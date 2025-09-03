<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getAllProduits() {
		return $this->db->get('PRODUIT')->result();
	}

	public function getProduitById($id) {
		$this->db->where('id_produit', $id);
		return $this->db->get('PRODUIT')->row();
	}

	public function retirerQuantite($id, $quantite) {
		$this->db->set('quantite', 'quantite - ' . (int) $quantite, false);
		$this->db->where('id_produit', $id);
		$this->db->update('PRODUIT');
	}

	public function getByReference($reference)
	{
		return $this->db->get_where('PRODUIT', ['reference' => $reference])->row();
	}

	public function updateQuantiteByReference($reference, $quantite)
	{
		$this->db->where('reference', $reference);
		$this->db->update('PRODUIT', ['quantite' => $quantite]);
	}

	public function insertProduit($data)
	{
		$this->db->insert('PRODUIT', $data);
	}

	// Alias pour compatibilité avec le contrôleur
	public function get_by_id($id) {
		return $this->getProduitById($id);
	}

	// Mise à jour générique d'un produit par son id
	public function update($id, $data) {
		$this->db->where('id_produit', $id);
		return $this->db->update('PRODUIT', $data);
	}

}
