<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##Extensions

/*AbuseFilter*/
//Requires update.php
wfLoadExtension("AbuseFilter");
$wgAbuseFilterActions=
["block"=>false,
"blockautopromote"=>false,
"degroup"=>false,
"disallow"=>true,
"flag"=>false,
"rangeblock"=>false,
"tag"=>false,
"throttle"=>false,
"warn"=>true];
//$wgAbuseFilterCentralDB="global_abusefilter";
$wgAbuseFilterNotifications="rcandudp";
$wgAbuseFilterNotificationsPrivate=$wgAbuseFilterNotifications;
$wgAbuseFilterRestrictions=
["blockautopromote"=>true,
"degroup"=>true];
//Permissions
$wgGroupPermissions=array_merge_recursive($wgGroupPermissions,
["bureaucrat"=>
  ["abusefilter-log-detail"=>true,
  "abusefilter-modify"=>true],
"steward"=>
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
//Requires update.php
wfLoadExtension("AntiSpoof");
//$wgSharedTables[]="spoofuser";
//Permissions
$wgGroupPermissions["bureaucrat"]["override-antispoof"]=false;
$wgGroupPermissions["steward"]["override-antispoof"]=true;

/*Babel*/
if ($extension_Babel||$wgCommandLineMode)
{wfLoadExtension("Babel");
$wgBabelCategoryNames=
["0"=>false,
"1"=>false,
"2"=>false,
"3"=>false,
"4"=>false,
"5"=>false,
"N"=>false];
$wgBabelMainCategory=false;
$wgBabelUseUserLanguage=true;}

/*CentralNotice
//Disabled due to low speed of wiki
wfLoadExtension("CentralNotice");
$wgCentralHost="//{$central_wiki}.plavormind.tk:81";
$wgNoticeInfrastructure=false;
$wgNoticeProject=$wiki_id;
$wgNoticeProjects=["exit"];

//Must be after $wgCentralHost
$wgCentralBannerRecorder="{$wgCentralHost}/page/Special:RecordImpression";
$wgCentralNoticeApiUrl="{$wgCentralHost}/mediawiki/api.php";
$wgCentralSelectedBannerDispatcher="{$wgCentralHost}/page/Special:BannerLoader";
*/

/*ChangeAuthor*/
wfLoadExtension("ChangeAuthor");
//Permissions
$wgGroupPermissions["steward"]["changeauthor"]=true;

/*CheckUser*/
//Requires update.php
wfLoadExtension("CheckUser");
$wgCheckUserCIDRLimit=$wgBlockCIDRLimit;
$wgCheckUserMaxBlocks=100;
//Permissions
$wgGroupPermissions["steward"]["checkuser"]=true;
$wgGroupPermissions["steward"]["checkuser-log"]=true;
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["checkuser"]);};

/*Cite*/
if ($extension_Cite)
{wfLoadExtension("Cite");}

/*CodeEditor*/
if ($extension_CodeEditor&&$extension_WikiEditor)
{wfLoadExtension("CodeEditor");}

/*CodeMirror*/
if ($extension_CodeMirror)
{wfLoadExtension("CodeMirror");}

/*CollapsibleVector*/
if ($extension_CollapsibleVector)
{wfLoadExtension("CollapsibleVector");}

/*CommonsMetadata*/
if ($extension_CommonsMetadata)
{wfLoadExtension("CommonsMetadata");}

/*ConfirmEdit*/
wfLoadExtension("ConfirmEdit");
$wgCaptchaBadLoginExpiration=60*60; //1 hour
$wgCaptchaTriggers["create"]=true;
$wgCaptchaTriggersOnNamespace=
[NS_USER=>
  ["create"=>false],
NS_FILE=>
  ["edit"=>true]
];
//Permissions
$wgGroupPermissions["autoconfirmed"]["skipcaptcha"]=true;

/*DeletePagesForGood*/
if ($extension_DeletePagesForGood)
{wfLoadExtension("DeletePagesForGood");
$wgDeletePagesForGoodNamespaces[NS_FILE]=false;
$wgPlavorBumaTabIcons["delete_page_permanently"]="fas fa-trash-alt";
//Permissions
$wgGroupPermissions["steward"]["deleteperm"]=true;}

/*DiscordNotifications*/
wfLoadExtension("DiscordNotifications");
$wgDiscordFromName="{$wgSitename} ({$_SERVER["HTTP_HOST"]}) @ PlavorMind";
$wgDiscordSendMethod="file_get_contents";
$wgWikiUrl="{$wgServer}/";
$wgWikiUrlEnding="mediawiki/index.php?title=";
$wgWikiUrlEndingUserRights="Special:UserRights/";

/*Echo*/
//Requires update.php
wfLoadExtension("Echo");
$wgDefaultUserOptions=array_merge($wgDefaultUserOptions,
["echo-email-frequency"=>-1,
"echo-subscriptions-email-user-rights"=>false,
"echo-subscriptions-web-thank-you-edit"=>false]);
$wgEchoMentionStatusNotifications=true;
$wgEchoPerUserBlacklist=true;
$wgNotifyTypeAvailabilityByCategory=
["article-linked"=>
  ["email"=>true],
"mention-failure"=>
  ["email"=>true],
"mention-success"=>
  ["email"=>true],
"thank-you-edit"=>
  ["email"=>true]
];

/*Flow*/
//Requires update.php
if ($extension_Flow)
{//DRAFT
//Exclude MediaWiki talk namespace
$wgNamespaceContentModels=array_merge($wgNamespaceContentModels,
[NS_CATEGORY_TALK=>"flow-board",
NS_FILE_TALK=>"flow-board",
NS_HELP_TALK=>"flow-board",
NS_PROJECT_TALK=>"flow-board",
NS_TALK=>"flow-board",
NS_TEMPLATE_TALK=>"flow-board",
NS_USER_TALK=>"flow-board"]);
$wgFlowCacheTime=60; //1 minute
$wgFlowEditorList=["wikitext"];
$wgFlowMaxMentionCount=10;
$wgFlowSearchEnabled=true;
//Permissions
$wgGroupPermissions=array_merge_recursive($wgGroupPermissions,
["*"=>
  ["flow-hide"=>false],
"user"=>
  ["flow-lock"=>false],
"staff"=>
  ["flow-edit-post"=>true,
  "flow-hide"=>true,
  "flow-lock"=>true],
"admin"=>
  ["flow-delete"=>true],
"steward"=>
  ["flow-create-board"=>true,
  "flow-suppress"=>true]
]);}

/*GlobalUserPage
//Disabled due to low speed of wiki
//wfLoadExtension("GlobalUserPage");
$wgGlobalUserPageAPIUrl="//{$central_wiki}.plavormind.tk:81/mediawiki/api.php";
$wgGlobalUserPageCacheExpiry=60;
$wgGlobalUserPageDBname="{$central_wiki}_wiki";
*/

/*Highlightjs_Integration*/
if (PHP_OS_FAMILY=="Windows"&&$extension_Highlightjs_Integration)
{wfLoadExtension("Highlightjs_Integration");}

/*MinimumNameLength*/
wfLoadExtension("MinimumNameLength");
//Only detects alphanumeric names
$wgMinimumUsernameLength=3;

/*MultimediaViewer*/
if ($extension_MultimediaViewer)
{wfLoadExtension("MultimediaViewer");
$wgMediaViewerUseThumbnailGuessing=true;}

/*Nuke*/
if ($extension_Nuke)
{wfLoadExtension("Nuke");
//Permissions
$wgGroupPermissions["bureaucrat"]["nuke"]=true;}

/*PageImages*/
if ($extension_PageImages)
{wfLoadExtension("PageImages");
$wgPageImagesBlacklistExpiry=60; //1 minute
$wgPageImagesExpandOpenSearchXml=true;
$wgPageImagesNamespaces=[NS_CATEGORY,NS_HELP,NS_MAIN,NS_PROJECT,NS_USER];}

/*PerformanceInspector*/
if ($extension_PerformanceInspector)
{wfLoadExtension("PerformanceInspector");
$wgDefaultUserOptions["performanceinspector"]=true;}

/*PlavorMindTools*/
wfLoadExtension("PlavorMindTools");
$wgPMTReplaceMsgForPlavorMind=true;

/*Popups*/
if ($extension_PageImages&&$extension_Popups&&$extension_TextExtracts)
{wfLoadExtension("Popups");
$wgPopupsOptInDefaultState="1";
$wgPopupsHideOptInOnPreferencesPage=true;}

/*Renameuser*/
wfLoadExtension("Renameuser");
//Permissions
$wgGroupPermissions["bureaucrat"]["renameuser"]=false;
$wgGroupPermissions["steward"]["renameuser"]=true;

/*SimpleMathJax*/
if ($extension_SimpleMathJax)
{wfLoadExtension("SimpleMathJax");}

/*StaffPowers*/
wfLoadExtension("StaffPowers");
$wgStaffPowersShoutWikiMessages=false;
$wgStaffPowersStewardGroupName="staff";
//Permissions
$wgGroupPermissions["staff"]["unblockable"]=false;
$wgGroupPermissions["admin"]["unblockable"]=true;

/*SyntaxHighlight_GeSHi*/
if (PHP_OS_FAMILY=="Linux"&&$extension_SyntaxHighlight_GeSHi)
{wfLoadExtension("SyntaxHighlight_GeSHi");}

/*TemplateData*/
if ($extension_TemplateData)
{wfLoadExtension("TemplateData");}

/*TextExtracts*/
if ($extension_TextExtracts)
{wfLoadExtension("TextExtracts");
$wgExtractsExtendOpenSearchXml=true;}

/*TitleBlacklist*/
wfLoadExtension("TitleBlacklist");
//Permissions
$wgGroupPermissions["steward"]["tboverride"]=true;
$wgGroupPermissions["steward"]["titleblacklistlog"]=true;

/*TwoColConflict*/
if ($extension_TwoColConflict)
{wfLoadExtension("TwoColConflict");}

/*UserMerge*/
wfLoadExtension("UserMerge");
$wgUserMergeProtectedGroups=["admin","bureaucrat","steward"];
//Permissions
$wgGroupPermissions["steward"]["usermerge"]=true;

/*UserPageEditProtection*/
//Add "$wgOnlyUserEditUserPage=true;" to enable this extension.
include_once("{$wgExtensionDirectory}/UserPageEditProtection/UserPageEditProtection.php");
//Permissions
$wgGroupPermissions["staff"]["editalluserpages"]=true;

/*WikiEditor*/
if ($extension_WikiEditor)
{wfLoadExtension("WikiEditor");}

##Skins

/*Liberty*/
wfLoadSkin("Liberty");
$wgLibertyMainColor="#9933ff";
$wgTwitterAccount="PlavorSeol";

/*Vector*/
wfLoadSkin("Vector");
$wgVectorResponsive=true;

/*Other skins*/
wfLoadSkin("Timeless");
?>
