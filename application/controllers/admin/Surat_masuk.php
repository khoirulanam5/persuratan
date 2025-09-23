<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['SuratMasukModel', 'JenisSuratModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Surat Masuk';
        $data['surat_masuk'] = $this->SuratMasukModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/surat_masuk/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Surat Masuk';
        $data['jenis'] = $this->JenisSuratModel->getAll()->result();
        
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('id_jenis_surat', 'ID Jenis Surat', 'required');
        $this->form_validation->set_rules('disposisi', 'Disposisi', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/surat_masuk/add', $data);
            $this->load->view('template/footer');
        } else {
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['max_size'] = 2048;
            $config['upload_path'] = './assets/img/surat_masuk/';
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('file')) {
                // Jika terjadi error saat upload
                $error = $this->upload->display_errors();
            
                // Menampilkan alert menggunakan SweetAlert
                $this->session->set_flashdata("pesan", "<script>
                    Swal.fire({
                        title: 'Gagal Upload!',
                        text: 'Ukuran file tidak boleh lebih dari 2mb',
                        icon: 'error'
                    });
                </script>");
                redirect('admin/surat_masuk/add');
            } else {
                // Jika upload berhasil
                $file = $this->upload->data('file_name');
            }
            
            $data = [
                'id_surat_masuk' => $this->SuratMasukModel->generateId(),
                'nomor' => $this->input->post('nomor'),
                'tgl_masuk' => date('Y-m-d'),
                'jam' => date('H:i:s'),
                'id_jenis_surat' => $this->input->post('id_jenis_surat'),
                'disposisi' => $this->input->post('disposisi'),
                'file' => $file
            ];
            $this->SuratMasukModel->save($data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil ditambahkan', icon:'success'})</script>");
			redirect('admin/surat_masuk');
        }
    }

    public function edit($id_surat_masuk) {
        $data['title'] = 'Edit Surat Masuk';
        $data['jenis'] = $this->JenisSuratModel->getAll()->result();
        $data['surat'] = $this->SuratMasukModel->getById($id_surat_masuk)->row();

        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('id_jenis_surat', 'ID Jenis Surat', 'required');
        $this->form_validation->set_rules('disposisi', 'Disposisi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/surat_masuk/edit', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'nomor' => $this->input->post('nomor'),
                'tgl_masuk' => date('Y-m-d'),
                'jam' => date('H:i:s'),
                'id_jenis_surat' => $this->input->post('id_jenis_surat'),
                'disposisi' => $this->input->post('disposisi')
            ];
    
            if (!empty($_FILES['file']['name'])) {
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size'] = '2048'; // Maksimal 2MB
                $config['upload_path'] = './assets/img/surat_masuk/';
                $this->load->library('upload', $config);
            
                if ($this->upload->do_upload('file')) {
                    $data['file'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Ukuran file harus di bawah 2 MB dan ekstensi pdf, doc, atau docx!', icon:'warning'})</script>");
                    redirect('admin/surat_masuk');
                    return;
                }
            }            
            $this->SuratMasukModel->edit($id_surat_masuk, $data);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('admin/surat_masuk');
        }
    }

    public function delete($id_surat_masuk) {
        $this->SuratMasukModel->delete($id_surat_masuk);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil dihapus', icon:'success'})</script>");
		redirect('admin/surat_masuk');
    }
}