<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek = $this->db->get_where("tb_user", ["username" => $username, "password" => $password])->row();

                if(!empty($cek)) {
                    $ses = [
                        'id_user' => $cek->id_user,
                        'username' => $cek->username,
                        'password' => $cek->password,
                        'level' => $cek->level,
                        'devisi' => $cek->devisi,
                        'nm_pengguna' => $cek->nm_pengguna,
                        'jenis_kelamin' => $cek->jenis_kelamin,
                        'no_hp' => $cek->no_hp,
                        'alamat' => $cek->alamat,
                        'foto' => $cek->foto
                    ];
                    $this->session->set_userdata($ses);

                    if ($cek->level == 'ADMIN') {
                        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Login Berhasil', icon:'success'})</script>");
                        redirect('dashboard');
                    } else if ($cek->level == 'PEGAWAI') {
                        $this->session->set_flashdata("pesan","<script>Swal.fire({icon:'success', title:'Berhasil', text:'Login Berhasil!', confirmButtonText:'OK'})</script>");
                        redirect('dashboard');
                    } else {
                        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Login Berhasil', icon:'success'})</script>");
                        redirect('dashboard');
                    }
                } else {
                    $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Gagal', text:'username / password salah', icon:'error'})</script>");
                    redirect('auth');
                }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}