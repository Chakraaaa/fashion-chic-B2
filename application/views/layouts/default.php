<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>FASHION-CHIC</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

	<script>
		const siteUrl = "<?= site_url(); ?>";
	</script>
</head>
<body>

<div>

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

	<?php if (!isset($show_footer) || $show_footer): ?>
		<?php $this->load->view('layouts/footer'); ?>
	<?php endif; ?>



</div>
<script

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
