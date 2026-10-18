<?php

include_once "nfc_macro.php";

function regions_preserv_find($curr__id) {
  global $fti_seg, $fti_expra, $fti_var;
  $exREGI = $fti_var['exREGI'][0];
  if ($fti_seg['regi__id'][$curr__id][REGI_ID_tara]) {
    $to__id = current($fti_seg['expr__arP'][
        current($fti_seg['expr__arP'][$fti_seg['term__id'][$exREGI][$curr__id][TERM_ID_id__arP]])[EXPR__arP_par__arP]
    ])[EXPR__arP_term__id];
//    print_r($fti_expra['term']);
    if (!key($fti_expra['term'])) {
      return $curr__id;
    }
    foreach ($fti_seg['expr__arP'][$fti_seg['regi__id'][$to__id][REGI_ID_arP]] as $term__arP => $arr) {
//echo "\nrf1 - to__id($to__id), term__arP($term__arP), is__arP=" . (isset($fti_expra['term'][$term__arP]) ? 1 : 0);
      if (isset($fti_expra['term'][$term__arP])) {
        return $curr__id;
      }
    }
    return regions_preserv_find($to__id);
  }
  return 0;
}

function region_preserv_parse($regi__name, $to_name) {
  global $fti_var, $fti_expra, $fti_seg,$fti_terme;
  $exREGI = $fti_var['exREGI'][0];
  $exTARA = $fti_var['exTARA'][0];
  $fti_expra = [];
  $regi_norm = parse_name($fti_var['exREGI'], preg_replace('/\s*[&+]\s*/u', ' ', $regi__name), $fti_var['syGroupRT'],FTI_PARSE_NAME__NORM_IT_elim_single_alpha);
  $regi_expra = $fti_expra;
  $regi_terme = $fti_terme;
  $fti_expra = [];
  $to_norm = parse_name($fti_var['exREGI'], preg_replace('/\s*[&+]\s*/u', ' ', $to_name), $fti_var['syGroupRT'],FTI_PARSE_NAME__NORM_IT_elim_single_alpha);
  $regi_found = 0;
  // echo "\np1 - regi_norm($regi_norm), to_norm($to_norm), is_tara=" . (isset($fti_seg['term__arP'][key($fti_expra['term'])][$exTARA]) ? 1 : 0); 
  //dd ($regi_expra, $fti_expra);
  if (isset($fti_seg['term__arP'][key($fti_expra['term'])][$exTARA])) {
    foreach ($regi_expra['term'] as $chiTerm__arP => $val) {
      if (isset($fti_seg['term__arP'][$chiTerm__arP][$exREGI])) {
        foreach ($fti_seg['term__arP'][$chiTerm__arP][$exREGI] as $term__id => $expr__arP) {
          if (isset($fti_seg['term__arP'][key($fti_expra['term'])][$exTARA][$fti_seg['regi__id'][$term__id][REGI_ID_tara]])) {
            $regi_found = $term__id;
            break 2;
          }
        }
      }
    }
  } else {
    foreach ($regi_expra['term'] as $chiTerm__arP => $val) {
 //     if ($regi_norm == '_pdo haut adige' ||  $regi_norm == '_pdo _prosecco') var_dump($regi_expra['term'],$regi_terme);
// echo "\np2  - chiTerm__arP($chiTerm__arP), is_tterm=" . (isset($fti_seg['term__arP'][$chiTerm__arP][$exREGI]) ? 1 : 0);
      if (isset($fti_seg['term__arP'][$chiTerm__arP][$exREGI])) {
//print_r($fti_seg['term__arP'][$chiTerm__arP][$exREGI]);
        foreach ($fti_seg['term__arP'][$chiTerm__arP][$exREGI] as $term__id => $expr__arP) {
          $found__id = regions_preserv_find($term__id);
// echo "\np3  - term__id($term__id), found__id($found__id)";
          if ($found__id) {
            $regi_found = $found__id;
            break 2;
          }
        }
      }
    }
  }
  return $regi_found;
}

function regions_preserv_restore() {
  global $fti_gustos_db, $fti_var, $fti_row, $fti_expra, $fti_seg;
  load_terms();
  load_regions();
  $t = time();
  $regi_restored_cnt = 0;
  extract($fti_var['link__eMI']);
  $fti_row['link__eMI'] = $link_lvl_regi__eB | $link_sts_wine__eB | $link_has_gustos__eB | $link_sts_jur__eB;
  $sql =
"SELECT
    regi__id, ifnull(new__id, 0) as new__id, regi__type, regi__weight, regi__level, regi__name, to_name, child__ids, gwe__ids, is_new, Country
  FROM src_old_regions"
  ;
  $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
  if ($rows) {
    if ($rows[0]['new__id']) {
        dop("regions_preserv_restore_e1 - table src_old_regions already used for restoring! field(new__id is not null)");
        return;
    }
    foreach ($rows as $row) {
      extract($row);
      if (!$is_new) {
        if (($regi_found = region_preserv_parse($regi__name, $to_name))) {
          $sql_u1 = "UPDATE src_old_regions set new__id = $regi_found where regi__id = $regi__id";
          $sql_u2 = "UPDATE $fti_gustos_db.gustos_wine_entity set region  = $regi_found where id in ($gwe__ids)";
          $regi_restored_cnt++;
          // echo "\n$sql_u1\n$sql_u2\n";
          db_query($sql_u1); db_query($sql_u2);
        } else {
          dd("regions_preserv_restore_e2 - not found regi__name($regi__name), to__name($to_name) of regi__id($regi__id) !");  
        }
      } elseif ($regi__type == 'CONTINENT') {
        $sql_i1 =
          "INSERT INTO $fti_gustos_db.region
              (`type`, created, updated, `name`)
            VALUES
              ('CONTINENT', $t, $t, '$regi__name')
        ";
        db_query("SET @FTI_TRIGGERS_STOP = 1");
        db_query($sql_i1);
        $new__id = db_query("SELECT LAST_INSERT_ID()")->fetchColumn();
        db_query("SET @FTI_TRIGGERS_STOP = 0");
        $sql_i2 =
          "INSERT INTO $fti_gustos_db.region_hierarchy
              (parent_id, child_id, `type`)
            VALUES
              ($new__id," . implode(",'GEOGRAPHICAL'),($new__id,", explode(',', $child__ids)) . ",'GEOGRAPHICAL')"
        ;
        $sql_u1 = "UPDATE src_old_regions set new__id = $new__id where regi__id = $regi__id";
        //echo "\n$sql_i1\n$sql_i2\n$sql_u1\n";
        db_query($sql_i2);
        db_query($sql_u1);
        $regi_restored_cnt++;
      } elseif (($regi_found = region_preserv_parse($regi__name, $to_name))) {
          $sql_u1 = "UPDATE src_old_regions set new__id = $regi_found where regi__id = $regi__id";
          $regi_restored_cnt++;
          //echo "\n$sql_u1\n";
          db_query($sql_u1);
      } else {
        dd("regions_preserv_restore_e3 - not found regi__name($regi__name), to__name($to_name) of regi__id($regi__id) !");  
      }
    }
  } else {
    dd("regions_preserv_restore_e4 - empty preserved regions in table(src_old_regions)!");
  }
  dop("   regions_preserv_rp1 - b - regi__id's restored : $regi_restored_cnt");
}

function regions_preserv_create() {
  global $fti_gustos_region_db, $fti_gustos_db, $fti_sqr, $fti_var;
  $v_FTI_SEP_SPAN = FTI_SEP_SPAN;
  $v_FTI_SEP_PATH_PARENT = FTI_SEP_PATH_PARENT;
  $Country__vid = db_query("SELECT vid from $fti_gustos_db.taxonomy_vocabulary where `name` = 'Country'")->fetchColumn();
  $Region__vid = db_query("SELECT vid from $fti_gustos_db.taxonomy_vocabulary where `name` = 'Region'")->fetchColumn();
  $fti_sqr['r1'] = $fti_sqr['r2'] = $fti_sqr['r3'] = $fti_sqr['r4'] = $fti_sqr['r6'] = $fti_sqr['r7'] = $fti_sqr['r8'] = $fti_sqr['r9'] = $fti_sqr['rA'] = '';  
  $fti_sqr['r0'] = [];
  $t = time();
  dop("   Rgions creation start at: $t");
  if (!db_query(
    "SELECT count(*)
      from information_schema.COLUMNS
      where 1 = 1
        and TABLE_NAME = 'gustos_wine'
        and TABLE_SCHEMA = '$fti_gustos_db'
        and COLUMN_NAME = 'co2'
    ")->fetchColumn()
  ) {
    $fti_sqr['r0'][] = "ALTER TABLE $fti_gustos_db.gustos_wine
        add `co2` int(10) unsigned GENERATED ALWAYS AS (json_unquote(json_extract(`category`,'$.co2'))) VIRTUAL"
    ;
  }
  $src_old_cnt = db_query("SELECT count(*) from src_old_regions")->fetchColumn();
  if ((db_query("SELECT count(*) from src_old_regions")->fetchColumn())) {
      dd("regions_preserv_create_e1 - preserved regions in table(src_old_regions) is not empty!");
  } else {
    $fti_sqr['r0'][] = "SET @FTI_TRIGGERS_STOP = 1";
    $fti_sqr['r0'][] = "SELECT @regi__1st_appellation := min(a1.tid) from $fti_gustos_db.taxonomy_term_data as a1 where a1.description = 'APPELLATION'";
    $fti_sqr['r0'][] = "SELECT @regi__1st_continent := min(a1.id) from $fti_gustos_db.region as a1 where a1.type = 'CONTINENT'";
    $fti_sqr['r0'][] = "TRUNCATE src_old_regions";
    $fti_sqr['r0'][] =
  "INSERT INTO src_old_regions
      (regi__id, regi__type, regi__weight, regi__level, regi__name, to_name, child__ids, gwe__ids, is_new, Country)
    select distinct
      b1.regi__id, b1.regi__type, b1.regi__weight, b1.regi__level, b1.regi__name,
      replace(substring_index(b4.name, '$v_FTI_SEP_PATH_PARENT', 1), '''', '''''') as to_name,
      group_concat(distinct b3.id separator '$v_FTI_SEP_SPAN') as child__ids,
      gwe__ids, is_new, Country
    from (
      select 
        a1.id as regi__id, a1.type as regi__type, a1.weight as regi__weight, a1.level as regi__level,
        replace(substring_index(a1.name, '$v_FTI_SEP_PATH_PARENT', 1), '''', '''''') as regi__name,
        max(a4.parent_id) as to_path_id,
        group_concat(distinct a2.id separator '$v_FTI_SEP_SPAN') as gwe__ids,
        if(a1.id >= @regi__1st_continent, 1, 0) as is_new,
        ifnull(a7.path, '') as Country
      from $fti_gustos_db.region as a1
        left join $fti_gustos_db.gustos_wine_entity as a2 on a2.region = a1.id
        left join $fti_gustos_db.region_hierarchy as a4 on a4.child_id = a1.id
        left join $fti_gustos_db.field_data_field_region_country as a6 on a6.entity_id = a1.id
        left join $fti_gustos_db.region as a7 on a7.id = a6.field_region_country_target_id
      where 1<>1
        or a2.region >= @regi__1st_appellation
        or a1.id >= @regi__1st_continent
      group by a1.id, a1.type, a1.name, a1.weight, a1.level, a7.path
    ) as b1
      left join $fti_gustos_db.region_hierarchy as b2 on b2.parent_id = b1.regi__id
      left join $fti_gustos_db.region as b3 on b3.id = b2.child_id
      left join $fti_gustos_db.region as b4 on b1.to_path_id = b4.id
    group by b1.regi__id, b1.regi__type, b1.regi__weight, b1.regi__level, b1.regi__name, b4.name, b1.gwe__ids, b1.is_new, b1.Country"
    ;
    $fti_sqr['r0'][] = 
  "UPDATE $fti_gustos_db.gustos_wine_entity as u1
    set u1.region = NULL
    where u1.region >= @regi__1st_appellation"
    ;
  }
  $fti_sqr['r0'][] = "SELECT @regi_preserved_ids := count(*) from src_old_regions";
  $fti_sqr['r0'][] = "DROP TABLE IF EXISTS $fti_gustos_region_db.region_wine";
  $fti_sqr['r0'][] = "DROP TABLE IF EXISTS $fti_gustos_region_db.region_vineyard";
  $fti_sqr['r0'][] = "DROP TABLE IF EXISTS $fti_gustos_region_db.region_hierarchy";
  $fti_sqr['r0'][] = "DROP TABLE IF EXISTS $fti_gustos_region_db.region";
  $fti_sqr['r0'][] =
"CREATE TABLE $fti_gustos_region_db.`region` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `type` enum('CONTINENT','COUNTRY','REGION','APPELLATION') NULL,
    `created` int(10) unsigned NULL,
    `updated` int(10) unsigned NULL,
    `name` varchar(255) NULL,
    `weight` smallint(6) NULL default 0,
    `level` smallint(6) NULL default 0,
    `path` varchar(1024) NULL default '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";  
  $fti_sqr['r0'][] = 
"CREATE TABLE $fti_gustos_region_db.`region_hierarchy` (
  `parent_id` int(10) unsigned NOT NULL,
  `child_id` int(10) unsigned NOT NULL,
  `type` enum('GEOGRAPHICAL','POLITICAL') NOT NULL,
  PRIMARY KEY (`type`,`parent_id`,`child_id`),
  KEY `fk_region_hierarchy_parent_id` (`parent_id`),
  KEY `fk_region_hierarchy_child_id` (`child_id`),
  CONSTRAINT `fk_region_hierarchy_child_id` FOREIGN KEY (`child_id`) REFERENCES $fti_gustos_region_db.`region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_region_hierarchy_parent_id` FOREIGN KEY (`parent_id`) REFERENCES $fti_gustos_region_db.`region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";
  $fti_sqr['r0'][] = 
"CREATE TABLE $fti_gustos_region_db.`region_vineyard` (
  `region_id` int(10) unsigned NOT NULL,
  `vineyard_id` int(10) unsigned NOT NULL,
  `type` enum('GEOGRAPHICAL','CERTIFICATION') NOT NULL,
  `created` int(10) unsigned NOT NULL,
  PRIMARY KEY (`type`,`vineyard_id`,`region_id`),
  KEY `fk_region_wine_region_id` (`region_id`) USING BTREE,
  KEY `fk_region_wine_wine_id` (`vineyard_id`) USING BTREE,
  CONSTRAINT `fk_region_vineyard_region_id` FOREIGN KEY (`region_id`) REFERENCES $fti_gustos_region_db.`region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_region_vineyard_vineyard_id` FOREIGN KEY (`vineyard_id`) REFERENCES $fti_gustos_db.`vineyard` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";
  $fti_sqr['r0'][] =
"CREATE TABLE $fti_gustos_region_db.`region_wine` (
  `region_id` int(10) unsigned NOT NULL,
  `wine_id` int(10) unsigned NOT NULL,
  `type` enum('GEOGRAPHICAL','CERTIFICATION') NOT NULL,
  `created` int(10) unsigned NOT NULL,
  PRIMARY KEY (`type`,`wine_id`,`region_id`),
  KEY `fk_region_wine_wine_id` (`wine_id`),
  KEY `fk_region_wine_region_id` (`region_id`),
  CONSTRAINT `fk_region_wine_region_id` FOREIGN KEY (`region_id`) REFERENCES $fti_gustos_region_db.`region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_region_wine_wine_id` FOREIGN KEY (`wine_id`) REFERENCES $fti_gustos_db.`gustos_wine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";
  $fti_sqr['r0'][] =
"DELETE d1 FROM $fti_gustos_db.taxonomy_term_hierarchy as d1
  inner join $fti_gustos_db.taxonomy_term_data as d2 on d2.tid = d1.tid
  where d2.tid >= @regi__1st_appellation and vid = $Region__vid";
  $fti_sqr['r0'][] = "DELETE FROM $fti_gustos_db.field_data_field_region_country where entity_id >= @regi__1st_appellation";
  $fti_sqr['r0'][] = "DELETE FROM $fti_gustos_db.field_revision_field_region_country where entity_id >= @regi__1st_appellation";
  $fti_sqr['r0'][] = "DELETE FROM $fti_gustos_db.taxonomy_term_data where tid >= @regi__1st_appellation and vid = $Region__vid";
  $fti_sqr['r0'][] = "SELECT @regi_deleted_ids := ROW_COUNT()";
  $fti_sqr['r0'][] =
"INSERT INTO $fti_gustos_region_db.region
      (id, `type`, created, updated, `name`, `weight`, `level`, `path`)
    select 
      t1.tid, if(t1.vid = $Country__vid, 'COUNTRY', 'REGION'), $t, $t, regexp_replace(t1.name, '\\\\bother\\\\b' , ''), 0, 0, ''
    from $fti_gustos_db.taxonomy_term_data as t1
      left join $fti_gustos_db.field_data_field_region_country as t2 on t2.entity_id = t1.tid
    where 1=1
      and t1.name not regexp '\\\\b(temp\\\\b|unknown|delete|удалить|xx|zz|^other)'
      and CHAR_LENGTH(t1.name) > 1
      and (1<>1
        or t1.vid = $Country__vid
        or (1=1
          and t1.vid = $Region__vid
          and t2.entity_id is not null
        )
      )
    ";
  $fti_sqr['r0'][] = "SELECT @regi_created_ids := ROW_COUNT()";
  $fti_sqr['r0'][] = "SET @FTI_TRIGGERS_STOP = 0";
  //print_r($fti_sqr);  exit;
  reg_expr();
  dop("   regions_preserv_rp1 - a - regi__id's preserved : " . db_query("SELECT @regi_preserved_ids")->fetchColumn());
  dop("   regions_preserv_rp2 - APPELLATION rows deleted from taxonomy: " . db_query("SELECT @regi_deleted_ids")->fetchColumn());
  dop("   regions_preserv_rp3 - regions and countries creation for initial records: " . db_query("SELECT @regi_created_ids")->fetchColumn());
}
  