<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_pelanggan');
		$this->load->model('m_auth');
	}

	public function register(){

		// proteksi halaman
		$user = $this->session->userdata('username_pelanggan');
		if ($user != "") {
			redirect('');
		}

		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|trim', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tbl_pelanggan.username_pelanggan]', array(
			'required' => '%s Harus Diisi!',
			'is_unique' => '%s Sudah Terdaftar'
		));
		$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|is_unique[tbl_pelanggan.email]', array(
			'required' => '%s Harus Diisi!',
			'valid_email' => '%s Belum Valid',
			'is_unique' => '%s Sudah Terdaftar'
		));
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[ulangi_password]', array(
			'required' => '%s Harus Diisi!',
			'min_length' => '%s Harus Minimal 6 Karakter',
			'matches' => '%s Tidak Sama Dengan Re-Password'
		));
		$this->form_validation->set_rules('ulangi_password', 'Re-Password', 'required|matches[password]', array(
			'required' => '%s Harus Diisi!',
			'matches' => '%s Tidak Sama Dengan Password'
		));
		
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Register Pelanggan';
			$data['isi'] = 'v_register';

			$this->load->view('layout/v_wrapper_frontend', $data, FALSE);

		} else{
			$data = [
				'nama_pelanggan' => htmlspecialchars($this->input->post('nama_pelanggan', TRUE)),
				'username_pelanggan' => htmlspecialchars($this->input->post('username', TRUE)),
				'email' => htmlspecialchars($this->input->post('email')),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'is_active' => 1,
				'date_created' => time()
			];

			$this->m_pelanggan->register($data);
			$this->session->set_flashdata('pesan', 'Selamat, Register Berhasil, Silahkan Login !');
			redirect('pelanggan/login');		
		}
	}

	public function login(){

		// proteksi halaman
		$user = $this->session->userdata('username_pelanggan');
		if ($user != "") {
			redirect('');
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim', array(
			'required' => '%s Harus Diisi!'
		));
		$this->form_validation->set_rules('password', 'Password', 'required|trim', array(
			'required' => '%s Harus Diisi!'
		));

		if ($this->form_validation->run() == TRUE) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->pelanggan_login->login($username, $password);
		}

		$data['title'] = 'Login Pelanggan';
		$data['isi'] = 'v_login_pelanggan';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function logout(){
		$this->cart->destroy();
		$this->pelanggan_login->logout();
	}

	public function akun($username_pelanggan){
		// proteksi halaman
		$this->pelanggan_login->proteksi_halaman();

		$data['title'] = 'Akun Saya';
		$data['pelanggan'] = $this->m_pelanggan->get_pelanggan($username_pelanggan);
		$data['isi'] = 'v_akun_saya';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function editAkun($username_pelanggan){

		$this->pelanggan_login->proteksi_halaman();

		$user = $this->db->get_where('tbl_pelanggan', ['username_pelanggan' => $username_pelanggan])->row();
		if ($user) {
			$usernameBaru = htmlspecialchars($this->input->post('username_pelanggan', true));
			if ($user->username_pelanggan == $usernameBaru) {
				goto cekUsername;
			}
			$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required', array('required' => '%s Harus Diisi!'));
			$this->form_validation->set_rules('username_pelanggan', 'Username', 'required|is_unique[tbl_pelanggan.username_pelanggan]', array(
				'required' => '%s Harus Diisi!',
				'is_unique' => '%s Sudah Terdaftar'
			));

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'title' =>'Edit Akun',
					'pelanggan' => $this->m_pelanggan->get_pelanggan($username_pelanggan),
					'isi' => 'v_akun_edit',
				);

				$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
			}
		}

		cekUsername:
		$this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required', array('required' => '%s Harus Diisi!'));
	
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/foto/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '4000'; //dlm kilobyte

			if ($_FILES['foto']['error'] == 4 ) {
				goto b;
			};
			$ekstensi = explode('.', $_FILES['foto']['name']);
			$newName = strtotime('+5 hours') .'_'. $username_pelanggan;
			$config['file_name'] = $newName.'_profile.'.end($ekstensi);
			
			b:
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('foto')) {
				$data = array(
					'title' =>'Edit Akun',
					'error_upload' => $this->upload->display_errors(),
					'pelanggan' => $this->m_pelanggan->get_pelanggan($username_pelanggan),
					'isi' => 'v_akun_edit',
				);

				if ($this->upload->data('file_name') == "") {
					goto a;
				}
				
				$this->load->view('layout/v_wrapper_frontend', $data, FALSE);

			} elseif($this->upload->data('is_image') == 1){
				// hapus foto
				$foto = $this->m_pelanggan->get_pelanggan($username_pelanggan);
				if (!empty($foto->foto)) {
					unlink('./assets/foto/'.$foto->foto);
				}
				// end hapus gambar
				// ketika ganti gambar
				$upload_data = ['uploads' => $this->upload->data()];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/foto/'.$upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				$data = array(
					'id_pelanggan' => $user->id_pelanggan,
					'nama_pelanggan'=> htmlspecialchars($this->input->post('nama_pelanggan', TRUE)),
					'username_pelanggan'=> htmlspecialchars($this->input->post('username_pelanggan', TRUE)),
					// 'email'=> htmlspecialchars($this->input->post('email', TRUE)),
					// 'password'=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'foto' => $upload_data['uploads']['file_name'],
				);

				$this->m_pelanggan->edit_akun($data);
				// set session user
				// $this->session->set_userdata('nama_pelanggan', $data['nama_pelanggan']);
				$this->session->set_userdata('username_pelanggan', $data['username_pelanggan']);
				$this->session->set_userdata('email', $data['email']);
				$this->session->set_userdata('foto', $data['foto']);
				//set notif pesan
				$this->session->set_flashdata('pesan', 'Akun Anda Berhasil Diedit!');
				redirect('pelanggan/akun/'.$data['username_pelanggan']);
			} else{
				a:
				// ketika tanpa ganti gambar
				$data = array(
					'id_pelanggan' => $user->id_pelanggan,
					'nama_pelanggan'=> htmlspecialchars($this->input->post('nama_pelanggan', TRUE)),
					'username_pelanggan'=> htmlspecialchars($this->input->post('username_pelanggan', TRUE)),
					// 'email'=> htmlspecialchars($this->input->post('email', TRUE)),
					// 'password'=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				);

				$this->m_pelanggan->edit_akun($data);
				// set session user
				// $this->session->set_userdata('nama_pelanggan', $data['nama_pelanggan']);
				$this->session->set_userdata('username_pelanggan', $data['username_pelanggan']);
				$this->session->set_userdata('email', $data['email']);
				//set notif pesan
				$this->session->set_flashdata('pesan', 'Akun Anda Berhasil Diedit!');
				redirect('pelanggan/akun/'.$data['username_pelanggan']);
				}
			
		}

		$data['title'] = 'Edit Akun';
		$data['pelanggan'] = $this->m_pelanggan->get_pelanggan($username_pelanggan);
		$data['isi'] = 'v_akun_edit';

		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function editPassword($username_pelanggan){

		$this->pelanggan_login->proteksi_halaman();

		$pelanggan = $this->m_pelanggan->get_pelanggan($username_pelanggan);

		$this->form_validation->set_rules('password_sekarang', 'Password Sekarang', 'required|trim', array(
			'required' => '%s Harus Diisi!',
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
			$data['title'] = 'Ganti Password';
			$data['isi'] = 'v_akun_edit_password';

			$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
		} else{
			$password_sekarang = $this->input->post('password_sekarang');
			$password_baru = $this->input->post('password_baru');

			if (!password_verify($password_sekarang, $pelanggan->password)) {
				$this->session->set_flashdata('pesan_error', 'Password Sekarang Salah!');

				redirect('pelanggan/editpassword/'. $username_pelanggan);
			} else{
				if ($password_sekarang == $password_baru) {
					$this->session->set_flashdata('pesan_error', 'Password Baru Sama Dengan Password Sekarang!');

					redirect('pelanggan/editpassword/'. $username_pelanggan);
				} else{
					$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('username_pelanggan', $username_pelanggan);
					$this->db->update('tbl_pelanggan');

					$this->session->set_flashdata('pesan', 'Password Berhasil Diubah!');
					redirect('pelanggan/akun/' . $username_pelanggan);
				}
			}
		}
	}

	public function forgetPassword(){
		// proteksi halaman
		$user = $this->session->userdata('username_pelanggan');
		if ($user != "") {
			redirect('');
		}

		$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email', array(
			'required' => '%s Harus Diisi!',
			'valid_email' => '%s Belum Valid'
		));

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Forget Password';
			$data['isi'] = 'v_forget_password_frontend';

			$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
		} else{
			$email = htmlspecialchars($this->input->post('email',TRUE));
			$this->pelanggan_login->forget_password_lib($email);
		}
	}

	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('tbl_pelanggan', ['email'=>$email])->row();

		if ($user) {
			$user_token = $this->db->get_where('tbl_pelanggan_token', ['email' => $email])->row();

			if ($user_token) {

				if (time() - $user_token->date_created < (60*60)) {

					$this->session->set_userdata('resetEmail', $email);
					$this->changePassword();

				} else{
					
					$this->db->delete('tbl_pelanggan_token', ['email' => $email]);

					$this->session->set_flashdata('error', 'Link Untuk Reset Password Telah Kadaluarsa');
					redirect('pelanggan/login');
				}
				
			} else{
				$this->session->set_flashdata('error', 'Token Untuk Reset Password Salah');
				redirect('pelanggan/login');
			}
		} else{
			$this->session->set_flashdata('error', 'Email Untuk Reset Password Salah');
			redirect('pelanggan/login');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('resetEmail')) {
			redirect('pelanggan/login');
		}

		$email = $this->session->userdata('resetEmail');
		$passwordLama = $this->db->get_where('tbl_pelanggan', ['email' => $email])->row();
		if (password_verify($this->input->post('password'), $passwordLama->password)) {
			$this->session->set_flashdata('error', 'Password Sama Dengan Yang Lama');
			redirect('pelanggan/changepassword');
		}

		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[ulangi_password]', array(
			'required' => '%s Harus Diisi!',
			'min_length' => '%s Harus Minimal 6 Karakter',
			'matches' => '%s Tidak Sama Dengan Re-Password'
		));
		$this->form_validation->set_rules('ulangi_password', 'Re-Password', 'required|matches[password]', array(
			'required' => '%s Harus Diisi!',
			'matches' => '%s Tidak Sama Dengan Password'
		));


		if ($this->form_validation->run() == false) {
			$data['title'] = 'Reset Password';
			$data['isi'] = 'v_reset_password_frontend';

			$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
		} else{

			$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('tbl_pelanggan');
			$this->db->delete('tbl_pelanggan_token', ['email' => $email]);

			$this->session->unset_userdata('resetEmail');

			$this->session->set_flashdata('pesan', 'Reset Password Berhasil ! Silahkan Login');
			redirect('pelanggan/login');
		}
	}

}