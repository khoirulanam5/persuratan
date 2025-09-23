<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisSuratModel extends CI_Model {

    private $_table = "tb_jenis_surat";

    public function generateId() {
        $unik = 'JNS';
        $kode = $this->db->query("SELECT MAX(id_jenis_surat) LAST_NO FROM tb_jenis_surat WHERE id_jenis_surat LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($id_jenis_surat, $data) {
        $this->db->where('id_jenis_surat', $id_jenis_surat);
        return $this->db->update($this->_table, $data);
    }

    public function delete($id_jenis_surat) {
        $this->db->where('id_jenis_surat', $id_jenis_surat);
        return $this->db->delete($this->_table);
    }

    public function getAll() {
        return $this->db->get($this->_table);
    }

    public function getById($id_jenis_surat) {
        return $this->db->get_where($this->_table, ["id_jenis_surat" => $id_jenis_surat]);
    }

    public function getRekap() {
        $this->db->select('tb_jenis_surat.*, tb_surat_keluar.*');
        $this->db->from('tb_jenis_surat');
        $this->db->join('tb_surat_keluar', 'tb_jenis_surat.id_jenis_surat = tb_surat_keluar.id_jenis_surat');
        $this->db->where('tb_surat_keluar.status', 'Disetujui');
        return $this->db->get();
    }
}