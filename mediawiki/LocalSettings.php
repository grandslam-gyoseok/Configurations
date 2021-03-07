<?php
if (!defined('MEDIAWIKI'))
  {exit('This is not a valid entry point.');}

//< Custom settings >

$wmgCacheExpiry=60; //1 minute
$wmgCentralWiki='central';
$wmgCIDRLimit=
['IPv4' => 8, //###.0.0.0/8
'IPv6' => 16]; //####::/16
$wmgCustomDomains=[];
$wmgDebugMode=false;
//Put "%wiki%" where the wiki ID should be placed.
$wmgDefaultBaseURL='http://%wiki%.plavormind.tk:81';
$wmgGlobalGroupPermissions=[];
$wmgGroupPermissions=[];
$wmgPermissionInheritances=[];
$wmgWikis=['central', 'osa'];

//<< Directories >>
$wmgDataDirectories=
['Android' => "{$IP}/data",
'Linux' => '/plavormind/web/data/mediawiki',
'Windows' => 'C:/plavormind/web/data/mediawiki'];

//<< Global accounts >>
$wmgGlobalAccountExemptWikis=[];
//Should be one of 'centralauth', 'shared-database' and false
$wmgGlobalAccountMode='centralauth';

//< Initialize >

//<< Callback functions >>
function efGetSiteParams($conf, $wiki)
  {$lang=null;
  $site=null;

  foreach($conf->suffixes as $suffix)
    {if (substr($wiki, -strlen($suffix)) === $suffix)
      {$lang=substr($wiki, 0, -strlen($suffix));
      $site=$suffix;
      break;}
    }

  return
    ['lang' => $lang,
    'params' =>
      ['lang' => $lang,
      'site' => $site,
      'wiki' => $wiki],
    'suffix' => $site,
    'tags' =>
      []
    ];
  }

function set_permissions()
  {global $wgGroupPermissions, $wmgGlobalAccountMode, $wmgGlobalGroupPermissions, $wmgGroupPermissions, $wmgPermissionInheritances;
  $wgGroupPermissions=$wmgGroupPermissions;

  foreach ($wmgPermissionInheritances as $target_group => $source_groups)
    {foreach ($source_groups as $source_group)
      {$wgGroupPermissions[$target_group]=array_merge($wgGroupPermissions[$source_group], $wgGroupPermissions[$target_group]);}
    }

  if ($wmgGlobalAccountMode !== 'centralauth')
    {foreach ($wmgGlobalGroupPermissions as $group => $permissions)
      {$wgGroupPermissions[$group]=is_array($wgGroupPermissions[$group]) ? array_merge($wgGroupPermissions[$group], $permissions) : $permissions;}
    }
  }

$wgConf->siteParamsCallback='efGetSiteParams';
$wgExtensionFunctions[]='set_permissions';

//<< Wiki detection >>
if ($wgCommandLineMode)
  {if (defined('MW_DB'))
    {$wmgWiki=MW_DB;}
  else
    {exit('Wiki is not specified.');}
  }
else
  //parse_url does not return anything if the string only contains domain.
  {$current_domain=parse_url('https://'.$_SERVER['HTTP_HOST'], PHP_URL_HOST);
  $domain_regex=str_replace('%wiki%', '([\w\-]+)', preg_quote(parse_url($wmgDefaultBaseURL, PHP_URL_HOST), '/'));

  if (array_key_exists($current_domain, $wmgCustomDomains))
    {$wmgWiki=$wmgCustomDomains[$current_domain];}
  elseif (preg_match('/^'.$domain_regex.'$/iu', $current_domain, $matches))
    {$wmgWiki=$matches[1];}
  else
    {exit('Cannot find this wiki.');}

  unset($current_domain, $domain_regex);}

if (!in_array($wmgWiki, $wmgWikis))
  {exit('Cannot find this wiki.');}

//<< Others >>
//Dependency of $wmgDataDirectory
$wmgPlatform=$wmgPlatform ?? PHP_OS_FAMILY;

//Dependency of $wmgGrantStewardsGlobalPermissions
if (in_array($wmgWiki, $wmgGlobalAccountExemptWikis))
  {$wmgGlobalAccountMode=false;}

$wmgCentralBaseURL=$wmgCentralBaseURL ?? str_replace('%wiki%', $wmgCentralWiki, $wmgDefaultBaseURL);
$wmgDataDirectory=$wmgDataDirectory ?? $wmgDataDirectories[$wmgPlatform];
$wmgGrantStewardsGlobalPermissions=$wmgGrantStewardsGlobalPermissions ?? ($wmgGlobalAccountMode !== "centralauth");

//< Wiki settings >

//<< Load settings >>
require_once "{$wmgDataDirectory}/GlobalCoreSettings.php";

if (file_exists("{$wmgDataDirectory}/per-wiki/{$wmgWiki}/CoreSettings.php"))
  {include_once "{$wmgDataDirectory}/per-wiki/{$wmgWiki}/CoreSettings.php";}

if (file_exists("{$wmgDataDirectory}/GlobalExtraSettings.php"))
  {include_once "{$wmgDataDirectory}/GlobalExtraSettings.php";}

if (file_exists("{$wmgDataDirectory}/per-wiki/{$wmgWiki}/ExtraSettings.php"))
  {include_once "{$wmgDataDirectory}/per-wiki/{$wmgWiki}/ExtraSettings.php";}

if (file_exists("{$wmgDataDirectory}/private/PrivateSettings.php"))
  {include_once "{$wmgDataDirectory}/private/PrivateSettings.php";}
