<style>
	body {
		background: #F0E6D1;
		font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
	}
	.h4{
		font-size: 35px;
	}
	.main-card {
		background: #fff;
		border-radius: 18px;
		box-shadow: 10px 10px #E4D0AA;
		padding: 32px 28px 24px 28px;
		margin-bottom: 32px;
		overflow-x: auto; /* Ajout important */
		width: 100%;
		max-width: 1400px; /* selon ta préférence */
		margin-left: auto;
		margin-right: auto;
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
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0,0,0,0.2);
		color: black;
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
	.alert {
		border-radius: 10px;
		margin-bottom: 20px;
	}
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
<?php
// Fonction utilitaire pour afficher le nom d'un utilisateur à partir d'une liste
if (!function_exists('getUserNameById')) {
	function getUserNameById($users, $id) {
		foreach ($users as $u) {
			if ($u->id_utilisateur == $id) {
				return $u->prenom . ' ' . $u->nom;
			}
		}
		return '';
	}
}
?>

<div class="container-fluid mt-4">
	<div class="main-card">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="h4 fw-semibold">Liste des commandes</h1>
			<button class="btn btn-ajouter btn-ajouter-commande" data-bs-toggle="modal" data-bs-target="#modalAjouterCommande">
				<i class="bi bi-plus-circle"></i> Ajouter une commande
			</button>
		</div>

	<!-- Filtres -->
	<form method="get" class="mb-3 d-flex gap-2 align-items-end">
		<div>
			<label class="form-label mb-0">Préparateur</label>
			<select name="filtre_preparateur" class="form-select">
				<option value="">Tous</option>
				<?php foreach ($preparateurs as $prep): ?>
					<option value="<?= $prep->id_utilisateur ?>" <?= isset($_GET['filtre_preparateur']) && $_GET['filtre_preparateur'] == $prep->id_utilisateur ? 'selected' : '' ?>><?= htmlspecialchars($prep->prenom . ' ' . $prep->nom) ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div>
			<label class="form-label mb-0">Envoyeur</label>
			<select name="filtre_envoyeur" class="form-select">
				<option value="">Tous</option>
				<?php foreach ($envoyeurs as $env): ?>
					<option value="<?= $env->id_utilisateur ?>" <?= isset($_GET['filtre_envoyeur']) && $_GET['filtre_envoyeur'] == $env->id_utilisateur ? 'selected' : '' ?>><?= htmlspecialchars($env->prenom . ' ' . $env->nom) ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div>
			<label class="form-label mb-0">Priorité</label>
			<select name="filtre_priorite" class="form-select">
				<option value="">Toutes</option>
				<?php for ($i = 10; $i >= 1; $i--): ?>
					<option value="<?= $i ?>" <?= isset($_GET['filtre_priorite']) && $_GET['filtre_priorite'] == $i ? 'selected' : '' ?>><?= $i ?></option>
				<?php endfor; ?>
			</select>
		</div>
		<div class="form-check mb-0 ms-2">
			<input class="form-check-input" type="checkbox" name="filtre_non_attribue" id="filtre_non_attribue" value="1" <?= isset($_GET['filtre_non_attribue']) ? 'checked' : '' ?>>
			<label class="form-check-label" for="filtre_non_attribue">Non attribuées</label>
		</div>
		<button type="submit" class="btn btn-outline-primary ms-2">Filtrer</button>
		<a href="<?= site_url('commandes') ?>" class="btn btn-outline-secondary ms-2">Réinitialiser</a>
	</form>

	<table class="table table-bordered bg-white rounded shadow-sm">
		<thead class="table-light">
		<tr>
			<th class="text-center">Numéro</th>
			<th class="text-center">Client</th>
			<th class="text-center">Commercial</th>
			<th class="text-center">Date</th>
			<th class="text-center">Statut</th>
			<th class="text-center">Priorité</th>
			<th class="text-center">Préparateur</th>
			<th class="text-center">Envoyeur</th>
			<th class="text-center">Commentaire</th>
			<th class="text-center">Coût total</th>
			<th class="text-center">Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php if (empty($commandes)): ?>
			<tr>
				<td colspan="11" class="text-center text-muted py-4">
					Aucune commande trouvée
				</td>
			</tr>
		<?php else: ?>
			<?php foreach ($commandes as $commande): ?>
				<?php
				// Détermination de la couleur de fond selon la priorité
				$priority = (int) $commande->priority_level;
				if ($priority >= 8) {
					$bg = 'style="background-color:#ffcccc"'; // rouge clair
				} elseif ($priority >= 5) {
					$bg = 'style="background-color:#ffe5b4"'; // orange clair
				} elseif ($priority >= 2) {
					$bg = 'style="background-color:#e6f0ff"'; // bleu clair
				} else {
					$bg = '';
				}
				?>
				<tr <?= $bg ?>>
					<td><?= htmlspecialchars($commande->numero_commande ?? '') ?></td>
					<td><?= htmlspecialchars($commande->nom_client ?? '') ?></td>
					<td><?= htmlspecialchars($commande->nom_commercial ?? '') ?></td>
					<td><?= date('d/m/Y', strtotime($commande->date_commande)) ?></td>
					<td><?= htmlspecialchars($commande->statut ?? '') ?></td>
					<td class="fw-bold text-center"> <?= $commande->priority_level ?> </td>
					<td>
						<?= isset($commande->id_preparateur) && $commande->id_preparateur ? htmlspecialchars(getUserNameById($preparateurs, $commande->id_preparateur)) : '<span class="text-muted">Non attribué</span>' ?>
					</td>
					<td>
						<?= isset($commande->id_envoyeur) && $commande->id_envoyeur ? htmlspecialchars(getUserNameById($envoyeurs, $commande->id_envoyeur)) : '<span class="text-muted">Non attribué</span>' ?>
					</td>
					<td><?= htmlspecialchars($commande->commentaire ?? '') ?></td>
					<td><?= number_format($commande->cout_total, 2, ',', ' ') ?> €</td>
					<td>
						<button class="btn btn-info btn-sm btn-edit-commande" data-id="<?= $commande->id_commande ?>">
							<i class="bi bi-pencil-square"></i>
						</button>
						<button class="btn btn-danger btn-sm btn-delete-commande" data-id="<?= $commande->id_commande ?>">
							<i class="bi bi-trash-fill"></i>
						</button>
						<button class="btn btn-primary btn-sm btn-view-contenu-commande" data-id="<?= $commande->id_commande ?>" title="Voir le contenu">
							<i class="bi bi-eye"></i>
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
	</div>
</div>



<div id="popup-add-commande" style="display: none;"></div>
<div id="popup-edit-commande" style="display: none;"></div>

<script>

$(document).ready(function () {
	$('.btn-ajouter-commande').on('click', function (e) {
		e.preventDefault();
		$.ajax({
			url: siteUrl + '/commandes/load_add_commande_popup',
			method: 'GET',
			success: function (data) {
				$('#popup-add-commande').remove();
				$('body').append(data);
				const popup = new bootstrap.Modal(document.getElementById('modalAjouterCommande'), {
					backdrop: 'static',
					keyboard: false
				});
				popup.show();
				$('#popup-add-commande').on('hidden.bs.modal', function () {
					$(this).remove();
				});
			},
			error: function () {
				alert("Erreur lors du chargement de la pop-up.");
			}
		});
	});

	$(document).on('click', '.btn-edit-commande', function () {
		const commandeId = $(this).data('id');
		$.ajax({
			url: siteUrl + '/commandes/load_edit_commande_popup/' + commandeId,
			method: 'GET',
			success: function (data) {
				$('#popup-edit-commande').remove();
				$('body').append(data);
				const popup = new bootstrap.Modal(document.getElementById('modalEditCommande'), {
					backdrop: 'static',
					keyboard: false
				});
				popup.show();
				$('#popup-edit-commande').on('hidden.bs.modal', function () {
					$(this).remove();
				});
			},
			error: function () {
				alert("Erreur lors du chargement de la pop-up d'édition.");
			}
		});
	});

	$(document).on('click', '.btn-delete-commande', function () {
		const commandeId = $(this).data('id');
		if (confirm("Voulez-vous vraiment supprimer cette commande ?")) {
			$.ajax({
				url: siteUrl + '/commandes/delete/' + commandeId,
				type: 'POST',
				success: function () {
					location.reload();
				},
				error: function () {
					alert("Une erreur est survenue lors de la suppression.");
				}
			});
		}
	});
});

</script>
