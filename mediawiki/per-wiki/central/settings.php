<?php
//< General Settings >

$wgSitename = 'PlavorMind Central';

//< Server URLs and file paths >

$wgLogos = [
  '1x' => "/resources/per-wiki/$wmgWiki/logos/logo-1x.png",
  '1.5x' => "/resources/per-wiki/$wmgWiki/logos/logo-1.5x.png",
  '2x' => "/resources/per-wiki/$wmgWiki/logos/logo-2x.png",
  'icon' => "/resources/per-wiki/$wmgWiki/logos/logo.svg",
  'svg' => "/resources/per-wiki/$wmgWiki/logos/logo.svg"
];

//< Files and file uploads >

//<< Images >>

//<<< Thumbnail settings >>>

// 1.40+
$wgThumbnailNamespaces = [NS_FILE, NS_HELP, NS_MAIN, NS_PROJECT, NS_USER];

//< ResourceLoader >

$wgAllowSiteCSSOnRestrictedPages = true;

//< Page titles and redirects >

//<< Namespaces >>

$wgMetaNamespace = 'PlavorMind';
$wgNamespaceAliases = [
  '@' => NS_USER,
  'PlavorMind_Central' => NS_PROJECT,
  'PM' => NS_PROJECT
];

//< Interwiki links and sites >

$wgLocalInterwikis = ['central'];

//< User rights, access control and monitoring >

if ($wmgGlobalAccountMode === 'shared-db') {
  $wgGroupPermissions['steward'] = array_merge($wgGroupPermissions['steward'], [
    'editinterface' => true,
    'editsitecss' => true,
    'editsitejson' => true,
    'editusercss' => true,
    'edituserjson' => true,
    // This permission was moved from Renameuser extension to core in MediaWiki 1.40.
    'renameuser' => true
  ]);
}

if ($wmgGlobalAccountMode !== null) {
  $wgGroupPermissions = array_replace_recursive($wgGroupPermissions, [
    'admin' => [
      'editinterface' => false,
      'editsitecss' => false,
      'editsitejson' => false,
      'editusercss' => false,
      'edituserjson' => false
    ],
    'steward' => [
      'userrights' => true,
      'userrights-interwiki' => true
    ]
  ]);
}

//<< Access >>

$wgEnablePartialActionBlocks = true;
$wgNamespaceProtection = [
  NS_PROJECT => ['editprotected-admin'],
  NS_TEMPLATE => ['editprotected-admin']
];
// $wgNonincludableNamespaces

//< Copyright >

$wgUseCopyrightUpload = true;

//< Import/Export >

$wgImportSources = [];

//< Extensions >

//<< AbuseFilter >>

if ($wmgGlobalAccountMode === 'centralauth') {
  $wgAbuseFilterIsCentral = true;
  $wgGroupPermissions['steward']['abusefilter-modify-global'] = true;
}

//<< AntiSpoof >>

$wgGroupPermissions['steward']['override-antispoof'] = true;

//<< CentralAuth >>

if ($wmgGlobalAccountMode === 'centralauth') {
  $wgGroupPermissions['steward'] = array_merge($wgGroupPermissions['steward'], [
    'centralauth-lock' => true,
    'centralauth-rename' => true,
    'centralauth-suppress' => true,
    'centralauth-unmerge' => true,
    'globalgroupmembership' => true,
    'globalgrouppermissions' => true
  ]);
}

//<< CiteThisPage >>

$wgCiteThisPageAdditionalNamespaces[NS_PROJECT] = true;

//<< GlobalBlocking >>

if ($wmgGlobalAccountMode !== null) {
  $wgGroupPermissions['steward']['globalblock'] = true;
}

//<< Interwiki >>

if ($wmgGlobalAccountMode === 'shared-db') {
  $wgGroupPermissions['steward']['interwiki'] = true;
}

if ($wmgGlobalAccountMode !== null) {
  $wgGroupPermissions['admin']['interwiki'] = false;
}

//<< OATHAuth >>

$wgGroupPermissions['steward']['oathauth-disable-for-user'] = true;
$wgGroupPermissions['steward']['oathauth-verify-user'] = true;

//<< PlavorMindTools >>

$wgCUGDisableGroups = array_diff($wgCUGDisableGroups, ['steward']);

//<< Renameuser >>

if (version_compare(MW_VERSION, '1.40', '<') && $wmgGlobalAccountMode === 'shared-db') {
  $wgGroupPermissions['steward']['renameuser'] = true;
}

//< Skins >

//<< Vector >>

// 1.40+
// This is same as default in MediaWiki 1.41 or newer.
$wgVectorPageTools['logged_out'] = true;
// Removed in MediaWiki 1.40
$wgVectorVisualEnhancementNext = true;
