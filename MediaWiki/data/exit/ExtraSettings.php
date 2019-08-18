<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

##Extensions

/*CentralAuth*/
if ($wmgGlobalAccountMode=="centralauth")
{//Permissions
$wgGroupPermissions["steward"]=array_merge($wgGroupPermissions["steward"],
["centralauth-rename"=>true,
"centralauth-usermerge"=>true,
"globalgroupmembership"=>true,
"globalgrouppermissions"=>true]);}

/*CentralNotice*/
$wgNoticeInfrastructure=true;

/*UserPageEditProtection*/
$wgOnlyUserEditUserPage=true;
?>
