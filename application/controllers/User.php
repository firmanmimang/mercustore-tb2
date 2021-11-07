<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
	}

	public function index(){
		$this->form_validation->set_rules('username', 'Username', 'is_unique[tbl_user.username]', array('is_unique' => '%s Sudah Terdaftar'));

		$data['title'] = 'User';
		$data['isi'] = 'v_user';
		$data['user'] = $this->m_user->get_all_data();

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function add_user(){

		$this->form_validation->set_rules('nama_user', 'Nama User', 'required|trim', array('required' => '%s Harus Diisi'));
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tbl_user.username]', array(
			'required' => '%s Harus Diisi',
			'is_unique' => '%s Sudah Terdaftar'
		));
		$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|is_unique[tbl_user.email_user]', array(
			'required' => '%s Harus Diisi!',
			'valid_email' => '%s Belum Valid',
			'is_unique' => '%s Sudah Terdaftar'
		));
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[re-password]', array(
			'required' => '%s Harus Diisi',
			'matches' => '%s Tidak Sama Dengan Re-Password',
			'min_length' => '%s Minimal 6 Karakter'
		));
		$this->form_validation->set_rules('re-password', 'Re-Password', 'required|matches[password]', array(
			'required' => '%s Harus Diisi!',
			'matches' => '%s Tidak Sama Dengan Password'
		));

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Add User';
			$data['isi'] = 'v_user_add';

			// set session penjualan
			$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
			$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
			$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
			$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
			$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
		} else{
			$data = [
				'nama_user' => htmlspecialchars($this->input->post('nama_user', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'email_user' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'level_user' => htmlspecialchars($this->input->post('level_user', true)),
				'is_active' => 1,
				'date_created' => time()
			];

			$this->m_user->add($data);
			// set session penjualan
			$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
			$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
			$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
			$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
			$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
			$this->session->set_flashdata('pesan', 'User Berhasil Ditambahkan!');
			redirect('user');
		}

	}

	public function edit_user($id_user){

		$username= $this->m_user->get_all_data_by_id($id_user);

		$data = [
			'id_user' => $id_user,
			'email_user' => htmlspecialchars($this->input->post('email', true)),
			'level_user' => htmlspecialchars($this->input->post('level_user', true)),
		];

		if ($username->email_user == $data['email_user']) {
			$data = [
				'id_user' => $id_user,
				'email_user' => htmlspecialchars($this->input->post('email', true)),
				'level_user' => htmlspecialchars($this->input->post('level_user', true)),
			];

			$this->m_user->edit($data);
			if ($this->session->userdata('username') == $username->username) {
				$this->session->set_userdata('level_user', $data['level_user']);
			}

		} else{
			$data = [
				'id_user' => $id_user,
				'email_user' => htmlspecialchars($this->input->post('email', true)),
				'level_user' => htmlspecialchars($this->input->post('level_user', true)),
				'is_active' => 1 // harusny 0 trus kirim aktivasi email
			];

			$this->m_user->edit($data);
			if ($this->session->userdata('username') == $username->username) {
				$this->session->set_userdata('level_user', $data['level_user']);
			}
		}

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->session->set_flashdata('pesan', 'User Berhasil Diubah!');
		redirect('user');
	}

	public function delete($id_user=null){
		// hapus gambar
		$foto = $this->m_user->get_all_data_by_id($id_user);
		if ($foto->foto_user != "") {
			unlink('./assets/foto_admin/'.$foto->foto_user);
		}
		// end hapus gambar
		$data = ['id_user' => $id_user ];

		$username= $this->m_user->get_all_data_by_id($id_user);
		$this->m_user->delete($data);

		if ($this->session->userdata('username') == $username->username) {
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('nama_user');
			$this->session->unset_userdata('level_user');
			$this->session->unset_userdata('pesanan_semua');
			$this->session->unset_userdata('pesanan_masuk');
			$this->session->unset_userdata('pesanan_proses');
			$this->session->unset_userdata('pesanan_kirim');
			$this->session->unset_userdata('pesanan_selesai');
		}

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->session->set_flashdata('pesan', 'User Berhasil Dihapus!');
		redirect('user');
	}

}