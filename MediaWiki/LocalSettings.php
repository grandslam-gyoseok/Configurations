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

##Wiki selector

if ($wgCommandLineMode)
{//For updating
$wiki_code="central";}
else
{switch ($_SERVER["SERVER_NAME"])
  {//PlavorMindCentral (central)
  case "central.plavormind.tk":
  $wiki_code="central";
  break;
  default:
  die("You don't have permission to do that.");
  exit;}
}

$central_wiki_code="central";
$data_dir="{$IP}/data";
$private_data_dir="{$IP}/private_data";

##Settings

/*Load settings*/
//Global settings
include_once("{$data_dir}/global_settings.php");
include_once("{$data_dir}/extra_settings.php");
//Per-wiki settings
include_once("{$data_dir}/{$wiki_code}/settings.php");
include_once("{$data_dir}/{$wiki_code}/extra_settings.php");

##Appending settings

/*Groups*/
//Remove groups
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["bot"]);
unset($wgGroupPermissions["sysop"]);};
//Temporary groups
$wgGroupPermissions["bot"]["read"]=true;
$wgGroupPermissions["sysop"]["read"]=true;
/*
$wgGroupPermissions["interface-admin"]["read"]=true;
$wgAddGroups["bureaucrat"]=["steward"];
$wgRemoveGroups["bureaucrat"]=["bot","interface-admin","sysop"];
//*/
?>
