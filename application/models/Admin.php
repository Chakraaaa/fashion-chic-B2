<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	// Récupérer tous les utilisateurs avec leur rôle (JOIN)
	public function getAllUsersWithRole() {
		$this->db->select('u.*, r.libelle as nom_role');
		$this->db->from('utilisateur u');
		$this->db->join('role r', 'u.id_role = r.id', 'left');
		$this->db->order_by('u.nom', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}

	// Récupérer un utilisateur avec son rôle par ID (JOIN)
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
}
