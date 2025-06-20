<?php
if (!isset($user) || in_array($user->id_role, [5, 6])) {
	return;
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
					<a class="nav-link" href="<?=site_url('login/logout')?>">Déconnexion</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
