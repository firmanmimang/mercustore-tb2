<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profileadmin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_pelanggan');
	}

	public function index(){

		$username = $this->session->userdata('username');

		$data['title'] = 'Profile Admin';
		$data['profile_admin'] = $this->m_admin->get_profile_admin($username);
		$data['isi'] = 'v_profile_admin';

		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function editprofileadmin($username){

		$id=$this->db->get_where('tbl_user', ['username' => $username])->row();

		if ($id) {
			$usernameBaru = htmlspecialchars($this->input->post('username', true));
			if ($id->username == $usernameBaru) {
				goto cekUsername;
			}
			$this->form_validation->set_rules('nama_user', 'Nama User', 'required', array('required' => '%s Harus Diisi!'));
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_user.username]', array(
				'required' => '%s Harus Diisi!',
				'is_unique' => '%s Sudah Terdaftar'
			));

			if ($this->form_validation->run() == FALSE) {
				$data['title'] = 'Profile Admin';
				$data['profile_admin'] = $this->m_admin->get_profile_admin($username);
				$data['isi'] = 'v_profile_admin_edit';

				// set session penjualan
				$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
				$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
				$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
				$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
				$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
				$this->load->view('layout/v_wrapper_backend', $data, FALSE);
			}
		}

		cekUsername:
		$this->form_validation->set_rules('nama_user', 'Nama User', 'required', array('required' => '%s Harus Diisi!'));
		// $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s Harus Diisi!'));
	
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/foto_admin/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '4000'; //dlm kilobyte

			if ($_FILES['foto']['error'] == 4 ) {
				goto b;
			};
			$ekstensi = explode('.', $_FILES['foto']['name']);
			$newName = time() .'_'. $username;
			$config['file_name'] = $newName.'_profile.'.end($ekstensi);
			
			b:
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('foto')) {
				$data = array(
					'title' =>'Profile Admin',
					'profile_admin' => $this->m_admin->get_profile_admin($username),
					'error_upload' => $this->upload->display_errors(),
					'isi' => 'v_profile_admin_edit',
				);
						
				if ($this->upload->data('file_name') == "") {
					goto a;
				} 
				
				$this->load->view('layout/v_wrapper_backend', $data, FALSE);

			} elseif($this->upload->data('is_image') == 1){
				// hapus foto
				$foto = $this->m_admin->get_profile_admin($username);
				if ($foto->foto_user != "") {
					unlink('./assets/foto_admin/'.$foto->foto_user);
				}
				// end hapus gambar
				// ketika ganti gambar
				$upload_data = ['uploads' => $this->upload->data()];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/foto_user/'.$upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				$data = array(
					'id_user' => htmlspecialchars($id->id_user),
					'nama_user'=> htmlspecialchars($this->input->post('nama_user', true)),
					'username'=> htmlspecialchars($this->input->post('username', true)),
					// 'password'=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					// 'level_user'=> htmlspecialchars($this->input->post('level_user', true)),
					'foto_user' => $upload_data['uploads']['file_name'],
				);

				$this->m_admin->edit_user($data);
				// set session user
				$this->session->set_userdata('username', $data['username']);
				$this->session->set_userdata('nama_user', $data['nama_user']);
				$this->session->set_userdata('level_user', $data['level_user']);
				$this->session->set_userdata('foto_user', $data['foto_user']);
				// set session penjualan
				$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
				$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
				$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
				$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
				$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
				//set notif pesan
				$this->session->set_flashdata('pesan', 'User Berhasil Diedit!');
				redirect('profileadmin');
			} else{
				a:
				// ketika tanpa ganti gambar
				$data = array(
					'id_user' => htmlspecialchars($id->id_user),
					'nama_user'=> htmlspecialchars($this->input->post('nama_user', true)),
					'username'=> htmlspecialchars($this->input->post('username', true)),
					// 'password'=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					// 'level_user'=> htmlspecialchars($this->input->post('level_user', true)),
				);

				$this->m_admin->edit_user($data);
				// set session user
				$this->session->set_userdata('username', $data['username']);
				$this->session->set_userdata('nama_user', $data['nama_user']);
				$this->session->set_userdata('level_user', $data['level_user']);
				// set session penjualan
				$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
				$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
				$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
				$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
				$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
				//set notif pesan
				$this->session->set_flashdata('pesan', 'User Berhasil Diedit!');
				redirect('profileadmin');
			}
			
		}
		$data['title'] = 'Profile Admin';
		$data['profile_admin'] = $this->m_admin->get_profile_admin($username);
		$data['isi'] = 'v_profile_admin_edit';

		// set session penjualan
		$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
		$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
		$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
		$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
		$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	public function editPassword($username){

		$data['profile_admin'] = $this->m_admin->get_profile_admin($username);

		$this->form_validation->set_rules('password_sekarang', 'Password Sekarang', 'required|trim', array(
			'required' => '%s Harus Diisi!'
		));
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|min_length[6]|matches[ulangi_password]', array(
			'required' => '%s Harus Diisi!',
			'min_length' => '%s Minimal 6 Karakter',
			'matches' => '%s Tidak Sama Dengan Retype Password'
		));
		$this->form_validation->set_rules('ulangi_password', 'Retype Password', 'required|trim|matches[password_baru]', array(
			'required' => '%s Harus Diisi!',
			'matches' => '%s Tidak Sama Dengan Password Baru'
		));

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Profile Admin';
			$data['isi'] = 'v_profile_admin_edit_password';

			// set session penjualan
			$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
			$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
			$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
			$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
			$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
		} else{
			$password_sekarang = $this->input->post('password_sekarang');
			$password_baru = $this->input->post('password_baru');

			if (!password_verify($password_sekarang, $data['profile_admin']->password)) {
				$this->session->set_flashdata('pesan_error', 'Password Sekarang Salah!');

				$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
				$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
				$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
				$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
				$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
				redirect('profileadmin/editpassword/'. $username);
			} else{
				if ($password_sekarang == $password_baru) {
					$this->session->set_flashdata('pesan_error', 'Password Baru Sama Dengan Password Sekarang!');

					$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
					$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
					$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
					$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
					$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
					redirect('profileadmin/editpassword/'. $username);
				} else{
					$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('username', $username);
					$this->db->update('tbl_user');

					$this->session->set_userdata('pesanan_semua', $this->m_pesanan_masuk->total_pesanan_semua());
					$this->session->set_userdata('pesanan_masuk', $this->m_pesanan_masuk->total_pesanan_masuk());
					$this->session->set_userdata('pesanan_proses', $this->m_pesanan_masuk->total_pesanan_proses());
					$this->session->set_userdata('pesanan_kirim', $this->m_pesanan_masuk->total_pesanan_kirim());
					$this->session->set_userdata('pesanan_selesai', $this->m_pesanan_masuk->total_pesanan_selesai());
					$this->session->set_flashdata('pesan', 'Password Berhasil Diubah!');
					redirect('profileadmin');
				}
			}
		}
	}

}