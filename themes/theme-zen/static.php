<?php include(dirname(__FILE__).'/header.php'); # On insere le header ?>
<div id="content">
	<div id="page">
		<h2><?php $plxShow->staticTitle(); ?></h2>
		<?php $plxShow->staticContent(); ?>
	</div>
	<?php include(dirname(__FILE__).'/sidebar.php'); # On insere la sidebar ?>
</div>
<?php include(dirname(__FILE__).'/footer.php'); # On insere le footer ?>
