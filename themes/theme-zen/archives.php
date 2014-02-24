<?php include(dirname(__FILE__).'/header.php'); # On insere le header ?>
<div id="content">
	<div id="page">
		<?php
			$mois	= substr($plxShow->plxMotor->get, 14 );
			$annee	= substr($plxShow->plxMotor->get, 9, 4);
		?>
		<div class="filter">
		<h3><?php $plxShow->lang('ARTICLES_PUBLISHED_IN') ?> <?php echo(plxDate::getCalendar('month',$mois)) ?> <?php echo($annee) ?></h3>
		</div>
		<?php while($plxShow->plxMotor->plxRecord_arts->loop()): # On boucle sur les articles ?>
			<div class="article">
				<div class="title">
					<h2><?php $plxShow->artTitle('link'); ?></h2>
					<p class="date"><?php $plxShow->artDate('#num_day&nbsp;#month&nbsp;#num_year(4)');?></p>
					<p class="author"><?php $plxShow->artAuthor() ?></p>
				</div>

				<?php $plxShow->artChapo("Lire la suite"); ?>
				<p class="comments"><?php $plxShow->artNbCom(); ?></p>
			</div>
		<?php endwhile; # Fin de la boucle sur les articles ?>

		<?php # On affiche la pagination ?>
		<div id="pagination" class="right"><?php $plxShow->pagination(); ?></div>
	</div>
	<?php include(dirname(__FILE__).'/sidebar.php'); # On insere la sidebar ?>
</div>
<?php include(dirname(__FILE__).'/footer.php'); # On insere le footer ?>
