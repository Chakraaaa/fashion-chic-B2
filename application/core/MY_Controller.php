<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function loadView($view, $data = []) {
		$data['content'] = $view;
		$this->load->view('layouts/default', $data);
	}
}
