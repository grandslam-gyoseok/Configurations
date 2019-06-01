<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##General

/*Basic information*/
$wgLogo="{$wgScriptPath}/data/{$wiki_id}/logo.png";
$wgSitename="PlavorEXITBeta";

/*CSS and JavaScript*/
$wgAllowSiteCSSOnRestrictedPages=true;

/*Interface*/
$wgForceUIMsgAsContentMsg=
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
$wgSiteNotice="Current [[MediaWiki]] version: [[Special:Version|{{CURRENTVERSION}}]]";

/*Others*/
$wgMetaNamespace="PlavorMind";
$wgRestrictDisplayTitle=false; //Added for test

##Permissions

/*Group permissions*/
$wgGroupPermissions["bureaucrat"]=array_merge($wgGroupPermissions["bureaucrat"],
["editinterface"=>false,
"editsitecss"=>false,
"editsitejs"=>false,
"editsitejson"=>false,
"editusercss"=>false,
"edituserjs"=>false,
"edituserjson"=>false]);

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

##Extensions

/*Extensions usage*/
$extension_Babel=true;
$extension_CodeEditor=true;
$extension_CodeMirror=true;
$extension_CollapsibleVector=true;
$extension_CommonsMetadata=true;
$extension_Highlightjs_Integration=true;
$extension_MultimediaViewer=true;
$extension_Nuke=true;
$extension_PageImages=true;
$extension_Popups=true;
$extension_SyntaxHighlight_GeSHi=true;
$extension_TextExtracts=true;
$extension_TwoColConflict=true;
$extension_WikiEditor=true;
?>
