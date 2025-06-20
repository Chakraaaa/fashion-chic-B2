<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lot extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllLots() {
		$this->db->select('id, date_creation');
		$this->db->from('LOT');
		$this->db->order_by('date_creation', 'DESC');

		$query = $this->db->get();
		return $query->result();
	}

	public function getContenuLot($id_lot)
	{
		$this->db->select('p.reference, p.nom, cl.quantite');
		$this->db->from('CONTENU_LOT cl');
		$this->db->join('PRODUIT p', 'cl.id_produit = p.id_produit');
		$this->db->where('cl.id_lot', $id_lot);

		$query = $this->db->get();
		return $query->result();
	}

	public function addLot($data)
	{
		$this->db->insert('LOT', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		return false;
	}

	public function addProduitToLot($id_lot, $id_produit, $quantite)
	{
		$data = [
			'id_lot' => $id_lot,
			'id_produit' => $id_produit,
			'quantite' => $quantite
		];

		return $this->db->insert('CONTENU_LOT', $data);
	}

	public function saveNewLot($produits)
	{
		$dataLot = [
			'date_creation' => date('Y-m-d'),
		];

		$idLot = $this->addLot($dataLot);
		if (!$idLot) {
			return false;
		}

		foreach ($produits as $idProduit => $quantite) {
			if ($quantite > 0) {
				$this->addProduitToLot($idLot, $idProduit, $quantite);
			}
		}

		return $idLot;
	}
}
