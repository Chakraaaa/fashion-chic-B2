<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Model {

	public $roleId;

	public function __construct($roleId = null)
	{
		parent::__construct();
		$this->roleId = $roleId;
	}


	public function getRoleByUserIdRole($roleId) {
		$this->db->select('libelle');
		$this->db->where('id', $roleId);
		$query = $this->db->get('role');

		if ($query->num_rows() === 1) {
			return $query->row()->libelle;
		}

		return null;
	}
	// Récupérer tous les rôles
	public function getAllRoles() {
		$this->db->order_by('libelle', 'ASC');
		$query = $this->db->get('role');
		return $query->result();
	}

	// Récupérer un rôle par son ID
	public function getRoleById($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('role');

		if ($query->num_rows() === 1) {
			return $query->row();
		}
		return null;
	}

	public function getIdByRoleName($roleName)
	{
		$query = $this->db->get_where('role', ['libelle' => $roleName]);
		$role = $query->row();

		return $role ? $role->id : null;
	}


}
