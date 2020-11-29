<?php
defined('BASEPATH') or exit('No direct script access allowed');
class pemasok extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Home-Pemasok';
        $data['role_id'] = '4';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 4) {
            redirect('auth/blocked');
        }
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('home/home', $data);
        $this->load->view('temp/footer', $data);
    }
}
