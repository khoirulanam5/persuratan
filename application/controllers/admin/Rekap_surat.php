<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_surat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['JenisSuratModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Rekap Surat Keluar';
        $data['rekap_surat'] = $this->JenisSuratModel->getRekap()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/rekap_surat/index', $data);
        $this->load->view('template/footer');
    }
}