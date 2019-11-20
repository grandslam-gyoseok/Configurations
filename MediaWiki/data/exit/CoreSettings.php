<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

#General

/*Basic information*/
$wgLogo=$wgScriptPath."/data/".$wmgWiki."/logo.png";
$wgSitename="PlavorMindCentral";

/*Copyright*/
$wgRightsIcon="https://upload.wikimedia.org/wikipedia/commons/2/28/Licence_Art_Libre.svg";
$wgRightsText="Free Art License 1.3";
$wgRightsUrl="https://artlibre.org/licence/lal/en/";

/*CSS and JavaScript*/
$wgAllowSiteCSSOnRestrictedPages=true;

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
"protect-level-editprotected-moderator",
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
"revertpage",
"undo-summary",
"unprotectedarticle-comment"];
$wgSiteNotice="Current [[MediaWiki]] version: [[Special:Version|{{CURRENTVERSION}}]]";

/*Others*/
$wgAllowSlowParserFunctions=true; //Experimental
$wgMetaNamespace="PlavorMind";
$wgRestrictDisplayTitle=false; //Experimental

#Permissions

/*Group permissions*/
$wgGroupPermissions["bureaucrat"]=array_merge($wgGroupPermissions["bureaucrat"],
["editinterface"=>false,
"editsitecss"=>false,
"editsitejs"=>false,
"editsitejson"=>false]);
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]=array_merge($wgGroupPermissions["steward"],
["editinterface"=>true,
"editsitecss"=>true,
"editsitejs"=>true,
"editsitejson"=>true]);}
$wgGroupPermissions["steward"]["siteadmin"]=true;
$wgGroupPermissions["steward"]["userrights"]=true;
$wgGroupPermissions["steward"]["userrights-interwiki"]=true;

/*Protection*/
$wgNamespaceProtection=
[NS_CATEGORY=>
  ["editprotected-autoconfirmed"],
NS_HELP=>
  ["editprotected-moderator"],
NS_MEDIAWIKI_TALK=>
  ["editprotected-steward"],
NS_PROJECT=>
  ["editprotected-steward"],
NS_TEMPLATE=>
  ["editprotected-admin"]
];

#Extensions

/*Extensions usage*/
$wmgExtensionBabel=true;
$wmgExtensionCite=true;
$wmgExtensionCodeEditor=true;
$wmgExtensionCodeMirror=true;
$wmgExtensionCollapsibleVector=true;
$wmgExtensionCommonsMetadata=true;
$wmgExtensionHighlightjs_Integration=true;
$wmgExtensionMultimediaViewer=true;
$wmgExtensionNuke=true;
$wmgExtensionPageImages=true;
$wmgExtensionPerformanceInspector=true;
$wmgExtensionPopups=true;
$wmgExtensionReplaceText=true;
$wmgExtensionRevisionSlider=true;
$wmgExtensionSyntaxHighlight_GeSHi=true;
$wmgExtensionTemplateData=true;
$wmgExtensionTemplateStyles=true;
$wmgExtensionTemplateWizard=true;
$wmgExtensionTextExtracts=true;
$wmgExtensionTwoColConflict=true;
$wmgExtensionWikiEditor=true;
?>
