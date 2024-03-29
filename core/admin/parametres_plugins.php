<?php

/**
 * Gestion des plugins
 *
 * @package PLX
 * @author	Stephane F
 **/

include(dirname(__FILE__).'/prepend.php');

# Control du token du formulaire
plxToken::validateFormToken($_POST);

# Control de l'accès à la page en fonction du profil de l'utilisateur connecté
$plxAdmin->checkProfil(PROFIL_ADMIN);

if(isset($_POST['submit']) AND in_array($_POST['selection'], array('delete', 'activate', 'deactivate'))) {
	$plxAdmin->plxPlugins->saveConfig($_POST);
	header('Location: parametres_plugins.php');
	exit;
}
elseif(isset($_POST['update'])) {
	$plxAdmin->plxPlugins->saveConfig($_POST);
	header('Location: parametres_plugins.php');
	exit;
}

function pluginsList($plugins, $defaultLang, $type) {
# plugins		array()		contient la liste des plugins à afficher
# defaultLang	string		langue utilisée dans l'admin
# type			true|false	true=liste des plugins actifs, false=liste des plugins inactifs

	$output='';
	if(sizeof($plugins)>0) {
		$num=0;
		foreach($plugins as $plugName => $plugInstance) {
			$ordre = ++$num;
			# détermination de l'icone à afficher
			if(is_file(PLX_PLUGINS.$plugName.'/icon.png'))
				$icon=PLX_PLUGINS.$plugName.'/icon.png';
			elseif(is_file(PLX_PLUGINS.$plugName.'/icon.jpg'))
				$icon=PLX_PLUGINS.$plugName.'/icon.jpg';
			elseif(is_file(PLX_PLUGINS.$plugName.'/icon.gif'))
				$icon=PLX_PLUGINS.$plugName.'/icon.gif';
			else
			$icon=PLX_CORE.'admin/theme/images/icon_plugin.png';

			$output .= '<tr class="line-'.($num%2).' top">';

				# checkbox
				$output .= '<td>';
				$output .= '<input type="hidden" name="plugName[]" value="'.$plugName.'" />';
				$output .= '<input type="checkbox" name="chkAction[]" value="'.$plugName.'" />';
				$output .= '</td>';
				# icon
				$output .= '<td><img src="'.$icon.'" alt="" /></td>';

				# plugin infos
				$output .= '<td>';
					# title + version
					$output .= '<strong>'.plxUtils::strCheck($plugInstance->getInfo('title')).'</strong> - '.L_PLUGINS_VERSION.' <strong>'.plxUtils::strCheck($plugInstance->getInfo('version')).'</strong>';
					# date
					if($plugInstance->getInfo('date')!='') $output .= ' ('.plxUtils::strCheck($plugInstance->getInfo('date')).')';
					# description
					$output .= '<br />'.plxUtils::strCheck($plugInstance->getInfo('description')).'<br />';
					# author
					$output .= L_PLUGINS_AUTHOR.' : '.plxUtils::strCheck($plugInstance->getInfo('author'));
					# site
					if($plugInstance->getInfo('site')!='') $output .= ' - <a href="'.plxUtils::strCheck($plugInstance->getInfo('site')).'">'.plxUtils::strCheck($plugInstance->getInfo('site')).'</a>';
					# message d'alerte si plugin non configuré
					if($type AND file_exists(PLX_PLUGINS.$plugName.'/config.php') AND !file_exists(PLX_ROOT.PLX_CONFIG_PATH.'plugins/'.$plugName.'.xml')) $output .= '<br /><span class="alert">'.L_PLUGIN_NO_CONFIG.'</span>';
				$output .= '</td>';

				# colonne pour trier les plugins
				if($type) {
					$output .= '<td>';
						$output .= '<input size="2" maxlength="3" type="text" name="plugOrdre['.$plugName.']" value="'.$ordre.'" />';
					$output .= '</td>';
				}

				# affichage des liens du plugin
				$output .= '<td class="right">';
					# lien configuration
					if(is_file(PLX_PLUGINS.$plugName.'/config.php')) {
						$output .= '<a title="'.L_PLUGINS_CONFIG_TITLE.'" href="parametres_plugin.php?p='.urlencode($plugName).'">'.L_PLUGINS_CONFIG.'</a><br />';
					}
					# lien pour code css
					$output .= '<a title="'.L_PLUGINS_CSS_TITLE.'" href="parametres_plugincss.php?p='.urlencode($plugName).'">'.L_PLUGINS_CSS.'</a><br />';
					# lien aide
					if(is_file(PLX_PLUGINS.$plugName.'/lang/'.$defaultLang.'-help.php'))
						$output .= '<a title="'.L_PLUGINS_HELP_TITLE.'" href="parametres_pluginhelp.php?p='.urlencode($plugName).'">'.L_PLUGINS_HELP.'</a>';
				$output .= '</td>';
			$output .= '</tr>';
		}
	}
	else
		$output .= '<tr><td colspan="5" class="center">'.L_NO_PLUGIN.'</td></tr>';
	return $output;
}

# récuperation de la liste des plugins inactifs
$aInactivePlugins = $plxAdmin->plxPlugins->getInactivePlugins();
# nombre de plugins actifs
$nbActivePlugins = sizeof($plxAdmin->plxPlugins->aPlugins);
# nombre de plugins inactifs
$nbInactivePlugins = sizeof($aInactivePlugins);
# récuperation du type de plugins à afficher
$_GET['sel'] = isset($_GET['sel']) ? intval(plxUtils::nullbyteRemove($_GET['sel'])) : '';
$session = isset($_SESSION['selPlugins']) ? $_SESSION['selPlugins'] : '1';
$sel = (in_array($_GET['sel'], array('0', '1')) ? $_GET['sel'] : $session);
$_SESSION['selPlugins'] = $sel;
if($sel=='1') {
	$aSelList = array('' => L_FOR_SELECTION, 'deactivate'=> L_PLUGINS_DEACTIVATE, '-' => '-----', 'delete' => L_PLUGINS_DELETE);
	$plugins = pluginsList($plxAdmin->plxPlugins->aPlugins, $plxAdmin->aConf['default_lang'], true);
} else {
	$aSelList = array('' => L_FOR_SELECTION, 'activate' => L_PLUGINS_ACTIVATE, '-' => '-----', 'delete' => L_PLUGINS_DELETE);
	$plugins = pluginsList($aInactivePlugins, $plxAdmin->aConf['default_lang'], false);
}
# fil d'ariane
$breadcrumbs = array();
$breadcrumbs[] = '<a '.($_SESSION['selPlugins']=='1'?'class="selected" ':'').'href="parametres_plugins.php?sel=1">'.L_PLUGINS_ACTIVE_LIST.'</a>&nbsp;('.$nbActivePlugins.')';
$breadcrumbs[] = '<a '.($_SESSION['selPlugins']=='0'?'class="selected" ':'').'href="parametres_plugins.php?sel=0">'.L_PLUGINS_INACTIVE_LIST.'</a>&nbsp;('.$nbInactivePlugins.')';

# On inclut le header
include(dirname(__FILE__).'/top.php');

?>

<h2><?php echo L_PLUGINS_TITLE ?></h2>

<?php eval($plxAdmin->plxPlugins->callHook('AdminSettingsPluginsTop')) # Hook Plugins ?>

<p class="breadcrumbs">
	<?php echo implode('&nbsp;|&nbsp;', $breadcrumbs); ?>
</p>
<form action="parametres_plugins.php" method="post" id="form_plugins">
<table class="table">
<thead>
	<tr>
		<th class="checkbox"><input type="checkbox" onclick="checkAll(this.form, 'chkAction[]')" /></th>
		<th class="icon">&nbsp;</th>
		<th class="description"><?php echo L_MENU_CONFIG_PLUGINS ?></th>
		<?php if($_SESSION['selPlugins']=='1') : ?>
		<th class="col"><?php echo L_PLUGINS_LOADING_SORT ?></th>
		<?php endif; ?>
		<th class="action"><?php echo L_PLUGINS_ACTION ?></th>
	</tr>
</thead>
<tbody>
	<?php echo $plugins ?>
</tbody>
</table>
<?php if($_SESSION['selPlugins']=='1') : ?>
<p class="center">
	<input class="button update " type="submit" name="update" value="<?php echo L_PLUGINS_APPLY_BUTTON ?>" />
</p>
<?php endif; ?>
<p>
	<?php echo plxToken::getTokenPostMethod() ?>
	<?php plxUtils::printSelect('selection', $aSelList,'', false,'','id_selection'); ?>&nbsp;
	<input class="button submit" type="submit" name="submit" value="<?php echo L_OK ?>" onclick="return confirmAction(this.form, 'id_selection', 'delete', 'chkAction[]', '<?php echo L_CONFIRM_DELETE ?>')" />
</p>
</form>

<?php
# Hook Plugins
eval($plxAdmin->plxPlugins->callHook('AdminSettingsPluginsFoot'));
# On inclut le footer
include(dirname(__FILE__).'/foot.php');
?>
