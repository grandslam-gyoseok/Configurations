<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{exit("You don't have permission to access to this page.");}

##General

/*Basic information*/
$wgLogo="{$wgScriptPath}/data/{$wiki_id}/logo.png";
$wgSitename="PlavorMindBeta";

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
"editsitejson"=>false]);
$wgGroupPermissions["steward"]=array_merge($wgGroupPermissions["steward"],
["editinterface"=>true,
"editsitecss"=>true,
"editsitejs"=>true,
"editsitejson"=>true]);

/*Protection*/
$wgNamespaceProtection=
[NS_CATEGORY=>
  ["editsemiprotected"],
NS_HELP=>
  ["editprotected-staff"],
NS_MEDIAWIKI_TALK=>
  ["editprotected-steward"],
NS_PROJECT=>
  ["editprotected-steward"],
NS_TEMPLATE=>
  ["editprotected"]
];

##Extensions

/*Extensions usage*/
$extension_Babel=true;
$extension_CodeEditor=true;
$extension_CodeMirror=true;
$extension_CollapsibleVector=true;
$extension_CommonsMetadata=true;
$extension_Flow=true;
$extension_Highlightjs_Integration=true;
$extension_MultimediaViewer=true;
$extension_Nuke=true;
$extension_PageImages=true;
$extension_PerformanceInspector=true;
$extension_Popups=true;
$extension_SecurePoll=true;
$extension_SyntaxHighlight_GeSHi=true;
$extension_TemplateData=true;
$extension_TemplateWizard=true;
$extension_TextExtracts=true;
$extension_TwoColConflict=true;
$extension_WikiEditor=true;
?>
