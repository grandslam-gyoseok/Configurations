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
$wgSitename="오사위키덤프";

//< Permissions >

//<< User group permissions >>
$wgGroupPermissions["*"]["createaccount"]=false;
$wgGroupPermissions["user"]["edit"]=false;

//< Extensions >

//<< Extension usage >>
$wmgExtensions=array_merge($wmgExtensions,
["Cite"=>true,
"Highlightjs_Integration"=>true,
"Josa"=>true,
"Math"=>true,
"PageImages"=>true,
"ParserFunctions"=>true,
"PerformanceInspector"=>true,
"Popups"=>true,
"ReplaceText"=>true,
"SyntaxHighlight_GeSHi"=>true,
"TextExtracts"=>true]);

//< Skins >

//<< Skin usage >>
$wmgSkinPlavorBuma=true;
