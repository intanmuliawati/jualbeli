<?php
defined('BASEPATH') or exit('No direct script access allowed');
class informasipenjualan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('pemasok_model', 'pmodel');
        $this->load->library('form_validation');
    }

    function index()
    {
        $data['title'] = 'Informasi Penjualan';
        $data['role_id'] = '4';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 4) {
            redirect('auth/blocked');
        }
        $st = $this->input->post('status', true);
        if (isset($st)) {
            $data['pembelian'] = $this->pmodel->getpembelian2($st);
            $data['status'] = $st;
        } else {
            $data['pembelian'] = $this->pmodel->getpembelian2(1);
            $data['status'] = 1;
        }
        // if ($st == 0) {
        //     $data['tabel'] = 'Tabel Daftar Penjualan';
        // } else
        if ($st == 2) {
            $data['tabel'] = 'Tabel Daftar Penjualan Selesai';
        } else  {
            $data['tabel'] = 'Tabel Daftar Pengiriman ';
        }
        $data['pengiriman'] = $this->db->get('pengiriman')->result_array();
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('pemasok/informasipenjualan', $data);
        $this->load->view('temp/footer');
    }
}
