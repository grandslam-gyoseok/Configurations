<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

#General

/*Basic information*/
$wgLogo=$wgScriptPath."/data/".$wmgWiki."/logo.png";
$wgSitename="PlavorMindCentral";

/*Copyright*/
$wgRightsIcon=null;
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
$wgSiteNotice="Current [[MediaWiki]] version: [[Special:Version|{{CURRENTVERSION}}]]";

/*Others*/
$wgAllowSlowParserFunctions=true; //Experimental
$wgMetaNamespace="PlavorMind";
$wgRestrictDisplayTitle=false; //Experimental

##Permissions

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
$wmgExtensionAlwaysBlueCategory=true;
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
$wmgExtensionRenameuser=true; //This should always be enabled on central wiki
$wmgExtensionReplaceText=true;
$wmgExtensionSyntaxHighlight_GeSHi=true;
$wmgExtensionTemplateData=true;
$wmgExtensionTemplateWizard=true;
$wmgExtensionTextExtracts=true;
$wmgExtensionTwoColConflict=true;
$wmgExtensionWikiEditor=true;
?>
