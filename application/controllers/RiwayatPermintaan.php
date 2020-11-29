
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class riwayatpermintaan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('permintaan_model', 'pmodel');
        $this->load->library('form_validation');
    }
    function index()
    {
        $data['title'] = 'Riwayat Permintaan';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 2) {
            redirect('auth/blocked');
        }
        $data['pemesanan'] = $this->pmodel->getBenang2();

        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('pengadaan/riwayatpermintaan', $data);
        $this->load->view('temp/footer');
    }
}
