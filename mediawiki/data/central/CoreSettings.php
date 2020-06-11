<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

//< General >

//<< Basic information >>
$wgLogos=
["1x"=>$wgScriptPath."/data/".$wmgWiki."/logos/logo-1x.png",
"1.5x"=>$wgScriptPath."/data/".$wmgWiki."/logos/logo-1.5x.png",
"2x"=>$wgScriptPath."/data/".$wmgWiki."/logos/logo-2x.png",
"icon"=>$wgScriptPath."/data/".$wmgWiki."/logos/logo-2x.png"];
$wgSitename="PlavorMindCentral";

//<< CSS and JavaScript >>
$wgAllowSiteCSSOnRestrictedPages=true;

//<< Namespaces >>
$wgMetaNamespace="PlavorMind";

//<< Parser >>
$wgAllowDisplayTitle=false;
$wgAllowSlowParserFunctions=true; //Experimental

//<< Recent changes and watchlist >>
$wgWatchlistExpiry=true; //Experimental

//<< User interface >>
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

//< Permissions >

//<< Protection >>
$wgNamespaceProtection=
[NS_CATEGORY_TALK=>
  ["editprotected-steward"],
NS_FILE_TALK=>
  ["editprotected-steward"],
NS_HELP_TALK=>
  ["editprotected-steward"],
NS_MEDIAWIKI_TALK=>
  ["editprotected-steward"],
NS_PROJECT=>
  ["editprotected-bureaucrat"],
NS_TEMPLATE=>
  ["editprotected-admin"],
NS_TEMPLATE_TALK=>
  ["editprotected-steward"],
];

//<< User group permissions >>
$wgGroupPermissions["bureaucrat"]["editinterface"]=false;
$wgGroupPermissions["bureaucrat"]["editsitecss"]=false;
$wgGroupPermissions["bureaucrat"]["editsitejson"]=false;
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["editinterface"]=true;
$wgGroupPermissions["steward"]["editsitecss"]=true;
$wgGroupPermissions["steward"]["editsitejson"]=true;}

//< Extensions >

//<< Extension usage >>
$wmgExtensions=array_merge($wmgExtensions,
["Cite"=>true,
"CodeEditor"=>true,
"CodeMirror"=>true,
"CommonsMetadata"=>true,
"CreateRedirect"=>true,
"Highlightjs_Integration"=>true,
"MultimediaViewer"=>true,
"Nuke"=>true,
"PageImages"=>true,
"PerformanceInspector"=>true,
"Popups"=>true,
"ReplaceText"=>true,
"RevisionSlider"=>true,
"SyntaxHighlight_GeSHi"=>true,
"TemplateData"=>true,
"TemplateSandbox"=>true,
"TemplateStyles"=>true,
"TemplateWizard"=>true,
"TextExtracts"=>true,
"TwoColConflict"=>true,
"UploadsLink"=>true,
"WikibaseClient"=>true,
"WikibaseRepository"=>true,
"WikiEditor"=>true]);

//< Skins >

//<< Skin usage >>
$wmgSkinCitizen=true;
$wmgSkinMinervaNeue=true;
$wmgSkinPlavorBuma=true;
$wmgSkinTimeless=true;
