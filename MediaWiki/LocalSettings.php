<?php
##Debugging

/*
error_reporting(-1);
ini_set("display_errors",1);
$wgShowDBErrorBacktrace=true;
$wgShowExceptionDetails=true;
$wgShowSQLErrors=true;
//*/

##Prevent web access

if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

##Initialize

/*Directory*/
$wmgDataDirectory="{$IP}/data";
switch (PHP_OS_FAMILY)
{case "Linux":
$wmgPrivateDataDirectory="/plavormind/web_data/mediawiki";
break;
case "Windows":
$wmgPrivateDataDirectory="C:/plavormind/web_data/mediawiki";
break;
default:
$wmgPrivateDataDirectory="{$IP}/private_data";}

/*Variable*/
$wmgCacheExpiry=60; //1 minute
//Should be one of "", "centralauth" and "shared-database"
$wmgGlobalAccountMode="centralauth";

/*Wiki*/
$wmgCentralWiki="exit";
if ($wgCommandLineMode)
{if (defined("MW_DB"))
  {$wmgWiki=MW_DB;}
else
  {exit("Wiki is not specified.");}
}
elseif (preg_match("/^([\-\dA-Za-z]+)(?:\.[\-\dA-Za-z]+){2}$/i",parse_url($_SERVER["HTTP_HOST"],PHP_URL_HOST),$matches))
{$wmgWiki=$matches[1];}
else
{exit("Cannot find this wiki.");}

##System

/*Database*/
$wgDBname="{$wmgWiki}wiki";
$wgLocalDatabases=["exitwiki","livewiki","osawiki"];
if (!in_array($wgDBname,$wgLocalDatabases))
{exit("Cannot find this wiki.");}

##Wiki settings

/*Load settings*/
//Core settings
if (file_exists("{$wmgDataDirectory}/GlobalCoreSettings.php"))
{include_once("{$wmgDataDirectory}/GlobalCoreSettings.php");}
if (file_exists("{$wmgDataDirectory}/{$wmgWiki}/CoreSettings.php"))
{include_once("{$wmgDataDirectory}/{$wmgWiki}/CoreSettings.php");}
//Extensions and skins settings
if (file_exists("{$wmgDataDirectory}/GlobalExtraSettings.php"))
{include_once("{$wmgDataDirectory}/GlobalExtraSettings.php");}
if (file_exists("{$wmgDataDirectory}/{$wmgWiki}/ExtraSettings.php"))
{include_once("{$wmgDataDirectory}/{$wmgWiki}/ExtraSettings.php");}
//Private settings
if (file_exists("{$wmgPrivateDataDirectory}/PrivateSettings.php"))
include_once("{$wmgPrivateDataDirectory}/PrivateSettings.php");

/*Permission inheritance*/
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["bureaucrat"]+=$wgGroupPermissions["admin"];
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]+=$wgGroupPermissions["bureaucrat"];}
?>
