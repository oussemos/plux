<?php if(!defined('PLX_ROOT')) exit; ?>
<div id="sidebar">
	<div class="section">
		<h3><?php $plxShow->lang('RSS_FEEDS')?></h3>
		<ul>
		<li><a class="feed noactive" href="<?php $plxShow->urlRewrite('feed.php') ?>" title="<?php $plxShow->lang('ARTICLES_RSS_FEED_TITLE') ?>"><?php $plxShow->lang('ARTICLES_RSS_FEED') ?></a></li>
		<li><a class="feed noactive" href="<?php $plxShow->urlRewrite('feed.php?commentaires') ?>" title="<?php $plxShow->lang('COMMENTS_RSS_FEED_TITLE') ?>"><?php $plxShow->lang('COMMENTS_RSS_FEED') ?></a></li>
		</ul>
	</div>

	<div class="section">
		<h3><?php $plxShow->lang('CATEGORIES')?></h3>
		<ul>
		<?php $plxShow->catList('','<li><a href="#cat_url" class="#cat_status">#cat_name (#art_nb)</a></li>'); ?>
		</ul>
	</div>

	<div class="section">
		<h3><?php $plxShow->lang('TAGS')?></h3>
		<p>
		<?php $plxShow->tagList('<a href="#tag_url" class="tag #tag_status">#tag_name</a> ', 20); ?>
		</p>
	</div>

	<div class="section">
		<h3><?php $plxShow->lang('ARCHIVES')?></h3>
		<ul>
		<?php $plxShow->archList('<li><a href="#archives_url" class="#archives_status">#archives_name (#archives_nbart)</a></li>'); ?>
		</ul>
	</div>

	<div class="section">
		<h3><?php $plxShow->lang('LATEST_ARTICLES')?></h3>
		<ul>
		<?php $plxShow->lastArtList('<li><a href="#art_url" title="#art_title" class="#art_status">#art_title</a></li>'); ?>
		</ul>
	</div>

	<div class="section">
		<h3><?php $plxShow->lang('LATEST_COMMENTS')?></h3>
		<ul>
		<?php $plxShow->lastComList('<li><a href="#com_url">#com_content(33)</a></li>'); ?>
		</ul>
	</div>
</div>
