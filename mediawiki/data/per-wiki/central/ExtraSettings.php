<?php
//< Extensions >

//<< AbuseFilter >>

if ($wmgGlobalAccountMode === 'centralauth') {
  $wgAbuseFilterIsCentral = true;
  $wgGroupPermissions['steward']['abusefilter-modify-global'] = true;
}

//<< AntiSpoof >>

$wgGroupPermissions['steward']['override-antispoof'] = true;

//<< CentralAuth >>

if ($wmgGlobalAccountMode === 'centralauth') {
  $wgGroupPermissions['steward']['centralauth-lock'] = true;
  $wgGroupPermissions['steward']['centralauth-rename'] = true;
  $wgGroupPermissions['steward']['centralauth-suppress'] = true;
  $wgGroupPermissions['steward']['centralauth-unmerge'] = true;
  $wgGroupPermissions['steward']['globalgroupmembership'] = true;
  $wgGroupPermissions['steward']['globalgrouppermissions'] = true;
}

//<< GlobalBlocking >>

if ($wmgGlobalAccountMode !== null) {
  $wgGroupPermissions['steward']['globalblock'] = true;
}

//<< Interwiki >>

if ($wmgGlobalAccountMode === 'shared-db') {
  $wgGroupPermissions['steward']['interwiki'] = true;
}

if ($wmgGlobalAccountMode !== null) {
  $wgGroupPermissions['admin']['interwiki'] = false;
}

//<< OATHAuth >>

$wgGroupPermissions['steward']['oathauth-disable-for-user'] = true;
$wgGroupPermissions['steward']['oathauth-verify-user'] = true;

//<< Renameuser >>

if ($wmgGlobalAccountMode === 'shared-db') {
  $wgGroupPermissions['steward']['renameuser'] = true;
}
