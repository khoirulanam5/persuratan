<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['UserModel']);
        ispegawai();
    }

    public function index() {
        $data['title'] = 'Data User';
        $data['user'] = $this->UserModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/user/index', $data);
        $this->load->view('template/footer');
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
            $this->load->view('pegawai/user/add', $data);
            $this->load->view('template/footer');
        } else {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/user/';
            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');
            $foto = $this->upload->data('file_name');

            $data = [
                'id_user' => $this->UserModel->generateId(),
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
            $this->UserModel->save($data);
            
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Tambah data user berhasil', icon:'success'})</script>");
			redirect('pegawai/user');
        }
    }

    public function edit($id_user) {
        $data['title'] = 'Edit Data User';
        $data['user'] = $this->UserModel->getById($id_user)->row();

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
            $this->load->view('pegawai/user/edit', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_user' => $id_user,
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
                    redirect('pegawai/user');
                    return;
                }
            }
            $this->UserModel->edit($id_user, $data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('pegawai/user');
        }
    }

    public function delete($id_user) {
        $this->UserModel->delete($id_user);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Hapus data user berhasil', icon:'success'})</script>");
		redirect('pegawai/user');
    }
}