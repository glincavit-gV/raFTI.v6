<?php
include_once '_o002a_raCORE__acPP_ini.php';


function _raCORE_api($step, $arg_val) { $pp = "p00Za-0a";
  global $RA;
  switch ($step) {
    case 'v6_0':
        _raCORE_dropDB();
        _raCORE_iniTables();
        break;
  }
}