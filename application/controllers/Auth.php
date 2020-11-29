<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required', [
            'required' => 'Email tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password tidak boleh kosong!'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login page';
            $this->load->view('temp/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('temp/auth_footer');
        } else {
            //validasi success
            $this->login_();
        }
    }

    private function login_()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        //jika user terdaftar
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                //cekpassword
                if (password_verify($password, $user['password'])) { //membandingkan password input dan data user
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                    ];

                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else if ($user['role_id'] == 2) {
                        redirect('dashboard');
                    } else if ($user['role_id'] == 3) {
                        redirect('gudang');
                    } else if ($user['role_id'] == 4) {
                        redirect('pemasok');
                    } else if ($user['role_id'] == 5) {
                        redirect('administrasi');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                    Password Salah! </div>');
                    redirect('auth');
                }
            } else { //user tidak aktif
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                    Akun Tidak Aktif! </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
            Email Tidak Terdaftar! </div>');
            redirect('auth');
        }
    }


    public function register()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|trim', ['required' => 'Nama tidak boleh kosongl!']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email sudah terdaftar!',
            'required' => 'Email tidak boleh kosong!',
            'valid_email' => 'Format email salah!'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim', [
            'required' => 'Alamat tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('no_tlp', 'No_tlp', 'required|trim', [
            'required' => 'No tlp tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Password tidak boleh kosong!',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'required' => 'Password tidak boleh kosong!'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $data['role'] = $this->db->get('user_role')->result_array();
            $this->load->view('temp/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('temp/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'no_tlp' => htmlspecialchars($this->input->post('no_tlp', true)),
                'role_id' => htmlspecialchars($this->input->post('role_id', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'is_active' => '0',
                'date_created' => date("Y-m-d"),
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
            Akun berhasil didaftarkan! </div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
        Logout berhasil ! </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
