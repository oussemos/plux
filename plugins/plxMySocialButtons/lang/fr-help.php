<h2>Aide</h2>
<p>
Pour afficher les boutons sociaux Facebook, Twitter et Google+, ajouter la ligne suivante dans le fichier article.php de votre th&egrave;me, &agrave; l'endroit o&ugrave; vous souhaitez afficher les boutons.
</p>
<pre style="font-size:12px; padding-left:40px">
&lt;?php eval($plxShow->callHook('MySocialButtons')) ?&gt;
</pre>

<p style="margin-top:20px">
L'affichage des boutons peut être modifié, en personnalisant la classe .social-buttons dans le fichier css de votre thème.
</p>
<p style="margin-top:10px">
Exemple: pour aligner les boutons à droite, rajouter dans le fichier .css de votre thème, le code suivant:
</p>
<pre style="font-size:12px; padding-left:40px">
.social-buttons {
	text-align:right !important;
}
</pre>