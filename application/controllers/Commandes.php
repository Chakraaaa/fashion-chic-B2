<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commandes extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Role');
		$this->load->model('Commande');
		$this->load->model('Client');
		$this->load->model('Utilisateur');
		$this->load->model('Lot');
	}

	public function index()
	{
		$user = $this->session->userdata('user');

		if (!$user) {
			redirect('login');
		}

		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$data = [
			'user' => $user,
			'role' => $role,
		];

		if (in_array($role, ['admin', 'gerant'])) {
			// Gestion des filtres
			$filters = [];
			if ($this->input->get('filtre_non_attribue')) {
				$filters['attribue'] = false;
			}
			if ($this->input->get('filtre_preparateur')) {
				$filters['id_preparateur'] = $this->input->get('filtre_preparateur');
			}
			if ($this->input->get('filtre_envoyeur')) {
				$filters['id_envoyeur'] = $this->input->get('filtre_envoyeur');
			}
			if ($this->input->get('filtre_priorite')) {
				$filters['priority_level'] = $this->input->get('filtre_priorite');
			}
			$commandes = $this->Commande->getCommandes($filters);
			$data['commandes'] = $commandes;
			$data['preparateurs'] = $this->Utilisateur->getUsersByIdRole(4); 
			$data['envoyeurs'] = $this->Utilisateur->getUsersByIdRole(5); 
			$this->loadView('commandes/admin', $data);
		}
		elseif ($role === 'commercial') {
			$commandes = $this->Commande->getCommandes(['id_commercial' => $user->id_utilisateur]);
			$data['commandes'] = $commandes;
			$this->loadView('commandes/commercial', $data);
		}
		else {
			show_error("Accès interdit à la gestion des commandes.", 403);
		}
	}

	// Affichage des commandes pour le préparateur
	public function preparateur()
	{
		$user = $this->session->userdata('user');
		if (!$user) redirect('login');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		if (strtolower($role) !== 'preparateur') {
			show_error("Accès interdit à la page préparateur.", 403);
		}
		$commandes = $this->Commande->getCommandes(['id_preparateur' => $user->id_utilisateur]);
		$data = ['commandes' => $commandes];
		$this->loadView('commandes/preparateur', $data, false);
	}

	// Affichage des commandes pour l'envoyeur
	public function envoyeur()
	{
		$user = $this->session->userdata('user');
		if (!$user) redirect('login');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		if (strtolower($role) !== 'envoyeur') {
			show_error("Accès interdit à la page envoyeur.", 403);
		}
		$commandes = $this->Commande->getCommandes(['id_envoyeur' => $user->id_utilisateur]);
		$data = ['commandes' => $commandes];
		$this->loadView('commandes/envoyeur', $data);
	}

	// Actions préparateur
	public function demarrer_preparation($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandes(['id_commande' => $id_commande]);
		if (strtolower($role) !== 'preparateur') {
			show_error("Accès interdit.", 403);
		}
		if (empty($commande) || $commande[0]->id_preparateur != $user->id_utilisateur) {
			show_error("Vous ne pouvez pas agir sur cette commande.", 403);
		}
		$this->Commande->setStatut($id_commande, 'En préparation');
		redirect('commandes/preparateur');
	}
	public function valider_preparation($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandes(['id_commande' => $id_commande]);
		if (strtolower($role) !== 'preparateur') {
			show_error("Accès interdit.", 403);
		}
		if (empty($commande) || $commande[0]->id_preparateur != $user->id_utilisateur) {
			show_error("Vous ne pouvez pas agir sur cette commande.", 403);
		}
		$this->Commande->setStatut($id_commande, 'Prête à envoyer');
		redirect('commandes/preparateur');
	}
	public function passer_en_erreur($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandes(['id_commande' => $id_commande]);
		$isPrep = (strtolower($role) === 'preparateur') && !empty($commande) && $commande[0]->id_preparateur == $user->id_utilisateur;
		$isEnv = (strtolower($role) === 'envoyeur') && !empty($commande) && $commande[0]->id_envoyeur == $user->id_utilisateur;
		if (!$isPrep && !$isEnv) {
			show_error("Vous ne pouvez pas agir sur cette commande.", 403);
		}
		$this->Commande->setStatut($id_commande, 'Erreur');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function modifier_commentaire_preparateur($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandes(['id_commande' => $id_commande]);
		if (strtolower($role) !== 'preparateur') {
			show_error("Accès interdit.", 403);
		}
		if (empty($commande) || $commande[0]->id_preparateur != $user->id_utilisateur) {
			show_error("Vous ne pouvez pas agir sur cette commande.", 403);
		}
		$commentaire = $this->input->post('commentaire');
		$this->Commande->setCommentaire($id_commande, $commentaire);
		redirect('commandes/preparateur');
	}
	// Actions envoyeur
	public function demarrer_envoi($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandes(['id_commande' => $id_commande]);
		if (strtolower($role) !== 'envoyeur') {
			show_error("Accès interdit.", 403);
		}
		if (empty($commande) || $commande[0]->id_envoyeur != $user->id_utilisateur) {
			show_error("Vous ne pouvez pas agir sur cette commande.", 403);
		}
		// Générer un lien de suivi fictif et unique (ex: www.ups.com/track/XXXXXXXXXXXX)
		$uniquePart = substr(strtoupper(md5(uniqid((string)$id_commande, true))), 0, 12);
		$lienFictif = 'https://www.ups.com/track/' . $uniquePart;
		$this->Commande->setLienSuivi($id_commande, $lienFictif);
		$this->Commande->setStatut($id_commande, 'Prête à livrer');
		redirect('commandes/envoyeur');
	}
	public function valider_envoi($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandes(['id_commande' => $id_commande]);
		if (strtolower($role) !== 'envoyeur') {
			show_error("Accès interdit.", 403);
		}
		if (empty($commande) || $commande[0]->id_envoyeur != $user->id_utilisateur) {
			show_error("Vous ne pouvez pas agir sur cette commande.", 403);
		}
		$this->Commande->setStatut($id_commande, 'Livrée');
		redirect('commandes/envoyeur');
	}
	public function modifier_commentaire_envoyeur($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandes(['id_commande' => $id_commande]);
		if (strtolower($role) !== 'envoyeur') {
			show_error("Accès interdit.", 403);
		}
		if (empty($commande) || $commande[0]->id_envoyeur != $user->id_utilisateur) {
			show_error("Vous ne pouvez pas agir sur cette commande.", 403);
		}
		$commentaire = $this->input->post('commentaire');
		$this->Commande->setCommentaire($id_commande, $commentaire);
		redirect('commandes/envoyeur');
	}
	public function modifier_lien_suivi($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandes(['id_commande' => $id_commande]);
		if (strtolower($role) !== 'envoyeur') {
			show_error("Accès interdit.", 403);
		}
		if (empty($commande) || $commande[0]->id_envoyeur != $user->id_utilisateur) {
			show_error("Vous ne pouvez pas agir sur cette commande.", 403);
		}
		$lien = $this->input->post('lien_suivi');
		$this->Commande->setLienSuivi($id_commande, $lien);
		redirect('commandes/envoyeur');
	}

	// Charge la popup d'ajout de commande
	public function load_add_commande_popup()
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		
		$data['user'] = $user;
		$data['role'] = $role;
		$data['clients'] = ($role === 'commercial') ? $this->Client->getClientsByCommercialId($user->id_utilisateur) : $this->Client->getAllClients();
		$data['commerciaux'] = ($role === 'commercial') ? [] : $this->Utilisateur->getCommerciaux();
		$data['lots'] = $this->Lot->getAllLots();
		
		// Récupérer les IDs de rôle pour préparateur et envoyeur
		$idRolePreparateur = $this->Role->getIdByRoleName('preparateur');
		$idRoleEnvoyeur = $this->Role->getIdByRoleName('envoyeur');
		
		$data['preparateurs'] = $idRolePreparateur ? $this->Utilisateur->getUsersByIdRole($idRolePreparateur) : [];
		$data['envoyeurs'] = $idRoleEnvoyeur ? $this->Utilisateur->getUsersByIdRole($idRoleEnvoyeur) : [];
		
		$this->load->view('commandes/popup_add_commande', $data);
	}

	// Charge la popup d'édition de commande
	public function load_edit_commande_popup($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandeById($id_commande);
		if ($role === 'commercial' && $commande->id_commercial != $user->id_utilisateur) {
			show_error("Accès interdit à cette commande.", 403);
		}
		$lots_commande = $this->Commande->getLotsByCommande($id_commande);
		
		$data['commande'] = $commande;
		$data['lots_commande'] = $lots_commande;
		$data['clients'] = $this->Client->getAllClients();
		$data['commerciaux'] = $this->Utilisateur->getCommerciaux();
		$data['lots'] = $this->Lot->getAllLots();
		
		// Récupérer les IDs de rôle pour préparateur et envoyeur
		$idRolePreparateur = $this->Role->getIdByRoleName('preparateur');
		$idRoleEnvoyeur = $this->Role->getIdByRoleName('envoyeur');
		
		$data['preparateurs'] = $idRolePreparateur ? $this->Utilisateur->getUsersByIdRole($idRolePreparateur) : [];
		$data['envoyeurs'] = $idRoleEnvoyeur ? $this->Utilisateur->getUsersByIdRole($idRoleEnvoyeur) : [];
		
		$this->load->view('commandes/popup_edit_commande', $data);
	}

	// Sauvegarde une nouvelle commande
	public function saveNewCommande()
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$data = [
			'id_client' => $this->input->post('id_client'),
			'id_commercial' => ($role === 'commercial') ? $user->id_utilisateur : $this->input->post('id_commercial'),
			'date_commande' => $this->input->post('date_commande'),
			'statut' => $this->input->post('statut'),
			'cout_total' => 0, // Sera calculé plus tard
			'id_preparateur' => $this->input->post('id_preparateur'),
			'id_envoyeur' => $this->input->post('id_envoyeur'),
			'commentaire' => $this->input->post('commentaire'),
			'priority_level' => $this->input->post('priority_level') ? $this->input->post('priority_level') : 1
		];

		// Récupération des lots sélectionnés
		$lots = [];
		$lots_post = $this->input->post('lots');
		if ($lots_post) {
			foreach ($lots_post as $id_lot => $lot_data) {
				if (isset($lot_data['selected']) && $lot_data['selected'] == 1) {
					$lots[] = [
						'id_lot' => $id_lot,
						'quantite' => $lot_data['quantite']
					];
				}
			}
		}

		if (empty($lots)) {
			$this->session->set_flashdata('error', 'Veuillez sélectionner au moins un lot.');
			redirect('commandes');
		}

		$id_commande = $this->Commande->addCommandeAvecLots($data, $lots);
		
		if ($id_commande) {
			$this->session->set_flashdata('success', 'Commande créée avec succès.');
		} else {
			$this->session->set_flashdata('error', 'Erreur lors de la création de la commande.');
		}
		
		redirect('commandes');
	}

	// Met à jour une commande existante
	public function updateCommande($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandeById($id_commande);
		if ($role === 'commercial' && $commande->id_commercial != $user->id_utilisateur) {
			show_error("Accès interdit à cette commande.", 403);
		}
		$data = [
			'id_client' => $this->input->post('id_client'),
			'id_commercial' => ($role === 'commercial') ? $user->id_utilisateur : $this->input->post('id_commercial'),
			'date_commande' => $this->input->post('date_commande'),
			'statut' => $this->input->post('statut'),
			'id_preparateur' => $this->input->post('id_preparateur'),
			'id_envoyeur' => $this->input->post('id_envoyeur'),
			'commentaire' => $this->input->post('commentaire'),
			'priority_level' => $this->input->post('priority_level') ? $this->input->post('priority_level') : 1
		];

		// Récupération des lots sélectionnés
		$lots = [];
		$lots_post = $this->input->post('lots');
		if ($lots_post) {
			foreach ($lots_post as $id_lot => $lot_data) {
				if (isset($lot_data['selected']) && $lot_data['selected'] == 1) {
					$lots[] = [
						'id_lot' => $id_lot,
						'quantite' => $lot_data['quantite']
					];
				}
			}
		}

		if (empty($lots)) {
			$this->session->set_flashdata('error', 'Veuillez sélectionner au moins un lot.');
			redirect('commandes');
		}

		$result = $this->Commande->updateCommandeAvecLots($id_commande, $data, $lots);
		
		if ($result) {
			$this->session->set_flashdata('success', 'Commande mise à jour avec succès.');
		} else {
			$this->session->set_flashdata('error', 'Erreur lors de la mise à jour de la commande.');
		}
		
		redirect('commandes');
	}

	// Supprime une commande
	public function delete($id_commande)
	{
		$user = $this->session->userdata('user');
		$role = $this->Role->getRoleByUserIdRole($user->id_role);
		$commande = $this->Commande->getCommandeById($id_commande);
		if ($role === 'commercial' && $commande->id_commercial != $user->id_utilisateur) {
			show_error("Accès interdit à cette commande.", 403);
		}
		$result = $this->Commande->deleteCommande($id_commande);
		
		if ($result) {
			$this->session->set_flashdata('success', 'Commande supprimée avec succès.');
		} else {
			$this->session->set_flashdata('error', 'Erreur lors de la suppression de la commande.');
		}
		
		redirect('commandes');
	}

	public function load_contenu_commande($id_commande)
	{
		$this->load->model('Lot');
		$lots_commande = $this->Lot->getLotsByCommande($id_commande);
		$data = [
			'lots_commande' => $lots_commande
		];
		$this->load->view('commandes/popup_contenu_commande', $data);
	}

	// Nouvelle version pour préparateur: liste des produits agrégés par commande avec cases à cocher
	public function load_contenu_commande_preparateur($id_commande)
	{
		$this->load->model('Lot');
		// Récupère les lots de la commande (avec quantités de lots)
		$lots_commande = $this->Lot->getLotsByCommande($id_commande);

		// Agrège les produits: pour chaque lot, multiplie la quantité du produit dans le lot par la quantité de ce lot dans la commande
		$produits_agreges = [];
		foreach ($lots_commande as $lot) {
			$contenu_lot = $this->Lot->getContenuLot($lot->id_lot);
			$quantite_lot_dans_commande = (int) $lot->quantite;
			foreach ($contenu_lot as $p) {
				$key = $p->reference;
				$quantite_calculee = ((int) $p->quantite) * $quantite_lot_dans_commande;
				if (!isset($produits_agreges[$key])) {
					$produits_agreges[$key] = (object) [
						'reference' => $p->reference,
						'nom' => $p->nom,
						'categorie' => $p->categorie,
						'genre' => $p->genre,
						'taille' => $p->taille,
						'couleur' => $p->couleur,
						'marque' => $p->marque,
						'quantite' => 0
					];
				}
				$produits_agreges[$key]->quantite += $quantite_calculee;
			}
		}

		$data = [
			'produits_commande' => array_values($produits_agreges)
		];

		$this->load->view('commandes/popup_contenu_commande_preparateur', $data);
	}

}
