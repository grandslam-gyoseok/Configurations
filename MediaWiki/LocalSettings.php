<?php
##Debugging

/*
$wgShowDBErrorBacktrace=true;
$wgShowExceptionDetails=true;
$wgShowSQLErrors=true;
error_reporting(-1);
ini_set("display_errors",1);
//*/

##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##System

/*Directory*/
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

/*Wiki selector*/
$central_wiki="exit";
if ($wgCommandLineMode)
{if (defined("MW_DB"))
  {$wiki_id=MW_DB;}
else
  {$wiki_id=$central_wiki;}
}
else
{switch (parse_url($wgServer,PHP_URL_HOST))
  {//PlavorMindBeta (exit)
  case "exit.plavormind.tk":
  $wiki_id="exit";
  break;
  default:
  die("You don't have permission to do that.");
  exit;}
}

##Appending settings

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
