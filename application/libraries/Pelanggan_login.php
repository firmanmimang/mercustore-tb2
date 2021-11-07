<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_login
{
	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('M_auth');
	}

	public function login($username, $password)
	{
		// cari user
		$cek = $this->ci->M_auth->login_pelanggan($username);

		if($cek){

			// cek password
			if (password_verify($password, $cek->password)) {
				// ambil data pada field tabel
				// $id_pelanggan= $cek->id_pelanggan;
				// $nama_pelanggan= $cek->nama_pelanggan;
				$username= $cek->username_pelanggan;
				$email = $cek->email;
				$foto = $cek->foto;

				// buat session
				// $this->ci->session->set_userdata('id_pelanggan', $id_pelanggan);
				// $this->ci->session->set_userdata('nama_pelanggan', $nama_pelanggan);
				$this->ci->session->set_userdata('username_pelanggan', $username);
				$this->ci->session->set_userdata('email', $email);
				$this->ci->session->set_userdata('foto', $foto);
				redirect('home');

			} else{
				// jika user tidak ada
				$this->ci->session->set_flashdata('error', 'Username / Password Salah');
				redirect('pelanggan/login');
			}

		} else{
			// jika user tidak ada
			$this->ci->session->set_flashdata('error', 'Akun Tidak Terdaftar');
			redirect('pelanggan/login');
		}
	}

	public function proteksi_halaman()
	{
		$cek = $this->ci->M_auth->login_pelanggan($this->ci->session->userdata('username_pelanggan'));
		if (!$cek) {
			$this->ci->session->set_flashdata('error', 'Anda Belum Login!');
			redirect('pelanggan/login');
		}
	}

	public function logout()
	{
		// $this->ci->session->unset_userdata('id_pelanggan');
		// $this->ci->session->unset_userdata('nama_pelanggan');
		$this->ci->session->unset_userdata('username_pelanggan');
		$this->ci->session->unset_userdata('email');
		$this->ci->session->unset_userdata('foto');
		$this->ci->session->set_flashdata('pesan', 'Anda Berhasil Logout!');
		redirect('pelanggan/login');
	}

		public function forget_password_lib($email)
	{
		$user = $this->ci->db->get_where('tbl_pelanggan', ['email' => $email, 'is_active' => 1])->row();
		if ($user) {
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email'=> $email,
				'token'=> $token,
				'date_created'=> time()
			];

			$this->ci->db->insert('tbl_pelanggan_token', $user_token);

			$config = [
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_user' => '',
				'smtp_pass' => '',
				'smtp_port' => 465,
				'smtp_cypto' => 'ssl',
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'charset' => 'utf-8',
				'newline' => "\r\n",
				'wordwrap' => true,
				'validate' => false,
			];

			// $this->load->library('email', $config);
			$this->ci->email->initialize($config);
			$this->ci->email->set_newline("\r\n");

			$this->ci->email->from('', 'Mercu Store');
			$this->ci->email->to($email);
			
			$this->ci->email->subject('Reset Password');
			$this->ci->email->message('Click this link to reset your password : <a href="'. base_url() .'pelanggan/resetpassword?email='.$user_token['email'].'&token='.urlencode($user_token['token']).'">Reset Password</a>');

			if($this->ci->email->send()){
				$this->ci->session->set_flashdata('pesan', 'Silahkan Cek Email Untuk Reset Password');
				redirect('pelanggan/login');
			} else{
				echo $this->ci->email->print_debugger();
				die;
			}

		} else{
			$this->ci->session->set_flashdata('error', 'Email Tidak Terdaftar');
			redirect('pelanggan/forgetpassword');
		}
	}
}