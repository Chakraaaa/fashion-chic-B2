<style>
    .modal-content {
        border-radius: 16px;
		box-shadow: 10px 10px #E4D0AA;
        border: none;
        background: #fff;
    }
    .modal-header {
		background-color: #ba9b61 !important;
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
		border-color: #ba9b61;
		box-shadow: 0 0 0 2px #ba9b61;
	}
	.form-control:focus, .form-select:focus {
		border-color: #ba9b61;
		box-shadow: 0 0 0 2px #ba9b61;
	}
    .btn-primary, .btn-primary:focus {
		background-color: #ba9b61 !important;
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
        background: none;
    }
    .form-text.text-muted {
        color: #7b8190 !important;
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

<div id="popup-edit-user">
	<div class="modal fade" id="modalModifierUtilisateur" tabindex="-1" aria-labelledby="modalModifierUtilisateurLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalModifierUtilisateurLabel">
						<i class="bi bi-person-gear me-2"></i>Modifier l'utilisateur
					</h5>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="formModifierUtilisateur" method="POST" action="<?= site_url('utilisateurs/update_user') ?>">
					<div class="modal-body">
						<input type="hidden" name="id_utilisateur" value="<?= $utilisateur->id_utilisateur ?>">
						
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="prenom" class="form-label">
										<i class="bi bi-person me-1"></i>Prénom <span class="text-danger">*</span>
									</label>
									<input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur->prenom) ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="nom" class="form-label">
										<i class="bi bi-person me-1"></i>Nom <span class="text-danger">*</span>
									</label>
									<input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur->nom) ?>" required>
								</div>
							</div>
						</div>

						<div class="mb-3">
							<label for="identifiant" class="form-label">
								<i class="bi bi-person-badge me-1"></i>Identifiant unique <span class="text-danger">*</span>
							</label>
							<input type="text" class="form-control" id="identifiant" name="identifiant" value="<?= htmlspecialchars($utilisateur->identifiant) ?>" required>
							<small class="form-text text-muted">Identifiant unique pour la connexion</small>
						</div>

						<div class="mb-3">
							<label for="id_role" class="form-label">
								<i class="bi bi-shield me-1"></i>Rôle <span class="text-danger">*</span>
							</label>
							<select class="form-select" id="id_role" name="id_role" required>
								<option value="">Sélectionnez un rôle</option>
								<?php foreach ($roles as $role): ?>
									<option value="<?= $role->id_role ?>" <?= ($utilisateur->id_role == $role->id_role) ? 'selected' : '' ?>>
										<?= htmlspecialchars(strtoupper($role->libelle)) ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
							<i class="bi bi-x-circle me-1"></i>Annuler
						</button>
						<button type="submit" class="btn btn-primary">
							<i class="bi bi-check-circle me-1"></i>Modifier
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	$('#formModifierUtilisateur').on('submit', function(e) {
		e.preventDefault();
		
		$.ajax({
			url: $(this).attr('action'),
			method: 'POST',
			data: $(this).serialize(),
			success: function(response) {
				if (response.success) {
					$('#modalModifierUtilisateur').modal('hide');
					location.reload();
				} else {
					alert(response.message || 'Erreur lors de la modification');
				}
			},
			error: function() {
				alert('Erreur lors de la modification de l\'utilisateur');
			}
		});
	});
});
</script> 
