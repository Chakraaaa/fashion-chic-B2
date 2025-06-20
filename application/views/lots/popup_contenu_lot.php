<div class="modal fade" id="popupViewLot" tabindex="-1" aria-labelledby="popupViewLotLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="popupViewLotLabel">Contenu du lot #<?= htmlspecialchars($id_lot) ?></h5>
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
