<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

#General

/*Basic information*/
$wgLogo=$wgScriptPath."/data/".$wmgWiki."/logo.png";
$wgSitename="오사위키덤프";

#Permissions

/*User group permissions*/
$wgGroupPermissions["*"]["createaccount"]=false;
$wgGroupPermissions["user"]["edit"]=false;

#Extensions

/*Extensions usage*/
$wmgExtensionCite=true;
$wmgExtensionHighlightjs_Integration=true;
$wmgExtensionMath=true;
$wmgExtensionInputBox=true;
$wmgExtensionJosa=true;
$wmgExtensionMassEditRegex=true;
$wmgExtensionPageImages=true; //Experimental
$wmgExtensionParserFunctions=true;
$wmgExtensionPopups=true; //Experimental
$wmgExtensionReplaceText=true;
$wmgExtensionSyntaxHighlight_GeSHi=true;
$wmgExtensionTextExtracts=true; //Experimental
?>
