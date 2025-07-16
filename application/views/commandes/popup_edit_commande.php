<style>
    .modal-content {
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(44, 62, 80, 0.12);
    }
    .modal-header {
        border-radius: 16px 16px 0 0;
        background: #f6f7fb;
        border-bottom: 1px solid #e3e6f0;
    }
    .modal-title {
        color: #2d3651;
        font-weight: 600;
    }
    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        background: #f9fafb;
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
    .btn-secondary {
        border-radius: 8px;
    }
    .modal-footer {
        border-top: 1px solid #e3e6f0;
        background: #f6f7fb;
        border-radius: 0 0 16px 16px;
    }
    @media (max-width: 768px) {
        .modal-content {
            padding: 8px;
        }
    }
</style>

<div class="modal fade" id="modalEditCommande" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Éditer la commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="formEditCommande" action="<?= site_url('commandes/updateCommande/' . $commande->id_commande) ?>">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date_commande" class="form-label">Date de commande *</label>
                            <input type="date" class="form-control" id="date_commande" name="date_commande" required value="<?= htmlspecialchars($commande->date_commande) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="id_client" class="form-label">Client *</label>
                            <select class="form-select" id="id_client" name="id_client" required>
                                <option value="">Sélectionner un client</option>
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?= $client->id_client ?>" <?= $commande->id_client == $client->id_client ? 'selected' : '' ?>> <?= htmlspecialchars($client->nom) ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="id_commercial" class="form-label">Commercial *</label>
                            <select class="form-select" id="id_commercial" name="id_commercial" required>
                                <option value="">Sélectionner un commercial</option>
                                <?php foreach ($commerciaux as $commercial): ?>
                                    <option value="<?= $commercial->id_utilisateur ?>" <?= $commande->id_commercial == $commercial->id_utilisateur ? 'selected' : '' ?>> <?= htmlspecialchars($commercial->prenom . ' ' . $commercial->nom) ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="statut" class="form-label">Statut *</label>
                            <select class="form-select" id="statut" name="statut" required>
                                <option value="">Sélectionner un statut</option>
                                <option value="En attente" <?= $commande->statut == 'En attente' ? 'selected' : '' ?>>En attente</option>
                                <option value="En préparation" <?= $commande->statut == 'En préparation' ? 'selected' : '' ?>>En préparation</option>
                                <option value="Prête à envoyer" <?= $commande->statut == 'Prête à envoyer' ? 'selected' : '' ?>>Prête à envoyer</option>
                                <option value="Prête à livrer" <?= $commande->statut == 'Prête à livrer' ? 'selected' : '' ?>>Prête à livrer</option>
                                <option value="Erreur" <?= $commande->statut == 'Erreur' ? 'selected' : '' ?>>Erreur</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="id_preparateur" class="form-label">Préparateur</label>
                            <select class="form-select" id="id_preparateur" name="id_preparateur">
                                <option value="">Non attribué</option>
                                <?php foreach ($preparateurs as $prep): ?>
                                    <option value="<?= $prep->id_utilisateur ?>" <?= $commande->id_preparateur == $prep->id_utilisateur ? 'selected' : '' ?>> <?= htmlspecialchars($prep->prenom . ' ' . $prep->nom) ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="id_envoyeur" class="form-label">Envoyeur</label>
                            <select class="form-select" id="id_envoyeur" name="id_envoyeur">
                                <option value="">Non attribué</option>
                                <?php foreach ($envoyeurs as $env): ?>
                                    <option value="<?= $env->id_utilisateur ?>" <?= $commande->id_envoyeur == $env->id_utilisateur ? 'selected' : '' ?>> <?= htmlspecialchars($env->prenom . ' ' . $env->nom) ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="priority_level" class="form-label">Priorité</label>
                            <select class="form-select" id="priority_level" name="priority_level">
                                <?php for ($i = 10; $i >= 1; $i--): ?>
                                    <option value="<?= $i ?>" <?= $commande->priority_level == $i ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Commentaire</label>
                        <textarea class="form-control" id="commentaire" name="commentaire" rows="2" placeholder="Ajouter un commentaire..."><?= htmlspecialchars($commande->commentaire) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lots associés *</label>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Nom du lot</th>
                                        <th>Date de création</th>
                                        <th>Quantité</th>
                                        <th>Sélectionner</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($lots as $lot): ?>
                                    <?php
                                    $selected = false;
                                    $quantite = 1;
                                    foreach ($lots_commande as $lc) {
                                        if ($lc->id_lot == $lot->id_lot) {
                                            $selected = true;
                                            $quantite = $lc->quantite;
                                            break;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($lot->nom) ?></td>
                                        <td><?= htmlspecialchars($lot->date_creation) ?></td>
                                        <td>
                                            <input type="number" min="1" class="form-control" name="lots[<?= $lot->id_lot ?>][quantite]" value="<?= $quantite ?>" <?= $selected ? '' : 'disabled' ?> required>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="form-check-input select-lot" name="lots[<?= $lot->id_lot ?>][selected]" value="1" <?= $selected ? 'checked' : '' ?>>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
// Active/désactive le champ quantité selon la sélection du lot
$(document).on('change', '.select-lot', function() {
    const input = $(this).closest('tr').find('input[type="number"]');
    if ($(this).is(':checked')) {
        input.prop('disabled', false);
    } else {
        input.prop('disabled', true);
    }
});
</script> 