<style>
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
	<div class="d-flex justify-content-between align-items-center mb-4">
		<h1 class="h4 fw-semibold">Liste des utilisateurs </h1>
		<button class="btn btn-ajouter btn-ajouter-user" data-bs-toggle="modal" data-bs-target="#modalAjouterUtilisateur">
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
						<a href="<?= site_url('admin/modifier_utilisateur/'.$utilisateur->id) ?>" class="text-decoration-none">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square action-icon" viewBox="0 0 16 16" title="Modifier">
								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
							</svg>
						</a>


						<span data-id="<?= $utilisateur->id ?>" class="btn-delete-client text-decoration-none">
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

