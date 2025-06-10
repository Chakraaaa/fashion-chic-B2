<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends MY_Controller
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
		$this->loadView('utilisateurs/admin', $data, false);
	}



	public function supprimer_utilisateur($id) {
		$this->db->where('id_utilisateur', $id);
		if ($this->db->delete('utilisateur')) {
			$this->session->set_flashdata('success', 'Utilisateur supprimé avec succès !');
		} else {
			$this->session->set_flashdata('error', 'Erreur lors de la suppression');
		}
		redirect('admin');
	}
}

