<?php

function nfc_rs__match($name_orig) {
  global $fti_var, $fti_seg, $fti_row, $fti_terms, $fti_terme, $fti_expra, $fti_exWINE, $mix__arr, $fti_sqr,$fti_gustos_db;
  $syGroupGRP = $fti_var['syGroupGRP'];
  load_regions();
  load_vineyards();
  load_blends();
  $name = preg_replace('/\s*[&+_]\s*/u', ' ', preg_replace("/\R.*/um", "", $name_orig));
  $fti_expra = [];
  $fti_row['country'] = 0;
  parse_name($fti_exWINE, $name, $syGroupGRP, FTI_PARSE_NAME__NORM_IT_elim_single_alpha); // 1- stand for eliminate sigle alpha
  $ret['country'] = $fti_row['country'];
  $sc_lvl = 3;
  $sc_cnt = 2;
  $sc_eid = 1;
  foreach (['REGI', 'VINE', 'GRAP'] as $TYPE) {
    $exTYPE = $fti_var["ex$TYPE"][0];
    $type__id = strtolower($TYPE) . "__id";
    if (isset($fti_terms[$exTYPE])) {
      $ret[$TYPE]['score'] = $ret[$TYPE]['types_id'] = [];
      foreach ($mix__arr[$exTYPE]['arP'] as $mix__id => $val) {
        $lvl = ($TYPE == 'REGI' ? $fti_seg[$type__id][$mix__id][REGI_ID_lvl] : 0);
        $ret[$TYPE]['types_id'][$mix__id]['lvl'] = $lvl;
        $ret[$TYPE]['types_id'][$mix__id]['cnt'] = $val['cnt'];
        $ret[$TYPE]['types_id'][$mix__id]['el__id'] = $val['el__id'];
        $score__val = 10 + $lvl * $sc_lvl + $val['cnt'] * $sc_cnt - $val['el__id'] * $sc_eid;
        $ret[$TYPE]['types_id'][$mix__id]['score'] = $score__val;
        $ret[$TYPE]['score'][$mix__id] = ($score__val * 10000 + $lvl * 100 * $sc_lvl + $val['cnt'] * 10 * $sc_cnt + $val['el__id'] * $sc_eid) * 1000000000000 + $mix__id;
      }
      arsort($ret[$TYPE]['score']);
      $ret[$TYPE]['types_ids'] = implode(',', array_keys($ret[$TYPE]['score']));
    }
  }
  //array_multisort(array_column($data, 'age'), SORT_ASC, $data);
  return $ret;
}

function nfc_rs_regi__reg($regi_init = 0) {
  global $fti_var, $fti_row, $fti_terms, $fti_terme, $fti_expra, $fti_exWINE, $mix__arr, $fti_sqr,$fti_gustos_db;
  $exREGI = $fti_var['exREGI'][0];
  $syGroupRP = $fti_var['syGroupRP'];
  $regi__link_j = db_query("SELECT count(*) from nfc_rs_regi_syn__arPD_link")->fetchColumn();
  if (!$regi__link_j || $regi_init == 1) {
    $regi__link_j = 0;
    $rows = db_query(
      "SELECT s.id, s.name,
        0 as vineyard,
        0 as country,
        0 as color,
        0 as grape__cnt,
        0 as grape__dsP,
        '' vintage,
        '' vintage__ids,
        '' region,
        max(ifnull(re.id, 0)) as syn_regi__id,
        0 as co2
    FROM rule as r 
        left join `synonym` as s on s.id = r.synonym_id
        left join $fti_gustos_db.region as re on re.id = nullif(r.value, 'empty')
        left join $fti_gustos_db.field_data_field_region_country as c on c.entity_id = nullif(r.value, 'empty')
      where r.property = 'region' -- and s.id = 89570
      group by s.id, s.name
--      limit 100
    ")->fetchAll(PDO::FETCH_ASSOC);
    load_regions();
    load_vineyards();
    load_blends();
    $regi__syn = $regi__link = $fti_sqr['r0'] = [];
    $fti_sqr['r0'][] = "delete from nfc_rs_regi_syn__arPD";
    $sql_max = 1000;
    dop("Phase - parsedwine.regi__syn - Register all parsed REGI synonyms entries: " . count($rows));
    $sql_syn_i = $sql_link_i = $fti_entry_cnt = 0;
    $sql_syn_t = $sql_link_t = '';
    $sql_link = "INSERT into nfc_rs_regi_syn__arPD_link (link__id, syn__id) values ";
    foreach ($rows as $fti_row) {
      echo "\r REGI synonym entry=" . $fti_entry_cnt++ . ", ID=" . $fti_row['id'];
      extract($fti_row);
      $name = preg_replace('/\s*[&+_]\s*/u', ' ', $name);
      $fti_expra = [];
      parse_name($fti_exWINE, $name, $syGroupRP, FTI_PARSE_NAME__NORM_IT_elim_single_alpha); // 1- stand for eliminate sigle alpha
      $regi__id = 0;
      $syn_regi__dsP = '';
      if (isset($fti_terms[$exREGI])) {
        $syn_regi__dsP = $mix__arr[$exREGI]['dsP'];
        foreach ($mix__arr[$exREGI]['arP'] as $mix__id => $val) {
          if ($mix__id != $syn_regi__id && $mix__id > $regi__id) {
            $regi__id = $mix__id;
          }
        }
      }
      $term__dsP = (isset($fti_expra['word']) ? implode(',', $fti_expra['word']) : '');
      //dd($fti_row, $fti_terms, $mix__arr, $fti_terme, $fti_expra, $term__dsP, $syn_regi__dsP);
      if ($regi__id || $syn_regi__id) {
        if(!isset($regi__syn[$syn_regi__dsP][$term__dsP])) {
          $term_ar = [];
          $term__sym = implode('', array_keys($term_ar));
          $regi__syn[$syn_regi__dsP][$term__dsP] = $id;
          $sql_syn_t .= ($sql_syn_i++ ? ',' : 'INSERT into nfc_rs_regi_syn__arPD (syn__id,syn_regi__id,syn_regi__dsP,term__dsP) values ')
            . "($id,$regi__id,'$syn_regi__dsP','$term__dsP')";
          if ($sql_syn_i > $sql_max) {
            $fti_sqr['r0'][] = $sql_syn_t;
            $sql_syn_i = 0;
            $sql_syn_t = '';
          }
          $sql_link_t .= ($sql_link_i++ ? "," : $sql_link) . "($id,$id)";
        } elseif (($syn__id = $regi__syn[$syn_regi__dsP][$term__dsP]) != $id) {
          $sql_link_t .= ($sql_link_i++ ? "," : $sql_link) . "($id,$syn__id)";
        }
        if ($sql_link_i > $sql_max) {
          $regi__link[] = $sql_link_t;
          $regi__link_j += $sql_link_i;
          $sql_link_i = 0;
          $sql_link_t = '';
        }
      }
    }
    if ($sql_syn_i) {
      $fti_sqr['r0'][] = $sql_syn_t;
    }
    if ($sql_link_i) {
      $regi__link[] = $sql_link_t;
      $regi__link_j += $sql_link_i;
    }
    $fti_sqr['r0'] = array_merge($fti_sqr['r0'], $regi__link);
    //dd($fti_sqr['r0']);
    reg_expr();
  }
  dop("\n All REGI synonyms entries: " . db_query("SELECT count(*) from nfc_rs_regi_syn__arPD")->fetchColumn());
  dop("\n All REGI omonyms entries: $regi__link_j");
  $regi__rule_j = db_query("SELECT count(*) from nfc_rs_regi_rule__arPD")->fetchColumn();
  if (!$regi__rule_j || $regi_init == 2) {
    $rows = db_query(
      "SELECT r.id as rid, s2.syn__id, s2.syn_regi__id,
        _term__asFL_dsP(a2.term__arP) as rule_regi__sym,
        _term__asFL_dsP(b2.term__arP) as syn_regi__sym,
        _word__asFL(s2.term__dsP) as term__sym,
        ifnull(re.id, 0) as rule_regi__id
      FROM rule as r 
        left join nfc_rs_regi_syn__arPD_link as s1 on s1.link__id = r.synonym_id
        left join nfc_rs_regi_syn__arPD as s2 on s2.syn__id = s1.syn__id
        left join $fti_gustos_db.region as re on re.id = nullif(r.value, 'empty')
        left join nfc_expr__arP as a1 on a1.id = re.id and a1.expr__eS = $exREGI
        left join nfc_expr__acPU_term as a2 on a2.expr__arP = a1.arP and a2.el__id = 0
        left join nfc_expr__arP as b1 on b1.id = s2.syn_regi__id and b1.expr__eS = $exREGI
        left join nfc_expr__acPU_term as b2 on b2.expr__arP = b1.arP and b2.el__id = 0
      where 1 = 1
        and r.property = 'region'
        and (re.id is not null or s2.syn_regi__id > 0)
    ")->fetchAll(PDO::FETCH_ASSOC);
    $regi__syn = $regi__link = $fti_sqr['r0'] = [];
    $fti_sqr['r0'][] = "delete from nfc_rs_regi_rule__arPD";
    $sql_max = 1000;
    dop("Phase - parsedwine.regi__rule - Register all parsed REGI rules entries: " . count($rows));
    $sql_syn_i = $fti_entry_cnt = 0;
    $sql_syn_t = '';
    foreach ($rows as $fti_row) {
      extract($fti_row);
      echo "\r REGI rule entry=" . $fti_entry_cnt++ . ", ID=$rid";
      $rule_regi__ar = array_flip(mb_str_split(strtr($rule_regi__sym, [' ' => '', '_' => ''])));
      $syn_regi__ar = array_flip(mb_str_split(strtr($syn_regi__sym, [' ' => '', '_' => ''])));
      $term__ar = array_flip(mb_str_split(strtr($term__sym, [' ' => '', '_' => ''])));
      $syn_term__sym = implode('', array_keys($term__ar));
      if (count($term__ar)) {
        $rule_regi__match = round(count(array_intersect_key($term__ar, $rule_regi__ar)) * 100 / count($term__ar + $rule_regi__ar));
        $syn_regi__match = round(count(array_intersect_key($term__ar, $syn_regi__ar)) * 100 / count($term__ar + $syn_regi__ar));
      } else {
        $rule_regi__match = $syn_regi__match = 0;
      }
      $sql_syn_t .= ($sql_syn_i++ ? ',' : 'INSERT into nfc_rs_regi_rule__arPD (rule_id,syn__id,rule_regi__id,rule_regi__match,syn_term__sym,syn_regi__match) values ')
        . "($rid,$syn__id,$rule_regi__id,$rule_regi__match,'$syn_term__sym',$syn_regi__match)";
      if ($sql_syn_i > $sql_max) {
        $fti_sqr['r0'][] = $sql_syn_t;
        $sql_syn_i = 0;
        $sql_syn_t = '';
      }
    }
    if ($sql_syn_i) {
      $fti_sqr['r0'][] = $sql_syn_t;
    }
    //dd($fti_sqr['r0'][0], $fti_sqr['r0'][1], $fti_sqr['r0'][2]);
    reg_expr();
  }
  dop("\n All REGI rule entries: " . db_query("SELECT count(*) from nfc_rs_regi_rule__arPD")->fetchColumn());
}

function nfc_rs_vine__reg($vine_init = 0) {
  global $fti_var, $fti_row, $fti_terms, $fti_terme, $fti_expra, $fti_exWINE, $mix__arr, $fti_sqr,$fti_gustos_db;
  $exVINE = $fti_var['exVINE'][0];
  $syGroupRP = $fti_var['syGroupRP'];
  $vine__link_j = db_query("SELECT count(*) from nfc_rs_vine_syn__arPD_link")->fetchColumn();
  if (!$vine__link_j || $vine_init == 1) {
    $vine__link_j = 0;
    $rows = db_query(
      "SELECT s.id, REGEXP_REPLACE(s.name, '\\\\R.*', '') as `name`,
        0 as country,
        0 as color,
        0 as grape__cnt,
        0 as grape__dsP,
        '' vintage,
        '' vintage__ids,
        '' vineyard,
        max(ifnull(nullif(r.value, 'empty'), 0)) as syn_vine__id,
        0 as co2
    FROM rule as r 
        left join `synonym` as s on s.id = r.synonym_id
      where r.property = 'vineyard' -- and s.id = 85078 -- 133439 -- 7450 -- 133439
      group by s.id, s.name
    ")->fetchAll(PDO::FETCH_ASSOC);
    load_regions();
    load_vineyards();
    load_blends();
    $vine__syn = $vine__link = $fti_sqr['r0'] = [];
    $fti_sqr['r0'][] = "delete from nfc_rs_vine_syn__arPD";
    $sql_max = 1000;
    dop("Phase - parsedwine.vine__syn - Register all parsed VINE synonyms entries: " . count($rows));
    $sql_syn_i = $sql_link_i = $fti_entry_cnt = 0;
    $sql_syn_t = $sql_link_t = '';
    $sql_link = "INSERT into nfc_rs_vine_syn__arPD_link (link__id, syn__id) values ";
    foreach ($rows as $fti_row) {
      echo "\r VINE synonym entry=" . $fti_entry_cnt++ . ", ID=" . $fti_row['id'];
      extract($fti_row);
      $name = preg_replace('/\s*[&+_]\s*/u', ' ', $name);
      $fti_expra = [];
      parse_name($fti_exWINE, $name, $syGroupRP, FTI_PARSE_NAME__NORM_IT_elim_single_alpha); // 1- stand for eliminate sigle alpha
      $vine__id = 0;
      $syn_vine__dsP = '';
      if (isset($fti_terms[$exVINE])) {
        $syn_vine__dsP = $mix__arr[$exVINE]['dsP'];
        foreach ($mix__arr[$exVINE]['arP'] as $mix__id => $val) {
          if ($mix__id != $syn_vine__id && $mix__id > $vine__id) {
            $vine__id = $mix__id;
          }
        }
      }
      $term__dsP = (isset($fti_expra['word']) ? implode(',', $fti_expra['word']) : '');
      //d($fti_row, $fti_terms, $mix__arr, $fti_terme, $fti_expra, $term__dsP, $syn_vine__dsP);
      if ($vine__id || $syn_vine__id) {
        if(!isset($vine__syn[$syn_vine__dsP][$term__dsP])) {
          $term_ar = [];
          $term__sym = implode('', array_keys($term_ar));
          $vine__syn[$syn_vine__dsP][$term__dsP] = $id;
          $sql_syn_t .= ($sql_syn_i++ ? ',' : 'INSERT into nfc_rs_vine_syn__arPD (syn__id,syn_vine__id,syn_vine__dsP,term__dsP) values ')
            . "($id,$vine__id,'$syn_vine__dsP','$term__dsP')";
          if ($sql_syn_i > $sql_max) {
            $fti_sqr['r0'][] = $sql_syn_t;
            $sql_syn_i = 0;
            $sql_syn_t = '';
          }
          $sql_link_t .= ($sql_link_i++ ? "," : $sql_link) . "($id,$id)";
        } elseif (($syn__id = $vine__syn[$syn_vine__dsP][$term__dsP]) != $id) {
          $sql_link_t .= ($sql_link_i++ ? "," : $sql_link) . "($id,$syn__id)";
        }
        if ($sql_link_i > $sql_max) {
          $vine__link[] = $sql_link_t;
          $vine__link_j += $sql_link_i;
          $sql_link_i = 0;
          $sql_link_t = '';
        }
      }
    }
    if ($sql_syn_i) {
      $fti_sqr['r0'][] = $sql_syn_t;
    }
    if ($sql_link_i) {
      $vine__link[] = $sql_link_t;
      $vine__link_j += $sql_link_i;
    }
    $fti_sqr['r0'] = array_merge($fti_sqr['r0'], $vine__link);
    //dd($fti_sqr['r0']);
    reg_expr();
  }
  dop("\n All VINE synonyms entries: " . db_query("SELECT count(*) from nfc_rs_vine_syn__arPD")->fetchColumn());
  dop("\n All VINE omonyms entries: $vine__link_j");
  $vine__rule_j = db_query("SELECT count(*) from nfc_rs_vine_rule__arPD")->fetchColumn();
  if (!$vine__rule_j || $vine_init == 2) {
    $rows = db_query(
      "SELECT r.id as rid, s2.syn__id, s2.syn_vine__id,
        _term__asFL_dsP(a2.term__arP) as rule_vine__sym,
        _term__asFL_dsP(b2.term__arP) as syn_vine__sym,
        _word__asFL(s2.term__dsP) as term__sym,
        ifnull(v.id, 0) as rule_vine__id
      FROM rule as r 
        left join nfc_rs_vine_syn__arPD_link as s1 on s1.link__id = r.synonym_id
        left join nfc_rs_vine_syn__arPD as s2 on s2.syn__id = s1.syn__id
        left join $fti_gustos_db.vineyard as v on v.id = nullif(r.value, 'empty')
        left join nfc_expr__arP as a1 on a1.id = v.id and a1.expr__eS = $exVINE
        left join nfc_expr__acPU_term as a2 on a2.expr__arP = a1.arP and a2.el__id = 0
        left join nfc_expr__arP as b1 on b1.id = s2.syn_vine__id and b1.expr__eS = $exVINE
        left join nfc_expr__acPU_term as b2 on b2.expr__arP = b1.arP and b2.el__id = 0
      where 1 = 1
        and r.property = 'vineyard'
        and (v.id is not null or s2.syn_vine__id > 0)
    ")->fetchAll(PDO::FETCH_ASSOC);
    $vine__syn = $vine__link = $fti_sqr['r0'] = [];
    $fti_sqr['r0'][] = "delete from nfc_rs_vine_rule__arPD";
    $sql_max = 1000;
    dop("Phase - parsedwine.vine__rule - Register all parsed VINE rules entries: " . count($rows));
    $sql_syn_i = $fti_entry_cnt = 0;
    $sql_syn_t = '';
    foreach ($rows as $fti_row) {
      extract($fti_row);
      echo "\r VINE rule entry=" . $fti_entry_cnt++ . ", ID=$rid";
      $rule_vine__ar = array_flip(mb_str_split(strtr($rule_vine__sym, [' ' => '', '_' => ''])));
      $syn_vine__ar = array_flip(mb_str_split(strtr($syn_vine__sym, [' ' => '', '_' => ''])));
      $term__ar = array_flip(mb_str_split(strtr($term__sym, [' ' => '', '_' => ''])));
      $syn_term__sym = implode('', array_keys($term__ar));
      if (count($term__ar)) {
        $rule_vine__match = round(count(array_intersect_key($term__ar, $rule_vine__ar)) * 100 / count($term__ar + $rule_vine__ar));
        $syn_vine__match = round(count(array_intersect_key($term__ar, $syn_vine__ar)) * 100 / count($term__ar + $syn_vine__ar));
      } else {
        $rule_vine__match = $syn_vine__match = 0;
      }
      $sql_syn_t .= ($sql_syn_i++ ? ',' : 'INSERT into nfc_rs_vine_rule__arPD (rule_id,syn__id,rule_vine__id,rule_vine__match,syn_term__sym,syn_vine__match) values ')
        . "($rid,$syn__id,$rule_vine__id,$rule_vine__match,'$syn_term__sym',$syn_vine__match)";
      if ($sql_syn_i > $sql_max) {
        $fti_sqr['r0'][] = $sql_syn_t;
        $sql_syn_i = 0;
        $sql_syn_t = '';
      }
    }
    if ($sql_syn_i) {
      $fti_sqr['r0'][] = $sql_syn_t;
    }
    //dd($fti_sqr['r0'][0], $fti_sqr['r0'][1], $fti_sqr['r0'][2]);
    reg_expr();
  }
  dop("\n All VINE rule entries: " . db_query("SELECT count(*) from nfc_rs_vine_rule__arPD")->fetchColumn());
}

function nfc_rs__rep($loTYPE = 'regi') { // $loTYPE = enum(regi, vine);
  global $fti_var;
  $arTYPE = ['regi' => 'region', 'vine' => 'vineyard'];
  $rrTYPE = ['regi' => '\\R', 'vine' => '\\R.*'];
  $crTYPE = ['regi' => 'field_data_field_region_country', 'vine' => 'vineyard'];
  $frTYPE = ['regi' => 'entity_id', 'vine' => 'id'];
  $trTYPE = ['regi' => 'field_region_country_target_id', 'vine' => 'country'];
  $loTYPE = strtolower($loTYPE);
  $hiTYPE = strtoupper($loTYPE);
  $exTYPE = $fti_var["ex{$hiTYPE}"][0];
  $sarTYPE = $arTYPE[$loTYPE];
  $srrTYPE = $rrTYPE[$loTYPE];
  $scrTYPE = $crTYPE[$loTYPE];
  $sfrTYPE = $frTYPE[$loTYPE];
  $strTYPE = $trTYPE[$loTYPE];
  $nfc_rs_rep_table = "nfc_rs_rep_{$loTYPE}_" . date('Y_m_d__h');;
  $sql =
"SELECT x.* FROM parsedwine__exDB.$nfc_rs_rep_table x  where x.syn <> '' order by rule_status, country, syn_name, rule_name, base_sname;
-- SELECT x.* FROM parsedwine__exDB.$nfc_rs_rep_table x where x.rule_status like 'a-%' order by rule_status, country, syn_name, rule_name, base_sname;
-- update parsedwine__exDB.$nfc_rs_rep_table as u1 set u1.edit_by_Vit = concat('d-new syn-', substring_index(u1.edit_by_Vit, 'd-new syn', -1)) where u1.edit_by_Vit regexp 'd-new syn\\d';
-- update parsedwine__exDB.$nfc_rs_rep_table as u1 set u1.edit_by_Vit = '' where u1.edit_by_Vit = '0' and u1.syn = '';
-- drop table parsedwine__exDB.$nfc_rs_rep_table;
-- alter table parsedwine__exDB.$nfc_rs_rep_table add UNIQUE key is25651_UK(rule_id);
-- create table parsedwine__exDB.$nfc_rs_rep_table
-- insert into parsedwine__exDB.$nfc_rs_rep_table
SELECT
    count(*) cnt,
  a2.id rule_id, a1.syn__id, a3.id as orig_sid, regexp_replace(a3.name, '$srrTYPE', '') as orig_sname,
  a1.rule_{$loTYPE}__id rrid, _term__asFL_dsP(a5.term__arP) as rule_name, a1.rule_{$loTYPE}__match as rrm,
  _word__asFL(b2.term__dsP) as base_sname, b2.syn_{$loTYPE}__dsP sr__dsP,
  b2.syn_{$loTYPE}__id srid, _term__asFL_dsP(b5.term__arP) as syn_name, a1.syn_{$loTYPE}__match as srm, b7.name country,
  case 
    when a1.rule_id is null then '0-ничего / 1-синоним / 2-под регион'
    when a1.rule_{$loTYPE}__id = 0 and b2.syn_{$loTYPE}__dsP not regexp ',' then '4-новый'
    when a1.rule_{$loTYPE}__id = 0 and b2.syn_{$loTYPE}__dsP regexp ',' then '5-микс'
    when b2.syn_{$loTYPE}__id = 0 or (b2.syn_{$loTYPE}__dsP not regexp ',' and b2.syn_{$loTYPE}__id = a1.rule_{$loTYPE}__id) then '6-совпадают'
    when FIND_IN_SET(a1.rule_{$loTYPE}__id, b2.syn_{$loTYPE}__dsP) > 0 and length(regexp_replace(b2.syn_{$loTYPE}__dsP, '\\d', '')) > 0 then '7-добавлено'
    when FIND_IN_SET(a1.rule_{$loTYPE}__id, b2.syn_{$loTYPE}__dsP) = 0 and b2.syn_{$loTYPE}__dsP not regexp ',' then '9-замена - регион'
    when FIND_IN_SET(a1.rule_{$loTYPE}__id, b2.syn_{$loTYPE}__dsP) = 0 and b2.syn_{$loTYPE}__dsP regexp ',' then 'A-замена - микс'
  end as rule_status,
  if(GREATEST(rule_{$loTYPE}__match, syn_{$loTYPE}__match) > 63, '1-синоним', '') as syn,
  cast('' as varchar(512)) as edit_by_Vit
from rule as a2
  left join nfc_rs_{$loTYPE}_rule__arPD as a1 on a2.id = a1.rule_id
  left join `synonym` as a3 on a3.id = a2.synonym_id
  left join nfc_expr__arP as a4 on a4.id = a1.rule_{$loTYPE}__id and a4.expr__eS = $exTYPE
  left join nfc_expr__acPU_term as a5 on a5.expr__arP = a4.arP and a5.el__id = 0
  left join nfc_rs_{$loTYPE}_syn__arPD_link as b1 on b1.link__id = a1.syn__id 
  left join nfc_rs_{$loTYPE}_syn__arPD as b2 on b2.syn__id = b1.syn__id 
  left join `synonym` as b3 on b3.id = b2.syn__id
  left join nfc_expr__arP as b4 on b4.id = b2.syn_{$loTYPE}__id and b4.expr__eS = $exTYPE
  left join nfc_expr__acPU_term as b5 on b5.expr__arP = b4.arP and b5.el__id = 0
  left join gustos.$scrTYPE as b6 on b6.$sfrTYPE = if(b2.syn_{$loTYPE}__id > 0, b2.syn_{$loTYPE}__id, a1.rule_{$loTYPE}__id)
  left join gustos.region as b7 on b7.id = b6.$strTYPE
where 1=1
  and a2.property = '$sarTYPE'
 -- and a3.id = 89570
-- and a1.rule_{$loTYPE}__id > 0 and b2.syn_{$loTYPE}__id > 0
-- and a1.rule_{$loTYPE}__id <> b2.syn_{$loTYPE}__id and b2.syn_{$loTYPE}__id > 0 and a1.rule_{$loTYPE}__id > 0
-- and FIND_IN_SET(a1.rule_{$loTYPE}__id, b2.syn_{$loTYPE}__dsP) = 0 and 0 not in (a1.rule_{$loTYPE}__id, b2.syn_{$loTYPE}__id)
-- and FIND_IN_SET(a1.rule_{$loTYPE}__id, b2.syn_{$loTYPE}__dsP) > 0 and length(regexp_replace(b2.syn_{$loTYPE}__dsP, '\\d', '')) > 0
-- and a1.rule_{$loTYPE}__id = 0
-- and b2.syn_{$loTYPE}__id = 0 or (b2.syn_{$loTYPE}__dsP not regexp ',' and b2.syn_{$loTYPE}__id = a1.rule_{$loTYPE}__id)
-- and a2.id in (241769,241779) -- a3.name regexp 'yarra'  -- _word__asFL(b2.term__dsP) regexp 'yarra'
-- and a1.rule_id is not null
 and a1.rule_id is null
 group by a1.syn__id, a1.rule_{$loTYPE}__id, b2.syn_{$loTYPE}__id, b2.syn_{$loTYPE}__dsP, b2.term__dsP, a3.id 
-- group by a1.syn__id, a1.rule_{$loTYPE}__id, b2.syn_{$loTYPE}__id, b2.syn_{$loTYPE}__dsP, b2.term__dsP
-- order by rule_status, country, syn_name, rule_name, base_sname
 order by orig_sname -- cnt desc, 
";
  return $sql;    
}