<?php
include_once '_o002a_raCore__acPP_ini.php';
include_once '_o003a_raCore__acPP_raDS.php';


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
        $_raDS_test = '_logVER__acTG_testObj';// '_raRES__arP'; //'_liMIN'; //_altMIN
        $_raDS_num = "t5";
        $_raDS_name = "$_raDS_num.Simple test for _raDS_test($_raDS_test)";
        du($RA[RA_cn__DS][$_raDS_test]);
        $_raDS_ret = _raDS_trans($_raDS_test);
        if ($_raDS_test == $_raDS_ret) dul(["$_raDS_name - passed"], 1);
        else dul(["$_raDS_name - FAILED, _raDS_ret($_raDS_ret)"], 1);
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
    case 'v6_5':
        $RA[RA_sql_stop] = 1;
        _raCore_iniTables();
        $RA[RA_sql_stop] = 0;
        du("133 $step", $step, $RA[RA_cn__DS]['@gV']);
        dd("133 $step", $step, $RA[RA_cn__DS]['@gV']);
        break;
  }
}