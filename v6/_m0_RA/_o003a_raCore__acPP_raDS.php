<?php
include_once '_o001a_raCore__acPP_meta.php';
include_once '_o002a_raCore__acPP_ini.php';

function _raDS_trans($cn__DS) { $pp = "p003a-0a";
  global $RA;
  $_DS_ref = "_raDS";
  $_DS_ver = "1.3.$_DS_ref new _raDS disign with modiviers as 4-th dimension of rules";
  if (!($RA[RA_ver_stop]++)) duv($_DS_ver, $_DS_ref, $pp);
//de("0a-1-u1 $cn__DS");
  $RA[RA_DS] = $DS_ret = [];
  $RA[RA_DS][DS_cn__DS] = $cn__DS;
  $RA[RA_DS][DS_ruleFLD] = $RA[RA_DS][DS_TKN_FLD] = 0;
  extract($RA[RA_cn__DS][$RA[RA_DS][DS_cn__DS]], EXTR_PREFIX_ALL, 'DS');
  $te_arr = explode(RA_sepPART, $DS_te__EXPR);
  $rule__EXPR_arr = explode(RA_sepLIST, $DS_rule__EXPR);
  $_dsABR = $rule__EXPR_arr[RA_rule__EXPR_dsABR];
  if (!isset($RA[RA_cn__DS][$_dsABR])) {

    $ep = "$pp-e1";
    $RA[RA_log][] = "$ep cn__DS($cn__DS) reule__EXPR($DS_reule__EXPR) not found as registered rule _dsABR($_dsABR)";
  } else {
    $DS_pred[DS_ret_dsx] = __dsTE_trans(explode(RA_sepOPTION, $rule__EXPR_arr[RA_rule__EXPR_dsx]));
    $DS_pred[DS_ret_dsn] = __dsTE_trans(explode(RA_sepOPTION, $rule__EXPR_arr[RA_rule__EXPR_dsn]));
    foreach ($te_arr as $te_el) {
      $dso_arr = explode(RA_sepOPTION, $te_el);
      if (($cnt = count($rule__EXPR_arr)) != RA_rule__EXPR_cnt) {

        $ep = "$pp-e2";
        $RA[RA_log][] = "$ep cn__DS($cn__DS) reule__EXPR($DS_reule__EXPR) has count of rules($cnt) != expecting(".RA_rule__EXPR_cnt.")";
      } else {
        switch ($dso_arr[0]) {
          case 'fcc':
            $DS_ret[] = [DS_ret_fcc => $DS_fcc__svQB];
            break;
          case 'dst':
            if ($DS_cn__TY == '') {

              $ep = "$pp-e3";
              $RA[RA_log][] = "$ep cn__DS($cn__DS) te__EXPR($DS_te__EXPR) has (dst) component but cn__TY field is empty";
            } else {
              $DS_ret[] = [DS_ret_dst => strtr($DS_cn__TY, ['_' => ''])];
            }
            break;
          case 'dso':
            if (count($dso_arr) == 1) {

              $ep = "$pp-e5";
              $RA[RA_log][] = "$ep cn__DS($cn__DS) te__EXPR($DS_te__EXPR) has (dso) component($te_el) and it don't have the options separated with (RA_sepOPTION)";
            } else {
              for($dso_arr_i = 1; $dso_arr_i < count($dso_arr); $dso_arr_i++) {
                $DS_ret[] = [($dso_arr_i == 1 ? DS_ret_dso : DS_ret_dson) => __dsTE_trans([$dso_arr[$dso_arr_i]])];
              }
            }
            break;
          case 'ds':
            $DS_ret[] = [DS_ret_dsx => $DS_pred[DS_ret_dsx]]; // [DS_ret_dsx => __dsTE_trans(explode(RA_sepOPTION, $rule__EXPR_arr[RA_rule__EXPR_dsx]))];
          case 'dsn':
            $DS_ret[] = [DS_ret_dsn => $DS_pred[DS_ret_dsn]]; //[DS_ret_dsn => __dsTE_trans(explode(RA_sepOPTION, $rule__EXPR_arr[RA_rule__EXPR_dsn]))];
            break;
          case 'dsx':
            $DS_ret[] = [DS_ret_dsx => $DS_pred[DS_ret_dsx]]; // [DS_ret_dsx => __dsTE_trans(explode(RA_sepOPTION, $rule__EXPR_arr[RA_rule__EXPR_dsx]))];
            break;
          default:
            $DS_ret[] = [DS_ret_sep => $te_el];
        }
//du("0a-1-u2", $DS_ret);
      }
    }
  }
  if (__check_err()) return '';
  $_dsABR_arr = explode(RA_sepADD, $RA[RA_cn__DS][$_dsABR]['cxF__EXPR']);
  $DS_dsABR_ret = '';
  foreach ($DS_ret as $DS_ret_arr) {
    switch (($DS_ret_key = key($DS_ret_arr))) {
      case DS_ret_dst:
      case DS_ret_dso:
      case DS_ret_dson:
        $DS_dsABR_ret .= __dsTE_abris($_dsABR_arr[RA_dsABR_rest], current($DS_ret_arr), $DS_ret_key);
        break;
      case DS_ret_fcc:
      case DS_ret_sep:
        $DS_dsABR_ret .= current($DS_ret_arr);
        break;
      case DS_ret_dsx:
        $DS_dsABR_ret .= __dsTE_abris($_dsABR_arr[RA_dsABR_dsx], current($DS_ret_arr), $DS_ret_key);
        break;
      case DS_ret_dsn:
        $DS_dsABR_ret .= __dsTE_abris($_dsABR_arr[RA_dsABR_dsn], current($DS_ret_arr), $DS_ret_key);
        break;
    }
  }
  return $DS_dsABR_ret;
}

function __dsTE_trans(array $ds_arr) { $pp = "p003a-1a";
  global $RA;
  $__dsTE_ret = '';
  for($ds_arr_i = 0; $ds_arr_i < count($ds_arr); $ds_arr_i++) {
    $ds_el = $ds_arr[$ds_arr_i];
    do {
      $__dsTE_ret .= __rule_trans($ds_el);
de("1a-1-u1",$__dsTE_ret, $RA[RA_DS][DS_ruleFLD]); if(isset($RA[RA_DS][DS_arr_cnt][$RA[RA_DS][DS_ruleFLD]])) de("1a-2-u1",$RA[RA_DS][DS_FLD][$RA[RA_DS][DS_ruleFLD]],$RA[RA_DS][DS_arr_cnt][$RA[RA_DS][DS_ruleFLD]], $RA[RA_DS][DS_arr_i][$RA[RA_DS][DS_ruleFLD]]);
    } while (1 == 1
              && isset($RA[RA_DS][DS_arr_cnt][$RA[RA_DS][DS_ruleFLD]])
              && $RA[RA_DS][DS_arr_cnt][$RA[RA_DS][DS_ruleFLD]] > $RA[RA_DS][DS_arr_i][$RA[RA_DS][DS_ruleFLD]]
              && $RA[RA_DS][DS_FLD][$RA[RA_DS][DS_ruleFLD]] == '_numR'
    );
  }
  return $__dsTE_ret;
}

function __dsTE_abris($dsABR, $dsRET, $dsRET_key) { $pp = "p003a-2a";
  switch ($dsABR) {
    case '_abrU':
      return strtoupper($dsRET);
    case '_abrS':
      return strtolower($dsRET);
    case '_abrH':
      return ucfirst(strtolower($dsRET));
    case '_abrC':
      if ($dsRET_key == DS_ret_dson) return ucfirst(strtolower($dsRET));
    case '_abrZ':
      return $dsRET;
  }
}

function __rule_parse($rule_el) { $pp = 'p003a-3a';
  global $RA;

  $parts = explode(RA_sepSTRUC, $rule_el);
  if (($parts_cnt = count($parts)) == 1) {
    $op = $rule_el;
    if (!($is_set_op = isset($RA[RA_cn__DS][$op])) || $RA[RA_cn__DS][$op]['cxN__DS'] != '_tknNUM') {
      $RA[RA_log][] = "$pp-e1 Bad operation($op) in rule($rule_el) isset(\$op)($is_set_op)";
    } else {
      $op_expr = explode(RA_sepADD, explode(RA_sepOPTION, $RA[RA_cn__DS][$op]['cxF__EXPR'])[0]);
      if (count($op_expr) != 2) {
        $RA[RA_log][] = "$pp-e2 Bad operation definition($op).cxF__EXPR elements count != 2";
      } else {
        $src_tkn = $_altTKN = $op_expr[0];
        $_altNUM = $op_expr[1];
        $innPATT = $RA[RA_cn__DS]['_exM']['val__bvPQ'];
      }
    }
  } elseif ($parts_cnt == 2) {
    list($src_tkn, $op) = $parts;
    if (!($is_set_op = isset($RA[RA_cn__DS][$op])) || $RA[RA_cn__DS][$op]['cxN__DS'] != '_tknNUM') {
      $RA[RA_log][] = "$pp-e3 Bad operation($op) in rule($rule_el) isset(\$op)($is_set_op)";
    } else {
      $op_expr = explode(RA_sepADD, explode(RA_sepOPTION, $RA[RA_cn__DS][$op]['cxF__EXPR'])[0]);
      if (count($op_expr) != 2) {
        $RA[RA_log][] = "$pp-e4 Bad operation definition($op).cxF__EXPR elements count != 2";
      } else {
        list($_altTKN, $_altNUM) = $op_expr;
        $innPATT = $RA[RA_cn__DS][$src_tkn]['val__bvPQ'];
      }
    }
  } else {
    $RA[RA_log][] = "$pp-e5 Bad rule($rule_el): structure depth > 2";
  }
  if (!($is_set_src = isset($RA[RA_cn__DS][$src_tkn])) || !in_array($RA[RA_cn__DS][$src_tkn]['cxN__DS'], ['_altTKN', '_tknNUM'])) {
    $RA[RA_log][] = "$pp-e6 Bad source($src_tkn) in rule($rule_el) isset(\$src)($is_set_src)";
  }
  $src_expr = explode(RA_sepOPTION, $RA[RA_cn__DS][$src_tkn]['cxF__EXPR']);
  __check_err();
  $ruleFLD = $src_expr[0];
  $_func_TKN = end($src_expr);
  return [
    '_altNUM_for_cnt' => $op,
    'ruleFLD' => $ruleFLD,
    '_func_TKN' => $_func_TKN,
    'innPATT' => $innPATT,
    '_altTKN' => $_altTKN,
    '_altNUM' => $_altNUM,
    'ruleFLD_sep' => ($ruleFLD == 'main__bvPQ' ? (in_array($_altTKN, ['_tknU', '_tknZ']) ? RA_sepSPACE : RA_sepWORD) : RA_sepADD_Q),
  ];
}

function __rule_trans($rule_el) { $pp = "p003a-4a";
  global $RA;
  $cn__DS = $RA[RA_DS][DS_cn__DS];
  $rule_arr = __rule_parse($rule_el);
  extract($rule_arr);
  if ($_altNUM_for_cnt == '_ZZ') {
    if (isset($RA[RA_DS][DS_arr_i][$RA[RA_DS][DS_ruleFLD]])) {
      $RA[RA_DS][DS_FLD][$RA[RA_DS][DS_ruleFLD]] = $RA[RA_DS][DS_arr_i][$RA[RA_DS][DS_ruleFLD]] = 0;
    }
    return '';
  }
  $_altNUM_add = (int) $RA[RA_cn__DS][$_altNUM_for_cnt]['val__bvPQ'];
de("3a-1-u1",$_altNUM_add, $rule_arr);
  if ($_altTKN == '_tknZ' && $RA[RA_DS][DS_ruleFLD]) {
    $ruleFLD = $RA[RA_DS][DS_ruleFLD];
  } else {
    $RA[RA_DS][DS_ruleFLD] = $ruleFLD;
  }
  $outPATT = $RA[RA_cn__DS][$_altTKN]['val__bvPQ'];
  if (!isset($RA[RA_DS][DS_FLD][$ruleFLD])) {
    $cxF__EXPR = $RA[RA_cn__DS][$_altTKN]['cxF__EXPR'];
    if (strpos($cxF__EXPR, '_altFUNC') === false) {
    
      $ep = "$pp-e1";
      $RA[RA_log][] = "$ep cn__DS($cn__DS) rule_el($rule_el) has bad _altTKN($_altTKN) - not _altFUNC like token in cxF__EXPR($cxF__EXPR) field";
    } else {
      if (!isset($RA[RA_DS][DS_arr][$ruleFLD])) {
        $ruleFLD_src = $ruleFLD;
        $RA_cn__DS_src = $RA[RA_DS][DS_cn__DS];
        if ($RA[RA_cn__DS][$_func_TKN]['cxF__EXPR'] != '') {
          $RA_cn__DS_src = $RA[RA_cn__DS][$RA_cn__DS_src][$ruleFLD_src];
          if (!isset($RA[RA_cn__DS][$RA_cn__DS_src])) {
    
            $ep = "$pp-e2";
            $RA[RA_log][] = "$ep cn__DS($cn__DS) rule_el($rule_el) _altTKN($_altTKN) - Not defined reference ($ref_val)";
          } else {
            $ruleFLD_src = $RA[RA_cn__DS][$_func_TKN]['cxF__EXPR'];
            $ruleFLD_sep = '###';
            if ($ruleFLD_src == 'main__bvPQ') {
              $ruleFLD_sep = RA_sepWORD;
            }
          }
          $RA[RA_DS][DS_arr][$ruleFLD] = preg_split("/$ruleFLD_sep/", $RA[RA_cn__DS][$RA_cn__DS_src][$ruleFLD_src]);
        } else {
          $RA[RA_DS][DS_arr][$ruleFLD] = preg_split("/$ruleFLD_sep/", explode(RA_sepOPTION, $RA[RA_cn__DS][$RA_cn__DS_src][$ruleFLD_src])[0]);
        }
        $RA[RA_DS][DS_arr_cnt][$ruleFLD] = count($RA[RA_DS][DS_arr][$ruleFLD]);
        $RA[RA_DS][DS_arr_i][$ruleFLD] = 0;
      }
de("3a-1-u2",$ruleFLD_src,$ruleFLD_sep, $innPATT, $outPATT, $RA[RA_cn__DS][$_altNUM]['val__bvPQ'],  $RA[RA_DS][DS_arr][$ruleFLD]);
      $RA[RA_DS][DS_FLD][$ruleFLD] = $_altNUM;
    }
  }
  $DS_TKN_FLD = $ruleFLD . $_altTKN;
  if (1 != 1
      || !$RA[RA_DS][DS_TKN_FLD]
      || (1 == 1
          && $_altTKN != '_tknZ'
          && $RA[RA_DS][DS_TKN_FLD] != $DS_TKN_FLD
      )
  ) {
    $RA[RA_DS][DS_TKN_FLD] = $DS_TKN_FLD;
    if ($RA[RA_cn__DS][$_func_TKN]['cxF__EXPR'] != '') {
      $arr = explode(RA_sepOPTION, $RA[RA_cn__DS][$_altTKN]['cxF__EXPR']);
      $_func_TKN = end($arr);
    }
    foreach ($RA[RA_DS][DS_arr][$ruleFLD] as $tkn_i => $tkn_word) {
      $RA[RA_DS][DS_TKN_arr][$ruleFLD][$tkn_i] = $_func_TKN($innPATT, $outPATT, $tkn_word);
      $RA[RA_DS][DS_tkn_cnt][$ruleFLD][$tkn_i] = strlen($RA[RA_DS][DS_TKN_arr][$ruleFLD][$tkn_i]);
      $RA[RA_DS][DS_tkn_i][$ruleFLD][$tkn_i] = 0;
    }
    if ($_altTKN == '_tknW' && $_altNUM != '_numR') {
      $RA[RA_DS][DS_arr_cnt][$ruleFLD] = (int) $RA[RA_cn__DS][$_altNUM]['val__bvPQ'];
      $RA[RA_DS][DS_FLD][$ruleFLD] = $_altNUM = '_numR';
    }
de("3a-1-u3", $_altNUM_add, $_altNUM, $_func_TKN,$RA[RA_DS][DS_arr_cnt][$ruleFLD], $RA[RA_DS][DS_arr_i][$ruleFLD], $RA[RA_DS][DS_tkn_cnt][$ruleFLD], $RA[RA_DS][DS_tkn_i][$ruleFLD], $RA[RA_DS][DS_TKN_arr][$ruleFLD]);    
  }
  if ($RA[RA_DS][DS_arr_cnt][$ruleFLD] <= $RA[RA_DS][DS_arr_i][$ruleFLD]) {

    $ep = "$pp-e2";
    $RA[RA_log][] = "$ep cn__DS($cn__DS) rule_el($rule_el) Bad \$RA[RA_DS][DS_arr_cnt][\$_altTKN] <= \$RA[RA_DS][DS_tkn_i][\$_altTKN]:\n"
    . $RA[RA_DS][DS_arr_cnt][$ruleFLD] . " <= " . $RA[RA_DS][DS_arr_i][$ruleFLD];
dz($RA[RA_DS]);
  }
  __check_err();
  $calc_ret = '';
  if ($_altTKN != '_tknZ') {
    if (strpos($RA[RA_cn__DS][$_altNUM]['cxF__EXPR'], '_altFUNC') !== false) {
      $_func_NUM = explode(RA_sepOPTION, $RA[RA_cn__DS][$_altNUM]['cxF__EXPR'])[0];
      $calc_ret = $_func_NUM($RA[RA_cn__DS][$_altNUM]['val__bvPQ'], '', $RA[RA_DS][DS_TKN_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]]);
    } else {
      if ($_altNUM_add > 0) {
        $calc_ret = substr($RA[RA_DS][DS_TKN_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]], 0, $_altNUM_add);
      } else {
        $calc_ret = substr($RA[RA_DS][DS_TKN_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]], $_altNUM_add);
      }
    }
  }
  $RA[RA_DS][DS_TKN_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]] = substr($RA[RA_DS][DS_TKN_arr][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]], $_altNUM_add);
  $RA[RA_DS][DS_tkn_i][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]] += $_altNUM_add;
  if ($RA[RA_DS][DS_tkn_cnt][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]] <= $RA[RA_DS][DS_tkn_i][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]]) {
    $RA[RA_DS][DS_arr_i][$ruleFLD]++;
  }
//de("3a-0-u3", $calc_ret, $RA[RA_DS][DS_TKN_arr][$ruleFLD], $RA[RA_DS][DS_tkn_i][$ruleFLD][$RA[RA_DS][DS_arr_i][$ruleFLD]], $_altNUM_add, $RA[RA_cn__DS][$_altNUM]['cxF__EXPR']);
  return $calc_ret;
}

function __eraseInnOut($innPATT, $outPATT, $tkn_word) { $pp = "p003a-5a";
  return preg_replace($outPATT, '', preg_replace($innPATT, '', $tkn_word));
}

function __eraseInn($innPATT, $outPATT, $tkn_word) { $pp = "p003a-6a";
  return preg_replace($innPATT, '', $tkn_word);
}

function __unTuch($innPATT, $outPATT, $tkn_word) { $pp = "p003a-7a";
  return $tkn_word;
}

function __check_err() { $pp = "p003a-11a";
  global $RA;
  if ($RA[RA_log]) {
    $msg = end($RA[RA_log]);
    dul($RA[RA_log]);
    throw new Exception($msg);
  }
  return false;
}

function _raDS_test_all() { $pp = "p003a-12a";
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
  foreach ($RA[RA_cn__DS] as $cn__DS => $cn_arr) if (isset($cn_arr['te__EXPR'])) if (_raDS_test_one($cn__DS, ++$cnt)) $errs++;
  dul(["\nTotal test FAILED($errs) from($cnt)"], 1);
  return $errs;
}

function _raDS_test_one($cn__DS, $cnt = 0) { $pp = "p003a-13a";
  $ret__DS = _raDS_trans($cn__DS);
  $msg = str_pad("\r " . ($cnt ? "$cnt - " : "") . "cn__DS($cn__DS) - " . (($ret_failed = ($ret__DS != $cn__DS)) ? "FAILED ret__DS($ret__DS)" : "Passed ... "), 160);
  if ($ret_failed) dul([$msg. "\n"], 1);
  else echo $msg;
  return $ret_failed;
}

function _raDS_test_integral_gen($seed = 0) { $pp = "p003a-14a";
  if ($seed) srand($seed); else srand();
  
}

function _raDS_test_integral() { $pp = "p003a-15a";
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
