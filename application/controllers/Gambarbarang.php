<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambarbarang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_gambarbarang');
		$this->load->model('m_barang');
	}

	public function index(){

		$data['title'] = 'Gambar Barang';
		$data['gambarbarang'] = $this->m_gambarbarang->get_all_data();
		$data['isi'] = 'gambarbarang/v_index';

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add($id_barang)
	{

		$this->form_validation->set_rules('ket', 'Keterangan Gambar', 'required', array('required' => '%s Harus Diisi!'));
		
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambarbarang/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '4000'; //dlm kilobyte

			// ambil nama ketagori
			$namaBarang = $this->db->get_where('tbl_barang', ['id_barang' => $id_barang])->row();
			$ekstensi = explode('.', $_FILES['gambar']['name']);
			$newName = time() .'_'. $this->session->userdata('username');
			$config['file_name'] = htmlspecialchars($this->input->post('ket',TRUE)).'_'.$newName.'_'.current($ekstensi).'.'.end($ekstensi);

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar')) {

				$data = array(
					'title' =>'Tambah Gambar Barang',
					'error_upload' => $this->upload->display_errors(),
					'barang' => $this->m_barang->get_data($id_barang),
					'gambar' => $this->m_gambarbarang->get_gambar($id_barang),
					'isi' => 'gambarbarang/v_add',
				);

				// set session penjualan
				$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
				$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
				$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
				$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
				$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());				
				$this->load->view('layout/v_wrapper_backend', $data, FALSE);

			} else{
						
				$upload_data = ['uploads' => $this->upload->data()];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/gambarbarang/'.$upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				$data = array(
					'id_barang'=>$id_barang,
					'ket'=> htmlspecialchars($this->input->post('ket', TRUE)),
					'gambar' => $upload_data['uploads']['file_name'],
				);

				$this->m_gambarbarang->add($data);
				// set session penjualan
				$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
				$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
				$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
				$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
				$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
				$this->session->set_flashdata('pesan', 'Gambar Barang Berhasil Ditambahkan!');
				redirect('gambarbarang/add/'.$id_barang);

			}
		}
				
		$data['title'] = 'Tambah Gambar Barang';
		$data['barang'] = $this->m_barang->get_data($id_barang);
		$data['gambar'] = $this->m_gambarbarang->get_gambar($id_barang);
		$data['isi'] = 'gambarbarang/v_add';

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function delete($id_barang=null, $id_gambar=null){
		// hapus gambar
		$gambar = $this->m_gambarbarang->get_data($id_gambar);
		if ($gambar->gambar != "") {
			unlink('./assets/gambarbarang/'.$gambar->gambar);
		}
		// end hapus gambar

		$data = ['id_gambar' => $id_gambar ];

		$this->m_gambarbarang->delete($data);

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->session->set_flashdata('pesan', 'Gambar Barang Berhasil Dihapus!');
		redirect('gambarbarang/add/'.$id_barang);		
	}



}