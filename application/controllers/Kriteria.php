<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kriteria extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('topsis_model', 'tmodel');
        $this->load->library('form_validation');
    }

    function index()
    {
        $data['title'] = 'Kriteria';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 2) {
            redirect('auth/blocked');
        }
        $data['kriteria'] = $this->db->get('kriteria')->result_array();
        $data['kode'] = $this->tmodel->kode();
        $this->form_validation->set_rules('namakriteria', 'Namakriteria', 'required', ['required' => 'Nama kriteria tidak boleh kosong!']);
        $this->form_validation->set_rules('atribut', 'Atribut', 'required', ['required' => 'Pilih atribut kriteria!']);
        $this->form_validation->set_rules('bobot', 'Bobot', 'required', ['required' => 'Pilih bobot kriteria!']);

        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pengadaan/kriteria', $data);
            $this->load->view('temp/footer');
        } else {
            $data = [
                'id_kriteria' =>  $this->input->post('id_kriteria', true),
                'nama_kriteria' =>  $this->input->post('namakriteria', true),
                'atribut' => $this->input->post('atribut', true),
                'bobot' => $this->input->post('bobot', true)
            ];
            $this->db->insert('kriteria', $data);
            $kriteria = $this->input->post('id_kriteria', true);
            $user =  $this->tmodel->getuser();
            foreach ($user as $us) {
                $pengguna[] = $us['id'];
            }
            $pgn = array_unique($pengguna);
            foreach ($pgn as $un) {
                $data2 = [
                    'id_pemasok' => $un,
                    'id_kriteria' => $kriteria,
                    'nilai' => 1
                ];
                $this->db->insert('penilaian_pemasok', $data2);
            }
            $this->session->set_flashdata('flash', 'dimasukan');
            redirect('penilaianpemasok');
        }
    }
    function hapuskriteria($id)
    {
        $where = array('id_kriteria' => $id);
        $this->tmodel->hapuskriteria($where, 'kriteria');
        // $this->tmodel->hapuspenilaian($where, 'penilaian_pemasok');
        $this->session->set_flashdata('flash', 'dihapus!');
        $this->topsis();
    }

    function ubahkriteria()
    {
        $data['title'] = 'Kriteria';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 2) {
            redirect('auth/blocked');
        }
        $data['kriteria'] = $this->db->get('kriteria')->result_array();
        $data['kode'] = $this->tmodel->kode();
        $this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => 'Nama kriteria tidak boleh kosong!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pengadaan/kriteria', $data);
            $this->load->view('temp/footer');
        } else {
            $id = $this->input->post('id_kriteria', true);
            $nama_kriteria = $this->input->post('nama', true);
            $atribut = $this->input->post('atribut', true);
            $bobot = $this->input->post('bobot', true);
            $this->tmodel->ubahkri($id, $nama_kriteria, $atribut, $bobot);
            $this->session->set_flashdata('flash', 'diubah!');
            $this->topsis();
        }
    }
    function topsis()
    {
        $query = $this->db->query("SELECT `penilaian_pemasok`.*,`user`. `name` ,`kriteria`. *
        FROM `penilaian_pemasok` JOIN `user`ON `penilaian_pemasok`.`id_pemasok` = `user`.`id`
        JOIN `kriteria`ON `penilaian_pemasok`.`id_kriteria` = `kriteria`.`id_kriteria`");

        $data      = array();
        $kriterias = array();
        $bobot     = array();
        $nilai_kuadrat = array();
        $atribut = array();

        if ($query) {
            foreach ($query->result() as $row) {
                if (!isset($data[$row->name])) {
                    $data[$row->name] = array();
                }
                if (!isset($data[$row->name][$row->nama_kriteria])) {
                    $data[$row->name][$row->nama_kriteria] = array();
                }
                if (!isset($nilai_kuadrat[$row->nama_kriteria])) {
                    $nilai_kuadrat[$row->nama_kriteria] = 0;
                }
                $bobot[$row->nama_kriteria] = $row->bobot;
                $data[$row->name][$row->nama_kriteria] = $row->nilai;
                $nilai_kuadrat[$row->nama_kriteria] += pow($row->nilai, 2);
                $kriterias[] = $row->nama_kriteria;
                $atribut[$row->nama_kriteria] = $row->atribut;
            }
        }
        $kriteria     = array_unique($kriterias);
        $jml_kriteria = count($kriteria);
        $i = 0;
        $y = array();
        foreach ($data as $nama => $krit) {
            ++$i;
            foreach ($kriteria as $k) {
                $y[$k][$i - 1] = round(($krit[$k] / sqrt($nilai_kuadrat[$k])), 4) * $bobot[$k];
            }
        }
        foreach ($kriteria as $k) {

            if ($atribut[$k] == 0) {
                $yplus[$k] = ([$k] ? max($y[$k]) : min($y[$k]));
            } else if ($atribut[$k] == 1) {
                $yplus[$k] = [$k] ? min($y[$k]) : max($y[$k]);
            }
        }
        $ymin = array();
        foreach ($kriteria as $k) {

            if ($atribut[$k] == 1) {
                $ymin[$k] = ([$k] ? max($y[$k]) : min($y[$k]));
            } else if ($atribut[$k] == 0) {
                $ymin[$k] = [$k] ? min($y[$k]) : max($y[$k]);
            }
        }
        $i = 0;
        $dplus = array();
        foreach ($data as $nama => $krit) {
            ++$i;
            foreach ($kriteria as $k) {
                if (!isset($dplus[$i - 1])) $dplus[$i - 1] = 0;
                $dplus[$i - 1] += pow($yplus[$k] - $y[$k][$i - 1], 2);
            }
        }
        $i = 0;
        $dmin = array();
        foreach ($data as $nama => $krit) {
            ++$i;
            foreach ($kriteria as $k) {
                if (!isset($dmin[$i - 1])) $dmin[$i - 1] = 0;
                $dmin[$i - 1] += pow($ymin[$k] - $y[$k][$i - 1], 2);
            }
        }
        $i = 0;
        $V = array();
        foreach ($data as $nama => $krit) {
            ++$i;
            foreach ($kriteria as $k) {
                $V = round(sqrt($dmin[$i - 1]) / (sqrt($dmin[$i - 1]) + sqrt($dplus[$i - 1])), 7);
            }
            $this->db->set('nilai_preferensi', $V);
            $this->db->where('name', $nama);
            $this->db->update('user');
        }

        redirect('penilaianpemasok');
    }
}
