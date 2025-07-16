<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Model {
	public function __construct($roleId = null)
	{
		parent::__construct();
	}

	public function getAllClients()
	{
		$this->db->select('client.*, utilisateur.nom as nom_commercial, utilisateur.prenom as prenom_commercial');
		$this->db->from('client');
		$this->db->join('utilisateur', 'client.id_commercial = utilisateur.id_utilisateur', 'left');
		return $this->db->get()->result();
	}

	public function addClient($data)
	{
		return $this->db->insert('client', $data);
	}

	public function deleteClientById($id)
	{
		$this->db->where('id_client', $id);
		$this->db->delete('client');
	}

	public function getClientsByCommercialId($idCommercial)
	{
		$this->db->select('client.*, utilisateur.nom as nom_commercial, utilisateur.prenom as prenom_commercial');
		$this->db->from('client');
		$this->db->join('utilisateur', 'client.id_commercial = utilisateur.id_utilisateur', 'left');
		$this->db->where('client.id_commercial', $idCommercial);
		return $this->db->get()->result();
	}


}
