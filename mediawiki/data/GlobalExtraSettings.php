<?php
//< Extensions >

//<< AbuseFilter >>

wfLoadExtension('AbuseFilter');
$wgAbuseFilterActionRestrictions = [
  'block' => false,
  'blockautopromote' => false,
  'degroup' => false,
  'disallow' => false,
  'rangeblock' => false,
  'tag' => false,
  'throttle' => false,
  'warn' => false
];
$wgAbuseFilterActions = [
  'block' => false,
  'blockautopromote' => false,
  'degroup' => false,
  'disallow' => true,
  'rangeblock' => false,
  'tag' => false,
  'throttle' => false,
  'warn' => true
];
// $wgAbuseFilterDefaultDisallowMessage
// $wgAbuseFilterDefaultWarningMessage
$wgAbuseFilterEmergencyDisableCount = [
  'default' => 10
];
$wgAbuseFilterEmergencyDisableThreshold = [
  'default' => 0.1
];
$wgAbuseFilterNotifications = 'rcandudp';

$wgGroupPermissions['suppress']['abusefilter-hidden-log'] = false;
$wgGroupPermissions['suppress']['abusefilter-hide-log'] = false;
// array_merge() should not be used here because sysop group was not defined before.
$wgGroupPermissions['sysop'] = [
  'abusefilter-log-detail' => false,
  'abusefilter-log-private' => false,
  'abusefilter-modify' => false,
  'abusefilter-modify-restricted' => false,
  'abusefilter-revert' => false,
  'abusefilter-view-private' => false
];
$wgGroupPermissions['moderator']['abusefilter-log-detail'] = true;
$wgGroupPermissions['staff']['abusefilter-modify'] = true;
$wgGroupPermissions['admin']['abusefilter-log-detail'] = true;
$wgGroupPermissions['admin']['abusefilter-modify-restricted'] = true;

if ($wmgGlobalAccountMode === 'centralauth') {
  $wgAbuseFilterCentralDB = $wmgCentralDB;
}
else {
  $wgGroupPermissions['steward'] = array_merge($wgGroupPermissions['steward'], [
    'abusefilter-hidden-log' => true,
    'abusefilter-hide-log' => true,
    'abusefilter-modify' => true,
    'abusefilter-privatedetails' => true,
    'abusefilter-privatedetails-log' => true,
    'abusefilter-revert' => true
  ]);
}

//<< AntiSpoof >>

// This extension requires running update.php.
wfLoadExtension('AntiSpoof');

$wgGroupPermissions['bureaucrat']['override-antispoof'] = false;
$wgGroupPermissions['sysop']['override-antispoof'] = false;

if ($wmgGlobalAccountMode === null) {
  $wgGroupPermissions['steward']['override-antispoof'] = true;
}
elseif ($wmgGlobalAccountMode === 'shared-db') {
  $wgSharedTables[] = 'spoofuser';
}

//<< Babel >>

if ($wmgUseExtensions['Babel']) {
  // This extension requires running update.php.
  wfLoadExtension('Babel');
  $wgBabelCategoryNames = [
    '0' => false,
    '1' => false,
    '2' => false,
    '3' => false,
    '4' => false,
    '5' => false,
    'N' => false
  ];
  $wgBabelMainCategory = false;
  $wgBabelUseUserLanguage = true;
}

//<< CentralAuth >>

if ($wmgGlobalAccountMode === 'centralauth') {
  // This extension requires running update.php.
  wfLoadExtension('CentralAuth');
  $wgCentralAuthAutoMigrate = true;
  $wgCentralAuthAutoMigrateNonGlobalAccounts = true;
  $wgCentralAuthCookies = true;
  $wgCentralAuthCreateOnView = true;
  $wgCentralAuthDatabase = 'wiki_centralauth';
  $wgCentralAuthGlobalPasswordPolicies['steward'] = $wgPasswordPolicy['policies']['steward'];
  $wgCentralAuthLoginWiki = $wmgCentralDB;
  $wgCentralAuthOldNameAntiSpoofWiki = $wmgCentralDB;
  $wgCentralAuthPreventUnattached = true;
  $wgCentralAuthStrict = true;
  $wgDisableUnmergedEditing = true;
  $wgGroupPermissions['sysop']['centralauth-createlocal'] = false;
  $wgGroupPermissions['*']['centralauth-merge'] = false;
  $wgGroupPermissions['user']['centralauth-merge'] = true;
  $wgGroupPermissions['steward']['centralauth-createlocal'] = false;
  $wgGroupPermissions['steward']['centralauth-lock'] = false;
  $wgGroupPermissions['steward']['centralauth-suppress'] = false;
  $wgGroupPermissions['steward']['centralauth-unmerge'] = false;

  if (strpos($wmgDefaultDomain, '%wiki%.') === 0 && !isset($wmgCustomDomains[$wmgWiki])) {
    $wgCentralAuthCookieDomain = preg_replace('/^%wiki%/', '', $wmgDefaultDomain);
  }
}

//<< CheckUser >>

// This extension requires running update.php.
wfLoadExtension('CheckUser');
$wgCheckUserCIDRLimit = $wmgCIDRLimit;
$wgCheckUserEnableSpecialInvestigate = true;
$wgCheckUserLogLogins = true;
$wgCheckUserMaxBlocks = 10;

$wgGroupPermissions['checkuser']['checkuser'] = false;
$wgGroupPermissions['checkuser']['checkuser-log'] = false;

if ($wmgGlobalAccountMode === 'centralauth') {
  $wgCheckUserCAMultiLock = [
    'centralDB' => $wmgCentralDB,
    'groups' => ['steward']
  ];
  $wgCheckUserCAtoollink = $wmgCentralDB;
  $wgCheckUserGBtoollink = [
    'centralDB' => $wmgCentralDB,
    'groups' => ['steward']
  ];
}
else {
  $wgGroupPermissions['steward']['checkuser'] = true;
  $wgGroupPermissions['steward']['checkuser-log'] = true;
}

//<< Cite >>

if ($wmgUseExtensions['Cite']) {
  wfLoadExtension('Cite');
  $wgCiteBookReferencing = true;
}

//<< CodeEditor >>

if ($wmgUseExtensions['CodeEditor'] && $wmgUseExtensions['WikiEditor']) {
  wfLoadExtension('CodeEditor');
}

//<< CodeMirror >>

if ($wmgUseExtensions['CodeMirror'] && $wmgUseExtensions['WikiEditor']) {
  wfLoadExtension('CodeMirror');
}

//<< CommonsMetadata >>

if ($wmgUseExtensions['CommonsMetadata']) {
  wfLoadExtension('CommonsMetadata');
}

//<< ConfirmEdit >>

wfLoadExtensions(['ConfirmEdit', 'ConfirmEdit/hCaptcha']);
// This completely blocks API login until expiration.
// 10 minutes
$wgCaptchaBadLoginExpiration = 60 * 10;
$wgCaptchaBadLoginPerUserAttempts = 10;
// This completely blocks API login until expiration.
// 1 day
$wgCaptchaBadLoginPerUserExpiration = 60 * 60 * 24;
$wgCaptchaTriggers['create'] = true;
$wgCaptchaTriggers['sendemail'] = true;
$wgCaptchaTriggersOnNamespace = [
  NS_USER => [
    'create' => false
  ]
];

$wgGroupPermissions['bot']['skipcaptcha'] = false;
$wgGroupPermissions['sysop']['skipcaptcha'] = false;
$wgGroupPermissions['autoconfirmed']['skipcaptcha'] = true;
$wgGroupPermissions['staff']['skipcaptcha'] = true;

if ($wmgGlobalAccountMode !== 'centralauth') {
  $wgGroupPermissions['steward']['skipcaptcha'] = true;
}

//<< Echo >>

// This extension requires running update.php.
wfLoadExtension('Echo');
$wgDefaultNotifyTypeAvailability = [
  'email' => false,
  'web' => true
];
$wgEchoMaxMentionsCount = 10;
$wgEchoMaxMentionsInEditSummary = 10;
// This is also the number of maximum notifications for single user to have.
$wgEchoMaxUpdateCount = 100;
$wgEchoMentionStatusNotifications = true;
// $wgEchoNotificationIcons
$wgEchoOnWikiBlacklist = null;
$wgEchoPerUserWhitelistFormat = null;
$wgEchoPollForUpdates = 30;
$wgEchoWatchlistNotifications = true;
$wgNotifyTypeAvailabilityByCategory = [
  'edit-user-talk' => [
    'email' => true,
    'web' => true
  ],
  'mention' => [
    'email' => true,
    'web' => true
  ],
  'user-rights' => [
    'email' => true,
    'web' => true
  ]
];

$wgGroupPermissions['push-subscription-manager']['manage-all-push-subscriptions'] = false;

$wgDefaultUserOptions = array_merge($wgDefaultUserOptions, [
  'echo-email-frequency' => -1,
  'echo-show-poll-updates' => 1,
  'echo-subscriptions-email-user-rights' => 0,
  'echo-subscriptions-web-mention-failure' => 1,
  'echo-subscriptions-web-thank-you-edit' => 0
]);

if ($wmgGlobalAccountMode !== null) {
  $wgDefaultUserOptions['echo-cross-wiki-notifications'] = 1;
  $wgEchoCrossWikiNotifications = true;
  $wgEchoSharedTrackingDB = $wmgCentralDB;
}

if ($wmgGlobalAccountMode !== 'centralauth') {
  $wgGroupPermissions['steward']['manage-all-push-subscriptions'] = true;
}

//<< GlobalBlocking >>

if ($wmgGlobalAccountMode === 'shared-db') {
  $wgGroupPermissions['steward']['globalblock-exempt'] = true;
  $wgGroupPermissions['steward']['globalblock-whitelist'] = true;
}

if ($wmgGlobalAccountMode !== null) {
  // This extension requires running update.php.
  wfLoadExtension('GlobalBlocking');
  $wgGlobalBlockingCIDRLimit = $wmgCIDRLimit;
  $wgGlobalBlockingDatabase = $wmgCentralDB;
  $wgGlobalBlockRemoteReasonUrl = "{$wmgCentralBaseURL}{$wgScriptPath}/api.php";
  $wgGroupPermissions['sysop']['globalblock-whitelist'] = false;
  $wgGroupPermissions['steward']['globalblock'] = false;
}

//<< GlobalCssJs >>

if ($wmgUseExtensions['GlobalCssJs'] && $wmgGlobalAccountMode !== null) {
  wfLoadExtension('GlobalCssJs');
  $wgGlobalCssJsConfig = [
    'source' => 'central',
    'wiki' => $wmgCentralDB
  ];

  $wgResourceLoaderSources['central'] = [
    'apiScript' => "{$wmgCentralBaseURL}{$wgScriptPath}/api.php",
    'loadScript' => "{$wmgCentralBaseURL}{$wgScriptPath}/load.php"
  ];
}

//<< GlobalPreferences >>

if ($wmgGlobalAccountMode === 'centralauth') {
  $wgGlobalPreferencesDB = $wmgCentralDB;
}

if ($wmgGlobalAccountMode !== null) {
  // This extension requires running update.php.
  wfLoadExtension('GlobalPreferences');
}

//<< GlobalUserPage >>

if ($wmgUseExtensions['GlobalUserPage'] && $wmgGlobalAccountMode !== null) {
  wfLoadExtension('GlobalUserPage');
  $wgGlobalUserPageAPIUrl = "{$wmgCentralBaseURL}{$wgScriptPath}/api.php";
  $wgGlobalUserPageCacheExpiry = $wmgCacheExpiry;
  $wgGlobalUserPageDBname = $wmgCentralDB;
  // $wgGlobalUserPageFooterKey
  $wgGlobalUserPageTimeout = 'default';
}

//<< Highlightjs_Integration >>

if ($wmgUseExtensions['Highlightjs_Integration'] && PHP_OS_FAMILY === 'Windows') {
  wfLoadExtension('Highlightjs_Integration');
}

//<< InputBox >>

if ($wmgUseExtensions['InputBox']) {
  wfLoadExtension('InputBox');
}

//<< Interwiki >>

wfLoadExtension('Interwiki');

$wgGroupPermissions['admin']['interwiki'] = true;

if ($wmgGlobalAccountMode !== null) {
  $wgInterwikiCentralDB = $wmgCentralDB;
}

//<< Josa >>

if ($wmgUseExtensions['Josa']) {
  wfLoadExtension('Josa');
}

//<< Math >>

if ($wmgUseExtensions['Math']) {
  // This extension requires running update.php.
  wfLoadExtension('Math');
  $wgMathEnableWikibaseDataType = false;
  $wgMathValidModes = ['mathml', 'source'];
}

//<< MultimediaViewer >>

if ($wmgUseExtensions['MultimediaViewer']) {
  wfLoadExtension('MultimediaViewer');
}

//<< Nuke >>

if ($wmgUseExtensions['Nuke']) {
  wfLoadExtension('Nuke');

  $wgGroupPermissions['sysop']['nuke'] = false;
  $wgGroupPermissions['staff']['nuke'] = true;

  if ($wmgGlobalAccountMode !== 'centralauth') {
    $wgGroupPermissions['steward']['nuke'] = true;
  }
}

//<< OATHAuth >>

wfLoadExtension('OATHAuth');
$wgOATHRequiredForGroups = ['steward'];

$wgGroupPermissions['sysop']['oathauth-disable-for-user'] = false;
$wgGroupPermissions['sysop']['oathauth-verify-user'] = false;
$wgGroupPermissions['sysop']['oathauth-view-log'] = false;

if ($wmgGlobalAccountMode === null) {
  $wgGroupPermissions['steward']['oathauth-disable-for-user'] = true;
  $wgGroupPermissions['steward']['oathauth-verify-user'] = true;
}
else {
  $wgOATHAuthAccountPrefix = 'PlavorMind wikis';
  $wgOATHAuthDatabase = $wmgCentralDB;
}

if ($wmgGlobalAccountMode !== 'centralauth') {
  $wgGroupPermissions['steward']['oathauth-api-all'] = true;
  $wgGroupPermissions['steward']['oathauth-view-log'] = true;
}

//<< PageImages >>

if ($wmgUseExtensions['PageImages']) {
  wfLoadExtension('PageImages');
  $wgPageImagesDenylistExpiry = $wmgCacheExpiry;
  $wgPageImagesExpandOpenSearchXml = true;
  $wgPageImagesNamespaces = [NS_HELP, NS_MAIN, NS_PROJECT, NS_USER];
}

//<< ParserFunctions >>

if ($wmgUseExtensions['ParserFunctions']) {
  wfLoadExtension('ParserFunctions');
  $wgPFEnableStringFunctions = true;
}

//<< Parsoid >>

wfLoadExtension('Parsoid', "$IP/vendor/wikimedia/parsoid/extension.json");

//<< PlavorMindTools >>

wfLoadExtension('PlavorMindTools');
$wgPMTFeatureConfig = [
  'BlueCategoryLinks' => [
    'enable' => false
  ],
  'NoActionsOnNonEditable' => [
    'enable' => true,
    'HideMoveTab' => true
  ],
  'ReplaceInterfaceMessages' => [
    'enable' => true,
    'EnglishSystemUsers' => true
  ],
  'UserPageAccess' => [
    'enable' => true
  ]
];

$wgGroupPermissions['moderator']['editotheruserpages'] = true;
$wgGroupPermissions['admin']['editotheruserpages'] = true;

//<< Poem >>

if ($wmgUseExtensions['Poem']) {
  wfLoadExtension('Poem');
}

//<< Popups >>

if ($wmgUseExtensions['Popups'] && $wmgUseExtensions['PageImages'] && $wmgUseExtensions['TextExtracts']) {
  wfLoadExtension('Popups');
  $wgPopupsHideOptInOnPreferencesPage = true;
  $wgPopupsReferencePreviewsBetaFeature = false;
}

//<< Renameuser >>

wfLoadExtension('Renameuser');

$wgGroupPermissions['bureaucrat']['renameuser'] = false;

if ($wmgGlobalAccountMode === null) {
  $wgGroupPermissions['steward']['renameuser'] = true;
}

//<< ReplaceText >>

if ($wmgUseExtensions['ReplaceText']) {
  wfLoadExtension('ReplaceText');
  $wgReplaceTextResultsLimit = 100;

  $wgGroupPermissions['sysop']['replacetext'] = false;

  if ($wmgGlobalAccountMode !== 'centralauth') {
    $wgGroupPermissions['steward']['replacetext'] = true;
  }
}

//<< RevisionSlider >>

if ($wmgUseExtensions['RevisionSlider']) {
  wfLoadExtension('RevisionSlider');
}

//<< Scribunto >>

if ($wmgUseExtensions['Scribunto']) {
  wfLoadExtension('Scribunto');
}

//<< StaffPowers >>

wfLoadExtension('StaffPowers');
$wgStaffPowersShoutWikiMessages = false;
$wgStaffPowersStewardGroupName = 'admin';

$wgGroupPermissions['staff']['unblockable'] = false;

if ($wmgGlobalAccountMode !== 'centralauth') {
  $wgGroupPermissions['steward']['unblockable'] = true;
}

//<< SyntaxHighlight_GeSHi >>

if ($wmgUseExtensions['SyntaxHighlight_GeSHi'] && PHP_OS_FAMILY === 'Linux') {
  wfLoadExtension('SyntaxHighlight_GeSHi');
}

//<< TemplateData >>

if ($wmgUseExtensions['TemplateData']) {
  wfLoadExtension('TemplateData');
}

//<< TemplateSandbox >>

if ($wmgUseExtensions['TemplateSandbox']) {
  wfLoadExtension('TemplateSandbox');
}

//<< TemplateStyles >>

if ($wmgUseExtensions['TemplateStyles']) {
  wfLoadExtension('TemplateStyles');
  // Remove default values
  $wgTemplateStylesAllowedUrls = [];
}

//<< TemplateWizard >>

if ($wmgUseExtensions['TemplateWizard'] && $wmgUseExtensions['TemplateData'] && $wmgUseExtensions['WikiEditor']) {
  wfLoadExtension('TemplateWizard');
}

//<< TextExtracts >>

if ($wmgUseExtensions['TextExtracts']) {
  wfLoadExtension('TextExtracts');
  $wgExtractsExtendOpenSearchXml = true;
}

//<< TitleBlacklist >>

wfLoadExtension('TitleBlacklist');
$wgTitleBlacklistCaching['expiry'] = $wmgCacheExpiry;
$wgTitleBlacklistCaching['warningexpiry'] = $wmgCacheExpiry;
$wgTitleBlacklistLogHits = true;
$wgTitleBlacklistSources = [
  'global' => [
    'src' => "$wmgDataDirectory/private/title-blacklist.txt",
    'type' => 'file'
  ]
];

$wgGroupPermissions['sysop']['tboverride'] = false;
$wgGroupPermissions['sysop']['titleblacklistlog'] = false;

if ($wmgGlobalAccountMode !== null) {
  $wgTitleBlacklistUsernameSources = ['global'];
}

if ($wmgGlobalAccountMode !== 'centralauth') {
  $wgGroupPermissions['steward']['tboverride'] = true;
  $wgGroupPermissions['steward']['titleblacklistlog'] = true;
}

//<< TwoColConflict >>

if ($wmgUseExtensions['TwoColConflict']) {
  wfLoadExtension('TwoColConflict');
  $wgTwoColConflictBetaFeature = false;
}

//<< UniversalLanguageSelector >>

if ($wmgUseExtensions['UniversalLanguageSelector']) {
  wfLoadExtension('UniversalLanguageSelector');
  $wgULSIMEEnabled = false;
  $wgULSLanguageDetection = false;
  $wgULSWebfontsEnabled = false;
}

//<< UploadsLink >>

if ($wmgUseExtensions['UploadsLink']) {
  wfLoadExtension('UploadsLink');
}

//<< WikiEditor >>

if ($wmgUseExtensions['WikiEditor']) {
  wfLoadExtension('WikiEditor');
  $wgWikiEditorRealtimePreview = true;
}

//<< Other extensions >>

wfLoadExtension('SecureLinkFixer');

//< Skins >

//<< MinervaNeue >>

if ($wmgUseSkins['MinervaNeue']) {
  wfLoadSkin('MinervaNeue');
  $wgMinervaAdvancedMainMenu['base'] = true;
  $wgMinervaAlwaysShowLanguageButton = false;
  $wgMinervaHistoryInPageActions['base'] = true;
  $wgMinervaOverflowInPageActions['base'] = true;
  $wgMinervaPersonalMenu['base'] = true;
  $wgMinervaShowCategories['base'] = true;
  $wgMinervaTalkAtTop['base'] = true;
}

//<< Timeless >>

if ($wmgUseSkins['Timeless']) {
  wfLoadSkin('Timeless');
}

//<< Vector >>

wfLoadSkin('Vector');
$wgVectorDefaultSidebarVisibleForAnonymousUser = true;
$wgVectorMaxWidthOptions = [
  'exclude' => [
    'mainpage' => true,
    // All namespaces
    'namespaces' => range(-1, 15)
  ],
  'include' => []
];
$wgVectorResponsive = true;
$wgVectorStickyHeader['logged_out'] = true;
$wgVectorStickyHeaderEdit = [
  'logged_in' => true,
  'logged_out' => true
];
