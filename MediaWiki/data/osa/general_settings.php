<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{exit("You don't have permission to access to this page.");}

##General

/*Basic information*/
$wgSitename="오사위키덤프";

##Permissions

/*Group permissions*/
$wgGroupPermissions["user"]["edit"]=false;

##Extensions

/*Extensions usage*/
$extension_Cite=true;
$extension_MassEditRegex=true;

##Skins

/*Others*/
$wgDefaultSkin="PlavorBuma";
?>