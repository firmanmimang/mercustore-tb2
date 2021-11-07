<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaksi');
	}

	public function index()
	{
		if (empty($this->cart->contents())) {
			redirect('');
		}
		$data['title'] = 'Keranjang Belanja';
		$data['isi'] = 'v_belanja';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function add()
	{
		$redirect_page = $this->input->post('redirect_page');
		$data= array(
			'id'=> $this->input->post('id'),
			'qty'=> $this->input->post('qty'),
			'price'=> $this->input->post('price'),
			'name'=> $this->input->post('name')
		);


		$this->cart->insert($data);
		redirect($redirect_page, 'refresh');
	}

	public function delete($rowid)
	{
		$this->cart->remove($rowid);
		redirect('belanja');
	}

	public function update()
	{
		$i=1;
		foreach ($this->cart->contents() as $items) {
			$data= array(
				'rowid'=> $items['rowid'],
				'qty'=> $this->input->post($i.'[qty]')	
			);

			$this->cart->update($data);
			$i++;
		}
		$this->session->set_flashdata('pesan', 'Keranjang Berhasil Diupdate !');
		redirect('belanja');
	}

	public function clear()
	{
		$this->cart->destroy();
		redirect('');
	}

	public function checkout()
	{
		// proteksi halaman
		$this->pelanggan_login->proteksi_halaman();
		if (empty($this->cart->contents())) {
			redirect('');
		}
		// form validasi
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('kota', 'Kota', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('ekspedisi', 'Ekspedisi', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('paket', 'Paket', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('kota', 'Kota', 'required', array('required' => '%s Harus Diisi!'));
		
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Check Out Belanja';
			$data['isi'] = 'v_checkout';

			$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
		} else{
			$pelanggan= $this->db->get_where('tbl_pelanggan', ['username_pelanggan' => $this->session->userdata('username_pelanggan')])->row();
			$kota = explode('/', $this->input->post('kota'));
			$lokasi = reset($kota);
			// simpan ke tbl_transaksi
			$data= [
				'no_order' => $this->input->post('no_order'),
				'id_pelanggan'=> htmlspecialchars($pelanggan->id_pelanggan),
				'tgl_order' => time(),
				'nama_penerima' => htmlspecialchars($this->input->post('nama_penerima', true)),
				'tlp_penerima' => htmlspecialchars($this->input->post('tlp_penerima', true)),
				'provinsi' => htmlspecialchars($this->input->post('provinsi', true)),
				'kota' => $lokasi,
				'alamat' => htmlspecialchars($this->input->post('alamat', true)),
				'kode_pos' => htmlspecialchars($this->input->post('kode_pos', true)),
				'ekspedisi' => htmlspecialchars($this->input->post('ekspedisi', true)),
				'paket' => htmlspecialchars($this->input->post('paket', true)),
				'estimasi' => htmlspecialchars($this->input->post('estimasi', true)),
				'ongkir' => htmlspecialchars($this->input->post('ongkir', true)),
				'berat' => htmlspecialchars($this->input->post('berat', true)),
				'sub_total' => htmlspecialchars($this->input->post('sub_total', true)),
				'grand_total' => htmlspecialchars($this->input->post('grand_total', true)),
				'status_bayar' => '0',
				'status_order' => '0',
			];
			
			$this->m_transaksi->simpan_transaksi($data);

			// simpan ke tbl_rinci_transaksi
			$i= 1;
			foreach ($this->cart->contents() as $item) {
				$data_rinci= [
					'no_order' => $this->input->post('no_order'),
					'id_barang' => $item['id'],
					'qty' => $this->input->post('qty'.$i++),
				];

				$this->m_transaksi->simpan_rinci_transaksi($data_rinci);
			}

			$this->cart->destroy();
			$this->session->set_flashdata('pesan', 'Pesanan Berhasil Diproses !');
			redirect('pesanan_saya');

		}
		
	}


}