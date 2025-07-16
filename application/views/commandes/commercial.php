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
    .btn-secondary {
        border-radius: 8px;
        font-weight: 500;
        margin-left: 4px;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
    }
    .btn-secondary:hover {
        background: #e9edfa;
        color: #2d3651;
        transform: scale(1.08);
        box-shadow: 0 4px 16px rgba(44, 62, 80, 0.10);
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
        <h1 class="h4 fw-semibold mb-4">Mes commandes</h1>
        <a href="<?= site_url('commandes/load_add_commande_popup') ?>" class="btn btn-primary mb-3 btn-ajouter-commande" data-bs-toggle="modal" data-bs-target="#modalAjouterCommande">
            <i class="bi bi-plus-circle"></i> Nouvelle commande
        </a>
        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th>Numéro</th>
                <th>Client</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Priorité</th>
                <th>Commentaire</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($commandes)): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Aucune commande trouvée
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($commandes as $commande): ?>
                    <?php
                    $priority = (int) $commande->priority_level;
                    if ($priority >= 8) {
                        $bg = 'style="background-color:#ffcccc"';
                    } elseif ($priority >= 5) {
                        $bg = 'style="background-color:#ffe5b4"';
                    } elseif ($priority >= 2) {
                        $bg = 'style="background-color:#e6f0ff"';
                    } else {
                        $bg = '';
                    }
                    ?>
                    <tr <?= $bg ?>>
                        <td><?= htmlspecialchars($commande->numero_commande) ?></td>
                        <td><?= htmlspecialchars($commande->nom_client) ?></td>
                        <td><?= date('d/m/Y', strtotime($commande->date_commande)) ?></td>
                        <td><?= htmlspecialchars($commande->statut) ?></td>
                        <td class="fw-bold text-center"> <?= $commande->priority_level ?> </td>
                        <td><?= htmlspecialchars($commande->commentaire) ?></td>
                        <td>
                            <button class="btn btn-info btn-sm btn-edit-commande" data-id="<?= $commande->id_commande ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-danger btn-sm btn-delete-commande" data-id="<?= $commande->id_commande ?>">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            <a href="<?= site_url('commandes/voir_lots/' . $commande->id_commande) ?>" class="btn btn-secondary btn-sm">Lots</a>
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
            url: $(this).attr('href'),
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
