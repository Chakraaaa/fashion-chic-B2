<div class="modal fade" id="popupImportStocks" tabindex="-1" aria-labelledby="popupImportStocksLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form method="post" action="<?= site_url('stocks/import_csv') ?>" enctype="multipart/form-data" class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="popupImportStocksLabel">Importer un fichier CSV</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
			</div>

			<div class="modal-body">
				<div class="mb-3">
					<label for="fichier_csv" class="form-label">Fichier CSV :</label>
					<input type="file" class="form-control" id="fichier_csv" name="fichier_csv" accept=".csv" required>
				</div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Valider</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
			</div>
		</form>
	</div>
</div>
