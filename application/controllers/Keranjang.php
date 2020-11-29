<?php
defined('BASEPATH') or exit('No direct script access allowed');
class keranjang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('pengadaan_model', 'pmodel');
        $this->load->library('form_validation');
    }

    function index()
    {
        $data['title'] = 'Keranjang';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 2) {
            redirect('auth/blocked');
        }
        $data['pembelian'] = $this->pmodel->getpembelian($data['user']['id']);
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('pengadaan/keranjang', $data);
        $this->load->view('temp/footer');
    }

    // function Pembelian($kode)
    // {
    //     $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $id = $user['id'];
    //     $data = $this->pmodel->getpembelian($id);
    //     echo json_encode($data);
    // }

    function data_pembelian()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $user['id'];
        $data = $this->pmodel->getpembelian($id);
        echo json_encode($data);
    }

    function hapus_barang()
    {
        $id = $this->input->post('kode');
        $pb = $this->db->get_where('pembelian', ['id_pembelian' => $id])->row_array();
        $pn = $this->db->get_where('penawaran', ['id_penawaran' => $pb['id_penawaran']])->row_array();
        $jmlbaru = $pn['jumlah_tersedia']+$pb['jumlah'];
        $this->db->set('jumlah_tersedia',$jmlbaru);
		$this->db->where('id_penawaran',$pb['id_penawaran']);
		$this->db->update('penawaran');
        $data = $this->pmodel->hapuspembelian($id);
        echo json_encode($data);
    }
}
