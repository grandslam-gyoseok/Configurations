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
{$wiki_code="exit";}
else
{switch ($_SERVER["HTTP_HOST"])
  {//PlavorEXITBeta (exit)
  case "exit.plavormind.tk:{$_SERVER["SERVER_PORT"]}":
  $wiki_code="exit";
  break;
  default:
  die("You don't have permission to do that.");
  exit;}
}

$central_wiki_code="exit";
$data_dir="{$IP}/data";
$private_data_dir="{$IP}/private_data";

##Settings

/*Load settings*/
include_once("{$data_dir}/global_settings.php");
include_once("{$private_data_dir}/global_settings.php");
include_once("{$data_dir}/{$wiki_code}/settings.php"); //Per-wiki
include_once("{$data_dir}/extra_settings.php");
?>
