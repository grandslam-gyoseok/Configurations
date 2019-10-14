<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

#Initialize

/*Databases*/
$wgDBname=$wmgWiki."wiki";
$wgLocalDatabases=["exitwiki","livewiki","osawiki"];
if (!in_array($wgDBname,$wgLocalDatabases))
{exit("Cannot find this wiki.");}

/*Variables*/
$wmgCentralWiki="exit";
$wmgGlobalAccountExemptWikis=["pocket"];
$wmgGlobalAccountMode="centralauth";
if (in_array($wmgWiki,$wmgGlobalAccountExemptWikis))
{$wmgGlobalAccountMode="";}

/*Others*/
if ($wmgGlobalAccountMode!="")
{$wgConf->localVHosts=["localhost"];
$wgConf->settings=
["wgArticlePath"=>
  ["default"=>"/page/$1"]
];
if ($wgCommandLineMode)
  {$wgConf->settings["wgServer"]["default"]='http://$lang.plavormind.tk:81';}
else
  {$wgConf->settings["wgServer"]["default"]=$_SERVER["REQUEST_SCHEME"].'://$lang.plavormind.tk:81';}
$wgConf->siteParamsCallback="efGetSiteParams";
$wgConf->suffixes=["wiki"];
$wgConf->wikis=$wgLocalDatabases;
$wgConf->extractAllGlobals($wgDBname);}
//Should be defined before variables using $wgScriptPath
$wgScriptPath="/mediawiki";

#General

/*Account*/
$wgInvalidUsernameCharacters="`~!@$%^&*()=+\\;:,.?";
$wgMaxNameChars=30;
$wgReservedUsernames=array_merge($wgReservedUsernames,
["Abuse filter",
"Anonymous",
"Example",
"Flow talk page manager",
"MediaWiki message delivery",
"Undefined",
"Unknown",
"User",
"Username",
"편집 필터"]);

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
$wgExternalInterwikiFragmentMode="html5";
$wgRedirectSources="https?:\\/\\/.+";

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
["hidecategorization"=>0,
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
  ["count"=>5,
  "seconds"=>60],
//Per day
  ["count"=>30,
  "seconds"=>60*60*24]
];
$wgRateLimits=array_merge($wgRateLimits,
["edit"=>
  ["ip"=>
    [3,60],
  "newbie"=>
    [5,60],
  "user"=>
    [10,60]
  ],
"move"=>
  ["ip"=>
    [1,60],
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
$wgLearnerEdits=15;
$wgLearnerMemberSince=7; //1 week
$wgRCFilterByAge=true;
$wgRCShowWatchingUsers=true;
$wgRCWatchCategoryMembership=true;
//Disable hiding (active) page watchers to users without "unwatchedpages" permission
$wgUnwatchedPageSecret=-1;
$wgUnwatchedPageThreshold=0;
$wgWatchersMaxAge=60*60*24*7; //1 week

/*Robot policies*/
$wgDefaultRobotPolicy="noindex,nofollow";
//All namespaces
$wgExemptFromUserRobotsControl=[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
$wgNoFollowDomainExceptions=["plavormind.tk"];

/*Others*/
$wgActiveUserDays=7; //1 week
$wgBreakFrames=true;
$wgCapitalLinks=false;
$wgCleanSignatures=false;
$wgEditPageFrameOptions="SAMEORIGIN";
$wgEnableMagicLinks= //Experimental
["ISBN"=>true,
"PMID"=>true,
"RFC"=>true];
$wgExternalLinkTarget="_blank";
$wgFragmentMode=["html5"];
unset($wgFooterIcons["poweredby"]);
$wgHideUserContribLimit=500;
$wgMaxSigChars=200;
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
$wgRangeContributionsCIDRLimit=$wgBlockCIDRLimit;
//Remove default value
$wgRawHtmlMessages=[];
$wgUniversalEditButton=false;
//Only allow HTTP and HTTPS protocol in links
$wgUrlProtocols=["//","http://","https://"];

#Permissions

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
  ["applychangetags"=>true,
  "createpage"=>true,
  "createtalk"=>true,
  "edit"=>true,
  "editprotected-user"=>true,
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
  ["autoconfirmed"=>true,
  "editprotected-user"=>true, //Patch for protection
  "editsemiprotected"=>true,
  "move"=>true,
  "move-categorypages"=>true,
  "move-rootuserpages"=>true,
  "movefile"=>true,
  "purge"=>true,
  "reupload"=>true,
  "upload"=>true],
"staff"=>
  ["autopatrol"=>true,
  "block"=>true,
  "blockemail"=>true,
  "delete"=>true,
  "deletedtext"=>true,
  "deleterevision"=>true,
  "editprotected-staff"=>true,
  "protect"=>true,
  "reupload-shared"=>true,
  "rollback"=>true,
  "suppressredirect"=>true,
  "undelete"=>true,
  "upload_by_url"=>true],
"admin"=>
  ["changetags"=>true,
  "deletelogentry"=>true,
  "editcontentmodel"=>true,
  "editprotected"=>true,
  "import"=>true,
  "ipblock-exempt"=>true,
  "move-subpages"=>true,
  "pagelang"=>true,
  "patrol"=>true],
"bureaucrat"=>
  ["editinterface"=>true,
  "editprotected-bureaucrat"=>true,
  "editsitecss"=>true,
  "editsitejs"=>true,
  "editsitejson"=>true,
  "editusercss"=>true,
  "edituserjs"=>true,
  "edituserjson"=>true,
  "importupload"=>true,
  "managechangetags"=>true,
  "mergehistory"=>true],
"steward"=>
  ["apihighlimits"=>true,
  "bigdelete"=>true,
  "deletechangetags"=>true,
  "editprotected-steward"=>true,
  "hideuser"=>true,
  "markbotedits"=>true,
  "nominornewtalk"=>true,
  "noratelimit"=>true,
  "suppressionlog"=>true,
  "suppressrevision"=>true,
  "unblockself"=>true,
  "writeapi"=>true]
];
$wgRemoveGroups["bureaucrat"]=["staff","admin"];

/*Protection*/
$wgCascadingRestrictionLevels=
["editprotected-staff",
"editprotected",
"editprotected-bureaucrat",
"editprotected-steward"];
$wgNamespaceProtection[NS_USER]=["editprotected-user"];
$wgRestrictionLevels=
["",
"editprotected-user",
"editsemiprotected",
"editprotected-staff",
"editprotected",
"editprotected-bureaucrat",
"editprotected-steward"];
$wgRestrictionTypes=
["create",
"edit",
"move",
"upload",
"delete",
"protect"];
$wgSemiprotectedRestrictionLevels=
["editprotected-user",
"editsemiprotected"];

/*Removal of groups*/
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["bot"],$wgGroupPermissions["sysop"]);};

/*Others*/
$wgDeleteRevisionsLimit=250;
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["bureaucrat"]+=$wgGroupPermissions["admin"];
if ($wmgGlobalAccountMode=="centralauth")
{unset($wgGroupPermissions["steward"]);}
else
{$wgGroupPermissions["steward"]+=$wgGroupPermissions["bureaucrat"];}

##Uploads

/*Directory*/
$wgDeletedDirectory="{$wmgPrivateDataDirectory}/{$wmgWiki}/deleted_files";
$wgUploadDirectory="{$wmgPrivateDataDirectory}/{$wmgWiki}/files";
$wgUploadPath="{$wgScriptPath}/img_auth.php";

/*Thumbnail*/
$wgGenerateThumbnailOnParse=false;
$wgThumbnailScriptPath="{$wgScriptPath}/thumb.php";

/*Others*/
$wgAllowCopyUploads=true;
$wgCopyUploadsDomains=[]; //openclipart.org is inaccessible
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
$wgCacheDirectory="{$wmgPrivateDataDirectory}/{$wmgWiki}/cache";
//Disable client side caching
$wgCachePages=false;
$wgMainCacheType=CACHE_ACCEL;

/*File cache*/
$wgFileCacheDepth=0;
$wgFileCacheDirectory=$wgCacheDirectory;
$wgUseFileCache=true;

/*Message cache*/
$wgAdaptiveMessageCache=true;
$wgLocalisationCacheConf["store"]="array";
$wgUseLocalMessageCache=true;

/*Sidebar cache*/
$wgEnableSidebarCache=true;
$wgSidebarCacheExpiry=$wmgCacheExpiry;
$wgTranscludeCacheExpiry=$wmgCacheExpiry;

/*Others*/
$wgAdaptiveMessageCache=true;
$wgInterwikiExpiry=$wmgCacheExpiry;
$wgLanguageConverterCacheType=$wgMainCacheType;
$wgMessageCacheType=$wgMainCacheType;
$wgMsgCacheExpiry=$wmgCacheExpiry;
$wgObjectCacheSessionExpiry=$wmgCacheExpiry;
$wgParserCacheExpireTime=$wmgCacheExpiry;
$wgParserCacheType=$wgMainCacheType;
$wgRevisionCacheExpiry=$wmgCacheExpiry;
$wgSearchSuggestCacheExpiry=$wmgCacheExpiry;
$wgSessionCacheType=CACHE_ACCEL; //This one should always use cache

#System

/*Database*/
if ($wmgGlobalAccountMode=="shared-database")
{$wgSharedDB="{$wmgCentralWiki}wiki";
$wgSharedTables=["actor","interwiki","user"];}
//SQLite-only
$wgSQLiteDataDir="{$wmgPrivateDataDirectory}/databases";

/*Path*/
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
unset($action,$actions);
$wgArticlePath="/page/$1";
$wgUsePathInfo=true;

/*Others*/
$wgAllowSecuritySensitiveOperationIfCannotReauthenticate["default"]=false; //Experimental
$wgApiFrameOptions="SAMEORIGIN";
$wgAsyncHTTPTimeout=30;
$wgAuthenticationTokenVersion="1";
$wgDeleteRevisionsBatchSize=500; //Experimental
//Ignored on Windows
$wgDirectoryMode=0755;
$wgEnableDnsBlacklist=true;
$wgExtendedLoginCookieExpiration=60*60*24*90; //3 months
$wgFeed=false;
$wgGitBin=false;
$wgHTTPTimeout=30;
$wgJpegTran=false;
$wgMemoryLimit="256M";
$wgPasswordResetRoutes["username"]=false;
switch (PHP_OS_FAMILY)
{case "Windows":
$wgPhpCli="C:/plavormind/php/php.exe";
break;}
$wgReadOnlyFile="{$wmgDataDirectory}/readonly.txt";
$wgReauthenticateTime["default"]=60*10; //10 minutes //Experimental

##Extensions

/*Guidelines
1. Do not add global extensions here.
2. Do not add PlavorMindTools extension here.
3. Always check dependencies on extra_settings.php when enabling per-wiki extension.*/

/*Extensions usage*/
$wmgExtensionAlwaysBlueCategory=false;
$wmgExtensionBabel=false;
$wmgExtensionCite=false;
$wmgExtensionCodeEditor=false;
$wmgExtensionCodeMirror=false;
$wmgExtensionCollapsibleVector=false;
$wmgExtensionCommonsMetadata=false;
$wmgExtensionDeletePagesForGood=false;
$wmgExtensionFlow=false;
$wmgExtensionHighlightjs_Integration=false;
$wmgExtensionMultimediaViewer=false;
$wmgExtensionNuke=false;
$wmgExtensionPageImages=false;
$wmgExtensionParserFunctions=false;
$wmgExtensionPerformanceInspector=false;
$wmgExtensionPopups=false;
if ($wmgGlobalAccountMode=="centralauth")
{$wmgExtensionRenameuser=true;}
else
{$wmgExtensionRenameuser=false;}
$wmgExtensionReplaceText=false;
$wmgExtensionSecurePoll=false;
$wmgExtensionSimpleMathJax=false;
$wmgExtensionSyntaxHighlight_GeSHi=false;
$wmgExtensionTemplateData=false;
$wmgExtensionTemplateWizard=false;
$wmgExtensionTextExtracts=false;
$wmgExtensionTwoColConflict=false;
$wmgExtensionWikiEditor=false;
?>
