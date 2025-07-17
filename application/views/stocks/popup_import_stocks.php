<style>
	.modal-title {
		text-align: center;
		width: 100%;
		margin: 0 auto;

	}
	.modal-content {
		border-radius: 16px;
		box-shadow: 0 8px 32px rgba(44, 62, 80, 0.12);
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
	.modal-footer {
		border: none;
		background: none;

	}
</style>


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
