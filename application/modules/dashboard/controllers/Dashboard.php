<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {

			$this->session->set_flashdata(
				'auth_flash',
				alerts('Anda harus login terlebih dahulu untuk mengakses halaman ini !', 'danger')
			);

			redirect('login', 'refresh');
		}
		if (!userdata()) {
			redirect('logout', 'refresh');
		}
	}

	function view_page($filename = 'dashboard')
	{

		if (!file_exists(APPPATH . 'modules/dashboard/views/page/' . $filename . '.php')) {
			show_404();
			exit;
		}

		$this->template->content->view('page/' . $filename);
		$this->template->publish();
	}

	function view_gen($param = 1)
	{

		if ($param < 1 || $param > 7) {
			show_404();
			exit;
		}

		$filename = 'mygeneration';
		if (!file_exists(APPPATH . 'modules/dashboard/views/page/' . $filename . '.php')) {
			show_404();
			exit;
		}

		$this->db->where('titiklevel_level', $param);
		$this->db->where('titiklevel_userid', userid());
		$cektitik = $this->db->get('tb_titiklevel');
		if ($cektitik->num_rows() == 0) {
			show_404();
			exit;
		}
		$data['genke'] = $param;
		$data['titiklevel'] = $cektitik->row();
		$this->template->content->view('page/' . $filename, $data);
		$this->template->publish();
	}

	function test()
	{
		$this->db->where('id !=', 1);
		$getdata = $this->db->get('tb_users');
		foreach ($getdata->result() as $datasss) {

			$info = $this->walletmodel->walletTABUNGAN($datasss->id);

			if ($info > 0) {

				$arraay[] = array(
					'id'		=> $datasss->id,
					'username'	=> $datasss->username,
					'amount'	=> $info,
				);
			}
		}

		echo "<pre>";
		print_r($arraay);
		echo "</pre>";
	}

	function view_produk($alias = null)
	{
		$this->db->where('produk_alias', $alias);
		$cekinfo = $this->db->get('tb_produk');
		if ($cekinfo->num_rows() == 0) {
			show_404();
			exit;
		}


		$filename 				= 'detail-produk';
		$data['rows']			= $cekinfo->row();
		$data['data_group']     = $this->ion_auth->get_users_groups()->row();
		$this->template->content->view('page/' . $filename, $data);
		$this->template->publish();
	}
}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controllers/Dashboard.php */