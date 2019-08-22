<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

##General

/*Basic information*/
$wgLogo="{$wgScriptPath}/data/{$wmgWiki}/logo.png";
$wgSitename="오사위키덤프";

##Permissions

/*Group permissions*/
$wgGroupPermissions["user"]["edit"]=false;

##Extensions

/*Extensions usage*/
$wmgExtensionCite=true;
$wmgExtensionHighlightjs_Integration=true;
$wmgExtensionReplaceText=true;
$wmgExtensionSimpleMathJax=true;
$wmgExtensionSyntaxHighlight_GeSHi=true;

##Skins

/*Others*/
$wgDefaultSkin="PlavorBuma";
?>
