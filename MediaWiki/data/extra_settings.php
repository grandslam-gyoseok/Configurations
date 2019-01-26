<?php
/*Prevent web access*/
if (!defined("MEDIAWIKI"))
{exit;}

#Extensions

/*StaffPowers*/
wfLoadExtension("StaffPowers");
$wgStaffPowersShoutWikiMessages=false;
$wgStaffPowersStewardGroupName="staff";
//Staffs
$wgGroupPermissions["staff"]["unblockable"]=false;
//Administrators
$wgGroupPermissions["admin"]["unblockable"]=true;

/*Other extensions*/
wfLoadExtension("PlavorMindTweaks");

#Skins

/*Vector*/
wfLoadSkin("Vector");
$wgVectorResponsive=true;

#Permission inheritance
//Must be after all settings
$wgGroupPermissions["staff"]+=$wgGroupPermissions["autoconfirmed"];
$wgGroupPermissions["admin"]+=$wgGroupPermissions["staff"];
$wgGroupPermissions["bureaucrat"]+=$wgGroupPermissions["admin"];
$wgGroupPermissions["steward"]+=$wgGroupPermissions["bureaucrat"];
?>
