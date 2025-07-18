<style>
    .modal-content {
        border-radius: 16px;
		box-shadow: 10px 10px #E4D0AA;
        border: none;
        background: #fff;
    }
	.modal-header {
		border-radius: 16px 16px 0 0;
		background: #f6f7fb;
		border-bottom: 1px solid #e3e6f0;
		background: linear-gradient(90deg, #ba9b61 0%, #E4D0AA 100%) !important;

	}
    .modal-title {
        font-weight: 600;
        letter-spacing: 0.5px;
		text-align: center;
		width: 100%;
		margin: 0 auto;
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
        background: #fff;
    }
    .input-group .form-control {
        border-radius: 8px 0 0 8px;
    }
    .input-group .btn {
        border-radius: 0 8px 8px 0;
    }
    .form-text.text-muted {
        color: #7b8190 !important;
    }
    .invalid-feedback {
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

<div class="modal fade" id="modalAjouterUtilisateur" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ajouter un nouvel utilisateur</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
						<small class="form-text text-muted">Un email automatique sera envoyé à cette adresse avec les identifiants de connexion.</small>
						<div class="invalid-feedback"></div>
					</div>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="id_role" class="form-label">Rôle *</label>
							<select class="form-select" id="id_role" name="id_role" required>
								<option value="">Sélectionner un rôle</option>
								<?php
								// Ordre souhaité des rôles
								$ordre_roles = ['admin', 'gerant', 'commercial'];
								foreach ($ordre_roles as $libelle_voulu) {
									foreach ($roles as $role) {
										if (strtolower($role->libelle) === $libelle_voulu && $role->id_role != 4 && $role->id_role != 5) {
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
							<div class="invalid-feedback"></div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="mot_de_passe" class="form-label">Mot de passe *</label>
							<div class="input-group">
								<input type="text" class="form-control" id="mot_de_passe" name="mot_de_passe" readonly required>
								<button type="button" class="btn btn-outline-secondary" id="genererMotDePasse">
									<i class="bi bi-arrow-clockwise"></i> Générer
								</button>
							</div>
							<small class="form-text text-muted">Mot de passe généré automatiquement</small>
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

<script>
$(document).ready(function() {
	// Générer un mot de passe au chargement de la popup
	genererMotDePasse();
	
	// Générer un nouveau mot de passe quand on clique sur le bouton
	$('#genererMotDePasse').on('click', function() {
		genererMotDePasse();
	});
	
	function genererMotDePasse() {
		const caracteres = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKMNPRSTUVWXYZ123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
		let motDePasse = '';
		for (let i = 0; i < 10; i++) {
			motDePasse += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
		}
		$('#mot_de_passe').val(motDePasse);
	}
});
</script>
