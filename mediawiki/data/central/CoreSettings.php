<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

#General

/*Basic information*/
$wgLogos=
["1x"=>$wgScriptPath."/data/".$wmgWiki."/logos/logo-1x.png",
"1.5x"=>$wgScriptPath."/data/".$wmgWiki."/logos/logo-1.5x.png",
"2x"=>$wgScriptPath."/data/".$wmgWiki."/logos/logo-2x.png"];
$wgSitename="PlavorMindCentral";

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

/*User group permissions*/
$wgGroupPermissions["bureaucrat"]["editsitecss"]=false;
$wgGroupPermissions["bureaucrat"]["editsitejson"]=false;
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["editsitecss"]=true;
$wgGroupPermissions["steward"]["editsitejson"]=true;}

/*Others*/
function central_modify_permissions()
{global $wgNamespaceProtection;
$wgNamespaceProtection[NS_MEDIAWIKI]=["editprotected-steward"];}
$wgExtensionFunctions[]="central_modify_permissions";

#Extensions

/*Extension usage*/
$wmgExtensionBabel=true;
$wmgExtensionCite=true;
$wmgExtensionCodeEditor=true;
$wmgExtensionCodeMirror=true;
$wmgExtensionCollapsibleVector=true;
$wmgExtensionCommonsMetadata=true;
$wmgExtensionHighlightjs_Integration=true;
$wmgExtensionMassEditRegex=true;
$wmgExtensionMultimediaViewer=true;
$wmgExtensionNuke=true;
$wmgExtensionPageImages=true;
$wmgExtensionPerformanceInspector=true;
$wmgExtensionPopups=true;
$wmgExtensionProtectionIndicator=true;
$wmgExtensionReplaceText=true;
$wmgExtensionRevisionSlider=true;
$wmgExtensionSyntaxHighlight_GeSHi=true;
$wmgExtensionTemplateData=true;
$wmgExtensionTemplateStyles=true;
$wmgExtensionTemplateWizard=true;
$wmgExtensionTextExtracts=true;
$wmgExtensionTwoColConflict=true;
$wmgExtensionUploadsLink=true;
$wmgExtensionWikibaseClient=true;
$wmgExtensionWikibaseRepository=true;
$wmgExtensionWikiEditor=true;

#Skins

/*Skin usage*/
$wmgSkinCitizen=true;
$wmgSkinLiberty=true;
$wmgSkinMinervaNeue=true;
$wmgSkinPlavorBuma=true;
$wmgSkinTimeless=true;
