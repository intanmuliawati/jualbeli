<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'Amodel');
    }
    public function index()
    {
        $data['title'] = 'Home-Admin';
        $data['role_id'] = '1';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 1) {
            redirect('auth/blocked');
        }
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('home/home', $data);
        $this->load->view('temp/footer', $data);
    }

    public function pengaturan_user()
    {
        $data['title'] = 'Pengaturan User';
        $data['role_id'] = '1';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 1) {
            redirect('auth/blocked');
        }
        $data['datauser'] = $this->Amodel->getuser();
        $data['role'] = $this->Amodel->getrole();
        $this->form_validation->set_rules('name', 'Name', 'required|trim', ['required' => 'Nama tidak boleh kosong!']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email tidak boleh kosong!',
            'is_unique' => 'Email sudah terdaftar!',
            'valid_email' => 'Format email salah!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat tidak boleh kosong!']);
        $this->form_validation->set_rules('no', 'No', 'required|trim', ['required' => 'No Hp tidak boleh kosong!']);
        $this->form_validation->set_rules('role_id', 'Role_id', 'required|trim', ['required' => 'Pilih posisi user!']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Password tidak boleh kosong!',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'required' => 'Password tidak boleh kosong!',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('admin/daftaruser', $data);
            $this->load->view('temp/footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'no_tlp' => htmlspecialchars($this->input->post('no', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id', true),
                'is_active' => $this->input->post('aktif', true),
                'date_created' => date("Y-m-d"),
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('flash', 'diinput!');
            redirect('admin/pengaturan_user');
        }
    }
    public function hapususer($id)
    {
        $where = array('id' => $id);
        $this->Amodel->hapususer($where, 'user');
        $this->session->set_flashdata('flash', 'dihapus!');
        $this->pengaturan_user();
    }
    function ubahuser()
    {
        $data['title'] = 'Pengaturan User';
        $data['role_id'] = '1';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 1) {
            redirect('auth/blocked');
        }
        $data['datauser'] = $this->Amodel->getuser();
        $data['role'] = $this->Amodel->getrole();
        $this->form_validation->set_rules('name2', 'Name2', 'required|trim', ['required' => 'Nama tidak boleh kosong!']);
        $this->form_validation->set_rules('alamat2', 'Alamat2', 'required|trim', ['required' => 'Alamat tidak boleh kosong!']);
        $this->form_validation->set_rules('no2', 'No2', 'required|trim', ['required' => 'No Hp tidak boleh kosong!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('admin/daftaruser', $data);
            $this->load->view('temp/footer');
        } else {
            $id = $this->input->post('id', true);
            $nama = $this->input->post('name2', true);
            $email = $this->input->post('email2', true);
            $alamat = $this->input->post('alamat2', true);
            $no_tlp = $this->input->post('no2', true);
            $role_id = $this->input->post('role_id', true);
            $active = $this->input->post('aktif', true);
            $this->Amodel->ubahuser($id, $nama, $email, $alamat, $no_tlp, $role_id, $active);
            $this->session->set_flashdata('flash', 'diubah!');
            redirect('admin/pengaturan_user');
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

        redirect('admin/pengaturan_user');
    }
}
