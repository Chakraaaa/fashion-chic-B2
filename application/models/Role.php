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

}
