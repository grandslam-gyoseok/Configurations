<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##Extensions

/*AbuseFilter*/
wfLoadExtension("AbuseFilter");
$wgAbuseFilterActions=
["disallow"=>true,
"warn"=>true];
//$wgAbuseFilterCentralDB="global_abusefilter";
$wgAbuseFilterNotifications="rcandudp";
$wgAbuseFilterNotificationsPrivate=$wgAbuseFilterNotifications;
//Permissions
$wgGroupPermissions=array_merge_recursive($wgGroupPermissions,
["*"=>
  ["abusefilter-log"=>false],
"steward"=>
  ["abusefilter-hide-log"=>true,
  "abusefilter-hidden-log"=>true,
  "abusefilter-log"=>true,
  "abusefilter-log-detail"=>true,
  "abusefilter-log-private"=>true,
  "abusefilter-modify"=>true,
  "abusefilter-modify-global"=>true,
  "abusefilter-modify-restricted"=>true,
  "abusefilter-private"=>true,
  "abusefilter-private-log"=>true,
  "abusefilter-revert"=>true,
  "abusefilter-view-private"=>true]
]);

/*AccountInfo*/
if ($extension_enable_AccountInfo)
{wfLoadExtension("AccountInfo");}

/*AntiSpoof*/
wfLoadExtension("AntiSpoof");
//$wgSharedTables[]="spoofuser";

/*CentralNotice*/
//wfLoadExtension("CentralNotice"); //Disabled due to low speed of wiki
$wgCentralHost="//exit.plavormind.tk:81";
$wgNoticeInfrastructure=false;
$wgNoticeProject=$wiki_id;
$wgNoticeProjects=["exit"];

//Must be after $wgCentralHost
$wgCentralBannerRecorder="{$wgCentralHost}/page/Special:RecordImpression";
$wgCentralNoticeApiUrl="{$wgCentralHost}/mediawiki/api.php";
$wgCentralSelectedBannerDispatcher="{$wgCentralHost}/page/Special:BannerLoader";

/*ChangeAuthor*/
wfLoadExtension("ChangeAuthor");
//Permissions
$wgGroupPermissions["steward"]["changeauthor"]=true;

/*CheckUser*/
wfLoadExtension("CheckUser");
$wgCheckUserCIDRLimit=$wgBlockCIDRLimit;
$wgCheckUserMaxBlocks=100;
//Permissions
$wgGroupPermissions["steward"]["checkuser"]=true;
$wgGroupPermissions["steward"]["checkuser-log"]=true;
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["checkuser"]);};

/*Cite*/
if ($extension_enable_Cite)
{wfLoadExtension("Cite");}

/*CodeEditor*/
if ($extension_enable_CodeEditor&&$extension_enable_WikiEditor)
{wfLoadExtension("CodeEditor");}

/*ConfirmEdit*/
wfLoadExtension("ConfirmEdit");
$wgCaptchaTriggers["create"]=true;
$wgCaptchaTriggers["edit"]=true;
$wgCaptchaTriggersOnNamespace=
[NS_USER=>
  ["create"=>false,
  "edit"=>false]
];
//Permissions
$wgGroupPermissions["autoconfirmed"]["skipcaptcha"]=true;

/*DeletePagesForGood*/
wfLoadExtension("DeletePagesForGood");
$wgDeletePagesForGoodNamespaces[NS_FILE]=false;
//Permissions
$wgGroupPermissions["eliminator"]["deleteperm"]=true;

/*GlobalUserPage*/
//wfLoadExtension("GlobalUserPage"); //Disabled due to low speed of wiki
$wgGlobalUserPageAPIUrl="//exit.plavormind.tk:81/mediawiki/api.php";
$wgGlobalUserPageCacheExpiry=60;
$wgGlobalUserPageDBname="wiki_{$central_wiki}";

/*Highlightjs_Integration*/
if (PHP_OS_FAMILY=="Windows")
{wfLoadExtension("Highlightjs_Integration");}

/*MinimumNameLength*/
wfLoadExtension("MinimumNameLength");
//Only detects alphanumeric names
$wgMinimumUsernameLength=4;

/*MultimediaViewer*/
if ($extension_enable_MultimediaViewer)
{wfLoadExtension("MultimediaViewer");
$wgMediaViewerUseThumbnailGuessing=true;}

/*Nuke*/
wfLoadExtension("Nuke");
//Permissions
$wgGroupPermissions["bureaucrat"]["nuke"]=true;

/*PageImages*/
wfLoadExtension("PageImages");
$wgPageImagesBlacklistExpiry=60; //1 minute
$wgPageImagesExpandOpenSearchXml=true;
$wgPageImagesNamespaces=[NS_CATEGORY,NS_HELP,NS_MAIN,NS_PROJECT,NS_USER];

/*Popups*/
if ($extension_enable_Popups)
{wfLoadExtension("Popups");
$wgPopupsOptInDefaultState="1";
$wgPopupsHideOptInOnPreferencesPage=true;}

/*Renameuser*/
wfLoadExtension("Renameuser");
//Permissions
$wgGroupPermissions["bureaucrat"]["renameuser"]=false;
$wgGroupPermissions["steward"]["renameuser"]=true;

/*SimpleMathJax*/
if ($extension_enable_SimpleMathJax)
{wfLoadExtension("SimpleMathJax");}

/*StaffPowers*/
wfLoadExtension("StaffPowers");
$wgStaffPowersShoutWikiMessages=false;
$wgStaffPowersStewardGroupName="staff";
//Permissions
$wgGroupPermissions["staff"]["unblockable"]=false;
$wgGroupPermissions["admin"]["unblockable"]=true;

/*SyntaxHighlight_GeSHi*/
if (PHP_OS_FAMILY=="Linux")
{wfLoadExtension("SyntaxHighlight_GeSHi");}

/*TextExtracts*/
wfLoadExtension("TextExtracts");
$wgExtractsExtendOpenSearchXml=true;

/*TitleBlacklist*/
wfLoadExtension("TitleBlacklist");
//Permissions
$wgGroupPermissions["steward"]["tboverride"]=true;
$wgGroupPermissions["steward"]["titleblacklistlog"]=true;

/*TwoColConflict*/
if ($extension_enable_TwoColConflict)
{wfLoadExtension("TwoColConflict");}

/*UserMerge*/
wfLoadExtension("UserMerge");
$wgUserMergeProtectedGroups=["admin","bureaucrat","steward"];
//Permissions
$wgGroupPermissions["steward"]["usermerge"]=true;

/*UserPageEditProtection*/
if ($extension_enable_UserPageEditProtection)
{include_once("{$wgExtensionDirectory}/UserPageEditProtection/UserPageEditProtection.php");
$wgOnlyUserEditUserPage=true;
//Permissions
$wgGroupPermissions["staff"]["editalluserpages"]=true;}

/*WikiEditor*/
if ($extension_enable_WikiEditor)
{wfLoadExtension("WikiEditor");}

/*Other extensions*/
wfLoadExtension("PlavorMindTweaks");

##Skins

/*Liberty*/
wfLoadSkin("Liberty");
$wgLibertyMainColor="#9933ff";
$wgTwitterAccount="PlavorSeol";

/*Vector*/
wfLoadSkin("Vector");
$wgVectorResponsive=true;

/*Other skins*/
wfLoadSkins(["PlavorMindView","Timeless"]);
?>
