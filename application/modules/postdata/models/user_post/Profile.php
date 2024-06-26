<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Model
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

	function updateprofile()
	{
		if (!$this->ion_auth->hash_password_db(userid(), post('user_pass'))) {
			Self::$data['status']       = false;
			Self::$data['message']      = 'Confirm Password Does Not Match!';
		}

		$this->form_validation->set_rules('user_fullname', 'Full Name', 'required');
		$this->form_validation->set_rules('user_phone', 'Whatsapp Number', 'required');
		$this->form_validation->set_rules('user_pass', 'Confirm Password', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$update_data 		= [
				'user_fullname'	  		=> post('user_fullname'),
				'user_phone'	  		=> post('user_phone'),
			];
			$this->ion_auth->update(userid(), $update_data);

			Self::$data['heading'] 	= 'Success';
			Self::$data['message'] 	= 'Your profile has been saved successfully !';
			Self::$data['type'] 	= 'success';
		} else {
			Self::$data['heading'] 	= 'Error';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}


	function updatebank()
	{
		if (!$this->ion_auth->hash_password_db(userid(), post('bank_pass'))) {
			Self::$data['status']       = false;
			Self::$data['message']      = 'Confirm Password Invalid!';
		}

		$this->form_validation->set_rules('user_bank_account', 'Account in the Name', 'required');
		$this->form_validation->set_rules('user_bank_name', 'Bank Mame', 'required');
		$this->form_validation->set_rules('user_bank_number', 'Account Number', 'required');
		$this->form_validation->set_rules('bank_pass', 'Confirm Password', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->update(
				'tb_users',
				[
					'user_bank_account'		=> post('user_bank_account'),
					'user_bank_name'		=> post('user_bank_name'),
					'user_bank_number'		=> post('user_bank_number'),

				],
				[
					'id'					=> userid(),
				]
			);

			Self::$data['heading'] 	= 'Success';
			Self::$data['message'] 	= 'Your Bank Data Has Been Updated!';
			Self::$data['type'] 	= 'success';
		} else {
			Self::$data['heading'] 	= 'Error';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}

	public function saveProfile()
	{
		$userdata 				= userdata();

		$is_unique_username 	= '';
		if (post('username') != $userdata->username) {
			$is_unique_username	= '|is_unique[tb_users.username]';
		}
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('user_phone', 'Nomor Telephone', 'required|max_length[12]|min_length[10]');
		$this->form_validation->set_rules('user_fullname', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('email', 'alamat email', 'required|valid_email');
		// $this->form_validation->set_rules('email', 'alamat email', 'required|valid_email|is_unique[tb_users.email]', array(
		// 	'is_unique'	=> 'Alamat email ini telah digunakan. Mohon untuk menggunakan email lain'
		// ));
		$this->form_validation->set_rules('user_address', 'Alamat Lengkap', 'required');
		$this->form_validation->set_rules('user_ktp', 'Nomor Identitas KTP', 'required|max_length[16]|min_length[16]');
		// $this->form_validation->set_rules('user_npwp', 'Nomor Pokok Wajib Pajak (NPWP)', 'required|max_length[15]|min_length[15]');




		$this->form_validation->set_rules('username', 'Username', 'required' . $is_unique_username, array(
			'is_unique'	=> 'Username ini telah digunakan. Mohon untuk menggunakan username lain'
		));
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}
		if (Self::$data['status']) {

			$update_data 		= [
				'username'  		=> post('username'),
				'user_phone'  		=> post('user_phone'),
				'user_fullname'  	=> post('user_fullname'),
				'email'  			=> post('email'),
				'user_address'  	=> post('user_address'),
				'user_ktp'  		=> post('user_ktp'),
				'user_npwp'  		=> post('user_npwp')
			];

			$this->ion_auth->update(userid(), $update_data);
			//create user logs
			userlog('user memperbaharui data profile');

			Self::$data['message'] 	= 'Profile Anda berhasil disimpan !';
			Self::$data['heading'] 	= 'Berhasil';
			Self::$data['status'] 	= true;
			Self::$data['type'] 	= 'success';
		} else {
			Self::$data['heading'] 	= 'Gagal';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}

	public function update_image()
	{
		$config['upload_path']          = './assets/profile/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = '99999999';
		$config['max_width']            = '99999999';
		$config['max_height']           = '99999999';
		$config['remove_spaces']        = TRUE;
		$config['encrypt_name']         = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('user_picture')) {
			Self::$data['status']     = false;
			Self::$data['message']     = $this->upload->display_errors();
		}

		$this->form_validation->set_rules('xxxx', 'CODE', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$userdata = userdata();
			$uploaded 			= $this->upload->data();
			if (!empty($userdata->user_picture)) {
				if (file_exists('./assets/profile/' . $userdata->user_picture)) {
					unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/profile/' . $userdata->user_picture);
				}
			}

			$this->ion_auth->update(userid(), array('user_picture' => $uploaded['file_name']));




			Self::$data['message'] 	= 'FOTO DIPERBARUI !';
			Self::$data['heading'] 	= 'Berhasil';
			Self::$data['type'] 	= 'success';
		} else {

			Self::$data['heading'] 	= 'Gagal';
			Self::$data['type'] 	= 'error';
		}

		return Self::$data;
	}

	public function saveBank()
	{

		if (post('user_bank_name') == "bank_lain") {
			$this->form_validation->set_rules('user_bank_name_lain', 'Nama Bank Lain', 'required');
			$this->form_validation->set_rules('user_bank_number', 'Nomor Rekening', 'required');

			if (!$this->form_validation->run()) {
				Self::$data['status'] 	= false;
				Self::$data['message'] 	= validation_errors(' ', '<br/>');
			} else {
				$bank_name = post('user_bank_name_lain');
				$bank_lain = "1";
			}
		} elseif (post('user_bank_name') != null) {

			$this->form_validation->set_rules('user_bank_number', 'Nomor Rekening', 'required');
			if (!$this->form_validation->run()) {
				Self::$data['status'] 	= false;
				Self::$data['message'] 	= validation_errors(' ', '<br/>');
			} else {
				$bank_name = post('user_bank_name');
				$bank_lain = "0";
			}
		} else {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'Silahkan Pilih Jenis Bank !';
		}

		if (Self::$data['status']) {
			$update_data 		= [
				'user_bank_name'  	=> $bank_name,
				'user_bank_lain'  	=> $bank_lain,
				'user_bank_number'	=> post('user_bank_number')
			];

			$this->ion_auth->update(userid(), $update_data);

			//create user logs
			userlog('User memperbaharui data BANK <br/>
				Nama BANK: ' . $bank_name . ' <br/>
				Nomor Rekening: ' . post('user_bank_number') . '
			');

			Self::$data['message'] 	= 'Data BANK berhasil disimpan !';
			Self::$data['heading'] 	= 'Berhasil';
			Self::$data['status'] 	= true;
			Self::$data['type'] 	= 'success';
		} else {

			Self::$data['heading'] 	= 'Gagal';
			Self::$data['type'] 	= 'error';
		}

		return Self::$data;
	}


	public function saveWallet()
	{

		$this->db->update('tb_users', [
			'wallet_btc_external' 	=> post('wallet_btc_external')
		], [
			'id' 	=> userid()
		]);

		Self::$data['message'] 		= 'Wallet setting updated !';
		Self::$data['heading'] 		= 'Success';
		Self::$data['type'] 		= 'success';

		return Self::$data;
	}


	public function change_avatar()
	{

		$data['status'] 	= true;
		$data['csrf_data']	= $this->security->get_csrf_hash();

		$config['upload_path'] 		= './uploads/users/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size']  		= '10000';
		$config['max_width']  		= '102400';
		$config['max_height']  		= '76800';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			$data['status'] 	= false;
			$data['message'] 	= $this->upload->display_errors();
			$data['heading'] 	= 'Failed';
			$data['type'] 		= 'error';
		}

		if ($data['status']) {

			$uploaded 			= $this->upload->data();
			//update user avatar
			$this->ion_auth->update(userid(), array('user_picture' => $uploaded['file_name']));

			$data['message'] 	= 'Upload user image Successfully !';
			$data['heading'] 	= 'Success';
			$data['type'] 		= 'success';
		}


		return $data;
	}


	public function changepass()
	{

		//validate current password
		if (!$this->ion_auth->hash_password_db(userid(), post('current_password'))) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "Old Password Doesn't Match!";
		}

		$this->form_validation->set_rules('current_password', 'Old Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Repeat New Password', 'trim|required|matches[new_password]');
		if ($this->form_validation->run() == FALSE) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->ion_auth->update(userid(), [
				'password'	=> post('new_password')
			]);

			Self::$data['heading'] 	= 'Success';
			Self::$data['message'] 	= 'Your Password Has Been Successfully Updated!';
			Self::$data['type'] 	= 'success';
		} else {

			Self::$data['heading'] 	= 'Error';
			Self::$data['type'] 	= 'error';
		}

		return Self::$data;
	}


	function changepin()
	{

		//validate current password
		$this->db->where('pin_lock', post('old_pintransaction'));
		$this->db->where('id', userid());
		$cekpinuser = $this->db->get('tb_users');
		if ($cekpinuser->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'Invalid PIN Transation!';
		}

		if (!$this->ion_auth->hash_password_db(userid(), post('confirm_password'))) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'Invalid Password!';
		}

		$this->form_validation->set_rules('old_pintransaction', 'Old transaction PIN', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('new_pintransaction', 'New transaction PIN', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->update(
				'tb_users',
				[
					'pin_lock'		=> post('new_pintransaction'),
				],
				[
					'id'		=> userid(),
				]
			);

			Self::$data['heading'] 	= 'Success';
			Self::$data['message'] 	= 'Your Transaction PIN has been successfully updated!';
			Self::$data['type'] 	= 'success';
		} else {

			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}

		return Self::$data;
	}

	function setpin()
	{
		if (!$this->ion_auth->hash_password_db(userid(), post('confirm_password'))) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'Invalid Password!';
		}

		$this->form_validation->set_rules('pintransaction', 'New transaction PIN', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->update(
				'tb_users',
				[
					'pin_lock'		=> post('pintransaction'),
				],
				[
					'id'			=> userid(),
				]
			);

			Self::$data['heading'] 	= 'Success';
			Self::$data['message'] 	= 'Your Transaction PIN has been successfully set!';
			Self::$data['type'] 	= 'success';
		} else {

			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}

		return Self::$data;
	}

	function sendverifikasi()
	{
		if (!$this->ion_auth->hash_password_db(userid(), post('verifikasi_password'))) {
			Self::$data['status']       = false;
			Self::$data['message']      = 'Konfirmasi Password Tidak Cocok!';
		} else {
			$this->db->where('userver_status', 'success');
			$this->db->where('userver_userid', userid());
			$cekstatus = $this->db->get('tb_userver');
			if ($cekstatus->num_rows() == 0) {
				$config['upload_path']          = './assets/verifikasi/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = '9999999';
				$config['max_width']            = '9999999';
				$config['max_height']           = '9999999';
				$config['encrypt_name'] 		= TRUE;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('verifikasi_picture')) {
					Self::$data['status']     = false;
					Self::$data['message']     = $this->upload->display_errors();
				}
			}
		}

		$this->form_validation->set_rules('verifikasi_nama', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('verifikasi_whatsapp', 'No Telp / Whatsapp', 'required');
		$this->form_validation->set_rules('verifikasi_password', 'Password', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		$this->db->where('userver_status', 'pending');
		$this->db->where('userver_userid', userid());
		$cekstatus = $this->db->get('tb_userver');
		if ($cekstatus->num_rows() != 0) {
			Self::$data['status']     	= false;
			Self::$data['message']		= "Anda Memiliki Status Verifikasi Pending";
		}

		if (Self::$data['status']) {
			$uploaded   = $this->upload->data();
			$userdata 	= userdata();

			$this->db->insert(
				'tb_userver',
				[
					'userver_userid'	=> userid(),
					'userver_nama'		=> post('verifikasi_nama'),
					'userver_wa'		=> post('verifikasi_whatsapp'),
					'userver_nik'		=> $userdata->user_nik,
					'userver_file'		 => $uploaded['file_name'],
					'userver_date'		=> sekarang(),
					'userver_code'		=> strtolower(random_string('alnum', 64)),
				]
			);

			Self::$data['message']      = 'Data Verifikasi Telah Dikirim Untuk Dikonfirmasi Admin';
			Self::$data['heading']      = 'Berhasil';
			Self::$data['type']         = 'success';
		} else {
			Self::$data['heading']     	= 'Gagal';
			Self::$data['type']     	= 'error';
		}

		return Self::$data;
	}

	function sendtestimoni()
	{
		$this->form_validation->set_rules('content', 'Testimonials', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->insert(
				'tb_testimonials',
				[
					'testimonials_userid'	   	=> userid(),
					'testimonials_content'		=> post('content'),
					'testimonials_date'			=> sekarang(),
					'testimonials_code'			=> strtolower(random_string('alnum', 64)),
				]
			);

			Self::$data['message']      = 'Data Sent Waiting for Admin Confirmation';
			Self::$data['heading']      = 'Success';
			Self::$data['type']         = 'success';
		} else {
			Self::$data['heading']     	= 'Error';
			Self::$data['type']     	= 'error';
		}

		return Self::$data;
	}

	function sendnewticket()
	{
		$this->db->where('ticket_userid', userid());
		$this->db->where('ticket_status', 'open');
		$cekticket = $this->db->get('tb_ticket');
		if ($cekticket->num_rows() >= 3) {
			Self::$data['status']     = false;
			Self::$data['message']     = "Please Complete Your Open Ticket Beforehand";
		}

		$this->form_validation->set_rules('ticket_subject', 'Subject', 'required');
		$this->form_validation->set_rules('ticket_description', 'Message', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->insert(
				'tb_ticket',
				[
					'ticket_userid'			=> userid(),
					'ticket_sendid'			=> userid(),
					'ticket_subject'		=> post('ticket_subject'),
					'ticket_description'	=> post('ticket_description'),
					'ticket_date'			=> sekarang(),
					'ticket_code'			=> strtolower(random_string('alnum', 64)),
					'ticket_kode'			=> strtoupper(random_string('alnum', 8)),
				]
			);

			Self::$data['message']      = 'Ticket Sent Waiting for Admins Reply';
			Self::$data['heading']      = 'Success';
			Self::$data['type']         = 'success';
		} else {
			Self::$data['heading']     	= 'Error';
			Self::$data['type']     	= 'error';
		}

		return Self::$data;
	}

	function sendrepleyticket()
	{
		$user_group     = $this->ion_auth->get_users_groups()->row();
		if ($user_group->id == 2) {
			$this->db->where('ticket_userid', userid());
		}
		$this->db->where('ticket_kode', post('code'));
		$cekticket = $this->db->get('tb_ticket');
		if ($cekticket->num_rows() == 0) {
			Self::$data['status']     = false;
			Self::$data['message']     = "Ticket Data Not Found";
		}

		$this->form_validation->set_rules('code', 'Code Message', 'required');
		$this->form_validation->set_rules('ticket_description', 'Message', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$myticket = $cekticket->row();
			$this->db->insert(
				'tb_ticket',
				[
					'ticket_userid'			=> userid(),
					'ticket_sendid'			=> userid(),
					'ticket_subject'		=> $myticket->ticket_subject,
					'ticket_description'	=> post('ticket_description'),
					'ticket_date'			=> sekarang(),
					'ticket_code'			=> strtolower(random_string('alnum', 64)),
					'ticket_kode'			=> post('code'),
				]
			);

			Self::$data['message']      = 'Reply Sent';
			Self::$data['heading']      = 'Success';
			Self::$data['type']         = 'success';
		} else {
			Self::$data['heading']     	= 'Error';
			Self::$data['type']     	= 'error';
		}

		return Self::$data;
	}

	function closeticket()
	{
		$this->db->where('ticket_kode', post('code'));
		$cekticket = $this->db->get('tb_ticket');
		if ($cekticket->num_rows() == 0) {
			Self::$data['status']     = false;
			Self::$data['message']     = "Ticket Data Not Found";
		}

		$this->form_validation->set_rules('code', 'Code Message', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->update(
				'tb_ticket',
				[
					'ticket_status'		=> 'close'
				],
				[
					'ticket_kode'		=> post('code')
				]
			);

			Self::$data['message']      = 'Your ticket has been closed successfully';
			Self::$data['heading']      = 'Success';
			Self::$data['type']         = 'success';
		} else {
			Self::$data['heading']     	= 'Error';
			Self::$data['type']     	= 'error';
		}

		return Self::$data;
	}

	function klaimreward()
	{
		// VALIDASI REWARD APAKAH ADA
		$this->db->where('reward_code', post('code'));
		$cekreward = $this->db->get('tb_reward');
		if ($cekreward->num_rows() == 0) {
			Self::$data['status']     = false;
			Self::$data['message']     = "Data Reward Tidak Valid";
		} else {
			$datareward = $cekreward->row();
			// VALIDASI POIN
			if ($this->usermodel->poinreward() < $datareward->reward_point) {
				Self::$data['status']     = false;
				Self::$data['message']     = "Poin Anda Tidak Cukup Untuk Klaim Reward Ini";
			}
		}

		// VALIDASI PASSWORD
		if (!$this->ion_auth->hash_password_db(userid(), post('konfirmasi_password'))) {
			Self::$data['status']       = false;
			Self::$data['message']      = 'Konfirmasi Password Tidak Cocok!';
		}

		// VALIDASI DATA
		$this->form_validation->set_rules('code', 'Kode Reward', 'required');
		$this->form_validation->set_rules('reward_bank_account', 'Rekening Atas Nama', 'required');
		$this->form_validation->set_rules('reward_bank_name', 'Nama Bank', 'required');
		$this->form_validation->set_rules('reward_bank_number', 'Nomor Rekening', 'required');
		$this->form_validation->set_rules('reward_phone', 'No WhatsApp', 'required');
		$this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		// CEK APAKAH ADA YANG PENDING
		$this->db->where('userreward_status', 'pending');
		$this->db->where('userreward_userid', userid());
		$cek_pending = $this->db->get('tb_userreward');
		if ($cek_pending->num_rows() != 0) {
			Self::$data['status']       = false;
			Self::$data['message']      = 'Anda Memiliki Transaksi Pending!';
		}


		if (Self::$data['status']) {
			$datareward = $cekreward->row();

			$this->db->insert(
				'tb_userreward',
				[
					'userreward_rewardid'		=> $datareward->reward_id,
					'userreward_userid'			=> userid(),
					'userreward_account'		=> $this->input->post('reward_bank_account'),
					'userreward_bank'			=> $this->input->post('reward_bank_name'),
					'userreward_number'			=> $this->input->post('reward_bank_number'),
					'userreward_contact'		=> $this->input->post('reward_phone'),
					'userreward_date'			=> sekarang(),
					'userreward_code'			=> strtolower(random_string('alnum', 64))
				]
			);

			Self::$data['message']      = 'Berhasil Claim Reward & Tenunggu Konfirmasi Dari Admin';
			Self::$data['heading']      = 'Berhasil';
			Self::$data['type']         = 'success';
		} else {
			Self::$data['heading']     	= 'Gagal';
			Self::$data['type']     	= 'error';
		}

		return Self::$data;
	}
}

/* End of file Profile.php */
/* Location: ./application/modules/postdata/models/user_post/Profile.php */