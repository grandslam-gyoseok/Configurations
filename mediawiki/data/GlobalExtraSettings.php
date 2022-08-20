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
$wgEchoPollForUpdates = 20;
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

//<< GlobalPreferences >>

if ($wmgGlobalAccountMode === 'centralauth') {
  $wgGlobalPreferencesDB = $wmgCentralDB;
}

if ($wmgGlobalAccountMode !== null) {
  // This extension requires running update.php.
  wfLoadExtension('GlobalPreferences');
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

//<< Poem >>

if ($wmgUseExtensions['Poem']) {
  wfLoadExtension('Poem');
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

//<< TemplateData >>

if ($wmgUseExtensions['TemplateData']) {
  wfLoadExtension('TemplateData');
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

//<< WikiEditor >>

if ($wmgUseExtensions['WikiEditor']) {
  wfLoadExtension('WikiEditor');
  $wgWikiEditorRealtimePreview = true;
}

//<< Other extensions >>

wfLoadExtension('SecureLinkFixer');

//< Skins >

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

//< Extensions >

//<< CodeMirror >>
if ($wmgExtensions['CodeMirror'] && $wmgExtensions['WikiEditor'])
  {wfLoadExtension('CodeMirror');}

//<< CommonsMetadata >>
if ($wmgExtensions['CommonsMetadata'])
  {wfLoadExtension('CommonsMetadata');}

//<< GlobalCssJs >>
if ($wmgGlobalAccountMode !== false && ($wmgWiki === $wmgCentralWiki || $wmgExtensions['GlobalCssJs']))
  {wfLoadExtension('GlobalCssJs');
  $wgGlobalCssJsConfig=
  ['source' => 'central',
  'wiki' => "{$wmgCentralWiki}wiki"];
  $wgResourceLoaderSources['central']=
  ['apiScript' => "{$wmgCentralBaseURL}{$wgScriptPath}/api.php",
  'loadScript' => "{$wmgCentralBaseURL}{$wgScriptPath}/load.php"];}

//<< GlobalUserPage >>
if ($wmgGlobalAccountMode !== false && ($wmgWiki === $wmgCentralWiki || $wmgExtensions['GlobalUserPage']))
  {wfLoadExtension('GlobalUserPage');
  $wgGlobalUserPageAPIUrl="{$wmgCentralBaseURL}{$wgScriptPath}/api.php";
  $wgGlobalUserPageCacheExpiry=$wmgCacheExpiry;
  $wgGlobalUserPageDBname="{$wmgCentralWiki}wiki";
  $wgGlobalUserPageTimeout='default';}

//<< Highlightjs_Integration >>
if ($wmgExtensions['Highlightjs_Integration'] && $wmgPlatform === 'Windows')
  {wfLoadExtension('Highlightjs_Integration');}

//<< Josa >>
if ($wmgExtensions['Josa'])
  {wfLoadExtension('Josa');}

//<< MassEditRegex >>
if ($wmgExtensions['MassEditRegex'])
  {wfLoadExtension('MassEditRegex');
  //Permissions
  $wmgGroupPermissions['bureaucrat']['masseditregex']=true;}

//<< PlavorMindTools >>
wfLoadExtension('PlavorMindTools');
$wgPMTFeatureConfig['NoActionsOnNonEditable']=
['enable' => true,
'HideMoveTab' => true];
$wgPMTFeatureConfig['ReplaceInterfaceMessages']=
['enable' => true,
'EnglishSystemUsers' => true];
//Permissions
$wmgGroupPermissions['user']['deleteownuserpages']=true;
$wmgGroupPermissions['user']['moveownuserpages']=true;
$wmgGroupPermissions['moderator']['editotheruserpages']=true;

//<< Popups >>
if ($wmgExtensions['Popups'] && $wmgExtensions['PageImages'] && $wmgExtensions['TextExtracts'])
  {wfLoadExtension('Popups');
  $wgPopupsHideOptInOnPreferencesPage=true;
  $wgPopupsReferencePreviewsBetaFeature=false;}

//<< RevisionSlider >>
if ($wmgExtensions['RevisionSlider'])
  {wfLoadExtension('RevisionSlider');}

//<< SyntaxHighlight_GeSHi >>
if ($wmgExtensions['SyntaxHighlight_GeSHi'] && $wmgPlatform === 'Linux')
  {wfLoadExtension('SyntaxHighlight_GeSHi');}

//<< TemplateSandbox >>
if ($wmgExtensions['TemplateSandbox'])
  {wfLoadExtension('TemplateSandbox');}

//<< TemplateStyles >>
if ($wmgExtensions['TemplateStyles'])
  {wfLoadExtension('TemplateStyles');
  //Remove default value
  $wgTemplateStylesAllowedUrls=[];}

//<< TemplateWizard >>
if ($wmgExtensions['TemplateWizard'] && $wmgExtensions['TemplateData'] && $wmgExtensions['WikiEditor'])
  {wfLoadExtension('TemplateWizard');}

//<< TwoColConflict >>
if ($wmgExtensions['TwoColConflict'])
  {wfLoadExtension('TwoColConflict');
  $wgTwoColConflictBetaFeature=false;}

//<< UniversalLanguageSelector >>
if ($wmgExtensions['UniversalLanguageSelector'])
  {wfLoadExtension('UniversalLanguageSelector');
  $wgULSCompactLanguageLinksBetaFeature=false;
  $wgULSIMEEnabled=false;
  $wgULSLanguageDetection=false;
  $wgULSWebfontsEnabled=false;}

//<< UploadsLink >>
if ($wmgExtensions['UploadsLink'])
  {wfLoadExtension('UploadsLink');}

//< Skins >

//<< Citizen >>
if ($wmgSkins['Citizen'])
  {wfLoadSkin('Citizen');
  $wgCitizenEnableManifest=false;
  $wgCitizenManifestThemeColor='#9933ff';
  $wgCitizenThemeColor='#9933ff';}

//<< Medik >>
if ($wmgSkins['Medik'])
  {wfLoadSkin('Medik');
  $wgMedikColor='#9933ff';}

//<< MinervaNeue >>
if ($wmgSkins['MinervaNeue'])
  {wfLoadSkin('MinervaNeue');
  $wgMinervaAdvancedMainMenu['base']=true;
  $wgMinervaAdvancedMainMenu['beta']=true;
  $wgMinervaAlwaysShowLanguageButton=false;
  $wgMinervaApplyKnownTemplateHacks=true;
  $wgMinervaHistoryInPageActions['base']=true;
  $wgMinervaHistoryInPageActions['beta']=true;
  $wgMinervaPageIssuesNewTreatment['beta']=false;
  $wgMinervaPersonalMenu['base']=true;
  $wgMinervaPersonalMenu['beta']=true;
  $wgMinervaShowCategoriesButton['base']=true;
  $wgMinervaTalkAtTop['base']=true;
  $wgMinervaTalkAtTop['beta']=true;}

//<< Timeless >>
if ($wmgSkins['Timeless'])
  {wfLoadSkin('Timeless');}
