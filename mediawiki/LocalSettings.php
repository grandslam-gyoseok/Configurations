<?php
function getWiki($defaultDomain, $uploadDomain, $customDomains) {
  if (PHP_SAPI === 'cli') {
    if (defined('MW_DB')) {
      return MW_DB;
    }

    return;
  }

  $currentDomain = parse_url('//' . $_SERVER['HTTP_HOST'], PHP_URL_HOST);
  $wiki = array_search($currentDomain, $customDomains, true);

  if ($wiki !== false) {
    return $wiki;
  }

  foreach ([$defaultDomain, $uploadDomain] as $expectedDomain) {
    $regex = str_replace('%wiki%', '([\w\-]+)', preg_quote($expectedDomain, '/'));

    if (preg_match("/^{$regex}$/i", $currentDomain, $matches)) {
      return $matches[1];
    }
  }
}

if (!defined('MEDIAWIKI')) {
  exit('This is not valid entry point.');
}

//< Custom settings >

$wmgBaseURL = 'http://%domain%:81';
// 1 minute
$wmgCacheExpiry = 60;
$wmgCentralWiki = 'central';
$wmgCIDRLimit = [
  // ###.0.0.0/8
  'IPv4' => 8,
  // ####::/16
  'IPv6' => 16
];
$wmgCustomDomains = [];
$wmgDebugLevel = 0;
$wmgDefaultDomain = '%wiki%.plavormind.tk';
$wmgWiki = getWiki($wmgDefaultDomain, 'default', $wmgCustomDomains);
$wmgWikis = ['central', 'osa'];

$domain = $wmgCustomDomains[$wmgCentralWiki] ?? str_replace('%wiki%', $wmgCentralWiki, $wmgDefaultDomain);
$wmgCentralBaseURL = str_replace('%domain%', $domain, $wmgBaseURL);
unset($domain);

switch (PHP_OS_FAMILY) {
  case 'Linux':
  $wmgDataDirectory = '/plavormind/web/data/mediawiki';
  break;

  case 'Windows':
  $wmgDataDirectory = 'C:/plavormind/web/data/mediawiki';
}

if (PHP_SAPI === 'cli' || $wmgDebugLevel >= 1) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
}

if (!in_array($wmgWiki, $wmgWikis, true)) {
  exit('Cannot find this wiki.');
}

//<< $wgConf callback >>

$wgConf->siteParamsCallback = function ($siteConfiguration, $wikiDB) {
  $wiki = preg_replace('/wiki$/', '', $wikiDB);
  return [
    'lang' => 'en',
    'params' => [
      'wiki' => $wiki
    ],
    'suffix' => '',
    'tags' => [$wiki]
  ];
};

//<< Backward compatibility >>

$wmgDebugMode = (PHP_SAPI === 'cli') || $wmgDebugLevel >= 1;
$wmgDefaultBaseURL = str_replace('%domain%', $wmgDefaultDomain, $wmgBaseURL);
$wmgGrantStewardsGlobalPermissions = false;
$wmgPlatform = PHP_OS_FAMILY;

//<< Global accounts >>

$wmgGlobalAccountExemptWikis = [];
// 'centralauth', 'shared-db' or null
$wmgGlobalAccountMode = 'centralauth';

if (in_array($wmgWiki, $wmgGlobalAccountExemptWikis, true)) {
  $wmgGlobalAccountMode = null;
}

//< Load settings >

require_once "$wmgDataDirectory/GlobalCoreSettings.php";

if (file_exists("$wmgDataDirectory/per-wiki/$wmgWiki/CoreSettings.php")) {
  include_once "$wmgDataDirectory/per-wiki/$wmgWiki/CoreSettings.php";
}

require_once "$wmgDataDirectory/GlobalExtraSettings.php";

if (file_exists("$wmgDataDirectory/per-wiki/$wmgWiki/ExtraSettings.php")) {
  include_once "$wmgDataDirectory/per-wiki/$wmgWiki/ExtraSettings.php";
}

if (file_exists("$wmgDataDirectory/private/PrivateSettings.php")) {
  include_once "$wmgDataDirectory/private/PrivateSettings.php";
}
