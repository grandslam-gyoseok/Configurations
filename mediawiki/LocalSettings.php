<?php
function getWiki($defaultDomain, $uploadDomain, $customDomains) {
  if (PHP_SAPI === 'cli') {
    if (defined('MW_WIKI_NAME')) {
      return MW_WIKI_NAME;
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
$wmgDefaultDomain = '%wiki%.plavormind.io';
$wmgUseExtensions = [
  'Babel' => true,
  'Cite' => true,
  'CodeEditor' => false,
  'CodeMirror' => false,
  'CommonsMetadata' => false,
  'GlobalCssJs' => true,
  'GlobalUserPage' => true,
  'Highlightjs_Integration' => false,
  'InputBox' => false,
  'Josa' => false,
  'Math' => false,
  'MultimediaViewer' => false,
  'Nuke' => true,
  'PageImages' => false,
  'ParserFunctions' => true,
  'Poem' => false,
  'Popups' => false,
  'ReplaceText' => false,
  'RevisionSlider' => false,
  'Scribunto' => false,
  'SyntaxHighlight_GeSHi' => false,
  'TemplateData' => false,
  'TemplateSandbox' => false,
  'TemplateStyles' => false,
  'TemplateWizard' => false,
  'TextExtracts' => false,
  'TwoColConflict' => true,
  'UniversalLanguageSelector' => false,
  'UploadsLink' => false,
  'WikiEditor' => true
];
$wmgUseSkins = [
  'MinervaNeue' => false,
  'Timeless' => false
];
$wmgWiki = getWiki($wmgDefaultDomain, 'default', $wmgCustomDomains);
$wmgWikis = ['central', 'osa'];

$wmgCentralDB = "{$wmgCentralWiki}wiki";

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

//<< Global accounts >>

$wmgGlobalAccountExemptWikis = [];
// 'centralauth', 'shared-db' or null
$wmgGlobalAccountMode = 'centralauth';

if (in_array($wmgWiki, $wmgGlobalAccountExemptWikis, true)) {
  $wmgGlobalAccountMode = null;
}

//< Load settings >

require_once "$wmgDataDirectory/GlobalCoreSettings.php";
require_once "$wmgDataDirectory/GlobalExtraSettings.php";

if (file_exists("$wmgDataDirectory/per-wiki/$wmgWiki/CoreSettings.php")) {
  include_once "$wmgDataDirectory/per-wiki/$wmgWiki/CoreSettings.php";
}

if (file_exists("$wmgDataDirectory/per-wiki/$wmgWiki/ExtraSettings.php")) {
  include_once "$wmgDataDirectory/per-wiki/$wmgWiki/ExtraSettings.php";
}

require_once "$wmgDataDirectory/private/PrivateSettings.php";
