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
$private_data_dir="{$IP}/private_data";

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
  {//PlavorEXITBeta (exit)
  case "exit.plavormind.tk":
  $wiki_id="exit";
  break;
  default:
  die("You don't have permission to do that.");
  exit;}
}

##Appending settings

/*Load settings*/
include_once("{$data_dir}/global_settings.php");
include_once("{$data_dir}/{$wiki_id}/settings.php");
include_once("{$data_dir}/extra_settings.php");
include_once("{$data_dir}/{$wiki_id}/extra_settings.php");
include_once("{$private_data_dir}/global_settings.php");

/*Permission inheritance*/
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["bureaucrat"]+=$wgGroupPermissions["admin"];
$wgGroupPermissions["steward"]+=$wgGroupPermissions["bureaucrat"];
?>
