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
		overflow-x: auto; /* Ajout important */
		width: 100%;
		max-width: 1400px; /* selon ta préférence */
		margin-left: auto;
		margin-right: auto;
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
		color: #fff;
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
    /* Bouton déconnexion harmonisé */
    .btn-logout {
        background: linear-gradient(90deg, #e74c3c 0%, #ff7675 100%);
        color: #fff !important;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        padding: 6px 16px;
        margin-left: 10px;
        box-shadow: 0 1px 4px rgba(44, 62, 80, 0.10);
        transition: background 0.18s, box-shadow 0.18s;
        float: right;
        margin-bottom: 12px;
    }
    .btn-logout:hover {
        background: linear-gradient(90deg, #ff7675 0%, #e74c3c 100%);
        color: #fff !important;
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
        .btn-logout {
            width: 100%;
            margin: 0 0 12px 0;
            float: none;
        }
    }
</style>

<div class="container-fluid mt-4">
    <div class="main-card">
        <a href="<?= site_url('login/logout') ?>" class="btn btn-logout">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
        </a>
        <h1 class="h4 fw-semibold mb-4">Mes commandes à envoyer</h1>
        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th class="text-center">Numéro</th>
                <th class="text-center">Client</th>
                <th class="text-center">Date</th>
                <th class="text-center">Statut</th>
                <th class="text-center">Priorité</th>
                <th class="text-center">Commentaire</th>
                <th class="text-center">Lien de suivi</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($commandes)): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        Aucune commande à envoyer
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
                        <td>
                            <form method="post" action="<?= site_url('commandes/modifier_commentaire_envoyeur/' . $commande->id_commande) ?>" class="d-flex align-items-center gap-2">
                                <input type="text" name="commentaire" class="form-control form-control-sm" value="<?= htmlspecialchars($commande->commentaire) ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary">💾</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="<?= site_url('commandes/modifier_lien_suivi/' . $commande->id_commande) ?>" class="d-flex align-items-center gap-2">
                                <input type="text" name="lien_suivi" class="form-control form-control-sm" value="<?= htmlspecialchars($commande->lien_suivi) ?>" placeholder="Lien de suivi...">
                                <button type="submit" class="btn btn-sm btn-outline-primary">💾</button>
                            </form>
                        </td>
                        <td>
                            <?php if ($commande->statut == 'Prête à envoyer'): ?>
                                <form method="post" action="<?= site_url('commandes/demarrer_envoi/' . $commande->id_commande) ?>" style="display:inline-block">
                                    <button type="submit" class="btn btn-sm btn-success">Démarrer</button>
                                </form>
                            <?php elseif ($commande->statut == 'Prête à livrer'): ?>
                                <form method="post" action="<?= site_url('commandes/valider_envoi/' . $commande->id_commande) ?>" style="display:inline-block">
                                    <button type="submit" class="btn btn-sm btn-primary">Terminer</button>
                                </form>
                            <?php endif; ?>
                            <form method="post" action="<?= site_url('commandes/passer_en_erreur/' . $commande->id_commande) ?>" style="display:inline-block">
                                <button type="submit" class="btn btn-sm btn-danger">Erreur</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div> 
