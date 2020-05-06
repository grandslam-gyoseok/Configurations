<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

//< Custom settings >

//Put "%wiki%" where the wiki ID should be placed.
//This setting is deprecated.
$wmgBaseURL="http://%wiki%.plavormind.tk:81";
$wmgCacheExpiry=60; //1 minute
$wmgCentralWiki="central";
$wmgCustomDomains=[];
$wmgDataDirectory=$IP."/data";
$wmgDebugMode=false;
//Put "%wiki%" where the wiki ID should be placed.
$wmgDefaultBaseURL="http://%wiki%.plavormind.tk:81";
$wmgGlobalAccountExemptWikis=[];
//Should be one of "", "centralauth" and "shared-database"
$wmgGlobalAccountMode="centralauth";
$wmgPrivateDataDirectories=
["Android"=>$IP."/private-data",
"Linux"=>"/plavormind/web/data/mediawiki",
"Windows"=>"C:/plavormind/web/data/mediawiki"];
$wmgWikis=["central","osa"];

//< Initialize >

//<< efGetSiteParams callback >>
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
$wgConf->siteParamsCallback="efGetSiteParams";

//<< Wiki detection >>
if ($wgCommandLineMode)
{if (defined("MW_DB"))
  {$wmgWiki=MW_DB;}
else
  {exit("Wiki is not specified.");}
}
else
//parse_url doesn't return anything if the string only contains domain.
{$current_domain=parse_url("//".$_SERVER["HTTP_HOST"],PHP_URL_HOST);
$domain_regex=str_replace("%wiki%","([\w\-]+)",preg_quote(parse_url($wmgDefaultBaseURL,PHP_URL_HOST),"/"));
if (array_key_exists($current_domain,$wmgCustomDomains))
  {$wmgWiki=$wmgCustomDomains[$current_domain];}
elseif (preg_match("/^".$domain_regex."$/iu",$current_domain,$matches))
  {$wmgWiki=$matches[1];}
else
  {exit("Cannot find this wiki.");}
unset($current_domain,$domain_regex);}

if (!in_array($wmgWiki,$wmgWikis))
{exit("Cannot find this wiki.");}

//<< Others >>
//Dependency of $wmgDataDirectory and $wmgPrivateDataDirectory
if (!isset($wmgPlatform))
{$wmgPlatform=PHP_OS_FAMILY;}

if (!isset($wmgCentralBaseURL))
{$wmgCentralBaseURL=str_replace("%wiki%",$wmgCentralWiki,$wmgDefaultBaseURL);}
if (!isset($wmgDataDirectory))
{$wmgDataDirectory=$wmgDataDirectories[$wmgPlatform];}
if (in_array($wmgWiki,$wmgGlobalAccountExemptWikis))
{$wmgGlobalAccountMode="";}
if (!isset($wmgPrivateDataDirectory))
{$wmgPrivateDataDirectory=$wmgPrivateDataDirectories[$wmgPlatform];}

if (!isset($wmgGrantStewardsGlobalPermissions))
{if ($wmgGlobalAccountMode == "centralauth")
  {$wmgGrantStewardsGlobalPermissions=false;}
else
  {$wmgGrantStewardsGlobalPermissions=true;}
}

require_once($wmgDataDirectory."/GlobalCoreSettings.php");
if (file_exists($wmgDataDirectory."/".$wmgWiki."/CoreSettings.php"))
{include_once($wmgDataDirectory."/".$wmgWiki."/CoreSettings.php");}
if (file_exists($wmgDataDirectory."/GlobalExtraSettings.php"))
{include_once($wmgDataDirectory."/GlobalExtraSettings.php");}
if (file_exists($wmgDataDirectory."/".$wmgWiki."/ExtraSettings.php"))
{include_once($wmgDataDirectory."/".$wmgWiki."/ExtraSettings.php");}
if (file_exists($wmgPrivateDataDirectory."/PrivateSettings.php"))
{include_once($wmgPrivateDataDirectory."/PrivateSettings.php");}
