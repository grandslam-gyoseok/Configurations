<?php
/*Prevent web access*/
if (!defined("MEDIAWIKI"))
{exit;}

/*Debug
error_reporting(-1);
ini_set("display_errors",1);
$wgShowExceptionDetails=true;
$wgShowDBErrorBacktrace=true;
$wgShowSQLErrors=true;
//*/

/*Entry point*/
//Must be above $wgLogo
$wgScriptPath="/mediawiki";
$wgResourceBasePath=$wgScriptPath;
#----

#General
/*Wiki information*/
//Wiki name
$wgSitename="PlavorEXITBeta";
//Logo
$wgLogo="$wgResourceBasePath/logo.png";

/*Copyright*/
$wgRightsText="CC BY-SA 4.0";
$wgRightsIcon="$wgResourceBasePath/resources/assets/licenses/cc-by-sa.png";
$wgRightsUrl="https://creativecommons.org/licenses/by-sa/4.0/";
//Copyright policy/description page
$wgRightsPage="";

/*Sitenotice*/
//This will be displayed if 'MediaWiki:Sitenotice' and 'MediaWiki:Anonnotice' are empty
$wgSiteNotice="<big>'''Welcome to [[{{SITENAME}}]]!'''</big>";

/*Namespace Aliases*/
$wgNamespaceAliases=
["@"=>NS_USER,
"M"=>NS_MEDIAWIKI,
"T"=>NS_TEMPLATE,
"U"=>NS_USER,
//This project only
"PEB"=>NS_PROJECT];

/*Reserved usernames*/
//Prevent creating accounts with these usernames
$wgReservedUsernames=array_merge($wgReservedUsernames,
["Null",
//Action names
"Block","Create","Delete","Edit","Move","Protect","Watch"
//동작 이름
"보호","삭제","생성","이동","주시","편집","차단"]);

/*Default Preferences*/
$wgDefaultUserOptions=array_merge($wgDefaultUserOptions,
[//Disable "Group changes by page in recent changes and watchlist" option by default
"usenewrc"=>0,
//Disable "Add pages I create and files I upload to my watchlist" option by default
"watchcreations"=>0,
//Disable "Add pages and files I edit to my watchlist" option by default
"watchdefault"=>0,
//Disable "Add new files I upload to my watchlist" option by default
"watchuploads"=>0]);

/*Blocking*/
//Prevent blocked users from editing their talk pages
$wgBlockAllowsUTEdit=false;
//Limit IP address CIDR range when blocking
$wgBlockCIDRLimit=
["IPv4"=>8, //###.0.0.0/8
"IPv6"=>16]; //####::/16
//Autoblock expiration
$wgAutoblockExpiry=60*60*24*365; //1 year
//Apply blocks to XFF header
$wgApplyIpBlocksToXff=true;
//Enable autoblock cookie
$wgCookieSetOnAutoblock=true;

/*CSS and JavaScript*/
//Apply CSS to Special:Preferences and Special:UserLogin page
$wgAllowSiteCSSOnRestrictedPages=true;
//Allow personal CSS
$wgAllowUserCss=true;
//Allow personal JavaScript
$wgAllowUserJs=true;

/*Export
$wgExportAllowAll=true;
$wgExportAllowHistory=true;
$wgExportAllowListContributors=true;
$wgExportFromNamespaces=true;
//*/

/*Others*/
//Allow using lowercase letters in first letter of page titles
$wgCapitalLinks=false;
//Disable user talk for non-logged in users
$wgDisableAnonTalk=true;
//Enable category browsing
$wgUseCategoryBrowser=true;
//Prevent creating accounts with these characters
$wgInvalidUsernameCharacters="`~!@$%^&*()=+\\;:,.?";

#Files and media
/*File uploads*/
//Enable file uploads
$wgEnableUploads=true;
//Allow uploading from URLs
$wgAllowCopyUploads=true;
//Disable uploading from URLs in Special:Upload page
$wgCopyUploadsFromSpecialUpload=false;
//Display warning when trying to upload files larger than this
$wgUploadSizeWarning=1024*1024*3; //3 MB
//Maximum file size for uploading
$wgMaxUploadSize=1024*1024*5; //5 MB

/*InstantCommons*/
//Allow using files from Wikimedia Commons
$wgUseInstantCommons=true;

#Permissions
/*Group permissions*/
//Grant permissions
$wgGroupPermissions=
["*"=>
  ["autocreateaccount"=>true,
  "createaccount"=>true,
  "patrolmarks"=>true,
  "read"=>true,
  "unwatchedpages"=>true],
"user"=> //Users
  ["applychangetags"=>true,
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
  "viewmyprivateinfo"=>true,
  "viewmywatchlist"=>true],
"autoconfirmed"=> //Autoconfirmed users
  ["move"=>true,
  "move-subpages"=>true,
  "movefile"=>true,
  "purge"=>true,
  "reupload-own"=>true,
  "sendemail"=>true,
  "upload"=>true],
"staff"=> //Staffs
  ["autopatrol"=>true,
  "block"=>true,
  "blockemail"=>true,
  "browsearchive"=>true,
  "delete"=>true,
  "deletedhistory"=>true,
  "deletedtext"=>true,
  "deleterevision"=>true,
  "protect"=>true,
  "reupload"=>true,
  "rollback"=>true,
  "suppressredirect"=>true,
  "undelete"=>true],
"admin"=> //Administrators
  ["deletelogentry"=>true,
  "ipblock-exempt"=>true,
  "move-categorypages"=>true,
  "patrol"=>true,
  "reupload-shared"=>true,
  "upload_by_url"=>true],
"owner"=> //Owner
  ["apihighlimits"=>true,
  "autoconfirmed"=>true,
  "bigdelete"=>true,
  "changetags"=>true,
  "editcontentmodel"=>true,
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
  "move-rootuserpages"=>true,
  "nominornewtalk"=>true,
  "noratelimit"=>true,
  "pagelang"=>true,
  "siteadmin"=>true,
  "suppressionlog"=>true,
  "suppressrevision"=>true,
  "unblockself"=>true,
  "userrights"=>true,
  "userrights-interwiki"=>true,
  "viewsuppressed"=>true,
  "writeapi"=>true]
];

/*Protection*/
$wgRestrictionTypes=array("create","edit","move","delete","upload","protect");
$wgRestrictionLevels=array("","1stprotect","2ndprotect","3rdprotect","fullyprotect");
$wgCascadingRestrictionLevels=array("2ndprotect","3rdprotect","fullyprotect");
//Namespace protection
$wgNamespaceProtection=
[NS_FILE=>"1stprotect",
NS_HELP=>"2ndprotect",
NS_MEDIAWIKI_TALK=>"fullyprotect",
NS_PROJECT=>"fullyprotect",
NS_TEMPLATE=>"3rdprotect"];
//Permissions
$wgGroupPermissions=array_merge_recursive($wgGroupPermissions,
["autoconfirmed"=> //Autoconfirmed users
  ["1stprotect"=>true],
"staff"=> //Staffs
  ["2ndprotect"=>true],
"admin"=> //Administrators
  ["3rdprotect"=>true],
"owner"=> //Owner
  ["editinterface"=>true,
  "fullyprotect"=>true]
]);

/*Autoconfirm*/
$wgAutoConfirmAge=60*60*24*15; //15 days
$wgAutoConfirmCount=15;

#Extensions
/*AbuseFilter*/
wfLoadExtension("AbuseFilter");
//Show abuse filter trigger notifications in Special:RecentChanges page
$wgAbuseFilterNotifications="rc";
//Permissions
$wgGroupPermissions=array_merge_recursive($wgGroupPermissions,
["*"=>
  ["abusefilter-log-detail"=>true],
"admin"=> //Administrators
  ["abusefilter-modify"=>true],
"owner"=> //Owner
  ["abusefilter-hide-log"=>true,
  "abusefilter-hidden-log"=>true,
  "abusefilter-log-private"=>true,
  "abusefilter-modify-global"=>true,
  "abusefilter-modify-restricted"=>true,
  "abusefilter-private"=>true,
  "abusefilter-private-log"=>true,
  "abusefilter-revert"=>true,
  "abusefilter-view-private"=>true]
]);

/*AntiSpoof*/
wfLoadExtension("AntiSpoof");
//Owner (owner)
$wgGroupPermissions["owner"]["override-antispoof"]=true;

/*CheckUser*/
wfLoadExtension("CheckUser");
$wgCheckUserCIDRLimit=$wgBlockCIDRLimit;
//*
$wgGroupPermissions["*"]["checkuser-log"]=true;
//Owner (owner)
$wgGroupPermissions["owner"]["checkuser"]=true;
//checkuser
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["checkuser"]);};

/*ConfirmEdit*/
wfLoadExtension("ConfirmEdit");
$wgCaptchaClass="SimpleCaptcha";
$wgCaptchaTriggers["create"]=true;
$wgCaptchaTriggers["edit"]=true;
$wgCaptchaBadLoginExpiration=60*5;
//Autoconfirmed users (autoconfirmed)
$wgGroupPermissions["autoconfirmed"]["skipcaptcha"]=true;

/*CookieWarning*/
wfLoadExtension("CookieWarning");
$wgCookieWarningEnabled=true;

/*Echo*/
wfLoadExtension("Echo");
$wgEchoEnableEmailBatch=false;
$wgEchoPerUserBlacklist=true;

/*Interwiki*/
wfLoadExtension("Interwiki");
//Enable interwiki transcluding
$wgEnableScaryTranscluding=true;
//Expiry time for interwiki transclusion cache
$wgTranscludeCacheExpiry=60;
//Owner (owner)
$wgGroupPermissions["owner"]["interwiki"]=true;

/*Nuke*/
wfLoadExtension("Nuke");
//Owner (owner)
$wgGroupPermissions["owner"]["nuke"]=true;

/*PageImages*/
wfLoadExtension("PageImages");
$wgPageImagesNamespaces=$wgContentNamespaces;

/*ParserFunctions*/
wfLoadExtension("ParserFunctions");
$wgPFEnableStringFunctions=true;

/*Popups*/
wfLoadExtension("Popups");
$wgPopupsBetaFeature=true;
//Enable Popups by default
$wgPopupsOptInDefaultState="1";

/*Renameuser*/
wfLoadExtension("Renameuser");
//Owner (owner)
$wgGroupPermissions["owner"]["renameuser"]=true;

/*StaffPowers*/
wfLoadExtension("StaffPowers");
//Disable ShoutWiki specific message
$wgStaffPowersShoutWikiMessages=false;
//Users in this group cannot be blocked by other users except by users that have unblockable permission
$wgStaffPowersStewardGroupName="staff";
//Staffs (staff)
$wgGroupPermissions["staff"]["unblockable"]=false;
//Administrators (admin)
$wgGroupPermissions["admin"]["unblockable"]=true;

/*TitleBlacklist*/
wfLoadExtension("TitleBlacklist");
//*
$wgGroupPermissions["*"]["titleblacklistlog"]=true;
//Administrators (admin)
$wgGroupPermissions["admin"]["tboverride"]=true;

/*TorBlock*/
wfLoadExtension("TorBlock");
$wgTorAllowedActions=array();
//Users (user)
$wgGroupPermissions["user"]["torunblocked"]=false;
//Owner (owner)
$wgGroupPermissions["owner"]["torunblocked"]=true;

/*UserMerge*/
wfLoadExtension("UserMerge");
//Prevent merging users in these groups
$wgUserMergeProtectedGroups=array("admin","owner");
//Owner (owner)
$wgGroupPermissions["owner"]["usermerge"]=true;

/*UserPageEditProtection*/
include_once("$IP/extensions/UserPageEditProtection/UserPageEditProtection.php");
$wgOnlyUserEditUserPage=true;
//Staffs (staff)
$wgGroupPermissions["staff"]["editalluserpages"]=true;

/*Other extensions*/
wfLoadExtensions(array("Cite","CodeEditor","CodeMirror","Highlightjs_Integration","InputBox","Josa","MultimediaViewer","TextExtracts","TwoColConflict","WikiEditor"));

#Skins
/*Default skin*/
$wgDefaultSkin="Vector";

/*Liberty*/
wfLoadSkin("Liberty");
//Color for navbar and address bar in some mobile browsers
$wgLibertyMainColor="#9933ff";
$wgTwitterAccount="pseol2190";

/*Vector*/
wfLoadSkin("Vector");
$wgVectorResponsive=true;

/*Other skins*/
wfLoadSkin("Timeless");

#Email
/*Disable email functions*/
$wgEnableEmail=false;

#System
/*Server*/
//Base URL of the server
//$wgServer="http://exit.nerdpol.ovh:81";

/*Entry point*/
//Short URL
$wgArticlePath="/page/$1";
$wgUsePathInfo=true;
$actions=["delete","edit","history","protect","purge","submit","unprotect"]
foreach ($actions as $action)
{$wgActionPaths[$action]="/$action/$1";}

/*Open external links in a new tab*/
$wgExternalLinkTarget="_blank";

/*Authentication token*/
//Changing this will log out all existing sessions
$wgAuthenticationTokenVersion="0";

/*Cache*/
//Object cache
$wgMainCacheType=CACHE_ACCEL; //PHP object caching
//Cache directory
$wgCacheDirectory="$IP/cache";
//Store localisation cache as PHP array
$wgLocalisationCacheConf["store"]="array";
//File cache
$wgUseFileCache=true;
$wgFileCacheDirectory=$wgCacheDirectory;

/*Job*/
//Run 2 jobs per request
$wgJobRunRate=2;

/*Diff3*/ //windows_only
//Path to Diff3 //windows_only
$wgDiff3="C:/Program Files (x86)/GnuWin32/bin/diff3.exe"; //windows_only

/*ImageMagick*/ //linux_only
//Enable ImageMagick //linux_only
$wgUseImageMagick=true; //linux_only

/*Database*/
//Database type
$wgDBtype="sqlite";
//Database name
$wgDBname="database";

//SQLite database directory
$wgSQLiteDataDir="C:/nginx/data/PlavorEXITBeta"; //windows_only
$wgSQLiteDataDir="/web_data/PlavorEXITBeta"; //linux_only

/*Private settings*/
include_once("C:/nginx/data/PlavorEXITBeta/PrivateSettings.php"); //windows_only
include_once("/web_data/PlavorEXITBeta/PrivateSettings.php"); //linux_only

#----
/*Remove groups*/
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["bot"]);
unset($wgGroupPermissions["bureaucrat"]);
unset($wgGroupPermissions["sysop"]);};
//*/

/*Temporary groups
$wgGroupPermissions["*"]["userrights"]=true;
$wgGroupPermissions["bureaucrat"]["read"]=true;
$wgGroupPermissions["interface-admin"]["read"]=true;
$wgGroupPermissions["sysop"]["read"]=true;
//*/

/*Inherit permissions*/
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["owner"]+=$wgGroupPermissions["admin"];
