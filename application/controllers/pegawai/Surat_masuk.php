<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Data Surat Masuk';
        
        $this->db->select('a.jenis, tb_surat_masuk.*, b.devisi');
        $this->db->from('tb_jenis_surat a');
        $this->db->join('tb_surat_masuk', 'a.id_jenis_surat = tb_surat_masuk.id_jenis_surat');
        $this->db->join('tb_user b', 'b.devisi = tb_surat_masuk.disposisi');
        $this->db->where('tb_surat_masuk.disposisi', $this->session->userdata('devisi'));
        $data['surat_masuk'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/surat_masuk/index', $data);
        $this->load->view('template/footer');
    }
}