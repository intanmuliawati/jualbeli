<?php
defined('BASEPATH') or exit('No direct script access allowed');
class pemesanan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('pemasok_model', 'pmodel');
        $this->load->library('form_validation');
    }
    function index()
    {
        $data['title'] = 'Pemesanan';
        $data['role_id'] = '4';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 4) {
            redirect('auth/blocked');
        }
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $user['id'];
        $data['pemesanan'] = $this->pmodel->getpesanan($id);
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', ['required' => 'Tanggal tidak boleh kosong!']);
        // $this->form_validation->set_rules('contoh', 'Contoh', 'required', ['required' => 'Masukan surat jalan!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('pemasok/pemesanan', $data);
            $this->load->view('temp/footer');
        } else {
            $this->pengiriman();
        }
    }
    public function pengiriman()
    {
        $data['title'] = 'Pemesanan';
        $data['role_id'] = '4';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $user['id'];
        $data['pemesanan'] = $this->pmodel->getpesanan($id);
        $this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('pemasok/pemesanan', $data);
        $this->load->view('temp/footer');

        $gambar = "default.jpg";
        $upload_image = $_FILES['contoh']['name'];
        if ($upload_image) {
            $config['upload_path'] = './assets/upload/suratjalan/';  // folder upload 
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
                redirect('pemesanan');
            }
        }

        // $this->load->library('upload', $config);

        // if (!$this->upload->do_upload('contoh')) //sesuai dengan name pada form 
        // {
        //     $this->session->set_flashdata('flash', 'error');
        //     redirect('pemesanan');
        // } else {
        //     $file = $this->upload->data();
        //     $gambar = $file['file_name'];

        $data = [
            'id_pembelian' => $this->input->post('id_pembelian', true),
            'tgl_kirim' => $this->input->post('tanggal', true),
            'pengiriman' => $this->input->post('pengiriman', true),
            'resi_pengiriman' => $this->input->post('resi', true),
            'bukti' => $gambar,
            'status_kirim' => 1,
            'cat' => $this->input->post('catatan', true),
        ];

        $this->db->insert('pengiriman', $data);
        $id = $this->input->post('id_pembelian', true);
        $this->db->set('status_kirim', '1');
        $this->db->where('id_pembelian', $id);
        $this->db->update('pembelian');
        $this->session->set_flashdata('flash', 'diinput!');
        redirect('pemesanan');
    }
}
