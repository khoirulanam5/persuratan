<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['SuratKeluarModel']);
        ispegawai();
    }

    public function index() {
        $data['title'] = 'Data Surat Keluar';
        $data['surat_keluar'] = $this->SuratKeluarModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/surat_keluar/index', $data);
        $this->load->view('template/footer');
    }

    public function setuju($id_surat_keluar) {
        $this->SuratKeluarModel->setuju($id_surat_keluar);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat Disetujui', icon:'success'})</script>");
		redirect('pegawai/surat_keluar');
    }

    public function tolak($id_surat_keluar) {
        $this->SuratKeluarModel->tolak($id_surat_keluar);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat Ditolak', icon:'success'})</script>");
		redirect('pegawai/surat_keluar');
    }
}