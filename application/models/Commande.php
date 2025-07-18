<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commande extends CI_Model {
	public function __construct($roleId = null)
	{
		parent::__construct();
	}

	public function getAllCommandes()
	{
		$this->db->select('c.*, cl.nom as nom_client, u.nom as nom_commercial');
		$this->db->from('COMMANDE c');
		$this->db->join('CLIENT cl', 'cl.id_client = c.id_client');
		$this->db->join('UTILISATEUR u', 'u.id_utilisateur = c.id_commercial');
		return $this->db->get()->result();
	}

	// Récupérer toutes les commandes, possibilité de filtrer par préparateur, envoyeur, statut, priorité
	public function getCommandes($filters = [])
	{
		$this->db->select('c.*, cl.nom as nom_client, u.nom as nom_commercial');
		$this->db->from('COMMANDE c');
		$this->db->join('CLIENT cl', 'cl.id_client = c.id_client');
		$this->db->join('UTILISATEUR u', 'u.id_utilisateur = c.id_commercial', 'left');

		if (!empty($filters['id_preparateur'])) {
			$this->db->where('c.id_preparateur', $filters['id_preparateur']);
		}
		if (!empty($filters['id_envoyeur'])) {
			$this->db->where('c.id_envoyeur', $filters['id_envoyeur']);
		}
		if (!empty($filters['statut'])) {
			$this->db->where('c.statut', $filters['statut']);
		}
		if (isset($filters['attribue']) && $filters['attribue'] === false) {
			// Commandes non attribuées à un préparateur ou envoyeur
			$this->db->where('(c.id_preparateur IS NULL OR c.id_envoyeur IS NULL)');
		}
		$this->db->order_by('c.priority_level', 'DESC');
		$this->db->order_by('c.date_commande', 'DESC');
		return $this->db->get()->result();
	}

	// Attribuer un préparateur à une commande
	public function assignerPreparateur($id_commande, $id_preparateur)
	{
		$this->db->where('id_commande', $id_commande);
		return $this->db->update('COMMANDE', ['id_preparateur' => $id_preparateur]);
	}

	// Attribuer un envoyeur à une commande
	public function assignerEnvoyeur($id_commande, $id_envoyeur)
	{
		$this->db->where('id_commande', $id_commande);
		return $this->db->update('COMMANDE', ['id_envoyeur' => $id_envoyeur]);
	}

	// Modifier la priorité d'une commande
	public function setPriority($id_commande, $priority_level)
	{
		$this->db->where('id_commande', $id_commande);
		return $this->db->update('COMMANDE', ['priority_level' => $priority_level]);
	}

	// Modifier le commentaire d'une commande
	public function setCommentaire($id_commande, $commentaire)
	{
		$this->db->where('id_commande', $id_commande);
		return $this->db->update('COMMANDE', ['commentaire' => $commentaire]);
	}

	// Modifier le statut d'une commande
	public function setStatut($id_commande, $statut)
	{
		$commande = $this->getCommandes(['id_commande' => $id_commande]);
		$ancien_statut = $commande && isset($commande[0]->statut) ? $commande[0]->statut : null;
		$this->db->where('id_commande', $id_commande);
		$this->db->update('COMMANDE', ['statut' => $statut]);
		// Log selon le rôle
		$user = $this->session->userdata('user');
		$role = isset($user->id_role) ? $user->id_role : null;
		if ($commande && $role) {
			if ($commande[0]->id_preparateur == $user->id_utilisateur) {
				$this->logPreparateur($user->id_utilisateur, $id_commande, 'statut_modifié', $ancien_statut, $statut);
			} elseif ($commande[0]->id_envoyeur == $user->id_utilisateur) {
				$this->logEnvoyeur($user->id_utilisateur, $id_commande, 'statut_modifié', $ancien_statut, $statut);
			}
		}
	}
	// Modifier le lien de suivi d'une commande
	public function setLienSuivi($id_commande, $lien)
	{
		$this->db->where('id_commande', $id_commande);
		return $this->db->update('COMMANDE', ['lien_suivi' => $lien]);
	}

	// Récupérer les commandes non attribuées à un préparateur ou envoyeur
	public function getCommandesNonAttribuees()
	{
		$this->db->select('c.*, cl.nom as nom_client, u.nom as nom_commercial');
		$this->db->from('COMMANDE c');
		$this->db->join('CLIENT cl', 'cl.id_client = c.id_client');
		$this->db->join('UTILISATEUR u', 'u.id_utilisateur = c.id_commercial', 'left');
		$this->db->where('(c.id_preparateur IS NULL OR c.id_envoyeur IS NULL)');
		$this->db->order_by('c.priority_level', 'DESC');
		$this->db->order_by('c.date_commande', 'DESC');
		return $this->db->get()->result();
	}

	// Génère un numéro de commande unique (ex : CMD20240607-XXXX)
	private function genererNumeroCommande() {
		$date = date('Ymd');
		$random = strtoupper(substr(md5(uniqid(rand(), true)), 0, 4));
		return 'CMD' . $date . '-' . $random;
	}

	// Ajoute une commande avec lots associés
	public function addCommandeAvecLots($data, $lots)
	{
		$this->db->trans_start();
		$data['numero_commande'] = $this->genererNumeroCommande();
		$this->db->insert('COMMANDE', $data);
		$id_commande = $this->db->insert_id();

		// Ajout des lots associés
		foreach ($lots as $lot) {
			$this->db->insert('COMMANDE_LOT', [
				'id_commande' => $id_commande,
				'id_lot' => $lot['id_lot'],
				'quantite' => $lot['quantite']
			]);
		}
		$this->db->trans_complete();
		return $id_commande;
	}

	// Met à jour une commande et ses lots
	public function updateCommandeAvecLots($id_commande, $data, $lots)
	{
		$this->db->trans_start();
		$this->db->where('id_commande', $id_commande);
		$this->db->update('COMMANDE', $data);

		// Suppression des lots existants
		$this->db->where('id_commande', $id_commande);
		$this->db->delete('COMMANDE_LOT');

		// Ajout des nouveaux lots
		foreach ($lots as $lot) {
			$this->db->insert('COMMANDE_LOT', [
				'id_commande' => $id_commande,
				'id_lot' => $lot['id_lot'],
				'quantite' => $lot['quantite']
			]);
		}
		$this->db->trans_complete();
	}

	// Récupère les lots associés à une commande
	public function getLotsByCommande($id_commande)
	{
		$this->db->select('cl.*, l.date_creation');
		$this->db->from('COMMANDE_LOT cl');
		$this->db->join('LOT l', 'l.id_lot = cl.id_lot');
		$this->db->where('cl.id_commande', $id_commande);
		return $this->db->get()->result();
	}

	// Supprime une commande et ses lots associés
	public function deleteCommande($id_commande)
	{
		$this->db->trans_start();
		$this->db->where('id_commande', $id_commande);
		$this->db->delete('COMMANDE_LOT');
		$this->db->where('id_commande', $id_commande);
		$this->db->delete('COMMANDE');
		$this->db->trans_complete();
	}

	public function deleteClientById($id)
	{
		$this->db->where('id_client', $id);
		$this->db->delete('client');
	}

	private function logPreparateur($id_preparateur, $id_commande, $action, $ancien_statut, $nouveau_statut)
	{
		$this->db->insert('log_preparateur', [
			'id_preparateur' => $id_preparateur,
			'id_commande' => $id_commande,
			'action' => $action,
			'ancien_statut' => $ancien_statut,
			'nouveau_statut' => $nouveau_statut
		]);
	}
	private function logEnvoyeur($id_envoyeur, $id_commande, $action, $ancien_statut, $nouveau_statut, $lien_suivi = null)
	{
		$this->db->insert('log_envoyeur', [
			'id_envoyeur' => $id_envoyeur,
			'id_commande' => $id_commande,
			'action' => $action,
			'ancien_statut' => $ancien_statut,
			'nouveau_statut' => $nouveau_statut,
			'lien_suivi' => $lien_suivi
		]);
	}

	public function getCommandeById($id_commande)
	{
		$this->db->select('c.*, cl.nom as nom_client, u.nom as nom_commercial');
		$this->db->from('COMMANDE c');
		$this->db->join('CLIENT cl', 'cl.id_client = c.id_client');
		$this->db->join('UTILISATEUR u', 'u.id_utilisateur = c.id_commercial');
		$this->db->where('c.id_commande', $id_commande);
		$query = $this->db->get();
		return $query->row();
	}


}
