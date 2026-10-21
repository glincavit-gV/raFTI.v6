<?php
include_once '_o002a_raCore__acPP_ini.php';
include_once '_o003a_raDS__acPP.php';


function _raCore_api($step, $arg_val) { $pp = "p00Za-0a";
  global $RA;
  switch ($step) {
    case 'v6_0':
        _raCore_dropDB();
        _raCore_iniTables();
        break;
    case 'v6_1':
        //_raCore_dropDB();
        $RA[RA_sql_stop] = 1;
        _raCore_iniTables();
        $RA[RA_sql_stop] = 0;
        $_arDS_test = '@gV';// '_raRES__arP'; //'_liMIN'; //_altMIN
        $_arDS_num = "t5";
        $_arDS_name = "$_arDS_num.Simple test for _arDS_test($_arDS_test)";
        du($RA[RA_cn__arDS][$_arDS_test]);
        $_arDS_ret = _raDS_calc($_arDS_test);
        if ($_arDS_test == $_arDS_ret) dul(["$_arDS_name - passed"], 1);
        else dul(["$_arDS_name - FAILED, _arDS_ret($_arDS_ret)"], 1);
        break;
    case 'v6_2':
        _raDS_test_all();
        break;
    case 'v6_3':
        _raDS_test_integral();
        break;
    case 'v6_4':
        _raCore_createSQL();
        break;
  }
}