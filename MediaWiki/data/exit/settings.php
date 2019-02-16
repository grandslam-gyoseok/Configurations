<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##General settings

/*Basic information*/
$wgLogo="{$wgScriptPath}/data/{$wiki_code}/logo.png";
$wgSitename="PlavorEXITBeta";

/*Interface*/
$wgAdvancedSearchHighlighting=true; //Added for test
$wgForceUIMsgAsContentMsg= //Added for test
["modifiedarticleprotection-comment",
"protect-expiry-indefinite",
"protect-fallback",
"protect-summary-cascade",
"protect-summary-desc",
"protectedarticle-comment",
"restriction-delete",
"restriction-edit",
"restriction-move",
"restriction-protect",
"restriction-upload",
"undo-summary",
"unprotectedarticle-comment",

"protect-level-user-access",
"protect-level-autoconfirmed-access",
"protect-level-staff-access",
"protect-level-admin-access",
"protect-level-bureaucrat-access",
"protect-level-steward-access"];
$wgSiteNotice="<b>Welcome to [[{{SITENAME}}]]!</b>";
//$wgUseCategoryBrowser=true; //Added for test
//$wgUseMediaWikiUIEverywhere=true;

/*Others*/
$wgRestrictDisplayTitle=false; //Added for test

##Permissions

/*Group permissions*/
$wgGroupPermissions["bureaucrat"]["editinterface"]=false;
$wgGroupPermissions["steward"]["editinterface"]=true;

/*Protection*/
$wgNamespaceProtection=
[NS_CATEGORY=>
  ["autoconfirmed-access"],
NS_HELP=>
  ["staff-access"],
NS_MEDIAWIKI_TALK=>
  ["steward-access"],
NS_PROJECT=>
  ["steward-access"],
NS_TEMPLATE=>
  ["admin-access"]
];
?>
