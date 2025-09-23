<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    private $_table = "tb_user";

    public function generateId() {
        $unik = 'NIP';
        $kode = $this->db->query("SELECT MAX(id_user) LAST_NO FROM tb_user WHERE id_user LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 6);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%06s", $urutan);
        return $kode;
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($id_user, $data) {
        $this->db->where('id_user', $id_user);
        return $this->db->update($this->_table, $data);
    }

    public function delete($id_user) {
        $this->db->where('id_user', $id_user);
        return $this->db->delete($this->_table);
    }

    public function getAll() {
        return $this->db->get($this->_table);
    }

    public function getById($id_user) {
        return $this->db->get_where($this->_table, ["id_user" => $id_user]);
    }

    public function getPegawai() {
        return $this->db->get_where($this->_table, ["level" => "PEGAWAI"]);
    }
}