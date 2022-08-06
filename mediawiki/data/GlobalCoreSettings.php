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

//< General >

//<< Accounts >>
$wgInvalidUsernameCharacters='`~!@$%^&*()=+\\;:,.?';
$wgMaxNameChars=30;
$wgReservedUsernames=array_merge($wgReservedUsernames,
['Example',
'Flow talk page manager',
'MediaWiki message delivery',
'New user message',
'User',
'Username',
'편집 필터']);

//<< Blocking >>
$wgApplyIpBlocksToXff=true;
$wgAutoblockExpiry=60 * 60 * 24 * 365 * 10; //10 years
$wgBlockCIDRLimit=$wmgCIDRLimit;

//<< Copyright >>
$wgRightsIcon="{$wgScriptPath}/resources/assets/licenses/cc-by-sa.png";
$wgRightsText='Creative Commons Attribution-ShareAlike 4.0 International';
$wgRightsUrl='https://creativecommons.org/licenses/by-sa/4.0/';

//<< CSS and JavaScript >>
$wgAllowUserCss=true;
$wgAllowUserJs=true;

//<< Interwiki >>
$wgExternalInterwikiFragmentMode='html5';
$wgRedirectSources='/^https?:\\/\\//i';

//<< Namespaces >>
//Exclude File namespace
$wgNamespacesWithSubpages[NS_CATEGORY]=true;
$wgNamespacesWithSubpages[NS_MAIN]=true;

//<< Password policies >>
$wgPasswordPolicy['policies']=
['default' =>
  ['MaximalPasswordLength' =>
    ['forceChange' => true,
    'value' => 20],
  'MinimalPasswordLength' =>
    ['forceChange' => true,
    'value' => 6],
  'MinimumPasswordLengthToLogin' =>
    ['forceChange' => true,
    'value' => 1],
  'PasswordCannotBeSubstringInUsername' =>
    ['forceChange' => true,
    'value' => true],
  'PasswordCannotMatchDefaults' =>
    ['forceChange' => true,
    'value' => true],
  'PasswordNotInCommonList' =>
    ['forceChange' => true,
    'value' => true]
  ],
'moderator' =>
  ['MinimumPasswordLengthToLogin' => 6],
'admin' =>
  ['MinimalPasswordLength' => 8,
  'MinimumPasswordLengthToLogin' => 6],
'bureaucrat' =>
  ['MinimalPasswordLength' => 10,
  'MinimumPasswordLengthToLogin' => 6],
'steward' =>
  ['MinimalPasswordLength' => 12,
  'MinimumPasswordLengthToLogin' => 6]
];

//<< Preferences >>
$wgDefaultUserOptions=array_merge($wgDefaultUserOptions,
['hidecategorization' => 0,
'rememberpassword' => 1,
'usenewrc' => 0,
'watchcreations' => 0,
'watchdefault' => 0,
'watchlisthidecategorization' => 0,
'watchuploads' => 0]);
$wgHiddenPrefs=['gender', 'realname'];

//<< Rate limits >>
//Any attempt to create an account, whether succeed or not, is subject to this setting.
$wgAccountCreationThrottle=
[//Per minute
  ['count' => 1,
  'seconds' => 60],
//Per day
  ['count' => 5,
  'seconds' => 60 * 60 * 24]
];
$wgPasswordAttemptThrottle=
[//Per minute
  ['count' => 5,
  'seconds' => 60],
//Per day
  ['count' => 30,
  'seconds' => 60 * 60 * 24]
];
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
$wgLearnerEdits=15;
$wgLearnerMemberSince=7; //1 week
$wgRCShowWatchingUsers=true;
$wgRCWatchCategoryMembership=true;
//Disable hiding (active) page watchers to users without unwatchedpages permission
$wgUnwatchedPageSecret=-1;
$wgUnwatchedPageThreshold=0;
$wgWatchersMaxAge=60 * 60 * 24 * 7; //1 week

//<< Robot policies >>
$wgDefaultRobotPolicy='noindex,nofollow';
//All namespaces
$wgExemptFromUserRobotsControl=[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
$wgNoFollowDomainExceptions=[parse_url(str_replace('%wiki%.', '', $wmgDefaultBaseURL), PHP_URL_HOST)];

//<< User interface >>
$wgAmericanDates=true;
$wgDisableAnonTalk=true;
$wgEdititis=true;
$wgSpecialVersionShowHooks=true;

//<< Wikitext >>
$wgEnableScaryTranscluding=true;
$wgMaxTemplateDepth=10;
$wgNonincludableNamespaces=
[NS_CATEGORY_TALK,
NS_FILE_TALK,
NS_HELP_TALK,
NS_MEDIAWIKI_TALK,
NS_PROJECT_TALK,
NS_TALK,
NS_TEMPLATE_TALK,
NS_USER_TALK];
//Only allow HTTP and HTTPS protocols in links
$wgUrlProtocols=['//', 'http://', 'https://'];

//<< Others >>
$wgActiveUserDays=7; //1 week
$wgBreakFrames=true;
$wgCapitalLinks=false;
$wgExternalLinkTarget='_blank';
$wgFragmentMode=['html5'];
unset($wgFooterIcons['poweredby']);
$wgHideUserContribLimit=500;
$wgMaxSigChars=200;
$wgRangeContributionsCIDRLimit=$wmgCIDRLimit;
$wgUniversalEditButton=false;

//< Permissions >

//<< Adding and removing users from user groups >>
$wgAddGroups['bureaucrat']=['moderator', 'admin'];
$wgRemoveGroups['bureaucrat']=['moderator', 'admin'];

//<< Auto-promoting >>
$wgAutoConfirmAge=60 * 60 * 24 * $wgLearnerMemberSince;
$wgAutoConfirmCount=$wgLearnerEdits;

//<< Protection >>
$wgCascadingRestrictionLevels=
['editprotected-moderator',
'editprotected-admin',
'editprotected-bureaucrat',
'editprotected-steward'];
$wgRestrictionLevels=
['',
'editprotected-user',
'editprotected-autoconfirmed',
'editprotected-moderator',
'editprotected-admin',
'editprotected-bureaucrat',
'editprotected-steward'];
$wgRestrictionTypes=
['create',
'edit',
'move',
'upload',
'delete',
'protect'];
$wgSemiprotectedRestrictionLevels=
['editprotected-user',
'editprotected-autoconfirmed'];

//<< User group permissions >>
$wgAvailableRights=
['editprotected-user',
'editprotected-autoconfirmed',
'editprotected-moderator',
'editprotected-admin',
'editprotected-bureaucrat',
'editprotected-steward'];
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

//<< Others >>
$wgDeleteRevisionsLimit=250;

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
$wgUpdateCompatibleMetadata=true;
$wgUploadStashMaxAge=60 * 60; //1 hour
$wgUseCopyrightUpload=true;
$wgUseTinyRGBForJPGThumbnails=true;

//< System >

//<< API >>
$wgAPIRequestLog="{$wmgDataDirectory}/private/per-wiki/{$wmgWiki}/api.log";

//<< Authentication and sessions >>
$wgAllowSecuritySensitiveOperationIfCannotReauthenticate=
['default' => false,
'LinkAccounts' => true,
'UnlinkAccount' => true];
$wgAuthenticationTokenVersion='1';
$wgExtendedLoginCookieExpiration=60 * 60 * 24 * 90; //3 months
$wgPasswordResetRoutes['username']=false;
$wgReauthenticateTime=
['default' => 60 * 10, //10 minutes
'ChangeCredentials' => 60, //1 minute
'RemoveCredentials' => 60]; //1 minute

//<< Databases >>
//SQLite-only
$wgSQLiteDataDir="{$wmgDataDirectory}/private/databases";

if ($wmgGlobalAccountMode === 'shared-database')
  {$wgSharedDB="{$wmgCentralWiki}wiki";
  $wgSharedTables=['actor', 'user'];}

//<< Debugging >>
if ($wgCommandLineMode || $wmgDebugMode)
  {error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  $wgDebugDumpSql=true;
  $wgDevelopmentWarnings=true;
  $wgShowExceptionDetails=true;}

//<< Others >>
$wgAsyncHTTPTimeout=30;
$wgDeleteRevisionsBatchSize=500;
//Ignored on Windows
$wgDirectoryMode=0755;
$wgEnableDnsBlacklist=true;
$wgFeed=false;
$wgGitBin=false;
$wgHTTPTimeout=30;
$wgJpegTran=false;
$wgMemoryLimit='256M';
$wgReadOnlyFile="{$wmgDataDirectory}/readonly.txt";

switch ($wmgPlatform)
  {case 'Windows':
  $wgPhpCli='C:/plavormind/php/php.exe';
  break;}

//< Caching >

//<< Sidebar cache >>
$wgTranscludeCacheExpiry=$wmgCacheExpiry;

//<< Others >>
$wgAPICacheHelpTimeout=$wmgCacheExpiry;
$wgInterwikiExpiry=$wmgCacheExpiry;
$wgObjectCacheSessionExpiry=$wmgCacheExpiry;
$wgSearchSuggestCacheExpiry=$wmgCacheExpiry;
//This one should always use cache
$wgSessionCacheType=CACHE_ACCEL;

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
