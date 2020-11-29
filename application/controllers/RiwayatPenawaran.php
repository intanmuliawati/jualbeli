<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Riwayatpenawaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pemasok_model', 'pmodel');
        $this->load->model('kategori_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Riwayat Penawaran';
        $data['role_id'] = '4';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->db->get('kategori_benang');
        $data['subkategori'] = $this->db->get('subkategori_benang');
        if ($data['user']['role_id'] != 4) {
            redirect('auth/blocked');
        }
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $user['id'];
        $data['penawaran'] = $this->pmodel->getlist($id);
        $this->form_validation->set_rules('subkategori', 'Subkategori', 'required', ['required' => 'Pilih benang!']);
        $this->form_validation->set_rules('warna', 'Warna', 'required', ['required' => 'Warna tidak boleh kosong!']);
        $this->form_validation->set_rules('jumlahtersedia', 'jumlahtersedia', 'required', ['required' => 'Jumlah tersedia tidak boleh kosong!']);
        $this->form_validation->set_rules('hargasatuan', 'Hargasatuan', 'required', ['required' => 'Harga satuan tidak boleh kosong!']);
        // $this->form_validation->set_rules('contoh', 'Contoh', 'required', ['required' => 'Masukan gambar contoh benang!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pemasok/pengajuanpenawaran', $data);
            $this->load->view('temp/footer');
        } else {
            $this->add();
        }
    }

    public function add()
    {
        // $data['title'] = 'List Pengajuan Penawaran';
        // $data['role_id'] = '4';
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['kategori'] = $this->db->get('kategori_benang');
        // $data['subkategori'] = $this->db->get('subkategori_benang');
        // $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $id = $user['id'];
        // $data['penawaran'] = $this->pmodel->getlist($id);
        // $this->load->view('temp/header', $data);
        // $this->load->view('temp/sidebar', $data);
        // $this->load->view('temp/topbar', $data);
        // $this->load->view('pemasok/pengajuanpenawaran', $data);
        // $this->load->view('temp/footer');

        $gambar = "default.jpg";
        $upload_image = $_FILES['contoh']['name'];
        if ($upload_image) {
            $config['upload_path'] = './assets/upload/contohbenang/';  // folder upload 
            $config['allowed_types']        = 'gif|jpg|png'; // jenis file
            $config['max_size']             = 2048;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('contoh')) //sesuai dengan name pada form 
            {
                $gambar = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('flash', 'error');
                redirect('riwayatpenawaran');
            }
        }
        $data = [
            'id_pemasok' => $this->input->post('id_pemasok', true),
            'id_benang' => $this->input->post('subkategori', true),
            'warna' => $this->input->post('warna', true),
            'jumlah_tersedia' => $this->input->post('jumlahtersedia', true),
            'harga_satuan' => $this->input->post('hargasatuan', true),
            'biaya_kirim' => $this->input->post('biayakirim', true),
            'contoh' => $gambar,
            'catatan' => $this->input->post('catatan', true),
        ];
        $this->db->insert('penawaran', $data);
        $this->session->set_flashdata('flash', 'diinput!');
        redirect('riwayatpenawaran');
    }

    public function ubahpenawaran()
    {
        $data['title'] = 'Riwayat Penawaran';
        $data['role_id'] = '4';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->db->get('kategori_benang');
        $data['subkategori'] = $this->db->get('subkategori_benang');
        if ($data['user']['role_id'] != 4) {
            redirect('auth/blocked');
        }
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $user['id'];
        $data['penawaran'] = $this->pmodel->getlist($id);
        $this->form_validation->set_rules('warna2', 'Warna2', 'required', ['required' => 'Warna tidak boleh kosong!']);
        $this->form_validation->set_rules('jtersedia2', 'jtersedia2', 'required', ['required' => 'Jumlah tersedia tidak boleh kosong!']);
        $this->form_validation->set_rules('harga2', 'Harga2', 'required', ['required' => 'Harga satuan tidak boleh kosong!']);
        // $this->form_validation->set_rules('contoh', 'Contoh', 'required', ['required' => 'Masukan gambar contoh benang!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pemasok/pengajuanpenawaran', $data);
            $this->load->view('temp/footer');
        } else {
            $id = $this->input->post('id_penawaran', true);
            $warna = $this->input->post('warna2', true);
            $jumlah_tersedia = $this->input->post('jtersedia2', true);
            $harga_satuan =  $this->input->post('harga2', true);
            $biaya_kirim = $this->input->post('biaya2', true);
            $catatan = $this->input->post('catatan', true);

            $upload = $_FILES['contoh']['name'];
            if ($upload) {
                // $contoh = $this->input->post('contoh', true);
                $config['upload_path'] = './assets/upload/contohbenang/';  // folder upload 
                $config['allowed_types']        = 'gif|jpg|png'; // jenis file
                $config['max_size']             = 2048;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('contoh')) //sesuai dengan name pada form 
                {
                    $this->session->set_flashdata('flash', 'error');
                    redirect('riwayatpenawaran');
                } else {
                    $oldimage = $this->input->post('fotolama');
                    if ($oldimage != 'default.jpg') {
                        unlink(FCPATH . 'assets/upload/contohbenang/' . $oldimage);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('contoh', $new_image);
                }
            }
            $this->db->set('warna', $warna);
            $this->db->set('jumlah_tersedia', $jumlah_tersedia);
            $this->db->set('harga_satuan', $harga_satuan);
            $this->db->set('biaya_kirim', $biaya_kirim);
            $this->db->set('catatan', $catatan);
            $this->db->where('id_penawaran', $id);
            $this->db->update('penawaran');
            $this->session->set_flashdata('flash', 'diubah!');
            redirect('riwayatpenawaran');
        }
    }

    // public function search()
    // {
    //     $data['title'] = 'Riwayat Penawaran';
    //     $data['role_id'] = '4';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['kategori'] = $this->db->get('kategori_benang');
    //     $data['subkategori'] = $this->db->get('subkategori_benang');
    //     if ($data['user']['role_id'] != 4) {
    //         redirect('auth/blocked');
    //     }
    //     $id = $data['user']['id'];
    //     $keyword = $this->input->post('keyword');
    //     $data['penawaran'] = $this->pmodel->search($id, $keyword);
    //     $this->load->view('temp/header', $data);
    //     $this->load->view('temp/sidebar', $data);
    //     $this->load->view('temp/topbar', $data);
    //     $this->load->view('pemasok/pengajuanpenawaran', $data);
    //     $this->load->view('temp/footer');
    // }

    function hapuspenawaran($id)
    {

        // $this->tmodel->hapuspenilaian($where, 'penilaian_pemasok');
        $beli = $this->db->get('pembelian')->result_array();
        $found = false;
        foreach ($beli as $b) {
            if ($b['id_penawaran'] == $id) {
                $found = true;
            }
        }
        if ($found == true) {
            $this->session->set_flashdata('flash', 'error5');
            redirect('riwayatpenawaran');
        }
        $this->db->where('id_penawaran', $id);
        $this->db->delete('penawaran');
        $this->session->set_flashdata('flash', 'dihapus!');
        redirect('riwayatpenawaran');
    }

    function get_subkategori()
    {
        $id = $this->input->post('id');
        $data = $this->kategori_model->get_subkategori($id);
        echo json_encode($data);
    }
}
