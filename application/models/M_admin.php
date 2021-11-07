<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function total_barang(){
		return $this->db->get('tbl_barang')->num_rows();
	}

	public function total_kategori(){
		return $this->db->get('tbl_kategori')->num_rows();
	}

	public function total_pesanan(){
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order != 3');

		return $this->db->get()->num_rows();
	}

	public function data_setting(){
		$this->db->select('*');
		$this->db->from('tbl_setting');
		$this->db->where('id', 1);

		return $this->db->get()->row();
	}

	public function edit($data){
		$this->db->where('id', $data['id']);
		$this->db->update('tbl_setting', $data);
	}

	public function get_profile_admin($username){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('username', $username);

		return $this->db->get()->row();
	}

	public function edit_user($data){
		$this->db->where('id_user', $data['id_user']);
		$this->db->update('tbl_user', $data);
	}
}