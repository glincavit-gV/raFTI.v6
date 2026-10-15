<?php
include_once '_o001a_raCORE__acPP_meta.php';
include_once '_o002a_raCORE__acPP_ini.php';

function _raDS_calc($cn__arDS) { $pp = "p003a-0a";
  global $RA;
  $RA[RA_DS] = [];
  $DS_ret = [];
  $RA[RA_DS][DS_cn__arDS] = $cn__arDS;
  extract($RA[RA__tySEP]);
  extract($RA[RA_cn__arDS][$RA[RA_DS][DS_cn__arDS]], EXTR_PREFIX_ALL, 'DS');
  $te_arr = explode($_sepALT, $DS_te__EXPR);
  $rule__EXPR_arr = explode($_sepLIST, $DS_reule__EXPR);
  $_dsABR = $rule__EXPR_arr[RA_rule__EXPR_dsABR];
  if (!isset($RA[RA_cn__arDS][$_dsABR])) {

    $ep = "$pp-e1";
    $RA[RA_log][] = "$ep reule__EXPR($DS_reule__EXPR) has registered rule _dsABR($_dsABR)";
  } else {
    foreach ($te_arr as $te_el) {
      $dso_arr = explode($_sepOPTION, $te_el);
      switch ($dso_arr[0]) {
        case 'dst':
          if ($DS_cn__TY == '') {

            $ep = "$pp-e2";
            $RA[RA_log][] = "$ep te__EXPR($DS_te__EXPR) has (dst) component but cn__TY field is empty";
          } else {
            $ty_arr = explode($_sepTY, $DS_cn__TY);
            if (($cnt = count($ty_arr)) != 2) {

              $ep = "$pp-e3";
              $RA[RA_log][] = "$ep cn__TY($DS_cn__TY) has bad type prefix signal($_sepTY) count($cnt), not equal with: 2";
            } else {
              $DS_ret[] = [DS_ret_dst => $ty_arr[1]];
            }
          }
          break;
        case 'dso':        
          if (count($dso_arr) == 1) {

            $ep = "$pp-e4";
            $RA[RA_log][] = "$ep te__EXPR($DS_te__EXPR) has (dso) component($te_el), it don't have the options separated with ($_sepOPTION)";
          } else {
            $DS_ret[] = [DS_ret_dso => __dsTE_calc($dso_arr, 1)];
          }
          break;
        case 'ds':
          $RA_rule__EXPR_cnt = RA_rule__EXPR_cnt;
          if (($cnt = count($rule__EXPR_arr)) != $RA_rule__EXPR_cnt) {

            $ep = "$pp-e5";
            $RA[RA_log][] = "$ep reule__EXPR($DS_reule__EXPR) has count of rules($cnt) != expecting($RA_rule__EXPR_cnt)";
          } else {
            $DS_ret[] = [DS_ret_dsx => __dsTE_calc(explode($_sepOPTION, $rule__EXPR_arr[RA_rule__EXPR_dsx]), 0)];
            $DS_ret[] = [DS_ret_dsn => __dsTE_calc(explode($_sepOPTION, $rule__EXPR_arr[RA_rule__EXPR_dsn]), 0)];
          }
          break;
        case $_sepCN:
        case $_sepTY:
          $DS_ret[] = [DS_ret_sep => $te_el];
      }
    }
  }
  __check_err();
  $_dsABR_arr = explode($_sepADD, $RA[RA_cn__arDS][$_dsABR]['cxF__EXPR']);
  $DS_dsABR_ret = '';
  foreach ($DS_ret as $DS_ret_arr) {
    switch ($DS_ret_arr[0]) {
      case DS_ret_dst:
      case DS_ret_dso:
        $DS_dsABR_ret .= ($_dsABR_arr[RA_dsABR_rest] == '_abrC'
            ? strtoupper($DS_ret_arr[1])
            : ($_dsABR_arr[RA_dsABR_rest] == '_abrS'
              ? strtoupper($DS_ret_arr[1])
              : $DS_ret_arr[1]
            )
        );
        break;
      case DS_ret_sep:
        $DS_dsABR_ret .= $DS_ret_arr[1];
        break;
      case DS_ret_dsx:
        $DS_dsABR_ret .= ($_dsABR_arr[RA_dsABR_dsx] == '_abrC'
            ? strtoupper($DS_ret_arr[1])
            : ($_dsABR_arr[RA_dsABR_dsx] == '_abrS'
              ? strtoupper($DS_ret_arr[1])
              : $DS_ret_arr[1]
            )
        );
        break;
      case DS_ret_dsn:
        $DS_dsABR_ret .= ($_dsABR_arr[RA_dsABR_dsn] == '_abrC'
            ? strtoupper($DS_ret_arr[1])
            : ($_dsABR_arr[RA_dsABR_dsn] == '_abrS'
              ? strtoupper($DS_ret_arr[1])
              : $DS_ret_arr[1]
            )
        );
        break;
    }
  }
  return $DS_dsABR_ret;
}

function __dsTE_calc(array $ds_arr, $ds_i) { $pp = "p003a-1a";
  global $RA;
  $__dsTE_ret = '';
  for($ds_arr_i = $ds_i; $ds_arr_i < count($ds_arr); $ds_arr_i++) {
    $ds_el = $ds_arr[$ds_arr_i];
    $__dsTE_ret .= __rule_calc($ds_el);
  }
  return $__dsTE_ret;
}

function __rule_calc($rule_el) { $pp = "p003a-2a";
  global $RA;
  extract($RA[RA__tySEP]);
  $rule_arr = explode($_sepCN, $rule_el);
  $rule_ret = '';
  if (1 != 1
      || ($cnt = count($rule_arr)) < 2
      || $cnt > 3
      || ($bad_tkn = !isset($RA[RA_cn__arDS][$rule_el])
      || ($bad_tkn = (($_tknNUM = $RA[RA_cn__arDS][$rule_el]['cxN__arDS']) != '_tknNUM' ? 1 : 0)))
  ) {
    if ($bad_tkn) {
      
      $ep = "$pp-e1";
      $RA[RA_log][] = "$ep rule_el($rule_el) has bad (_tknNUM) != ($_tknNUM) in its cxN__arDS field";
    } else {

      $ep = "$pp-e2";
      $RA[RA_log][] = "$ep rule_el($rule_el) has bad _sepCN($_sepCN) prefix count($cnt) of parts, not betwen (2, 3)";
    }
  } else {
    if ($cnt == 2) { // source $RA[RA_DS][DS_cn__arDS]]['main__vbPQ'] 
      $_altTKN = "_tkn" . substr($rule_arr[1], 0, 1);
      if (1 != 1
          || !isset($RA[RA_cn__arDS][$_altTKN])
          || $RA[RA_cn__arDS][$_altTKN]['cxN__arDS'] != '_altTKN'
          || strpos($RA[RA_cn__arDS][$_altTKN]['cxF__EXPR'], '_altNUM') !== false
      ) {
      
        $ep = "$pp-e3";
        $RA[RA_log][] = "$ep rule_el($rule_el) has bad _altTKN($_altTKN) in 1-st subpart of _tknNUM($_tknNUM) or bad cxF__EXPR include _altNUM";
      } else {
        $_altNUM = "_num" . substr($rule_arr[1], 1);
        if (!isset($RA[RA_cn__arDS][$_altNUM]) || $RA[RA_cn__arDS][$_altNUM]['cxN__arDS'] != '_altNUM') {
        
          $ep = "$pp-e4";
          $RA[RA_log][] = "$ep rule_el($rule_el) has bad _altNUM($_altNUM) in 2-nd subpart of _tknNUM($_tknNUM)";
        } else {
          if (!isset($RA[RA_DS][DS_arr][$_altTKN])) {
            $RA[RA_DS][DS_arr][$_altTKN] = explode($_sepWORD, $RA[RA_cn__arDS][$RA[RA_DS][DS_cn__arDS]]['main__vbPQ']);
            $RA[RA_DS][DS_arr_cnt][$_altTKN] = count($RA[RA_DS][DS_arr][$_altTKN]);
            $RA[RA_DS][DS_arr_i][$_altTKN] = 0;
            $patt = $RA[RA_cn__arDS][$_altTKN]['val__vbPQ'];
            foreach ($RA[RA_DS][DS_arr][$_altTKN] as $main_i => $main_word) {
              $RA[RA_DS][DS_arr][$_altTKN][$main_i] = preg_replace($patt, '', $main_word);
              $RA[RA_DS][DS_tkn_cnt][$_altTKN][$main_i] = strlen($RA[RA_DS][DS_arr][$_altTKN][$main_i]);
              $RA[RA_DS][DS_tkn_i][$_altTKN][$main_i] = 0;
            }
          }
        }
      }
    } else { // source from field from $RA[RA_DS][DS_cn__arDS]]['cxF__EXPR']
      $_altTKN = "_tkn" . substr($rule_arr[2], 0, 1);
      $_altNUM = "_num" . substr($rule_arr[2], 1);
      if (!isset($RA[RA_DS][DS_arr][$_altTKN])) {
        $rule__arDS = $_sepCN . $rule_arr[1];
        $patt = $RA[RA_cn__arDS][$_altTKN]['val__vbPQ'];
        if ($rule__arDS == '_cxF') {
          $rule__arDS = explode($_sepOPTION, $RA[RA_cn__arDS][$RA[RA_cn__arDS][$rule__arDS]['cxF__EXPR']])[0];
          $RA[RA_DS][DS_arr][$_altTKN] = explode($_sepADD, $rule__arDS);
          foreach($RA[RA_DS][DS_arr][$_altTKN] as $cxF_i => $cxF_word) {
            $RA[RA_DS][DS_arr][$_altTKN][$cxF_i] = preg_replace($patt, '', $cxF_word);
            $RA[RA_DS][DS_tkn_cnt][$_altTKN][$cxF_i] = strlen($RA[RA_DS][DS_arr][$_altTKN][$cxF_i]);
            $RA[RA_DS][DS_tkn_i][$_altTKN][$cxF_i] = 0;
          }
        } else {
          $RA[RA_DS][DS_arr][$_altTKN] = [preg_replace($patt, '', $RA[RA_cn__arDS][$RA[RA_cn__arDS][$rule__arDS]['cxF__EXPR']])];
          $RA[RA_DS][DS_tkn_cnt][$_altTKN] = strlen($RA[RA_DS][DS_arr][$_altTKN][0]);
        }
        $RA[RA_DS][DS_arr_i][$_altTKN] = 0;
        $RA[RA_DS][DS_arr_cnt][$_altTKN] = count($RA[RA_DS][DS_arr][$_altTKN]);
      }
    }
  }
  if ($RA[RA_DS][DS_tkn_i][$_altTKN] >= $RA[RA_DS][DS_tkn_cnt][$_altTKN]) {

    $ep = "$pp-e4";
    $RA[RA_log][] = "$ep Bad (RA[DS_tkn_i] >= RA[DS_tkn_cnt]):\n"
    . $RA[RA_DS][DS_tkn_i][$_altTKN] . " >= " . $RA[RA_DS][DS_tkn_cnt][$_altTKN];
  }
  if ($RA[RA_DS][DS_arr_cnt][$_altTKN] <= $RA[RA_DS][DS_tkn_i][$_altTKN]) {

    $ep = "$pp-e2";
    $RA[RA_log][] = "$ep Bad \$RA[RA_DS][DS_arr_cnt][\$_altTKN] <= \$RA[RA_DS][DS_tkn_i][\$_altTKN]:\n"
    . $RA[RA_DS][DS_arr_cnt][$_altTKN] . " <= " . $RA[RA_DS][DS_tkn_i][$_altTKN];
  }
  __check_err();
  $calc_ret = substr($RA[RA_DS][DS_arr][$_altTKN][$RA[RA_DS][DS_arr_i][$_altTKN]]
    , $RA[RA_DS][DS_tkn_i][$_altTKN][$RA[RA_DS][DS_arr_i][$_altTKN]]
    , $RA[RA_cn__arDS][$_altNUM]['val__vbPQ']
  );
  $RA[RA_DS][DS_tkn_i][$_altTKN] += $RA[RA_cn__arDS][$_altNUM]['val__vbPQ'];
  if ($RA[RA_DS][DS_arr_cnt][$_altTKN] <= $RA[RA_DS][DS_tkn_i][$_altTKN]) {
    $RA[RA_DS][DS_tkn_i][$_altTKN] = 0;
    $RA[RA_DS][DS_arr_i][$_altTKN]++;
  }
  return $calc_ret;
}

function __check_err() { $pp = "p003a-3a";
  global $RA;
  if ($RA[RA_log]) {
    $msg = end($RA[RA_log]);
    dol($RA[RA_log]);
    throw new Exception($msg);
  }
}
