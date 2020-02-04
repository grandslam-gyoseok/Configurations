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
$wgAllowDisplayTitle=false;
$wgAllowSlowParserFunctions=true; //Experimental
$wgMetaNamespace="PlavorMind";

#Permissions

/*User group permissions*/
$wgGroupPermissions["bureaucrat"]["editinterface"]=false;
$wgGroupPermissions["bureaucrat"]["editsitecss"]=false;
$wgGroupPermissions["bureaucrat"]["editsitejson"]=false;
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["editinterface"]=true;
$wgGroupPermissions["steward"]["editsitecss"]=true;
$wgGroupPermissions["steward"]["editsitejson"]=true;}

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
$wmgExtensionInputBox=true;
$wmgExtensionJosa=true;
$wmgExtensionMassEditRegex=true;
$wmgExtensionMultimediaViewer=true;
$wmgExtensionNuke=true;
$wmgExtensionPageImages=true;
$wmgExtensionPerformanceInspector=true;
$wmgExtensionPopups=true;
$wmgExtensionReplaceText=true;
$wmgExtensionRevisionSlider=true;
$wmgExtensionScribunto=true;
$wmgExtensionSyntaxHighlight_GeSHi=true;
$wmgExtensionTemplateData=true;
$wmgExtensionTemplateStyles=true;
$wmgExtensionTemplateWizard=true;
$wmgExtensionTextExtracts=true;
$wmgExtensionTwoColConflict=true;
$wmgExtensionUploadsLink=true;
$wmgExtensionWikiEditor=true;
?>
