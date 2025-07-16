<style>
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
    .table tbody tr {
        transition: box-shadow 0.2s, background 0.2s, border-left 0.2s;
        border-left: 4px solid transparent;
        border-bottom: 1.5px solid #e3e6f0;
    }
    .table tbody tr:hover {
        background: #f0f4ff;
        box-shadow: 0 2px 12px rgba(102, 126, 234, 0.10);
        border-left: 4px solid #667eea;
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
							<th>Quantité</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($contenu as $produit): ?>
							<tr>
								<td><?= htmlspecialchars($produit->reference) ?></td>
								<td><?= htmlspecialchars($produit->nom) ?></td>
								<td><?= htmlspecialchars($produit->quantite) ?></td>
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
