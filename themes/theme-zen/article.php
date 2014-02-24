<?php include(dirname(__FILE__).'/header.php'); # On insere le header ?>
<div id="content">
	<div id="page">
		<div class="article">
			<div class="title">
				<h2><?php $plxShow->artTitle('link'); ?></h2>
				<p class="date"><?php $plxShow->artDate('#num_day&nbsp;#month&nbsp;#num_year(4)');?></p>
				<p class="author"><?php $plxShow->artAuthor() ?></p>
			</div>

			<?php $plxShow->artContent(); ?>
			<p class="categories"><?php $plxShow->lang('ASSIGNED_CATEGORIES') ?>&nbsp;: <?php $plxShow->artCat(); ?></p>
			<p class="tags"><?php $plxShow->lang('ASSIGNED_TAGS') ?>&nbsp;: <?php $plxShow->artTags('<a class="#tag_status" href="#tag_url" title="#tag_name">#tag_name</a>'); ?></p>
	
			<?php $plxShow->artAuthorInfos('<div class="infos">#art_authorinfos</div>'); ?>

		</div>
		<?php include(dirname(__FILE__).'/commentaires.php'); # On insere les commentaires ?>
	</div>
	<?php include(dirname(__FILE__).'/sidebar.php'); # On insere la sidebar ?>
</div>
<?php include(dirname(__FILE__).'/footer.php'); # On insere le footer ?>
