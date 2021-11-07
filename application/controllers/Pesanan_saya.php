<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_transaksi');
	}

	public function index(){
		// id pelanggan
		$pelanggan= $this->db->get_where('tbl_pelanggan', ['username_pelanggan' => $this->session->userdata('username_pelanggan')])->row();
		// saat data pelanggan tidak
		if (!$pelanggan) {
			$this->session->unset_userdata('id_pelanggan');
			$this->session->unset_userdata('nama_pelanggan');
			$this->session->unset_userdata('username_pelanggan');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('foto');
			redirect('');
		}

		$this->pelanggan_login->proteksi_halaman();
		$data['title'] = 'Pesanan Saya';
		$data['belum_bayar'] = $this->m_transaksi->belum_bayar($pelanggan->id_pelanggan);
		$data['diproses'] = $this->m_transaksi->diproses($pelanggan->id_pelanggan);
		$data['dikirim'] = $this->m_transaksi->dikirim($pelanggan->id_pelanggan);
		$data['selesai'] = $this->m_transaksi->selesai($pelanggan->id_pelanggan);
		$data['isi'] = 'v_pesanan_saya';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function bayar($no_order){
		// id pelanggan
		$pelanggan= $this->db->get_where('tbl_pelanggan', ['username_pelanggan' => $this->session->userdata('username_pelanggan')])->row();
		// saat data pelanggan tidak
		if (!$pelanggan) {
			$this->session->unset_userdata('id_pelanggan');
			$this->session->unset_userdata('nama_pelanggan');
			$this->session->unset_userdata('username_pelanggan');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('foto');
			redirect('');
		}

		$data['pesanan'] = $this->m_transaksi->detail_pesanan($no_order);

		$this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required|trim', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|trim', array('required' => '%s Harus Diisi!'));
		
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/bukti_bayar/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '4000'; //dlm kilobyte

			if ($_FILES['bukti_bayar']['error'] == 4 ) {
				goto b;
			};
			$ekstensi = explode('.', $_FILES['bukti_bayar']['name']);
			$newName = time() .'_'. $data['pesanan']->username_pelanggan;
			$config['file_name'] = $newName.'_'. $data['pesanan']->no_order .'.'.end($ekstensi);
			
			b:
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bukti_bayar')) {

				$data = array(
					'title' =>'Pembayaran',
					'rekening' => $this->m_transaksi->rekening(),
					'error_upload' => $this->upload->display_errors(),
					// 'barang' => $this->m_barang->get_data($id_barang),
					'pesanan' => $this->m_transaksi->detail_pesanan($no_order),
					'isi' => 'v_bayar',
				);
				
				$this->load->view('layout/v_wrapper_frontend', $data, FALSE);

			} else{
				$upload_data = ['uploads' => $this->upload->data()];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/bukti_bayar/'.$upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				$data = array(
					'no_order' => $no_order,
					'atas_nama'=> htmlspecialchars($this->input->post('atas_nama', TRUE)),
					'nama_bank'=>htmlspecialchars($this->input->post('nama_bank', TRUE)),
					'no_rek'=> htmlspecialchars($this->input->post('no_rek', TRUE)),
					'status_bayar'=> '1',
					'bukti_bayar' => $upload_data['uploads']['file_name'],
				);

				$this->m_transaksi->upload_bukti_bayar($data);
				$this->session->set_flashdata('pesan', 'Bukti Pembayaran Berhasil Diupload!');
				redirect('pesanan_saya');

			}

		}

		$data['title'] = 'Pembayaran';
		$data['rekening'] = $this->m_transaksi->rekening();
		$data['isi'] = 'v_bayar';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function edit_bayar ($no_order){
		// id pelanggan
		$pelanggan= $this->db->get_where('tbl_pelanggan', ['username_pelanggan' => $this->session->userdata('username_pelanggan')])->row();
		// saat data pelanggan tidak
		if (!$pelanggan) {
			$this->session->unset_userdata('id_pelanggan');
			$this->session->unset_userdata('nama_pelanggan');
			$this->session->unset_userdata('username_pelanggan');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('foto');
			redirect('');
		}

		$data['pesanan'] = $this->m_transaksi->detail_pesanan($no_order);

		$this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required|trim', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|trim', array('required' => '%s Harus Diisi!'));
		
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/bukti_bayar/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '4000'; //dlm kilobyte

			if ($_FILES['bukti_bayar']['error'] == 4 ) {
				goto b;
			};
			$ekstensi = explode('.', $_FILES['bukti_bayar']['name']);
			$newName = time() .'_'. $data['pesanan']->username_pelanggan;
			$config['file_name'] = $newName.'_'. $data['pesanan']->no_order .'.'.end($ekstensi);
			
			b:
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bukti_bayar')) {

				$data = array(
					'title' =>'Pembayaran',
					'rekening' => $this->m_transaksi->rekening(),
					'error_upload' => $this->upload->display_errors(),
					// 'barang' => $this->m_barang->get_data($id_barang),
					'pesanan' => $this->m_transaksi->detail_pesanan($no_order),
					'isi' => 'v_bayar_edit',
				);

				// if ($this->upload->data('file_name') == "") {
				// 	goto a;
				// }
				
				$this->load->view('layout/v_wrapper_frontend', $data, FALSE);

			} elseif($this->upload->data('is_image') == 1){
				// hapus foto
				$foto = $this->m_transaksi->detail_pesanan($no_order);
				if ($foto->bukti_bayar != "") {
					unlink('./assets/bukti_bayar/'.$foto->bukti_bayar);
				}
				//end
				$upload_data = ['uploads' => $this->upload->data()];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/bukti_bayar/'.$upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				$data = array(
					'no_order' => $no_order,
					'atas_nama'=> htmlspecialchars($this->input->post('atas_nama', TRUE)),
					'nama_bank'=>htmlspecialchars($this->input->post('nama_bank', TRUE)),
					'no_rek'=> htmlspecialchars($this->input->post('no_rek', TRUE)),
					'status_bayar'=> '1',
					'bukti_bayar' => $upload_data['uploads']['file_name'],
				);

				$this->m_transaksi->upload_bukti_bayar($data);
				$this->session->set_flashdata('pesan', 'Bukti Pembayaran Berhasil Diupload!');
				redirect('pesanan_saya');

			} else{
				a:
				// ketika tanpa ganti gambar
				$data = array(
					'no_order' => $no_order,
					'atas_nama'=> htmlspecialchars($this->input->post('atas_nama', TRUE)),
					'nama_bank'=>htmlspecialchars($this->input->post('nama_bank', TRUE)),
					'no_rek'=> htmlspecialchars($this->input->post('no_rek', TRUE)),
					'status_bayar'=> '1',
				);

				$this->m_transaksi->upload_bukti_bayar($data);
				$this->session->set_flashdata('pesan', 'Bukti Pembayaran Berhasil Diupload!');
				redirect('pesanan_saya');
			}

		}

		$data['title'] = 'Pembayaran';
		$data['rekening'] = $this->m_transaksi->rekening();
		$data['isi'] = 'v_bayar_edit';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function invoice($no_order){
		// id pelanggan
		$pelanggan= $this->db->get_where('tbl_pelanggan', ['username_pelanggan' => $this->session->userdata('username_pelanggan')])->row();
		// saat data pelanggan tidak
		if (!$pelanggan) {
			$this->session->unset_userdata('id_pelanggan');
			$this->session->unset_userdata('nama_pelanggan');
			$this->session->unset_userdata('username_pelanggan');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('foto');
			redirect('');
		}

		$this->load->model('m_pesanan_saya');

		$data['title'] = 'Invoice';
		$data['invoice'] = $this->m_pesanan_saya->invoice($no_order);
		$data['isi'] = 'v_invoice';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function diterima($no_order){
		// id pelanggan
		$pelanggan= $this->db->get_where('tbl_pelanggan', ['username_pelanggan' => $this->session->userdata('username_pelanggan')])->row();
		// saat data pelanggan tidak
		if (!$pelanggan) {
			$this->session->unset_userdata('id_pelanggan');
			$this->session->unset_userdata('nama_pelanggan');
			$this->session->unset_userdata('username_pelanggan');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('foto');
			redirect('');
		}
		
		$data = [
			'no_order' => $no_order,
			'status_order' => '3',
			'tgl_terima' => time()
		];

		$this->m_transaksi->update_order($data);
		$this->session->set_flashdata('pesan', 'Pesanan Berhasil Diterima !');
		redirect('pesanan_saya');
	}
}