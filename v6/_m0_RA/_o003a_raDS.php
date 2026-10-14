<?php
include_once '_o001a_raCORE__acPP_meta.php';
include_once '_o002a_raCORE__acPP_ini.php';

function _raDS_ini($cn__arDS) { $pp = "p003a-0a";
  global $RA;
  $RA[DS_main_tknW_i] = 0;
  $RA[DS_cn__arDS] = $cn__arDS;

}

function _raDS_calc($cn__arDS) { $pp = "p003a-1a";
  global $RA;
   _raDS_ini($cn__arDS);
  extract($RA[RA__tySEP]);
  extract($RA[RA_cn__arDS][$RA[DS_cn__arDS]], EXTR_PREFIX_ALL, 'DS');
  $te_arr = explode($_sepALT, $DS_te__EXPR);
  $RA[DS_ret] = '';
  foreach ($te_arr as $te_el) {
    $dso_arr = explode($_sepOPTION, $te_el);
    switch ($dso_arr[0]) {
      case 'ds':
        break;
      case 'dsx':
        break;
      case 'dsn':
        break;
      case 'dst':
        if ($DS_cn__TY == '') {

          $ep = "$pp-e1";
          $RA[RA_log][] = "$ep te__EXPR($DS_te__EXPR) has (dst) component but cn__TY field is empty";
        } else {
          $ty_arr = explode($_sepTY, $DS_cn__TY);
          if (($cnt = count($ty_arr)) != 2) {

            $ep = "$pp-e2";
            $RA[RA_log][] = "$ep cn__TY($DS_cn__TY) has bad type prefix signal($_sepTY) count($cnt), not equal with: 2";
          } else {
            $RA[DS_ret][] = ['dst' => $ty_arr[1]];
          }
        }
        break;
      case 'dso':        
        if (count($dso_arr) == 1) {

          $ep = "$pp-e3";
          $RA[RA_log][] = "$ep te__EXPR($DS_te__EXPR) has (dso) component($te_el), it don't have the options separated with ($_sepOPTION)";
        } else {
          __dso_calc($dso_arr, 1);
        }
        break;
      default:
        $RA[DS_ret][] = ['sep' => $te_el];
    }
  }
  __check_err();
}

function __dso_calc(array $dso_arr, $dso_i) { $pp = "p003a-2a";
  global $RA;
  for($dso_arr_i = $dso_i; $dso_arr_i < count($dso_arr); $dso_arr_i++) {
    $dso_el = $dso_arr[$dso_arr_i];
    __rule_calc($dso_el);
  }  
}

function __rule_calc($rule_el) { $pp = "p003a-3a";
  global $RA;
  extract($RA[RA__tySEP]);
  $rule_arr = explode($_sepCN, $rule_el);  
  if (($cnt = count($rule_arr)) < 2 || $cnt > 3 || ($bad_tkn = !isset($RA[RA_cn__arDS][$rule_el] || ($bad_tkn = (($_tknNUM = RA[RA_cn__arDS][$rule_el]['cxN__arDS']) != '_tknNUM' ? 1 : 0))))) {
    if ($bad_tkn) {
      
      $ep = "$pp-e1";
      $RA[RA_log][] = "$ep rule_el($rule_el) has bad _tknNUM($_tknNUM) in its cxN__arDS field";
    }
    if ($cnt < 2 || $cnt > 3) {

      $ep = "$pp-e2";
      $RA[RA_log][] = "$ep rule_el($rule_el) has bad _sepCN($_sepCN) prefix count($cnt), not betwen (2, 3)";
    }
  } else {
    if ($cnt == 2) {
      $_altTKN = "_tkn" . substr($rule_arr[1], 0, 1);
      if (!isset($RA[RA_cn__arDS][$_altTKN]) || $RA[RA_cn__arDS][$_altTKN]['cxN__arDS'] != '_altTKN' || strpos($RA[RA_cn__arDS][$_altTKN]['cxF__EXPR'], '_altNUM') !== false) {
      
        $ep = "$pp-e3";
        $RA[RA_log][] = "$ep rule_el($rule_el) has bad _altTKN($_altTKN) in 1-st subpart of _tknNUM($_tknNUM) or bad cxF__EXPR include _altNUM";
      } else {
        $_altNUM = "_num" . substr($rule_arr[1], 1);
        if (!isset($RA[RA_cn__arDS][$_altNUM]) || $RA[RA_cn__arDS][$_altNUM]['cxN__arDS'] != '_altNUM') {
        
          $ep = "$pp-e4";
          $RA[RA_log][] = "$ep rule_el($rule_el) has bad _altNUM($_altNUM) in 2-nd subpart of _tknNUM($_tknNUM)";
        } else {
          __DS_main_calc($_altTKN, $_altNUM);
          /*
          $func = "__DS_main{$_altTKN}__calc";
          if (function_exists($func)) {
            $func($_altNUM);
          } else {
        
            $ep = "$pp-e5";
            $RA[RA_log][] = "$ep rule_el($rule_el) for _altTKN($_altTKN) has bad function name($func)";
          }
            */
        }
      }
    } else {

    }
  }
  __check_err();
}

function __DS_main_calc($_altTKN, $_altNUM) { $pp = "p003a-4a";
  global $RA;
  __DS_main_check($_altTKN);
  switch ($_altNUM) {
    case '_numAA':
      break;
    case '_numN':
      
      break;
    case '_numX':
      
      break;
    case '_numTY':
      
      break;
    default:
      if (!isset($RA[DS_main_arr][$_altTKN])) {
        $RA[DS_main_arr][$_altTKN] = explode($RA[RA__tySEP]['_sepWORD'], $RA[RA_cn__arDS][$RA[DS_cn__arDS]]['main__vbPQ']);
        $RA[DS_main_arr_cnt] = count($RA[DS_main_arr][$_altTKN]);
        $patt = $RA[RA_cn__arDS][$_altTKN]['val__vbPQ'];
        foreach ($RA[DS_main_arr][$_altTKN] as $main_i => $main_word) {
          $RA[DS_main_arr][$_altTKN][$main_i] = preg_replace("/$patt/i", '', $main_word);
          $RA[DS_main_arr_tkn_cnt][$_altTKN][$main_i] = strlen($RA[DS_main_arr][$_altTKN][$main_i]);
        }
      }
      $RA[DS_ret][] = substr($RA[DS_main_arr][$_altTKN][$RA[DS_main_numW_i]]
        , $RA[DS_main_arr_i][$_altTKN]
        , $RA[RA_cn__arDS][$_altNUM]['val__vbPQ']
      );
      $RA[DS_main_arr_i][$_altTKN] += $RA[RA_cn__arDS][$_altNUM]['val__vbPQ'];
      if ($RA[DS_main_arr_cnt][$_altTKN][$RA[DS_main_tknW_i]] < $RA[DS_main_arr_i][$_altTKN]) {
        $RA[DS_main_arr_i][$_altTKN] = 0;
        $RA[DS_main_numW_i]++;
      }
  }
}

function __check_err() { $pp = "p003a-5a";
  global $RA;
  if ($RA[RA_log]) {
    $msg = end($RA[RA_log]);
    dol($RA[RA_log]);
    throw new Exception($msg);
  }
}

function __DS_main_check($_altTKN) { $pp = "p003a-6a";
  global $RA;
  if ($RA[DS_main_numW_i] >= $RA[DS_main_arr_cnt]) {

    $ep = "$pp-e1";
    $RA[RA_log][] = "$ep Bad(RA[DS_main_numW_i] >= RA[DS_main_arr_cnt]):\n"
    . $RA[DS_main_numW_i] . " >= " . $RA[DS_main_arr_cnt];
  }
  if ($RA[DS_main_arr_cnt][$_altTKN][$RA[DS_main_tknW_i]] < $RA[DS_main_arr_i][$_altTKN]) {

    $ep = "$pp-e2";
    $RA[RA_log][] = "$ep Bad(RA[DS_main_arr_cnt][_altTKN][RA[DS_main_tknW_i]] < RA[DS_main_arr_i][_altTKN]):\n"
    . $RA[DS_main_arr_cnt][$_altTKN][$RA[DS_main_tknW_i]] . " < " .  $RA[DS_main_arr_i][$_altTKN];
  }
  __check_err();
}

function __DS_main_split($_altTKN) { $pp = "p003a-9a";
  global $RA;
  $RA[DS_main_arr][$_altTKN] = explode($RA[RA__tySEP]['_sepWORD'], $RA[RA_cn__arDS][$RA[DS_cn__arDS]]['main__vbPQ']);
  $RA[DS_main_arr_cnt] = count($RA[DS_main_arr][$_altTKN]);
  $patt = $RA[RA_cn__arDS][$_altTKN]['val__vbPQ'];
  foreach ($RA[DS_main_arr][$_altTKN] as $main_i => $main_word) {
    $RA[DS_main_arr][$_altTKN][$main_i] = preg_replace("/$patt/i", '', $main_word);
    $RA[DS_main_arr_tkn_cnt][$_altTKN][$main_i] = strlen($RA[DS_main_arr][$_altTKN][$main_i]);
  }
}
