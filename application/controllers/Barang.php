<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->model('m_gambarbarang');
		$this->load->model('m_kategori');
	}

	public function index()
	{

		$data['title'] = 'Barang';
		$data['isi'] = 'barang/v_barang';
		$data['barang'] = $this->m_barang->get_all_data();

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add()
	{

		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('harga', 'Harga', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('berat', 'Berat', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required' => '%s Harus Diisi!'));
		
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambar/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '4000'; //dlm kilobyte

			// ambil nama ketagori
			$kategori = $this->db->get_where('tbl_kategori', ['id_kategori' => htmlspecialchars($this->input->post('id_kategori', true))])->row();
			$ekstensi = explode('.', $_FILES['gambar']['name']);
			$newName = time() .'_'.$this->session->userdata('username');
			$config['file_name'] = $kategori->nama_kategori.'_'.$newName.'_'.current($ekstensi).'.'.end($ekstensi);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar')) {

				$data = array(
					'title' =>'Tambah Barang',
					'kategori' => $this->m_kategori->get_all_data(),
					'error_upload' => $this->upload->display_errors(),
					'isi' => 'barang/v_add',
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
				$config['source_image'] = './assets/gambar/'.$upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				$data = array(
					'nama_barang'=>htmlspecialchars($this->input->post('nama_barang', true)),
					'id_kategori'=>htmlspecialchars($this->input->post('id_kategori',true)),
					'harga'=>htmlspecialchars($this->input->post('harga', true)),
					'berat'=>htmlspecialchars($this->input->post('berat', true)),
					'deskripsi'=>htmlspecialchars($this->input->post('deskripsi', true)),
					'gambar' => $upload_data['uploads']['file_name'],
				);

				$this->m_barang->add($data);
				// set session penjualan
				$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
				$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
				$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
				$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
				$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
				$this->session->set_flashdata('pesan', 'Barang Berhasil Ditambahkan!');
				redirect('barang');

			}
		}
		$data['title'] = 'Tambah Barang';
		$data['isi'] = 'barang/v_add';
		$data['kategori'] = $this->m_kategori->get_all_data();

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);		
	}

	public function edit($id_barang=null){

		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('harga', 'Harga', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('berat', 'Berat', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required' => '%s Harus Diisi!'));
		
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/gambar/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '4000'; //dlm kilobyte

			if ($_FILES['gambar']['error'] == 4 ) {
				goto b;
			};
			// ambil nama ketagori
			$kategori = $this->db->get_where('tbl_kategori', ['id_kategori' => htmlspecialchars($this->input->post('id_kategori', true))])->row();
			$ekstensi = explode('.', $_FILES['gambar']['name']);
			$newName = time() .'_'.$this->session->userdata('username');
			$config['file_name'] = $kategori->nama_kategori.'_'.$newName.'_'.current($ekstensi).'.'.end($ekstensi);

			b:
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar')) {

				$data = array(
					'title' =>'Edit Barang',
					'kategori' => $this->m_kategori->get_all_data(),
					'error_upload' => $this->upload->display_errors(),
					'barang' => $this->m_barang->get_data($id_barang),
					'isi' => 'barang/v_edit',
				);

				if ($this->upload->data('file_name') == "") {
					goto a;
				}

				// set session penjualan
				$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
				$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
				$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
				$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
				$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());				
				$this->load->view('layout/v_wrapper_backend', $data, FALSE);

			} elseif($this->upload->data('is_image') == 1){
				// hapus gambar
				$barang = $this->m_barang->get_data($id_barang);
				if ($barang->gambar != "") {
					unlink('./assets/gambar/'.$barang->gambar);
				}
				// end hapus gambar
				// ketika ganti gambar
				$upload_data = ['uploads' => $this->upload->data()];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/gambar/'.$upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				$data = array(
					'id_barang' => $id_barang,
					'nama_barang'=>htmlspecialchars($this->input->post('nama_barang', true)),
					'id_kategori'=>htmlspecialchars($this->input->post('id_kategori',true)),
					'harga'=>htmlspecialchars($this->input->post('harga', true)),
					'berat'=>htmlspecialchars($this->input->post('berat', true)),
					'deskripsi'=>htmlspecialchars($this->input->post('deskripsi', true)),
					'gambar' => $upload_data['uploads']['file_name'],
				);

				$this->m_barang->edit($data);
				// set session penjualan
				$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
				$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
				$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
				$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
				$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
				$this->session->set_flashdata('pesan', 'Barang Berhasil Diupdate!');
				redirect('barang');

			} else{
				a:
				// ketika tanpa ganti gambar
				$data = array(
					'id_barang' => $id_barang,
					'nama_barang'=>htmlspecialchars($this->input->post('nama_barang', true)),
					'id_kategori'=>htmlspecialchars($this->input->post('id_kategori',true)),
					'harga'=>htmlspecialchars($this->input->post('harga', true)),
					'berat'=>htmlspecialchars($this->input->post('berat', true)),
					'deskripsi'=>htmlspecialchars($this->input->post('deskripsi', true)),
				);

				$this->m_barang->edit($data);
				// set session penjualan
				$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
				$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
				$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
				$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
				$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
				$this->session->set_flashdata('pesan', 'Barang Berhasil Diupdate!');
				redirect('barang');
			}
			
		}
		$data = array(
			'title' =>'Edit Barang',
			'kategori' => $this->m_kategori->get_all_data(),
			'barang' => $this->m_barang->get_data($id_barang),
			'isi' => 'barang/v_edit',
		);

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);

	}
	

	public function delete($id_barang){
		// hapus gambar
		$barang = $this->m_barang->get_data($id_barang);
		$gambarbarang = $this->m_gambarbarang->get_gambar($id_barang);
		for ($i=0; $i < count($gambarbarang) ; $i++) { 
			if ($gambarbarang[$i]->gambar != "") {
				unlink('./assets/gambarbarang/'.$gambarbarang[$i]->gambar);
			}
		}
		if ($barang->gambar != "") {
			unlink('./assets/gambar/'.$barang->gambar);
		}
		
		// end hapus gambar

		$data = ['id_barang' => $id_barang ];
		$this->m_barang->delete($data);
		$this->m_gambarbarang->delete_gambarbarang($data);

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->session->set_flashdata('pesan', 'Barang Berhasil Dihapus!');
		redirect('barang');		
	}
}