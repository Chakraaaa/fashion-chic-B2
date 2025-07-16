<style>
    body {
        background: #f6f7fb;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }
    .main-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(44, 62, 80, 0.08);
        padding: 32px 28px 24px 28px;
        margin-bottom: 32px;
    }
    .h4, h1, h2, h3 {
        color: #2d3651;
        letter-spacing: 0.5px;
    }
    .btn-primary, .btn-primary:focus {
        background: linear-gradient(90deg, #2d3651 0%, #667eea 100%);
        border: none;
        color: #fff;
        font-weight: 500;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #667eea 0%, #2d3651 100%);
        color: #fff;
        box-shadow: 0 4px 16px rgba(44, 62, 80, 0.12);
    }
    .btn-info {
        background: linear-gradient(90deg, #36d1c4 0%, #5b86e5 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        margin-right: 4px;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
    }
    .btn-info:hover {
        background: linear-gradient(90deg, #5b86e5 0%, #36d1c4 100%);
        color: #fff;
        transform: scale(1.08);
        box-shadow: 0 4px 16px rgba(91, 134, 229, 0.18);
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
    .table {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(44, 62, 80, 0.06);
        background: #fff;
    }
    .table thead th {
        background: linear-gradient(90deg, #667eea 0%, #2d3651 100%);
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
        border-left: 4px solid #667eea;
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
            <h1 class="h4 fw-semibold">Liste des lots</h1>
            <button class="btn btn-primary" id="btn-add-lot">
                <i class="fas fa-plus me-1"></i> Ajouter un lot
            </button>
        </div>

        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($lots)):?>
                <?php foreach ($lots as $lot):?>
                    <tr>
                        <td><?= htmlspecialchars($lot->id_lot) ?></td>
                        <td><?= htmlspecialchars($lot->nom) ?></td>
                        <td><?= htmlspecialchars($lot->date_creation) ?></td>
                        <td>
                            <button class="btn btn-info btn-sm btn-view-lot" data-id="<?= $lot->id_lot ?>">
                                Contenu
                            </button>
                            <button class="btn btn-danger btn-sm btn-delete-lot" data-id="<?= $lot->id_lot ?>">
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
