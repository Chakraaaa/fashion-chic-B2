<style>
	body {
		background: #F0E6D1;
		font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
	}
	.main-card {
		background: #fff;
		border-radius: 18px;
		box-shadow: 10px 10px #E4D0AA;
		border:none;
		padding: 32px 28px 24px 28px;
		margin-bottom: 32px;
	}
    .h4, h1, h2, h3 {
        color: #2d3651;
        letter-spacing: 0.5px;
    }
	.h4{
		font-size: 35px;
	}
	.btn-primary, .btn-primary:focus {
		background-color: #ba9b61; !important;
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
    .btn-danger {
        border-radius: 8px;
    }
    .table {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(44, 62, 80, 0.06);
        background: #fff;
    }
    .table thead th {
		background-color: #ba9b61;
        color: #fff;
        font-weight: 600;
        border: none;
        padding: 16px 12px;
        letter-spacing: 0.5px;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f6f7fb;
    }
    .table-hover tbody tr:hover {
        background-color: #e9edfa;
        transition: background-color 0.2s;
    }
    .table tbody tr {
        transition: box-shadow 0.2s, background 0.2s, border-left 0.2s;
        border-left: 4px solid transparent;
        border-bottom: 1.5px solid #e3e6f0;
    }
    .table tbody tr:hover {
        background: #f0f4ff;
        box-shadow: 0 2px 12px rgba(102, 126, 234, 0.10);
		border-left: 4px solid #ba9b61;
    }

    .btn-action {
        border-radius: 8px;
        font-weight: 500;
        padding: 6px 14px;
        margin-right: 4px;
        box-shadow: 0 1px 4px rgba(44, 62, 80, 0.08);
        transition: transform 0.15s, box-shadow 0.15s;
        font-size: 1rem;
    }
    .btn-action:hover {
        transform: scale(1.08);
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.18);
        opacity: 0.92;
    }
    .btn-delete-client {
        background: linear-gradient(90deg, #e74c3c 0%, #ff7675 100%);
        color: #fff;
        border: none;
    }
    .btn-delete-client:hover {
        background: linear-gradient(90deg, #ff7675 0%, #e74c3c 100%);
        color: #fff;
    }
    .alert {
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 1rem;
    }
    .text-center {
        color: #7b8190;
    }
    @media (max-width: 768px) {
        .main-card {
            padding: 16px 6px 12px 6px;
        }
        .table {
            font-size: 0.95rem;
        }
    }
</style>

<div class="container mt-4">
    <div class="main-card">
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
                            <button class="btn btn-action btn-delete-client" data-id="<?= $client->id_client ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">Aucun client trouvé.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="popup-add-client" style="display: none; "></div>

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
				url: siteUrl + '/clients/delete/' + clientId,
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


