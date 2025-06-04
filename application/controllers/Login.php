<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function index() {
		$data['title'] = 'Connexion - FASHION CHIC';
		$this->loadView('login', $data, false);
	}

	public function authentifier() {
		$this->load->model('Utilisateur');
		$this->load->model('Role');
		$email = $this->input->post('email');
		$password = $this->input->post('mot_de_passe');
		$user = $this->Utilisateur->getUserByLogins($email, $password);
		if ($user) {
			$role = $this->Role->getRoleByUserIdRole($user->id_role);
			$user->role_nom = strtolower($role->libelle);
			$this->session->set_userdata('user', $user);
			redirect('stocks');
		} else {
			$data['error'] = "Email ou mot de passe incorrect.";
			$this->loadView('login/index', $data, false);
		}
	}



}
