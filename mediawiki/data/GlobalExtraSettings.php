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
if ($wmgGrantStewardsGlobalPermissions)
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
$wgCentralAuthLoginWiki=$wmgCentralWiki."wiki";
$wgCentralAuthPreventUnattached=true;
$wgDisableUnmergedEditing=true;
//Permissions
$wgGroupPermissions["*"]["centralauth-merge"]=false;
$wgGroupPermissions["user"]["centralauth-merge"]=true;
if ($wmgWiki==$wmgCentralWiki)
  {$wgGroupPermissions["steward"]["centralauth-rename"]=true;
  $wgGroupPermissions["steward"]["centralauth-usermerge"]=true;
  $wgGroupPermissions["steward"]["globalgroupmembership"]=true;
  $wgGroupPermissions["steward"]["globalgrouppermissions"]=true;}
else
  {$wgGroupPermissions["steward"]["centralauth-lock"]=false;
  $wgGroupPermissions["steward"]["centralauth-oversight"]=false;
  $wgGroupPermissions["steward"]["centralauth-unmerge"]=false;}
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
$wgCheckUserEnableSpecialInvestigate=true; //Experimental
$wgCheckUserForceSummary=true;
$wgCheckUserGBtoollink=
["centralDB"=>$wmgCentralWiki."wiki",
"groups"=>
  ["steward"]
];
$wgCheckUserLogLogins=true;
$wgCheckUserMaxBlocks=100;
//Permissions
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["checkuser"]=true;
$wgGroupPermissions["steward"]["checkuser-log"]=true;}
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["checkuser"]);};

/*Cite*/
if ($wmgExtensionCite)
{wfLoadExtension("Cite");
$wgCiteBookReferencing=true;}

/*CodeEditor*/
if ($wmgExtensionCodeEditor&&$wmgExtensionWikiEditor)
{wfLoadExtension("CodeEditor");}

/*CodeMirror*/
if ($wmgExtensionCodeMirror&&$wmgExtensionWikiEditor)
{wfLoadExtension("CodeMirror");}

/*CollapsibleVector*/
if ($wmgExtensionCollapsibleVector)
{wfLoadExtension("CollapsibleVector");
$wgCollapsibleVectorFeatures["collapsiblenav"]=
["global"=>true,
"user"=>false];}

/*CommonsMetadata*/
if ($wmgExtensionCommonsMetadata)
{wfLoadExtension("CommonsMetadata");}

/*ConfirmEdit*/
wfLoadExtensions(["ConfirmEdit","ConfirmEdit/ReCaptchaNoCaptcha"]);
$wgCaptchaBadLoginExpiration=60*60; //1 hour
$wgCaptchaClass="ReCaptchaNoCaptcha";
$wgCaptchaTriggers["create"]=true;
$wgCaptchaTriggers["sendemail"]=true;
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
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["skipcaptcha"]=true;}

/*DeletePagesForGood*/
if ($wmgExtensionDeletePagesForGood)
{wfLoadExtension("DeletePagesForGood");
$wgDeletePagesForGoodNamespaces[NS_FILE]=false;
//Permissions
if ($wmgGrantStewardsGlobalPermissions)
  {$wgGroupPermissions["steward"]["deleteperm"]=true;}
}

/*Discord*/
if ($wmgExtensionDiscord)
{wfLoadExtension("Discord");
$wgDiscordNoBots=false;
$wgDiscordPrependTimestamp=true;}

/*DiscordNotifications*/
if ($wmgExtensionDiscordNotifications)
{wfLoadExtension("DiscordNotifications");
if ($wgCommandLineMode)
  {$wgDiscordFromName=$wgSitename." (".$wmgWiki.")";}
else
  {$wgDiscordFromName=$wgSitename." (".$wgServer.")";}
$wgDiscordIncludePageUrls=false;
$wgDiscordIncludeUserUrls=false;
$wgWikiUrl=$wgServer.$wgScriptPath."/";
$wgWikiUrlEndingUserRights="Special:UserRights/";}

/*Echo
//Requires update.php
//Disabled because dismiss function does not work properly
wfLoadExtension("Echo");
$wgAllowArticleReminderNotification=true;
$wgDefaultUserOptions=array_merge($wgDefaultUserOptions,
["echo-email-frequency"=>-1,
"echo-subscriptions-email-user-rights"=>false,
"echo-subscriptions-web-thank-you-edit"=>false]);
$wgEchoMaxMentionsCount=10;
$wgEchoMaxMentionsInEditSummary=10;
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
$wgGroupPermissions["*"]["flow-hide"]=false;
$wgGroupPermissions["user"]["flow-lock"]=false;
$wgGroupPermissions["moderator"]["flow-edit-post"]=true;
$wgGroupPermissions["moderator"]["flow-hide"]=true;
$wgGroupPermissions["moderator"]["flow-lock"]=true;
$wgGroupPermissions["admin"]["flow-delete"]=true;
$wgGroupPermissions["admin"]["flow-edit-post"]=true;
$wgGroupPermissions["admin"]["flow-hide"]=true;
$wgGroupPermissions["admin"]["flow-lock"]=true;
$wgGroupPermissions["bureaucrat"]["flow-create-board"]=true;
$wgGroupPermissions["bureaucrat"]["flow-delete"]=true;
$wgGroupPermissions["bureaucrat"]["flow-edit-post"]=true;
$wgGroupPermissions["bureaucrat"]["flow-hide"]=true;
$wgGroupPermissions["bureaucrat"]["flow-lock"]=true;
if ($wmgGrantStewardsGlobalPermissions)
  {$wgGroupPermissions["steward"]=array_merge($wgGroupPermissions["steward"],
  ["flow-create-board"=>true,
  "flow-delete"=>true,
  "flow-edit-post"=>true,
  "flow-hide"=>true,
  "flow-lock"=>true,
  "flow-suppress"=>true]);}
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
  {unset($wgGroupPermissions["flow-bot"],$wgGroupPermissions["suppress"]);};
}
*/

/*GlobalBlocking*/
//Requires update.php
if ($wmgGlobalAccountMode!="")
{wfLoadExtension("GlobalBlocking");
$wgGlobalBlockingDatabase="wiki_globalblocking";
//Permissions
if ($wmgWiki!=$wmgCentralWiki)
  {$wgGroupPermissions["steward"]["globalblock"]=false;}
if ($wmgGrantStewardsGlobalPermissions)
  {$wgGroupPermissions["steward"]["globalblock-exempt"]=true;
  $wgGroupPermissions["steward"]["globalblock-whitelist"]=true;}
}

/*GlobalCssJs*/
if ($wmgGlobalAccountMode!=""&&($wmgWiki==$wmgCentralWiki||$wmgExtensionGlobalCssJs))
{wfLoadExtension("GlobalCssJs");
$wgGlobalCssJsConfig=
["source"=>"central",
"wiki"=>$wmgCentralWiki."wiki"];
$wgResourceLoaderSources["central"]=
["apiScript"=>"//".$wmgCentralWiki.".".$wmgRootHost.$wgScriptPath."/api.php",
"loadScript"=>"//".$wmgCentralWiki.".".$wmgRootHost.$wgScriptPath."/load.php"];}

/*GlobalPreferences*/
//Requires update.php
if ($wmgGlobalAccountMode!="")
{wfLoadExtension("GlobalPreferences");
if ($wmgGlobalAccountMode=="centralauth")
  {$wgGlobalPreferencesDB="wiki_globalpreferences";}
}

/*GlobalUserPage*/
if ($wmgGlobalAccountMode!=""&&($wmgWiki==$wmgCentralWiki||$wmgExtensionGlobalUserPage))
{wfLoadExtension("GlobalUserPage");
$wgGlobalUserPageAPIUrl="//".$wmgCentralWiki.".".$wmgRootHost.$wgScriptPath."/api.php";
$wgGlobalUserPageCacheExpiry=$wmgCacheExpiry;
$wgGlobalUserPageDBname=$wmgCentralWiki."wiki";
$wgGlobalUserPageTimeout="default";}

/*Highlightjs_Integration*/
if ($wmgExtensionHighlightjs_Integration&&PHP_OS_FAMILY=="Windows")
{wfLoadExtension("Highlightjs_Integration");}

/*InputBox*/
if ($wmgExtensionInputBox)
{wfLoadExtension("InputBox");}

/*Interwiki*/
wfLoadExtension("Interwiki");
if ($wmgGlobalAccountMode!="")
{$wgInterwikiCentralDB=$wmgCentralWiki."wiki";}
//Permissions
if ($wmgGlobalAccountMode==""||$wmgWiki!=$wmgCentralWiki)
{$wgGroupPermissions["bureaucrat"]["interwiki"]=true;}
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["interwiki"]=true;}

/*Josa*/
if ($wmgExtensionJosa)
{wfLoadExtension("Josa");}

/*MassEditRegex*/
if ($wmgExtensionMassEditRegex)
{wfLoadExtension("MassEditRegex");
//Permissions
if ($wmgGrantStewardsGlobalPermissions)
  {$wgGroupPermissions["steward"]["masseditregex"]=true;}
}

/*Math*/
//Requires update.php
if ($wmgExtensionMath)
{wfLoadExtension("Math");
$wgMathEnableExperimentalInputFormats=true;}

/*MinimumNameLength*/
wfLoadExtension("MinimumNameLength");
//Only detects alphanumeric names
$wgMinimumUsernameLength=2;

/*MultimediaViewer*/
if ($wmgExtensionMultimediaViewer)
{wfLoadExtension("MultimediaViewer");
if ($wgThumbnailScriptPath)
  {$wgMediaViewerUseThumbnailGuessing=true;}
}

/*NativeSvgHandler*/
if (!$wgSVGConverter)
{wfLoadExtension("NativeSvgHandler");}

/*Nuke*/
if ($wmgExtensionNuke)
{wfLoadExtension("Nuke");
//Permissions
$wgGroupPermissions["bureaucrat"]["nuke"]=true;
if ($wmgGrantStewardsGlobalPermissions)
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
$wgDefaultUserOptions["performanceinspector"]=1;}

/*PlavorMindTools*/
wfLoadExtension("PlavorMindTools");
$wgPMTFeatureConfig["NoActionsOnNonEditable"]=
["enable"=>true,
"HideMoveTab"=>true];
$wgPMTFeatureConfig["ReplaceInterfaceMessages"]=
["enable"=>true,
"EnglishSystemUsers"=>true];
//Permissions
//"deleteownuserpages" permission does not have to be inherited by moderators and above because it is not needed if the group already has "delete" permission
$wgGroupPermissions["autoconfirmed"]["deleteownuserpages"]=true;
$wgGroupPermissions["moderator"]["editotheruserpages"]=true;
$wgGroupPermissions["admin"]["editotheruserpages"]=true;
$wgGroupPermissions["bureaucrat"]["editotheruserpages"]=true;
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["editotheruserpages"]=true;}

/*Popups*/
if ($wmgExtensionPopups&&$wmgExtensionPageImages&&$wmgExtensionTextExtracts)
{wfLoadExtension("Popups");
$wgPopupsHideOptInOnPreferencesPage=true;
$wgPopupsOptInDefaultState="1";
$wgPopupsReferencePreviewsBetaFeature=false;}

/*Renameuser*/
wfLoadExtension("Renameuser");
//Permissions
$wgGroupPermissions["bureaucrat"]["renameuser"]=false;
if ($wmgGlobalAccountMode=="shared-database")
{if ($wmgWiki==$wmgCentralWiki)
  {$wgGroupPermissions["steward"]["renameuser"]=true;}
}
elseif ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["renameuser"]=true;}

/*ReplaceText*/
if ($wmgExtensionReplaceText)
{wfLoadExtension("ReplaceText");
//Permissions
if ($wmgGrantStewardsGlobalPermissions)
  {$wgGroupPermissions["steward"]["replacetext"]=true;}
}

/*RevisionSlider*/
if ($wmgExtensionRevisionSlider)
{wfLoadExtension("RevisionSlider");}

/*Scribunto*/
if ($wmgExtensionScribunto)
{wfLoadExtension("Scribunto");}

/*StaffPowers*/
wfLoadExtension("StaffPowers");
$wgStaffPowersShoutWikiMessages=false;
$wgStaffPowersStewardGroupName="bureaucrat";
//Permissions
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["unblockable"]=true;}
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["staff"]);};

/*StalkerLog*/
//Requires update.php
require_once($wgExtensionDirectory."/StalkerLog/StalkerLog.php");

/*SyntaxHighlight_GeSHi*/
if ($wmgExtensionSyntaxHighlight_GeSHi&&PHP_OS_FAMILY=="Linux")
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
if ($wmgExtensionTemplateWizard&&$wmgExtensionTemplateData&&$wmgExtensionWikiEditor)
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
if ($wmgWiki==$wmgCentralWiki)
{$wgGroupPermissions["steward"]["tboverride-account"]=true;}
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["tboverride"]=true;
$wgGroupPermissions["steward"]["titleblacklistlog"]=true;}

/*TwoColConflict*/
if ($wmgExtensionTwoColConflict)
{wfLoadExtension("TwoColConflict");
$wgTwoColConflictBetaFeature=false;}

/*UploadsLink*/
if ($wmgExtensionUploadsLink)
{wfLoadExtension("UploadsLink");}

/*UserMerge*/
if ($wmgGlobalAccountMode!="shared-database")
{wfLoadExtension("UserMerge");
//Remove default value ("sysop")
$wgUserMergeProtectedGroups=[];
//Permissions
if ($wmgGrantStewardsGlobalPermissions)
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
$wgLibertyEnableLiveRC=false;
$wgLibertyMainColor="#9933ff";
$wgTwitterAccount="PlavorSeol";

/*Medik*/
wfLoadSkin("Medik");
$wgMedikColor="#9933ff";

/*MinervaNeue*/
wfLoadSkin("MinervaNeue");
$wgMinervaAdvancedMainMenu["base"]=true;
$wgMinervaAdvancedMainMenu["beta"]=true;
$wgMinervaAlwaysShowLanguageButton=false;
$wgMinervaApplyKnownTemplateHacks=true;
$wgMinervaEnableSiteNotice=true;
$wgMinervaHistoryInPageActions["base"]=true;
$wgMinervaHistoryInPageActions["beta"]=true;
$wgMinervaPageIssuesNewTreatment["beta"]=false;
$wgMinervaPersonalMenu["base"]=true;
$wgMinervaPersonalMenu["beta"]=true;
$wgMinervaShowCategoriesButton["base"]=true;
$wgMinervaTalkAtTop["base"]=true;
$wgMinervaTalkAtTop["beta"]=true;

/*Vector*/
wfLoadSkin("Vector");
$wgVectorResponsive=true;

/*Other skins*/
wfLoadSkins(["PlavorBuma","Timeless"]);
?>
