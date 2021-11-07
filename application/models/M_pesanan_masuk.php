<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesanan_masuk extends CI_Model {

	public function pesanan(){
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		$this->db->where('status_order=0');
		$this->db->order_by('no_order', 'asc');
		
		return $this->db->get()->result();
	}

	public function pesanan_diproses(){
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		$this->db->where('status_order=1');
		$this->db->order_by('no_order', 'asc');
		
		return $this->db->get()->result();
	}

	public function pesanan_dikirim(){
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		$this->db->where('status_order=2');
		$this->db->order_by('no_order', 'asc');
		
		return $this->db->get()->result();
	}

	public function pesanan_selesai(){
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		$this->db->where('status_order=3');
		$this->db->order_by('no_order', 'asc');
		
		return $this->db->get()->result();
	}

	public function update_order($data){
		$this->db->where('no_order', $data['no_order']);
		$this->db->update('tbl_transaksi', $data);
	}

	public function total_pesanan_semua(){
		$this->db->select('*');
		$this->db->from('tbl_transaksi');

		return $this->db->get()->num_rows();
	}

	public function total_pesanan_masuk(){
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order = 0');

		return $this->db->get()->num_rows();
	}

	public function total_pesanan_proses(){
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order = 1');

		return $this->db->get()->num_rows();
	}

	public function total_pesanan_kirim(){
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order = 2');

		return $this->db->get()->num_rows();
	}

	public function total_pesanan_selesai(){
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order = 3');

		return $this->db->get()->num_rows();
	}
}
