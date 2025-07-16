<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getUserByLogins($email, $password) {
		$this->db->where('email', $email);
		$this->db->where('mot_de_passe', $password);
		$query = $this->db->get('utilisateur');

		if ($query->num_rows() === 1) {
			return $query->row();
		}

		return null;
	}

	public function getUserByIdentifiant($identifiant) {
		// Récupérer tous les utilisateurs avec identifiant
		$this->db->where('identifiant IS NOT NULL');
		$query = $this->db->get('utilisateur');
		$utilisateurs = $query->result();
		
		// Vérifier si l'identifiant correspond en utilisant password_verify
		foreach ($utilisateurs as $utilisateur) {
			if ($identifiant === $utilisateur->identifiant) {
				return $utilisateur;
			}
		}
		return null;
	}
	public function getUsersByIdRole($roleId)
	{
		$this->db->where('id_role', $roleId);
		return $this->db->get('utilisateur')->result();
	}

	public function getAllUsersWithRole() {
		$this->db->select('u.*, r.libelle as nom_role');
		$this->db->from('utilisateur u');
		$this->db->join('role r', 'u.id_role = r.id_role', 'left');
		$this->db->order_by('u.nom', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}

	public function getUserWithRoleById($id) {
		$this->db->select('u.*, r.libelle as nom_role');
		$this->db->from('utilisateur u');
		$this->db->join('role r', 'u.id_role = r.id', 'left');
		$this->db->where('u.id_utilisateur', $id);
		$query = $this->db->get();

		if ($query->num_rows() === 1) {
			return $query->row();
		}
		return null;
	}

	// Récupérer un utilisateur par son ID
	public function getUserById($id) {
		$this->db->where('id_utilisateur', $id);
		$query = $this->db->get('utilisateur');

		if ($query->num_rows() === 1) {
			return $query->row();
		}
		return null;
	}
	// Récupérer tous les utilisateurs (sans JOIN)
	public function getAllUsers() {
		$this->db->order_by('nom', 'ASC');
		$query = $this->db->get('utilisateur');
		return $query->result();
	}

	// Créer un nouvel utilisateur
	public function createUser($userData) {
		if ($this->db->insert('utilisateur', $userData)) {
			return $this->db->insert_id();
		}
		return false;
	}

	// Modifier un utilisateur
	public function updateUser($id, $userData) {
		$this->db->where('id_utilisateur', $id);
		return $this->db->update('utilisateur', $userData);
	}

	public function deleteUser($id) {
		$this->db->where('id_utilisateur', $id);
		return $this->db->delete('utilisateur');
	}

	// Vérifier si un email existe déjà (pour éviter les doublons)
	public function emailExists($email, $excludeId = null) {
		$this->db->where('email', $email);
		if ($excludeId) {
			$this->db->where('id_utilisateur !=', $excludeId);
		}
		$query = $this->db->get('utilisateur');
		return $query->num_rows() > 0;
	}

	// Vérifier si un identifiant existe déjà (pour éviter les doublons)
	public function identifiantExists($identifiant, $excludeId = null) {
		// Récupérer tous les utilisateurs avec identifiant
		$this->db->select('identifiant');
		if ($excludeId) {
			$this->db->where('id_utilisateur !=', $excludeId);
		}
		$query = $this->db->get('utilisateur');
		$utilisateurs = $query->result();
		
		// Vérifier si l'identifiant existe en comparant avec password_verify
		foreach ($utilisateurs as $utilisateur) {
			if (!empty($utilisateur->identifiant) && is_string($utilisateur->identifiant)) {
				if ($identifiant === $utilisateur->identifiant) {
					return true;
				}
			}
		}
		return false;
	}

	public function addUser($data)
	{
		return $this->db->insert('utilisateur', $data);
	}


	// Retourne tous les utilisateurs ayant le rôle commercial
	public function getCommerciaux() {
		$this->db->select('u.*');
		$this->db->from('utilisateur u');
		$this->db->join('role r', 'u.id_role = r.id_role');
		$this->db->where('LOWER(r.libelle)', 'commercial');
		return $this->db->get()->result();
	}

	// Récupérer un utilisateur par son email (pour vérification du mot de passe haché)
	public function getUserByEmail($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('utilisateur');
		if ($query->num_rows() === 1) {
			return $query->row();
		}
		return null;
	}


}
