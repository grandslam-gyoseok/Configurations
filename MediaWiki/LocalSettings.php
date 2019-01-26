<?php
/*Debug
error_reporting(-1);
ini_set("display_errors",1);
$wgShowDBErrorBacktrace=true;
$wgShowExceptionDetails=true;
$wgShowSQLErrors=true;
//*/

/*Prevent web access*/
if (!defined("MEDIAWIKI"))
{exit;}

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
  //$_SERVER["HTTPS"]
  header("Location: http://{$_SERVER["HTTP_HOST"]}/error/403.html");
  exit;}
}

$central_wiki_code="central";
$data_dir="{$IP}/data";
$private_data_dir="{$IP}/private_data";

require_once("https://raw.githubusercontent.com/PlavorMind/Configurations/Main/MediaWiki/data/global_settings.php");
require_once("https://raw.githubusercontent.com/PlavorMind/Configurations/Main/MediaWiki/data/extra_settings.php");
include_once("{$data_dir}/{$wiki_code}/settings.php");

/*
$wgGroupPermissions["bot"]["read"]=true;
$wgGroupPermissions["interface-admin"]["read"]=true;
$wgGroupPermissions["sysop"]["read"]=true;
$wgGroupPermissions["bureaucrat"]["userrights"]=true;
//*/
?>
