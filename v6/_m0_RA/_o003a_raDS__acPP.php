<?php
include_once '_o001a_raCore__acPP_meta.php';
include_once '_o002a_raCore__acPP_ini.php';

function _raDS_calc($cn__arDS) { $pp = "p003a-0a";
  global $RA;
  $_DS_ref = "_arDS";
  $_DS_ver = "1.0.$_DS_ref test integral";
  if (!($RA[RA_ver_stop]++)) duv($_DS_ver, $_DS_ref, $pp);
  //echo "\n$cn__arDS\n";
  $RA[RA_DS] = $DS_ret = [];
  $RA[RA_DS][DS_cn__arDS] = $cn__arDS;
  extract($RA[RA__tySEP]);
  extract($RA[RA_cn__arDS][$RA[RA_DS][DS_cn__arDS]], EXTR_PREFIX_ALL, 'DS');
  $te_arr = explode($_sepPART, $DS_te__EXPR);
  $rule__EXPR_arr = explode($_sepLIST, $DS_rule__EXPR);
  $_dsABR = $rule__EXPR_arr[RA_rule__EXPR_dsABR];
  if (!isset($RA[RA_cn__arDS][$_dsABR])) {

    $ep = "$pp-e1";
    $RA[RA_log][] = "$ep cn__arDS($cn__arDS) reule__EXPR($DS_reule__EXPR) not found as registered rule _dsABR($_dsABR)";
  } else {
    foreach ($te_arr as $te_el) {
      $dso_arr = explode($_sepOPTION, $te_el);
      $RA_rule__EXPR_cnt = RA_rule__EXPR_cnt;
      if (($cnt = count($rule__EXPR_arr)) != $RA_rule__EXPR_cnt) {

        $ep = "$pp-e2";
        $RA[RA_log][] = "$ep cn__arDS($cn__arDS) reule__EXPR($DS_reule__EXPR) has count of rules($cnt) != expecting($RA_rule__EXPR_cnt)";
      } else {
        switch ($dso_arr[0]) {
          case 'fcc':
            $DS_ret[] = [DS_ret_fcc => $DS_fcc__svQB];
            break;
          case 'dst':
            if ($DS_cn__TY == '') {

              $ep = "$pp-e3";
              $RA[RA_log][] = "$ep cn__arDS($cn__arDS) te__EXPR($DS_te__EXPR) has (dst) component but cn__TY field is empty";
            } else {
              $DS_ret[] = [DS_ret_dst => strtr($DS_cn__TY, ['_' => ''])];
            }
            break;
          case 'dso':
            if (count($dso_arr) == 1) {

              $ep = "$pp-e5";
              $RA[RA_log][] = "$ep cn__arDS($cn__arDS) te__EXPR($DS_te__EXPR) has (dso) component($te_el) and it don't have the options separated with ($_sepOPTION)";
            } else {
              $DS_ret[] = [DS_ret_dso => __dsTE_calc($dso_arr, 1)];
            }
            break;
          case 'ds':
            $DS_ret[] = [DS_ret_dsx => __dsTE_calc(explode($_sepOPTION, $rule__EXPR_arr[RA_rule__EXPR_dsx]), 0)];
          case 'dsn':
            $DS_ret[] = [DS_ret_dsn => __dsTE_calc(explode($_sepOPTION, $rule__EXPR_arr[RA_rule__EXPR_dsn]), 0)];
            break;
          case 'dsx':
            $DS_ret[] = [DS_ret_dsx => __dsTE_calc(explode($_sepOPTION, $rule__EXPR_arr[RA_rule__EXPR_dsx]), 0)];
            break;
          case $_sepCN:
          case $_sepTY:
          case $_sepPER:
            $DS_ret[] = [DS_ret_sep => $te_el];
        }
//du("dbg-1 ret =", $DS_ret);
      }
    }
  }
  if (__check_err()) return '';
  $_dsABR_arr = explode($_sepADD, $RA[RA_cn__arDS][$_dsABR]['cxF__EXPR']);
  $DS_dsABR_ret = '';
  foreach ($DS_ret as $DS_ret_arr) {
    switch (key($DS_ret_arr)) {
      case DS_ret_dst:
      case DS_ret_dso:
        $DS_dsABR_ret .= __dsTE_abris($_dsABR_arr[RA_dsABR_rest], current($DS_ret_arr));
        break;
      case DS_ret_fcc:
      case DS_ret_sep:
        $DS_dsABR_ret .= current($DS_ret_arr);
        break;
      case DS_ret_dsx:
        $DS_dsABR_ret .= __dsTE_abris($_dsABR_arr[RA_dsABR_dsx], current($DS_ret_arr));
        break;
      case DS_ret_dsn:
        $DS_dsABR_ret .= __dsTE_abris($_dsABR_arr[RA_dsABR_dsn], current($DS_ret_arr));
        break;
    }
  }
  return $DS_dsABR_ret;
}

function __dsTE_calc(array $ds_arr, $ds_i) { $pp = "p004a-1a";
  global $RA;
  $__dsTE_ret = '';
  for($ds_arr_i = $ds_i; $ds_arr_i < count($ds_arr); $ds_arr_i++) {
    $ds_el = $ds_arr[$ds_arr_i];
    do {
      $__dsTE_ret .= __rule_calc($ds_el);
//du("dbg-2 _altTKN.p1=$__dsTE_ret", $RA[RA_DS][DS_ruleFLD]); if(isset($RA[RA_DS][DS_arr_cnt][$RA[RA_DS][DS_ruleFLD]])) du($RA[RA_DS][DS_arr_cnt][$RA[RA_DS][DS_ruleFLD]], $RA[RA_DS][DS_arr_i][$RA[RA_DS][DS_ruleFLD]]);
    } while (1 == 1
              && isset($RA[RA_DS][DS_arr_cnt][$RA[RA_DS][DS_ruleFLD]])
              && $RA[RA_DS][DS_arr_cnt][$RA[RA_DS][DS_ruleFLD]] > $RA[RA_DS][DS_arr_i][$RA[RA_DS][DS_ruleFLD]]
              && end($RA[RA_DS][DS_altTKN][$RA[RA_DS][DS_ruleFLD]]) == '_numR'
    );
  }
  return $__dsTE_ret;
}

function __dsTE_abris($dsABR, $dsRET) { $pp = "p004a-2a";
  return ($dsABR == '_abrU'
    ? strtoupper($dsRET)
    : ($dsABR == '_abrS'
      ? strtolower($dsRET)
      : ($dsABR == '_abrH'
        ? ucfirst(strtolower($dsRET))
        : $dsRET
      )
    )
  );
}

function __rule_calc($rule_el) { $pp = "p003a-3a";
  global $RA;
  extract($RA[RA__tySEP]);
  $cn__arDS = $RA[RA_DS][DS_cn__arDS];
  $rule_arr = explode($_sepCN, $rule_el);
  if (1 != 1
      || ($rule_cnt = count($rule_arr)) < 2
      || $rule_cnt > 3
      || ($bad_tkn = !isset($RA[RA_cn__arDS][$rule_el])
      || ($bad_tkn = (($_tknNUM = $RA[RA_cn__arDS][$rule_el]['cxN__arDS']) != '_tknNUM' ? 1 : 0)))
  ) {
    if ($bad_tkn) {
      
      $ep = "$pp-e1";
      $RA[RA_log][] = "$ep cn__arDS($cn__arDS) rule_el($rule_el) has bad (_tknNUM) != ($_tknNUM) in its cxN__arDS field";
    } else {

      $ep = "$pp-e2";
      $RA[RA_log][] = "$ep cn__arDS($cn__arDS) rule_el($rule_el) has bad _sepCN($_sepCN) prefix count($rule_cnt) of parts, not betwen (2, 3)";
    }
  } else {
    $tknNUM_arr = explode($_sepADD, explode($_sepOPTION, $RA[RA_cn__arDS][$rule_el]['cxF__EXPR'])[0]);
    if ($rule_cnt == 2) { // source $RA[RA_DS][DS_cn__arDS]]['main__bvPQ']
      $_altTKN = $tknNUM_arr[0];
      $_altNUM = $tknNUM_arr[1];
      $_altNUM_for_cnt = $rule_el;
      $ruleFLD = 'main__bvPQ';
      $innPATT = "/###/";
      $ruleFLD_sep = "\s*[$_sepPART_Q-]\s*|\s+";
    } else {
      $ruleFLD = explode($_sepOPTION, $RA[RA_cn__arDS][$tknNUM_arr[0]]['cxF__EXPR'])[0];
      $innPATT = $RA[RA_cn__arDS][$tknNUM_arr[0]]['val__bvPQ'];
      $_altNUM_for_cnt = $tknNUM_arr[1];
      $tknNUM_arr = explode($_sepADD, explode($_sepOPTION, $RA[RA_cn__arDS][$tknNUM_arr[1]]['cxF__EXPR'])[0]);
      $_altTKN = $tknNUM_arr[0];
      $_altNUM = $tknNUM_arr[1];
      $ruleFLD_sep = $_sepADD_Q;
    }
//echo "\n dbg-3 - _altTKN($_altTKN), _altNUM($_altNUM), ruleFLD($ruleFLD), ruleFLD_sep($ruleFLD_sep)";
    $RA[RA_DS][DS_ruleFLD] = $ruleFLD;
    if ($rule_el == '_ZA') {
      if (isset($RA[RA_DS][DS_arr][$ruleFLD])) {
        $RA[RA_DS][DS_arr_i][$ruleFLD]++;
      }
      return '';
    }
    if (!isset($RA[RA_DS][DS_altTKN][$ruleFLD][$_altTKN])) {
      $cxF__EXPR = $RA[RA_cn__arDS][$_altTKN]['cxF__EXPR'];
      if (strpos($cxF__EXPR, '_altFUNC') === false) {
      
        $ep = "$pp-e3";
        $RA[RA_log][] = "$ep cn__arDS($cn__arDS) rule_el($rule_el) has bad _altTKN($_altTKN) - not _altFUNC like token in cxF__EXPR($cxF__EXPR) field";
      } else {
        if (!isset($RA[RA_DS][DS_arr][$ruleFLD])) {
          $RA[RA_DS][DS_arr][$ruleFLD] = preg_split("/$ruleFLD_sep/", explode($_sepOPTION, $RA[RA_cn__arDS][$RA[RA_DS][DS_cn__arDS]][$ruleFLD])[0]);
          $RA[RA_DS][DS_arr_cnt][$ruleFLD] = count($RA[RA_DS][DS_arr][$ruleFLD]);
          $RA[RA_DS][DS_arr_i][$ruleFLD] = 0;
        }
        $_func_TKN_arr = explode($_sepOPTION, $RA[RA_cn__arDS][$_altTKN]['cxF__EXPR']);
        $outPATT = $RA[RA_cn__arDS][$_altTKN]['val__bvPQ'];
        $_func_TKN = end($_func_TKN_arr);
//du("dbg-5 _func_TKN($_func_TKN), _altTKN innPATT($innPATT), outPATT($outPATT), _altNUM val=", $RA[RA_cn__arDS][$_altNUM]['val__bvPQ'],  $RA[RA_DS][DS_arr][$ruleFLD]);
        foreach ($RA[RA_DS][DS_arr][$ruleFLD] as $tkn_i => $tkn_word) {
          $RA[RA_DS][DS_arr][$ruleFLD][$tkn_i] = $_func_TKN($innPATT, $outPATT, $tkn_word);
          $RA[RA_DS][DS_tkn_cnt][$ruleFLD][$tkn_i] = strlen($RA[RA_DS][DS_arr][$ruleFLD][$tkn_i]);
          $RA[RA_DS][DS_tkn_i][$ruleFLD][$tkn_i] = 0;
        }
        if ($_altTKN == '_tknW' && $_altNUM != '_numR') {
          $RA[RA_DS][DS_arr_cnt][$ruleFLD] = (int) $RA[RA_cn__arDS][$_altNUM]['val__bvPQ'];
          $_altNUM = '_numR';
        }
        $RA[RA_DS][DS_altTKN][$ruleFLD][$_altTKN] = $_altNUM;
      }
    }
  }
  if ($RA[RA_DS][DS_arr_cnt][$ruleFLD] <= $RA[RA_DS][DS_arr_i][$ruleFLD]) {

    $ep = "$pp-e5";
    $RA[RA_log][] = "$ep cn__arDS($cn__arDS) rule_el($rule_el) Bad \$RA[RA_DS][DS_arr_cnt][\$_altTKN] <= \$RA[RA_DS][DS_tkn_i][\$_altTKN]:\n"
    . $RA[RA_DS][DS_arr_cnt][$ruleFLD] . " <= " . $RA[RA_DS][DS_arr_i][$ruleFLD];
  }
  if (__check_err()) return ' ERROR ';
  $_altNUM_add = (int) $RA[RA_cn__arDS][$_altNUM_for_cnt]['val__bvPQ'];
  if (strpos($RA[RA_cn__arDS][$_altNUM]['cxF__EXPR'], '_altFUNC') !== false) {
    $_func_NUM = explode($_sepOPTION, $RA[RA_cn__arDS][$_altNUM]['cxF__EXPR'])[0];
    $calc_ret = $_func_NUM($RA[RA_cn__arDS][$_altNUM]['val__bvPQ'], '', $RA[RA_DS][DS_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]]);
  } else {
    /*
    if ($_altNUM_add > 0) {
      $calc_ret = substr($RA[RA_DS][DS_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]]
        , $RA[RA_DS][DS_tkn_i][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]]
        , $_altNUM_add
      );
    } else {
      $calc_ret = substr($RA[RA_DS][DS_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]]
        , $_altNUM_add
      );
    }
    */
    if ($_altNUM_add > 0) {
      $calc_ret = substr($RA[RA_DS][DS_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]], 0, $_altNUM_add);
      $RA[RA_DS][DS_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]] = substr($RA[RA_DS][DS_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]], $_altNUM_add);
    } else {
      $calc_ret = substr($RA[RA_DS][DS_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]], $_altNUM_add);
    }
  }
//du("dbg-4 calc_ret($calc_ret)", $RA[RA_DS][DS_arr][$ruleFLD], $RA[RA_DS][DS_tkn_i][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]], $_altNUM_add, $RA[RA_cn__arDS][$_altNUM]['cxF__EXPR']);
  $RA[RA_DS][DS_tkn_i][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]] += $_altNUM_add;
  if ($RA[RA_DS][DS_tkn_cnt][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]] <= $RA[RA_DS][DS_tkn_i][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]]) {
    $RA[RA_DS][DS_arr_i][$ruleFLD]++;
  }
  return $calc_ret;
}

function __eraseInnOut($innPATT, $outPATT, $tkn_word) { $pp = "p003a-4a";
  return preg_replace($outPATT, '', preg_replace($innPATT, '', $tkn_word));
}

function __eraseInn($innPATT, $outPATT, $tkn_word) { $pp = "p003a-5a";
  return preg_replace($innPATT, '', $tkn_word);
}

function __unTuch($innPATT, $outPATT, $tkn_word) { $pp = "p003a-6a";
  return $tkn_word;
}

function __extractRef($innPATT, $outPATT, $tkn_word) { $pp = "p003a-7a";
  global $RA;
  if (isset($RA[RA_cn__arDS][$tkn_word]['val__bvPQ'])) {
    return $RA[RA_cn__arDS][$tkn_word]['val__bvPQ'];
  } else {

    $ep = "$pp-e1";
    $RA[RA_log][] = "$ep innPATT($innPATT)/outPATT($outPATT) has bad reference value - not found token in cn__arDS($tkn_word)";
    return " ERROR ";
  }
}

function __check_err() { $pp = "p003a-8a";
  global $RA;
  if ($RA[RA_log]) {
    $msg = end($RA[RA_log]);
    dul($RA[RA_log]);
    throw new Exception($msg);
    return true;
  }
  return false;
}

function _raDS_test_all() { $pp = "p003a-9a";
  global $RA;  
  $RA[RA_sql_stop] = 1;
  _raCore_iniTables();
  $RA[RA_sql_stop] = 0;
  dul(["$pp-s1 Test ALL is running ...\n"], 1);
  _raDS_test_one('_OM');
  echo "\n";
  _raDS_test_one('_raALT');
  echo "\n";
  $cnt = $errs = 0;
  foreach ($RA[RA_cn__arDS] as $cn__arDS => $cn_arr) if (isset($cn_arr['te__EXPR'])) if (_raDS_test_one($cn__arDS, ++$cnt)) $errs++;
  dul(["\nTotal test FAILED($errs) from($cnt)"], 1);
  return $errs;
}

function _raDS_test_one($cn__arDS, $cnt = 0) { $pp = "p003a-10a";
  $ret__arDS = _raDS_calc($cn__arDS);
  $msg = str_pad("\r " . ($cnt ? "$cnt - " : "") . "cn__arDS($cn__arDS) - " . (($ret_failed = ($ret__arDS != $cn__arDS)) ? "FAILED ret__arDS($ret__arDS)" : "Passed ... "), 160);
  if ($ret_failed) dul([$msg. "\n"], 1);
  else echo $msg;
  return $ret_failed;
}

function _raDS_test_integral() { $pp = "p003a-11a";
  global $RA;  
  $RA[RA_sql_stop] = 1;
  _raCore_iniTables();
  $RA[RA_sql_stop] = 0;
  dul(["$pp-s1 Test Integral running ...\n"], 1);
  if (_raDS_test_all()) dz(["1. Test ALL - FAILED!"], 1);
  dul (["1. Test ALL -  Pased ..."], 1); 
  echo "\n";
  $cnt = $errs = 0;
}
