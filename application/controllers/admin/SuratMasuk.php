<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratMasuk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Data Surat Masuk';
        // $data['surat'] = $this->db->get_where('tb_surat_masuk', ['status' => 'Diteruskan'])->result();
        $data['surat'] = $this->db->where_in('status', ['Diteruskan', 'Ditanggapi'])->get('tb_surat_masuk')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/suratmasuk/index', $data);
        $this->load->view('template/footer');
    }

    public function update_status($id_surat_masuk) {

        $this->db->set('status', 'Ditanggapi');
        $this->db->where('id_surat_masuk', $id_surat_masuk);
        $this->db->update('tb_surat_masuk');
        
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Status berhasil diperbarui menjadi Ditanggapi', icon:'success'})</script>");
        redirect('admin/suratmasuk');
    }

    public function delete($id_surat_masuk) {
        $this->db->where('id_surat_masuk', $id_surat_masuk);
        $this->db->delete('tb_surat_masuk');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil di hapus', icon:'success'})</script>");
		redirect('admin/suratmasuk');
    }
}