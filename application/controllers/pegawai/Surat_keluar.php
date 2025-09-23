<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Data Surat Keluar';
        
        $this->db->select('tb_jenis_surat.*, tb_surat_keluar.*');
        $this->db->from('tb_jenis_surat');
        $this->db->join('tb_surat_keluar', 'tb_jenis_surat.id_jenis_surat = tb_surat_keluar.id_jenis_surat');
        $data['surat_keluar'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/surat_keluar/index', $data);
        $this->load->view('template/footer');
    }

    public function setuju($id_surat_keluar) {
        $this->db->set('status', 'Disetujui');
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        $this->db->update('tb_surat_keluar');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat Disetujui', icon:'success'})</script>");
		redirect('pegawai/surat_keluar');
    }

    public function tolak($id_surat_keluar) {
        $this->db->set('status', 'Ditolak');
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        $this->db->update('tb_surat_keluar');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat Ditolak', icon:'success'})</script>");
		redirect('pegawai/surat_keluar');
    }
}