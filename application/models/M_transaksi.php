<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

	public function simpan_transaksi($data)
	{
		$this->db->insert('tbl_transaksi', $data);
	}

	public function simpan_rinci_transaksi($data_rinci)
	{
		$this->db->insert('tbl_rinci_transaksi', $data_rinci);
	}

	public function belum_bayar($id_pelanggan)
	{
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order=0');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('no_order', 'asc');
		
		return $this->db->get()->result();
	}

	public function diproses($id_pelanggan)
	{
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order=1');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('no_order', 'asc');
		
		return $this->db->get()->result();
	}

	public function dikirim($id_pelanggan)
	{
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order=2');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('no_order', 'asc');
		
		return $this->db->get()->result();
	}

	public function selesai($id_pelanggan)
	{
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->where('status_order=3');
		$this->db->where('id_pelanggan', $id_pelanggan);
		$this->db->order_by('no_order', 'asc');
		
		return $this->db->get()->result();
	}

	public function update_order($data){
		$this->db->where('no_order', $data['no_order']);
		$this->db->update('tbl_transaksi', $data);
	}

	public function detail_pesanan($no_order)
	{
		$this->db->select('*');
		$this->db->from('tbl_transaksi');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		$this->db->where('no_order', $no_order);

		return $this->db->get()->row();
	}

	public function rekening()
	{
		$this->db->select('*');
		$this->db->from('tbl_rekening');

		return $this->db->get()->result();
	}

	public function upload_bukti_bayar($data)
	{
		$this->db->where('no_order', $data['no_order']);
		$this->db->update('tbl_transaksi', $data);
	}
}