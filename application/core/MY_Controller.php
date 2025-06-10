<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	protected $data = [];

	public function __construct() {
		parent::__construct();
		$this->data['user'] = $this->session->userdata('user');
	}

	protected function loadView($view, $data = [], $show_menu = true) {
		$data = array_merge($this->data, $data);
		$data['content'] = $view;
		$data['show_menu'] = $show_menu;
		$this->load->view('layouts/default', $data);
	}
}
