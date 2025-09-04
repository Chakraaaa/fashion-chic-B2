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
    .h4{ font-size: 35px; }

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

    /* Couleurs de priorité (table) */
    .prio-high   { background-color: #ffcccc !important; } /* >= 8 */
    .prio-mid    { background-color: #ffe5b4 !important; } /* 5..7 */
    .prio-low    { background-color: #e6f0ff !important; } /* 2..4 */

    /* ===== Vue Cards ===== */
    .cards-toolbar .btn{ border-radius:8px; }
    .cards-grid{ display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:16px; margin-top:16px; }
    .card-row{
        background:#fff; border-radius:14px; padding:16px; box-shadow:0 2px 12px rgba(44,62,80,.08);
        border:1px solid rgba(0,0,0,.04);
    }
    .card-row .row-title{ font-weight:700; color:#2d3651; }
    .card-row .text-muted{ color:#7b8190!important; }
    .badge-status{ font-weight:600; border-radius:999px; padding:.25rem .6rem; }
    .badge-envoi{   background:#d1f3e0; color:#176e3b; }
    .badge-attente{ background:#fff2c6; color:#7a5b00; }
    .badge-livrer{  background:#dce7ff; color:#27418b; }
    .chip-prio{ border-radius:999px; padding:.2rem .55rem; font-weight:700; background:#e6f0ff; color:#27418b; }

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

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 fw-semibold m-0">Mes commandes à envoyer</h1>
            <div class="btn-group cards-toolbar" role="group" aria-label="Changer de vue">
                <button class="btn btn-outline-secondary btn-sm" id="viewTable" type="button">Table</button>
                <button class="btn btn-outline-secondary btn-sm" id="viewCards" type="button">Cards</button>
            </div>
        </div>

        <!-- ===== Vue Cards (avec tes règles PHP de lien suivi) ===== -->
        <div id="cardsView" class="cards-grid d-none">
            <?php if (!empty($commandes)): ?>
                <?php foreach ($commandes as $commande): ?>
                    <?php
                        $priority = (int) $commande->priority_level;
                        $badgeClass = 'badge-attente';
                        if ($commande->statut === 'Prête à envoyer') $badgeClass = 'badge-envoi';
                        elseif ($commande->statut === 'Prête à livrer') $badgeClass = 'badge-livrer';
                    ?>
                    <div class="card-row">
                        <div class="row-title">
                            <?= htmlspecialchars($commande->numero_commande) ?> · <?= htmlspecialchars($commande->nom_client) ?>
                        </div>
                        <div class="text-muted">
                            <?= date('d/m/Y', strtotime($commande->date_commande)) ?>
                            — <span class="badge-status <?= $badgeClass ?>"><?= htmlspecialchars($commande->statut) ?></span>
                        </div>

                        <div class="mt-2">Priorité <span class="chip-prio"><?= $priority ?></span></div>

                        <div class="mt-3">
                            <div class="small text-muted mb-1">Commentaire</div>
                            <form method="post" action="<?= site_url('commandes/modifier_commentaire_envoyeur/' . $commande->id_commande) ?>" class="d-flex align-items-center gap-2">
                                <input type="text" name="commentaire" class="form-control form-control-sm" value="<?= htmlspecialchars($commande->commentaire) ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary" title="Sauvegarder">💾</button>
                            </form>
                        </div>

                        <div class="mt-3">
                            <div class="small text-muted mb-1">Lien de suivi</div>
                            <?php if ($commande->statut === 'Prête à envoyer'): ?>
                                <span class="text-muted">Le lien sera généré à la validation.</span>
                            <?php elseif (!empty($commande->lien_suivi)): ?>
                                <a href="<?= htmlspecialchars($commande->lien_suivi) ?>" target="_blank" rel="noopener">Voir le suivi</a>
                            <?php else: ?>
                                <span class="text-muted"></span>
                            <?php endif; ?>
                        </div>

                        <div class="mt-3 d-flex flex-wrap gap-2">
                            <?php if ($commande->statut == 'Prête à envoyer' || $commande->statut == 'Prête à livrer'): ?>
                                <button type="button" class="btn btn-sm btn-primary btn-view-contenu-commande" data-id="<?= $commande->id_commande ?>">Contenu</button>
                            <?php endif; ?>
                            <?php if ($commande->statut == 'Prête à envoyer'): ?>
                                <form method="post" action="<?= site_url('commandes/demarrer_envoi/' . $commande->id_commande) ?>" onsubmit="return confirm('Êtes-vous sûr de vouloir valider l\'envoi ?');">
                                    <button type="submit" class="btn btn-sm btn-success">Valider</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="card-row">
                    <div class="text-center text-muted">Aucune commande à envoyer</div>
                </div>
            <?php endif; ?>
        </div>

        <!-- ===== Vue Tableau (avec tes modifs PHP) ===== -->
        <table class="table table-striped table-hover" id="tableView">
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
                        if     ($priority >= 8) $rowClass = 'prio-high';
                        elseif ($priority >= 5) $rowClass = 'prio-mid';
                        elseif ($priority >= 2) $rowClass = 'prio-low';
                        else                    $rowClass = '';
                    ?>
                    <tr class="<?= $rowClass ?>">
                        <td class="text-center"><?= htmlspecialchars($commande->numero_commande) ?></td>
                        <td class="text-center"><?= htmlspecialchars($commande->nom_client) ?></td>
                        <td class="text-center"><?= date('d/m/Y', strtotime($commande->date_commande)) ?></td>
                        <td class="text-center"><?= htmlspecialchars($commande->statut) ?></td>
                        <td class="fw-bold text-center"><?= $commande->priority_level ?></td>
                        <td>
                            <form method="post" action="<?= site_url('commandes/modifier_commentaire_envoyeur/' . $commande->id_commande) ?>" class="d-flex align-items-center gap-2">
                                <input type="text" name="commentaire" class="form-control form-control-sm" value="<?= htmlspecialchars($commande->commentaire) ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary">💾</button>
                            </form>
                        </td>
                        <td class="text-center">
                            <?php if ($commande->statut === 'Prête à envoyer'): ?>
                                <span class="text-muted">Le lien sera généré à la validation.</span>
                            <?php elseif (!empty($commande->lien_suivi)): ?>
                                <a href="<?= htmlspecialchars($commande->lien_suivi) ?>" target="_blank" rel="noopener">Voir le suivi</a>
                            <?php else: ?>
                                <span class="text-muted"></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($commande->statut == 'Prête à envoyer' || $commande->statut == 'Prête à livrer'): ?>
                                <button type="button" class="btn btn-sm btn-primary btn-view-contenu-commande" data-id="<?= $commande->id_commande ?>">Contenu</button>
                            <?php endif; ?>
                            <?php if ($commande->statut == 'Prête à envoyer'): ?>
                                <form method="post" action="<?= site_url('commandes/demarrer_envoi/' . $commande->id_commande) ?>" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir valider l\'envoi ?');">
                                    <button type="submit" class="btn btn-sm btn-success">Valider</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="popup-contenu-commande-preparateur" style="display:none;"></div>

<script>
$(document).ready(function () {
    /* --- Popup contenu : ajoute data-order-id à la modale comme demandé --- */
    $(document).on('click', '.btn-view-contenu-commande', function () {
        const commandeId = $(this).data('id');
        $.ajax({
            url: siteUrl + '/commandes/load_contenu_commande_preparateur/' + commandeId,
            method: 'GET',
            success: function (data) {
                $('#popup-contenu-commande-preparateur').remove();
                $('body').append('<div id="popup-contenu-commande-preparateur"></div>');
                $('#popup-contenu-commande-preparateur').html(data);
                // identifiant de commande sur la modale (persistance front)
                $('#popupContenuCommandePreparateur').attr('data-order-id', String(commandeId));
                const popup = new bootstrap.Modal(document.getElementById('popupContenuCommandePreparateur'), {
                    backdrop: 'static',
                    keyboard: false
                });
                popup.show();
                $('#popupContenuCommandePreparateur').on('hidden.bs.modal', function () {
                    $(this).closest('#popup-contenu-commande-preparateur').remove();
                });
            },
            error: function () {
                alert("Erreur lors du chargement du contenu de la commande.");
            }
        });
    });

    /* --- Toggle Table/Cards + persistence locale --- */
    const cardsView   = document.getElementById('cardsView');
    const tableView   = document.getElementById('tableView');
    const viewTableBtn= document.getElementById('viewTable');
    const viewCardsBtn= document.getElementById('viewCards');

    function setView(mode){
        if(mode === 'cards'){
            cardsView.classList.remove('d-none');
            tableView.classList.add('d-none');
        } else {
            cardsView.classList.add('d-none');
            tableView.classList.remove('d-none');
        }
        localStorage.setItem('orders_view', mode);
    }

    // Restaure le dernier choix
    const savedView = localStorage.getItem('orders_view');
    if(savedView === 'cards'){ setView('cards'); }

    viewCardsBtn.addEventListener('click', ()=> setView('cards'));
    viewTableBtn.addEventListener('click', ()=> setView('table'));
});
</script>
