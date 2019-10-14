<?php
/*
error_reporting(-1);
ini_set("display_errors",1);
$wgShowDBErrorBacktrace=true;
$wgShowExceptionDetails=true;
$wgShowSQLErrors=true;
//*/
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

#Initialize

/*efGetSiteParams callback*/
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

/*Variables*/
$wmgCacheExpiry=60; //1 minute
$wmgCentralWiki="wiki";
$wmgDataDirectory="{$IP}/data";
$wmgGlobalAccountExemptWikis=[];
//Should be one of "", "centralauth" and "shared-database"
$wmgGlobalAccountMode="";
switch (PHP_OS_FAMILY)
{case "Linux":
$wmgPrivateDataDirectory="/plavormind/web_data/mediawiki";
break;
case "Windows":
$wmgPrivateDataDirectory="C:/plavormind/web_data/mediawiki";
break;
default:
$wmgPrivateDataDirectory="{$IP}/private_data";}
$wmgWiki="wiki";

/*Wiki selector*/
if ($wgCommandLineMode)
{if (defined("MW_DB"))
  {$wmgWiki=MW_DB;}
else
  {exit("Wiki is not specified.");}
}
elseif (preg_match("/^([\d\-a-z]+)(?:\.[\d\-a-z]+){2}$/i",parse_url($_SERVER["HTTP_HOST"],PHP_URL_HOST),$matches))
{$wmgWiki=$matches[1];}
else
{exit("Cannot find this wiki.");}

/*Others*/
require_once($wmgDataDirectory."/GlobalCoreSettings.php");
if (file_exists($wmgDataDirectory."/".$wmgWiki."/CoreSettings.php"))
{include_once($wmgDataDirectory."/".$wmgWiki."/CoreSettings.php");}
if (file_exists($wmgDataDirectory."/GlobalExtraSettings.php"))
{include_once($wmgDataDirectory."/GlobalExtraSettings.php");}
if (file_exists($wmgDataDirectory."/".$wmgWiki."/ExtraSettings.php"))
{include_once($wmgDataDirectory."/".$wmgWiki."/ExtraSettings.php");}
if (file_exists($wmgPrivateDataDirectory."/PrivateSettings.php"))
{include_once($wmgPrivateDataDirectory."/PrivateSettings.php");}
//Permission inheritance
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["bureaucrat"]+=$wgGroupPermissions["admin"];
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]+=$wgGroupPermissions["bureaucrat"];}
?>
