<style>
    body {
        background: #f6f7fb;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }
    .main-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(44, 62, 80, 0.08);
        padding: 32px 28px 24px 28px;
        margin-bottom: 32px;
    }
    .h4, h1, h2, h3 {
        color: #2d3651;
        letter-spacing: 0.5px;
    }
    .btn-primary, .btn-primary:focus {
        background: linear-gradient(90deg, #2d3651 0%, #667eea 100%);
        border: none;
        color: #fff;
        font-weight: 500;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #667eea 0%, #2d3651 100%);
        color: #fff;
        box-shadow: 0 4px 16px rgba(44, 62, 80, 0.12);
    }
    .btn-danger {
        border-radius: 8px;
    }
    .table {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(44, 62, 80, 0.06);
        background: #fff;
    }
    .table thead th {
        background: linear-gradient(90deg, #667eea 0%, #2d3651 100%);
        color: #fff;
        font-weight: 600;
        border: none;
        padding: 16px 12px;
        letter-spacing: 0.5px;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f6f7fb;
    }
    .table-hover tbody tr:hover {
        background-color: #e9edfa;
        transition: background-color 0.2s;
    }
    .modal-content {
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(44, 62, 80, 0.12);
    }
    .modal-header {
        border-radius: 16px 16px 0 0;
        background: #f6f7fb;
        border-bottom: 1px solid #e3e6f0;
    }
    .modal-title {
        color: #2d3651;
        font-weight: 600;
    }
    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        background: #f9fafb;
    }
    .btn-close {
        filter: grayscale(1);
    }
    .alert {
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 1rem;
    }
    .text-center {
        color: #7b8190;
    }
    @media (max-width: 768px) {
        .main-card {
            padding: 16px 6px 12px 6px;
        }
        .table {
            font-size: 0.95rem;
        }
    }
    .table tbody tr {
        transition: box-shadow 0.2s, background 0.2s, border-left 0.2s;
        border-left: 4px solid transparent;
    }
    .table tbody tr:hover {
        background: #f0f4ff;
        box-shadow: 0 2px 12px rgba(102, 126, 234, 0.10);
        border-left: 4px solid #667eea;
    }
    .table tbody tr {
        border-bottom: 1.5px solid #e3e6f0;
    }
    .btn-action {
        border-radius: 8px;
        font-weight: 500;
        padding: 6px 14px;
        margin-right: 4px;
        box-shadow: 0 1px 4px rgba(44, 62, 80, 0.08);
        transition: transform 0.15s, box-shadow 0.15s;
        font-size: 1rem;
    }
    .btn-action:hover {
        transform: scale(1.08);
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.18);
        opacity: 0.92;
    }
    .btn-supprimer-produit {
        background: linear-gradient(90deg, #e74c3c 0%, #ff7675 100%);
        color: #fff;
        border: none;
    }
    .btn-supprimer-produit:hover {
        background: linear-gradient(90deg, #ff7675 0%, #e74c3c 100%);
        color: #fff;
    }
</style>

<div class="container mt-4">
	<div class="main-card">
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

		<table class="table table-striped table-hover">
			<thead class="table-light">
			<tr>
				<th>Nom</th>
				<th>Référence</th>
				<th>Catégorie</th>
				<th>Genre</th>
				<th>Taille</th>
				<th>Couleur</th>
				<th>Marque</th>
				<th>Prix achat</th>
				<th>Prix vente</th>
				<th>Quantité</th>
				<th>Seuil réappro</th>
				<th>Date ajout</th>
				<th>Date modif</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php if (!empty($produits)): ?>
				<?php foreach ($produits as $produit): ?>
					<tr>
						<td><?= htmlspecialchars($produit->nom) ?></td>
						<td><?= htmlspecialchars($produit->reference) ?></td>
						<td><?= htmlspecialchars($produit->categorie) ?></td>
						<td><?= htmlspecialchars($produit->genre) ?></td>
						<td><?= htmlspecialchars($produit->taille) ?></td>
						<td><?= htmlspecialchars($produit->couleur) ?></td>
						<td><?= htmlspecialchars($produit->marque) ?></td>
						<td><?= isset($produit->prix_achat) ? number_format($produit->prix_achat, 2, ',', ' ') . ' €' : '' ?></td>
						<td><?= isset($produit->prix_vente) ? number_format($produit->prix_vente, 2, ',', ' ') . ' €' : '' ?></td>
						<td><?= htmlspecialchars($produit->quantite) ?></td>
						<td><?= htmlspecialchars($produit->seuil_reappro) ?></td>
						<td><?= isset($produit->date_ajout) ? date('d/m/Y H:i', strtotime($produit->date_ajout)) : '' ?></td>
						<td><?= isset($produit->date_modif) ? date('d/m/Y H:i', strtotime($produit->date_modif)) : '' ?></td>
						<td>
							<!-- Bouton édition (texte simple) -->
							<button
								class="btn btn-action btn-edit-produit me-1"
								data-id="<?= $produit->id_produit ?>"
								data-nom="<?= htmlspecialchars($produit->nom) ?>"
								data-reference="<?= htmlspecialchars($produit->reference) ?>"
								data-categorie="<?= htmlspecialchars($produit->categorie) ?>"
								data-genre="<?= htmlspecialchars($produit->genre) ?>"
								data-taille="<?= htmlspecialchars($produit->taille) ?>"
								data-couleur="<?= htmlspecialchars($produit->couleur) ?>"
								data-marque="<?= htmlspecialchars($produit->marque) ?>"
								data-prix_achat="<?= htmlspecialchars($produit->prix_achat) ?>"
								data-prix_vente="<?= htmlspecialchars($produit->prix_vente) ?>"
								data-quantite="<?= htmlspecialchars($produit->quantite) ?>"
								data-seuil_reappro="<?= htmlspecialchars($produit->seuil_reappro) ?>"
								data-date_ajout="<?= isset($produit->date_ajout) ? date('d/m/Y H:i', strtotime($produit->date_ajout)) : '' ?>"
								data-date_modif="<?= isset($produit->date_modif) ? date('d/m/Y H:i', strtotime($produit->date_modif)) : '' ?>"
								data-bs-toggle="modal"
								title="Éditer le produit"
							>
								Éditer
							</button>
							<!-- Bouton suppression -->
							<button
								class="btn btn-action btn-supprimer-produit"
								data-id="<?= $produit->id_produit ?>"
								data-nom="<?= htmlspecialchars($produit->nom) ?>"
								data-quantite="<?= $produit->quantite ?>">
								Supprimer
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr><td colspan="18" class="text-center">Aucun produit en stock.</td></tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
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
<div id="popup-edit-produit" style="display: none;"></div>

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

	// Logique ouverture pop-up édition produit
	$(document).on('click', '.btn-edit-produit', function (e) {
		e.preventDefault();
		const idProduit = $(this).data('id');

		$.ajax({
			url: siteUrl + '/stocks/load_edit_produit_popup',
			method: 'GET',
			data: { id_produit: idProduit },
			success: function (data) {
				$('#popup-edit-produit').remove();
				$('body').append(data);
				const popup = new bootstrap.Modal(document.getElementById('popupEditProduit'), {
					backdrop: 'static',
					keyboard: false
				});
				popup.show();
				$('#popupEditProduit').on('hidden.bs.modal', function () {
					$(this).remove();
				});
			},
			error: function () {
				alert("Erreur lors du chargement de la pop-up d'édition.");
			}
		});
	});
</script>
