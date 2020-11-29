<?php
defined('BASEPATH') or exit('No direct script access allowed');
class jenisbenang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('kategori_model', 'kmodel');
        $this->load->library('form_validation');
    }

    function index()
    {
        $data['title'] = 'Jenis Benang';
        $data['role_id'] = '1';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 1) {
            redirect('auth/blocked');
        }
        $data['kategori'] = $this->db->get('kategori_benang')->result_array();
        $this->form_validation->set_rules('namakategori', 'Namakategori', 'required', ['required' => 'Nama jenis benang tidak boleh kosong!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pengadaan/kategori', $data);
            $this->load->view('temp/footer');
        } else {
            $this->db->insert('kategori_benang', ['kategori_nama' => $this->input->post('namakategori')]);
            $this->session->set_flashdata('flash', 'diinput!');
            redirect('jenisbenang');
        }
    }
    function hapuskategori($id)
    {
        $where = array('kategori_id' => $id);
        $this->kmodel->hapusdatakategori($where, 'kategori_benang');
        $this->session->set_flashdata('flash', 'dihapus!');
        redirect('jenisbenang');
    }
    function ubahkategori()
    {
        $data['title'] = 'Jenis Benang';
        $data['role_id'] = '1';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 1) {
            redirect('auth/blocked');
        }
        $data['kategori'] = $this->db->get('kategori_benang')->result_array();
        $this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => 'Nama jenis benang tidak boleh kosong!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pengadaan/kategori', $data);
            $this->load->view('temp/footer');
        } else {
            $kategori_id = $this->input->post('id', true);
            $kategori_nama = $this->input->post('nama', true);
            $this->kmodel->ubahkat($kategori_id, $kategori_nama);
            $this->session->set_flashdata('flash', 'diubah!');
            redirect('jenisbenang');
        }
    }

    function nobenang()
    {

        $data['title'] = 'No Benang';
        $data['role_id'] = '1';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 1) {
            redirect('auth/blocked');
        }
        $data['kategori'] = $this->db->get('kategori_benang')->result_array();
        $data['subkategori'] = $this->kmodel->getkategori();
        $this->form_validation->set_rules('kategori_jenis', 'Kategori_jenis', 'required', ['required' => 'Pilih jenis benang!']);
        $this->form_validation->set_rules('namasubkategori', 'namasubkategori', 'required', ['required' => 'No benang tidak boleh kosong!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pengadaan/subkategori', $data);
            $this->load->view('temp/footer');
        } else {
            $data = [
                'subkategori_nama' => $this->input->post('namasubkategori', true),
                'kategori_id' =>  $this->input->post('kategori_jenis', true),
            ];
            $this->db->insert('subkategori_benang', $data);
            $this->session->set_flashdata('flash', 'diinput!');
            redirect('jenisbenang/nobenang');
        }
    }

    function hapussubkategori($id)
    {
        $where = array('subkategori_id' => $id);
        $this->kmodel->hapusdatasubkategori($where, 'subkategori_benang');
        $this->session->set_flashdata('flash', 'dihapus!');
        redirect('jenisbenang/nobenang');
    }

    function ubahsubkategori()
    {
        $data['title'] = 'No Benang';
        $data['role_id'] = '1';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 1) {
            redirect('auth/blocked');
        }
        $data['kategori'] = $this->db->get('kategori_benang')->result_array();
        $data['subkategori'] = $this->kmodel->getkategori();
        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => 'No benang tidak boleh kosong!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pengadaan/subkategori', $data);
            $this->load->view('temp/footer');
        } else {
            $subkategori_id = $this->input->post('id', true);
            $subkategori_nama = $this->input->post('nama', true);
            $kategori_id = $this->input->post('kategori_jenis', true);
            $this->kmodel->ubahsubkat($subkategori_id, $subkategori_nama, $kategori_id);
            $this->session->set_flashdata('flash', 'diubah!');
            redirect('jenisbenang/nobenang');
        }
    }
}
