<div class="modal fade" id="modalAjouterUtilisateur" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-light">
				<h5 class="modal-title">Ajouter un nouvel utilisateur</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form method="post" id="formAjouterUtilisateur" action="<?= site_url('utilisateurs/saveNewUser') ?>">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="prenom" class="form-label">Prénom *</label>
							<input type="text" class="form-control" id="prenom" name="prenom" required>
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="nom" class="form-label">Nom *</label>
							<input type="text" class="form-control" id="nom" name="nom" required>
							<div class="invalid-feedback"></div>
						</div>
					</div>

					<div class="mb-3">
						<label for="email" class="form-label">Email *</label>
						<input type="email" class="form-control" id="email" name="email" required>
						<div class="invalid-feedback"></div>
					</div>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="id_role" class="form-label">Rôle *</label>
							<select class="form-select" id="id_role" name="id_role" required>
								<option value="">Sélectionner un rôle</option>
								<?php foreach ($roles as $role): ?>
									<option value="<?= $role->id ?>">
										<?= ucfirst($role->libelle) ?>
									</option>
								<?php endforeach; ?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="mot_de_passe" class="form-label">Mot de passe *</label>
							<input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
						<button type="submit" class="btn btn-primary" id="btnSauvegarder">Sauvegarder</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
