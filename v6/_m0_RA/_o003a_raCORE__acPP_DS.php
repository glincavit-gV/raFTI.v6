<?php
include_once '_o001a_raCORE__acPP_meta.php';
include_once '_o002a_raCORE__acPP_ini.php';

function _raCORE_DS_ini() { $pp = "p003a-0a";
  global $RA;

}

function _raCORE_DS_check($cn__arDS) { $pp = "p003a-1a";
  global $RA;
  if (!isset($RA[RA_cn__arDS][$cn__arDS])) {

    $ep = "$pp-e1";
    $msg = "$ep Bad __arDS($cn__arDS) not found";
    dol([$msg]);
    throw new (Eception $msg)
  }

}

function _DSC($dsc_rule) { $pp = "p003a-2a";
  global $RA;

}