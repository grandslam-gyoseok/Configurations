<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##Extensions

/*CentralNotice*/
$wgNoticeInfrastructure=true;

/*UserPageEditProtection*/
$wgOnlyUserEditUserPage=true;
?>
