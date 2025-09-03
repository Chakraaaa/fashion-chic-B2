<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lot extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllLots() {
		$this->db->select('id_lot, nom, date_creation');
		$this->db->from('lot');
		$this->db->order_by('date_creation', 'DESC');

		$query = $this->db->get();
		return $query->result();
	}

	public function getContenuLot($id_lot)
	{
		$this->db->select('p.reference, p.nom, p.categorie, p.genre, p.taille, p.couleur, p.marque, p.prix_vente, cl.quantite');
		$this->db->from('contenu_lot cl');
		$this->db->join('produit p', 'cl.id_produit = p.id_produit');
		$this->db->where('cl.id_lot', $id_lot);

		$query = $this->db->get();
		return $query->result();
	}

	public function addLot($data)
	{
		$this->db->insert('lot', $data);
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

		return $this->db->insert('contenu_lot', $data);
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

	public function getLotById($id_lot)
	{
		$this->db->select('id_lot, nom, date_creation');
		$this->db->from('lot');
		$this->db->where('id_lot', $id_lot);
		
		$query = $this->db->get();
		return $query->row();
	}

	public function deleteLotById($id_lot)
	{
		// Démarrer une transaction
		$this->db->trans_start();

		// Supprimer le contenu du lot
		$this->db->where('id_lot', $id_lot);
		$this->db->delete('contenu_lot');

		// Supprimer le lot
		$this->db->where('id_lot', $id_lot);
		$this->db->delete('lot');

		// Terminer la transaction
		$this->db->trans_complete();

		return $this->db->trans_status();
	}

	public function getLotsByCommande($id_commande)
	{
		$this->db->select('cl.id_lot, l.nom, SUM(cl.quantite) as quantite');
		$this->db->from('commande_lot cl');
		$this->db->join('lot l', 'cl.id_lot = l.id_lot');
		$this->db->where('cl.id_commande', $id_commande);
		$this->db->group_by(['cl.id_lot', 'l.nom']);
		$query = $this->db->get();
		return $query->result();
	}
}
