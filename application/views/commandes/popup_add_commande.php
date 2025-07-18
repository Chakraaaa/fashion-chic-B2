<?php
?>

<style>
    .modal-content {
		border: none;

		border-radius: 16px;
		box-shadow: 10px 10px #E4D0AA;
    }
    .modal-header {
		border-radius: 16px 16px 0 0;
		background: #f6f7fb;
		border-bottom: 1px solid #e3e6f0;
		background: linear-gradient(90deg, #ba9b61 0%, #E4D0AA 100%) !important;
    }
    .modal-title {
        color: #2d3651;
        font-weight: 600;
		text-align: center;
		width: 100%;
		margin: 0 auto;
    }
    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        background: #f9fafb;
    }
	.form-control:focus, .form-select:focus {
		border-color: #ba9b61;
		box-shadow: 0 0 0 2px #ba9b61;
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
		background-color: #ba9b61; !important;
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

<div class="modal fade" id="modalAjouterCommande" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Créer une nouvelle commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="formAjouterCommande" action="<?= site_url('commandes/saveNewCommande') ?>">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date_commande" class="form-label">Date de commande *</label>
                            <input type="date" class="form-control" id="date_commande" name="date_commande" required value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="id_client" class="form-label">Client *</label>
                            <select class="form-select" id="id_client" name="id_client" required>
                                <option value="">Sélectionner un client</option>
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?= $client->id_client ?>"> <?= htmlspecialchars($client->nom) ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="id_commercial" class="form-label">Commercial *</label>
                            <?php if ($role === 'commercial'): ?>
                                <!-- Pour les commerciaux : champ grisé avec leurs infos -->
                                <input type="hidden" name="id_commercial" value="<?= $user->id_utilisateur ?>">
                                <input type="text" class="form-control" value="<?= htmlspecialchars($user->prenom . ' ' . $user->nom) ?>" disabled>
                            <?php else: ?>
                                <!-- Pour les admins : select avec tous les commerciaux -->
                                <select class="form-select" id="id_commercial" name="id_commercial" required>
                                    <option value="">Sélectionner un commercial</option>
                                    <?php foreach ($commerciaux as $commercial): ?>
                                        <option value="<?= $commercial->id_utilisateur ?>"> <?= htmlspecialchars($commercial->prenom . ' ' . $commercial->nom) ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label for="statut" class="form-label">Statut *</label>
                            <select class="form-select" id="statut" name="statut" required>
                                <option value="">Sélectionner un statut</option>
                                <option value="En attente">En attente</option>
                                <option value="Prete à livrer">Prete à livrer</option>
                                <option value="En cours de livraison">En cours de livraison</option>
                                <option value="Livré">Livré</option>
                                <option value="Annulée">Annulée</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="id_preparateur" class="form-label">Préparateur</label>
                            <select class="form-select" id="id_preparateur" name="id_preparateur">
                                <option value="">Non attribué</option>
                                <?php foreach ($preparateurs as $prep): ?>
                                    <option value="<?= $prep->id_utilisateur ?>"> <?= htmlspecialchars($prep->prenom . ' ' . $prep->nom) ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="id_envoyeur" class="form-label">Envoyeur</label>
                            <select class="form-select" id="id_envoyeur" name="id_envoyeur">
                                <option value="">Non attribué</option>
                                <?php foreach ($envoyeurs as $env): ?>
                                    <option value="<?= $env->id_utilisateur ?>"> <?= htmlspecialchars($env->prenom . ' ' . $env->nom) ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="priority_level" class="form-label">Priorité</label>
                            <select class="form-select" id="priority_level" name="priority_level">
                                <?php for ($i = 10; $i >= 1; $i--): ?>
                                    <option value="<?= $i ?>" <?= $i == 1 ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Commentaire</label>
                        <textarea class="form-control" id="commentaire" name="commentaire" rows="2" placeholder="Ajouter un commentaire..."></textarea>
                    </div>
                    <div class="mb-3">
                        <p class="text-danger mb-2"><small>Le numéro de commande sera généré automatiquement lors de la création de la commande.</small></p>
                        <label class="form-label">Lots à ajouter *</label>
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
                                    <tr>
                                        <td><?= htmlspecialchars($lot->nom) ?></td>
                                        <td><?= htmlspecialchars($lot->date_creation) ?></td>
                                        <td>
                                            <input type="number" min="1" class="form-control" name="lots[<?= $lot->id_lot ?>][quantite]" value="1" disabled required>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="form-check-input select-lot" name="lots[<?= $lot->id_lot ?>][selected]" value="1">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
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
