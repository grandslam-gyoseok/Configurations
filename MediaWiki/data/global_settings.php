<?php
/*Prevent web access*/
if (!defined("MEDIAWIKI"))
{exit;}

#General settings
$wgSitename="Wiki";

#Paths
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
//Ignored on Windows
$wgDirectoryMode=0755;
$wgLogo="{$data_dir}/{$wiki_code}/logo.png";
switch (PHP_OS_FAMILY)
{case "Windows":
$wgPhpCli="C:/PHP/php.exe";
break;}
$wgScriptPath="/mediawiki";
$wgUsePathInfo=true;

#Email settings
//Server does not support e-mail services
$wgEnableEmail=false;

#Database settings
$wgDBname="{$wiki_code}_db";
$wgDBtype="sqlite";

/*SQLite-specific*/
$wgSQLiteDataDir="{$private_data_dir}/databases";

/*Shared DB settings
$wgSharedDB="{$central_wiki_code}_db";
//$wgSharedPrefix="shared_"; //Enabled for test
$wgSharedTables=["user"];
*/

#Localization
$wgMsgCacheExpiry=60;

#Site customization
$wgBreakFrames=true;
$wgCapitalLinks=false;
$wgEditPageFrameOptions="SAMEORIGIN";
$wgNoFollowDomainExceptions=[];
$wgRestrictionLevels=["","user-access","autoconfirmed-access","staff-access","admin-access","bureaucrat-access","steward-access"];
$wgSiteNotice="'''Welcome to [[{{SITENAME}}]]!'''";
$wgUniversalEditButton=false;
//Only allow HTTP and HTTPS protocol in links
$wgUrlProtocols=["//","http://","https://"];

/*Frontend*/
$wgAllowSiteCSSOnRestrictedPages=true;
$wgAllowUserCss=true;
$wgAllowUserJs=true;

/*Namespaces*/
//Exclude File namespace
$wgNamespacesWithSubpages[NS_CATEGORY]=true;
$wgNamespacesWithSubpages[NS_MAIN]=true;

/*Output*/
$wgUseMediaWikiUIEverywhere=true;

/*Robot policies*/
$wgDefaultRobotPolicy="noindex,nofollow"; //Enabled for test
//All namespaces
$wgExemptFromUserRobotsControl=[-2,-1,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]; //Enabled for test

#Category
$wgUseCategoryBrowser=true;

#Cache
$wgCacheDirectory="{$private_data_dir}/{$wiki_code}/cache";
$wgMainCacheType=CACHE_ACCEL;
$wgObjectCacheSessionExpiry=60;
$wgSessionCacheType=$wgMainCacheType;

//Must be after $wgMainCacheType
$wgLanguageConverterCacheType=$wgMainCacheType;

/*Client side caching*/
$wgCachePages=false;

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

/*Parser cache*/
$wgParserCacheExpireTime=60;

#Interwiki
$wgEnableScaryTranscluding=true;
$wgRedirectSources="https?:\\/\\/.*"; //Enabled for test
$wgTranscludeCacheExpiry=60;

#Access
$wgAccountCreationThrottle=
[//Per minute
  ["count"=>1,
  "seconds"=>60],
//Per day
  ["count"=>5,
  "seconds"=>60*60*24]
];
$wgBlockCIDRLimit=
["IPv4"=>8, //###.0.0.0/8
"IPv6"=>16]; //####::/16
$wgDeleteRevisionsLimit=250;
$wgPasswordAttemptThrottle=
[//Per minute
  ["count"=>3,
  "seconds"=>60],
//Per day
  ["count"=>50,
  "seconds"=>60*60*24]
];
$wgRangeContributionsCIDRLimit=$wgBlockCIDRLimit;
$wgRestrictionTypes=["create","edit","move","upload","delete","protect"];
$wgCookieSetOnAutoblock=true;

/*Rate limiter*/
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

#Reduction
$wgShowRollbackEditCount=20; //Enabled for test

#Uploads
$wgAllowCopyUploads=true;
$wgCopyUploadsDomains=[]; //MUST SET!
$wgEnableUploads=true;
$wgHashedUploadDirectory=false;
$wgUploadDirectory="{$private_data_dir}/{$wiki_code}/files";
$wgDeletedDirectory="{$private_data_dir}/{$wiki_code}/deleted_files";
$wgUploadPath="{$wgScriptPath}/img_auth.php";
$wgUploadSizeWarning=1024*1024*3; //3 MB
$wgUploadStashMaxAge=60*60; //1 hour
$wgMaxUploadSize=1024*1024*5; //5 MB

/*EXIF*/
$wgUpdateCompatibleMetadata=true;

/*Thumbnail settings*/
$wgGenerateThumbnailOnParse=false;
$wgThumbnailScriptPath="{$wgScriptPath}/thumb.php";

#Parser
$wgAllowSlowParserFunctions=true; //Enabled for test
$wgCleanSignatures=false;
$wgExternalLinkTarget="_blank";
$wgMaxTemplateDepth=10;
$wgMaxTocLevel=5;
$wgRestrictDisplayTitle=false;

#Special pages
$wgFilterLogTypes=[];
$wgRCShowWatchingUsers=true;

#Users
$wgActiveUserDays=7;
$wgAutoConfirmAge=60*60*24*14; //2 weeks
$wgAutoConfirmCount=15;
$wgAllowUserCssPrefs=true;
$wgDisableAnonTalk=true;
$wgHiddenPrefs=["gender","realname"];
$wgInvalidUsernameCharacters="`~!@$%^&*()=+\\;:,.?";
$wgMaxNameChars=20;
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
$wgReservedUsernames=array_merge_recursive($wgReservedUsernames,
["Anon","Anonymous","Not logged in","Null"]);

/*Authentication*/
$wgAuthenticationTokenVersion="1";

/*User access*/
$wgAddGroups["bureaucrat"]=["staff","admin"];
$wgAutoblockExpiry=60*60*24*365; //1 year
$wgBlockAllowsUTEdit=true;
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
  "edituserjs"=>true,
  "edituserjson"=>true,
  "managechangetags"=>true,
  "mergehistory"=>true],
"steward"=> //Stewards
  ["steward-access"=>true,

  "apihighlimits"=>true,
  "bigdelete"=>true,
  "editsitejs"=>true,
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
$wgRemoveGroups["bureaucrat"]=["staff","admin"];

#Cookies
$wgExtendedLoginCookieExpiration=60*60*24*90; //3 months

#Feed
$wgFeed=false;

#Copyright
$wgMaxCredits=10;
$wgRightsIcon="{$wgScriptPath}/resources/assets/licenses/cc-by-sa.png";
$wgRightsText="CC BY-SA 4.0";
$wgRightsUrl="https://creativecommons.org/licenses/by-sa/4.0/";
$wgUseCopyrightUpload=true;

#Search
$wgAdvancedSearchHighlighting=true;
$wgSearchSuggestCacheExpiry=60;

#Jobs
$wgJobRunRate=2;

#Proxies
$wgEnableDnsBlacklist=true;

#Maintenance scripts setting
$wgCommandLineDarkBg=true; //Enabled for test

#Miscellaneous settings
$wgMemoryLimit="256M";

#Undocumented
$wgCascadingRestrictionLevels=["staff-access","admin-access","bureaucrat-access","steward-access"];
$wgCookieSetOnIpBlock=true;
$wgEnablePartialBlocks=true;
//$wgResourceLoaderEnableJSProfiler=true; //Disabled for test
$wgSemiprotectedRestrictionLevels=["user-access","autoconfirmed-access"];
?>
