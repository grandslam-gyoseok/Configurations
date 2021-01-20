<?php
//< Extensions >

//<< AbuseFilter >>
//This extension requires running update.php.
wfLoadExtension('AbuseFilter');
$wgAbuseFilterActionRestrictions=
['block' => false,
'blockautopromote' => false,
'degroup' => false,
'disallow' => false,
'rangeblock' => false,
'tag' => false,
'throttle' => false,
'warn' => false];
//"disallow" and "warn" should always be enabled to make AbuseFilter work properly.
$wgAbuseFilterActions=
['block' => false,
'blockautopromote' => false,
'degroup' => false,
'disallow' => true,
'rangeblock' => false,
'tag' => false,
'throttle' => false,
'warn' => true];

if ($wmgGlobalAccountMode !== false)
  {$wgAbuseFilterCentralDB="{$wmgCentralWiki}wiki";}

$wgAbuseFilterConditionLimit=100;
$wgAbuseFilterEmergencyDisableCount=
['default' => 5];

if ($wmgGlobalAccountMode !== false && $wmgWiki === $wmgCentralWiki)
  {$wgAbuseFilterIsCentral=true;}

$wgAbuseFilterLogPrivateDetailsAccess=true;
$wgAbuseFilterNotifications='rcandudp';
$wgAbuseFilterPrivateDetailsForceReason=true;
//Permissions
$wmgGroupPermissions['*']['abusefilter-log']=true;
$wmgGroupPermissions['*']['abusefilter-log-detail']=true;
$wmgGroupPermissions['*']['abusefilter-view']=true;
$wmgGroupPermissions['bureaucrat']['abusefilter-log-private']=true;
$wmgGroupPermissions['bureaucrat']['abusefilter-modify']=true;
$wmgGroupPermissions['bureaucrat']['abusefilter-revert']=true;

if ($wmgWiki === $wmgCentralWiki)
  {$wmgGroupPermissions['steward']['abusefilter-modify-global']=true;}

if ($wmgGrantStewardsGlobalPermissions)
  {$wmgGroupPermissions['steward']=array_merge($wmgGroupPermissions['steward'],
  ['abusefilter-hidden-log' => true,
  'abusefilter-hide-log' => true,
  'abusefilter-modify-restricted' => true,
  'abusefilter-privatedetails' => true,
  'abusefilter-privatedetails-log' => true]);}

//<< AntiSpoof >>
//This extension requires running update.php.
wfLoadExtension('AntiSpoof');
if ($wmgGlobalAccountMode === 'shared-database')
  {$wgSharedTables[]='spoofuser';}
//Permissions
if ($wmgGrantStewardsGlobalPermissions)
  {$wmgGroupPermissions['steward']['override-antispoof']=true;}

//<< Babel >>
//This extension requires running update.php.
if ($wmgExtensions['Babel'])
  {wfLoadExtension('Babel');
  $wgBabelCategoryNames=
  ['0' => false,
  '1' => false,
  '2' => false,
  '3' => false,
  '4' => false,
  '5' => false,
  'N' => false];
  $wgBabelMainCategory=false;
  $wgBabelUseUserLanguage=true;}

//<< CentralAuth >>
//This extension requires running update.php.
if ($wmgGlobalAccountMode === 'centralauth')
  {wfLoadExtension('CentralAuth');
  $wgCentralAuthAutoMigrate=true;
  $wgCentralAuthAutoMigrateNonGlobalAccounts=true;
  //"." should be prepended
  $wgCentralAuthCookieDomain=parse_url(str_replace('%wiki%','',$wmgDefaultBaseURL),PHP_URL_HOST);
  $wgCentralAuthCookies=true;
  $wgCentralAuthCreateOnView=true;
  $wgCentralAuthDatabase='wiki_centralauth';
  $wgCentralAuthEnableUserMerge=true;
  $wgCentralAuthLoginWiki="{$wmgCentralWiki}wiki";
  $wgCentralAuthPreventUnattached=true;
  $wgDisableUnmergedEditing=true;
  //Permissions
  $wmgGroupPermissions['user']['centralauth-merge']=true;

  if ($wmgWiki === $wmgCentralWiki)
    {$wmgGroupPermissions['steward']['centralauth-lock']=true;
    $wmgGroupPermissions['steward']['centralauth-oversight']=true;
    $wmgGroupPermissions['steward']['centralauth-rename']=true;
    $wmgGroupPermissions['steward']['centralauth-unmerge']=true;
    $wmgGroupPermissions['steward']['centralauth-usermerge']=true;
    $wmgGroupPermissions['steward']['globalgroupmembership']=true;
    $wmgGroupPermissions['steward']['globalgrouppermissions']=true;}
  }

//<< CheckUser >>
//This extension requires running update.php.
wfLoadExtension('CheckUser');
$wgCheckUserCAMultiLock=
['centralDB' => "{$wmgCentralWiki}wiki",
'groups' =>
  ['steward']
];
$wgCheckUserCAtoollink="{$wmgCentralWiki}wiki";
$wgCheckUserCIDRLimit=$wmgCIDRLimit;
$wgCheckUserEnableSpecialInvestigate=true;
$wgCheckUserForceSummary=true;
$wgCheckUserGBtoollink=
['centralDB' => "{$wmgCentralWiki}wiki",
'groups' =>
  ['steward']
];
$wgCheckUserLogLogins=true;
$wgCheckUserMaxBlocks=100;
$wgCheckUserMaximumRowCount=500; //Experimental
//Permissions
if ($wmgGrantStewardsGlobalPermissions)
  {$wmgGroupPermissions['steward']['checkuser']=true;
  $wmgGroupPermissions['steward']['checkuser-log']=true;}

//<< Cite >>
if ($wmgExtensions['Cite'])
  {wfLoadExtension('Cite');
  $wgCiteBookReferencing=true;}

//<< CodeEditor >>
if ($wmgExtensions['CodeEditor'] && $wmgExtensions['WikiEditor'])
  {wfLoadExtension('CodeEditor');}

//<< CodeMirror >>
if ($wmgExtensions['CodeMirror'] && $wmgExtensions['WikiEditor'])
  {wfLoadExtension('CodeMirror');}

//<< CommonsMetadata >>
if ($wmgExtensions['CommonsMetadata'])
  {wfLoadExtension('CommonsMetadata');}

//<< ConfirmEdit >>
wfLoadExtensions(['ConfirmEdit','ConfirmEdit/hCaptcha']);
$wgCaptchaBadLoginExpiration=60 * 60; //1 hour
$wgCaptchaTriggers['create']=true;
$wgCaptchaTriggers['sendemail']=true;
$wgCaptchaTriggersOnNamespace=
[NS_FILE =>
  ['edit' => true],
NS_USER =>
  ['create' => false]
];
//Permissions
$wmgGroupPermissions['autoconfirmed']['skipcaptcha']=true;

//<< CreateRedirect >>
if ($wmgExtensions['CreateRedirect'])
  {wfLoadExtension('CreateRedirect');}

//<< DiscordNotifications >>
if ($wmgExtensions['DiscordNotifications'])
  {wfLoadExtension('DiscordNotifications');

  if ($wgCommandLineMode)
    {$wgDiscordFromName="{$wgSitename} ({$wmgWiki})";}
  else
    {$wgDiscordFromName="{$wgSitename} ({$wgServer}/)";}

  $wgDiscordIncludePageUrls=false;
  $wgDiscordIncludeUserUrls=false;
  $wgDiscordNotificationWikiUrl="{$wgServer}{$wgScriptPath}/";
  $wgDiscordNotificationWikiUrlEndingUserRights='Special:UserRights/';}

//<< DiscussionTools >>
/*
if ($wmgExtensions["DiscussionTools"] && $wmgExtensions["VisualEditor"])
{wfLoadExtension("DiscussionTools");
//Required by DiscussionTools
$wgLocaltimezone="Asia/Seoul";}
*/

//<< Echo >>
//This extension requires running update.php.
wfLoadExtension('Echo');
$wgAllowArticleReminderNotification=true;
$wgDefaultUserOptions=array_merge($wgDefaultUserOptions,
['echo-email-frequency' => -1,
'echo-subscriptions-email-user-rights' => false,
'echo-subscriptions-web-thank-you-edit' => false]);
$wgEchoMaxMentionsCount=10;
$wgEchoMaxMentionsInEditSummary=10;
$wgEchoMentionStatusNotifications=true;
$wgEchoPerUserBlacklist=true;

//<< GlobalBlocking >>
//This extension requires running update.php.
if ($wmgGlobalAccountMode !== false)
  {wfLoadExtension('GlobalBlocking');
  $wgGlobalBlockingDatabase='wiki_globalblocking';
  //Permissions
  if ($wmgWiki === $wmgCentralWiki)
    {$wmgGroupPermissions['steward']['globalblock']=true;}
  if ($wmgGrantStewardsGlobalPermissions)
    {$wmgGroupPermissions['steward']['globalblock-exempt']=true;
    $wmgGroupPermissions['steward']['globalblock-whitelist']=true;}
  }

//<< GlobalCssJs >>
if ($wmgGlobalAccountMode !== false && ($wmgWiki === $wmgCentralWiki || $wmgExtensions['GlobalCssJs']))
  {wfLoadExtension('GlobalCssJs');
  $wgGlobalCssJsConfig=
  ['source' => 'central',
  'wiki' => "{$wmgCentralWiki}wiki"];
  $wgResourceLoaderSources['central']=
  ['apiScript' => "{$wmgCentralBaseURL}{$wgScriptPath}/api.php",
  'loadScript' => "{$wmgCentralBaseURL}{$wgScriptPath}/load.php"];}

//<< GlobalPreferences >>
//This extension requires running update.php.
if ($wmgGlobalAccountMode !== false)
  {wfLoadExtension('GlobalPreferences');

  if ($wmgGlobalAccountMode === 'centralauth')
    {$wgGlobalPreferencesDB='wiki_globalpreferences';}
  }

//<< GlobalUserPage >>
if ($wmgGlobalAccountMode !== false && ($wmgWiki === $wmgCentralWiki || $wmgExtensions['GlobalUserPage']))
  {wfLoadExtension('GlobalUserPage');
  $wgGlobalUserPageAPIUrl="{$wmgCentralBaseURL}{$wgScriptPath}/api.php";
  $wgGlobalUserPageCacheExpiry=$wmgCacheExpiry;
  $wgGlobalUserPageDBname="{$wmgCentralWiki}wiki";
  $wgGlobalUserPageTimeout='default';}

//<< Highlightjs_Integration >>
if ($wmgExtensions['Highlightjs_Integration'] && $wmgPlatform === 'Windows')
  {wfLoadExtension('Highlightjs_Integration');}

//<< InputBox >>
if ($wmgExtensions['InputBox'])
  {wfLoadExtension('InputBox');}

//<< Interwiki >>
wfLoadExtension('Interwiki');
if ($wmgGlobalAccountMode !== false)
  {$wgInterwikiCentralDB="{$wmgCentralWiki}wiki";}
//Permissions
if ($wmgGlobalAccountMode === false || $wmgWiki !== $wmgCentralWiki)
  {$wmgGroupPermissions['bureaucrat']['interwiki']=true;}

if ($wmgGrantStewardsGlobalPermissions)
  {$wmgGroupPermissions['steward']['interwiki']=true;}

//<< Josa >>
if ($wmgExtensions['Josa'])
  {wfLoadExtension('Josa');}

//<< MassEditRegex >>
if ($wmgExtensions['MassEditRegex'])
  {wfLoadExtension('MassEditRegex');
  //Permissions
  $wmgGroupPermissions['bureaucrat']['masseditregex']=true;}

//<< Math >>
//This extension requires running update.php.
if ($wmgExtensions['Math'])
  {wfLoadExtension('Math');
  $wgMathEnableExperimentalInputFormats=true;}

//<< MultimediaViewer >>
if ($wmgExtensions['MultimediaViewer'])
  {wfLoadExtension('MultimediaViewer');
  if ($wgThumbnailScriptPath)
    {$wgMediaViewerUseThumbnailGuessing=true;}
  }

//<< Nuke >>
if ($wmgExtensions['Nuke'])
  {wfLoadExtension('Nuke');
  //Permissions
  $wmgGroupPermissions['bureaucrat']['nuke']=true;}

//<< OATHAuth >>
if ($wmgGlobalAccountMode !== 'shared-database')
  {wfLoadExtension('OATHAuth');
  $wgOATHAuthAccountPrefix='PlavorMind wikis';

  if ($wmgGlobalAccountMode === 'centralauth')
    {$wgOATHAuthDatabase='wiki_centralauth';}
  //Permissions
  $wmgGroupPermissions['user']['oathauth-enable']=true;

  if ($wmgWiki === $wmgCentralWiki)
    {$wmgGroupPermissions['steward']['oathauth-verify-user']=true;}

  if ($wmgGrantStewardsGlobalPermissions)
    {$wmgGroupPermissions['steward']['oathauth-api-all']=true;
    $wmgGroupPermissions['steward']['oathauth-disable-for-user']=true;
    $wmgGroupPermissions['steward']['oathauth-view-log']=true;}
  }

//<< PageImages >>
if ($wmgExtensions['PageImages'])
  {wfLoadExtension('PageImages');
  $wgPageImagesBlacklistExpiry=$wmgCacheExpiry;
  $wgPageImagesExpandOpenSearchXml=true;
  $wgPageImagesNamespaces=[NS_HELP,NS_MAIN,NS_PROJECT,NS_USER];}

//<< ParserFunctions >>
if ($wmgExtensions['ParserFunctions'])
  {wfLoadExtension('ParserFunctions');
  $wgPFEnableStringFunctions=true;}

//<< PlavorMindTools >>
wfLoadExtension('PlavorMindTools');
$wgPMTFeatureConfig['NoActionsOnNonEditable']=
['enable' => true,
'HideMoveTab' => true];
$wgPMTFeatureConfig['ReplaceInterfaceMessages']=
['enable' => true,
'EnglishSystemUsers' => true];
//Permissions
$wmgGroupPermissions['user']['deleteownuserpages']=true;
$wmgGroupPermissions['user']['moveownuserpages']=true;
$wmgGroupPermissions['moderator']['editotheruserpages']=true;

//<< Poem >>
if ($wmgExtensions['Poem'])
  {wfLoadExtension('Poem');}

//<< Popups >>
if ($wmgExtensions['Popups'] && $wmgExtensions['PageImages'] && $wmgExtensions['TextExtracts'])
  {wfLoadExtension('Popups');
  $wgPopupsHideOptInOnPreferencesPage=true;
  $wgPopupsReferencePreviewsBetaFeature=false;}

//<< Renameuser >>
wfLoadExtension('Renameuser');
//Permissions
if ($wmgGlobalAccountMode === 'shared-database')
  {if ($wmgWiki === $wmgCentralWiki)
    {$wmgGroupPermissions['steward']['renameuser']=true;}
  }
elseif ($wmgGrantStewardsGlobalPermissions)
  {$wmgGroupPermissions['steward']['renameuser']=true;}

//<< ReplaceText >>
if ($wmgExtensions['ReplaceText'])
  {wfLoadExtension('ReplaceText');
  //Permissions
  if ($wmgGrantStewardsGlobalPermissions)
    {$wmgGroupPermissions['steward']['replacetext']=true;}
  }

//<< RevisionSlider >>
if ($wmgExtensions['RevisionSlider'])
  {wfLoadExtension('RevisionSlider');}

//<< Scribunto >>
if ($wmgExtensions['Scribunto'])
  {wfLoadExtension('Scribunto');}

//<< StaffPowers >>
wfLoadExtension('StaffPowers');
$wgStaffPowersShoutWikiMessages=false;
$wgStaffPowersStewardGroupName='bureaucrat';
//Permissions
if ($wmgGrantStewardsGlobalPermissions)
  {$wmgGroupPermissions['steward']['unblockable']=true;}

//<< SyntaxHighlight_GeSHi >>
if ($wmgExtensions['SyntaxHighlight_GeSHi'] && $wmgPlatform === 'Linux')
  {wfLoadExtension('SyntaxHighlight_GeSHi');}

//<< TemplateData >>
if ($wmgExtensions['TemplateData'])
  {wfLoadExtension('TemplateData');}

//<< TemplateSandbox >>
if ($wmgExtensions['TemplateSandbox'])
  {wfLoadExtension('TemplateSandbox');}

//<< TemplateStyles >>
if ($wmgExtensions['TemplateStyles'])
  {wfLoadExtension('TemplateStyles');
  //Remove default value
  $wgTemplateStylesAllowedUrls=[];}

//<< TemplateWizard >>
if ($wmgExtensions['TemplateWizard'] && $wmgExtensions['TemplateData'] && $wmgExtensions['WikiEditor'])
  {wfLoadExtension('TemplateWizard');}

//<< TextExtracts >>
if ($wmgExtensions['TextExtracts'])
  {wfLoadExtension('TextExtracts');
  $wgExtractsExtendOpenSearchXml=true;}

//<< TitleBlacklist >>
wfLoadExtension('TitleBlacklist');
$wgTitleBlacklistSources=
['global' =>
  ['src' => "{$wmgDataDirectory}/private/titleblacklist.txt",
  'type' => 'file']
];

if ($wmgGlobalAccountMode !== false)
  {$wgTitleBlacklistUsernameSources=['global'];}
//Permissions
$wmgGroupPermissions['admin']['tboverride']=true;

if ($wmgWiki === $wmgCentralWiki)
  {$wmgGroupPermissions['steward']['tboverride-account']=true;}

if ($wmgGrantStewardsGlobalPermissions)
  {$wmgGroupPermissions['steward']['titleblacklistlog']=true;}

//<< TwoColConflict >>
if ($wmgExtensions['TwoColConflict'])
  {wfLoadExtension('TwoColConflict');
  $wgTwoColConflictBetaFeature=false;}

//<< UniversalLanguageSelector >>
if ($wmgExtensions['UniversalLanguageSelector'])
  {wfLoadExtension('UniversalLanguageSelector');
  $wgULSCompactLanguageLinksBetaFeature=false;
  $wgULSIMEEnabled=false;
  $wgULSLanguageDetection=false;
  $wgULSWebfontsEnabled=false;}

//<< UploadsLink >>
if ($wmgExtensions['UploadsLink'])
  {wfLoadExtension('UploadsLink');}

//<< UserMerge >>
if ($wmgGlobalAccountMode !== 'shared-database')
  {wfLoadExtension('UserMerge');
  //Remove default value ('sysop')
  $wgUserMergeProtectedGroups=[];
  //Permissions
  if ($wmgGrantStewardsGlobalPermissions)
    {$wmgGroupPermissions['steward']['usermerge']=true;}
  }

//<< VisualEditor >>
/*
if ($wmgExtensions["VisualEditor"])
{wfLoadExtension("VisualEditor");
$wgDefaultUserOptions["visualeditor-enable"]=0;
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

//<< WikibaseClient >>
/*
if ($wmgExtensions["WikibaseClient"])
{wfLoadExtension("WikibaseClient",$wgExtensionDirectory."/Wikibase/extension-client.json");
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
*/

//<< WikibaseRepository >>
/*
if ($wmgExtensions["WikibaseRepository"])
{wfLoadExtension("WikibaseRepository",$wgExtensionDirectory."/Wikibase/extension-repo.json");
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
if ($wgLanguageCode !== "en")
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
$wmgGroupPermissions["user"]["item-term"]=true;
$wmgGroupPermissions["user"]["property-create"]=true;
$wmgGroupPermissions["user"]["property-term"]=true;
if ($wmgGrantStewardsGlobalPermissions)
  {$wmgGroupPermissions["steward"]["item-merge"]=true;
  $wmgGroupPermissions["steward"]["item-redirect"]=true;}
}
*/

//<< WikiEditor >>
if ($wmgExtensions['WikiEditor'])
  {wfLoadExtension('WikiEditor');}

//<< Other extensions >>
wfLoadExtension('SecureLinkFixer');

//< Skins >

//<< Citizen >>
if ($wmgSkins['Citizen'])
  {wfLoadSkin('Citizen');
  $wgCitizenEnableManifest=false;
  $wgCitizenManifestThemeColor='#9933ff';
  $wgCitizenThemeColor='#9933ff';}

//<< Liberty >>
/*
if ($wmgSkins["Liberty"])
{wfLoadSkin("Liberty");
$wgLibertyEnableLiveRC=false;
$wgLibertyMainColor="#9933ff";
$wgTwitterAccount="PlavorSeol";}
*/

//<< Medik >>
if ($wmgSkins['Medik'])
  {wfLoadSkin('Medik');
  $wgMedikColor='#9933ff';}

//<< Metrolook >>
if ($wmgSkins['Metrolook'])
  {wfLoadSkin('Metrolook');
  $wgMetrolookDownArrow=false;
  $wgMetrolookFeatures['collapsiblenav']=
  ['global' => true,
  'user' => false];
  $wgMetrolookSearchBar=false;
  $wgMetrolookUploadButton=false;}

//<< MinervaNeue >>
if ($wmgSkins['MinervaNeue'])
  {wfLoadSkin('MinervaNeue');
  $wgMinervaAdvancedMainMenu['base']=true;
  $wgMinervaAdvancedMainMenu['beta']=true;
  $wgMinervaAlwaysShowLanguageButton=false;
  $wgMinervaApplyKnownTemplateHacks=true;
  $wgMinervaHistoryInPageActions['base']=true;
  $wgMinervaHistoryInPageActions['beta']=true;
  $wgMinervaPageIssuesNewTreatment['beta']=false;
  $wgMinervaPersonalMenu['base']=true;
  $wgMinervaPersonalMenu['beta']=true;
  $wgMinervaShowCategoriesButton['base']=true;
  $wgMinervaTalkAtTop['base']=true;
  $wgMinervaTalkAtTop['beta']=true;}

//<< PlavorBuma >>
if ($wmgSkins['PlavorBuma'])
  {wfLoadSkin('PlavorBuma');}

//<< Timeless >>
if ($wmgSkins['Timeless'])
  {wfLoadSkin('Timeless');}

//<< Vector >>
wfLoadSkin('Vector');
$wgVectorDefaultSidebarVisibleForAnonymousUser=true;
$wgVectorResponsive=true;
