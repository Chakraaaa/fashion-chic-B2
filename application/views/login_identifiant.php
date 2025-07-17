<style>
	body {
		background: #F0E6D1;
		font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
	}
    .card {
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(44, 62, 80, 0.10);
        border: none;
        background: #fff;
    }
    .card-header {
		background: linear-gradient(90deg, #ba9b61 0%, #E4D0AA 100%) !important;
        color: #fff !important;
        border-radius: 18px 18px 0 0 !important;
        border-bottom: none;
        padding: 1.5rem 1rem;
    }
    .form-label {
        color: #2d3651;
        font-weight: 500;
    }
    .form-control {
        border-radius: 8px;
        border: 1.5px solid #e3e6f0;
        box-shadow: none;
        transition: border-color 0.2s;
    }
    .form-control:focus {
		border-color: #ba9b61;
		box-shadow: 0 0 0 2px #ba9b61;
    }
    .btn-primary, .btn-primary:focus {
		background: linear-gradient(90deg, #ba9b61 0%, #E4D0AA 100%) !important;
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
    .alert {
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 1rem;
    }
    .text-muted a {
        color: #667eea !important;
        transition: color 0.2s;
    }
    .text-muted a:hover {
        color: #2d3651 !important;
        text-decoration: underline;
    }
    @media (max-width: 768px) {
        .card {
            border-radius: 12px;
        }
        .card-header {
            border-radius: 12px 12px 0 0 !important;
            padding: 1rem 0.5rem;
        }
        .card-body {
            padding: 1.2rem !important;
        }
    }
</style>

<!-- Ajout des icônes Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="row justify-content-center mt-5">
	<div class="col-md-6 col-lg-4">
		<div class="card shadow">
			<div class="card-header text-white text-center">
			<img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo de l'entreprise" style="max-height: 110px; display: block; margin-left: auto; margin-right: auto;">
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

				<form method="POST" action="<?= site_url('login/authentifier_identifiant') ?>">
					<?php if ($this->security->get_csrf_token_name()): ?>
						<input type="hidden"
							   name="<?= $this->security->get_csrf_token_name() ?>"
							   value="<?= $this->security->get_csrf_hash() ?>">
					<?php endif; ?>

					<div class="mb-3">
						<label for="identifiant" class="form-label">
							<i class="fas fa-user me-2"></i>Identifiant unique
						</label>
						<input type="text" class="form-control" id="identifiant" name="identifiant" placeholder="Votre identifiant unique" required>
					</div>

					<div class="d-grid">
						<button type="submit" class="btn btn-primary btn-lg">
							Se connecter
						</button>
					</div>
				</form>

				<div class="text-center mt-3">
					<small class="text-muted">
						<a href="<?= site_url('login') ?>" class="text-decoration-none">Se connecter avec mon email</a>
					</small>
				</div>

			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
