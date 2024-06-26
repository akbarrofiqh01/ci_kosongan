<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Model
{

	private static $data = [
		'status' 	=> true,
		'message' 	=> null,
	];

	public function __construct()
	{
		parent::__construct();
		Self::$data['csrf_data'] 	= $this->security->get_csrf_hash();
	}

	function do_login()
	{
		// if ($this->input->post('g-recaptcha-response')) {
		// }

		$do_login 					= $this->ion_auth->login(post('authentication_id'), post('authentication_password'), true);
		if (!$do_login) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= $this->ion_auth->errors();
		}

		// validate captcha
		/*if( post('captcha') != $this->session->userdata('user_captcha') ){
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'Invalid security captcha !';
		}*/

		//validate form
		$this->form_validation->set_rules('authentication_id', 'USERNAME', 'required');
		$this->form_validation->set_rules('authentication_password', 'PASSWORD', 'required');
		// $this->form_validation->set_rules('g-recaptcha-response', 'security captcha', 'required');
		if ($this->form_validation->run() == false) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		// $recaptcha = $this->input->post('g-recaptcha-response');
		// $response = $this->recaptcha->verifyResponse($recaptcha);
		// if ($response['success'] == false) {
		// 	Self::$data['status'] 	= false;
		// 	Self::$data['message'] 	= "PLEASE VALIDATE THE CAPTCHA";
		// }

		if (!$this->input->post()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'Method not allowed';
		}

		// if ($this->input->post('authentication_id') != 'admin') {
		// 	if (option('login')['option_desc1'] == 'no') {
		// 		Self::$data['status'] 	= false;
		// 		Self::$data['message'] 	= 'System under Maintenance a few minutes. Please come back later !';
		// 	}
		// }


		if (Self::$data['status']) {

			// login success create session if admin
			$user_group 	= $this->ion_auth->get_users_groups()->row();
			if ($user_group->name == 'admin') {
				$array = array(
					'admin_userid' => userid()
				);
				$this->session->set_userdata($array);
			}


			Self::$data['message'] 	= 'You have successfully logged in. Click OK to continue';
			Self::$data['heading'] 	= 'Success';
			Self::$data['type'] 	= 'success';
		} else {

			Self::$data['heading'] 	= 'Error';
			Self::$data['type'] 	= 'error';
		}

		return Self::$data;
	}

	function do_forgotpass()
	{
		$this->db->where('username', post('username'));
		$this->db->where('email', post('email'));
		$cekdata = $this->db->get('tb_users');
		if ($cekdata->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "Username & Alamat Email Tidak Ditemukan";
		}

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Alamat Email', 'required');
		if ($this->form_validation->run() == false) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}
		if (!$this->input->post()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'Method not allowed';
		}

		// Self::$data['status'] 	= false;
		// Self::$data['message'] 	= 'Sistem Dalam Pemeliharaan. Silakan Kembali Lagi Nanti!';
		if (Self::$data['status']) {

			$random = hash('sha256', random_string('numeric', 20));

			$this->db->update(
				'tb_users',
				[
					'forgotten_password_code'	=> $random,
					'forgotten_password_time'	=> date('Y-m-d H:i:s', strtotime('+12 hour', now()))
				],
				[
					'username'					=> post('username'),
					'email'						=> post('email'),
				]
			);


			$email_data 			= [
				'username'			=> post('username'),
				'email'				=> post('email'),
				'link'				=> site_url('reset-password/' . $random),
			];

			$config['mailtype'] 	= 'html';
			$config['wordwrap'] 	= TRUE;
			$config['charset'] 		= 'iso-8859-1';
			$config['protocol'] 	= 'sendmail';
			$config['smtp_host'] 	= 'mail.minemabeauty.co.id';
			$config['smtp_user'] 	= 'no-replay@minemabeauty.co.id';
			$config['smtp_pass'] 	= 'Solusitech123';
			$config['smtp_port'] 	= 465;
			$config['smtp_timeout'] = 5;
			$config['newline'] 		= "\r\n";
			$this->load->library('email', $config);

			$email_message 	= $this->load->view('email-reset-password', $email_data, true);

			$this->email->from('no-replay@minemabeauty.co.id', 'PT. Minema Berkah Abadi');
			$this->email->to(str_replace(' ', '', $this->input->post('user_email')));
			$this->email->subject('Reset Password - PT. Minema Berkah Abadi');
			$this->email->message($email_message);
			$this->email->send();

			Self::$data['message'] 	= 'Tautan Reset Password Telah Dikirim! Tunggu Maksimal 1 Jam dan Periksa Kontak Masuk, Folder Spam Anda.';
			Self::$data['heading'] 	= 'Berhasil';
			Self::$data['type'] 	= 'success';
		} else {

			Self::$data['heading'] 	= 'Error';
			Self::$data['type'] 	= 'error';
		}

		return Self::$data;
	}

	function do_resetpass()
	{

		$this->db->where('forgotten_password_code', post('code'));
		$userdatas = $this->db->get('tb_users');
		if ($userdatas->num_rows() == 0) {
			Self::$data['status']         = false;
			Self::$data['message']        = 'Kode Reset Password tidak valid atau telah kedaluwarsa';
		}

		$this->form_validation->set_rules('code', 'Kode Reset Password', 'required');
		$this->form_validation->set_rules('new_password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
		if ($this->form_validation->run() == false) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}
		if (Self::$data['status']) {

			$userdata               = $userdatas->row();
			$update_users_data 		= array(
				'password' 					=> post('new_password'),
				'forgotten_password_code' 	=> null
			);

			$this->ion_auth->update($userdata->id,  $update_users_data);

			Self::$data['message']			= 'Password diperbarui, silakan masuk dengan Password Baru';
			Self::$data['heading']			= 'Berhasil';
			Self::$data['type']			   	= 'success';
		} else {
			Self::$data['heading'] 		= 'Error';
			Self::$data['type']	 		= 'error';
		}

		return Self::$data;
	}

	function login_back_admin()
	{

		Self::$data['heading'] 		= 'Login Admin Berhasil';
		Self::$data['type']	 		= 'success';

		if (!$this->session->userdata('admin_userid')) {
			Self::$data['status'] 		= false;
			Self::$data['message'] 		= 'Not allowed';
		}

		if (Self::$data['status']) {

			//update status
			$array = array(
				'user_id' => $this->session->userdata('admin_userid')
			);
			$this->session->set_userdata($array);
			Self::$data['message']	= 'Berhasil login kembali menjadi menjadi Admin';
		} else {

			Self::$data['heading'] 		= 'Failed';
			Self::$data['type']	 		= 'error';
		}

		return Self::$data;
	}

	public function do_register()
	{
		$referral_id 			= 1; //ADMIN ID

		/*============================================
		= VALIDASI REFERRAL KODE YANG DI INPUT MANUAL =
		============================================*/
		if ($this->input->post('user_referral')) {

			$user_referral 		= userdata(['user_referral_code' => post('user_referral')]);
			if (!$user_referral) {
				Self::$data['status'] 	= false;
				Self::$data['message'] 	= 'Referral Code Invalid or Unavailable!';
			} else {
				$referral_id  =	$user_referral->id;
			}
		}

		/*============================================
		=  JIKA ADA SESSION REFERRAL DARI LINK REF   =
		============================================*/
		if ($this->session->userdata('referralID')) {
			$referral_id 		= userdata(['user_referral_code' => $this->session->userdata('referralID')])->id;
		}

		/*============================================
		=	           VALIDASI PAKET	           =
		============================================*/
		$this->db->where('package_code', $this->input->post('user_paket'));
		$cekkkkpkt = $this->db->get('tb_packages');
		if ($cekkkkpkt->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'The Package You Choose is Invalid';
		}

		/*============================================
		=     VALIDASI INPUT AGAR TIDAK KOSONG       =
		============================================*/
		$this->form_validation->set_rules('user_fullname', 'Full Name', 'required');
		$this->form_validation->set_rules('user_username', 'Username', 'trim|required|min_length[4]|is_unique[tb_users.username]', array(
			'is_unique'    => 'Username Already Used, Use Another Username.'
		));
		$this->form_validation->set_rules('user_email', 'Email Address', 'trim|required');
		$this->form_validation->set_rules('user_phone', 'Whatsapp Number', 'required');
		$this->form_validation->set_rules('user_paket', 'Join Package', 'required');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[6]');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}



		/*============================================
		=           JIKA STATUS TRUE / BENAR         =
		============================================*/
		if (Self::$data['status']) {
			$random_string 		= strtolower(random_string('alnum', 64));
			$datapaket 			= $cekkkkpkt->row();
			$trx_id 			= hash('SHA256', random_string('alnum', 16));
			/*============================================
			=            INPUT DATA PENDAFTAR            =
			============================================*/
			$additional_data 	= array(
				'referral_id' 			=> $referral_id,
				'upline_id' 			=> $referral_id,
				'user_fullname'			=> $this->input->post('user_fullname'),
				'user_phone'			=> $this->input->post('user_phone'),
				'user_referral_code'	=> random_string('alnum', 6),
				'user_code'				=> $random_string,
			);

			$this->ion_auth->register(str_replace(' ', '', $this->input->post('user_username')), $this->input->post('user_password'), str_replace(' ', '', $this->input->post('user_email')), $additional_data, array(2));

			$last_user 		= userdata(array('user_code' => $random_string));

			/*============================================
			=              MEMBUAT WALLET               =
			============================================*/
			$this->db->insert(
				'tb_users_wallet',
				[
					'wallet_user_id'  	=> $last_user->id,
					'wallet_address'  	=> generateWallet(),
					'wallet_type'  		=> 'withdrawal',
					'wallet_date_added' => sekarang()
				]
			);

			/*============================================
			=              MEMBUAT INVOICE               =
			============================================*/
			$rannnnnnn 	= rand(300, 999);
			$this->db->insert(
				'tb_users_invoice',
				[
					'invoice_package_id'		=> $datapaket->package_id,
					'invoice_type'				=> 'join',
					'invoice_user_id'			=> $last_user->id,
					'invoice_amount'			=> (int)$datapaket->package_price,
					'invoice_subamount'			=> (int)$datapaket->package_price + $rannnnnnn,
					'invoice_kodeinv'			=> date('Y') . date('m') . date('d') . $rannnnnnn,
					'invoice_kode_unik'			=> $rannnnnnn,
					'invoice_date_add'			=> sekarang(),
					'invoice_code'				=> strtolower(random_string('alnum', 64)),
				]
			);

			/*============================================
			=           HAPUS SESION REFERRAL           =
			============================================*/
			$this->session->unset_userdata([
				'referralID'
			]);


			Self::$data['message'] 	= 'New Account Registration Successful';
			Self::$data['heading'] 	= 'Success';
			Self::$data['type'] 	= 'success';
		} else {

			Self::$data['heading'] 	= 'Error';
			Self::$data['type'] 	= 'error';
		}

		return Self::$data;
	}

	function titiklevel($user_id = null, $user_id_from = null, $level = 1)
	{
		$result         = array();
		$status         = true;

		$datauser         = userdata(['id' => $user_id]);
		$userdata         = userdata(['id' => $user_id_from]);
		if ($userdata->upline_id == 0) {
			$status = false;
		}

		$uplinedata     = userdata(['id' => $userdata->upline_id]);

		if ($status) {

			if ($uplinedata) {
				$this->db->insert('tb_titiklevel', [
					'titiklevel_userid'             => $uplinedata->id,
					'titiklevel_downlineid'         => $datauser->id,
					'titiklevel_level'              => $level,
					'titiklevel_date'               => sekarang(),
				]);

				$this->titiklevel($datauser->id, $uplinedata->id, $level + 1);
			}
		}
		return $result;
	}


	function bonuslevel($user_id = null, $user_id_from = null, $getpaket = 1, $level = 1)
	{
		$result 		= array();
		$status 		= true;
		$paketid		= $getpaket;

		$datauser 		= userdata(['id' => $user_id]);
		$userdata 		= userdata(['id' => $user_id_from]);

		// GET PAKET
		$this->db->where('package_id', $paketid);
		$get_packages 		= $this->db->get('tb_packages')->row();

		$array_term_level 	= json_decode($get_packages->package_titik);
		if ($level > count($array_term_level)) {
			$status = false;
		}

		if ($userdata->upline_id == 1) {
			$status = false;
		}
		if ($userdata->upline_id == 0) {
			$status = false;
		}

		$uplinedata 	= userdata(['id' => $userdata->upline_id]);


		if ($status) {
			if ($uplinedata) {
				$wallet     		= $this->usermodel->userWallet('withdrawal', $uplinedata->id);

				$this->db->insert(
					'tb_wallet_balance',
					[
						'w_balance_wallet_id'       => $wallet->wallet_id,
						'w_balance_amount'          => $array_term_level[$level - 1],
						'w_balance_type'            => 'credit',
						'w_balance_desc'            => 'Bonus Titik Level, Level Ke ' . $level . ' dari Username : ' . $datauser->username,
						'w_balance_date_add'        => sekarang(),
						'w_balance_txid'            => strtolower(random_string('alnum', 64)),
						'w_balance_ket'				=> 'level',
					]
				);

				$this->bonuslevel($datauser->id, $uplinedata->id, $paketid, $level + 1);
			}
		}
		return $result;
	}
}
