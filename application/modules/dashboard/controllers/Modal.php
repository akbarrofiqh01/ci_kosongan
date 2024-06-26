<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal extends MX_Controller {

	public function show( $filename = 'null' )
	{	
		
		if ( ! file_exists( MODULESPATH. '/dashboard/views/modal/' . $filename . '.php' ) ) {
			show_404();
			exit;
		}

		echo $this->load->view( 'modal/'. $filename, [], true);
	
	}

}

/* End of file Modal.php */
/* Location: ./application/modules/modal/controllers/Modal.php */