<?php
//Prevent web access
if (!defined("MEDIAWIKI"))
{http_response_code(403);
$host=$_SERVER["HTTP_HOST"];
header("Location: //$host/error/403.html");
exit;}

/*Debug
error_reporting(-1);
ini_set("display_errors",1);
$wgShowDBErrorBacktrace=true;
$wgShowExceptionDetails=true;
$wgShowSQLErrors=true;
//*/

/*Path*/
//Script path
$wgScriptPath="/mediawiki";
$wgResourceBasePath=$wgScriptPath;

/*Basic wiki information*/
//Wiki logo
$wgLogo="$wgResourceBasePath/resources/assets/wiki.png";
//Wiki name
$wgSitename="PlavorPocketWiki";

/*Data folder*/
//Windows
if (PHP_OS_FAMILY=="Windows")
{$data_folder="C:/nginx/data/$wgSitename";}
//Linux
if (PHP_OS_FAMILY=="Linux")
{$data_folder="/web_data/$wgSitename";}

#General

/*Block*/
//Autoblock expiration
$wgAutoblockExpiry=60*60*24*365; //1 year
//Apply blocks to XFF header
$wgApplyIpBlocksToXff=true;
//Prevent blocked users from editing their talk pages
$wgBlockAllowsUTEdit=false;
//Limit IP address CIDR range when blocking
$wgBlockCIDRLimit=
["IPv4"=>8, //###.0.0.0/8
"IPv6"=>16]; //####::/16
//Set autoblock cookie
$wgCookieSetOnAutoblock=true;
//Check DNS blacklist
$wgEnableDnsBlacklist=true;
//Enable partial blocks
$wgEnablePartialBlocks=true;

/*Copyright*/
//Footer license icon
$wgRightsIcon="$wgResourceBasePath/resources/assets/licenses/cc-by-sa.png";
//License page
$wgRightsPage="";
//License
$wgRightsText="CC BY-SA 4.0";
//License URL
$wgRightsUrl="https://creativecommons.org/licenses/by-sa/4.0/";

/*CSS and JavaScript */
//Apply CSS to Special:Preferences and Special:UserLogin page
$wgAllowSiteCSSOnRestrictedPages=true;
//Allow personal CSS
$wgAllowUserCss=true;
//Allow personal JavaScript
$wgAllowUserJs=true;

/*Export*/
$wgExportAllowListContributors=true;
/*
$wgExportAllowAll=true;
$wgExportFromNamespaces=true;
//*/

/*Files and media*/
//Allow uploads from URLs
$wgAllowCopyUploads=true;
//Allow uploads from URLs in Special:Upload page
$wgCopyUploadsFromSpecialUpload=true;
//Enable file uploads
$wgEnableUploads=true;
//Disable putting files in subdirectories of $wgUploadDirectory based on MD5 hash of the filename
$wgHashedUploadDirectory=false;
//Maximum file size for uploading
$wgMaxUploadSize=1024*1024*5; //5 MB
//Display warning when trying to upload files larger than this
$wgUploadSizeWarning=1024*1024*3; //3 MB
//Allow using files from Wikimedia Commons
$wgUseInstantCommons=true;

/*Namespace aliases*/
$wgNamespaceAliases=
["?"=>NS_HELP,
"@"=>NS_USER,
"H"=>NS_HELP,
"M"=>NS_MEDIAWIKI,
"S"=>NS_SPECIAL,
"T"=>NS_TEMPLATE,
"U"=>NS_USER,
"UT"=>NS_USER_TALK,
//This project only
"PPW"=>NS_PROJECT];

/*Preferences*/
//Default preferences
$wgDefaultUserOptions=array_merge($wgDefaultUserOptions,
["editfont"=>"sans-serif",
"enotifwatchlistpages"=>0,
"enotifusertalkpages"=>0,
"enotifrevealaddr"=>1,
"hidecategorization"=>0,
"rememberpassword"=>1,
//Disable "Group changes by page in recent changes and watchlist" option by default
"usenewrc"=>0,
//Disable "Add pages I create and files I upload to my watchlist" option by default
"watchcreations"=>0,
//Disable "Add pages and files I edit to my watchlist" option by default
"watchdefault"=>0,
"watchlisthidecategorization"=>0,
//Disable "Add new files I upload to my watchlist" option by default
"watchuploads"=>0]);
//Hide "How do you prefer to be described?" (gender) option
$wgHiddenPrefs[]="gender";
//Hide "Real name" option
$wgHiddenPrefs[]="realname";

/*Rate limits*/
//Limit account creation to 5 per IP address in 1 day
$wgAccountCreationThrottle["count"]=5;
//Limit actions
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
  ["ip"=>[2,60],
  "newbie"=>[2,60],
  "user"=>[5,60]]
]);

/*Reserved usernames*/
//Prevent creating accounts with these usernames
$wgReservedUsernames=array_merge($wgReservedUsernames,
["Null"]);

/*Robot policy*/
//Default robot policy
$wgDefaultRobotPolicy="noindex,nofollow";
//Namespace robot policy
$wgNamespaceRobotPolicies[NS_MAIN]="index,follow";

/*Others*/
//Users edited within 1 week is active user
$wgActiveUserDays=7;
//Disable forcing the first letter of links to capitals
$wgCapitalLinks=false;
//Enable category browsing
$wgUseCategoryBrowser=true;
//Disable user talk for non-logged in users
$wgDisableAnonTalk=true;
//Disable email features
$wgEnableEmail=false;
//Open external links in a new tab
$wgExternalLinkTarget="_blank";
//Remove "Powered by MediaWiki" footer icon
unset($wgFooterIcons["poweredby"]);
//Prevent creating accounts with these characters
$wgInvalidUsernameCharacters="`~!@$%^&*()=+\\;:,.?";
//Enable subpages in these namespaces (Excludes File namespace)
$wgNamespacesWithSubpages[NS_MAIN]=true;
$wgNamespacesWithSubpages[NS_CATEGORY]=true;
//Disable display title restrictions
$wgRestrictDisplayTitle=false;
//Default sitenotice
$wgSiteNotice="<big>'''Welcome to [[{{SITENAME}}]]!'''</big>";

#Permissions

/*Autoconfirm*/
$wgAutoConfirmAge=60*60*24*15; //15 days
$wgAutoConfirmCount=15;

/*Group permissions*/
$wgGroupPermissions=
["*"=>
  ["applychangetags"=>true,
  "autocreateaccount"=>true,
  "createaccount"=>true,
  "createpage"=>true,
  "createtalk"=>true,
  "deletedhistory"=>true,
  "patrolmarks"=>true,
  "read"=>true,
  "unwatchedpages"=>true],
"user"=>
  ["user-access"=>true,
  //Users
  "edit"=>true,
  "editmyoptions"=>true,
  "editmyprivateinfo"=>true,
  "editmyusercss"=>true,
  "editmyuserjs"=>true,
  "editmyuserjson"=>true,
  "editmywatchlist"=>true,
  "minoredit"=>true,
  "viewmyprivateinfo"=>true,
  "viewmywatchlist"=>true],
"autoconfirmed"=>
  ["autoconfirmed-access"=>true,
  //Autoconfirmed users
  "autoconfirmed"=>true,
  "move"=>true,
  "move-categorypages"=>true,
  "move-subpages"=>true,
  "purge"=>true,
  "reupload-own"=>true,
  "sendemail"=>true,
  "upload"=>true,
  "upload_by_url"=>true],
"staff"=>
  ["staff-access"=>true,
  //Staffs
  "autopatrol"=>true,
  "block"=>true,
  "blockemail"=>true,
  "browsearchive"=>true,
  "delete"=>true,
  "deletedtext"=>true,
  "deleterevision"=>true,
  "movefile"=>true,
  "protect"=>true,
  "reupload"=>true,
  "reupload-shared"=>true,
  "rollback"=>true,
  "suppressredirect"=>true,
  "undelete"=>true],
"admin"=>
  ["admin-access"=>true,
  //Administrators
  "deletelogentry"=>true,
  "move-rootuserpages"=>true,
  "ipblock-exempt"=>true,
  "patrol"=>true],
"supervisor"=>
  ["supervisor-access"=>true,
  //Bureaucrats
  "apihighlimits"=>true,
  "bigdelete"=>true,
  "changetags"=>true,
  "deletechangetags"=>true,
  "editcontentmodel"=>true,
  "editinterface"=>true,
  "editsitecss"=>true,
  "editsitejs"=>true,
  "editsitejson"=>true,
  "editusercss"=>true,
  "edituserjs"=>true,
  "edituserjson"=>true,
  "hideuser"=>true,
  "import"=>true,
  "importupload"=>true,
  "managechangetags"=>true,
  "markbotedits"=>true,
  "mergehistory"=>true,
  "nominornewtalk"=>true,
  "noratelimit"=>true,
  "pagelang"=>true,
  //"siteadmin"=>true,
  "suppressionlog"=>true,
  "suppressrevision"=>true,
  "unblockself"=>true,
  "viewsuppressed"=>true,
  "writeapi"=>true]/*,
"root"=>
  ["block"=>true,
  "unblockself"=>true,
  "userrights"=>true,
  "userrights-interwiki"=>true]
//*/
];
$wgGroupsRemoveFromSelf["admin"][]="staff";
$wgAddGroups["supervisor"][]="staff";
$wgAddGroups["supervisor"][]="admin";
$wgRemoveGroups["supervisor"][]="staff";
$wgRemoveGroups["supervisor"][]="admin";

/*Password policy*/
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
  "PasswordCannotBePopular"=>50],
"admin"=> //Administrators
  ["MinimalPasswordLength"=>8,
  "MinimumPasswordLengthToLogin"=>6,
  "PasswordCannotBePopular"=>25],
"supervisor"=> //Bureaucrats
  ["MinimalPasswordLength"=>10,
  "MinimumPasswordLengthToLogin"=>8,
  "PasswordCannotBePopular"=>25]
];

/*Protection*/
$wgCascadingRestrictionLevels=["staff-access","admin-access","supervisor-access"];
$wgRestrictionLevels=["","user-access","autoconfirmed-access","staff-access","admin-access","supervisor-access"];
$wgRestrictionTypes=["create","edit","move","upload","delete","protect"];
$wgSemiprotectedRestrictionLevels=["user-access"];
//Namespace protection
$wgNamespaceProtection=
[NS_HELP=>["staff-access"],
NS_PROJECT=>["supervisor-access"],
NS_TEMPLATE=>["admin-access"],
NS_USER=>["user-access"]];
//Patch for protection
$wgGroupPermissions["autoconfirmed"]["user-access"]=true;

/*Remove groups*/
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["bot"]);
unset($wgGroupPermissions["bureaucrat"]);
unset($wgGroupPermissions["sysop"]);};
//*/

/*Temporary groups
$wgGroupPermissions["bureaucrat"]["userrights"]=true;
$wgGroupPermissions["interface-admin"]["read"]=true;
$wgGroupPermissions["sysop"]["read"]=true;
//*/

/*Others*/
//Bigdelete
$wgDeleteRevisionsLimit=250;

#System

/*Cache*/
//Cache folder
$wgCacheDirectory="$data_folder/cache";
//Localisation cache
$wgLocalisationCacheConf["store"]="array";
//Use APCu or WinCache for caching if available
$wgMainCacheType=CACHE_ACCEL;
//Expiry time to use for session storage
$wgObjectCacheSessionExpiry=60; //1 minute
//File cache
$wgUseFileCache=true;

//File cache directory
$wgFileCacheDirectory=$wgCacheDirectory;
//Language conversion tables cache
$wgLanguageConverterCacheType=$wgMainCacheType;
//Session data cache
$wgSessionCacheType=$wgMainCacheType;

/*Database*/
//Database name
$wgDBname="database";
//Database type
$wgDBtype="sqlite";
//SQLite database folder
$wgSQLiteDataDir=$data_folder;

/*Others*/
//Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion="0";
//Run 2 jobs per request
$wgJobRunRate=2;

//Include private settings
include_once("$data_folder/private.php");

#Extension

/*Other extensions*/
wfLoadExtension("PlavorMindTweaks");

/*Inherit permissions*/
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["supervisor"]+=$wgGroupPermissions["admin"];
//$wgGroupPermissions["root"]+=$wgGroupPermissions["supervisor"];

#Skin

/*Default skin*/
$wgDefaultSkin="Vector";

/*Buma*/
wfLoadSkin("Buma");
$wgResourceLoaderDebug=true;

/*Vector*/
wfLoadSkin("Vector");
$wgVectorResponsive=true;
