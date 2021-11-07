<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

	public function lap_harian($tgl_laporan){
		$this->db->select('*');
		$this->db->from('tbl_rinci_transaksi');
		$this->db->join('tbl_transaksi', 'tbl_transaksi.no_order = tbl_rinci_transaksi.no_order', 'left');
		$this->db->join('tbl_barang', 'tbl_barang.id_barang = tbl_rinci_transaksi.id_barang', 'left');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		$this->db->where('status_bayar=1');
		$this->db->where('tbl_transaksi.tgl_order <', $tgl_laporan);
		$this->db->where('tbl_transaksi.tgl_order >', $tgl_laporan-(24*60*60));
		// $this->db->where('DAY(tbl_transaksi.tgl_order)', $tanggal);
		// $this->db->where('MONTH(tbl_transaksi.tgl_order)', $bulan);
		// $this->db->where('YEAR(tbl_transaksi.tgl_order)', $tahun);

		return $this->db->get()->result();
	}

	public function lap_bulanan($tgl_laporan){
		// $this->db->select('*');
		// $this->db->from('tbl_transaksi');
		// $this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		// $this->db->where('status_bayar=1');
		$this->db->select('*');
		$this->db->from('tbl_rinci_transaksi');
		$this->db->join('tbl_transaksi', 'tbl_transaksi.no_order = tbl_rinci_transaksi.no_order', 'left');
		$this->db->join('tbl_barang', 'tbl_barang.id_barang = tbl_rinci_transaksi.id_barang', 'left');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		$this->db->where('status_bayar=1');
		$this->db->where('tbl_transaksi.tgl_order <', $tgl_laporan);
		$this->db->where('tbl_transaksi.tgl_order >', $tgl_laporan-(31*24*60*60));
		// $this->db->where('MONTH(tbl_transaksi.tgl_order)', $bulan);
		// $this->db->where('YEAR(tbl_transaksi.tgl_order)', $tahun);

		return $this->db->get()->result();
	}

	public function lap_tahunan($tgl_laporan){
		// $this->db->select('*');
		// $this->db->from('tbl_transaksi');
		// $this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		// $this->db->where('status_bayar=1');
		$this->db->select('*');
		$this->db->from('tbl_rinci_transaksi');
		$this->db->join('tbl_transaksi', 'tbl_transaksi.no_order = tbl_rinci_transaksi.no_order', 'left');
		$this->db->join('tbl_barang', 'tbl_barang.id_barang = tbl_rinci_transaksi.id_barang', 'left');
		$this->db->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan', 'left');
		$this->db->where('status_bayar=1');
		$this->db->where('tbl_transaksi.tgl_order <', $tgl_laporan);
		$this->db->where('tbl_transaksi.tgl_order >', $tgl_laporan-(12*31*24*60*60));
		// $this->db->where('YEAR(tbl_transaksi.tgl_order)', $tahun);

		return $this->db->get()->result();
	}
}