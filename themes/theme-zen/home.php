<?php include(dirname(__FILE__).'/header.php'); # On insere le header ?>
<div id="content">
	<div id="page">
		<?php while($plxShow->plxMotor->plxRecord_arts->loop()): # On boucle sur les articles ?>
			<div class="article">
				<div class="title">
					<h2><?php $plxShow->artTitle('link'); ?></h2>
					<p class="date"><?php $plxShow->artDate('#num_day&nbsp;#month&nbsp;#num_year(4)');?></p>
					<p class="author"><?php $plxShow->artAuthor() ?></p>
				</div>
				<?php $plxShow->artChapo(); ?>
				<p class="comments"><?php $plxShow->artNbCom(); ?></p>
			</div>
		<?php endwhile; # Fin de la boucle sur les articles ?>		

	<?php # On affiche la pagination ?>
	<div id="pagination"><?php $plxShow->pagination(); ?></div>

	</div>
	<?php include(dirname(__FILE__).'/sidebar.php'); # On insere la barre laterale ?>
</div>
<?php include(dirname(__FILE__).'/footer.php'); # On insere le footer ?>
