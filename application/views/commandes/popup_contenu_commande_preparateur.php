<style>
	.modal-content {
		border-radius: 16px;
		box-shadow: 10px 10px #E4D0AA;
	}
	.modal-header {
		border-radius: 16px 16px 0 0;
		background: linear-gradient(90deg, #ba9b61 0%, #E4D0AA 100%) !important;
		border-bottom: 1px solid #e3e6f0;
	}
	.modal-title {
		color: #2d3651;
		font-weight: 600;
	}
	.table thead th {
		background-color: #ba9b61;
		color: #fff;
	}
	.form-check-input {
		width: 1.3rem;
		height: 1.3rem;
	}
</style>

<div class="modal fade" id="popupContenuCommandePreparateur" tabindex="-1" aria-labelledby="popupContenuCommandePreparateurLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="popupContenuCommandePreparateurLabel">Contenu de la commande</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>
			<div class="modal-body">
				<?php if (!empty($produits_commande)): ?>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Référence</th>
								<th>Produit</th>
								<th>Taille</th>
								<th>Couleur</th>
								<th>Quantité</th>
								<th class="text-center">Fait</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($produits_commande as $prod): ?>
							<tr data-product-key="<?= htmlspecialchars($prod->reference . '|' . $prod->taille . '|' . $prod->couleur) ?>">
								<td><?= htmlspecialchars($prod->reference) ?></td>
								<td><?= htmlspecialchars($prod->nom) ?></td>
								<td><?= htmlspecialchars($prod->taille) ?></td>
								<td><?= htmlspecialchars($prod->couleur) ?></td>
								<td class="fw-bold"><?= (int)$prod->quantite ?></td>
								<td class="text-center">
									<input class="form-check-input fait-checkbox" type="checkbox" />
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				<?php else: ?>
					<p>Aucun produit trouvé pour cette commande.</p>
				<?php endif; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div> 

<script>
(function() {
	function getOrderId() {
		var modal = document.getElementById('popupContenuCommandePreparateur');
		return modal ? modal.getAttribute('data-order-id') : null;
	}
	function storageKey(orderId) {
		return 'commande_fait_' + orderId;
	}
	function loadState(orderId) {
		try {
			var raw = localStorage.getItem(storageKey(orderId));
			return raw ? JSON.parse(raw) : {};
		} catch (e) {
			return {};
		}
	}
	function saveState(orderId, state) {
		try {
			localStorage.setItem(storageKey(orderId), JSON.stringify(state));
		} catch (e) {}
	}
	function applyState(state) {
		var rows = document.querySelectorAll('#popupContenuCommandePreparateur tbody tr');
		rows.forEach(function(row) {
			var key = row.getAttribute('data-product-key');
			var checkbox = row.querySelector('.fait-checkbox');
			if (!checkbox) return;
			checkbox.checked = Boolean(state[key]);
		});
	}
	function bindHandlers(orderId, state) {
		var rows = document.querySelectorAll('#popupContenuCommandePreparateur tbody tr');
		rows.forEach(function(row) {
			var key = row.getAttribute('data-product-key');
			var checkbox = row.querySelector('.fait-checkbox');
			if (!checkbox) return;
			checkbox.addEventListener('change', function() {
				state[key] = checkbox.checked;
				saveState(orderId, state);
			});
		});
	}
	document.addEventListener('DOMContentLoaded', function() {
		var orderId = getOrderId();
		if (!orderId) return;
		var state = loadState(orderId);
		applyState(state);
		bindHandlers(orderId, state);
	});
})();
</script> 