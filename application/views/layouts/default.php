<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>FASHION-CHIC</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script>
		const siteUrl = "<?= site_url(); ?>";
	</script>
</head>
<body>

<div class="container mt-4">

	<!-- Injection du menu ici -->
	<?php if (!isset($show_menu) || $show_menu): ?>
		<?php $this->load->view('layouts/menu'); ?>
	<?php endif; ?>


	<!-- Injection du contenu des vues ici -->
	<?php if (isset($content)) {
		$this->load->view($content);
	} else {
		echo "<p>Aucune vue de contenu n'a été trouvée.</p>";
	} ?>




</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
