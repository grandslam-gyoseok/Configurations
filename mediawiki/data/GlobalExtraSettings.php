<?php
//< Extensions >

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

//<< CentralAuth >>

if ($wmgGlobalAccountMode === 'centralauth') {
  // This extension requires running update.php.
  wfLoadExtension('CentralAuth');
  $wgCentralAuthAutoMigrate = true;
  $wgCentralAuthAutoMigrateNonGlobalAccounts = true;
  $wgCentralAuthCookies = true;
  $wgCentralAuthCreateOnView = true;
  $wgCentralAuthDatabase = 'wiki_centralauth';
  // $wgCentralAuthGlobalPasswordPolicies
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
// $wgCUDMaxAge

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

//<< ConfirmEdit >>

wfLoadExtensions(['ConfirmEdit', 'ConfirmEdit/hCaptcha']);
// $wgCaptchaBadLoginAttempts
// This completely blocks API login until expiration.
// $wgCaptchaBadLoginExpiration
// $wgCaptchaBadLoginPerUserAttempts
// This completely blocks API login until expiration.
// $wgCaptchaBadLoginPerUserExpiration
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
// $wgAllowArticleReminderNotification
$wgDefaultNotifyTypeAvailability = [
  'email' => false,
  'web' => true
];
$wgEchoMaxMentionsCount = 10;
$wgEchoMaxMentionsInEditSummary = 10;
// This is also the number of maximum notifications for single user to have.
$wgEchoMaxUpdateCount = 100;
$wgEchoMentionStatusNotifications = true;
// $wgEchoNotificationCategories
// $wgEchoNotificationIcons
$wgEchoOnWikiBlacklist = null;
$wgEchoPerUserWhitelistFormat = null;
// $wgEchoPollForUpdates
// $wgEchoSecondaryIcons
// $wgEchoWatchlistNotifications
// Remove default values
$wgNotifyTypeAvailabilityByCategory = [];

$wgGroupPermissions['push-subscription-manager']['manage-all-push-subscriptions'] = false;

if ($wmgGlobalAccountMode !== null) {
  $wgEchoCrossWikiNotifications = true;
  $wgEchoSharedTrackingDB = $wmgCentralDB;
}

if ($wmgGlobalAccountMode !== 'centralauth') {
  $wgGroupPermissions['steward']['manage-all-push-subscriptions'] = true;
}

//<< Renameuser >>

wfLoadExtension('Renameuser');

$wgGroupPermissions['bureaucrat']['renameuser'] = false;

if ($wmgGlobalAccountMode === null) {
  $wgGroupPermissions['steward']['renameuser'] = true;
}

//<< StaffPowers >>

wfLoadExtension('StaffPowers');
$wgStaffPowersShoutWikiMessages = false;
$wgStaffPowersStewardGroupName = 'admin';

$wgGroupPermissions['staff']['unblockable'] = false;

if ($wmgGlobalAccountMode !== 'centralauth') {
  $wgGroupPermissions['steward']['unblockable'] = true;
}

//<< TitleBlacklist >>

wfLoadExtension('TitleBlacklist');
// $wgTitleBlacklistSources
// $wgTitleBlacklistUsernameSources

$wgGroupPermissions['sysop']['tboverride'] = false;
$wgGroupPermissions['sysop']['titleblacklistlog'] = false;

if ($wmgGlobalAccountMode !== 'centralauth') {
  $wgGroupPermissions['steward']['tboverride'] = true;
  $wgGroupPermissions['steward']['titleblacklistlog'] = true;
}

//< Extensions >

//<< AbuseFilter >>
//This extension requires running update.php.
wfLoadExtension('AbuseFilter');
$wgAbuseFilterActionRestrictions=
['block' => false,
'blockautopromote' => false,
'degroup' => false,
'disallow' => false,
'rangeblock' => false,
'tag' => false,
'throttle' => false,
'warn' => false];
//"disallow" and "warn" should always be enabled to make AbuseFilter work properly.
$wgAbuseFilterActions=
['block' => false,
'blockautopromote' => false,
'degroup' => false,
'disallow' => true,
'rangeblock' => false,
'tag' => false,
'throttle' => false,
'warn' => true];

if ($wmgGlobalAccountMode !== false)
  {$wgAbuseFilterCentralDB="{$wmgCentralWiki}wiki";}

$wgAbuseFilterConditionLimit=100;
$wgAbuseFilterEmergencyDisableCount=
['default' => 5];

if ($wmgGlobalAccountMode !== false && $wmgWiki === $wmgCentralWiki)
  {$wgAbuseFilterIsCentral=true;}

$wgAbuseFilterLogPrivateDetailsAccess=true;
$wgAbuseFilterNotifications='rcandudp';
$wgAbuseFilterPrivateDetailsForceReason=true;
//Permissions
$wmgGroupPermissions['*']['abusefilter-log']=true;
$wmgGroupPermissions['*']['abusefilter-log-detail']=true;
$wmgGroupPermissions['*']['abusefilter-view']=true;
$wmgGroupPermissions['bureaucrat']['abusefilter-log-private']=true;
$wmgGroupPermissions['bureaucrat']['abusefilter-modify']=true;
$wmgGroupPermissions['bureaucrat']['abusefilter-revert']=true;

if ($wmgWiki === $wmgCentralWiki)
  {$wmgGroupPermissions['steward']['abusefilter-modify-global']=true;}

if ($wmgGrantStewardsGlobalPermissions)
  {$wmgGroupPermissions['steward']=array_merge($wmgGroupPermissions['steward'],
  ['abusefilter-hidden-log' => true,
  'abusefilter-hide-log' => true,
  'abusefilter-modify-restricted' => true,
  'abusefilter-privatedetails' => true,
  'abusefilter-privatedetails-log' => true]);}

//<< Babel >>
//This extension requires running update.php.
if ($wmgExtensions['Babel'])
  {wfLoadExtension('Babel');
  $wgBabelCategoryNames=
  ['0' => false,
  '1' => false,
  '2' => false,
  '3' => false,
  '4' => false,
  '5' => false,
  'N' => false];
  $wgBabelMainCategory=false;
  $wgBabelUseUserLanguage=true;}

//<< Cite >>
if ($wmgExtensions['Cite'])
  {wfLoadExtension('Cite');
  $wgCiteBookReferencing=true;}

//<< CodeEditor >>
if ($wmgExtensions['CodeEditor'] && $wmgExtensions['WikiEditor'])
  {wfLoadExtension('CodeEditor');}

//<< CodeMirror >>
if ($wmgExtensions['CodeMirror'] && $wmgExtensions['WikiEditor'])
  {wfLoadExtension('CodeMirror');}

//<< CommonsMetadata >>
if ($wmgExtensions['CommonsMetadata'])
  {wfLoadExtension('CommonsMetadata');}

//<< ConfirmEdit >>

$wgCaptchaBadLoginExpiration=60 * 60; //1 hour

//<< Echo >>

$wgAllowArticleReminderNotification=true;
$wgDefaultUserOptions=array_merge($wgDefaultUserOptions,
['echo-email-frequency' => -1,
'echo-subscriptions-email-user-rights' => false,
'echo-subscriptions-web-thank-you-edit' => false]);

//<< GlobalBlocking >>
//This extension requires running update.php.
if ($wmgGlobalAccountMode !== false)
  {wfLoadExtension('GlobalBlocking');
  $wgGlobalBlockingDatabase='wiki_globalblocking';
  //Permissions
  if ($wmgWiki === $wmgCentralWiki)
    {$wmgGroupPermissions['steward']['globalblock']=true;}
  if ($wmgGrantStewardsGlobalPermissions)
    {$wmgGroupPermissions['steward']['globalblock-exempt']=true;
    $wmgGroupPermissions['steward']['globalblock-whitelist']=true;}
  }

//<< GlobalCssJs >>
if ($wmgGlobalAccountMode !== false && ($wmgWiki === $wmgCentralWiki || $wmgExtensions['GlobalCssJs']))
  {wfLoadExtension('GlobalCssJs');
  $wgGlobalCssJsConfig=
  ['source' => 'central',
  'wiki' => "{$wmgCentralWiki}wiki"];
  $wgResourceLoaderSources['central']=
  ['apiScript' => "{$wmgCentralBaseURL}{$wgScriptPath}/api.php",
  'loadScript' => "{$wmgCentralBaseURL}{$wgScriptPath}/load.php"];}

//<< GlobalPreferences >>
//This extension requires running update.php.
if ($wmgGlobalAccountMode !== false)
  {wfLoadExtension('GlobalPreferences');

  if ($wmgGlobalAccountMode === 'centralauth')
    {$wgGlobalPreferencesDB='wiki_globalpreferences';}
  }

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

//<< InputBox >>
if ($wmgExtensions['InputBox'])
  {wfLoadExtension('InputBox');}

//<< Interwiki >>
wfLoadExtension('Interwiki');
if ($wmgGlobalAccountMode !== false)
  {$wgInterwikiCentralDB="{$wmgCentralWiki}wiki";}
//Permissions
if ($wmgGlobalAccountMode === false || $wmgWiki !== $wmgCentralWiki)
  {$wmgGroupPermissions['bureaucrat']['interwiki']=true;}

if ($wmgGrantStewardsGlobalPermissions)
  {$wmgGroupPermissions['steward']['interwiki']=true;}

//<< Josa >>
if ($wmgExtensions['Josa'])
  {wfLoadExtension('Josa');}

//<< MassEditRegex >>
if ($wmgExtensions['MassEditRegex'])
  {wfLoadExtension('MassEditRegex');
  //Permissions
  $wmgGroupPermissions['bureaucrat']['masseditregex']=true;}

//<< Math >>
//This extension requires running update.php.
if ($wmgExtensions['Math'])
  {wfLoadExtension('Math');
  $wgMathEnableExperimentalInputFormats=true;}

//<< MultimediaViewer >>
if ($wmgExtensions['MultimediaViewer'])
  {wfLoadExtension('MultimediaViewer');
  if ($wgThumbnailScriptPath)
    {$wgMediaViewerUseThumbnailGuessing=true;}
  }

//<< Nuke >>
if ($wmgExtensions['Nuke'])
  {wfLoadExtension('Nuke');
  //Permissions
  $wmgGroupPermissions['bureaucrat']['nuke']=true;}

//<< OATHAuth >>
if ($wmgGlobalAccountMode !== 'shared-database')
  {wfLoadExtension('OATHAuth');
  $wgOATHAuthAccountPrefix='PlavorMind wikis';

  if ($wmgGlobalAccountMode === 'centralauth')
    {$wgOATHAuthDatabase='wiki_centralauth';}
  //Permissions
  $wmgGroupPermissions['user']['oathauth-enable']=true;

  if ($wmgWiki === $wmgCentralWiki)
    {$wmgGroupPermissions['steward']['oathauth-verify-user']=true;}

  if ($wmgGrantStewardsGlobalPermissions)
    {$wmgGroupPermissions['steward']['oathauth-api-all']=true;
    $wmgGroupPermissions['steward']['oathauth-disable-for-user']=true;
    $wmgGroupPermissions['steward']['oathauth-view-log']=true;}
  }

//<< PageImages >>
if ($wmgExtensions['PageImages'])
  {wfLoadExtension('PageImages');
  $wgPageImagesBlacklistExpiry=$wmgCacheExpiry;
  $wgPageImagesExpandOpenSearchXml=true;
  $wgPageImagesNamespaces=[NS_HELP, NS_MAIN, NS_PROJECT, NS_USER];}

//<< ParserFunctions >>
if ($wmgExtensions['ParserFunctions'])
  {wfLoadExtension('ParserFunctions');
  $wgPFEnableStringFunctions=true;}

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

//<< Poem >>
if ($wmgExtensions['Poem'])
  {wfLoadExtension('Poem');}

//<< Popups >>
if ($wmgExtensions['Popups'] && $wmgExtensions['PageImages'] && $wmgExtensions['TextExtracts'])
  {wfLoadExtension('Popups');
  $wgPopupsHideOptInOnPreferencesPage=true;
  $wgPopupsReferencePreviewsBetaFeature=false;}

//<< ReplaceText >>
if ($wmgExtensions['ReplaceText'])
  {wfLoadExtension('ReplaceText');
  //Permissions
  if ($wmgGrantStewardsGlobalPermissions)
    {$wmgGroupPermissions['steward']['replacetext']=true;}
  }

//<< RevisionSlider >>
if ($wmgExtensions['RevisionSlider'])
  {wfLoadExtension('RevisionSlider');}

//<< Scribunto >>
if ($wmgExtensions['Scribunto'])
  {wfLoadExtension('Scribunto');}

//<< SyntaxHighlight_GeSHi >>
if ($wmgExtensions['SyntaxHighlight_GeSHi'] && $wmgPlatform === 'Linux')
  {wfLoadExtension('SyntaxHighlight_GeSHi');}

//<< TemplateData >>
if ($wmgExtensions['TemplateData'])
  {wfLoadExtension('TemplateData');}

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

//<< TextExtracts >>
if ($wmgExtensions['TextExtracts'])
  {wfLoadExtension('TextExtracts');
  $wgExtractsExtendOpenSearchXml=true;}

//<< TitleBlacklist >>
$wgTitleBlacklistSources=
['global' =>
  ['src' => "{$wmgDataDirectory}/private/titleblacklist.txt",
  'type' => 'file']
];

if ($wmgGlobalAccountMode !== false)
  {$wgTitleBlacklistUsernameSources=['global'];}

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

//<< WikiEditor >>
if ($wmgExtensions['WikiEditor'])
  {wfLoadExtension('WikiEditor');
  $wgWikiEditorRealtimePreview=true;}

//<< Other extensions >>
wfLoadExtension('SecureLinkFixer');

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

//<< Metrolook >>
if ($wmgSkins['Metrolook'])
  {wfLoadSkin('Metrolook');
  $wgMetrolookDownArrow=false;
  $wgMetrolookFeatures['collapsiblenav']=
  ['global' => true,
  'user' => false];
  $wgMetrolookSearchBar=false;
  $wgMetrolookUploadButton=false;}

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

//<< Vector >>
wfLoadSkin('Vector');
$wgVectorDefaultSidebarVisibleForAnonymousUser=true;
$wgVectorDefaultSkinVersion='2';
$wgVectorDefaultSkinVersionForExistingAccounts='2';
$wgVectorDefaultSkinVersionForNewAccounts='2';
$wgVectorGrid=true;
$wgVectorLanguageAlertInSidebar=
['logged_in' => true,
'logged_out' => true];
$wgVectorMaxWidthOptions=
['exclude' =>
  ['mainpage' => true,
  'namespaces' =>
    //All namespaces
    [-1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
  ],
'include' =>
  []
];
$wgVectorResponsive=true;
$wgVectorStickyHeader['logged_out']=true;
$wgVectorStickyHeaderEdit=
['logged_in' => true,
'logged_out' => true];
$wgVectorTableOfContents['default']=true;
