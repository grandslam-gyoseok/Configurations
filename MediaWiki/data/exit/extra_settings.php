<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##Extensions

/*UserPageEditProtection*/
include_once("{$wgExtensionDirectory}/UserPageEditProtection/UserPageEditProtection.php");
$wgOnlyUserEditUserPage=true;
//Staffs
$wgGroupPermissions["staff"]["editalluserpages"]=true;

##Appending settings

/*Permission inheritance*/
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["bureaucrat"]+=$wgGroupPermissions["admin"];
$wgGroupPermissions["steward"]+=$wgGroupPermissions["bureaucrat"];
?>
