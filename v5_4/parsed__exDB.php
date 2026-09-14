<?php
function parsed__exDB_laad_country() {
  global $fti_terme, $fti_terms, $fti_expra, $fti_var, $mix__dsP, $fti_parsedwine__exDB;
  $rows = db_query("SELECT country from lwin__arS_country")->fetchAll(PDO::FETCH_COLUMN);
  //d($rows);
  foreach ($rows as $name) {
    $fti_expra['word'] = [];
    expra_word(($name == 'Syria' ? 'Syrian Arab Republic' : ($name == 'Republic of Korea' ? ' Korea Republic' : $name)));
    search_terms($fti_var['exTARA'][0]);
    $tid = array_keys($fti_terms[$fti_var['exTARA'][0]])[0];
    //d($name, $fti_terms, $tid);
    echo "\n$name, tid=$tid";
    db_query("UPDATE $fti_parsedwine__exDB.lwin__arS_country set tid = $tid where country = '$name'");
  }
  db_query(
    "UPDATE $fti_parsedwine__exDB.lwin__arS as u1
        left join lwin__arS_colour as u2 on u2.colour = u1.colour
        left join lwin__arS_type as u3 on u3.type = u1.type
        left join lwin__arS_type_sub as u4 on u4.type_sub = u1.sub_type
        left join lwin__arS_country as u5 on u5.country = u1.country
        left join lwin__arS_type as u6 on u6.type = u1.type
      set u1.parsed__exDB_colour__tid = u2.parsed__exDB_colour__tid,
          u1.parsed__exDB_co2__tid = u4.tid,
          u1.parsed__exDB_country__tid = u5.tid,
          u1.parsed__exDB_type__tid = if(u1.DISPLAY_NAME = '', 0, u6.tid)
      where 1=1
        -- and u3.tid = 1
        -- and u4.tid > 0
  ");

}

function parsed__exDB_laad_region() {
  global $fti_terme, $fti_terms, $fti_expra, $fti_var, $fti_seg, $fti_gustos_db, $fti_parsedwine__exDB;
  $sql = 
"SELECT -- arS,
  replace(region, '''', '''''') as region,
  replace(sub_region, '''','''''') as sub_region,
  concat(region, ',', sub_region) as parsed__exDB_region__dsP
from $fti_parsedwine__exDB.lwin__arS
where 1=1
    and parsed__exDB_region__dsP is null
    and (1<>1
        or sub_region <> ''
        or region <> ''
    )
group by region, sub_region
"
  ;
  //d($sql);
  $rows = db_query($sql)->fetchAll();
  $sc_base = 1000000;
  $sc_base_x2 = $sc_base * 2;
  $sc_base_x4 = $sc_base * 4;
  $parsed__exDB_all = $parsed__exDB_found = 0;
  // $word_sy__arP = db_query("SELECT MAX(base__arP) & " . $fti_seg['from']['next'] . " nfc_word__arS_group")->fetchColumn();
  dop("LWIN Regions register started:");
  foreach ($rows as $row) {
    $parsed__exDB_all++;
    $fti_expra['word'] = [];
    expra_word(preg_replace('/\s*[&+]\s*/u', ' ', $row->parsed__exDB_region__dsP));
    $prev = $fti_expra['word'];
    $word__in = (count($fti_expra['word']) ? implode(',', array_keys($fti_expra['word'])) : 0);
    search_terms($fti_var['exREGI'][0]);
    $fti_expra['word'] = [];
    expra_word(preg_replace('/\s*[&+]\s*/u', ' ', $row->region));
    $regi__in = (count($fti_expra['word']) ? implode(',', array_keys($fti_expra['word'])) : 0);
    $regi_base_cnt = $regi__base = $score = $tid = 0;
    $region = '';
    $parsed__exDB_region__dsP = '0';
    //d(norm_it($row->parsed__exDB_region__dsP), $prev, $fti_expra['word'], "word_in=" . ($word__in), "region__in=$regi__in", $fti_terms, $fti_terme);
    if (isset($fti_terms[$fti_var['exREGI'][0]])) {
      $regi_base_cnt = count($fti_terms[$fti_var['exREGI'][0]]);
      $parsed__exDB_region__dsP = ($regi_base_cnt ? implode(',', array_keys($fti_terms[$fti_var['exREGI'][0]])) : '0'); 
      $regi__base = $sc_base_x2 * $regi_base_cnt;
    }
    $sql = 
      "SELECT
          _sNs__asFL(b1.synonym__dsP, '$parsed__exDB_region__dsP') * $regi__base
            + sum(_sNs__asFL(b1.words__dsP, '$word__in') * $sc_base)
            + if(b1.region__tid in ($parsed__exDB_region__dsP), $sc_base_x2, 0)
            + if(_sNs__asFL(b1.words__dsP, '$regi__in') > 0, $sc_base_x2, 0)
          as score,
          b1.region__tid as id,
          replace(b2.name, '''', '''''') as `name`
        from (
            select group_concat(c2.child__arP) as words__dsP, c1.arP, c1.region__tid, c1.synonym__dsP
            from nfc_expr_expr__arPD as c1
                left join nfc__acPU as c2 on c2.parrent__arP = c1.arP
            group by c1.arP, c1.region__tid, c1.synonym__dsP
        ) as b1
          left join $fti_gustos_db.taxonomy_term_data as b2 on b2.tid = b1.region__tid
        where _sNs__asFL('$word__in', b1.words__dsP) > 0
        group by b1.region__tid, b2.name, b1.synonym__dsP, b1.words__dsP
        order by score desc
        limit 2
    ";
    //d($sql);
    //d(db_query($sql)->fetchAll());
    if (($row2 = db_query($sql)->fetchAll())) {
      $score = $row2[0]->score ?? 0;
      $tid = $row2[0]->id;
      $region = $score ? $row2[0]->name : '';
      $parsed__exDB_found++;
    }
    if ($regi_base_cnt > 1) {
      $pres__dsP = $parsed__exDB_region__dsP;
      if ($row->sub_region == 'Texas High Plains') {
        $parsed__exDB_region__dsP = 5541;
      } else {
        $parsed__exDB_region__dsP = $tid;
      }
      dop("WARNING! parsed__exDB_region__dsP was corrected from value($pres__dsP) to value($parsed__exDB_region__dsP), region(" . $row->parsed__exDB_region__dsP . ")");
    }
    //$upd = "UPDATE lwin__arS_region set parsed__exDB_region__dsP = '$parsed__exDB_region__dsP', word__dsP = '$word__in', parsed__exDB_region__score = $score, tid = $tid where arS = " . $row->arS;
    //d($upd);
    //db_query($upd);
    $upd = 
      "UPDATE $fti_parsedwine__exDB.lwin__arS 
        set parsed__exDB_region__dsP = '$parsed__exDB_region__dsP', parsed__exDB_region__score = $score, parsed__exDB_region = '$region'
        where region = '" . $row->region . "' and sub_region = '" . $row->sub_region . "'"
    ;
    //d($score, $parsed__exDB_region__dsP, $upd);
    db_query($upd);
    echo "\rRegion=" . $row->region . ' / ' . $row->sub_region
        . ", tid=$tid, score=$score, parsed__exDB_region__dsP=$parsed__exDB_region__dsP, region=" . $row->parsed__exDB_region__dsP;

  }
  dop("LWIN Regions found ($parsed__exDB_found) from total: $parsed__exDB_all");
}

function parsed__exDB_laad_producer() {
  global $fti_terme, $fti_terms, $fti_expra, $fti_var, $fti_gustos_db, $fti_parsedwine__exDB;
  db_query("UPDATE $fti_parsedwine__exDB.lwin__arS_producer set parsed__exDB_vineyard__dsP = '', parsed__exDB_vineyard__score = 0, id = 0");
  dop("NF Producer matching started: ");
  $rows = db_query(
    "SELECT arS,
        replace(producer_name, '''', '''''') as producer_name,
        replace(producer_title, '''','''''') as producer_title,
        producer_name as producer__dsP
      from $fti_parsedwine__exDB.lwin__arS_producer
      -- where arS = 3
  ")->fetchAll();
  $sc_base = 1000000;
  $sc_base_x2 = $sc_base * 2;
  $sc_base_x4 = $sc_base * 4;
  $producer__dsP = $word__in = '0';
  foreach ($rows as $row) {
    $fti_expra['word'] = [];
    expra_word(preg_replace('/\s*[&+]\s*/u', ' ', $row->producer__dsP));
    $words_cnt = count($fti_expra['word']);
    $word__in = ($words_cnt ? implode(',', array_keys($fti_expra['word'])) : '0');
    $producer__dsP = $producer_base_cnt = $score = $id = 0;
    $vineyard = '';
    //d(norm_it(preg_replace('/\s*[&+]\s*/u', ' ', $row->producer__dsP)), "word__in=$word__in", $fti_expra['word'], $fti_terms, $fti_terme);
    /*
    search_terms($fti_var['exVINE'][0]);
    if (isset($fti_terms[$fti_var['exVINE'][0]])) {
      $producer_base_cnt = count($fti_terms[$fti_var['exVINE'][0]]);
      $producer__dsP = ($producer_base_cnt ? implode(',', array_keys($fti_terms[$fti_var['exVINE'][0]])) : '0'); 
    }
    //d(norm_it($row->producer__dsP), $fti_expra['word'],"producer__dsP=$producer__dsP","producer__base=$producer__base", "word__in=$word__in", $fti_terms, $fti_terme);
    $sql = 
      "SELECT
          score + max_cnt + ifnull(found_cnt * 10, 0)
            + ifnull(round(found_cnt * 10 / max_cnt), 0) * $sc_base
          as score, 
          id, `name`
        from (
          select
            if ($producer_base_cnt > 0 and b1.vine__id in ($producer__dsP), ($sc_base_x4 + 1000) * $producer_base_cnt, 0) as score,
            b1.vine__id as id,
            sum(if(b3.child__arP in ($word__in), 1, 0)) as found_cnt,
            if(b4.word__cnt <= $words_cnt, $words_cnt, b4.word__cnt) as max_cnt,
            replace(b2.name, '''', '''''') as `name`
          from nfc_expr_vineyard__arPD as b1
            left join $fti_gustos_db.vineyard as b2 on b2.id = b1.vine__id
            left join nfc__acPU as b3 on b3.parrent__arP = b1.arP
            left join nfc_expr__arP as b4 on b4.arP = b1.arP
          where b3.child__arP in ($word__in)
          group by b1.vine__id, b2.name, b4.word__cnt
        ) a1
        order by score desc
        limit 1
    ";
    */
    $sql = 
      "SELECT d1.id,
          max_cnt * 10 + if(found_cnt < max_cnt, found_cnt, max_cnt) + round(score2) * $sc_base as score,
          replace(d2.name, '''', '''''') as `name`
        from (    
          select a1.id,
              max(max_cnt) as max_cnt,
              sum(found_cnt) as found_cnt,
              sum(found_cnt * 10 / max_cnt) as score2
          from (
            select b1.id,
              max_cnt, found_cnt, 
              sum(found_cnt * 10 / max_cnt) over (partition by b1.id order by b1.id, b1.el__id) as score1
            from (
              select c1.vine__id as id, c2.el__id,
                count(*) as found_cnt, 
                c3.next__id as max_cnt
              from nfc_expr_vineyard__arPD as c1
                left join nfc_expr__acPU_term as c2 on c2.expr__arP = c1.arP
                left join nfc_term__arP as c3 on c3.arP = c2.el__arP 
                left join nfc_term__acPU_word as c4 on c4.term__arP = c3.arP
              where c4.el__arP in ($word__in)
              group by c1.vine__id, c3.arP, c3.next__id, c2.el__id
            ) as b1
          ) as a1
          where score1 <= 10
          group by a1.id
        ) as d1
          left join gustosapp.vineyard as d2 on d2.id = d1.id
        where d1.score2 > 0
        order by d1.score2 desc
        limit 1
    ";

    // where _sNs__asFL('$word__in', b1.words__dsP) > 0
    //d($sql);
    //d($word__in, $producer__dsP, db_query($sql)->fetchAll());
    if (($row2 = db_query($sql)->fetchAll())) {
      $score = $row2[0]->score;
      $id = $row2[0]->id;
      $vineyard = $score ? $row2[0]->name : '';
    }
    $upd = "UPDATE $fti_parsedwine__exDB.lwin__arS_producer set parsed__exDB_vineyard__dsP = '$producer__dsP', word__dsP = '$word__in', parsed__exDB_vineyard__score = $score, id = $id where arS = " . $row->arS;
    //d($upd);
    db_query($upd);
    $upd =
      "UPDATE $fti_parsedwine__exDB.lwin__arS
        set parsed__exDB_vineyard__dsP = '$word__in', parsed__exDB_vineyard__score = $score, parsed__exDB_vineyard_name = '$vineyard'
        where producer_name='" . $row->producer_name . "' and producer_title='" . $row->producer_title . "'"
    ;
    //d($upd);
    db_query($upd);
    echo "\rarS=" . $row->arS . ", id=$id, score=$score, producer=" . $row->producer__dsP . ", term_id=$producer__dsP, dsP=$word__in";

  }
  dop("NF Producer matching ends.");
  /*
  nfc_vineyard_synonyms();
  db_query(
    "UPDATE lwin__arS as u1
      inner join nfc_expr_vineyard__arPD as u2 on u2.synonym__dsP <> '' and u2.vine__id = u1.parsed__exDB_vineyard__dsP
      set u1.parsed__exDB_vineyard__dsP = concat(u2.vine__id, ',', u2.synonym__dsP)
  ");
  */
}

function mf__ex_laad_producer() {
  global $fti_terme, $fti_terms, $fti_expra, $fti_var, $fti_gustos_db, $fti_parsedwine__exDB;
  db_query("UPDATE lwin__arS set mf__ex_vineyard__dsP = NULL, mf__ex_vineyard__score = 0, mf__ex_vineyard_name = ''");
  dop("MF Producer matching started: ");
  $rows = db_query(
    "SELECT arS,
        replace(producer_name, '''', '''''') as producer_name,
        replace(producer_title, '''','''''') as producer_title,
        replace(producer_full, '''','''''') as producer_full
      from $fti_parsedwine__exDB.lwin__arS_producer
      -- where arS = 96
  ")->fetchAll();
  foreach ($rows as $row) {
    $score = $id = 0;
    $vineyard = '';
    $producer_full = $row->producer_full;
    $sql = 
      "SELECT
          round(MATCH (v.name) AGAINST ('$producer_full') * 50000) AS score,
          id, replace(v.name, '''', '''''') as `name`
        from $fti_gustos_db.vineyard as v
        order by score desc
        limit 1
    ";
    if (($row2 = db_query($sql)->fetchAll())) {
      $score = $row2[0]->score;
      $id = $row2[0]->id;
      $vineyard = $score ? $row2[0]->name : '';
    }
    $upd =
      "UPDATE $fti_parsedwine__exDB.lwin__arS
        set mf__ex_vineyard__dsP = '$id', mf__ex_vineyard__score = $score, mf__ex_vineyard_name = '$vineyard'
        where producer_name='" . $row->producer_name . "' and producer_title='" . $row->producer_title . "'"
    ;
    //d($upd);
    db_query($upd);
    echo "\rarS=" . $row->arS . ", id=$id, score=$score, producer=$producer_full";

  }
  dop("MF Producer matching ends.");
}

function parsed__exDB_laad_wine_v1($reini = 0, $restore = 0, $in__arS = '', $mode = 2, $version = 4) { 
  // $mode = (1) / (0) => (use all vineyard synonyms - dups) / (use only 1-st found in lwin)
  global $fti_var, $fti_sq, $fti_parsedwine__exDB;
  dop("NF Wines matching started: reini=$reini, restore=$restore, in__arS='$in__arS', mode=$mode, version=$version");
  if ($reini) {
    db_query("UPDATE $fti_parsedwine__exDB.lwin__arS set nfc_gustos_wine__id = NULL");
  }
  $score__arS = $cur__arS = 0;
  if ($restore > 0) {
    $filter = "and arS >= (SELECT min(arS) from lwin__arS where nfc_gustos_wine__id is null)";
    $limit_src = 10000;
  } else {
    //$filter = "and parsed__exDB_vineyard__dsP <> nfc_gustos_vineyard_id and nfc_gustos_vineyard_id > 0 and parsed__exDB_vineyard__score > 0";
    //$filter = "and WINE_FULL like '%''%'";
    $filter =
        "and arS in (
          SELECT arS
          from $fti_parsedwine__exDB.lwin__arS
          where floor((nfc_gustos_wine__score % 1000) / 100) > floor((nfc_gustos_wine__score % 100) / 10)
        )"
    ;
    $filter = "and 1=1";
    $limit_src = 100000;
    if (!$restore) {
      db_query("INSERT into  $fti_parsedwine__exDB.src_score__arS (description__dsP) values ('lwin__arS')");
    }
    $score__arS = db_query("SELECT max(arS) from  $fti_parsedwine__exDB.src_score__arS")->fetchColumn() ?? 0;
    if (!$score__arS) {
      $msg = "You are traing to perform matching with continue option (\$restore < 0), but there are no previouse score session in  $fti_parsedwine__exDB.src_score__arS";
      dop($msg);
      throw new Exception($msg);
    }
    $cur__arS = db_query("SELECT max(lwin__arS) from $fti_parsedwine__exDB.src_score__acSG where score__arS = $score__arS")->fetchColumn() ?? 0;
  }
  do {
    dop("  Next wine $limit_src rows proceding, arS=$cur__arS, score__arS=$score__arS");
    $sql = 
      "SELECT arS,
        " . ($mode == 2
          ? "WINE_FULL"
          : "concat(WINE_FULL, if(WINE_FULL = '', '', ', '), if(SUB_REGION <> '', SUB_REGION, REGION))"
        ) . " as wine_name,
        -- ifnull(parsed__exDB_vineyard__dsP, '0') as parsed__exDB_vineyard__dsP,
        PRODUCER_FULL,
        ifnull(parsed__exDB_region__dsP, '0') as region__dsP, ifnull(parsed__exDB_region__score, 0) as region__score,
        ifnull(parsed__exDB_co2__tid, 0) as co2, ifnull(parsed__exDB_colour__tid, 0) as color, ifnull(parsed__exDB_country__tid, 0) as country
      from $fti_parsedwine__exDB.lwin__arS
      where 1=1
        and arS > $cur__arS
        " . ($in__arS == '' 
              ? "$filter"
              : "and arS in ($in__arS)"
        ) . "
        -- and arS = 1003594
        and PRODUCER_FULL <> ''
        -- and nfc_gustos_vineyard_name <> ''
      order by arS
      limit $limit_src
    ";
    //d($sql);
    $rows = db_query($sql)->fetchAll();
    $arS = 0;
    foreach ($rows as $row) {
      $cur__arS = $arS = $row->arS;
      switch ($version) {
        case 3:
          $nfc_grape__dsP = parsed__exDB_match__raFTI_v3($row);
          break;
        case 4:
          $nfc_grape__dsP = nfc_match__raFTI_v4($row, $mode);
          break;
      }
      //d($fti_sq['match_r0']);
      if (array_key_exists('match_dbg' ,$fti_var) && $fti_var['match_dbg'] == '1') {
        nfc_setVar('match_dbg', 0);
        dd($fti_sq['match_r0']);
      }
      $nfc_gustos_vineyard_id = $score = $id = 0;
      $nfc_gustos_wine_name = $nfc_gustos_vineyard_name = $nfc_gustos_name = '';
      if (($rows2 = db_query($fti_sq['match_r0'])->fetchAll())) {
        $score = $rows2[0]->score;
        $id = $rows2[0]->wine ?? 0;
        if ($score) {
          $nfc_gustos_wine_name = strtr($rows2[0]->nfc_gustos_wine_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_name = strtr($rows2[0]->nfc_gustos_vineyard_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_id = $rows2[0]->vineyard;
        }
      }
      if ($restore > 0) {
        $sql = 
          "UPDATE $fti_parsedwine__exDB.lwin__arS
            set nfc_gustos_wine__id = $id, nfc_gustos_wine__score = $score, nfc_gustos_wine_name = '$nfc_gustos_wine_name', nfc_grape__dsP = '$nfc_grape__dsP',
                nfc_gustos_vineyard_id = $nfc_gustos_vineyard_id, nfc_gustos_vineyard_name = '$nfc_gustos_vineyard_name'
            where arS = $arS
        ";
        //d($sql);
        db_query($sql);
      } else {
        $sql = 
          "INSERT into $fti_parsedwine__exDB.src_score__acSG
              (score__arS, src__arS, dst__id, score__niQB)
            values"
        ;
        if ($score) {
          foreach($rows2 as $i => $row2) {
            //d($rows2, $i, $row);
            $sql .= ($i ? ',' : '') . "
                ($score__arS, $arS, " . $row2->wine . ", " . $row2->score . ")"
            ;
          }
        } else {
          $sql .= " ($score__arS, $arS, 0, 0)";
        }
        //d($sql);
        db_query($sql);
      }
      echo "\rarS=$arS, id=$id, score=$score, nfc_gustos_name=$nfc_gustos_name";

    }
  } while ($arS);
  dop("NF Wine matching ends.");
}

function _is24297__nfc_laad_wine($reini = 0, $restore = 0, $in__arS = '', $mode = 1, $version = 5) { 
  global $fti_var, $fti_sq, $fti_parsedwine__exDB;
  dop("is24297 Wines matching started: reini=$reini, restore=$restore, in__arS='$in__arS', mode=$mode, version=$version");
  if ($reini) {
    db_query("UPDATE $fti_parsedwine__exDB.is24297__ID_wines set nfc_gustos_wine__id = NULL");
  }
  $score__arS = $cur__arS = 0;
  if ($restore > 0) {
    $filter = "and arS >= (SELECT min(arS) from $fti_parsedwine__exDB.is24297__ID_wines where nfc_gustos_wine__id is null)";
    $limit_src = 10000;
  } else {
    //$filter = "and parsed__exDB_vineyard__dsP <> nfc_gustos_vineyard_id and nfc_gustos_vineyard_id > 0 and parsed__exDB_vineyard__score > 0";
    //$filter = "and WINE_FULL like '%''%'";
    $filter =
        "and ID in (
          SELECT arS
          from $fti_parsedwine__exDB.is24297__ID_wines
          where floor((nfc_gustos_wine__score % 1000) / 100) > floor((nfc_gustos_wine__score % 100) / 10)
        )"
    ;
    $filter = "and 1=1";
    $limit_src = 100000;
    if (!$restore) {
      db_query("INSERT into  $fti_parsedwine__exDB.src_score__arS (description__dsP) values ('src__arS')");
    }
    $score__arS = db_query("SELECT max(arS) from  $fti_parsedwine__exDB.src_score__arS")->fetchColumn() ?? 0;
    if (!$score__arS) {
      $msg = "You are traing to perform matching with continue option (\$restore < 0), but there are no previouse score session in  $fti_parsedwine__exDB.src_score__arS";
      dop($msg);
      throw new Exception($msg);
    }
    $cur__arS = db_query("SELECT max(src__arS) from $fti_parsedwine__exDB.src_score__acSG where score__arS = $score__arS")->fetchColumn() ?? 0;
  }
  do {
    dop("  Next wine $limit_src rows proceding, arS=$cur__arS, score__arS=$score__arS");
    $sql = 
      "SELECT arS,
        concat(
          if(REGEXP_SUBSTR(x.vineyard_name, '\\\\s*\\\\w+(?=\\\\b)') = REGEXP_SUBSTR(x.wine_name , '\\\\s*\\\\w+(?=\\\\b)'), '', concat(x.vineyard_name, ',')),
          x.wine_name
        ) as wine_name,
        x.vineyard_name as PRODUCER_FULL,
        if(x.wine_vintage = 0 , 2023, x.wine_vintage) as vintage, 0 as region__dsP, 0 as color, 0 as co2, 1065 as country
      from $fti_parsedwine__exDB.is24297__ID_wines as x
      where 1=1
        and x.arS > $cur__arS
        " . ($in__arS == '' 
              ? "$filter"
              : "and x.arS in ($in__arS)"
        ) . "
      order by x.arS
      limit $limit_src
    ";
    //d($sql);
    $rows = db_query($sql)->fetchAll();
    $arS = 0;
    foreach ($rows as $row) {
      $cur__arS = $arS = $row->arS;
      if ($version == 'mySQL') {
        $nfc_grape__dsP = nfc_match__myFTI($row);
      } else {
        $nfc_grape__dsP = nfc_match_create_sql__raFTI_v5($row, $mode);
      }
      //d($fti_sq['match_r0']);
      if (array_key_exists('match_dbg' ,$fti_var) && $fti_var['match_dbg'] == '1') {
        nfc_setVar('match_dbg', 0);
        dd($row, $fti_sq['match_r0']);
      }
      $nfc_gustos_vineyard_id = $score = $id = 0;
      $nfc_gustos_wine_name = $nfc_gustos_vineyard_name = $nfc_gustos_name = '';
      if (($rows2 = db_query($fti_sq['match_r0'])->fetchAll())) {
        $score = $rows2[0]->score;
        $id = $rows2[0]->wine ?? 0;
        if ($score) {
          $nfc_gustos_wine_name = strtr($rows2[0]->nfc_gustos_wine_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_name = strtr($rows2[0]->nfc_gustos_vineyard_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_id = $rows2[0]->vineyard;
        }
      }
      if ($restore > 0) {
        $sql = 
          "UPDATE $fti_parsedwine__exDB.is24297__ID_wines
            set nfc_gustos_wine__id = $id, nfc_gustos_wine__score = $score, nfc_gustos_wine_name = '$nfc_gustos_wine_name', nfc_grape__dsP = '$nfc_grape__dsP',
                nfc_gustos_vineyard_id = $nfc_gustos_vineyard_id, nfc_gustos_vineyard_name = '$nfc_gustos_vineyard_name'
            where arS = $arS
        ";
        //d($sql);
        db_query($sql);
      } else {
        $sql = 
          "INSERT into $fti_parsedwine__exDB.src_score__acSG
              (score__arS, src__arS, dst__id, score__niQB)
            values"
        ;
        if ($score) {
          foreach($rows2 as $i => $row2) {
            //d($rows2, $i, $row);
            $sql .= ($i ? ',' : '') . "
                ($score__arS, $arS, " . $row2->wine . ", " . $row2->score . ")"
            ;
          }
        } else {
          $sql .= " ($score__arS, $arS, 0, 0)";
        }
        //d($sql);
        db_query($sql);
      }
      echo "\rarS=$arS, id=$id, score=$score, nfc_gustos_name=$nfc_gustos_name";

    }
  } while ($arS);
  db_query(
    "UPDATE $fti_parsedwine__exDB.is24297__ID_wines as u1
        left join gustosapp.gustos_wine_entity as u2 on u2.wine = u1.nfc_gustos_wine__id and u2.vintage = if(u1.Год = 0, 2023, u1.Год)
        left join (
          select max(a1.vintage) as max_vintage, a1.wine
          from gustosapp.gustos_wine_entity as a1
          group by a1.wine
        ) as u3 on u3.wine = u1.nfc_gustos_wine__id
        left join gustosapp.gustos_wine_entity as u4 on u4.wine = u3.wine and u4.vintage = u3.max_vintage
      set u1.nfc_gustos_wine_entety__id = ifnull(u2.id, u4.id), u1.nfc_gustos_vintage = ifnull(u2.vintage, u4.vintage)
      where u2.id is not null or u4.id is not null
  ");
  dop("NF Wine matching ends.");
}

function mf__ex_laad_wine($reini = 0, $restore = 0, $in__arS = '') { // $mode = (1) / (0) => (use all vineyard synonyms - dups) / (use only 1-st found in lwin)
  global $fti_terme, $fti_terms, $fti_expra, $fti_var, $fti_gustos_db, $fti_parsedwine__exDB;
  dop("MF Wines matching started:");
  $result_limit = 1;
  if ($reini) {
    db_query("UPDATE $fti_parsedwine__exDB.lwin__arS set mf_gustos_wine__id = NULL");
  }
  $cur__arS = $score__arS = 0;
  if ($restore > 0) {
    $filter = "and arS >= (SELECT min(arS) from $fti_parsedwine__exDB.lwin__arS where mf_gustos_wine__id is null)";
    $limit_src = 10000;
  } else {
    //$filter = "and parsed__exDB_vineyard__dsP <> nfc_gustos_vineyard_id and nfc_gustos_vineyard_id > 0 and parsed__exDB_vineyard__score > 0";
    //$filter = "and 1=1";
    //$filter = "and (mf_gustos_wine__score & 1) = 1";
    $filter = 
        "and arS in (
            select x.arS
            from lwin__arS x
            where ((floor(x.nfc_gustos_wine__score / 10000) % 100) & 16) > 0
          )"
    ;
    $limit_src = 10000;
    if (!$restore) {
      db_query("INSERT into  $fti_parsedwine__exDB.src_score__arS (description__dsP) values ('lwin__arS')");
    }
    $score__arS = db_query("SELECT max(arS) from  $fti_parsedwine__exDB.src_score__arS")->fetchColumn();
    if (!$score__arS) {
      $msg = "You are traing to perform matching with continue option (\$restore < 0), but there are no previouse score session in  $fti_parsedwine__exDB.src_score__arS";
      dop($msg);
      throw new Exception($msg);
    }
    $cur__arS = db_query("SELECT max(lwin__arS) from $fti_parsedwine__exDB.src_score__acSG where score__arS = $score__arS")->fetchColumn() ?? 0;
  }
  do {
    dop("  Next wine $limit_src rows proceding. score__arS=$score__arS");
    $sql = 
      "SELECT arS,
        replace(if(WINE_FULL <> '' OR SUB_REGION <> '' OR REGION = '', WINE_FULL, concat(WINE_FULL, ',', REGION)), '''', '''''') as wine_name,
        replace(ifnull(PRODUCER_FULL, ''), '''', '''''') as parsed__exDB_vineyard__dsP,
        ifnull(parsed__exDB_region__dsP, '0') as parsed__exDB_region__dsP, ifnull(parsed__exDB_region__score, 0) as parsed__exDB_region__score,
        ifnull(parsed__exDB_co2__tid, 0) as parsed__exDB_co2__tid, ifnull(parsed__exDB_colour__tid, 0) as parsed__exDB_colour__tid, ifnull(parsed__exDB_country__tid, 0) as parsed__exDB_country__tid
      from $fti_parsedwine__exDB.lwin__arS
      where 1=1
        and arS > $cur__arS
        " . ($in__arS == '' 
              ? "$filter"
              : "and arS in ($in__arS)"
        ) . "
        -- and arS = 1003594
      order by arS
      limit $limit_src
    ";
    //d($sql);
    $rows = db_query($sql)->fetchAll();
    $sc_base = 1000000;
    $sc_base_x2 = $sc_base * 2;
    $sc_base_x3 = $sc_base * 3;
    $sc_base_x4 = $sc_base * 4;
    $sc_base_x5 = $sc_base * 5;
    $sc_base_x6 = $sc_base * 6;
    $sc_base_x8 = $sc_base * 8;
    $wine__dsP = $word__in = '0';
    $arS = 0;
    foreach ($rows as $row) {
      //d(norm_it($row->wine_name), $wine_words, $fti_expra, $fti_terms, $fti_terme);
      $nfc_gustos_vineyard_id = $score = $id = 0;
      $nfc_gustos_wine_name = $nfc_gustos_vineyard_name = $nfc_gustos_name = '';
      $cur__arS = $arS = $row->arS;
      $wine_name = $row->wine_name;
      $producer__dsP = $row->parsed__exDB_vineyard__dsP;
      $parsed__exDB_country__tid = $row->parsed__exDB_country__tid;
      $colour = $row->parsed__exDB_colour__tid;
      $co2 = $row->parsed__exDB_co2__tid;
      $sql = 
        "SELECT
          if (rel0 = 0 or match_wine_name_score > 40, round(match_wine_name_score * 50) * 10000 + 2, 20000001)
            + round(match_vineyard_name_score * 50) * 10000 + if(match_vineyard_name_score > 0, 800, 0)
            + if(b1.color = 0 or $colour = 0, 0, if(b1.color = $colour, $sc_base_x2 + 400, -$sc_base_x2))
            + if(b1.co2 = 0 or $co2 = 0, 0, if(b1.co2 = $co2, $sc_base_x2 + 200, -$sc_base_x2))
          as score,
          b1.w_id as wine, b1.w_name as nfc_gustos_wine_name,
          b1.v_id as vineyard, b1.v_name as nfc_gustos_vineyard_name
        from (
          select v.id as v_id, v.name as v_name, gw.id as w_id, gw.name as w_name,
            gw.name = '$wine_name' as rel0,
            MATCH (gw.name) AGAINST ('$wine_name') AS match_wine_name_score,
            MATCH (v.name) AGAINST ('$producer__dsP') AS match_vineyard_name_score,
            cast(substring_index(gw.category, '\"co2\":', -1) as int) co2,
            gw.color
          from $fti_gustos_db.gustos_wine as gw
            inner join $fti_gustos_db.vineyard as v on v.id = gw.vineyard
          where gw.country = $parsed__exDB_country__tid
        ) b1
        where 1<>1
          or rel0 = 1
          or match_wine_name_score
          or match_vineyard_name_score
        order by score desc
        limit $result_limit
      ";
      if (array_key_exists('match_dbg' ,$fti_var) && $fti_var['match_dbg'] == '1') {
        nfc_setVar('match_dbg', 0);
        dd($sql);
      }
      if (($rows2 = db_query($sql)->fetchAll())) {
        $score = $rows2[0]->score;
        $id = $rows2[0]->wine;
        if ($score) {
          $nfc_gustos_wine_name = strtr($rows2[0]->nfc_gustos_wine_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_name = strtr($rows2[0]->nfc_gustos_vineyard_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_id = $rows2[0]->vineyard;
        }
      }
      if ($restore > 0) {
        $sql = 
          "UPDATE $fti_parsedwine__exDB.lwin__arS
            set mf_gustos_wine__id = $id, mf_gustos_wine__score = $score, mf_gustos_wine_name = '$nfc_gustos_wine_name',
                mf_gustos_vineyard_id = $nfc_gustos_vineyard_id, mf_gustos_vineyard_name = '$nfc_gustos_vineyard_name'
            where arS = $arS
        ";
        //d($sql);
        db_query($sql);
      } else {
        $sql = 
          "INSERT into $fti_parsedwine__exDB.src_score__acSG
              (score__arS, src__arS, dst__id, score__niQB)
            values"
        ;
        if ($score) {
          foreach($rows2 as $i => $row2) {
            //d($rows2, $i, $row);
            $sql .= ($i ? ',' : '') . "
                ($score__arS, $arS, " . $row2->wine . ", " . $row2->score . ")"
            ;
          }
        } else {
          $sql .= "($score__arS, $arS, 0, 0)";
        }
        //d($sql);
        db_query($sql);
      }
      echo "\rarS=$arS, id=$id, score=$score, nfc_gustos_name=$nfc_gustos_name";

    }
  } while ($arS);
  dop("MF Wine matching ends.");
}

function parsed__exDB_save_score($src = 'nf', $tab = 'lwin__arS') {
  global $fti_parsedwine__exDB;
  $tab = "$fti_parsedwine__exDB.$tab";
  db_query("INSERT into  $fti_parsedwine__exDB.src_score__arS (description__dsP) values ('lwin__arS')");
  $score__arS = db_query("SELECT max(arS) from  $fti_parsedwine__exDB.src_score__arS")->fetchColumn();
  dop("LWIN ($src) Scores saving start for session arS=$score__arS.");
  db_query(
    "INSERT INTO $fti_parsedwine__exDB.src_score__acSG
        (score__arS, src__arS, dst__id, score__niQB)
      select
        $score__arS, arS, {$src}_gustos_wine__id, {$src}_gustos_wine__score
      from {$tab}
      where 1=1
--        and parsed__exDB_type__tid > 0
  ");
  dop("LWIN ($src) Number of scores saved: " . db_query("SELECT ROW_COUNT() as cnt")->fetchColumn());
}


function parsed__exDB_restore_score($src = 'nf', $tab = 'lwin__arS') {
  global $fti_gustos_db, $fti_parsedwine__exDB;
  $tab = "$fti_parsedwine__exDB.$tab";
  $rows = db_query("SELECT arS, description__dsP from  $fti_parsedwine__exDB.src_score__arS order by arS desc limit 1")->fetchAll();
  if (empty($rows)) {
    $msg = "Error 1 - parsed__exDB_restore_score - no data to restore!";
    dop($msg);
    throw new Exception($msg);
  }
  if ($rows[0]->description__dsP != 'lwin__arS') {
    $msg = "Error 2 - parsed__exDB_restore_score - the last stored data in lwin_score_arS is not correct: (description__dsP != 'lwin__arS')";
    dop($msg);
    throw new Exception($msg);
  }
  $score__arS = $rows[0]->arS;
  dop("LWIN: ($src) Scores restoring start for score session arS=$score__arS.");
  db_query(
    "UPDATE {$tab} as u1
      inner join (
        select lwin__arS, ifnull(a1.id, 0) as wine_id, ifnull(a2.name, '') as wine_name, ifnull(a3.id, 0) as vine_id, ifnull(a3.name, '') as vine_name, score__niQB
        from $fti_parsedwine__exDB.src_score__acSG as a1
          left join $fti_gustos_db.gustos_wine as a2 on a2.id = a1.id
          left join $fti_gustos_db.vineyard as a3 on a3.id = a2.vineyard
        where score__arS = $score__arS
      ) as u2 on u2.lwin__arS = u1.arS
      set u1.{$src}_gustos_wine__score = u2.score__niQB,
          u1.{$src}_gustos_wine__id = u2.wine_id, u1.{$src}_gustos_wine_name = u2.wine_name,
          u1.{$src}_gustos_vineyard_id = u2.vine_id, u1.{$src}_gustos_vineyard_name = u2.vine_name
  ");
  dop("LWIN: ($src) Number of scores restored: " . db_query("SELECT ROW_COUNT() as cnt")->fetchColumn());
}

function parsed__exDB_producer_save_score() {
  global $fti_parsedwine__exDB;
  db_query("INSERT into  $fti_parsedwine__exDB.src_score__arS (description__dsP) values ('lwin__arS_producer')");
  $score__arS = db_query("SELECT max(arS) from  $fti_parsedwine__exDB.src_score__arS")->fetchColumn();
  dop("LWIN_producer Scores saving start.");
  db_query(
    "INSERT INTO $fti_parsedwine__exDB.src_score__acSG
        (score__arS, src__arS, dst__id, score__niQB)
      select
        $score__arS, arS, id, parsed__exDB_vineyard__score
      from $fti_parsedwine__exDB.lwin__arS_producer
  ");
  dop("LWIN_producer Number of scores saved: " . db_query("SELECT ROW_COUNT() as cnt")->fetchColumn());
}

function parsed__exDB_save_db() {
  global $fti_parsedwine__exDB;
  $rows = db_query(
    "SELECT table_name
      from information_schema.tables
      where 1=1
        and table_schema = '$fti_parsedwine__exDB'
        and table_name like 'lwin\_%'
  ")->fetchAll(\PDO::FETCH_COLUMN);
  //d($rows);
  dop("LWIN_db tables saving start. Tables number: " . count($rows));
  $reca = 0;
  foreach ($rows as $table) {
    echo "\rTable($table), records: ?";
    db_query("TRUNCATE lwin.$table");
    db_query(
      "INSERT INTO $fti_parsedwine__exDB.$table select * from $fti_parsedwine__exDB.$table
    ");
    $recs = db_query("SELECT ROW_COUNT()")->fetchColumn();
    $reca += $recs;
    echo "\rTable($table), records: $recs\n";
  }
  dop("LWIN_db tables saved records number: $reca");
}

function parsed__exDB_resore_db() {
  global $fti_parsedwine__exDB;
  $rows = db_query(
    "SELECT table_name
      from information_schema.tables
      where 1=1
        and table_schema = '$fti_parsedwine__exDB'
        and table_name like 'lwin\_%'
  ")->fetchAll(\PDO::FETCH_COLUMN);
  //d($rows);
  dop("LWIN_db tables saving start. Tables number: " . count($rows));
  $reca = 0;
  foreach ($rows as $table) {
    echo "\rTable($table), records: ?";
    db_query("TRUNCATE $fti_parsedwine__exDB.$table");
    db_query(
      "INSERT INTO $fti_parsedwine__exDB.$table select * from $fti_parsedwine__exDB.$table
    ");
    $recs = db_query("SELECT ROW_COUNT()")->fetchColumn();
    $reca += $recs;
    echo "\rTable($table), records: $recs\n";
  }
  dop("LWIN_db tables saved records number: $reca");
}

function _w2t_change_columns() {
  $rows = db_query("SELECT * from _w2t_tbales_fields_changed")->fetchAll();
  $sql = '';
  foreach ($rows as $row) {
    $cols = explode(",\n", $row->column);
    foreach ($cols as $col) {
      $pars = explode('` ', $col);
      // if ($row->id == 2) dd($row->column, $cols, $col, $pars, explode(' ', ltrim($pars[0]))[0], explode(' ', ltrim($pars[1]))[0], $sql);
      if (!isset($pars[1])) {
        break;
      }
      $sql .=  "ALTER TABLE " . $row->table . " MODIFY " . trim($pars[0]) . '` ' . trim($pars[1]) . ";\n"
      ;
    }

  }
  $sql = strtr($sql, [',;' => ';']);
  echo $sql;
}

function _is24726__preload_prepare() {
  global $fti_tables, $fti_gustos_db, $fti_sq, $fti_parsedwine__exDB;
  db_query(
    "UPDATE $fti_parsedwine__exDB.is24726_Wine_Republic_v4
      set wine_name =
        replace(
          replace(
            replace(
              replace(wine_name, 'EtCeter', 'Et Cetera'
              ), 'TerraDacia', 'Terra Dacia'
            ), 'IceWine', 'Ice Wine'
          ), 'AlterEgo', 'Alter Ego'
        )
  ");
  $msg = "_is24726__preload_prepare - updated bad name ligatures: " . db_query("SELECT ROW_COUNT()")->fetchColumn();
  dop($msg);
  $sql_s =
    "SELECT arS, regexp_replace(wine_name, '\\\\d\\\\d\\\\d\\\\d', '') wine_name, regexp_substr(wine_name, '\\\\d\\\\d\\\\d\\\\d') wine_vintage
      from $fti_parsedwine__exDB.is24726_Wine_Republic_v4
      where wine_name regexp '\\\\d\\\\d\\\\d\\\\d'
  ";
  db_query(
    "UPDATE $fti_parsedwine__exDB.is24726_Wine_Republic_v4 as u1
      inner join ($sql_s) as u2 on u2.arS = u1.arS
      set u1.wine_name = u2.wine_name, u1.wine_vintage = u2.wine_vintage
  ");
  $msg = "_is24726__preload_prepare - extract from name vintage: " . db_query("SELECT ROW_COUNT()")->fetchColumn();
  dop($msg);
  $sql_s =
    "SELECT a1.arS, a2.tid
      from $fti_parsedwine__exDB.is24726_Wine_Republic_v4 as a1
        left join $fti_gustos_db.taxonomy_term_data as a2 on a2.vid = 2 and a2.name = a1.color
      where a2.tid is not null
  ";
  db_query(
    "UPDATE $fti_parsedwine__exDB.is24726_Wine_Republic_v4 as u1
      inner join ($sql_s) as u2 on u2.arS = u1.arS
      set u1.color__tid = u2.tid
  ");
  $msg = "_is24726__preload_prepare - translate color to color__tid: " . db_query("SELECT ROW_COUNT()")->fetchColumn();
  dop($msg);
}

function parsed__exDB_laad_wine($src_table, $reini = 0, $restore = 0, $in__arS = '', $mode = 1, $version = 4) {
  global $fti_parsedwine__exDB, $fti_var, $fti_sq;
  dop("$src_table Wines matching started: reini=$reini, restore=$restore, in__arS='$in__arS', mode=$mode, version=$version");
  if ($reini) {
    db_query("UPDATE $fti_parsedwine__exDB.$src_table set nfc_gustos_wine__id = NULL");
  }
  $score__arS = $cur__arS = 0;
  if ($restore > 0) {
    $filter = "and arS >= (SELECT min(arS) from $fti_parsedwine__exDB.$src_table where nfc_gustos_wine__id is null)";
    $limit_src = 10000;
  } else {
    //$filter = "and parsed__exDB_vineyard__dsP <> nfc_gustos_vineyard_id and nfc_gustos_vineyard_id > 0 and parsed__exDB_vineyard__score > 0";
    //$filter = "and WINE_FULL like '%''%'";
    $filter =
        "and ID in (
          SELECT arS
          from $fti_parsedwine__exDB.$src_table
          where floor((nfc_gustos_wine__score % 1000) / 100) > floor((nfc_gustos_wine__score % 100) / 10)
        )"
    ;
    $filter = "and 1=1";
    $limit_src = 100000;
    if (!$restore) {
      db_query("INSERT into  $fti_parsedwine__exDB.src_score__arS (description__dsP) values ('$src_table')");
    }
    $score__arS = db_query("SELECT max(arS) from  $fti_parsedwine__exDB.src_score__arS")->fetchColumn() ?? 0;
    if (!$score__arS) {
      $msg = "You are traing to perform matching with continue option (\$restore < 0), but there are no previouse score session in  $fti_parsedwine__exDB.src_score__arS";
      dop($msg);
      throw new Exception($msg);
    }
    $cur__arS = db_query("SELECT max(src__arS) from $fti_parsedwine__exDB.src_score__acSG where score__arS = $score__arS")->fetchColumn() ?? 0;
  }
  do {
    dop("  Next wine $limit_src rows proceding, arS=$cur__arS, score__arS=$score__arS");
    $sql = 
      "SELECT arS, wine_name,
        x.vineyard_name as PRODUCER_FULL,
        if(ifnull(x.wine_vintage, 0) = 0 , 2024, x.wine_vintage) as vintage, 0 as region__dsP, ifnull(color__tid, 0) as color, 0 as co2, 1065 as country
      from $fti_parsedwine__exDB.$src_table as x
      where 1=1
        and x.arS > $cur__arS
        " . ($in__arS == '' 
              ? "$filter"
              : "and x.arS in ($in__arS)"
        ) . "
      order by x.arS
      limit $limit_src
    ";
    //d($sql);
    $rows = db_query($sql)->fetchAll();
    $arS = 0;
    foreach ($rows as $row) {
      $cur__arS = $arS = $row->arS;
      if ($version == 'mySQL') {
        $nfc_grape__dsP = nfc_match__myFTI($row);
      } else {
        $nfc_grape__dsP = nfc_match__raFTI_v4($row, $mode);
      }
      //d($fti_sq['match_r0']);
      if (array_key_exists('match_dbg' ,$fti_var) && $fti_var['match_dbg'] == '1') {
        nfc_setVar('match_dbg', 0);
        dd($row, $fti_sq['match_r0']);
      }
      $nfc_gustos_vineyard_id = $score = $id = 0;
      $nfc_gustos_wine_name = $nfc_gustos_vineyard_name = $nfc_gustos_name = '';
      if (($rows2 = db_query($fti_sq['match_r0'])->fetchAll())) {
        $score = $rows2[0]->score;
        $id = $rows2[0]->wine ?? 0;
        if ($score) {
          $nfc_gustos_wine_name = strtr($rows2[0]->nfc_gustos_wine_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_name = strtr($rows2[0]->nfc_gustos_vineyard_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_id = $rows2[0]->vineyard;
        }
      }
      if ($restore > 0) {
        $sql = 
          "UPDATE $fti_parsedwine__exDB.$src_table
            set nfc_gustos_wine__id = $id, nfc_gustos_wine__score = $score, nfc_gustos_wine_name = '$nfc_gustos_wine_name', nfc_grape__dsP = '$nfc_grape__dsP',
                nfc_gustos_vineyard_id = $nfc_gustos_vineyard_id, nfc_gustos_vineyard_name = '$nfc_gustos_vineyard_name'
            where arS = $arS
        ";
        //d($sql);
        db_query($sql);
      } else {
        $sql = 
          "INSERT into $fti_parsedwine__exDB.src_score__acSG
              (score__arS, src__arS, dst__id, score__niQB)
            values"
        ;
        if ($score) {
          foreach($rows2 as $i => $row2) {
            //d($rows2, $i, $row);
            $sql .= ($i ? ',' : '') . "
                ($score__arS, $arS, " . $row2->wine . ", " . $row2->score . ")"
            ;
          }
        } else {
          $sql .= " ($score__arS, $arS, 0, 0)";
        }
        //d($sql);
        db_query($sql);
      }
      echo "\rarS=$arS, id=$id, score=$score, nfc_gustos_name=$nfc_gustos_name";

    }
  } while ($arS);
  db_query(
    "UPDATE $fti_parsedwine__exDB.$src_table as u1
        left join gustosapp.gustos_wine_entity as u2 on 1=1
        	and u2.wine = u1.nfc_gustos_wine__id
        	and u2.vintage = if(ifnull(u1.wine_vintage, 0) = 0, 2024, u1.wine_vintage)
        left join (
          select max(a1.vintage) as max_vintage, a1.wine
          from gustosapp.gustos_wine_entity as a1
          group by a1.wine
        ) as u3 on u3.wine = u1.nfc_gustos_wine__id
        left join gustosapp.gustos_wine_entity as u4 on u4.wine = u3.wine and u4.vintage = u3.max_vintage
        left join gustosapp.third_party_vivino_wine_entity as u5 on u5.wine_entity_id = ifnull(u2.id, u4.id)
      set u1.nfc_gustos_wine_entety__id = ifnull(u2.id, u4.id),
          u1.nfc_gustos_vintage = ifnull(u2.vintage, u4.vintage),
          u1.vivino_wine_id = u5.vivino_wine_id,
          u1.verified = u5.verified,
          u1.gwmr = if(u2.id is null, u4.gwmr, u2.gwmr),
          u1.gwr = if(u2.id is null, u4.gwr, u2.gwr)
      where u2.id is not null or u4.id is not null
  ");
  dop("NF Wine matching ends.");
}

function _is24956_Wines_Croitoru__laad($reini = 0, $restore = 0, $in__arS = '', $limit_dst = 1, $sq_mode = 1, $version = 5) { 
  global $fti_var, $fti_sq, $fti_row, $fti_seg, $fti_expra, $fti_parsedwine__exDB;
  $table_ex_ = "$fti_parsedwine__exDB.src_is24956_Wines_Croitoru";
  dop("is24956 Wines matching started: reini=$reini, restore=$restore, in__arS='$in__arS', mode=$sq_mode, version=$version");
  if ($reini) {
    db_query("UPDATE $table_ex_ set nfc_gustos_wine__id = NULL");
  }
  $score__arS = $cur__arS = 0;
  if ($restore > 0) {
    $filter = "and arS >= (SELECT min(arS) from $table_ex_ where nfc_gustos_wine__id is null)";
    $limit_src = 10000;
  } else {
    //$filter = "and parsed__exDB_vineyard__dsP <> nfc_gustos_vineyard_id and nfc_gustos_vineyard_id > 0 and parsed__exDB_vineyard__score > 0";
    //$filter = "and WINE_FULL like '%''%'";
    $filter =
        "and ID in (
          SELECT arS
          from $table_ex_
          where floor((nfc_gustos_wine__score % 1000) / 100) > floor((nfc_gustos_wine__score % 100) / 10)
        )"
    ;
    $filter = "and 1=1";
    $limit_src = 100000;
    if (!$restore) {
      $destination__dsP = "$table_ex_ - ver: $version";
      db_query("INSERT into  $fti_parsedwine__exDB.src_score__arS (description__dsP, limit_dst, mode__niSB) values ('$destination__dsP', $limit_dst, $sq_mode)");
    }
    $score__arS = db_query("SELECT max(arS) from  $fti_parsedwine__exDB.src_score__arS")->fetchColumn() ?? 0;
    if (!$score__arS) {
      $msg = "You are traing to perform matching with continue option (\$restore < 0), but there are no previouse score session in  $fti_parsedwine__exDB.src_score__arS";
      dop($msg);
      throw new Exception($msg);
    }
    $cur__arS = db_query("SELECT max(src__arS) from $fti_parsedwine__exDB.src_score__acSG where score__arS = $score__arS")->fetchColumn() ?? 0;
  }

  load_regions();
  load_vineyards();
  load_blends();

  do {
    dop("  Next wine $limit_src rows proceding, arS=$cur__arS, score__arS=$score__arS");
    $sql = 
      "SELECT 0 as id,
        arS, `name`, 0 as vineyard, 0 as country, 0 as color, 0 as co2,
        vintage__dsP as vintage, '' as region, '0' as grape,
        0 as blend__cnt, 0 as co2
      from $table_ex_ as x
      where 1=1
        and x.arS > $cur__arS
        " . ($in__arS == '' 
              ? "$filter"
              : "and x.arS in ($in__arS)"
        ) . "
      order by x.arS
      limit $limit_src
    ";
    //d($sql);
    $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $arS = 0;
    $sql_u = $sql_i = $name = '';
    foreach ($rows as $fti_row) {
      $arS = $fti_row['arS'];
      $cur__arS = $arS;
      if ($version == 'msf') {
        echo "\rarS=$arS, " . str_pad($fti_row['name'], 120);
        nfc_match_create_sql__MySqlFTI();
        //echo "\n" . $fti_sq['match_r0'] . "\n";
      } else {
        $norm_name = reg_wine_attr(0);
        eval(extrace('fti_row'));
        echo "\rarS=$arS, " . str_pad("$name/$norm_name", 120);
        if ($vintage != '') {
          $vintage = "%,$vintage,%";
        } else {
          preg_match("/\d+(?= yo\b)/u", $norm_name, $m);
          $vintage = (count($m) ? "%," . $m[0] . ",%" : '');
        }
        nfc_match_create_sql__raFTI_v5($limit_dst, $sq_mode); // sq_mode = 0/1 - exclude/include wine and vineyard names from result
      }

      $sc_exe = $sc_base = $wine_entity_id = $wine_entity_year = $nfc_word__cnt = $word__cnt = $nfc_gustos_vineyard_id = $score = $id = 0;
      $nfc_grape__dsP = $nfc_gustos_wine_name = $nfc_gustos_vineyard_name = '';
      try {
        $rows2 = db_query($fti_sq['match_r0'])->fetchAll();
      } catch (Exception $e) {
        $errs = $e->getMessage();
        $msg = "ErrFTI(match_r0__P_1) name=($name) $errs";
        echo "\nSQL=\n" . $fti_sq['match_r0'] . "\n";
        dd($msg);
      }
      if (($rows2)) {
        $score = $rows2[0]->score;
        $id = $rows2[0]->wine ?? 0;
        if ($score) {
          if ($version != 'msf') {
            $ids = explode(',', $rows2[0]->vintage__ids);
            $vints = explode(',', $rows2[0]->vintage__dsP);
            $nfc_word__cnt = $rows2[0]->nfc_word__cnt;
            $word__cnt = $rows2[0]->word__cnt;
            $nfc_grape__dsP = $rows2[0]->nfc_grape__dsP;
            $wine_entity_id = end($ids);
            $wine_entity_year = end($vints);
            $sc_exe = $rows2[0]->sc_exe; $sc_base = $rows2[0]->sc_base;
          }
          $nfc_gustos_wine_name = strtr($rows2[0]->nfc_gustos_wine_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_name = strtr($rows2[0]->nfc_gustos_vineyard_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_id = $rows2[0]->nfc_gustos_vineyard_id;
        }
      }
      try {
        //d($sql);
        if ($version == 'msf') {
          $sql_u = 
          "UPDATE $table_ex_ as u1
            set
              msf_wine__id = $id, msf_score = $score, msf_wine_name = '$nfc_gustos_wine_name',
              msf_vineyard_id = $nfc_gustos_vineyard_id, msf_vineyard_name = '$nfc_gustos_vineyard_name'
            where u1.arS = $arS
          ";
        } else {
          $sql_u = 
          "UPDATE $table_ex_ as u1
            set 
              vineyard = $vineyard, countries = '$countries', color = $color, co2 = $co2,
              vintage__dsP = '$vintage', grape__dsP = '$grape', grape__cnt = $blend__cnt, word__cnt = $word__cnt,
              regi__dsP = '$region', attrTYPE__arS = $attrTYPE__arS, attrTITLE__arS = $attrTITLE__arS, norm_name = '$norm_name',
              regi__path = '$regi__path', vine__name = '$vine__name',
              nfc_gustos_wine__id = $id, nfc_gustos_wine__score = $score, nfc_gustos_wine_name = '$nfc_gustos_wine_name', nfc_grape__dsP = '$nfc_grape__dsP',
              nfc_gustos_vineyard_id = $nfc_gustos_vineyard_id, nfc_gustos_vineyard_name = '$nfc_gustos_vineyard_name',
              nfc_word__cnt = $nfc_word__cnt,
              nfc_gustos_wine_entity__id = $wine_entity_id, nfc_gustos_vintage = $wine_entity_year,
              sc_limit = if($sc_exe > 0, ($score / $sc_base / $sc_exe), sc_limit)
            where u1.arS = $arS
          ";
        }
        //echo "\n\nsql_u\n\n$sql_u\n\n";
        db_query($sql_u);
        $sql_i = 
          "INSERT into $fti_parsedwine__exDB.src_score__acSG
              (score__arS, src__arS, el__id, dst__id, score__niQB)
            values"
        ;
        if ($score) {
          foreach($rows2 as $i => $row2) {
            //d($rows2, $i, $row);
            $sql_i .= ($i ? ',' : '') . "
                ($score__arS, $arS, $i, " . $row2->wine . ", " . $row2->score . ")"
            ;
          }
        } else {
          $sql_i .= " ($score__arS, $arS, 0, 0, 0)";
        }
        //d($sql);
        db_query($sql_i);
        //d($rows2,$sql_u,$sql_i);
      } catch (Exception $e) {
        $errs = $e->getMessage();
        $msg = "ErrFTI(match_r0__P_2) name=($name)\n $errs\nsql_u\n$sql_u\nsql_i\n$sql_i\n";
        echo "\nSQL=\n" . $fti_sq['match_r0'] . "\n$msg";
        exit;
      }
    }
  } while ($arS);
  dop("NF Wine matching ends.");
  dop("  8a - 1 - All wine entries: " . db_query("SELECT count(*) from $table_ex_")->fetchColumn());
  dop("  8a - 2 - REGIs found: " . $fti_sq['wine']['regi']);
  dop("  8a - 3 - VINEs found: " . $fti_sq['wine']['vine']);
  dop("  8a - 4 - GRAPs found: " . $fti_sq['wine']['grap']);
  dop("  8a - 5 - COLORs found: " . $fti_sq['wine']['color']);
  dop("  8a - 6 - GO2s found: " . $fti_sq['wine']['co2']);
  dop("NF Wine matching ends.");
}

function parsed__exDB_init() {
  global $fti_src, $fti_src_col, $fti_parsedwine__exDB;
  $fti_src = [
    'alcomarket' =>
          "SELECT arS,
            if(a1.Brand_name regexp '\\\\bother', '', regexp_replace(a1.Brand_name, '\\\\b((no |)brand) ?', '')) as Brand_name,
            regexp_replace(a1.Wine_name, '\\\\d+([[:punct:]]|\\\\s*((m|)l\\\\b)|)', '') as Wine_name,
            a1.Description, a1.Grape as grape_type, a1.Producer_name,
            if(a1.Country regexp '\\\\bother', '', a1.Country) as Country_name,
            REGEXP_SUBSTR(a1.Description, '\\\\d\\\\d\\\\d\\\\d') as vintage,
            a1.Color as color_name, '' co2_name, '' region_type
          FROM $fti_parsedwine__exDB.src_is25559_alcomarket a1
    ",
    'carpe_diem' =>
          "SELECT arS,
            '' as Brand_name,
            regexp_replace(a1.Wine_name, '\\\\d+([[:punct:]]|\\\\s*((m|)l\\\\b)|)', '') as Wine_name,
            a1.Description, a1.Variety as grape_type, a1.Producer as Producer_name, 
            if(a1.Country_of_origin regexp '\\\\bother', '', a1.Country_of_origin) as Country_name,
            if(a1.Vintage <> '', a1.Vintage, REGEXP_SUBSTR(a1.Description, '\\\\d\\\\d\\\\d\\\\d')) as vintage,
            a1.Colour as color_name, if(a1.Category = 'wines', 'still', a1.Category) as co2_name, '' region_type
          FROM $fti_parsedwine__exDB.src_is25559_carpe_diem a1
    ",
    'linella' =>
          "SELECT arS,
            if(a1.Brend_name regexp '\\\\bother', '', regexp_replace(a1.Brend_name, '\\\\b((no |)brand) ?', '')) as Brand_name,
            regexp_replace(a1.Wine_name, '\\\\d+([[:punct:]]|\\\\s*((m|)l\\\\b)|)', '') as Wine_name, a1.Description, '' as grape_type,
            '' Producer_name, '' as Country_name,
            REGEXP_SUBSTR(a1.Description, '\\\\d\\\\d\\\\d\\\\d') as vintage,
            a1.Wine_type as color_name, a1.Category as co2_name, '' region_type
          FROM $fti_parsedwine__exDB.src_is25559_linella a1
    ",
    'vincuvin' =>
          "SELECT arS,
            if(a1.Brand_name regexp '\\\\bother', '', regexp_replace(a1.Brand_name, '\\\\b((no |)brand) ?', '')) as Brand_name,
            regexp_replace(a1.Wine_name, '\\\\d+([[:punct:]]|\\\\s*((m|)l\\\\b)|)', '') as Wine_name, a1.Description, a1.Grapes as grape_type,
            '' Producer_name,
            if(a1.Country regexp '\\\\bother', '', a1.Country) as Country_name,
            if(a1.Vintage <> '', a1.Vintage, REGEXP_SUBSTR(a1.Description, '\\\\d\\\\d\\\\d\\\\d')) as vintage,
            '' as color_name, a1.Category as co2_name, a1.Region as region_type
          FROM $fti_parsedwine__exDB.src_is25559_vincuvin a1
    ",
    'wine_md' =>
          "SELECT arS,
            if(a1.Brand_name regexp '\\\\bother', '', regexp_replace(a1.Brand_name, '\\\\b((no |)brand) ?', '')) as Brand_name,
            regexp_replace(a1.Wine_name, '\\\\d+([[:punct:]]|\\\\s*((m|)l\\\\b)|)', '') as Wine_name, a1.Description, a1.Grapes as grape_type,
            '' Producer_name,
            if(a1.Country regexp '\\\\bother', '', a1.Country) as Country_name,
            if(a1.`Year` <> '', a1.`Year`, REGEXP_SUBSTR(a1.Description, '\\\\d\\\\d\\\\d\\\\d')) as vintage,
            '' as color_name, '' as co2_name, '' region_type
          FROM $fti_parsedwine__exDB.src_is25559_wine_md a1
    ",
    'wine_time' =>
          "SELECT arS,
            if(a1.Brand_name regexp '\\\\bother', '', regexp_replace(a1.Brand_name, '\\\\b((no |)brand) ?', '')) as Brand_name,
            regexp_replace(a1.Wine_name, '\\\\d+([[:punct:]]|\\\\s*((m|)l\\\\b)|)', '') as Wine_name, a1.Description,
            if(arS = 810, '',
              REGEXP_REPLACE(REGEXP_SUBSTR(a1.Description, '(strugur(i|e)(:|)(?! ?(tip|selec|aten))|soi(:|\\\\b)(?!\\\\s*((de|vin)\\\\b|select)))\\\\K.*?(?=(Culoar|Alc|ABV|Tip\\b|Continut|:|\\n))'), '\\\\d+\\\\s*%?|și', ','
            )) as grape_type,
            '' Producer_name, '' Country_name,
            if(a1.Description regexp '\\\\d\\\\d\\\\d\\\\d', REGEXP_SUBSTR(a1.Description, '\\\\d\\\\d\\\\d\\\\d'), REGEXP_SUBSTR(a1.Wine_name, '\\\\d\\\\d\\\\d\\\\d')
            ) as vintage,
            a1.Category as color_name, a1.Subcategory as co2_name, '' region_type
          FROM $fti_parsedwine__exDB.src_is25559_wine_time a1
    ",
    'metro_parsing' =>
          "SELECT arS,
            if(a1.`Marcă_comercială` regexp '\\\\bother', '', regexp_replace(a1.`Marcă_comercială`, '\\\\b((no |)brand) ?', '')) as Brand_name,
            regexp_replace(a1.Numele_vinului, '\\\\d+([[:punct:]]|\\\\s*((m|)l\\\\b)|)', '') as Wine_name,
            a1.Descrierea_produsului as `Description`,
            a1.Soi as grape_type,
            a1.`Producător` as Producer_name,
            if(a1.`Țară` regexp '\\\\bother', '', a1.`Țară`) as Country_name,
            '' as vintage,
            a1.Culoarea as color_name, '' co2_name, '' region_type
          FROM $fti_parsedwine__exDB.src_is25559_metro_parsing a1
    ",
    'gw_without_medals' =>
          "SELECT arS,
            Country as Country_name,
            XYZ, Gustos_vintage_ID, VivinoAnalogs,
            '' as grape_type,
            '' as color_name, '' as co2_name, '' region_type,
            '' as src_Wine_name, '' as src_Winemaker,  0  as src_Year, 0 as src_Wine_id, 0 as src_Vintage_id, 0 as src_Rating
          FROM $fti_parsedwine__exDB.src_is25559_gw_without_medals a1
    ",
    '25669_gw_without_medals' =>
          "SELECT arS,
            country as Country_name,
            vintage_id as Gustos_vintage_ID, VivinoAnalogs,
            '' as grape_type,
            '' as color_name, '' as co2_name, '' region_type,
            '' as src_Wine_name, '' as src_Winemaker,  0  as src_Year, 0 as src_Wine_id, 0 as src_Vintage_id, 0 as src_Rating, '' as src_grape_type
          FROM $fti_parsedwine__exDB.src_is25559_25669_gw_without_medals a1
    ",
    'parse_armenia' =>
          "SELECT arS,
            '' as Brand_name,
            a1.title as Wine_name,
            a1.extra_data as `Description`,
            a1.grape_variety as grape_type,
            a1.producer as Producer_name,
            a1.country as Country_name,
            a1.vintage,
            a1.color_name,
            a1.co2_name,
            a1.region as region_type
          FROM $fti_parsedwine__exDB.src_is26763_parse_armenia as a1
    ",

  ];
  $fti_src_col = ['vineyard',  'countries', 'color', 'co2', 'vintage__dsP', 'grape__dsP', 'grape__cnt', 'word__cnt',
                  'regi__dsP', 'attrTYPE__arS', 'attrTITLE__arS', 'regi__path', 'vine__name',
                  'norm_name', 'nfc_gustos_wine__score', 'sc_limit', 'nfc_gustos_wine_name', 'nfc_gustos_vineyard_name',
                  'nfc_grape__dsP', 'nfc_gustos_vineyard_id', 'nfc_word__cnt', 'nfc_gustos_wine_entity__id', 'nfc_gustos_vintage',
                  'nfc_gustos_wine__id', 'msf_wine__id', 'msf_score', 'msf_wine_name', 'msf_vineyard_id', 'msf_vineyard_name', 'arS'
  ];
}

function _src_check($del_cols = 0, $src_key = '') {
  global $fti_src, $fti_src_col, $fti_parsedwine__exDB;
  //d($del_cols, $src_key, $fti_src_col);
  foreach ($fti_src as $key => $src) {
    //echo "\n";
    if ($src_key == '' || $src_key == $key) {
      $tabs = explode('.', explode('FROM ', $src)[1] ?? 0);
      $tab_s = $tabs[0];
      $tab_n = explode(' ', ($tabs[1] ?? 0))[0];
      if (count($tabs) != 2 || !db_query(
        "SELECT count(*)
          from information_schema.TABLES
          where 1 = 1
            and TABLE_SCHEMA = '$tab_s'
            and TABLE_NAME = '$tab_n'
        ")->fetchColumn()
      ) {
        $msg = "ErrFTI(_src_check_P1) -err- Table for \$fti_src['$key']='$tab_s.$tab_n' - not found!";
        dop($msg);
        throw new Exception($msg);
      }
      $col_exist = db_query(
        "SELECT count(*)
          from information_schema.COLUMNS
          where 1 = 1
            and TABLE_SCHEMA = '$tab_s'
            and TABLE_NAME = '$tab_n'
            and COLUMN_NAME = 'arS'
      ")->fetchColumn();
      if ($col_exist && $del_cols) {
        db_query("ALTER TABLE $tab_s.$tab_n DROP COLUMN arS");
        $col_exist = 0;
      }
      if (!$col_exist || $del_cols) {
        dop("Create extra columns for table $tab_s.$tab_n");
        foreach ($fti_src_col as $col) {
          $col_exist = db_query(
            "SELECT count(*)
              from information_schema.COLUMNS
              where 1 = 1
                and TABLE_SCHEMA = '$tab_s'
                and TABLE_NAME = '$tab_n'
                and COLUMN_NAME = '$col'
          ")->fetchColumn();
          if ($col_exist && $del_cols) {
            db_query("ALTER TABLE $tab_s.$tab_n DROP COLUMN $col");
            $col_exist = 0;
          }
          if (!$col_exist) {
            switch ($col) {
              case 'arS':
                db_query("ALTER TABLE $tab_s.$tab_n add $col int not null primary key AUTO_INCREMENT");
                break;
              case 'msf_score':
              case 'nfc_gustos_wine__score':
                db_query("ALTER TABLE $tab_s.$tab_n add $col bigint");
                break;
              case 'sc_limit':
                db_query("ALTER TABLE $tab_s.$tab_n add $col int");
                break;
              case 'XYZ':
                db_query("ALTER TABLE $tab_s.$tab_n add $col varchar(64)");
                break;
              default:
                if (strpos($col, '_id') === false) {
                  db_query("ALTER TABLE $tab_s.$tab_n add $col text");
                } else {
                  db_query("ALTER TABLE $tab_s.$tab_n add $col int");
                }
            }
          }
        }
      }
    }

  }
  if (!db_query(
    "SELECT count(*)
      from information_schema.COLUMNS
      where 1 = 1
        and TABLE_SCHEMA = '$fti_parsedwine__exDB'
        and TABLE_NAME = 'src_score__arS'
    ")->fetchColumn()
  ) {
    dop("Create tables src_score__arS, src_score__acSG");
    parsed__exDB_create_tables();
  }
}

function parsed__exDB_laad($src_key='alcomarket', $isXXXXX = 'is25559', $version = 5, $reini = 0, $restore = 0, $in__arS = '', $limit_dst = 1, $sq_mode = 1) { 
  global $fti_src, $fti_sq, $fti_row, $fti_parsedwine__exDB, $fti_expra, $fti_terme, $mix__arr, $fti_terms;
  parsed__exDB_init();
  _src_check(0, $src_key);
  $table_ex_ = "$fti_parsedwine__exDB.src_{$isXXXXX}_$src_key";
  $table_sq_ = $fti_src[$src_key];
  dop("$isXXXXX Wines matching started: src_key=$src_key, reini=$reini, restore=$restore, in__arS='$in__arS', mode=$sq_mode, version=$version");
  if ($reini) {
    db_query("UPDATE $table_ex_ set nfc_gustos_wine__id = NULL");
  }
  $score__arS = $cur__arS = 0;
  if ($restore > 0) {
    $filter = "and arS >= (SELECT min(arS) from $table_ex_ where nfc_gustos_wine__id is null)";
    $limit_src = 10000;
  } else {
    $filter = "and 1=1";
    $limit_src = 100000;
    if (!$restore) {
      $destination__dsP = "$table_ex_ - ver: $version";
      db_query("INSERT into  $fti_parsedwine__exDB.src_score__arS (description__dsP, limit_dst, mode__niSB) values ('$destination__dsP', $limit_dst, $sq_mode)");
    }
    $score__arS = db_query("SELECT max(arS) from  $fti_parsedwine__exDB.src_score__arS")->fetchColumn() ?? 0;
    if (!$score__arS) {
      $msg = "You are traing to perform matching with continue option (\$restore < 0), but there are no previouse score session in  $fti_parsedwine__exDB.src_score__arS";
      dop($msg);
      throw new Exception($msg);
    }
    $cur__arS = db_query("SELECT max(src__arS) from $fti_parsedwine__exDB.src_score__acSG where score__arS = $score__arS")->fetchColumn() ?? 0;
  }

  load_regions();
  load_vineyards();
  load_blends();
  $__dur = time();
  $__cnt = 0;
  do {
    dop("  Next wine $limit_src rows proceding, arS=$cur__arS, score__arS=$score__arS");
    $sql = 
      "SELECT 0 as id,
        arS, 
        concat_ws(',', Wine_name, color_name, co2_name) as `name`, 0 as vineyard, 0 as color, 0 as co2,
        '' as region, '0' as grape,
        0 as blend__cnt,
        grape_type, vintage, 
        ifnull(c.country__tid, 0) as country,
        concat_ws(' / ', Producer_name, Brand_name) as vineyard_type, region_type,
        '0' as grape__dsP
      from ($table_sq_) as x
        left join $fti_parsedwine__exDB.src_countries as c on c.country__name = x.Country_name
      where 1=1
        and x.arS > $cur__arS
        " . ($in__arS == '' 
              ? "$filter"
              : "and x.arS in ($in__arS)"
        ) . "
      order by x.arS
      limit $limit_src
    ";
    // echo "\n$sql\n\n";
    $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $arS = 0;
    $sql_u = $sql_i = $name = '';
    foreach ($rows as $fti_row) {
      $arS = $fti_row['arS'];
      $cur__arS = $arS;
      $__cnt++;
      if ($version != 5) {
        echo "\rarS=$arS, " . str_pad($fti_row['name'], 120);
        nfc_match_create_sql__MySqlFTI();
        //echo "\n" . $fti_sq['match_r0'] . "\n";
      } else {
        $norm_name = reg_wine_attr(0);
        // d($fti_row, $fti_expra, $fti_terme, $mix__arr, $fti_terms);
        eval(extrace('fti_row'));
        echo "\rarS=$arS, " . str_pad("$name/$norm_name", 120);
        if (!preg_match("/\d+(?= yo\b)/u", $norm_name, $m) && $vintage != '' && $vintage > 1900) {
          $vintage = "%,$vintage,%";
        } else {
          $vintage = (count($m) ? "%," . $m[0] . ",%" : '');
        }
        nfc_match_create_sql__raFTI_v5($limit_dst, $sq_mode); // sq_mode = 0/1 - exclude/include wine and vineyard names from result
      }

      $sc_exe = $sc_base = $wine_entity_id = $wine_entity_year = $nfc_word__cnt = $word__cnt = $nfc_gustos_vineyard_id = $score = $id = 0;
      $nfc_grape__dsP = $nfc_gustos_wine_name = $nfc_gustos_vineyard_name = '';
      try {
        $rows2 = db_query($fti_sq['match_r0'])->fetchAll();
      } catch (Exception $e) {
        $errs = $e->getMessage();
        $msg = "ErrFTI(match_r0__P_1) name=($name) $errs";
        echo "\nSQL=\n" . $fti_sq['match_r0'] . "\n";
        dd($msg);
      }
      if (($rows2)) {
        $score = $rows2[0]->score;
        $id = $rows2[0]->wine ?? 0;
        if ($score) {
          if ($version == 5) {
            $ids = explode(',', $rows2[0]->vintage__ids);
            $vints = explode(',', $rows2[0]->vintage__dsP);
            if (in_array($vintage, $vints)) {
              $wine_entity_id = $ids[array_flip($vints)[$vintage]];
              $wine_entity_year = $vintage;
            } else {
              $wine_entity_id = end($ids);
              $wine_entity_year = end($vints);
            }
            $nfc_word__cnt = $rows2[0]->nfc_word__cnt;
            $word__cnt = $rows2[0]->word__cnt;
            $nfc_grape__dsP = $rows2[0]->nfc_grape__dsP;
            $sc_exe = $rows2[0]->sc_exe; $sc_base = $rows2[0]->sc_base;
          }
          $nfc_gustos_wine_name = strtr($rows2[0]->nfc_gustos_wine_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_name = strtr($rows2[0]->nfc_gustos_vineyard_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_id = $rows2[0]->nfc_gustos_vineyard_id;
        }
      }
      try {
        //d($sql);
        if ($version != 5) {
          $sql_u = 
          "UPDATE $table_ex_ as u1
            set
              msf_wine__id = $id, msf_score = $score, msf_wine_name = '$nfc_gustos_wine_name',
              msf_vineyard_id = $nfc_gustos_vineyard_id, msf_vineyard_name = '$nfc_gustos_vineyard_name'
            where u1.arS = $arS
          ";
        } else {
          $sc_exe = ($sc_exe > 0 ? round($score / $sc_base / $sc_exe) : 0);
          $sql_u = 
          "UPDATE $table_ex_ as u1
            set 
              vineyard = $vineyard, countries = '$countries', color = $color, co2 = $co2,
              vintage__dsP = '$vintage', grape__dsP = '$grape', grape__cnt = $blend__cnt, word__cnt = $word__cnt,
              regi__dsP = '$region', attrTYPE__arS = $attrTYPE__arS, attrTITLE__arS = $attrTITLE__arS, norm_name = '$norm_name',
              nfc_gustos_wine__id = $id, nfc_gustos_wine__score = $score, nfc_gustos_wine_name = '$nfc_gustos_wine_name', nfc_grape__dsP = '$nfc_grape__dsP',
              nfc_gustos_vineyard_id = $nfc_gustos_vineyard_id, nfc_gustos_vineyard_name = '$nfc_gustos_vineyard_name',
              nfc_word__cnt = $nfc_word__cnt, 
              nfc_gustos_wine_entity__id = $wine_entity_id, nfc_gustos_vintage = $wine_entity_year,
              sc_limit = $sc_exe
            where u1.arS = $arS
          ";
//--              regi__path = '$regi__path', vine__name = '$vine__name',
        }
        //echo "\n\nsql_u\n\n$sql_u\n\n";
        db_query($sql_u);
        $sql_i = 
          "INSERT into $fti_parsedwine__exDB.src_score__acSG
              (score__arS, src__arS, el__id, dst__id, score__niOB, score__niQB)
            values"
        ;
        if ($score) {
          foreach($rows2 as $i => $row2) {
            //d($rows2, $i, $row);
            $sql_i .= ($i ? ',' : '') . "
                ($score__arS, $arS, $i, $id, $score, $sc_exe)"
            ;
          }
        } else {
          $sql_i .= " ($score__arS, $arS, 0, 0, 0, 0)";
        }
        //d($sql);
        db_query($sql_i);
        //d($rows2,$sql_u,$sql_i);
      } catch (Exception $e) {
        $errs = $e->getMessage();
        $msg = "ErrFTI(match_r0__P_2) name=($name)\n $errs\nsql_u\n$sql_u\nsql_i\n$sql_i\n";
        echo "\nSQL=\n" . $fti_sq['match_r0'] . "\n$msg";
        exit;
      }
    }
  } while ($arS);
  $__dur = time() - $__dur;
  dop("  9a - 1 - All wine entries: " . db_query("SELECT count(*) from $table_ex_")->fetchColumn());
  dop("  9a - 2 - Matched wine entries: $__cnt");
  dop("  9a - 3 - Matched duration: " . intdiv($__dur, 60) . ":" . ($__dur % 60));
  dop("  9a - 4 - REGIs found: " . $fti_sq['wine']['regi']);
  dop("  9a - 5 - VINEs found: " . $fti_sq['wine']['vine']);
  dop("  9a - 6 - GRAPs found: " . $fti_sq['wine']['grap']);
  dop("  9a - 7 - COLORs found: " . $fti_sq['wine']['color']);
  dop("  9a - 8 - GO2s found: " . $fti_sq['wine']['co2']);
  dop("NF Wine matching ends.");
  db_query(
    "UPDATE $fti_parsedwine__exDB.src_score__arS
      set __cnt = $__cnt, __dur = $__dur
      where arS = $score__arS
  ");
  return $score__arS;
}

/*
  $ini = 1, $restore = 0, $in__arS = '' - usual begining for new packet
  $ini = 0, $restore = 1, $in__arS = '' - usual for continue for debuging
  $ini = 0, $restore = 1, $in__arS = 'NNN' - usual for debug one NNN record from source
*/
function parsed__exDB_is25559_gw_without_medals__laad($src_key='gw_without_medals', $restore = 0, $in__arS = '', $ini = 1, $sq_mode = 1, $version = 5) { 
  global $fti_src, $fti_src_col, $fti_sq, $fti_row, $fti_parsedwine__exDB, $fti_gustos_db, $fti_expra, $fti_terme, $mix__arr, $fti_terms;
  $limit_dst = 9;
    $limit_src = 100000;
  parsed__exDB_init();
  $fti_src_col = array_merge($fti_src_col, ['dst_wine_id', 'src_Wine_name', 'src_Winemaker', 'src_Year', 'src_Wine_id', 'src_Vintage_id', 'src_Rating', 'src_grape_type']);
  if ($ini && !$restore ) {
    _src_check(1, $src_key);
  }
  $table_ex_ = "$fti_parsedwine__exDB.src_is25559_$src_key";
  $table_sq_ = $fti_src[$src_key];
  dop("is25559 Wines matching started: src_key=$src_key, restore=$restore, in__arS='$in__arS', ini=$ini, mode=$sq_mode, version=$version");
  $score__arS = $cur__arS = 0;
  $filter = "";
  if ($restore) {
    if ($in__arS != '') {
      $filter = "
        and x.arS in ($in__arS)";
    }
  } else {
    db_query("UPDATE $table_ex_ set nfc_gustos_wine__id = NULL");
    $destination__dsP = "$table_ex_ - ver: $version";
    db_query("INSERT into  $fti_parsedwine__exDB.src_score__arS (description__dsP, limit_dst, mode__niSB) values ('$destination__dsP', $limit_dst, $sq_mode)");
  }
  $score__arS = db_query("SELECT max(arS) from  $fti_parsedwine__exDB.src_score__arS")->fetchColumn() ?? 0;
  if (!$score__arS) {
    $msg = "There are no previouse score session in  $fti_parsedwine__exDB.src_score__arS";
    dop($msg);
    throw new Exception($msg);
  }
  load_regions();
  load_vineyards();
  load_blends();
  $__dur = time();
  $__cnt = 0;
  do {
    $sql = 
      "SELECT 0 as id,
        arS,
        Gustos_vintage_ID, concat('[', replace(VivinoAnalogs, '}{', '},{'), ']') as va,
        src_Wine_name, src_Winemaker, src_Year, src_Wine_id, src_Vintage_id, src_Rating, src_grape_type,
        '' as `name`, 0 as vineyard, 0 as color, 0 as co2, gwe.vintage as dst_vintage,
        '' as region, '0' as grape,
        0 as blend__cnt,
        grape_type,
        ifnull(c.country__tid, 0) as country,
        '' as vineyard_type, region_type, gwe.wine as dst_wine_id
      from ($table_sq_) as x
        left join $fti_parsedwine__exDB.src_countries as c on c.country__name = x.Country_name
        left join $fti_gustos_db.gustos_wine_entity as gwe on gwe.id = x.Gustos_vintage_ID
      where 1=1 
        and x.arS > $cur__arS $filter
      order by x.arS
      limit $limit_src
    ";
    //cho "\n$sql\n\n"; exit;
    $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
    dop("  Next wine $limit_src rows proceding, score__arS=$score__arS, arS=" . ($rows[0]['arS'] ?? 0));
    $arS = 0;
    $sql_u = $sql_i = $name = '';
    foreach ($rows as $fti_row) {
      $cur__arS = $arS = $fti_row['arS'];
      $__cnt++;
      $score = 0;
      $rows2 = [];
  //$rowsD = [];
      $rows2_sc_limit = 0;
      $va = json_decode($fti_row['va'], true);
      //d($fti_row, $va);
      if (!$va) { 
        continue;
      }
      foreach ($va as $va_arr) {
        $fti_row['name'] = $va_arr['Wine_name'] ?? '';
        $fti_row['vineyard_type'] = $va_arr['Winemaker'] ?? '';
        $fti_row['vintage'] = $va_arr['Year'] ?? -1;
        $fti_row['vineyard'] = 0;
        $fti_row['color'] = 0;
        $fti_row['co2'] = 0;
        $fti_row['grape'] = 0;
        $fti_row['region'] = '';
        if (isset($fti_row['Grapes']) && is_array($fti_row['Grapes'])) {
          foreach($fti_row['Grapes'] as $src_grape) {
            $fti_row['grape_type'] .= ',' . $src_grape['name'];
          }
        }
        if ($version != 5) {
          echo "\rarS=$arS, " . str_pad($fti_row['name'], 120);
          nfc_match_create_sql__MySqlFTI();
        } else {
          $norm_name = reg_wine_attr(0);
          eval(extrace('fti_row'));
          echo "\rarS=$arS, " . str_pad("$name", 120);
          nfc_match_create_sql__raFTI_v5($limit_dst, $sq_mode); //, ($va_arr['Wine_id'] == 4627954 ? 1 : 0)); // sq_mode = 0/1 - exclude/include wine and vineyard names from result
        }

        $sc_exe = $sc_base = $wine_entity_id = $wine_entity_year = $nfc_word__cnt = $word__cnt = $nfc_gustos_vineyard_id = $score = $id = 0;
        $nfc_grape__dsP = $nfc_gustos_wine_name = $nfc_gustos_vineyard_name = '';
        try {
          $rows4 = db_query($fti_sq['match_r0'])->fetchAll();
        } catch (Exception $e) {
          $errs = $e->getMessage();
          $msg = "ErrFTI(gw_without_medals__P_1) name=($name) $errs";
          echo "\nSQL=\n" . $fti_sq['match_r0'] . "\n";
          dd($msg);
        }
        foreach ($rows4 as $rows3) {
          $rows3->sc_limit = ($rows3->sc_exe > 0 ? round($rows3->score / $rows3->sc_base / $rows3->sc_exe) : 0);
          if (1 == 1
                && $rows3->sc_limit > $rows2_sc_limit
                && ( 1 != 1
                    || ( 1== 1
                          && (($rows3->in_gw = (($rows3->wine ?? 0) == $dst_wine_id)))
                          && (($rows3->in_arr_gwe = in_array($vintage, explode(',', $rows3->vintage__dsP))))
                    )
                    || $rows3->in_gw
                )
          ) {
            $rows2 = $rows3;
            $rows2_sc_limit = $rows3->sc_limit;
            $src_Wine_name = $va_arr['Wine_name'] ?? '';
            $src_Winemaker = $va_arr['Winemaker'] ?? '';
            $src_Year = $vintage;
            $src_Wine_id = $va_arr['Wine_id'] ?? 0;
            $src_Vintage_id = $va_arr['Vintage_id'] ?? 0;
            $src_Rating = $va_arr['Rating'] ?? '';
      //$rowsD[0][] = $fti_sq['match_r0']; $rowsD[1][] = $fti_row; $rowsD[2][] = $rows3;
          }
        }
      }
      //d($rows2, $rowsD);
      if (($rows2)) {
        $score = $rows2->score;
        $id = $rows2->wine ?? 0;
        if ($score) {
          if ($version == 5) {
            $ids = explode(',', $rows2->vintage__ids);
            $vints = explode(',', $rows2->vintage__dsP);
            if (isset($rows2->in_arr_gwe) && $rows2->in_arr_gwe) {
              $wine_entity_id = $Gustos_vintage_ID;
              $wine_entity_year = $dst_vintage;
            } elseif (in_array($vintage, $vints)) {
              $wine_entity_id = $ids[array_flip($vints)[$vintage]];
              $wine_entity_year = $vintage;
            } else {
              $wine_entity_id = end($ids);
              $wine_entity_year = end($vints);
            }
            $nfc_word__cnt = $rows2->nfc_word__cnt;
            $word__cnt = $rows2->word__cnt;
            $nfc_grape__dsP = $rows2->nfc_grape__dsP;
            $sc_limit = $rows2->sc_limit;
          }
          $nfc_gustos_wine_name = strtr($rows2->nfc_gustos_wine_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_name = strtr($rows2->nfc_gustos_vineyard_name, ["'" => "''", "\\" => "\\\\"]);
          $nfc_gustos_vineyard_id = $rows2->nfc_gustos_vineyard_id;
        }
      }
      try {
        if ($version != 5) {
          $sql_u = 
          "UPDATE $table_ex_ as u1
            set
              msf_wine__id = $id, msf_score = $score, msf_wine_name = '$nfc_gustos_wine_name',
              msf_vineyard_id = $nfc_gustos_vineyard_id, msf_vineyard_name = '$nfc_gustos_vineyard_name'
            where u1.arS = $arS
          ";
        } else {
          $sc_exe = ($sc_exe > 0 ? round($score / $sc_base / $sc_exe) : 0);
          $src_Winemaker = strtr($src_Winemaker, ["'" => "''", "\\" => "\\\\"]);
          $src_Wine_name = strtr($src_Wine_name, ["'" => "''", "\\" => "\\\\"]);
          $sql_u = 
          "UPDATE $table_ex_ as u1
            set 
              vineyard = $vineyard, countries = '$countries', color = $color, co2 = $co2,
              vintage__dsP = '$vintage', grape__dsP = '$grape', grape__cnt = $blend__cnt, word__cnt = $word__cnt,
              regi__dsP = '$region', attrTYPE__arS = $attrTYPE__arS, attrTITLE__arS = $attrTITLE__arS, norm_name = '$norm_name',
              regi__path = '$regi__path', vine__name = '$vine__name',
              nfc_gustos_wine__id = $id, nfc_gustos_wine__score = $score, nfc_gustos_wine_name = '$nfc_gustos_wine_name', nfc_grape__dsP = '$nfc_grape__dsP',
              nfc_gustos_vineyard_id = $nfc_gustos_vineyard_id, nfc_gustos_vineyard_name = '$nfc_gustos_vineyard_name',
              nfc_word__cnt = $nfc_word__cnt, 
              nfc_gustos_wine_entity__id = $wine_entity_id, nfc_gustos_vintage = $wine_entity_year,
              sc_limit = $sc_limit,
              dst_wine_id = $dst_wine_id,
              src_Wine_name = '$src_Wine_name',
              src_Winemaker = '$src_Winemaker',
              src_Year = '$src_Year',
              src_Wine_id = $src_Wine_id,
              src_Vintage_id = $src_Vintage_id,
              src_Rating = '$src_Rating'
            where u1.arS = $arS
          ";
        }
        //echo "\n\nsql_u\n\n$sql_u\n\n";
        db_query($sql_u);
        $sql_i = 
          "INSERT into $fti_parsedwine__exDB.src_score__acSG
              (score__arS, src__arS, el__id, dst__id, score__niOB, score__niQB)
            values"
        ;
        if ($score) {
          $sql_i .= "
              ($score__arS, $arS, 0, $id, $score, $sc_exe)"
          ;
        } else {
          $sql_i .= " ($score__arS, $arS, 0, 0, 0, 0)";
        }
        //d($sql_i);
        db_query($sql_i);
        //d($rows2,$sql_u,$sql_i);
      } catch (Exception $e) {
        $errs = $e->getMessage();
        $msg = "ErrFTI(gw_without_medals__P_2) name=($name)\n $errs\nsql_u\n$sql_u\nsql_i\n$sql_i\n";
        echo "\nSQL=\n" . (isset($fti_sq['match_r0']) ? $fti_sq['match_r0'] : '') . "\n$msg";
        exit;
      }
    }
  } while ($arS);
  $__dur = time() - $__dur;
  dop("  10a - 1 - All wine entries: " . db_query("SELECT count(*) from $table_ex_")->fetchColumn());
  dop("  10a - 2 - Matched wine entries: $__cnt");
  dop("  10a - 3 - Matched duration: " . intdiv($__dur, 60) . ":" . ($__dur % 60));
  dop("  10a - 4 - REGIs found: " . $fti_sq['wine']['regi']);
  dop("  10a - 5 - VINEs found: " . $fti_sq['wine']['vine']);
  dop("  10a - 6 - GRAPs found: " . $fti_sq['wine']['grap']);
  dop("  10a - 7 - COLORs found: " . $fti_sq['wine']['color']);
  dop("  10a - 8 - GO2s found: " . $fti_sq['wine']['co2']);
  dop("NF Wine matching ends.");
  db_query(
    "UPDATE $fti_parsedwine__exDB.src_score__arS
      set __cnt = $__cnt, __dur = $__dur
      where arS = $score__arS
  ");
  return $score__arS;
}

function parsed__exDB_reMatch($pw__id, $pw__cnt) {
  global $fti_gustos_db;
  $sql_pwa =
    "SELECT max(b1.id) as max_id
      FROM wines_actions as b1
        left join $fti_gustos_db.gustos_wine_entity as b2 on b2.id = b1.gustos_vintage_id
      where 1=1
        and b2.id is not null
        and b1.wine_id >= $pw__id
      group by b1.wine_id
      limit $pw__cnt
  ";
  $sql_nsw = "SELECT c1.wine_id FROM wines_actions as c1 inner join ($sql_pwa) as c3 on c3.max_id = c1.id";
  $vers__dsP = "RaFTI.v" . nfc_getVar('version', '0');  
  //echo "\n$sql_nsw\n";
  db_query("TRUNCATE nfc_score__acSG_ids");
  $sq_mode = 3;
  db_query("INSERT into nfc_score__arS (limit_dst, description__dsP, mode__niSB) VALUES(1, 'nfc_match - ver: $vers__dsP', $sq_mode)");
  $score__arS = db_query("SELECT max(arS) from nfc_score__arS")->fetchColumn() ?? 0;
  db_query("INSERT into nfc_score__acSG_ids (score__arS, id) select $score__arS as score__arS, wine_id from ($sql_nsw) as t1");
  $rows_cnt = db_query("SELECT ROW_COUNT()")->fetchColumn();
  $match_percent = 70;
  echo "\nsq_mode=$sq_mode, match_percent=$match_percent, score__arS=$score__arS, rows_count=$rows_cnt, pw__id=$pw__id\n";
  nfc_match($rows_cnt, $score__arS, $sq_mode, $match_percent);
  $sq_mode = 2;
  db_query("INSERT into nfc_score__arS (limit_dst, description__dsP, mode__niSB) VALUES(1, 'nfc_match - ver: $vers__dsP', $sq_mode)");
  $score__arS = db_query("SELECT max(arS) from nfc_score__arS")->fetchColumn() ?? 0;
  echo "\nsq_mode=$sq_mode, score__arS=$score__arS, rows_count=$rows_cnt, pw__id=$pw__id\n";
  nfc_match($rows_cnt, $score__arS, $sq_mode, $match_percent);
}


function parsed__exDB_reMatch_admins($pw__id, $pw__cnt, $wa__id = 0, $parsed_file_id = 1434) {
  global $fti_gustos_db;
  $user_ids = "1,3";
  $parsed_file_filter = (!$parsed_file_id ? "" : "
        and e1.parsed_file_id = $parsed_file_id"
  );
  $action_filter = ($pw__id ? "b1.wine_id >= $pw__id" : "b1.id >= $wa__id");
  $sql_pwa =
    "SELECT max(b1.id) as max_id
      FROM wines_actions as b1
        left join $fti_gustos_db.gustos_wine_entity as b2 on b2.id = b1.gustos_vintage_id
        left join parsed_file_row as e1 on e1.wine_id = b1.wine_id
      where 1=1
        and b2.id is not null
        and $action_filter
        and b1.user_id in ($user_ids) $parsed_file_filter
      group by b1.wine_id
      limit $pw__cnt
  ";
  $sql_nsw = "SELECT c1.wine_id FROM wines_actions as c1 inner join ($sql_pwa) as c3 on c3.max_id = c1.id";
  $vers__dsP = "RaFTI.v" . nfc_getVar('version', '0');  
  $match_percent = 70;
  //echo "\n$sql_nsw\n";
  db_query("TRUNCATE nfc_score__acSG_ids");
  $sq_mode = 3;
  db_query("INSERT into nfc_score__arS (limit_dst, description__dsP, mode__niSB) VALUES(1, 'nfc_match - ver: $vers__dsP', $sq_mode)");
  $score__arS = db_query("SELECT max(arS) from nfc_score__arS")->fetchColumn() ?? 0;
  db_query("INSERT into nfc_score__acSG_ids (score__arS, id) select $score__arS as score__arS, wine_id from ($sql_nsw) as t1");
  $rows_cnt = db_query("SELECT ROW_COUNT()")->fetchColumn();
  echo "\nsq_mode=$sq_mode, match_percent=$match_percent, score__arS=$score__arS, rows_count=$rows_cnt, pw__id=$pw__id\n";
  nfc_match($rows_cnt, $score__arS, $sq_mode, $match_percent);
  $sq_mode = 2;
  db_query("INSERT into nfc_score__arS (limit_dst, description__dsP, mode__niSB) VALUES(1, 'nfc_match - ver: $vers__dsP', $sq_mode)");
  $score__arS = db_query("SELECT max(arS) from nfc_score__arS")->fetchColumn() ?? 0;
  echo "\nsq_mode=$sq_mode, score__arS=$score__arS, rows_count=$rows_cnt, pw__id=$pw__id\n";
  nfc_match($rows_cnt, $score__arS, $sq_mode, $match_percent);
}

function parsed__exDB_last_vivino_and_gwmr($country_id = 0) {
  $sql =
"SELECT
  c1.id wine_id, c1.name wine_name,
  c1.vineyard as vineyard_id, c4.name vineyard_name, c3.wine_entity_id, c3.rating_100, c2.vintage,
  c2.gwmr as rating_gwmr
from gustosapp.gustos_wine as c1
  left join gustosapp.gustos_wine_entity c2 on c2.wine = c1.id
  inner join (
  	select e1.wine_entity_id, e1.rating_100
  	from gustosapp.third_party_vivino_wine_entity_history as e1
  	  inner join (  	  
  	    select a1.wine_entity_id, max(a1.created) as max_created
  	    FROM gustosapp.third_party_vivino_wine_entity_history as a1
  	    where exists (
  	      select 1
  	      from gustosapp.gustos_wine as f1
  	        left join gustosapp.gustos_wine_entity as f2 on f2.wine = f1.id
  	      where 1=1
  	        and f1.country = $country_id
  	        and f2.id = a1.wine_entity_id
  	    )
		group by a1.wine_entity_id		
  	  ) as e2 on e2.wine_entity_id = e1.wine_entity_id and e2.max_created = e1.created
  ) as c3 on c3.wine_entity_id = c2.id
  left join gustosapp.vineyard as c4 on c4.id = c1.vineyard
where 1=1
  and c1.country = $country_id
  and exists (select 1 from gustosapp.third_party_vivino_wine_entity_history as d1 where d1.wine_entity_id = c2.id)  
";

}

function parsed__exDB_getVINE_nullTERM() {
  $sql =
"SELECT x.arP, v.id, v.name, count(*) wines, gw.id, gw.name, _term__asFL_dsP(u.term__arP) dsP
FROM parsedwine.nfc_expr__arP x
  left join parsedwine.nfc_expr__acPU_term u on u.expr__arP = x.arP
  left join gustos.vineyard v on v.id = x.id 
  left join gustos.gustos_wine gw on gw.vineyard = v.id
  left join parsedwine.nfc_type__arP as t on t.val = x.expr__eS 
where 1 = 1
  and t.dsP = 'exVINE'
  and u.expr__arP is null
group by x.id
  ";
}

function pasrsed__exDB_parsed_armenia() {
  $sql =
"SELECT
  a1.id, title, producer, a1.vintage, volume, co2_name, color_name, a1.sugar, a1.country, price, discount_price, currency,
  in_stock, link, bottle_image, gwmr_id, marketplace, grape_variety, a1.region, extra_data, `new`,
  vivino_matching, last_change, a1.vineyard, 
  nfc_gustos_wine__score, sc_limit, nfc_gustos_wine_name, nfc_gustos_vineyard_name, nfc_gustos_wine_entity__id, nfc_gustos_vintage, nfc_gustos_wine__id,
  t1.name as nfc_color, SUBSTRING_INDEX(t2.name, '(', 1) as nfc_co2, t3.name as nfc_region, a3.gwmr, 
  msf_wine__id, msf_score, msf_wine_name, msf_vineyard_id, msf_vineyard_name, arS
FROM parsedwine.src_is26763_parse_armenia a1
  left join gustos.gustos_wine as a2 on a2.id = a1.nfc_gustos_wine__id 
  left join gustos.gustos_wine_entity as a3 on a3.id = a1.nfc_gustos_wine_entity__id 
  left join gustos.taxonomy_term_data as t1 on t1.tid = a2.color 
  left join gustos.taxonomy_term_data as t2 on t2.tid = a2.co2 
  left join gustos.taxonomy_term_data as t3 on t3.tid = a3.region 
where a1.country = 'armenia'
order by a1.sc_limit desc

  ";
}