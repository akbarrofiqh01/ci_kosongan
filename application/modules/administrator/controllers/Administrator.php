<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->is_admin()) :
			redirect('login', 'refresh');
		endif;
	}

	function index($filename = 'dashboard/dashboard')
	{

		if (!file_exists(APPPATH . 'modules/administrator/views/' . $filename . '.php')) {
			show_404();
			exit;
		}


		$this->template->content->view('administrator/' . $filename);
		$this->template->publish('dashboard/template');
	}

	function berangkat($code = null)
	{
		$filename = 'data-peserta-berangkat';

		$this->db->where('tglberangkat_code', $code);
		$cek_tanggal = $this->db->get('tb_tglberangkat');

		if ($cek_tanggal->num_rows() == 0) {
			show_404();
			exit;
		} elseif (!file_exists(APPPATH . 'modules/administrator/views/' . $filename . '.php')) {
			show_404();
			exit;
		}
		$data['tanggal']	= $cek_tanggal->row();

		$this->template->content->view('administrator/' . $filename, $data);
		$this->template->publish('dashboard/template');
	}

	function otherdata($filename = null)
	{

		if (!file_exists(APPPATH . 'modules/administrator/views/other/' . $filename . '.php')) {
			show_404();
			exit;
		}


		$this->template->content->view('administrator/other/' . $filename);
		$this->template->publish('dashboard/template');
	}


	function editnews($param = null)
	{



		$data = array();
		$filename = "edit-news";

		$this->db->where('blog_code', $param);
		$cekblog = $this->db->get('tb_blog');
		if ($cekblog->num_rows() == 0) {
			show_404();
			exit;
		}

		if (!file_exists(APPPATH . 'modules/administrator/views/' . $filename . '.php')) {
			show_404();
			exit;
		}

		$data['blog']	= $cekblog->row();
		$this->template->content->view('administrator/' . $filename, $data);
		$this->template->publish('dashboard/template');
	}

	function view_editartikel($param = null)
	{
		$data = array();
		$filename = 'edit-artikel';

		$this->db->where('blog_code', $param);
		$cekartikel = $this->db->get('tb_blog');
		if ($cekartikel->num_rows() == 0) {
			show_404();
			exit;
		}

		if (!file_exists(APPPATH . 'modules/administrator/views/' . $filename . '.php')) {
			show_404();
			exit;
		}

		$data['artikel']	= $cekartikel->row();
		$this->template->content->view('administrator/' . $filename, $data);
		$this->template->publish('dashboard/template');
	}

	function test($total = 31, $userid = 63)
	{
		$this->db->limit($total);
		$this->db->where('pin_userid', $userid);
		$this->db->where('pin_package_id', '2');
		$this->db->where('pin_status', 'available');
		$ggggget = $this->db->get('tb_users_pin');
		foreach ($ggggget->result() as $show) {
			$this->db->update(
				'tb_users_pin',
				[
					'pin_userid'        => '1',
				],
				[
					'pin_code'          => $show->pin_code,
				]
			);
		}

		$this->db->insert('tb_histori_userpin', [
			'histori_userid'                => $userid,
			'histori_userpindesc'           => 'Tarik ' . $total . ' PIN Paket SKINCARE',
			'histori_userpindate'           => sekarang(),
			'histori_code'                  => strtolower(random_string('alnum', 64)),
		]);
	}
}

/* End of file Administrator.php */
/* Location: ./application/controllers/Administrator.php */