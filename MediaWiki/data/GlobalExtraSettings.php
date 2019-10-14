<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

#Extensions

/*AbuseFilter
//Requires update.php
//Disabled due to conflict with global accounts
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
*/

/*AlwaysBlueCategory*/
if ($wmgExtensionAlwaysBlueCategory)
{wfLoadExtension("AlwaysBlueCategory");}

/*AntiSpoof*/
//Requires update.php
wfLoadExtension("AntiSpoof");
if ($wmgGlobalAccountMode=="shared-database")
{$wgSharedTables[]="spoofuser";}
//Permissions
$wgGroupPermissions["bureaucrat"]["override-antispoof"]=false;
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]["override-antispoof"]=true;}

/*Babel*/
//Requires update.php
if ($wmgExtensionBabel)
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

/*CentralAuth*/
//Requires update.php
if ($wmgGlobalAccountMode=="centralauth")
{wfLoadExtension("CentralAuth");
$wgCentralAuthAutoMigrate=true;
$wgCentralAuthAutoMigrateNonGlobalAccounts=true;
$wgCentralAuthCookieDomain=".plavormind.tk";
$wgCentralAuthCookies=true;
$wgCentralAuthCreateOnView=true;
$wgCentralAuthDatabase="wiki_centralauth";
$wgCentralAuthEnableUserMerge=true;
$wgCentralAuthPreventUnattached=true;
$wgDisableUnmergedEditing=true;
//Permissions
$wgGroupPermissions["steward"]["centralauth-lock"]=false;
$wgGroupPermissions["steward"]["centralauth-oversight"]=false;
$wgGroupPermissions["steward"]["centralauth-unmerge"]=false;}

/*CentralNotice
//Disabled due to low speed of wiki
wfLoadExtension("CentralNotice");
$wgCentralHost="//{$wmgCentralWiki}.plavormind.tk:81";
$wgNoticeInfrastructure=false;
$wgNoticeProject=$wmgWiki;
$wgNoticeProjects=["exit"];

//Must be after $wgCentralHost
$wgCentralBannerRecorder="{$wgCentralHost}/page/Special:RecordImpression";
$wgCentralNoticeApiUrl="{$wgCentralHost}/mediawiki/api.php";
$wgCentralSelectedBannerDispatcher="{$wgCentralHost}/page/Special:BannerLoader";
*/

/*ChangeAuthor*/
wfLoadExtension("ChangeAuthor");
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]["changeauthor"]=true;}

/*CheckUser*/
//Requires update.php
wfLoadExtension("CheckUser");
$wgCheckUserCAMultiLock=
["centralDB"=>$wmgCentralWiki."wiki",
"groups"=>
  ["steward"]
];
$wgCheckUserCAtoollink=$wmgCentralWiki."wiki";
$wgCheckUserCIDRLimit=$wgBlockCIDRLimit;
$wgCheckUserForceSummary=true;
$wgCheckUserGBtoollink=
["centralDB"=>$wmgCentralWiki."wiki",
"groups"=>
  ["steward"]
];
$wgCheckUserLogLogins=true;
$wgCheckUserMaxBlocks=100;
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]["checkuser"]=true;
$wgGroupPermissions["steward"]["checkuser-log"]=true;}
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["checkuser"]);};

/*Cite*/
if ($wmgExtensionCite)
{wfLoadExtension("Cite");}

/*CodeEditor*/
if ($wmgExtensionCodeEditor&&$wmgExtensionWikiEditor)
{wfLoadExtension("CodeEditor");}

/*CodeMirror*/
if ($wmgExtensionCodeMirror)
{wfLoadExtension("CodeMirror");}

/*CollapsibleVector*/
if ($wmgExtensionCollapsibleVector)
{wfLoadExtension("CollapsibleVector");}

/*CommonsMetadata*/
if ($wmgExtensionCommonsMetadata)
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
if ($wmgExtensionDeletePagesForGood)
{wfLoadExtension("DeletePagesForGood");
$wgDeletePagesForGoodNamespaces[NS_FILE]=false;
$wgPlavorBumaTabIcons["delete_page_permanently"]="fas fa-trash-alt";
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["deleteperm"]=true;}
}

/*DiscordNotifications*/
wfLoadExtension("DiscordNotifications");
if ($wgCommandLineMode)
{$wgDiscordFromName="{$wgSitename} ({$wmgWiki}) @ PlavorMind";}
else
{$wgDiscordFromName="{$wgSitename} ({$_SERVER["HTTP_HOST"]}) @ PlavorMind";}
$wgWikiUrl="{$wgServer}/";
$wgWikiUrlEnding="mediawiki/index.php?title=";
$wgWikiUrlEndingUserRights="Special:UserRights/";

/*Echo
//Requires update.php
//Disabled due to not working dismiss function
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
*/

/*Flow*/
//Requires update.php
if ($wmgExtensionFlow)
{wfLoadExtension("Flow");
$wgFlowCacheTime=$wmgCacheExpiry;
$wgFlowCoreActionWhitelist[]="delete_page_permanently";
$wgFlowEditorList=["wikitext"];
$wgFlowMaxMentionCount=10;
$wgFlowSearchEnabled=true;
//Exclude MediaWiki talk namespace
//array_merge should not be used due to a bug
$wgNamespaceContentModels[NS_CATEGORY_TALK]="flow-board";
$wgNamespaceContentModels[NS_FILE_TALK]="flow-board";
$wgNamespaceContentModels[NS_HELP_TALK]="flow-board";
$wgNamespaceContentModels[NS_PROJECT_TALK]="flow-board";
$wgNamespaceContentModels[NS_TALK]="flow-board";
$wgNamespaceContentModels[NS_TEMPLATE_TALK]="flow-board";
$wgNamespaceContentModels[NS_USER_TALK]="flow-board";
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
  ["flow-delete"=>true]
]);
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["flow-create-board"]=true;
  $wgGroupPermissions["steward"]["flow-suppress"]=true;}
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
  {unset($wgGroupPermissions["flow-bot"]);
  unset($wgGroupPermissions["suppress"]);};
}

/*GlobalBlocking*/
if ($wmgGlobalAccountMode!="")
{wfLoadExtension("GlobalBlocking");
$wgGlobalBlockingDatabase="wiki_globalblocking";
//Permissions
$wgGroupPermissions["steward"]["globalblock"]=false;
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["globalblock-exempt"]=true;}
}

/*GlobalUserPage*/
if ($wmgGlobalAccountMode!="")
wfLoadExtension("GlobalUserPage");
{$wgGlobalUserPageAPIUrl="//{$wmgCentralWiki}.plavormind.tk:81{$wgScriptPath}/api.php";
$wgGlobalUserPageCacheExpiry=60;
$wgGlobalUserPageDBname="{$wmgCentralWiki}wiki";}

/*Highlightjs_Integration*/
if (PHP_OS_FAMILY=="Windows"&&$wmgExtensionHighlightjs_Integration)
{wfLoadExtension("Highlightjs_Integration");}

/*Interwiki*/
wfLoadExtension("Interwiki");
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]["interwiki"]=true;}

/*MinimumNameLength*/
wfLoadExtension("MinimumNameLength");
//Only detects alphanumeric names
$wgMinimumUsernameLength=3;

/*MultimediaViewer*/
if ($wmgExtensionMultimediaViewer)
{wfLoadExtension("MultimediaViewer");
$wgMediaViewerUseThumbnailGuessing=true;}

/*Nuke*/
if ($wmgExtensionNuke)
{wfLoadExtension("Nuke");
//Permissions
$wgGroupPermissions["bureaucrat"]["nuke"]=true;}

/*PageImages*/
if ($wmgExtensionPageImages)
{wfLoadExtension("PageImages");
$wgPageImagesBlacklistExpiry=60; //1 minute
$wgPageImagesExpandOpenSearchXml=true;
$wgPageImagesNamespaces=[NS_CATEGORY,NS_HELP,NS_MAIN,NS_PROJECT,NS_USER];}

/*ParserFunctions*/
if ($wmgExtensionParserFunctions)
{wfLoadExtension("ParserFunctions");
$wgPFEnableStringFunctions=true;}

/*PerformanceInspector*/
if ($wmgExtensionPerformanceInspector)
{wfLoadExtension("PerformanceInspector");
$wgDefaultUserOptions["performanceinspector"]=true;}

/*PlavorMindTools*/
wfLoadExtension("PlavorMindTools");
//Permissions
$wgAddGroups=array_merge_recursive($wgAddGroups,
["admin"=>
  ["protectedpageeditor"],
"bureaucrat"=>
  ["protectedpageeditor"]
]);
$wgRemoveGroups=array_merge_recursive($wgRemoveGroups,
["admin"=>
  ["protectedpageeditor"],
"bureaucrat"=>
  ["protectedpageeditor"]
]);

/*Popups*/
if ($wmgExtensionPageImages&&$wmgExtensionPopups&&$wmgExtensionTextExtracts)
{wfLoadExtension("Popups");
$wgPopupsOptInDefaultState="1";
$wgPopupsHideOptInOnPreferencesPage=true;}

/*Renameuser*/
if ($wmgExtensionRenameuser)
{wfLoadExtension("Renameuser");
//Permissions
$wgGroupPermissions["bureaucrat"]["renameuser"]=false;
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["renameuser"]=true;}
}

/*ReplaceText*/
if ($wmgExtensionReplaceText)
{wfLoadExtension("ReplaceText");
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["replacetext"]=true;}
}

/*SecurePoll*/
//Requires update.php
if ($wmgExtensionSecurePoll)
{wfLoadExtension("SecurePoll");
//Permissions
$wgGroupPermissions["bureaucrat"]["securepoll-create-poll"]=true;}

/*SimpleMathJax*/
if ($wmgExtensionSimpleMathJax)
{wfLoadExtension("SimpleMathJax");}

/*StaffPowers*/
wfLoadExtension("StaffPowers");
$wgStaffPowersShoutWikiMessages=false;
$wgStaffPowersStewardGroupName="staff";
//Permissions
$wgGroupPermissions["staff"]["unblockable"]=false;
$wgGroupPermissions["admin"]["unblockable"]=true;

/*StalkerLog*/
//Requires update.php
include_once("{$wgExtensionDirectory}/StalkerLog/StalkerLog.php");

/*SyntaxHighlight_GeSHi*/
if (PHP_OS_FAMILY=="Linux"&&$wmgExtensionSyntaxHighlight_GeSHi)
{wfLoadExtension("SyntaxHighlight_GeSHi");}

/*TemplateData*/
if ($wmgExtensionTemplateData)
{wfLoadExtension("TemplateData");}

/*TemplateWizard*/
if ($wmgExtensionTemplateData&&$wmgExtensionTemplateWizard&&$wmgExtensionWikiEditor)
{wfLoadExtension("TemplateWizard");}

/*TextExtracts*/
if ($wmgExtensionTextExtracts)
{wfLoadExtension("TextExtracts");
$wgExtractsExtendOpenSearchXml=true;}

/*TitleBlacklist*/
wfLoadExtension("TitleBlacklist");
$wgTitleBlacklistSources=
["global"=>
  ["src"=>"{$wmgPrivateDataDirectory}/titleblacklist.txt",
  "type"=>"file"]
];
if ($wmgGlobalAccountMode!="")
{$wgTitleBlacklistUsernameSources=["global"];}
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]["tboverride"]=true;
//$wgGroupPermissions["steward"]["tboverride-account"]=true; //Disabled for test
$wgGroupPermissions["steward"]["titleblacklistlog"]=true;}

/*TwoColConflict*/
if ($wmgExtensionTwoColConflict)
{wfLoadExtension("TwoColConflict");}

/*UserMerge*/
if ($wmgGlobalAccountMode!="shared-database")
{wfLoadExtension("UserMerge");
//Remove default value ("sysop")
$wgUserMergeProtectedGroups=[];
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["usermerge"]=true;}
}

/*UserPageEditProtection*/
//Add "$wgOnlyUserEditUserPage=true;" to enable this extension.
include_once("{$wgExtensionDirectory}/UserPageEditProtection/UserPageEditProtection.php");
//Permissions
$wgGroupPermissions["staff"]["editalluserpages"]=true;
$wgGroupPermissions["protectedpageeditor"]["editalluserpages"]=true;

/*WikiEditor*/
if ($wmgExtensionWikiEditor)
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
wfLoadSkins(["PlavorBuma","Timeless"]);
?>
