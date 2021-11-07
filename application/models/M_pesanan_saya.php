<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesanan_saya extends CI_Model {

	public function invoice($no_order){
		$this->db->select('*');
		$this->db->from('tbl_rinci_transaksi');
		$this->db->join('tbl_transaksi', 'tbl_transaksi.no_order = tbl_rinci_transaksi.no_order', 'left');
		$this->db->join('tbl_barang', 'tbl_barang.id_barang = tbl_rinci_transaksi.id_barang', 'left');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		$this->db->where('tbl_rinci_transaksi.no_order', $no_order);

		return $this->db->get()->result();
	}
	

}