<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratKeluar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Proses Surat Keluar';
        $data['surat'] = $this->db->get('tb_surat_keluar')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/suratkeluar/index', $data);
        $this->load->view('template/footer');
    }

    public function edit($id_surat_keluar) {
        $data['title'] = 'Edit Surat Keluar';
        $data['id_surat_keluar'] = $id_surat_keluar; // Tambahkan variabel ini
        $data['tujuan'] = $this->db->get_where('tb_user', ['level' => 'TAMU'])->result();
        $data['surat'] = $this->db->get_where('tb_surat_keluar', ['id_surat_keluar' => $id_surat_keluar])->row();
    
        if (!$data['surat']) {
            $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Error', text:'Surat tidak ditemukan', icon:'error'})</script>");
            redirect('pegawai/suratkeluar');
            return;
        }
    
        $this->form_validation->set_rules('perihal', 'Perihal Surat', 'required');
        $this->form_validation->set_rules('isi_surat', 'Isi Surat', 'required');
        $this->form_validation->set_rules('tujuan', 'Tujuan Surat', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/suratkeluar/edit', $data); // Pastikan view menerima variabel
            $this->load->view('template/footer');
        } else {
            $update_data = [
                'perihal' => $this->input->post('perihal'),
                'isi_surat' => $this->input->post('isi_surat'),
                'tujuan' => $this->input->post('tujuan')
            ];
    
            $this->db->where('id_surat_keluar', $id_surat_keluar);
            $this->db->update('tb_surat_keluar', $update_data);
    
            $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Berhasil', text:'Surat berhasil diedit', icon:'success'})</script>");
            redirect('pegawai/suratkeluar');
        }
    }

    public function update_status($id_surat_keluar) {

        $this->db->set('status', 'Teruskan');
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        $this->db->update('tb_surat_keluar');
        
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Surat berhasil diteruskan ke tamu', icon:'success'})</script>");
        redirect('pegawai/suratkeluar');
    }

    public function delete($id_surat_keluar) {
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        $this->db->delete('tb_surat_keluar');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil di hapus', icon:'success'})</script>");
		redirect('pegawai/suratkeluar');
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
            redirect('pegawai/suratkeluar');
        }
    
        // Load view khusus untuk cetak
        $this->load->view('pegawai/suratkeluar/cetak', $data);
    }
}