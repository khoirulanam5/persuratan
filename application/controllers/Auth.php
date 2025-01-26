<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek = $this->db->get_where("tb_user", array("username" => $username, "password" => $password))->row();

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

    public function generateId(){
        $unik = 'NIP';
        $kode = $this->db->query("SELECT MAX(id_user) LAST_NO FROM tb_user WHERE id_user LIKE '".$unik."%'")->row()->LAST_NO;
        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($kode, 3, 6);
        
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;
        
        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = $unik;
        $kode = $huruf . sprintf("%06s", $urutan);
        return $kode;
      }

    public function register() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('nm_pengguna', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = [
                'id_user' => $this->generateId(),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => 'TAMU',
                'devisi' => 'Tamu (Pihak Eksternal)',
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'foto' => 'default.jpg'
            ];
            $this->db->insert('tb_user', $data);
    
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Akunmu sudah dibuat', icon:'success'})</script>");
			redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}