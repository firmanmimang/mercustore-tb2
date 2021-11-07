<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login_user(){

		if($this->session->userdata('username')){
			redirect('admin');
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
			$this->user_login->login($username, $password);
		} 

		$data['title'] = 'Login User';
		$this->load->view('v_login_user', $data, FALSE);

	}

	public function register_user(){

		$this->form_validation->set_rules('nama_user', 'Nama', 'required|trim', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tbl_user.username]', array(
			'required' => '%s Harus Diisi!',
			'is_unique' => '%s Sudah Terdaftar'
		));
		$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|is_unique[tbl_user.email_user]', array(
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
			$data['title'] = 'Register Admin';

			$this->load->view('v_register_user', $data, FALSE);

		} else{
			$data = [
				'nama_user' => htmlspecialchars($this->input->post('nama_user', TRUE)),
				'email_user' => htmlspecialchars($this->input->post('email')),
				'username' => htmlspecialchars($this->input->post('username', TRUE)),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'level_user' => 2,
				'foto_user' => '',
				'is_active' => 1,
				'date_created' => time()
			];

			$this->load->model('m_user');
			$this->m_user->add($data);
			$this->session->set_flashdata('pesan', 'Selamat, Register Berhasil, Silahkan Login !');
			redirect('auth/login_user');		
		}
	}

	public function logout_user()
	{
		$this->user_login->logout();
	}

	public function forget_password()
	{
		if($this->session->userdata('username')){
			redirect('admin');
		}

		$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email', array(
			'required' => '%s Harus Diisi!',
			'valid_email' => '%s Belum Valid'
		));

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Forget Password';

			$this->load->view('v_forget_password_backend', $data, FALSE);
		} else{
			$email = htmlspecialchars($this->input->post('email',TRUE));
			$this->user_login->forget_password_lib($email);
		}
	}

	public function reset_password()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('tbl_user', ['email_user'=>$email])->row();

		if ($user) {
			$user_token = $this->db->get_where('tbl_user_token', ['email' => $email])->row();

			if ($user_token) {

				if (time() - $user_token->date_created < (60*60)) {

					$this->session->set_userdata('reset_email', $email);
					$this->change_password();

				} else{
					
					$this->db->delete('tbl_user_token', ['email' => $email]);

					$this->session->set_flashdata('error', 'Link Untuk Reset Password Telah Kadaluarsa');
					redirect('auth/login_user');
				}
				
			} else{
				$this->session->set_flashdata('error', 'Token Untuk Reset Password Salah');
				redirect('auth/login_user');
			}
		} else{
			$this->session->set_flashdata('error', 'Email Untuk Reset Password Salah');
			redirect('auth/login_user');
		}
	}

	public function change_password()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth/login_user');
		}

		$email = $this->session->userdata('reset_email');
		$passwordLama = $this->db->get_where('tbl_user', ['email_user' => $email])->row();
		if (password_verify($this->input->post('password'), $passwordLama->password)) {
			$this->session->set_flashdata('error', 'Password Sama Dengan Yang Lama');
			redirect('auth/change_password');
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

			$this->load->view('v_reset_password_backend', $data, FALSE);
		} else{

			$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

			$this->db->set('password', $password);
			$this->db->where('email_user', $email);
			$this->db->update('tbl_user');
			$this->db->delete('tbl_user_token', ['email' => $email]);

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('pesan', 'Reset Password Berhasil ! Silahkan Login');
			redirect('auth/login_user');
		}
	}

}