<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_surat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['JenisSuratModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Jenis Surat';
        $data['jenis'] = $this->JenisSuratModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/jenis_surat/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Jenis Surat';
        $data['jenis'] = $this->JenisSuratModel->getAll()->result();

        $this->form_validation->set_rules('jenis', 'Jenis Surat', 'required');
        $this->form_validation->set_rules('kode', 'Kode Surat', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/jenis_surat/add', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_jenis_surat' => $this->JenisSuratModel->generateId(),
                'jenis' => $this->input->post('jenis'),
                'kode' => $this->input->post('kode')
            ];
            $this->JenisSuratModel->save($data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Tambah data berhasil', icon:'success'})</script>");
			redirect('admin/jenis_surat');
        }
    }

    public function edit($id_jenis_surat) {
        $data['title'] = 'Edit Jenis Surat';
        $data['jenis'] = $this->JenisSuratModel->getById($id_jenis_surat)->row();

        $this->form_validation->set_rules('jenis', 'Jenis Surat', 'required');
        $this->form_validation->set_rules('kode', 'Kode Surat', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/jenis_surat/edit', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'jenis' => $this->input->post('jenis'),
                'kode' => $this->input->post('kode')
            ];
            $this->JenisSuratModel->edit($id_jenis_surat, $data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Edit data berhasil', icon:'success'})</script>");
			redirect('admin/jenis_surat');
        }
    }

    public function delete($id_jenis_surat) {
        $this->JenisSuratModel->delete($id_jenis_surat);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Delete data berhasil', icon:'success'})</script>");
        redirect('admin/jenis_surat');
    }
}