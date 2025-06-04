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

	public function getUsersByIdRole($roleId)
	{
		$this->db->where('id_role', $roleId);
		return $this->db->get('utilisateur')->result();
	}



}
