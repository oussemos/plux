<?php if(!defined('PLX_ROOT')) exit; ?>
<div id="footer">
	<p>
	&copy; <?php $plxShow->mainTitle('link'); ?> &bull;
	<?php $plxShow->lang('POWERED_BY') ?> <a href="http://pluxml.org" title="<?php $plxShow->lang('PLUXML_DESCRIPTION') ?>">PluXml</a> 
	<?php $plxShow->lang('IN') ?> <?php $plxShow->chrono() ?> &bull; 
	<?php $plxShow->lang('THEME') ?> <em>Zen</em> <?php $plxShow->lang('BY') ?> Guillaume Brocker (<a href="http://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>) &bull;
	<a href="<?php $plxShow->urlRewrite('core/admin/') ?>" title="<?php $plxShow->lang('ADMINISTRATION_TITLE') ?>"><?php $plxShow->lang('ADMINISTRATION') ?></a> &bull; 
	<a href="<?php echo $plxShow->urlRewrite('#top') ?>" title="<?php $plxShow->lang('TOP_TITLE') ?>"><?php $plxShow->lang('TOP') ?></a>
	</p>
</div>
</body>
</html>
