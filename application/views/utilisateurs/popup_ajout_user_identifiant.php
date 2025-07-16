<style>
    .modal-content {
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(44, 62, 80, 0.15);
        border: none;
        background: #fff;
    }
    .modal-header {
        background: linear-gradient(90deg, #2d3651 0%, #667eea 100%);
        color: #fff;
        border-radius: 16px 16px 0 0;
        border-bottom: none;
    }
    .modal-title {
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .form-label {
        color: #2d3651;
        font-weight: 500;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1.5px solid #e3e6f0;
        box-shadow: none;
        transition: border-color 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 2px rgba(102,126,234,0.12);
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
        background: #f6f7fb;
        color: #2d3651;
        border: none;
        font-weight: 500;
        transition: background 0.2s, color 0.2s;
    }
    .btn-secondary:hover {
        background: #e9edfa;
        color: #2d3651;
    }
    .modal-footer {
        border-top: none;
        border-radius: 0 0 16px 16px;
        background: #fff;
    }
    .text-danger {
        font-size: 0.95rem;
    }
    @media (max-width: 768px) {
        .modal-dialog {
            max-width: 98vw;
            margin: 1.2rem auto;
        }
        .modal-content {
            padding: 0 2px;
        }
    }
</style>

<div id="popup-add-user-identifiant">
	<div class="modal fade" id="modalAjouterUtilisateurIdentifiant" tabindex="-1" aria-labelledby="modalAjouterUtilisateurIdentifiantLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalAjouterUtilisateurIdentifiantLabel">
						<i class="bi bi-person-badge-plus me-2"></i>Ajouter un utilisateur avec identifiant
					</h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="formAjouterUtilisateurIdentifiant" method="POST" action="<?= site_url('utilisateurs/saveNewUserIdentifiant') ?>">
					<?php if ($this->security->get_csrf_token_name()): ?>
    <input type="hidden"
           name="<?= $this->security->get_csrf_token_name() ?>"
           value="<?= $this->security->get_csrf_hash() ?>">
<?php endif; ?>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="prenom" class="form-label">
										<i class="bi bi-person me-1"></i>Prénom <span class="text-danger">*</span>
									</label>
									<input type="text" class="form-control" id="prenom" name="prenom" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="nom" class="form-label">
										<i class="bi bi-person me-1"></i>Nom <span class="text-danger">*</span>
									</label>
									<input type="text" class="form-control" id="nom" name="nom" required>
								</div>
							</div>
						</div>

						<div class="mb-3">
							<p class="text-danger mb-2"><small>L'identifiant unique sera généré automatiquement lors de la création de l'utilisateur.</small></p>
						</div>

						<div class="mb-3">
							<label for="id_role" class="form-label">
								<i class="bi bi-shield me-1"></i>Rôle <span class="text-danger">*</span>
							</label>
							<select class="form-select" id="id_role" name="id_role" required>
								<option value="">Sélectionnez un rôle</option>
								<?php
								// Ordre souhaité : préparateur (id 4), puis envoyeur (id 5)
								foreach ([4, 5] as $id_voulu) {
									foreach ($roles as $role) {
										if ($role->id_role == $id_voulu) {
											?>
											<option value="<?= $role->id_role ?>">
												<?= ucfirst($role->libelle) ?>
											</option>
											<?php
										}
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
							<i class="bi bi-x-circle me-1"></i>Annuler
						</button>
						<button type="submit" class="btn btn-primary">
							<i class="bi bi-check-circle me-1"></i>Ajouter
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div> 