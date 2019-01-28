<?php
##Prevent web access

if (!defined("MEDIAWIKI"))
{die("You don't have permission to do that.");}

##Extensions

/*ConfirmEdit*/
wfLoadExtension("ConfirmEdit");
$wgCaptchaTriggers["create"]=true;
$wgCaptchaTriggers["edit"]=true;
$wgCaptchaTriggersOnNamespace=
[NS_USER=>
  ["create"=>false,
  "edit"=>false]
];

/*MultimediaViewer*/
wfLoadExtension("MultimediaViewer");
$wgMediaViewerUseThumbnailGuessing=true;

/*StaffPowers*/
wfLoadExtension("StaffPowers");
$wgStaffPowersShoutWikiMessages=false;
$wgStaffPowersStewardGroupName="staff";
//Staffs
$wgGroupPermissions["staff"]["unblockable"]=false;
//Administrators
$wgGroupPermissions["admin"]["unblockable"]=true;

/*TorBlock*/
wfLoadExtension("TorBlock");
//Remove default value
$wgTorAllowedActions=[];
//Users
$wgGroupPermissions["user"]["torunblocked"]=false;
//Stewards
$wgGroupPermissions["steward"]["torunblocked"]=true;

/*Other extensions*/
wfLoadExtension("PlavorMindTweaks");

##Skins

/*Liberty*/
wfLoadSkin("Liberty");
$wgLibertyMainColor="#9933ff";
$wgTwitterAccount="pseol2190";

/*Vector*/
wfLoadSkin("Vector");
$wgVectorResponsive=true;

/*Other skins*/
wfLoadSkin("Timeless");

##Permission inheritance

$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["bureaucrat"]+=$wgGroupPermissions["admin"];
$wgGroupPermissions["steward"]+=$wgGroupPermissions["bureaucrat"];
?>
