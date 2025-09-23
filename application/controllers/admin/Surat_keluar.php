<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['SuratKeluarModel', 'JenisSuratModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Surat Keluar';
        $data['surat_keluar'] = $this->SuratKeluarModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/surat_keluar/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Surat Keluar';
        $data['jenis'] = $this->JenisSuratModel->getAll()->result();
        $data['nomor'] = $this->SuratKeluarModel->getNomor()->result();
        
        $this->form_validation->set_rules('id_jenis_surat', 'ID Jenis Surat', 'required');
        $this->form_validation->set_rules('kepada', 'Kepada', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal Surat', 'required');
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/surat_keluar/add', $data);
            $this->load->view('template/footer');
        } else {
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['max_size'] = 2048;
            $config['upload_path'] = './assets/img/surat_keluar/';
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
                redirect('admin/surat_keluar/add');
            } else {
                // Jika upload berhasil
                $file = $this->upload->data('file_name');
            }
            
            $data = [
                'id_surat_keluar' => $this->SuratKeluarModel->generateId(),
                'id_jenis_surat' => $this->input->post('id_jenis_surat'),
                'kepada' => $this->input->post('kepada'),
                'perihal' => $this->input->post('perihal'),
                'nomor' => $this->input->post('nomor'),
                'tgl_buat' => date('Y-m-d'),
                'file' => $file,
                'status' => 'Pending'
            ];
            $this->SuratKeluarModel->save($data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat keluar berhasil ditambahkan', icon:'success'})</script>");
			redirect('admin/surat_keluar');
        }
    }

    public function edit($id_surat_keluar) {
        $data['title'] = 'Edit Surat Keluar';
        $data['jenis'] = $this->JenisSuratModel->getAll()->result();
        $data['surat'] = $this->SuratKeluarModel->getById($id_surat_keluar)->row();
        $data['nomor'] = $this->SuratKeluarModel->getNomor()->result();

        $this->form_validation->set_rules('id_jenis_surat', 'ID Jenis Surat', 'required');
        $this->form_validation->set_rules('kepada', 'Kepada', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal Surat', 'required');
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/surat_keluar/edit', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_jenis_surat' => $this->input->post('id_jenis_surat'),
                'kepada' => $this->input->post('kepada'),
                'perihal' => $this->input->post('perihal'),
                'nomor' => $this->input->post('nomor'),
                'tgl_buat' => date('Y-m-d'),
                'status' => 'Pending'
            ];
    
            if (!empty($_FILES['file']['name'])) {
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/surat_masuk/';
                $this->load->library('upload', $config);
            
                if ($this->upload->do_upload('file')) {
                    $data['file'] = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Ukuran file harus di bawah 2 MB dan ekstensi pdf, doc, atau docx!', icon:'warning'})</script>");
                    redirect('admin/surat_keluar');
                    return;
                }
            }            
            $this->SuratKeluarModel->edit($id_surat_keluar, $data);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('admin/surat_keluar');
        }
    }

    public function delete($id_surat_keluar) {
        $this->SuratKeluarModel->delete($id_surat_keluar);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil dihapus', icon:'success'})</script>");
		redirect('admin/surat_keluar');
    }
}