<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['surat_masuk'] = count($this->db->get('tb_surat_masuk')->result());
        $data['surat_keluar'] = count($this->db->get('tb_surat_keluar')->result());
        $data['arsip'] = count($this->db->get('tb_arsip')->result());
        $data['user'] = count($this->db->get('tb_user')->result());

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}