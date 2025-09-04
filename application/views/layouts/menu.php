<?php
if (!isset($user) || in_array($user->id_role, [5, 6])) {
	return;
}
?>

<style>
	:root{
		--gold:#ba9b61;
		--gold-2:#c5c1b7;
		--cream:#F0E6D1;
		--ink:#2d3651;
		--light:#e3e6f0;
		--danger-1:#e74c3c;
		--danger-2:#ff7675;
	}

	body{
		background: var(--cream);
		font-family: 'Segoe UI','Roboto',Arial,sans-serif;
	}

	/* NAVBAR */
	.navbar-custom{
		background: var(--gold);
		box-shadow: 0 6px 20px rgba(44,62,80,.12);
		position: sticky; top:0; z-index: 1030;
	}
	.navbar-brand{
		font-weight: 800;
		letter-spacing: .8px;
		color:#fff !important;
		text-shadow: 0 2px 8px rgba(44,62,80,.12);
		display:flex; align-items:center; gap:.6rem;
	}
	.navbar-brand .brand-dot{
		width:12px; height:12px; border-radius:50%;
		background:#fff; opacity:.9; box-shadow:0 0 0 4px rgba(255,255,255,.25) inset;
	}

	/* liens du menu */
	.navbar-custom .nav-link{
		color: #fff !important;
		font-weight: 600;
		border-radius: 999px;
		padding: .5rem .9rem;
		margin: .2rem .25rem;
		position: relative;
		transition: background .2s, color .2s, transform .15s;
	}
	.navbar-custom .nav-link:hover{
		background: rgba(255,255,255,.22);
		color: #1d2235 !important;
		transform: translateY(-1px);
	}
	.navbar-custom .nav-link.active{
		background:#fff;
		color: var(--gold) !important;
		box-shadow: 0 4px 16px rgba(44,62,80,.18);
	}

	/* bouton logout */
	.btn-logout{
		background: linear-gradient(90deg, var(--danger-1) 0%, var(--danger-2) 100%);
		color:#fff; border:none; border-radius: 12px;
		font-weight: 600; padding: .5rem 1rem;
		box-shadow: 0 2px 10px rgba(231,76,60,.25);
		transition: transform .15s ease, box-shadow .2s ease, opacity .2s ease;
		display:inline-flex; align-items:center; gap:.5rem;
	}
	.btn-logout:hover{
		transform: translateY(-1px);
		box-shadow: 0 6px 18px rgba(231,76,60,.35);
		opacity: .95;
		color:#fff;
	}

	/* logo centré, optionnel */
	.nav-divider{
		width:1px; height:28px; background: rgba(255,255,255,.55);
		margin: 0 .75rem; border-radius: 2px;
	}

	/* Toggler (icône burger blanche) */
	.navbar-toggler{
		border: none;
	}
	.navbar-toggler:focus{
		box-shadow: none;
	}
	.navbar-toggler .navbar-toggler-icon{
		filter: invert(1) grayscale(1) brightness(2);
	}

	/* démo de contenu sous la barre */
	.page-demo{
		padding: 24px;
	}
	.card-demo{
		background:#fff; border:none; border-radius:18px;
		box-shadow: 10px 10px #E4D0AA;
		padding: 24px;
	}
	.card-demo h2{
		color: var(--ink);
		margin-bottom: .75rem;
	}
	.muted{
		color:#7b8190;
	}
	/* Palette */
	:root{
		--logout-bg: #ffffff;        /* fond du bouton */
		--logout-text: #ba9b61;      /* texte du bouton */
		--logout-ink: #000000;       /* “middle” */
		--logout-light: #e9e9e9;     /* “light” pour svg doorway */
	}

	/* Bouton logout animé */
	.logoutButton{
		--figure-duration: 100ms;
		--transform-figure: none;
		--walking-duration: 100ms;
		--transform-arm1: none;
		--transform-wrist1: none;
		--transform-arm2: none;
		--transform-wrist2: none;
		--transform-leg1: none;
		--transform-calf1: none;
		--transform-leg2: none;
		--transform-calf2: none;

		background: none;
		border: 0;
		cursor: pointer;
		display: inline-block;
		font-family: 'Segoe UI','Roboto',Arial,sans-serif;
		font-size: 14px;
		font-weight: 600;
		height: 40px;
		padding: 0 0 0 20px;
		perspective: 100px;
		position: relative;
		text-align: left;
		width: 150px;
		-webkit-tap-highlight-color: transparent;
	}

	.logoutButton::before{
		background-color: var(--logout-bg);
		border-radius: 12px;
		content: '';
		display: block;
		height: 100%;
		left: 0;
		position: absolute;
		top: 0;
		transform: none;
		transition: transform 50ms ease, box-shadow .2s ease;
		width: 100%;
		z-index: 2;
		box-shadow: 0 2px 10px rgba(0,0,0,.15);
	}

	.logoutButton:hover .door{ transform: rotateY(20deg); }
	.logoutButton:active::before{ transform: scale(.96); }
	.logoutButton:active .door{ transform: rotateY(28deg); }

	/* états */
	.logoutButton.clicked .door{ transform: rotateY(35deg); }
	.logoutButton.door-slammed .door{
		transform: none;
		transition: transform 100ms ease-in 250ms;
	}
	.logoutButton.falling{
		animation: shake 200ms linear;
	}
	.logoutButton.falling .bang{ animation: flash 300ms linear; }
	.logoutButton.falling .figure{
		animation: spin 1000ms infinite linear;
		bottom: -1080px; opacity: 0; right: 1px;
		transition:
			transform calc(var(--figure-duration)) linear,
			bottom calc(var(--figure-duration)) cubic-bezier(0.7, 0.1, 1, 1) 100ms,
			opacity calc(var(--figure-duration) * 0.25) linear calc(var(--figure-duration) * 0.75);
		z-index: 1;
	}

	/* variante thème nav (texte or, fond blanc) */
	.logoutButton--nav .button-text{ color: var(--logout-text); }
	.logoutButton--nav .door,
	.logoutButton--nav .doorway{ fill: var(--logout-bg); }

	.button-text{
		line-height: 40px;                   /* centre verticalement */
		display: inline-block;
		padding-left: 74px;                  /* garde l’espace pour les SVG */
	}

	svg{ display: block; position: absolute; }
	.figure{
		bottom: 5px; right: 18px; width: 30px; z-index: 4;
		fill: var(--logout-ink);
		transform: var(--transform-figure);
		transition: transform calc(var(--figure-duration)) cubic-bezier(0.2, 0.1, 0.80, 0.9);
	}
	.door, .doorway{
		bottom: 4px; right: 12px; width: 32px;
		fill: var(--logout-light);
	}
	.door{
		transform: rotateY(20deg);
		transform-origin: 100% 50%;
		transform-style: preserve-3d;
		transition: transform 200ms ease;
		z-index: 5;
	}
	.door path{
		fill: var(--logout-ink);
		stroke: var(--logout-ink);
		stroke-width: 4;
	}
	.doorway{ z-index: 3; }
	.bang{ opacity: 0; }

	.arm1,.wrist1,.arm2,.wrist2,.leg1,.calf1,.leg2,.calf2{
		transition: transform calc(var(--walking-duration)) ease-in-out;
	}
	.arm1{ transform: var(--transform-arm1); transform-origin: 52% 45%; }
	.wrist1{ transform: var(--transform-wrist1); transform-origin: 59% 55%; }
	.arm2{ transform: var(--transform-arm2); transform-origin: 47% 43%; }
	.wrist2{ transform: var(--transform-wrist2); transform-origin: 35% 47%; }
	.leg1{ transform: var(--transform-leg1); transform-origin: 47% 64.5%; }
	.calf1{ transform: var(--transform-calf1); transform-origin: 55.5% 71.5%; }
	.leg2{ transform: var(--transform-leg2); transform-origin: 43% 63%; }
	.calf2{ transform: var(--transform-calf2); transform-origin: 41.5% 73%; }

	/* animations */
	@keyframes spin {
		from { transform: rotate(0deg) scale(0.94); }
		to   { transform: rotate(359deg) scale(0.94); }
	}
	@keyframes shake {
		0% { transform: rotate(-1deg); }
		50% { transform: rotate(2deg); }
		100% { transform: rotate(-1deg); }
	}
	@keyframes flash {
		0% { opacity: 0.4; }
		100% { opacity: 0; }
	}


</style>

<nav class="navbar navbar-expand-lg navbar-custom">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">FASHION-CHIC</a>
		<div class="card-header text-white text-center">
			<img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo de l'entreprise" style="max-height: 70px; display: block; margin-left: auto; margin-right: auto;">
		</div>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
			<!-- Centrer les liens de navigation -->
			<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
				<?php if (in_array($user->id_role, [1, 2, 3, 4])): ?>
					<li class="nav-item">
						<a class="nav-link" href="<?=site_url('stocks');?>">Stocks</a>
					</li>
				<?php endif; ?>

				<?php if (in_array($user->id_role, [1, 2, 3])): ?>
					<li class="nav-item">
						<a class="nav-link" href="<?=site_url('lots');?>">Lots</a>
					</li>
				<?php endif; ?>

				<?php if (in_array($user->id_role, [1, 2, 3, 4])): ?>
					<li class="nav-item">
						<a class="nav-link" href="<?=site_url('commandes')?>">Commandes</a>
					</li>
				<?php endif; ?>

				<?php if (in_array($user->id_role, [1, 2, 3])): ?>
					<li class="nav-item">
						<a class="nav-link" href="<?=site_url('clients')?>">Clients</a>
					</li>
				<?php endif; ?>

				<?php if (in_array($user->id_role, [1, 2])): ?>
					<li class="nav-item">
						<a class="nav-link" href="<?=site_url('utilisateurs')?>">Utilisateurs</a>
					</li>
				<?php endif; ?>
			</ul>

			<!-- Bouton de déconnexion à droite -->
			<ul class="navbar-nav ms-lg-auto mt-2 mt-lg-0">
				<li class="nav-item">
					<a href="<?= site_url('login/logout') ?>" class="logoutButton logoutButton--nav" id="btn-logout">
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
						<span class="button-text">Log out</span>
					</a>
				</li>
			</ul>

		</div>
	</div>
</nav>
<script>
	// Démo : active nav
	document.querySelectorAll('.navbar .nav-link').forEach(link=>{
		link.addEventListener('click', (e)=>{
			document.querySelectorAll('.navbar .nav-link').forEach(l=>l.classList.remove('active'));
			e.currentTarget.classList.add('active');
		});
	});

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

		const updateButtonState = (btn, state) => {
			const def = logoutButtonStates[state];
			if (!def) return;
			btn.state = state;
			Object.keys(def).forEach(k => btn.style.setProperty(k, def[k]));
		};

		button.addEventListener('mouseenter', () => {
			if (button.state === 'default') updateButtonState(button, 'hover');
		});
		button.addEventListener('mouseleave', () => {
			if (button.state === 'hover') updateButtonState(button, 'default');
		});

		button.addEventListener('click', (e) => {
			// Empêche la déconnexion immédiate
			e.preventDefault();

			// URL cible (si <a href="...">)
			const url = button.getAttribute('href') || button.dataset.href;
			if (!url) {
				console.warn('Aucune URL de logout trouvée (href ou data-href).');
			}

			if (button.state === 'default' || button.state === 'hover') {
				button.classList.add('clicked');
				updateButtonState(button, 'walking1');

				// Lance la redirection après 2000 ms (2s)
				const redirectTimer = setTimeout(() => {
					if (url) window.location.href = url;
				}, 2000);

				setTimeout(() => {
					button.classList.add('door-slammed');
					updateButtonState(button, 'walking2');
					setTimeout(() => {
						button.classList.add('falling');
						updateButtonState(button, 'falling1');
						setTimeout(() => {
							updateButtonState(button, 'falling2');
							setTimeout(() => {
								updateButtonState(button, 'falling3');
								setTimeout(() => {
									// reset visuel si jamais la redirection était annulée
									button.classList.remove('clicked','door-slammed','falling');
									updateButtonState(button, 'default');
								}, 900);
							}, 500);
						}, 300);
					}, 400);
				}, 300);
			}
		});
	});
</script>

