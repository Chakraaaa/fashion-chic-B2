<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function loadView($view, $data = [], $show_menu = true) {
		$data['content'] = $view;
		$data['show_menu'] = $show_menu;
		$this->load->view('layouts/default', $data);
	}
}

