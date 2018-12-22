<?php
//Prevent web access
if (!defined("MEDIAWIKI"))
{http_response_code(403);
$host=$_SERVER["HTTP_HOST"];
header("Location: //{$host}/error/403.html");
exit;}

#Extensions

/*AbuseFilter*/
wfLoadExtension("AbuseFilter");
//Send abuse filter trigger notifications to Special:RecentChanges page and UDP
$wgAbuseFilterNotifications="rcandudp";
//Enable notifications for private filters
$wgAbuseFilterNotificationsPrivate=true;
//Permissions
$wgGroupPermissions=array_merge_recursive($wgGroupPermissions,
["*"=>
  ["abusefilter-log-detail"=>true],
"supervisor"=> //Bureaucrats
  ["abusefilter-hide-log"=>true,
  "abusefilter-hidden-log"=>true,
  "abusefilter-log-private"=>true,
  "abusefilter-modify"=>true,
  "abusefilter-modify-global"=>true,
  "abusefilter-modify-restricted"=>true,
  "abusefilter-private"=>true,
  "abusefilter-private-log"=>true,
  "abusefilter-revert"=>true,
  "abusefilter-view-private"=>true]
]);

/*AntiSpoof*/
wfLoadExtension("AntiSpoof");
//Bureaucrats (supervisor)
$wgGroupPermissions["supervisor"]["override-antispoof"]=true;

/*CheckUser*/
wfLoadExtension("CheckUser");
$wgCheckUserCIDRLimit=$wgBlockCIDRLimit;
//*
$wgGroupPermissions["*"]["checkuser-log"]=true;
//Bureaucrats (supervisor)
$wgGroupPermissions["supervisor"]["checkuser"]=true;
//checkuser
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["checkuser"]);};

/*ConfirmEdit*/
wfLoadExtension("ConfirmEdit");
$wgCaptchaClass="SimpleCaptcha";
$wgCaptchaTriggers["create"]=true;
$wgCaptchaTriggers["edit"]=true;
$wgCaptchaTriggersOnNamespace[NS_USER]["create"]=false;
$wgCaptchaTriggersOnNamespace[NS_USER]["edit"]=false;
$wgCaptchaBadLoginExpiration=60*5;
//Autoconfirmed users (autoconfirmed)
$wgGroupPermissions["autoconfirmed"]["skipcaptcha"]=true;

/*DeletePagesForGood*/
wfLoadExtension("DeletePagesForGood");
//Bureaucrats (supervisor)
$wgGroupPermissions["supervisor"]["deleteperm"]=true;

/*DeleteUserPages*/
wfLoadExtension("DeleteUserPages");
//Users (user)
$wgGroupPermissions["user"]["delete-rootuserpages"]=true;
$wgGroupPermissions["user"]["delete-usersubpages"]=true;

/*Echo
wfLoadExtension("Echo");
$wgEchoEnableEmailBatch=false;
$wgEchoPerUserBlacklist=true;
*/

/*Interwiki
wfLoadExtension("Interwiki");
//Enable interwiki transcluding
$wgEnableScaryTranscluding=true;
//Expiry time for interwiki transclusion cache
$wgTranscludeCacheExpiry=60;
//Bureaucrats (supervisor)
$wgGroupPermissions["supervisor"]["interwiki"]=true;
*/

/*Nuke*/
wfLoadExtension("Nuke");
//Bureaucrats (supervisor)
$wgGroupPermissions["supervisor"]["nuke"]=true;

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
//Bureaucrats (supervisor)
$wgGroupPermissions["supervisor"]["renameuser"]=true;

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
$wgTitleBlacklistLogHits=true;
//*
$wgGroupPermissions["*"]["titleblacklistlog"]=true;
//Bureaucrats (supervisor)
$wgGroupPermissions["supervisor"]["tboverride"]=true;

/*TorBlock*/
wfLoadExtension("TorBlock");
$wgTorAllowedActions=[];
//Users (user)
$wgGroupPermissions["user"]["torunblocked"]=false;
//Bureaucrats (supervisor)
$wgGroupPermissions["supervisor"]["torunblocked"]=true;

/*UserMerge*/
wfLoadExtension("UserMerge");
//Prevent merging users in these groups
$wgUserMergeProtectedGroups=["staff","admin","supervisor"/*,"root"*/];
//Bureaucrats (supervisor)
$wgGroupPermissions["supervisor"]["usermerge"]=true;

/*UserPageEditProtection*/
include_once("{$wgExtensionDirectory}/UserPageEditProtection/UserPageEditProtection.php");
$wgOnlyUserEditUserPage=true;
//Staffs (staff)
$wgGroupPermissions["staff"]["editalluserpages"]=true;

/*Other extensions*/
wfLoadExtensions(
["Cite",
"CodeEditor",
"CodeMirror",
"Highlightjs_Integration",
"InputBox",
"Josa",
"MultimediaViewer",
"PlavorMindTweaks",
"TextExtracts",
"TwoColConflict",
"WikiEditor"]);

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
