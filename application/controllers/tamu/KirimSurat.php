<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KirimSurat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Data Surat Terkirim';
        // Ambil ID pengguna yang login
        $nama = $this->session->userdata('nm_pengguna');

        // Ambil data surat berdasarkan pengguna login
        $data['surat'] = $this->db->get_where('tb_surat_masuk', ['pengirim' => $nama])->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('tamu/suratmasuk/index', $data);
        $this->load->view('template/footer');
    }

    public function generateId(){
        $unik = 'IN';
        $kode = $this->db->query("SELECT MAX(id_surat_masuk) LAST_NO FROM tb_surat_masuk WHERE id_surat_masuk LIKE '".$unik."%'")->row()->LAST_NO;
        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($kode, 2, 6);
        
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;
        
        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = $unik;
        $kode = $huruf . sprintf("%06s", $urutan);
        return $kode;
      }

    public function add() {
        $data['title'] = 'Kirim Surat';
        
        $this->form_validation->set_rules('perihal', 'Judul Surat', 'required');
        $this->form_validation->set_rules('isi_surat', 'Isi Surat', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('tamu/suratmasuk/add', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->generateId();

            // Konfigurasi upload file
            $config['allowed_types'] = 'pdf|doc|docx'; // Format file yang diizinkan
            $config['max_size'] = '2048'; // Ukuran maksimal file (dalam KB, 2048 KB = 2 MB)
            $config['upload_path'] = './assets/img/surat_masuk/'; // Direktori penyimpanan file

            $this->load->library('upload', $config);
            $this->upload->do_upload('file'); // 'file' adalah nama input di form
            $file = $this->upload->data('file_name'); // Mendapatkan nama file yang berhasil diunggah

            $data = [
                'id_surat_masuk' => $id,
                'tgl_kirim' => date('Y-m-d'),
                'perihal' => $this->input->post('perihal'),
                'isi_surat' => $this->input->post('isi_surat'),
                'pengirim' => $this->session->userdata('nm_pengguna'),
                'file' => $file
            ];
            $this->db->insert('tb_surat_masuk', $data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil di kirim', icon:'success'})</script>");
			redirect('tamu/kirimsurat');
        }
    }

    public function edit($id_surat_masuk) {
        $data['title'] = 'Edit Kirim Surat';
        $data['surat'] = $this->db->get_where('tb_surat_masuk', ['id_surat_masuk' => $id_surat_masuk])->row();

        $this->form_validation->set_rules('perihal', 'Judul Surat', 'required');
        $this->form_validation->set_rules('isi_surat', 'Isi Surat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('tamu/suratmasuk/edit', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->input->post('id_surat_masuk');
            $data = [
                'id_surat_masuk' => $id,
                'tgl_kirim' => date('Y-m-d'),
                'perihal' => $this->input->post('perihal'),
                'isi_surat' => $this->input->post('isi_surat'),
                'pengirim' => $this->session->userdata('nm_pengguna')
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
                    redirect('tamu/kirimsurat');
                    return;
                }
            }            
    
            $this->db->where('id_surat_masuk', $id);
            $this->db->update('tb_surat_masuk', $data);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('tamu/kirimsurat');
        }
    }

    public function delete($id_surat_masuk) {
        $this->db->where('id_surat_masuk', $id_surat_masuk);
        $this->db->delete('tb_surat_masuk');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil di hapus', icon:'success'})</script>");
		redirect('tamu/kirimsurat');
    }
}