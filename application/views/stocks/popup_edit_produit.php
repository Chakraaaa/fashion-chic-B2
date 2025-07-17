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