<?php
//< General Settings >

$wgSitename = 'Nameless';

//< Global Objects >

if ($wmgGlobalAccountMode === 'centralauth') {
  $wgConf->settings = [
    'wgArticlePath' => [
      'default' => '/page/$1'
    ],
    'wgServer' => []
  ];
  $domain = str_replace('%wiki%', '$wiki', $wmgDefaultDomain);
  $wgConf->settings['wgServer']['default'] = str_replace('%domain%', $domain, $wmgBaseURL);

  foreach ($wmgCustomDomains as $wiki => $domain) {
    $wgConf->settings['wgServer'][$wiki] = str_replace('%domain%', $domain, $wmgBaseURL);
  }

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

  $wgConf->suffixes = [''];
  $wgConf->wikis = [];

  foreach ($wmgWikis as $wiki) {
    $wgConf->wikis[] = "{$wiki}wiki";
  }

  unset($domain, $wiki);
}

//< Server URLs and file paths >

$wgArticlePath = '/page/$1';
$wgFileCacheDirectory = "$wmgDataDirectory/private/per-wiki/$wmgWiki/caches";
$wgScriptPath = '/mediawiki';
$wgUploadDirectory = "$wmgDataDirectory/private/per-wiki/$wmgWiki/uploads";
$wgUploadPath = "$wgScriptPath/img_auth.php";
$wgUsePathInfo = true;

$actions = [
  'delete',
  'edit',
  'history',
  'info',
  'markpatrolled',
  'protect',
  'purge',
  'raw',
  'render',
  'revert',
  'rollback',
  'submit',
  'unprotect',
  'unwatch',
  'watch'
];

foreach ($actions as $action) {
  $wgActionPaths[$action] = "/$action/$1";
}

$domain = $wmgCustomDomains[$wmgWiki] ?? str_replace('%wiki%', $wmgWiki, $wmgDefaultDomain);
$wgServer = str_replace('%domain%', $domain, $wmgBaseURL);
unset($action, $actions, $domain);

//< Files and file uploads >

$wgAllowCopyUploads = true;
$wgCopyUploadsDomains = ['openclipart.org'];
$wgCopyUploadsFromSpecialUpload = true;
$wgDeletedDirectory = "$wmgDataDirectory/private/per-wiki/$wmgWiki/deleted-uploads";
$wgEnableUploads = true;
$wgFileExtensions = ['gif', 'jpg', 'png', 'webp'];
$wgImgAuthDetails = true;
$wgMaxUploadSize = [
  // 3 MiB
  '*' => 1024 * 1024 * 3,
  // 1 MiB
  'url' => 1024 * 1024 * 1
];
$wgMediaInTargetLanguage = true;
$wgNativeImageLazyLoading = true;
// 1 MiB
$wgUploadSizeWarning = 1024 * 1024 * 1;

//<< Shared uploads >>

$wgUseInstantCommons = true;

//<< MIME types >>

$wgVerifyMimeTypeIE = false;

//<< Images >>

//<<< Thumbnail settings >>>

$wgGenerateThumbnailOnParse = false;
$wgThumbnailScriptPath = "$wgScriptPath/thumb.php";

//< Email settings >

$wgEnableEmail = false;

//< Database settings >

$wgDBname = "{$wmgWiki}wiki";
$wgDBserver = '127.0.0.1';
$wgDBuser = 'root';

foreach ($wmgWikis as $wiki) {
  $wgLocalDatabases[] = "{$wiki}wiki";
}

unset($wiki);

//<< SQLite-specific >>

$wgSQLiteDataDir = "$wmgDataDirectory/private/dbs";

//<< Shared DB settings >>

if ($wmgGlobalAccountMode === 'shared-db') {
  $wgSharedDB = "pmw$wmgCentralWiki";
  $wgSharedTables = ['actor', 'user', 'user_autocreate_serial'];
}

//< Content handlers and storage >

$wgPageLanguageUseDB = true;
$wgRevisionCacheExpiry = $wmgCacheExpiry;

//< Cache >

$wgCacheDirectory = "$wmgDataDirectory/private/per-wiki/$wmgWiki/caches";
$wgFooterLinkCacheExpiry = $wmgCacheExpiry;
$wgLanguageConverterCacheType = CACHE_ACCEL;
$wgMainCacheType = CACHE_ACCEL;
$wgStatsCacheType = CACHE_ACCEL;
$wgUseFileCache = true;

//<< Message Cache >>

$wgMessageCacheType = CACHE_ACCEL;
$wgUseLocalMessageCache = true;

//<< Sidebar Cache >>

$wgEnableSidebarCache = true;
$wgSidebarCacheExpiry = $wmgCacheExpiry;

//<< Parser Cache >>

$wgOldRevisionParserCacheExpireTime = $wmgCacheExpiry;
$wgParserCacheExpireTime = $wmgCacheExpiry;
$wgParserCacheType = CACHE_ACCEL;
$wgUseContentMediaStyles = true;

//<< Memcached settings >>

$wgSessionCacheType = CACHE_ACCEL;

//< Language, regional and character encoding settings >

$wgAllUnicodeFixes = true;
// $wgRawHtmlMessages

//<< Language-specific >>

//<<< English >>>

$wgAmericanDates = true;

//< Output format and skin settings >

//<< Output >>

$wgEditSubmitButtonLabelPublish = true;
$wgExternalInterwikiFragmentMode = 'html5';
$wgFragmentMode = ['html5'];

//<< Skins >>

$wgDefaultSkin = 'vector-2022';
$wgSkinMetaTags = ['og:title'];

unset($wgFooterIcons['poweredby']);

//< Page titles and redirects >

$wgCapitalLinks = false;

//< Interwiki links and sites >

$baseURL = str_replace('%domain%', $wmgDefaultDomain, $wmgBaseURL);
$regex = str_replace('%wiki%', '([\w\-]+)', preg_quote($baseURL, '/'));
$wgRedirectSources = "/^{$regex}$/i";

//<< Interwiki cache >>

$wgInterwikiExpiry = $wmgCacheExpiry;

//< Parser >

$wgCleanSignatures = false;
$wgEnableScaryTranscluding = true;
$wgExternalLinkTarget = '_blank';
$wgMaxTemplateDepth = 5;
// Remove default value ('mediawiki.org')
$wgNoFollowDomainExceptions = [];
$wgParserEnableLegacyMediaDOM = false;
$wgTranscludeCacheExpiry = $wmgCacheExpiry;
// Only allow HTTP and HTTPS protocols in links
$wgUrlProtocols = ['http://', 'https://'];

if (strpos($wmgDefaultDomain, '%wiki%.') === 0) {
  $wgNoFollowDomainExceptions[] = preg_replace('/^%wiki%\\./', '', $wmgDefaultDomain);
}
elseif (!isset($wmgCustomDomains[$wmgWiki])) {
  $wgNoFollowDomainExceptions[] = str_replace('%wiki%', $wmgWiki, $wmgDefaultDomain);
}

if (isset($wmgCustomDomains[$wmgWiki])) {
  $wgNoFollowDomainExceptions[] = $wmgCustomDomains[$wmgWiki];
}

//< Statistics and content analysis >

// 1 week
$wgActiveUserDays = 7;
$wgLearnerEdits = 15;
// 1 week
$wgLearnerMemberSince = 7;

//< User accounts, authentication >

$wgHiddenPrefs = ['gender', 'realname'];
$wgInvalidUsernameCharacters = '`~!@$%^&*()=+\\;:,.?';
$wgMaxNameChars = 30;
$wgMaxSigChars = 200;
$wgPasswordPolicy['policies'] = [
  'default' => [
    'MaximalPasswordLength' => [
      'forceChange' => true,
      'value' => 20
    ],
    'MinimalPasswordLength' => [
      'forceChange' => true,
      'value' => 6
    ],
    'MinimumPasswordLengthToLogin' => [
      'forceChange' => true,
      'value' => 1
    ],
    'PasswordCannotBeSubstringInUsername' => [
      'forceChange' => true,
      'value' => true
    ],
    'PasswordCannotMatchDefaults' => [
      'forceChange' => true,
      'value' => true
    ],
    'PasswordNotInCommonList' => [
      'forceChange' => true,
      'value' => true
    ]
  ],
  'moderator' => [
    'MinimumPasswordLengthToLogin' => 6
  ],
  'staff' => [
    'MinimalPasswordLength' => 8,
    'MinimumPasswordLengthToLogin' => 6
  ],
  'admin' => [
    'MinimalPasswordLength' => 10,
    'MinimumPasswordLengthToLogin' => 6
  ],
  'steward' => [
    'MinimalPasswordLength' => 12,
    'MinimumPasswordLengthToLogin' => 6
  ]
];
// Remove default value ('obsolete-tag')
$wgSignatureAllowedLintErrors = [];
$wgSignatureValidation = 'disallow';

$wgDefaultUserOptions = array_merge($wgDefaultUserOptions, [
  // Recent Changes
  'hidecategorization' => 0,
  'usenewrc' => 0,

  // Watchlist
  'watchcreations' => 0,
  'watchdefault' => 0,
  'watchlisthidecategorization' => 0,
  'watchlistunwatchlinks' => 1,
  'watchuploads' => 0
]);

$wgReservedUsernames = array_merge($wgReservedUsernames, [
  'Example',
  'Flow talk page manager',
  'MediaWiki message delivery',
  'New user message',
  'User',
  'Username',
  '편집 필터'
]);

//<< Authentication >>

$wgAllowSecuritySensitiveOperationIfCannotReauthenticate = [
  'default' => false,
  'LinkAccounts' => true,
  'UnlinkAccount' => true
];
$wgReauthenticateTime = [
  // 10 minutes
  'default' => 60 * 10,
  // 1 minute
  'ChangeCredentials' => 60,
  // 1 minute
  'RemoveCredentials' => 60
];

//< User rights, access control and monitoring >

$wgAddGroups = [
  'staff' => ['moderator'],
  'admin' => ['moderator', 'staff']
];
// 10 years
$wgAutoblockExpiry = 60 * 60 * 24 * 365 * 10;
$wgDeleteRevisionsBatchSize = 500;
$wgGroupInheritsPermissions = [
  'moderator' => 'autoconfirmed',
  'staff' => 'moderator',
  'admin' => 'staff'
];
$wgGroupPermissions = [
  '*' => [
    'autocreateaccount' => true,
    'browsearchive' => true,
    'createaccount' => true,
    'deletedhistory' => true,
    'patrolmarks' => true,
    'read' => true,
    'unwatchedpages' => true,
    'writeapi' => true
  ],
  'user' => [
    'applychangetags' => true,
    'createpage' => true,
    'createtalk' => true,
    'edit' => true,
    'editmyoptions' => true,
    'editmyprivateinfo' => true,
    'editmyusercss' => true,
    'editmyuserjson' => true,
    'editmywatchlist' => true,
    'editprotected-user' => true,
    'minoredit' => true,
    'viewmyprivateinfo' => true,
    'viewmywatchlist' => true
  ],
  'autoconfirmed' => [
    'autoconfirmed' => true,
    'editmyuserjs' => true,
    'editmyuserjsredirect' => true,
    'editprotected-autoconfirmed' => true,
    'move' => true,
    'move-rootuserpages' => true,
    'movefile' => true,
    'purge' => true,
    'reupload' => true,
    'sendemail' => true,
    'upload' => true
  ],
  'moderator' => [
    'autopatrol' => true,
    'block' => true,
    'delete' => true,
    'deletedtext' => true,
    'deleterevision' => true,
    'editprotected-moderator' => true,
    'move-categorypages' => true,
    'move-subpages' => true,
    'patrol' => true,
    'reupload-shared' => true,
    'rollback' => true,
    'suppressredirect' => true,
    'undelete' => true
  ],
  'staff' => [
    'changetags' => true,
    'deletelogentry' => true,
    'editcontentmodel' => true,
    'editprotected-staff' => true,
    'ipblock-exempt' => true,
    'managechangetags' => true,
    'markbotedits' => true,
    'protect' => true
  ],
  'admin' => [
    'deletechangetags' => true,
    'editinterface' => true,
    'editprotected-admin' => true,
    'editsitecss' => true,
    'editsitejson' => true,
    'editusercss' => true,
    'edituserjson' => true,
    'mergehistory' => true
  ]
];
$wgGroupsRemoveFromSelf = [
  'moderator' => ['moderator'],
  'staff' => ['staff'],
  'admin' => ['admin']
];
$wgHideUserContribLimit = 500;
$wgPasswordAttemptThrottle = [
  [
    'allIPs' => 'Value of "allIPs" key can be anything but null.',
    'count' => 5,
    // 10 minutes
    'seconds' => 60 * 10
  ],
  [
    'allIPs' => 'See includes/auth/Throttler.php.',
    'count' => 30,
    // 1 day
    'seconds' => 60 * 60 * 24
  ]
];
// $wgRateLimits
$wgRemoveGroups = [
  'staff' => ['moderator'],
  'admin' => ['moderator', 'staff']
];

if ($wmgGlobalAccountMode !== 'centralauth') {
  $wgGroupInheritsPermissions['steward'] = 'admin';
  $wgGroupPermissions['steward'] = [
    'apihighlimits' => true,
    'bigdelete' => true,
    'blockemail' => true,
    'editprotected-steward' => true,
    'editsitejs' => true,
    'edituserjs' => true,
    'hideuser' => true,
    'import' => true,
    'importupload' => true,
    'nominornewtalk' => true,
    'noratelimit' => true,
    'override-export-depth' => true,
    'pagelang' => true,
    'siteadmin' => true,
    'suppressionlog' => true,
    'suppressrevision' => true,
    'unblockself' => true,
    'upload_by_url' => true
  ];
}

//<< Access >>

// This also counts failed attempts (e. g. CAPTCHA failure).
$wgAccountCreationThrottle = [
  [
    'count' => 3,
    // 1 day
    'seconds' => 60 * 60 * 24
  ]
];
$wgApplyIpBlocksToXff = true;
// 1 week
$wgAutoConfirmAge = 60 * 60 * 24 * 7;
$wgAutoConfirmCount = 15;
$wgAvailableRights = [
  'editprotected-user',
  'editprotected-autoconfirmed',
  'editprotected-moderator',
  'editprotected-staff',
  'editprotected-admin',
  'editprotected-steward'
];
$wgBlockCIDRLimit = $wmgCIDRLimit;
$wgCascadingRestrictionLevels = [
  'editprotected-staff',
  'editprotected-admin',
  'editprotected-steward'
];
$wgDeleteRevisionsLimit = 250;
$wgRestrictionLevels = [
  '',
  'editprotected-user',
  'editprotected-autoconfirmed',
  'editprotected-moderator',
  'editprotected-staff',
  'editprotected-admin',
  'editprotected-steward'
];
$wgRestrictionTypes[] = 'delete';
$wgSemiprotectedRestrictionLevels = [
  'editprotected-user',
  'editprotected-autoconfirmed'
];

if ($wmgGlobalAccountMode !== null) {
  $wgBotPasswordsDatabase = "{$wmgCentralWiki}wiki";
}

//< Security >

$wgAllowUserCssPrefs = false;
$wgAllowUserCss = true;
$wgAllowUserJs = true;
$wgBreakFrames = true;
// $wgCSPHeader
// $wgCSPReportOnlyHeader
$wgRestAllowCrossOriginCookieAuth = true;

//< Cookies >

$wgCookieSameSite = 'None';
// 2 months
$wgExtendedLoginCookieExpiration = 60 * 60 * 24 * 30 * 2;

if ($wmgGlobalAccountMode === 'shared-db' && strpos($wmgDefaultDomain, '%wiki%.') === 0 && !isset($wmgCustomDomains[$wmgWiki])) {
  $wgCookieDomain = preg_replace('/^%wiki%/', '', $wmgDefaultDomain);
}

//< Profiling, testing and debugging >

//<< Debug >>

$wgDebugDumpSql = true;
// $wgDebugLogGroups
// $wgSpecialVersionShowHooks

if (PHP_SAPI === 'cli' || $wmgDebugLevel >= 1) {
  $wgShowExceptionDetails = true;
}

if ($wmgDebugLevel >= 2) {
  $wgDebugComments = true;
  // $wgDebugLogFile
  $wgDevelopmentWarnings = true;
  $wgShowDebug = true;
  $wgShowHostnames = true;
}

//< Search >

$wgSearchSuggestCacheExpiry = $wmgCacheExpiry;

//< Edit user interface >

// $wgDiff3
// $wgPreviewOnOpenNamespaces

//< Maintenance Scripts setting >

$wgGitBin = false;
$wgGitRepositoryViewers['https:\/\/github\.com\/([\w-.]+\/[\w-.]+)\.git'] = 'https://github.com/$1/commit/%H';

if (PHP_SAPI !== 'cli') {
  $wgReadOnlyFile = "$wmgDataDirectory/read-only.txt";
}

//< Recent changes, new pages, watchlist and history >

$wgDisableAnonTalk = true;
$wgRCWatchCategoryMembership = true;
// $wgRecentChangesFlags
// $wgUnwatchedPageSecret
// $wgUnwatchedPageThreshold
// 1 week
$wgWatchersMaxAge = 60 * 60 * 24 * 7;
$wgWatchlistExpiry = true;
// $wgWatchlistPurgeRate

//<< Feed >>

$wgFeed = false;

//< Copyright >

$wgRightsIcon = "$wgScriptPath/resources/assets/licenses/cc-by-sa.png";
$wgRightsText = 'Creative Commons Attribution-ShareAlike 4.0 International';
$wgRightsUrl = 'https://creativecommons.org/licenses/by-sa/4.0/';

//< Import/Export >

$wgExportAllowListContributors = true;
$wgExportMaxHistory = 50;
$wgExportPagelistLimit = 20;
// $wgImportSources

//< Logging >

// $wgFilterLogTypes
// $wgLogHeaders
// $wgLogNames

//< Special pages >

$wgRangeContributionsCIDRLimit = $wmgCIDRLimit;

//< Robot policies >

$wgDefaultRobotPolicy = 'noindex, nofollow';
// All namespaces
$wgExemptFromUserRobotsControl = range(0, 15);

//< Ajax, Action API and REST API >

//<< API >>

$wgAPICacheHelpTimeout = $wmgCacheExpiry;

//< Shell and process control >

if (PHP_OS_FAMILY === 'Windows') {
  $wgPhpCli = 'C:/plavormind/php/php.exe';
}

//< HTTP client >

$wgAsyncHTTPTimeout = 40;
$wgHTTPMaxTimeout = 40;
$wgHTTPImportTimeout = 30;
$wgHTTPTimeout = 30;

//< Miscellaneous settings >

// $wgSkinsPreferred

//< Legacy settings >

//<< Rate limits >>

$wgRateLimits=
//"anon" aggregates all non-logged in users (not per-IP basis)
['edit' =>
  ['ip' =>
    [5, 60], //5/min
  'newbie' =>
    [5, 60], //5/min
  'user' =>
    [10, 60] //10/min
  ],
'move' =>
  ['ip' =>
    [2, 60], //2/min
  'newbie' =>
    [2, 60], //2/min
  'user' =>
    [5, 60] //5/min
  ],
'upload' =>
  ['ip' =>
    [1, 60], //1/min
  'newbie' =>
    [1, 60], //1/min
  'user' =>
    [3, 60] //3/min
  ],
'rollback' =>
  ['ip' =>
    [5, 60], //5/min
  'newbie' =>
    [5, 60], //5/min
  'user' =>
    [10, 60] //10/min
  ],
'mailpassword' =>
  ['ip' =>
    [5, 60 * 60 * 24] //5/day
  ],
'emailuser' =>
  ['&can-bypass' => false,
  'ip' =>
    [3, 60 * 60], //3/h
  'newbie' =>
    [3, 60 * 60], //3/h
  'user' =>
    [10, 60 * 60] //10/h
  ],
'changeemail' =>
  ['&can-bypass' => false,
  'ip' =>
    [3, 60 * 60 * 24], //3/day
  'newbie' =>
    [3, 60 * 60 * 24], //3/day
  'user' =>
    [6, 60 * 60 * 24] //6/day
  ],
'confirmemail' =>
  ['&can-bypass' => false,
  'ip' =>
    [3, 60 * 60 * 24], //3/day
  'newbie' =>
    [3, 60 * 60 * 24], //3/day
  'user' =>
    [6, 60 * 60 * 24] //6/day
  ],
'purge' =>
  ['&can-bypass' => false,
  'anon' =>
    [2, 1], //2/s
  'ip' =>
    [6, 60], //6/min
  'newbie' =>
    [3, 60], //3/min
  'user' =>
    [10, 60] //10/min
  ],
'linkpurge' =>
  ['&can-bypass' => false,
  'anon' =>
    [2, 1], //2/s
  'ip' =>
    [6, 60], //6/min
  'newbie' =>
    [3, 60], //3/min
  'user' =>
    [10, 60] //10/min
  ],
'renderfile' =>
  ['&can-bypass' => false,
  'anon' =>
    [30, 1], //30/s
  'ip' =>
    [60, 60], //60/min
  'newbie' =>
    [30, 60], //30/min
  'user' =>
    [60, 60] //60/min
  ],
'renderfile-nonstandard' =>
  ['&can-bypass' => false,
  'anon' =>
    [10, 1], //10/s
  'ip' =>
    [30, 60], //30/min
  'newbie' =>
    [15, 60], //15/min
  'user' =>
    [40, 60] //40/min
  ],
'stashedit' =>
  ['&can-bypass' => false,
  'ip' =>
    [15, 60], //15/min
  'newbie' =>
    [15, 60], //15/min
  'user' =>
    [30, 60] //30/min
  ],
'changetag' =>
  ['ip' =>
    [5, 60], //5/min
  'newbie' =>
    [5, 60], //5/min
  'user' =>
    [10, 60] //10/min
  ],
'editcontentmodel' =>
  ['ip' =>
    [1, 60], //1/min
  'newbie' =>
    [1, 60], //1/min
  'user' =>
    [3, 60] //3/min
  ]
];

//<< Recent changes and watchlist >>
//Disable hiding (active) page watchers to users without unwatchedpages permission
$wgUnwatchedPageSecret=-1;
$wgUnwatchedPageThreshold=0;

//<< User interface >>
$wgSpecialVersionShowHooks=true;

//< Images and uploads >

//<< ImageMagick >>
if ($wmgPlatform === "Windows")
  {$wgImageMagickConvertCommand='C:/Program Files/ImageMagick-7.0.9-Q16-HDRI/convert.exe';}

if (file_exists($wgImageMagickConvertCommand))
  {$wgUseImageMagick=true;}

//<< SVG >>
switch ($wmgPlatform)
  {case 'Windows':
  $wgSVGConverter='inkscape';
  $wgSVGConverters=
  //"!" should not be escaped on Windows
  //$path and $wgSVGConverterPath should not be used because double quotes automatically surrounds $path.
  ['ImageMagick' => '"' . $wgImageMagickConvertCommand . '" -background none -thumbnail $widthx$height! $input $output',
  'inkscape' => '"C:/Program Files/Inkscape/bin/inkscape.com" $input --batch-process --export-filename=$output --export-height=$height --export-width=$width'];
  break;
  default:
  $wgSVGConverter=false;}

if ($wgSVGConverter)
  {$wgFileExtensions[]='svg';}

$wgHashedUploadDirectory=false;

//< Extensions >

//<< Extension usage >>
$wmgExtensions=
['Babel' => true,
'Cite' => false,
'CodeEditor' => false,
'CodeMirror' => false,
'CommonsMetadata' => false,
'GlobalCssJs' => true,
'GlobalUserPage' => true,
'Highlightjs_Integration' => false,
'InputBox' => false,
'Josa' => false,
'MassEditRegex' => false,
'Math' => false,
'MultimediaViewer' => false,
'Nuke' => false,
'PageImages' => false,
'ParserFunctions' => false,
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
'TwoColConflict' => false,
'UniversalLanguageSelector' => false,
'UploadsLink' => false,
'WikiEditor' => false];

//< Skins >

//<< Skin usage >>
$wmgSkins=
['Citizen' => false,
'Medik' => false,
'Metrolook' => false,
'MinervaNeue' => false,
'Timeless' => false];
