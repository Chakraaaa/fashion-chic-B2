<style>
	.modal-content {
		border-radius: 16px;
		box-shadow: 10px 10px #E4D0AA;
		border: none;
		background: #fff;
	}
	.modal-header {
		border-radius: 16px 16px 0 0;
		background: #f6f7fb;
		border-bottom: 1px solid #e3e6f0;
		background: linear-gradient(90deg, #ba9b61 0%, #E4D0AA 100%) !important;

	}
	.modal-title {
		font-weight: 600;
		letter-spacing: 0.5px;
		text-align: center;
		width: 100%;
		margin: 0 auto;
	}
	.form-label {
		color: #2d3651;
		font-weight: 500;
	}
	.form-control, .form-select {
		border-radius: 8px;
		border: 1.5px solid #e3e6f0;
		box-shadow: none;
		transition: border-color 0.2s;
	}
	.form-control:focus, .form-select:focus {
		border-color: #ba9b61;
		box-shadow: 0 0 0 2px #ba9b61;
	}
	.btn-primary, .btn-primary:focus {
		background-color: #ba9b61 !important;
		border: none;
		color: #fff;
		font-weight: 500;
		border-radius: 8px;
		box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
		transition: background 0.2s, box-shadow 0.2s;
	}
	.btn-primary:hover {
		background-color: #c5c1b7;
		color: black;
		box-shadow: 0 4px 16px rgba(44, 62, 80, 0.12);
	}
	.btn-secondary {
		border-radius: 8px;
		background: #f6f7fb;
		color: #2d3651;
		border: none;
		font-weight: 500;
		transition: background 0.2s, color 0.2s;
	}
	.btn-secondary:hover {
		background: #e9edfa;
		color: #2d3651;
	}
	.modal-footer {
		border-top: none;
		border-radius: 0 0 16px 16px;
		background: #fff;
	}
	.form-text.text-muted {
		color: #7b8190 !important;
	}
	@media (max-width: 768px) {
		.modal-dialog {
			max-width: 98vw;
			margin: 1.2rem auto;
		}
		.modal-content {
			padding: 0 2px;
		}
	}
</style>

<div class="modal fade" id="popupEditProduit" tabindex="-1" aria-labelledby="popupEditProduitLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="<?= site_url('stocks/edit_produit') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupEditProduitLabel">Modifier le produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_produit" value="<?= htmlspecialchars($produit->id_produit) ?>">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($produit->nom) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="reference" class="form-label">Référence</label>
                            <input type="text" class="form-control" id="reference" name="reference" value="<?= htmlspecialchars($produit->reference) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="categorie" class="form-label">Catégorie</label>
                            <input type="text" class="form-control" id="categorie" name="categorie" value="<?= htmlspecialchars($produit->categorie) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="genre" class="form-label">Genre</label>
                            <select class="form-select" id="genre" name="genre">
                                <option value="Homme" <?= $produit->genre == 'Homme' ? 'selected' : '' ?>>Homme</option>
                                <option value="Femme" <?= $produit->genre == 'Femme' ? 'selected' : '' ?>>Femme</option>
                                <option value="Enfant" <?= $produit->genre == 'Enfant' ? 'selected' : '' ?>>Enfant</option>
                                <option value="Mixte" <?= $produit->genre == 'Mixte' ? 'selected' : '' ?>>Mixte</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="taille" class="form-label">Taille</label>
                            <input type="text" class="form-control" id="taille" name="taille" value="<?= htmlspecialchars($produit->taille) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="couleur" class="form-label">Couleur</label>
                            <input type="text" class="form-control" id="couleur" name="couleur" value="<?= htmlspecialchars($produit->couleur) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="marque" class="form-label">Marque</label>
                            <input type="text" class="form-control" id="marque" name="marque" value="<?= htmlspecialchars($produit->marque) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="prix_achat" class="form-label">Prix d'achat (€)</label>
                            <input type="number" step="0.01" class="form-control" id="prix_achat" name="prix_achat" value="<?= htmlspecialchars($produit->prix_achat) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="prix_vente" class="form-label">Prix de vente (€)</label>
                            <input type="number" step="0.01" class="form-control" id="prix_vente" name="prix_vente" value="<?= htmlspecialchars($produit->prix_vente) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="quantite" class="form-label">Quantité</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" value="<?= htmlspecialchars($produit->quantite) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="seuil_reappro" class="form-label">Seuil de réapprovisionnement</label>
                            <input type="number" class="form-control" id="seuil_reappro" name="seuil_reappro" value="<?= htmlspecialchars($produit->seuil_reappro) ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </form>
    </div>
</div> 
