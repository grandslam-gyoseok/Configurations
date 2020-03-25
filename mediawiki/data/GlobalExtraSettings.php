<?php
if (!defined("MEDIAWIKI"))
{exit("This is not a valid entry point.");}

#Extensions

/*AbuseFilter*/
//Requires update.php
wfLoadExtension("AbuseFilter");
//"disallow" and "warn" should always be enabled to make AbuseFilter work properly
$wgAbuseFilterActions=
["block"=>false,
"blockautopromote"=>false,
"degroup"=>false,
"disallow"=>true,
"rangeblock"=>false,
"tag"=>false,
"throttle"=>false,
"warn"=>true];
if ($wmgGlobalAccountMode!="")
{$wgAbuseFilterCentralDB=$wmgCentralWiki."wiki";}
$wgAbuseFilterConditionLimit=100;
$wgAbuseFilterEmergencyDisableCount=
["default"=>5];
if ($wmgGlobalAccountMode!="" && $wmgWiki==$wmgCentralWiki)
{$wgAbuseFilterIsCentral=true;}
$wgAbuseFilterLogPrivateDetailsAccess=true;
$wgAbuseFilterNotifications="rcandudp";
$wgAbuseFilterPrivateDetailsForceReason=true;
$wgAbuseFilterRestrictions=
["block"=>false,
"blockautopromote"=>false,
"degroup"=>false,
"disallow"=>false,
"rangeblock"=>false,
"tag"=>false,
"throttle"=>false,
"warn"=>false];
//Permissions
function extension_AbuseFilter_modify_permissions()
{global $wgGroupPermissions;
unset($wgGroupPermissions["suppress"]);}
$wgExtensionFunctions[]="extension_AbuseFilter_modify_permissions";
$wgGroupPermissions["*"]["abusefilter-log-detail"]=true;
$wgGroupPermissions["bureaucrat"]["abusefilter-log-private"]=true;
$wgGroupPermissions["bureaucrat"]["abusefilter-modify"]=true;
$wgGroupPermissions["bureaucrat"]["abusefilter-revert"]=true;
if ($wmgWiki==$wmgCentralWiki)
{$wgGroupPermissions["steward"]["abusefilter-modify-global"]=true;}
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]=array_merge($wgGroupPermissions["steward"],
["abusefilter-hidden-log"=>true,
"abusefilter-hide-log"=>true,
"abusefilter-log-private"=>true,
"abusefilter-modify"=>true,
"abusefilter-modify-restricted"=>true,
"abusefilter-privatedetails"=>true,
"abusefilter-privatedetails-log"=>true,
"abusefilter-revert"=>true]);}

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
//"." should be prepended
$wgCentralAuthCookieDomain=parse_url(str_replace("%wiki%","",$wmgBaseURL),PHP_URL_HOST);
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
$wgCheckUserEnableSpecialInvestigate=true;
$wgCheckUserForceSummary=true;
$wgCheckUserGBtoollink=
["centralDB"=>$wmgCentralWiki."wiki",
"groups"=>
  ["steward"]
];
$wgCheckUserLogLogins=true;
$wgCheckUserMaxBlocks=100;
//Permissions
function extension_CheckUser_modify_permissions()
{global $wgGroupPermissions;
unset($wgGroupPermissions["checkuser"]);}
$wgExtensionFunctions[]="extension_CheckUser_modify_permissions";
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["checkuser"]=true;
$wgGroupPermissions["steward"]["checkuser-log"]=true;}

/*Cite*/
if ($wmgExtensionCite)
{wfLoadExtension("Cite");
$wgCiteBookReferencing=true;}

/*CodeEditor*/
if ($wmgExtensionCodeEditor && $wmgExtensionWikiEditor)
{wfLoadExtension("CodeEditor");}

/*CodeMirror*/
if ($wmgExtensionCodeMirror && $wmgExtensionWikiEditor)
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
  {$wgDiscordFromName=$wgSitename." (".$wgServer."/)";}
$wgDiscordIncludePageUrls=false;
$wgDiscordIncludeUserUrls=false;
$wgWikiUrl=$wgServer.$wgScriptPath."/";
$wgWikiUrlEndingUserRights="Special:UserRights/";}

/*DiscussionTools
//Disabled due to Parsoid error
if ($wmgExtensionDiscussionTools && $wmgExtensionParsoid_testing && $wmgExtensionVisualEditor)
{wfLoadExtension("DiscussionTools");
//Required by DiscussionTools
$wgLocaltimezone="Asia/Seoul";}
*/

/*Echo*/
//Requires update.php
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
$wgGroupPermissions["bureaucrat"]=array_merge($wgGroupPermissions["bureaucrat"],
["flow-create-board"=>true,
"flow-delete"=>true,
"flow-edit-post"=>true,
"flow-hide"=>true,
"flow-lock"=>true]);
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
if ($wmgGlobalAccountMode!="" && ($wmgWiki==$wmgCentralWiki || $wmgExtensionGlobalCssJs))
{wfLoadExtension("GlobalCssJs");
$wgGlobalCssJsConfig=
["source"=>"central",
"wiki"=>$wmgCentralWiki."wiki"];
$wgResourceLoaderSources["central"]=
["apiScript"=>$wmgCentralBaseURL.$wgScriptPath."/api.php",
"loadScript"=>$wmgCentralBaseURL.$wgScriptPath."/load.php"];}

/*GlobalPreferences*/
//Requires update.php
if ($wmgGlobalAccountMode!="")
{wfLoadExtension("GlobalPreferences");
if ($wmgGlobalAccountMode=="centralauth")
  {$wgGlobalPreferencesDB="wiki_globalpreferences";}
}

/*GlobalUserPage*/
if ($wmgGlobalAccountMode!="" && ($wmgWiki==$wmgCentralWiki || $wmgExtensionGlobalUserPage))
{wfLoadExtension("GlobalUserPage");
$wgGlobalUserPageAPIUrl=$wmgCentralBaseURL.$wgScriptPath."/api.php";
$wgGlobalUserPageCacheExpiry=$wmgCacheExpiry;
$wgGlobalUserPageDBname=$wmgCentralWiki."wiki";
$wgGlobalUserPageTimeout="default";}

/*Highlightjs_Integration*/
if ($wmgExtensionHighlightjs_Integration && PHP_OS_FAMILY=="Windows")
{wfLoadExtension("Highlightjs_Integration");}

/*InputBox*/
if ($wmgExtensionInputBox)
{wfLoadExtension("InputBox");}

/*Interwiki*/
wfLoadExtension("Interwiki");
if ($wmgGlobalAccountMode!="")
{$wgInterwikiCentralDB=$wmgCentralWiki."wiki";}
//Permissions
if ($wmgGlobalAccountMode=="" || $wmgWiki!=$wmgCentralWiki)
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
$wgGroupPermissions["bureaucrat"]["masseditregex"]=true;
if ($wmgGrantStewardsGlobalPermissions)
  {$wgGroupPermissions["steward"]["masseditregex"]=true;}
}

/*Math*/
//Requires update.php
if ($wmgExtensionMath)
{wfLoadExtension("Math");
$wgMathEnableExperimentalInputFormats=true;}

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

/*Parsoid-testing
//Disabled due to error
if ($wmgExtensionParsoid_testing)
{wfLoadExtension("Parsoid-testing",$IP."/vendor/wikimedia/parsoid/extension.json");
$wgParsoidSettings=
["linting"=>true,
"useSelser"=>true];
$wgVirtualRestConfig["modules"]["parsoid"]=
["domain"=>parse_url($wgServer,PHP_URL_HOST),
"forwardCookies"=>true,
//Deprecated but required
"prefix"=>$wmgWiki,
"url"=>$wgServer."/mediawiki/rest.php"];}
*/

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
$wgGroupPermissions["user"]["deleteownuserpages"]=true;
$wgGroupPermissions["user"]["moveownuserpages"]=true;
$wgGroupPermissions["moderator"]["editotheruserpages"]=true;
$wgGroupPermissions["admin"]["editotheruserpages"]=true;
$wgGroupPermissions["bureaucrat"]["editotheruserpages"]=true;
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["editotheruserpages"]=true;}

/*Popups*/
if ($wmgExtensionPopups && $wmgExtensionPageImages && $wmgExtensionTextExtracts)
{wfLoadExtension("Popups");
$wgPopupsHideOptInOnPreferencesPage=true;
$wgPopupsReferencePreviewsBetaFeature=false;}

/*ProtectionIndicator*/
if ($wmgExtensionProtectionIndicator)
{wfLoadExtension("ProtectionIndicator");
$wgShowIconsOnMainPage=true;}

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
function extension_StaffPowers_modify_permissions()
{global $wgGroupPermissions;
unset($wgGroupPermissions["staff"]);}
$wgExtensionFunctions[]="extension_StaffPowers_modify_permissions";
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["unblockable"]=true;}

/*StalkerLog*/
//Requires update.php
require_once($wgExtensionDirectory."/StalkerLog/StalkerLog.php");

/*SyntaxHighlight_GeSHi*/
if ($wmgExtensionSyntaxHighlight_GeSHi && PHP_OS_FAMILY=="Linux")
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
if ($wmgExtensionTemplateWizard && $wmgExtensionTemplateData && $wmgExtensionWikiEditor)
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
$wgGroupPermissions["admin"]["tboverride"]=true;
$wgGroupPermissions["bureaucrat"]["tboverride"]=true;
if ($wmgWiki==$wmgCentralWiki)
{$wgGroupPermissions["steward"]["tboverride-account"]=true;}
if ($wmgGrantStewardsGlobalPermissions)
{$wgGroupPermissions["steward"]["tboverride"]=true;
$wgGroupPermissions["steward"]["titleblacklistlog"]=true;}

/*TwoColConflict*/
if ($wmgExtensionTwoColConflict)
{wfLoadExtension("TwoColConflict");
$wgTwoColConflictBetaFeature=false;
$wgTwoColConflictSuggestResolution=true;}

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

/*VisualEditor
//Disabled due to Parsoid error
if ($wmgExtensionVisualEditor && $wmgExtensionParsoid_testing)
{wfLoadExtension("VisualEditor");
$wgDefaultUserOptions["visualeditor-newwikitext"]=1;
$wgDefaultUserOptions["visualeditor-tabs"]="prefer-wt";
$wgHiddenPrefs[]="visualeditor-betatempdisable";
$wgVisualEditorAvailableNamespaces["Help"]=true;
$wgVisualEditorAvailableNamespaces["Project"]=true;
$wgVisualEditorEnableDiffPage=true;
$wgVisualEditorEnableVisualSectionEditing=true;
$wgVisualEditorEnableWikitext=true;
$wgVisualEditorShowBetaWelcome=false;
$wgVisualEditorUseSingleEditTab=true;}
*/

/*WikibaseClient*/
if ($wmgExtensionWikibaseClient)
{require_once($wgExtensionDirectory."/Wikibase/client/WikibaseClient.php");
$wgEnableWikibaseClient=true;
//Use value of $baseNs in $wgExtensionDirectory/extensions/Wikibase/repo/config/Wikibase.example.php
$ns_item=120;
$ns_item_talk=121;
$ns_property=122;
$ns_property_talk=123;
$wgWBClientSettings=array_merge($wgWBClientSettings,
["repoArticlePath"=>$wgArticlePath,
"repoScriptPath"=>$wgScriptPath,
"repositories"=>
  [""=>
    [//baseUri will not work because Wikibase appends "/"
    "baseUri"=>$wmgCentralBaseURL."/page/Item:",
    "changesDatabase"=>$wmgCentralWiki."wiki",
    "entityNamespaces"=>
      ["item"=>$ns_item,
      "property"=>$ns_property],
    "repoDatabase"=>$wmgCentralWiki."wiki"]
  ],
"repoUrl"=>$wmgCentralBaseURL,
"siteGlobalID"=>$wmgWiki,
"siteGroup"=>"plavormind-wikis",
"sortPrepend"=>
  ["en","ko"]
]);}

/*WikibaseRepository*/
if ($wmgExtensionWikibaseRepository)
{require_once($wgExtensionDirectory."/Wikibase/repo/Wikibase.php");
$wgEnableWikibaseRepo=true;
//Use value of $baseNs in $wgExtensionDirectory/extensions/Wikibase/repo/config/Wikibase.example.php
$ns_item=120;
$ns_item_talk=121;
$ns_property=122;
$ns_property_talk=123;
switch ($wgLanguageCode)
  {case "ko":
  $wgExtraNamespaces[$ns_item]="항목";
  $wgExtraNamespaces[$ns_item_talk]="항목토론";
  $wgExtraNamespaces[$ns_property]="속성";
  $wgExtraNamespaces[$ns_property_talk]="속성토론";
  break;
  default:
  $wgExtraNamespaces[$ns_item]="Item";
  $wgExtraNamespaces[$ns_item_talk]="Item_talk";
  $wgExtraNamespaces[$ns_property]="Property";
  $wgExtraNamespaces[$ns_property_talk]="Property_talk";}
if ($wgLanguageCode!="en")
  {$wgNamespaceAliases["Item"]=$ns_item;
  $wgNamespaceAliases["Item_talk"]=$ns_item_talk;
  $wgNamespaceAliases["Property"]=$ns_property;
  $wgNamespaceAliases["Property_talk"]=$ns_property_talk;}
$wgWBRepoSettings["enableEntitySearchUI"]=false;
$wgWBRepoSettings["entityNamespaces"]=
["item"=>$ns_item,
"property"=>$ns_property];
$wgWBRepoSettings["siteLinkGroups"]=["plavormind-wikis"];
//Permissions
$wgGroupPermissions["*"]=array_merge($wgGroupPermissions["*"],
["item-merge"=>false,
"item-redirect"=>false,
"item-term"=>false,
"property-create"=>false,
"property-term"=>false]);
$wgGroupPermissions["user"]["item-term"]=true;
$wgGroupPermissions["user"]["property-create"]=true;
$wgGroupPermissions["user"]["property-term"]=true;
if ($wmgGrantStewardsGlobalPermissions)
  {$wgGroupPermissions["steward"]["item-merge"]=true;
  $wgGroupPermissions["steward"]["item-redirect"]=true;}
}

/*WikiEditor*/
if ($wmgExtensionWikiEditor)
{wfLoadExtension("WikiEditor");}

/*Other extensions*/
wfLoadExtension("SecureLinkFixer");

#Skins

/*Citizen*/
if ($wmgSkinCitizen)
{wfLoadSkin("Citizen");
$wgCitizenEnableManifest=false; //Experimental
$wgCitizenManifestThemeColor="#9933ff";
$wgCitizenThemeColor="#9933ff";}

/*Liberty*/
if ($wmgSkinLiberty)
{wfLoadSkin("Liberty");
$wgLibertyEnableLiveRC=false;
$wgLibertyMainColor="#9933ff";
$wgTwitterAccount="PlavorSeol";}

/*Medik*/
if ($wmgSkinMedik)
{wfLoadSkin("Medik");
$wgMedikColor="#9933ff";}

/*Metrolook*/
if ($wmgSkinMetrolook)
{wfLoadSkin("Metrolook");
$wgMetrolookDownArrow=false;
$wgMetrolookFeatures["collapsiblenav"]=
["global"=>true,
"user"=>false];
$wgMetrolookSearchBar=false;
$wgMetrolookUploadButton=false;}

/*MinervaNeue*/
if ($wmgSkinMinervaNeue)
{wfLoadSkin("MinervaNeue");
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
$wgMinervaTalkAtTop["beta"]=true;}

/*PlavorBuma*/
if ($wmgSkinPlavorBuma)
{wfLoadSkin("PlavorBuma");}

/*Timeless*/
if ($wmgSkinTimeless)
{wfLoadSkin("Timeless");}

/*Vector*/
wfLoadSkin("Vector");
$wgVectorResponsive=true;
