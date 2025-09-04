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
		color: black;
        box-shadow: 0 4px 16px rgba(44, 62, 80, 0.12);
    }
    .btn-info {
        background: linear-gradient(90deg, #36d1c4 0%, #5b86e5 100%);
        color: #fff; border: none; border-radius: 8px; font-weight: 500; margin-right: 4px;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
    }
    .btn-info:hover {
        background: linear-gradient(90deg, #5b86e5 0%, #36d1c4 100%);
        color: #fff; transform: scale(1.08);
        box-shadow: 0 4px 16px rgba(91, 134, 229, 0.18);
    }
    .btn-secondary {
        border-radius: 8px; font-weight: 500; margin-left: 4px;
        transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
    }
    .btn-secondary:hover {
        background: #e9edfa; color: #2d3651; transform: scale(1.08);
        box-shadow: 0 4px 16px rgba(44, 62, 80, 0.10);
    }

    .table {
        border-radius: 14px; overflow: hidden; box-shadow: 0 2px 12px rgba(44, 62, 80, 0.06); background: #fff;
    }
    .table thead th {
		background-color: #ba9b61; color: #fff; font-weight: 600; border: none; padding: 16px 12px; letter-spacing: 0.5px;
    }
    .table-striped > tbody > tr:nth-of-type(odd) { background-color: #f6f7fb; }
    .table-hover tbody tr:hover { background-color: #e9edfa; transition: background-color 0.2s; }
    .table tbody tr {
        transition: box-shadow 0.2s, background 0.2s, border-left 0.2s;
        border-left: 4px solid transparent; border-bottom: 1.5px solid #e3e6f0;
    }
    .table tbody tr:hover {
        background: #f0f4ff; box-shadow: 0 2px 12px rgba(102, 126, 234, 0.10); border-left: 4px solid #667eea;
    }

    /* Couleurs de priorité (table) */
    .prio-high { background-color: #ffcccc !important; } /* >=8 */
    .prio-mid  { background-color: #ffe5b4 !important; } /* 5..7 */
    .prio-low  { background-color: #e6f0ff !important; } /* 2..4 */

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
    .badge-attente{ background:#fff2c6; color:#7a5b00; }  /* En attente */
    .badge-prepa  { background:#d1f3e0; color:#176e3b; }  /* En préparation (vert, style “envoi”) */
    .chip-prio{ border-radius:999px; padding:.2rem .55rem; font-weight:700; background:#e6f0ff; color:#27418b; }

	/* ---- Fix conteneur (aligner à droite dans la card) ---- */
	.logout-wrap{ display:flex; justify-content:flex-end; margin-bottom:12px; }

	/* ---- Bouton logout animé (version compacte) ---- */
	:root{
		--logout-bg:#ffffff; --logout-text:#ba9b61; --logout-ink:#000000; --logout-light:#e9e9e9;
	}
	.logoutButton{ --figure-duration:100ms; --transform-figure:none; --walking-duration:100ms;
		--transform-arm1:none; --transform-wrist1:none; --transform-arm2:none; --transform-wrist2:none;
		--transform-leg1:none; --transform-calf1:none; --transform-leg2:none; --transform-calf2:none;
		position:relative; display:inline-block; height:38px; width:128px; padding-left:16px;
		background:none; border:0; cursor:pointer; font:600 14px 'Segoe UI','Roboto',Arial,sans-serif;
		-webkit-tap-highlight-color:transparent;
	}
	.logoutButton::before{ content:''; position:absolute; inset:0; background-color:var(--logout-bg);
		border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,.14);
		transition:transform 50ms ease, box-shadow .2s ease; z-index:2;
	}
	.logoutButton:hover .door{ transform: rotateY(20deg); }
	.logoutButton:active::before{ transform: scale(.97); }
	.logoutButton:active .door{ transform: rotateY(26deg); }
	.logoutButton.clicked .door{ transform: rotateY(32deg); }
	.logoutButton.door-slammed .door{ transform:none; transition: transform 100ms ease-in 250ms; }
	.logoutButton.falling{ animation: shake 200ms linear; }
	.logoutButton.falling .bang{ animation: flash 300ms linear; }
	.logoutButton.falling .figure{
		animation: spin 1000ms infinite linear; bottom:-1080px; opacity:0; right:1px;
		transition: transform var(--figure-duration) linear,
		           bottom var(--figure-duration) cubic-bezier(0.7,0.1,1,1) 100ms,
		           opacity calc(var(--figure-duration)*.25) linear calc(var(--figure-duration)*.75);
		z-index:1;
	}
	.logoutButton--nav .button-text{ color:var(--logout-text); }
	.logoutButton--nav .door, .logoutButton--nav .doorway{ fill:var(--logout-bg); }
	.logoutButton svg{ position:absolute; display:block; }
	.logoutButton .figure{ bottom:4px; right:14px; width:24px; z-index:4; fill:var(--logout-ink);
		transform:var(--transform-figure); transition: transform var(--figure-duration) cubic-bezier(0.2,0.1,0.80,0.9);
	}
	.logoutButton .door, .logoutButton .doorway{ bottom:3px; right:9px; width:26px; fill:var(--logout-light); }
	.logoutButton .door{ transform:rotateY(18deg); transform-origin:100% 50%; transform-style:preserve-3d; transition:200ms ease; z-index:5; }
	.logoutButton .door path{ fill:var(--logout-ink); stroke:var(--logout-ink); stroke-width:4; }
	.logoutButton .doorway{ z-index:3; }
	.logoutButton .bang{ opacity:0; }
	.logoutButton .arm1,.logoutButton .wrist1,.logoutButton .arm2,.logoutButton .wrist2,.logoutButton .leg1,.logoutButton .calf1,.logoutButton .leg2,.logoutButton .calf2{ transition: transform var(--walking-duration) ease-in-out; }

	@keyframes spin{ from{transform:rotate(0) scale(.94)} to{transform:rotate(359deg) scale(.94)} }
	@keyframes shake{ 0%{transform:rotate(-1deg)} 50%{transform:rotate(2deg)} 100%{transform:rotate(-1deg)} }
	@keyframes flash{ 0%{opacity:.4} 100%{opacity:0} }
</style>

<div class="container-fluid mt-4">
	<!-- Bouton Déconnexion animé (conservé) -->
	<div class="logout-wrap">
		<a href="<?= site_url('login/logout') ?>" class="logoutButton logoutButton--nav" id="btn-logout" title="Déconnexion">
			<svg class="doorway" viewBox="0 0 100 100" aria-hidden="true">
				<path d="M93.4 86.3H58.6c-1.9 0-3.4-1.5-3.4-3.4V17.1c0-1.9 1.5-3.4 3.4-3.4h34.8c1.9 0 3.4 1.5 3.4 3.4v65.8c0 1.9-1.5 3.4-3.4 3.4z" />
				<path class="bang" d="M40.5 43.7L26.6 31.4l-2.5 6.7zM41.9 50.4l-19.5-4-1.4 6.3zM40 57.4l-17.7 3.9 3.9 5.7z" />
			</svg>
			<svg class="figure" viewBox="0 0 100 100" aria-hidden="true">
				<circle cx="52.1" cy="32.4" r="6.4" />
				<path d="M50.7 62.8c-1.2 2.5-3.6 5-7.2 4-3.2-.9-4.9-3.5-4-7.8.7-3.4 3.1-13.8 4.1-15.8 1.7-3.4 1.6-4.6 7-3.7 4.3.7 4.6 2.5 4.3 5.4-.4 3.7-2.8 15.1-4.2 17.9z" />
				<g class="arm1">
					<path d="M55.5 56.5l-6-9.5c-1-1.5-.6-3.5.9-4.4 1.5-1 3.7-1.1 4.6.4l6.1 10c1 1.5.3 3.5-1.1 4.4-1.5.9-3.5.5-4.5-.9z" />
					<path class="wrist1" d="M69.4 59.9L58.1 58c-1.7-.3-2.9-1.9-2.6-3.7.3-1.7 1.9-2.9 3.7-2.6l11.4 1.9c1.7.3 2.9 1.9 2.6 3.7-.4 1.7-2 2.9-3.8 2.6z" />
				</g>
				<g class="arm2">
					<path d="M34.2 43.6L45 40.3c1.7-.6 3.5.3 4 2 .6 1.7-.3 4-2 4.5l-10.8 2.8c-1.7.6-3.5-.3-4-2-.6-1.6.3-3.4 2-4z" />
					<path class="wrist2" d="M27.1 56.2L32 45.7c.7-1.6 2.6-2.3 4.2-1.6 1.6.7 2.3 2.6 1.6 4.2L33 58.8c-.7 1.6-2.6 2.3-4.2 1.6-1.7-.7-2.4-2.6-1.7-4.2z" />
				</g>
				<g class="leg1">
					<path d="M52.1 73.2s-7-5.7-7.9-6.5c-.9-.9-1.2-3.5-.1-4.9 1.1-1.4 3.8-1.9 5.2-.9l7.9 7c1.4 1.1 1.7 3.5.7 4.9-1.1 1.4-4.4 1.5-5.8.4z" />
					<path class="calf1" d="M52.6 84.4l-1-12.8c-.1-1.9 1.5-3.6 3.5-3.7 2-.1 3.7 1.4 3.8 3.4l1 12.8c.1 1.9-1.5 3.6-3.5 3.7-2 0-3.7-1.5-3.8-3.4z" />
				</g>
				<g class="leg2">
					<path d="M37.8 72.7s1.3-10.2 1.6-11.4 2.4-2.8 4.1-2.6c1.7.2 3.6 2.3 3.4 4l-1.8 11.1c-.2 1.7-1.7 3.3-3.4 3.1-1.8-.2-4.1-2.4-3.9-4.2z" />
					<path class="calf2" d="M29.5 82.3l9.6-10.9c1.3-1.4 3.6-1.5 5.1-.1 1.5 1.4.4 4.9-.9 6.3l-8.5 9.6c-1.3 1.4-3.6 1.5-5.1.1-1.4-1.3-1.5-3.5-.2-5z" />
				</g>
			</svg>
			<svg class="door" viewBox="0 0 100 100" aria-hidden="true">
				<path d="M93.4 86.3H58.6c-1.9 0-3.4-1.5-3.4-3.4V17.1c0-1.9 1.5-3.4 3.4-3.4h34.8c1.9 0 3.4 1.5 3.4 3.4v65.8c0 1.9-1.5 3.4-3.4 3.4z" />
				<circle cx="66" cy="50" r="3.7" />
			</svg>
		</a>
	</div>

    <div class="main-card">
		<div class="d-flex justify-content-between align-items-center mb-3">
			<h1 class="h4 fw-semibold m-0">Mes commandes à préparer</h1>
			<div class="btn-group cards-toolbar" role="group" aria-label="Changer de vue">
				<button class="btn btn-outline-secondary btn-sm" id="viewTable" type="button">Table</button>
				<button class="btn btn-outline-secondary btn-sm" id="viewCards" type="button">Cards</button>
			</div>
		</div>

		<!-- ===== Vue Cards (PHP conservé) ===== -->
		<div id="cardsView" class="cards-grid d-none">
			<?php if (!empty($commandes)): ?>
				<?php foreach ($commandes as $commande): ?>
					<?php
						$priority   = (int) $commande->priority_level;
						$badgeClass = ($commande->statut === 'En préparation') ? 'badge-prepa'
						            : (($commande->statut === 'En attente') ? 'badge-attente' : 'badge-attente');
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
							<form method="post" action="<?= site_url('commandes/modifier_commentaire_preparateur/' . $commande->id_commande) ?>" class="d-flex align-items-center gap-2">
								<input type="text" name="commentaire" class="form-control form-control-sm" value="<?= htmlspecialchars($commande->commentaire) ?>">
								<button type="submit" class="btn btn-sm btn-outline-primary" title="Sauvegarder">💾</button>
							</form>
						</div>

						<div class="mt-3 d-flex flex-wrap gap-2">
							<?php if ($commande->statut == 'En attente' || $commande->statut == 'En préparation'): ?>
								<button type="button" class="btn btn-sm btn-primary btn-view-contenu-commande" data-id="<?= $commande->id_commande ?>">Contenu</button>
							<?php endif; ?>
							<?php if ($commande->statut == 'En préparation' || $commande->statut == 'En attente'): ?>
								<form method="post" action="<?= site_url('commandes/valider_preparation/' . $commande->id_commande) ?>" onsubmit="return confirm('Êtes-vous sûr de vouloir valider ?');">
									<button type="submit" class="btn btn-sm btn-success">Valider</button>
								</form>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="card-row">
					<div class="text-center text-muted">Aucune commande à préparer</div>
				</div>
			<?php endif; ?>
		</div>

        <!-- ===== Vue Tableau (existante) ===== -->
        <table class="table table-striped table-hover" id="tableView">
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
                        Aucune commande à préparer
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($commandes as $commande): ?>
                    <?php
                    $priority = (int) $commande->priority_level;
                    if     ($priority >= 8) $bg = 'style="background-color:#ffcccc"';
                    elseif ($priority >= 5) $bg = 'style="background-color:#ffe5b4"';
                    elseif ($priority >= 2) $bg = 'style="background-color:#e6f0ff"';
                    else                    $bg = '';
                    ?>
                    <tr <?= $bg ?>>
                        <td><?= htmlspecialchars($commande->numero_commande) ?></td>
                        <td><?= htmlspecialchars($commande->nom_client) ?></td>
                        <td><?= date('d/m/Y', strtotime($commande->date_commande)) ?></td>
                        <td><?= htmlspecialchars($commande->statut) ?></td>
                        <td class="fw-bold text-center"> <?= $commande->priority_level ?> </td>
                        <td>
                            <form method="post" action="<?= site_url('commandes/modifier_commentaire_preparateur/' . $commande->id_commande) ?>" class="d-flex align-items-center gap-2">
                                <input type="text" name="commentaire" class="form-control form-control-sm" value="<?= htmlspecialchars($commande->commentaire) ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary">💾</button>
                            </form>
                        </td>
                        <td>
                            <?php if ($commande->statut == 'En attente' || $commande->statut == 'En préparation'): ?>
                                <button type="button" class="btn btn-sm btn-primary btn-view-contenu-commande" data-id="<?= $commande->id_commande ?>">Contenu</button>
                            <?php endif; ?>
                            <?php if ($commande->statut == 'En préparation' || $commande->statut == 'En attente'): ?>
								<form method="post" action="<?= site_url('commandes/valider_preparation/' . $commande->id_commande) ?>" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir valider ?');">
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
  /* --- Popup contenu --- */
  $(document).on('click', '.btn-view-contenu-commande', function () {
    const commandeId = $(this).data('id');
    $.ajax({
      url: siteUrl + '/commandes/load_contenu_commande_preparateur/' + commandeId,
      method: 'GET',
      success: function (data) {
        $('#popup-contenu-commande-preparateur').remove();
        $('body').append('<div id="popup-contenu-commande-preparateur"></div>');
        $('#popup-contenu-commande-preparateur').html(data);

        const popup = new bootstrap.Modal(
          document.getElementById('popupContenuCommandePreparateur'),
          { backdrop: 'static', keyboard: false }
        );
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

  /* --- Toggle Table/Cards + persistence --- */
  const cardsView    = document.getElementById('cardsView');
  const tableView    = document.getElementById('tableView');
  const viewTableBtn = document.getElementById('viewTable');
  const viewCardsBtn = document.getElementById('viewCards');

  function setView(mode){
    if(mode === 'cards'){
      cardsView.classList.remove('d-none');
      tableView.classList.add('d-none');
    } else {
      cardsView.classList.add('d-none');
      tableView.classList.remove('d-none');
    }
    localStorage.setItem('prep_view', mode);
  }

  const savedView = localStorage.getItem('prep_view');
  if(savedView === 'cards'){ setView('cards'); }

  viewCardsBtn.addEventListener('click', ()=> setView('cards'));
  viewTableBtn.addEventListener('click', ()=> setView('table'));
});

/* --- Bouton Déconnexion animé --- */
const logoutButtonStates = {
  'default': {'--figure-duration':'100ms','--transform-figure':'none','--walking-duration':'100ms','--transform-arm1':'none','--transform-wrist1':'none','--transform-arm2':'none','--transform-wrist2':'none','--transform-leg1':'none','--transform-calf1':'none','--transform-leg2':'none','--transform-calf2':'none'},
  'hover':   {'--figure-duration':'100ms','--transform-figure':'translateX(1.5px)','--walking-duration':'100ms','--transform-arm1':'rotate(-5deg)','--transform-wrist1':'rotate(-15deg)','--transform-arm2':'rotate(5deg)','--transform-wrist2':'rotate(6deg)','--transform-leg1':'rotate(-10deg)','--transform-calf1':'rotate(5deg)','--transform-leg2':'rotate(20deg)','--transform-calf2':'rotate(-20deg)'},
  'walking1':{'--figure-duration':'300ms','--transform-figure':'translateX(11px)','--walking-duration':'300ms','--transform-arm1':'translateX(-4px) translateY(-2px) rotate(120deg)','--transform-wrist1':'rotate(-5deg)','--transform-arm2':'translateX(4px) rotate(-110deg)','--transform-wrist2':'rotate(-5deg)','--transform-leg1':'translateX(-3px) rotate(80deg)','--transform-calf1':'rotate(-30deg)','--transform-leg2':'translateX(4px) rotate(-60deg)','--transform-calf2':'rotate(20deg)'},
  'walking2':{'--figure-duration':'400ms','--transform-figure':'translateX(17px)','--walking-duration':'300ms','--transform-arm1':'rotate(60deg)','--transform-wrist1':'rotate(-15deg)','--transform-arm2':'rotate(-45deg)','--transform-wrist2':'rotate(6deg)','--transform-leg1':'rotate(-5deg)','--transform-calf1':'rotate(10deg)','--transform-leg2':'rotate(10deg)','--transform-calf2':'rotate(-20deg)'},
  'falling1':{'--figure-duration':'1600ms','--walking-duration':'400ms','--transform-arm1':'rotate(-60deg)','--transform-wrist1':'none','--transform-arm2':'rotate(30deg)','--transform-wrist2':'rotate(120deg)','--transform-leg1':'rotate(-30deg)','--transform-calf1':'rotate(-20deg)','--transform-leg2':'rotate(20deg)'},
  'falling2':{'--walking-duration':'300ms','--transform-arm1':'rotate(-100deg)','--transform-arm2':'rotate(-60deg)','--transform-wrist2':'rotate(60deg)','--transform-leg1':'rotate(80deg)','--transform-calf1':'rotate(20deg)','--transform-leg2':'rotate(-60deg)'},
  'falling3':{'--walking-duration':'500ms','--transform-arm1':'rotate(-30deg)','--transform-wrist1':'rotate(40deg)','--transform-arm2':'rotate(50deg)','--transform-wrist2':'none','--transform-leg1':'rotate(-30deg)','--transform-leg2':'rotate(20deg)','--transform-calf2':'none'}
};

document.querySelectorAll('.logoutButton').forEach(button => {
  button.state = 'default';

  const setState = (btn, state) => {
    const def = logoutButtonStates[state];
    if (!def) return;
    btn.state = state;
    Object.keys(def).forEach(k => btn.style.setProperty(k, def[k]));
  };

  button.addEventListener('mouseenter', () => {
    if (button.state === 'default') setState(button, 'hover');
  });

  button.addEventListener('mouseleave', () => {
    if (button.state === 'hover') setState(button, 'default');
  });

  button.addEventListener('click', (e) => {
    e.preventDefault();
    const url = button.getAttribute('href');

    if (button.state === 'default' || button.state === 'hover') {
      button.classList.add('clicked');
      setState(button, 'walking1');

      // Redirection après 2s
      setTimeout(() => { if (url) window.location.href = url; }, 2000);

      // Séquence visuelle (facultative)
      setTimeout(() => {
        button.classList.add('door-slammed');
        setState(button, 'walking2');
        setTimeout(() => {
          button.classList.add('falling');
          setState(button, 'falling1');
          setTimeout(() => {
            setState(button, 'falling2');
            setTimeout(() => {
              setState(button, 'falling3');
              setTimeout(() => {
                // Reset visuel si jamais la redirection était annulée
                button.classList.remove('clicked','door-slammed','falling');
                setState(button, 'default');
              }, 900);
            }, 500);
          }, 300);
        }, 400);
      }, 300);
    }
  });
});
</script>

