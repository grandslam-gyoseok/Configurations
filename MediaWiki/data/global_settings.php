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
$wgReservedUsernames=array_merge_recursive($wgReservedUsernames,
["Anon","Anonymous","Default","Not logged in","Null"]);

/*Basic information*/
//Will fallback to default logo by try_files when logo does not exist
$wgLogo="{$wgScriptPath}/data/{$wiki_code}/logo.png";
$wgSitename="Wiki";

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
$wgMaxCredits=10; //Added for test
$wgRightsIcon="{$wgScriptPath}/resources/assets/licenses/cc-by-sa.png";
$wgRightsText="CC BY-SA 4.0";
$wgRightsUrl="https://creativecommons.org/licenses/by-sa/4.0/";

/*CSS and JavaScript*/
$wgAllowSiteCSSOnRestrictedPages=true;
$wgAllowUserCss=true;
$wgAllowUserCssPrefs=true;
$wgAllowUserJs=true;

/*Interwiki*/
$wgEnableScaryTranscluding=true;
$wgRedirectSources="https?:\\/\\/.*"; //Set for test

/*Namespaces*/
//Exclude File namespace
$wgNamespacesWithSubpages[NS_CATEGORY]=true;
$wgNamespacesWithSubpages[NS_MAIN]=true;

/*Password policies*/
$wgPasswordPolicy["policies"]=
["default"=>
  ["MaximalPasswordLength"=>20,
  "MinimalPasswordLength"=>6,
  "MinimumPasswordLengthToLogin"=>1,
  "PasswordCannotBePopular"=>100,
  "PasswordCannotMatchBlacklist"=>true,
  "PasswordCannotMatchUsername"=>true],
"staff"=> //Staffs
  ["MinimalPasswordLength"=>8,
  "MinimumPasswordLengthToLogin"=>6,
  "PasswordCannotBePopular"=>75],
"admin"=> //Administrators
  ["MinimalPasswordLength"=>8,
  "MinimumPasswordLengthToLogin"=>6,
  "PasswordCannotBePopular"=>50],
"bureaucrat"=> //Bureaucrats
  ["MinimalPasswordLength"=>10,
  "MinimumPasswordLengthToLogin"=>8,
  "PasswordCannotBePopular"=>50],
"steward"=> //Stewards
  ["MinimalPasswordLength"=>10,
  "MinimumPasswordLengthToLogin"=>8,
  "PasswordCannotBePopular"=>25]
];

/*Preferences*/
$wgDefaultUserOptions=array_merge($wgDefaultUserOptions,
["editfont"=>"sans-serif",
"hidecategorization"=>0,
"usenewrc"=>0,
"rememberpassword"=>1,
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
$wgRateLimits=array_merge_recursive($wgRateLimits,
["edit"=>
  ["ip"=>[5,60],
  "newbie"=>[5,60],
  "user"=>[10,60]],
"move"=>
  ["ip"=>[2,60],
  "newbie"=>[2,60],
  "user"=>[5,60]],
"upload"=>
  ["ip"=>[1,60],
  "newbie"=>[1,60],
  "user"=>[3,60]]
]);

/*Robot policies*/
$wgDefaultRobotPolicy="noindex,nofollow"; //Set for test
//All namespaces
$wgExemptFromUserRobotsControl=[-2,-1,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]; //Set for test
//Remove default value ("mediawiki.org")
$wgNoFollowDomainExceptions=[];

/*Others*/
$wgAdvancedSearchHighlighting=true; //Added for test
$wgAllowSlowParserFunctions=true; //Added for test
$wgActiveUserDays=7;
$wgBreakFrames=true;
$wgCapitalLinks=false;
$wgCleanSignatures=false; //Added for test
$wgDisableAnonTalk=true;
$wgEditPageFrameOptions="SAMEORIGIN";
$wgExternalLinkTarget="_blank";
//Remove default value
$wgFilterLogTypes=[];
unset($wgFooterIcons["poweredby"]);
$wgMaxTemplateDepth=10;
$wgMaxTocLevel=5;
$wgRangeContributionsCIDRLimit=$wgBlockCIDRLimit;
$wgRCShowWatchingUsers=true; //Added for test
$wgRestrictDisplayTitle=false; //Added for test
$wgShowRollbackEditCount=20; //Set for test
$wgUniversalEditButton=false;
//Only allow HTTP and HTTPS protocol in links
$wgUrlProtocols=["//","http://","https://"];
$wgUseCategoryBrowser=true; //Added for test

##Permissions

/*Autoconfirm*/
$wgAutoConfirmAge=60*60*24*14; //2 weeks
$wgAutoConfirmCount=15;

/*Group permissions*/
$wgGroupPermissions=
["*"=>
  ["autocreateaccount"=>true,
  "createaccount"=>true,
  "deletedhistory"=>true,
  "patrolmarks"=>true,
  "read"=>true,
  "unwatchedpages"=>true],
"user"=> //Users
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
  "reupload-own"=>true,
  "sendemail"=>true,
  "upload"=>true,
  "viewmyprivateinfo"=>true,
  "viewmywatchlist"=>true],
"autoconfirmed"=> //Autoconfirmed users
  ["autoconfirmed-access"=>true,

  "autoconfirmed"=>true,
  "move"=>true,
  "move-categorypages"=>true,
  "move-rootuserpages"=>true,
  "move-subpages"=>true,
  "movefile"=>true,
  "purge"=>true,
  "reupload"=>true,
  "user-access"=>true, //Patch for protection
  "upload_by_url"=>true],
"staff"=> //Staffs
  ["staff-access"=>true,

  "autopatrol"=>true,
  "block"=>true,
  "blockemail"=>true,
  "browsearchive"=>true,
  "delete"=>true,
  "deletedtext"=>true,
  "deleterevision"=>true,
  "protect"=>true,
  "reupload-shared"=>true,
  "rollback"=>true,
  "suppressredirect"=>true,
  "undelete"=>true],
"admin"=> //Administrators
  ["admin-access"=>true,

  "changetags"=>true,
  "deletechangetags"=>true,
  "deletelogentry"=>true,
  "editcontentmodel"=>true,
  "ipblock-exempt"=>true,
  "pagelang"=>true,
  "patrol"=>true],
"bureaucrat"=> //Bureaucrats
  ["bureaucrat-access"=>true,

  "editinterface"=>true,
  "editsitecss"=>true,
  "editsitejson"=>true,
  "editusercss"=>true,
  "edituserjson"=>true,
  "managechangetags"=>true,
  "mergehistory"=>true],
"steward"=> //Stewards
  ["steward-access"=>true,

  "apihighlimits"=>true,
  "bigdelete"=>true,
  "editsitejs"=>true,
  "edituserjs"=>true,
  "hideuser"=>true,
  "import"=>true,
  "importupload"=>true,
  "markbotedits"=>true,
  "nominornewtalk"=>true,
  "noratelimit"=>true,
  "siteadmin"=>true,
  "suppressionlog"=>true,
  "suppressrevision"=>true,
  "unblockself"=>true,
  "userrights"=>true,
  "userrights-interwiki"=>true,
  "viewsuppressed"=>true,
  "writeapi"=>true]
];
$wgAddGroups["bureaucrat"]=["staff","admin"];
$wgRemoveGroups["bureaucrat"]=["staff","admin"];

/*Protection*/
$wgCascadingRestrictionLevels=["staff-access","admin-access","bureaucrat-access","steward-access"];
$wgRestrictionLevels=["","user-access","autoconfirmed-access","staff-access","admin-access","bureaucrat-access","steward-access"];
$wgRestrictionTypes=["create","edit","move","upload","delete","protect"];
$wgSemiprotectedRestrictionLevels=["user-access","autoconfirmed-access"];

/*Others*/
$wgDeleteRevisionsLimit=250;

##Uploads

$wgAllowCopyUploads=true;
$wgCopyUploadsDomains=[]; //MUST SET!
$wgEnableUploads=true;
$wgHashedUploadDirectory=false;
$wgMaxUploadSize=1024*1024*5; //5 MB
$wgUseCopyrightUpload=true;
//Automatically update outdated EXIF metadata
$wgUpdateCompatibleMetadata=true;
$wgUploadSizeWarning=1024*1024*3; //3 MB
$wgUploadStashMaxAge=60*60; //1 hour

/*Directory*/
$wgDeletedDirectory="{$private_data_dir}/{$wiki_code}/deleted_files";
$wgUploadDirectory="{$private_data_dir}/{$wiki_code}/files";
$wgUploadPath="{$wgScriptPath}/img_auth.php";

/*Thumbnail*/
$wgGenerateThumbnailOnParse=false;
$wgThumbnailScriptPath="{$wgScriptPath}/thumb.php";

##Email

//Server does not support e-mail services
$wgEnableEmail=false;

##Caching

/*Basic cache settings*/
$wgCacheDirectory="{$private_data_dir}/{$wiki_code}/cache";
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
$wgSidebarCacheExpiry=60;

/*Others*/
$wgLanguageConverterCacheType=$wgMainCacheType;
$wgMsgCacheExpiry=60;
$wgObjectCacheSessionExpiry=60;
$wgParserCacheExpireTime=60;
$wgSearchSuggestCacheExpiry=60;
$wgSessionCacheType=$wgMainCacheType;
$wgTranscludeCacheExpiry=60;

##System

/*Database*/
$wgDBname="{$wiki_code}_db";
$wgDBtype="sqlite";
//SQLite-only
$wgSQLiteDataDir="{$private_data_dir}/databases";

/*
$wgSharedDB="{$central_wiki_code}_db";
//$wgSharedPrefix="shared_"; //Enabled for test
$wgSharedTables=["user"];
*/

/*Paths*/
$actions=["delete",
"edit",
"history",
"info",
"markpatrolled",
"protect",
"purge",
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
$wgAuthenticationTokenVersion="1";
$wgCommandLineDarkBg=true; //Added for test
//Ignored on Windows
$wgDirectoryMode=0755;
$wgEnableDnsBlacklist=true;
$wgExtendedLoginCookieExpiration=60*60*24*90; //3 months
$wgFeed=false;
$wgJobRunRate=2;
$wgMemoryLimit="256M";
switch (PHP_OS_FAMILY)
{case "Windows":
$wgPhpCli="C:/PHP/php.exe";
break;}
//$wgResourceLoaderEnableJSProfiler=true; //Disabled for test
$wgUseMediaWikiUIEverywhere=true;
?>
