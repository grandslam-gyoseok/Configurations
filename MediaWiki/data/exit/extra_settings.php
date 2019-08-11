<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{exit("You don't have permission to access to this page.");}

##Extensions

/*CentralAuth*/
//Permissions
if (isset($wgCentralAuthAutoMigrate))
{//All permissions of local stewards should be set here
$wgGroupPermissions["steward"]=
["centralauth-rename"=>true,
"centralauth-usermerge"=>true,
"globalgroupmembership"=>true,
"globalgrouppermissions"=>true,
"userrights"=>true,
"userrights-interwiki"=>true];}

/*CentralNotice*/
$wgNoticeInfrastructure=true;

/*UserPageEditProtection*/
$wgOnlyUserEditUserPage=true;
?>
