<div class="container mt-4">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="h4 fw-semibold">Liste des stocks</h1>
		<div class="d-flex gap-2">
			<button class="btn btn-primary" id="btn-import-stocks">
				<i class="fas fa-plus me-1"></i> Importer des stocks
			</button>
			<button class="btn btn-primary" id="btn-export-stocks">
				<i class="fas fa-download me-1"></i> Exporter les stocks
			</button>
		</div>
	</div>
</div>

<table class="table table-striped table-hover">
		<thead class="table-light">
		<tr>
			<th>Nom</th>
			<th>Référence</th>
			<th>Taille</th>
			<th>Couleur</th>
			<th>Quantité</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php if (!empty($produits)): ?>
			<?php foreach ($produits as $produit): ?>
				<tr>
					<td><?= htmlspecialchars($produit->nom) ?></td>
					<td><?= htmlspecialchars($produit->reference) ?></td>
					<td><?= htmlspecialchars($produit->taille) ?></td>
					<td><?= htmlspecialchars($produit->couleur) ?></td>
					<td><?= htmlspecialchars($produit->quantite) ?></td>
					<td>
						<button
							class="btn btn-danger btn-sm btn-supprimer-produit"
							data-id="<?= $produit->id_produit ?>"
							data-nom="<?= htmlspecialchars($produit->nom) ?>"
							data-quantite="<?= $produit->quantite ?>">
							Supprimer
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan="6" class="text-center">Aucun produit en stock.</td></tr>
		<?php endif; ?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="popupSupprimerProduit" tabindex="-1" aria-labelledby="popupLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form method="post" action="<?= site_url('stocks/supprimer_quantite') ?>">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Supprimer une quantité</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
				</div>
				<div class="modal-body">
					<p id="info-produit"></p>
					<input type="hidden" name="id_produit" id="id_produit_modal">
					<label for="quantite_select" class="form-label">Quantité à supprimer :</label>
					<select class="form-select" name="quantite" id="quantite_select" required></select>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Confirmer</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div id="popup-import-stocks" style="display: none;"></div>

<script>
	$(document).ready(function () {
		$('#btn-import-stocks').on('click', function (e) {
			e.preventDefault();

			$.ajax({
				url: siteUrl + '/stocks/load_import_popup',
				method: 'GET',
				success: function (data) {
					$('#popup-import-stocks').remove();
					$('body').append(data);

					const popup = new bootstrap.Modal(document.getElementById('popupImportStocks'), {
						backdrop: 'static',
						keyboard: false
					});

					popup.show();

					$('#popup-import-stocks').on('hidden.bs.modal', function () {
						$(this).remove();
					});
				},
				error: function () {
					alert("Erreur lors du chargement de la pop-up d'import.");
				}
			});
		});
	});

	$('#btn-export-stocks').on('click', function () {
		if (confirm("Voulez-vous vraiment exporter les stocks en fichier csv?")) {
			window.location.href = siteUrl + '/stocks/export_csv';
		}
	});

	$(document).on('click', '.btn-supprimer-produit', function () {
		const id = $(this).data('id');
		const nom = $(this).data('nom');
		const quantiteMax = parseInt($(this).data('quantite'));

		$('#id_produit_modal').val(id);
		$('#info-produit').text(`Produit : ${nom} — Stock actuel : ${quantiteMax}`);

		const select = $('#quantite_select');
		select.empty();
		for (let i = 1; i <= quantiteMax; i++) {
			select.append(`<option value="${i}">${i}</option>`);
		}

		const popup = new bootstrap.Modal(document.getElementById('popupSupprimerProduit'));
		popup.show();
	});
</script>
