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
    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        background: #f9fafb;
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
								<option value="<?= $commercial->id_utilisateur ?>"><?= $commercial->nom ?> <?= $commercial->prenom ?></option>
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
