<?php
/*Prevent web access*/
if (!defined("MEDIAWIKI"))
{exit;}

#Extensions

/*Other extensions*/
wfLoadExtension("PlavorMindTweaks");

#Skins

/*Vector*/
wfLoadSkin("Vector");
$wgVectorResponsive=true;

?>
