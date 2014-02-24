<?php include(dirname(__FILE__).'/header.php'); # On insere le header ?>
<div id="content">
	<div id="page">
		<div class="filter">
		<h3><?php $plxShow->lang('ARTICLES_CLASSIFIED_IN') ?> &laquo; <?php echo($plxShow->plxMotor->aCats[$plxShow->plxMotor->cible]['name']) ?> &raquo;</h3>
		<?php echo($plxShow->plxMotor->aCats[$plxShow->plxMotor->cible]['description']) ?>
		</div>

		<?php while($plxShow->plxMotor->plxRecord_arts->loop()): # On boucle sur les articles ?>
			<div class="article">
				<div class="title">
					<h2><?php $plxShow->artTitle('link'); ?></h2>
					<p class="date"><?php $plxShow->artDate('#num_day&nbsp;#month&nbsp;#num_year(4)');?></p>
					<p class="author"><?php $plxShow->artAuthor() ?></p>
				</div>
				<?php $plxShow->artChapo("Lire la suite"); ?>
				<p class="comments"><a href="#comments"><?php $plxShow->artNbCom(); ?></a></p>
			</div>
		<?php endwhile; # Fin de la boucle sur les articles ?>
		<p class="feed"><?php $plxShow->artFeed('rss',$plxShow->catId()); ?></p>
		<p id="pagination"><?php $plxShow->pagination(); ?></p>
	</div>
	<?php include(dirname(__FILE__).'/sidebar.php'); # On insere le footer ?>
</div>
<?php include(dirname(__FILE__).'/footer.php'); # On insere le footer ?>
