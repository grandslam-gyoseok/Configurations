<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

##General

/*Basic information*/
$wgSitename="Live위키";

/*Interface*/
$wgForceUIMsgAsContentMsg=
["excontent",
"excontentauthor",
"modifiedarticleprotection-comment",
"protect-expiry-indefinite",
"protect-fallback",
"protect-level-editprotected",
"protect-level-editprotected-admin",
"protect-level-editprotected-autoconfirmed",
"protect-level-editprotected-bureaucrat",
"protect-level-editprotected-staff",
"protect-level-editprotected-steward",
"protect-level-editprotected-user",
"protect-level-editsemiprotected",
"protect-summary-cascade",
"protect-summary-desc",
"protectedarticle-comment",
"restriction-delete",
"restriction-edit",
"restriction-move",
"restriction-protect",
"restriction-upload",
"undo-summary",
"unprotectedarticle-comment"];

##Extensions

/*Extensions usage*/
$wmgExtensionCite=true;
$wmgExtensionReplaceText=true;
?>
