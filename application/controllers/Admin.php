<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Utilisateur');
		$this->load->model('Role');
	}

	// Page principale admin avec gestion des utilisateurs
	public function index()
	{
		$data['user'] = $this->session->userdata('user');
		$data['title'] = 'Liste des utilisateurs Relais-Managers';

		// JOIN directement dans le contrôleur
		$this->db->select('u.*, r.libelle as nom_role');
		$this->db->from('utilisateur u');
		$this->db->join('role r', 'u.id_role = r.id_role', 'left');
		$this->db->order_by('u.nom', 'ASC');
		$query = $this->db->get();
		$data['utilisateurs'] = $query->result();

		$data['roles'] = $this->Role->getAllRoles();

		// Charger ta vue admin.php
		$this->loadView('admin', $data, false);
	}

/*
	// Traiter l'ajout d'un nouvel utilisateur (via AJAX)
	public function ajouter_utilisateur() {
		// Définir les règles de validation
		$this->form_validation->set_rules('nom', 'Nom', 'required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('prenom', 'Prénom', 'required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[utilisateur.email]');
		$this->form_validation->set_rules('id_role', 'Rôle', 'required|numeric');
		$this->form_validation->set_rules('mot_de_passe', 'Mot de passe', 'required|min_length[6]');

		// Réponse JSON
		$response = array();

		if ($this->form_validation->run() == FALSE) {
			// Erreurs de validation
			$response['success'] = false;
			$response['errors'] = array(
				'nom' => form_error('nom'),
				'prenom' => form_error('prenom'),
				'email' => form_error('email'),
				'id_role' => form_error('id_role'),
				'mot_de_passe' => form_error('mot_de_passe')
			);
		} else {
			// Données valides, créer l'utilisateur
			$userData = array(
				'nom' => $this->input->post('nom'),
				'prenom' => $this->input->post('prenom'),
				'email' => $this->input->post('email'),
				'mot_de_passe' => $this->input->post('mot_de_passe'),
				'id_role' => $this->input->post('id_role')
			);

			// Insertion directe
			if ($this->db->insert('utilisateur', $userData)) {
				$userId = $this->db->insert_id();

				// Récupérer l'utilisateur créé avec son rôle (JOIN direct CORRIGÉ)
				$this->db->select('u.*, r.libelle as nom_role');
				$this->db->from('utilisateur u');
				$this->db->join('role r', 'u.id_role = r.id_role', 'left');  // CORRECTION : r.id_role
				$this->db->where('u.id_utilisateur', $userId);
				$query = $this->db->get();
				$newUser = $query->row();

				$response['success'] = true;
				$response['message'] = 'Utilisateur ajouté avec succès !';
				$response['user'] = $newUser;
			} else {
				$response['success'] = false;
				$response['message'] = 'Erreur lors de la création de l\'utilisateur';
			}
		}

		// Retourner la réponse JSON
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	// Supprimer un utilisateur
	public function supprimer_utilisateur($id) {
		$this->db->where('id_utilisateur', $id);
		if ($this->db->delete('utilisateur')) {
			$this->session->set_flashdata('success', 'Utilisateur supprimé avec succès !');
		} else {
			$this->session->set_flashdata('error', 'Erreur lors de la suppression');
		}
		redirect('admin');
	}

	// Modifier un utilisateur (simple redirection pour l'instant)
	public function modifier_utilisateur($id) {
		// Pour l'instant, redirige vers la liste avec un message
		$this->session->set_flashdata('info', 'Fonctionnalité de modification à venir...');
		redirect('admin');
	}

	// Test de fonctionnement
	public function test() {
		echo "<h3>🔍 Test des composants :</h3>";

		// Test base de données
		echo "<p>📊 <strong>Test base de données :</strong></p>";
		$users = $this->db->get('utilisateur')->result();
		echo "✅ Table utilisateur : " . count($users) . " enregistrements<br>";

		$roles = $this->db->get('role')->result();
		echo "✅ Table role : " . count($roles) . " enregistrements<br>";

		// Test JOIN
		echo "<p>🔗 <strong>Test JOIN :</strong></p>";
		$this->db->select('u.*, r.libelle as nom_role');
		$this->db->from('utilisateur u');
		$this->db->join('role r', 'u.id_role = r.id_role', 'left');  // CORRECTION : r.id_role
		$query = $this->db->get();
		$usersWithRoles = $query->result();
		echo "✅ JOIN utilisateur+role : " . count($usersWithRoles) . " résultats<br>";

		// Test modèles
		echo "<p>📦 <strong>Test modèles :</strong></p>";
		$rolesFromModel = $this->Role->getAllRoles();
		echo "✅ Role->getAllRoles() : " . count($rolesFromModel) . " rôles<br>";

		echo "<p>🎯 <strong>Tout fonctionne ! Tu peux aller sur <a href='" . site_url('admin') . "'>/admin</a></strong></p>";
	}
*/
}
