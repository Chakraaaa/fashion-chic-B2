<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= isset($title) ? $title : 'Document' ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
	<style>
		/* Bouton d'ajout avec gradient */
		.btn-ajouter {
			background: linear-gradient(45deg, #28a745, #20c997);
			border: none;
			color: white;
			font-weight: 500;
			padding: 10px 20px;
			border-radius: 8px;
			transition: all 0.3s ease;
			box-shadow: 0 2px 4px rgba(0,0,0,0.1);
		}

		.btn-ajouter:hover {
			background: linear-gradient(45deg, #218838, #1e7e34);
			transform: translateY(-2px);
			box-shadow: 0 4px 8px rgba(0,0,0,0.2);
			color: white;
		}


		.table {
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		.table thead th {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			font-weight: 600;
			border: none;
			padding: 15px 12px;
		}

		.table tbody tr:hover {
			background-color: rgba(0, 123, 255, 0.05);
			transition: background-color 0.2s ease;
		}

		.modal-header {
			border-radius: 10px 10px 0 0;
		}

		.modal-content {
			border-radius: 15px;
			border: none;
			box-shadow: 0 10px 30px rgba(0,0,0,0.2);
		}

		/* Messages flash */
		.alert {
			border-radius: 10px;
			margin-bottom: 20px;
		}

		/* Responsive */
		@media (max-width: 768px) {
			.btn-ajouter {
				padding: 8px 15px;
				font-size: 0.9rem;
			}

			.action-icon {
				margin: 0 3px;
			}

			.table {
				font-size: 0.9rem;
			}
		}
	</style>
</head>
<body class="bg-light py-4">

<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<i class="bi bi-check-circle-fill me-2"></i><?= $this->session->flashdata('success') ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<i class="bi bi-exclamation-triangle-fill me-2"></i><?= $this->session->flashdata('error') ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h2 class="fw-bold">Liste des utilisateurs </h2>
		<button class="btn btn-ajouter" data-bs-toggle="modal" data-bs-target="#modalAjouterUtilisateur">
			<i class="bi bi-person-plus-fill"></i> Ajouter un utilisateur
		</button>
	</div>

	<table class="table table-bordered bg-white rounded shadow-sm">
		<thead class="table-light">
		<tr>
			<th>Prénom</th>
			<th>Nom</th>
			<th>Email</th>
			<th>Rôle</th>
			<th>Date de création</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php if (empty($utilisateurs)): ?>
			<tr>
				<td colspan="6" class="text-center text-muted py-4">
					Aucun utilisateur trouvé
				</td>
			</tr>
		<?php else: ?>
			<?php foreach ($utilisateurs as $utilisateur): ?>
				<tr>

					<td><?= htmlspecialchars($utilisateur->prenom) ?></td>
					<td><?= htmlspecialchars($utilisateur->nom) ?></td>
					<td><?= htmlspecialchars($utilisateur->email) ?></td>
					<td><?= htmlspecialchars($utilisateur->nom_role ? strtoupper($utilisateur->nom_role) : 'N/A') ?></td>
					<td><?= isset($utilisateur->date_creation) ? date('d/m/Y H:i', strtotime($utilisateur->date_creation)) : '25/11/2024 10:33' ?></td>
					<td>

						<a href="<?= site_url('admin/modifier_utilisateur/'.$utilisateur->id_utilisateur) ?>" class="text-decoration-none">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square action-icon" viewBox="0 0 16 16" title="Modifier">
								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
							</svg>
						</a>


						<span onclick="confirmerSuppression(<?= $utilisateur->id_utilisateur ?>, '<?= htmlspecialchars($utilisateur->prenom . ' ' . $utilisateur->nom) ?>')" class="text-decoration-none">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill action-icon delete-icon" viewBox="0 0 16 16" title="Supprimer">
							<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
						</svg>
					</span>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
</div>


<div class="modal fade" id="modalAjouterUtilisateur" tabindex="-1" aria-labelledby="modalAjouterUtilisateurLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="modalAjouterUtilisateurLabel">
					<i class="bi bi-person-plus-fill me-2"></i>Ajouter un nouvel utilisateur
				</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="formAjouterUtilisateur">
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="prenom" class="form-label">Prénom *</label>
								<input type="text" class="form-control" id="prenom" name="prenom" required>
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="nom" class="form-label">Nom *</label>
								<input type="text" class="form-control" id="nom" name="nom" required>
								<div class="invalid-feedback"></div>
							</div>
						</div>
					</div>

					<div class="mb-3">
						<label for="email" class="form-label">Adresse email *</label>
						<input type="email" class="form-control" id="email" name="email" required>
						<div class="invalid-feedback"></div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="id_role" class="form-label">Rôle *</label>
								<select class="form-select" id="id_role" name="id_role" required>
									<option value="">Sélectionner un rôle</option>
									<?php if (isset($roles)): ?>
										<?php foreach ($roles as $role): ?>
											<option value="<?= $role->id_role ?>"><?= ucfirst($role->libelle) ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="mot_de_passe" class="form-label">Mot de passe *</label>
								<input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
								<div class="invalid-feedback"></div>
								<div class="form-text">Minimum 6 caractères</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-success" id="btnSauvegarder">Créer l'utilisateur</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalSuppression" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title">
					<i class="bi bi-exclamation-triangle-fill me-2"></i>Confirmer la suppression
				</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<p>Êtes-vous sûr de vouloir supprimer l'utilisateur <strong id="nomUtilisateurSuppression"></strong> ?</p>
				<p class="text-danger">
					<i class="bi bi-exclamation-triangle-fill me-2"></i>Cette action est irréversible !
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
				<a href="#" id="lienSuppression" class="btn btn-danger">Supprimer</a>
			</div>
		</div>
	</div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
