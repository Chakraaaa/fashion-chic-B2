<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Role');
	}

	public function index() {
		$this->load->model('Client');
		$user = $this->session->userdata('user');

		if (!$user) {
			redirect('login');
		}

		$role = $this->Role->getRoleByUserIdRole($user->id_role);

		$data = [
			'user' => $user,
			'role' => $role,
		];

		if (in_array($role, ['admin', 'gerant'])) {
			$clients = $this->Client->getAllClients();
			$data['clients'] = $clients;
			$this->loadView('clients/admin', $data);
		} elseif ($role == 'commercial') {
			// Faire une méthode getClientsByCommercialId dans le model Client et l'appelé ici
			$this->loadView('clients/commercial', $data);
		}
		else {
			show_error("Accès interdit à la gestion des clients.", 403);
		}
	}

	public function load_add_client_popup()
	{
		$this->load->model('Role');
		$this->load->model('Utilisateur');

		$idRoleCommercial = $this->Role->getIdByRoleName('commercial');

		if ($idRoleCommercial === null) {
			show_error("Rôle 'commercial' introuvable en base", 500);
		}

		$commerciaux = $this->Utilisateur->getUsersByIdRole($idRoleCommercial);

		$data = [
			'commerciaux' => $commerciaux
		];

		$this->load->view('clients/popup_add_client', $data);

	}

	public function saveNewClient()
	{
		$this->load->model('Client');

		$data = [
			'nom'        => $this->input->post('nom'),
			'adresse'    => $this->input->post('adresse'),
			'telephone'  => $this->input->post('telephone'),
			'email'      => $this->input->post('email'),
			'id_commercial' => $this->input->post('id_commercial'),
		];

		$this->Client->addClient($data);
		redirect('clients');

	}

	public function delete($id)
	{
		$this->load->model('Client');
		$this->Client->deleteClientById($id);
	}



}

