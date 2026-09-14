<?php

// включить лог mariaDB в таблицу
/*
SET GLOBAL log_output = 'TABLE';
SET GLOBAL log_output = 'FILE,TABLE';

SET GLOBAL general_log = 'ON';
SET GLOBAL slow_query_log = 'ON';

SHOW VARIABLES LIKE 'log_output';
SHOW VARIABLES LIKE 'general_log';

SELECT * FROM mysql.general_log;
//*/

function nfc_rep__get_omonym__on__region_syn() {
/*
nf_rep_region_parsed_omonym_2025_03_24.xlsx 

1) Список омонимов регионов полученных при регистрации синонимов из таблицы parsedwine.rule, содержит 96 записей, из них:
а) нормальные совпаденияя - когда в названии использованы слова частей света или категорий типа - central/hout/..., как в acPG=3960
b) -- // -- или когда в названии одни категориальные слова и тогда сравнивается совпадение в категориях, как в acPG=4916

|synonym__acPG|syn_tid|syn_name|syn_tara|om_tid|om_name|om_tara|om_attr|rule__id|synonym_rec|
|-------------|-------|--------|--------|------|-------|-------|-------|--------|-----------|
|3960|5546|Castile and Leon|spain|2656|Central Valley|chile|,central,|65027|Central Castile|
|4619|6349|Black Sea Region|turkey|2725|Black Sea Coast|ukraine|sy__black sy__sea sy__coast,,|193509|Black Sea Coast|

c) - явные ошибки, когда в синониме обнаружен "заглавный терм" региона другой страныи и он не типа (а) и (b) выше:

|synonym__acPG|syn_tid|syn_name|syn_tara|om_tid|om_name|om_tara|om_attr|rule__id|synonym_rec|
|-------------|-------|--------|--------|------|-------|-------|-------|--------|-----------|
|4403|5875|Loire Valley (Val de Loire)|france|1567|Toscana (Tuscany)|italy||49961|Toscana|
|3466|5052|German-Speaking Switzerland|switzerland|3367|Baden|germany||25533|Kaiserstuhl / Baden|
|261|1555|Bordeaux|france|3716|Murcia|spain||40598|Murcia|

d) подозрение на тип (а) и (b), когда в синониме есть слова похожие на категорию, но в базе как категория не зарегин. Например для acPG=4929, для региона (Arizona (AZ)) есть синоним (Arizona, Verde Valley), котрый с учетом вычитоа зарегиных категорий совпадает с регионом (Vinho Verde <portugal), где (Vinho) - это категориия:

|synonym__acPG|syn_tid|syn_name|syn_tara|om_tid|om_name|om_tara|om_attr|rule__id|synonym_rec|
|-------------|-------|--------|--------|------|-------|-------|-------|--------|-----------|
|3389|4929|Arizona (AZ)|united states|6944|Vinho Verde|portugal|valley,,|207250|Arizona, Verde Valley|
|-------------|-------|--------|--------|------|-------|-------|-------|--------|-----------|
|1874|4392|Provence|france|4814|Mediterranean|turkey|pgi,,|218484|IGP Mediterranean|

*/
      
    $sql = 
"SELECT
	t1.synonym__acPG,
	t2.regi__id as syn_tid, t5.name as syn_name, SUBSTRING_INDEX(t5.path, ' <', -1) as syn_tara,
	t1.omonym__id as om_tid, t6.name as om_name, SUBSTRING_INDEX(t6.path, ' <', -1) as om_tara,
	_attr__asFL(t2.attr__arS) as om_attr, t2.rule__id, replace(t4.name, '\n', ', ') as synonym_rec
FROM nfc_rs_regi_syn__arPD_om t1
  left join nfc_rs_regi_syn__arPD as t2 on t2.acPG = t1.synonym__acPG
  left join rule as t3 on t3.id = t2.rule__id
  left join synonym as t4 on t4.id = t3.synonym_id
  left join gustos_region.region as t5 on t5.id = t2.regi__id
  left join gustos_region.region as t6 on t6.id = t1.omonym__id
order by syn_tara
  ";

  /*
1) Список омонимов обнаруженных в таблице parsedwine.rule для синонимов  регионов по состоянию на 2025-03-20
*/
}

function nfc_rep_region_parsed_syn() {
  /*
1) Список всех различных синонимов регионов для таблицы parsedwine.rule, отсортированный по (стране)/(число синонимов данного региона)/(имя первого терма в записе синонимов)
 (nfc_rep_region_syn_2025_03_17.xlsx)

 Требуется подтвердить, что в основном это варианты написания рзличных подрегионов дла головного региона
  */
  $sql = 
"SELECT 
	t1.acPG, t1.regi__id, cnt,
	t4.name as reg_name, SUBSTRING_INDEX(t4.path, ' <', -1) as reg_tara,
	group_concat(_term__asFL_dsP(t1.term__arP) order by t1.term__arP separator ' / ') as syn_term, t1.rule__id,
	replace(t3.name, '\n', ', ') as syn_record
FROM nfc_rs_regi_syn__arPD as t1
  left join rule as t2 on t2.id = t1.rule__id 
  left join synonym as t3 on t3.id = t2.synonym_id 
  left join gustos_region.region as t4 on t4.id = t1.regi__id
  left join (select regi__id, count(*) as cnt from nfc_rs_regi_syn__arPD group by regi__id) as t5 on t5.regi__id = t1.regi__id
group by t1.regi__id, t1.rule__id
order by reg_tara, cnt desc, t1.regi__id, syn_term 
  ";
}

function nfc_rep_region_parsed_doubt() {

  /*
1) Подозрительные связи в таблице parsedwine.rule
a - если страны разные, то это омонимы
b - если страны одинаковые, то это либо ошибка либо иеррахия
  */
  $sql = 
"SELECT x.reg_tid, x.rule__id,x.synonym,x.term__dsP,x.ref_id,x.ref_rule_id 
  FROM parsedwine.nfc_expr__asVS_term x
  WHERE link__hex = 00044020;
";
  return $sql;
}

function nf_rep_garpes_dups() {
  $sql =
"SELECT t1.link__id, t2.name, t1.grap__id, t3.name
  FROM parsedwine.nfc_expr_grap__arPD_link as t1
    left join gustosapp.taxonomy_term_data as t2 on t2.tid = t1.link__id
    left join gustosapp.taxonomy_term_data as t3 on t3.tid = t1.grap__id 
  ";
  return $sql;
}

function nfc_rep_region_parsed_interference() {
/*
1) Совпадения в не гланых термах регионов в таблице parsedwine.rule

Совпадения по категориям вин будут вычищены автоматом - 1222 записи

[nf_rep_region_parsed_interference_2025_03_24.xlsx](https://redmine.deeplace.md/attachments/48766)
*/
  $sql =
"SELECT @syn_parsed__eMI := val
  from nfc_type__arP as i1
  where 1=1
  	and i1.description like 'link__eMI%'
  	and i1.dsP = 'link_syn_parsed__eB'
;
SELECT DISTINCT _term__asFL_dsP(t1.term__arP) term_name,
	concat_ws(' / ', t2.id, t3.name) as reg_tid,
	SUBSTRING_INDEX(t3.path, ' <', -1) as reg_tara, t4.rule__id, t6.name 
FROM nfc_expr__acPG_term as t1
  left join nfc_expr__arP as t2 on t2.arP = t1.expr__arP
  left join gustos_region.region as t3 on t3.id = t2.id
  left join nfc_rs_regi_syn__arPD as t4 on t4.regi__id = t2.id and t4.term__arP = t1.term__arP
  left join rule as t5 on t5.id = t4.rule__id
  left join synonym as t6 on t6.id = t5.synonym_id
  left join nfc_expr_attr__arSD t7 on t7.arSD = t4.attr__arS
  inner join (
  	select i1.term__arP
  	from nfc_expr__acPG_term as i1
      left join nfc_expr__arP as i2 on i2.arP = i1.expr__arP	  
      left join nfc_rs_regi_syn__arPD as i6 on i6.regi__id = i2.id and i6.term__arP = i1.term__arP
      left join nfc_expr_attr__arSD i8 on i8.term__arP = i6.term__arP
  	where 1=1
  	  and (i1.link__eMI & @syn_parsed__eMI) > 0
  	  and i8.term__arP is null
  ) as t8 on t8.term__arP = t1.term__arP 
order by t1.term__arP, reg_tara
  ";
  return $sql;
}

function nfc_get_region_src__exDB() {
  global $fti_parsedwine__exDB;
  $sql_u =
"SELECT 'src_regions_France_EU' src,
    ENG_term, Fr_term, IGP_IGT, Name, Country, Gustos_Import_Name, Wine_region, '' Multiparrent_possible
  FROM $fti_parsedwine__exDB.src_regions_France_EU
UNION ALL
  SELECT 'src_regions_Italy' src,
    ENG_term, Fr_term, IT_term, Name, Country, Gustos_Name_to_import, Gustos_Parent, Multiparrent_possible
  FROM $fti_parsedwine__exDB.src_regions_Italy
UNION ALL
  SELECT 'src_regions_Moldova' src,
    `ENG term`, `Fr term`, `IGP / IGT`, Name, Country, `Gustos Name to import`, `Gustos Parent`, `Multiparrent possible`
  FROM $fti_parsedwine__exDB.src_regions_Moldova   
UNION ALL
  SELECT 'src_regions_switzerland' src,
    `ENG_term`, `Fr_term`, `It/_esp`, Name, Country, `Gustos_Name_to_import`, `Gustos_Parent`, `Multiparrent_possible`
  FROM $fti_parsedwine__exDB.src_regions_switzerland      
UNION ALL
  SELECT 'src_regions_US' src,
    ENG_term, '', '', Gustos_Name_to_import as Name, Country, Gustos_Name_to_import, gustos_parent, Multiple_possible
  FROM $fti_parsedwine__exDB.src_regions_US   
UNION ALL
  SELECT 'src_regions_canada' as src,
    ENG_term, '', '', Name, Country, Name as Gustos_Name_to_import, Gustos_Parent, Multiple_possible
  FROM $fti_parsedwine__exDB.src_regions_canada
UNION ALL
  SELECT 'src_regions_australia' src,
    ENG_term, '', '', Name, Country, Gustos_Name_to_import, Parent_Item, ''
  FROM $fti_parsedwine__exDB.src_regions_australia      
UNION ALL
  SELECT 'src_regions_Spain' src,
    Certification_level, '', '', Name, Country, Gustos_Name_to_import, Gustos_Parent, Multiparrent_possible
  FROM $fti_parsedwine__exDB.src_regions_Spain
UNION ALL
  SELECT 'src_regions_South_Africa' src,
    ENG_term, '', '', Name, Country, Gustos_Name_to_import, Parent_Item, ''
  FROM $fti_parsedwine__exDB.src_regions_South_Africa
UNION ALL
  SELECT 'src_regions_New_Zealand' src,
    ENG_term, '', '', Name, Country, Gustos_Name_to_import, Parent_Item, ''
  FROM $fti_parsedwine__exDB.src_regions_New_Zealand
UNION ALL
  SELECT 'src_regions_Argentina' src,
    ENG_term, Fr_term, `IGP_/_IGT`, Name, 'Argentina' as Country, Gustos_Name_to_import, Gustos_Parent, Column9 as Multiparrent_possible
  FROM $fti_parsedwine__exDB.src_regions_Argentina
UNION ALL
  SELECT 'src_regions_Austria' src,
    ENG_term, Fr_term, `IGP_/_IGT`, Name, Country, Gustos_Name_to_import, Gustos_Parent, Multiparrent_possible
  FROM $fti_parsedwine__exDB.src_regions_Austria
UNION ALL
  SELECT 'src_regions_Chile' src,
    ENG_term, Fr_term, `IGP_/_IGT`, Name, Country, Gustos_Name_to_import, Gustos_Parent, Multiparrent_possible
  FROM $fti_parsedwine__exDB.src_regions_Chile
UNION ALL
  SELECT 'src_regions_Czech' src,
    ENG_term, Fr_term, `IGP_/_IGT`, Name, 'Czech' as Country, Gustos_Name_to_import, Gustos_Parent, Multiparrent_possible
  FROM $fti_parsedwine__exDB.src_regions_Czech
UNION ALL
  SELECT 'src_regions_Germany' src,
    ENG_term, Fr_term, `IGP_/_IGT`, Name, Country, Gustos_Name_to_import, Gustos_Parent, Multiparrent_possible
  FROM $fti_parsedwine__exDB.src_regions_Germany
UNION ALL  
  SELECT 'src_regions_Portugal' src, 
    ENG_term, Fr_term, `IGP_/_IGT`, Name, Country, Gustos_Name_to_import, Gustos_Parent, Multiparrent_possible
  FROM $fti_parsedwine__exDB.src_regions_Portugal"
  ;
  $sql =
"SELECT DISTINCT a1.src, replace(a1.Name, '''', ' ') as `Name`,
  replace(if(a1.Name <> '', a1.Name, a1.Gustos_Import_Name), '''', ' ') as Gustos_Import_Name,
  trim(
    replace(if(a1.IGP_IGT <> '',
              a1.IGP_IGT,
              if(a1.ENG_term <> '',
                a1.ENG_term,
                a1.Fr_term
              )
            ),
            '''', ' '
    )
  ) as IGP,
  a1.Country, a2.country__tid as countries,
  replace(a1.Wine_region, '''', ' ') as Wine_region,
  replace(a1.Multiparrent_possible , '''', ' ') as Multiparrent_possible
from (
    SELECT t1.src, t1.ENG_term, t1.Fr_term, t1.IGP_IGT, t1.Name, t1.Country, t1.Gustos_Import_Name, t1.Wine_region, t1.Multiparrent_possible
    FROM ($sql_u) as t1
  UNION ALL
    SELECT
    	'src_regions_EU' as src,
      t2.ENG_term, t2.Fr_term, t2.IGP_IGT, t2.Name, t2.Country, t2.Gustos_Name_to_import, t2.Gustos_Parent, t2.Multiparrent_possible
    FROM $fti_parsedwine__exDB.src_regions_EU as t2
      left join ($sql_u) as t3 on t2.Country = t3.Country and t2.Name = t3.Name
    where t3.Country is null
  UNION ALL
    SELECT 'src_old' as src, '' ENG_term, '' Fr_term, '' IGP_IGT, t1.regi__name as `Name`, t1.Country, t1.regi__name, t1.to_name, '' as Multiparrent_possible
    FROM src_old_regions as t1
    where 1=1
      and t1.is_new = 1
      and t1.regi__type <> 'CONTINENT'
  ) as a1
	left join $fti_parsedwine__exDB.src_countries as a2 on a2.country__name = a1.Country
where a2.country__tid is not null
";
// where a2.country__tid is not null and a1.Name like '%Beaujolais-Villages%'
  //cho "\n$sql\n";
  return $sql;
}

function nfc_create_countris() {
  global $fti_parsedwine__exDB;
  $sql =
"CREATE table $fti_parsedwine__exDB.src_countries
select id as country__tid, _term__asFL_dsP(a3.term__arP) as country__name
from (
	select val as exTARA from nfc_type__arP as i1 where i1.description like 'expr__eS%' and i1.dsP = 'exTARA'
) as a1, nfc_expr__arP as a2
  left join nfc_expr__acPU_term as a3 on (a3.expr__arP & (0x00FFFFFF+0)) = a2.arP
where expr__eS = exTARA
order by id
  ";
  return $sql;
}

function nfc_rep_country_award() {
  $sql =
"SELECT t4.name, t4.tid, count(*) cnt
FROM gustosapp.third_party_award_wine_entity t1
  left join gustosapp.gustos_wine_entity as t2 on t2.id = t1.wine_entity_id
  left join gustosapp.gustos_wine as t3 on t3.id = t2.wine
  left join gustosapp.taxonomy_term_data as t4 on t4.tid = t3.country
group by t4.name, t4.tid
";
  return $sql;
}

function nfc_rep_src_regions_found() {
  global $fti_parsedwine__exDB;
  $sql =
"SELECT x.id, x.src, r2.name as country, x.cur_name , concat(x.regi__id, ' / ', r.name) gustos_name, x.src_path 
FROM $fti_parsedwine__exDB.nfc_src_regions x
  left join gustos_region.region r on r.id = x.regi__id
  left join gustos_region.region r2 on r2.id = x.country__tid
where x.regi__id > 0
group by regi__id
order by x.country__tid, x.id 
  ";
  return $sql;
}

function nfc_rep_src_regions_not_found() {
  global $fti_parsedwine__exDB;
  $sql =
"SELECT 
  t1.id, t1.name, t1.path, SUBSTRING_INDEX(t1.path, ' < ', -1) country
from gustos_region.region as t1
  left join $fti_parsedwine__exDB.nfc_src_regions as t2 on t2.regi__id = t1.id 
where 1=1
  and t1.`type` = 'region'
  and t2.regi__id is null
order by country, t1.name 
  ";
  return $sql;
}

function nfc_rep_src_regions_found_syn() {
  global $fti_parsedwine__exDB;
  $sql =
"SELECT t1.src, t3.name, cnt, t1.cur_name, t1.src_path, t1.term__arP, t8.name as syn_name, t4.path as base_region, t2.rule__id
FROM $fti_parsedwine__exDB.nfc_src_regions as t1
  left join nfc_rs_regi_syn__arPD as t2 on t2.term__arP = t1.term__arP
  left join gustos_region.region as t3 on t3.id = t1.country__tid
  left join gustos_region.region as t4 on t4.id = t2.regi__id
  left join nfc_expr_attr__arSD as t5 on t5.term__arP = t1.term__arP
  left join (
  	select count(*) as cnt, term__arP
  	from (
      select i1.term__arP, i2.regi__id
      from $fti_parsedwine__exDB.nfc_src_regions i1
        left join nfc_rs_regi_syn__arPD as i2 on i2.term__arP = i1.term__arP
      group by i1.term__arP, i2.regi__id
    ) as i3
    group by term__arP
  ) as t6 on t6.term__arP = t1.term__arP
  left join rule as t7 on t7.id = t2.rule__id
  left join `synonym` as t8 on t8.id = t7.synonym_id 
where 1=1
  and t4.type = 'region'
  and t1.term__arP > 0
  and t5.arSD is null
group by t1.term__arP, t2.regi__id 
order by cnt desc, t3.name, t1.term__arP
";
  return $sql;
}

function nfc_rep_om_in_syn_primary() {
  global $fti_parsedwine__exDB;
  $sql =
"SELECT
	t1.*, _term__asFL_dsP(t1.whenTerm__arP) term,
	t4.id, t4.type, t4.name,
	_term__asFL_dsP(if(t5.chiTerm__arP is null, t6.chiTerm__arP, t5.chiTerm__arP)) as tara,
	t6.id as keyID
FROM nfc_rule__acSG_term_expr as t1
  left join nfc_expr__arP as t2 on t2.arP = t1.keyExpr__arP
  left join nfc_expr__arP as t3 on t3.chiTerm__arP = t1.whenTerm__arP
  left join $fti_parsedwine__exDB.region as t4 on t4.id = t3.id
  left join nfc_expr__arP as t5 on t5.arP = t3.parExpr__arP
  left join nfc_expr__arP as t6 on t6.arP = t1.keyExpr__arP 
  ";
  return $sql;
}

function nfc_rep_om_in_syn_second() {
  global $fti_parsedwine__exDB;
  $sql =
"SELECT t1.arP,
  _term__asFL_dsP(t3.chiTerm__arP) as tara,
  t4.path as reg_path,
  _term__asFL_dsP(t2.term__arP) as reg_term, t4.name as reg_name, t1.id as reg_id, 
  t7.name as om_name, t6.id as om_id, _term__asFL_dsP(t5.term__arP) as om_term,  t7.path as om_path
from nfc_expr__arP as t1
  cross join (select val as region__eS from nfc_type__arP where dsP = 'exREGI') as t0 
  left join nfc_expr__acPU_term as t2 on (t2.expr__arP & (0x00FFFFFF+0)) = t1.arP
  left join nfc_expr__arP as t3 on t3.arP = t1.parExpr__arP
  left join $fti_parsedwine__exDB.region as t4 on t4.id = t1.id
  left join nfc_expr__acPU_term as t5 on t5.term__arP = t2.term__arP
  left join nfc_expr__arP as t6 on t6.arP = t5.expr__arP
  left join $fti_parsedwine__exDB.region as t7 on t7.id = t6.id
where 1=1
  and t1.expr__eS = region__eS
  and t3.arP is not null
  and t2.expr__arP > (0x00FFFFFF+0)
  and t5.expr__arP is not null
  and (t5.expr__arP & (0x00FFFFFF+0)) <> t1.arP
  and t5.expr__arP < (0x00FFFFFF+0)
order by tara, (t2.expr__arP & (0x00FFFFFF+0))
  ";
  return $sql;
}

function nfc_rep_wines_changing_TYPES() {
  global $fti_parsedwine__exDB, $fti_gustos_db;
  $sql =
"SELECT distinct a1.path, t1.word__cnt,
  t1.wine__id, t2.name, t6.dsP, t1.from__id,
  if(t1.expr__eS = t6.val and t6.dsP = 'exVINE',
    t10.name,
    if(t1.expr__eS = t6.val and t6.dsP = 'exGRAP',
      t8.name,
      if(t1.expr__eS = t6.val and t6.dsP = 'exREGI',
      	t12.name,
      	regexp_substr(b2.description, '-- *\\K\\w*')
      )
    )
  ) from_n,
  t1.to__id,
  if(t1.expr__eS = t6.val and t6.dsP = 'exVINE',
    t9.name,
    if(t1.expr__eS = t6.val and t6.dsP = 'exGRAP',
      t7.name,
      if(t1.expr__eS = t6.val and t6.dsP = 'exREGI',
        t11.name,
        regexp_substr(b1.description, '-- *\\K\\w*')
      )
    )
  ) to_n
FROM parsedwine.nfc_expr_wine__acPG t1
  left join $fti_gustos_db.gustos_wine as t2 on t2.id = t1.wine__id 
  left join nfc_expr_wine__arPD as t3 on t3.wine = t2.id
  left join nfc_type__arP as t6 on t6.description like 'expr__eS%' and t6.val = t1.expr__eS
  left join nfc_blend__asVS as t7 on t1.expr__eS = t6.val and t6.dsP = 'exGRAP' and t7.blend__arS = t1.to__id 
  left join nfc_blend__asVS as t8 on t1.expr__eS = t6.val and t6.dsP = 'exGRAP' and t8.blend__arS = t1.from__id
  left join $fti_gustos_db.vineyard as t9 on t1.expr__eS = t6.val and t6.dsP = 'exVINE' and  t9.id = t1.to__id 
  left join $fti_gustos_db.vineyard as t10 on t1.expr__eS = t6.val and t6.dsP = 'exVINE' and  t10.id = t1.from__id
  left join $fti_parsedwine__exDB.region as t11 on t11.id = t1.to__id
  left join $fti_parsedwine__exDB.region as t12 on t12.id = t1.from__id
  left join $fti_parsedwine__exDB.region a1 on a1.id = t2.country
  left join nfc_type__arP as b1 on b1.description like 'attr__eC%' and b1.val = t1.to__id
  left join nfc_type__arP as b2 on b2.description like 'attr__eC%' and b2.val = t1.from__id
where 1=1
	and t6.dsP = 'wineTYPE'
	-- and to__id not in(6430)
order by t1.word__cnt desc, to__id -- path, t2.name -- a1.path
  ";
}
