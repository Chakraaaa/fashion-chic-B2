<style>
    .modal-content {
        border-radius: 16px;
		box-shadow: 10px 10px #E4D0AA;
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
	.form-control:focus, .form-select:focus {
		border-color: #ba9b61;
		box-shadow: 0 0 0 2px #ba9b61;
	}

    .btn-secondary {
        border-radius: 8px;
    }
    .modal-footer {
        border-top: 1px solid #e3e6f0;
        background: #f6f7fb;
        border-radius: 0 0 16px 16px;
    }
    @media (max-width: 768px) {
        .modal-content {
            padding: 8px;
        }
    }
</style>

<div class="modal fade" id="popupViewLot" tabindex="-1" aria-labelledby="popupViewLotLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="popupViewLotLabel">Contenu du lot <?= htmlspecialchars($nom_lot) ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<?php if (!empty($contenu)): ?>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th>Référence</th>
							<th>Nom du produit</th>
							<th>Taille</th>
							<th>Couleur</th>
							<th>Quantité</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($contenu as $produit): ?>
							<tr>
								<td><?= htmlspecialchars($produit->reference ?? '') ?></td>
								<td><?= htmlspecialchars($produit->nom ?? '') ?></td>
								<td><?= htmlspecialchars($produit->taille ?? '') ?></td>
								<td><?= htmlspecialchars($produit->couleur ?? '') ?></td>
								<td><?= htmlspecialchars($produit->quantite ?? '') ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				<?php else: ?>
					<p>Aucun produit dans ce lot.</p>
				<?php endif; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>
