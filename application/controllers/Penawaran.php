<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Penawaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengadaan_model', 'pmodel');
    }
    public function index()
    {
        $data['title'] = 'Penawaran';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 2) {
            redirect('auth/blocked');
        }
        $data['penawaran'] = $this->pmodel->getList();
        // $data['rekomendasi'] = $this->pmodel->rekomendasi();
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required', ['required' => 'Jumlah tidak boleh kosong!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pengadaan/penawaran', $data);
            $this->load->view('temp/footer');
        } else {
            $id = $this->input->post('id_penawaran', true);
            $jumlah = $this->input->post('jumlah', true);
            $jumlahter = $this->input->post('jumlahter', true);
            $harga = $this->input->post('harga', true);
            // $biaya = $this->input->post('biaya', true);
            $total = ($jumlah * $harga);
            if ($jumlah > $jumlahter) {
                $this->session->set_flashdata('flash', 'lebih dari stok!');
                redirect('penawaran');
            } else {
                $data = [
                    'id_penawaran' => $this->input->post('id_penawaran', true),
                    'jumlah' => $this->input->post('jumlah', true),
                    // 'tanggal_pembelian' => date("Y-m-d"),
                    'total' => $total,
                    'id' => $data['user']['id']
                ];
                $this->db->insert('pembelian', $data);
                $sisa = $jumlahter - $jumlah;
                $this->pmodel->updatesisa($id, $sisa);
                $this->session->set_flashdata('flash', 'diinput!');
                redirect('keranjang');
            }
        }
    }
    public function search()
    {
        $data['title'] = 'Penawaran';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 2) {
            redirect('auth/blocked');
        }
        $data['rekomendasi'] = $this->pmodel->rekomendasi();
        $keyword = $this->input->post('keyword');
        $data['penawaran'] = $this->pmodel->search($keyword);
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('pengadaan/penawaran', $data);
        $this->load->view('temp/footer');
    }
}
