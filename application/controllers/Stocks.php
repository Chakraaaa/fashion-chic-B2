<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Role');
		$this->load->model('Produit');
	}

	public function index() {
		$user = $this->session->userdata('user');

		if (!$user) {
			redirect('login');
		}

		$role = $this->Role->getRoleByUserIdRole($user->id_role);

		$data = [
			'user' => $user,
			'role' => $role,
		];

		if (in_array($role, ['admin', 'gerant', 'commercial'])) {
			$produits = $this->Produit->getAllProduits();
			$data['produits'] = $produits;
			$this->loadView('stocks/admin', $data);
		} elseif ($role === 'preparateur') {
			// Vue spécifique préparateur
			$this->loadView('commandes/preparateur', $data, false);
		} elseif ($role === 'envoyeur') {
			// Vue spécifique envoyeur
			$this->loadView('commandes/envoyeur', $data, false);
		} else {
			show_error("Accès interdit à la gestion des stocks.", 403);
		}
	}

	public function supprimer_quantite() {
		$id_produit = $this->input->post('id_produit');
		$quantite_a_supprimer = $this->input->post('quantite');

		if (!$id_produit || !$quantite_a_supprimer) {
			show_error('Paramètres invalides.', 400);
			return;
		}

		$this->load->model('Produit');
		$produit = $this->Produit->getProduitById($id_produit);

		if (!$produit) {
			show_error('Produit introuvable.', 404);
			return;
		}

		if ($quantite_a_supprimer > $produit->quantite) {
			show_error('Quantité à supprimer trop élevée.', 400);
			return;
		}

		$this->Produit->retirerQuantite($id_produit, $quantite_a_supprimer);

		redirect('stocks');
	}

	public function load_import_popup()
	{
		$this->load->view('stocks/popup_import_stocks');
	}

	public function import_csv()
	{
		$this->load->model('Produit');

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier_csv']) && $_FILES['fichier_csv']['error'] === UPLOAD_ERR_OK) {
			$file = $_FILES['fichier_csv']['tmp_name'];
			$handle = fopen($file, 'r');

			if ($handle === false) {
				show_error("Impossible d'ouvrir le fichier CSV.", 500);
				return;
			}

			$header = fgetcsv($handle, 1000, ",");
			$expectedColumns = [
				'reference','nom','description','categorie','genre','taille','couleur',
				'saison','marque','prix_achat','prix_vente','quantite','seuil_reappro','ean','actif'
			];

			if ($header !== $expectedColumns) {
				show_error("Les colonnes du fichier CSV ne correspondent pas aux colonnes attendues.", 400);
				return;
			}

			while (($row = fgetcsv($handle, 1000, ",")) !== false) {
				$data = array_combine($header, $row);
				$produit_existant = $this->Produit->getByReference($data['reference']);

				if ($produit_existant) {
					$nouvelle_quantite = $produit_existant->quantite + (int)$data['quantite'];
					$this->Produit->updateQuantiteByReference($data['reference'], $nouvelle_quantite);
				} else {
					$this->Produit->insertProduit($data);
				}
			}

			fclose($handle);
			redirect('stocks');
		} else {
			show_error("Aucun fichier CSV n'a été téléchargé.", 400);
		}
	}

	public function export_csv() {
		$this->load->model('Produit');
		$produits = $this->Produit->getAllProduits();
		$filename = 'stocks_export_' . date('Y-m-d_H-i-s') . '.csv';
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		$output = fopen('php://output', 'w');
		fputcsv($output, [
			'reference', 'nom', 'description', 'categorie', 'genre', 'taille', 'couleur',
			'saison', 'marque', 'prix_achat', 'prix_vente', 'quantite',
			'seuil_reappro', 'ean', 'actif', 'date_ajout', 'date_modif'
		]);

		foreach ($produits as $produit) {
			fputcsv($output, [
				$produit->reference,
				$produit->nom,
				$produit->description,
				$produit->categorie,
				$produit->genre,
				$produit->taille,
				$produit->couleur,
				$produit->saison,
				$produit->marque,
				$produit->prix_achat,
				$produit->prix_vente,
				$produit->quantite,
				$produit->seuil_reappro,
				$produit->ean,
				$produit->actif ? '1' : '0',
				$produit->date_ajout,
				$produit->date_modif
			]);
		}

		fclose($output);
		exit;
	}

    /**
     * Affiche la pop-up d'édition d'un produit (AJAX)
     */
    public function load_edit_produit_popup()
    {
        $id = $this->input->get('id_produit');
        if (!$id) {
            show_error('ID produit manquant', 400);
        }
        $this->load->model('Produit');
        $produit = $this->Produit->get_by_id($id);
        if (!$produit) {
            show_error('Produit introuvable', 404);
        }
        $data['produit'] = $produit;
        $this->load->view('stocks/popup_edit_produit', $data);
    }

    /**
     * Traite la soumission du formulaire d'édition de produit
     */
    public function edit_produit()
    {
        $id = $this->input->post('id_produit');
        if (!$id) {
            show_error('ID produit manquant', 400);
        }
        $this->load->model('Produit');
        $data = [
            'nom' => $this->input->post('nom'),
            'reference' => $this->input->post('reference'),
            'categorie' => $this->input->post('categorie'),
            'genre' => $this->input->post('genre'),
            'taille' => $this->input->post('taille'),
            'couleur' => $this->input->post('couleur'),
            'marque' => $this->input->post('marque'),
            'prix_achat' => $this->input->post('prix_achat'),
            'prix_vente' => $this->input->post('prix_vente'),
            'quantite' => $this->input->post('quantite'),
            'seuil_reappro' => $this->input->post('seuil_reappro'),
        ];
        $this->Produit->update($id, $data);
        $this->session->set_flashdata('success', 'Produit modifié avec succès.');
        redirect('stocks');
    }


}
