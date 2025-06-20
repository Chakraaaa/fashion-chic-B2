<div class="container mt-4">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="h4 fw-semibold">Liste des clients</h1>
		<button class="btn btn-primary" id="btn-add-client">
			<i class="fas fa-plus me-1"></i> Ajouter un client
		</button>
	</div>

	<table class="table table-striped table-hover">
		<thead class="table-light">
		<tr>
			<th>Nom</th>
			<th>Adresse</th>
			<th>Téléphone</th>
			<th>Email</th>
			<th>Commercial</th>
			<th>Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php if (!empty($clients)): ?>
			<?php foreach ($clients as $client): ?>
				<tr>
					<td><?= htmlspecialchars($client->nom) ?></td>
					<td><?= htmlspecialchars($client->adresse) ?></td>
					<td><?= htmlspecialchars($client->telephone) ?></td>
					<td><?= htmlspecialchars($client->email) ?></td>
					<td><?= htmlspecialchars($client->prenom_commercial . ' ' . $client->nom_commercial) ?></td>
					<td>
						<button class="btn btn-danger btn-sm btn-delete-client" data-id="<?= $client->id ?>">
							Supprimer
						</button>
					</td>

				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan="5" class="text-center">Aucun client trouvé.</td></tr>
		<?php endif; ?>
		</tbody>
	</table>
</div>

<div id="popup-add-client" style="display: none;"></div>

<script>
	$(document).ready(function () {
		$('#btn-add-client').on('click', function (e) {
			e.preventDefault();
			$.ajax({
				url: siteUrl + '/clients/load_add_client_popup',
				method: 'GET',
				success: function (data) {
					$('#popup-add-client').remove();
					$('body').append(data);
					const popup = new bootstrap.Modal(document.getElementById('popupAddClient'), {
						backdrop: 'static',
						keyboard: false
					});

					popup.show();
					$('#popup-add-client').on('hidden.bs.modal', function () {
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

		if (confirm("Voulez-vous vraiment supprimer ce client ?")) {
			$.ajax({
				url: siteUrl + 'clients/delete/' + clientId,
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


