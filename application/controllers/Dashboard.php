<?php
defined('BASEPATH') or exit('No direct script access allowed');
class dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 2) {
            redirect('auth/blocked');
        }
        // $nilai = $this->tmodel->getnilai();
        // $data['nilai'] = json_encode($nilai);
        // $data['penjualan'] = $this->pmodel->getpenjualan4();
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('home/home', $data);
        $this->load->view('temp/footer', $data);
    }
}
