<?php
if (!isset($user) || in_array($user->id_role, [5, 6])) {
	return;
}
?>

<style>
    .navbar-custom {
        background: linear-gradient(90deg, #2d3651 0%, #667eea 100%);
        box-shadow: 0 2px 12px rgba(44, 62, 80, 0.10);
        margin-bottom: 24px;
    }
    .navbar-custom .navbar-brand {
        font-weight: 700;
        font-size: 1.35rem;
        letter-spacing: 1px;
        color: #fff !important;
        text-shadow: 0 2px 8px rgba(44,62,80,0.10);
    }
    .navbar-custom .nav-link {
        color: #e3e6f0 !important;
        font-weight: 500;
        border-radius: 8px;
        margin-right: 6px;
        transition: background 0.18s, color 0.18s;
    }
    .navbar-custom .nav-link:hover, .navbar-custom .nav-link.active {
        background: #fff;
        color: #667eea !important;
    }
    .navbar-custom .btn-logout {
        background: linear-gradient(90deg, #e74c3c 0%, #ff7675 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        padding: 6px 16px;
        margin-left: 10px;
        box-shadow: 0 1px 4px rgba(44, 62, 80, 0.10);
        transition: background 0.18s, box-shadow 0.18s;
    }
    .navbar-custom .btn-logout:hover {
        background: linear-gradient(90deg, #ff7675 0%, #e74c3c 100%);
        color: #fff;
        box-shadow: 0 4px 16px rgba(231, 76, 60, 0.18);
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">FASHION-CHIC</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="mainNavbar">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">

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

			<ul class="navbar-nav ms-auto">
				<li class="nav-item">
					<a class="btn btn-logout" href="<?=site_url('login/logout')?>">
						<i class="bi bi-box-arrow-right"></i> Déconnexion
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
