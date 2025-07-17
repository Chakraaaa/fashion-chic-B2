<style>
    body {
        background: #F0E6D1;;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }
    .main-card {
        background: #fff;
        border-radius: 18px;
		box-shadow: 10px 10px #E4D0AA;
        padding: 32px 28px 24px 28px;
        margin-bottom: 32px;
    }
    .h4, h1, h2, h3 {
        color: #2d3651;
        letter-spacing: 0.5px;
    }
	.h4{
		font-size: 35px;
	}
    .btn-primary, .btn-primary:focus {
		background-color: #ba9b61;
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
		background-color: #ba9b61;
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
        border-left: 4px solid #ba9b61;
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
		border: none;
		color: #fff;
		font-weight: 600;
		border-radius: 12px;
		padding: 10px 24px;
		font-size: 1rem;
		box-shadow: 0 3px 10px rgba(231, 76, 60, 0.3);
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 8px;
	}

	.btn-supprimer-produit:hover {
		background: linear-gradient(90deg, #ff7675 0%, #e74c3c 100%);
		box-shadow: 0 6px 16px rgba(231, 76, 60, 0.5);
		transform: scale(1.05);
	}
	#search-input {
		border: 2px solid #ba9b61; /* bordure initiale */
		border-radius: 8px;
		background-color: #fff;
		box-shadow: none;
		transition: all 0.2s ease;
		color: #2d3651;
		padding: 10px 16px;
		font-size: 16px;
	}

	/* Effet au clic */
	#search-input:focus {
		outline: none; /* Supprime la bordure bleue par défaut */
		border: 2px solid #E4D0AA; /* couleur de bordure personnalisée */
		box-shadow: 0 0 6px rgba(186, 155, 97, 0.4); /* halo doux */

</style>

<div class="container mt-4">
	<div class="main-card">
		<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
			<h1 class="h4 fw-semibold mb-2 mb-md-0">Liste des stocks</h1>

			<div class="d-flex flex-grow-1 justify-content-center order-2 order-md-1 mb-2 mb-md-0">
				<input type="text" id="search-input" class="form-control" placeholder="Rechercher un produit par nom ou référence..." style="max-width: 400px;">
			</div>

			<div class="d-flex gap-2 order-1 order-md-2">
				<button class="btn btn-primary btnimport" id="btn-import-stocks">
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
								class="btn btn-action btn-supprimer-produit"
								data-id="<?= $produit->id_produit ?>"
								data-nom="<?= htmlspecialchars($produit->nom) ?>"
								data-quantite="<?= $produit->quantite ?>">
								<i class="fas fa-trash-alt"></i>
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
	// Recherche en direct dans le tableau
	$('#search-input').on('keyup', function () {
		const value = $(this).val().toLowerCase();
		$('table tbody tr').filter(function () {
			const nom = $(this).find('td:eq(0)').text().toLowerCase();
			const reference = $(this).find('td:eq(1)').text().toLowerCase();
			$(this).toggle(nom.includes(value) || reference.includes(value));
		});
	});
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
