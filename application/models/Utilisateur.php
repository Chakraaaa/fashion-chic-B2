<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	// Pour le formulaire
	public function getUserByLogins($email, $password) {
		$this->db->where('email', $email);
		$this->db->where('mot_de_passe', $password);
		$query = $this->db->get('utilisateur');

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

// Supprimer un utilisateur
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

}
