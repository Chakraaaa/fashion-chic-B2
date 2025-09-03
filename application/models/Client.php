<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Model {
	public function __construct($roleId = null)
	{
		parent::__construct();
	}

	public function getAllClients()
	{
		$this->db->select('CLIENT.*, UTILISATEUR.nom as nom_commercial, UTILISATEUR.prenom as prenom_commercial');
		$this->db->from('CLIENT');
		$this->db->join('UTILISATEUR', 'CLIENT.id_commercial = UTILISATEUR.id_utilisateur', 'left');
		return $this->db->get()->result();
	}

	public function addClient($data)
	{
		return $this->db->insert('CLIENT', $data);
	}

	public function deleteClientById($id)
	{
		$this->db->where('id_client', $id);
		$this->db->delete('CLIENT');
	}

	public function getClientsByCommercialId($idCommercial)
	{
		$this->db->select('CLIENT.*, UTILISATEUR.nom as nom_commercial, UTILISATEUR.prenom as prenom_commercial');
		$this->db->from('CLIENT');
		$this->db->join('UTILISATEUR', 'CLIENT.id_commercial = UTILISATEUR.id_utilisateur', 'left');
		$this->db->where('CLIENT.id_commercial', $idCommercial);
		return $this->db->get()->result();
	}

	public function getClientById($id)
	{
		$this->db->where('id_client', $id);
		return $this->db->get('CLIENT')->row();
	}


}
