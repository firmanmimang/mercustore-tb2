<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {

	public function register($data){
		$this->db->insert('tbl_pelanggan', $data);
	}

	public function get_pelanggan_all(){
		$this->db->select('*');
		$this->db->from('tbl_pelanggan');

		return $this->db->get()->result();
	}

	public function get_pelanggan($username_pelanggan){
		$this->db->select('*');
		$this->db->from('tbl_pelanggan');
		$this->db->where('username_pelanggan', $username_pelanggan);

		return $this->db->get()->row();
	}

	public function get_pelanggan_by_id($id_pelanggan){
		$this->db->select('*');
		$this->db->from('tbl_pelanggan');
		$this->db->where('id_pelanggan', $id_pelanggan);

		return $this->db->get()->row();
	}

	public function delete_pelanggan($data){
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->delete('tbl_pelanggan');
	}

	public function edit_akun($data){
		$this->db->where('id_pelanggan', $data['id_pelanggan']);
		$this->db->update('tbl_pelanggan', $data);
	}
}