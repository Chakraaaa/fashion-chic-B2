<div class="container mt-4">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="h4 fw-semibold">Liste des lots</h1>
		<button class="btn btn-primary" id="btn-add-lot">
			<i class="fas fa-plus me-1"></i> Ajouter un lot
		</button>
	</div>

	<table class="table table-striped table-hover">
		<thead class="table-light">
		<tr>
			<th>ID</th>
			<th>Date de création</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php if (!empty($lots)): ?>
			<?php foreach ($lots as $lot):?>
				<tr>
					<td><?= htmlspecialchars($lot->id) ?></td>
					<td><?= htmlspecialchars($lot->date_creation) ?></td>
					<td>
						<button class="btn btn-info btn-sm btn-view-lot" data-id="<?= $lot->id ?>">
							Contenu
						</button>
						<button class="btn btn-danger btn-sm btn-delete-lot" data-id="<?= $lot->id ?>">
							Supprimer
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan="4" class="text-center">Aucun lot trouvé.</td></tr>
		<?php endif; ?>
		</tbody>
	</table>
</div>

<div id="popup-add-lot" style="display: none;"></div>

<div id="popupViewLot" style="display: none;"></div>

<script>

	$(document).on('click', '.btn-view-lot', function () {
		const lotId = $(this).data('id');
		$.ajax({
			url: siteUrl + '/lots/load_contenu_lot/' + lotId,
			method: 'GET',
			success: function (data) {
				$('#popupViewLot').remove();
				$('body').append(data);
				const modal = new bootstrap.Modal(document.getElementById('popupViewLot'), {
					backdrop: 'static',
					keyboard: false
				});
				modal.show();
			},
			error: function () {
				alert("Erreur lors du chargement du contenu du lot.");
			}
		});
	});

	$(document).ready(function () {
		$('#btn-add-lot').on('click', function (e) {
			e.preventDefault();
			$.ajax({
				url: siteUrl + '/lots/load_add_lot_popup',
				method: 'GET',
				success: function (data) {
					$('#popup-add-lot').remove();
					$('body').append(data);
					const popup = new bootstrap.Modal(document.getElementById('popupAddLot'), {
						backdrop: 'static',
						keyboard: false
					});
					popup.show();
					$('#popup-add-lot').on('hidden.bs.modal', function () {
						$(this).remove();
					});
				},
				error: function () {
					alert("Erreur lors du chargement de la pop-up.");
				}
			});
		});

		$(document).on('click', '.btn-delete-lot', function () {
			const lotId = $(this).data('id');

			if (confirm("Voulez-vous vraiment supprimer ce lot ?")) {
				$.ajax({
					url: siteUrl + '/lots/delete/' + lotId,
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
