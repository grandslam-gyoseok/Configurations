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

// This should be migrated to on-wiki later. $wgSiteNotice should never be used again.
$wgSiteNotice = 'Current [[MediaWiki]] version: [[Special:Version|{{CURRENTVERSION}}]]';

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

// $wgLocalInterwikis

//< User rights, access control and monitoring >

$wgGroupPermissions['steward']['userrights'] = true;
$wgGroupPermissions['steward']['userrights-interwiki'] = true;

$wgGroupPermissions['admin'] = array_merge($wgGroupPermissions['admin'], [
  'editinterface' => false,
  'editsitecss' => false,
  'editsitejson' => false,
  'editusercss' => false,
  'edituserjson' => false
]);

if ($wmgGlobalAccountMode !== 'centralauth') {
  $wgGroupPermissions['steward'] = array_merge($wgGroupPermissions['steward'], [
    'editinterface' => true,
    'editsitecss' => true,
    'editsitejson' => true,
    'editusercss' => true,
    'edituserjson' => true,
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

//< Miscellaneous settings >

$wgRedirectOnLogin = 'PlavorMindCentral';

//< Extensions >

//<< Extension usage >>
$wmgExtensions=array_merge($wmgExtensions,
['Babel' => true,
'Cite' => true,
'CodeEditor' => true,
'CodeMirror' => true,
'CommonsMetadata' => true,
'Highlightjs_Integration' => true,
'MassEditRegex' => true,
'MultimediaViewer' => true,
'Nuke' => true,
'PageImages' => true,
'Poem' => true,
'Popups' => true,
'ReplaceText' => true,
'RevisionSlider' => true,
'SyntaxHighlight_GeSHi' => true,
'TemplateData' => true,
'TemplateSandbox' => true,
'TemplateStyles' => true,
'TemplateWizard' => true,
'TextExtracts' => true,
'TwoColConflict' => true,
'UniversalLanguageSelector' => true,
'UploadsLink' => true,
'WikiEditor' => true]);

//< Skins >

//<< Skin usage >>
$wmgSkins['Citizen'] = true;
$wmgSkins['MinervaNeue'] = true;
$wmgSkins['Timeless'] = true;
