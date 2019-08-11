<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{exit("You don't have permission to access to this page.");}

##Extensions

/*CentralAuth*/
//Permissions
if (isset($wgCentralAuthAutoMigrate))
{unset($wgGroupPermissions["steward"]);} //Check later and change to $wgGroupPermissions["steward"]=[];

/*CentralNotice*/
$wgNoticeInfrastructure=true;

/*UserPageEditProtection*/
$wgOnlyUserEditUserPage=true;
?>
