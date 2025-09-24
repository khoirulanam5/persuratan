<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratMasukModel extends CI_Model {

    private $_table = "tb_surat_masuk";

    public function generateId() {
        $unik = 'SM';
        $kode = $this->db->query("SELECT MAX(id_surat_masuk) LAST_NO FROM tb_surat_masuk WHERE id_surat_masuk LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($id_surat_masuk, $data) {
        $this->db->where('id_surat_masuk', $id_surat_masuk);
        return $this->db->update($this->_table, $data);
    }

    public function delete($id_surat_masuk) {
        $this->db->where('id_surat_masuk', $id_surat_masuk);
        return $this->db->delete($this->_table);
    }

    public function getAll() {
        $this->db->select('a.jenis, tb_surat_masuk.*');
        $this->db->from('tb_jenis_surat a');
        $this->db->join('tb_surat_masuk', 'a.id_jenis_surat = tb_surat_masuk.id_jenis_surat');
        return $this->db->get();
    }

    public function getById($id_surat_masuk) {
        return $this->db->get_where($this->_table, ["id_surat_masuk" => $id_surat_masuk]);
    }

    public function getByDevisi() {
        $this->db->select('a.jenis, tb_surat_masuk.*, b.devisi');
        $this->db->from('tb_jenis_surat a');
        $this->db->join('tb_surat_masuk', 'a.id_jenis_surat = tb_surat_masuk.id_jenis_surat');
        $this->db->join('tb_user b', 'b.devisi = tb_surat_masuk.disposisi');
        $this->db->where('tb_surat_masuk.disposisi', $this->session->userdata('devisi'));
        return $this->db->get();
    }
}