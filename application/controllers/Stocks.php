<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Role');
	}

	public function index() {
		$user = $this->session->userdata('user');

		if (!$user) {
			redirect('login');
		}

		$role = $this->Role->getRoleByUserIdRole($user->id_role);

		$data = [
			'user' => $user,
			'role' => $role,
		];

		$view_path = "stocks/{$role}";
		if (file_exists(APPPATH . "views/{$view_path}.php")) {
			$this->loadView($view_path, $data);
		} else {
			show_error("Vue non disponible pour le rôle : $role", 404);
		}
	}
}

