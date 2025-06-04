<div class="modal fade" id="popupAddClient" tabindex="-1" aria-labelledby="popupAddClientLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title" id="popupAddClientLabel">Ajouter un client</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>

			<div class="modal-body">
				<form id="formAddClient" action="<?= site_url('clients/saveNewClient') ?>" method="post">
					<div class="mb-3">
						<label for="nom" class="form-label">Nom</label>
						<input type="text" class="form-control" id="nom" name="nom" required>
					</div>
					<div class="mb-3">
						<label for="adresse" class="form-label">Adresse</label>
						<input type="text" class="form-control" id="adresse" name="adresse" required>
					</div>
					<div class="mb-3">
						<label for="telephone" class="form-label">Téléphone</label>
						<input type="text" class="form-control" id="telephone" name="telephone" required>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="mb-3">
						<label for="id_commercial" class="form-label">Commercial</label>
						<select class="form-select" id="id_commercial" name="id_commercial" required>
							<option value="">-- Sélectionner --</option>
							<?php foreach ($commerciaux as $commercial): ?>
								<option value="<?= $commercial->id ?>"><?= $commercial->nom ?> <?= $commercial->prenom ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Enregistrer</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
