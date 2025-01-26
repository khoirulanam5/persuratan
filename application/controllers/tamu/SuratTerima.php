<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratTerima extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Data Surat Masuk';
        $tujuan = $this->session->userdata('nm_pengguna');

        $this->db->where('tujuan', $tujuan);
        $this->db->group_start(); // Mulai grup kondisi
        $this->db->where('status', 'Teruskan');
        $this->db->or_where('status', 'Diterima');
        $this->db->group_end(); // Akhiri grup kondisi
        $data['surat'] = $this->db->get('tb_surat_keluar')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('tamu/suratterima/index', $data);
        $this->load->view('template/footer');
    }

    public function update_status($id_surat_keluar) {

        $this->db->set('tgl_terima', date('Y-m-d'));
        $this->db->set('status', 'Diterima');
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        $this->db->update('tb_surat_keluar');
        
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Surat telah di terima', icon:'success'})</script>");
        redirect('tamu/suratterima');
    }

    public function cetak($id_surat_keluar) {
        $data['title'] = 'Cetak Surat Keluar';
        // Ambil data surat keluar berdasarkan ID
        $this->db->select('tb_surat_keluar.*, tb_user.id_user');
        $this->db->from('tb_surat_keluar');
        $this->db->join('tb_user', 'tb_surat_keluar.pengirim = tb_user.nm_pengguna', 'left');
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        $data['surat'] = $this->db->get()->row();
    
        // Periksa apakah data ditemukan
        if (!$data['surat']) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Error', text:'Surat tidak ditemukan!', icon:'error'})</script>");
            redirect('tamu/suratterima');
        }
    
        // Load view khusus untuk cetak
        $this->load->view('tamu/suratterima/cetak', $data);
    }
}