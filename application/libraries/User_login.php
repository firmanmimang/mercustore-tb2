<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_login
{
	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('M_auth');
		$this->ci->load->model('m_pesanan_masuk');
	}

	public function login($username, $password)
	{
		// cek user di table
		$cek = $this->ci->M_auth->login_user($username);
		$pesanan_semua = $this->ci->m_pesanan_masuk->total_pesanan_semua();
		$pesanan_masuk = $this->ci->m_pesanan_masuk->total_pesanan_masuk();
		$pesanan_proses = $this->ci->m_pesanan_masuk->total_pesanan_proses();
		$pesanan_kirim = $this->ci->m_pesanan_masuk->total_pesanan_kirim();
		$pesanan_selesai = $this->ci->m_pesanan_masuk->total_pesanan_selesai();
		if($cek){

			if (password_verify($password, $cek->password)) {

				// ambil data pada field tabel
				// $id_user = $cek->id_user;
				$nama_user= $cek->nama_user;
				$username = $cek->username;
				$level_user = $cek->level_user;
				$foto_user = $cek->foto_user;
				$pesanan_semua = $pesanan_semua;
				$pesanan_masuk = $pesanan_masuk;
				$pesanan_proses = $pesanan_proses;
				$pesanan_kirim = $pesanan_kirim;
				$pesanan_selesai = $pesanan_selesai;

				// buat session
				// $this->ci->session->set_userdata('id_user', $id_user);
				$this->ci->session->set_userdata('username', $username);
				$this->ci->session->set_userdata('nama_user', $nama_user);
				$this->ci->session->set_userdata('level_user', $level_user);
				$this->ci->session->set_userdata('foto_user', $foto_user);
				$this->ci->session->set_userdata('pesanan_semua', $pesanan_semua);
				$this->ci->session->set_userdata('pesanan_masuk', $pesanan_masuk);
				$this->ci->session->set_userdata('pesanan_proses', $pesanan_proses);
				$this->ci->session->set_userdata('pesanan_kirim', $pesanan_kirim);
				$this->ci->session->set_userdata('pesanan_selesai', $pesanan_selesai);
				redirect('admin');
			} else{
				// jika user tidak ada
				$this->ci->session->set_flashdata('error', 'Username / Password Salah');
				redirect('auth/login_user');
			}

		} else{
			// jika user tidak ada
			$this->ci->session->set_flashdata('error', 'Akun Tidak Terdaftar');
			redirect('auth/login_user');
		}
	}

	public function proteksi_halaman()
	{
		$cek = $this->ci->M_auth->login_user($this->ci->session->userdata('username'));	
			
		if (!$cek) {
			$this->ci->session->unset_userdata('username');
			$this->ci->session->unset_userdata('nama_user');
			$this->ci->session->unset_userdata('level_user');
			// $this->ci->session->set_flashdata('error', 'Anda Belum Login!');
			redirect('auth/login_user');
		} elseif ($cek->is_active != 1) {
			$this->ci->session->unset_userdata('username');
			$this->ci->session->unset_userdata('nama_user');
			$this->ci->session->unset_userdata('level_user');
			$this->ci->session->set_flashdata('error', 'Anda Belum Aktivasi Email');
			redirect('auth/login_user');
		}
	}

	public function logout()
	{
		$this->ci->session->unset_userdata('username');
		$this->ci->session->unset_userdata('nama_user');
		$this->ci->session->unset_userdata('level_user');
		$this->ci->session->unset_userdata('pesanan_semua');
		$this->ci->session->unset_userdata('pesanan_masuk');
		$this->ci->session->unset_userdata('pesanan_proses');
		$this->ci->session->unset_userdata('pesanan_kirim');
		$this->ci->session->unset_userdata('pesanan_selesai');
		$this->ci->session->set_flashdata('pesan', 'Anda Berhasil Logout!');
		redirect('auth/login_user');
	}

	public function forget_password_lib($email)
	{
		$user = $this->ci->db->get_where('tbl_user', ['email_user' => $email, 'is_active' => 1])->row();
		if ($user) {
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email'=> $email,
				'token'=> $token,
				'date_created'=> time()
			];

			$this->ci->db->insert('tbl_user_token', $user_token);

			$config = [
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com', //koneksi ke gmail
				'smtp_user' => '', // email
				'smtp_pass' => '', //password email
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

			$this->ci->email->from('', 'Mercu Store');
			$this->ci->email->to($email);
			
			$this->ci->email->subject('Reset Password');
			$this->ci->email->message('Click this link to reset your password : <a href="'. base_url() .'auth/reset_password?email='.$user_token['email'].'&token='.urlencode($user_token['token']).'">Reset Password</a>');

			if($this->ci->email->send()){
				$this->ci->session->set_flashdata('pesan', 'Silahkan Cek Email Untuk Reset Password');
				redirect('auth/login_user');
			} else{
				echo $this->ci->email->print_debugger();
				die;
			}

		} else{
			$this->ci->session->set_flashdata('error', 'Email Tidak Terdaftar');
			redirect('auth/forget_password');
		}
	}
}