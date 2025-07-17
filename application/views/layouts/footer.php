<?php
if (!isset($user) || in_array($user->id_role, [5, 6])) {
	return;
}
?>

<style>
	/* =============== FOOTER =============== */



	/* =============== FOOTER =============== */

	.footer-infos {
		margin-top: 100px;
		padding-top: 40px;
		padding-bottom: 100px;
		background-color: none;
	}
	.footer-infos .nav {
		border-bottom: solid 0.5px #0000004c !important;
	}

</style>

<footer class="mt-auto text-black-50 footer-infos py-4 border-top ">
   <div class="container">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
         <?php if (in_array($user->id_role, [1, 2, 3, 4])): ?>
            <li class="nav-item">
               <a class="nav-link px-2 text-body-secondary" href="<?=site_url('stocks');?>">Stocks</a>
            </li>
         <?php endif; ?>

         <?php if (in_array($user->id_role, [1, 2, 3])): ?>
            <li class="nav-item">
               <a class="nav-link px-2 text-body-secondary" href="<?=site_url('lots');?>">Lots</a>
            </li>
         <?php endif; ?>

         <?php if (in_array($user->id_role, [1, 2, 3, 4])): ?>
            <li class="nav-item">
               <a class="nav-link px-2 text-body-secondary" href="<?=site_url('commandes')?>">Commandes</a>
            </li>
         <?php endif; ?>

         <?php if (in_array($user->id_role, [1, 2, 3])): ?>
            <li class="nav-item">
               <a class="nav-link px-2 text-body-secondary" href="<?=site_url('clients')?>">Clients</a>
            </li>
         <?php endif; ?>

         <?php if (in_array($user->id_role, [1, 2])): ?>
            <li class="nav-item">
               <a class="nav-link px-2 text-body-secondary" href="<?=site_url('utilisateurs')?>">Utilisateurs</a>
            </li>
         <?php endif; ?>
      </ul>
      <p class="text-center text-body-secondary">
         © <?=date('Y')?> Fashion Chic — Tous droits réservés<br>
         <a href="#" class="text-decoration-none text-body-secondary">Mentions légales</a> ·
         <a href="#" class="text-decoration-none text-body-secondary">Politique de confidentialité</a>
      </p>
   </div>
</footer>
