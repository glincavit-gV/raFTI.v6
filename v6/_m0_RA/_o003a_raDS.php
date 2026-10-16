<?php
include_once '_o001a_raCORE__acPP_meta.php';
include_once '_o002a_raCORE__acPP_ini.php';

function _raDS_calc($cn__arDS) { $pp = "p003a-0a";
  global $RA;
  $RA[RA_DS] = $DS_ret = [];
  $RA[RA_DS][DS_cn__arDS] = $cn__arDS;
  extract($RA[RA__tySEP]);
  extract($RA[RA_cn__arDS][$RA[RA_DS][DS_cn__arDS]], EXTR_PREFIX_ALL, 'DS');
  $te_arr = explode($_sepALT, $DS_te__EXPR);
  $rule__EXPR_arr = explode($_sepLIST, $DS_reule__EXPR);
  $_dsABR = $rule__EXPR_arr[RA_rule__EXPR_dsABR];
  if (!isset($RA[RA_cn__arDS][$_dsABR])) {

    $ep = "$pp-e1";
    $RA[RA_log][] = "$ep reule__EXPR($DS_reule__EXPR) not found as registered rule _dsABR($_dsABR)";
  } else {
    foreach ($te_arr as $te_el) {
      $dso_arr = explode($_sepOPTION, $te_el);
      $RA_rule__EXPR_cnt = RA_rule__EXPR_cnt;
      if (($cnt = count($rule__EXPR_arr)) != $RA_rule__EXPR_cnt) {

        $ep = "$pp-e2";
        $RA[RA_log][] = "$ep reule__EXPR($DS_reule__EXPR) has count of rules($cnt) != expecting($RA_rule__EXPR_cnt)";
      } else {
        switch ($dso_arr[0]) {
          case 'dst':
            if ($DS_cn__TY == '') {

              $ep = "$pp-e3";
              $RA[RA_log][] = "$ep te__EXPR($DS_te__EXPR) has (dst) component but cn__TY field is empty";
            } else {
              $ty_arr = explode($_sepTY, $DS_cn__TY);
              if (($cnt = count($ty_arr)) != 2) {

                $ep = "$pp-e4";
                $RA[RA_log][] = "$ep cn__TY($DS_cn__TY) has bad type prefix signal($_sepTY) count($cnt), not equal with: 2";
              } else {
                $DS_ret[] = [DS_ret_dst => $ty_arr[1]];
              }
            }
            break;
          case 'dso':        
            if (count($dso_arr) == 1) {

              $ep = "$pp-e5";
              $RA[RA_log][] = "$ep te__EXPR($DS_te__EXPR) has (dso) component($te_el) and it don't have the options separated with ($_sepOPTION)";
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
            $DS_ret[] = [DS_ret_sep => $te_el];
        }
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
        $DS_dsABR_ret .= __dsTE_abris($_dsABR_arr[RA_dsABR_rest], $DS_ret_arr[1]);
        break;
      case DS_ret_sep:
        $DS_dsABR_ret .= $DS_ret_arr[1];
        break;
      case DS_ret_dsx:
        $DS_dsABR_ret .= __dsTE_abris($_dsABR_arr[RA_dsABR_dsx], $DS_ret_arr[1]);
        break;
      case DS_ret_dsn:
        $DS_dsABR_ret .= __dsTE_abris($_dsABR_arr[RA_dsABR_dsn], $DS_ret_arr[1]);
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
    $__dsTE_ret .= __rule_calc($ds_el);
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
  $rule_arr = explode($_sepCN, $rule_el);
  if (1 != 1
      || ($rule_cnt = count($rule_arr)) < 2
      || $rule_cnt > 3
      || ($bad_tkn = !isset($RA[RA_cn__arDS][$rule_el])
      || ($bad_tkn = (($_tknNUM = $RA[RA_cn__arDS][$rule_el]['cxN__arDS']) != '_tknNUM' ? 1 : 0)))
  ) {
    if ($bad_tkn) {
      
      $ep = "$pp-e1";
      $RA[RA_log][] = "$ep rule_el($rule_el) has bad (_tknNUM) != ($_tknNUM) in its cxN__arDS field";
    } else {

      $ep = "$pp-e2";
      $RA[RA_log][] = "$ep rule_el($rule_el) has bad _sepCN($_sepCN) prefix count($rule_cnt) of parts, not betwen (2, 3)";
    }
  } else {
    if ($cnt == 2) { // source $RA[RA_DS][DS_cn__arDS]]['main__bvPQ'] 
      $tknNUM_arr = explode($_sepADD, explode($_sepOPTION, $RA[RA_cn__arDS][$rule_el]['cxF__EXPR'])[0]);
      $_altTKN = $tknNUM_arr[0];
      $_altNUM = $tknNUM_arr[1];
      $ruleFLD = 'main__bvPQ';
      $ruleFLD_sep = $_sepWORD;
    } else {
      $cxF_arr = explode($_sepADD, explode($_sepOPTION, $RA[RA_cn__arDS][$rule_el]['cxF__EXPR'])[0]);
      $tknNUM_arr = explode($_sepADD, explode($_sepOPTION, $RA[RA_cn__arDS][$cxF_arr[1]]));
      $_altTKN = $tknNUM_arr[0];
      $_altNUM = $tknNUM_arr[1];
      $ruleFLD = explode($_sepOPTION, $RA[RA_cn__arDS][$cxF_arr[0]]['cxF__EXPR'])[0];
      $ruleFLD_sep = $_sepADD;
    }
    if (!isset($RA[RA_DS][DS_arr][$_altTKN])) {
      $cxF__EXPR = $RA[RA_cn__arDS][$_altTKN]['cxF__EXPR'];
      if (strpos($cxF__EXPR, '_funcNUM') === false) {
      
        $ep = "$pp-e3";
        $RA[RA_log][] = "$ep rule_el($rule_el) has bad _altTKN($_altTKN) - not _funcNUM like token in cxF__EXPR($cxF__EXPR) field";
      } else {
        $RA[RA_DS][DS_arr][$_altTKN] = explode($ruleFLD_sep, explode($_sepOPTIPON, $RA[RA_cn__arDS][$RA[RA_DS][DS_cn__arDS]][$ruleFLD])[0]);
        $RA[RA_DS][DS_arr_cnt][$_altTKN] = count($RA[RA_DS][DS_arr][$_altTKN]);
        $RA[RA_DS][DS_arr_i][$_altTKN] = 0;
        $RA[RA_DS][DS_arr_patt][$_altTKN]['_pattErase'] = $RA[RA_cn__arDS][$_altTKN][$RA[RA_cn__arDS][$_altTKN]['val__bvPQ']];
        $_funcNUM = "__func_Earse";
        if (($is_func = strpos($RA[RA_cn__arDS][$_altNUM]['cxF__EXPR'], '_funcNUM')) !== false) {
          $_funcNUM = explode($_sepOPTION, $RA[RA_cn__arDS][$_altNUM]['cxF__EXPR']);
          $RA[RA_DS][DS_tkn_add][$_altTKN] = 1000;
          $pattFLD_name = $RA[RA_cn__arDS][$_altNUM]['val__bvPQ'];
          $RA[RA_DS][DS_arr_patt][$_altTKN][$pattFLD_name] = $RA[RA_cn__arDS][$_altTKN][$pattFLD_name];
        } else {
          $RA[RA_DS][DS_tkn_add][$_altTKN] = $RA[RA_cn__arDS][$_altNUM]['val__bvPQ'];
        }
        foreach ($RA[RA_DS][DS_arr][$_altTKN] as $tkn_i => $tkn_word) {
          switch ($_funcNUM) {
            case '__func_EarseCapture':
              $RA[RA_DS][DS_arr][$_altTKN][$tkn_i] = preg_replace($RA[RA_DS][DS_arr_patt][$_altTKN]['_pattErase'], '', $tkn_word);;
            case '__func_Capture':
              $RA[RA_DS][DS_arr][$_altTKN][$tkn_i] = preg_replace($RA[RA_DS][DS_arr_patt][$_altTKN]['_pattCapture'], '\1', $tkn_word);;
              break;
            case '__func_Earse':
            default:
              $RA[RA_DS][DS_arr][$_altTKN][$tkn_i] = preg_replace($RA[RA_DS][DS_arr_patt][$_altTKN]['_pattErase'], '', $tkn_word);;
          }
          $RA[RA_DS][DS_tkn_cnt][$_altTKN][$tkn_i] = strlen($RA[RA_DS][DS_arr][$_altTKN][$tkn_i]);
          $RA[RA_DS][DS_tkn_i][$_altTKN][$tkn_i] = 0;
        }
      }
    }
  }
  if ($RA[RA_DS][DS_tkn_i][$_altTKN] >= $RA[RA_DS][DS_tkn_cnt][$_altTKN]) {

    $ep = "$pp-e4";
    $RA[RA_log][] = "$ep Bad (RA[DS_tkn_i] >= RA[DS_tkn_cnt]):\n"
    . $RA[RA_DS][DS_tkn_i][$_altTKN] . " >= " . $RA[RA_DS][DS_tkn_cnt][$_altTKN];
  }
  if ($RA[RA_DS][DS_arr_cnt][$_altTKN] <= $RA[RA_DS][DS_tkn_i][$_altTKN]) {

    $ep = "$pp-e5";
    $RA[RA_log][] = "$ep Bad \$RA[RA_DS][DS_arr_cnt][\$_altTKN] <= \$RA[RA_DS][DS_tkn_i][\$_altTKN]:\n"
    . $RA[RA_DS][DS_arr_cnt][$_altTKN] . " <= " . $RA[RA_DS][DS_tkn_i][$_altTKN];
  }
  __check_err();
  if ($is_func) {
    $calc_ret = $RA[RA_DS][DS_arr][$_altTKN][$RA[RA_DS][DS_arr_i][$_altTKN]];
  } else {
    $calc_ret = substr($RA[RA_DS][DS_arr][$_altTKN][$RA[RA_DS][DS_arr_i][$_altTKN]]
      , $RA[RA_DS][DS_tkn_i][$_altTKN][$RA[RA_DS][DS_arr_i][$_altTKN]]
      , $RA[RA_cn__arDS][$_altNUM]['val__bvPQ']
    );
  }
  $RA[RA_DS][DS_tkn_i][$_altTKN] += $RA[RA_DS][DS_tkn_add][$_altTKN];
  if ($RA[RA_DS][DS_arr_cnt][$_altTKN] <= $RA[RA_DS][DS_tkn_i][$_altTKN]) {
    $RA[RA_DS][DS_tkn_i][$_altTKN] = 0;
    $RA[RA_DS][DS_arr_i][$_altTKN]++;
  }
  return $calc_ret;
}

function __check_err() { $pp = "p003a-4a";
  global $RA;
  if ($RA[RA_log]) {
    $msg = end($RA[RA_log]);
    dol($RA[RA_log]);
    throw new Exception($msg);
  }
}
