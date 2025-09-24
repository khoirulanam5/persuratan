<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['SuratMasukModel']);
        ispegawai();
    }

    public function index() {
        $data['title'] = 'Data Surat Masuk';
        $data['surat_masuk'] = $this->SuratMasukModel->getByDevisi()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pegawai/surat_masuk/index', $data);
        $this->load->view('template/footer');
    }
}