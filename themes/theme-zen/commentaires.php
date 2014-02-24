<?php if(!defined('PLX_ROOT')) exit; ?>

<?php # Si on a des commentaires ?>
<div id="comments">
	<?php if($plxShow->plxMotor->plxGlob_coms->count): ?>
		<h2><?php $plxShow->lang('COMMENTS') ?></h2>
		<?php while($plxShow->plxMotor->plxRecord_coms->loop()): # On boucle sur les commentaires ?>
			<div id="<?php $plxShow->comId(); ?>" class="comment type-<?php $plxShow->comType(); ?>">
				<p class="author"><?php $plxShow->comAuthor('link'); ?> <span><a href="<?php $plxShow->ComUrl() ?>" title="#<?php echo $plxShow->plxMotor->plxRecord_coms->i+1 ?>">#<?php echo $plxShow->plxMotor->plxRecord_coms->i+1 ?></a></span></p>
				<p class="date"><?php $plxShow->comDate('#num_day&nbsp;#month&nbsp;#num_year(4),&nbsp;#hour:#minute'); ?></p>
				<p><?php $plxShow->comContent() ?></p>
			</div>
		<?php endwhile; # Fin de la boucle sur les commentaires ?>
		<p class="feed"><?php $plxShow->comFeed('rss',$plxShow->artId()); ?></p>
	<?php endif; # Fin du if sur la prescence des commentaires ?>
</div>


<?php # Si on autorise les commentaires ?>
<?php if($plxShow->plxMotor->plxRecord_arts->f('allow_com') AND $plxShow->plxMotor->aConf['allow_com']): ?>
	<div id="form">
		<h2><?php $plxShow->lang('LEAVE_A_COMMENT') ?></h2>
		<p id="message"><?php $plxShow->comMessage(); ?></p>
		<form id="comment" action="<?php $plxShow->artUrl(); ?>#comments-form" method="post">
			<fieldset>
				<p><label><?php $plxShow->lang('NAME') ?>&nbsp;:</label>
				<input name="name" type="text" size="20" value="<?php $plxShow->comGet('name',''); ?>" maxlength="30" /></p>
			
				<p><label><?php $plxShow->lang('WEBSITE') ?>&nbsp;:</label>
				<input name="site" type="text" size="20" value="<?php $plxShow->comGet('site',''); ?>" /></p>
			
				<p><label><?php $plxShow->lang('EMAIL') ?>&nbsp;:</label>
				<input name="mail" type="text" size="20" value="<?php $plxShow->comGet('mail',''); ?>" /></p>
			
				<textarea name="content" cols="35" rows="6"><?php $plxShow->comGet('content',''); ?></textarea>
			
				<p id="capcha">
					<?php # Affichage du capcha anti-spam
					if($plxShow->plxMotor->aConf['capcha']): ?>
						<?php $plxShow->capchaQ(); ?>&nbsp;<input name="rep" type="text" size="10" />
						<input name="rep2" type="hidden" value="<?php $plxShow->capchaR(); ?>" />
					<?php endif; # Fin du if sur le capcha anti-spam ?>
				</p>
				
				<p id="buttons"><input type="reset" value="<?php $plxShow->lang('RESET') ?>" />
				<input type="submit" value="<?php $plxShow->lang('SEND') ?>" /></p>
			</fieldset>
		</form>
	</div>
<?php endif; # Fin du if sur l'autorisation des commentaires ?>
