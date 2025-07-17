<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function index() {
		$data['title'] = 'Connexion - FASHION CHIC';
		$this->loadView('login', $data, false);
	}

	public function identifiant() {
		$data['title'] = 'Connexion par identifiant - FASHION CHIC';
		$this->loadView('login_identifiant', $data, false);
	}

	public function authentifier() {
		$this->load->model('Utilisateur');
		$this->load->model('Role');
		$email = $this->input->post('email');
		$password = $this->input->post('mot_de_passe');
		$user = $this->Utilisateur->getUserByEmail($email);
		if ($user && password_verify($password, $user->mot_de_passe)) {
			if (isset($user->actif) && !$user->actif) {
				$data['error'] = "L’accès à votre compte a été bloqué.";
				$this->loadView('login', $data, false);
				return;
			}
			$role = $this->Role->getRoleByUserIdRole($user->id_role);
			$user->role_nom = strtolower($role->libelle);
			$this->session->set_userdata('user', $user);
			redirect('stocks');
		} else {
			$data['error'] = "Email ou mot de passe incorrect.";
			$this->loadView('login', $data, false);
		}
	}

	public function authentifier_identifiant() {
		$this->load->model('Utilisateur');
		$this->load->model('Role');
		$identifiant = $this->input->post('identifiant');
		$user = $this->Utilisateur->getUserByIdentifiant($identifiant);
		if ($user) {
			if (isset($user->actif) && !$user->actif) {
				$data['error'] = "L’accès à votre compte a été bloqué.";
				$this->loadView('login_identifiant', $data, false);
				return;
			}
			$role = $this->Role->getRoleByUserIdRole($user->id_role);
			$user->role_nom = strtolower($role->libelle);
			$this->session->set_userdata('user', $user);
			redirect('stocks');
		} else {
			$data['error'] = "Identifiant incorrect.";
			$this->loadView('login_identifiant', $data, false);
		}
	}

	public function logout() {
		$this->session->unset_userdata('user');
		$this->session->sess_destroy();
		redirect('login');
	}




}
