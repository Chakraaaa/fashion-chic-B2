$(document).ready(function() {

	// Gestion de l'ajout d'utilisateur
	$('#btnSauvegarder').on('click', function() {
		const $form = $('#formAjouterUtilisateur');
		const $btn = $(this);
		const formData = new FormData($form[0]);

		// Réinitialiser les erreurs
		$('.is-invalid').removeClass('is-invalid');

		// Désactiver le bouton pendant la requête
		$btn.prop('disabled', true).html('Création...');

		$.ajax({
			url: '<?= site_url('admin/ajouter_utilisateur') ?>',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(data) {
			if (data.success) {
				// Succès : recharger la page pour voir le nouvel utilisateur
				$('#modalAjouterUtilisateur').modal('hide');
				location.reload();
			} else {
				// Erreurs de validation
				if (data.errors) {
					$.each(data.errors, function(field, error) {
						if (error) {
							const $input = $('#' + field);
							$input.addClass('is-invalid');
							$input.next('.invalid-feedback').text(error.replace(/<[^>]*>/g, ''));
						}
					});
				}
			}
		},
		error: function(xhr, status, error) {
			console.error('Erreur:', error);
			alert('Erreur de communication avec le serveur');
		},
		complete: function() {
			// Réactiver le bouton
			$btn.prop('disabled', false).html('Créer l\'utilisateur');
		}
	});
	});

	// Réinitialiser les erreurs quand on ferme la modal
	$('#modalAjouterUtilisateur').on('hidden.bs.modal', function() {
		$('#formAjouterUtilisateur')[0].reset();
		$('.is-invalid').removeClass('is-invalid');
	});

});

// Fonction de confirmation de suppression (globale)
function confirmerSuppression(id, nom) {
	$('#nomUtilisateurSuppression').text(nom);
	$('#lienSuppression').attr('href', '<?= site_url('admin/supprimer_utilisateur/') ?>' + id);
	$('#modalSuppression').modal('show');
}
