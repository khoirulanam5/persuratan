<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['UserModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Pegawai';
        $data['pegawai'] = $this->UserModel->getPegawai()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/pegawai/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Data Pegawai';

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('devisi', 'Devisi', 'required');
        $this->form_validation->set_rules('nm_pengguna', 'Nama Lengkap', 'required|is_unique[tb_user.nm_pengguna]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/pegawai/add', $data);
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
                'level' => 'PEGAWAI',
                'devisi' => $this->input->post('devisi'),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'foto' => $foto
            ];
            $this->UserModel->save($data);
            
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Tambah data pegawai berhasil', icon:'success'})</script>");
			redirect('admin/pegawai');
        }
    }

    public function edit($id_user) {
        $data['title'] = 'Edit Data Pegawai';
        $data['pegawai'] = $this->UserModel->getById($id_user)->row();

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('devisi', 'Devisi', 'required');
        $this->form_validation->set_rules('nm_pengguna', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/pegawai/edit', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_user' => $this->input->post('id_user'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level' => 'PEGAWAI',
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
                    redirect('admin/pegawai');
                    return;
                }
            }
            $this->UserModel->edit($id_user, $data);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('admin/pegawai');
        }
    }

    public function delete($id_user) {
        $this->UserModel->delete($id_user);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Hapus data pegawai berhasil', icon:'success'})</script>");
		redirect('admin/pegawai');
    }
}