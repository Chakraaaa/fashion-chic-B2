<div class="modal fade" id="popupAddLot" tabindex="-1" aria-labelledby="popupAddLotLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered">
		<div class="modal-content">
			<form id="formAddLot" action="<?= site_url('lots/saveNewLot') ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title" id="popupAddLotLabel">Créer un nouveau lot</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
				</div>

				<div class="modal-body">

					<h6>Produits à inclure :</h6>

					<!-- Zone scrollable -->
					<div style="max-height: 400px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: .25rem; padding: 0.5rem;">
						<table class="table table-sm table-bordered">
							<thead class="table-light">
							<tr>
								<th>Référence</th>
								<th>Nom</th>
								<th>Quantité disponible</th>
								<th>Quantité à ajouter</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($products as $produit): ?>
								<tr>
									<td><?= htmlspecialchars($produit->reference) ?></td>
									<td><?= htmlspecialchars($produit->nom) ?></td>
									<td><?= (int)$produit->quantite ?></td>
									<td>
										<input type="number" name="quantites[<?= $produit->id_produit ?>]" class="form-control form-control-sm" min="0" max="<?= (int)$produit->quantite ?>">
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Créer le lot</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
				</div>
			</form>
		</div>
	</div>
</div>
