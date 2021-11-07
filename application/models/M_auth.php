<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function login_user($username){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where(['username' => $username]);

		return $this->db->get()->row();
	}

	public function login_pelanggan($username){
		$this->db->select('*');
		$this->db->from('tbl_pelanggan');
		$this->db->where(['username_pelanggan' => $username]);

		return $this->db->get()->row();
	}
}