<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lots extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Role');
	}

	public function index() {
		$this->load->model('Lot');
		$this->load->model('Role');
		$user = $this->session->userdata('user');
		$lots = $this->Lot->getAllLots();

		if (!$user) {
			redirect('login');
		}

		$role = $this->Role->getRoleByUserIdRole($user->id_role);

		$data = [
			'user' => $user,
			'role' => $role,
			'lots' => $lots
		];

		$this->loadView('lots/admin.php', $data);

	}

	public function load_add_lot_popup()
	{
		$this->load->model('Produit');
		$products = $this->Produit->getAllProduits();
		$data = ['products' => $products];
		$this->load->view('lots/popup_add_lot', $data);
	}

	public function saveNewLot()
	{
		$this->load->model('Lot');
		$this->load->model('Produit');
		$quantities = $this->input->post('quantites');
		$filteredQuantities = [];
		foreach ($quantities as $idProduit => $qty) {
			$qty = (int)$qty;
			if ($qty > 0) {
				$filteredQuantities[$idProduit] = $qty;
			}
		}

		if (empty($filteredQuantities)) {
			show_error("Au moins un produit doit avoir une quantité supérieure à zéro.", 400);
		}

		foreach ($filteredQuantities as $idProduit => $qty) {
			$product = $this->Produit->getProduitById($idProduit);
			if (!$product) {
				show_error("Produit introuvable : $idProduit", 400);
			}
			if ($qty > $product->quantite) {
				show_error("Quantité demandée pour le produit {$product->reference} dépasse le stock disponible.", 400);
			}
		}

		$nom_lot = $this->input->post('nom_lot');
		if (empty($nom_lot)) {
			show_error("Le nom du lot est obligatoire.", 400);
		}

		$lotData = [
			'nom' => $nom_lot,
			'date_creation' => date('Y-m-d'),
		];
		$idLot = $this->Lot->addLot($lotData);

		if (!$idLot) {
			show_error("Erreur lors de la création du lot.", 500);
		}

		foreach ($filteredQuantities as $idProduit => $qty) {
			$this->Lot->addProduitToLot($idLot, $idProduit, $qty);
			$this->Produit->retirerQuantite($idProduit, $qty);
		}

		redirect('lots');
	}


	public function delete($id) {
		$this->load->model('Lot');
		$this->Lot->deleteLotById($id);
	}

	public function load_contenu_lot($id_lot)
	{
		$this->load->model('Lot');
		$this->load->model('Produit');

		$contenu = $this->Lot->getContenuLot($id_lot);
		$lot = $this->Lot->getLotById($id_lot);

		if (!$contenu) {
			show_error("Aucun contenu trouvé pour ce lot.", 404);
		}

		$data = [
			'id_lot' => $id_lot,
			'nom_lot' => $lot->nom,
			'contenu' => $contenu
		];

		$this->load->view('lots/popup_contenu_lot', $data);
	}

}
