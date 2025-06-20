<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateurs extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Utilisateur');
		$this->load->model('Role');
	}

	public function index()
	{
		$data['user'] = $this->session->userdata('user');
		$data['title'] = 'Liste des utilisateurs Relais-Managers';
		$data['utilisateurs'] = $this->Utilisateur->getAllUsersWithRole();
		$data['roles'] = $this->Role->getAllRoles();
		$this->loadView('utilisateurs/admin', $data);
	}


	public function delete($id)
	{
		var_dump("test");
		$this->load->model('Utilisateur');
		$this->Utilisateur->deleteUser($id);
	}

	public function load_add_users_popup()
	{
		$this->load->model('Role');
		$roles = $this->Role->getAllRoles();
		$data['roles'] = $roles;
		$this->load->view('utilisateurs/popup_ajout_user', $data);

	}

	public function saveNewUser()
	{
		$this->load->model('Utilisateur');

		$data = [
			'prenom'       => $this->input->post('prenom'),
			'nom'          => $this->input->post('nom'),
			'email'        => $this->input->post('email'),
			'id_role'      => $this->input->post('id_role'),
			'mot_de_passe' => password_hash($this->input->post('mot_de_passe'), PASSWORD_DEFAULT),
		];

		$this->Utilisateur->addUser($data);
		redirect('utilisateurs');
	}
}


