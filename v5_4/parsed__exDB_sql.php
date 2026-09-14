<?php

function parsed__exDB_create_is24954() {
  global $fti_parsedwine__exDB;

  db_query("DROP TABLE IF EXISTS $fti_parsedwine__exDB.src_is24956_Wines_Croitoru");
  
  db_query("CREATE TABLE $fti_parsedwine__exDB.src_is24956_Wines_Croitoru (
      arS int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
      norm_name varchar(128) DEFAULT NULL,
      `name` varchar(128) DEFAULT NULL,
      vineyard int unsigned default null null,
      vine__name varchar(128) DEFAULT NULL,
      country int unsigned default null null,
      countries varbinary(1024) DEFAULT '',
      color int unsigned default null null,
      co2 int unsigned default null null,
      vintage__dsP varbinary(512) default null null, 
      grape__dsP varbinary(512) default null null,
      grape__cnt tinyint default null null,
      nfc_word__cnt tinyint default 0,
      word__cnt tinyint default 0,
      regi__dsP varbinary(512) default null null, 
      regi__path varbinary(512) default null null, 
      attrTYPE__arS SMALLINT unsigned default null null,
      attrTITLE__arS SMALLINT unsigned default null null,
      nfc_gustos_vineyard_id int(11) DEFAULT NULL,
      nfc_gustos_vineyard_name varchar(1024) DEFAULT NULL,
      nfc_gustos_wine__score bigint(20) DEFAULT NULL,
      nfc_gustos_wine__id int(11) DEFAULT NULL,
      nfc_gustos_wine_name varchar(1024) DEFAULT NULL,
      msf_score bigint(20) DEFAULT NULL,
      msf_wine__id int(11) DEFAULT NULL,
      msf_wine_name varchar(1024) DEFAULT NULL,
      msf_vineyard_id int(11) DEFAULT NULL,
      msf_vineyard_name varchar(1024) DEFAULT NULL,
      nfc_grape__dsP varchar(128) DEFAULT NULL,
      nfc_gustos_wine_entity__id int(11) DEFAULT NULL,
      nfc_gustos_vintage int(11) DEFAULT NULL,
      sc_limit int (11) default 0 not null,
      KEY is24956_Wines_Croitoru_nfc_gustos__XK_wine__score(nfc_gustos_wine__score)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
  ");

  db_query(
    "INSERT INTO $fti_parsedwine__exDB.src_is24956_Wines_Croitoru
        (name, vintage__dsP)
      select
        regexp_replace(Artigo, '\\\\d\\\\d\\\\\d\\\\d|\\\\d+ *(m|)l\\\\b', '') as wine_name,
        regexp_substr(Artigo, '\\\\d\\\\d\\\\\d\\\\d') as wine_vintage
      from $fti_parsedwine__exDB.src_is24956_Wines_Croitoru_a
  ");
 
}

function parsed__exDB_create_tables() {
  global $fti_parsedwine__exDB;
  db_query("SET FOREIGN_KEY_CHECKS=0");

  db_query("DROP TABLE IF EXISTS $fti_parsedwine__exDB.src_score__arS");

  db_query("CREATE TABLE $fti_parsedwine__exDB.src_score__arS (
      arS int(11) NOT NULL AUTO_INCREMENT,
      description__dsP varchar(10024) DEFAULT NULL,
      mode__niSB tinyint NOT NULL DEFAULT 1,
      limit_dst tinyint NOT NULL DEFAULT 1,
      created_at timestamp NOT NULL DEFAULT current_timestamp(),
      __cnt int NOT NULL DEFAULT 0,
      __dur int NOT NULL DEFAULT 0,
      PRIMARY KEY (arS)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
  ");
  
  db_query("DROP TABLE IF EXISTS $fti_parsedwine__exDB.src_score__acSG");
  
  db_query("CREATE TABLE $fti_parsedwine__exDB.src_score__acSG (
      acSG int NOT NULL AUTO_INCREMENT,
      score__arS int DEFAULT NULL,
      src__arS int DEFAULT NULL,
      el__id tinyint NOT NULL DEFAULT 0,
      dst__id int DEFAULT NULL,
      score__niOB bigint DEFAULT NULL,
      score__niQB int DEFAULT NULL,
      PRIMARY KEY (acSG),
      KEY src_score__acSG_dst__id_IDX (dst__id) USING BTREE,
      KEY src_score__acSG_score__arS_FK (score__arS) USING BTREE,
      KEY src_score__acSG_src__arS_FK (src__arS) USING BTREE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
  ");
  db_query("SET FOREIGN_KEY_CHECKS=1");
  
}

function parsed__exDB_create_is24297_v4() {
  global $fti_parsedwine__exDB;
  db_query("DROP TABLE IF EXISTS $fti_parsedwine__exDB.src_is24297_v4");
  
  db_query("CREATE TABLE $fti_parsedwine__exDB.src_is24297_v4 (
      arS int(10) unsigned NOT NULL AUTO_INCREMENT,
      wine_name varchar(128) DEFAULT NULL,
      wine_vintage int(11) DEFAULT NULL,
      vineyard_name varchar(128) DEFAULT NULL,
      color__tid int(11) DEFAULT NULL,
      color varchar(128) DEFAULT NULL,
      sugar varchar(128) DEFAULT NULL,
      vol varchar(128) DEFAULT NULL,
      nfc_gustos_vineyard_id int(11) DEFAULT NULL,
      nfc_gustos_vineyard_name varchar(128) DEFAULT NULL,
      nfc_gustos_wine__score bigint(20) DEFAULT NULL,
      nfc_word__cnt tinyint default 0,
      word__cnt tinyint default 0,
      nfc_gustos_wine__id int(11) DEFAULT NULL,
      nfc_gustos_wine_name varchar(128) DEFAULT NULL,
      nfc_grape__dsP varchar(128) DEFAULT NULL,
      nfc_gustos_wine_entety__id int(11) DEFAULT NULL,
      nfc_gustos_vintage int(11) DEFAULT NULL,
      gwmr decimal(14,10) unsigned DEFAULT NULL COMMENT 'Global wine medal rating.',
      gwr decimal(14,10) unsigned DEFAULT NULL COMMENT 'Global wine medal rating & vivino rating.',
      vivino_wine_id int(10) unsigned DEFAULT NULL COMMENT 'Identifier of vivino wine.',
      verified tinyint(4) DEFAULT 0 COMMENT 'Verified by human.',
      PRIMARY KEY (arS)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
  ");
  
  db_query("DROP TABLE IF EXISTS $fti_parsedwine__exDB.src_is24726_Wine_Republic_v4");
  
  db_query("CREATE TABLE $fti_parsedwine__exDB.src_is24726_Wine_Republic_v4 (
      arS int(10) unsigned NOT NULL AUTO_INCREMENT,
      wine_name varchar(128) DEFAULT NULL,
      wine_vintage int(11) DEFAULT NULL,
      vineyard_name varchar(128) DEFAULT NULL,
      color__tid int(11) DEFAULT NULL,
      color varchar(128) DEFAULT NULL,
      sugar varchar(128) DEFAULT NULL,
      vol varchar(128) DEFAULT NULL,
      nfc_gustos_vineyard_id int(11) DEFAULT NULL,
      nfc_gustos_vineyard_name varchar(128) DEFAULT NULL,
      nfc_gustos_wine__score bigint(20) DEFAULT NULL,
      nfc_gustos_wine__id int(11) DEFAULT NULL,
      nfc_gustos_wine_name varchar(128) DEFAULT NULL,
      nfc_grape__dsP varchar(128) DEFAULT NULL,
      nfc_gustos_wine_entety__id int(11) DEFAULT NULL,
      nfc_gustos_vintage int(11) DEFAULT NULL,
      gwmr decimal(14,10) unsigned DEFAULT NULL COMMENT 'Global wine medal rating.',
      gwr decimal(14,10) unsigned DEFAULT NULL COMMENT 'Global wine medal rating & vivino rating.',
      vivino_wine_id int(10) unsigned DEFAULT NULL COMMENT 'Identifier of vivino wine.',
      verified tinyint(4) DEFAULT 0 COMMENT 'Verified by human.',
      PRIMARY KEY (arS)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Rating_Wines_GWR_Vivino_Wine_Republic'
  ");
}