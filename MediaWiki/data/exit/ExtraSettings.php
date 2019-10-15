<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

#Extensions

/*CentralAuth*/
if ($wmgGlobalAccountMode=="centralauth")
{//Permissions
$wgGroupPermissions["steward"]=array_merge($wgGroupPermissions["steward"],
["centralauth-lock"=>true,
"centralauth-oversight"=>true,
"centralauth-rename"=>true,
"centralauth-unmerge"=>true,
"centralauth-usermerge"=>true,
"globalgroupmembership"=>true,
"globalgrouppermissions"=>true]);}

/*CentralNotice*/
$wgNoticeInfrastructure=true;

/*GlobalBlocking*/
if ($wmgGlobalAccountMode!="")
{//Permissions
$wgGroupPermissions["steward"]["globalblock"]=true;}

/*UserPageEditProtection*/
$wgOnlyUserEditUserPage=true;
?>
