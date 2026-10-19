<?php
global $RA;
const RA_cn__arDS = 0;
const RA_sql = 1;
const RA_sql_stop = 2;
const RA_sq = 3;
const RA_db = 4;
const RA_curDB = 5;
const RA_seg__arP = 6;
const RA_seg__arDS = 7;
const RA_EXPR__arP = 8;
const RA_tables = 9;
const RA__tySEP = 10;
const RA_var = 11;
const RA_log = 12;
const RA_DS = 13;
const RA_ver_stop = 14;

$RA[RA_sql_stop] = 0;
$RA[RA_ver_stop] = 0;


const DS_arr = 0;
const DS_arr_cnt = 1;
const DS_arr_i = 2;
const DS_tkn_cnt = 3;
const DS_tkn_i = 4;
const DS_tkn_add = 5;
const DS_cn__arDS = 6;
const DS_ruleFLD = 7;
const DS_altTKN = 8;

const DS_ret_dst = 0;
const DS_ret_dso = 1;
const DS_ret_sep = 2;
const DS_ret_dsx = 3;
const DS_ret_dsn = 4;

const RA_rule__EXPR_cnt = 3;
const RA_rule__EXPR_dsx = 0;
const RA_rule__EXPR_dsn = 1;
const RA_rule__EXPR_dsABR = 2;

const RA_dsABR_dsx = 0;
const RA_dsABR_dsn = 1;
const RA_dsABR_rest = 2;

const RA_seg__arDS_start = 0;
const RA_seg__arDS_next = 1;
const RA_seg__arDS_arP = 2;

const RA_tables_flds_str = 0;
const RA_tables_hieSHE = 1;

const RA_sql_cnt = 0;
const RA_sql_str = 1;
const RA_sql_max = 100;

$RA[RA__tySEP]['_sepCN'] = "_";
$RA[RA__tySEP]['_sepTY'] = "__";
$RA[RA__tySEP]['_sepADD'] = " + ";
$RA[RA__tySEP]['_sepMINUS'] = " - ";
$RA[RA__tySEP]['_sepFIXE'] = "-";
$RA[RA__tySEP]['_sepMULTIPLY'] = " * ";
$RA[RA__tySEP]['_sepVALUE'] = " : ";
$RA[RA__tySEP]['_sepOPTION'] = ":";
$RA[RA__tySEP]['_sepBACK'] = " :: ";
$RA[RA__tySEP]['_sepLIST'] = " , ";
$RA[RA__tySEP]['_sepALT'] = " / ";
$RA[RA__tySEP]['_sepPART'] = "/";
$RA[RA__tySEP]['_sepREM'] = " -- ";
$RA[RA__tySEP]['_sepPER'] = "@";
$RA[RA__tySEP]['_sepWORD'] = " ";
$RA[RA__tySEP]['_sepSTRUC'] = ".";
$RA[RA__tySEP]['_sepL_BRACKET'] = "(";
$RA[RA__tySEP]['_sepR_BRACKET'] = ")";

//dz($_SERVER);
if (isset($_SERVER['DB_HOST'] )) $client_machine_name = $_SERVER['DB_HOST'];
else $client_machine_name = $_SERVER['COMPUTERNAME'];
$RA[RA_var]['login'] = '@gV';
$RA[RA_var]['host'] = $client_machine_name;
$RA[RA_var]['ref'] = $RA[RA_var]['login'] . $RA[RA__tySEP]['_sepALT'] . $RA[RA_var]['host'];
$RA[RA_log] = [];

function dz(...$vars) { $pp = "p001a-0a";
  du(...$vars);
  exit(1);
}

function du(...$vars) { $pp = "p001a-1a";
  echo "\n";
  // Orange/Brown for structural brackets
  $orange = "\e[38;5;208m"; 
  $reset  = "\e[0m";
  foreach ($vars as $v) {
    if (is_array($v)) {
      $count = count($v);
      echo "\e[34m^\e[0m \e[36marray:$count\e[0m {$orange}[{$reset}\n";
      formatTerminalArray($v, 2);
      echo "{$orange}]{$reset}\n";
    } else {
      echo "\e[34m^\e[0m " . formatTerminalValue($v, 0) . "\n";
    }
  }
}

function formatTerminalArray($array, $indent = 2) { $pp = "p001a-2a";
  $spaces = str_repeat(" ", $indent);
  $orange = "\e[38;5;208m";
  $reset  = "\e[0m";
  foreach ($array as $key => $val) {
    // Key Name remains regular weight. Surrounding quotes colored orange.
    $formattedKey = is_string($key) ? "{$orange}\"{$reset}{$key}{$orange}\"{$reset}" : "\e[36m$key\e[0m";
    if (is_array($val)) {
      $count = count($val);
      echo $spaces . $formattedKey . " {$orange}=>{$reset} \e[36marray:$count\e[0m {$orange}[{$reset}\n";
      formatTerminalArray($val, $indent + 2);
      echo $spaces . "{$orange}]{$reset}\n";
    } else {
      // Arrows are colored orange
      echo $spaces . $formattedKey . " {$orange}=>{$reset} " . formatTerminalValue($val, $indent) . "\n";
    }
  }
}

function formatTerminalValue($val, $indent = 0) { $pp = "p001a-3a";
  $orange = "\e[38;5;208m";
  $reset  = "\e[0m";
  $bold   = "\e[1m"; // ANSI Bold Modifier
  if (is_string($val)) {
    if (strpos($val, "\n") !== false) {          
      $spaces = str_repeat(" ", $indent + 2);
      $indentedString = str_replace("\n", "\n" . $spaces, $val);
      // Quotes are orange, string text inside is BOLD green (\e[1;32m)
      return "{$orange}\"{$reset}\e[1;32m\n{$spaces}" . $indentedString . "{$reset}{$orange}\n\"{$reset}";
    }
    return "{$orange}\"{$reset}\e[1;32m{$val}{$reset}{$orange}\"{$reset}";                  
  }
  // Bold numbers (\e[1;33m), Bold magenta booleans (\e[1;35m), Bold gray nulls (\e[1;90m)
  if (is_numeric($val)) return "\e[1;36m{$val}{$reset}";                     
  if (is_bool($val))    return "\e[1;35m" . ($val ? 'true' : 'false') . "{$reset}"; 
  if (is_null($val))    return "\e[1;90mnull{$reset}";                     

  return $val;
}

function __format_SQL($flds_str, $seg__arPV = '_logWDOG__arT', $cn__arP = 0) { $pp = 'p001a-4a';
  global $RA;
  if (is_numeric($seg__arPV)) {
    $seg__arDS = $RA[RA_seg__arP][$seg__arPV];
  } else {
    $seg__arDS = $seg__arPV;
  }
  if (!($is_set = isset($RA[RA_sql][$seg__arDS])) || $RA[RA_sql][$seg__arDS][RA_sql_cnt] > RA_sql_max) {
    $seg_tab = __get_table($seg__arDS);
    if ($is_set) {
      $RA[RA_sq][] = rtrim($RA[RA_sql][$seg__arDS][RA_sql_str], ',');
    }
    $RA[RA_sql][$seg__arDS][RA_sql_cnt] = 0;
    $RA[RA_sql][$seg__arDS][RA_sql_str] = "INSERT into $seg_tab (" . $RA[RA_tables][$seg__arDS][RA_tables_flds_str] . ") values ";
  }
  if (!$cn__arP) {
    if ($RA[RA_cn__arDS][$seg__arDS]['cn__TY'] == '__arT') {
      $cn__arP = $RA[RA_seg__arDS][$seg__arDS][RA_seg__arDS_next]--;
    } else {
      $cn__arP = $RA[RA_seg__arDS][$seg__arDS][RA_seg__arDS_next]++;
    }
    $flds_str = "$cn__arP,$flds_str";
  }
  $RA[RA_sql][$seg__arDS][RA_sql_str] .= "\n  ($flds_str),";
  $RA[RA_sql][$seg__arDS][RA_sql_cnt]++;
  return $cn__arP;
}

function __seg_agg_INT($seg_agg__val) { $pp = 'p001a-5a';
  global $RA;
  try {
    $_ateSEG = (int) $RA[RA_cn__arDS]['_ateSEG']['val__bvPQ'];
    return (is_numeric($seg_agg__val) ? (int) $seg_agg__val : (10 + ord($seg_agg__val) - ord('A'))) << $_ateSEG;
  } catch (Exception $e) {

    $ep = "$pp-e1";
    $msg = "$ep Error PHP: seg_agg__val($seg_agg__val)\nMSG:\n" . $e->getMessage();
    $err = [$msg];
    $err[] = "\nTrace:\n" . $e->getTraceAsString();
    $msg .= $err[1];
    du($err);
    throw new Exception($msg);
  }
}

function __get_hieSCH($table_name) { $pp = 'p001a-6a';
  global $RA;
  return $RA[RA_cn__arDS][$RA[RA_cn__arDS][$table_name]['cxN__arDS']]['cxN__arDS'];
}

function __get_cn__arP($cn__arDS) { $pp = 'p001a-7a';
  global $RA;
  try {
    $seg__arDS = $RA[RA_cn__arDS][$cn__arDS]['src_tab'];    
    return $RA[RA_seg__arDS][$seg__arDS][RA_seg__arDS_start] + $RA[RA_cn__arDS][$cn__arDS]['src_arr_i'];
  } catch (Exception $e) {

    $ep = "$pp-e1";
    $msg = "$ep Error PHP: cn__arDS($cn__arDS)\nMSG:\n" . $e->getMessage();
    $err = [$msg];
    $err[] = "\nTrace:\n" . $e->getTraceAsString();
    $msg .= $err[1];
    du($err);
    throw new Exception($msg);
  }
}

function __exec_SQL($echo_it = 0) { $pp = 'p001a-8a';
  global $RA;
  if (!$RA[RA_sql_stop]) {
    foreach ($RA[RA_sql] as $seg__arDS => $seg_arr) {
      $RA[RA_sq][] = rtrim($seg_arr[RA_sql_str], ',');
    }
    //dz($RA[RA_sq][30]);
    if ($echo_it) "\nInserting data ...\n";
    try {
      foreach ($RA[RA_sq] as $sql_i => $sql) {
        if ($echo_it) echo "\r$sql_i - " . str_pad(explode(' values ', $sql)[0], 160);
        db_query($sql);
      }
    } catch (Exception $e) {

      $ep = "$pp-e1";
      $msg = "$ep Error SQL:\n" . $e->getMessage();
      $err = [$msg];
      $err[] = "\nTrace:\n" . $e->getTraceAsString();
      $msg .= $err[1];
      $err[] = "\nSQL:\n$sql\n";
      du($err);
      throw new Exception($msg);
    }
  }
  $RA[RA_sq] = $RA[RA_sql] = [];
}

function __get_table($name) { $pp = "p001a-9a";
  global $RA;
  if (isset($RA[RA_cn__arDS][$name])) {
    $_hieSCH = $RA[RA_cn__arDS][$RA[RA_cn__arDS][$name]['cxN__arDS']]['cxN__arDS'];
    $fcc = $RA[RA_cn__arDS][$name]['fcc__svQB'];
    return "{$_hieSCH}._{$fcc}{$name}";
  }
  return false;
}

function duv($ver, $ref, $pp = 0) { $pp = ($pp ? $pp : "p001a-10a");
  global $RA;
  $_sepSTRUC = $RA[RA__tySEP]['_sepSTRUC'];
  $vers = explode($_sepSTRUC, $ver, 3);
  extract($vers, EXTR_PREFIX_ALL, 'vers');
  $vers_2 = ltrim(explode("$vers_0{$_sepSTRUC}$vers_1", $ver)[1], $_sepSTRUC);
  if (($tname = __get_table('_logVER__arT'))) {
    $ref = $RA[RA_var]['ref'] . " / $ref";
    $where_s = "ref__svPQ = '$ref' and major__nuDB = $vers_0 and minor__nuDB = $vers_1";
    $sql = "SELECT _arT as cn__arT, build__nuDB from $tname where $where_s";
    //dz($sql);
    $rows = db_query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    if ($rows) {
      extract($rows[0]);
      $build__nuDB++;
      __format_SQL("$cn__arT, $build__nuDB", '_logVER__acTG', 1);
      $RA[RA_sq][] = "UPDATE $tname set build__nuDB = $build__nuDB where $where_s";
    } else {
      __format_SQL("'$ref', $vers_0, $vers_1, 0, '$vers_2'", '_logVER__arT');
    }
    __exec_SQL();
    dul(["$pp Set verssion: $ver\n"], 1);
    return true;
  }
  return false;
}

function dul(array $log, $echo_it = 0) { $pp = "p001a-11a";
  global $RA;
  if (!$log) $log = $RA[RA_log];
  if (__get_table('_logWDOG__acTG')) {
    foreach ($log as $log_i => $log_s) {
      if ($echo_it) echo "\n$log_i - $log_s";
      if (($is_fcc = preg_match("/p\w\w\w\w-/", $log_s)) || !$log_i) {
        if ($is_fcc) {
          $fcc = explode($RA[RA__tySEP]['_sepWORD'], $log_s)[0];
          $msg = explode($fcc, $log_s)[1];
        } else {
          $fcc = '';
          $msg = $log_s;
        }
        $ref = $RA[RA_var]['ref'];
        $cn__arT = __format_SQL("'$ref', '$fcc', '$msg', " . count($log));
      } else {
        __format_SQL("$cn__arT, $log_i, '$log_s'", '_logWDOG__acTG', 1);
      }
    }
    __exec_SQL();
  } else {
    du($RA[RA_log]);
  }
  $RA[RA_log] = [];
}

function duz(array $log, $ref = 'NULL') { $pp = "p001a-12a";
  dul($log, $ref);
  exit(1);
}
