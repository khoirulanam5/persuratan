<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Arsip Surat';
        $data['arsip'] = $this->db->get('tb_arsip')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/arsip/index', $data);
        $this->load->view('template/footer');
    }

    public function generateId() {
        $unik = 'ARS';
        $kode = $this->db->query("SELECT MAX(id_arsip) LAST_NO FROM tb_arsip WHERE id_arsip LIKE '".$unik."%'")->row()->LAST_NO;
        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($kode, 3, 6);
        
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
        $data['title'] = 'Arsipkan Surat';

        $data['surat'] = $this->db->query("
                            SELECT id_surat_masuk AS id_surat, 'Surat Masuk' AS jenis_surat 
                            FROM tb_surat_masuk
                            UNION
                            SELECT id_surat_keluar AS id_surat, 'Surat Keluar' AS jenis_surat 
                            FROM tb_surat_keluar")->result();

        $this->form_validation->set_rules('id_surat', 'ID Surat', 'required');
        $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required');
        $this->form_validation->set_rules('lokasi_arsip', 'Lokasi Pengarsipan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/arsip/add', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->generateId();

            $data = [
                'id_arsip' => $id,
                'id_surat' => $this->input->post('id_surat'),
                'jenis_surat' => $this->input->post('jenis_surat'),
                'lokasi_arsip' => $this->input->post('lokasi_arsip'),
                'tgl_arsip' => date('Y-m-d')
            ];
            $this->db->insert('tb_arsip', $data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil diarsipkan', icon:'success'})</script>");
			redirect('admin/arsip');
        }
    }

    public function detail($id_arsip) {
        $data['title'] = 'Detail Surat';
        $this->db->select('tb_arsip.*, tb_surat_masuk.*, tb_surat_keluar.*'); // Memilih kolom dari tiga tabel
        $this->db->from('tb_arsip');
        $this->db->join('tb_surat_masuk', 'tb_arsip.id_surat = tb_surat_masuk.id_surat_masuk', 'left'); // Join dengan tb_surat_masuk
        $this->db->join('tb_surat_keluar', 'tb_arsip.id_surat = tb_surat_keluar.id_surat_keluar', 'left'); // Join dengan tb_surat_keluar
        $this->db->where('tb_arsip.id_arsip', $id_arsip); // Filter berdasarkan id_arsip
        $data['arsip'] = $this->db->get()->result(); // Mengambil satu baris data

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/arsip/detail', $data);
        $this->load->view('template/footer');
    }

    public function delete($id_arsip) {
        $this->db->where('id_arsip', $id_arsip);
        $this->db->delete('tb_arsip');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil dihapus', icon:'success'})</script>");
		redirect('admin/arsip');
    }
}