<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_laporan');
	}

	public function index(){

		$data['title'] = 'Laporan Penjualan';
		$data['isi'] = 'v_laporan';

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function lap_harian(){

		$tanggal = $this->input->post('tanggal');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$tgl_laporan = strtotime($this->input->post('tanggal').'-'.$this->input->post('bulan').'-'.$this->input->post('tahun').' 11:59:59 pm');

		$data['title'] = 'Laporan Penjualan Harian';
		$data['tanggal'] = $tanggal;
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$data['laporan'] = $this->m_laporan->lap_harian($tgl_laporan);
		$data['isi'] = 'v_lap_harian';

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function lap_bulanan(){

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$tgl_laporan = strtotime('31-'.$this->input->post('bulan').'-'.$this->input->post('tahun').' 11:59:59 pm');

		$data['title'] = 'Laporan Penjualan Bulanan';
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$data['laporan'] = $this->m_laporan->lap_bulanan($tgl_laporan);
		$data['isi'] = 'v_lap_bulanan';

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function lap_tahunan(){

		$tahun = $this->input->post('tahun');
		$tgl_laporan = strtotime('31-12-'.$this->input->post('tahun').' 11:59:59 pm');

		$data['title'] = 'Laporan Penjualan Tahunan';
		$data['tahun'] = $tahun;
		$data['laporan'] = $this->m_laporan->lap_tahunan($tgl_laporan);
		$data['isi'] = 'v_lap_tahunan';

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}
}