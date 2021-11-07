<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rinci extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_rinci');
	}

	public function index(){
		$data['title'] = 'Rinci Transaksi';
		$data['rinci_transaksi'] = $this->m_rinci->get_rinci_transaksi();
		$data['isi'] = 'v_rinci_transaksi';

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}


}