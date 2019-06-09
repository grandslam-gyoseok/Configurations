<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##Prepending settings

$wgScriptPath="/mediawiki";

##General

/*Account*/
$wgInvalidUsernameCharacters="`~!@$%^&*()=+\\;:,.?";
$wgMaxNameChars=20;
$wgReservedUsernames=array_merge($wgReservedUsernames,
["Account",
"Anon",
"Anonymous",
"Default",
"Error",
"Example",
"ID",
"Not logged in",
"Null",
"Undefined",
"Unknown",
"User",
"Username"]);

/*Basic information*/
$wgSitename="Nameless";

/*Blocking*/
$wgApplyIpBlocksToXff=true;
$wgAutoblockExpiry=60*60*24*365; //1 year
$wgBlockCIDRLimit=
["IPv4"=>8, //###.0.0.0/8
"IPv6"=>16]; //####::/16
$wgCookieSetOnAutoblock=true;
$wgCookieSetOnIpBlock=true;
$wgEnablePartialBlocks=true;

/*Copyright*/
$wgMaxCredits=10;
$wgRightsIcon="{$wgScriptPath}/resources/assets/licenses/cc-by-sa.png";
$wgRightsText="Creative Commons Attribution-ShareAlike 4.0 International";
$wgRightsUrl="https://creativecommons.org/licenses/by-sa/4.0/";

/*CSS and JavaScript*/
$wgAllowUserCss=true;
$wgAllowUserJs=true;

/*Interface*/
$wgAdvancedSearchHighlighting=true;
$wgAmericanDates=true;
$wgDisableAnonTalk=true;
$wgEdititis=true;
$wgMaxTocLevel=5;
$wgShowRollbackEditCount=30;
$wgSpecialVersionShowHooks=true;

/*Interwiki*/
$wgEnableScaryTranscluding=true;
$wgExternalInterwikiFragmentMode="html5"; //Added for test
$wgLocalInterwikis=[$wiki_id]; //Added for test
$wgRedirectSources="https?:\\/\\/.+"; //Set for test

/*Namespaces*/
//Exclude File namespace
$wgNamespacesWithSubpages[NS_CATEGORY]=true;
$wgNamespacesWithSubpages[NS_MAIN]=true;

/*Password policies*/
$wgPasswordPolicy["policies"]=
["default"=>
  ["MaximalPasswordLength"=>
    ["forceChange"=>true,
    "value"=>20],
  "MinimalPasswordLength"=>
    ["forceChange"=>true,
    "value"=>6],
  "MinimumPasswordLengthToLogin"=>
    ["forceChange"=>true,
    "value"=>1],
  "PasswordCannotBePopular"=>
    ["forceChange"=>true,
    "value"=>50],
  "PasswordCannotMatchBlacklist"=>
    ["forceChange"=>true,
    "value"=>true],
  "PasswordCannotMatchUsername"=>
    ["forceChange"=>true,
    "value"=>true],
  "PasswordNotInLargeBlacklist"=>
    ["forceChange"=>true,
    "value"=>true]
  ],
"staff"=>
  ["MinimumPasswordLengthToLogin"=>6,
  "PasswordCannotBePopular"=>100],
"admin"=>
  ["MinimalPasswordLength"=>8,
  "MinimumPasswordLengthToLogin"=>6,
  "PasswordCannotBePopular"=>200],
"bureaucrat"=>
  ["MinimalPasswordLength"=>10,
  "MinimumPasswordLengthToLogin"=>8,
  "PasswordCannotBePopular"=>400],
"steward"=>
  ["MinimalPasswordLength"=>12,
  "MinimumPasswordLengthToLogin"=>10,
  "PasswordCannotBePopular"=>1000]
];

/*Preferences*/
$wgDefaultUserOptions=array_merge($wgDefaultUserOptions,
["editfont"=>"sans-serif",
"hidecategorization"=>0,
"rememberpassword"=>1,
"usenewrc"=>0,
"watchcreations"=>0,
"watchdefault"=>0,
"watchlisthidecategorization"=>0,
"watchuploads"=>0]);
$wgHiddenPrefs=["gender","realname"];

/*Rate limits*/
$wgAccountCreationThrottle=
[//Per minute
  ["count"=>1,
  "seconds"=>60],
//Per day
  ["count"=>5,
  "seconds"=>60*60*24]
];
$wgPasswordAttemptThrottle=
[//Per minute
  ["count"=>3,
  "seconds"=>60],
//Per day
  ["count"=>50,
  "seconds"=>60*60*24]
];
$wgRateLimits=array_merge($wgRateLimits,
["edit"=>
  ["ip"=>
    [5,60],
  "newbie"=>
    [5,60],
  "user"=>
    [10,60]
  ],
"move"=>
  ["ip"=>
    [2,60],
  "newbie"=>
    [2,60],
  "user"=>
    [5,60]
  ],
"upload"=>
  ["ip"=>
    [1,60],
  "newbie"=>
    [1,60],
  "user"=>
    [3,60]
  ]
]);

/*Recent changes and watchlist*/
$wgLearnerEdits=15; //Added for test
$wgLearnerMemberSince=7; //1 week //Added for test
$wgRCFilterByAge=true; //Added for test
$wgRCShowWatchingUsers=true;
$wgRCWatchCategoryMembership=true;
//Disable hiding (active) page watchers to users without "unwatchedpages" permission
$wgUnwatchedPageSecret=-1;
$wgUnwatchedPageThreshold=0;
$wgWatchersMaxAge=60*60*24*7; //1 week //Added for test

/*Robot policies*/
$wgDefaultRobotPolicy="noindex,nofollow";
//All namespaces
$wgExemptFromUserRobotsControl=[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]; //Set for test
$wgNoFollowDomainExceptions=["plavormind.tk"];

/*Others*/
$wgActiveUserDays=7; //1 week
$wgAllowSlowParserFunctions=true; //Added for test
$wgBreakFrames=true;
$wgCapitalLinks=false;
$wgCleanSignatures=false;
$wgEditPageFrameOptions="SAMEORIGIN";
$wgEnableMagicLinks= //Added for test
["ISBN"=>true,
"PMID"=>true,
"RFC"=>true];
$wgExternalLinkTarget="_blank";
$wgFragmentMode=["html5"]; //Added for test
unset($wgFooterIcons["poweredby"]);
$wgHideUserContribLimit=500; //Added for test
$wgMaxSigChars=200;
$wgMaxTemplateDepth=10;
$wgRangeContributionsCIDRLimit=$wgBlockCIDRLimit;
//Remove default value
$wgRawHtmlMessages=[];
$wgUniversalEditButton=false;
//Only allow HTTP and HTTPS protocol in links
$wgUrlProtocols=["//","http://","https://"];

##Permissions

/*Autoconfirm*/
$wgAutoConfirmAge=60*60*24*$wgLearnerMemberSince;
$wgAutoConfirmCount=$wgLearnerEdits;

/*Group permissions*/
$wgAddGroups["bureaucrat"]=["staff","admin"];
$wgGroupPermissions=
["*"=>
  ["autocreateaccount"=>true,
  "browsearchive"=>true,
  "createaccount"=>true,
  "deletedhistory"=>true,
  "patrolmarks"=>true,
  "read"=>true,
  "unwatchedpages"=>true],
"user"=>
  ["user-access"=>true,

  "applychangetags"=>true,
  "createpage"=>true,
  "createtalk"=>true,
  "edit"=>true,
  "editmyoptions"=>true,
  "editmyprivateinfo"=>true,
  "editmyusercss"=>true,
  "editmyuserjs"=>true,
  "editmyuserjson"=>true,
  "editmywatchlist"=>true,
  "minoredit"=>true,
  "sendemail"=>true,
  "viewmyprivateinfo"=>true,
  "viewmywatchlist"=>true],
"autoconfirmed"=>
  ["autoconfirmed-access"=>true,

  "autoconfirmed"=>true,
  "move"=>true,
  "move-categorypages"=>true,
  "move-rootuserpages"=>true,
  "movefile"=>true,
  "purge"=>true,
  "reupload"=>true,
  "upload"=>true,
  "user-access"=>true], //Patch for protection
"staff"=>
  ["staff-access"=>true,

  "autopatrol"=>true,
  "block"=>true,
  "blockemail"=>true,
  "delete"=>true,
  "deletedtext"=>true,
  "deleterevision"=>true,
  "protect"=>true,
  "reupload-shared"=>true,
  "rollback"=>true,
  "suppressredirect"=>true,
  "undelete"=>true,
  "upload_by_url"=>true],
"admin"=>
  ["admin-access"=>true,

  "changetags"=>true,
  "deletelogentry"=>true,
  "editcontentmodel"=>true,
  "ipblock-exempt"=>true,
  "move-subpages"=>true,
  "pagelang"=>true,
  "patrol"=>true],
"bureaucrat"=>
  ["bureaucrat-access"=>true,

  "editinterface"=>true,
  "editsitecss"=>true,
  "editsitejs"=>true,
  "editsitejson"=>true,
  "editusercss"=>true,
  "edituserjs"=>true,
  "edituserjson"=>true,
  "import"=>true,
  "importupload"=>true,
  "managechangetags"=>true,
  "mergehistory"=>true],
"steward"=>
  ["steward-access"=>true,

  "apihighlimits"=>true,
  "bigdelete"=>true,
  "deletechangetags"=>true, //Very dangerous
  "hideuser"=>true,
  "markbotedits"=>true,
  "nominornewtalk"=>true,
  "noratelimit"=>true,
  "siteadmin"=>true,
  "suppressionlog"=>true,
  "suppressrevision"=>true,
  "unblockself"=>true,
  "userrights"=>true,
  "userrights-interwiki"=>true,
  //"viewsuppressed"=>true, //Disabled for test
  "writeapi"=>true]
];
$wgGroupsRemoveFromSelf=
["staff"=>
  ["staff"],
"admin"=>
  ["admin"],
"bureaucrat"=>
  ["bureaucrat"]
];
$wgRemoveGroups["bureaucrat"]=["staff","admin"];

/*Protection*/
$wgCascadingRestrictionLevels=
["staff-access",
"admin-access",
"bureaucrat-access",
"steward-access"];
$wgRestrictionLevels=
["",
"user-access",
"autoconfirmed-access",
"staff-access",
"admin-access",
"bureaucrat-access",
"steward-access"];
$wgRestrictionTypes=
["create",
"edit",
"move",
"upload",
"delete",
"protect"];
$wgSemiprotectedRestrictionLevels=
["user-access",
"autoconfirmed-access"];

/*Remove groups*/
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["bot"]);
unset($wgGroupPermissions["sysop"]);};

/*Others*/
$wgDeleteRevisionsLimit=250;

##Uploads

/*Directory*/
$wgDeletedDirectory="{$private_data_dir}/{$wiki_id}/deleted_files";
$wgUploadDirectory="{$private_data_dir}/{$wiki_id}/files";
$wgUploadPath="{$wgScriptPath}/img_auth.php";

/*Thumbnail*/
$wgGenerateThumbnailOnParse=false;
$wgThumbnailScriptPath="{$wgScriptPath}/thumb.php";

/*Others*/
$wgAllowCopyUploads=true;
$wgAllowTitlesInSVG=true;
$wgCopyUploadsDomains=["openclipart.org"];
$wgCopyUploadsFromSpecialUpload=true;
$wgEnableUploads=true;
$wgHashedUploadDirectory=false;
$wgMaxUploadSize=
["*"=>1024*1024*5, //5 MB
"url"=>1024*1024*2]; //2 MB
$wgUpdateCompatibleMetadata=true;
$wgUploadSizeWarning=1024*1024*4; //4 MB
$wgUploadStashMaxAge=60*60; //1 hour
$wgUseCopyrightUpload=true;
$wgUseInstantCommons=true;
$wgUseTinyRGBForJPGThumbnails=true;

##Email

//Server does not support e-mail services
$wgEnableEmail=false;

##Caching

/*Basic cache settings*/
$wgCacheDirectory="{$private_data_dir}/{$wiki_id}/cache";
//Disable client side caching
$wgCachePages=false;
$wgMainCacheType=CACHE_ACCEL;

/*File cache*/
$wgFileCacheDepth=0;
$wgFileCacheDirectory=$wgCacheDirectory;
$wgUseFileCache=true;

/*Interwiki cache*/
$wgInterwikiCache=true;
$wgInterwikiExpiry=60; //1 minute

/*Message cache*/
$wgAdaptiveMessageCache=true;
$wgLocalisationCacheConf["store"]="array";
$wgUseLocalMessageCache=true;

/*Sidebar cache*/
$wgEnableSidebarCache=true;
$wgSidebarCacheExpiry=60; //1 minute
$wgTranscludeCacheExpiry=60; //1 minute

/*Others*/
$wgAdaptiveMessageCache=true; //Added for test
$wgLanguageConverterCacheType=$wgMainCacheType;
$wgMsgCacheExpiry=60; //1 minute
$wgObjectCacheSessionExpiry=60; //1 minute
$wgParserCacheExpireTime=60; //1 minute
$wgRevisionCacheExpiry=60; //1 minute
$wgSearchSuggestCacheExpiry=60; //1 minute
$wgSessionCacheType=$wgMainCacheType;

##System

/*Database*/
$wgDBname="wiki_{$wiki_id}";
$wgDBtype="sqlite";
/*
//Shared database
$wgSharedDB="wiki_{$central_wiki}";
$wgSharedTables=["user"];
*/
//SQLite-only
$wgSQLiteDataDir="{$private_data_dir}/databases";

/*Paths*/
$actions=
["delete",
"edit",
"history",
"info",
"markpatrolled",
"protect",
"purge",
"raw",
"render",
"revert",
"rollback",
"submit",
"unprotect",
"unwatch",
"watch"];
foreach ($actions as $action)
{$wgActionPaths[$action]="/{$action}/$1";}
$wgArticlePath="/page/$1";
$wgUsePathInfo=true;

/*Others*/
$wgAllowSecuritySensitiveOperationIfCannotReauthenticate["default"]=false; //Added for test
$wgApiFrameOptions="SAMEORIGIN";
$wgAuthenticationTokenVersion="1";
//Ignored on Windows
$wgDeleteRevisionsBatchSize=500; //Added for test
$wgDirectoryMode=0755;
//$wgEnableBlockNoticeStats=false; //??? //MUST SET!
$wgEnableDnsBlacklist=true;
$wgExtendedLoginCookieExpiration=60*60*24*90; //3 months
$wgFeed=false;
$wgGitBin=false;
$wgJobRunRate=2;
$wgJpegTran=false;
$wgMemoryLimit="256M";
$wgPasswordResetRoutes["username"]=false; //Added for test
switch (PHP_OS_FAMILY)
{case "Windows":
$wgPhpCli="C:/PHP/php.exe";
break;}
$wgReauthenticateTime["default"]=60*10; //10 minutes //Added for test

##Extensions

/*Guidelines
1. Do not add global extensions here.
2. Do not add PlavorMindTools extension here.
3. Always check dependencies on extra_settings.php when enabling per-wiki extension.*/

/*Extensions usage*/
$extension_Babel=false;
$extension_Cite=false;
$extension_CodeEditor=false;
$extension_CodeMirror=false;
$extension_CollapsibleVector=false;
$extension_CommonsMetadata=false;
$extension_DeletePagesForGood=false;
$extension_Highlightjs_Integration=false;
$extension_MultimediaViewer=false;
$extension_Nuke=false;
$extension_PageImages=false;
$extension_Popups=false;
$extension_SimpleMathJax=false;
$extension_SyntaxHighlight_GeSHi=false;
$extension_TextExtracts=false;
$extension_TwoColConflict=false;
$extension_WikiEditor=false;
?>
