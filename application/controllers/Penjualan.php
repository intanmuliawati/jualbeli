<?php
defined('BASEPATH') or exit('No direct script access allowed');
class penjualan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('pengadaan_model', 'pmodel');
        $this->load->model('kategori_model', 'kmodel');
        $this->load->library('form_validation');
    }
    function index()
    {
        $data['title'] = 'Data Penjualan';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['penjualan'] = $this->pmodel->getPenjualan();
        $data['kategori'] = $this->kmodel->get_kategori();

        $this->form_validation->set_rules('jumlah_p', 'jumlah_p', 'required');
        $this->form_validation->set_rules('t_jumlah', 't_jumlah', 'required');
        $this->form_validation->set_rules('t_harga', 't_harga', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pengadaan/penjualan', $data);
            $this->load->view('temp/footer');
        } else {
            $jumlah = $this->input->post('jumlah_p', true);
            $t_jumlah = $this->input->post('t_jumlah', true);
            $t_harga = $this->input->post('t_harga', true);
            $r_jumlah = $t_jumlah / $jumlah;
            $r_harga = $t_harga / $jumlah;

            $data = [
                'id_benang' =>  $this->input->post('subkategori', true),
                'jumlah_p' => $jumlah,
                't_jumlah' => $t_jumlah,
                'r_jumlah' => $r_jumlah,
                't_harga' => $t_harga,
                'r_harga' => $r_harga
            ];

            $this->db->insert('datapenjualan', $data);
            $this->session->set_flashdata('flash', 'diinput!');
            redirect('penjualan');
        }
    }

    function ubahpenjualan()
    {
        $id = $this->input->post('id', true);
        $benang_id = $this->input->post('id_benang', true);
        $jumlah = $this->input->post('jumlah_p', true);
        $t_jumlah = $this->input->post('t_jumlah', true);
        $t_harga = $this->input->post('t_harga', true);
        $r_jumlah = $t_jumlah / $jumlah;
        $r_harga = $t_harga / $jumlah;
        $this->pmodel->ubahpenjualan($id, $benang_id, $jumlah, $t_jumlah, $r_jumlah, $t_harga, $r_harga);
        $this->session->set_flashdata('flash', 'diubah!');
        redirect('penjualan');
    }

    function hapuspenjualan($id)
    {
        $where = array('id_penjualan' => $id);
        $this->pmodel->hapuspenjualan($where, 'datapenjualan');
        $this->session->set_flashdata('flash', 'dihapus!');
        redirect('penjualan');
    }
}
