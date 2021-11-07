<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('m_home');
	}

	public function index()
	{

		$data['title'] = 'Home';
		$data['barang'] = $this->m_home->get_all_data();
		$data['isi'] = 'v_home';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function kategori($id_kategori)
	{
		$kategori= $this->m_home->kategori($id_kategori);

		$data['title'] = 'Kategori ' . $kategori->nama_kategori;
		$data['barang'] = $this->m_home->get_all_data_barang($id_kategori);
		$data['isi'] = 'v_kategori_frontend';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}	

	public function detail_barang($id_barang){

		$data['title'] = 'Detail Barang ';
		$data['gambar'] = $this->m_home->gambar_barang($id_barang);
		$data['barang'] = $this->m_home->detail_barang($id_barang);
		$data['isi'] = 'v_detail_barang_frontend';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function about(){
		$this->load->model('m_admin');
		$data['title'] = 'About ';
		$data['lokasi'] = $this->m_admin->data_setting();
		$data['isi'] = 'v_about';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}
}