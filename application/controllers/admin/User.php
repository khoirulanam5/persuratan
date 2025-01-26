<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get('tb_user')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/user/index', $data);
        $this->load->view('template/footer');
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

    public function add() {
        $data['title'] = 'Tambah Data User';

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('devisi', 'Devisi', 'required');
        $this->form_validation->set_rules('nm_pengguna', 'Nama Lengkap', 'required|is_unique[tb_user.nm_pengguna]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/user/add', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->GenerateId();
            //konfigurasi upload foto
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/user/';
            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');
            $foto = $this->upload->data('file_name');

            $data = [
                'id_user' => $id,
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level'),
                'devisi' => $this->input->post('devisi'),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'foto' => $foto
            ];
            $this->db->insert('tb_user', $data);
            
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Tambah data user berhasil', icon:'success'})</script>");
			redirect('admin/user');
        }
    }

    public function edit($id_user) {
        $data['title'] = 'Edit Data User';
        $data['user'] = $this->db->get_where('tb_user', ['id_user' => $id_user])->row();

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('devisi', 'Devisi', 'required');
        $this->form_validation->set_rules('nm_pengguna', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/user/edit', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->input->post('id_user');
            $data = [
                'id_user' => $id,
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level'),
                'devisi' => $this->input->post('devisi'),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat')
            ];
    
            if (!empty($_FILES['foto']['name'])) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/user/';
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('foto')) {
                    $data['foto'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Ukuran file harus di bawah 2 MB dan ekstensi gif, jpg, png, atau jpeg!', icon:'warning'})</script>");
                    redirect('admin/user');
                    return;
                }
            }
    
            $this->db->where('id_user', $id);
            $this->db->update('tb_user', $data);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('admin/user');
        }
    }

    public function delete($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Hapus data user berhasil', icon:'success'})</script>");
		redirect('admin/user');
    }
}