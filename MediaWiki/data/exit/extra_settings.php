<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{exit("You don't have permission to access to this page.");}

##Extensions

/*CentralNotice*/
$wgNoticeInfrastructure=true;

/*UserPageEditProtection*/
$wgOnlyUserEditUserPage=true;
?>
