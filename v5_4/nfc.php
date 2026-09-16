<?php

use Hamcrest\Arrays\IsArray;

global $fti_seg, $fti_max_level, $fti_sq, $fti_sqr, $fti_expra, $fti_frpm_re, $fti_log, $fti_sw_term, $fti_sw_repl,
        $fti_word_1st, $fti_merged_forms, $fti_merged_terms, $fti_var, $fti_version,
        $fti_exWINE,$fti_exVINE,$fti_exREGI,$fti_exGRAP,$fti_exPARS,$fti_sttFINC,$fti_expr__arP, $fti_type__arP,
        $fti_scnMyALL, $fti_scnMyVINE, $fti_scnMyGRAP, $fti_scnMyNAM,
        $fti_scnRaALL, $fti_scnRaVINE, $fti_scnRaGRAP, $fti_scnRaNAM, $fti_latin_ext,
        $fti_update_limit, $fti_register_src, $fti_word__arP,
        $fti_gsNOTHING, $fti_gsGRAPE,$fti_gsMIX_NEW,$fti_gsMIX_DINAMIC,$fti_gsMIX_STORED,
        $fti_seg_next,$fti_seg_mask,$fti_seg_start,$fti_fspFormUnstNumb;
mb_internal_encoding('UTF-8');
include_once "nfc_macro.php";

function check_hex($str) {
  return (substr($str, 0, 2) === '0x' ? hexdec($str) : $str);

}

function nfc_load_all($init_all = 1) {
  global $fti_var;
  if (nfc_loadClass()) {
    //throw new Exception("Err DBG");
    //if (0)
    if ($init_all) {
      load_terms();
      load_attributes();
      load_rules();
      load_regions();
      load_vineyards();
      load_blends();
    }
  }
}

/*
  Load globals vars and arrays.
  Return 0 if errors;

*/
function nfc_loadClass() {
global $fti_seg, $fti_max_level, $fti_sq, $fti_sqr, $fti_expra, $fti_frpm_re, $fti_log, $fti_sw_term, $fti_sw_repl,
  $fti_word_1st, $fti_merged_forms, $fti_merged_terms, $fti_var, $fti_version,
  $fti_exWINE,$fti_exVINE,$fti_exREGI,$fti_exGRAP,$fti_exPARS,$fti_sttFINC,$fti_expr__arP,
  $fti_scnRaALL, $fti_scnRaVINE, $fti_scnRaGRAP, $fti_scnRaNAM, $fti_latin_ext,$fti_latin_spc,
  $fti_update_limit, $fti_register_src,$fti_fspFormUnstNumb,
  $fti_wineTYPE, $fti_gsGRAPE,$fti_gsMIX_NEW,$fti_gsMIX_DINAMIC,$fti_gsMIX_STORED, $fti_gustos_db,
  $fti_seg_next,$fti_seg_mask,$fti_seg_start,$fti_type__arP,$fti_attr_still;

  $FTI_SEP_VAL = FTI_SEP_VAL;
  $FTI_SEP_COMM = FTI_SEP_COMM;
  $FTI_SEP_TYPE = FTI_SEP_TYPE;
  $FTI_SEP_HIE = FTI_SEP_HIE;
  
  $fti_latin_ext = [
    "ã³" => "a", "í“" => "i", "ã¨" => "a", "ä°" => "a", "â%" => "a", "е" => 'e',
    'ё' => 'e', 'ȳ' => 'y', 'ı' => 'i', 'ĳ' => 'ij', 'ƒ' => "f", 'š' => "s",
    'ž' => "z", '¢' => "c", 'µ' => "m", 'ß' => "ss", 'à' => "a", 'á' => "a", 'â' => "a", 'ã' => "a", 'ä' => "a", 'å' => "a",
    'æ' => "", 'ç' => "c", 'è' => "e", 'é' => "e", 'ê' => "e", 'ë' => "e", 'ì' => "i", 'í' => "i", 'î' => "i", 'ï' => "i", 'ð' => "dj", 'ñ' => "n", 'ò' => "o",
    'ó' => "o", 'ô' => "o", 'õ' => "o", 'ö' => "o", '÷' => ",", 'ø' => "o", 'ù' => "u", 'ú' => "u", 'û' => "u", 'ü' => "u", 'ý' => "y", 'þ' => "th", 'ÿ' => "y",
    "і" => "i", "ї" => "i", "n/a" => "",
    'olaszrizling' => 'olasz rizling', 'welschriesling' => 'welsch riesling', 'cabernet f' => 'cabernet franc', 'fountaingrove' => 'fountain grove',
    'rieslingsekt' => 'riesling sekt', 'rieslingspatlese' => 'riesling spatlese', 'rieslingtrocken' => 'riesling trocken', 'trockenbeerenauslese' => 'trocken beerenauslese',
    'blaufrankisch' => 'blau frankisch', 'alterego' => 'alter ego', 'altego' => 'alter ego', 'australgrand' => 'austral grand'
  ];
  $fti_latin_spc = [
    '…' => ",", '†' => ",", '‡' => ",", 'ˆ' => ",", '‰' => ",", '…' => ",", '†' => ",", '‡' => ",", 'ˆ' => ",", '‰' => ",",
    '‹' => ",", '“' => ",", '”' => ",",  '•' => ",", '—' => "-", '˜' => ",", '™' => "", '›' => ",", 'œ' => "", '¡' => "",
    '‹' => ",", '“' => ",", '”' => ",", '•' => ",", '˜' => ",",'›' => ",", '£' => "",'¤' => "",'¥' => "",'¦' => ",",'§' => "",'¨' => ",", '©' => "",'ª' => "",'«' => ",",'¬' => ",",
    '®' => "", "¯" => ",", '°' => "", '±' => "", '²' => "", '³' => "", '·' => ",", '¸' => ",", '¹' => "", 'º' => "",
    '»' => ",", '¼' => "", '½' => "", '¾' => "", '¿' => ",", '×' => ",", "\\" => "/",
    '¦' => ",", '¨' => ",", '«' => ",", '¬' => ",",
    '¶' => ",", '·' => ",", '¸' => ",", "–" => "-", 
    '»' => ",", '¿' => ",", '×' => ",", '÷' => ",", "'"=>'`','‚'=>"`",'„'=>"`",'´'=>"`",'‘'=>"`",'’'=>"`",
    "п'я" => "пя", "П'я" => "пя", "·l" => "l"
  ];  
  if (1 != 1 
      || !db_query("SELECT count(*) from information_schema.TABLES as t where t.TABLE_SCHEMA = 'parsedwine' and t.TABLE_NAME = 'nfc_type__arP';")->fetchColumn()
      || !db_query("SELECT COUNT(*) from nfc_type__arP")->fetchColumn()
    ) {
    return 0;
  }
  $fti_seg = [];
  $fti_log = [];
  $sql2 = 
"SELECT seg_next, seg_start, seg_mask,
    substring_index(substring_index(t2.dsP, '$FTI_SEP_TYPE', 1), '$FTI_SEP_HIE', -1) dsP
  from nfc_type_segments__arPD t1
    left join nfc_type__arP t2 on t2.arP = t1.segment__arP
  where t2.dsP in ('nfc_word__arP', 'nfc_term__arP', 'nfc_expr__arP', 'nfc_form__arP')
  ";
  //cho "\n\n" . $sql2 . "\n\n"; exit;
  $sql = db_query($sql2)->fetchAll();
  foreach ($sql as $row) {
    $fti_seg[$row->dsP] = [];
    foreach ($row as $key => $val) {
      if (is_numeric($val)) {
        $fti_seg[$row->dsP][$key] = (int) $val;
      }
    }
  }
  $sql2 =
"SELECT `level` as arP, dsP as old__dsP,
    if(dsP_pos > 1 and instr(t1.dsP, '__arP') > 0, concat(dsP_CN, '$FTI_SEP_TYPE', dsP_TY), if(dsP_pos = 1, concat(desc_CN, dsP), dsP)) as dsP,
    concat(desc_CN, desc_TY) kval, t1.description, desc_VAL, desc_TY
  from (
    select
      substring_index(substring_index(substring_index(t1.description, '$FTI_SEP_COMM', 1), '$FTI_SEP_TYPE', 1), '$FTI_SEP_HIE', -1) as desc_CN,
      concat('$FTI_SEP_TYPE', substring_index(substring_index(t1.description, '$FTI_SEP_COMM', 1), '$FTI_SEP_TYPE', -1)) as desc_TY,
      if(instr(t1.description, '$FTI_SEP_VAL') > 0, substring_index(t1.description, '$FTI_SEP_VAL', -1), t1.level % 100) as desc_VAL,
      substring_index(substring_index(t1.dsP, '$FTI_SEP_TYPE', 1), '$FTI_SEP_HIE', -1) as dsP_CN,
      substring_index(dsP, '$FTI_SEP_TYPE', -1) as dsP_TY, t1.level, t1.dsP, t1.arP, t1.description,
      instr(t1.dsP, '$FTI_SEP_TYPE') as dsP_pos
    from nfc_type__arP t1
    where arP > 0
    order by arP
  ) t1
  ";
  $sql = db_query($sql2)->fetchAll(PDO::FETCH_ASSOC);
  //d($sql2,array_slice($sql, 0, 20));
  $fti_var = [];
try {
  $fti_var['fspBaseUnstDigit'] = 0;
  foreach ($sql as $row) {
    extract($row);
    $key = $arP;
    $val = $dsP;
    $literal = "fti_$dsP";
    switch ($desc_TY) {
      case '__eS':
        $dsP = $old__dsP;
        $literal = "fti_$dsP";
        $arr = explode(',', $desc_VAL);
        $arP = [];
        for ($i = 0; $i < count($arr); $i++) {
          $elt = explode(':', $arr[$i]);
          if ($i) {
            $arP[1][] = check_hex($elt[1]);
          } else {
            $arP[0] = check_hex($elt[1]);
            $arP[1] = [];
          }
        }
        $key = $arP[1];
        $val = $arP[0];
        break;
      case '__eMB':
      case '__eMI':
      case '__eMS':
      case '__eMT':
      case '__eB':
      case '__eC':
      case '__eH':
        $val = $dsP = $old__dsP;
        $literal = "fti_$dsP";
        $key = $arP = check_hex($desc_VAL);
        break;
      case '__eNV':
        $val = $dsP = $old__dsP;
        $literal = "fti_$dsP";
        $var_name = "fti_$desc_VAL";
        $key = $arP = $$var_name;
        break;
      case '__eN':
        $val = $key;
        $key = $dsP;
    }
    $$literal = $arP;
    $fti_var[$dsP] = $arP;
    if (!isset($fti_var[$kval]) || !is_array($fti_var[$kval])) {
      $fti_var[$kval] = [];
    }
    $fti_var[$kval][$val] = $key;
  }
} catch (Exception $e) {
  $msg = "load nfc_type__arP_P1 kval=$kval, dsP=$dsP, val=" . $val . ", old__dsP=$old__dsP, desc_VAL=$desc_VAL, ". $e->getMessage();
  dop($msg);
  throw new Exception($msg . $e->getTraceAsString());
}
  $fti_seg_next = $fti_seg['form']['seg_next'];
  $fti_seg_mask = $fti_seg['form']['seg_mask'];
  $fti_seg_start = $fti_seg['form']['seg_start'];
  //d($fti_var); //array_slice($fti_var, 0, 20));
try {
  $rows = db_query("SELECT arP, word__eMT, dsP, len from nfc_word__arP")->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
  print_r($e);
  return 0;
}
  $fti_var['fspBaseUnstPunct__dsP'] = $fti_var['fspBaseUnstDigit__arP'] = $fti_seg['fspFormStopWord__arP'] = $fti_seg['fspBaseStopWord__arP'] = $fti_seg['word'] = [];
  foreach ($rows as $row) {
    extract($row);
    $fti_seg['word']['dsP'][$dsP] = $arP;
    $fti_seg['word']['arP'][$arP]['dsP'] = $dsP;
    $fti_seg['word']['arP'][$arP]['len'] = $len;
    $fti_seg['word']['arP'][$arP]['eMT'] = $word__eMT;
    $arP_masked = $arP & $fti_seg_next;
    switch ($word__eMT) {
      case $fti_var['fspFormStopWord']: // is eliminated elsewere unconditional
            $fti_seg['fspFormStopWord__arP'][$arP_masked] = $dsP;
      case $fti_var['fspBaseStopWord']: // is eliminated elsewere but at the end of term
            $fti_seg['fspBaseStopWord__arP'][$arP_masked] = $dsP;
            break;
      case $fti_var['fspBaseUnstPunct']:
            $fti_var['fspBaseUnstPunct__dsP'][$dsP] = $arP;
            break;
      case $fti_var['fspBaseUnstDigit']:
            $fti_var['fspBaseUnstDigit__arP'][$arP] = $dsP;
            break;
    }
  }
  //d($fti_seg['fspBaseStopWord__arP'], $fti_seg['fspFormStopWord__arP']);
//  echo "\nW2.is_setForm[1050310]=".(isset($fti_seg['fspFormStopWord__arP'][1050310])?1:0).", is_setBase=".(isset($fti_seg['fspBaseStopWord__arP'][1050310])?1:0).", word__arP[dos]=".$fti_seg['word']['dsP']['dos'];
  $fti_sq['a1'] =
    "INSERT into nfc__arP (arP)
      values "
  ;
  $fti_sq['e3'] =
    "INSERT into nfc_expr__acPU_term (expr__arP, el__id, term__arP)
      values "
  ;
  $fti_sq['update_word_count'] =
    "UPDATE nfc_word__arP
      set cnt = cnt + 1
      where arP = 
  ";
  $fti_sq['t0'] =
    "UPDATE nfc_term__arP
      set cnt = cnt + 1
      where arP = 
  ";
  $fti_sq['insert_word'] =
    "INSERT into nfc_word__arP (arP, len, dsP, word__eMT)
      values "
  ;
  $fti_sq['t3'] =
    "INSERT into nfc_term__acPU_word (term__arP, el__id, word__arP)
      values "
  ;
  $fti_sq['term'] =
    "INSERT into nfc_term__arP (arP,len,next__id,dsP,rang)
      values"
  ;
  $fti_sqr['r0'] = $fti_sqr['r1'] = $fti_sqr['r2'] = $fti_sqr['r3'] = $fti_sqr['r4'] = $fti_sqr['r6'] = $fti_sqr['r7'] = $fti_sqr['r8'] = $fti_sqr['r9'] = $fti_sqr['rA'] = '';
  return 1;
}
//[$term__typ, $term__id, $term__arP, $par__arP, $par__typ, $term__name];
const EXPR__arP_term__id = 0;
const EXPR__arP_term__dsP = 1;
const EXPR__arP_term__typ = 2;
const EXPR__arP_par__arP = 3;
const EXPR__arP_chiTerm__arP = 4;
const EXPR__arP_new__id = 5;
const EXPR__arP_el__id = 6;
const EXPR__arP_rang = 7;

const TERM_rang_par__arP = 0;
const TERM_rang_el__id = 1;
const TERM_rang_term__arP = 2;

const TERM_ID_id__arP = 0;
const TERM_ID_el__id = 1;
const TERM_ID_new__id = 2;
const TERM_ID_tara = 3;

function load_terms() {
  global $fti_var, $fti_seg;

  $sql = "call nfc_term__asPL_load()";
  // "SELECT term__arP, el__id, term__id, dsP, rang, term__typ, expr__arP, id__arP, par__arP, new__id, countries
  $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
  //d($rows);
  $fti_seg['expr__arP'] = $fti_seg['term'] = $fti_seg['term__arP'] = $fti_seg['term__id'] = [];
  foreach ($rows as $row) {
    extract($row);
    $fti_seg['expr__arP'][$expr__arP][$term__arP] = [
      EXPR__arP_term__id      => $term__id,
      EXPR__arP_term__dsP     => $dsP,
      EXPR__arP_term__typ     => $term__typ,
      EXPR__arP_par__arP      => $par__arP,
      EXPR__arP_chiTerm__arP  => $chiTerm__arP,
      EXPR__arP_new__id       => $new__id,
      EXPR__arP_el__id        => $el__id,
      EXPR__arP_rang          => $rang
    ];
    $fti_seg['term__arP'][$term__arP][$term__typ][$term__id] = $expr__arP;
    if (!isset($fti_seg['term__id'][$term__typ][$term__id])) {
      $fti_seg['term__id'][$term__typ][$term__id] = [
        TERM_ID_id__arP => $id__arP,
        TERM_ID_el__id  => $el__id,
        TERM_ID_new__id => $new__id,
        TERM_ID_tara      => array_flip(explode(',', $countries))
      ];
    }
    $fti_seg['term'][$rang][$dsP][$term__typ][$expr__arP] = [
      TERM_rang_par__arP  => $par__arP,
      TERM_rang_el__id    => $el__id,
      TERM_rang_term__arP => $term__arP
    ];
    //if ($term__typ == 319827969) echo "\nexpr__arP=$expr__arP,term__id=$term__id,term__arP=$term__arP";
  }
  return 1;
  //d($fti_seg['term']);
}

function unset_terms($expr__arP) {
  global $fti_var, $fti_seg;
  //rang=18, dsP=100537100098100208, type=27262978, expr__arP=3183733
  //print_r($GLOBALS['fti_seg']['term'][18]['100537100098100208'][27262978][3183733]);
  if (isset($fti_seg['expr__arP'][$expr__arP])) {
    foreach ($fti_seg['expr__arP'][$expr__arP] as $term__arP => $arr) {
      //echo "\nterm__arP=$term__arP, rang=".$arr[EXPR__arP_rang].", dsP=".$arr[EXPR__arP_term__dsP].", type=".$arr[EXPR__arP_term__typ].", expr__arP=".$expr__arP;
      unset($GLOBALS['fti_seg']['term'][$arr[EXPR__arP_rang]][$arr[EXPR__arP_term__dsP]][$arr[EXPR__arP_term__typ]]); //[$expr__arP]);
    }
  }
}

function reg_log() {
  global $fti_log;
  if (count($fti_log)) {
    $sql_e = $sql_i =
    "INSERT into nfc_log__arS
        (action__eN, dsP)
      values"
    ;
    $j = 0;
    foreach ($fti_log as $i => $msg) {
      $sql_e .= ($j ? ',' : '') . "
        ('" . (isset($msg[1]) ? $msg[1] : "msg-$i") . "', '" . substr(strtr($msg[0], ["'" => "\'", "\\" => "\\\\"]),0,15000) . "')";
      if (++$j == 10) {
        $j = 0;
        db_query($sql_e);
        $sql_e = $sql_i;
      }
    }
    if ($j) {
      // if (count($fti_log) == 2) echo $sql_e;
      db_query($sql_e);
    }
  }
  $fti_log = [];
}

function dog($msg) {
  global $fti_log;
  $fti_log[] = [$msg];
  reg_log();
}

function dop($msg) {
  global $fti_log;
  $fti_log[] = [$msg];
  reg_log();
  echo "\n$msg\n";
}

function dol($msg) {
  global $fti_log;
  $fti_log[] = [$msg];
}

function doa($msg, array $arr) {
  global $fti_log;
  $fti_log[] = [$msg];
  foreach ($arr as $key => $val) {
    $fti_log[] = "key($key)/val=" . (is_array($val) ? implode(',', $val) : $val);
  }
  $fti_log[] = [$msg];
  reg_log();
}

function reg_expr() {
  global $fti_sqr, $fti_var,$fti_row;
  db_query("start transaction");
  try {
    if ($fti_sqr['r0'] != '') {
      if (is_array($fti_sqr['r0'])) {
        $sqra = $fti_sqr['r0'];
      } else {
        $sqra = [$fti_sqr['r0']];
      }
      foreach ($sqra as $sqr) {
        db_query($sqr);
      }
    }
    if ($fti_sqr['r1'] != '') {
      db_query($fti_sqr['r1']);
    }
    if ($fti_sqr['r2'] != '') {
      db_query($fti_sqr['r2']);
    }
    if ($fti_sqr['r3'] != '') {
      db_query($fti_sqr['r3']);
    }
    if ($fti_sqr['r4'] != '') {
      db_query($fti_sqr['r4']);
    }
    if ($fti_sqr['r6'] != '') {
      db_query($fti_sqr['r6']);
    }
    if ($fti_sqr['r7'] != '') {
      db_query($fti_sqr['r7']);
    }
    if ($fti_sqr['r8'] != '') {
      db_query($fti_sqr['r8']);
    }
    if ($fti_sqr['r9'] != '') {
      db_query($fti_sqr['r9']);
    }
    if ($fti_sqr['rA'] != '') {
      db_query($fti_sqr['rA']);
    }
    db_query("commit");
    $fti_sqr['r0'] = $fti_sqr['r1'] = $fti_sqr['r2'] = $fti_sqr['r3'] = $fti_sqr['r4'] = $fti_sqr['r6'] = $fti_sqr['r7'] = $fti_sqr['r8'] = $fti_sqr['r9'] = $fti_sqr['rA'] = '';
  } catch (Exception $e) {
    db_query("rollback");
    $msg = "ErrFTI(reg_expr__Point_1)" . (isset($fti_row['name']) ? ",name(" . $fti_row['name'] . "), " : '')
          . ", r0/" . (is_array($fti_sqr['r0']) ? $fti_sqr['r0'][0] : $fti_sqr['r0'])
          . ", r1/" . $fti_sqr['r1'] . ", r2/" . $fti_sqr['r2'] . "/, r4/" . $fti_sqr['r4'] . "/, r6/" . $fti_sqr['r6']
          . "/, r7/" . $fti_sqr['r7']. "/, r8/" . $fti_sqr['r8'] . "/, r9/" . $fti_sqr['r9'] . "/, rA/" . $fti_sqr['rA'] . $e->getMessage();
    dog($msg);
    throw new Exception($msg . $e->getTraceAsString());
  }
}

function seg_next_arP($segn, $cnt = 1) {
  global $fti_var;
  db_query("start transaction");
  $arP = db_query(
    "SELECT seg_next 
      from nfc_type_segments__arPD 
      where segment__arP = $segn
      FOR UPDATE
  ")->fetchColumn();
  db_query("UPDATE nfc_type_segments__arPD set seg_next = seg_next + $cnt where segment__arP = $segn");
  db_query('commit');
  return $arP;
}

function norm_it($in_str, $is_elim_salpha = 0) {
  global $fti_latin_ext, $fti_latin_spc;
  return
  // 13. convert the rest of diacritics symbols and to lower case.
  strtr(mb_strtolower(
  // 12. eliminate some extra spaces and commas
  preg_replace("/^( *,+ *)+|" . (($is_elim_salpha & FTI_PARSE_NAME__NORM_IT_elim_single_alpha) ? "\b[[:alpha:]]\b|" : "") . "( *,+ *)+(?=,)| +(?= )|( *,+ *)+$/um", "",
  // 11. change vintage designations to normalized one ( yo )
  preg_replace("/\d\K *(an(i|ul|os?)|year(s|) old|years|y(o|)\b|роки|рокiв|лет)/ium"," yo ",
  // 10. change rest of punctuation to 'comma'
  preg_replace("/\R+|[!\"#%$&'()\*\+,\-\/:;<=>?@[\]\^`{|}~]|(?<=\D)[\.]|[\.](?=\D)/um", ",",
  // 9. change some number styles designation before digits to normalized form (no \d+)
  preg_replace("/(\bno|\bn|#) *(?=\d+)|№/ium", " num ",   
  // 8. eliminate some case sensitive stop words without their legal analog. Example: (Al) and (al) to exclude but not (AL)
  preg_replace("/(?<=[[:alpha:]]\w)`(?=\w)|\b((i|I)(n|l)|(a|A|d|D)l|(l|L)a|lui|LUI)\b/um", "", // |(c|C)a // \\b[^ ]\\s*\´
  //preg_replace("/(?<=[[:alpha:]]\w)`(?=\w)|\b((d|D)(o|u|e|E)|(c|C)a|(i|I)(n|l)|(a|A)l|(l|L)a|lui|LUI)\b|(?<!(\w|`))[[:alpha:]](?!(\w|$))/um", "",
  // 7. change rest of punctuations and extra spaces to one space
  preg_replace("/ y +| +|\v+|\t+|[%?$!\^]+|(?<=[[:alpha:]])\s*[-.]\s*|(?<=\d)[-.]\s*(?=[[:alpha:]])/ium"," ",
  // 6. change some different styles of abbreviation to one without punctuations at all
  //preg_replace("/\d*[.]?\d+\s*((((m|)l|g(r|)|alc))\.?(?!\w)|%)|(?<!\.|\w)0?\.\d+(?!\.|\w)|(\d|\b)[[:alpha:]]\K\s*\.\s*(?!([[:alpha:]]\w|\d))|-do\b/ium", "",
  preg_replace("/(\bal(c\.?|\.)\s*)?\d*[.]?\b\d+\s*(((m|)l|g(r|)|alc)\.?(?!\w)|%(\s*alc(\.|\b))?)|\bvol\b|(?<!\.|\w)0?\.\d+(?!\.|\w)|(\d|\b)[[:alpha:]]\K\s*\.\s*(?!([[:alpha:]]\w|\d))|-do\b/ium", "",
  // 5. change all different punctuation near \w to dot
  preg_replace("/(?<=\d)\s*[`,\/\\\\*+\-@#$!&_:;<>?|!]+(?=\d)|(?<=\b\w)\s*[`\/\\\\*+\-@#$!&_:;<>?|!]+\s*(?=\w)/um", ".",
  //preg_replace("/(?<=\w)\s*[,\/\\\\*+\-@#$!&_:;<>?|!]+\s*(?=\w)/um", ".",
  // 4. change some special punctuation sequence to comma (not complete)
  preg_replace("/\s+-\s*|(?<=[[:alpha:]]\w)\s*[|\/\\\\+@&]\s*/um", ",",
  // 3. change some regions designation to normal one (not complete)
  preg_replace("/\b(р-н(у|)|в-во) */ium","rw ",
  // 2. eliminate some apostrophes after some words when was used as grammatic form - (this is bad rule but was used as compromise)
  preg_replace("/(?<=\w\w)` /um", " ", //(?<=\w\w)` //\b[[:alpha:]]\s*`//
  // 1. change extend punctuation to 'comma' and 'apostrophe' like symbols to 'back apostrophe' and 1-st round converting diacritic to its analogs
  preg_replace("/[\x{0300}-\x{036f}]|\b[[:alpha:]]\s*`(?![[:alpha:]]\b)/um","", normalizer_normalize(strtr($in_str, $fti_latin_spc), Normalizer::FORM_D))
    ,1))))
))
)
))))
,'UTF-8'),$fti_latin_ext)
;
}

function expra_word($name, $is_eliminate_single_alpha = 0) {
  global $fti_seg, $fti_sq, $fti_words, $fti_expra, $fti_var, $fti_terme, $fti_seg_next,$fti_fspFormUnstNumb;
  $norm_name = norm_it($name, $is_eliminate_single_alpha);  
  $norm_name = preg_replace("/^\s*|\s*(?=(\s|,|\.))|(?<=(,|\.))\s*|\s*$/u", "", $norm_name);
  $terms = explode(',', $norm_name);
  $i_term = $fti_expra['cnt'] = 0;
  $fti_words = $fti_terme = [];
  //d($name, $terms);
  //echo "\nold name($name), norm_name($norm_name)\n";
  foreach ($terms as $j_term => $term) {
    $words = explode(' ', $term);
    $fti_terme[$i_term] = [];
    $sq_p = $sq_w = '';
    $sq_wf = $sq_wi = 0;
    //d($norm_name,$terms,$words);
    $fti_word_cnt = count($words);
    if (!$fti_word_cnt--) {
      continue;
    }
    $arP = 0;
    $wordk = array_flip($words);
    db_query("start transaction");
    $sql = "SELECT dsP, arP from nfc_word__arP where dsP IN ('" . implode("','", $words) . "') FOR UPDATE";
    $wordf = db_query($sql)->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_GROUP);
    $arPA = array_diff_key($wordk, $wordf);
    if ($arPA) {
      $arP = db_query("SELECT seg_next from nfc_type_segments__arPD where segment__arP = " . $fti_var["word__arP"]. " FOR UPDATE")->fetchColumn();
      db_query("UPDATE nfc_type_segments__arPD set seg_next = seg_next + " . count($arPA) . " where segment__arP = " . $fti_var["word__arP"]);
      try {
        foreach ($arPA as $word => $i) {
          $sq__eMT = (preg_match("/\D/", $word) ? 0 : $fti_fspFormUnstNumb);
          $sq_wi = mb_strlen($word);
          $fti_seg['word']['dsP'][$word] = $arP;
          $fti_seg['word']['arP'][$arP]['dsP'] = $word;
          $fti_seg['word']['arP'][$arP]['len'] = $sq_wi;
          $fti_seg['word']['arP'][$arP]['eMT'] = $sq__eMT;
          if ($sq_wf++) {
            $sq_w .= ',';
            $sq_p .= ',';
          }
          $sq_w .= "($arP, $sq_wi,'$word', $sq__eMT)";
          $sq_p .= "(" . $arP++ . ")";
        }
        $sqr1 = $fti_sq['a1'] . $sq_p;
        $sqr2 = $fti_sq['insert_word'] . $sq_w;
        //d($sqr1,$sqr2);
        db_query($sqr1);
        db_query($sqr2);
      } catch (Exception $e) {
        $msg = "ErrFTI(expra_word__P_1)word=$word,arP=$arP,name=($name)" . $e->getMessage();
        db_query("rollback");
        dog($msg);
        throw new Exception($msg . $e->getTraceAsString());
      }
    }
    db_query("commit");
    foreach ($words as $i => $word) {
      $arP_masked = $fti_words[] = $arP = $fti_seg['word']['dsP'][$word];
      $arP_masked &= $fti_seg_next;
      // echo "\nW1.is_setForm[$arP_masked]=".(isset($fti_seg['fspFormStopWord__arP'][$arP_masked])?1:0).", is_setBase=".(isset($fti_seg['fspBaseStopWord__arP'][$arP_masked])?1:0).", i=$i, fti_word_cnt=$fti_word_cnt";
      if (!isset($fti_seg['fspFormStopWord__arP'][$arP_masked]) && (!isset($fti_seg['fspBaseStopWord__arP'][$arP_masked]) || $i == $fti_word_cnt)) {
        $fti_terme[$i_term][] = $arP_masked;
        $fti_expra['word'][$arP_masked] = $arP_masked;
        $fti_expra['cnt']++;
        // echo "\n$word";
      }
    }
    $i_term++;
  }
  return $norm_name;
}

const REG_TERM_arP = 0;
const REG_TERM_arPS = 1;
const REG_TERM_dsP = 2;
const REG_TERM_rang = 3;
const REG_TERM_len = 4;
const REG_TERM_arDS = 5;
const REG_TERM_origin__arP = 6;

function reg_term($term, $exTYPE = 0, $ignore_test_used = 0) {
  global $fti_sq, $fti_sqr, $fti_seg, $fti_var, $fti_exWINE, $fti_exREGI, $fti_exTARA;
  $origin__arP = $arP = $sq_wr = $rang = $i = 0;
  $sq_w = $arPS = $arDS = $dsP = '';
  foreach ($term as $arP_masked) {
    $sq_wr += $fti_seg['word']['arP'][$arP_masked]['len'];
    if ($i) {
      $arPS .= ',';  
      $sq_w .= ',';
      $arDS .= ' ';
    }
    $arPS .= $arP_masked;
    $arDS .= $fti_seg['word']['arP'][$arP_masked]['dsP'];
    $sq_w .= "(#, " . $i++ . ", $arP_masked)";
    $dsP .= str_pad(strtoupper(dechex($arP_masked)), FTI_RANG_SZ, '0', STR_PAD_LEFT);
    $rang += FTI_RANG_SZ;
  }
  try {
    if ($exTYPE != $fti_exWINE[0]) {
      //echo "\nignore_test_used=$ignore_test_used, key&2=".(key($fti_seg['term'][$rang][$dsP] ?? [0]) & FTI_MASK__ALL).", exTYPE=".($exTYPE & FTI_MASK__ALL).", rang=$rang, dsP=$dsP, key=".key($fti_seg['term'][$rang][$dsP]);
      db_query("start transaction");
      if (!($arP = db_query("SELECT arP from nfc_term__arP where dsP = '$dsP' FOR UPDATE")->fetchColumn())) {
        $arP = db_query("SELECT seg_next from nfc_type_segments__arPD where segment__arP = " . $fti_var["term__arP"]. " FOR UPDATE")->fetchColumn();
        db_query("UPDATE nfc_type_segments__arPD set seg_next = seg_next + 1 where segment__arP = " . $fti_var["term__arP"]);
        $sqr3 = $fti_sq['a1'] . "($arP)";
        $sqr4 = $fti_sq['term'] . "($arP,$sq_wr,$i,'$dsP',$rang)";
        $sqr5 = $fti_sq['t3'] . strtr($sq_w, ['#' => $arP]);
        //echo "\nterm=$term\n$arP\n$sqr3\n$sqr4\n$sqr5\n";
        db_query($sqr3);
        db_query($sqr4);
        db_query($sqr5);
      } elseif (1 == 1
                && (($ignore_test_used & FTI_PARSE_NAME__REG_TERM_ignore_term))
                && ((key($fti_seg['term'][$rang][$dsP] ?? [0]) & FTI_MASK__ALL)) > ($exTYPE & FTI_MASK__ALL)
      ) {
        $origin__arP = $arP;
        $arP = 0;
      }
      db_query("commit");
    }
  } catch (Exception $e) {
    $msg = $e->getMessage();
    db_query("rollback");
    $msg = "ErrFTI(reg_term__P_1)term__dsP=$dsP,arP=" . ($arP ?? 'NULL') 
      //. (",sqr4($sqr4),sqr5($sqr5)")
      . $msg;
    dog($msg);
    throw new Exception($msg . $e->getTraceAsString());
  }
  return [$arP, $arPS, $dsP, $rang, $sq_wr, $arDS, $origin__arP];
}

function parse_name($exTYPE, $name, $terms_search_mask = 0, $is_eliminate_single_alpha = 0) {
  global $fti_expra, $fti_terme, $fti_terms, $mix_arr, $fti_row;
  expra_word($name, $is_eliminate_single_alpha);
  //dd($name, $fti_expra, $fti_terme);
  search_terms($terms_search_mask, $exTYPE[0]);
  //d($fti_expra, $fti_terme, $fti_terms, $mix_arr);
  $ret_term = '';
  foreach ($fti_terme as $j => $term) {
    if (($term__cnt = count($term))) {
      $arPA = reg_term($term, $exTYPE[0], $is_eliminate_single_alpha);
      if ($ret_term == '') {
        $ret_term = $arPA[REG_TERM_arDS];
      }
      $key = $arPA[REG_TERM_arP];
      $fti_expra['term__arP'][$j] = $key;
      if (!isset($fti_expra['term'][$key])) {
        $fti_expra['term'][$key] = $arPA[REG_TERM_arPS];
        $fti_expra['term__cnt'][$key] = $term__cnt;
        $fti_expra['term__len'][$key] = $arPA[REG_TERM_len];
        $fti_expra['term__dsP'][$key] = $arPA[REG_TERM_dsP];
        $fti_expra['term__arDS'][$key] = $arPA[REG_TERM_arDS];
        $fti_expra['origin__arP'][$key] = $arPA[REG_TERM_origin__arP];
      }
    }
  }
  //d($fti_terme, $fti_row, $fti_expra);
  return $ret_term;
}

function reg_query($exTYPE, $name, $arP = 0, $terms_search_mask = 0, $parExpr__arP = 0) {
  global $fti_expra, $fti_row;
  $fti_expra = [];
  parse_name($exTYPE, $name, $terms_search_mask); // eliminate accents
  $fti_row['expr__eMI'] = 0;
  return prep_query($exTYPE, $arP, (count($fti_expra['term'] ?? []) ? key($fti_expra['term']) : 0), $parExpr__arP);
}

function prep_query($exTYPE, $arP, $chiTerm__arP = 0, $parExpr__arP = 0) {
    global $fti_var, $fti_row, $fti_seg, $fti_sq, $fti_sqr, $fti_expra;
//d($fti_expra);
  if (!$arP) {
    $arP = seg_next_arP(NFC_EXPR__arP);
    $fti_sqr['r1'] = $fti_sq['a1'] . "($arP)";
  }
  if (!($id = $fti_row['id'])) {
    $id = $arP;
  }
  $max_chars = 0;
  $word_cnt = $fti_expra['cnt'];
  if (count($fti_expra['word'] ?? [])) {
    foreach ($fti_expra['word'] as $word => $j) {
      $max_chars += $fti_seg['word']['arP'][$word]['len'];
    }
  }
  if (($fti_expr_cnt = count($fti_expra['term'] ?? []))) {
    $fti_expr_cnt = 0;
    $chiTerm__arP = key($fti_expra['term']);
    $fti_sqr['r4'] = '';
    foreach ($fti_expra['term'] as $term => $j) {
      if ($term) {
        $fti_sqr['r4'] .= ($fti_expr_cnt++ ? ',' : $fti_sq['e3']) . " ($arP, " . ($fti_expr_cnt - 1) . ", $term)";
      }
    }
  }
  if ($fti_sqr['r1'] == '') {
    $fti_sqr['r2'] =
      "UPDATE nfc_expr__arP
        set expr__eS = " . $exTYPE[0]. ", expr__eMI = " . $fti_row['expr__eMI'] . ", parExpr__arP = $parExpr__arP,
            chiTerm__arP = $chiTerm__arP, id = $id, next__id = $fti_expr_cnt, word__cnt = $word_cnt, char__cnt = $max_chars,
            attrTYPE__arS = " . (isset($fti_row['attrTYPE__arS']) ?? 'NULL') . ",
            attrTITLE__arS = " . (isset($fti_row['attrTITLE__arS']) ?? 'NULL') . ",
            new__id = " . ($fti_expra['new__id'] ?? 0) . ",
            countries = '" . ($fti_row['countries'] ?? '') . "'
        where arP = $arP
    ";
  } else {
    $fti_sqr['r2'] =
      "INSERT into nfc_expr__arP
          (arP, expr__eS, expr__eMI, parExpr__arP,
            chiTerm__arP, id, next__id, word__cnt, char__cnt, new__id, countries, attrTYPE__arS, attrTITLE__arS)
        values
          ($arP, " . $exTYPE[0]. ", " . $fti_row['expr__eMI'] . ", $parExpr__arP"
          . ", $chiTerm__arP, $id, $fti_expr_cnt, $word_cnt, $max_chars, "
          . ($fti_expra['new__id'] ?? 0) . ", '". ($fti_row['countries'] ?? '') . "', "
          . (isset($fti_row['attrTYPE__arS']) ?? 'NULL') . ", "
          . (isset($fti_row['attrTITLE__arS']) ?? 'NULL')
    . ")";
  }
  //d($fti_sqr['r1'],$fti_sqr['r2'],$fti_sqr['r4'],$fti_sqr['r6']);
  return $arP;
}

function reg_blends() {
  global $fti_gustos_db, $fti_var;
  $exGRAP = $fti_var['exGRAP'][0];
  db_query("DELETE FROM nfc_expr_grap__arS_blend");
  dop("Starting all blends registration");
  $sql_s = 
    "SELECT i1.wine_entity, group_concat(distinct i3.id order by i3.id) as blend__dsP, count(*) as blend__cnt
      from $fti_gustos_db.gustos_wine_grapes as i1
        left join nfc_expr_grap__arPD_link as i2 on i2.link__id = i1.grape
        left join nfc_expr__arP as i3 on i3.id = ifnull(i2.grap__id, i1.grape)
      where i3.expr__eS = $exGRAP
      group by i1.wine_entity
  ";
  db_query(
    "INSERT into nfc_expr_grap__arS_blend
        (arS, blend__dsP, blend__cnt, min__weID)
    SELECT
      ROW_NUMBER() over(order by blend__dsP) as arS,
      blend__dsP, min(blend__cnt), min(wine_entity)
    from (
      $sql_s
    ) as t1
    group by blend__dsP
  ");
  $ins_blends = db_query("SELECT ROW_COUNT()")->fetchColumn();
  db_query(
    "INSERT INTO nfc_expr_grap__acSG_blend
        (blend__arS, grap__id)
      select
        distinct a1.arS, a4.id as grap__id
      from nfc_expr_grap__arS_blend as a1
        left join $fti_gustos_db.gustos_wine_grapes as a2 on a2.wine_entity = a1.min__weID
        left join nfc_expr_grap__arPD_link as a3 on a3.link__id = a2.grape
        left join nfc_expr__arP as a4 on a4.id = ifnull(a3.grap__id, a2.grape)
      where a4.expr__eS = $exGRAP
  ");

}

function load_blends() {
  global $fti_seg;
  $sql = "SELECT arS, blend__dsP, blend__cnt FROM nfc_expr_grap__arS_blend";
  $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $fti_seg['blends'] = [];
  foreach ($rows as $row) {
    $fti_seg['blends'][$row['blend__dsP']][$row['arS']] = $row['blend__cnt'];
  }
}

function reg_tag() {
  global $fti_gustos_db, $fti_seg, $fti_var, $fti_sq, $fti_sqr, $fti_expra, $fti_terms, $fti_terme, $fti_seg_next;
  dop("Starting registration all tags in all wines");
  $exATAG = $fti_var['exATAG'][0];
  $real_cnt = $old_cnt = $alt_cnt = 0;
  $dst_rang = 12;
  $tags_cnt = db_query("SELECT count(*) from nfc_tag__arS")->fetchColumn();
  $last_sy__arP = db_query("SELECT max(base__arP) & $fti_seg_next from nfc_word__arS_group")->fetchColumn();
  $sql_s = 
    "SELECT a3.arP, count(*) as cnt
      from nfc_expr__acPU_term as a1
        inner join nfc_expr_wine__arPD as a2 on a2.arP = a1.expr__arP
        left join (
          select b1.arP, b1.rang, b1.state__eMI
          from nfc_term__arP as b1
            left join nfc_term__acPU_word as b2 on b2.term__arP = b1.arP
          group by b1.arP, b1.rang, b1.state__eMI
          having sum(if(b2.word__arP > $last_sy__arP, 1, 0)) > 0
        ) as a3 on a3.arP = a1.word__arP
      where 1=1
        and a3.rang = $dst_rang
        and a3.state__eMI is null
      group by a3.arP
      having count(*) > 1
  ";
  //d($sql_s);
  db_query(
    "UPDATE nfc_term__arP as u1
      inner join ($sql_s) as u2 on u2.arP = u1.arP
      set u1.expr__eS = u1.expr__eS | $exATAG, state__eMI = $exATAG, u1.cnt = u2.cnt
  ");
  $tags_cnt += db_query("SELECT ROW_COUNT()")->fetchColumn();
  db_query(
    "INSERT INTO nfc_tag__arS (term__arP)
      select arP
      from nfc_term__arP
      where state__eMI = $exATAG
  ");
  $serch_cnt = db_query(
    "SELECT count(*)
      from (
        SELECT DISTINCT a1.word__arP
          from nfc_expr__acPU_term as a1
            inner join nfc_expr_wine__arPD as a2 on a2.arP = a1.expr__arP
            left join nfc_term__arP as a3 on a3.arP = a1.word__arP 
           where a3.rang >= $dst_rang
      ) b1
  ")->fetchColumn();
  dop("  tags_cnt=$tags_cnt, search_cnt=$serch_cnt");
  $sql_s =
    "SELECT instr(a1.dsP, a4.dsP) as pos__id,
        a1.arP as dst__arP, a1.dsP as dst__dsP, a4.arP as src__arP, a4.dsP as src__dsP, a4.rang as src__rang
      from nfc_term__arP as a1
        cross join nfc_tag__arS as a2
        left join nfc_term__arP as a4 on a4.arP = a2.term__arP 
      where 1=1
        and exists(
          SELECT 1 from nfc_expr__acPU_term as b1
          where 1=1
            and b1.word__arP = a1.arP
            and exists(select 1 from nfc_expr_wine__arPD as b2 where b2.arP = b1.expr__arP) -- and b2.wine = 1960)
        )
        and a1.rang > a4.rang
        and instr(a1.dsP, a4.dsP) > 0
      order by src__rang desc, (a4.cnt + if(a4.state__eMI < $exATAG, 10000, 0)) desc
  ";

  //d($sql_s);
  $rows = db_query($sql_s)->fetchAll(PDO::FETCH_ASSOC);
  dop("  found_cnt=" . count($rows));
  $new_row = [];
  try {
    $exWINE = $fti_var['exWINE'][0] & $fti_var['syGroupMT'];
    foreach ($rows as $row) {
      extract($row);
      //d($rows, $row);
      $new_dst__dsP = isset($new_row[$dst__arP]) ?  $new_row[$dst__arP] : $dst__dsP;
      $new__dsP = strtr($new_dst__dsP, [$src__dsP => '']);
      if ($new__dsP != $new_dst__dsP) {
        $real_cnt++;
        $new_row[$dst__arP] = $new__dsP;
        $alt__arP = db_query(
          "SELECT arP
            from nfc_term__arP
            where 1=1
              and dsP = '$new__dsP'
              and (expr__eS & $exWINE) = $exWINE
        ")->fetchColumn() ?? 0;
        //d($alt__arP, $new_dst__dsP, $new__dsP, $src__dsP, $row);
        db_query(
          "INSERT into nfc_expr__acPU_term
              (expr__arP, el__id, word__arP)
            select expr__arP, if($pos__id = 1, min(el__id) - 1, max(el__id) + 1), $src__arP
            from nfc_expr__acPU_term as i1
            where exists (select 1 from nfc_expr__acPU_term as i2 where i2.expr__arP = i1.expr__arP and i2.word__arP = $dst__arP)
            group by expr__arP
        ");
        if ($alt__arP) {
          db_query("UPDATE nfc_expr__acPU_term set word__arP = $alt__arP where word__arP = $dst__arP");
          $alt_cnt += db_query("SELECT ROW_COUNT()")->fetchColumn();
          echo "\r    alt_cnt=$alt_cnt, cnt=$real_cnt                                                                ";
          db_query("DELETE from nfc__arP where arP = $dst__arP");
        } else {
          db_query("UPDATE nfc_term__arP set rang = rang - $src__rang, dsP = '$new__dsP' where arP = $dst__arP");
          $old_cnt += db_query("SELECT ROW_COUNT()")->fetchColumn();
          echo "\r    old_cnt=$old_cnt, cnt=$real_cnt                                                                ";
          db_query(
            "DELETE d1 from nfc_term__acPU_word as d1
              cross join nfc_term__acPU_word as d2
              where 1=1
                and d1.term__arP = $dst__arP
                and d2.term__arP = $src__arP
                and d1.word__arP = d2.word__arP
          ");
        }
      }
    }
  } catch (Exception $e) {
    print_r($e);
    print_r($row);
  }
  dop("    alt_cnt=$alt_cnt, old_cnt=$old_cnt\n  Ending registration all tags in all wines, found_cnt_real=$real_cnt\n");

}

const RULE_ID_arS = 0;
const RULE_ID_rule__eMI = 1;
const RULE_ID_when__eMI = 2;
const RULE_ID_column__dsP = 3;
const RULE_ID_term__arP = 4;
const RULE_ID_key__eMI = 5;
const RULE_ID_key__id = 6;

function load_rules() {
  global $fti_seg, $fti_var;
  $sql = "call nfc_rule__arS__asPL_load()";
  $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $fti_seg['rule'] = [];
  $msg = '';
  foreach ($rows as $row) {
    extract($row);
    if (!isset($fti_seg['expr__arP'][$key__arP])) {
      $msg = "load_rules_e1 - some terms not found for rule($acSG)";
      dop($msg);
      dd($row);
    }
    if (isset($fti_seg['rule'][$when__eMI][$term__dsP][$key__arP])) {
      $msg = "load_rules_e2 - not unique combination when__eMI($when__eMI) and term__dsP($term__dsP) found for rule($acSG)";
      dop($msg);
      dd($row);
    }
    $fti_seg['rule'][$when__eMI][$term__dsP][$key__arP] = $acSG;
    $fti_seg['rule__arS'][$acSG] = [
      RULE_ID_arS         => $arS,
      RULE_ID_rule__eMI   => $rule__eMI,
      RULE_ID_when__eMI   => $when__eMI,
      RULE_ID_column__dsP => $fti_var['column__eN'][$column__eN],
      RULE_ID_term__arP   => $term__arP,
      RULE_ID_key__eMI    => $key__eMI,
      RULE_ID_key__id     => $key__id,
    ];
  }
  //rint_r($fti_seg['rule']);
}

function reg_rules() {
  global $fti_sq, $fti_sqr, $fti_var, $fti_expra, $fti_seg,
    $fti_seg_next,$fti_seg_mask,$fti_row;
  dop("Phase 2a-3 - Register all omonym rules");
  $rule_cnt = db_query("SELECT count(*) from nfc_rule__acSG_term_expr")->fetchColumn();
  dop("  2a-3 - 1 - found omonym rules number: $rule_cnt");
  if ($rule_cnt) {
    load_rules();
    return;
  }
  $exWINE = $fti_var['exWINE'];
  $exTARA = $fti_var['exTARA'][0];
  $exREGI = $fti_var['exREGI'][0];
  $regiTITLE = $fti_var['regiTITLE'][0];
  $syGroupRV = $fti_var['syGroupRV'];
  $sql = "call nfc_rule__arS__asPL_init()";
  $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $sql_i =
    "INSERT INTO nfc_rule__arS
        (arS, rule__eMI, when__eMI, column__eN)
      VALUES
        (" . $fti_var['exREGI_regiTITLE_exTARA'] . ", $syGroupRV, $regiTITLE, " . $fti_var['countries'] . "),
        (" . $fti_var['exREGI_exREGI_exTARA'] . ", $syGroupRV, $exREGI, " . $fti_var['countries'] . ")"
  ;
  $sql_ig = "INSERT INTO nfc_rule__acSG_term_expr (rule__arS, whenTerm__arP, keyExpr__arP) VALUES";
  db_query("SET FOREIGN_KEY_CHECKS=0");
  db_query("TRUNCATE nfc_rule__acSG_term_expr");
  db_query("TRUNCATE nfc_rule__arS");
  $ig = 0;
  $arSA = [];
  //d($fti_seg['term__arP'][2097419],$fti_seg['term__arP'][2097726]);
  foreach ($rows as $row) {
    extract($row);
    $fti_row['id'] = 0;
    reg_query($exWINE, $rule_whenKEY__dsP, 0, 0, FTI_RULE);
    if (1 != 1
        || count($fti_expra['term'] ?? []) < 2
        || !isset($fti_var[$column__dsP])
        || !isset($fti_var[$rule__dsP])
    ) {
      $msg = "reg_rules_e1 - some terms in rule is not found!";
      dop($msg);
      dd($row, $fti_expra['term']);
      throw new Exception ($msg);
    } else {
      $arS = $fti_var[$rule__dsP];
      $terms = array_flip($fti_expra['term']);
      $whenTerm__arP = current($terms);
      $keyExpr__arP = next($terms);
      if (!isset($fti_seg['term__arP'][$keyExpr__arP][$key__eMI])) {
        dd("reg_rules_e2 - bad rule_whenKEY__dsP: ", $row, $keyExpr__arP, $whenTerm__arP);
      }
      if (count($fti_seg['term__arP'][$keyExpr__arP][$key__eMI]) > 1) {
        dd("reg_rules_e3 - bad keyExpr__arP not unique: ", $row, $whenTerm__arP, $keyExpr__arP);
      }
      $keyExpr__arP = (current($fti_seg['term__arP'][$keyExpr__arP][$key__eMI]) & $fti_seg_next);
      if (!isset($arSA[$arS])) {
        $arSA[$arS] = $arS;
        $sql_i .= ",\n($arS, $rule__eMI, $when__eMI, " . $fti_var[$column__dsP] . ")";
      }
      $sql_ig .= ($ig++ ? ',' : '') . "\n($arS, $whenTerm__arP, $keyExpr__arP)";
    }
  }
  //d($sql, $row, $terms, $sql_i, $sql_ig, dechex($fti_seg_next));
  db_query($sql_i);
  db_query($sql_ig);
  dop("  2a-3 - 2 - registerd omonym rules number: " . db_query("SELECT ROW_COUNT()")->fetchColumn());
  db_query("SET FOREIGN_KEY_CHECKS=1");
  load_rules();
}

function load_attributes() {
  global $fti_seg, $fti_var;
  $sql_sd = "call nfc_attr__asPL_term_load()";
  $sql_s = "call nfc_attr__asPL_load()";
  $rows = db_query($sql_sd)->fetchAll(PDO::FETCH_ASSOC);
  $fti_seg['attr__arP'] = $fti_seg['attr__arS'] = $fti_seg['attr_single'] = $fti_seg['attr_multi'] = $fti_seg['attr_term'] = [];
  $fti_seg['attr__acSD'] = $fti_seg['attr__arSD'] = [];
  foreach ($rows as $row) {
    //d($fti_var);
    $fti_seg['attr_term'][$row['a_int']][$row['term__arP']] = $row['a_mask'];
    $fti_seg['attr__arS'][$row['a_int']][$row['a_mask']] = $row['arSD'];
    $fti_seg['attr__arP'][$row['a_int']][$row['a_mask']] = $row['term__arP'];
    $fti_seg['attr__arSD'][$row['arSD']] = [$row['term__arP']];
  }
  $rows = db_query($sql_s)->fetchAll(PDO::FETCH_ASSOC);
  foreach ($rows as $row) {
    $fti_seg['attr__acSD'][$row['attr__acSD']] = $row['arS'];
    $fti_seg['attr__arSD'][$row['arS']] = explode(',', $row['attr__arSD']);
  }

}

function reg_attributes() {
  global $fti_var, $fti_expra, $fti_terme,$fti_row, $fti_seg_start, $fti_words;
  $syn_start = $fti_seg_start << 1;
  dop("Phase 0a - Number terms for excluding found: " . db_query("SELECT ROW_COUNT()")->fetchColumn());
  dop("Phase 0b - Register all synonyms and stop words.");
  nfc_reg_synonyms_word();
  dop("  1a - 1 - All stop word and synonum entries: " . db_query("SELECT count(*) from nfc_word__acSG_group")->fetchColumn());
  dop("Phase 1b - Register all attributes");
  $attr_cnt = db_query("SELECT count(*) from nfc_expr_attr__arS")->fetchColumn();
  //nfcDB__backup();
  dop("  1b - 0 - found attributes number: $attr_cnt");
  if (!$attr_cnt) {
    $rows = db_query("call nfc_attr__asPL_term_init()")->fetchAll(PDO::FETCH_ASSOC);
    $sql_id = "INSERT INTO nfc_expr_attr__arSD VALUES";
    $sql_i_['REGI'] = "INSERT INTO nfc_expr_attr__arS (arS, REGI__arSD) values ";
    $sql_i_['VINE'] = "INSERT INTO nfc_expr_attr__arS (arS, VINE__arSD) values ";
    $sql_i_['WINE'] = "INSERT INTO nfc_expr_attr__arS (arS, WINE__arSD) values ";
    $sql__arP = "INSERT INTO nfc__arP values ";
    $sql__acPU = "INSERT INTO nfc_expr__acPU_term values ";
    db_query("SET FOREIGN_KEY_CHECKS=0");
    db_query("TRUNCATE nfc_expr_attr__arSD");
    db_query("INSERT INTO nfc_expr_attr__arSD (arSD) values(0)");
    foreach ($rows as $row) {
      extract($row);
      $attr__dsPGA = explode(',', $attr__dsPG);
      $attr__dsPA = explode('__', $attr__dsP);
      $val__nuOB = $cnt = 1;
      $exTYPE = $fti_var[$attr__dsPA[0]];
      $exTYPE_0 = $exTYPE[0];
      $exTYPE_0S = $exTYPE_0 & NFC_exprTRIG__eMB;
      //d($exTYPE_0, $fti_var['attr__eS'][$attr__dsP], $attr__dsPA);
      $type__dsP = $fti_var['attr__eS'][$attr__dsP][0];
      foreach ($attr__dsPGA as $vala) {
        $fti_row['id'] = 0;
        if (($isTRIG = $attr__dsP == 'wineTRIG__eMB')) {
          $attrTRIGA = explode(':', $vala);
          //cho "\nattr_cnt=$attr_cnt, $vala";
        } else {
          $attrTRIGA = [$vala];
        }
        foreach ($attrTRIGA as $vali => $val) {
          $attr_cnt++;
          $fti_expra = [];
          expra_word($val);
          foreach ($fti_terme as $term_i => $term) {
            if (($term_cnt = count($term))) {
              if ($term_cnt > 1) {
                $arPA = reg_term(array_reverse($term));
                $key = $arPA[REG_TERM_arP];
                if (!isset($fti_expra['term'][$key])) {
                  $fti_expra['term'][$key] = $arPA[REG_TERM_arPS];
                  $fti_expra['term__cnt'][$key] = intdiv($arPA[REG_TERM_rang], FTI_RANG_SZ);
                  $fti_expra['term__len'][$key] = $arPA[REG_TERM_len];
                }
              } elseif (!$term_i && $fti_words[0] > $syn_start) {
                dd($attr__dsP, $val, "reg_attributes_e1 - not main syn arP for word($val) " . $fti_words[0] . " > $syn_start");
              }
              $arPA = reg_term($term);
              $key = $arPA[REG_TERM_arP];
              if (!isset($fti_expra['term'][$key])) {
                $fti_expra['term'][$key] = $arPA[REG_TERM_arPS];
                $fti_expra['term__cnt'][$key] = intdiv($arPA[REG_TERM_rang], FTI_RANG_SZ);
                $fti_expra['term__len'][$key] = $arPA[REG_TERM_len];
                $fti_expra['term__dsP'][$key] = $arPA[REG_TERM_dsP];              
              }
            }
          }
          $arP = seg_next_arP(NFC_EXPR__arP);
          if ($isTRIG && $vali == 1) {
            $sql_id .= "($attr_cnt, $exTYPE_0S, $val__nuOB, $arP),";
          } else {
            $sql_id .= "($attr_cnt, $exTYPE_0, $val__nuOB, $arP),";
            $val__nuOB <<= 1;
            $cnt++;
          }
          $sql_i_[$type__dsP] .= "\n($attr_cnt, $attr_cnt),";
          $sql__arP .= "($arP),";
          $el__id = 0;
          foreach ($fti_expra['term'] as $term__arP => $v) {
            $sql__acPU .= "($arP, $el__id, $term__arP),";
            $el__id++;
          }
          if ($cnt > FTI_ATTR_64_BITS_CNT) {
            $msg = "reg_attributes_e2 - attrib variant number greater than 64. last term($val)";
            dop($msg);
            dd($sql_id);
          }
        }
      }
    }
    //d($sql_id); //,$sql_i_);
    //echo "\n$sql__arP\n$sql__acPU\n$sql_id\n";
    db_query("start transaction");
    db_query(substr($sql__arP, 0, -1));
    db_query(substr($sql__acPU, 0, -1));
    db_query(substr($sql_id, 0, -1));
    db_query(substr($sql_i_['REGI'], 0, -1));
    db_query(substr($sql_i_['VINE'], 0, -1));
    db_query(substr($sql_i_['WINE'], 0, -1));
    db_query('commit');
    db_query("SET FOREIGN_KEY_CHECKS=1");
    db_query("delete from nfc_term__arPD_exclude_log");
    nfc_term__arPD_exclude_log_restore();
    db_query("UPDATE nfc_term__arPD_exclude_log set term__dsP = TRIM(term__dsP)");
    load_terms();
    load_attributes();
    nfc_term__asPL_create();
    //d("\nstop\n");
  }
  dop("  1b - 1 - all attributes_number: $attr_cnt");
  $attr_syn_cnt = db_query(
    "SELECT count(*)
      from nfc_expr_attr__arSD as t1
        left join nfc_expr__acPU_term as t2 on t2.expr__arP = t1.expr__arP
      where t2.el__id > 0
  ")->fetchColumn();;
  dop("  1b - 2 - all attributes synonyms: $attr_syn_cnt");
}

function reg_country() {
  global $fti_sq, $fti_sqr, $fti_expra, $fti_var, $fti_row;
  $syGroupRT = $fti_var['syGroupRT'];
  try {
    $fti_expra = [];
    $exTYPE = $fti_var['exTARA'];
    parse_name($exTYPE, preg_replace('/[,()].*/u', '', $fti_row['name']), $syGroupRT);
    $fti_row['expr__eMI'] = $fti_var['link_lvl_tara__eB'] | $fti_var['link_sts_parent__eB'];
    $arP = prep_query($exTYPE, 0, (count($fti_expra['term'] ?? []) ? key($fti_expra['term']) : 0), FTI_TARA);
    reg_expr();
  } catch (Exception $e) {
    $errs = $e->getMessage();
    $msg = "ErrFTI(reg_country__P_1)arP=" . ($arP ?? 'NULL') . ",country__tid=(" . ($row->id ?? 'NULL') . ") $errs";
    dog($msg);
    throw new Exception($msg . (strpos($errs, 'ErrFTI(') === false ? $e->getTraceAsString() : ''));
  }
  return $arP;
}

function reg_word($form, $word__eMT) {
  global $fti_var, $fti_seg, $fti_seg_start;
  try {
    db_query("start transaction");
    $arP = (($word__eMT & $fti_var['word_form__eB']) ? $fti_seg_start : 0) + db_query(
      "SELECT seg_next FROM nfc_type_segments__arPD where segment__arP = " . $fti_var['word__arP'] . " FOR UPDATE"
    )->fetchColumn();
    db_query("UPDATE nfc_type_segments__arPD set seg_next = seg_next + 1 where segment__arP = " . $fti_var['word__arP']);
    $form_len = mb_strlen($form);
    $fti_seg['word']['dsP'][$form] = $arP;
    $fti_seg['word']['arP'][$arP]['dsP'] = $form;
    $fti_seg['word']['arP'][$arP]['len'] = $form_len;
    db_query("INSERT INTO nfc__arP values($arP)");
    db_query("INSERT INTO nfc_word__arP(arP, word__eMT, dsP, len) values ($arP, $word__eMT, '$form', $form_len)");
    db_query("commit");
    return $arP;
  } catch (Exception $e) {
    $errs = $e->getMessage();
    db_query("rollback");
    $msg = "\nErrFTI(reg_word__P_1)form__dsP($form),arP(" . ($arP ?? 'NULL') . "\n$errs";
    dol($msg);
    throw new Exception($msg . $e->getTraceAsString());
  }
}

function count_expr_synonyms($expr_typ) {
  return db_query(
    "SELECT count(*)
      from nfc_expr__arP as t1
        left join nfc_expr__acPU_term as t2 on t2.expr__arP = t1.arP
      where 1=1
        and t1.expr__eS = $expr_typ
        and t2.el__id > 0
  ")->fetchColumn();
}

function reg_countries() {
  global $fti_seg, $fti_row, $fti_var, $fti_expra, $fti_terme, $fti_sqr, $fti_gustos_region_db, $fti_seg_next;
  $exTARA = $fti_var['exTARA'][0];
  $syGroupRT = $fti_var['syGroupRT'];
  $fti_seg_fspFormStopWord__arP = $fti_seg['fspFormStopWord__arP'];
  $fti_seg['fspFormStopWord__arP'] = $fti_seg['fspBaseStopWord__arP'];
  dop("Phase 2a-1 - Register all country name entries and synonyms and initial tags.");
  $max_tid = db_query("SELECT max(id) as id from nfc_expr__arP where expr__eS = $exTARA")->fetchColumn() ?? 0; //  and tid = 1163
  $rows = db_query("SELECT id, `name` from $fti_gustos_region_db.region where `type` = 'COUNTRY' and id > $max_tid order by id")->fetchAll(PDO::FETCH_ASSOC);
  $fti_entry_cnt = 0;
  $exTYPE = $fti_var['exTARA'];
  $term__arPA = $term__arPA_dups = [];
  db_query("SET @FTI_TRIGGERS_STOP = 1");
  foreach ($rows as $fti_row) {
    $fti_expra = [];
    $ret_name = parse_name($exTYPE, preg_replace('/[,()].*/u', '', $fti_row['name']), $syGroupRT);
    $msg = "\r Country entries=" . ++$fti_entry_cnt . ", SID=" . $fti_row['id'] . ", row_name(" . $fti_row['name'] . "), ret_name($ret_name)";
    echo str_pad($msg, 140);
    $fti_row['expr__eMI'] = $fti_var['link_lvl_tara__eB'] | $fti_var['link_sts_parent__eB'];
    $arP = prep_query($exTYPE, 0, (count($fti_expra['term'] ?? []) ? key($fti_expra['term']) : 0), FTI_TARA);
    $key = key($fti_expra['term']);
    if (isset($term__arPA[$key])) {
      $term__arPA_dups[$arP] = $fti_row['id'];
      $term__arPA_dups[$term__arPA[$key][0]] = $term__arPA[$key][1];
    } else {
      reg_expr();
      $term__arPA[$key] = [$arP, $fti_row['id']];
      db_query("UPDATE $fti_gustos_region_db.region set `path` = _term__asFL_dsP($key) where id = " . $fti_row['id']);
    }
  }
  db_query("SET @FTI_TRIGGERS_STOP = 0");
  if (($fti_dups_cnt = count($term__arPA_dups))) {
    db_query("DELETE from nfc__arP where arP in (" . implode(',', array_keys($term__arPA_dups)) . ")");
    $rows = db_query(
      "SELECT t1.id, regexp_replace(t1.name, '[(),]', ' ') as `name`
        from $fti_gustos_region_db.region as t1
        where t1.id in (" . implode(',', $term__arPA_dups) . ")
    ")->fetchAll(PDO::FETCH_ASSOC);
    db_query("SET @FTI_TRIGGERS_STOP = 1");
    foreach ($rows as $fti_row) {
      reg_country();
      db_query("UPDATE $fti_gustos_region_db.region set `path` = _term__asFL_dsP(" . key($fti_expra['term']) . ") where id = " . $fti_row['id']);
    }
    db_query("SET @FTI_TRIGGERS_STOP = 0");
  }
  dop("  2a-1 - 1 - Number of country 1-st term entry duplicates updated: $fti_dups_cnt");
  dop("  2a-1 - 2 - All country entries: " . db_query("SELECT count(*) from nfc_expr__arP where expr__eS = $exTARA")->fetchColumn());
  $syn_cnt = db_query(
    "SELECT count(*) from nfc_expr__arP as t1
        left join nfc_expr__acPU_term as t2 on t2.expr__arP = t1.arP
      where 1=1
        and t1.expr__eS = $exTARA
        and t2.el__id > 0
  ")->fetchColumn();
  if ($fti_entry_cnt) {
    $syn_cnt = 0;
    $rows = nfc_country_synonyms_create();
    load_regions();
    foreach ($rows as $fti_row) {
      $fti_expra = [];
      parse_name($fti_var['exTARA'], $fti_row['name'], $syGroupRT);
      if (($cnt = count($fti_expra['term'] ?? [])) && isset($fti_seg['regi__arP'][key($fti_expra['term'])])) {
        $syn_cnt += $cnt - 1;
        $arP = current($fti_seg['regi__arP'][key($fti_expra['term'])])['expr__arP'];
        $fti_sqr['r0'] = "DELETE FROM nfc_expr__acPU_term where expr__arP = $arP";
      } else {
        dd("reg_countries_e1 - base country expr__arP not found for nfc_country_synonyms_create.dsP=" . $fti_row['name'], $fti_expra, $fti_terme);
      }
      $fti_row['expr__eMI'] = $fti_var['link_lvl_tara__eB'];
      $fti_row['id'] = current($fti_seg['regi__arP'][key($fti_expra['term'])])['id'];
      prep_query($fti_var['exTARA'], $arP, key($fti_expra['term']), key($fti_seg['regi__arP'][key($fti_expra['term'])]));
      reg_expr();
    }
    $syn_cnt = count_expr_synonyms($fti_var['exTARA'][0]);
  }
  dop("  2a-1 - 3 - Number of synonyms in countries: $syn_cnt");
  $exATAG = $fti_var['exATAG'][0];
  $exHTAG = $fti_var['exHTAG'][0];
  if (!($tags_cnt = db_query("SELECT count(*) from nfc_tag__arS")->fetchColumn())) {
    nfc_tag_create();
    $rows = db_query("SELECT arS, tag__dsP from nfc_tag__arS")->fetchAll(PDO::FETCH_ASSOC);
    $fti_row['id'] = 0;
    foreach ($rows as $key => $row) {
      $tags_cnt++;
      reg_query($fti_var['exHTAG'], $row['tag__dsP']);
      reg_expr();
      db_query("UPDATE nfc_tag__arS set term__arP = " . key($fti_expra['term']) . " where arS = " . $row['arS']);
    }
    //db_query("call nfc_term__asPL_create_synonyms($exHTAG)");
    $tag_syn_cnt = count_expr_synonyms($exHTAG);
  } else {
    $tag_syn_cnt = db_query("SELECT sum(syn__cnt) from nfc_expr__arP where expr__eS = $exHTAG group by expr__eS")->fetchColumn();
  }
  dop("Phase 2a-2 - Number of initial tags: $tags_cnt and synonyms: $tag_syn_cnt");
  $fti_seg['fspFormStopWord__arP'] = $fti_seg_fspFormStopWord__arP;
  load_terms();

}

function reg_grape($arP = 0) {
  global $fti_row, $fti_seg, $fti_sq, $fti_sqr, $fti_expra,
        $word_1s, $fti_var, $fti_exGRAP, $fti_seg_next;
  try {
    extract($fti_row);
    $fti_expra = [];
    parse_name($fti_exGRAP, $name);
    if (!$arP) {
      $arP = seg_next_arP(NFC_EXPR__arP);
      $fti_sqr['r1'] = $fti_sq['a1'] . "($arP)";
    }
    if ((count($fti_expra['term'] ?? []))) {
      $key_term__arP = 0;
      foreach ($fti_expra['term'] as $term__arP => $v) {
        if ($term__arP) {
          $a_V = explode(',', $v);
          $a_K = array_map(function($v_arP) use($fti_seg_next) {return ($v_arP & $fti_seg_next); }, $a_V);
          if (count($a_V) > 1) {
            $arPA = reg_term(array_reverse(array_combine($a_K, $a_V), true));
            $fti_expra['term'][$arPA[REG_TERM_arP]] = 0;
          }
          if (!$key_term__arP) {
            $key_term__arP = $term__arP;
          }
        }
      }
      if ($key_term__arP && isset($fti_seg['grap__arP'][$key_term__arP])) {
        $parExpr__arP = $arP;
      } else {
        $parExpr__arP = FTI_GRAP;
        $fti_seg['grap__arP'][$key_term__arP] = $key_term__arP;
      }      
      prep_query($fti_exGRAP, $arP, $key_term__arP, $parExpr__arP);
      //if ($fti_row['id'] == 6873) dd($fti_sqr); // 6873 6765
      reg_expr();
    } else {
      dop("reg_grape_e1 - Grape name($name) for id($id) can't be empty!");
    }
  } catch (Exception $e) {
    $errs = $e->getMessage();
    $msg = "ErrFTI(reg_grape_P2)arP=" . ($arP ?? 'NULL') . ",grap__id=(" . ($id ?? 'NULL') . ") $errs";
    dog($msg);
    throw new Exception($msg . (strpos($errs, 'ErrFTI(') === false ? $e->getTraceAsString() : ''));
  }

}

function link_regi_hierarchy_flat() {
  $sql_s =
"SELECT distinct a1.link__id, a1.regi__id as to_regi__id, a2.regi__id as from_regi__id
from (
  select
    t1.link__id, ifnull(t6.regi__id, ifnull(t5.regi__id, ifnull(t4.regi__id, ifnull(t3.regi__id, ifnull(t2.regi__id, t1.regi__id))))) regi__id
  from nfc_expr_regi__arPD_link as t1
    left join nfc_expr_regi__arPD_link as t2 on t2.link__id = t1.regi__id and t1.link__id <> t1.regi__id
    left join nfc_expr_regi__arPD_link as t3 on t3.link__id = t2.regi__id and t2.link__id <> t2.regi__id
    left join nfc_expr_regi__arPD_link as t4 on t4.link__id = t3.regi__id and t3.link__id <> t3.regi__id
    left join nfc_expr_regi__arPD_link as t5 on t5.link__id = t4.regi__id and t4.link__id <> t4.regi__id
    left join nfc_expr_regi__arPD_link as t6 on t6.link__id = t5.regi__id and t5.link__id <> t5.regi__id
) as a1
  left join nfc_expr_regi__arPD_link as a2 on a2.link__id = a1.link__id
where a1.regi__id <> a2.regi__id
  ";
  db_query(
    "UPDATE nfc_expr_regi__arPD_link as u1
      inner join ($sql_s) as u2 on u2.link__id = u1.link__id
      set u1.regi__id = u2.to_regi__id
  ");
  db_query(
    "REPLACE nfc_expr_regi__arPD_link
        (link__id, regi__id)
      select distinct regi__id as link__id, regi__id
      from nfc_expr_regi__arPD_link
  ");
  dog("REGI - number links hierarchy changed to flat: " . db_query("SELECT ROW_COUNT()")->fetchColumn());
}

function link_vine_hierarchy_flat() {
  global $fti_gustos_db, $fti_seg;
  $link_s =
"SELECT distinct a1.link__id, a1.vine__id as to_vine__id, a2.vine__id as from_vine__id
from (
  select
  	t1.link__id,
    ifnull(t6.vine__id, ifnull(t5.vine__id, ifnull(t4.vine__id, ifnull(t3.vine__id, ifnull(t2.vine__id, t1.vine__id))))) vine__id
  from nfc_expr_vine__arPD_link as t1
    left join nfc_expr_vine__arPD_link as t2 on t2.link__id = t1.vine__id and t1.link__id <> t1.vine__id
    left join nfc_expr_vine__arPD_link as t3 on t3.link__id = t2.vine__id and t2.link__id <> t2.vine__id
    left join nfc_expr_vine__arPD_link as t4 on t4.link__id = t3.vine__id and t3.link__id <> t3.vine__id
    left join nfc_expr_vine__arPD_link as t5 on t5.link__id = t4.vine__id and t4.link__id <> t4.vine__id
    left join nfc_expr_vine__arPD_link as t6 on t6.link__id = t5.vine__id and t5.link__id <> t5.vine__id
) as a1
  left join nfc_expr_vine__arPD_link as a2 on a2.link__id = a1.link__id
where a1.vine__id <> a2.vine__id
  ";
  db_query(
    "UPDATE nfc_expr_vine__arPD_link as u1
      inner join ($link_s) as u2 on u2.link__id = u1.link__id
      set u1.vine__id = u2.to_vine__id
  ");
  dog("VINE/link - number hierarchy changed to flat: " . db_query("SELECT ROW_COUNT()")->fetchColumn());
  $dups_s =
"SELECT distinct a1.dups__id, a1.vine__id as to_vine__id, a2.vine__id as from_vine__id
from (
  select
  	t1.dups__id,
    ifnull(t6.vine__id, ifnull(t5.vine__id, ifnull(t4.vine__id, ifnull(t3.vine__id, ifnull(t2.vine__id, t1.vine__id))))) vine__id
  from nfc_expr_vine__arPD_dups as t1
    left join nfc_expr_vine__arPD_dups as t2 on t2.dups__id = t1.vine__id and t1.dups__id <> t1.vine__id
    left join nfc_expr_vine__arPD_dups as t3 on t3.dups__id = t2.vine__id and t2.dups__id <> t2.vine__id
    left join nfc_expr_vine__arPD_dups as t4 on t4.dups__id = t3.vine__id and t3.dups__id <> t3.vine__id
    left join nfc_expr_vine__arPD_dups as t5 on t5.dups__id = t4.vine__id and t4.dups__id <> t4.vine__id
    left join nfc_expr_vine__arPD_dups as t6 on t6.dups__id = t5.vine__id and t5.dups__id <> t5.vine__id
) as a1
  left join nfc_expr_vine__arPD_dups as a2 on a2.dups__id = a1.dups__id
where a1.vine__id <> a2.vine__id
  ";
  db_query(
    "UPDATE nfc_expr_vine__arPD_dups as u1
      inner join ($dups_s) as u2 on u2.dups__id = u1.dups__id
      set u1.vine__id = u2.to_vine__id
  ");
  dog("VINE/dups - number hierarchy changed to flat: " . db_query("SELECT ROW_COUNT()")->fetchColumn());
  $sql =
    "UPDATE nfc_expr_vine__arPD_link as u1
      left join (
        select ifnull(group_concat(distinct a2.country), '') as cas, a1.vine__id
        from nfc_expr_vine__arPD_link as a1
          left join $fti_gustos_db.vineyard as a2 on a2.id = a1.link__id
        group by a1.vine__id
      ) as u2 on u2.vine__id = u1.vine__id
      set u1.countries = u2.cas
  ";
  db_query($sql);
  load_vineyards();
  $sql_i = $sql_p = 1000;
  $sql_u = "UPDATE nfc_expr__arP u1 inner join (select 0 arP, '' ca union all values ";
  $sql = '';
  foreach ($fti_seg['vine__id'] as $vine__id => $arr) {
    if ($sql_i++ == $sql_p) {
      $sql_i = 0;
      if ($sql != '') {
        db_query("$sql) u2 on u2.arP = u1.arP set u1.countries = u2.ca");
      }
      $sql = $sql_u . "(" . $arr[VINE_ID_expr__arP] . ",'" . implode(',', array_keys($arr[VINE_ID_tara])) . "')";
    } else {
      $sql .= ",(" . $arr[VINE_ID_expr__arP] . ",'" . implode(',', array_keys($arr[VINE_ID_tara])) . "')";
    }
  }
  if ($sql != '') {
    db_query("$sql) u2 on u2.arP = u1.arP set u1.countries = u2.ca");
  }
  load_terms();
}

function link_expr($TYPE) { // link grap/vine objects (not for regi objects)
  global $fti_row, $fti_var, $fti_seg;
  $expr__linkc = $expr__dupc = $ids = $expr__dups = $expr__oms = $expr__link = $link__it = $term_new__arPA = $term_1numberst__arPA = $term_om__arPA = [];
  $exEXPR = $fti_var[$TYPE][0];
  $exTARA = $fti_var['exTARA'][0];
  $sufix = $fti_var[$TYPE][1][0];
  $field__id = "{$sufix}__id";
  $table_link = "nfc_expr_{$sufix}__arPD_link";
  $table_dups = "nfc_expr_{$sufix}__arPD_dups";
  $table_om = "nfc_expr_{$sufix}__arPD_om";
  if ($sufix == 'vine') {
    db_query("TRUNCATE $table_link");  
    db_query("TRUNCATE $table_dups");  
    db_query("TRUNCATE $table_om");  
  }
  // search dups
  //$file = storage_path('app/custom_debug.log'); file_put_contents($file, "\nStart\n");
  foreach ($fti_seg['expr__arP'] as $expr__arP => $term_old__arPA) {
    if (current($term_old__arPA)[EXPR__arP_term__typ] == $exEXPR) {
      foreach ($term_old__arPA as $term__arP => $arr) {
        $expr__id = $arr[EXPR__arP_term__id];
        $ids[$expr__id][$term__arP] = 0;
        $vine__arP = $fti_seg['term__id'][$exEXPR][$expr__id][TERM_ID_id__arP];
        $tara__id = ($sufix != 'vine' ? 0 : key($fti_seg[$field__id][$expr__id][EXPR_ID_tara]));
        if (isset($term_new__arPA[$term__arP])) {
          $term_new__id = $term_new__arPA[$term__arP][0];
          $term_new__arPA[$term__arP][] = $expr__id;
          if (($is_expr__id = isset($expr__link[$expr__id])) || isset($expr__link[$term_new__id])) {
            if ($sufix == 'vine' && ($term_new__arP = $link__it[$expr__link[($is_expr__id ? $expr__id : $term_new__id)]]) != $term__arP) {
              $term_new__id = $term_new__arPA[$term_new__arP][0];
              $temp__arPA = $term_new__arPA[$term_new__arP];
              //if ($file) file_put_contents($file, "p1, term__arP=$term__arP,\n" . print_r($term_new__arPA[$term__arP], true), FILE_APPEND);
              foreach ($term_new__arPA[$term__arP] as $expr__old) {
                if (isset($link__it[$expr__old])) {
                  $term_link__arP = $link__it[$expr__link[$expr__old]];
                  foreach ($term_new__arPA[$term_link__arP] as $link__old) {
                    $expr__link[$link__old] = $term_new__id;
                    $link__it[$link__old] = $term_new__arP;
                  }
                } else {
                  $term_link__arP = $term__arP;
                  $expr__link[$expr__old] = $term_new__id;
                  $link__it[$expr__old] = $term_new__arP;
                }
                $temp__arPA = array_keys(array_flip(array_merge($temp__arPA, $term_new__arPA[$term_link__arP])));
              }
              $temp__arPA = array_keys(array_flip(array_merge($temp__arPA, $term_new__arPA[$term__arP])));
              unset($term_new__arPA[$term__arP]);
              $term_new__arPA[$term_new__arP] = $temp__arPA;
              //if ($file) file_put_contents($file, "p2, term_new__arP=$term_new__arP\n" . print_r($term_new__arPA[$term_new__arP], true), FILE_APPEND);
            }
          } else {
            if ($sufix == 'vine' && !isset($expr__link[$term_new__id])) {
              $link__it[$term_new__id] = $term__arP;
              $expr__link[$term_new__id] = $term_new__id;
            }
            $link__it[$expr__id] = $term__arP;
            $expr__link[$expr__id] = $term_new__id;
            $expr__dupc[$expr__id] = 0;
            $expr__dupc[$term_new__id] = 0;
          }
        } else {
          $term_new__arPA[$term__arP] = [$expr__id];
        }
        if (1 == 1
            && $sufix == 'vine'
            && $arr[EXPR__arP_el__id] <= $arr[EXPR__arP_new__id]
        ) {
          if (isset($term_1st__arPA[$term__arP][$tara__id])) {
            $vine__arP = $fti_seg['term__id'][$exEXPR][$term_1st__arPA[$term__arP][$tara__id]][TERM_ID_id__arP];
            if ($fti_seg['expr__arP'][$vine__arP][$term__arP][EXPR__arP_el__id] <= $fti_seg['expr__arP'][$vine__arP][$term__arP][EXPR__arP_new__id]) {
              if (!isset($expr__dups[$expr__id])) {
                if (!isset($expr__dups[$term_1st__arPA[$term__arP][$tara__id]])) {
                  $expr__dups[$term_1st__arPA[$term__arP][$tara__id]] = $term_1st__arPA[$term__arP][$tara__id];
                }
                $expr__dups[$expr__id] = $term_1st__arPA[$term__arP][$tara__id];
              }
            }
          } else {
            $term_1st__arPA[$term__arP][$tara__id] = $expr__id;
          }
          if (isset($term_om__arPA[$term__arP])) {
            $term_om__id = $term_om__arPA[$term__arP];
            $vine__arP = $fti_seg['term__id'][$exEXPR][$term_om__id][TERM_ID_id__arP];
            if ($fti_seg['expr__arP'][$vine__arP][$term__arP][EXPR__arP_el__id] <= $fti_seg['expr__arP'][$vine__arP][$term__arP][EXPR__arP_new__id]) {
              if (!isset($expr__oms[$term_om__id])) {
                $expr__oms[$term_om__id] = $term_om__id;
                $expr__linkc[$term_om__id]++;
              }
              $expr__oms[$expr__id] = $term_om__id;
              $expr__linkc[$term_om__id]++;
            }
          } else {
            $term_om__arPA[$term__arP] = $expr__id;
            if (!isset($expr__linkc[$expr__id])) {
              $expr__linkc[$expr__id] = 0;
            }
          }
        }
      }
    }
  }
  // prepare sqls for changed exprs
  //d($expr__link, $expr__dupc, $link__it);
  $dups_sql = $link_sql = $terms_sql = $expr_sql = $dels_sql = $om_sql = '';
  $dels_cnt = $dups_cnt = $link_cnt = $expr_cnt = $all_cnt = $oms_cnt = 0;
  $term_om__arPA = [];
  foreach ($expr__oms as $om__id => $vine__id) {
    if (1 == 1
          && !isset($expr__dups[$om__id])
          && isset($expr__linkc[$om__id])
          && isset($expr__link[$om__id])
          && isset($link__it[$expr__link[$om__id]])
          && $expr__linkc[$om__id] == count(array_flip($term_new__arPA[$link__it[$expr__link[$om__id]]]))
    ) {
      $term_om__arPA[$om__id] = 0;
      $om_sql .= ($oms_cnt++ ? ',' : '') . "($om__id, $vine__id)";
    }
  }
  $expr__linkc = $expr__linkcg = [];
  foreach ($expr__link as $link__id => $expr__id) {
    if (!isset($term_om__arPA[$link__id])) {
      if (isset($expr__linkc[$expr__id])) {
        if (!isset($expr__linkcg[$expr__linkc[$expr__id]])) {
          $expr__linkcg[$expr__linkc[$expr__id]] = $expr__linkc[$expr__id];
        }
        $expr__linkcg[$link__id] = $expr__linkc[$expr__id];
      } else {
        $expr__linkc[$expr__id] = $link__id;
      }
    }
    if ($sufix != 'vine') {
      if (isset($ids[$link__id])) {
        $ids[$expr__id] += $ids[$link__id];
      }
      $link_sql .= ($link_cnt++ ? ',' : '') . "($link__id, $expr__id)";
    }
  }
  if ($sufix == 'vine') {
    foreach ($expr__linkcg as $link__id => $expr__id) {
      if (isset($ids[$link__id])) {
        $ids[$expr__id] += $ids[$link__id];
      }
      $link_sql .= ($link_cnt++ ? ',' : '') . "($link__id, $expr__id)";
    }
    if ($link_cnt) {
      db_query("REPLACE INTO $table_link (link__id, $field__id) values $link_sql");
    }
    dog("$sufix/link - total number: $link_cnt");
    foreach ($expr__dups as $dups__id => $expr__id) {
      $dups_sql .= ($dups_cnt++ ? ',' : '') . "($dups__id, 1, $expr__id)";
    }
    if ($dups_cnt) {
      db_query("REPLACE INTO $table_dups values $dups_sql");
    }
    if ($oms_cnt) {
      db_query("REPLACE INTO $table_om values $om_sql");
    }
    dog("VINE/dups - total number: $dups_cnt");
    dog("VINE/link unclear - total number: " . count($expr__link));
    dog("VINE/omonyms - total number: $oms_cnt");
    $func = "link_{$sufix}_hierarchy_flat";
    $func();
    return;
  }
  if ($link_cnt) {
    db_query("REPLACE INTO $table_link (link__id, $field__id) values $link_sql");
  }
  dog("$sufix/link - total number: $link_cnt");
  $parExpr__arP = FTI_GRAP;
  foreach ($expr__dupc as $expr__id => $val) {
    $expr__arP = $fti_seg['term__id'][$exEXPR][$expr__id][TERM_ID_id__arP];
    $terms_cnt = 0;
    $chiTerm__arP = key($ids[$expr__id]);
    if (isset($expr__link[$expr__id])) {
      $expr_sql .= ($expr_cnt++ ? ",\n" : "\n") . " ($expr__arP, $exEXPR, $chiTerm__arP, $chiTerm__arP, $expr__id, $terms_cnt)";
    } else {
      foreach ($ids[$expr__id] as $term__arP => $val) {
        $terms_sql .= ($terms_cnt || $all_cnt ? ',' : '') . "($expr__arP," . $terms_cnt++ . ",$term__arP)";
      }
      $expr_sql .= ($expr_cnt++ ? ",\n" : "\n") . " ($expr__arP, $exEXPR, $parExpr__arP, $chiTerm__arP, $expr__id, $terms_cnt)";
    }
    $all_cnt += $terms_cnt;
    $dels_sql .= ($dels_cnt++ ? ',' : '') . "$expr__arP";
  }
  //cho "\n\nids_cnt=" . count($ids) . ", dups_sql\n$dups_sql\n dels_sql\n$dels_sql\n expr_sql\n$expr_sql\n terms_sql\n$terms_sql\n";
  if ($expr_cnt) {
    db_query("START TRANSACTION");
    try {
      db_query("DELETE FROM nfc_expr__acPU_term where expr__arP in ($dels_sql)");
      db_query("DELETE FROM nfc_expr__arP where arP in ($dels_sql)");
      db_query("INSERT INTO nfc_expr__arP (arP, expr__eS, parExpr__arP, chiTerm__arP, id, next__id) values $expr_sql");
      db_query("INSERT INTO nfc_expr__acPU_term (expr__arP,el__id,term__arP) values $terms_sql");
      db_query("commit");
    } catch (Exception $e) {
      db_query("rollback");
      $errs = $e->getMessage();
      $msg = "ErrFTI(dups_exprs_e4) - dels_sql($dels_sql), expr_sql($expr_sql), terms_sql($terms_sql). $errs";
      dog($msg);
      throw new Exception($msg . (strpos($errs, 'ErrFTI(') === false ? $e->getTraceAsString() : ''));
    }
  }

}

function reg_grapes() {
  global $fti_row, $fti_var, $fti_seg;
  $exGRAP = $fti_var['exGRAP'][0];
  dop("Phase 2b - Register all grape name entries.");
  $max_id = db_query("SELECT max(id) as id from nfc_expr__arP where expr__eS = $exGRAP")->fetchColumn() ?? 0;
  $rows = db_query("CALL nfc_expr__asPL_grap_gustosapp($max_id, 0)")->fetchAll(PDO::FETCH_ASSOC);
  $fti_entry_cnt = 0;
  $fti_seg['grap__arP'] = [];
  if (count($rows)) {
    foreach ($rows as $fti_row) {
      $fti_row['expr__eMI'] = 0;
      echo "\r Grape entries=" . ++$fti_entry_cnt . ", ID=" . $fti_row['id'];
      reg_grape();
    }
    load_terms();
    link_expr('exGRAP');
    reg_blends();
  }
  dop("  2b - 1 - Grape entries: " . db_query("SELECT count(*) from nfc_expr__arP where expr__eS = $exGRAP")->fetchColumn());
  dop("  2b - 2 -  -- // -- dups: " . db_query("SELECT count(*) from nfc_expr_grap__arPD_link")->fetchColumn());
  dop("  2b - 3 - Blend entries: " . db_query("SELECT count(*) from nfc_expr_grap__arS_blend")->fetchColumn());
}

const REGI_ID_tara = 0;
const REGI_ID_arP = 1;
const REGI_ID_path = 2;
const REGI_ID_new__id = 3;
const REGI_ID_lvl = 4;

function load_regions($sufix = '') {
  global $fti_seg;
  $fti_seg['regi_om'] = $fti_seg['regi__id'] = $fti_seg['regi_dups'] = $fti_seg['regi_dupg'] = $fti_seg['regi_path'] = $fti_seg['regi__arP'] = [];
  $rows = db_query(
    "SELECT expr__arP, id, expr__eMI, chiTerm__arP, parExpr__arP, `path`, attrTYPE__arS, attrTITLE__arS, country, to_link__id, new__id, lvl
      FROM nfc_expr__asVS_regi_load$sufix
  ")->fetchAll(PDO::FETCH_ASSOC);
  $fti_seg['regi__id'][''] = [0, '', 0];
  foreach ($rows as $row) {
    $fti_seg['regi__arP'][$row['chiTerm__arP']][$row['parExpr__arP']] = $row;
    if (!isset($fti_seg['regi__id'][$row['id']])) {
      $fti_seg['regi__id'][$row['id']] = [
        REGI_ID_tara        => $row['country'],
        REGI_ID_arP         => $row['expr__arP'],
        REGI_ID_path        => $row['path'],
        REGI_ID_new__id        => $row['new__id'],
        REGI_ID_lvl        => $row['lvl']
      ];
    }
    if ($row['to_link__id']) {
      $fti_seg['regi_dups'][$row['id']] = $row['to_link__id'];
      if (!isset($fti_seg['regi_dupg'][$row['to_link__id']])) {
        $fti_seg['regi_dupg'][$row['to_link__id']] = [];
      }
      $fti_seg['regi_dupg'][$row['to_link__id']][$row['id']] = 0;
    }
    if ($row['path'] != '') {
      if (isset($fti_seg['regi_path'][$row['path']])) {
        $msg = "ErrFTI(load_regions_p1) regi__id(" . $row['id'] . ") - duplicate id/path(" . $fti_seg['regi_path'][$row['path']] . "/" . $row['path'] . ")";
        dog($msg);
        throw new Exception($msg);
      } else {
        $fti_seg['regi_path'][$row['path']] = $row['id'];
      }
    }
  }
}

function reg_region($arP = 0) {
  global $fti_seg, $fti_sq, $fti_sqr, $fti_expra,$mix__arr,$fti_terme, $fti_terms, $fti_row,
        $fti_exREGI, $fti_var, $fti_gustos_region_db, $fti_gustos_db;
  $v_FTI_SEP_PATH_CHILD = FTI_SEP_PATH_CHILD;
  try {
    $fti_sq_rA =
      "INSERT INTO nfc_rule__acSG_term_expr
          (rule__arS, whenTerm__arP, keyExpr__arP)
        VALUES"
    ;
    //$level = 1;
    extract($fti_row);
    $fti_expra = [];
    $name = strtr(preg_replace('/\s*[&+_]\s*/u', ' ', $name), ["'" => "''"]);
    if ($parent_id) {
      $to_path = $fti_seg['regi__id'][$parent_id][REGI_ID_path];
    } elseif (isset($to_path) && isset($fti_seg['regi_path'][$to_path])) {
      $parent_id = $fti_seg['regi_path'][$to_path];
    } else {
      $msg = "reg_region_e1 - region__id=($id) parrent for regi($name) not found!";
      dog($msg);
      throw new Exception($msg);
    }
    if ($fti_seg['regi__id'][$parent_id][REGI_ID_tara]) {
      //$level++;      
      if (!is_array($fti_sqr['r0'])) {
        $fti_sqr['r0'] = [];
      }
      $fti_sqr['r0'][] = "REPLACE INTO nfc_expr_regi__arPD_link (link__id, regi__id) VALUES($id, $parent_id)";
    }
    $level = $fti_seg['regi__id'][$parent_id][REGI_ID_lvl] + 1;
    $to_name = parse_name($fti_exREGI, $name, $fti_var['syGroupRT'], FTI_PARSE_NAME__NORM_IT_elim_single_alpha);
    $regi_parExpr__arP = $fti_seg['regi__id'][$parent_id][REGI_ID_arP];
    $regi_term__arP = (($fti_expra['term'] ?? 0) ? key($fti_expra['term']) : 0);
    $path = "$to_path $v_FTI_SEP_PATH_CHILD $to_name";
    if (isset($fti_seg['regi__arP'][$regi_term__arP])) {
      if ($arP) {
        $key = key($fti_seg['regi__arP'][$regi_term__arP]);
        if (isset($fti_seg['regi__arP'][$regi_term__arP][$key])) {
          unset($fti_seg['regi__arP'][$regi_term__arP][$key]);
        }
      }
      if ($regi_term__arP && isset($fti_seg['regi__arP'][$regi_term__arP][$regi_parExpr__arP])) {
        $for_regi_id = $fti_seg['regi__arP'][$regi_term__arP][$regi_parExpr__arP]['id'];
        $for_regi_path = $fti_seg['regi__arP'][$regi_term__arP][$regi_parExpr__arP]['path'];
        $msg = "reg_region_e3 - region country($countries) and regi__id($id) - alrady registered -- for region($to_path)";
        $msg .= "\n             -- // -- country($countries) and regi__id($for_regi_id) - alrady registered -- for region($for_regi_path)";
        dop($msg);
        throw new Exception($msg);
      }
    }
    $arP = prep_query($fti_exREGI, $arP, $regi_term__arP, $regi_parExpr__arP);
    $fti_seg['regi__arP'][$regi_term__arP][$regi_parExpr__arP] = [
      'expr__arP' => $arP,
      'id' => $id,
      'chiTerm__arP' => $regi_term__arP,
      'parExpr__arP' => $regi_parExpr__arP,
      'path' => $path,
      'rule__arS' => 0,
      'expr__eMI' => $expr__eMI,
      'attrTYPE__arS' => $attrTYPE__arS ?? 0,
      'attrTITLE__arS' => $attrTITLE__arS ?? 0
    ];
    $fti_seg['regi__id'][$id] = [
      REGI_ID_tara        => $countries,
      REGI_ID_arP         => $arP,
      REGI_ID_path        => $path,
      REGI_ID_lvl         => $level
    ];
    // foreach ($fti_expra['term'] as $term__arP => $val) {  $fti_seg['term'][$fti_expra['term__cnt'][$term__arP] * FTI_RANG_SZ][$fti_expra['term__dsP'][$term__arP]][$fti_exREGI[0]][$id] = []; }
    $t = time();
    $fti_sqr['r7'] =
      "UPDATE $fti_gustos_region_db.region
        set
          updated = $t, `name` = '$name', `path` = '$path', `level` = $level
        where id = $id"
    ;
    $fti_sqr['r3'] = "UPDATE $fti_gustos_db.taxonomy_term_data set `name` = '$name' where tid = $id";
    if ($regi_parExpr__arP) {
      $fti_sqr['r9'] =
        "REPLACE INTO $fti_gustos_region_db.region_hierarchy
            (parent_id, child_id, `type`)
          VALUES
            ($parent_id, $id, 'GEOGRAPHICAL')
      ";
    }
    //d($fti_row, $fti_expra,$mix__arr,$fti_sqr);
    db_query("SET @FTI_TRIGGERS_STOP = 1");
    //d($fti_sqr);
    reg_expr();
    db_query("SET @FTI_TRIGGERS_STOP = 0");
  } catch (Exception $e) {
    $errs = $e->getMessage();
    $msg = "ErrFTI(reg_region_e4) - arP=$arP,region__tid=(" . ($fti_row['id'] ?? 'NULL') . ") $errs";
    dog($msg);
    throw new Exception($msg . (strpos($errs, 'ErrFTI(') === false ? $e->getTraceAsString() : ''));
  }
}

function reg_regions() {
  global $fti_sq, $fti_sqr, $fti_var, $fti_row, $fti_seg, $fti_seg_next, $fti_seg_mask;
  dop("Phase 2c-1 - Register all region name entries.");
  extract($fti_var['link__eMI']);
  $exREGI = $fti_var['exREGI'][0];
  $max_id = db_query("SELECT max(id) from nfc_expr__arP where 1=1 and expr__eS = $exREGI and (expr__eMI & $link_lvl_regi__eB) > 0")->fetchColumn() ?? 0;
  $sql = db_query("CALL nfc_expr__asPL_regi_gustosapp($max_id, 0)")->fetchAll(PDO::FETCH_ASSOC);
  $reg_bads = $fti_entry_cnt = 0;
  load_regions();
  $link__eMI = $link_lvl_regi__eB | $link_sts_wine__eB | $link_has_gustos__eB | $link_sts_jur__eB;
  if (count($sql)) {
    foreach ($sql as $fti_row) {
      $fti_row['expr__eMI'] = $link__eMI;
      //if ($fti_row['id'] != 4066) continue;
      echo "\r Region entries=" . (++$fti_entry_cnt) . ", ID=" . $fti_row['id'];
      reg_region();
    }
    nfc_load_all();
    link_regi_hierarchy_flat();
    db_query("call nfc_expr_regi__arPD_span__asPL_create()");
    //link_expr('exREGI');
  }
  dop("  2c-1 - 1 - All region entries: "
    . db_query("SELECT count(*) from nfc_expr__arP where 1=1 and expr__eS = $exREGI and (expr__eMI & $link_lvl_regi__eB) > 0")->fetchColumn());
  dop("  2c-1 - 2 - Omonyms: " . count($fti_seg['regi_om']));
  dop("  2c-1 - 3 - Linked: " . db_query("SELECT count(*) from nfc_expr_regi__arPD_link")->fetchColumn());
  if ($reg_bads) {
    dop("  2c-1 - 4 - Warning! Regions with zero wines registered: $reg_bads");
  }
  dop("Phase 2c-2 - Create all region synonyms.");
  $regi_syn_cnt = count_expr_synonyms($exREGI);
  dop("  2c-2 - 1 - All region synonyms: $regi_syn_cnt");
  unset($fti_seg['regi_om']);
  unset($fti_seg['regi_dups']);
}

function extrac(array $arr, $var) {
  $str = '';
  foreach ($arr as $key => $val) {
    $str .= "\n$$key = &$$var" . "['$key'];";
  }
  //cho "\n$str\n";
  return $str;
}

function extrace($ar) {
  $dar = "\$var = &\$$ar; eval(extrac(\$var, \"$ar\"));";
  return $dar;
}

function search_region($countries, $row_term__arP, $row_name) {
  global $fti_var, $fti_row, $fti_expra, $fti_seg, $fti_link__eMI;
  $fti_row = $fti_expra['word'] = $fti_expra['term'] = [];
  $exREGI = $fti_var['exREGI'][0];
  $exTARA = $fti_var['exTARA'][0];
  $countriy__arP = current($fti_seg['expr__arP'][$fti_seg['term__id'][$exTARA][$countries][TERM_ID_id__arP]])[EXPR__arP_chiTerm__arP];
  $reta = [
    'row_regi'  => 0,
    'row_terms' => []
  ];  
  $fti_row['name'] = $row_name;
  $fti_expra = [];
  $reta['row_term'] = parse_name($fti_var['exREGI'], preg_replace('/\s*[&+_]\s*/u', ' ', $row_name), $fti_var['syGroupRT'], FTI_PARSE_NAME__NORM_IT_elim_single_alpha);
  $key_term = key($fti_expra['term']);
  if ($key_term == $countriy__arP) { // || key($fti_seg['expr__arP'][$key_tara] ?? [1=>1]) == $countriy__arP) {
    return $reta;
  }
  foreach ($fti_expra['term'] as $chiTerm__arP => $val) {
    $reta['row_terms'][] = $chiTerm__arP;
//echo "\nSR.a - key=$key_term, key_tara=$key_tara, rang=$rang, name=$row_name, row_term__arP=$row_term__arP, chiTerm__arP=$chiTerm__arP, dsP=" . $fti_expra['term__arDS'][$chiTerm__arP] . "\n";
    if (isset($fti_seg['term__arP'][$chiTerm__arP][$exREGI])) {
      foreach ($fti_seg['term__arP'][$chiTerm__arP][$exREGI] as $term__id => $expr__arP) {
//echo "\nSR.b - term__id=$term__id, [regi__id][tara]=".$fti_seg['regi__id'][$term__id][REGI_ID_tara]."tara=$countries, [regi__id][par]=".$fti_seg['expr__arP'][$expr__arP][$chiTerm__arP][EXPR__arP_par__arP]."\n";
        if (1 == 1
            && isset($fti_seg['expr__arP'][$expr__arP][$chiTerm__arP])
            && $fti_seg['regi__id'][$term__id][REGI_ID_tara] == $countries
            && (1 != 1
                || !$row_term__arP
                || $fti_seg['expr__arP'][$expr__arP][$chiTerm__arP][EXPR__arP_par__arP] == $row_term__arP
                || $fti_seg['expr__arP'][$expr__arP][$chiTerm__arP][EXPR__arP_par__arP] == current($fti_seg['term__arP'][$countriy__arP][$exTARA])
            )
        ) {
          $reta['row_regi'] = $term__id;
        }
      }
    }
  }
  return $reta;
}

function reg_regions_src_types__exDB($sql) {
  db_query("TRUNCATE src_region_types");
  $rows = db_query(
"SELECT
      LOWER(c1.IGP) as type__full,
      trim(regexp_replace(c1.IGP, '(^[[:punct:]]|(?<=.)[[:punct:]].*|\\\\b(BC|bc)\\\\b)', '')) as type__abr,
      min(c1.src) as type__src,
      min(c1.Gustos_Import_Name) as type__region
    from ($sql) as c1
    group by c1.IGP
")->fetchAll(PDO::FETCH_ASSOC);
  $sql_i = "INSERT INTO src_region_types (type__full, type__abr, type__src, type__region)\nVALUES\n";
  foreach ($rows as $row) {
    extract($row);
    $words = explode(' ', $type__abr);
    if (($abr__cnt = count($words))) {
      if ($abr__cnt == 1) {
        $type__abr = norm_it($words[0]);
      } else {
        $type__abr = '';
        foreach ($words as $word) {
          $type__abr .= mb_strtolower((
            (($abr__len = mb_strlen($word)) < 2) ? '' : norm_it($word)[0]
          ));
        }
      }
      $sql_i .= ($type__abr == '' ? '' : "\n  ('$type__full', '$type__abr', '$type__src', '$type__region'),");
    }
  }
  //echo "\n$sql_i\n";
  db_query(mb_substr($sql_i, 0, -1));
  $rows = db_query(
"SELECT
    c1.src, c1.Name, c1.IGP,
    concat_ws(' ', if(c2.type__abr is null and c1.IGP <> '', 'ERROR', c2.type__abr), c1.Gustos_Import_Name) as Gustos_Import_Name
  from ($sql) as c1
    left join src_region_types as c2 on c2.type__full = LOWER(c1.IGP)
  where 1=1
    and c2.type__abr is null
    and c1.IGP <> ''
  ")->fetchAll(PDO::FETCH_ASSOC);
  if ($rows) {
    echo "\nERROR IGP value in src_regions_* tables\n\n";
    dd($rows);
  }
}

function search_regions_src__exDB() {
  global $fti_gustos_region_db, $fti_seg, $fti_expra, $fti_terme, $fti_link__eMI, $fti_var, $fti_sqr, $fti_gustos_db, $fti_parsedwine__exDB;
  $v_FTI_SEP_PATH_CHILD = FTI_SEP_PATH_CHILD;
  $exREGI = $fti_var['exREGI'][0];
  $sql = nfc_get_region_src__exDB();
  reg_regions_src_types__exDB($sql);
  $sql_s = 
"SELECT
    c1.src, c1.Name,
    if(c2.type__abr is null and c1.IGP <> '',
        concat('ERROR: ', c1.Gustos_Import_Name),
        if(c1.Gustos_Import_Name regexp '[[:punct:]]', concat_ws(' ', c2.type__abr, c1.Gustos_Import_Name),
          if(c2.type__abr is null, c1.Gustos_Import_Name,
            concat(c2.type__abr, ' ', c1.Gustos_Import_Name, ' / ', c1.Gustos_Import_Name, ' ', c2.type__abr)
          )
        )
    ) as Gustos_Import_Name,
    LOWER(c1.Country) as Country, c1.countries,
    if(c1.Wine_region = c1.Name, '', c1.Wine_region) as Wine_region,
    c1.Multiparrent_possible
  from ($sql) as c1
    left join src_region_types as c2 on c2.type__full = LOWER(c1.IGP)
  ";
  //  where c1.Name regexp 'Beaujolais'
  //  where c1.Multiparrent_possible regexp 'Oregon' and c1.Multiparrent_possible regexp 'Washington'
  // echo "\n$sql_s\n"; exit;
  $rows = db_query($sql_s)->fetchAll(PDO::FETCH_ASSOC);
  $register_phase_curr = 3;
  dop("Phase {$register_phase_curr}a - Search regions from $fti_parsedwine__exDB.src_*. All entries: " . count($rows));
  $fnc = $fti_entry_cnt = $iter = $found_nods_cnt = $found_span_cnt = 0;
  if (((int)$fti_var['register_phase']) < $register_phase_curr) {
    //d($fti_var['register_phase']);
    $exTARA = $fti_var['exTARA'][0];
    extract($fti_var['link__eMI']);    
    $fti_link__eMI = $link_has_extern__eB
      | $link_sts_app__eB
      | $link_sts_parent__eB
      | $link_sts_wine__eB
      | $link_lvl_regi__eB
    ;    
    load_regions('_all');
    db_query("truncate nfc_src_regions");
    $row_regi__vid = db_query("SELECT vid from $fti_gustos_db.taxonomy_vocabulary where `name` = 'Region'")->fetchColumn();
    $row_regi__id = db_query("SELECT max(tid) + 1 from $fti_gustos_db.taxonomy_term_data")->fetchColumn();
    $path__ids = $regions_rows = [];
    foreach ($rows as $row) {
      extract($row);
      if ($Multiparrent_possible != '' && $Wine_region == '') {
        $name_spans = $Multiparrent_possible;
      } else {
        $name_spans = ($Wine_region == '' ? $Country : $Wine_region);
      }
      $childs = explode(FTI_SEP_PATH_CHILD, trim($name_spans));
      $childs_cnt = count($childs);
      $up_regions = [];
      $Name = explode(FTI_SEP_SPAN, trim($Name))[0];
      $up_regions[$Name] = [$Name];
      $src_path = $name_spans . " $v_FTI_SEP_PATH_CHILD " . $Gustos_Import_Name;
      $span_yes = 0;
      for ($i = $childs_cnt; $i--;) {
        $spans = explode(FTI_SEP_SPAN, $childs[$i]);
        $up_new = $up_regions;
        foreach($up_regions as $up_region => $up_arr) {
          if (($span_cnt = count($spans)) > 1) {
            $span_yes++;
            $last = end($up_arr);
            for ($j = $span_cnt; $j--;) {
              $key = $spans[$j] . " $v_FTI_SEP_PATH_CHILD $last";
              if ($Name != $last) {
                $key .= " $v_FTI_SEP_PATH_CHILD $Name";
                $new_arr = [$Name, $last, $spans[$j]];
              } else {
                $new_arr = [$last, $spans[$j]];
              }
              if (isset($up_new[$key])) {
                dop("search_regions_e1 - Found span duplicates for src($src), Name($name) Wine_region($Wine_region)");
              } else {
                $up_new[$key] = $new_arr;
              }
              $iter++;
              $found_span_cnt++;
              $found_nods_cnt++;
            }
          } else {
            $up_new[$up_region][] = $spans[0];
            $found_nods_cnt++;
          }
        }
        $up_regions = $up_new;
      }
      if ($span_yes) {
        $found_nods_cnt--;
        unset($up_regions[$Name]);
      }
      if (!isset($regions_rows[$Country])) {
        $regions_rows[$Country] = [];
      }
      $regions_rows[$Country][] = [[$Name => $up_regions], $src, $src_path, $countries, $Gustos_Import_Name];
      $fnc += count($up_regions);
    }
    dop("  {$register_phase_curr}a - 0 - Found regions hierarchy nods: $fnc/$found_nods_cnt");
    unset($rows);
    $t = time();
    foreach ($regions_rows as $Country => $regions_row) {
      foreach ($regions_row as $regions_name) {
        $src = $regions_name[1];
        $src_path = $regions_name[2];
        $countries = $regions_name[3];
        $country__Expr = $fti_seg['term__id'][$exTARA][$countries][TERM_ID_id__arP];
        $Gustos_Import_Name = trim($regions_name[4]);
        foreach ($regions_name[0] as $Name => $up_regions) {
          foreach ($up_regions as $key => $up_arr) {
            $up_arr = array_reverse($up_arr);
            $path = implode($v_FTI_SEP_PATH_CHILD, $up_arr);
            $row_term__arP = $country__Expr;
            $to_path_ip = $path_ip = $path_i = $to_path_i = $sql_i = '';
            $up_cnt = count($up_arr) - 1;
            for ($row_regi_abs = $row_regi = $iter_ii = $iter_i = 0; $iter_i <= $up_cnt; $iter_i++) {
              $to_name = trim($up_arr[$iter_i], "[] ");
              $row_name = ($iter_i == $up_cnt ? $Gustos_Import_Name : $to_name);
              $to_row_regi = $row_regi_abs;
              $row_reta = search_region($countries, ($iter_i ? $to_row_regi : 0), $row_name);
              extract($row_reta);
//echo "\nSR.0 - row_name($row_name), row_term($row_term)\n"; //print_r($fti_expra);
              if ($iter_i) {
                $to_path = trim($up_arr[$iter_i - 1]);
                $to_path_i = ($to_row_regi ? $fti_seg['regi__id'][$to_row_regi][REGI_ID_path] : $path_i);
                $to_path_ip = $path_ip;
                $path_ip = "$path_ip $v_FTI_SEP_PATH_CHILD $row_term";
                $path_i = "$to_path_i $v_FTI_SEP_PATH_CHILD $row_term";
              } else {
                if ($row_regi) {
                  $to_path_ip = $to_path_i = $fti_seg['regi__id'][$countries][REGI_ID_path];
                  $path_ip = $path_i = $fti_seg['regi__id'][$row_regi][REGI_ID_path];
                } else {
                  $to_path_ip = $to_path_i = '';
                  $path_ip = $path_i = $fti_seg['regi__id'][$countries][REGI_ID_path];
                }
                $to_path = $Country;
              }
              if (!count($row_terms)) {
                continue;
              }
              if ($row_regi) {
                $is_new_path = 1;
                foreach ($fti_expra['term'] as $term__arP => $val) {
                  $new_path = "$to_path_i $v_FTI_SEP_PATH_CHILD ". $fti_expra['term__arDS'][$term__arP];
                  $end_path = explode(" $v_FTI_SEP_PATH_CHILD ", $path_i);
//echo "\nSR.1 - $row_term, row_regi=$row_regi, p_i=$new_path, is_i=" . (isset($fti_seg['regi_path'][$new_path]) ? 1 : 0) . "tarm__dsP(".$fti_expra['term__arDS'][$term__arP]."), end_p(".end($end_path).")\n";
                  if (isset($fti_seg['regi_path'][$new_path]) || end($end_path) == $fti_expra['term__arDS'][$term__arP]) {
                    $is_new_path = 0;
                    break;
                  }
                }
                if ($is_new_path) {
                  $row_regi = 0;
                }
              }
//echo "\nSR.2 - row_regi=$row_regi, is_i=" . (isset($path__ids[$path_i]) ? 1 : 0) . ", is_ip=" . (isset($path__ids[$path_ip]) ? 1 : 0);
              $row_regi = (isset($path__ids[$path_i]) ? $path__ids[$path_i] : (isset($path__ids[$path_ip]) ? $path__ids[$path_ip] : $row_regi));
//echo "\nSR.3 - row_regi=$row_regi\n";
              $to_term__arP = $row_term__arP;
              if ($row_regi) {
                $row_term__arP = $row_terms[0];
              } else {
//*
                $fti_sqr['r3'] =
                  "INSERT INTO $fti_gustos_region_db.region
                      (id, `type`, created, updated, `name`, `weight`, `level`, `path`)
                    values
                      ($row_regi__id, 'APPELLATION', $t, $t, '$row_name', 0, 1, '')
                ";
                $fti_sqr['r4'] =
                  "INSERT INTO $fti_gustos_db.taxonomy_term_data
                      (tid, vid, `name`, `description`)
                    value
                      ($row_regi__id, $row_regi__vid, '$row_name', 'APPELLATION')
                ";
                $fti_sqr['r6'] = "REPLACE INTO $fti_gustos_db.taxonomy_term_hierarchy (tid) value ($row_regi__id)";
                $fti_sqr['r7'] =
                  "REPLACE INTO $fti_gustos_db.field_data_field_region_country
                      (entity_type, bundle, entity_id, revision_id, `language`, delta, field_region_country_target_id)
                    value
                      ('taxonomy_term', 'region', $row_regi__id, $row_regi__id, 'und', 0, $countries)
                ";
                $fti_sqr['r8'] =
                  "REPLACE INTO $fti_gustos_db.field_revision_field_region_country
                      (entity_type, bundle, entity_id, revision_id, `language`, delta, field_region_country_target_id)
                    value
                      ('taxonomy_term', 'region', $row_regi__id, $row_regi__id, 'und', 0, $countries)
                ";
                db_query("SET @FTI_TRIGGERS_STOP = 1");
                reg_expr();
                db_query("SET @FTI_TRIGGERS_STOP = 0");
//                db_query("INSERT INTO $fti_gustos_region_db.region_hierarchy (parent_id, child_id, `type`) VALUES ($countries, $row_regi__id, 'GEOGRAPHICAL')");
                //*/
                $fti_seg['regi__id'][$row_regi__id] = [
                  REGI_ID_tara        => $countries,
                  REGI_ID_arP         => 0,
                  REGI_ID_path        => $path_i
                ];
                $row_term__arP = key($fti_expra['term']);
                foreach ($fti_expra['term'] as $term__arP => $val) {
//echo "\nSR.4 cnt=" . count($fti_expra['term']) . " term__arP=$term__arP, term__arDS=" . $fti_expra['term__arDS'][$term__arP] . "\n";
                  $fti_seg['term__arP'][$term__arP][$exREGI][$row_regi__id] = $row_regi__id;
                  $fti_seg['expr__arP'][$row_regi__id][$term__arP][EXPR__arP_par__arP] = $to_row_regi;
                  $fti_seg['term'][$fti_expra['term__cnt'][$term__arP] * FTI_RANG_SZ][$fti_expra['term__dsP'][$term__arP]][$exREGI][$row_regi__id] = [
                    TERM_rang_par__arP  => $to_term__arP,
                    TERM_rang_el__id    => 0,
                    TERM_rang_term__arP => $term__arP
                  ];
                }
                $row_regi = 0 - $row_regi__id++;
              }
              $to_path__id = (
                isset($path__ids[$to_path_i])
                  ? $path__ids[$to_path_i]
                  : (isset($path__ids[$to_path_ip])
                      ? $path__ids[$to_path_ip] 
                      : $to_row_regi
                  )
              );
              $sql_i .= ($iter_ii++ ? ",\n" : "") . "('$src', $countries, '$row_name', '$path_i', $row_regi, $row_term__arP, '$src_path', '$to_name', '$to_path', $to_path__id)";
              $row_regi_abs = abs($row_regi);
              if ($iter_i == $up_cnt) {
                foreach ($fti_expra['term'] as $term__arP => $val) {
                  $path_aip = "$to_path_ip $v_FTI_SEP_PATH_CHILD " . $fti_expra['term__arDS'][$term__arP];
                  $path_ai = "$to_path_i $v_FTI_SEP_PATH_CHILD " . $fti_expra['term__arDS'][$term__arP];
                  $fti_seg['regi_path'][$path_aip] = $fti_seg['regi_path'][$path_ai] = $path__ids[$path_aip] = $path__ids[$path_ai] = $row_regi_abs;
                }
              } else {
                $fti_seg['regi_path'][$path_ip] = $fti_seg['regi_path'][$path_i] = $path__ids[$path_ip] = $path__ids[$path_i] = $row_regi_abs;
              }
            }
            $msg = str_pad((", id($row_regi)"), 11);
            echo "\r entries(" .str_pad(++$fti_entry_cnt, 5) . str_pad((")$msg, for($Country>" . substr($path, 0, 100) . ")"), 140);
            if ($iter_ii) {
              $sql_i =
                "INSERT INTO $fti_parsedwine__exDB.nfc_src_regions
                    (src, country__tid, cur_name, cur_path, regi__id, term__arP, src_path, to_name, to_path, to_path__id)
                  values
                    $sql_i
              ";
              try {
                db_query($sql_i);
              } catch (Exception $e) {
                $msg = "\nsearch_regions_e2 - $sql_i\n" . $e->getMessage();
                dop($msg);
                dd($up_arr, $src_path, $src);
              }
            }
          }
        }
//if ($Gustos_Import_Name == "Moravia") dd("\nStop\n",$fti_expra); //  "dop Beaujolais / Beaujolais dop"
      }
    }
    nfc_setVar('register_phase', $register_phase_curr);
  }
  $found_gustos_cnt = db_query("SELECT count(DISTINCT regi__id) from $fti_parsedwine__exDB.nfc_src_regions where regi__id > 0")->fetchColumn();
  dop("  {$register_phase_curr}a - 1 - Found regions from gustosapp.regions: $found_gustos_cnt");
  $found_new_cnt = db_query("SELECT count(*) from $fti_parsedwine__exDB.nfc_src_regions where regi__id < 0")->fetchColumn();
  dop("  {$register_phase_curr}a - 2 - Found new nodes: $found_new_cnt");
//  dd($up_arr, $src_path, $src, $fti_expra);
}

function reg_regions_src__exDB() {
  global $fti_var, $fti_row, $fti_seg, $fti_parsedwine__exDB, $fti_gustos_db;
  $exREGI = $fti_var['exREGI'][0];
  $sql = 
    "SELECT b1.mid,
        b1.rid as id, b1.name, b2.regi__id, b2.cur_path,
        ifnull(b5.arP, 0) as arP,
        b2.src, b2.country__tid as countries, b2.src_path,
        if(b4.country__tid is null, b2.to_path, '') as to_path,
        b2.to_path__id, 0 as wines__cnt
      FROM (
        SELECT
          min(a1.id) as mid, a2.rid,
          group_concat(a1.cur_name order by a2.name_len desc) as `name`
        FROM $fti_parsedwine__exDB.nfc_src_regions as a1
          inner join (
            select
              min(id) as mid,
              abs(regi__id) as rid,
              char_length(regexp_replace(trim(SUBSTRING_INDEX(REGEXP_replace(cur_name, '[(/]', ','), ',', 1)), '\\\\w', '')) as name_len
            from $fti_parsedwine__exDB.nfc_src_regions
            group by cur_name, abs(regi__id)
          ) as a2 on a2.mid = a1.id
        group by a2.rid
      ) b1
        inner join $fti_parsedwine__exDB.nfc_src_regions as b2 on b2.id = b1.mid
        left join $fti_gustos_db.region as b3 on b3.id = abs(b2.regi__id)
        left join $fti_parsedwine__exDB.src_countries as b4 on b4.country__name = b2.to_path
        left join nfc_expr__arP as b5 on b5.id = b1.rid and b5.expr__eS = $exREGI
      where b3.path = ''
      order by b1.mid"
  ;
  //echo "\n$sql\n"; exit;
  $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $rows_cnt = count($rows);
  dop("Phase 3b - Rgister regions from $fti_parsedwine__exDB.src_*. All entries: $rows_cnt");
  extract($fti_var['link__eMI']);
  $fti_entry_cnt = 0;
  load_regions();
  $link__eMI = $link_lvl_regi__eB | $link_sts_wine__eB | $link_has_extern__eB | $link_sts_jur__eB;
  if ($rows_cnt) {
    foreach ($rows as $fti_row) {
      extract($fti_row);
      if ($to_path != '') {
        if ($to_path__id) {
          $fti_row['parent_id'] = $to_path__id;
        } else {
          $msg = "reg_regions_src__exDB_e1 - Parrent region is not registered for region($name), parrent_name($to_path), from($src/$src_path)";
          dog($msg);
          throw new Exception($msg);
        }
      } else {
        $fti_row['parent_id'] = $countries;
      }
      $fti_row['expr__eMI'] = $link__eMI;
      if ($regi__id < 0) {
        echo "\r Region new entries=" . (++$fti_entry_cnt) . ", ID=$id";
        reg_region();
      } else {
        echo "\r Region old entries=" . (++$fti_entry_cnt) . ", ID=$id";
        reg_region_clear($arP, $id);
        reg_region($arP);
      }
    }
    nfc_load_all();
    link_regi_hierarchy_flat();
    //link_expr('exREGI');
  }
  dop("  3b - 1 - All region entries: "
    . db_query("SELECT count(*) from nfc_expr__arP where expr__eS = $exREGI and (expr__eMI & $link_has_extern__eB) > 0")->fetchColumn());
  dop("  3b - 2 - Omonyms: " . count($fti_seg['regi_om']));
  dop("  3b - 3 - Linked: " . db_query("SELECT count(*) from nfc_expr_regi__arPD_link")->fetchColumn());

  dop("Phase 3c - Create all region synonyms.");
  $regi_syn_cnt = count_expr_synonyms($exREGI);
  dop("  3c - 1 - All region synonyms: $regi_syn_cnt");
  unset($fti_seg['regi_om']);
  unset($fti_seg['regi_dups']);
  nfc_load_all();
}

function norm_vine($vine_name) {
  global $fti_seg, $fti_expra, $fti_seg, $fti_var, $fti_terme;
  $exVINE = $fti_var['exVINE'][0];
  $fti_expra = [];
  $ret_name = preg_replace('/^\s*\d+\s*[[:punct:]](?!\d)|[[:punct:]]\s*\d+\s*([[:punct:]](?!\d)|$)/u', '', norm_it(preg_replace('/\s*[&+_"]\s*/u', ' ', $vine_name)));
  expra_word($ret_name);
  search_terms($fti_var['syGroupVT'], $exVINE);
  foreach ($fti_terme as $j => $term) {
    if (($term__cnt = count($term))) {
      $arPA = reg_term(array_flip(array_flip($term)), $exVINE, FTI_PARSE_NAME__REG_TERM_ignore_term);
      $key = $arPA[REG_TERM_arP];
      $fti_expra['term__arP'][$j] = $key;
      if (!isset($fti_expra['term'][$key])) {
        $fti_expra['term'][$key] = $arPA[REG_TERM_arPS];
        $fti_expra['term__cnt'][$key] = $term__cnt;
        $fti_expra['term__len'][$key] = $arPA[REG_TERM_len];
        $fti_expra['term__dsP'][$key] = $arPA[REG_TERM_dsP];
        $fti_expra['term__arDS'][$key] = $arPA[REG_TERM_arDS];
        $fti_expra['origin__arP'][$key] = $arPA[REG_TERM_origin__arP];
      }
    }
  }
  return $ret_name;
}

function reg_vineyard($arP = 0) {
  global $fti_seg, $fti_row, $fti_sq, $fti_sqr, $fti_expra, $fti_seg,
          $fti_exVINE, $fti_var, $fti_terms, $fti_terme, $mix__arr;
  try {
    $exTARA = $fti_var['exTARA'][0];
    $to_parExpr__arP = FTI_VINE;
    $countries__ids = [];
    $norm_name =  norm_vine($fti_row['name']);
    extract($fti_row);
    //d($norm_name, $fti_row,$fti_expra,$fti_terme);
    if ($countries != '') {
      $fti_row['expr__eMI'] |= $fti_var['link_sts_child__eB'];
      $countries__ids = array_flip(explode(',', $countries));
      $to_parExpr__arP = $fti_seg['term__id'][$exTARA][key($countries__ids)][TERM_ID_id__arP];
    }
    $origin__arP = $term__arP = (($fti_expra['term'] ?? 0) ? key($fti_expra['term']) : 0);
    $fti_expr_cnt = 0;
    $fti_sqr['r4'] = '';
    if (!$arP) {
      $arP = seg_next_arP(NFC_EXPR__arP);
      $fti_sqr['r1'] = $fti_sq['a1'] . "($arP)";
    }
    foreach ($fti_expra['term'] as $term => $j) {
      if (!$term) {
        $origin__arP = $fti_expra['origin__arP'][$term];
        // if ($fti_expra['term__cnt'][$term] > 1) { $term = $origin__arP; }
      } else {
        $fti_sqr['r4'] .= ($fti_expr_cnt++ ? ',' : $fti_sq['e3']) . " ($arP, " . ($fti_expr_cnt - 1) . ", $term)";
      }
    }
    if ($term__arP) {
      $origin__arP = $term__arP;
    }
    if (!$origin__arP) {
      dd("Bad term__arP($origin__arP) for: $norm_name", $fti_row);
    }
    if (isset($fti_seg['vine__arP'][$origin__arP][$to_parExpr__arP])) {
      $to_parExpr__arP = $arP;
    }
    if (!$fti_expr_cnt) {
      $fti_sqr['r4'] = $fti_sq['e3'] . " ($arP, 0, $origin__arP)";
      $fti_expr_cnt++;
    }
    $fti_sqr['r2'] =
      "INSERT into nfc_expr__arP
          (arP, expr__eS, expr__eMI, parExpr__arP,
            chiTerm__arP, id, next__id, word__cnt, char__cnt, new__id, countries, attrTYPE__arS, attrTITLE__arS)
        values
          ($arP, " . $fti_exVINE[0]. ", $expr__eMI, $to_parExpr__arP"
          . ", $origin__arP, $id, $fti_expr_cnt, "
          . $fti_expra['term__cnt'][$term__arP] . ", ". $fti_expra['term__len'][$term__arP] . ", "
          . $fti_expra['new__id'] . ", '$countries'"
          . ", $attrTYPE__arS, $attrTITLE__arS)"
    ;
    //d($fti_row, $fti_expra, $fti_sqr['r4'],$origin__arP,$term__arP, $fti_terme, $mix__arr, $fti_sqr['r2']);
    $fti_seg['vine__arP'][$origin__arP][$to_parExpr__arP] = [
      'chiTerm__arP' => $origin__arP,
      'expr__arP' => $arP,
      'id' => $id,
      'next__id' => $fti_expr_cnt,
      'new__id' => $fti_expra['new__id'],
      'countries' => $countries,
      'wines__cnt' => $wines__cnt
    ];
    $fti_seg['vine__id'][$id] = [
      VINE_ID_tara        => $countries__ids,
      VINE_ID_wines__cnt  => $wines__cnt
    ];

    $fti_seg['vine__arP'][$origin__arP][$to_parExpr__arP]['countries'] = $countries;
    $fti_seg['vine__arP'][$origin__arP][$to_parExpr__arP]['wines__cnt'] = $wines__cnt;
    $fti_sqr['r3'] =
      "INSERT INTO nfc_expr_vine__arPD
          (vine__arP, countries, wines__cnt)
        values
          ($arP, '$countries', $wines__cnt)
    ";
    reg_expr();
    return $arP;
  } catch (Exception $e) {
    $errs = $e->getMessage();
    $msg = "ErrFTI(reg_vineyard__P_1)arP=$arP,vine__id=(" . ($id ?? 'NULL') . ") $errs";
    dog($msg);
    throw new Exception($msg . (strpos($errs, 'ErrFTI(') === false ? $e->getTraceAsString() : ''));
  }

}

const VINE_ID_tara = 0;
const VINE_ID_wines__cnt = 1;
const VINE_ID_new__id = 2;
const VINE_ID_expr__arP = 3;
const EXPR_ID_tara = VINE_ID_tara;
if (VINE_ID_tara != REGI_ID_tara) {
  dd("VINE_ID_tara and REGI_ID_tara constants must be equal!!!");
}

function load_vineyards() {
  global $fti_seg;

  $fti_seg['vine_link'] = $fti_seg['vine_ling'] = $fti_seg['vine_dups'] = $fti_seg['vine_dupg'] = [];
  $fti_seg['vine_links'] = $fti_seg['vine__arP'] = $fti_seg['vine__id'] = [];
  $rows = db_query(
    "SELECT
        expr__arP, id, expr__eMI, chiTerm__arP, parExpr__arP, attrTYPE__arS, attrTITLE__arS, next__id, new__id,
        countries, wines__cnt, to_link__id, to_dups__id
      FROM nfc_expr__asVS_vine_load
  ")->fetchAll(PDO::FETCH_ASSOC);
  foreach ($rows as $row) {
    $fti_seg['vine__arP'][$row['chiTerm__arP']][$row['parExpr__arP']] = $row;
    $ca = ($row['countries'] == '' ? [] : array_flip(explode(',', $row['countries'])));
    $fti_seg['vine__id'][$row['id']] = [
      VINE_ID_tara        => $ca,
      VINE_ID_wines__cnt  => $row['wines__cnt'],
      VINE_ID_new__id     => $row['new__id'],
      VINE_ID_expr__arP   => $row['expr__arP'],
    ];
    if ($row['to_link__id']) {
      $fti_seg['vine_link'][$row['id']] = $row['to_link__id'];
      if (!isset($fti_seg['vine_ling'][$row['to_link__id']])) {
        $fti_seg['vine_ling'][$row['to_link__id']] = [];
      }
      $fti_seg['vine_ling'][$row['to_link__id']][$row['id']] = 0;
      if (!isset($fti_seg['vine_links'][$row['to_link__id']])) {
        $fti_seg['vine_links'][$row['to_link__id']] = $row['id'];
      } else {
        $fti_seg['vine_links'][$row['to_link__id']] .= "," . $row['id'];
      }
    }
    if ($row['to_dups__id']) {
      $fti_seg['vine_dups'][$row['id']] = $row['to_dups__id'];
      if (!isset($fti_seg['vine_dupg'][$row['to_dups__id']])) {
        $fti_seg['vine_dupg'][$row['to_dups__id']] = [];
      }
      $fti_seg['vine_dupg'][$row['to_dups__id']][$row['id']] = 0;
    }
  }
}

function reg_vineyards_syn() {
  global $fti_sq, $fti_var, $fti_row, $fti_seg, $fti_expra, $fti_terms, $fti_terme;
  $rows = nfc_vine_synonyms_create();
  load_terms();
  $vine_cnt = $syn_cnt = 0;
  try {
    foreach ($rows as $fti_row) {
      $fti_expra = [];
      $name_a = explode('/', $fti_row['name']);
      $fti_expra = [];
      $name_b = norm_vine($name_a[0]);
      // parse_name($fti_var['exVINE'], $name_b, $fti_var[$fti_row['group']]); //, FTI_PARSE_NAME__REG_TERM_ignore_term);
      $expra = $fti_expra;
      $key__arP = (($fti_expra['term'] ?? 0) ? key($fti_expra['term']) : 0);
      $fti_expra = [];
      array_shift($name_a);
      $name_r = norm_vine(implode('/', $name_a));
      // parse_name($fti_var['exVINE'], $name_r, $fti_var[$fti_row['group']]); //, FTI_PARSE_NAME__REG_TERM_ignore_term);
      $vine_cnt++;
      if ($key__arP && isset($fti_seg['vine__arP'][$key__arP])) {
        $arP = key($fti_seg['vine__arP'][$key__arP]);
      } else {
        dop("reg_vineyards_syn_e1 - base country expr__arP not found for nfc_vine_synonyms_create.dsP=" . $fti_row['name']);
        dd($name_b, $expra, $key__arP, $name_r, $fti_expra, $fti_row, $fti_var[$fti_row['group']]);
        return;
      }
      $sql_i = "REPLACE INTO nfc_expr__acPU_term (expr__arP, el__id, term__arP) values ";
      $expr__arP = $fti_seg['vine__arP'][$key__arP][$arP]['expr__arP'];
      foreach (array_merge($expra['term__arP'], $fti_expra['term__arP']) as $i => $term__arP) {
        if ($term__arP) {
          $sql_i .= ($i ? "," : "") . "($expr__arP, $i, $term__arP)";
          $syn_cnt++;
        }
      }
      $i++;
      //d($fti_row, $fti_expra, $fti_terms, $fti_terme, $sql_i);
      db_query($sql_i);
      db_query("UPDATE nfc_expr__arP set next__id = $i where arP = $expr__arP");
    }
  } catch (Exception $e) {
    $errs = $e->getMessage();
    $msg = "reg_vineyards_syn_e2 - arP=$arP, sql_i=($sql_i) $errs";
    dog($msg);
    throw new Exception($msg);
  }
  dop("       3 - vineyard entries updated: $vine_cnt");
  dop("       4 - vineyard synonyms inserted: $syn_cnt");
  load_terms();
}

function reg_vineyards() {
  global $fti_sq, $fti_var, $fti_row, $fti_seg, $fti_seg_next, $fti_seg_mask;
  $register_phase_curr = 4;
  $exVINE = $fti_var['exVINE'][0];
  dop("Phase {$register_phase_curr}a - Register all vineyard name entries.");
  if (((int)$fti_var['register_phase']) < $register_phase_curr) {
    extract($fti_var['link__eMI']);
    $fti_entry_cnt = 0;
    load_vineyards();
    $link__eMI = $link_lvl_vine__eB | $link_sts_wine__eB | $link_has_gustos__eB;
    db_query("SET FOREIGN_KEY_CHECKS=0");
    db_query("TRUNCATE nfc_expr_vine__arPD_link");
    do {
      $max_id = db_query("SELECT max(id) from nfc_expr__arP where expr__eS = $exVINE")->fetchColumn() ?? 0;
      $rows = db_query("CALL nfc_expr__asPL_vine_gustosapp($max_id, 0)")->fetchAll(PDO::FETCH_ASSOC); // 26525
      $fti_entry_done = $fti_entry_cnt;
      dop("Next " . FTI_VINEYARD_BL_20000 . " rows vineyards registration, prior rows number: $fti_entry_done, start id: " . ($max_id + 1));
      foreach ($rows as $fti_row) {
        echo "\r Vineyard entries=" . $fti_entry_cnt++ . ", ID=" . $fti_row['id'];
        $fti_row['expr__eMI'] = $link__eMI;
        reg_vineyard();
      }
    } while ($fti_entry_cnt != $fti_entry_done);
    nfc_setVar('register_phase', $register_phase_curr);
    nfc_term__arPD_exclude_log_restore();
    db_query("UPDATE nfc_term__arPD_exclude_log set term__dsP = TRIM(term__dsP)");
    reg_vineyards_syn();
    link_expr('exVINE');
  }
  dop("  {$register_phase_curr}a - 1 - All vineyard entries: " . db_query("SELECT count(*) from nfc_expr__arP where expr__eS = $exVINE")->fetchColumn());
  dop("  {$register_phase_curr}a - 2 - Linked vineyard entries: " . db_query("SELECT count(*) from nfc_expr_vine__arPD_link")->fetchColumn());
  dop("Phase {$register_phase_curr}b - Register all vineyard synonyms.");
  $vine_syn_cnt = count_expr_synonyms($exVINE);
  dop("  {$register_phase_curr}b - 1 - All vineyard synonyms: $vine_syn_cnt");
  db_query("SET FOREIGN_KEY_CHECKS=1");

}

function nfc_register() {
  global $fti_seg;
  reg_attributes();
  reg_countries();
 //reg_rules();
  reg_grapes();
  reg_regions();
  //nfcDB__backup();
  ///*
  //*
  reg_vineyards();
  //..nfcDB__backup();
  // exit;
  //nfc_rs_regi__reg();
  //nfc_rs_vine__reg();
  //* /
  reg_wines();
  link_vine_hierarchy_flat();
  link_regi_hierarchy_flat();
  //                          parsed__exDB_laad('parse_armenia', 'is26763', '5'); //, 0, 0, 178);
  //                          parsed__exDB_laad('parse_armenia', 'is26763', 'msf'); //, 0, 0, 178);

  //*/
}

function reg_wine_attr_vine($arP) {
  global $fti_terms, $fti_exVINE, $mix__arr, $fti_sq, $fti_seg, $fti_row;
  $exVINE = $fti_exVINE[0];
  $id = $fti_row['id'];
  $vineyard = &$fti_row['vineyard'];
  $vine__id = &$fti_row['vine__id'];
  $vine__id = key($mix__arr[$exVINE]['arP']);
  $vine__cnt = $mix__arr[$exVINE]['arP'][$vine__id]['cnt'];
  $fti_row['vine__lvl'] = ($vine__cnt > 1 ? 0 : ($mix__arr[$exVINE]['arP'][$vine__id]['el__id'] > $fti_seg['term__id'][$exVINE][$vine__id][TERM_ID_new__id] ? 2 : 1));
  //d($vine__id, $vine__cnt, $fti_expra, $mix__arr[$exVINE]['arP'], $fti_terms, $vine__id);
  $fti_sq['wine']['vine']++;
  $fti_row['vine__term'] = $mix__arr[$exVINE]['arP'][$vine__id]['term__arP'];
  if ($vineyard != $vine__id) {
    $ret = "$exVINE, $vine__cnt, $id, $vineyard, $vine__id";
    $vineyard = ($vineyard ? $vineyard : $vine__id);
    return $ret;
  }
  return 0;
}

function reg_wine_blend($grap) {
  global $fti_seg;
  $grapes = explode(',', $grap);
  if (($grapes_cnt = count($grapes))) {
    db_query("INSERT into nfc_expr_grap__arS_blend (blend__dsP, blend__cnt) values ('$grap', $grapes_cnt)");
    $sql = '';
    $j = 0;
    $new_blend__arS = db_query("SELECT LAST_INSERT_ID()")->fetchColumn();
    foreach ($grapes as $grape__id) {
      $sql .= ($j++ ? ",\n" : "INSERT INTO nfc_expr_grap__acSG_blend (blend__arS, grap__id) values\n") . "  ($new_blend__arS, $grape__id)";
    }
    //d($fti_row, $mix__arr, $fti_expra, $exTYPE, $grapes, $grap, $sql);
    db_query($sql);
    if (($new_grapes_cnt = db_query("SELECT ROW_COUNT()")->fetchColumn()) != $grapes_cnt) {
      return 0;
    }
    $fti_seg['blends'][$grap][$new_blend__arS] = $new_grapes_cnt;
  } else {
    return 0;
  }
  return $new_blend__arS;
}

function reg_wine_attr($arP = 0, $sq_mode = 0) {
  global $fti_var, $fti_terme, $fti_sqr, $fti_expra, $fti_terms, $fti_seg, $fti_sq,
        $fti_row,$fti_exWINE, $fti_var, $fti_wineTYPE, $mix__arr, $fti_exREGI, $fti_exGRAP, $fti_exVINE, $fti_attr_still;
  if (!isset($fti_sq['wine'])) {
    $fti_sq['wine']['color'] = $fti_sq['wine']['co2'] = $fti_sq['wine']['regi'] = $fti_sq['wine']['grap'] = $fti_sq['wine']['vine'] = $fti_sq['wine']['col'] = $fti_sq['wine']['co2'] = 0;
  }
  //extract($fti_row);
  $BL_i = $fti_row['blend__arS'] = $fti_row['blend_new__arS'] = $fti_row['attrTYPE__eMB'] = $fti_row['attrTITLE__eMB'] = $fti_row['type__cnt'] = $fti_row['vine__term'] =
    $fti_row['title__cnt'] = $fti_row['term__cnt'] = $fti_row['vine__id'] = $fti_row['regi__id'] = $fti_row['vine__lvl'] = $fti_row['regi__lvl'] = 0;
  $fti_row['word__dsP'] = $fti_row['blend__dsP'] = $fti_row['term__dsP'] = $fti_row['grape_new__dsP'] = $fti_sqr['r8'] = $fti_row['countries'] ='';
  $regi__arr = array_flip($fti_row['region'] == '' ? [] : explode(',', $fti_row['region']));
  $fti_row['to_vine__id'] = (isset($fti_seg['vine_link'][$fti_row['vineyard']]) ? $fti_seg['vine_link'][$fti_row['vineyard']] : 0);
  eval(extrace('fti_row'));
  if ($sq_mode) {
    echo "\r$id";
  }
  $exGRAP = $fti_exGRAP[0];
  $exREGI = $fti_exREGI[0];
  $exVINE = $fti_exVINE[0];
  $wineTYPE = $fti_wineTYPE[0];
  $wineTITLE = $fti_var['wineTITLE'][0];
  $wineTRIG = $fti_var['wineTRIG'][0];
  $wineTRIGS = $wineTRIG & NFC_exprTRIG__eMB;
  $wiAttrColor = $fti_var['wiAttrColor'];
  $wiAttrCo2 = $fti_var['wiAttrCo2'];
  $ca = $blends = $exTYPE = $fti_expra = [];
  if ($vineyard) {
    if (isset($fti_seg['term__id'][$exVINE][$vineyard])) {
      $ca = $fti_seg['term__id'][$exVINE][$vineyard][TERM_ID_tara];
    }
  }
  $ca1 = $ca;
  if (!$country && count($ca)) {
    $countries = key($ca);
  } else {
    if ($region != '') {
      foreach (explode(',', $region) as $curr__id) {
        if (isset($fti_seg['term__id'][$exREGI][$curr__id])) {
          $ca += $fti_seg['term__id'][$exREGI][$curr__id][TERM_ID_tara];
        }
      }
    }
    $countries = implode(',', array_keys($ca));
  }
  //d($ca1, $ca, $vineyard, $fti_seg['term__id'][$exVINE][$vineyard], $curr__id, $fti_seg['term__id'][$exREGI][$curr__id]);
  $norm_name = parse_name($fti_exWINE, $name, $fti_var['syGroupWT']);
  //d($fti_row, $fti_expra, $mix__arr, $fti_terms);
  if ($grape__dsP != '0') {
    foreach (explode(',#,', $grape__dsP) as $old_grap) {
      if ($old_grap != '') {
        if (isset($fti_seg['blends'][$old_grap])) {
          $curr_blend__arS = key($fti_seg['blends'][$old_grap]);
        } elseif (!($curr_blend__arS = reg_wine_blend($old_grap))) {
          $msg = "reg_wine_attr_e1 - for wine($id/$name) BLEND/BLENDS($old_grap/$grape__dsP) has bad grapes count";
          dog($msg);
          throw new Exception($msg);
        }
        $blends[] = $curr_blend__arS;
        if (($curr__cnt = $fti_seg['blends'][$old_grap][$curr_blend__arS]) > $grape__cnt || !$blend__arS) {
          $blend__arS = $curr_blend__arS;
          $grape__cnt = $curr__cnt;
        }
        if ($arP) {
          $fti_sqr['r8'] .= ($BL_i++ ? ",\n" : "INSERT INTO nfc_expr_wine__acPU_blend values\n") . "  ($arP, $curr_blend__arS)";
        }
      }
    }
    if (count($blends)) {
      $blend__dsP = implode(',', $blends);
    }
  }
  if (($regi_exists = isset($fti_terms[$exREGI])) || isset($fti_row['region_type']) && $region_type != '') {
    if (!$regi_exists) {
      $save_terme = $fti_terme;
      $save_expra = $fti_expra;
      $save_terms = $fti_terms;
      $save_mix__arr = $mix__arr;
      $fti_expra = [];
      parse_name($fti_exWINE, preg_replace('/\R.*/u', '', $region_type), $exREGI, FTI_PARSE_NAME__NORM_IT_elim_single_alpha);
      $fti_terme = $save_terme;
    }
    if (isset($fti_terms[$exREGI])) {
      $regi__id = key($mix__arr[$exREGI]['arP']);
      $regi__cnt = $mix__arr[$exREGI]['arP'][$regi__id]['cnt'];
      $regi__lvl = ($regi__cnt > 1 ? 0 : ($mix__arr[$exREGI]['arP'][$regi__id]['el__id'] > $fti_seg['term__id'][$exREGI][$regi__id][TERM_ID_new__id] ? 2 : 1));
      $regi_tara = key($fti_seg['term__id'][$exREGI][$regi__id][TERM_ID_tara]);
      $fti_sq['wine']['regi']++;
      if (!isset($regi__arr[$regi__id])) {
        $regi__arr[$regi__id] = 0;
        $exTYPE[] = "$exREGI, $regi__cnt, $id, $regi_tara, $regi__id";
        $region = implode(',', array_keys($regi__arr));
      }
      if (!$regi_exists) {
        $fti_terme = $save_terme;
        $fti_expra = $save_expra;
        $fti_terms = $save_terms;
        $mix__arr = $save_mix__arr;
        $regi__id = 0;
      }
    } 
  }
  if (isset($fti_terms[$exVINE])) {
    if (($ret = reg_wine_attr_vine($arP))) {
      $exTYPE[] = $ret;
    }
  } elseif (isset($fti_row['vineyard_type']) && $vineyard_type != '') {
    $save_terme = $fti_terme;
    $save_expra = $fti_expra;
    $save_terms = $fti_terms;
    $save_mix__arr = $mix__arr;
    foreach (explode(' / ', $vineyard_type) as $vt__name) {
      $fti_expra = [];
      $nn = norm_vine($vt__name);
      // echo "\nVI_1 name=$vt__name, nn=$nn, is_terms_vine=" . (isset($fti_terms[$exVINE]) ? 1 : 0);
      if (isset($fti_terms[$exVINE]) && ($ret = reg_wine_attr_vine($arP))) {
        $exTYPE[] = $ret;
        $vine__id = 0;
        break;
      }
    }
    $fti_terme = $save_terme;
    $fti_expra = $save_expra;
    $fti_terms = $save_terms;
    $mix__arr = $save_mix__arr;
  }
  $cntARR[$wineTYPE] = $type__cnt;
  $cntARR[$wineTITLE] = $title__cnt;
  $attrARR[$wineTYPE] = $mix__arr[$wineTYPE]['attr__eMB'] ?? 0;
  $attrARR[$wineTITLE] = $mix__arr[$wineTITLE]['attr__eMB'] ?? 0;
  if (isset($fti_terms[$wineTRIG])) {
    foreach($fti_terms[$wineTRIG] as $term__arP => $term__id) {
      $expr__arP = $fti_seg['term__arP'][$term__arP][$wineTRIG][$term__id] + 1; // wineTRIGS atte.expr__arP is exact greater by 1
      foreach ($fti_seg['expr__arP'][$expr__arP] as $attrARR_term__arP => $arr) {
        foreach ($fti_seg['term__arP'][$attrARR_term__arP] as $attrARR_typ => $attrARR_ida) {
          //echo "\nattrARR_typ=$attrARR_typ, in_arr=".(in_array($attrARR_typ, [$wineTYPE, $wineTITLE])?1:0;
          if (in_array($attrARR_typ, [$wineTYPE, $wineTITLE]) && !($attrARR[$attrARR_typ] & key($attrARR_ida))) {
            $attrARR[$attrARR_typ] |= key($attrARR_ida);
            $cntARR[$attrARR_typ]++;
            //echo "\n  id=" . key($attrARR_ida);
          }
        }
      }
      //d($fti_seg['term__arP'][$term__arP][$wineTRIG], $term__id, $term__arP);
    }
  }
  $attrTYPE__eMB = $attrARR[$wineTYPE]; // is used as reference to $fti_row['attrTYPE__eMB']
  $attrTITLE__eMB = $attrARR[$wineTITLE];
  //d($attrTYPE__eMB,$attrTITLE__eMB, $attrARR);
  $type__cnt = $cntARR[$wineTYPE];
  $title__cnt = $cntARR[$wineTITLE];
  if ($attrTITLE__eMB) {
    $wiColor = 'attr_' . dechex($attrTITLE__eMB & $wiAttrColor);
    if (isset($fti_var[$wiColor])) {
      $fti_sq['wine']['color']++;
      if ($fti_var[$wiColor] != $color) {
        $exTYPE[] = "$wineTITLE, 1, $id, $color, " . $fti_var[$wiColor];
        $color = $fti_var[$wiColor];
      }
    }
    $wiCo2 = 'attr_' . dechex($attrTITLE__eMB & $wiAttrCo2);
    //d("p4", $fti_row, $fti_expra, $mix__arr, $fti_terms, $wiColor, $wiCo2);
    // if (isset($fti_var[$wiCo2])) {
    if (isset($fti_var[$wiCo2]) && ($fti_var[$wiCo2] != $fti_attr_still || !$co2)) { // skeep if (new co2 is fti_attr_still) && (old co2 != 0) -- so new stile wine has low priority
      $fti_sq['wine']['co2']++;
      if ($fti_var[$wiCo2] != $co2) {
        $exTYPE[] = "$wineTITLE, 1, $id, $co2, " . $fti_var[$wiCo2];
        $co2 = $fti_var[$wiCo2];
      }
    }
    //if ($id == 763) /* 1893) */ d($fti_row, $fti_expra, $mix__arr, $fti_terms, $wiColor, $wiCo2, $color, $co2);
  }
  if (($term__cnt = count($fti_expra['word'] ?? []))) {
    $term__dsP = implode(',', $fti_expra['word']);
  }
  if (!$country) {
    $ca = [];
    if ($region != '') {
      foreach (explode(',', $region) as $curr__id) {
        if (isset($fti_seg['term__id'][$exREGI][$curr__id])) {
          $ca += $fti_seg['term__id'][$exREGI][$curr__id][TERM_ID_tara];
        }
      }
    }
    if ($vineyard) {
      if (isset($fti_seg['term__id'][$exVINE][$vineyard])) {
        $ca += $fti_seg['term__id'][$exVINE][$vineyard][TERM_ID_tara];
      }
    }
    $countries = implode(',', array_keys($ca));
  }
  if (($exist_blend = isset($fti_terms[$exGRAP])) || (isset($fti_row['grape_type']) && $grape_type != '')) {
    if (!$exist_blend) {
      $save_terme = $fti_terme;
      $save_expra = $fti_expra;
      $save_terms = $fti_terms;
      $save_mix__arr = $mix__arr;
      $fti_expra = [];
      parse_name($fti_exWINE, preg_replace('/\R.*|\d+/u', '', $grape_type), $exGRAP);
    }
    if (isset($fti_terms[$exGRAP])) {
      $grap = $mix__arr[$exGRAP]['dsP'];
      if (isset($fti_seg['blends'][$grap])) {
        $new_blend__arS = key($fti_seg['blends'][$grap]);
      } elseif (!($new_blend__arS = reg_wine_blend($grap))) {
        $msg = "reg_wine_e2 - for wine($id/$name) bad grapes count ($grap)";
        dog($msg);
        throw new Exception($msg);
      }
      $grape_new__dsP = $grap;
      $grape__cnt = $fti_seg['blends'][$grap][$new_blend__arS];
      $blend_new__arS = $new_blend__arS;
      if (1 == 1
          && !in_array($new_blend__arS, $blends)
          && ( 1 != 1
              || !$blend__arS
              || $fti_seg['blends'][$grap][$new_blend__arS] >= $grape__cnt
          )
      ) {
        $grape__cnt = $fti_seg['blends'][$grap][$new_blend__arS];
        $fti_sq['wine']['grap']++;
        $exTYPE[] = "$exGRAP, $grape__cnt, $id, $blend__arS, $blend_new__arS";
        $blend__arS = $blend_new__arS;
      }
      if ($arP) {
        $fti_sqr['r8'] = "INSERT INTO nfc_expr_wine__acPU_blend values ($arP, $blend_new__arS)";
      }
      if (!in_array($new_blend__arS, $blends)) {
        if ($grape__dsP == '0') {
          $grape__dsP = $grap;
          $blend__dsP = $blend_new__arS; 
        } else {
          $grape__dsP .= ",#,$grap";
          $blend__dsP .= ",$blend_new__arS"; 
        }
      }
    }
    if (!$exist_blend) {
      $fti_terme = $save_terme;
      $fti_expra = $save_expra;
      $fti_terms = $save_terms;
      $mix__arr = $save_mix__arr;
      $blend_new__arS = 0;
      $grape_new__dsP = '';
    }
  }
  if ($arP && count($exTYPE)) {
    $fti_sqr['r7'] = '';
    $et_i = 0;
    foreach ($exTYPE as $et) {
      $fti_sqr['r7'] .= ($et_i++
          ? "\n,"
          : "INSERT INTO nfc_expr_wine__acPG (expr__eS, word__cnt, wine__id, from__id, to__id) values\n  "
        ) . "  ($et)";
    }
  }
  return $norm_name;
}

function reg_wine($arP = 0) {
  global $fti_var, $fti_sq, $fti_sqr, $fti_expra, $fti_terms, $fti_row, $fti_var, $fti_seg, $fti_exVINE, $mix__arr;
    $exTARA = $fti_var['exTARA'][0];
    if (!$arP) {
      $arP = seg_next_arP(NFC_EXPR__arP);
      $fti_sqr['r1'] = $fti_sq['a1'] . "($arP)";
    }
    reg_wine_attr($arP);
  try {
    extract($fti_row);
    $vine__terms = "";
    if ($vine__id) {
      $exVINE = $fti_exVINE[0];
      $vine__terma = [];
      $vine__arP = $fti_seg['term__id'][$exVINE][$vine__id][TERM_ID_id__arP];
      foreach (explode(',', $vine__term) as $vine__ter_el) {
        $vine__dsP = $fti_seg['expr__arP'][$vine__arP][$vine__ter_el][EXPR__arP_term__dsP];
        foreach ($fti_seg['expr__arP'][$vine__arP] as $term__arP => $arr) {
          if (1 == 1
              && (1 != 1
                  || ($pos = strpos($arr[EXPR__arP_term__dsP], $vine__dsP)) !== false
                  || ($pos = strpos($vine__dsP, $arr[EXPR__arP_term__dsP])) !== false
              )
              && !($pos % FTI_RANG_SZ)
          ) {
            $vine__terma[$term__arP] = $term__arP;
          }
        }
      }
      $vine__terms = implode(',', $vine__terma);
    }
    //d($fti_row, $mix__arr, $vine__terms,$vine__terma, $fti_expra);
    $tara__id = (isset($fti_terms[$exTARA]) ? end($fti_terms[$exTARA]) : 0);
    if ($region != '') {
      $fti_sqr['rA'] =
        "INSERT INTO nfc_expr_wine__acPU_regi
            (wine__arP, regi__id)
          VALUES
            ($arP," . implode("),($arP,", explode(',', $region)) . ")"
      ;
    }
    if (isset($fti_terms[$exTARA])) {
      $tara__id = end($fti_terms[$exTARA]);
      if (!$regi__id) {
        $regi__id = $tara__id;
      }
      if ($region != '') {
        $region .= ",$tara__id";
      } else {
        $region = "$tara__id";
      }
    }
    $sql = $fti_sqr['r3'] =
      "INSERT INTO nfc_expr_wine__arPD
          (arP, wine, vineyard, country, color, co2, vintage__dsP, vintage__ids, blend__dsP, blend_new__arS, grape__dsP, grape_new__dsP, vine__term,
              regi__id, vine__id, term__cnt, term__dsP, regi__dsP, attrTYPE__cnt, attrTYPE__eMB, attrTITLE__cnt, attrTITLE__eMB, grape__cnt, vine__lvl, regi__lvl)
        VALUES
          ($arP, $id, $vineyard, $country, $color, $co2, '$vintage', '$vintage__ids', '$blend__dsP', $blend_new__arS, '$grape__dsP', '$grape_new__dsP', '$vine__terms',
            $regi__id, '$vine__id', $term__cnt, '$term__dsP', '$region', $type__cnt, $attrTYPE__eMB, $title__cnt, $attrTITLE__eMB, $grape__cnt, $vine__lvl, $regi__lvl)
    ";
    if ($countries != '') {
      $fti_sqr['r9'] =
        "INSERT INTO nfc_expr_wine__acPU_tara
            (wine__arP, tara__id)
          VALUES
            ($arP, " . implode("),($arP,", explode(',', $countries)) . ")"
      ;
    }
    //d($fti_sqr, $fti_row, $countries);
    reg_expr();
  } catch (Exception $e) {
    $errs = $e->getMessage();
    $msg = "ErrFTI(reg_wine__P0)sql(" . (isset($sql) ? $sql : '') . "),arP=$arP,wine=(" . ($id ?? 'NULL') . ") $errs";
    dog($msg);
    throw new Exception($msg . (strpos($errs, 'ErrFTI(') === false ? $e->getTraceAsString() : ''));
  }

}

function reg_wines() {
  global $fti_row, $fti_exVINE, $fti_sq;
  dop("Phase 6a - Register all wine name entries.");
  $fti_entry_cnt = 1;
  db_query("SET FOREIGN_KEY_CHECKS=0");
  $rows_number = 0;
  do {
    load_regions();
    load_vineyards();
    load_blends();
    if (!($max_id = db_query("SELECT max(wine) as id from nfc_expr_wine__arPD")->fetchColumn() ?? 0)) {
      db_query("TRUNCATE nfc_expr_wine__acPG");
    }
    $sql = db_query("CALL nfc_expr__asPL_wine_gustosapp($max_id, 0)")->fetchAll(PDO::FETCH_ASSOC);
    dop("Next " . FTI_WINE_BL_20000 . " rows(" . count($sql) . ") wine registration, prior rows number: $rows_number, start id: " . ++$max_id);
    $rows_number = 0;
    foreach ($sql as $fti_row) {
      $rows_number++;
      echo "\r Wine entries=" . $fti_entry_cnt++ . ", ID=" . $fti_row['id'];
      reg_wine();
    }
  } while ($rows_number);
  dop("  6a - 1 - All wine entries: " . db_query("SELECT count(*) from nfc_expr_wine__arPD")->fetchColumn());
  dop("  6a - 2 - REGIs changed: " . $fti_sq['wine']['regi']);
  dop("  6a - 3a - VINEs changed: " . $fti_sq['wine']['vine']);
  dop("  6a - 3b - VINEs linked: " . db_query("SELECT COUNT(*) from nfc_expr_wine__acPG where expr__eS = " . $fti_exVINE[0])->fetchColumn());
  dop("  6a - 4 - GRAPs changed: " . $fti_sq['wine']['grap']);
  dop("  6a - 5 - COLORs changed: " . $fti_sq['wine']['color']);
  dop("  6a - 6 - GO2s changed: " . $fti_sq['wine']['co2']);
  db_query("SET FOREIGN_KEY_CHECKS=1");
  dop("Successful registration.");
}

function nfc_getVar($name = 'zzzzzzzz', $val = '') {
  return (db_query(
    "SELECT substring_index(t1.description, ': ', -1) as val 
      from nfc_type__arP as t1 
      where t1.dsP = '" . (substr($name, 1,4) == 'fti_' ? substr($name, 4) : $name) . "'
  ")->fetchAll()[0]->val ?? $val);
}

function nfc_setVar($name = 'zzzzzzzz', $val = '') {
  $sql =
    "UPDATE nfc_type__arP as t1
      set t1.description = concat(substring_index(t1.description, ': ', 1), ': ', '$val') 
      where t1.dsP = '" . (substr($name, 1,4) == 'fti_' ? substr($name, 4) : $name) . "'
  ";
  //cho "\nsql=$sql\n";
  return (db_query($sql));
}

function reg_region_clear($arP, $id) {
  global $fti_sqr, $fti_seg;
  $fti_sqr['r0'] = [];
  $fti_sqr['r0'][] = "DELETE from nfc_expr__acPU_term where expr__arP = $arP";
  $dups = 0;
  if (isset($fti_seg['regi_dups'][$id])) {
    $dups = 1;
    $to_link__id = $fti_seg['regi_dups'][$id];
    if (count($fti_seg['regi_dupg'][$to_link__id]) < 3) {
      $fti_sqr['r0'][] = "DELETE FROM nfc_expr_regi__arPD_link where regi__id = $to_link__id";
      $dups = 2;
    } else {
      $dups = 3;
      if ($to_link__id == $id) {
        $to_link__id = (($did = key($fti_seg['regi_dupg'][$to_link__id])) != $id ? $did : array_key_last($fti_seg['regi_dupg'][$to_link__id]));
        $fti_sqr['r0'][] = "UPDATE nfc_expr_regi__arPD_link set regi__id = $to_link__id where regi__id = $id";
        $dups = 4;
      }
      $fti_sqr['r0'][] = "DELETE FROM nfc_expr_regi__arPD_link where link__id = $id";
    }
  }
  return $dups;
}

function nfc_update() {
  global $fti_seg, $fti_sq, $fti_sqr, $fti_expra, $fti_gustos_db, $fti_var, $fti_row, $fti_gustos_region_db;
  $exREGI = $fti_var['exREGI'][0];
  $exVINE = $fti_var['exVINE'][0];
  $exGRAP = $fti_var['exGRAP'][0];
  if(!($max__arS = db_query("SELECT max(arS) from nfc_expr_updates__arS")->fetchColumn() ?? 0)) {
    return;
  }
  try {
    $sql_c = "grape";
    $sql_e =
      "SELECT distinct ifnull(s4.tid, 0) as id, ifnull(s2.arP, 0) as arP, ifnull(s3.link__id, 0) as link__id, s4.name
        from nfc_expr_updates__arS as s1
          left join nfc_expr_grap__arPD_link as s3 on s1.action__id in (s3.link__id,s3.grap__id)
          left join nfc_expr__arP as s2 on s2.id in (s3.grap__id, s3.link__id, s1.action__id) and s2.expr__eS = $exGRAP
          left join $fti_gustos_db.taxonomy_term_data as s4 on s4.tid = ifnull(s2.id, ifnull(s3.link__id, ifnull(s3.grap__id, s1.action__id)))
        where 1 = 1
          and s1.arS <= $max__arS
          and s1.source__dsP = '$sql_c'
    ";
    $upds = db_query($sql_e)->fetchAll(PDO::FETCH_ASSOC);
    $score = count($upds);
    if ($score) {
      dog("Phase 3a - Update grapes names entries number: $score");
      $dups = $dels = 0;
      //$dd1 = [];
      foreach ($upds as $fti_row) {
        extract($fti_row);
        if ($id) {
          $dups++;
          $fti_row['expr__eMI'] = 0;
          $dels .= ",$id";
          if ($arP) {
            $fti_sqr['r0'] = [];
            if ($link__id) {
              $fti_sqr['r0'][] = "DELETE FROM nfc_expr_grap__arPD_link where $id in (link__id, grap__id)";
            }
            $fti_sqr['r0'][] =
              "DELETE d1 FROM nfc_expr__acPU_term as d1
                inner join nfc_expr__arP as d2 on d2.arP = d1.expr__arP
                where 1 = 1
                  and d2.id = $id
                  and d2.expr__eS = $exGRAP
            ";
            reg_grape($arP);
          } else {
            reg_grape();
          }
          //$dd1[] = [$fti_sqr, $fti_row];
        }
        db_query("DELETE from nfc_expr_updates__arS where arS <= $max__arS and action__id = $id and source__dsP = '$sql_c'");
      }
      dog("  Ins/Upd $sql_c action__id in ($dels)");
      load_terms();
      link_expr('exGRAP');
    }
    $sql_c = "region";
    $sql_e =
      "SELECT distinct
          s1.action__id as id, ifnull(s2.arP, 0) as arP
        from nfc_expr_updates__arS as s1
          left join nfc_expr__arP as s2 on s2.id = s1.action__id and s2.expr__eS = $exREGI
        where 1 = 1
          and s1.arS <= $max__arS
          and s1.source__dsP = '$sql_c'
    ";
    $upds = db_query($sql_e)->fetchAll(PDO::FETCH_ASSOC);
    $score = count($upds);
    if ($score) {
      dog("Phase 3c - Update regi names entries number: $score");
      $dups = $dels = 0;
      load_regions();
      foreach ($upds as $row) {
        extract($row);
        if (($fti_row = db_query("CALL nfc_expr__asPL_regi_gustosapp(0, $id)")->fetchAll(PDO::FETCH_ASSOC)[0] ?? 0)) {
          $dels .= ",$id";
          //d($fti_row, $upds, $id);
          $fti_row['expr__eMI'] = 0;
          if ($arP) {
            $dups = reg_region_clear($arP, $id);
            reg_region($arP);
          } else {
            reg_region();
          }
        }
        db_query("call nfc_expr_regi__arPD_span__asPL_create()");
        db_query("DELETE from nfc_expr_updates__arS where arS <= $max__arS and action__id = $id and source__dsP = '$sql_c'");
      }
      dog("  Ins/Upd $sql_c action__id in ($dels), dups($dups)");
      load_terms();
      link_regi_hierarchy_flat();
      //link_expr('exREGI');
    }

    $sql_c = "wine";
    $sql_e =
      "SELECT distinct s1.action__id as id, ifnull(s2.arP, 0) as arP
        from nfc_expr_updates__arS as s1
          left join nfc_expr_wine__arPD as s2 on s2.wine = s1.action__id
        where 1 = 1
          and s1.arS <= $max__arS
          and s1.source__dsP = '$sql_c'
    ";
    $upds = db_query($sql_e)->fetchAll(PDO::FETCH_ASSOC);
    //d($fti_row, $upds, $sql_e);
    $score = count($upds);
    if ($score) {
      dog("Phase 3e - Update wine names entries number: $score");
      $dels = '0';
      foreach ($upds as $row) {
        extract($row);
        if (($fti_row = db_query("CALL nfc_expr__asPL_wine_gustosapp(0, $id)")->fetchAll(PDO::FETCH_ASSOC)[0] ?? 0)) {
          $dels .= ",$id";
          //d($fti_row, $upds, $id);
          if ($arP) {
            $fti_sqr['r0'] = [];
            $fti_sqr['r0'][] = "DELETE from nfc_expr_wine__acPG where wine__id = $id";
            $fti_sqr['r0'][] = "DELETE from nfc_expr_wine__arPD where arP = $arP";
            reg_wine($arP);
          } else {
            reg_wine();
          }
        }
        db_query("DELETE from nfc_expr_updates__arS where arS <= $max__arS and action__id = $id and source__dsP = '$sql_c'");
      }
      dog("  Ins/Upd $sql_c action__id in ($dels)");
    }
    // vineyards must be after wines becase vine registraion collect existents of wines for each vine
    $sql_c = "vineyard";
    $sql_e =
      "SELECT distinct s1.action__id as id, ifnull(s2.arP, 0) as arP
        from nfc_expr_updates__arS as s1
          left join nfc_expr__arP as s2 on s2.id = s1.action__id and s2.expr__eS = $exVINE
        where 1 = 1
          and s1.arS <= $max__arS
          and s1.source__dsP = '$sql_c'
    ";
    $upds = db_query($sql_e)->fetchAll(PDO::FETCH_ASSOC);
    $score = count($upds);
    if ($score) {
      dog("Phase 3d - Update vine names entries number: $score");
      $dups = $dels = 0;
      load_vineyards();
      foreach ($upds as $row) {
        extract($row);
        if(($fti_row = db_query("CALL nfc_expr__asPL_vine_gustosapp(0, $id)")->fetchAll(PDO::FETCH_ASSOC)[0] ?? 0)) {
          $dels .= ",$id";
          //d($fti_row, $upds, $id);
          $fti_row['expr__eMI'] = 0;
          if ($arP) {
            $fti_sqr['r0'] = [];
            $fti_sqr['r0'][] = "DELETE from nfc_expr__acPU_term where expr__arP = $arP";
            $fti_sqr['r0'][] = "DELETE from nfc_expr__arP where arP = $arP";
            if (isset($fti_seg['vine_link'][$id])) {
              $dups = 1;
              $to_link__id = $fti_seg['vine_link'][$id];
              if (count($fti_seg['vine_ling'][$to_link__id]) < 3) {
                $fti_sqr['r0'][] = "DELETE FROM nfc_expr_vine__arPD_link where vine__id = $to_link__id";
                $dups = 2;
              } else {
                $dups = 3;
                if ($to_link__id == $id) {
                  $to_link__id = (($did = key($fti_seg['vine_ling'][$to_link__id])) != $id ? $did : array_key_last($fti_seg['vine_ling'][$to_link__id]));
                  $fti_sqr['r0'][] = "UPDATE nfc_expr_vine__arPD_link set vine__id = $to_link__id where vine__id = $id";
                  $dups = 4;
                }
                $fti_sqr['r0'][] = "DELETE FROM nfc_expr_vine__arPD_link where link__id = $id";
              }
            }
            if (isset($fti_seg['vine_dups'][$id])) {
              $to_dups__id = $fti_seg['vine_dups'][$id];
              if (count($fti_seg['vine_dupg'][$to_dups__id]) < 3) {
                $fti_sqr['r0'][] = "DELETE FROM nfc_expr_vine__arPD_dups where vine__id = $to_dups__id";
              } else {
                if ($to_dups__id == $id) {
                  $to_dups__id = (($did = key($fti_seg['vine_dupg'][$to_dups__id])) != $id ? $did : array_key_last($fti_seg['vine_dupg'][$to_dups__id]));
                  $fti_sqr['r0'][] = "UPDATE nfc_expr_vine__arPD_dups set vine__id = $to_dups__id where vine__id = $id";
                }
                $fti_sqr['r0'][] = "DELETE FROM nfc_expr_vine__arPD_dups where dups__id = $id";
              }
            }
            unset_terms($arP);
            reg_vineyard($arP);
          } else {
            reg_vineyard();
          }
        }
        db_query("DELETE from nfc_expr_updates__arS where arS <= $max__arS and action__id = $id and source__dsP = '$sql_c'");
      }
      dog("  Ins/Upd $sql_c action__id in ($dels), dups($dups)");
      load_terms();
      //reg_vineyards_syn();
      link_expr('exVINE');
    }
  } catch (Exception $e) {
    $errs = $e->getMessage();
    $msg = " ErrFTI(nfc_updates__Point_1), segment($sql_c)" . (isset($id) ? ", row_id($id)" : "") . "\n$errs";
    dog($msg);
    throw new Exception($msg . (strpos($errs, 'ErrFTI(') === false ? $e->getTraceAsString() : ''));
  }
}

function nfc_update_arr($class_name, array $arr) {
  //d($class_name, $arr);
  db_query("DELETE FROM nfc_expr_updates__arS");
  $sql = "INSERT INTO nfc_expr_updates__arS (source__dsP, action__eC, action__id) VALUES\n('$class_name','acUpd',"
      . (implode("),\n('$class_name','acUpd',", $arr)) . ")\n";
  db_query($sql);
  nfc_update();
}

function nfc_reg_synonyms_word() {
  global $fti_seg, $fti_seg_next, $fti_seg_start, $fti_seg_mask, $fti_log, $fti_sw_term, $fti_sw_repl,
        $fti_word_1st, $fti_merged_forms, $fti_merged_terms, $fti_var;
  $fti_log = [];
  $fti_merged_forms = 0;
  $merged_base_forms = 0;
  $arP_old = $arP = 0;
  $sql =
    "SELECT t1.acSG as rn, t1.acSG, t2.arS,
        _norm_ii__asFL(t1.form__dsP) as form,
        _norm_ii__asFL(t1.base__dsP) as base,
        t2.word__eDS
      FROM nfc_word__acSG_group as t1
        left join nfc_word__arS_group as t2 on t2.base__dsP = t1.base__dsP
      where t1.form__arP is null
      order by t1.base__dsP, rn
  ";
  dog("Phase 0c - Register all word forms.");
  $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $key = '';
  $FTI_SEP_HIE_len = strlen(FTI_SEP_HIE);
  try {
    db_query("start transaction");
    foreach ($rows as $row) {
      extract($row);
      $sw__TYP = $fti_var[$word__eDS];
      if ($key != $base) {
        $key = $base;
        $merged_base_forms++;
        if (!isset($fti_seg['word']['dsP'][$key])) {
          $arP = reg_word($key, $sw__TYP);
          if (($sw__TYP & $fti_var['word_form__eB'])) {
            $arP_base = $arP & $fti_seg_next;
            $dsP_base = FTI_SEP_HIE . "{$key}";
            $form_len = $fti_seg['word']['arP'][$arP]['len'] + $FTI_SEP_HIE_len;
            db_query("INSERT INTO nfc__arP (arP) values ($arP_base)");
            db_query("INSERT INTO nfc_word__arP(arP, word__eMT, dsP, len) values ($arP_base, $sw__TYP, '$dsP_base', $form_len)");
            $fti_seg['word']['dsP'][$dsP_base] = $arP_base;
            $fti_seg['word']['arP'][$arP_base]['dsP'] = $dsP_base;
            $fti_seg['word']['arP'][$arP_base]['len'] = $form_len;
          }
          $sql = "UPDATE nfc_word__arS_group set base__arP = $arP where arS = $arS";
          db_query($sql);
        } else {
          $arP = $fti_seg['word']['dsP'][$key];
        }
      }
      $fti_merged_forms++;
      if(!isset($fti_seg['word']['dsP'][$form])) {
        $arP_old = reg_word($form, $sw__TYP);
        $sql = "UPDATE nfc_word__acSG_group set orig__arP = $arP_old where acSG = " . $acSG;
        db_query($sql);
      }
    }
    db_query("commit");
    $err1 = db_query(
      "SELECT t1.arS, t1.base__dsP, t2.cnt
        from nfc_word__arS_group as t1
          inner join (
            SELECT min(arS) min__arS, count(*) cnt
              from nfc_word__arS_group 
              where base__arP is null
          ) as t2 on t2.min__arS = t1.arS
    ")->fetchAll();
    if (!empty($err1)) {
      throw new Exception("Err_1 - Bad SynBase_arP for base form(" . $err1[0]->base__dsP . "). Bad number of recs: " . $err1[0]->cnt);
    }
    $err2 = db_query(
      "SELECT t1.acSG, t1.form__dsP, t2.cnt
        from nfc_word__acSG_group as t1
          inner join (
            SELECT min(acSG) min__acSG, count(*) cnt
              from nfc_word__acSG_group 
              where orig__arP is null
          ) as t2 on t2.min__acSG = t1.acSG
    ")->fetchAll();
    if (!empty($err2)) {
      throw new Exception("Err_2 - Bad SynBase_arP for syn form(" . $err2[0]->form__dsP . "). Bad number of recs: " . $err2[0]->cnt);
    }
    $err3 = db_query(
      "SELECT t1.form__dsP 
        from nfc_word__acSG_group as t1 
        where 1=1
          and t1.form__dsP = 'белыи'
          and t1.acSG = (select max(acSG) from nfc_word__acSG_group)
    ")->fetchColumn() ?? '';
    if ($err3 == '') {
      throw new Exception("Err_3 - Bad last SynBase_dsP not equal to 'белыи' stop word");
    }
  } catch (Exception $e) {
    $errs = $e->getMessage();
    db_query("rollback");
    $msg = "ErrFTI(nfc_reg_synonyms_word__P_1),sql($sql),arP(".dechex($arP)."),base($base),form($form),arP_old(".dechex($arP_old).") $errs";
    dog($msg);
    throw new Exception($msg . (strpos($errs, 'ErrFTI(') === false ? $e->getTraceAsString() : ''));
  }
  dog('End forms converting - bEND');
  dog("$merged_base_forms - base forms, $fti_merged_forms - derivate form converted");
  nfc_load_all();
}

function search_terms($search__eMI = 0, $rule__eMI = 0) {
  global $fti_seg, $fti_var, $fti_expra, $mix__arr, $fti_terms, $fti_terme,$fti_row, $fti_fspFormUnstNumb;
  $country__ids = $tara_term = $attr_typ = $fti_expra['found'] = $fti_expra['terms'] = $fti_expra['attr'] = [];
  $mix__arr = $fti_terms = $attr_term = $term_expr_found = [];
  $fti_row['attrTYPE__arS'] = $fti_row['attrTITLE__arS'] = 'NULL';
  if (!$search__eMI || !isset($fti_expra['word'])) return;
  try {
    $exREGI = $fti_var['exREGI'][0];
    $exGRAP = $fti_var['exGRAP'][0];
    $exTARA = $fti_var['exTARA'][0];
    $syGroupAttrType = $fti_var['syGroupAttrType'];
    $syGroupAttrTitle = $fti_var['syGroupAttrTitle']; //0x20000000; //$fti_var['syGroupAttrTitle'];
    $exWINE = $fti_var['exWINE'][0];
    $exVINE = $fti_var['exVINE'][0];
    $wineTYPE = $fti_var['wineTYPE'][0];
    $wineTITLE = $fti_var['wineTITLE'][0];
    $wineTRIG = $fti_var['wineTRIG'][0];
    $syGroupAT = $fti_var['syGroupAT'];
    $syGroupMT = $fti_var['syGroupMT'];
    $syGroupRV = $fti_var['syGroupRV'];
    $syGroupRP = $fti_var['syGroupRP'];
    $syGroupGRP = $fti_var['syGroupGRP'];
    $words =  &$fti_expra['word'];
    $vineyard = (int)($fti_row['vineyard'] ?? 0);
    if (($is_country = isset($fti_row['country']) && ((int)$fti_row['country']))) {
      $country__ids = [$fti_row['country']];    
    }
    if ($search__eMI != $syGroupGRP && isset($fti_row['countries']) && $fti_row['countries'] != '') {
      $country__ids = explode(',', $fti_row['countries']);
    }
    $country__ids = array_flip($country__ids);
    $fti_expra['new__id'] = $country__arPA = $found__cnt = 0;
    if ($country__ids) {
      $country__dsPA = $country__arPA = [];
      foreach ($country__ids as $country__tid => $v) {
        $country__arPA[$country__tid] = $fti_seg['term__id'][$exTARA][$country__tid][TERM_ID_id__arP];
        $country__dsPA[$country__tid] = current($fti_seg['expr__arP'][$country__arPA[$country__tid]])[EXPR__arP_term__dsP];
      }
    }
    $terme_cnt = count($fti_terme) - 1;
    //d($fti_row, $fti_terme, $terme_cnt);
    $term_1st = [];
    for ($j_beg = $j = 0; $j <= $terme_cnt; $j++) {
      $term = $fti_terme[$j];
      $term_old__cnt = count($term);
      $words__dsP = $dsP = '';
      $term_found_AttrExtend = $term_found_AttrType = [];
      //echo "\np.1.j=$j"; print_r($term);
      if (!count($term)) {
        continue;
      }
      foreach ($term as $arP_masked) {
        $dsP .= str_pad(strtoupper(dechex($arP_masked)), FTI_RANG_SZ, '0', STR_PAD_LEFT); 
        $words__dsP .= $fti_seg['word']['arP'][$arP_masked]['dsP'] . ' ';
        if ($fti_seg['word']['arP'][$arP_masked]['eMT'] == $fti_var['fspFormExtAType']) {
          $term_found_AttrExtend[] = $arP_masked;
        }
      }
      //echo "\ns0 - words__dsP($words__dsP), dsP($dsP)\n";
      $dsPA = [$dsP];
      if ($rule__eMI != $exWINE) {
        $term_expr_found = $attr_term = [];
      }
      $dsPA_cnt = count($dsPA);
      //echo "\np1a j=$j, dsP($dsP), words=" . implode(',', $words);
      $found_TITLE = 0;
      for ($dsPA_i = 0; $dsPA_i < $dsPA_cnt; $dsPA_i++) {
        $dsP = $dsPA[$dsPA_i];
        $len__dsP = strlen($dsP);
        foreach ($fti_seg['term'] as $rang => $v__dsP) {
          if ($len__dsP >= $rang) {
            foreach ($v__dsP as $term__dsP => $typa) {
              if (($pos = strpos($dsP, $term__dsP)) !== false && !($pos % FTI_RANG_SZ)) {
                $mix__RV = [];
                $found_word__cnt = $found__cnt = 0;
                $isset__RV = false;
//    var_dump($term__dsP,$dsP, $typa);
                foreach ($typa as $typ_expr => $ids) {
//  echo "\nP2a. dsP=$dsP, term__dsP=$term__dsP, j=$j, typ_expr=$typ_expr, typ_hex=".dechex($typ_expr).", search__eMI_hex=".dechex($search__eMI).",found=".implode(',', (array_map('hexdec', str_split($term__dsP, FTI_RANG_SZ)))); // print_r($ids);
                  if (($typ_expr & $search__eMI)) {
                    if (!$found_word__cnt) {
                      $term_found = array_map('hexdec', str_split($term__dsP, FTI_RANG_SZ));
                      $term_found = array_combine($term_found, $term_found);
                      $found_word__cnt = count($term_found);
                    }
                    if (($typ_expr & $syGroupAttrType)) {
                      $term_found_AttrType += $term_found;
                      $found__cnt |= FTI_FOUND__AType;
                    }
                    $country__tid = $par__arP = current($ids)[TERM_rang_par__arP];
                    foreach ($country__ids as $country__tid => $v) {
                      $country__arP = $country__arPA[$country__tid];
                      if (isset($fti_seg['rule'][$typ_expr][$term__dsP][$country__arP]) && $country__arP == $par__arP) {
                        break;
                      }
                    }
                    $found_term__arP = current($ids)[TERM_rang_term__arP];
                    $fti_expra['terms'][$found_term__arP][$typ_expr] = 0;
                    $fti_expra['found'][$j][$typ_expr] = $found_term__arP;
                    if ($typ_expr == $exTARA) {
                      $tara_term = array_values($term_found);
                      if (!$is_country || ($search__eMI & $syGroupRP) == $syGroupRP) {
                        $fti_row['country'] = current($fti_seg['expr__arP'][key($ids)])[EXPR__arP_term__id];
                      }
                      $found__cnt |= FTI_FOUND__TARA;
                      if ($term_old__cnt == $found_word__cnt && $rule__eMI == $exVINE) {
                        $term_found_AttrType += $term_found;
                      }
                    } 
                    if (1 == 1
                        && (1 != 1
                          || $rule__eMI == $exWINE
                          || !($found__cnt & FTI_FOUND__TARA) // это работает т.к. термы TARA будут проверены раньше термов других классов
                        )
                        && (1 != 1
                          || $rule__eMI != $exVINE
                          || !in_array($typ_expr, [$exREGI, $exGRAP])
                          || $term_old__cnt == $found_word__cnt
                        )
                    ) {
                      $fti_expra['attr'] += $term_found;
                      foreach ($ids as $i => $ids__par) {
                        $id = current($fti_seg['expr__arP'][$i])[EXPR__arP_term__id];
                        $el__id = $ids__par[TERM_rang_el__id];
                        if (($typ_expr & $syGroupAT) && (($rule__eMI & FTI_MASK__CLASS) == ($typ_expr & FTI_MASK__CLASS))) {
                          $bit_flg = 0;
                          if (isset($attr_term[$typ_expr])) {
                            if (!($attr_term[$typ_expr] & $id)) {
                              $attr_term[$typ_expr] |= $id;
                              $bit_flg++;
                            }
                          } else {
                            $attr_term[$typ_expr] = $id;
                            $bit_flg++;
                          }
                          if (isset($term_expr_found[$typ_expr])) {
                            $term_expr_found[$typ_expr] += $term_found;
                          } else {
                            $term_expr_found[$typ_expr] = $term_found;
                          }
                          if ($bit_flg && $rule__eMI == $exWINE && ($search__eMI & $syGroupRP) != $syGroupRP) {
                            if ($typ_expr == $wineTYPE) {
                              $fti_row['type__cnt']++;
                            } elseif ($typ_expr == $wineTITLE) {
                              $fti_row['title__cnt']++;
                            }
                          }
                        }
                        if (1 != 1
                              || $rule__eMI != $exWINE
                              || ($search__eMI & $syGroupRP) == $syGroupRP
                              || !($typ_expr & $syGroupRV)
                              || !$country__ids
                              || (1 == 1
                                      && (1 != 1
                                            || $typ_expr != $exVINE
                                            || !count($fti_seg['term__id'][$exVINE][$id][TERM_ID_tara])
                                            || array_intersect_key($fti_seg['term__id'][$exVINE][$id][TERM_ID_tara], $country__ids)
                                      )
                                      && (1 != 1
                                            || $typ_expr != $exREGI
                                            || (!$is_country && $found_word__cnt > 1)
                                            || isset($country__ids[key($fti_seg['term__id'][$exREGI][$id][TERM_ID_tara])])
                                      )
                                )
                        ) {
                          if (($typ_expr & $syGroupRV) && $search__eMI != $syGroupGRP) {
                            $isset__RV = true;
                            $is_vine = ($typ_expr == $exVINE && $vineyard && $vineyard == $id);
                            if (1 != 1
                                  || !isset($mix__RV[$typ_expr])
                                  || $is_vine
                                  || (1 == 1
                                        && $mix__RV[$typ_expr]['cnt'] != 100
                                        && (1 != 1
                                              || $mix__RV[$typ_expr]['cnt'] < $found_word__cnt
                                              || ($mix__RV[$typ_expr]['cnt'] == $found_word__cnt && $mix__RV[$typ_expr]['el__id'] > $el__id)
                                        )
                                  )
                            ) {
                              $mix__RV[$typ_expr]['id'] = $id;
                              $mix__RV[$typ_expr]['cnt'] = ($is_vine ? 100 : $found_word__cnt);
                              $mix__RV[$typ_expr]['el__id'] = $el__id;
                              $mix__RV[$typ_expr]['term__arP'] = $found_term__arP;
                              $mix__RV[$typ_expr]['term_found'] = $term_found;
                              $found__cnt |= FTI_FOUND__RV;
//  echo "\nP2a-RV";
                            }
                          } else {
                            $fti_terms[$typ_expr][$found_term__arP] = $id;
                            $mix__arr[$typ_expr]['arP'][$id]['term__arP'] = $found_term__arP;
                            $mix__arr[$typ_expr]['arP'][$id]['cnt'] = $found_word__cnt;
                            $mix__arr[$typ_expr]['arP'][$id]['el__id'] = $el__id;
                            $mix__arr[$typ_expr]['term_found'] = $term_found;
                            $found__cnt |= FTI_FOUND__rest;
//  echo "\nP2a-rest";                              
                          }
                          if ($found__cnt && $found__cnt != FTI_FOUND__RV && $typ_expr != $wineTRIG) {
                            if (($typ_expr & $syGroupAttrTitle)) {
                              $found_TITLE++;
                            }
                            $words = array_diff_key($words, $term_found);
                            $terme_diff = array_diff($fti_terme[$j], array_values($term_found));
                            if (1 == 1
                                  && $rule__eMI != $exWINE
                                  && !($typ_expr & $syGroupAttrType)
                                  && (1 != 1
                                      || !$terme_diff
                                      || $terme_diff != array_values($term_found_AttrType)
                                  )
                            ) {                                
                              $fti_terme[$j] = $terme_diff;
                            }
                          }
                        }
                      }
                    }
                  }
                }
                if ($isset__RV) {
//  echo "\nP2a-delete words, found_term__arP=$found_term__arP";// print_r($mix__RV);
                  $found__cnt |= FTI_FOUND__RV;
                  $words = array_diff_key($words, $term_found);
                  $isset__RV = false;
                }
//  echo "\nP2b"; if (($id??0)) echo " j=$j, id=$id, el__id=$el__id, dsP($dsP), typ_expr($typ_expr), found__cnt($found__cnt), terme=" . implode(',', $fti_terme[$j]) . ", words=" . implode(',', $words) . ", found=" . implode(',', $term_found); print_r($mix__arr);
                if ($found__cnt) {
                  if (($found__cnt & FTI_FOUND__RV)) {
                    $typ_arr = (isset($mix__RV[$exREGI]) ? [0 => $exREGI] : []) + (isset($mix__RV[$exVINE]) ? [1 => $exVINE] : []);
                    foreach ($typ_arr as $typ_expr) {
                      $id = $mix__RV[$typ_expr]['id'];
                      if (1 == 1
                          && isset($mix__arr[$typ_expr])
                          && ($key_mix = key($mix__arr[$typ_expr]['arP'])) != $id
                          && ($search__eMI & $syGroupRP) != $syGroupRP
                      ) {
                        if (1 == 1
                            && $mix__arr[$typ_expr]['arP'][$key_mix]['cnt'] != 100
                            && (1 != 1
                                || $mix__arr[$typ_expr]['arP'][$key_mix]['cnt'] < $mix__RV[$typ_expr]['cnt']
                                || (1 == 1
                                    && $mix__arr[$typ_expr]['arP'][$key_mix]['cnt'] == $mix__RV[$typ_expr]['cnt']
                                    && $mix__arr[$typ_expr]['arP'][$key_mix]['el__id'] > $mix__RV[$typ_expr]['el__id']
                                )
                            )
                        ) {
                          if ($found__cnt == FTI_FOUND__RV) {
                            $words += $mix__arr[$typ_expr]['term_found'];
                          }
                          unset($mix__arr[$typ_expr]);
                          unset($fti_terms[$typ_expr]);
                        } else {
                          $found_term__arP = 0;
                          $words += $term_found;
                        }
                      }                      
                      if ($found_term__arP) {
//  echo "\nP2c old_term__arP=".(isset($mix__arr[$typ_expr]['arP'][$id])?$mix__arr[$typ_expr]['arP'][$id]['term__arP']:'').", typ_expr=$typ_expr, id=$id, found_term__arP=$found_term__arP";
                        if (isset($mix__arr[$typ_expr]['arP'][$id])) {
                          $mix__RV[$typ_expr]['cnt'] = 100;
                          $mix__arr[$typ_expr]['arP'][$id]['term__arP'] .= ",$found_term__arP";
                        } else {
                          $mix__arr[$typ_expr]['arP'][$id]['term__arP'] = $found_term__arP;
                        }
                        $found_term__arP = $mix__RV[$typ_expr]['term__arP'];
                        $fti_terms[$typ_expr][$found_term__arP] = $id;
                        $mix__arr[$typ_expr]['arP'][$id]['cnt'] = $mix__RV[$typ_expr]['cnt'];
                        $mix__arr[$typ_expr]['arP'][$id]['el__id'] = $mix__RV[$typ_expr]['el__id'];
                        $mix__arr[$typ_expr]['term_found'] = $mix__arr[$typ_expr]['arP'][$id]['term_found'] = $mix__RV[$typ_expr]['term_found'];
                      }
                    }
                  }
                  if ($pos) {
                    $dsPA[] = substr($dsP, 0, $pos);
                    $dsPA_cnt++;
                    $dsP = substr($dsP, $pos);
                  }
                  $dsP = strtr($dsP, [$term__dsP => '']);
                  $len__dsP = strlen($dsP);
                  if (!$len__dsP) {
                    break 2; // next $fti_terme
                  }
                }
              }
            }
          }
        }
      }
// echo "\nP3.j=$j, j_beg=$j_beg, terme_cnt=$terme_cnt,  term_found_AttrType=" . implode(',', $term_found_AttrType).", search__eMI=$search__eMI, tfAT_cnt=".count($term_found_AttrType) . ", ft_cnt=".count($fti_terme[$j]); if ($j == -1) dd($fti_terme);
      if ($rule__eMI != $exWINE) {
        $j_curr = $j;
//  echo "\nP4a.j_curr=$j_curr, j_beg=$j_beg, terme_cnt=$terme_cnt,  found_TITLE=$found_TITLE, terme[$j]=" . implode(',', $fti_terme[$j]).", Extend=" . implode(',', $term_found_AttrExtend);
// var_dump($fti_terme, $term_found_AttrType);
        if (($curr_term__cnt = count($fti_terme[$j]))) {
          if ($curr_term__cnt == 1) {
            $j__arP = current($fti_terme[$j]);
            if ($fti_seg['word']['arP'][$j__arP]['len'] == 1) {
              $fti_terme[$j] = [];
              $curr_term__cnt = 0;
              if (isset($fti_var['fspBaseUnstDigit__arP'][$j__arP])) {
                $term_found_AttrType += [$j__arP => $j__arP]; // add single digit to next term as for AttrType
                $curr_term__cnt++; // correction just for next condition ($term_found_AttrType_cnt == $curr_term__cnt)
              }
            }
          }
          if (1 == 1
                && ($term_found_AttrType_cnt = count($term_found_AttrType)) == $curr_term__cnt
                && (1 != 1
                      || ($found__cnt & FTI_FOUND__TARA)
                      || !count($term_found_AttrExtend)
                      || $term_found_AttrType_cnt == 1
                )
          ) {
            // move term with only syGroupAttrType words to next or previus term. Eliminate terms with only syGroupAttrType contetent
            if ($j == $j_beg) {
              if ($j != $terme_cnt && $fti_terme[$j] != $fti_terme[$j + 1]) {
                $term_1_merge = ($fti_terme[$j + 1] ? $fti_terme[$j + 1] : $term_1st);
                array_splice($fti_terme, $j, 0, [array_merge($term_found_AttrType, $term_1_merge)]);
                $fti_terme[$j + 1] = array_merge($term_1_merge, $term_found_AttrType);
                $fti_expra['new__id'] += 2;
                $j_beg += 2;
                $terme_cnt++;
                $j += 2;
              } else {
                $fti_terme[$j] = [];
                if ($j == $terme_cnt) {
                  $curr_term__cnt = 0;
                } else {
                  $j++;
                }
              }
            } else {
              $term_1_merge = ($fti_terme[$j_beg] ? $fti_terme[$j_beg] : $term_1st);
              array_splice($fti_terme, $j, 0, [array_merge($term_found_AttrType, $term_1_merge)]);
              $fti_terme[$j + 1] = array_merge($term_1_merge, $term_found_AttrType);
              $terme_cnt++;
              $j++;
            }
          } else {
            $term_fount_single = [];
            foreach ($fti_terme[$j] as $j__arP) {
              if ($fti_seg['word']['arP'][$j__arP]['len'] == 1 && !isset($fti_var['fspBaseUnstDigit__arP'][$j__arP])) {
                $term_fount_single += [$j__arP => $j__arP];
                $term_found_AttrType_cnt++;
              }
            }
            $term_found_AttrExtend__cnt = 0;
            if ($term_found_AttrType_cnt && ($terme_diff = array_diff($fti_terme[$j], $term_found_AttrType))) {
              $j__arP = current($terme_diff);
              if (1 != 1
                  || count($terme_diff) != 1
                  || (1 == 1
                      && $fti_seg['word']['arP'][$j__arP]['len'] != 1
                      && ($fti_seg['word']['arP'][$j__arP]['eMT'] & $fti_var['fspFormUnstSyn']) != $fti_var['fspFormUnstSyn']
                      && !isset($fti_seg['fspBaseStopWord__arP'][$j__arP])
                  )
              ) {
                if (array_values($terme_diff) != array_values($tara_term)) {
                  array_splice($fti_terme, ++$j, 0, [$terme_diff]);
                  $term_found_AttrExtend__cnt++;
                  if ($term_fount_single) {
                    $terme_diff = array_diff($terme_diff, $term_fount_single);
                    array_splice($fti_terme, ++$j, 0, [$terme_diff]);
                    $term_found_AttrExtend__cnt++;
                  }
                }
                //dd($j__arP, $fti_terme, $fti_row, $terme_diff,$term_found_AttrExtend,array_merge($terme_diff,$term_found_AttrExtend));
              }
            }
            if (count($term_found_AttrExtend) && $rule__eMI == $exVINE) {
              $terme_diff = array_diff($fti_terme[$j], $term_found_AttrExtend);
              array_splice($fti_terme, ++$j, 0, [$terme_diff]);
              array_splice($fti_terme, ++$j, 0, [array_merge($terme_diff,$term_found_AttrExtend)]);
              array_splice($fti_terme, ++$j, 0, [array_merge($term_found_AttrExtend,$terme_diff)]);
              $term_found_AttrExtend__cnt += 2;
            }
            $terme_cnt += $term_found_AttrExtend__cnt;
            if ($j == ($j_beg + $term_found_AttrExtend__cnt)) {
              $fti_expra['new__id'] += $term_found_AttrExtend__cnt;
            }
          }
        }
        if ((!$terme_cnt || $found_TITLE) && $curr_term__cnt != count($term)) {
          if ($curr_term__cnt == 1 && $fti_seg['word']['arP'][current($fti_terme[$j_curr])]['len'] == 1) {
            $fti_terme[$j_curr] = $term;
          } else {
            if (!$curr_term__cnt) {
              if ($j_curr == $j_beg && $j_beg != $terme_cnt) {
                //$terme_cnt++;
                $j_beg++;
                //$j++;
              }
              $term = array_merge($term, $fti_terme[$j_beg]);
            }
            if ($found_TITLE && ($term_found_AttrType_cnt ?? 0)) {
              $terme_diff = array_diff($term, $term_found_AttrType);
              array_splice($fti_terme, $j++, 0, [$terme_diff]);
              $terme_cnt++;
              if (($j - 1) == $j_beg) {
                $fti_expra['new__id'] += 2;
              }
            }
            array_splice($fti_terme, $j++, 0, [$term]);
            $terme_cnt++;
            if (($j - 1) == $j_beg) {
              $fti_expra['new__id']++;
            }
          }
        } elseif(!$term_1st) {
          $term_1st = $term;
        }
        if ($terme_cnt > 0 && count($fti_terme[$j_curr]) == 1 && $fti_seg['word']['arP'][current($fti_terme[$j_curr])]['eMT'] == $fti_fspFormUnstNumb) {
          $fti_terme[$j_curr] = [];
        }        
//  echo "\nP4b.j=$j, j_beg=$j_beg, curr_term__cnt=$curr_term__cnt, terme[$j_curr]=" . implode(',', $fti_terme[$j_curr]) . ", term=" . implode(',', $term) . (($j-1) <= $j_beg ? "" : ", terme[$j-1]=" . implode(',', $fti_terme[$j-1]));
// var_dump($fti_terme, $term_found_AttrType);
        //d($terme_cnt, $fti_terme);
      }
      if (count($attr_term)) {
        foreach ($attr_term as $typ => $attr__eMB) {
          if ($rule__eMI != $exWINE && !isset($fti_seg['attr__arS'][$typ][$attr__eMB])) {
            if (!isset($term_expr_found[$typ])) {
              continue;
            }
            ksort($term_expr_found[$typ]);
            $arPA = reg_term($term_expr_found[$typ]);
            $arP = $arPA[REG_TERM_arP];
            if (isset($fti_seg['attr_term'][$typ][$arP])) {
              $attr__eMB = $fti_seg['attr_term'][$typ][$arP];
            } else {
              $fti_expr__arP = $fti_var["expr__arP"];
              db_query("START TRANSACTION");
              $attr__arS = db_query("SELECT max(arS) + 1 from nfc_expr_attr__arS FOR UPDATE")->fetchColumn();
              $expr__arP = db_query("SELECT seg_next from nfc_type_segments__arPD where segment__arP = $fti_expr__arP FOR UPDATE")->fetchColumn();
              db_query("UPDATE nfc_type_segments__arPD set seg_next = seg_next + 1 where segment__arP = $fti_expr__arP");
              db_query("INSERT INTO nfc__arP values ($expr__arP)");
              $sql_sd =
                "INSERT into nfc_expr_attr__arSD
                    (arSD, attr__eSI, attr__eMB, expr__arP)
                  values ($attr__arS, $typ, $attr__eMB, $expr__arP)";
              //d($sql_sd);
              $sql_s =
                "INSERT INTO nfc_expr_attr__arS
                    (arS, " . ($fti_var['attr__eS'][$fti_var['expr__eS'][$typ][0]][0]) . "__arSD)
                  values ($attr__arS, $attr__arS)
              ";
              //d($sql_sd,$sql_s, $typ, $fti_var['attr__eS'], $fti_var['expr__eS']);
              db_query("INSERT INTO nfc_expr__acPU_term values ($expr__arP, 0, $arP)");
              db_query($sql_sd);
              db_query($sql_s);
              db_query("COMMIT");
              $fti_seg['attr_term'][$typ][$arP] = $attr__eMB;
              $fti_seg['attr__arS'][$typ][$attr__eMB] = $attr__arS;
              $fti_seg['attr__arP'][$typ][$attr__eMB] = $arP;
              $fti_seg['term'][$arPA[REG_TERM_rang]][$arPA[REG_TERM_dsP]][$typ][$attr__arS] = [0, 0, $arP];
              $fti_seg['term__id'][$typ][$attr__eMB][TERM_ID_id__arP] = $attr__arS;
              $fti_seg['attr__arSD'][$attr__arS] = [$arP];
              $fti_seg['expr__arP'][$attr__arS][$arP] = [
                EXPR__arP_term__id => $attr__eMB,
                EXPR__arP_term__dsP => $arPA[REG_TERM_dsP],
                EXPR__arP_term__typ => $typ,
                EXPR__arP_par__arP => 0
              ];
            }
          }
          $mix__arr[$typ]['attr__eMB'] = $attr__eMB;
          //d($fti_row, $fti_expra, $mix__arr, $typ, $syGroupAttrType, $typ & $syGroupAttrType, $attr_typ, $attr__eMB);
          if ($rule__eMI != $exWINE) {
            $attr_typ[$typ & $syGroupAttrType][$typ] = $fti_seg['attr__arS'][$typ][$attr__eMB];
          }
        }
      }
    }
    //d($fti_row);
    foreach ($fti_terms as $typ => $ids) {
      $ids = array_flip($ids);
      ksort($ids);
      $mix__arr[$typ]['dsP'] = implode(',', array_keys($ids));
    }
    if ($rule__eMI != $exWINE) {
      foreach ($attr_typ as $syGroupAttr => $typs) {
        $attr__cnt = count($typs);
        $atrrROW = 'attr' . ($syGroupAttr ? 'TYPE' : 'TITLE') . '__arS'; // attrTYPE__arS or attrTITLE__arS
        if ($attr__cnt) {
          //if (isset($fti_row['rule__id']) && $fti_row['rule__id'] == 198531) dd($fti_row, $attr__typ,$attr__cnt, $mix__arr, $fti_expra, $fti_terms, $fti_terme);
          if ($attr__cnt > 1) {
            $attr__acSD = 0;
            $attr__arSD = [];
            $REGI_attr = $VINE_attr = $WINE_attr = 0;
            foreach ($typs as $typ => $arS) {
              $attr__arSD[] = $fti_seg['attr__arSD'][$arS][0];
              // not main group (TYPE+TITLE) of attr, then it determined by 0xF0000000 group of bits
              switch ($typ & $syGroupMT) {
                case FTI_WINE:
                  $WINE_attr = $arS;
                  $shift = 0;
                  break;
                case FTI_VINE:
                  $VINE_attr = $arS;
                  $shift = 16;
                  break;
                case FTI_REGI:
                  $REGI_attr = $arS;
                  $shift = 32;
                  break;
                default:
                  dd("search_terms_e2 - bad attr type found (not for REGI/VINE/WINE) typ($typ), last byte=" . str_pad(dechex($typ & $syGroupMT), 2, '0', STR_PAD_LEFT));
              }
              $attr__acSD += ($arS << $shift);
            }
            if (!isset($fti_seg['attr__acSD'][$attr__acSD])) {
              $sql_i =
              "INSERT INTO nfc_expr_attr__arS
                  (REGI__arSD, VINE__arSD, WINE__arSD)
                values ($REGI_attr, $VINE_attr, $WINE_attr)
              ";
              //if (isset($fti_row['rule__id']) && $fti_row['rule__id'] > 192996) dd($sql_i, $fti_row, $attr__typ, $attr__typ_A,$attr__cnt, $mix__arr, $fti_expra, $fti_terms, $fti_terme);
              db_query($sql_i);
              $arS = db_query("SELECT LAST_INSERT_ID()")->fetchColumn();
              $fti_seg['attr__acSD'][$attr__acSD] = $arS;
              $fti_seg['attr__arSD'][$arS] = $attr__arSD;
            }
            $fti_row[$atrrROW] = $fti_seg['attr__acSD'][$attr__acSD];
          } else {
            $fti_row[$atrrROW] = current($typs);
            //d($fti_row, $attr__typ,$attr__cnt, $mix__arr, $fti_expra, $fti_terms, $fti_terme);
          }
        }
      }
    }
    foreach ($fti_expra['found'] as $found__j => $found_typs) {
      foreach ($found_typs as $found_typ => $found_val) {
        if (($found_typ & $syGroupAT) && isset($attr_typ[$found_typ])) {
          $fti_expra['found'][$found__j][$found_typ] = $attr_typ[$found_typ];
        }
      }
    }
  } catch (Exception $e) {
    $errs = $e->getMessage();
    //d($errs, $country__ids, $is_country, $fti_row);
    throw new Exception($errs . $e->getTraceAsString());
  }
}

function nfc_match($wine_mix, $score__arS = 0, $sq_mode = 0, $match_threshold = 0, $version = 5, $limit = 1) {
  global $fti_sq, $fti_row, $fti_log, $fti_scnRaNAM, $fti_gustos_db, $fti_var, $fti_seg;
  $inp_score__arS = $score__arS;
  if (!isset($fti_var)) {
    nfc_loadClass();
    load_terms();
    load_attributes();
    load_blends();
  }
  if (!$match_threshold) {
    $match_threshold = $fti_var['match_threshold'];
  }
  if ($version == 5) {
    $vers__dsP = "RaFTI.v" . nfc_getVar('version', '0');
  } else {
    $vers__dsP = "MySQL.FTI";
  }
  $sq_r7 =
    "INSERT into nfc_score__arS
        (limit_dst, description__dsP, mode__niSB)
      VALUES($limit, 'nfc_match - ver: $vers__dsP', $sq_mode)
  ";
  $sq_r8 =
    "INSERT INTO nfc_score__acSG_wine
        (score__arS, pw_wine, pw_vintage, gw_wine, gwe_vintage, gwe_id, score__niBO, limit__niBQ, action__dsP)
      VALUES"
  ;
  try {
    nfc_update();
    if ($score__arS) {
      $arS = $score__arS - ($sq_mode == 2 ? 1 : 0);
      $sql =
        "SELECT
            a1.score__arS, a1.id, a1.gustos_wine_id, a1.grape__dsP, a1.grape__cnt, a1.name, a1.grape_type, a1.region, a1.country,
            a1.color, a1.co2, a1.vineyard, a1.status, a1.vintage,
            if(a4.action = 'NEW_WINE', a5.wine, 0) as gw_wine, a5.wine as aw_wine
          FROM nfc_expr__asVS_wine_parsedwine_normWID as a1
            inner join nfc_score__acSG_ids as a2 on a2.score__arS = $arS and a2.id = a1.id
            left join (
              select max(b1.id) as max_id, b1.wine_id
              from wines_actions as b1
                inner join nfc_score__acSG_ids as b2 on b2.score__arS = $arS and b2.id = b1.wine_id
              group by b1.wine_id
            ) as a3 on a3.wine_id = a1.id
            left join wines_actions as a4 on a4.id = a3.max_id
            left join $fti_gustos_db.gustos_wine_entity as a5 on a5.id = a4.gustos_vintage_id
            where a5.id is not null
        ";
        $limit2 = 1;
        $wine_cnt = $wine_mix;
    } else {
      db_query($sq_r7);
      $inp_score__arS = $score__arS = db_query("SELECT LAST_INSERT_ID()")->fetchColumn();
      if (is_array($wine_mix)) {
        $wine_str = "($score__arS," . (implode("),($score__arS,", $wine_mix)) . ")";
        $wine_cnt = count($wine_mix);
        $limit2 = 9;
      } else {
        $limit2 = 9;
        $wine_cnt = 1;
        $wine_str = "($score__arS, $wine_mix)";
      }
      db_query("INSERT into nfc_score__acSG_ids values $wine_str");
      $sql =
        "SELECT
            score__arS, id, gustos_wine_id, grape__dsP, grape__cnt, `name`, grape_type, region, country,
            color, co2, vineyard, `status`, vintage, 0 as gw_wine, 0 as aw_wine
          FROM nfc_expr__asVS_wine_parsedwine_normWID
          where score__arS = $score__arS
        ";
    }
    $tm_start = time();
    dog("Phase 7a - Score($score__arS) sq_mode($sq_mode) type $vers__dsP for $wine_cnt number wines start at: " . date('d m Y H:i:s', $tm_start));
  } catch (Exception $e) {
    $errs = $e->getMessage();
    $msg = "ErrFTI(nfc_match__P_1)wine_str=($wine_str) $errs";
    dog($msg);
    throw new Exception($msg . (strpos($errs, 'ErrFTI(') === false ? $e->getTraceAsString() : ''));
  }
  try {
    $name = '';
    $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
    //d($sql, $rows);
    foreach ($rows as $fti_row) {
      if ($version != 5) {
        if (isset($fti_row['vineyard']) && $fti_row['vineyard']) {
          $fti_row['PRODUCER_FULL'] = db_query("SELECT `name` from $fti_gustos_db.vineyard where id = " . $fti_row['vineyard'])->fetchColumn();
        }
        extract($fti_row);
        nfc_match_create_sql__MySqlFTI();
      } else {
        reg_wine_attr(0, $sq_mode);
        extract($fti_row);
        nfc_match_create_sql__raFTI_v5($limit2, $sq_mode, $gw_wine, $aw_wine);
      }
      //echo "\n\n" . $fti_sq['match_r0']; exit;
      $results = db_query($fti_sq['match_r0'])->fetchAll(PDO::FETCH_ASSOC);
      //d($results);
      $sq_r2 = $sq_r8;
      if ($results) {
        //echo "\n" . $fti_sq['match_r0'] . "\n"; dd($fti_row, $sql1);
        foreach ($results as $i => $result) {
          extract($result);
          if ($sc_exe) {
            if ($score >= 0) {
              $limt__niBQ = round(intdiv($score, $sc_base * 100) * 100 / $sc_exe);
              //$limt__niBQ = round($score / $sc_base / $sc_exe);
            } else {
              $sc_base_100 = $sc_base * 100;
              $limt__niBQ = 0;
              $score = $score - ($sc_base_100 + ($score % $sc_base_100)) * 2;
            }
          } else {
            $limt__niBQ = 0;
          }
          $gwea_vintage = array_combine(explode(',', $vintage__dsP), explode(',', $vintage__ids));
          if ($limt__niBQ >= $match_threshold && $vintage__ids) {
            //echo "\npw_id=$id, gw_id=$wine, vintage__dsP=$vintage__dsP, vintage__ids=$vintage__ids";
            if (isset($gwea_vintage[$vintage])) {
              $gwe_vintage = $vintage;
              $gwe_id = $gwea_vintage[$vintage];
              $action = 'MERGE_SELECT';
            } else {
              $gwe_vintage = array_key_last($gwea_vintage);
              $gwe_id = end($gwea_vintage);
              $action = 'NEW_VINTAGE';
            }
          } else {
            $action = 'NEW_WINE';
            $gwe_vintage = array_key_last($gwea_vintage);
            $gwe_id = end($gwea_vintage);
          }
          $sq_r2 .= ($i ? ',' : '')
          . "\n($inp_score__arS, $id, $vintage, $wine, " . ($gwe_vintage == '' ? 0 : $gwe_vintage) . ", $gwe_id, $score, $limt__niBQ, '$action')";
        }
        //echo "\n\n$sq_r2\n\n"; //exit;
        db_query($sq_r2);
      }
    }
  } catch (Exception $e) {
    // echo "\n\n" . (isset($fti_sq['match_r0']) ? $fti_sq['match_r0'] : "");
    $errs = $e->getMessage();
    $msg = "ErrFTI(nfc_match__P_2)name=($name) sc_exe(" . ($sc_exe ?? 0) . ") score(". ($score ?? -100) .") sql(\n" . (isset($sq_r2) ? $sq_r2 : $sql)
        . (isset($fti_sq['match_r0']) ? $fti_sq['match_r0'] : '') . "\n), err($errs)"; // . $e->getTraceAsString();
    //d($fti_row, $msg);
    dog($msg);
    throw new Exception($msg . " sql(" . (isset($sq_r2) ? $sq_r2 : $sql. ")")
                             . (strpos($errs, 'ErrFTI(') === false ? $e->getTraceAsString() : ''));
  }
  if ($sq_mode != 3) {
    db_query("DELETE FROM nfc_score__acSG_ids where score__arS = $inp_score__arS");
  }
  $tm_end = time();
  dog("Phase 4b - Score type $vers__dsP ended at: " . date('d m Y H:i:s', $tm_end)
    . ", dur.: " . date('H:i:s', ($tm_end-$tm_start-3600*3)) . ", limit: $limit");
  return db_query(
    "SELECT
        score__arS as score__arP,
        pw_wine as parsedwine_id, pw_vintage,
        gw_wine, gwe_vintage,
        gwe_id as wine_entity_id,
        (score__niBO * 1000) + limit__niBQ as score__niBQ, limit__niBQ, action__dsP
      from nfc_score__acSG_wine 
      where score__arS = $score__arS
  ")->fetchAll();
}

function nfc_match_create_sql__MySqlFTI() {
  global $fti_gustos_db, $fti_sq, $fti_row;
  $result_limit = 1;
  extract($fti_row);
  $wine_name = strtr($name, ["'" => "''", "\\" => "\\\\"]);
  $producer__dsP = (isset($vineyard_type) && $vineyard_type != '' ? strtr($vineyard_type, ["'" => "''", "\\" => "\\\\"]) : $wine_name);
  $where_country = '';//(isset($country) && $country ? "\nwhere gw.country = " . $country : "");
  $color = (isset($color) ? $color : 0);
  $co2 = (isset($co2) ? $co2 : 0);
  $sc_base = 10000000;
  $fti_sq['match_r0'] =  
    "SELECT
      if (rel0 = 0 or match_wine_name_score > 40, round(match_wine_name_score * 50) * 10000 + 2, 20000001)
        + round(match_vineyard_name_score * 50) * 10000 + if(match_vineyard_name_score > 0, 800, 0)
        + if(b1.color = 0 or $color = 0, 0, if(b1.color = $color, $sc_base * 2 + 400, -$sc_base * 2))
        + if(b1.co2 = 0 or $co2 = 0, 0, if(b1.co2 = $co2, $sc_base * 2 + 200, -$sc_base * 2))
      as score,
      0 as state__niBQ,
      b1.w_id as wine, b1.w_name as nfc_gustos_wine_name,
      b1.v_id as nfc_gustos_vineyard_id, b1.v_name as nfc_gustos_vineyard_name,
      0 as sc_exe, 0 as sc_base
    from (
      select v.id as v_id, v.name as v_name, gw.id as w_id, gw.name as w_name,
        gw.name = '$wine_name' as rel0,
        MATCH (gw.name) AGAINST ('$wine_name') AS match_wine_name_score,
        MATCH (v.name) AGAINST ('$producer__dsP') AS match_vineyard_name_score,
        cast(substring_index(gw.category, '\"co2\":', -1) as int) co2,
        gw.color
      from $fti_gustos_db.gustos_wine as gw
        inner join $fti_gustos_db.vineyard as v on v.id = gw.vineyard $where_country
    ) b1
    where 1<>1
      or rel0 = 1
      or match_wine_name_score
      or match_vineyard_name_score
    order by score desc
    limit $result_limit
  ";
  return;
}

function nfc_match_create_sql__raFTI_v5($sq_limit = 1, $sq_mode = 0, $gw_wine = 0, $aw_wine = 0) {
  global $fti_var, $fti_terme, $fti_terms, $fti_expra, $fti_gustos_db, $mix__arr, $fti_sq, $fti_seg, $fti_row;
  $exTARA = $fti_var['exTARA'][0];
  extract($fti_row);
  $vintage = $vintage ?? 0;
  $sc_limit = $sc_base = 10000000;
  $sc_base *= 100;
  $vineyard = ($vineyard ?? 0);
  $grape__dsP = strtr($grape__dsP, [',#,' => ',']);
  $tara__id = $count_blend_new = $sc_exe = $word__cnt = $grap__cnt = $attr__cnt = 0;
  //d($fti_row);
  $count_blend = $count_grapes = $count_term = '';
  if ($term__cnt) {
    $word__cnt += $term__cnt;
    foreach ($fti_expra['word'] as $word) {
      $count_term .= "+if(FIND_IN_SET($word, b1.term__dsP)>0,1,0)";
    }
  }
  if (($attr__cnt = $type__cnt + $title__cnt)) {
    $word__cnt += $attr__cnt;
    $count_type = "BIT_COUNT($attrTYPE__eMB & b1.attrTYPE__eMB)";
    $count_title = "BIT_COUNT($attrTITLE__eMB & b1.attrTITLE__eMB)";
  }  
  $sc_co2 = $sc_color = 6;
  $sc_regi = 5;
  $sc_vine = 6;
  $sc_words = 3;
  $sc_title = $sc_type = 3;
  $sc_blend = 5;
  $lvl_max = 2;
  $sc_name = 2;
  $sc_names = $sc_name * 3;
  $sc_ext = 3;
  $sq_calc = $sq_where_country = $sq_join = $sq_where_sum = '';
  if (isset($fti_terms[$exTARA])) {
    $sc_regi++;
    $tara__id = end($fti_terms[$exTARA]);
    $sq_calc .= ",
      if(FIND_IN_SET($tara__id, b1.regi__dsP) = 0, 0, 1) as sc_tara"
    ;
  } else {
    $tara__id = 0;
    $sq_calc .= ",
      0 as sc_tara"
    ;
  }
  $sc_sum = $sc_co2 + $sc_color + $sc_regi + $sc_vine + $sc_ext + $sc_type + $sc_title + $sc_blend + $sc_names;
  $sq_fields1 =
    "b1.arP, b1.wine, b1.vineyard, b1.term__cnt, b1.grape__dsP, b1.grape_new__dsP, b1.country, b1.regi__id, b1.vine__id, (b1.attrTITLE__eMB & 7) as sc_colEMB"
  ;
  $sq_fields2 =
    "b1.color, b1.co2, b1.vintage__dsP, b1.vintage__ids, b1.regi__dsP, b1.blend__dsP, b1.blend_new__arS, b1.grape__cnt, b1.regi__lvl, b1.vine__lvl, b1.vine__term"
  ;
  if ($sq_mode == 2) {
    $sq_where_country = "
      WHERE 1 = 1
        and b1.wine = $aw_wine"
    ;
  } else {
    $sq_where_country = "
      where 1 = 1"
         . ($gw_wine
            ? "
        and b1.wine <> $gw_wine"
            : ""
         ) 
    ;
  }
  if ($countries != '') {
    if ($country) {
      $countries .= ",$country";
    }
    $sq_where_country .= "
        and b1.country in ($countries)"
    ;
  } elseif ($country) {
    $sq_where_country .= "
        and b1.country = $country"
    ;
  }
  $sq_from = "nfc_expr_wine__arPD";
  $sq_words = ",
      -LEAST(LEAST(b1.term__cnt, $sc_words), $sc_ext) as sc_words"
  ;
  $sq_attr = ",
      -LEAST(b1.attrTYPE__cnt, $sc_type) as sc_type, 0 as sc_title"
  ;
  $sq_blend = ",
      0 as sc_blend, if(b1.blend_new__arS = 0, 0, -1) as sc_blend_new"
  ;
  if ($region != '') {
    $regi__to_id = '';
    foreach (explode(',', $region) as $sc_regi_id) {
      $regi__to_id .= ($regi__to_id == '' ? '' : ',') . ($fti_seg['regi_dups'][$sc_regi_id] ?? $sc_regi_id);
    }
    $sc_exe += $sc_regi;
    $sq_where_sum .= "
        + if(ifnull(b5.regi__id, ifnull(b4.regi__id, 0)) in ($regi__to_id), $sc_ext, 0)"
    ;
    if ($regi__id) {
      $sc_exe += $sc_name;
      $sq_calc .= ",
      if(b4.regi__id is null,
          0, if(if(b1.regi__id = 0 or $tara__id <> 0, b4.regi__id, b1.regi__id) in ($region),
                $sc_regi, if(b5.regi__id in ($regi__to_id), $sc_ext, -$sc_ext
      ))) as sc_regi,
      if(b4.regi__id is null, -1, if(if(b1.regi__id = 0 or $tara__id <> 0, b4.regi__id, b1.regi__id) in ($region),
          $sc_name, if(b5.regi__id in ($regi__to_id), 1, -1
      ))) * if(b1.regi__id = 0 or $tara__id <> 0, 0, 1) as sc_regi_new"
      ;
    } else {
      $sc_exe--;
      $sq_calc .= ",
      if(b4.regi__id is null, 0, if(b4.regi__id in ($region), $sc_regi - 1, if(b5.regi__id in ($regi__to_id), $sc_ext - 1, -$sc_ext))) as sc_regi, 
      if(b1.regi__id = 0 or $tara__id <> 0, 0, -1) as sc_regi_new"
      ;
    }
    $sq_calc .= ",
      GREATEST(b1.regi__lvl, $regi__lvl) as regi__sub"
    ;
    $sq_join .= "
      left join nfc_expr_wine__acPU_regi as b4 on b4.wine__arP = b1.arP
      left join nfc_expr_regi__arPD_link as b5 on b5.link__id = b4.regi__id"
    ;
  } else {
    $sq_calc .= ",
      0 as sc_regi, if(b1.regi__id = 0 or $tara__id <> 0, 0, -1) as sc_regi_new, 0 as regi__sub"
    ;
  }
  if ($vineyard) {
    $vineyard__to_id = $fti_seg['vine_link'][$vineyard] ?? $vineyard;
    $sc_exe += $sc_vine;
    $sq_calc .= ",
      GREATEST(b1.vine__lvl, $vine__lvl) as vine__sub"
    ;
    if ($vine__id) {
      $vine__terms = '';
      foreach (explode(',', $vine__term) as $vine__term_id) {
        $vine__terms .= " or FIND_IN_SET($vine__term_id, b1.vine__term) > 0";
      }
      $sc_exe += $sc_name;
      $vine__to_id = $fti_seg['vine_link'][$vine__id] ?? $vine__id;
      $__to_ids = implode(',', array_flip(array_flip(explode(',', "$vineyard__to_id,$vine__to_id"))));
      $__ids = implode(',', array_flip(array_flip(explode(',', "$vineyard,$vine__id"))));
      //d($__ids,$__to_ids,$vineyard,$vine__id,$vineyard__to_id,$vine__to_id);
      $sq_where_sum .= "
          + if(b1.vineyard in ($__ids) or b1.vine__id in ($__ids) or b3.vine__id in ($__to_ids), $sc_ext, 0)"
      ;
      $sq_calc .= ",
      if(b1.vineyard in ($__ids) or b1.vine__id in ($__ids),
            $sc_vine, if(b3.vine__id in ($__to_ids), $sc_ext, b1.vine__lvl - $sc_ext)) as sc_vine,
      if(b1.vine__id = $vine__id, $sc_name, if(b3.vine__id in ($__to_ids), 1, 0)
      ) - if(b1.vine__id = 0 $vine__terms, 0, 1) as sc_vine_new"
      ;
    } else {
      $sq_where_sum .= "
          + if(b1.vineyard in ($vineyard__to_id) or b1.vine__id in ($vineyard__to_id) or b3.vine__id in ($vineyard__to_id), $sc_ext, 0)"
      ;
      $sq_calc .= ",
      if(b1.vineyard in ($vineyard__to_id) or b1.vine__id in ($vineyard__to_id),
          $sc_vine, if(b3.vine__id in ($vineyard__to_id), $sc_ext, b1.vine__lvl - $sc_ext)) as sc_vine, 
      if(b1.vine__id = 0, 0, -1) as sc_vine_new"
      ;
    }
    $sq_join .= "
      left join nfc_expr_vine__arPD_link as b3 on b3.link__id = b1.vineyard"
    ;
  } else {
    $sq_calc .= ",
      if(b1.vine__id = 0, 0, b1.vine__lvl - $lvl_max) as sc_vine, if(b1.vine__id = 0, 0, -1) as sc_vine_new, 0 as vine__sub"
    ;
  }
  if ($color) {
    $sc_exe += $sc_color;
    $sq_where_sum .= "
        + if(b1.color = $color, 1, 0)"
    ;
    $sq_calc .= ",
      if(b1.color = 0, 0, if(b1.color = $color, $sc_color, -$sc_ext)) as sc_color"
    ;
  } else {
    $sq_calc .= ",
      0 as sc_color"
    ;
  }
  if ($co2) {
    $sc_exe += $sc_co2;
    $sq_where_sum .= "
        + if(b1.co2 = $co2, 1, 0)"
    ;
    $sq_calc .= ",
      if(b1.co2 = 0, 0, if(b1.co2 = $co2, $sc_co2, -$sc_ext)) as sc_co2"
    ;
  } else {
    $sq_calc .= ",
      0 as sc_co2"
    ;
  }
  if ($word__cnt || $blend__arS) {
    $sq_from = "(
      SELECT
        $sq_fields1,
        $sq_fields2,
        b1.attrTYPE__cnt, b1.attrTITLE__cnt, b1.attrTITLE__eMB"
    ;
    if ($term__cnt) {
      $sq_from .= ",
        ($count_term) as count_term"
      ;
      $sq_where_sum .= "
        + if(b1.term__cnt > 0, count_term * 3, 0)"
      ;
      $sq_words = ",
      if(b1.term__cnt = 0,
          -LEAST($term__cnt, $sc_ext),
          if($term__cnt <> b1.term__cnt or $term__cnt <> count_term,
              -LEAST(GREATEST($term__cnt, b1.term__cnt) - count_term, $sc_ext),
              LEAST($term__cnt * 2, $sc_words)
      )) as sc_words"
      ;
      $sc_exe += $sc_words;
    }
    if ($attr__cnt) {
      $sq_attr = "";
      $sq_where_sum .= "
        + if(attrTYPE__cnt + attrTITLE__cnt > 0, 2, 0)"
      ;
      if ($title__cnt) {
        $sc_exe += $sc_title;
        $sq_attr .= ",
      if(GREATEST_title - count_title <= count_title,
          LEAST(count_title * 2 - GREATEST_title, $sc_title), -LEAST(GREATEST_title - count_title, $sc_ext)) as sc_title"
        ;
        $sq_from .= ",
        ($count_title) as count_title,
        GREATEST(b1.attrTITLE__cnt, $title__cnt) as GREATEST_title"
        ;
      } else {
        $sq_attr .= ",
      -LEAST(b1.attrTITLE__cnt, $sc_ext) as sc_title"
        ;
      }
      if ($type__cnt) {
        $sc_exe += $sc_type;
        $sq_attr .= ",
      if($type__cnt <> attrTYPE__cnt or $type__cnt <> count_type,
          -LEAST(GREATEST($type__cnt, attrTYPE__cnt) - count_type, $sc_type),
          LEAST(count_type , $sc_type)
      ) as sc_type"
        ;
        $sq_from .= ",
        ($count_type) as count_type"
        ;
      } else {
        $sq_attr .= ",
      -LEAST(b1.attrTYPE__cnt, $sc_ext) as sc_type"
        ;
      }
    }
    if ($blend__arS) {
      $sc_exe += $sc_blend + ($blend_new__arS ? $sc_name : 0);
      foreach (explode(',', $grape__dsP) as $grape__id) {
        $grap__cnt++;
        $count_blend .= "+if(FIND_IN_SET($grape__id, b1.grape__dsP) > 0, 1, 0)";
        if ($blend_new__arS) {
          $count_blend_new .= "+if(FIND_IN_SET($grape__id, b1.grape_new__dsP) > 0, 1, 0)";
        }
      }
      $sq_where_sum .= "
          + if(b1.blend__dsP = '', 0, if(FIND_IN_SET($blend__arS, b1.blend__dsP) > 0, $sc_ext, if(c_blend > 0, 1, 0)))"
      ;
      $sq_blend = ",
      if(b1.blend__dsP = '', if($blend_new__arS = 0, 0, -1), if(FIND_IN_SET($blend__arS, b1.blend__dsP) > 0,
        $sc_blend, if(c_blend > 0, GREATEST($sc_blend - LEAST(b1.grape__cnt, $grap__cnt) - GREATEST(b1.grape__cnt, $grap__cnt) + c_blend * 2, 0), -LEAST($grap__cnt, $sc_ext)
      ))) as sc_blend,
      if(b1.blend_new__arS * $blend_new__arS = 0, 0, if(b1.blend_new__arS = $blend_new__arS, 2, if(c_blend_new > 0, 1, -1))) as sc_blend_new"
      ;
      $sq_from .= ",
        ($count_blend) as c_blend,
        ($count_blend_new) as c_blend_new"
      ;
    }
    $sq_from .= "
      FROM nfc_expr_wine__arPD as b1 $sq_where_country
    )";
    $sq_where_country = "
  WHERE 1 = 1"
    ;
  }
  if ($sq_mode != 2) {
    $sq_where_country .= "
    and (0 $sq_where_sum
    ) >= $sc_ext"
    ;
  }
  $sq_calc .= $sq_words . $sq_attr . $sq_blend;
  if ($sq_mode == 1 || nfc_getVar('match_dbg', 0) == '1') {
    $sq_mode_names = ",
    concat(a1.vineyard, '/', g2.name) as nfc_gustos_vineyard_name, g1.name as nfc_gustos_wine_name"
    ;
    $sq_mode_join = "
    left join $fti_gustos_db.gustos_wine as g1 on g1.id = a1.wine
    left join $fti_gustos_db.vineyard as g2 on g2.id = a1.vineyard"
    ;
  } else {
    $sq_mode_names = ",
    '' as nfc_gustos_vineyard_name, '' as nfc_gustos_wine_name"
    ;
    $sq_mode_join = "";
  }
  $fti_sq['match_r0'] =
"SELECT distinct
    a1.arP, a1.country,
    a1.color, a1.co2, a1.vintage__ids, a1.regi__dsP,
    a1.vintage__dsP,
    $word__cnt as word__cnt,
    a1.wine, nfc_word__cnt,
    $sc_sum as sc_sum, $sc_exe as sc_exe, $sc_limit as sc_base,
    a1.grape__dsP as nfc_grape__dsP,
    a1.vineyard as nfc_gustos_vineyard_id,
    -- sc_words,sc_type,sc_co2,sc_color,sc_title,sc_regi,sc_vine,sc_blend,sc_blend_new,sc_regi_new,sc_vine_new,
    ($sc_base * (sc_words
        + sc_regi + sc_tara - regi__sub - if(sc_regi < 0 and regi__sub <> 0, sc_regi, 0)
        + sc_vine - vine__sub - if(sc_vine < 0 and vine__sub <> 0, sc_vine, 0)
        + sc_blend + sc_color + sc_co2 + sc_type + sc_title + sc_blend_new
        + sc_regi_new
        + sc_vine_new
        - LEAST(if(sc_vine<0,1,0)+if(sc_blend<0,1,0)+if(sc_color<0,1,0)+if(sc_co2<0,1,0)+if(sc_words<0,1,0)+if(sc_type<0,1,0), 2) * $sc_ext * 3
      )
      + sc_words + $sc_ext
      + (sc_type + $sc_ext)   * 10
      + (sc_co2 + $sc_ext)    * 100
      + (sc_color + $sc_ext)  * 1000
      + (sc_title + $sc_ext)  * 10000
      + (sc_regi + sc_tara + $sc_ext - regi__sub - if(sc_regi < 0 and regi__sub <> 0, sc_regi, 0)) * 100000
      + (sc_vine + $sc_ext - vine__sub - if(sc_vine < 0 and vine__sub <> 0, sc_vine, 0)) * 1000000
      + (sc_blend + $sc_ext) * 10000000
      + (sc_blend_new + sc_regi_new + sc_vine_new + $sc_ext) * 100000000
    ) as score $sq_mode_names
  FROM (
    SELECT
      b1.attrTYPE__cnt + b1.attrTITLE__cnt as nfc_word__cnt,
      $sq_fields1,
      $sq_fields2 $sq_calc 
    FROM $sq_from as b1 $sq_join $sq_where_country
  ) a1 $sq_mode_join
ORDER BY score desc
LIMIT $sq_limit
  ";
  if (nfc_getVar('match_dbg', 0) == '1') {
    nfc_setVar('match_dbg', 0);
    echo "\nd1\n" . strtr($fti_sq['match_r0'], ["\t"=>"  "]) . "\n";
    foreach ($fti_terme as $i => $term) {
      foreach ($term as $k => $arP) {
        $fti_terme[$i][$k] = "$arP/" . $fti_seg['word']['arP'][$arP]['dsP'];
      }
    }
    foreach ($fti_expra['attr'] as $arP) {
      $fti_expra['attr'][$arP] = "$arP/" . $fti_seg['word']['arP'][$arP]['dsP'];
    }
    foreach ($fti_expra['word'] as $arP) {
      $fti_expra['word'][$arP] = "$arP/" . $fti_seg['word']['arP'][$arP]['dsP'];
    }
    dd($sc_exe, $fti_row, $mix__arr, $fti_expra, $fti_terms, $fti_terme);
    exit;
  }
  
}