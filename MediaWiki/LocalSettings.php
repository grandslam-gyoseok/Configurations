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

$central_wiki_code="exit";
$data_dir="{$IP}/data";
$private_data_dir="{$IP}/private_data";

if ($wgCommandLineMode)
{if (defined("MW_DB"))
  {$wiki_code=MW_DB;}
else
  {$wiki_code=$central_wiki_code;}
}
else
{switch (parse_url($wgServer,PHP_URL_HOST))
  {//PlavorEXITBeta (exit)
  case "exit.plavormind.tk":
  $wiki_code="exit";
  break;
  default:
  die("You don't have permission to do that.");
  exit;}
}

##Appending settings

/*Load settings*/
include_once("{$data_dir}/global_settings.php");
include_once("{$private_data_dir}/global_settings.php");
include_once("{$data_dir}/{$wiki_code}/settings.php"); //Per-wiki
include_once("{$data_dir}/extra_settings.php");
include_once("{$private_data_dir}/extra_settings.php");
include_once("{$data_dir}/{$wiki_code}/extra_settings.php"); //Per-wiki
?>
