<?php

use PhpParser\Node\Stmt\Continue_;

global $parsedwine__nfcDB;

function createTab_nfc_score__acSG_ids() {
  db_query("DROP table if exists nfc_score__acSG_ids");
  db_query("CREATE table nfc_score__acSG_ids (
    score__arS int unsigned not null,
    id int unsigned primary key not null),
    primary key (score__arS, id)
  ");
// nfc_score__acSG_ids
  db_query("ALTER TABLE IF EXISTS nfc_score__acSG_ids
    ADD INDEX if not exists nfc_score__acSG_ids_fK_score__arS(score__arS)
  ");
}

function nfc_add_new_indexes(array $specification) {
    foreach($specification as $table => $index) {
        $index_name = "{$table}_" . $index['name'] . '_' . $index['field'];
        $sql = "ALTER TABLE $table DROP INDEX IF EXISTS $index_name";
        db_query ($sql);
        $sql = "ALTER TABLE $table ADD " . ($index['unique'] ? 'UNIQUE ' : '') . "INDEX $index_name(" . $index['field'] .  ')';
        db_query ($sql);
    }
}

function nfc_add_new_constraints(array $specification) {
    foreach($specification as $table => $index) {
        $index_name = "{$table}_" . $index['name'] . '_' . $index['field'];
        $sql = "ALTER TABLE $table DROP CONSTRAINT IF EXISTS $index_name";
        db_query ($sql);
        $sql = "ALTER TABLE $table ADD CONSTRAINT $index_name FOREIGN KEY ("  . $index['field'] .  ')';
        $sql = "\n  REFERENCE " . $index['reference'] . " ON DELETE " . $index['on_delete'] . " ON UPDATE " . $index['on_update'];
        db_query ($sql);
    }
    nfc_add_new_indexes($specification);
}

function nfc_updates_CreateTbales () {
  db_query("DROP TABLE if exists nfc_expr_updates__arS");
  db_query("CREATE table nfc_expr_updates__arS (
    arS integer AUTO_INCREMENT primary key not null,
    source__dsP varchar(255) not null,
    action__eC varchar(16) not null,
    action__id int unsigned not null,
    created int(11) NOT NULL DEFAULT unix_timestamp()
  )");
  db_query("ALTER TABLE IF EXISTS nfc_expr_updates__arS 
    ADD INDEX if not exists nfc_expr_updates__arS_tK_action__id(action__id)
  ");

  db_query("DROP TABLE if exists nfc_score__acSG_ids");
  db_query("CREATE table nfc_score__acSG_ids (
    score__arS int unsigned not null,
    id int unsigned not null,
    primary key (score__arS, id)
  )");
  db_query("ALTER TABLE IF EXISTS nfc_score__acSG_ids
    ADD INDEX if not exists nfc_score__acSG_ids_fK_score__arS(score__arS)
  ");

}

function nfc_update_7003() { //  add vy__coontry column
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.columns
      WHERE 1=1
        AND TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = 'nfc_expr_parsedwine__arPD'
        AND COLUMN_NAME = 'vy__country'
  ")->fetchColumn()) {
    db_query(
      "ALTER TABLE nfc_expr_parsedwine__arPD
        ADD vy__country int unsigned default null null
    ");
  }
  if (db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.columns
      WHERE 1=1
        AND TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = 'nfc_score__arS'
        AND COLUMN_NAME = 'score_porog'
  ")->fetchColumn()) {
    db_query(
      "ALTER TABLE nfc_score__arS
        CHANGE score_porog match_threshold integer default 17000000 not null
    ");
  }
}

function nfc_update_7006() { //  re create index for parsedwine->tables(rule, vintage)
  parsedwine_drop_constraints();
  parsedwine_drop_indexes();
  parsedwine_create_constraints();
  parsedwine_create_indexes();
  
}

const nfcDB__PREFIX_LEN = 17;
const nfcDB__MIN_BUCKUPS_FOR_DELETE_BY_DEFAULT = 4;
$parsedwine__nfcDB = 'parsedwine__nfcDB';

function nfcDB__backup() {
  global $parsedwine__nfcDB;
  if (!db_query("SELECT 1 from information_schema.SCHEMATA where schema_name = '$parsedwine__nfcDB'")->fetchColumn()) {
    dop("$parsedwine__nfcDB - creating database");
    db_query("CREATE database $parsedwine__nfcDB");
    db_query(
      "CREATE TABLE $parsedwine__nfcDB.buDB__arS (
        arS int(11) NOT NULL DEFAULT (0 - unix_timestamp()),
        create__dfOB datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (arS)
      )
    ");
  }
  db_query("INSERT into $parsedwine__nfcDB.buDB__arS (arS) values (0 - unix_timestamp())");
  $prefix = db_query("SELECT left(create__dfOB, " . nfcDB__PREFIX_LEN . ") from $parsedwine__nfcDB.buDB__arS order by arS limit 1")->fetchColumn();
  nfcDB__delete();
  dop("$parsedwine__nfcDB - starting buckup");
  $rows = db_query("SELECT `name` from nfc_tables__asVS")->fetchAll(PDO::FETCH_ASSOC);
  foreach ($rows as $table) {
    $pt_name = $prefix . $table['name'];
    dop("$parsedwine__nfcDB - buckup table: $pt_name");
    db_query("DROP table if exists $parsedwine__nfcDB.`$pt_name`");
    db_query("CREATE table $parsedwine__nfcDB.`$pt_name` select * from " . $table['name']);
  }
  dop("$parsedwine__nfcDB - ending buckup");
}

function nfcDB__exists() {
  global $parsedwine__nfcDB;
  if (!db_query("SELECT 1 from information_schema.tables where TABLE_SCHEMA = '$parsedwine__nfcDB' and table_name = 'buDB__arS'")->fetchColumn()) {
    dog("DataBbase($parsedwine__nfcDB) or table(buDB__arS) not exists!\nCreate buckup using nfcDB__backup() first");
    return FALSE;
  }
  return TRUE;
}

function nfcDB__prefix($prefix, $limit = 1) {
  global $parsedwine__nfcDB;
  if ($prefix == '') {
    $rows = db_query("SELECT left(create__dfOB, " . nfcDB__PREFIX_LEN . ") as pref from $parsedwine__nfcDB.buDB__arS order by arS limit $limit")->fetchAll();
    if ($rows) {
      if (count($rows) != $limit) {
        return FALSE;
      }
      $prefix = $rows[$limit - 1]->pref;
    } else {
      dop("There are no buckups in DataBase($parsedwine__nfcDB)");
      return FALSE;
    }
  }
  if (!db_query("SELECT count(*) from information_schema.tables where TABLE_SCHEMA = '$parsedwine__nfcDB' and table_name like '$prefix%'")->fetchColumn()) {
    dop("There are no buckup with prefix($prefix) in DataBase($parsedwine__nfcDB)");
    db_query("DELETE FROM $parsedwine__nfcDB.buDB__arS where create__dfOB like '$prefix%'");
    return FALSE;
  }
  return $prefix;
}

function nfcDB__restore($prefix = '') {
  global $parsedwine__nfcDB;
  if (nfcDB__exists() && ($prefix = nfcDB__prefix($prefix))) {
    dop("$parsedwine__nfcDB - starting restore for prefix=$prefix");
    nfc_drop_triggers();
    db_query("SET FOREIGN_KEY_CHECKS=0");
    $rows = db_query("SELECT `name` from nfc_tables__asVS")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $table) {
      $pt_name = $prefix . $table['name'];
      if (db_query("SELECT count(*) from information_schema.tables where TABLE_SCHEMA = '$parsedwine__nfcDB' and table_name = '$pt_name'")->fetchColumn()) {
        dop("$parsedwine__nfcDB - restore table: $pt_name");
        db_query("DELETE from " . $table['name']);
        db_query("INSERT into " . $table['name'] . " select * from $parsedwine__nfcDB.`$pt_name`");
      }
    }
    db_query("SET FOREIGN_KEY_CHECKS=1");
    nfc_create_triggers();
    dop("$parsedwine__nfcDB - ending restore");
  }
}

function nfcDB__delete($prefix = '') {
  global $parsedwine__nfcDB;;
  if (nfcDB__exists()) {
    if (!($prefix = nfcDB__prefix($prefix, nfcDB__MIN_BUCKUPS_FOR_DELETE_BY_DEFAULT))) {
      dop("There are no min buckups in DataBase($parsedwine__nfcDB) for deleting by default. Expecting: " . nfcDB__MIN_BUCKUPS_FOR_DELETE_BY_DEFAULT);
      return;
    }
    dop("$parsedwine__nfcDB - starting droping tables for prefix=$prefix");
    $rows = db_query("SELECT `name` from nfc_tables__asVS")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $table) {
      $pt_name = $prefix . $table['name'];
      if (db_query("SELECT count(*) from information_schema.tables where TABLE_SCHEMA = '$parsedwine__nfcDB' and table_name = '$pt_name'")->fetchColumn()) {
        dop("$parsedwine__nfcDB - drop table: $pt_name");
        db_query("DROP TABLE $parsedwine__nfcDB.`$pt_name`");
      }
    }
    dop("$parsedwine__nfcDB - ending droping");
    db_query("DELETE FROM $parsedwine__nfcDB.buDB__arS where create__dfOB like '$prefix%'");
  }
}

function nfc_updates_7008() {
  global $fti_var, $fti_gustos_region_db, $fti_gustos_db, $fti_seg;
  //dups_expr($fti_var['exVINE']);
  //dups_expr($fti_var['exVINE']);
//*
  reg_attributes();
  reg_countries();
  //reg_rules();
  reg_grapes();
  //dups_expr($fti_var['exGRAP']);
  //nfcDB__backup();
  reg_regions();
  //nfcDB__backup();
  ///*
  //nfc_rs_regi__reg();
  //nfcDB__backup();
  search_regions_src__exDB();
  reg_regions_src__exDB();
  //nfcDB__backup();
  ///* /
  reg_vineyards();
  //nfcDB__backup();
  //nfc_rs_vine__reg();
  nfcDB__backup();
  //*/
  reg_wines();
  nfcDB__backup();
  link_vine_hierarchy_flat();
  link_regi_hierarchy_flat();
}

function nfc_updates_7009() {
  parsed__exDB_create_tables();
  parsed__exDB_create_is24954();
  _is24956_Wines_Croitoru__laad(); //0,0,'',1,0); //0,0,43);
}

function nfc_updates_7010_regi() {
  global $fti_row, $fti_seg,$fti_sqr, $fti_var;
  $exREGI = $fti_var['exREGI'][0];
  $desc_7010 = 'nfc_updates_7010_regi';
  if (!($score__arS = db_query(
        "SELECT max(a1.score__arS)
          from nfc_score__acSG_ids as a1
            left join nfc_score__arS as a2 on a2.arS = a1.score__arS
          where a2.description__dsP = '$desc_7010'"
      )->fetchColumn() ?? 0)
  ) {
    $score__arS = seg_next_arP(NFC_SCORE__arS);
    db_query("INSERT into nfc_score__arS (arS, limit_dst, description__dsP) VALUES($score__arS, 0, '$desc_7010')");
    /* to correct using word "tint(o|a)"
    db_query(
      "INSERT into nfc_score__acSG_ids
        SELECT $score__arS, id
        from gustosapp.gustos_wine
        where name regexp '\\\\btint(o|a)\\\\b'
        order by id"
    );
    */
    // to correct all regi changed
    db_query(
      "INSERT INTO nfc_score__acSG_ids
        SELECT $score__arS, wine__id
        from nfc_expr_wine__acPG
        where expr__eS = $exREGI
    "
    );
  }
  dop("Phase 8a - Update wine name entries.");
  $fti_seg['wine_color'] = $fti_seg['wine_co2'] = $fti_seg['wine_regi'] = $fti_seg['wine_grap'] = $fti_seg['wine_vine'] = $fti_seg['wine_col'] = $fti_seg['wine_co2'] = 0;
  $fti_entry_cnt = 1;
  $rows_number = 0;
  do {
    load_regions();
    load_vineyards();
    load_blends();
    $max_id = db_query("SELECT min(id) from nfc_score__acSG_ids")->fetchColumn();
    $rows = db_query("CALL nfc_expr__asPL_wine_gustosapp_normALL(0, $score__arS, 0)")->fetchAll(PDO::FETCH_ASSOC);
    dop("Next " . FTI_WINE_BL_20000 . " rows wine registration, prior rows number: $rows_number, start id: $max_id");
    $rows_number = 0;
    foreach ($rows as $fti_row) {
      $rows_number++;
      $id = $fti_row['id'];
      echo "\r Wine entries=" . $fti_entry_cnt++ . ", ID=$id";
      if (($arP = db_query("SELECT arP from nfc_expr_wine__arPD where wine = $id")->fetchColumn() ?? 0)) {
        $fti_sqr['r0'] = "DELETE FROM nfc_expr_wine__arPD where arP = $arP";
      }
      reg_wine($arP);
      db_query("DELETE from nfc_score__acSG_ids where score__arS = $score__arS and id = $id");
    }
  } while ($rows_number);
  link_regi_hierarchy_flat();
  dop("  8a - 1 - All wine entries: " . db_query("SELECT count(*) from nfc_expr_wine__arPD")->fetchColumn());
  dop("  8a - 2 - REGIs changed: " . $fti_seg['wine_regi']);
  dop("  8a - 3 - VINEs changed: " . $fti_seg['wine_vine']);
  dop("  8a - 4 - GRAPs changed: " . $fti_seg['wine_grap']);
  dop("  8a - 5 - COLORs changed: " . $fti_seg['wine_color']);
  dop("  8a - 6 - GO2s changed: " . $fti_seg['wine_co2']);
  dop("Successful registration.");

}

function nfc_updates_7010_vine() {
  global $fti_row, $fti_seg,$fti_sqr, $fti_var;
  $exVINE = $fti_var['exVINE'][0];
  $desc_7010 = 'nfc_updates_7010_vine';
  if (!($score__arS = db_query(
        "SELECT max(a1.score__arS)
          from nfc_score__acSG_ids as a1
            left join nfc_score__arS as a2 on a2.arS = a1.score__arS
          where a2.description__dsP = '$desc_7010'"
      )->fetchColumn() ?? 0)
  ) {
    $score__arS = seg_next_arP(NFC_SCORE__arS);
    db_query("INSERT into nfc_score__arS (arS, limit_dst, description__dsP) VALUES($score__arS, 0, '$desc_7010')");
    // to correct all vine changed
    db_query(
      "INSERT INTO nfc_score__acSG_ids
        SELECT $score__arS, wine__id
        from nfc_expr_wine__acPG
        where expr__eS = $exVINE
    "
    );
  }
  dop("Phase 8a - Update wine name entries.");
  $fti_seg['wine_color'] = $fti_seg['wine_co2'] = $fti_seg['wine_regi'] = $fti_seg['wine_grap'] = $fti_seg['wine_vine'] = $fti_seg['wine_col'] = $fti_seg['wine_co2'] = 0;
  $fti_entry_cnt = 1;
  $rows_number = 0;
  do {
    load_regions();
    load_vineyards();
    load_blends();
    $max_id = db_query("SELECT min(id) from nfc_score__acSG_ids")->fetchColumn();
    $rows = db_query("CALL nfc_expr__asPL_wine_gustosapp_normALL(0, $score__arS, 0)")->fetchAll(PDO::FETCH_ASSOC);
    dop("Next " . FTI_WINE_BL_20000 . " rows wine registration, prior rows number: $rows_number, start id: $max_id");
    $rows_number = 0;
    foreach ($rows as $fti_row) {
      $rows_number++;
      $id = $fti_row['id'];
      echo "\r Wine entries=" . $fti_entry_cnt++ . ", ID=$id";
      if (($arP = db_query("SELECT arP from nfc_expr_wine__arPD where wine = $id")->fetchColumn() ?? 0)) {
        $fti_sqr['r0'] = "DELETE FROM nfc_expr_wine__arPD where arP = $arP";
      }
      reg_wine($arP);
      db_query("DELETE from nfc_score__acSG_ids where score__arS = $score__arS and id = $id");
    }
  } while ($rows_number);
  link_vine_hierarchy_flat();
  dop("  8a - 1 - All wine entries: " . db_query("SELECT count(*) from nfc_expr_wine__arPD")->fetchColumn());
  dop("  8a - 2 - REGIs changed: " . $fti_seg['wine_regi']);
  dop("  8a - 3 - VINEs changed: " . $fti_seg['wine_vine']);
  dop("  8a - 4 - GRAPs changed: " . $fti_seg['wine_grap']);
  dop("  8a - 5 - COLORs changed: " . $fti_seg['wine_color']);
  dop("  8a - 6 - GO2s changed: " . $fti_seg['wine_co2']);
  dop("Successful registration.");

}

function nfc_updates_7011(){
  global $fti_var;
  dups_expr($fti_var['exREGI']);
  dups_expr($fti_var['exVINE']);
}

function nfc_updates_7012() {
  global $fti_seg, $fti_var;
  $exREGI = $fti_var['exREGI'][0];
  $row_id = $upd_cnt = 0;
  $rows = db_query(
    "SELECT min(a1.acPG) as acPG, a1.from__id, a1.to__id
    from nfc_expr_wine__acPG as a1
    where 1 = 1
      and a1.expr__eS = $exREGI
    group by a1.from__id, a1.to__id
    order by a1.acPG
  ")->fetchAll(PDO::FETCH_ASSOC);
  dop(count($rows) . " - VINE recs found to update\n");
  foreach ($rows as $row) {
    extract($row);
      $row_id++;
      echo "\rrow_id=$row_id, acPG=$acPG, upd_cnt = $upd_cnt, sql='$cas' for ($from__id, $to__id)";
      db_query($sqr4);
      $upd_cnt += db_query("SELECT ROW_COUNT()")->fetchColumn();
  }
  dop("VINE records updated: $upd_cnt");

}

function nfc_vine_restore_countries() {
  global $fti_seg, $fti_var, $fti_gustos_db;
  $exTYPE = $fti_var['exVINE'][0];
  $sql =
    "SELECT
        a2.arP,
        concat_ws(',', a3.country, group_concat(distinct nullif(a4.country, a3.country))) as countries
      from nfc_expr_vine__arPD as a1
        left join nfc_expr__arP as a2 on a2.arP = a1.vine__arP
        inner join $fti_gustos_db.vineyard as a3 on a3.id = a2.id
        left join $fti_gustos_db.gustos_wine as a4 on a4.vineyard = a3.id
      where 1 = 1
        and a2.expr__eS = $exTYPE
      group by a2.arP, a3.country
  ";
  dop("VINE countries restore start\n");
  echo "\n$sql\n";
  db_query(
    "UPDATE nfc_expr_vine__arPD as u1
      inner join ($sql) as u2 on u2.arP = u1.vine__arP
      set u1.countries = u2.countries
  ")->fetchAll(PDO::FETCH_ASSOC);
  dop(db_query("SELECT ROW_COUNT()")->fetchColumn() . " - VINE recs found to update\n");

}

function merge_grapes_link($arg_val = 0) {
  global $fti_seg, $fti_var, $fti_gustos_db;
  $sql_s =
"SELECT
      x1.tid as from_tid, x1.name as from_name,
      x.grap__id as to_tid, y1.name as to_name, x2.cnt
    FROM parsedwine.nfc_expr_grap__arPD_link x
      left join $fti_gustos_db.taxonomy_term_data x1 on x1.tid  = x.link__id 
      left join (
        select grape, count(wine) cnt
        from $fti_gustos_db.gustos_wine_grapes
        group by grape
      ) x2 on x2.grape = x1.tid
      left join $fti_gustos_db.taxonomy_term_data y1 on y1.tid  = x.grap__id
    union all
  SELECT y1.tid, y1.name, x.link__id, x1.name, y2.cnt
    FROM parsedwine.nfc_expr_grap__arPD_link x
    left join $fti_gustos_db.taxonomy_term_data y1 on y1.tid  = x.grap__id
    left join (
      select grape, count(wine) cnt
      from $fti_gustos_db.gustos_wine_grapes
      group by grape
    ) y2 on y2.grape = y1.tid
    left join $fti_gustos_db.taxonomy_term_data x1 on x1.tid  = x.link__id
  order by cnt
  limit 1
  ";
  if (($row = db_query($sql_s)->fetchAll(PDO::FETCH_ASSOC)[0] ?? 0)) {
    extract($row);
    if ($arg_val) {
      dd($row);
    }
    dop("  GRAP - merging grape from($from_tid/$from_name) to($to_tid/$to_name) with wines($cnt)");
    $blends_cnt = db_query("SELECT COUNT(*) from nfc_expr_grap__acSG_blend where grap__id = $from_tid")->fetchColumn();
    dop("       - found blends($blends_cnt) with grape($from_tid)");
    db_query("UPDATE $fti_gustos_db.gustos_wine_grapes set grape = $to_tid where grape = $from_tid");
    nfc_update();
    db_query("DELETE FROM $fti_gustos_db.taxonomy_term_data where tid = $from_tid");
    nfc_update();
    $blends_cnt = db_query("SELECT COUNT(*) from nfc_expr_grap__acSG_blend where grap__id = $from_tid")->fetchColumn();
    dop("       - found blends($blends_cnt) with grape($from_tid)");
    dop("       - done.");
  } else {
    dop("  GRAP - there are no grapes dups found!");
  }
}

function nfc_updates_7012_reg_all() {
  global $fti_var, $fti_gustos_region_db, $fti_gustos_db, $fti_seg;
  reg_attributes();
  reg_countries();
  //reg_rules();
  reg_grapes();
  reg_regions();
  //nfcDB__backup();
  search_regions_src__exDB();
  reg_regions_src__exDB();
  regions_preserv_restore();
  db_query("call nfc_expr_regi__arPD_span__asPL_create()");
  /*
  reg_vineyards();
  reg_vineyards_syn();
  link_expr('exVINE');
  nfcDB__backup();
  //*/
}
