<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratKeluarModel extends CI_Model {

    private $_table = "tb_surat_keluar";

    public function generateId() {
        $unik = 'SK';
        $kode = $this->db->query("SELECT MAX(id_surat_keluar) LAST_NO FROM tb_surat_keluar WHERE id_surat_keluar LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($id_surat_keluar, $data) {
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        return $this->db->update($this->_table, $data);
    }

    public function delete($id_surat_keluar) {
        $this->db->where('id_surat_keluar', $id_surat_keluar);
        return $this->db->delete($this->_table);
    }

    public function getAll() {
        $this->db->select('tb_jenis_surat.*, tb_surat_keluar.*');
        $this->db->from('tb_jenis_surat');
        $this->db->join('tb_surat_keluar', 'tb_jenis_surat.id_jenis_surat = tb_surat_keluar.id_jenis_surat');
        return $this->db->get();
    }

    public function getById($id_surat_keluar) {
        return $this->db->get_where($this->_table, ["id_surat_keluar" => $id_surat_keluar]);
    }

    public function getNomor() {
        $this->db->select('tb_jenis_surat.*, tb_surat_masuk.*');
        $this->db->from('tb_jenis_surat');
        $this->db->join('tb_surat_masuk', 'tb_jenis_surat.id_jenis_surat = tb_surat_masuk.id_jenis_surat');
        return $this->db->get();
    }
}