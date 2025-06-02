<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends MY_Controller {

	public function __construct() {
	parent::__construct();
	$this->load->helper('url');
	}

	public function admin() {
	$data['user'] = $this->session->userdata('user');
	$this->loadView('stocks/admin', $data, true);
	}

	public function gerant() {
	$data['user'] = $this->session->userdata('user');
	$this->loadView('stocks/gerant', $data, true);
	}

	public function commercial() {
	$data['user'] = $this->session->userdata('user');
	$this->loadView('stocks/commercial', $data, true);
	}

	public function manager() {
	$data['user'] = $this->session->userdata('user');
	$this->loadView('stocks/manager', $data, true);
	}

	public function preparateur() {
	$data['user'] = $this->session->userdata('user');
	$this->loadView('stocks/preparateur', $data, true);
	}

	public function envoyeur() {
	$data['user'] = $this->session->userdata('user');
	$this->loadView('stocks/envoyeur', $data, true);
	}
}
