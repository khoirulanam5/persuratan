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
        $data['surat'] = $this->db->get('tb_surat_masuk')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/suratmasuk/index', $data);
        $this->load->view('template/footer');
    }

    public function teruskan($id_surat_masuk) {
        $data['title'] = 'Teruskan Surat Ke Admin';
        $data['surat'] = $this->db->get_where('tb_surat_masuk', ['id_surat_masuk' => $id_surat_masuk])->row();

        $this->form_validation->set_rules('tgl_kirim', 'Tanggal Kirim', 'required');
        $this->form_validation->set_rules('perihal', 'Judul Surat', 'required');
        $this->form_validation->set_rules('isi_surat', 'Isi Surat', 'required');
        $this->form_validation->set_rules('pengirim', 'Pengirim Surat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('pegawai/suratmasuk/teruskan', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->input->post('id_surat_masuk');
            $data = [
                'id_surat_masuk' => $id,
                'tgl_kirim' => $this->input->post('tgl_kirim'),
                'tgl_terima' => date('Y-m-d'),
                'perihal' => $this->input->post('perihal'),
                'isi_surat' => $this->input->post('isi_surat'),
                'pengirim' => $this->input->post('pengirim'),
                'penerima' => $this->session->userdata('nm_pengguna'),
                'status' => 'Diteruskan'
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
                    redirect('pegawai/suratmasuk');
                    return;
                }
            }            
    
            $this->db->where('id_surat_masuk', $id);
            $this->db->update('tb_surat_masuk', $data);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Surat Berhasil di Teruskan ke Admin', icon:'success'})</script>");
            redirect('pegawai/suratmasuk');
        }
    }

    public function delete($id_surat_masuk) {
        $this->db->where('id_surat_masuk', $id_surat_masuk);
        $this->db->delete('tb_surat_masuk');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil di hapus', icon:'success'})</script>");
		redirect('pegawai/suratmasuk');
    }
}