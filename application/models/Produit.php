<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getAllProduits() {
		return $this->db->get('produit')->result();
	}

	public function getProduitById($id) {
		$this->db->where('id_produit', $id);
		return $this->db->get('produit')->row();
	}

	public function retirerQuantite($id, $quantite) {
		$this->db->set('quantite', 'quantite - ' . (int) $quantite, false);
		$this->db->where('id_produit', $id);
		$this->db->update('produit');
	}

	public function getByReference($reference)
	{
		return $this->db->get_where('produit', ['reference' => $reference])->row();
	}

	public function updateQuantiteByReference($reference, $quantite)
	{
		$this->db->where('reference', $reference);
		$this->db->update('produit', ['quantite' => $quantite]);
	}

	public function insertProduit($data)
	{
		$this->db->insert('produit', $data);
	}

}
