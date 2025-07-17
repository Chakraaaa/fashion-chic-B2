<style>

	.modal-title {
		text-align: center;
		width: 100%;
		margin: 0 auto;

	}

	.modal-content {
		border: none;
        border-radius: 16px;
		box-shadow: 10px 10px #E4D0AA;
    }
    .modal-header {
        border-radius: 16px 16px 0 0;
        background: #f6f7fb;
        border-bottom: 1px solid #e3e6f0;
		background: linear-gradient(90deg, #ba9b61 0%, #E4D0AA 100%) !important;

	}
    .modal-title {
        color: #2d3651;
        font-weight: 600;
    }
	.form-control:focus, .form-select:focus {
		border-color: #ba9b61;
		box-shadow: 0 0 0 2px #ba9b61;
	}
    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        background: #f9fafb;
    }
    .btn-primary, .btn-primary:focus {
		background-color: #ba9b61; !important;
        border: none;
        color: #fff;
        font-weight: 500;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-primary:hover {
		background-color: #ba9b61; !important;
        color: #fff;
        box-shadow: 0 4px 16px rgba(44, 62, 80, 0.12);
    }
    .btn-secondary {
        border-radius: 8px;
    }
    .modal-footer {
        background: none;
        border : none;
    }
    @media (max-width: 768px) {
        .modal-content {
            padding: 8px;
        }
    }
	.table{

		overflow-y: scroll;
		scrollbar-width: none;              /* Firefox */
		-ms-overflow-style: none;           /* IE 10+ */
	}

	.scroll-container::-webkit-scrollbar {
		display: none;                      /* Chrome, Safari, Edge */
	}
</style>

<div class="modal fade" id="popupAddLot" tabindex="-1" aria-labelledby="popupAddLotLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered">
		<div class="modal-content">
			<form id="formAddLot" action="<?= site_url('lots/saveNewLot') ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title" id="popupAddLotLabel">Créer un nouveau lot</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
				</div>

				<div class="modal-body">

					<div class="mb-3">
						<label for="nom_lot" class="form-label">Nom du lot *</label>
						<input type="text" class="form-control" id="nom_lot" name="nom_lot" required>
					</div>

					<h6>Produits à inclure :</h6>

					<!-- Zone scrollable -->
					<div style="max-height: 400px; overflow-y: auto; border: none; padding: 0.5rem;">
						<table class="table table-sm table-bordered">
							<thead class="table-light">
							<tr>
								<th>Référence</th>
								<th>Nom</th>
								<th>Taille</th>
								<th>couleur</th>
								<th>Quantité disponible</th>
								<th>Quantité à ajouter</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($products as $produit): ?>
								<tr>
									<td><?= htmlspecialchars($produit->reference) ?></td>
									<td><?= htmlspecialchars($produit->nom) ?></td>
									<td><?= htmlspecialchars($produit->taille) ?></td>
									<td><?= htmlspecialchars($produit->couleur) ?></td>
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
