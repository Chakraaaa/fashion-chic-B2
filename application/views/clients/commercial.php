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
    .h4, h1, h2, h3 {
        color: #2d3651;
        letter-spacing: 0.5px;
    }
	.h4{
		font-size: 35px;
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
    .btn-info {
		background-color: #ba9b61;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        margin-right: 4px;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
    }
    .btn-info:hover {
		background-color: #c5c1b7;
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
        <h1 class="h4 fw-semibold mb-4">Mes clients</h1>
        <a href="<?= site_url('clients/load_add_client_popup') ?>" class="btn btn-primary mb-3 btn-ajouter-client" data-bs-toggle="modal" data-bs-target="#modalAjouterClient">
            <i class="bi bi-plus-circle"></i> Nouveau client
        </a>
        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($clients)): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Aucun client trouvé
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client->nom) ?></td>
                        <td><?= htmlspecialchars($client->adresse) ?></td>
                        <td><?= htmlspecialchars($client->telephone) ?></td>
                        <td><?= htmlspecialchars($client->email) ?></td>
                        <td>
                            <button class="btn btn-info btn-sm btn-edit-client" data-id="<?= $client->id_client ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-danger btn-sm btn-delete-client" data-id="<?= $client->id_client ?>">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="popup-add-client" style="display: none;"></div>
<div id="popup-edit-client" style="display: none;"></div>

<script>
$(document).ready(function () {
    $('.btn-ajouter-client').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            method: 'GET',
            success: function (data) {
                $('#popup-add-client').remove();
                $('body').append(data);
                setTimeout(function() {
                    var modalEl = document.getElementById('modalAjouterClient');
                    if (modalEl) {
                        const popup = new bootstrap.Modal(modalEl, {
                            backdrop: 'static',
                            keyboard: false
                        });
                        popup.show();
                        $('#modalAjouterClient').on('hidden.bs.modal', function () {
                            $(this).remove();
                        });
                    } else {
                        alert("Erreur : la popup n'a pas été trouvée dans le DOM.");
                    }
                }, 10);
            },
            error: function () {
                alert("Erreur lors du chargement de la pop-up.");
            }
        });
    });

    $(document).on('click', '.btn-edit-client', function () {
        const clientId = $(this).data('id');
        $.ajax({
            url: siteUrl + '/clients/load_edit_client_popup/' + clientId,
            method: 'GET',
            success: function (data) {
                $('#popup-edit-client').remove();
                $('body').append(data);
                const popup = new bootstrap.Modal(document.getElementById('modalEditClient'), {
                    backdrop: 'static',
                    keyboard: false
                });
                popup.show();
                $('#popup-edit-client').on('hidden.bs.modal', function () {
                    $(this).remove();
                });
            },
            error: function () {
                alert("Erreur lors du chargement de la pop-up d'édition.");
            }
        });
    });

    $(document).on('click', '.btn-delete-client', function () {
        const clientId = $(this).data('id');
        if (confirm("Voulez-vous vraiment supprimer ce client ?")) {
            $.ajax({
                url: siteUrl + '/clients/delete/' + clientId,
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
