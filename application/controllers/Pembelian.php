<?php
defined('BASEPATH') or exit('No direct script access allowed');
class pembelian extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('pengadaan_model', 'pmodel');
        $this->load->library('form_validation');
    }

    function index()
    {
        $data['title'] = 'Riwayat Pembelian';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 2) {
            redirect('auth/blocked');
        }
        $data['riwayat'] = $this->db->get_where('riwayat', ['id_user' => $data['user']['id']])->result_array();
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('pengadaan/pembelian', $data);
        $this->load->view('temp/footer');
    }

    function cetakinvoice($id)
    {
        $data['title'] = 'Cetak';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['riwayat'] = $this->db->get_where('riwayat', ['id_faktur' => $id])->row_array();
        $data['pembelian'] = $this->pmodel->getcetak($id);
        $this->load->view('invoice', $data);
    }
    
    function detail ($faktur)
    {
        $data['title'] = 'Detail Pembelian';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 2) {
            redirect('auth/blocked');
        }
       
        $data['detail'] = $this->pmodel->getdetail($faktur);
        $data['pengiriman'] = $this->db->get('pengiriman')->result_array();;
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('pengadaan/detail', $data);
        $this->load->view('temp/footer');
    }

    function infopengiriman($id)
    {
        $data['title'] = 'Riwayat Pembelian';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pengiriman'] = $this->pmodel->getpengiriman($id);
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('pengadaan/pengiriman', $data);
        $this->load->view('temp/footer');
    }

    public function ubahstatus($id)
    {
        $this->db->set('status_kirim', 2);
        $this->db->where('id_pembelian', $id);
        $this->db->update('pembelian');
        $this->session->set_flashdata('flash', 'diubah!');
        redirect('pembelian');
    }
}
