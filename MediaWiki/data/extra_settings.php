<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##Extensions

/*AntiSpoof*/
wfLoadExtension("AntiSpoof");
//$wgSharedTables[]="spoofuser";

/*CheckUser*/
wfLoadExtension("CheckUser");
$wgCheckUserCIDRLimit=$wgBlockCIDRLimit;
$wgCheckUserMaxBlocks=100;
//Stewards
$wgGroupPermissions["steward"]["checkuser"]=true;
$wgGroupPermissions["steward"]["checkuser-log"]=true;
$wgExtensionFunctions[]=function() use (&$wgGroupPermissions)
{unset($wgGroupPermissions["checkuser"]);};

/*ConfirmEdit*/
wfLoadExtension("ConfirmEdit");
$wgCaptchaTriggers["create"]=true;
$wgCaptchaTriggers["edit"]=true;
$wgCaptchaTriggersOnNamespace=
[NS_USER=>
  ["create"=>false,
  "edit"=>false]
];
//Autoconfirmed users
$wgGroupPermissions["autoconfirmed"]["skipcaptcha"]=true;

/*DeletePagesForGood*/
wfLoadExtension("DeletePagesForGood");
$wgDeletePagesForGoodNamespaces[NS_FILE]=false;
$wgGroupPermissions["eliminator"]["deleteperm"]=true;

/*GoToShell*/
include_once("{$wgExtensionDirectory}/GoToShell/GoToShell.php");
switch (PHP_OS_FAMILY)
{case "Linux":
$wgGoToShellCommand="rm -frv {$private_data_dir}/{$wiki_code}/cache/*";
break;
case "Windows":
$wgGoToShellCommand="powershell -Command Remove-Item {$private_data_dir}/{$wiki_code}/cache/* -Force -Recurse";
break;}
//Bureaucrats
$wgGroupPermissions["bureaucrat"]["gotoshell"]=false;
//Stewards
$wgGroupPermissions["steward"]["gotoshell"]=true;

/*Highlightjs_Integration*/
if (PHP_OS_FAMILY=="Windows")
{wfLoadExtension("Highlightjs_Integration");}

/*MinimumNameLength*/
wfLoadExtension("MinimumNameLength");
//Only detects alphanumeric names
$wgMinimumUsernameLength=4;

/*MultimediaViewer*/
wfLoadExtension("MultimediaViewer");
$wgMediaViewerUseThumbnailGuessing=true;

/*Nuke*/
wfLoadExtension("Nuke");
$wgGroupPermissions["steward"]["nuke"]=true;

/*PageImages*/
wfLoadExtension("PageImages");
$wgPageImagesBlacklistExpiry=60; //1 minute
$wgPageImagesExpandOpenSearchXml=true;
$wgPageImagesNamespaces=[NS_CATEGORY,NS_HELP,NS_MAIN,NS_PROJECT,NS_USER];

/*Popups*/
wfLoadExtension("Popups");
$wgPopupsOptInDefaultState="1";
$wgPopupsHideOptInOnPreferencesPage=true;

/*Renameuser*/
wfLoadExtension("Renameuser");
$wgGroupPermissions["bureaucrat"]["renameuser"]=false;
$wgGroupPermissions["steward"]["renameuser"]=true;

/*SyntaxHighlight_GeSHi*/
if (PHP_OS_FAMILY=="Linux")
{wfLoadExtension("SyntaxHighlight_GeSHi");}

/*StaffPowers*/
wfLoadExtension("StaffPowers");
$wgStaffPowersShoutWikiMessages=false;
$wgStaffPowersStewardGroupName="staff";
//Staffs
$wgGroupPermissions["staff"]["unblockable"]=false;
//Administrators
$wgGroupPermissions["admin"]["unblockable"]=true;

/*TextExtracts*/
wfLoadExtension("TextExtracts");
$wgExtractsExtendOpenSearchXml=true;

/*TitleBlacklist*/
wfLoadExtension("TitleBlacklist");
//Stewards
$wgGroupPermissions["steward"]["tboverride"]=true;
$wgGroupPermissions["steward"]["titleblacklistlog"]=true;

/*TorBlock*/
wfLoadExtension("TorBlock");
//Remove default value
$wgTorAllowedActions=[];
//Users
$wgGroupPermissions["user"]["torunblocked"]=false;
//Stewards
$wgGroupPermissions["steward"]["torunblocked"]=true;

/*UserMerge*/
wfLoadExtension("UserMerge");
$wgUserMergeProtectedGroups=["admin","bureaucrat","steward"];
//Stewards
$wgGroupPermissions["steward"]["usermerge"]=true;

/*Other extensions*/
wfLoadExtensions(["AccountInfo","PlavorMindTweaks","TwoColConflict"]);

##Skins

/*Liberty*/
wfLoadSkin("Liberty");
$wgLibertyMainColor="#9933ff";
$wgTwitterAccount="pseol2190";

/*Vector*/
wfLoadSkin("Vector");
$wgVectorResponsive=true;

/*Other skins*/
wfLoadSkins(["PlavorMindView","Timeless"]);

##Appending settings

/*Permission inheritance*/
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["bureaucrat"]+=$wgGroupPermissions["admin"];
$wgGroupPermissions["steward"]+=$wgGroupPermissions["bureaucrat"];
?>
