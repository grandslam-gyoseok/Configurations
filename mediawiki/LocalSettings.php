<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

//< Initialize >

//<< efGetSiteParams callback >>
function efGetSiteParams($conf,$wiki)
{$lang=null;
$site=null;
foreach($conf->suffixes as $suffix)
  {if (substr($wiki,-strlen($suffix))==$suffix)
    {$lang=substr($wiki,0,-strlen($suffix));
    $site=$suffix;
    break;}
  }
return
  ["lang"=>$lang,
  "params"=>
    ["lang"=>$lang,
    "site"=>$site,
    "wiki"=>$wiki],
  "suffix"=>$site,
  "tags"=>
    []
  ];
}
$wgConf->siteParamsCallback="efGetSiteParams";

//<< Variables >>
//Put "%wiki%" where the wiki ID should be placed.
$wmgBaseURL="http://%wiki%.plavormind.tk:81";
$wmgCacheExpiry=60; //1 minute
$wmgCentralWiki="central";
$wmgDataDirectory=$IP."/data";
$wmgDebugMode=false;
$wmgGlobalAccountExemptWikis=[];
//Should be one of "", "centralauth" and "shared-database"
$wmgGlobalAccountMode="centralauth";
$wmgGrantStewardsGlobalPermissions=false;
switch (PHP_OS_FAMILY)
{case "Linux":
$wmgPrivateDataDirectory="/plavormind/web/data/mediawiki";
break;
case "Windows":
$wmgPrivateDataDirectory="C:/plavormind/web/data/mediawiki";
break;
default:
$wmgPrivateDataDirectory=$IP."/private-data";}
$wmgWikis=["central","osa"];

//<< Wiki selector >>
if ($wgCommandLineMode)
{if (defined("MW_DB"))
  {$wmgWiki=MW_DB;}
else
  {exit("Wiki is not specified.");}
}
//parse_url doesn't return anything if the string only contains domain
elseif (preg_match("/^([\d\-a-z]+)(?:\.[\d\-a-z]+){2}$/iu",parse_url("//".$_SERVER["HTTP_HOST"],PHP_URL_HOST),$matches))
{$wmgWiki=$matches[1];}
else
{exit("Cannot find this wiki.");}
if (!in_array($wmgWiki,$wmgWikis))
{exit("Cannot find this wiki.");}

//<< Others >>
require_once($wmgDataDirectory."/GlobalCoreSettings.php");
if (file_exists($wmgDataDirectory."/".$wmgWiki."/CoreSettings.php"))
{include_once($wmgDataDirectory."/".$wmgWiki."/CoreSettings.php");}
if (file_exists($wmgDataDirectory."/GlobalExtraSettings.php"))
{include_once($wmgDataDirectory."/GlobalExtraSettings.php");}
if (file_exists($wmgDataDirectory."/".$wmgWiki."/ExtraSettings.php"))
{include_once($wmgDataDirectory."/".$wmgWiki."/ExtraSettings.php");}
if (file_exists($wmgPrivateDataDirectory."/PrivateSettings.php"))
{include_once($wmgPrivateDataDirectory."/PrivateSettings.php");}
