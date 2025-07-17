<style>
    .modal-content {
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
    }
    .btn-secondary {
        border-radius: 8px;
    }
    .modal-footer {
        background: none;
        border: none;
    }
    @media (max-width: 768px) {
        .modal-content {
            padding: 8px;
        }
    }
</style>

<div class="modal fade" id="popupContenuCommande" tabindex="-1" aria-labelledby="popupContenuCommandeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popupContenuCommandeLabel">Contenu de la commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <?php if (!empty($lots_commande)): ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID Lot</th>
                            <th>Nom du lot</th>
                            <th>Quantité</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lots_commande as $lot): ?>
                            <tr>
                                <td><?= htmlspecialchars($lot->id_lot) ?></td>
                                <td><?= htmlspecialchars($lot->nom) ?></td>
                                <td><?= (int)$lot->quantite ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucun lot dans cette commande.</p>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div> 