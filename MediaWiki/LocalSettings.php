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
{exit("You don't have permission to access to this page.");}

##System

/*Directory (priority: 1)*/
$data_dir="{$IP}/data";
switch (PHP_OS_FAMILY)
{case "Linux":
$private_data_dir="/plavormind/web_data/mediawiki";
break;
case "Windows":
$private_data_dir="C:/plavormind/web_data/mediawiki";
break;
default:
$private_data_dir="{$IP}/private_data";}

/*Wiki selector (priority: 1)*/
$central_wiki="exit";
if ($wgCommandLineMode)
{if (defined("MW_DB"))
  {$wiki_id=MW_DB;}
else
  {$wiki_id=$central_wiki;}
}
elseif (preg_match("/(.+)\.plavormind\.tk/i",parse_url($_SERVER["HTTP_HOST"],PHP_URL_HOST),$matches))
{$wiki_id=$matches[1];}
else
{exit("Cannot find this wiki.");}

/*Database (priority: 2)*/
$wgDBname="{$wiki_id}wiki";
//Local databases (required by $wgConf)
$wgLocalDatabases=["exitwiki"];
if (!in_array($wgDBname,$wgLocalDatabases))
{exit("Cannot find this wiki.");}

##Wiki settings

/*Load settings*/
if (file_exists("{$data_dir}/general_settings.php"))
{include_once("{$data_dir}/general_settings.php");}
if (file_exists("{$data_dir}/{$wiki_id}/general_settings.php"))
{include_once("{$data_dir}/{$wiki_id}/general_settings.php");}
if (file_exists("{$data_dir}/extra_settings.php"))
{include_once("{$data_dir}/extra_settings.php");}
if (file_exists("{$data_dir}/{$wiki_id}/extra_settings.php"))
{include_once("{$data_dir}/{$wiki_id}/extra_settings.php");}
if (file_exists("{$private_data_dir}/settings.php"))
include_once("{$private_data_dir}/settings.php");

/*Permission inheritance*/
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["bureaucrat"]+=$wgGroupPermissions["admin"];
$wgGroupPermissions["steward"]+=$wgGroupPermissions["bureaucrat"];
?>
