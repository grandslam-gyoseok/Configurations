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
//$wgAbuseFilterCentralDB="wiki_abusefilter";
$wgAbuseFilterNotifications="rcandudp";
$wgAbuseFilterNotificationsPrivate=$wgAbuseFilterNotifications;
$wgAbuseFilterRestrictions=
["blockautopromote"=>true,
"degroup"=>true];
//Permissions
$wgGroupPermissions=array_merge_recursive($wgGroupPermissions,
["bureaucrat"=>
  ["abusefilter-log-detail"=>true,
  "abusefilter-modify"=>true]
]);
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]=array_merge($wgGroupPermissions["steward"],
["abusefilter-hide-log"=>true,
"abusefilter-hidden-log"=>true,
"abusefilter-log-private"=>true,
"abusefilter-modify-global"=>true,
"abusefilter-modify-restricted"=>true,
"abusefilter-private"=>true,
"abusefilter-private-log"=>true,
"abusefilter-revert"=>true,
"abusefilter-view-private"=>true]);}
*/

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
$wgCentralAuthCookieDomain=".".parse_url($wmgRootHost,PHP_URL_HOST);
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

/*ChangeAuthor*/
if ($wmgExtensionChangeAuthor)
{wfLoadExtension("ChangeAuthor");
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["changeauthor"]=true;}
}

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
wfLoadExtensions(["ConfirmEdit","ConfirmEdit/ReCaptchaNoCaptcha"]);
$wgCaptchaBadLoginExpiration=60*60; //1 hour
$wgCaptchaClass="ReCaptchaNoCaptcha";
$wgCaptchaTriggers["create"]=true;
$wgCaptchaTriggersOnNamespace=
[NS_FILE=>
  ["edit"=>true],
NS_USER=>
  ["create"=>false]
];
//Permissions
$wgGroupPermissions["autoconfirmed"]["skipcaptcha"]=true;
$wgGroupPermissions["moderator"]["skipcaptcha"]=true;
$wgGroupPermissions["admin"]["skipcaptcha"]=true;
$wgGroupPermissions["bureaucrat"]["skipcaptcha"]=true;
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]["skipcaptcha"]=true;}

/*DeletePagesForGood*/
if ($wmgExtensionDeletePagesForGood)
{wfLoadExtension("DeletePagesForGood");
$wgDeletePagesForGoodNamespaces[NS_FILE]=false;
$wgPBTabIcons["delete_page_permanently"]="fas fa-trash-alt";
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["deleteperm"]=true;}
}

/*DiscordNotifications*/
wfLoadExtension("DiscordNotifications");
if ($wgCommandLineMode)
{$wgDiscordFromName=$wgSitename." (".$wmgWiki.")";}
else
{$wgDiscordFromName=$wgSitename." (".$_SERVER["HTTP_HOST"].")";}
$wgWikiUrl=$wgServer."/";
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

/*Flow
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
*/

/*GlobalBlocking*/
//Requires update.php
if ($wmgGlobalAccountMode!="")
{wfLoadExtension("GlobalBlocking");
$wgGlobalBlockingDatabase="wiki_globalblocking";
//Permissions
$wgGroupPermissions["steward"]["globalblock"]=false;
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["globalblock-exempt"]=true;}
}

/*GlobalPreferences*/
//Requires update.php
if ($wmgGlobalAccountMode!="")
{wfLoadExtension("GlobalPreferences");
if ($wmgGlobalAccountMode=="centralauth")
  {$wgGlobalPreferencesDB="wiki_globalpreferences";}
}

/*GlobalUserPage*/
if ($wmgGlobalAccountMode!="")
wfLoadExtension("GlobalUserPage");
{$wgGlobalUserPageAPIUrl="http://".$wmgCentralWiki.".".$wmgRootHost.$wgScriptPath."/api.php";
$wgGlobalUserPageCacheExpiry=$wmgCacheExpiry;
$wgGlobalUserPageDBname=$wmgCentralWiki."wiki";}

/*Highlightjs_Integration*/
if (PHP_OS_FAMILY=="Windows"&&$wmgExtensionHighlightjs_Integration)
{wfLoadExtension("Highlightjs_Integration");}

/*Interwiki*/
wfLoadExtension("Interwiki");
if ($wmgGlobalAccountMode!="")
{$wgInterwikiCentralDB=$wmgCentralWiki."wiki";}
//Permissions
$wgGroupPermissions["bureaucrat"]["interwiki"]=true;
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
$wgGroupPermissions["bureaucrat"]["nuke"]=true;
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["nuke"]=true;}
}

/*PageImages*/
if ($wmgExtensionPageImages)
{wfLoadExtension("PageImages");
$wgPageImagesBlacklistExpiry=$wmgCacheExpiry;
$wgPageImagesExpandOpenSearchXml=true;
$wgPageImagesNamespaces=[NS_HELP,NS_MAIN,NS_PROJECT,NS_USER];}

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
$wgPMTEnabledTools=["pmtmsg"];
$wgPMTEnglishSystemUsers=true;
$wgPMTPlavorMindMessages=true;
//Permissions
$wgGroupPermissions["moderator"]["editotheruserpages"]=true;
$wgGroupPermissions["admin"]["editotheruserpages"]=true;
$wgGroupPermissions["bureaucrat"]["editotheruserpages"]=true;
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]["editotheruserpages"]=true;}

/*Popups*/
if ($wmgExtensionPageImages&&$wmgExtensionPopups&&$wmgExtensionTextExtracts)
{wfLoadExtension("Popups");
$wgPopupsOptInDefaultState="1";
$wgPopupsHideOptInOnPreferencesPage=true;}

/*Renameuser*/
wfLoadExtension("Renameuser");
//Permissions
$wgGroupPermissions["bureaucrat"]["renameuser"]=false;
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]["renameuser"]=true;}

/*ReplaceText*/
if ($wmgExtensionReplaceText)
{wfLoadExtension("ReplaceText");
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["replacetext"]=true;}
}

/*RevisionSlider*/
if ($wmgExtensionRevisionSlider)
{wfLoadExtension("RevisionSlider");}

/*Scribunto*/
if ($wmgExtensionScribunto)
{wfLoadExtension("Scribunto");}

/*SecurePoll*/
//Requires update.php
if ($wmgExtensionSecurePoll)
{wfLoadExtension("SecurePoll");
//Permissions
$wgGroupPermissions["bureaucrat"]["securepoll-create-poll"]=true;
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["securepoll-create-poll"]=true;}
}

/*SimpleMathJax*/
if ($wmgExtensionSimpleMathJax)
{wfLoadExtension("SimpleMathJax");}

/*StaffPowers*/
wfLoadExtension("StaffPowers");
$wgStaffPowersShoutWikiMessages=false;
$wgStaffPowersStewardGroupName="moderator";
//Permissions
$wgGroupPermissions["admin"]["unblockable"]=true;
$wgGroupPermissions["bureaucrat"]["unblockable"]=true;
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]["unblockable"]=true;}
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["staff"]);};

/*StalkerLog*/
//Requires update.php
require_once($wgExtensionDirectory."/StalkerLog/StalkerLog.php");

/*SyntaxHighlight_GeSHi*/
if (PHP_OS_FAMILY=="Linux"&&$wmgExtensionSyntaxHighlight_GeSHi)
{wfLoadExtension("SyntaxHighlight_GeSHi");}

/*TemplateData*/
if ($wmgExtensionTemplateData)
{wfLoadExtension("TemplateData");}

/*TemplateStyles*/
if ($wmgExtensionTemplateStyles)
{wfLoadExtension("TemplateStyles");
//Remove default value
$wgTemplateStylesAllowedUrls=[];}

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
  ["src"=>$wmgPrivateDataDirectory."/titleblacklist.txt",
  "type"=>"file"]
];
if ($wmgGlobalAccountMode!="")
{$wgTitleBlacklistUsernameSources=["global"];}
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
{$wgGroupPermissions["steward"]["tboverride"]=true;
$wgGroupPermissions["steward"]["tboverride-account"]=true;
$wgGroupPermissions["steward"]["titleblacklistlog"]=true;}

/*TwoColConflict*/
if ($wmgExtensionTwoColConflict)
{wfLoadExtension("TwoColConflict");}

/*UploadsLink*/
if ($wmgExtensionUploadsLink)
{wfLoadExtension("UploadsLink");}

/*UserMerge*/
if ($wmgGlobalAccountMode!="shared-database")
{wfLoadExtension("UserMerge");
//Remove default value ("sysop")
$wgUserMergeProtectedGroups=[];
//Permissions
if ($wmgGlobalAccountMode!="centralauth")
  {$wgGroupPermissions["steward"]["usermerge"]=true;}
}

/*WikiEditor*/
if ($wmgExtensionWikiEditor)
{wfLoadExtension("WikiEditor");}

/*Other extensions*/
wfLoadExtension("SecureLinkFixer");

#Skins

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
