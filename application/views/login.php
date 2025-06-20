<!-- Ajout des icônes Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="row justify-content-center mt-5">
	<div class="col-md-6 col-lg-4">
		<div class="card shadow">
			<div class="card-header bg-primary text-white text-center">
				<img src="C:\wamp64\www\fashion-chic\assets\images\logo.png" alt="Logo de l'entreprise" class="mb-2" style="max-height: 60px;">
				<h4 class="mb-0">Connexion</h4>
			</div>
			<div class="card-body p-4">

				<?php if (isset($error) && !empty($error)): ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="fas fa-exclamation-triangle me-2"></i><?= $error ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
				<?php endif; ?>

				<?php if (isset($success) && !empty($success)): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="fas fa-check-circle me-2"></i><?= $success ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
				<?php endif; ?>

				<form method="POST" action="<?= site_url('login/authentifier') ?>">
					<?php if ($this->security->get_csrf_token_name()): ?>
						<input type="hidden"
							   name="<?= $this->security->get_csrf_token_name() ?>"
							   value="<?= $this->security->get_csrf_hash() ?>">
					<?php endif; ?>

					<div class="mb-3">
						<label for="email" class="form-label">
							<i class="fas fa-envelope me-2"></i>Adresse email
						</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
					</div>

					<div class="mb-3">
						<label for="mot_de_passe" class="form-label">
							<i class="fas fa-lock me-2"></i>Mot de passe
						</label>
						<input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" required>
					</div>

					<div class="d-grid">
						<button type="submit" class="btn btn-primary btn-lg">
							Se connecter
						</button>
					</div>
				</form>

				<div class="text-center mt-3">
					<small class="text-muted">
						Mot de passe oublié ? <a href="#" class="text-decoration-none">Cliquez ici</a>
					</small>
				</div>

			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
