<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProsesSurat extends CI_Controller {

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
        $this->load->view('admin/suratkeluar/index', $data);
        $this->load->view('template/footer');
    }

    public function generateId(){
        $unik = 'OUT';
        $kode = $this->db->query("SELECT MAX(id_surat_keluar) LAST_NO FROM tb_surat_keluar WHERE id_surat_keluar LIKE '".$unik."%'")->row()->LAST_NO;
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

    public function generateIdKeluar(){
        $unik = 'SEND';
        $kode = $this->db->query("SELECT MAX(id_surat_keluar) LAST_NO FROM tb_surat_keluar WHERE id_surat_keluar LIKE '".$unik."%'")->row()->LAST_NO;
        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($kode, 4, 6);
        
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
        $data['title'] = 'Buat Surat Keluar';
        $data['tujuan'] = $this->db->get_where('tb_user', ['level' => 'TAMU'])->result();

        $this->form_validation->set_rules('perihal', 'Perihal Surat', 'required');
        $this->form_validation->set_rules('isi_surat', 'Isi Surat', 'required');
        $this->form_validation->set_rules('tujuan', 'Tujuan Surat', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/suratkeluar/add', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->generateIdKeluar();

            $data = [
                'id_surat_keluar' => $id,
                'tgl_kirim' => date('Y-m-d'),
                'perihal' => $this->input->post('perihal'),
                'isi_surat' => $this->input->post('isi_surat'),
                'pengirim' => $this->session->userdata('nm_pengguna'),
                'tujuan' => $this->input->post('tujuan')
            ];
            $this->db->insert('tb_surat_keluar', $data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil di kirim', icon:'success'})</script>");
			redirect('admin/prosessurat');
        }
    }

    public function edit($id_surat_keluar) {
        $data['title'] = 'Edit Surat Keluar';
        $data['id_surat_keluar'] = $id_surat_keluar; // Tambahkan variabel ini
        $data['tujuan'] = $this->db->get_where('tb_user', ['level' => 'TAMU'])->result();
        $data['surat'] = $this->db->get_where('tb_surat_keluar', ['id_surat_keluar' => $id_surat_keluar])->row();
    
        if (!$data['surat']) {
            $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Error', text:'Surat tidak ditemukan', icon:'error'})</script>");
            redirect('admin/prosessurat');
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
            redirect('admin/prosessurat');
        }
    }    

    public function balas_surat($id_surat_masuk) {
        $data['title'] = 'Proses Surat Balasan';
        $data['id_surat_masuk'] = $id_surat_masuk;
        // Query untuk mendapatkan pengirim berdasarkan id_surat_masuk
        $this->db->select('pengirim');
        $this->db->from('tb_surat_masuk');
        $this->db->where('id_surat_masuk', $id_surat_masuk);
        $pengirim = $this->db->get()->row()->pengirim;

        // Siapkan data untuk dikirim ke view
        $data['tujuan_surat'] = $pengirim;

        $this->form_validation->set_rules('perihal', 'Perihal Surat', 'required');
        $this->form_validation->set_rules('isi_surat', 'Isi Surat', 'required');
        $this->form_validation->set_rules('tujuan', 'Tujuan Surat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/suratkeluar/balas_surat', $data);
            $this->load->view('template/footer');
        } else {
            $id = $this->generateId();

            $data = [
                'id_surat_keluar' => $id,
                'tgl_kirim' => date('Y-m-d'),
                'perihal' => $this->input->post('perihal'),
                'isi_surat' => $this->input->post('isi_surat'),
                'pengirim' => $this->session->userdata('nm_pengguna'),
                'tujuan' => $this->input->post('tujuan')
            ];
            $this->db->insert('tb_surat_keluar', $data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil di kirim', icon:'success'})</script>");
			redirect('admin/prosessurat');
        }
    }

    public function delete($id_surat_keluar) {
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        $this->db->delete('tb_surat_keluar');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Surat berhasil di hapus', icon:'success'})</script>");
		redirect('admin/prosessurat');
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
            redirect('admin/suratkeluar');
        }
    
        // Load view khusus untuk cetak
        $this->load->view('admin/suratkeluar/cetak', $data);
    }
}