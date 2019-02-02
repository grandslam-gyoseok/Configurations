<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##Extensions

/*Renameuser*/
wfLoadExtension("Renameuser");
$wgGroupPermissions["bureaucrat"]["renameuser"]=false;
$wgGroupPermissions["steward"]["renameuser"]=true;

/*UserPageEditProtection*/
include_once("{$wgExtensionDirectory}/UserPageEditProtection/UserPageEditProtection.php");
$wgOnlyUserEditUserPage=true;
//Staffs
$wgGroupPermissions["staff"]["editalluserpages"]=true;

##Skins

/*Other skins*/
wfLoadSkin("Anisa");

##Appending settings

/*Permission inheritance*/
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["bureaucrat"]+=$wgGroupPermissions["admin"];
$wgGroupPermissions["steward"]+=$wgGroupPermissions["bureaucrat"];
