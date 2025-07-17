<style>
	body {
		background: #F0E6D1;
		font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
	}
	.main-card {
		background: #fff;
		border-radius: 18px;
		box-shadow: 10px 10px #E4D0AA;
		padding: 32px 28px 24px 28px;
		margin-bottom: 32px;
	}
	.h4{
		font-size: 35px;
	}
		.btn-ajouter {
			background-color: #ba9b61 !important;
			border: none;
			color: white;
			font-weight: 500;
			padding: 10px 20px;
			border-radius: 8px;
			transition: all 0.3s ease;
			box-shadow: 0 2px 4px rgba(0,0,0,0.1);
		}

		.btn-ajouter:hover {
			background-color: #c5c1b7;
			color: black;
			transform: translateY(-2px);
			box-shadow: 0 4px 8px rgba(0,0,0,0.2);
		}


		.table {
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		.table thead th {
			background-color: #ba9b61;
			color: white;
			font-weight: 600;
			border: none;
			padding: 15px 12px;
		}
	.table tbody tr:hover {
		background: #f0f4ff;
		box-shadow: 0 2px 12px rgba(102, 126, 234, 0.10);
		border-left: 4px solid #ba9b61;
	}
	.btn-danger {
		border-radius: 8px;
		background: linear-gradient(90deg, #e74c3c 0%, #ff7675 100%);
		color: #fff;
		border: none;
		font-weight: 500;
		transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
	}
	.btn-danger:hover {
		background: linear-gradient(90deg, #ff7675 0%, #e74c3c 100%);
		color: #fff;
		transform: scale(1.08);
		box-shadow: 0 4px 16px rgba(231, 76, 60, 0.18);
	}
	.btn-edit {
		background-color: #ba9b61;
		color: #fff;
		border: none;
		border-radius: 8px;
		font-weight: 500;
		margin-right: 4px;
		transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
	}
	.btn-edit:hover {
		background-color: #c5c1b7;
		color: #fff;
		transform: scale(1.08);
		box-shadow: 0 4px 16px rgba(91, 134, 229, 0.18);
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

<div class="container mt-4">
	<div class="main-card">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h1 class="h4 fw-semibold">Liste des utilisateurs </h1>
		<div class="d-flex gap-2">
			<button class="btn btn-ajouter btn-ajouter-user" data-bs-toggle="modal" data-bs-target="#modalAjouterUtilisateur">
				<i class="bi bi-person-plus-fill"></i> Ajouter un utilisateur
			</button>
			<button class="btn btn-ajouter btn-ajouter-user-identifiant" data-bs-toggle="modal" data-bs-target="#modalAjouterUtilisateurIdentifiant">
				<i class="bi bi-person-badge-plus"></i> Ajouter un utilisateur avec identifiant
			</button>
		</div>
	</div>

	<table class="table table-bordered bg-white rounded shadow-sm">
		<thead class="table-light">
		<tr>
			<th>Prénom</th>
			<th>Nom</th>
			<th>Email / Identifiant</th>
			<th>Rôle</th>
			<th>Actif</th>
			<th>Date de création</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php if (empty($utilisateurs)): ?>
			<tr>
				<td colspan="7" class="text-center text-muted py-4">
					Aucun utilisateur trouvé
				</td>
			</tr>
		<?php else: ?>
			<?php foreach ($utilisateurs as $utilisateur): ?>
				<tr>

					<td><?= htmlspecialchars($utilisateur->prenom) ?></td>
					<td><?= htmlspecialchars($utilisateur->nom) ?></td>
					<td>
						<?php if (in_array($utilisateur->id_role, [4,5])): ?>
							<?= htmlspecialchars($utilisateur->identifiant) ?>
						<?php else: ?>
							<?= htmlspecialchars($utilisateur->email) ?>	
						<?php endif; ?>
					</td>
					<td><?= htmlspecialchars($utilisateur->nom_role ? strtoupper($utilisateur->nom_role) : 'N/A') ?></td>
					<td><?= isset($utilisateur->actif) && $utilisateur->actif ? 'Oui' : 'Non' ?></td>
					<td><?= isset($utilisateur->date_creation) ? date('d/m/Y H:i', strtotime($utilisateur->date_creation)) : '25/11/2024 10:33' ?></td>
					<td>
						<button class="btn-edit-user btn btn-edit btn-sm btn-delete-lot" data-id="<?= $utilisateur->id_utilisateur ?>" data-role="<?= $utilisateur->id_role ?>">
							<i class="fas fa-edit"></i>
						</button>
						<button class="btn-delete-client btn btn-danger btn-sm btn-delete-lot" data-id="<?= $utilisateur->id_utilisateur ?>">
							<i class="fas fa-trash-alt"></i>
						</button>

					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
	</div>
</div>


			<div id="popup-add-user" style="display: none;"></div>

<script>
	$(document).ready(function () {
		$('.btn-ajouter-user').on('click', function (e) {
			e.preventDefault();
			$.ajax({
				url: siteUrl + '/utilisateurs/load_add_users_popup',
				method: 'GET',
				success: function (data) {
					$('#popup-add-user').remove();
					$('body').append(data);
					const popup = new bootstrap.Modal(document.getElementById('modalAjouterUtilisateur'), {
						backdrop: 'static',
						keyboard: false
					});

					popup.show();
					$('#popup-add-user').on('hidden.bs.modal', function () {
						$(this).remove();
					});
				},
				error: function () {
					alert("Erreur lors du chargement de la pop-up.");
				}
			});
		});

		// Logique pour modifier un utilisateur
		$(document).on('click', '.btn-edit-user', function (e) {
			e.preventDefault();
			const userId = $(this).data('id');
			const userRole = $(this).data('role');
			
			$.ajax({
				url: siteUrl + '/utilisateurs/load_edit_users_popup',
				method: 'GET',
				data: {
					user_id: userId,
					user_role: userRole
				},
				success: function (data) {
					$('#popup-edit-user').remove();
					$('body').append(data);
					const popup = new bootstrap.Modal(document.getElementById('modalModifierUtilisateur'), {
						backdrop: 'static',
						keyboard: false
					});

					popup.show();
					$('#popup-edit-user').on('hidden.bs.modal', function () {
						$(this).remove();
					});
				},
				error: function () {
					alert("Erreur lors du chargement de la pop-up de modification.");
				}
			});
		});

		// Logique pour ajouter un utilisateur avec identifiant
		$('.btn-ajouter-user-identifiant').on('click', function (e) {
			e.preventDefault();
			$.ajax({
				url: siteUrl + '/utilisateurs/load_add_users_identifiant_popup',
				method: 'GET',
				success: function (data) {
					$('#popup-add-user-identifiant').remove();
					$('body').append(data);
					const popup = new bootstrap.Modal(document.getElementById('modalAjouterUtilisateurIdentifiant'), {
						backdrop: 'static',
						keyboard: false
					});

					popup.show();
					$('#popup-add-user-identifiant').on('hidden.bs.modal', function () {
						$(this).remove();
					});
				},
				error: function () {
					alert("Erreur lors du chargement de la pop-up.");
				}
			});
		});
	});

	$(document).on('click', '.btn-delete-client', function () {
		const clientId = $(this).data('id');

		if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
			$.ajax({
				url: siteUrl + '/utilisateurs/delete/' + clientId,
				type: 'POST',
				success: function (response) {
					location.reload();
				},
				error: function () {
					alert("Une erreur est survenue lors de la suppression.");
				}
			});
		}
	});
</script>

