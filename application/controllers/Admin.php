<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_pelanggan');
	}

	public function index(){

		$data['title'] = 'Dashboard';
		$data['total_barang']= $this->m_admin->total_barang();
		$data['total_kategori']= $this->m_admin->total_kategori();
		$data['total_pesanan']= $this->m_admin->total_pesanan();
		$data['pelanggan'] = $this->m_pelanggan->get_pelanggan_all();
		$data['isi'] = 'v_admin';

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function setting(){

		$this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('kota', 'Kota', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('alamat_toko', 'Alamat Toko', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('no_telepon', 'No. Telepon', 'required', array('required' => '%s Harus Diisi!'));
		
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Setting';
			$data['setting'] = $this->m_admin->data_setting();
			$data['isi'] = 'v_setting';

			// set session penjualan
			$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
			$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
			$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
			$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
			$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
		} else{
			$kota = explode('/', $this->input->post('kota'));
			$id_kota = end($kota);
			$lokasi = reset($kota);
			if ($id_kota == $lokasi) {
				$data = [
					'id' => 1,
					'lokasi' => $lokasi,
					'nama_toko' => htmlspecialchars($this->input->post('nama_toko', true)),
					'alamat_toko' => htmlspecialchars($this->input->post('alamat_toko', true)),
					'no_telepon' => htmlspecialchars($this->input->post('no_telepon', true)),
				];
			} else {
				$data = [
					'id' => 1,
					'lokasi' => $lokasi,
					'id_kota' => $id_kota,
					'nama_toko' => htmlspecialchars($this->input->post('nama_toko', true)),
					'alamat_toko' => htmlspecialchars($this->input->post('alamat_toko', true)),
					'no_telepon' => htmlspecialchars($this->input->post('no_telepon', true)),
				];
			}

			$this->m_admin->edit($data);
			// set session penjualan
			$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
			$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
			$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
			$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
			$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
			$this->session->set_flashdata('pesan', 'Settingan Berhasil Diubah!');
			redirect('admin/setting');		
		}

	}

	public function pesananMasuk(){
		$data['title'] = 'Pesanan Masuk';
		$data['pesanan'] = $this->m_pesanan_masuk->pesanan();
		$data['isi'] = 'v_pesanan_masuk';

		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function tolak_bayar($no_order){
		// hapus foto
		$foto = $this->db->get_where('tbl_transaksi', ['no_order'=> $no_order])->row();
		if ($foto->bukti_bayar != "") {
			unlink('./assets/bukti_bayar/'.$foto->bukti_bayar);
		}

		$data = [
			'no_order' => $no_order,
			'bukti_bayar' => null,
			'status_bayar' => 2
		];

		$this->m_pesanan_masuk->update_order($data);
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->session->set_flashdata('pesan', 'Pembayaran Berhasil Ditolak!');
		redirect('admin/pesananmasuk');

	}

	public function pesananProses(){
		$data['title'] = 'Pesanan Proses';
		$data['pesanan_diproses'] = $this->m_pesanan_masuk->pesanan_diproses();
		$data['isi'] = 'v_pesanan_proses';

		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function pesananKirim(){
		$data['title'] = 'Pesanan Kirim';
		$data['pesanan_dikirim'] = $this->m_pesanan_masuk->pesanan_dikirim();
		$data['isi'] = 'v_pesanan_kirim';

		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function pesananSelesai(){
		$data['title'] = 'Pesanan Selesai';
		$data['pesanan_selesai'] = $this->m_pesanan_masuk->pesanan_selesai();
		$data['isi'] = 'v_pesanan_selesai';

		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function proses($no_order){
		$data = [
			'no_order' => $no_order,
			'status_order' => '1',

		];

		$this->m_pesanan_masuk->update_order($data);
		$this->session->set_flashdata('pesan', 'Pesanan Berhasil Diproses !');
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		redirect('admin/pesananmasuk');
	}

	public function batal_proses($no_order){
		$data = [
			'no_order' => $no_order,
			'status_order' => '0',

		];

		$this->m_pesanan_masuk->update_order($data);
		$this->session->set_flashdata('pesan', 'Pesanan Batal Diproses !');
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		redirect('admin/pesananproses');
	}

	public function kirim($no_order){
		$data = [
			'no_order' => $no_order,
			'no_resi' => $this->input->post('no_resi'),
			'tgl_kirim' => strtotime($this->input->post('tanggal').'-'.$this->input->post('bulan').'-'.$this->input->post('tahun').' '.$this->input->post('jam').':'.$this->input->post('menit').':'.$this->input->post('detik').' '.$this->input->post('ampm'))-mktime(7, 0, 0, 1, 1, 1970),
			'status_order' => '2',

		];
		// // 3-10-2005 07:00:00 pm
		// var_dump( $data['tgl_kirim']);
        // var_dump(mktime(12, 0, 0, 1, 1, 1970));
		// echo (date('d F Y h:i:sa', $data['tgl_kirim']) );
        // echo (date('h:i:s', 60*60*11));
		// die();

		$this->m_pesanan_masuk->update_order($data);
		$this->session->set_flashdata('pesan', 'Pesanan Berhasil Dikirim !');
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		redirect('admin/pesananproses');
	}

	public function pelanggan(){
		$data['title'] = 'Daftar Pelanggan';
		$data['pelanggan'] = $this->m_pelanggan->get_pelanggan_all();
		$data['isi'] = 'v_pelanggan_backend';

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function pelanggan_delete($id_pelanggan){
		// hapus gambar
		// $foto = $this->m_pelanggan->get_pelanggan_by_id($id_pelanggan);
		// if ($foto->foto != "") {
		// 	unlink('./assets/foto/'.$foto->foto);
		// }
		// end hapus gambar
		$data = ['id_pelanggan' => $id_pelanggan ];
		$no_order = $this->db->get_where('tbl_transaksi', ['id_pelanggan'=> $id_pelanggan])->result_array();

		// delete tbl rinci pelanggan
		$i=0;
		foreach ($no_order as $key => $value) {
			$this->db->where('no_order', $no_order[$i++]['no_order']);
			$this->db->delete('tbl_rinci_transaksi');
		}

		// delete table transaksi pelanggan
		$a=0;
		foreach ($no_order as $key => $value) {
			$this->db->where('no_order', $no_order[$a++]['no_order']);
			$this->db->delete('tbl_transaksi');
		}
		
		// delete table pelanggan
		$this->m_pelanggan->delete_pelanggan($data);
		
		
		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->session->set_flashdata('pesan', 'Pelanggan Berhasil Dihapus!');
		redirect('admin/pelanggan');		
	}

}