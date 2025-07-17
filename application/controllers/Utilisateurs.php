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
		$this->load->model('Utilisateur');
		$this->Utilisateur->deleteUser($id);
		$this->session->set_flashdata('success', 'Utilisateur supprimé avec succès.');
		redirect('utilisateurs');
	}

	public function load_add_users_popup()
	{
		$this->load->model('Role');
		$roles = $this->Role->getAllRoles();
		$data['roles'] = $roles;
		$this->load->view('utilisateurs/popup_ajout_user', $data);
	}

	public function load_add_users_identifiant_popup()
	{
		$this->load->model('Role');
		$roles = $this->Role->getAllRoles();
		$data['roles'] = $roles;
		$this->load->view('utilisateurs/popup_ajout_user_identifiant', $data);
	}

	public function saveNewUser()
	{
		$this->load->model('Utilisateur');

		// Validation des données
		$email = $this->input->post('email');
		if ($this->Utilisateur->emailExists($email)) {
			$this->session->set_flashdata('error', 'Cet email existe déjà');
			redirect('utilisateurs');
			return;
		}

		$data = [
			'prenom'       => $this->input->post('prenom'),
			'nom'          => $this->input->post('nom'),
			'email'        => $email,
			'id_role'      => $this->input->post('id_role'),
			'mot_de_passe' => password_hash($this->input->post('mot_de_passe'), PASSWORD_DEFAULT),
		];

		$this->Utilisateur->addUser($data);
		$this->session->set_flashdata('success', 'Utilisateur ajouté avec succès');
		redirect('utilisateurs');

		// Envoi de l'email de bienvenue avec les identifiants
		$this->load->library('email');
		$this->email->from('no-reply@fashion-chic.com', 'FASHION CHIC');
		$this->email->to($email);
		$this->email->subject('Votre compte FASHION CHIC');
		$prenom = $this->input->post('prenom');
		$nom = $this->input->post('nom');
		$mot_de_passe = $this->input->post('mot_de_passe');
		$message = "Bonjour $prenom $nom,\n\nVotre compte a été créé.\nEmail de connexion : $email\nMot de passe : $mot_de_passe\n\nCordialement,\nFASHION CHIC";
		$this->email->message($message);
		$this->email->send();
	}

	public function saveNewUserIdentifiant()
	{
		var_dump($this->input->post('prenom'));
		$this->load->model('Utilisateur');

		// Générer un identifiant unique automatiquement
		do {
			$identifiant = $this->generateUniqueIdentifiant();
		} while ($this->Utilisateur->identifiantExists($identifiant));

		// Générer un email fictif unique
		$email_fictif = $identifiant . '@noemail.local';

		$data = [
			'prenom'     => $this->input->post('prenom'),
			'nom'        => $this->input->post('nom'),
			'identifiant' => $identifiant, // Stockage en clair
			'id_role'    => $this->input->post('id_role'),
			'email'      => $email_fictif // Ajout de l'email fictif
		];

		$result = $this->Utilisateur->addUser($data);
		$this->session->set_flashdata('success', 'Utilisateur ajouté avec succès');
		redirect('utilisateurs');
	}

	private function generateUniqueIdentifiant()
	{
		$caracteres = 'ABCDEFGHJKMNPRSTUVWXYZ123456789'; // Sans i, l, o, 0
		$identifiant = '';
		for ($i = 0; $i < 10; $i++) {
			$identifiant .= $caracteres[rand(0, strlen($caracteres) - 1)];
		}
		return $identifiant;
	}

	public function load_edit_users_popup()
	{
		$user_id = $this->input->get('user_id');
		$user_role = $this->input->get('user_role');
		
		// Récupérer les données de l'utilisateur
		$utilisateur = $this->Utilisateur->getUserById($user_id);
		$roles = $this->Role->getAllRoles();
		
		$data['utilisateur'] = $utilisateur;
		$data['roles'] = $roles;
		
		// Choisir la vue selon le rôle
		if ($user_role == 4 || $user_role == 5) {
			$this->load->view('utilisateurs/popup_edit_user_roles_4_5', $data);
		} else {
			$this->load->view('utilisateurs/popup_edit_user_roles_1_3', $data);
		}
	}

	public function update_user()
	{
		$user_id = $this->input->post('id_utilisateur');
		$user_role = $this->input->post('id_role');
		
		// Validation des données
		if (empty($user_id) || empty($user_role)) {
			header('Content-Type: application/json');
			echo json_encode(['success' => false, 'message' => 'Données manquantes']);
			return;
		}
		
		// Ajout de la gestion du champ 'actif'
		$actif = $this->input->post('actif');

		// Préparer les données selon le rôle
		if ($user_role == 4 || $user_role == 5) {
			// Pour les rôles 4 et 5 : prénom, nom, identifiant
			$identifiant = $this->input->post('identifiant');
			
			// Vérifier si l'identifiant existe déjà (sauf pour cet utilisateur)
			if ($this->Utilisateur->identifiantExists($identifiant, $user_id)) {
				header('Content-Type: application/json');
				echo json_encode(['success' => false, 'message' => 'Cet identifiant existe déjà']);
				return;
			}
			
			$data = [
				'prenom' => $this->input->post('prenom'),
				'nom' => $this->input->post('nom'),
				'id_role' => $user_role,
				'actif' => ($actif !== null) ? (int)$actif : 1,
			];
			// Ne mettre à jour l'identifiant que si un nouveau est saisi
			if (!empty($identifiant)) {
				$data['identifiant'] = $identifiant; // Stockage en clair
			}
		} else {
			// Pour les rôles 1, 2, 3 : prénom, nom, email, mot de passe
			$email = $this->input->post('email');
			$mot_de_passe = $this->input->post('mot_de_passe');
			
			// Vérifier si l'email existe déjà (sauf pour cet utilisateur)
			if ($this->Utilisateur->emailExists($email, $user_id)) {
				header('Content-Type: application/json');
				echo json_encode(['success' => false, 'message' => 'Cet email existe déjà']);
				return;
			}
			
			$data = [
				'prenom' => $this->input->post('prenom'),
				'nom' => $this->input->post('nom'),
				'email' => $email,
				'id_role' => $user_role,
				'actif' => ($actif !== null) ? (int)$actif : 1,
			];
			// Ne mettre à jour le mot de passe que si un nouveau est saisi
			if (!empty($mot_de_passe)) {
				$data['mot_de_passe'] = password_hash($mot_de_passe, PASSWORD_DEFAULT);
			}
		}
		
		$result = $this->Utilisateur->updateUser($user_id, $data);
		
		// Retourner une réponse JSON
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(['success' => true, 'message' => 'Utilisateur modifié avec succès']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Erreur lors de la modification']);
		}
	}
}


