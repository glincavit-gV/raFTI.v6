<?php
include_once '_o001a_raCore__acPP_meta.php';
include_once '_o002a_raCore__acPP_ini.php';

function _raDS_calc($cn__arDS) { $pp = "p003a-0a";
  global $RA;
  $_DS_ref = "_arDS";
  $_DS_ver = "0.11.$_DS_ref t2.$cn__arDS";
  duv($_DS_ver, $_DS_ref);
  $RA[RA_DS] = $DS_ret = [];
  $RA[RA_DS][DS_cn__arDS] = $cn__arDS;
  extract($RA[RA__tySEP]);
  extract($RA[RA_cn__arDS][$RA[RA_DS][DS_cn__arDS]], EXTR_PREFIX_ALL, 'DS');
  $te_arr = explode($_sepPART, $DS_te__EXPR);
  $rule__EXPR_arr = explode($_sepLIST, $DS_rule__EXPR);
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
        echo "\nret ="; du("p0", $DS_ret);
      }
    }
  }
  __check_err();
  $_dsABR_arr = explode($_sepADD, $RA[RA_cn__arDS][$_dsABR]['cxF__EXPR']);
  $DS_dsABR_ret = '';
  foreach ($DS_ret as $DS_ret_arr) {
    switch (key($DS_ret_arr)) {
      case DS_ret_dst:
      case DS_ret_dso:
        $DS_dsABR_ret .= __dsTE_abris($_dsABR_arr[RA_dsABR_rest], current($DS_ret_arr));
        break;
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
      du("_altTKN.p1=$__dsTE_ret", $RA[RA_DS][DS_altTKN], $RA[RA_DS][DS_arr_cnt][$RA[RA_DS][DS_altTKN]], $RA[RA_DS][DS_arr_i][$RA[RA_DS][DS_altTKN]]);
    } while ($RA[RA_DS][DS_arr_cnt][$RA[RA_DS][DS_altTKN]] > $RA[RA_DS][DS_arr_i][$RA[RA_DS][DS_altTKN]]);
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
    $tknNUM_arr = explode($_sepADD, explode($_sepOPTION, $RA[RA_cn__arDS][$rule_el]['cxF__EXPR'])[0]);
    if ($rule_cnt == 2) { // source $RA[RA_DS][DS_cn__arDS]]['main__bvPQ']
      $mTKM = $RA[RA_DS][DS_altTKN] = $_altTKN = $tknNUM_arr[0];
      $_altNUM = $tknNUM_arr[1];
      $ruleFLD = 'main__bvPQ';
      $ruleFLD_sep = $_sepWORD;
    } else {
      $ruleFLD = explode($_sepOPTION, $RA[RA_cn__arDS][$tknNUM_arr[0]]['cxF__EXPR'])[0];
      $tknNUM_arr = explode($_sepADD, explode($_sepOPTION, $RA[RA_cn__arDS][$tknNUM_arr[1]]['cxF__EXPR'])[0]);
      $_altTKN = $tknNUM_arr[0];
      $_altNUM = $tknNUM_arr[1];
      $ruleFLD_sep = $_sepADD;
      $mTKM = $RA[RA_DS][DS_altTKN] = $rule_el;
    }
    echo "\n_altTKN($_altTKN), _altNUM($_altNUM), ruleFLD($ruleFLD), ruleFLD_sep($ruleFLD_sep), mainTKN=" . $mTKM;
    if (!isset($RA[RA_DS][DS_arr][$mTKM])) {
      $RA[RA_DS][DS_arr_cnt][$mTKM] = $RA[RA_DS][DS_arr_i][$mTKM] = 0;
      if ($_altTKN == '_tknZ') return '';
      $cxF__EXPR = $RA[RA_cn__arDS][$_altTKN]['cxF__EXPR'];
      if (strpos($cxF__EXPR, '_funcNUM') === false) {
      
        $ep = "$pp-e3";
        $RA[RA_log][] = "$ep rule_el($rule_el) has bad _altTKN($_altTKN) - not _funcNUM like token in cxF__EXPR($cxF__EXPR) field";
      } else {
        $RA[RA_DS][DS_arr][$mTKM] = explode($ruleFLD_sep, explode($_sepOPTION, $RA[RA_cn__arDS][$RA[RA_DS][DS_cn__arDS]][$ruleFLD])[0]);
        $RA[RA_DS][DS_arr_cnt][$mTKM] = count($RA[RA_DS][DS_arr][$mTKM]);
        $RA[RA_DS][DS_arr_i][$mTKM] = 0;
        $RA[RA_DS][DS_arr_patt][$mTKM]['_pattErase'] = $RA[RA_cn__arDS][$_altTKN][$RA[RA_cn__arDS][$_altTKN]['val__bvPQ']];
        $_funcNUM = "__func_Earse";
        if (($RA[RA_DS][DS_is_func][$mTKM] = strpos($RA[RA_cn__arDS][$_altNUM]['cxF__EXPR'], '_funcNUM')) !== false) {
          $_funcNUM = explode($_sepOPTION, $RA[RA_cn__arDS][$_altNUM]['cxF__EXPR'])[0];
          $RA[RA_DS][DS_tkn_add][$mTKM] = 1000;
          $RA[RA_DS][DS_arr_patt][$mTKM][$RA[RA_cn__arDS][$_altNUM]['val__bvPQ']] = $RA[RA_cn__arDS][$_altTKN]['_pattErase'];
        } else {
          $RA[RA_DS][DS_tkn_add][$mTKM] = (int)$RA[RA_cn__arDS][$_altNUM]['val__bvPQ'];
        }
        foreach ($RA[RA_DS][DS_arr][$mTKM] as $tkn_i => $tkn_word) {
          switch ($_funcNUM) {
            case '__func_EarseCapture':
              $RA[RA_DS][DS_arr][$mTKM][$tkn_i] = preg_replace($RA[RA_DS][DS_arr_patt][$mTKM]['_pattErase'], '', $tkn_word);;
            case '__func_Capture':
              $RA[RA_DS][DS_arr][$mTKM][$tkn_i] = preg_replace($RA[RA_DS][DS_arr_patt][$mTKM]['_pattCapture'], '\1', $tkn_word);;
              break;
            case '__func_Earse':
            default:
              $RA[RA_DS][DS_arr][$mTKM][$tkn_i] = preg_replace($RA[RA_DS][DS_arr_patt][$mTKM]['_pattErase'], '', $tkn_word);;
          }
          $RA[RA_DS][DS_tkn_cnt][$mTKM][$tkn_i] = strlen($RA[RA_DS][DS_arr][$mTKM][$tkn_i]);
          $RA[RA_DS][DS_tkn_i][$mTKM][$tkn_i] = 0;
        }
      }
    }
  }
  if ($RA[RA_DS][DS_arr_cnt][$mTKM] <= $RA[RA_DS][DS_arr_i][$mTKM]) {

    $ep = "$pp-e5";
    $RA[RA_log][] = "$ep Bad \$RA[RA_DS][DS_arr_cnt][\$_altTKN] <= \$RA[RA_DS][DS_tkn_i][\$_altTKN]:\n"
    . $RA[RA_DS][DS_arr_cnt][$mTKM] . " <= " . $RA[RA_DS][DS_arr_i][$mTKM];
  }
  __check_err();
  du("p2", $RA[RA_DS][DS_arr][$mTKM], $RA[RA_DS][DS_tkn_i][$mTKM][$RA[RA_DS][DS_arr_i][$mTKM]], $RA[RA_DS][DS_tkn_add][$mTKM], $RA[RA_DS][DS_arr_i][$mTKM]);
  if ($RA[RA_DS][DS_is_func][$mTKM]) {
    $calc_ret = $RA[RA_DS][DS_arr][$mTKM][$RA[RA_DS][DS_arr_i][$mTKM]];
  } else {
    $calc_ret = substr($RA[RA_DS][DS_arr][$mTKM][$RA[RA_DS][DS_arr_i][$mTKM]]
      , $RA[RA_DS][DS_tkn_i][$mTKM][$RA[RA_DS][DS_arr_i][$mTKM]]
      , $RA[RA_cn__arDS][$_altNUM]['val__bvPQ']
    );
  }
  $RA[RA_DS][DS_tkn_i][$mTKM][$RA[RA_DS][DS_arr_i][$mTKM]] += $RA[RA_DS][DS_tkn_add][$mTKM];
  if ($RA[RA_DS][DS_tkn_cnt][$mTKM][$RA[RA_DS][DS_arr_i][$mTKM]] <= $RA[RA_DS][DS_tkn_i][$mTKM][$RA[RA_DS][DS_arr_i][$mTKM]]) {
    $RA[RA_DS][DS_arr_i][$mTKM]++;
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
