<?php
defined('BASEPATH') or exit('No direct script access allowed');

class editprofile extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] == NULL) {
            redirect('auth/blocked');
        }
        $data['role_id'] = $data['user']['role_id'];
        $this->form_validation->set_rules('passwordlama', 'Passwordlama', 'required|trim', ['required' => 'Password lama tidak boleh kosong!']);
        $this->form_validation->set_rules('password1', 'password1', 'required|trim|min_length[6]', [
            'required' => 'Password baru tidak boleh kosong!',

            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'password2', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Ulangi password tidak boleh kosong!',
            'min_length' => 'Password terlalu pendek!',
            'matches' => 'Password baru tidak sama!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('profile/profile', $data);
            $this->load->view('temp/footer');
        } else {
            $passlama = $this->input->post('passwordlama');
            $newpassword = $this->input->post('password1');
            if (!password_verify($passlama, $data['user']['password'])) {
                $this->session->set_flashdata('flash', 'error3');
                redirect('editprofile');
            } else {
                if ($passlama == $newpassword) {
                    $this->session->set_flashdata('flash', 'error4');
                    redirect('editprofile');
                }

                $password = password_hash($newpassword, PASSWORD_DEFAULT);
                $this->db->set('password', $password);
                $this->db->where('email', $data['user']['email']);
                $this->db->update('user');
                $this->session->set_flashdata('flash', 'diubah!');
                redirect('editprofile');
            }
        }
    }

    function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] == NULL) {
            redirect('auth/blocked');
        }
        $data['role_id'] = $data['user']['role_id'];
        $this->form_validation->set_rules('name', 'Name', 'required|trim', ['required' => 'Nama tidak boleh kosong!']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat tidak boleh kosong!']);
        $this->form_validation->set_rules('no', 'No', 'required|trim', ['required' => 'No Hp tidak boleh kosong!']);

        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/sidebar', $data);
            $this->load->view('temp/topbar', $data);
            $this->load->view('profile/profile', $data);
            $this->load->view('temp/footer');
        } else {
            $id = $this->input->post('id', true);
            $nama = $this->input->post('name', true);
            $alamat = $this->input->post('alamat', true);
            $no_tlp = $this->input->post('no', true);

            $this->db->set('name', $nama);
            $this->db->set('alamat', $alamat);
            $this->db->set('no_tlp', $no_tlp);
            $this->db->where('id', $id);
            $this->db->update('user');
            $this->session->set_flashdata('flash', 'diubah!');
            redirect('editprofile');
        }
    }
}
