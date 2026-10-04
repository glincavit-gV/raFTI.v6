<?php
include_once '_o002a_raCore__acPP_ini.php';

// _p00Za
function _raCORE_api($step, $arg_val) {
  global $RA;
  switch ($step) {
    case 'v6_0':
        _raCore_dropDB();
        _raCore_iniTables();
        break;
  }
}