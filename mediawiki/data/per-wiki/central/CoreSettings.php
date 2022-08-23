<?php
//< General Settings >

$wgSitename = 'PlavorMindCentral';

//< Server URLs and file paths >

$wgLogos = [
  '1x' => "/resources/per-wiki/$wmgWiki/logos/logo-1x.png",
  '1.5x' => "/resources/per-wiki/$wmgWiki/logos/logo-1.5x.png",
  '2x' => "/resources/per-wiki/$wmgWiki/logos/logo-2x.png",
  'icon' => "/resources/per-wiki/$wmgWiki/logos/logo-2x.png"
];

//< Output format and skin settings >

//<< Output >>

$wgSiteNotice = '[[MediaWiki]] version: [[Special:Version|{{CURRENTVERSION}}]]';

//< ResourceLoader >

$wgAllowSiteCSSOnRestrictedPages = true;

//< Page titles and redirects >

//<< Namespaces >>

$wgMetaNamespace = 'PlavorMind';
$wgNamespaceAliases = [
  '@' => NS_USER,
  'PlavorMindCentral' => NS_PROJECT,
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
  ]);
}

if ($wmgGlobalAccountMode !== null) {
  $wgGroupPermissions['admin'] = array_merge($wgGroupPermissions['admin'], [
    'editinterface' => false,
    'editsitecss' => false,
    'editsitejson' => false,
    'editusercss' => false,
    'edituserjson' => false
  ]);
  $wgGroupPermissions['steward']['userrights'] = true;
  $wgGroupPermissions['steward']['userrights-interwiki'] = true;
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

//< Miscellaneous settings >

$wgRedirectOnLogin = 'PlavorMindCentral';
