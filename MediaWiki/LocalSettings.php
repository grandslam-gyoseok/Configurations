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

include_once("{$data_dir}/global_settings.php");
include_once("{$data_dir}/{$wiki_code}/settings.php");

wfLoadExtension("PlavorMindTweaks");
wfLoadSkin("Vector");
?>
