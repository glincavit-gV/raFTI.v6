<?php
global $fti_gustos_db, $fti_sq, $fti_gustos_region_db, $fti_parsedwine__exDB;

include_once "nfc_macro.php";

$fti_gustos_db = config('database.connections.gustosapp.database'); // 'gustos';//
$fti_gustos_region_db = $fti_gustos_db;
$fti_parsedwine__exDB = "parsedwine";

function nfc_drop_procedures() {
  db_query("DROP FUNCTION if exists gustos_wine_entity__acFL_fix_vintage");
  db_query("DROP PROCEDURE if exists nfc_expr__asPL_vine_gustosapp");
  db_query("DROP PROCEDURE if exists nfc_expr__asPL_regi_gustosapp");
  db_query("DROP PROCEDURE if exists nfc_expr__asPL_grap_gustosapp");
  db_query("DROP PROCEDURE if exists nfc_expr__asPL_wine_gustosapp");
  db_query("DROP PROCEDURE if exists nfc_expr_regi__arPD_span__asPL_create");
  db_query("DROP FUNCTION if exists nfc_expr__asFL_term_syn_count");
  db_query("DROP PROCEDURE if exists nfc_expr__asPL_term_syn_load");
  db_query("DROP FUNCTION if exists nfc_expr__asPL_syn_load");
  db_query("DROP PROCEDURE if exists nfc_rule__arS__asPL_load");
  db_query("DROP PROCEDURE if exists nfc_rule__arS__asPL_init");
  db_query("DROP PROCEDURE if exists nfc_attr__asPL_term_init");
  db_query("DROP PROCEDURE if exists nfc_attr__asPL_term_load");
  db_query("DROP PROCEDURE if exists nfc_attr__asPL_load");
  db_query("DROP FUNCTION if exists nfc_word__asFL_group_insert");
  db_query("DROP PROCEDURE if exists nfc_word__asPL_group_delete"); 
  db_query("DROP FUNCTION if exists _norma__asFL_v2");
  db_query("DROP FUNCTION if exists _reg_word__asFL");
  db_query("DROP FUNCTION if exists _norm_ii__asFL");
  db_query("DROP FUNCTION if exists _syTerm__asFL");  
  db_query("DROP FUNCTION if exists _attr__asFL");
  db_query("DROP FUNCTION if exists _term__asFL_dsP");
  db_query("DROP FUNCTION if exists _expr__asFL");
  db_query("DROP FUNCTION if exists _acI__asFL");
  db_query("DROP FUNCTION if exists _wine__asFL");
  db_query("DROP FUNCTION if exists _xName__asFL");
  db_query("DROP FUNCTION if exists _tName__asFL");
  db_query("DROP FUNCTION if exists _sNs__asFL");
  db_query("DROP FUNCTION if exists _s2w__asFL");
  db_query("DROP PROCEDURE if exists _iName__asPL");

}

$fti_sq['init'] =
"SELECT
      cast(-1 as int) as `level`, 'nfc__eN' as dsP, '-- top most object of data hive - meta type' as `description`, 
      cast(0 as unsigned) as seg_next, cast(0 as unsigned) as seg_mask, cast(0 as unsigned) as seg_start
union values
      (100,'nfc_type_segment__arP', 'nfc__eN-- aggregate rgister segments unit dada type', 0, 0, 0),
      (102,'dtHOLDS__eN', 'nfc__eN-- data holder types', 0, 0, 0),
      (103,'dtFIELD__eN', 'nfc__eN-- data fields types', 0, 0, 0),
      (104,'dtINDEX__eN', 'nfc__eN-- data index types', 0, 0, 0),
      (105,'atST__eF', 'nfc__eN-- attributes structure', 0, 0, 0),
      (106,'scST__eF', 'nfc__eN-- scores structure', 0, 0, 0),
      (107,'vars__eC', 'nfc__eN-- variables values', 0, 0, 0),
      (108,'register_src__eC', 'nfc__eN-- variables values', 0, 0, 0),
      (109,'grape_score__eC', 'nfc__eN-- variables values', 0, 0, 0),
      (110,'word__eC', 'nfc__eN-- word tipology', 0, 0, 0),
      (111,'word__eMT', 'nfc__eN-- word enamed mask tinyint codes', 0, 0, 0),
      (112,'expr__eC', 'nfc__eN-- tipology groups', 0, 0, 0),
      (113,'wi__eF', 'nfc__eN-- wine tipology codes', 0, 0, 0),
      (114,'vy__eF', 'nfc__eN-- vineyard tipology codes', 0, 0, 0),
      (115,'reg__eF', 'nfc__eN-- regions tipology codes', 0, 0, 0),
      (116,'link__eMI', 'nfc__eN-- regions link types', 0, 0, 0),
      (117,'rule__eN', 'nfc__eN-- rule name', 0, 0, 0),
      (118,'column__eN', 'nfc__eN-- rule expr column name', 0, 0, 0),
      (119,'expr__eS', 'nfc__eN-- expression serislized array', 0, 0, 0),
      (120,'attr__eS', 'nfc__eN-- attributes tipology codes', 0, 0, 0),
      (121,'attr__eB', 'nfc__eN-- 1169-red/1170-white/1171-rose/1358-still/1359-pearl/1360-sparcling', 0, 0, 0),
      (122,'attr__eMT', 'tinyint bit mask of attr__eB', 0, 0, 0),
      (" . NFC_TYPE__arP . ",'nfc_type__arP', 'nfc_type_segment__arP', 0x00000000+0, 0x00000FFF+0, 0x00000000+0),
      (" . NFC_WORD__arP . ",'nfc_word__arP', 'nfc_type_segment__arP', 0x00100000+0, 0x000FFFFF+0, 0x00100000+0),
      (" . NFC_TERM__arP . ",'nfc_term__arP', 'nfc_type_segment__arP', 0x00200000+0, 0x000FFFFF+0, 0x00200000+0),
      (" . NFC_EXPR__arP . ",'nfc_expr__arP', 'nfc_type_segment__arP', 0x00300000+0, 0x000FFFFF+0, 0x00300000+0),
      (" . NFC_FORM__arP . ",'nfc_form__arP', 'nfc_type_segment__arP', 0x00FFFFFF+0, 0xFF000000+0, 0x01000000+0),
      (200,'__eN', 'dtHOLDS__eN-- enamed number', 0, 0, 0),
      (201,'__eB', 'dtHOLDS__eN-- enamed bits', 0, 0, 0),
      (202,'__eF', 'dtHOLDS__eN-- enamed fields', 0, 0, 0),
      (203,'__eC', 'dtHOLDS__eN-- enamed code', 0, 0, 0),
      (204,'__eH', 'dtHOLDS__eN-- enamed hex', 0, 0, 0),
      (205,'__eMB', 'dtHOLDS__eN-- enamed mask bigint', 0, 0, 0),
      (206,'__eMI', 'dtHOLDS__eN-- enamed mask int', 0, 0, 0),
      (207,'__eMS', 'dtHOLDS__eN-- enamed mask small', 0, 0, 0),
      (208,'__eMT', 'dtHOLDS__eN-- enamed mask tiny', 0, 0, 0),
      (209,'__eMD', 'dtHOLDS__eN-- enamed mask decimal', 0, 0, 0),
      (210,'__arP', 'dtHOLDS__eN-- aggregate register primary contour', 0, 0, 0),
      (211,'__arS', 'dtHOLDS__eN-- aggregate register secondary contour', 0, 0, 0),
      (212,'__arR', 'dtHOLDS__eN-- aggregate register reverse contour', 0, 0, 0),
      (213,'__arPD', 'dtHOLDS__eN-- aggregate regisater primary detalisation', 0, 0, 0),
      (214,'__acPU', 'dtHOLDS__eN-- aggregate component primary union', 0, 0, 0),
      (215,'__acPG', 'dtHOLDS__eN-- aggregate component primary grid', 0, 0, 0),
      (216,'__arSD', 'dtHOLDS__eN-- aggregate component secondary detalisation', 0, 0, 0),
      (217,'__acSU', 'dtHOLDS__eN-- aggregate component seconadary union', 0, 0, 0),
      (218,'__acSG', 'dtHOLDS__eN-- aggregate component seconadary grid', 0, 0, 0),
      (219,'__dsP', 'dtHOLDS__eN-- designation primary', 0, 0, 0),
      (220,'__parsed__nfcDB', 'dtHOLDS__eN-- back up data base', 0, 0, 0),
      (221,'__eS', 'dtHOLDS__eN-- enamed structure', 0, 0, 0),
      (222,'__eJ', 'dtHOLDS__eN-- enamed json', 0, 0, 0),
      (223,'__eT', 'dtHOLDS__eN-- enamed term', 0, 0, 0),
      (224,'__eSI', 'dtHOLDS__eN-- enamed structure integer type', 0, 0, 0),
      (225,'__eSEP', 'dtHOLDS__eN-- enamed separors', 0, 0, 0),
      (226,'__eNV', 'dtHOLDS__eN-- enamed number value from var', 0, 0, 0),
      (300,'__niSB', 'dtFIELD__eN-- number int single bytes', 0, 0, 0),
      (301,'__niDB', 'dtFIELD__eN-- number int double bytes', 0, 0, 0),
      (302,'__niQB', 'dtFIELD__eN-- number int quad bytes', 0, 0, 0),
      (303,'__nuQB', 'dtFIELD__eN-- number unsigned quad bytes', 0, 0, 0),
      (304,'__nuOB', 'dtFIELD__eN-- number unsigned octet bytes', 0, 0, 0),
      (305,'__dfOB', 'dtFIELD__eN-- Full Date in Octet Bytes', 0, 0, 0),
      (400,'__PK', 'dtINDEX__eN-- primary key', 0, 0, 0),
      (401,'__FK', 'dtINDEX__eN-- foreign key', 0, 0, 0),
      (402,'__UK', 'dtINDEX__eN-- unical key', 0, 0, 0),
      (403,'__XK', 'dtINDEX__eN-- index key -- not unical', 0, 0, 0),
      (500,'astCOL', 'atST__eF-- color', 0, 3, 2),
      (501,'astCO2', 'atST__eF-- CO2', 2, 0xC+0, 2),
      (502,'astCNTR', 'atST__eF-- country', 0x10+0, 0xFF0, 8),
      (503,'astVINT', 'atST__eF-- vintage', 0x1000+0, 0xFF000+0, 8),
      (600,'sstMOD__eC', 'scST__eF-- mode', 0, 1, 1),
      (601,'sstRUL__eC', 'scST__eF-- rule', 1, 6, 2),
      (60000,'smodMy', 'sstMOD__eC-- MySQL FTI: 0', 0, 0, 0),
      (60001,'smodRa', 'sstMOD__eC-- RaSQL FTI: 1', 0, 0, 0),
      (60100,'srulNAM', 'sstRUL__eC-- Name only match - 0/off, 1/on: 1', 0, 0, 0),
      (60101,'srulGRAP', 'sstRUL__eC-- +Grape - 0/off, 1/on: 1', 0, 0, 0),
      (60102,'srulREGI', 'sstRUL__eC-- +Region - 0/off, 1/on: 1', 0, 0, 0),
      (60103,'srulVINE', 'sstRUL__eC-- +Vineyard - 0/off, 1/on: 1', 0, 0, 0),
      (60104,'srulALL', 'sstRUL__eC-- +All - 0/off, 1/on: 0', 0, 0, 0),
      (700,'scnMyNAM', 'scCN__eC-- smodMy(SQL) + srulNAM: 0', 0, 0, 0),
      (702,'scnMyGRAP', 'scCN__eC-- My+GRAP: 2', 0, 0, 0),
      (704,'scnMyVINE', 'scCN__eC-- : 4', 0, 0, 0),
      (706,'scnMyALL',  'scCN__eC-- : 6', 0, 0, 0),
      (701,'scnRaNAM',  'scCN__eC-- : 1', 0, 0, 0),
      (703,'scnRaGRAP', 'scCN__eC-- : 3', 0, 0, 0),
      (705,'scnRaVINE', 'scCN__eC-- : 5', 0, 0, 0),
      (707,'scnRaALL',  'scCN__eC-- : 7', 0, 0, 0),
      (800,'exDUP', 'expr__eS-- : i:0x00000000,s:dup'     , 0, 0, 0),
      (801,'exWINE', 'expr__eS-- FTI_WINE=x01: i:0x000000" . str_pad(dechex(FTI_WINE), 2, '0', STR_PAD_LEFT) . ",s:wine'     , 0, 0, 0),
      (802,'exVINE', 'expr__eS-- =x02 :   i:0x01A000" . str_pad(dechex(FTI_VINE), 2, '0', STR_PAD_LEFT) . ",s:vine' , 0, 0, 0),
      (803,'exREGI', 'expr__eS-- =x04 :   i:0x01A000" . str_pad(dechex(FTI_REGI), 2, '0', STR_PAD_LEFT) . ",s:regi'   , 0, 0, 0),
      (804,'exGRAP', 'expr__eS-- =x08:    i:0x116000" . str_pad(dechex(FTI_GRAP), 2, '0', STR_PAD_LEFT) . ",s:grap'    , 0, 0, 0),
      (805,'exTARA', 'expr__eS-- =x10 :   i:0x1D4000" . str_pad(dechex(FTI_TARA), 2, '0', STR_PAD_LEFT) . ",s:tara'    , 0, 0, 0),
      (806,'exHTAG', 'expr__eS-- =x01:    i:0x000001" . str_pad(dechex(FTI_WINE), 2, '0', STR_PAD_LEFT) . ",s:htag'    , 0, 0, 0),
      (807,'exATAG', 'expr__eS-- =x01:    i:0x000003" . str_pad(dechex(FTI_WINE), 2, '0', STR_PAD_LEFT) . ",s:atag'    , 0, 0, 0),
      (808,'wineTYPE', 'expr__eS-- =x01:  i:0x131010" . str_pad(dechex(FTI_WINE), 2, '0', STR_PAD_LEFT) . ",s:wineTYPE__eMB'    , 0, 0, 0),
      (809,'wineTITLE', 'expr__eS-- =x01: i:0x330020" . str_pad(dechex(FTI_WINE), 2, '0', STR_PAD_LEFT) . ",s:wineTITLE__eMB'    , 0, 0, 0),
      (810,'wineTRIG', 'expr__eS-- =x01:  i:0x131030" . str_pad(dechex(FTI_WINE), 2, '0', STR_PAD_LEFT) . ",s:wineTRIG__eMB'    , 0, 0, 0),
      (811,'wineTRIGS', 'expr__eS-- =x01:  i:0x000030" . str_pad(dechex(FTI_WINE), 2, '0', STR_PAD_LEFT) . ",s:wineTRIGS__eMB'    , 0, 0, 0),
      (812,'regiTYPE', 'expr__eS-- =x04:  i:0x1F1040" . str_pad(dechex(FTI_REGI), 2, '0', STR_PAD_LEFT) . ",s:regiTYPE__eMB'    , 0, 0, 0),
      (813,'regiTITLE', 'expr__eS-- =x04: i:0x360080" . str_pad(dechex(FTI_REGI), 2, '0', STR_PAD_LEFT) . ",s:regiTITLE__eMB'    , 0, 0, 0),
      (814,'vineTYPE', 'expr__eS-- =x02:  i:0x1F1100" . str_pad(dechex(FTI_VINE), 2, '0', STR_PAD_LEFT) . ",s:vineTYPE__eMB'    , 0, 0, 0),
      (815,'vineTITLE', 'expr__eS-- =x02: i:0x3A0200" . str_pad(dechex(FTI_VINE), 2, '0', STR_PAD_LEFT) . ",s:vineTITLE__eMB'    , 0, 0, 0),
      (816,'exREGI_syn', 'expr__eS-- =x24: i:0x000000" . str_pad(dechex(FTI_REGI), 2, '0', STR_PAD_LEFT) . ",s:regi_syn'   , 0, 0, 0),
      (817,'exVINE_syn', 'expr__eS-- =x22: i:0x000000" . str_pad(dechex(FTI_VINE), 2, '0', STR_PAD_LEFT) . ",s:vine_syn'   , 0, 0, 0),
      (900,'syGroupGRP', 'expr__eC-- Country + Grape: 0x17000000', 0, 0, 0),
      (901,'syGroupRV', 'expr__eC-- Region and Vineyard: 0x00800000', 0, 0, 0),
      (902,'syGroupMA', 'expr__eC-- Mask for All = CG + RV: 0x00C00000', 0, 0, 0),
      (903,'syGroupMR', 'expr__eC-- Mask for Revers MA = ~(SY + MA): 0x003FFFFF', 0, 0, 0),
      (904,'syGroupAttrTitle', 'expr__eC-- titles not types (xxxxTITLE) - bit[29] must be 1: 0x20000000', 0, 0, 0),
      (905,'syGroupAT', 'expr__eC-- attributes terms AT: 0x02000000', 0, 0, 0),
      (906,'syGroupRT', 'expr__eC-- region terms RT: 0x04000000', 0, 0, 0),
      (907,'syGroupVT', 'expr__eC-- vineyard terms VT: 0x08000000', 0, 0, 0),
      (908,'syGroupWT', 'expr__eC-- wine: 0x01000000', 0, 0, 0),
      (909,'syGroupRP', 'expr__eC-- region parsed: 0x15000000', 0, 0, 0),
      (910,'syGroupVP', 'expr__eC-- vineyard parsed: 0x19000000', 0, 0, 0),
      (911,'syGroupMT', 'expr__eC-- main types (wine,vine,regi,tara,grap): 0xFF', 0, 0, 0),
      (912,'syGroupAttrType', 'expr__eC-- Attr tpPe: 0x00100000', 0, 0, 0),
      (913,'wiAttrColor', 'expr__eC-- wine attr color: 0x07', 0, 0, 0),
      (914,'wiAttrCo2', 'expr__eC-- wine attr co2: 0x38', 0, 0, 0),
      (1000,'match_new',        'vars__eC-- 0/old, 1/new                  : 0', 0, 0, 0),
      (1001,'match_dbg',        'vars__eC-- 0/off, 1/on                   : 0', 0, 0, 0),
      (1002,'match_scn',        'vars__eC-- scn(Ra/My)(NAM/GRAP/VINE/ALL) : scnRaGRAP', 0, 0, 0),
      (1003,'match_norma',      'vars__eC-- terms norma (1/ascend,0/off)  : 0', 0, 0, 0),
      (1004,'match_threshold',  'vars__eC-- auto matchign treshold (% to max) : 40', 0, 0, 0),
      (1005,'index_ver',        'vars__eC--                               : 5.94', 0, 0, 0),
      (1006,'version',          'vars__eC--                               : 5.4', 0, 0, 0),
      (1007,'update_limit',     'vars__eC--                               : 1000', 0, 0, 0),
      (1008,'update_max',       'vars__eC-- max numbe updates per matching: 10', 0, 0, 0),
      (1009,'update_all',       'vars__eC--                               : 0', 0, 0, 0),
      (1010,'update_dbg',       'vars__eC--                               : 0', 0, 0, 0),
      (1012,'debug_log',        'vars__eC-- 0/off, 1/on                   : 0', 0, 0, 0),
      (1013,'register_src',     'vars__eC-- L/local, F/federation         : L', 0, 0, 0),
      (1014,'register_phase',    'vars__eC-- 0:1a/2:2d-1         : 10', 0, 0, 0),
      (1100,'register_src__Fed',    'register_src__eC-- : F', 0, 0, 0),
      (1101,'register_src__Local',  'register_src__eC-- : L', 0, 0, 0),
      (1200,'gsNOTHING', 'grape_score__eC-- nothing to graping                    : 81', 0, 0, 0),
      (1201,'gsGRAPE', 'grape_score__eC-- test against paresed dinamic mix        : 82', 0, 0, 0),
      (1202,'gsMIX_NEW', 'grape_score__eC-- test against paresed dinamic mix      : 83', 0, 0, 0),
      (1203,'gsMIX_DINAMIC', 'grape_score__eC-- test against paresed dinamic mix  : 84', 0, 0, 0),
      (1204,'gsMIX_STORED', 'grape_score__eC-- test against paresed stored mix    : 85', 0, 0, 0),
      (1300,'word_form__eB',      'word__eC-- index type (0/1 - base/form): 1' , 0, 0, 0),
      (1301,'word_stop__eB',      'word__eC-- stoping type (0/1 - unstoped/stoped): 2' , 0, 0, 0),
      (1302,'word_punct__eB',      'word__eC-- punctuation class (0/1 - word/punct): 4' , 0, 0, 0),
      (1400,'fspBaseUnstWord', 'word__eMT-- form:stop:punct (BASE:UNSTOPED:WORD) - regular words: 0', 0, 0, 0),
      (1401,'fspFormUnstWord', 'word__eMT-- form:stop:punct (FORM:UNSTOPED:WORD) - regular synonyms: 1', 0, 0, 0),
      (1402,'fspBaseStopWord', 'word__eMT-- form:stop:punct (BASE:STOPED:WORD) - word articles like (the,la,..) conditional stoping: 2', 0, 0, 0),
      (1403,'fspFormStopWord', 'word__eMT-- form:stop:punct (FORM:STOPED:WORD) - uncoditional stop words: 3', 0, 0, 0),
      (1404,'fspBaseUnstPunct', 'word__eMT-- form:stop:punct (BASE:UNSTOPED:PUNCT) - unstoped separators: 4', 0, 0, 0),
      (1408,'fspBaseUnstDigit', 'word__eMT-- form:stop:punct (BASE:UNSTOPED:DIGIT) - unstoped digits: 8', 0, 0, 0),
      (1409,'fspFormUnstSyn', 'word__eMT-- form:stop:punct (FORM:UNSTOPED:SYNonym) - excluded autosynonyms 9=8+1 - join with fspFormUnstWord: 9', 0, 0, 0),
      (1410,'fspFormExtAType', 'word__eMT-- form:stop:punct (FORM:EXTEND:AttrType) - excluded autosynonyms 25=9+16 - join with fspFormUnstSyn: 25', 0, 0, 0),
      (1411,'fspFormUnstNumb', 'word__eMT-- form:stop:punct (FORM:EXTEND:AttrType) - excluded autosynonyms 41=9+32 - join with fspFormUnstSyn: 41', 0, 0, 0),
      (1600,'wiCOL__eMB', 'wi__eF-- wine colors: 0x0000000F', 0, 0, 0),
      (1601,'wiCO2__eMB', 'wi__eF-- wine co2: 0x000000F0', 0, 0, 0),
      (1602,'wiDRY__eMB', 'wi__eF-- wine dryness type: 0x0000FF00', 0, 0, 0),
      (1605,'wiNT__eMB', 'wi__eF-- wine name template: 0xFFFFFFFF', 0, 0, 0),
      (160501,'wiNT_COL__eB', 'wiNT__eMB-- colors: 0x00000001', 0, 0, 0),
      (160502,'wiNT_CO2__eB', 'wiNT__eMB-- co2: 0x00000002', 0, 0, 0),
      (160503,'wiNT_DRY__eB', 'wiNT__eMB-- dryness: 0x00000004', 0, 0, 0),
      (160504,'wiNT_WINE__eB', 'wiNT__eMB-- wine: 0x00000010', 0, 0, 0),
      (160505,'wiNT_HWINE__eB', 'wiNT__eMB-- hierachy wine (including tags): 0x00000030', 0, 0, 0),
      (160506,'wiNT_CRU__eB', 'wiNT__eMB-- crudus 1-st 64 bist: 0x00000050', 0, 0, 0),
      (160507,'wiNT_VINE__eB', 'wiNT__eMB-- vineyard: 0x00000100', 0, 0, 0),
      (160508,'wiNT_HVINE__eB', 'wiNT__eMB-- hierachy vineyard: 0x00000300', 0, 0, 0),
      (160509,'wiNT_TVINE1__eB', 'wiNT__eMB-- title vineyard 1-st 64 bist: 0x00000500', 0, 0, 0),
      (160510,'wiNT_TVINE2__eB', 'wiNT__eMB-- title vineyard 2-nd 64 bits: 0x00000900', 0, 0, 0),
      (160511,'wiNT_REGI__eB', 'wiNT__eMB-- region: 0x00001000', 0, 0, 0),
      (160512,'wiNT_HREGI__eB', 'wiNT__eMB-- hierachy region: 0x00003000', 0, 0, 0),
      (160513,'wiNT_TREGI__eB', 'wiNT__eMB-- title region: 0x00005000', 0, 0, 0),
      (160514,'wiNT_GRAP__eB', 'wiNT__eMB-- grape: 0x00010000', 0, 0, 0),
      (160515,'wiNT_HGRAP__eB', 'wiNT__eMB-- hierachy grape: 0x00030000', 0, 0, 0),
      (160516,'wiNT_TARA__eB', 'wiNT__eMB-- country: 0x00100000', 0, 0, 0),
      (1701,'wineTYPE__eMB', 'attr__eS-- wi__eF = wine type - color/co2/dryness: s:wineTYPE__eMB,s:WINE', 0, 0, 0),
      (1702,'wineTITLE__eMB', 'attr__eS-- wi__eF = wine title - cru/reserve: s:wineTITLE__eMB,s:WINE', 0, 0, 0),
      (1703,'wineTRIG__eMB', 'attr__eS-- wi__eF = wine trigger - prosecco,brut: s:wineTRIG__eMB,s:WINE', 0, 0, 0),
      (1704,'wineTRIGS__eMB', 'attr__eS-- wi__eF = wine trigger settings - prosecco:spark/wite: s:wineTRIGS__eMB,s:WINE', 0, 0, 0),
      (1705,'vineTYPE__eMB', 'attr__eS-- vy__eF = physical/juridical person type : s:vineTYPE__eMB,s:VINE', 0, 0, 0),
      (1706,'vineTITLE__eMB', 'attr__eS-- vy__eF = vine title - saint/prop/acad : s:vineTITLE__eMB,s:VINE', 0, 0, 0),
      (1707,'regiTITLE__eMB', 'attr__eS-- reg__eF = region title - typical/reserve/saint : s:regiTITLE__eMB,s:REGI', 0, 0, 0),
      (1708,'regiTYPE__eMB', 'attr__eS-- reg__eF = region type - aoc/pgi/tara/valley : s:regiTYPE__eMB,s:REGI', 0, 0, 0),
      (1901,'link_sts_bad__eB', 'link__eMI-- status undefined: 1', 0, 0, 0),
      (1902,'link_sts_child__eB', 'link__eMI-- status child: 2', 0, 0, 0),
      (1903,'link_sts_parent__eB', 'link__eMI-- status parent: 4', 0, 0, 0),
      (1904,'link_sts_span__eB', 'link__eMI-- status span: 8', 0, 0, 0),
      (1905,'link_sts_old__eB', 'link__eMI-- status old: 0x10', 0, 0, 0),
      (1906,'link_sts_doubt__eB', 'link__eMI-- status doubts from parsedwine.synonyms: 0x20', 0, 0, 0),
      (1907,'link_sts_wine__eB', 'link__eMI-- hierarchy used for wines: 0x40', 0, 0, 0),
      (1908,'link_sts_jur__eB', 'link__eMI-- hierarchy jurudic - politic: 0x80', 0, 0, 0),
      (1909,'link_sts_geo__eB', 'link__eMI-- hierarchy geographic: 0x100', 0, 0, 0),
      (1910,'link_sts_app__eB', 'link__eMI-- hierarchy appellation: 0x200', 0, 0, 0),
      (1911,'link_has_rule__eB', 'link__eMI-- has omonym rule: 0x400', 0, 0, 0),
      (1912,'link_has_dups__eB', 'link__eMI-- has omonym duplicate: 0x800', 0, 0, 0),
      (1913,'link_has_syn__eB', 'link__eMI-- has synonym term: 0x1000', 0, 0, 0),
      (1914,'link_has_gustos__eB', 'link__eMI-- is synonym from gustos: 0x2000', 0, 0, 0),
      (1915,'link_has_parsed__eB', 'link__eMI-- is synonym from parsedwine: 0x4000', 0, 0, 0),
      (1916,'link_has_extern__eB', 'link__eMI-- is synonym from extern src: 0x8000', 0, 0, 0),
      (1917,'link_lvl_continent__eB', 'link__eMI-- level continent: 0x00010000', 0, 0, 0),
      (1918,'link_lvl_tara__eB', 'link__eMI-- level tara: 0x00020000', 0, 0, 0),
      (1919,'link_lvl_regi__eB', 'link__eMI-- level region: 0x00040000', 0, 0, 0),
      (1920,'link_lvl_local__eB', 'link__eMI-- level localitatea: 0x00080000', 0, 0, 0),
      (1921,'link_lvl_house__eB', 'link__eMI-- level house - vineyard: 0x00100000', 0, 0, 0),
      (1922,'link_lvl_brand__eB', 'link__eMI-- level brand: 0x00200000', 0, 0, 0),
      (1923,'link_lvl_wine__eB', 'link__eMI-- level wine line: 0x00400000', 0, 0, 0),
      (1924,'link_lvl_vine__eB', 'link__eMI-- level vineyard - wine: 0x00800000', 0, 0, 0),
      (2001,'exREGI_exTARA_exTARA', 'rule__eN-- rule for regions when detected TARA check key TARA: 1', 0, 0, 0),
      (2002,'exREGI_exREGI_exTARA', 'rule__eN-- rule for regions when detected REGI -- // --: 2', 0, 0, 0),
      (2003,'exREGI_regiTITLE_exTARA', 'rule__eN-- rule for regions when detected regiTITLE -- // --: 3', 0, 0, 0),
      (2004,'exREGI_exREGI_exTARA_dups', 'rule__eN-- rule for regions duplicates: 4', 0, 0, 0),
      (2101,'countries', 'column__eN-- field for rule rulREGI_TARA: 1', 0, 0, 0),
      (2201,'attr_1', 'attr__eB-- white -> wine color tid : 1170', 0, 0, 0),
      (2202,'attr_2', 'attr__eB-- red -> wine color tid : 1169', 0, 0, 0),
      (2203,'attr_4', 'attr__eB-- rose -> wine color tid : 1171', 0, 0, 0),
      (2301,'attr_8', 'attr__eB-- still -> wine co2 tid : 1358', 0, 0, 0),
      (2302,'attr_10', 'attr__eB-- pearl -> wine co2 tid : 1359', 0, 0, 0),
      (2303,'attr_20', 'attr__eB-- sparkling -> wine co2 tid : 1360', 0, 0, 0),
      (2401,'attr_6', 'attr__eMT-- red+rose -> rose tid : 1171', 0, 0, 0),
      (2402,'attr_3', 'attr__eMT-- red+white -> white tid : 1170', 0, 0, 0),
      (2403,'attr_5', 'attr__eMT-- rose+white -> rose tid : 1171', 0, 0, 0),
      (2404,'attr_7', 'attr__eMT-- red+rose+white -> rose tid : 1171', 0, 0, 0),
      (2405,'attr_18', 'attr__eMT-- still+perl -> pearl tid : 1359', 0, 0, 0),
      (2406,'attr_28', 'attr__eMT-- still+spark -> sparkling tid : 1360', 0, 0, 0),
      (2407,'attr_30', 'attr__eMT-- pearl+spark -> pearl tid : 1359', 0, 0, 0),
      (2408,'attr_38', 'attr__eMT-- still+pearl+spark -> pearl tid : 1359', 0, 0, 0),
      (2501,'attr_white', 'attr__eNV-- white wine color var : attr_1', 0, 0, 0),
      (2502,'attr_red', 'attr__eNV-- red wine color var : attr_2', 0, 0, 0),
      (2503,'attr_rose', 'attr__eNV-- rose wine color var : attr_4', 0, 0, 0),
      (2601,'attr_still', 'attr__eNV-- still wine var : attr_8', 0, 0, 0),
      (2602,'attr_pearl', 'attr__eNV-- pearl wine var : attr_10', 0, 0, 0),
      (2603,'attr_sparkling', 'attr__eNV-- sparkling wine var : attr_20', 0, 0, 0),
      (9901,'FTI_SEP_PATH_PARENT', 'FTI_SEP__dsP-- path like (child<parent): =" . FTI_SEP_PATH_PARENT . "', 0, 0, 0),
      (9902,'FTI_SEP_PATH_CHILD', 'FTI_SEP__dsP-- path like (parent>child): =" . FTI_SEP_PATH_CHILD . "', 0, 0, 0),
      (9902,'FTI_SEP_PATH_SPAN', 'FTI_SEP__dsP-- path span like (region_1><region_2): =" . FTI_SEP_PATH_SPAN . "', 0, 0, 0),
      (9903,'FTI_SEP_ATTR', 'FTI_SEP__dsP-- path target attributes start: =" . FTI_SEP_ATTR . "', 0, 0, 0),
      (9904,'FTI_SEP_SPAN', 'FTI_SEP__dsP-- in field Multiparrent_possible of __exDB span designations like (span_1 , span_2 , ...): =" . FTI_SEP_SPAN . "', 0, 0, 0),
      (9905,'FTI_SEP_ALT', 'FTI_SEP__dsP-- in region designstions alternatives or synonyms chine (syn_1 / syn_2 / ...): =" . FTI_SEP_ALT . "', 0, 0, 0),
      (9906,'FTI_SEP_VAL', 'FTI_SEP__dsP-- this set value sep in this field (if type is *__dsP like the value begin after sign(=)): =:= ', 0, 0, 0),
      (9907,'FTI_SEP_COMM', 'FTI_SEP__dsP-- in this filed comment start folowed by value after FTI_SEP_VAL: =" . FTI_SEP_COMM . "', 0, 0, 0),
      (9908,'FTI_SEP_TYPE', 'FTI_SEP__dsP-- type designation begin folowed by regexp(/\\w+/, ...) as designation of type: =" . FTI_SEP_TYPE . "', 0, 0, 0),
      (9909,'FTI_SEP_HIE', 'FTI_SEP__dsP-- hierarchy next level begin: =" . FTI_SEP_HIE . "', 0, 0, 0)
";

$fti_sq['init_attr'] = // important for wineTRIG 1-st term? if it consist more then 2 words then it mast be presented as its inverse words seq, example for wineTYPE(extra brut) wineTRIG(brut extra) 
"SELECT 0 as arS, '' as attr__dsP, '' as attr__dsPG
union values
      (1, 'wineTITLE__eMB', 'white'),
      (2, 'wineTITLE__eMB', 'red'),
      (3, 'wineTITLE__eMB', 'rose'),
      (4, 'wineTITLE__eMB', 'still/wine/still wine'),
      (5, 'wineTITLE__eMB', 'pearl/pearl wine'),
      (6, 'wineTITLE__eMB', 'sparkling/wine sparkling'),
      (7, 'wineTITLE__eMB', 'champagne,cava,charmat/Long Charmat/lc,methode typical/methode classic,methode champenoise,petnat/pet nat'),
      (8, 'wineTITLE__eMB', 'frizzante,Semi Sparkling/lightly sparkling,pink,blush/oeil perdrix'),
      (9, 'wineTITLE__eMB', 'extra,strong,semi,blend/znamkove,generosos,gri,blanc noir,blanck blanck,black,ruby,modra,vermelha,rouge'),
      (10, 'wineTITLE__eMB', 'na/non alc,old,new,dry,privilege/super,asda,erstes gewachs,first/first growth,vieilles vignes/Alte Reben'),
      (11, 'wineTITLE__eMB', 'grape,platinum,gold,silver,Quality,anniversary,terrios,signature,hochgewachs,vsop'),
      (12, 'wineTITLE__eMB', 'private,classic,series,sol negru,lichior,pastoral'),
      (13, 'wineTITLE__eMB', 'taste,generic,magnum,vignerons/vita vie,white label,black label,red label,rose label,orange label/label'),
      (14, 'wineTYPE__eMB', 'brut,extra brut,nature brut,extra dry,semidry/semi dry/d dry/d sec/ds/s dry,semisweet/d sweet/s sweet/dd/semi sweet,sweet,qvevri'),
      (15, 'wineTYPE__eMB', 'cuvee,premier,grand,cru,roble,crianza,reserve/dac reserve,tafelwein,zandwein,vintage,harvest,select grape,wine aroma/aromatic'),
      (16, 'wineTYPE__eMB', 'vinifera,residual sugar,bio/bio wine/bio bio,skin/skin fermented,edition/limited edition,select/c select,collection/col,limited'),
      (17, 'wineTYPE__eMB', 'off dry,late harvest/lh/Vendanges Tardives,kabinett,ice/ice wine,fermented,fermented barrique/barrique/Barriccato,fermented wild,wild,mild'),
      (18, 'wineTYPE__eMB', 'sugar,sur lie/s lie,botrytis/botrytised/výběr z cibéb,Passito/appassimento,výběr z hroznů/výběr hroznů,výběr z bobulí,slámové víno'),
      (19, 'wineTYPE__eMB', 'special/original,nv/non vintage/vdt/vin de table/vdm/vin de masa/ordinary,royal/elite'),
      (20, 'wineTRIG__eMB', 'prosecco/proseco pdo/asolo prosecco:sparkling/white'),
      (21, 'wineTRIG__eMB', 'champagne/cava/crisecco/aprisecco/brut/extra brut/nature brut/charmat/methode typical/methode champenoise/pet nat:sparkling'),
      (22, 'wineTRIG__eMB', 'black/ruby/modra/vermelha/rouge:red,gri/blanc noir/blanck blanck:white,lichior/pastoral:sweet/wine'),
      (23, 'wineTRIG__eMB', 'Semi Sparkling/lightly sparkling/frizzante:pearl,pink/oeil perdrix/blush:rose'),
      (24, 'vineTYPE__eMB', 'scav/Sociedade Agrícola/Sociedade Vinícola/Adraga Explorações Vitivinicolas/Explorações Vitivinicolas/Sociedade Unipessoal/azienda agr/az agr/az ag/az vit/av/Azienda vignerons/az vignerons/scv/sa cv'),
      (25, 'vineTYPE__eMB', 'srl/srl limited/wine limited/wine food,co/wine co,town,village,group,bio/bio wine'),
      (26, 'vineTYPE__eMB', 'joint,stock,ac/Anecoop Coop/Cooperativa Vinícola,uc/Union Producteurs,brothers/brothers wine'),
      (27, 'vineTYPE__eMB', 'station,agricola/ag,social,society,etno,farm,cooper/co operative/co op,kft/vin kft/bor kft,cave,scout cellar'),
      (28, 'vineTYPE__eMB', 'castello,house,domaine/Family Wines,vineyard/food vineyard/food wine/food beverage/food market/wine market/winemarket/wine house/wine station,family,distillery,spirits'),
      (29, 'vineTITLE__eMB', 'wine,unipessoal,comercial,liability,academia,premier,grand,cru,limited,vignerons,saint,rare,vintage,reserve,Quality,super,graf,don'),
      (30, 'regiTITLE__eMB', 'vignerons,academia,typical,reserve,saint,super,grand'),
      (31, 'regiTYPE__eMB', 'designation,original,vp/vin pays,zemské víno,vt/Vino de la tierra,protected,geographical,guaranteed,vinho doc'),
      (32, 'regiTYPE__eMB', 'controlled,indication,qba/Qualitätswein bestimmter Anbaugebiete'),
      (33, 'regiTYPE__eMB', 'pgi/Protected Geographical Indication/Vin Mousseux Qualité'),
      (34, 'regiTYPE__eMB', 'sn/state name,nws/ns wine standart,na/non/No Appellation/Not Applicable'),
      (35, 'regiTYPE__eMB', 'regione,district,county,subr/sub regione,wr/wine region'),
      (36, 'regiTYPE__eMB', 'ava,pdo/Protected Designation of Origin/special designation,qwpsr,vdqs,aovdqs')
";
// regiTYP => valley,
// ATTENTION!!! wineTITLE is full set of 63 bits! last bit.#64 can't be used as bad php integer model

$fti_sq['select_type__arP'] =
  "SELECT
      row_number() over (order by t1.level) - 1 as arP, t1.dsP,
      t1.level % 100 as `level`,
      t1.description,
      if(instr(t1.description, '0x') > 0, conv(substr(t1.description, instr(t1.description, '0x')+2) , 16, 10),
        if(instr(t1.description, ': ') > 0, replace(substring_index(t1.description, ': ', -1), '=', ''), t1.level % 100)
      ) as val
    from (" . $fti_sq['init'] . ") t1
    order by arP
";
$fti_sq['init__arP'] =
  "INSERT into nfc__arP (arP)
    select t1.arP
    from (" . $fti_sq['select_type__arP'] . ") t1
      left join nfc__arP as t2 on t2.arP = t1.arP
    where t2.arP is null
    order by t1.arP
";
$fti_sq['init_type__arP'] =
  "INSERT into nfc_type__arP
    " . $fti_sq['select_type__arP'] . "
";

function nfc_drop_tables($drop_log = false) {
  global $fti_tables;
  nfc_drop_objects();
  nfc_drop_indexes();
  $pref1 = '\\\\b' . FTI_PREFIX;
  $rows = db_query(
    "SELECT TABLE_NAME as `name`
      from information_schema.TABLES
      where 1=1
        and TABLE_SCHEMA = 'parsedwine'
        and TABLE_NAME regexp '$pref1'
        and TABLE_TYPE = 'BASE TABLE'
        and TABLE_NAME not regexp 'LOG'
  ")->fetchAll(PDO::FETCH_ASSOC);
  try {
    db_query("SET FOREIGN_KEY_CHECKS=0");
    foreach($rows as $row) {
      db_query("DROP TABLE IF EXISTS " . $row['name']);  
    }
    db_query("SET FOREIGN_KEY_CHECKS=1");
  } catch (Exception $e) {
    echo "\ntable => " . $row['name'];
    throw $e;
  }
}

function nfc_drop_by_prefix() {
  $pref1 = '\\\\b' . FTI_PREFIX;
  $pref2 = '\\\\bnames_fti_';
  $pref3 = '__as';
  $exclude1 = '_log|_score';
  db_query("SET FOREIGN_KEY_CHECKS=0");
  $rows = db_query(
    "SELECT TABLE_NAME as `name`
      from information_schema.TABLES
      where 1=1
        and TABLE_SCHEMA = 'parsedwine'
        and (TABLE_NAME regexp '$pref1' or TABLE_NAME regexp '$pref2')
        and TABLE_TYPE = 'BASE TABLE'
        and TABLE_NAME not regexp '$exclude1'
  ")->fetchAll(PDO::FETCH_ASSOC);
  $i = 0;
  foreach ($rows as $row) {
    $i++;
    db_query("DROP TABLE " . $row['name']);
  }
  echo "\nNumber of tables deleted: $i\n";
  $sql =
    "SELECT ROUTINE_NAME as `name`, ROUTINE_TYPE
      from information_schema.ROUTINES
      where 1=1
        and ROUTINE_SCHEMA = 'parsedwine'
        and ROUTINE_NAME regexp '$pref3'
  ";
  //echo "\n$sql";
  $rows = db_query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $i = 0;
  foreach ($rows as $row) {
    extract($row);
    $i++;
    db_query("DROP $ROUTINE_TYPE $name");
  }
  echo "\nNumber of routine deleted: $i\n";
  $rows = db_query(
    "SELECT TABLE_NAME as `name`
      from information_schema.VIEWS
      where 1=1
        and TABLE_SCHEMA = 'parsedwine'
        and TABLE_NAME regexp '$pref3'
  ")->fetchAll(PDO::FETCH_ASSOC);
  $i = 0;
  foreach ($rows as $row) {
    $i++;
    db_query("DROP VIEW " . $row['name']);
  }
  echo "\nNumber of views deleted: $i\n";
  $rows = db_query(
    "SELECT TRIGGER_NAME as `name`
      from information_schema.TRIGGERS
      where 1=1
        and TRIGGER_SCHEMA = 'parsedwine'
        and TRIGGER_NAME regexp '$pref3'
  ")->fetchAll(PDO::FETCH_ASSOC);
  $i = 0;
  foreach ($rows as $row) {
    $i++;
    db_query("DROP TRIGGER " . $row['name']);
  }
  echo "\nNumber of triggers deleted: $i\n";
  db_query("SET FOREIGN_KEY_CHECKS=1");

}

function nfc_create_tables() {
  nfc_drop_by_prefix();

  db_query("CREATE table if not exists nfc__arP (
      arP int unsigned primary key not null
    )
  ");

  db_query("CREATE table if not exists nfc__acPU (
      child__arP int unsigned not null, 
      parrent__arP int unsigned not null,
      constraint primary key (parrent__arP,child__arP)
    )
  ");

  db_query("CREATE table if not exists nfc__acPU_wine (
      child__arP int unsigned not null, 
      parrent__arP int unsigned not null, 
      constraint primary key (parrent__arP,child__arP)
    )
  ");

  db_query("CREATE table if not exists nfc_type__arP (
      arP int unsigned primary key not null, 
      dsP varchar(256) collate utf8mb4_general_ci not null,
      `level` integer default -1 not null,
      `description` varchar(1024) collate utf8mb4_general_ci,
      val varchar(256)
    )
  ");

  db_query("CREATE table if not exists nfc_type_segments__arPD (
      segment__arP int unsigned primary key not null,
      seg_next int unsigned not null,
      seg_mask int unsigned not null,
      seg_start int unsigned not null
    )
  ");

  db_query("CREATE table if not exists nfc_word__arP (
      arP int unsigned primary key not null,
      dsP varchar(256) NOT NULL,
      word__eMT tinyint unsigned default 0 not null,
      cnt integer default 1 not null,
      len integer default 0 not null,
      next__form integer default 1 not null
    )  DEFAULT CHARSET=utf8mb4
  ");

  db_query("CREATE table if not exists nfc_word__acPG_lang (
      arP int unsigned primary key not null,
      lang__dsP varchar(512) DEFAULT NULL,
      type__arP int unsigned default 0 not null
    )  DEFAULT CHARSET=utf8mb4
  ");

  db_query("CREATE table if not exists nfc_word__arS_group (
      arS int unsigned AUTO_INCREMENT primary key not null,
      word__eDS  enum('fspBaseUnstWord', 'fspFormUnstWord', 'fspBaseStopWord', 'fspFormStopWord', 'fspBaseUnstPunct', 'fspBaseUnstDigit', 'fspFormUnstSyn', 'fspFormExtAType', 'fspFormUnstNumb') default 'fspFormUnstWord',
      base__dsP varchar(256) not null default '',
      base__arP int unsigned default null null,
      UNIQUE KEY nfc_word__arS_group_UK_base__dsP(base__dsP)
    )
  ");

  db_query("CREATE table if not exists nfc_word__acSG_group (
      acSG int unsigned AUTO_INCREMENT primary key not null,
      base__dsP varchar(256) not null,
      form__dsP varchar(256) not null,
      form__arP int unsigned null,
      orig__arP int unsigned null
    )
  ");

  db_query("CREATE table if not exists nfc_term__arP (
      arP int unsigned primary key not null,
      expr__eS int unsigned default 0 not null,
      state__eMI int unsigned null,
      cnt integer default 1 not null,
      len integer default 0 not null,
      next__id integer default 0 not null,
      dsP varchar (120) NOT NULL,
      rang integer null
    )
  ");

$FTI_WINE = FTI_WINE;
$FTI_VINE = FTI_VINE;
$FTI_REGI =  FTI_REGI;
$FTI_GRAP =  FTI_GRAP;
$FTI_TARA =  FTI_TARA;
$FTI_ALL =  FTI_ALL;

  db_query("CREATE table if not exists nfc_term__arPD_exclude_log (
      term__dsP varchar(512) primary key not null default '',
      term__arP int unsigned null,
      expr__eDS ENUM ('exALL-$FTI_ALL', 'exWINE-$FTI_WINE', 'exVINE-$FTI_VINE', 'exREGI-$FTI_REGI', 'exGRAP-$FTI_GRAP', 'exTARA-$FTI_TARA') default 'exALL-$FTI_ALL',
      expr__eN tinyint unsigned as (substring_index(expr__eDS, '-', -1)),
      UNIQUE KEY nfc_term__arPD_exclude_UK_term__arP(term__arP)
    )
  ");

  db_query(
    "CREATE table if not exists nfc_src_regions (
      id int not null auto_increment primary key,
      src varchar(256) null,
      country__tid int null,
      cur_name varchar (256) null,
      cur_path varchar(1024) null,
      regi__id int,
      term__arP int,
      src_path varchar(1024) null,
      to_name varchar(256),
      to_path varchar(256),
      to_path__id int
    )
  ");

  db_query("CREATE table if not exists nfc_expr_attr__arSD (
      arSD SMALLINT unsigned NOT NULL PRIMARY KEY,
      attr__eSI int unsigned not null default 0,
      attr__eMB bigint unsigned not null default 0,
      expr__arP int unsigned not null default 0,
      UNIQUE KEY nfc_expr_attr__arSD_UK_expr__arP(expr__arP),
      UNIQUE KEY nfc_expr_attr__arSD_UK_attr__eMB(attr__eSI,attr__eMB)
    )
  ");

  db_query("CREATE table if not exists nfc_expr_attr__arS (
      arS SMALLINT unsigned primary key not null AUTO_INCREMENT,
      REGI__arSD SMALLINT unsigned default 0 not null,
      VINE__arSD SMALLINT unsigned default 0 not null,
      WINE__arSD SMALLINT unsigned default 0 not null
    )
  ");

  db_query("CREATE table if not exists nfc_term__acPU_word (
      term__arP int unsigned not null,
      el__id tinyint default 0 not null,
      word__arP int unsigned not null,
      constraint primary key (term__arP,el__id)
    )
  ");

  db_query("CREATE TABLE if not exists nfc_expr__arP (
      arP int(10) unsigned NOT NULL,
      expr__eS int(10) unsigned NOT NULL DEFAULT 0,
      expr__eMI int(10) unsigned NOT NULL DEFAULT 0,
      parExpr__arP int(10) unsigned NOT NULL DEFAULT 0,
      chiTerm__arP int(10) unsigned NOT NULL,
      id int(10) unsigned NOT NULL,
      next__id tinyint(4) NOT NULL DEFAULT 0,
      new__id tinyint(4) NOT NULL DEFAULT 0 COMMENT '1-st el__id for new terms in ..acPU_term generated during search_terms(). Zero for no new terms',
      word__cnt tinyint(4) NOT NULL DEFAULT 0,
      char__cnt smallint(6) NOT NULL DEFAULT 0,
      syn__cnt tinyint(3) unsigned NOT NULL DEFAULT 0,
      countries varbinary(2048) NOT NULL DEFAULT '',
      attrTYPE__arS smallint(5) unsigned DEFAULT NULL,
      attrTITLE__arS smallint(5) unsigned DEFAULT NULL,
      PRIMARY KEY (arP),
      UNIQUE KEY nfc_expr__arP_UK_id (expr__eS,id),
      KEY nfc_expr__arP_FK_parExpr__arP (parExpr__arP),
      KEY nfc_expr__arP_FK_chiTerm__arP (chiTerm__arP),
      KEY nfc_expr__arP_FK_attrTYPE__arS (attrTYPE__arS),
      KEY nfc_expr__arP_FK_attrTITLE__arS (attrTITLE__arS),
      KEY nfc_expr__arP_FK_arP (arP),
      KEY nfc_expr__arP_XK_expr__eS (expr__eS),
      CONSTRAINT nfc_expr__arP_FK_arP FOREIGN KEY (arP) REFERENCES nfc__arP (arP) ON DELETE CASCADE ON UPDATE CASCADE,
      CONSTRAINT nfc_expr__arP_FK_attrTITLE__arS FOREIGN KEY (attrTITLE__arS) REFERENCES nfc_expr_attr__arS (arS) ON DELETE CASCADE ON UPDATE CASCADE,
      CONSTRAINT nfc_expr__arP_FK_attrTYPE__arS FOREIGN KEY (attrTYPE__arS) REFERENCES nfc_expr_attr__arS (arS) ON DELETE CASCADE ON UPDATE CASCADE,
      CONSTRAINT nfc_expr__arP_FK_chiTerm__arP FOREIGN KEY (chiTerm__arP) REFERENCES nfc__arP (arP) ON DELETE CASCADE ON UPDATE CASCADE,
      CONSTRAINT nfc_expr__arP_FK_parExpr__arP FOREIGN KEY (parExpr__arP) REFERENCES nfc__arP (arP) ON DELETE CASCADE ON UPDATE CASCADE
    )
  ");

  db_query("CREATE table if not exists nfc_expr__acPU_term (
      expr__arP int unsigned not null,
      el__id tinyint default 0 not null, 
      term__arP int unsigned not null,
      constraint primary key (expr__arP,el__id),
      unique key nfc_expr__acPU_term_UK_term__arP(expr__arP, term__arP),
      key nfc_expr__acPU_term_XK_el__id(el__id)
    )
  ");

  db_query("CREATE table if not exists nfc_expr__acPG_term (
      expr__arP int unsigned not null,
      term__arP int unsigned not null,
      link__eMI int unsigned default 0 not null,
      primary key (expr__arP, term__arP, link__eMI)
    )
  ");

  db_query("CREATE table if not exists nfc_rule__acSG_term_expr (
      acSG int unsigned PRIMARY KEY not null AUTO_INCREMENT,
      rule__arS int unsigned NOT NULL,
      whenTerm__arP int unsigned default 0 not null
        COMMENT 'term (when) rule trigger',
      keyExpr__arP int unsigned default 0 not null
        COMMENT 'expr (key) rule trigger'
    )
  ");

  db_query("CREATE table if not exists nfc_rs_regi_syn__arPD (
      syn__id int unsigned primary key not null,
      syn_regi__id int unsigned not null,
      syn_regi__dsP varbinary(1024) default '' not null,
      term__dsP varbinary(1024) default '' not null,
      term__arP int unsigned null,
      key nfc_rs_regi_syn__arPD_XK_syn_regi__id(syn_regi__id),
      key nfc_rs_regi_syn__arPD_XK_syn_regi__dsP(syn_regi__dsP),      
      key nfc_rs_regi_syn__arPD_XK_term__dsP(term__dsP),
      key nfc_rs_regi_syn__arPD_XK_term__arP(term__arP)
    )
  ");

  db_query("CREATE table if not exists nfc_rs_regi_syn__arPD_link (
      link__id int unsigned primary key not null,
      syn__id int unsigned null,
      key nfc_rs_regi_syn__arPD_om_XK_link__id(link__id),
      key nfc_rs_regi_syn__arPD_om_FK_syn__id(syn__id),
      CONSTRAINT nfc_rs_regi_syn__arPD_om_FK_syn__id FOREIGN KEY (syn__id)
        REFERENCES nfc_rs_regi_syn__arPD (syn__id) ON DELETE CASCADE ON UPDATE CASCADE
    )
  ");

  db_query("CREATE table if not exists nfc_rs_regi_rule__arPD (
      rule_id int unsigned primary key not null,
      syn__id int unsigned not null,
      syn_term__sym varchar(1024) default '',
      syn_regi__match tinyint unsigned default 0,
      rule_regi__id int unsigned,
      rule_regi__match tinyint unsigned default 0,
      key nfc_rs_regi_rule__arPD_XK_rule_regi__id(rule_regi__id),
      key nfc_rs_regi_rule__arPD_FK_syn__id(syn__id),
      key nfc_rs_regi_rule__arPD_XK_syn_regi__match(syn_regi__match),
      key nfc_rs_regi_rule__arPD_XK_rule_regi__match(rule_regi__match),
      CONSTRAINT nfc_rs_regi_rule__arPD_FK_syn__id FOREIGN KEY (syn__id)
        REFERENCES nfc_rs_regi_syn__arPD (syn__id) ON DELETE CASCADE ON UPDATE CASCADE
    )
  ");

  db_query("CREATE table if not exists nfc_rs_vine_syn__arPD (
      syn__id int unsigned primary key not null,
      syn_vine__id int unsigned not null,
      syn_vine__dsP varbinary(1024) default '' not null,
      term__dsP varbinary(1024) default '' not null,
      term__arP int unsigned null,
      key nfc_rs_vine_syn__arPD_XK_syn_vine__id(syn_vine__id),
      key nfc_rs_vine_syn__arPD_XK_syn_vine__dsP(syn_vine__dsP),      
      key nfc_rs_vine_syn__arPD_XK_term__dsP(term__dsP),
      key nfc_rs_vine_syn__arPD_XK_term__arP(term__arP)
    )
  ");

  db_query("CREATE table if not exists nfc_rs_vine_syn__arPD_link (
      link__id int unsigned primary key not null,
      syn__id int unsigned null,
      key nfc_rs_vine_syn__arPD_om_XK_link__id(link__id),
      key nfc_rs_vine_syn__arPD_om_FK_syn__id(syn__id),
      CONSTRAINT nfc_rs_vine_syn__arPD_om_FK_syn__id FOREIGN KEY (syn__id)
        REFERENCES nfc_rs_vine_syn__arPD (syn__id) ON DELETE CASCADE ON UPDATE CASCADE
    )
  ");

  db_query("CREATE table if not exists nfc_rs_vine_rule__arPD (
      rule_id int unsigned primary key not null,
      syn__id int unsigned not null,
      syn_term__sym varchar(1024) default '',
      syn_vine__match tinyint unsigned default 0,
      rule_vine__id int unsigned,
      rule_vine__match tinyint unsigned default 0,
      key nfc_rs_vine_rule__arPD_XK_rule_vine__id(rule_vine__id),
      key nfc_rs_vine_rule__arPD_FK_syn__id(syn__id),
      key nfc_rs_vine_rule__arPD_XK_syn_vine__match(syn_vine__match),
      key nfc_rs_vine_rule__arPD_XK_rule_vine__match(rule_vine__match),
      CONSTRAINT nfc_rs_vine_rule__arPD_FK_syn__id FOREIGN KEY (syn__id)
        REFERENCES nfc_rs_vine_syn__arPD (syn__id) ON DELETE CASCADE ON UPDATE CASCADE
    )
  ");

  db_query("CREATE table if not exists nfc_expr_vine__arPD (
      vine__arP int unsigned primary key not null,
      countries varbinary(1024),
      wines__cnt int unsigned not null
    )
  ");

  db_query("CREATE table if not exists nfc_expr_vine__arPD_link (
      link__id int unsigned not null,
      countries varbinary(1024),
      vine__id int unsigned not null,
      PRIMARY KEY (link__id),
      KEY nfc_expr_vine__arPD_link_FK_link__id (link__id),
      KEY nfc_expr_vine__arPD_link_FK_vine__id (vine__id)
    )
  ");

  db_query("CREATE table if not exists nfc_expr_vine__arPD_om (
      om__id int unsigned not null,
      vine__id int unsigned not null,
      PRIMARY KEY (om__id),
      KEY nfc_expr_vine__arPD_om_FK_om__id (om__id),
      KEY nfc_expr_vine__arPD_om_FK_vine__id (vine__id)
    )
  ");

  db_query("CREATE table if not exists nfc_expr_vine__arPD_dups (
      dups__id int unsigned not null,
      dups__lvl tinyint not null default 0,
      vine__id int unsigned not null,
      PRIMARY KEY (dups__id),
      KEY nfc_expr_vine__arPD_dups_FK_dups__id (dups__id),
      KEY nfc_expr_vine__arPD_dups_XK_dups__lvl (dups__lvl),
      KEY nfc_expr_vine__arPD_dups_FK_vine__id (vine__id)
    )
  ");

  db_query("CREATE table if not exists nfc_expr_regi__arPD_link (
      link__id int unsigned primary key not null,
      regi__id int unsigned not null
    )
  ");

  db_query("CREATE table if not exists nfc_expr_regi__arPD_span (
      span__id int unsigned primary key not null,
      ids__dsP varbinary(1024) default null null
    )
  ");

  db_query("CREATE table if not exists nfc_expr_grap__arPD_link (
      link__id int unsigned primary key not null,
      grap__id int unsigned not null
    )
  ");

  db_query("CREATE TABLE if not exists nfc_expr_wine__arPD_dups (
      dups__id int(10) unsigned NOT NULL,
      dups__lvl tinyint not null default 0,
      wine__id int(10) unsigned NOT NULL,  
      PRIMARY KEY (dups__id),
      KEY nfc_expr_wine__arPD_dups_FK_dups__id (dups__id),
      KEY nfc_expr_wine__arPD_dups_XK_dups__lvl (dups__lvl),
      KEY nfc_expr_wine__arPD_dups_FK_wine__id (wine__id)
    )
  ");

  db_query("CREATE table if not exists nfc_expr_grap__arS_blend (
      arS int unsigned primary key NOT NULL AUTO_INCREMENT,
      blend__dsP varbinary(1024) NOT NULL DEFAULT '',
      blend__cnt TINYINT NOT NULL DEFAULT 2,
      min__weID int unsigned DEFAULT NULL,
      UNIQUE KEY nfc_expr_grap__arS_blend_UK_blend__dsP(blend__dsP)
    )
  ");

  db_query("CREATE table if not exists nfc_expr_grap__acSG_blend (
      blend__arS int unsigned NOT NULL,
      grap__id int unsigned NOT NULL,
      PRIMARY KEY (blend__arS, grap__id)
    )
  ");

  db_query("CREATE table if not exists nfc_expr_updates__arS (
      arS integer AUTO_INCREMENT primary key not null,
      source__dsP varchar(255) not null,
      action__eC varchar(16) not null,
      action__id int unsigned not null,
      created int(11) NOT NULL DEFAULT unix_timestamp()
    )
  ");

  db_query("CREATE table if not exists nfc_expr_wine__arPD (
      arP int unsigned primary key not null,
      type__arP int unsigned default 0 not null,
      wine int unsigned default 0 not null,
      regi__dsP varbinary(512) default null null,
      vineyard int unsigned default null null,
      country int unsigned default null null,
      color int unsigned default null null,
      co2 int unsigned default null null,
      vintage__dsP varbinary(1024) default null null,
      vintage__ids varbinary(2024) default null null,
      grape__cnt tinyint default 0 not null,
      grape__dsP varbinary(512) default null null,
      grape_new__dsP varbinary(512) default null null,
      blend__dsP varbinary(512) default null null,
      blend_new__arS int unsigned default 0 not null,
      regi__lvl tinyint default 0 not null COMMENT '0 - best or no fit / 1 - 1-st term and one word / 2 - not 1-st term and one word',
      regi__id int unsigned default 0 not null,
      vine__lvl tinyint default 0 not null COMMENT '0 - best or no fit / 1 - 1-st term and one word / 2 - not 1-st term and one word',
      vine__id int unsigned default 0 not null,
      vine__term varbinary(64) default '',
      term__cnt tinyint default 0 not null,
      term__dsP varbinary(2024) default null null,
      attrTYPE__cnt tinyint default 0 not null,
      attrTYPE__eMB bigint unsigned default 0 not null,
      attrTITLE__cnt tinyint default 0 not null,
      attrTITLE__eMB bigint unsigned default 0 not null,
      UNIQUE KEY nfc_expr_wine__arPD_FK_wine(wine),
      KEY nfc_expr_wine__arPD_XK_vineyard(vineyard),
      KEY nfc_expr_wine__arPD_XK_blend_new__arS(blend_new__arS),
      KEY nfc_expr_wine__arPD_XK_country(country)      
    )
  ");

  db_query("CREATE table if not exists nfc_expr_wine__acPG (
      acPG int unsigned primary key not null AUTO_INCREMENT,
      expr__eS int unsigned default 0 not null,
      word__cnt int unsigned default 1 not null,
      wine__id int unsigned default 0 not null,
      from__id int unsigned default 0 not null,
      to__id int unsigned default 0 not null,
      CONSTRAINT nfc_expr_wine__acPG_FK_wine__id FOREIGN KEY (wine__id) REFERENCES nfc_expr_wine__arPD (wine) ON DELETE CASCADE ON UPDATE CASCADE,
      KEY nfc_expr_wine__acPG_FK_wine__id(wine__id),
      KEY nfc_expr_wine__acPG_XK_expr__eS(expr__eS)
    )
  ");

  db_query("CREATE table if not exists nfc_expr_wine__acPU_regi (
      wine__arP int unsigned default 0 not null,
      regi__id int unsigned default 0 not null,
      PRIMARY KEY (wine__arP, regi__id),
      CONSTRAINT nfc_expr_wine__acPU_regi_FK_wine__arP FOREIGN KEY (wine__arP) REFERENCES nfc_expr_wine__arPD (arP) ON DELETE CASCADE ON UPDATE CASCADE,
      KEY nfc_expr_wine__acPU_regi_FK_wine__arP (wine__arP),
      KEY nfc_expr_wine__acPU_regi_FK_regi__id (regi__id)
    )
  ");

  db_query("CREATE table if not exists nfc_expr_wine__acPU_blend (
      wine__arP int unsigned default 0 not null,
      blend__arS int unsigned default 0 not null,
      PRIMARY KEY (wine__arP, blend__arS)
    )
  ");

  db_query("CREATE table if not exists nfc_expr_wine__acPU_tara (
      wine__arP int unsigned NOT NULL,
      tara__id int unsigned NOT NULL,
      PRIMARY KEY (wine__arP, tara__id)
    )
  ");

  db_query("CREATE table if not exists nfc_score__arS (
      arS int(11) NOT NULL AUTO_INCREMENT,
      description__dsP varchar(10024) DEFAULT NULL,
      mode__niSB tinyint(4) NOT NULL DEFAULT 0,
      limit_dst smallint NOT NULL DEFAULT 1,
      created_at timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (arS)
    )
  ");

  db_query("CREATE table if not exists nfc_score__acSG_wine (
      acSG int unsigned AUTO_INCREMENT primary key not null,
      score__arS int unsigned not null,
      pw_wine int unsigned not null,
      pw_vintage int unsigned default null null,
      gw_wine int unsigned not null,
      gwe_vintage int unsigned default null null,
      gwe_id int unsigned default null null,
      score__niBO bigint not null default 0,
      limit__niBQ integer not null default 0,
      action__dsP varchar(255) default '',
      KEY nfc_score__acSG_wine_FK_score__arS(score__arS),
      KEY nfc_score__acSG_wine_XK_pw_wine(pw_wine),
      KEY nfc_score__acSG_wine_XK_gw_wine(gw_wine)
    )
  ");

  db_query("CREATE table if not exists nfc_score__acSG_ids (
    score__arS int unsigned not null,
    id int unsigned not null,
    primary key (score__arS, id)
  )");

  db_query("CREATE table if not exists nfc_log__arS (
      arS int unsigned AUTO_INCREMENT primary key not null,
      created_at timestamp DEFAULT current_timestamp(),
      action__eN varchar(16),
      dsP varchar(15000) collate utf8mb4_general_ci
    )
  ");

  db_query("CREATE table if not exists nfc_tag__arS (
      arS int unsigned AUTO_INCREMENT primary key not null,
      tag__dsP varchar(1024) DEFAULT NULL,
      term__arP int unsigned DEFAULT NULL
    )
  ");

  db_query("CREATE table if not exists nfc_rule__arS (
      arS int unsigned PRIMARY KEY not null,
      rule__eMI int unsigned default 0 not null,
      when__eMI int unsigned default 0 not null,
      column__eN int unsigned default 0 not null
    )
  ");

  db_query("CREATE table if not exists nfc_buger__arS (
      arS int unsigned PRIMARY KEY not null,
      buger__eS int unsigned default 0 not null,
      created_at timestamp DEFAULT current_timestamp()
    )
  ");
  nfc_create_indexes();

}

function nfc_create_constraints() {
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc__acPU_FK_child__arP'
  ")->fetchColumn()) {
  // nfc__acPU
    db_query("ALTER TABLE IF EXISTS nfc__acPU 
      ADD constraint nfc__acPU_FK_child__arP FOREIGN KEY (child__arP)
        references nfc__arP (arP) on delete cascade on update cascade,
      ADD constraint nfc__acPU_FK_parrent__arP FOREIGN KEY (parrent__arP)
        references nfc__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc__acPU_wine_FK_child__arP'
  ")->fetchColumn()) {
  // nfc__acPU_wine
    db_query("ALTER TABLE IF EXISTS nfc__acPU_wine 
      ADD constraint nfc__acPU_wine_FK_child__arP FOREIGN KEY (child__arP)
        references nfc__arP (arP) on delete cascade on update cascade,
      ADD constraint nfc__acPU_wine_FK_parrent__arP FOREIGN KEY (parrent__arP)
        references nfc_expr_wine__arPD (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_type__arP_FK_arP'
  ")->fetchColumn()) {
  // nfc_type__arP
    db_query("ALTER TABLE IF EXISTS nfc_type__arP 
      ADD constraint nfc_type__arP_FK_arP FOREIGN KEY (arP)
        references nfc__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_type_segments__arPD_FK_segment__arP'
  ")->fetchColumn()) {
  // nfc_type_segments__arPD
    db_query("ALTER TABLE IF EXISTS nfc_type_segments__arPD 
      ADD constraint nfc_type_segments__arPD_FK_segment__arP FOREIGN KEY (segment__arP)
        references nfc__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_word__arP_FK_arP'
  ")->fetchColumn()) {
  // nfc_word__arP
    db_query("ALTER TABLE IF EXISTS nfc_word__arP 
      ADD constraint nfc_word__arP_FK_arP FOREIGN KEY (arP)
        references nfc__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_word__acPG_lang_FK_arP'
  ")->fetchColumn()) {
  // nfc_word__acPG_lang
    db_query("ALTER TABLE IF EXISTS nfc_word__acPG_lang
      ADD constraint nfc_word__acPG_lang_FK_arP FOREIGN KEY (arP)
        references nfc__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_term__arP_FK_arP'
  ")->fetchColumn()) {
  // nfc_term__arP
    db_query("ALTER TABLE IF EXISTS nfc_term__arP 
      ADD constraint nfc_term__arP_FK_arP FOREIGN KEY (arP)
        references nfc__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_expr_attr__arSD_FK_term__arP'
  ")->fetchColumn()) {
  // nfc_expr_attr__arSD
    db_query("ALTER TABLE IF EXISTS nfc_expr_attr__arSD
      ADD constraint nfc_expr_attr__arSD_FK_expr__arP FOREIGN KEY (expr__arP)
        references nfc__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_expr_attr__arS_FK_REGI__arSD'
  ")->fetchColumn()) {
  // nfc_expr_attr__arS
    db_query("ALTER TABLE IF EXISTS nfc_expr_attr__arS 
      ADD constraint nfc_expr_attr__arS_FK_REGI__arSD FOREIGN KEY (REGI__arSD)
        references nfc_expr_attr__arSD (arSD) on delete cascade on update cascade,
      ADD constraint nfc_expr_attr__arS_FK_VINE__arSD FOREIGN KEY (VINE__arSD)
        references nfc_expr_attr__arSD (arSD) on delete cascade on update cascade,
      ADD constraint nfc_expr_attr__arS_FK_WINE__arSD FOREIGN KEY (WINE__arSD)
        references nfc_expr_attr__arSD (arSD) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_term__acPU_word_FK_term__arP'
  ")->fetchColumn()) {
  // nfc_term__acPU_word
    db_query("ALTER TABLE IF EXISTS nfc_term__acPU_word 
      ADD constraint nfc_term__acPU_word_FK_term__arP FOREIGN KEY (term__arP)
        references nfc_term__arP (arP) on delete cascade on update cascade,
      ADD constraint nfc_term__acPU_word_FK_word__arP FOREIGN KEY (word__arP)
        references nfc__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_rule__acSG_term_expr_FK_rule__arS'
  ")->fetchColumn()) {
  // nfc_rule__acSG_term_expr
    db_query("ALTER TABLE IF EXISTS nfc_rule__acSG_term_expr
      ADD constraint nfc_rule__acSG_term_expr_FK_rule__arS FOREIGN KEY (rule__arS)
        references nfc_rule__arS (arS) on delete cascade on update cascade,
      ADD constraint nfc_rule__acSG_term_expr_FK_whenTerm__arP FOREIGN KEY (whenTerm__arP)
        references nfc_term__arP (arP) on delete cascade on update cascade,
      ADD constraint nfc_rule__acSG_term_expr_FK_keyExpr__arP FOREIGN KEY (keyExpr__arP)
        references nfc_expr__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_expr__acPU_term_FK_expr__arP'
  ")->fetchColumn()) {
  // nfc_expr__acPU_term
    db_query("ALTER TABLE IF EXISTS nfc_expr__acPU_term 
      ADD constraint nfc_expr__acPU_term_FK_expr__arP FOREIGN KEY (expr__arP)
        references nfc__arP (arP) on delete cascade on update cascade,
      ADD constraint nfc_expr__acPU_term_FK_term__arP FOREIGN KEY (term__arP)
        references nfc_term__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_expr_wine__arPD_FK_arP'
  ")->fetchColumn()) {
  // nfc_expr_wine__arPD
    db_query("ALTER TABLE IF EXISTS nfc_expr_wine__arPD 
      ADD constraint nfc_expr_wine__arPD_FK_arP FOREIGN KEY (arP)
        references nfc__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_expr_wine__acPU_blend_FK_wine__arP'
  ")->fetchColumn()) {
  // nfc_expr_wine__acPU_blend
    db_query("ALTER TABLE IF EXISTS nfc_expr_wine__acPU_blend
      ADD constraint nfc_expr_wine__acPU_blend_FK_wine__arP FOREIGN KEY (wine__arP)
        references nfc_expr_wine__arPD (arP) on delete cascade on update cascade,
      ADD constraint nfc_expr__acSG_wine_blend_FK_blend__arS FOREIGN KEY (blend__arS)
        references nfc_expr_grap__arS_blend (arS) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_expr_wine__acPU_tara_FK_wine__arP'
  ")->fetchColumn()) {
  // nfc_expr_wine__acPU_tara
    db_query("ALTER TABLE IF EXISTS nfc_expr_wine__acPU_tara
      ADD constraint nfc_expr_wine__acPU_tara_FK_wine__arP FOREIGN KEY (wine__arP)
        references nfc_expr_wine__arPD (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_expr_vine__arPD_FK_vine__arP'
  ")->fetchColumn()) {
  // nfc_expr_vine__arPD
    db_query("ALTER TABLE IF EXISTS nfc_expr_vine__arPD
      ADD constraint nfc_expr_vine__arPD_FK_vine__arP FOREIGN KEY (vine__arP)
        references nfc_expr__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_expr__acPG_term_FK_expr__arP'
  ")->fetchColumn()) {
  // nfc_expr__acPG_term
    db_query("ALTER TABLE IF EXISTS nfc_expr__acPG_term
      ADD constraint nfc_expr__acPG_term_FK_expr__arP FOREIGN KEY (expr__arP)
        references nfc__arP (arP) on delete cascade on update cascade,
      ADD constraint nfc_expr__acPG_term_FK_term__arP FOREIGN KEY (term__arP)
        references nfc_term__arP (arP) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_expr_grap__acSG_blend_FK_blend__arS'
  ")->fetchColumn()) {
  // nfc_expr_grap__acSG_blend
    db_query("ALTER TABLE IF EXISTS nfc_expr_grap__acSG_blend 
      ADD constraint nfc_expr_grap__acSG_blend_FK_blend__arS FOREIGN KEY (blend__arS)
        references nfc_expr_grap__arS_blend (arS) on delete cascade on update cascade
    ");
  }
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_word__acSG_group_FK_base__dsP'
  ")->fetchColumn()) {
  // nfc_word__acSG_group
    db_query("ALTER TABLE IF EXISTS nfc_word__acSG_group
      ADD constraint nfc_word__acSG_group_FK_base__dsP FOREIGN KEY (base__dsP)
        references nfc_word__arS_group (base__dsP) on delete cascade on update cascade
    ");
  }
  //nfc_tag__arS
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'nfc_tag__arS_FK_term__arP'
  ")->fetchColumn()) {
// nfc_tag__arS
    db_query("ALTER TABLE IF EXISTS nfc_tag__arS
      ADD constraint nfc_tag__arS_FK_term__arP FOREIGN KEY (term__arP)
        references nfc_term__arP (arP) on delete cascade on update cascade
    ");
  }

  parsedwine_create_constraints();

}

function parsedwine_create_constraints() {
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'rule_FK_parsed_file_id'
  ")->fetchColumn()) {
// rule
    db_query("ALTER TABLE IF EXISTS rule
      ADD constraint rule_FK_parsed_file_id FOREIGN KEY (parsed_file_id)
        references parsed_file (id) on delete SET NULL,
      ADD constraint rule_FK_synonym_id FOREIGN KEY (synonym_id)
        references `synonym` (id) on delete SET NULL,
      ADD constraint rule_FK_user_id FOREIGN KEY (user_id)
        references users (id) on delete SET NULL
    ");
  }
  //vintage_wine_id_index
  if (!db_query(
    "SELECT count(*) as cnt 
      FROM information_schema.REFERENTIAL_CONSTRAINTS
      WHERE 1=1
        AND CONSTRAINT_SCHEMA = DATABASE() 
        AND CONSTRAINT_NAME = 'vintage_FK_wine_id'
  ")->fetchColumn()) {
// vintage
    db_query("ALTER TABLE IF EXISTS vintage
      ADD constraint vintage_FK_wine_id FOREIGN KEY (wine_id)
        references wine (id)
    ");
  }

}

function nfc_create_indexes() {

  nfc_create_constraints();
// nfc__acPU
  db_query("ALTER TABLE IF EXISTS nfc__acPU 
    ADD INDEX if not exists nfc__acPU_FK_child__arP(child__arP),
    ADD INDEX if not exists nfc__acPU_FK_parrent__arP(parrent__arP)
  ");
// nfc__acPU_wine
  db_query("ALTER TABLE IF EXISTS nfc__acPU_wine 
    ADD INDEX if not exists nfc__acPU_wine_FK_child__arP(child__arP),
    ADD INDEX if not exists nfc__acPU_wine_FK_parrent__arP(parrent__arP)
  ");
// nfc_type__arP
  db_query("ALTER TABLE IF EXISTS nfc_type__arP 
    ADD UNIQUE INDEX if not exists nfc_type__arP_UK_dsP(dsP),
    ADD INDEX if not exists nfc_type__arP_FK_arP(arP)
  ");
// nfc_type_segments__arPD
  db_query("ALTER TABLE IF EXISTS nfc_type_segments__arPD
    ADD INDEX if not exists nfc_type_segments__arPD_FK_segment__arP(segment__arP)
  ");  
// nfc_word__arP
  db_query("ALTER TABLE IF EXISTS nfc_word__arP 
    ADD INDEX if not exists nfc_word__arP_FK_arP(arP),
    ADD INDEX if not exists nfc_word__arP_XK_word__eMT(word__eMT),
    ADD UNIQUE INDEX if not exists nfc_word__arP_UK_dsP(dsP)
  ");
// nfc_word__acPG_lang
  db_query("ALTER TABLE IF EXISTS nfc_word__acPG_lang
    ADD INDEX if not exists nfc_word__arP_FK_acPG(arP)
  ");
// nfc_expr_attr__arSD
  db_query("ALTER TABLE IF EXISTS nfc_expr_attr__arSD
    ADD INDEX if not exists nfc_expr_attr__arSD_FK_expr__arP(expr__arP)
  ");
// nfc_expr_attr__arS
  db_query("ALTER TABLE IF EXISTS nfc_expr_attr__arS
    ADD INDEX if not exists nfc_expr_attr__arS_FK_REGI__arSD(REGI__arSD),
    ADD INDEX if not exists nfc_expr_attr__arS_FK_VINE__arSD(VINE__arSD),
    ADD INDEX if not exists nfc_expr_attr__arS_FK_WINE__arSD(WINE__arSD),
    ADD UNIQUE INDEX if not exists nfc_expr_attr__arS_UK_WINE__arSD(REGI__arSD,VINE__arSD,WINE__arSD)
  ");
// nfc_term__arP
  db_query("ALTER TABLE IF EXISTS nfc_term__arP 
    ADD INDEX if not exists nfc_term__arP_FK_arP(arP),
    ADD INDEX if not exists nfc_term__arP_XK_expr__eS(expr__eS),
    ADD UNIQUE INDEX if not exists nfc_term__arP_UK_dsP(dsP),
    ADD INDEX if not exists nfc_term__arP_XK_rang(rang)
  ");
// nfc_term__acPU_word
  db_query("ALTER TABLE IF EXISTS nfc_term__acPU_word 
    ADD INDEX if not exists nfc_term__acPU_word_FK_term__arP(term__arP),
    ADD INDEX if not exists nfc_term__acPU_word_FK_word__arP(word__arP)
  ");
// nfc_expr__acPU_term
  db_query("ALTER TABLE IF EXISTS nfc_expr__acPU_term 
    ADD INDEX if not exists nfc_expr__acPU_term_FK_expr__arP(expr__arP),
    ADD INDEX if not exists nfc_expr__acPU_term_FK_term__arP(term__arP)
  ");
// nfc_rule__arS
  db_query("ALTER TABLE IF EXISTS nfc_rule__arS
    ADD INDEX if not exists nfc_rule__arS_XK_rule__eMI(rule__eMI),
    ADD INDEX if not exists nfc_rule__arS_XK_when__eMI(when__eMI),
    ADD INDEX if not exists nfc_rule__arS_XK_column__eN(column__eN)
  ");
// nfc_rule__acSG_term_expr
  db_query("ALTER TABLE IF EXISTS nfc_rule__acSG_term_expr
    ADD INDEX if not exists nfc_rule__acSG_term_expr_FK_rule__arS(rule__arS),
    ADD INDEX if not exists nfc_rule__acSG_term_expr_FK_whenTerm__arP(whenTerm__arP),
    ADD INDEX if not exists nfc_rule__acSG_term_expr_FK_keyExpr__arP(keyExpr__arP)
  ");
// nfc_expr_wine__arPD
  db_query("ALTER TABLE IF EXISTS nfc_expr_wine__arPD
    ADD INDEX if not exists nfc_expr_wine__arPD_FK_arP(arP)
  ");
// nfc_expr_wine__acPU_blend
  db_query("ALTER TABLE IF EXISTS nfc_expr_wine__acPU_blend
    ADD INDEX if not exists nfc_expr_wine__acPU_blend_FK_wine__arP(wine__arP),
    ADD INDEX if not exists nfc_expr_wine__acPU_blend_FK_blend__arS(blend__arS)
  ");
// nfc_expr_wine__acPU_tara
  db_query("ALTER TABLE IF EXISTS nfc_expr_wine__acPU_tara
    ADD INDEX if not exists nfc_expr_wine__acPU_tara_FK_wine__arP(wine__arP),
    ADD INDEX if not exists nfc_expr_wine__acPU_tara_UK_tara__id(tara__id)
  ");
// nfc_expr_vine__arPD
  db_query("ALTER TABLE IF EXISTS nfc_expr_vine__arPD 
    ADD INDEX if not exists nfc_expr_vine__arPD_FK_vine__arP(vine__arP)
  ");
// nfc_expr__acPG_term
  db_query("ALTER TABLE IF EXISTS nfc_expr__acPG_term
    ADD INDEX if not exists nfc_expr__acPG_term_FK_expr__arP(expr__arP),
    ADD INDEX if not exists nfc_expr__acPG_term_FK_term__arP(term__arP),
    ADD INDEX if not exists nfc_expr__acPG_term_XK_link__eMI(link__eMI)
  ");
// nfc_expr_regi__arPD_link
  db_query("ALTER TABLE IF EXISTS nfc_expr_regi__arPD_link
    ADD INDEX if not exists nfc_expr_regi__arPD_link_FK_link__id(link__id),
    ADD INDEX if not exists nfc_expr_regi__arPD_link_FK_regi__id(regi__id)
  ");
// nfc_expr_grap__arPD_link
  db_query("ALTER TABLE IF EXISTS nfc_expr_grap__arPD_link
    ADD INDEX if not exists nfc_expr_grap__arPD_link_FK_link__id(link__id),
    ADD INDEX if not exists nfc_expr_grap__arPD_link_FK_grap__id(grap__id)
  ");
// nfc_expr_grap__acSG_blend
  db_query("ALTER TABLE IF EXISTS nfc_expr_grap__acSG_blend 
    ADD INDEX if not exists nfc_expr_grap__acSG_blend_FK_blend__arS(blend__arS),
    ADD INDEX if not exists nfc_expr_grap__acSG_blend_FK_grap__id(grap__id)
  ");
// nfc_score__acSG
  db_query("ALTER TABLE IF EXISTS nfc_score__acSG 
    ADD INDEX if not exists nfc_score__acSG_FK_score__arS(score__arS),
    ADD INDEX if not exists nfc_score__acSG_FK_expr__arP(expr__arP),
    ADD INDEX if not exists nfc_score__acSG_FK_score__arP(expr__arP)
  ");
// nfc_score__acSG_ids
  db_query("ALTER TABLE IF EXISTS nfc_score__acSG_ids
    ADD INDEX if not exists nfc_score__acSG_ids_FK_score__arS(score__arS)
  ");
  // nfc_expr_updates__arS
  db_query("ALTER TABLE IF EXISTS nfc_expr_updates__arS 
    ADD INDEX if not exists nfc_expr_updates__arS_XK_action__id(action__id)
  ");
  // nfc_word__acSG_group
  db_query("ALTER TABLE IF EXISTS nfc_word__acSG_group 
    ADD INDEX if not exists nfc_word__acSG_group_FK_base__dsP(base__dsP),
    ADD UNIQUE INDEX if not exists nfc_word__acSG_group_UK_SynDeriv__dsP(form__dsP)
  ");
  // nfc_tag__arS
  db_query("ALTER TABLE IF EXISTS nfc_tag__arS 
    ADD INDEX if not exists nfc_tag__arS_FK_term__arP(term__arP)
  ");

  parsedwine_create_indexes();

}


function parsedwine_create_indexes() {
  db_query("ALTER TABLE IF EXISTS rule
    ADD INDEX if not exists rule_FK_parsed_file_id (parsed_file_id),
    ADD INDEX if not exists rule_FK_synonym_id (synonym_id),
    ADD INDEX if not exists rule_FK_user_id (user_id),
    ADD INDEX if not exists rule_XK_value (`value`)
  ");
  db_query("ALTER TABLE IF EXISTS vintage
    ADD INDEX if not exists vintage_FK_wine_id (wine_id)
  ");
  
}

function nfc_drop_indexes() {
  nfc_drop_constraints();

// nfc_tag__arS
  db_query("ALTER TABLE IF EXISTS nfc_tag__arS
    DROP INDEX if exists nfc_tag__arS_FK_term__arP
  ");
// nfc_expr_updates__arS
  db_query("ALTER TABLE IF EXISTS nfc_expr_updates__arS
    DROP INDEX if exists nfc_expr_updates__arS_XK_action__id
  ");
// nfc_score__acSG_ids
  db_query("ALTER TABLE IF EXISTS nfc_score__acSG_ids
    DROP INDEX IF EXISTS nfc_score__acSG_ids_FK_score__arS
  ");
// nfc_score__acSG
  db_query("ALTER TABLE IF EXISTS nfc_score__acSG 
    DROP INDEX IF EXISTS nfc_score__acSG_FK_score__arS,
    DROP INDEX IF EXISTS nfc_score__acSG_FK_expr__arP,
    DROP INDEX IF EXISTS nfc_score__acSG_FK_score__arP
  ");
// nfc_expr_regi__arPD_link
  db_query("ALTER TABLE IF EXISTS nfc_expr_regi__arPD_link
    DROP INDEX IF EXISTS nfc_expr_regi__arPD_link_FK_link__id,
    DROP INDEX IF EXISTS nfc_expr_regi__arPD_link_FK_regi__id
  ");
// nfc_expr_grap__arPD_link
  db_query("ALTER TABLE IF EXISTS nfc_expr_grap__arPD_link
    DROP INDEX IF EXISTS nfc_expr_grap__arPD_link_FK_link__id,
    DROP INDEX IF EXISTS nfc_expr_grap__arPD_link_FK_grap__id
  ");
// nfc_expr_grap__acSG_blend
  db_query("ALTER TABLE IF EXISTS nfc_expr_grap__acSG_blend 
    DROP INDEX IF EXISTS nfc_expr_grap__acSG_blend_FK_blend__arS,
    DROP INDEX IF EXISTS nfc_expr_grap__acSG_blend_FK_grap__id
  ");
// nfc_expr__acPG_term
  db_query("ALTER TABLE IF EXISTS nfc_expr__acPG_term
    DROP INDEX IF EXISTS nfc_expr__acPG_term_FK_expr__arP,
    DROP INDEX IF EXISTS nfc_expr__acPG_term_FK_term__arP,
    DROP INDEX IF EXISTS nfc_expr__acPG_term_XK_link__eMI
  ");
// nfc_expr_wine__acPU_blend
  db_query("ALTER TABLE IF EXISTS nfc_expr_wine__acPU_blend
    DROP INDEX IF EXISTS nfc_expr_wine__acPU_blend_FK_wine__arP,
    DROP INDEX IF EXISTS nfc_expr_wine__acPU_blend_FK_blend__arS
  ");
// nfc_expr_wine__acPU_tara
  db_query("ALTER TABLE IF EXISTS nfc_expr_wine__acPU_tara
    DROP INDEX IF EXISTS nfc_expr_wine__acPU_tara_FK_wine__arP,
    DROP INDEX IF EXISTS nfc_expr_wine__acPG_tara_FK_tara__id
  ");
// nfc_expr_vine__arPD
  db_query("ALTER TABLE IF EXISTS nfc_expr_vine__arPD
    DROP INDEX IF EXISTS nfc_expr_vine__arPD_FK_vine__arP
  ");
// nfc_expr_wine__arPD
  db_query("ALTER TABLE IF EXISTS nfc_expr_wine__arPD 
    DROP INDEX IF EXISTS nfc_expr_wine__arPD_FK_arP
  ");
// nfc_expr__acPU_term
  db_query("ALTER TABLE IF EXISTS nfc_expr__acPU_term 
    DROP INDEX IF EXISTS nfc_expr__acPU_term_FK_expr__arP,
    DROP INDEX IF EXISTS nfc_expr__acPU_term_FK_term__arP
  ");
// nfc_rule__acSG_term_expr
  db_query("ALTER TABLE IF EXISTS nfc_rule__acSG_term_expr
    DROP INDEX IF EXISTS nfc_rule__acSG_term_expr_FK_whenTerm__arP,
    DROP INDEX IF EXISTS nfc_rule__acSG_term_expr_FK_keyExpr__arP,
    DROP INDEX IF EXISTS nfc_rule__acSG_term_expr_FK_rule__arS
  ");
// nfc_rule__arS
  db_query("ALTER TABLE IF EXISTS nfc_rule__arS
    DROP INDEX IF EXISTS nfc_rule__arS_XK_when__eMI,
    DROP INDEX IF EXISTS nfc_rule__arS_XK_rule__eMI,
    DROP INDEX IF EXISTS nfc_rule__arS_XK_column__eN
  ");
// nfc_term__acPU_word
  db_query("ALTER TABLE IF EXISTS nfc_term__acPU_word 
    DROP INDEX IF EXISTS nfc_term__acPU_word_FK_term__arP,
    DROP INDEX IF EXISTS nfc_term__acPU_word_FK_word__arP
  ");
// nfc_expr_attr__arS
  db_query("ALTER TABLE IF EXISTS nfc_expr_attr__arS 
    DROP INDEX IF EXISTS nfc_expr_attr__arS_FK_REGI__arSD,
    DROP INDEX IF EXISTS nfc_expr_attr__arS_FK_VINE__arSD,
    DROP INDEX IF EXISTS nfc_expr_attr__arS_FK_WINE__arSD,
    DROP INDEX IF EXISTS nfc_expr_attr__arS_UK_WINE__arSD
  ");
// nfc_expr_attr__arS
  db_query("ALTER TABLE IF EXISTS nfc_expr_attr__arSD 
    DROP INDEX IF EXISTS nfc_expr_attr__arSD_FK_expr__arP
  ");
// nfc_term__arP
  db_query("ALTER TABLE IF EXISTS nfc_term__arP 
    DROP INDEX IF EXISTS nfc_term__arP_UK_dsP,
    DROP INDEX IF EXISTS nfc_term__arP_FK_arP,
    DROP INDEX IF EXISTS nfc_term__arP_XK_expr__eS,
    DROP INDEX if exists nfc_term__arP_XK_rang

  ");
// nfc_word__arP
  db_query("ALTER TABLE IF EXISTS nfc_word__arP 
    DROP INDEX IF EXISTS nfc_word__arP_UK_dsP,
    DROP INDEX IF EXISTS nfc_word__arP_FK_arP,
    DROP INDEX IF EXISTS nfc_word__arP_XK_word__eMT
  ");
// nfc_word__acPG_lang
  db_query("ALTER TABLE IF EXISTS nfc_word__acPG_lang
    DROP INDEX IF EXISTS nfc_word__acPG_lang_FK_arP
  ");
// nfc_type__arP
  db_query("ALTER TABLE IF EXISTS nfc_type__arP 
    DROP INDEX IF EXISTS nfc_type__arP_FK_arP,
    DROP INDEX IF EXISTS nfc_type__arP_UK_dsP
  ");
// nfc_type_segments__arPD
  db_query("ALTER TABLE IF EXISTS nfc_type_segments__arPD 
    DROP INDEX IF EXISTS nfc_type_segments__arPD_FK_segment__arP
  ");  
// nfc__acPU_wine
  db_query("ALTER TABLE IF EXISTS nfc__acPU_wine 
    DROP INDEX IF EXISTS nfc__acPU_wine_FK_child__arP,
    DROP INDEX IF EXISTS nfc__acPU_wine_FK_parrent__arP
  ");
// nfc__acPU
  db_query("ALTER TABLE IF EXISTS nfc__acPU 
    DROP INDEX IF EXISTS nfc__acPU_FK_child__arP,
    DROP INDEX IF EXISTS nfc__acPU_FK_parrent__arP
 ");
  // nfc_word__arS_group
  db_query("ALTER TABLE IF EXISTS nfc_word__arS_group
    DROP INDEX if exists nfc_word__arS_group_UK_base__dsP
  ");
  // nfc_word__acSG_group
  db_query("ALTER TABLE IF EXISTS nfc_word__acSG_group 
    DROP INDEX if exists nfc_word__acSG_group_FK_base__dsP,
    DROP INDEX if exists nfc_word__acSG_group_UK_SynDeriv__dsP
  ");
  parsedwine_drop_indexes();

}

function parsedwine_drop_indexes() {
  db_query("ALTER TABLE IF EXISTS rule
    DROP INDEX if exists rule_FK_parsed_file_id,
    DROP INDEX if exists rule_FK_synonym_id,
    DROP INDEX if exists rule_FK_user_id,
    DROP INDEX if exists rule_XK_value
  ");
  // old index names
  db_query("ALTER TABLE IF EXISTS rule
    DROP INDEX if exists INDEX_SET_FILE,
    DROP INDEX if exists INDEX_SYNONYM,
    DROP INDEX if exists rule_user_id_foreign
  ");
  db_query("ALTER TABLE IF EXISTS vintage
    DROP INDEX if exists vintage_FK_wine_id
  ");
  // old index names for vintage
  db_query("ALTER TABLE IF EXISTS vintage
    DROP INDEX if exists vintage_wine_id_index
  ");

}

function nfc_drop_constraints() {
  
// nfc_tag__arS
  db_query("ALTER TABLE IF EXISTS nfc_tag__arS 
    DROP CONSTRAINT IF EXISTS nfc_tag__arS_FK_term__arP
  ");
// nfc_expr_grap__acSG_blend
  db_query("ALTER TABLE IF EXISTS nfc_expr_grap__acSG_blend 
    DROP CONSTRAINT IF EXISTS nfc_expr_grap__acSG_blend_FK_blend__arS,
    DROP CONSTRAINT IF EXISTS nfc_expr_grap__acSG_blend_FK_grap__id
  ");
// nfc_expr_wine__acPU_blend
  db_query("ALTER TABLE IF EXISTS nfc_expr_wine__acPU_blend
    DROP CONSTRAINT IF EXISTS nfc_expr_wine__acPU_blend_FK_wine__arP,
    DROP CONSTRAINT IF EXISTS nfc_expr_wine__acPU_blend_FK_blend__arS
  ");
// nfc_expr_wine__acPU_tara
  db_query("ALTER TABLE IF EXISTS nfc_expr_wine__acPG_tara
    DROP CONSTRAINT IF EXISTS nfc_expr_wine__acPU_tara_FK_wine__arP
  ");
// nfc_expr_vine__arPD
  db_query("ALTER TABLE IF EXISTS nfc_expr_vine__arPD
    DROP CONSTRAINT IF EXISTS nfc_expr_vine__arPD_FK_vine__arP
  ");
// nfc_expr__acPG_term
  db_query("ALTER TABLE IF EXISTS nfc_expr__acPG_term
    DROP CONSTRAINT IF EXISTS nfc_expr__acPG_term_FK_expr__arP,
    DROP CONSTRAINT IF EXISTS nfc_expr__acPG_term_FK_term__arP
  ");
// nfc_expr_wine__arPD
  db_query("ALTER TABLE IF EXISTS nfc_expr_wine__arPD
    DROP CONSTRAINT IF EXISTS nfc_expr_wine__arPD_FK_arP
  ");
// nfc_expr__acPU_term
  db_query("ALTER TABLE IF EXISTS nfc_expr__acPU_term 
    DROP CONSTRAINT IF EXISTS nfc_expr__acPU_term_FK_expr__arP,
    DROP CONSTRAINT IF EXISTS nfc_expr__acPU_term_FK_term__arP
  ");
// nfc_rule__acSG_term_expr
  db_query("ALTER TABLE IF EXISTS nfc_rule__acSG_term_expr
    DROP CONSTRAINT IF EXISTS nfc_rule__acSG_term_expr_FK_whenTerm__arP,
    DROP CONSTRAINT IF EXISTS nfc_rule__acSG_term_expr_FK_keyExpr__arP,
    DROP CONSTRAINT IF EXISTS nfc_rule__acSG_term_expr_FK_rule__arS
  ");
// nfc_term__acPU_word
  db_query("ALTER TABLE IF EXISTS nfc_term__acPU_word 
    DROP CONSTRAINT IF EXISTS nfc_term__acPU_word_FK_term__arP,
    DROP CONSTRAINT IF EXISTS nfc_term__acPU_word_FK_word__arP
  ");
// nfc_expr_attr__arS
  db_query("ALTER TABLE IF EXISTS nfc_expr_attr__arS 
    DROP CONSTRAINT IF EXISTS nfc_expr_attr__arS_FK_arP,
    DROP CONSTRAINT IF EXISTS nfc_expr_attr__arS_FK_REGI__arSD,
    DROP CONSTRAINT IF EXISTS nfc_expr_attr__arS_FK_VINE__arSD,
    DROP CONSTRAINT IF EXISTS nfc_expr_attr__arS_FK_WINE__arSD
  ");
// nfc_expr_attr__arSD
  db_query("ALTER TABLE IF EXISTS nfc_expr_attr__arSD
    DROP CONSTRAINT IF EXISTS nfc_expr_attr__arSD_FK_expr__arP
  ");
// nfc_term__arP
  db_query("ALTER TABLE IF EXISTS nfc_term__arP 
    DROP CONSTRAINT IF EXISTS nfc_term__arP_FK_arP
  ");
// nfc_word__arP
  db_query("ALTER TABLE IF EXISTS nfc_word__arP
    DROP CONSTRAINT IF EXISTS nfc_word__arP_FK_arP,
    DROP CONSTRAINT IF EXISTS nfc_word__arP_XK_word__eMT
  ");
// nfc_word__acPG_lang
  db_query("ALTER TABLE IF EXISTS nfc_word__acPG_lang
    DROP CONSTRAINT IF EXISTS nfc_word__acPG_lang_FK_arP
  ");
// nfc_type__arP
  db_query("ALTER TABLE IF EXISTS nfc_type__arP 
    DROP CONSTRAINT IF EXISTS nfc_type__arP_FK_arP
  ");
// nfc_type_segments__arPD
  db_query("ALTER TABLE IF EXISTS nfc_type_segments__arPD
    DROP CONSTRAINT IF EXISTS nfc_type_segments__arPD_FK_segment__arP
  ");  
// nfc__acPU_wine
  db_query("ALTER TABLE IF EXISTS nfc__acPU_wine 
    DROP CONSTRAINT IF EXISTS nfc__acPU_wine_FK_child__arP,
    DROP CONSTRAINT IF EXISTS nfc__acPU_wine_FK_parrent__arP
  ");
// nfc__acPU
  db_query("ALTER TABLE IF EXISTS nfc__acPU 
    DROP CONSTRAINT IF EXISTS nfc__acPU_FK_child__arP,
    DROP CONSTRAINT IF EXISTS nfc__acPU_FK_parrent__arP
  ");
  // nfc_word__acSG_group
  db_query("ALTER TABLE IF EXISTS nfc_word__acSG_group 
    DROP CONSTRAINT if exists nfc_word__acSG_group_FK_base__dsP
  ");
  parsedwine_drop_constraints();

}

function parsedwine_drop_constraints() {
  db_query("ALTER TABLE IF EXISTS rule
    DROP CONSTRAINT if exists rule_FK_parsed_file_id,
    DROP CONSTRAINT if exists rule_FK_synonym_id,
    DROP CONSTRAINT if exists rule_FK_user_id
  ");
  // old CONSTRAINT names
  db_query("ALTER TABLE IF EXISTS rule
    DROP CONSTRAINT if exists rule_FK,
    DROP CONSTRAINT if exists rule_FK_1,
    DROP CONSTRAINT if exists rule_user_id_foreign
  ");
  db_query("ALTER TABLE IF EXISTS vintage
    DROP CONSTRAINT if exists vintage_FK_wine_id
  ");
  // old CONSTRAINT names for vintage
  db_query("ALTER TABLE IF EXISTS vintage
    DROP CONSTRAINT if exists fk_wine_id
  ");

}

function nfc_reInit() { // updates and insert only changes in types
  global $fti_sq;
  $NFC_TYPE__arP = NFC_TYPE__arP;
  //echo "\n" . $fti_sq['init_type__arP'] . " order by cast(level as int)";
  $sql = "TRUNCATE nfc_type__arP";
  db_query($sql);
  db_query($fti_sq['init__arP']);
  db_query($fti_sq['init_type__arP']);
  $types = db_query("SELECT count(*) as cnt from (" . $fti_sq['select_type__arP'] . ") as t1")->fetchColumn();
  db_query("UPDATE nfc_type_segments__arPD set seg_next = $types where segment__arP = $NFC_TYPE__arP");
}

function nfc_init() {
global $fti_sq, $fti_var;
//  echo "\n" . $fti_sq['init_type__arP'] . " order by cast(level as int)";
  db_query($fti_sq['init__arP']);
  db_query($fti_sq['init_type__arP']);
  $fti_type_next = db_query("SELECT max(arP) + 1 arP from nfc_type__arP")->fetchAll()[0]->arP;
  $sql2 =
    "INSERT into nfc_type_segments__arPD
        (segment__arP, seg_next, seg_mask, seg_start)
      select t2.arP, if(t2.dsP = 'nfc_type__arP', $fti_type_next, seg_next) seg_next, seg_mask, seg_start
      from ( " . $fti_sq['init'] . " ) t1
        left join nfc_type__arP t2 on t2.dsP = t1.dsP
      where t1.description like 'nfc_type_segment__arP%'
  ";
  //echo $sql2; exit;
  db_query($sql2);
  nfc_synonyms_create();
  nfc_loadClass();
  dog("New schema regeneration. ver: " . $fti_var['index_ver']);

}

function nfc_create_procedures() {
  global $fti_gustos_db, $fti_gustos_region_db, $fti_var, $fti_seg_start, $fti_seg_mask, $fti_seg_next, $fti_sq;
  //d($fti_var);
  $exTARA = $fti_var['exTARA'][0];
  $syGroupRV = $fti_var['syGroupRV'];
  $exREGI = $fti_var['exREGI'][0];
  $exVINE = $fti_var['exVINE'][0];
  $exGRAP = $fti_var['exGRAP'][0];
  $syGroupNW = $fti_var['exWINE'][0];
  $FTI_VINE = FTI_VINE;
  $FTI_TARA = FTI_TARA;
  
  db_query("DROP FUNCTION if exists gustos_wine_entity__acFL_fix_vintage");
  db_query(
"CREATE FUNCTION gustos_wine_entity__acFL_fix_vintage() RETURNS int(11)
  BEGIN
    declare rows__cnt int;
    declare vint__min int default 3;
    declare vint__max int default 100;
    declare year__cur int default YEAR(CURDATE());
    update ignore $fti_gustos_db.gustos_wine_entity as u1
      inner join (    
        select a1.id,
          ifnull(min(a6.year), 3) - 1 as vint
        from $fti_gustos_db.gustos_wine_entity as a1
          left join $fti_gustos_db.third_party_award_wine_entity as a4 on a4.wine_entity_id = a1.id
          left join $fti_gustos_db.third_party_award as a5 on a5.id = a4.award_id
          left join $fti_gustos_db.third_party_event as a6 on a6.id = a5.event_id
        where a1.vintage not between vint__min and year__cur
        group by a1.id      
      ) as u2 on u2.id = u1.id
      set u1.vintage = u2.vint
    ;
    select ROW_COUNT() into rows__cnt;
    update $fti_gustos_db.gustos_wine_entity as u1
      inner join (      
        select a1.id, a1.vintage, a1.wine, if(a2.vint > vint__max, a2.vint - a2.vintage, a2.vint) vint
        from $fti_gustos_db.gustos_wine_entity as a1
          left join (    
            select b1.id, b1.wine, cast(b1.vintage as int) vintage,
              cast(if(b2.vint > vint__max, b2.vint, b1.vintage + b2.vint) as int) as vint
            from $fti_gustos_db.gustos_wine_entity as b1
              left join (
                select wine,
                  if (max(c1.vintage) between vint__max and year__cur,
                      (select min(vintage) - 1
                        from $fti_gustos_db.gustos_wine_entity
                        where 1=1
                          and wine = c1.wine
                          and vintage between vint__max and year__cur
                      ),
                      (select if(vintage > year__cur, vint__min, max(vintage)) + 1
                        from $fti_gustos_db.gustos_wine_entity
                        where 1=1
                          and wine = c1.wine
                          and vintage not between vint__max and year__cur
                      )
                  ) vint
                from $fti_gustos_db.gustos_wine_entity as c1
                where exists(select 1 from $fti_gustos_db.gustos_wine_entity where wine = c1.wine and vintage not between vint__min and year__cur)
                group by c1.wine
              ) as b2 on b2.wine = b1.wine
            where b1.vintage not between vint__min and year__cur
          ) as a2 on a2.id = a1.id
        where a1.vintage not between vint__min and year__cur
      ) as u2 on u2.id = u1.id
      set u1.vintage = u2.vint
    ;
    return (SELECT rows__cnt + ROW_COUNT());
  END  
  ");

  db_query("DROP FUNCTION if exists _norma__asFL_v2");
  db_query(
"CREATE FUNCTION _norma__asFL_v2(p__name varchar(512)) returns varchar(512) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
  return (
    SELECT
      trim(regexp_replace(regexp_replace(
        replace(regexp_replace(replace(
          regexp_replace(
            regexp_replace(
              regexp_replace(
                regexp_replace(
                    regexp_replace(
                      regexp_replace(lower(p__name COLLATE utf8mb4_unicode_ci), '[[:alpha:]]\\\\w+\\\\K\\\\.', ' ')
                      ,'\\\\d\\\\K ?(anos|ani|years old|years|yo|роки|років|лет)(\\\\b|\\\\z)','yo')
                  , '((^|\\\\b)(no\\\\b|n°?)|№|#)\\\\.? ?(?=\\\\d)', 'n')
                ,'(?<=\\\\b[[:alpha:]])\\\\. (?=([[:alpha:]]\\\\b|\\\\z))|((’|''|`)(?=я))', '')
              ,'(?<=\\\\w)((’|`|''|\\\\.)(?=[[:alpha:]]\\\\w)|/|-|&|\\\\\\\\|\\\\|)(?=\\\\w\\\\w)|\\\\.\\\\.+',' ')
            ,'(’|`|'')|(?<=\\\\w)(/|\\\\.|(?<=\\\\b[[:alpha:]]) (?=[[:alpha:]]\\\\W)|&|-|\\\\\\\\|\\\\||([[:punct:]](?=[[:alpha:]](\\\\b|$))))(?!(\\\\d))|°', '')
          ,'.','pppointtt'),' ?([[:punct:]\\n]) ?', ','),'pppointtt','.')
        ,',+',','), '('')+', ''))
  )
  ");

  $FTI_VINEYARD_BL_20000 = FTI_VINEYARD_BL_20000;
  db_query("DROP PROCEDURE if exists nfc_expr__asPL_vine_gustosapp");
  db_query(
"CREATE PROCEDURE nfc_expr__asPL_vine_gustosapp (IN p__id int unsigned, p__arS int unsigned)
  select
      t1.id, t1.name,
      concat_ws(',', t1.country, group_concat(distinct nullif(t2.country, t1.country))) as countries,
      count(t2.id) as wines__cnt
    FROM $fti_gustos_db.vineyard as t1
      left join $fti_gustos_db.gustos_wine as t2 on t2.vineyard = t1.id
    where 1 = 1
      and t1.name not regexp '\\\\(temp\\\\)|\\\\b(delet(e|)|удалить|test|тест|No Value)\\\\b'
      and CHAR_LENGTH(t1.name) > 1
      and (1 <> 1
      	or (p__arS <> 0 and t1.id = p__arS)
      	or (p__arS = 0 and t1.id > p__id)
      )
    group by t1.id, t1.name, t1.country
    order by t1.id
    limit $FTI_VINEYARD_BL_20000
  ");

  $FTI_REGION_BL_20000 = FTI_REGION_BL_20000;
  db_query("DROP PROCEDURE if exists nfc_expr__asPL_regi_gustosapp");
  db_query(
"CREATE PROCEDURE nfc_expr__asPL_regi_gustosapp (IN p__id int unsigned, p__arS int unsigned)
  select distinct
      t1.id, t1.name,
      ifnull(t2.field_region_country_target_id, 0) as countries,
      ifnull(t3.parent_id, ifnull(t2.field_region_country_target_id, 0)) as parent_id
    FROM $fti_gustos_db.region as t1
      inner join $fti_gustos_db.field_data_field_region_country as t2 on t2.entity_id = t1.id
      left join $fti_gustos_region_db.region_hierarchy as t3 on t3.type = 'GEOGRAPHICAL' and t3.child_id = t1.id
      left join (
        select b1.child_id, b1.parent_id
        from $fti_gustos_region_db.region_hierarchy as b1
          inner join (
            select a1.child_id
            from $fti_gustos_region_db.region_hierarchy as a1
            group by a1.child_id
            having count(*) > 1
          ) as b2 on b2.child_id = b1.child_id
          left join $fti_gustos_db.region as b3 on b3.id = b1.parent_id
        where b3.type = 'COUNTRY'
      ) as t4 on t4.parent_id = t3.parent_id and t4.child_id = t3.child_id
    where 1 = 1
      and t1.type in ('REGION', 'APPELLATION')
      and t4.parent_id is null
      and (1 <> 1
        or (p__arS <> 0 and t1.id = p__arS)
        or (p__arS = 0 and t1.id > p__id)
      )
    order by t1.id
    limit $FTI_REGION_BL_20000
  ");
  
  $FTI_GRAPE_BL_20000 = FTI_GRAPE_BL_20000;
  db_query("DROP PROCEDURE if exists nfc_expr__asPL_grap_gustosapp");
  db_query(
"CREATE PROCEDURE nfc_expr__asPL_grap_gustosapp (IN p__id int unsigned, p__arS int unsigned)
  select t1.tid as id, t1.name
    FROM $fti_gustos_db.taxonomy_term_data as t1
    where 1 = 1
      and vid = 4
      and CHAR_LENGTH(t1.name) > 1
      and (1 <> 1
        or (p__arS <> 0 and t1.tid = p__arS)
        or (p__arS = 0 and t1.tid > p__id)
      )
    order by t1.tid
    limit $FTI_GRAPE_BL_20000
  ");

  $FTI_WINE_BL_20000 = FTI_WINE_BL_20000;
  db_query("DROP PROCEDURE if exists nfc_expr__asPL_wine_gustosapp");
  db_query(
"CREATE procedure nfc_expr__asPL_wine_gustosapp(IN p__id int unsigned, p__arS int unsigned)
  SELECT
    a1.id, a1.name,
    ifnull(a1.vineyard, 0) as vineyard,
    ifnull(a1.country, 0) as country,
    ifnull(a1.color, 0) as color,
    max(ifnull(a2.grape__cnt, 0)) as grape__cnt,
    ifnull(group_concat(distinct a2.grape__dsP separator ',#,'), 0) as grape__dsP,
    group_concat(a3.vintage order by a3.vintage) as vintage,
    group_concat(a3.id order by a3.vintage) as vintage__ids,
    ifnull(group_concat(distinct ifnull(a5.ids__dsP, a4.id)), '') as region,
    ifnull(a1.co2, 0) as co2
  from $fti_gustos_db.gustos_wine as a1
    inner join $fti_gustos_db.gustos_wine_entity as a3 on a3.wine = a1.id
    left join $fti_gustos_db.region as a4 on a4.type <> 'COUNTRY' and a4.id = a3.region
    left join (
      select i1.wine_entity, count(distinct i3.id) as grape__cnt,
        group_concat(distinct i3.id order by i3.id) as grape__dsP
      from $fti_gustos_db.gustos_wine_grapes as i1
        left join nfc_expr_grap__arPD_link as i2 on i2.link__id = i1.grape
        left join nfc_expr__arP as i3 on i3.id = ifnull(i2.grap__id, i1.grape) and i3.expr__eS = $exGRAP
      where 1 <> 1
        or (p__arS > 0 and i1.wine = p__arS)
        or (p__arS = 0 and i1.wine > p__id)
      group by i1.wine_entity
      limit $FTI_WINE_BL_20000
    ) a2 on a2.wine_entity = a3.id
    left join nfc_expr_regi__arPD_span as a5 on a5.span__id = a4.id
  where 1 = 1
    and a1.name not regexp '\\\\(temp\\\\)|\\\\b(delet(e|)|удалить)\\\\b'
    and (1 <> 1
      or (p__arS > 0 and a1.id = p__arS)
      or (p__arS = 0 and a1.id > p__id)
    )
  group by a1.id, a1.name, a1.vineyard, a1.country, a1.color, a1.co2
  order by a1.id
  limit $FTI_WINE_BL_20000
  ");

  db_query("DROP PROCEDURE if exists nfc_expr_regi__arPD_span__asPL_create");
  db_query(
"CREATE PROCEDURE nfc_expr_regi__arPD_span__asPL_create()
BEGIN
  truncate nfc_expr_regi__arPD_span;
  insert into nfc_expr_regi__arPD_span
      (span__id, ids__dsP)
   select
      a1.id, cast(substring_index(max(a2.ids), '_cnt,', -1) as char(1024)) as ids
    from nfc_expr__arP as a1
      inner join (      
        select concat(count(distinct b1.id), '_cnt,', group_concat(distinct b1.id order by b1.id)) ids
        from nfc_expr__arP as b1
          left join nfc_expr__acPU_term as b2 on b2.expr__arP = b1.arP
          left join $fti_gustos_db.field_data_field_region_country as b3 on b3.entity_id = b1.id
        where b1.expr__eS = $exREGI and b3.entity_id is not null
        group by b3.field_region_country_target_id, b2.term__arP
        having count(*) > 1
      ) a2 on find_in_set(a1.id, a2.ids) > 0 and a1.expr__eS = $exREGI
    group by a1.id
  ;
END
  ");

  db_query(
"CREATE OR REPLACE VIEW nfc_expr__asVS_wine_parsedwine_normWID as 
  select
      t1.score__arS, t1.id,
      ifnull(t1.gustos_wine_id, 0) as gustos_wine_id, 
      ifnull(t1.grape__cnt, 0) as grape__cnt,
      ifnull(t1.grape, 0) as grape__dsP,
      replace(t1.name,
        if(char_length(t1.name) = 4, '',
            if(ifnull(t1.vint__year, 0) < 2,
                ifnull(t1.year,10000) - 1,
                if(length(t1.res) > 0 and cast(t1.res as int) >= 1970 and t1.res = ifnull(t1.vint__year, 0), t1.res, '')
            )
        ), ''
      ) as `name`,
      ifnull(t1.grape_type, '') as grape_type,
      t1.region, t1.country, t1.color, t1.co2, t1.vineyard, t1.status,
      if(ifnull(t1.vint__year, 0) < 2, ifnull(t1.year, 10000) - 1, t1.vint__year) as vintage
    from (
      select 
        a1.id, 
        regexp_substr(a1.name,'\\\\b(19|20)\\\\d\\\\d\\\\b') as res,
        a5.year as vint__year,
        a6.grape, a6.grape__cnt, a8.year, a1.name,
        ifnull(a9.id, '') as region, 
        ifnull(a1.country, 0) as country, ifnull(a1.color, 0) as color, ifnull(a1.co2, 0) as co2,
        ifnull(a1.winery, 0) as vineyard,
        a1.gustos_wine_id, a1.status, a5.grape_type, a2.score__arS
      from wine as a1
        inner join nfc_score__acSG_ids as a2 on a2.id = a1.id
        left join vintage as a5 on a5.wine_id = a1.id
        left join (
          select b1.vintage_id, count(distinct b1.grape_id) as grape__cnt,
            group_concat(distinct ifnull(b2.grap__id, b1.grape_id) order by ifnull(b2.grap__id, b1.grape_id)) as grape
          from vintage_grape as b1
            left join nfc_expr_grap__arPD_link as b2 on b2.link__id = b1.grape_id
          group by b1.vintage_id
        ) as a6 on a6.vintage_id = a5.id
        left join $fti_gustos_db.third_party_award as a7 on a7.id = a5.award
        left join $fti_gustos_db.third_party_event as a8 on a8.id = a7.event_id
        left join $fti_gustos_region_db.region as a9 on a9.id = a1.region
    ) as t1
  ");

  db_query("DROP FUNCTION if exists _norm_ii__asFL");
  db_query(
"CREATE FUNCTION _norm_ii__asFL(p__dsP varchar (256)) returns varchar(256)
BEGIN
  declare v__dsP varchar (256) default lower(p__dsP);
  declare v_in1 varchar (256) default 
    'ªºàáâãäåçèéêëìíîïðñòóôõöùúûüýÿāăąćĉċčďēĕėęěĝğġģĥħĩīĭįıĵķĸĺļľŀłńņňŉŋōŏőŕŗřśŝşšţťŧũūŭůűųŵŷźżžſǝșțơưầằềồờừỳảẩẳẻểỉỏổởủửỷẫẵẽễỗỡữỹấắếốớứạậặẹệịọộợụựỵɑǖǘǎǐǒǔǚǜ¡¢°ёȳ’´·''';
  declare v_out1 varchar (256) default 
    'aoaaaaaaceeeeiiiidnooooouuuuyyaaaccccdeeeeegggghhiiiiijkklllllnnnnnooorrrsssstttuuuuuuwyzzzsestouaaeoouyaaaeeiooouuyaaeeoouyaaeoouaaaeeiooouuyauuaiouuuicoеy````';
  declare v_in2 varchar (256) default 'ßþĳœ€£¼¹²³æøđ§';
  declare v_out2 varchar (256) default 'ssthijoeeubps4u1u2u3aeoedjpg';
  declare v_count int default char_length(v_in1);
  while v_count > 0 do
    set v__dsP = replace(v__dsP, substring(v_in1, v_count, 1), substring(v_out1, v_count, 1));
    set v_count = v_count - 1;
  end while;
  set v_count = char_length(v_in2) - 1;
  while v_count > 0 do
    set v__dsP = replace(v__dsP, substring(v_in2, v_count, 1), substring(v_out2, (v_count * 2) - 1, 2));
    set v_count = v_count - 1;
  end while;
  return v__dsP;
END
  ");

  db_query("DROP FUNCTION if exists _reg_word__asFL");
  db_query(
"CREATE FUNCTION _reg_word__asFL(p__dsP varchar (256)) returns integer
BEGIN
  declare v__arP int unsigned default (
    select seg_next from nfc_type_segments__arPD where segment__arP = (0x00000002+0) FOR UPDATE
  );  -- @fti_typ__word__arP = (0x00000002+0)
  update nfc_type_segments__arPD set seg_next = seg_next + 1 where segment__arP = (0x00000002+0);
  insert into nfc_word__arP (arP, dsP, len) values (v__arP, p__dsP, CHAR_LENGTH(p__dsP));
  return v__arP;
END
  ");

  $word_form__eB = $fti_var['word_form__eB'];
  $var_FTI_ARP_MAX = FTI_ARP_MAX;
  db_query("DROP FUNCTION if exists nfc_word__asFL_group_insert");
  db_query(
"CREATE FUNCTION nfc_word__asFL_group_insert(p_base__dsP varchar (256), p_form__dsP varchar (256)) returns int
BEGIN
  declare v_base__arP int unsigned default (SELECT (arP & $fti_seg_next) from nfc_word__arP where dsP = p_base__dsP);
  declare v_form__arP int unsigned default 0;
  declare v_word__eMT tinyint unsigned;
  declare v_max__arP bigint unsigned default (
    select max(arP) + $fti_seg_start
      from nfc_word__arP 
      where v_base__arP = (arP & $fti_seg_next)
  );
  declare v_msg varchar(4096);
  if v_max__arP >= $var_FTI_ARP_MAX then
    set v_msg = concat_ws('/','ErrFTI(nfc_synonym__asPL_insert__P_1_arP_Over) - maximum count(0x100000000) of forms achieved for key', 
      p_base__dsP, 'form', p_form__dsP, 'base__arP', v_base__arP, 'max__arP', v_max__arP)
    ;
    signal SQLSTATE '45000' SET MESSAGE_TEXT = v_msg;
  end if;
  SELECT arP, word__eMT into v_form__arP, v_word__eMT from nfc_word__arP where dsP = p_form__dsP;
  IF v_form__arP = 0 then
    set v_form__arP = _reg_word__asFL(p_form__dsP);
  end if;
  IF (v_word__eMT & $word_form__eB) > 0 then
    UPDATE nfc__arP
      set arP = v_max__arP
      where arP = v_form__arP
    ;
    update ignore nfc_term__arP as u1
      inner join (
        select term__arP as arP,
          group_concat(lpad(hex(word__arP & $fti_seg_next), 6, '0') order by el__id separator '') as dsP
        from nfc_term__acPU_word
        where word__arP = v_max__arP
        group by term__arP
      ) as u2 on u2.arP = u1.arP
      set u1.dsP = u2.dsP
    ;
  end if;
  return v_max__arP;
END
  ");

  db_query("DROP FUNCTION if exists _term__asFL_arP");
  db_query(
"CREATE FUNCTION _term__asFL_arP(p__dsP varchar (1024)) returns int
BEGIN
  declare v_term__arP int unsigned default 0;
  declare v_msg varchar(4096);
  set p__dsP = trim(p__dsP);
  with recursive Explode as (
    select 1 as _an_, p__dsP,
        cast(left(p__dsP, if(instr(p__dsP, ' ') > 0, instr(p__dsP, ' ') - 1, 10024)) as varchar(10024) collate utf8mb4_general_ci) as el,
        cast(substr(p__dsP, if(instr(p__dsP, ' ') > 0, instr(p__dsP, ' ') + 1, 10024), 10024) as varchar(10024)) as rest
    union all
      select _an_ + 1, p__dsP,
        left(rest,if(instr(rest, ' ') > 0, instr(rest, ' ') - 1, 10024)) as el,
        substr(rest, if(instr(rest, ' ') > 0, instr(rest, ' ') + 1, 10024), 10024) as rest
      from Explode where rest <> ''
  )
  select ifnull(b2.arP, 0) into v_term__arP
  from (
    select ifnull(min(t2.arP), 0) as t2_arP, group_concat(lpad(hex((ifnull(t2.arP, 0) & (0xFFFFFF+0))), 6, '0') separator '') as t2__dsP
      from Explode as t1
        left join nfc_word__arP as t2 on t2.dsP = el
      where el <> ''
      group by p__dsP
   ) as b1
     left join nfc_term__arP as b2 on b2.dsP = t2__dsP
  ;
  return v_term__arP;
end
  ");

  db_query("DROP PROCEDURE if exists nfc_word__asPL_group_delete");
  db_query(
"CREATE PROCEDURE nfc_word__asPL_group_delete(p_base__dsP varchar (256), p_form__dsP varchar (256), p_old__arP int unsigned)
BEGIN
  declare v_base__arP int unsigned default (SELECT arP from nfc_word__arP where dsP = p_base__dsP);
  declare v_form__arP int unsigned default (SELECT arP from nfc_word__arP where dsP = p_form__dsP);
  update nfc__arP
    set arP = p_old__arP
    where arP = v_form__arP
  ;
  update ignore nfc_term__arP as u1
    inner join (
      select term__arP as arP,
        group_concat(lpad(hex(word__arP & $fti_seg_next), 6, '0') order by el__id separator '') as dsP
      from nfc_term__acPU_word
      where word__arP = p_old__arP
      group by term__arP
    ) as u2 on u2.arP = u1.arP
    set u1.dsP = u2.dsP
  ;
END
  ");

  db_query("DROP FUNCTION if exists _term__asFL_dsP");
  db_query(
"CREATE FUNCTION _term__asFL_dsP(p_term__arP varchar(2048)) returns varchar(2048)
return (
  SELECT
  	  group_concat(val) as vals
  FROM (
    SELECT
      if (@fti_dbg > 0,
          concat_ws('/', term__arP, group_concat(t2.dsP order by t1.el__id separator ' ')),
          group_concat(t2.dsP order by t1.el__id separator ' ')
      ) as val
    from nfc_term__acPU_word as t1
      left join nfc_word__arP as t2 on t2.arP = t1.word__arP
    where FIND_IN_SET(term__arP, p_term__arP) > 0
    group by term__arP
  ) as a1
)
  ");

  db_query("DROP FUNCTION if exists _word__asFL");
  db_query(
"CREATE FUNCTION _word__asFL(p_word__arPA varbinary(1024)) returns varchar(2048)
BEGIN
  declare v_ret varchar(2048) default '';  
  declare v_word__cnt int default length(regexp_replace(p_word__arPA, '[^,]', '')) + 1;
  if p_word__arPA <> '' then
    while v_word__cnt > 0 DO
      select concat(v_ret, ' ', dsP) into  v_ret
        from nfc_word__arP
        where arP = substring_index(substring_index(p_word__arPA, ',', -v_word__cnt), ',', 1)
      ;
      set v_word__cnt = v_word__cnt - 1;
    END WHILE;
  end if;
  return ltrim(v_ret);
END
  ");

  $syGroupAttrType = $fti_var['syGroupAttrType'];
  db_query("DROP FUNCTION if exists _attr__asFL");
  db_query(
"CREATE FUNCTION _attr__asFL(p_attr__arS bigint unsigned) RETURNS varchar(2048) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
return (
    SELECT 
      concat_ws(',',
        if(t1.REGI__arSD = 0, '',
          concat(left(t21.dsP, 2),
            if((t2.attr__eSI & $syGroupAttrType) > 0, 'P', 'L'),
            '(', _term__asFL_dsP(t22.term__arP), ')'
          )
        ),
        if(t1.VINE__arSD = 0, '',
          concat(left(t31.dsP, 2),
            if((t3.attr__eSI & $syGroupAttrType) > 0, 'P', 'L'),
            '(', _term__asFL_dsP(t32.term__arP), ')'
          )
        ),
        if(t1.WINE__arSD = 0, '',
          concat(left(t41.dsP, 2),
            if((t4.attr__eSI & $syGroupAttrType) > 0, 'P', 'L'),
            '(', _term__asFL_dsP(t42.term__arP), ')'
          )
        )
      ) as val
    from nfc_expr_attr__arS as t1
      left join nfc_expr_attr__arSD as t2 on t2.arSD = t1.REGI__arSD
      left join nfc_expr_attr__arSD as t3 on t3.arSD = t1.VINE__arSD
      left join nfc_expr_attr__arSD as t4 on t4.arSD = t1.WINE__arSD
      left join nfc_type__arP as t21 on t21.val = t2.attr__eSI
      left join nfc_type__arP as t31 on t31.val = t3.attr__eSI
      left join nfc_type__arP as t41 on t41.val = t4.attr__eSI
      left join nfc_expr__acPU_term as t22 on t22.expr__arP = t2.expr__arP and t22.el__id = 0
      left join nfc_expr__acPU_term as t32 on t32.expr__arP = t3.expr__arP and t32.el__id = 0
      left join nfc_expr__acPU_term as t42 on t42.expr__arP = t4.expr__arP and t42.el__id = 0
    where 1=1
      and t1.arS = p_attr__arS
      and t21.description like 'expr__eS%'
      and t31.description like 'expr__eS%'
      and t41.description like 'expr__eS%'
)
  ");

  db_query("DROP FUNCTION if exists _syTerm__asFL");
  db_query(
"CREATE FUNCTION _syTerm__asFL(p_term__arP int) returns varchar(2048)
  return (
    SELECT 
      group_concat(_term__asFL_dsP(t1.arP) order by t1.arP separator '/')
    from nfc_term__arP as t1
    where (t1.arP & $fti_seg_next) = (p_term__arP & $fti_seg_next)
  )
  ");

  db_query("DROP FUNCTION if exists _acI__asFL");
  db_query(
"CREATE FUNCTION _acI__asFL(p_expr__arP int) returns varchar(2048)
  return (
    SELECT 
      concat_ws('/',
        group_concat(t2.dsP separator ' '),
        if (@fti_dbg > 0, group_concat(concat(hex(t2.arP),':',t2.arP) separator '/'), '')
      ) as val
    from nfc__acPU as t1
      left join nfc_word__arP as t2 on t2.arP = t1.child__arP
    where parrent__arP = p_expr__arP
  )
  ");

  db_query("DROP FUNCTION if exists _wine__asFL");
  db_query(
"CREATE FUNCTION _wine__asFL(p__id int unsigned, p__arP int unsigned) RETURNS varchar(2096) CHARSET utf8mb4
BEGIN
  declare v__dsP varchar(4096);
  declare v__arP, v__id int unsigned default 0;
  select arP into v__arP from nfc_expr_wine__arPD where arP = p__arP or wine = p__id;
  if p__id = 0 THEN
    if v__arP = 0 then
      set v__dsP = concat_ws('/', 'Error p__id', p__id, ' or p__arP', p__arP, '! Wine not found.', v__id, v__arP);
      signal SQLSTATE '45000' SET MESSAGE_TEXT = v__dsP; 
    end if;
  end if;
  select concat_ws('/', 'GWine', t2.name, 'PWine', group_concat(t4.dsP separator ' '))
    into v__dsP
    from nfc_expr_wine__arPD as t1
      left join $fti_gustos_db.gustos_wine as t2 on t2.id = t1.wine 
      left join nfc__acPU_wine as  t3 on t3.parrent__arP = t1.arP
      left join nfc_word__arP as t4 on t4.arP = t3.child__arP
    where t1.arP = v__arP
    group by t1.arP, t2.name
  ;
  return v__dsP;
END
  ");

  db_query("DROP FUNCTION if exists _xName__asFL");
  db_query(
"CREATE FUNCTION _xName__asFL(p_upd__dsP varchar(8), p__id int unsigned) RETURNS varchar(9192) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
  declare v__dsP varchar(9192);
  declare v__arP, v__id int unsigned default 0;
  if p_upd__dsP = 'wine' then
    select arP into v__arP from nfc_expr_wine__arPD where wine = p__id;
    if v__arP = 0 then
      set v__dsP = concat('Error p__id(', p__id, ')! Wine not found.');
      signal SQLSTATE '45000' SET MESSAGE_TEXT = v__dsP; 
    end if;
    select concat_ws(' ', '#GW#', t2.name, '#PW#', group_concat(t4.dsP separator ' '))
      into v__dsP
      from nfc_expr_wine__arPD as t1
        left join $fti_gustos_db.gustos_wine as t2 on t2.id = t1.wine 
        left join nfc__acPU_wine as t3 on t3.parrent__arP = t1.arP
        left join nfc_word__arP as t4 on t4.arP = t3.child__arP
      where t1.arP = v__arP
      group by t1.arP, t2.name
    ;
  else
    select _tName__asFL(p_upd__dsP, p__id) into v__dsP;
  end if;
  return v__dsP;
END
  ");

  db_query("DROP FUNCTION if exists _expr__asFL");
  db_query(
"CREATE FUNCTION _expr__asFL(p__arP int) RETURNS varchar(9192) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
  return (
    select group_concat(_term__asFL_dsP(t1.term__arP) order by t1.el__id)
    from nfc_expr__acPU_term as t1
    where t1.expr__arP = p__arP
  )
  ");

  db_query("DROP FUNCTION if exists _tName__asFL");
  db_query(
"CREATE FUNCTION _tName__asFL(p_upd__dsP varchar(8), p__id int unsigned) RETURNS varchar(9192) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
  declare v__dsP varchar(9192);
  declare v__arP, v__id int unsigned default 0;
  if (p__id is null) then
    return '### NULL ###';
  end if;
  case p_upd__dsP
    when 'wine' then begin
      select arP into v__arP from nfc_expr_wine__arPD where wine = p__id;
      if v__arP = 0 then
        set v__dsP = concat('Error p__id(', p__id, ')! Wine not found.');
        signal SQLSTATE '45000' SET MESSAGE_TEXT = v__dsP; 
      end if;
      select concat_ws(' ', '#GW#', t2.name, '#PW#', _expr__asFL(t1.arP))
        into v__dsP
        from nfc_expr_wine__arPD as t1
          left join $fti_gustos_db.gustos_wine as t2 on t2.id = t1.wine
        where t1.arP = v__arP
      ;
    end;
    when 'vineyard' then begin
      select arP into v__arP from nfc_expr__arP where id = p__id and expr__eS = $exVINE;
      if v__arP = 0 then
        set v__dsP = concat('Error p__id(', p__id, ')! Vineyard not found.');
        signal SQLSTATE '45000' SET MESSAGE_TEXT = v__dsP; 
      end if;
      select concat_ws(' ', '#GV#', t2.name, '#PV#', _expr__asFL(t1.arP))
        into v__dsP
        from nfc_expr__arP as t1
          left join $fti_gustos_db.vineyard as t2 on t2.id = t1.id
        where t1.arP = v__arP
      ;
    end;
    when 'region' then begin
      select arP into v__arP from nfc_expr__arP where id = p__id and expr__eS = $exREGI;
      if v__arP = 0 then
        set v__dsP = concat('Error p__id(', p__id, ')! Region not found.');
        signal SQLSTATE '45000' SET MESSAGE_TEXT = v__dsP; 
      end if;
      select concat_ws(' ', '#GR#', t2.name, '#PR#', _expr__asFL(t1.arP))
        into v__dsP
        from nfc_expr__arP as t1
          left join $fti_gustos_region_db.region as t2 on t2.id = t1.id
        where t1.arP = v__arP
      ;
    end;
    when 'grape' then begin
      select arP into v__arP from nfc_expr__arP where id = p__id and expr__eS = $exGRAP;
      if v__arP = 0 then
        set v__dsP = concat('Error p__id(', p__id, ')! Grape not found.');
        signal SQLSTATE '45000' SET MESSAGE_TEXT = v__dsP; 
      end if;
      select concat_ws(' ', '#GG#', t2.name, '#PG#', group_concat(_term__asFL_dsP(t4.arP) order by t4.arP separator ' / '))
        into v__dsP
        from nfc_expr__arP as t1
          left join $fti_gustos_region_db.region as t2 on t2.id = t1.id
          left join nfc_expr__acPU_term as t3 on t3.expr__arP = t1.arP
          left join nfc_term__arP as t4 on (t4.arP & $fti_seg_next) = t3.term__arP
        where 1=1
          and t1.arP = v__arP
          and t1.expr__eS = $exGRAP
        group by t1.arP, t2.name
      ;
    end;
    else begin
      set v__dsP = concat('Error p_upd__dsP(', p_upd__dsP, ')! Must one from (wine,vineyard,region,grape).');
      signal SQLSTATE '45000' SET MESSAGE_TEXT = v__dsP; 
    end;
  end case;
  return v__dsP;
END
  ");

  db_query("DROP FUNCTION if exists _sNs__asFL");
  db_query(
"CREATE FUNCTION _sNs__asFL(p1__dsP varchar(10024), p2__dsP varchar(10024)) returns int
BEGIN
-- _sNs__asFL - Set_iN_Set - search all elements from p1__dsP comma separated set like '1,5,6' in target p2__dsP comma separated set
-- return - 0 if not found
  declare v_ret int;
  with recursive Explode as (
    select 1 as _an_,
        cast(left(p1__dsP, if(instr(p1__dsP, ',') > 0, instr(p1__dsP, ',') - 1, 10024)) as varchar(10024) collate utf8mb4_general_ci) as el,
        cast(substr(p1__dsP, if(instr(p1__dsP, ',') > 0, instr(p1__dsP, ',') + 1, 10024), 10024) as varchar(10024)) as rest
    union all
      select _an_ + 1,
        left(rest,if(instr(rest, ',') > 0, instr(rest, ',') - 1, 10024)) as el,
        substr(rest, if(instr(rest, ',') > 0, instr(rest, ',') + 1, 10024), 10024) as rest
      from Explode where rest <> ''
  )
  select sum(if(find_in_set(el, p2__dsP) > 0, 1, 0)) into v_ret
    from Explode 
    where el <> ''
  ;
  return v_ret;
END
  ");

  db_query("DROP FUNCTION if exists _s2w__asFL");
  db_query(
"CREATE FUNCTION _s2w__asFL(p1__dsP varchar(10024) collate utf8mb4_general_ci) RETURNS varchar(10024)  collate utf8mb4_general_ci
BEGIN
-- _s2w__asFL - Set_To_Words - explode ids set then implode as words set
-- return - 0 if not found
  declare v_ret varchar(10024);
  with recursive Explode as (
    select 1 as _an_,
        cast(left(p1__dsP, if(instr(p1__dsP, ',') > 0, instr(p1__dsP, ',') - 1, 10024)) as varchar(10024) collate utf8mb4_general_ci) as el,
        cast(substr(p1__dsP, if(instr(p1__dsP, ',') > 0, instr(p1__dsP, ',') + 1, 10024), 10024) as varchar(10024)) as rest
    union all
      select _an_ + 1,
        left(rest,if(instr(rest, ',') > 0, instr(rest, ',') - 1, 10024)) as el,
        substr(rest, if(instr(rest, ',') > 0, instr(rest, ',') + 1, 10024), 10024) as rest
      from Explode where rest <> ''
  )
  select group_concat(t2.dsP separator ' ') into v_ret
    from Explode as t1
      left join nfc_word__arP as t2 on t2.arP = t1.el
    where el <> ''
  ;
  return v_ret;
END"
  );

  db_query("DROP PROCEDURE if exists _iName__asPL");
  db_query(
"CREATE PROCEDURE _iName__asPL(p_upd__dsP varchar(8), p__ids varbinary(1024))
BEGIN
  declare v__dsP varchar(4096);
  declare v__ids varchar(1024) default replace(p__ids, ' ', '');
  case p_upd__dsP
    when 'wine' then begin
      select
          t2.id, t2.name as GW_Name, _expr__asFL(t1.arP) as PW_Name, t1.vineyard as vy_id, t5.name as vy_Name, t1.grape__dsP, 
          group_concat(DISTINCT t4.name order by t4.tid separator ' # ') as grape_Names, t1.region__dsP,
          group_concat(DISTINCT t7.name separator ' / ') as region_Names,
          t1.color as color_tid, t8.name as color_Name, t1.co2 as co2_tid, t9.name as CO2_Name, t1.country, tB.name as CName,
          t1.word__cnt as all_cnt, tA.word__cnt, t1.vintage__dsP
        from nfc_expr_wine__arPD as t1
          left join $fti_gustos_db.gustos_wine as t2 on t2.id = t1.wine
          left join $fti_gustos_db.gustos_wine_grapes as t3 on t3.wine = t1.wine
          left join nfc_expr_grap__arPD_link as t30 on t30.link__id = t3.grape
          left join $fti_gustos_db.taxonomy_term_data as t4 on t4.tid = ifnull(t30.grap__id, t3.grape)
          left join $fti_gustos_db.vineyard as t5 on t5.id = t1.vineyard
          left join $fti_gustos_db.gustos_wine_entity as t6 on t6.wine = t2.id
          left join $fti_gustos_db.taxonomy_term_data as t7 on t7.tid = t6.region
          left join $fti_gustos_db.taxonomy_term_data as t8 on t8.tid = t1.color
          left join $fti_gustos_db.taxonomy_term_data as t9 on t9.tid = t1.co2
          left join nfc_expr__arP as tA on tA.arP = t1.arP
          left join $fti_gustos_db.taxonomy_term_data as tB on tB.tid = t1.country
        where concat(',', v__ids, ',') like concat('%,', t1.wine, ',%')
        group by t2.id, t2.name, t1.arP, t1.vineyard, t5.name, t1.grape__dsP, t1.region__dsP, t1.color, t8.name, t1.co2, t9.name,
          t1.country, tB.name, t1.word__cnt, tA.word__cnt, t1.vintage__dsP
        order by t1.vineyard, t2.Name
      ;
    end;
    when 'vineyard' then begin
      SET @@max_sp_recursion_depth = 100;
      call _iName__asPL('wine', (
          select group_concat(t4.wine)
            from nfc_expr__arP as t1
              left join nfc_expr_wine__arPD as t4 on t4.vineyard = t1.id
            where 1=1
              and concat(',', v__ids, ',') like concat('%,', t1.id, ',%')
              and t1.expr__eS = $exVINE
       ));
    end;
    else begin
      set v__dsP = concat('Error p_upd__dsP(', p_upd__dsP, ')! Must one from (wine,vineyard).');
      signal SQLSTATE '45000' SET MESSAGE_TEXT = v__dsP; 
    end;
  end case;
END"
  );

  db_query("CREATE or REPLACE PROCEDURE nfc_expr__asPS_terms()
select b1.dsP,
  a1.arP, a1.next__id AS term_cnt,
  a1.new__id, a1.id, a2.el__id,
  case b1.dsP
    when 'exVINE' then concat_ws(' < ', v1.name, v2.path)
    when 'exREGI' then r1.name
    when 'exGRAP' then g1.name
    else 'bad expr__eS'
  end AS name,
  a3.next__id AS word_cnt,
  _term__asFL_dsP(a3.arP) AS term
from nfc_expr__arP a1
  left join nfc_expr__acPU_term a2 on a2.expr__arP = a1.arP
  left join nfc_term__arP a3 on a3.arP = a2.term__arP
  left join nfc_type__arP b1 on b1.val = a1.expr__eS
  left join $fti_gustos_db.vineyard v1 on v1.id = a1.id
  left join $fti_gustos_region_db.region as v2 on v2.id = v1.country
  left join $fti_gustos_region_db.region as r1 on r1.id = a1.id
  left join $fti_gustos_db.taxonomy_term_data g1 on g1.tid = a1.id
where 1 = 1
  and b1.dsP in ('exVINE','exREGI','exGRAP')
order by b1.dsP, a1.arP,a2.el__id"
  );

  db_query("DROP PROCEDURE if exists nfc_attr__asPL_term_load");
  db_query(
"CREATE PROCEDURE nfc_attr__asPL_term_load()
  SELECT t1.arSD, t1.attr__eSI as a_int, t1.attr__eMB as a_mask, t2.term__arP
    from nfc_expr_attr__arSD as t1
      left join nfc_expr__acPU_term as t2 on t2.expr__arP = t1.expr__arP
    where 1=1
      and t1.arSD > 0
      and t2.el__id = 0
"
  );
  
  db_query("DROP PROCEDURE if exists nfc_attr__asPL_term_init");
  db_query(
"CREATE PROCEDURE nfc_attr__asPL_term_init()
  SELECT min(t1.arS) as arS, t1.attr__dsP, group_concat(t1.attr__dsPG order by t1.arS) as attr__dsPG
    from (" . $fti_sq['init_attr'] . ") as t1
    where t1.arS > 0
    group by t1.attr__dsP
    order by arS
"
  );

  db_query("DROP PROCEDURE if exists nfc_attr__asPL_load");
  db_query(
"CREATE PROCEDURE nfc_attr__asPL_load()
  SELECT
  		(t1.REGI__arSD << 32) + (t1.VINE__arSD << 16) + t1.WINE__arSD as attr__acSD,
  		t1.arS,
  		concat_ws(',', nullif(t2.term__arP, 0), nullif(t3.term__arP, 0), nullif(t4.term__arP, 0)) as attr__arSD
    from nfc_expr_attr__arS as t1
    	left join nfc_expr_attr__arSD as t21 on t21.arSD = t1.REGI__arSD
    	left join nfc_expr_attr__arSD as t31 on t31.arSD = t1.VINE__arSD
    	left join nfc_expr_attr__arSD as t41 on t41.arSD = t1.WINE__arSD
      left join nfc_expr__acPU_term as t2 on t2.expr__arP = t21.expr__arP and t2.el__id = 0
      left join nfc_expr__acPU_term as t3 on t3.expr__arP = t31.expr__arP and t3.el__id = 0
      left join nfc_expr__acPU_term as t4 on t4.expr__arP = t41.expr__arP and t4.el__id = 0
    where (t1.REGI__arSD + t1.VINE__arSD + t1.WINE__arSD) > 1
"
  );

  db_query("DROP PROCEDURE if exists nfc_rule__arS__asPL_load");
  db_query(
"CREATE PROCEDURE nfc_rule__arS__asPL_load()
    SELECT
        t1.arS, t2.acSG, t1.rule__eMI, t1.when__eMI, t1.column__eN,
        ifnull(t3.arP, 0) as term__arP, ifnull(t3.dsP, '') as term__dsP,
        t4.expr__eS as key__eMI, t4.id as key__id, t4.arP as key__arP
      from nfc_rule__arS as t1
        left join nfc_rule__acSG_term_expr as t2 on t2.rule__arS = t1.arS
        left join nfc_term__arP as t3 on t3.arP = t2.whenTerm__arP
        left join nfc_expr__arP as t4 on t4.arP = t2.keyExpr__arP
      where t2.rule__arS is not null
"
  );

  db_query("DROP PROCEDURE if exists nfc_rule__arS__asPL_init");
  db_query(
"CREATE PROCEDURE nfc_rule__arS__asPL_init()
    SELECT t1.rule__dsP, t1.rule__eMI, t1.column__dsP, t1.rule_whenKEY__dsP, t1.when__eMI, t1.key__eMI
      from (
        SELECT '' as rule__dsP, 0 as rule__eMI, '' as column__dsP, '' as rule_whenKEY__dsP, 0 as when__eMI, 0 as key__eMI
      union all values
          ('exREGI_exTARA_exTARA', $syGroupRV, 'countries', 'romania/moldova', $exTARA, $exTARA),
          ('exREGI_exTARA_exTARA', $syGroupRV, 'countries', 'us/jersey', $exTARA, $exTARA),
          ('exREGI_exTARA_exTARA', $syGroupRV, 'countries', 'us/mexico', $exTARA, $exTARA),
          ('exREGI_exTARA_exTARA', $syGroupRV, 'countries', 'us/georgia', $exTARA, $exTARA),
          ('exREGI_exTARA_exTARA', $syGroupRV, 'countries', 'us/colombia', $exTARA, $exTARA),
          ('exREGI_exTARA_exTARA', $syGroupRV, 'countries', 'serbia/kosovo', $exTARA, $exTARA),
          ('exREGI_exTARA_exTARA', $syGroupRV, 'countries', 'canada/british', $exTARA, $exTARA),
          ('exREGI_exTARA_exTARA', $syGroupRV, 'countries', 'canada/colombia', $exTARA, $exTARA),
          ('exREGI_exTARA_exTARA', $syGroupRV, 'countries', 'switzerland/german', $exTARA, $exTARA),
          ('exREGI_exREGI_exTARA_dups', $exREGI, 'countries', 'east anglia/uk', 0, $exTARA)
      ) as t1
        where t1.rule__dsP <> ''
"
  );

  db_query("DROP PROCEDURE if exists nfc_expr__asPL_term_syn_load");
  db_query(
"CREATE PROCEDURE nfc_expr__asPL_term_syn_load(p_expr__eS int unsigned)
SELECT t2.expr__arP, t1.expr__eS, t2.el__id, t2.term__arP
  from nfc_expr__arP as t1
    left join nfc_expr__acPU_term as t2 on t2.expr__arP = t1.arP
  where 1=1
    and (t1.expr__eS & p_expr__eS) = p_expr__eS
    and t2.el__id > 0
  order by t2.expr__arP, t2.el__id desc
"
  );

  db_query("DROP PROCEDURE if exists nfc_expr__asFL_term_syn_count");
  db_query(
"CREATE FUNCTION nfc_expr__asFL_term_syn_count(p_expr__eS int unsigned) returns int
RETURN (
  SELECT COUNT(*)
    from nfc_expr__arP as t1
      left join nfc_expr__acPU_term as t2 on (t2.expr__arP & $fti_seg_next) = t1.arP
    where 1=1
      and t2.expr__arP > $fti_seg_next
      and t1.expr__eS = p_expr__eS
      and t2.expr__arP is not null
)"
  );

  db_query("DROP PROCEDURE if exists nfc_expr__asPL_syn_load");
  db_query(
"CREATE PROCEDURE nfc_expr__asPL_syn_load(p_expr__eS int unsigned)
SELECT
    t1.arP, t2.term__arP, ifnull(t3.link__eMI, 0) as link__eMI
  from nfc_expr__arP as t1
    left join nfc_expr__acPU_term as t2 on (t2.expr__arP & $fti_seg_next)= t1.arP
    left join nfc_expr__acPG_term as t3 on t3.expr__arP = t1.arP and t3.term__arP = t2.term__arP
  where 1=1
    and t1.expr__eS = p_expr__eS
    and t2.expr__arP > $fti_seg_next
"
  );

  db_query(
"CREATE OR REPLACE VIEW nfc_expr__asVS_regi_load_all as
SELECT distinct
    ifnull(t1.arP, 0) as expr__arP,
    t2.id, ifnull(t1.expr__eMI, 0) as expr__eMI,
    ifnull(t3.term__arP, ifnull(t1.chiTerm__arP, 0)) as chiTerm__arP,
    ifnull(t1.parExpr__arP, 0) as parExpr__arP,
    concat(SUBSTRING_INDEX(t2.path, ' > ', LENGTH(t2.path) - LENGTH(REPLACE(t2.path, '>', ''))),
       if(t6.field_region_country_target_id is null, '', ' > '), group_concat(a5.dsP order by a4.el__id separator ' ')
    ) as `path`,
    ifnull(t1.attrTYPE__arS, 0) as attrTYPE__arS,
    ifnull(t1.attrTITLE__arS, 0) as attrTITLE__arS,
    ifnull(t1.next__id, 0) as next__id,
    ifnull(t1.new__id, 0) as new__id,
    ifnull(t6.field_region_country_target_id, 0) as country,
    ifnull(t7.regi__id, 0) as to_link__id,
    t2.level as lvl
  FROM $fti_gustos_region_db.region as t2
    left join nfc_expr__arP as t1 on t2.id = t1.id and t1.expr__eS in ($exREGI, $exTARA)
    left join nfc_expr__acPU_term as t3 on t3.expr__arP = t1.arP
    left join nfc_term__acPU_word as a4 on a4.term__arP = t3.term__arP
    left join nfc_word__arP as a5 on a5.arP = a4.word__arP
    left join $fti_gustos_db.field_data_field_region_country as t6 on t6.entity_id = t1.id
    left join nfc_expr_regi__arPD_link as t7 on t7.link__id = t2.id
  where t2.type <> 'CONTINENT'
  group by
      t1.arP, t2.id, t2.level, t1.expr__eMI, t3.term__arP, t1.parExpr__arP, t2.path, t1.new__id, t1.chiTerm__arP,
      t1.attrTYPE__arS, t1.attrTITLE__arS,t1.next__id,t6.field_region_country_target_id,t7.regi__id
"
  );

  db_query(
"CREATE OR REPLACE VIEW nfc_expr__asVS_regi_load as 
SELECT
    ifnull(t1.arP, 0) as expr__arP,
    t2.id, ifnull(t1.expr__eMI, 0) as expr__eMI,
    ifnull(t1.chiTerm__arP, 0) as chiTerm__arP,
    ifnull(t1.parExpr__arP, 0) as parExpr__arP,
    t2.path,
    ifnull(t1.attrTYPE__arS, 0) as attrTYPE__arS,
    ifnull(t1.attrTITLE__arS, 0) as attrTITLE__arS,
    ifnull(t1.next__id, 0) as next__id,
    ifnull(t1.new__id, 0) as new__id,
    ifnull(t6.field_region_country_target_id, 0) as country,
    ifnull(t7.regi__id, 0) as to_link__id,
    t2.level as lvl
  FROM $fti_gustos_region_db.region as t2
    left join nfc_expr__arP as t1 on t2.id = t1.id and t1.expr__eS in ($exREGI, $exTARA)
    left join $fti_gustos_db.field_data_field_region_country as t6 on t6.entity_id = t1.id
    left join nfc_expr_regi__arPD_link as t7 on t7.link__id = t2.id
  where t2.type <> 'CONTINENT'
"
  );

  db_query(
"CREATE OR REPLACE VIEW nfc_expr__asVS_vine_load as
SELECT
    t1.arP as expr__arP,
    t1.id, t1.expr__eMI,
    t1.chiTerm__arP,
    t1.parExpr__arP,
    t1.attrTYPE__arS,
    t1.attrTITLE__arS,
    t1.next__id,
    t1.new__id,
    concat_ws(',', nullif(t6.countries, ''), nullif(t7.countries, '')) as countries,
    t6.wines__cnt,
    ifnull(t7.vine__id, 0) as to_link__id,
    ifnull(t8.vine__id, 0) as to_dups__id
  FROM nfc_expr_vine__arPD as t6
    left join nfc_expr__arP as t1 on t6.vine__arP = t1.arP
    left join nfc_expr_vine__arPD_link as t7 on t7.link__id = t1.id
    left join nfc_expr_vine__arPD_dups as t8 on t8.dups__id = t1.id
  ");

  db_query(
"CREATE or replace VIEW nfc_score__acSG_wine__asVS as 
SELECT a1.score__arS, a1.acSG, a1.pw_vintage,
	concat_ws('/', a2.id, a2.name, a2.winery, a21.name, a22.id, a22.name) pw_name,
	a1.score__niBO, a1.limit__niBQ,
	concat_ws('/', a3.id, a3.name, a31.id, a31.name, a32.regi__dsP, a33.name) gw_name,
	a1.gwe_vintage, a1.action__dsP, a1.pw_wine, a1.gw_wine
FROM nfc_score__acSG_wine as a1
  left join wine as a2 on a2.id = a1.pw_wine 
  left join $fti_gustos_db.gustos_wine as a3 on a3.id = a1.gw_wine
  left join $fti_gustos_db.vineyard as a21 on a21.id = a2.winery 
  left join $fti_gustos_region_db.region as a22 on a22.id = a2.region
  left join nfc_expr_wine__arPD as a32 on a32.wine = a1.gw_wine
  left join $fti_gustos_db.vineyard as a31 on a31.id = a32.vineyard
  left join $fti_gustos_region_db.region as a33 on a33.id = a32.regi__dsP"
);
  
  db_query(
"CREATE OR REPLACE PROCEDURE nfc_expr__asPS_vine_link_primary()
  SELECT
    (select count(*)
      from $fti_gustos_db.gustos_wine as i1
        left join $fti_gustos_db.gustos_wine_entity as i2 on i2.wine = i1.id
      where i1.vineyard = t2.id
    ) as link__wines,
    a2.path as link__country,
    t2.id as link__id, t2.name as link__name,
    t3.id, t3.name,
    a3.path as country,
    (select count(*)
      from $fti_gustos_db.gustos_wine as b1
        left join $fti_gustos_db.gustos_wine_entity as b2 on b2.wine = b1.id
      where b1.vineyard = t3.id
    ) as wines
  FROM nfc_expr_vine__arPD_link t1
    left join $fti_gustos_db.vineyard t2 on t2.id = t1.link__id 
    left join $fti_gustos_db.vineyard t3 on t3.id = t1.vine__id
    left join $fti_gustos_region_db.region as a2 on a2.id = t2.country
    left join $fti_gustos_region_db.region as a3 on a3.id = t3.country
  order by trim(t3.name), country
  ");

  db_query(
"CREATE OR REPLACE PROCEDURE nfc_expr__asPS_vine_link_second()
SELECT count(*) cnt, term__dsP, min(t1.id) vy_id, min(t3.name) vy_name, min(t4.id) as link__id, min(t4.name) as link__name
FROM nfc_expr__arP as t1
  left join nfc_expr__acPU_term as t2 on t2.expr__arP = t1.arP
  left join $fti_gustos_db.vineyard as t3 on t3.id = t1.id
  left join (
    select a2.term__arP, a1.id, a3.name, _term__asFL_dsP(a2.term__arP) as term__dsP
    FROM nfc_expr__arP as a1
      left join nfc_expr__acPU_term as a2 on a2.expr__arP = a1.arP
      left join $fti_gustos_db.vineyard as a3 on a3.id = a1.id
    where 1=1
      and a1.expr__eS = $exVINE
      and a2.el__id > 0  	
  ) as t4 on t4.term__arP = t2.term__arP
  left join nfc_expr__acPU_term as t51 on t51.term__arP = t2.term__arP
  left join nfc_expr_attr__arSD as t5 on t5.expr__arP = t51.expr__arP
  left join nfc_expr__arP as t6 on t6.chiTerm__arP = t2.term__arP and t6.expr__eS = 524288016 -- $exTARA
where 1=1
  and t1.expr__eS = $exVINE
  and t2.el__id > 0
  and t1.id <> t4.id
  and t5.arSD is null
  and t1.id < t4.id
  and t6.arP is null
group by term__dsP
  ");

  db_query(
  "CREATE OR REPLACE PROCEDURE nfc_expr__asPS_vine_syn_parsedwine_main()
    SELECT DISTINCT 
        t1.id, t1.chiTerm__arP, ifnull(t2.country, '') as countries, _term__asFL_dsP(t1.chiTerm__arP) as term__dsP
      from rule r
        left join nfc_expr__arP as t1 on t1.id = r.value
        left join $fti_gustos_db.vineyard as t2 on t2.id = t1.id
      where 1=1
        and r.property = 'vineyard'
        and t1.expr__eS = $exVINE
        and t1.id is not null
  ");

  $pref1 = '\\\\b' . FTI_PREFIX; 
  db_query(
  "CREATE OR REPLACE VIEW nfc_tables__asVS as    
SELECT TABLE_NAME as `name`
 from information_schema.TABLES
 where 1=1
   and TABLE_SCHEMA = 'parsedwine'
   and TABLE_NAME regexp '$pref1'
   and TABLE_TYPE = 'BASE TABLE'
   and TABLE_NAME not regexp 'LOG'
  ");

  db_query(
  "CREATE OR REPLACE VIEW nfc_blend__asVS as 
SELECT t1.blend__arS, GROUP_CONCAT(t2.name separator ' , ') name
  FROM nfc_expr_grap__acSG_blend as t1
    left join $fti_gustos_db.taxonomy_term_data as t2 on t2.tid = t1.grap__id 
  group by t1.blend__arS 
  ");
  nfc_term__asPL_create();
}

function nfc_term__asPL_create() {
  global $fti_var;
  $v_FTI_MASK__CLASS = FTI_MASK__CLASS;
  $v_FTI_WINE = FTI_WINE;
  $syGroupMT = $fti_var['syGroupMT'];
  $attr_last = db_query("SELECT max(arSD) FROM nfc_expr_attr__arSD where BIT_COUNT(attr__eMB) = 1")->fetchColumn() ?? 10000;
  db_query("CREATE OR REPLACE PROCEDURE nfc_term__asPL_load()
    SELECT
        t3.term__arP, t3.el__id, t1.id as term__id, t4.dsP, t4.rang, (t1.expr__eS & $v_FTI_MASK__CLASS) as rank,
        t1.expr__eS as term__typ,
        t3.expr__arP,
        t1.arP as id__arP,
        ifnull(t1.parExpr__arP, 0) as par__arP,
        t1.chiTerm__arP, t1.new__id, t1.countries
      from nfc_expr__acPU_term as t3
        inner join nfc_expr__arP as t1 on t3.expr__arP = t1.arP
        left join nfc_term__arP as t4 on t4.arP = t3.term__arP
        left join nfc_term__arPD_exclude_log as t6 on t6.term__arP = t4.arP
      where 1 = 1
        and t4.len > 1
        and t1.expr__eS & $v_FTI_WINE = 0
        and (1 <> 1
          or t6.term__arP is null
          or t6.expr__eN < t1.expr__eS & $syGroupMT
        )
  union all
    select
        c2.term__arP, c2.el__id, c1.attr__eMB as term__id, c3.dsP, c3.rang, 0 as rank,
        c1.attr__eSI as term__typ, c1.arSD as expr__arP, c1.expr__arP as id__arP,
        0 as par__arP, c3.arP as chiTerm__arP, 0 as new__id, '' as countries
      from nfc_expr_attr__arSD as c1
        left join nfc_expr__acPU_term as c2 on c2.expr__arP = c1.expr__arP
        left join nfc_term__arP as c3 on c2.term__arP = c3.arP
      where c1.arSD between 1 and $attr_last
    order by rang desc, rank, el__id
"
  );
  db_query("CREATE OR REPLACE VIEW _attr__asVL as
SELECT b1.attr__eSI, b1.dsP, b1.arSD, group_concat(b1.term__dsP order by b1.el__id separator ' / ') terms__dsP, b1.attr__eMB
FROM (
  SELECT a1.arSD, a1.attr__eSI, a2.dsP, 
    concat(a3.el__id, ':', group_concat(a5.dsP order by a4.el__id separator ' ')) as term__dsP,
    a1.attr__eMB, a3.el__id
  FROM nfc_expr_attr__arSD as a1
    left join nfc_type__arP as a2 on a2.val = a1.attr__eSI
    left join nfc_expr__acPU_term as a3 on a3.expr__arP = a1.expr__arP
    left join nfc_term__acPU_word as a4 on a4.term__arP = a3.term__arP
    left join nfc_word__arP as a5 on a5.arP = a4.word__arP
  where a1.arSD between 1 and $attr_last
  group by a1.arSD, a1.expr__arP, a1.attr__eSI, a2.dsP, a3.term__arP, a1.attr__eMB, a3.el__id
) as b1
group by b1.attr__eSI, b1.dsP, b1.arSD, b1.attr__eMB
order by b1.arSD
  ");
}

function nfc_create_pw_tables() {

db_query("CREATE TABLE IF NOT EXISTS `parsed_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `hash` varchar(64) NOT NULL,
  `competition_id` int(10) unsigned DEFAULT NULL,
  `columns` longtext NOT NULL COMMENT 'column names',
  `status` enum('NEW','IN_PROGRESS','DONE') DEFAULT 'NEW',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
)");

db_query("CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
)");

db_query("CREATE TABLE IF NOT EXISTS `presets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `column` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `presets_column_unique` (`column`)
)");

db_query("CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
)");

db_query("CREATE TABLE IF NOT EXISTS `settings` (
  `name` varchar(255) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`value`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`name`)
)");

db_query("CREATE TABLE IF NOT EXISTS `synonym` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
)");

db_query("CREATE TABLE IF NOT EXISTS `tmp_photos` (
  `wine_entity_id` int(11) DEFAULT NULL,
  `photo` int(11) DEFAULT NULL
)");

db_query("CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_bot` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `users_email_index` (`email`),
  KEY `users_api_key_index` (`api_key`)
)");

db_query("CREATE TABLE IF NOT EXISTS `vivino_review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wine_entity_id` int(10) unsigned NOT NULL,
  `vivino_vintage_id` int(10) unsigned DEFAULT NULL,
  `vivino_wine_id` int(10) unsigned DEFAULT NULL,
  `vivino_valid` tinyint(1) NOT NULL DEFAULT 0,
  `forget` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
)");

db_query("CREATE TABLE IF NOT EXISTS `parsed_file_column` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `synonym_id` int(10) unsigned NOT NULL,
  `parsed_file_id` int(10) unsigned NOT NULL,
  `property` enum('VINEYARD','NAME','REGION','COUNTRY','COLOR','GRAPE_CATEGORY','CO2','METHOD','UNDER_FILM_OF_YEAST','EXTRA_SWEETNESS','YEAR','ALCOHOL','AWARD','SUGAR','PRODUCTION_VOLUME','PRODUCTION_UNITS','SKIP','SAVE','IMAGE','SAVE_GRAPE','SAVE_TROPHY','URL_IMAGE','AWARD_POINTS') DEFAULT 'SKIP',
  `weight` int(11) NOT NULL COMMENT 'column index from file',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `INDEX_SYNONYM` (`synonym_id`),
  KEY `INDEX_FILE` (`parsed_file_id`),
  CONSTRAINT `parsed_file_column_FK` FOREIGN KEY (`parsed_file_id`) REFERENCES `parsed_file` (`id`),
  CONSTRAINT `parsed_file_column_FK_1` FOREIGN KEY (`synonym_id`) REFERENCES `synonym` (`id`) ON DELETE CASCADE
)");

db_query("CREATE TABLE IF NOT EXISTS `role_permission` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `role_permission_role_id_permission_id_unique` (`role_id`,`permission_id`),
  KEY `role_permission_role_id_permission_id_index` (`role_id`,`permission_id`),
  KEY `role_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
)");

db_query("CREATE TABLE IF NOT EXISTS `rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `synonym_id` int(10) unsigned DEFAULT NULL,
  `parent_value` varchar(100) DEFAULT NULL,
  `value` varchar(255) NOT NULL,
  `property` enum('VINEYARD','NAME','REGION','COUNTRY','COLOR','GRAPE_CATEGORY','CO2','METHOD','UNDER_FILM_OF_YEAST','EXTRA_SWEETNESS','YEAR','ALCOHOL','AWARD','SUGAR','PRODUCTION_VOLUME','PRODUCTION_UNITS','SKIP','SAVE','STAGE_OF_PRODUCTION','GRAPE_TYPE') DEFAULT 'SKIP',
  `parsed_file_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `is_frozen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `INDEX_SYNONYM` (`synonym_id`),
  KEY `INDEX_SET_FILE` (`parsed_file_id`),
  KEY `rule_user_id_foreign` (`user_id`),
  KEY `rule_FK_parsed_file_id` (`parsed_file_id`),
  KEY `rule_FK_synonym_id` (`synonym_id`),
  KEY `rule_FK_user_id` (`user_id`),
  KEY `rule_XK_value` (`value`),
  CONSTRAINT `rule_FK` FOREIGN KEY (`parsed_file_id`) REFERENCES `parsed_file` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rule_FK_1` FOREIGN KEY (`synonym_id`) REFERENCES `synonym` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rule_FK_parsed_file_id` FOREIGN KEY (`parsed_file_id`) REFERENCES `parsed_file` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rule_FK_synonym_id` FOREIGN KEY (`synonym_id`) REFERENCES `synonym` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rule_FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rule_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
)");

db_query("CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `user_role_role_id_user_id_unique` (`role_id`,`user_id`),
  KEY `user_role_role_id_user_id_index` (`role_id`,`user_id`),
  KEY `user_role_user_id_foreign` (`user_id`),
  CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
)");

db_query("CREATE TABLE IF NOT EXISTS `vivino_review_forget_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vivino_review_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vivino_review_forget_users_vivino_review_id_index` (`vivino_review_id`),
  KEY `vivino_review_forget_users_user_id_index` (`user_id`),
  CONSTRAINT `vivino_review_forget_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vivino_review_forget_users_vivino_review_id_foreign` FOREIGN KEY (`vivino_review_id`) REFERENCES `vivino_review` (`id`) ON DELETE CASCADE
)");

db_query("CREATE TABLE IF NOT EXISTS `wine` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `region` int(10) unsigned DEFAULT NULL,
  `country` int(10) unsigned DEFAULT NULL,
  `color` int(10) unsigned DEFAULT NULL,
  `method` int(10) unsigned DEFAULT NULL,
  `co2` int(10) unsigned DEFAULT NULL,
  `winery` int(10) unsigned DEFAULT NULL,
  `grape_variety` enum('AROMATIC','NON_AROMATIC') DEFAULT NULL,
  `sweet` enum('NO','NATURALLY_SWEET','LIQUEUR') DEFAULT NULL,
  `is_under_film_of_yeast` tinyint(1) DEFAULT NULL,
  `status` enum('NEW','SKIPPED','RESERVED','ESCALATED','PROCESSED','REJECTED','FROZEN','DONE','AUTOMATCH') DEFAULT 'NEW',
  `gustos_wine_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `INDEX_REGION` (`region`),
  KEY `INDEX_COUNTRY` (`country`),
  KEY `INDEX_COLOR` (`color`),
  KEY `INDEX_METHOD` (`co2`),
  KEY `wine_user_id_foreign` (`user_id`),
  KEY `wine_id_IDX` (`id`,`status`) USING BTREE,
  CONSTRAINT `wine_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
)");

db_query("CREATE TABLE IF NOT EXISTS `wine_field_edit_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wine_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `field` enum('VINEYARD','NAME','REGION','COUNTRY','COLOR','GRAPE_CATEGORY','CO2','METHOD','UNDER_FILM_OF_YEAST','EXTRA_SWEETNESS','YEAR','ALCOHOL','AWARD','SUGAR','PRODUCTION_VOLUME','PRODUCTION_UNITS','SKIP','SAVE','STAGE_OF_PRODUCTION','GRAPE_TYPE','URL_IMAGE','LOCATION') NOT NULL,
  `old_data` varchar(255) DEFAULT NULL,
  `new_data` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wine_field_edit_history_wine_id_foreign` (`wine_id`),
  KEY `wine_field_edit_history_user_id_foreign` (`user_id`),
  CONSTRAINT `wine_field_edit_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `wine_field_edit_history_wine_id_foreign` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`id`) ON DELETE CASCADE
)");

db_query("CREATE TABLE IF NOT EXISTS `wine_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `wine_id` int(10) unsigned DEFAULT NULL,
  `content` longtext NOT NULL,
  `version` smallint(6) NOT NULL,
  `gustos_wine_id` int(10) unsigned NOT NULL,
  `vintage_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `INDEX_USER_ID` (`user_id`),
  KEY `INDEX_GUSTOS_WINE_ID` (`gustos_wine_id`),
  KEY `INDEX_VINTAGE_ID` (`vintage_id`),
  CONSTRAINT `wine_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
)");

db_query("CREATE TABLE IF NOT EXISTS `wine_in_progress` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(32) NOT NULL,
  `wine_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wine_in_progress_FK` (`wine_id`),
  KEY `wine_in_progress_user_id_foreign` (`user_id`),
  CONSTRAINT `wine_in_progress_FK` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wine_in_progress_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
)");

db_query("CREATE TABLE IF NOT EXISTS `wine_rule` (
  `wine_id` int(10) unsigned NOT NULL,
  `rule_id` int(10) unsigned NOT NULL,
  KEY `INDEX_WINE` (`wine_id`),
  KEY `INDEX_RULE` (`rule_id`),
  CONSTRAINT `fk_rule` FOREIGN KEY (`rule_id`) REFERENCES `rule` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_wine` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
)");

db_query("CREATE TABLE IF NOT EXISTS `winery_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `initial_winery_id` int(10) unsigned NOT NULL,
  `action` enum('CREATED','RENAMED','DELETED','MERGED') NOT NULL,
  `winery_name` varchar(255) NOT NULL,
  `target_winery_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `winery_action_initial_winery_id_index` (`initial_winery_id`),
  KEY `winery_action_target_winery_id_index` (`target_winery_id`),
  KEY `INDEX_USER_ID` (`user_id`),
  CONSTRAINT `winery_action_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
)");

db_query("CREATE TABLE IF NOT EXISTS `winery_review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `winery_id` int(10) unsigned NOT NULL,
  `status` enum('PROBLEMATIC','VALID','MERGED','FINISHED') NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `winery_review_winery_id_status_unique` (`winery_id`,`status`),
  KEY `winery_review_winery_id_index` (`winery_id`),
  KEY `winery_review_status_index` (`status`),
  KEY `winery_review_user_id_index` (`user_id`),
  CONSTRAINT `winery_review_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
)");

db_query("CREATE TABLE IF NOT EXISTS `winery_review_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `winery_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `message` longtext NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `winery_review_comment_winery_id_index` (`winery_id`),
  KEY `winery_review_comment_user_id_index` (`user_id`),
  CONSTRAINT `winery_review_comment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
)");

db_query("CREATE TABLE IF NOT EXISTS `wines_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wine_id` int(10) unsigned NOT NULL,
  `action` enum('NEW_WINE','NEW_VINTAGE','MERGE_SELECTED') NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `gustos_vintage_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `INDEX_WINE_ID` (`wine_id`),
  KEY `INDEX_USER_ID` (`user_id`),
  KEY `wines_actions_gustos_vintage_id_index` (`gustos_vintage_id`),
  CONSTRAINT `wines_actions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `wines_actions_wine_id_foreign` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`id`)
)");

db_query("CREATE TABLE IF NOT EXISTS `wines_filters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `filter` longtext NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_filters_user_id_index` (`user_id`),
  CONSTRAINT `users_filters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
)");

db_query("CREATE TABLE IF NOT EXISTS `vintage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wine_id` int(10) unsigned NOT NULL,
  `award` int(10) unsigned DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `alcohol` double DEFAULT NULL,
  `sugar` double DEFAULT NULL,
  `prod_volume` double(8,2) DEFAULT NULL,
  `prod_units` int(10) unsigned DEFAULT NULL,
  `trophy` longtext DEFAULT NULL,
  `grape_type` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url_image` varchar(255) DEFAULT NULL,
  `add_info` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `award_points` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX_WINE` (`wine_id`),
  KEY `vintage_wine_id_index` (`wine_id`),
  KEY `vintage_FK_wine_id` (`wine_id`),
  CONSTRAINT `fk_wine_id` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`id`),
  CONSTRAINT `vintage_FK_wine_id` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`id`)
)");

db_query("CREATE TABLE IF NOT EXISTS `vintage_grape` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vintage_id` int(10) unsigned NOT NULL,
  `grape_id` int(10) unsigned NOT NULL,
  `percentage` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vintage_grape_vintage_id_foreign` (`vintage_id`),
  CONSTRAINT `vintage_grape_vintage_id_foreign` FOREIGN KEY (`vintage_id`) REFERENCES `vintage` (`id`) ON DELETE CASCADE
)");

db_query("CREATE TABLE IF NOT EXISTS `vintage_rule` (
  `vintage_id` int(10) unsigned NOT NULL,
  `rule_id` int(10) unsigned NOT NULL,
  KEY `INDEX_VINTAGE` (`vintage_id`),
  KEY `INDEX_RULE` (`rule_id`),
  CONSTRAINT `fk_rule_1` FOREIGN KEY (`rule_id`) REFERENCES `rule` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_vintage_1` FOREIGN KEY (`vintage_id`) REFERENCES `vintage` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
)");

db_query("CREATE TABLE IF NOT EXISTS `parsed_file_row` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `row` longtext NOT NULL,
  `parsed_file_id` int(10) unsigned NOT NULL,
  `weight` int(10) unsigned NOT NULL,
  `status` enum('NEW','IN_PROGRESS','MANUAL','FROZEN','DONE') DEFAULT 'NEW',
  `wine_id` int(10) unsigned DEFAULT NULL,
  `vintage_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `parsed_file_row_FK` (`parsed_file_id`),
  KEY `wine_id_FK` (`wine_id`),
  KEY `vintage_id_FK` (`vintage_id`),
  FULLTEXT KEY `row_fulltext` (`row`),
  CONSTRAINT `parsed_file_row_FK` FOREIGN KEY (`parsed_file_id`) REFERENCES `parsed_file` (`id`),
  CONSTRAINT `vintage_id_FK` FOREIGN KEY (`vintage_id`) REFERENCES `vintage` (`id`),
  CONSTRAINT `wine_id_FK` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`id`) ON DELETE SET NULL
)");

db_query("CREATE TABLE IF NOT EXISTS `rows_in_progress` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(32) DEFAULT NULL,
  `row_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rows_in_progress_FK` (`row_id`),
  CONSTRAINT `rows_in_progress_FK` FOREIGN KEY (`row_id`) REFERENCES `parsed_file_row` (`id`) ON DELETE CASCADE
)");  
}

function nfc_drop_objects() {
  nfc_drop_triggers();
  nfc_drop_procedures();
}

function nfc_create_objects() {
  nfc_load_all(0);
  nfc_drop_objects();
  nfc_create_pw_tables();
  nfc_create_procedures();
  nfc_create_triggers();
  region_db_triggers_create();
  gw_db_triggers_create();
}

function nfc_drop_triggers() {
  db_query("DROP TRIGGER  if exists nfc_word__acSG_group__asTBI");
  db_query("DROP TRIGGER  if exists nfc_word__acSG_group__asTBU");
  db_query("DROP TRIGGER  if exists nfc_word__acSG_group__asTBD");
  db_query("DROP TRIGGER  if exists nfc_term__arPD_exclude_log__asTBI");
  db_query("DROP TRIGGER  if exists nfc_term__arPD_exclude_log__asTBU");
}

function nfc_create_triggers() {
  db_query(
"CREATE TRIGGER nfc_word__acSG_group__asTBI
BEFORE INSERT ON nfc_word__acSG_group FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
  DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
    GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(nfc_word__acSG_group__asTBI_P1) -err- ', v__dsP);
	  resignal SET MESSAGE_TEXT = v__dsP;
  END;
  set new.form__arP = nfc_word__asFL_group_insert(_norm_ii__asFL(new.base__dsP), _norm_ii__asFL(new.form__dsP));
END
  ");

  db_query(
"CREATE TRIGGER nfc_word__acSG_group__asTBD
BEFORE DELETE ON nfc_word__acSG_group FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
  DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
    GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(nfc_word__acSG_group__asTBD_P1) -err- ', v__dsP);
	  resignal SET MESSAGE_TEXT = v__dsP;
  END;
  call nfc_word__asPL_group_delete(_norm_ii__asFL(old.base__dsP), _norm_ii__asFL(old.form__dsP), old.orig__arP);
END
  ");

  db_query(
"CREATE TRIGGER nfc_word__acSG_group__asTBU
BEFORE UPDATE ON nfc_word__acSG_group FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
  DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
    GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(nfc_word__acSG_group__asTBU_P1) -err- ', v__dsP);
	  resignal SET MESSAGE_TEXT = v__dsP;
  END;
  call nfc_word__asPL_group_delete(_norm_ii__asFL(old.base__dsP), _norm_ii__asFL(old.form__dsP), new.orig__arP);
  set new.form__arP = nfc_word__asFL_group_insert(_norm_ii__asFL(new.base__dsP), _norm_ii__asFL(new.form__dsP));
END
  ");

  db_query(
    "CREATE TRIGGER nfc_term__arPD_exclude_log__asTBI
      BEFORE INSERT ON nfc_term__arPD_exclude_log FOR EACH ROW
        set new.term__arP = nullif(_term__asFL_arP(new.term__dsP), 0);
  ");
  
  db_query(
    "CREATE TRIGGER nfc_term__arPD_exclude_log__asTBU
      BEFORE UPDATE ON nfc_term__arPD_exclude_log FOR EACH ROW
        set new.term__arP = nullif(_term__asFL_arP(new.term__dsP), 0);
  ");
}

function gw_db_triggers_script() {
  global $fti_gustos_db;
  $gw_grants =
"GRANT TRIGGER ON gustosapp.gustos_wine TO 'parsedwine'@'%';
GRANT TRIGGER ON gustosapp.gustos_wine_entity TO 'parsedwine'@'%';
GRANT TRIGGER ON gustosapp.gustos_wine_grapes TO 'parsedwine'@'%';
GRANT TRIGGER ON gustosapp.vineyard TO 'parsedwine'@'%';
GRANT TRIGGER ON gustosapp.taxonomy_term_data TO 'parsedwine'@'%';
GRANT TRIGGER ON gustosapp.taxonomy_term_hierarchy TO 'parsedwine'@'%';
GRANT TRIGGER ON gustosapp.field_data_field_region_country TO 'parsedwine'@'%';
GRANT TRIGGER ON gustosapp.field_revision_field_region_country TO 'parsedwine'@'%';

GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.gustos_wine TO 'parsedwine'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.gustos_wine_entity TO 'parsedwine'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.gustos_wine_grapes TO 'parsedwine'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.vineyard TO 'parsedwine'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.taxonomy_term_data TO 'parsedwine'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.taxonomy_term_hierarchy TO 'parsedwine'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.field_data_field_region_country TO 'parsedwine'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.field_revision_field_region_country TO 'parsedwine'@'%';

GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.region TO 'parsedwine'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.region_hierarchy TO 'parsedwine'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.region_vineyard TO 'parsedwine'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON gustosapp.region_wine TO 'parsedwine'@'%';
";
  echo "\n\n$gw_grants\n\n";
}
function gw_db_triggers_create() {
  global $fti_var, $fti_gustos_region_db, $fti_gustos_db;
  $exREGI = $fti_var['exREGI'][0];
  $exVINE = $fti_var['exVINE'][0];
  $exGRAP = $fti_var['exGRAP'][0];
/*
  DROP TRIGGER if exists gustos_wine__asTAU;
  DROP TRIGGER if exists gustos_wine__asTAI;
  DROP TRIGGER if exists gustos_wine__asTAD;
  DROP TRIGGER if exists gustos_wine_entity__asTAU;
  DROP TRIGGER if exists gustos_wine_entity__asTAI;
  DROP TRIGGER if exists gustos_wine_entity__asTAD;
  DROP TRIGGER if exists gustos_wine_grapes__asTAU;
  DROP TRIGGER if exists gustos_wine_grapes__asTAI;
  DROP TRIGGER if exists gustos_wine_grapes__asTAD;
  DROP TRIGGER if exists taxonomy_term_data__asTAU;
  DROP TRIGGER if exists taxonomy_term_data__asTAI;
  DROP TRIGGER if exists taxonomy_term_data__asTAD;
  DROP TRIGGER if exists vineyard__asTAU;
  DROP TRIGGER if exists vineyard__asTAI;
  DROP TRIGGER if exists vineyard__asTAD;
*/
  db_query("DROP TRIGGER if exists $fti_gustos_db.gustos_wine__asTAU");
  db_query("DROP TRIGGER if exists $fti_gustos_db.gustos_wine__asTAI");
  db_query("DROP TRIGGER if exists $fti_gustos_db.gustos_wine__asTAD");
  db_query("DROP TRIGGER if exists $fti_gustos_db.gustos_wine_entity__asTAU");
  db_query("DROP TRIGGER if exists $fti_gustos_db.gustos_wine_entity__asTAI");
  db_query("DROP TRIGGER if exists $fti_gustos_db.gustos_wine_entity__asTAD");
  db_query("DROP TRIGGER if exists $fti_gustos_db.gustos_wine_grapes__asTAU");
  db_query("DROP TRIGGER if exists $fti_gustos_db.gustos_wine_grapes__asTAI");
  db_query("DROP TRIGGER if exists $fti_gustos_db.gustos_wine_grapes__asTAD");
  db_query("DROP TRIGGER if exists $fti_gustos_db.taxonomy_term_data__asTAU");
  db_query("DROP TRIGGER if exists $fti_gustos_db.taxonomy_term_data__asTAI");
  db_query("DROP TRIGGER if exists $fti_gustos_db.taxonomy_term_data__asTAD");
  db_query("DROP TRIGGER if exists $fti_gustos_db.vineyard__asTAU");
  db_query("DROP TRIGGER if exists $fti_gustos_db.vineyard__asTAI");
  db_query("DROP TRIGGER if exists $fti_gustos_db.vineyard__asTAD");
  db_query(
"CREATE TRIGGER $fti_gustos_db.gustos_wine__asTAU
AFTER UPDATE ON $fti_gustos_db.gustos_wine FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
  declare v_new_vine int default ifnull(new.vineyard,0);
  declare v_old_vine int default ifnull(old.vineyard,0);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(gustos_wine__asTAU_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if 1<>1
    or ifnull(old.name,'') <> ifnull(new.name,'')
    or ifnull(old.country,'') <> ifnull(new.country,'')
    or ifnull(old.category,'') <> ifnull(new.category,'')
  then
    if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
      insert into parsedwine.nfc_expr_updates__arS
          (source__dsP, action__eC, action__id)
        values
          ('wine', 'acUpd', new.id)
      ;
    end if;
  end if;
END
  ");
db_query(
"CREATE TRIGGER $fti_gustos_db.gustos_wine__asTAI
AFTER INSERT ON $fti_gustos_db.gustos_wine FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(gustos_wine__asTAI_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    insert into parsedwine.nfc_expr_updates__arS
        (source__dsP, action__eC, action__id)
      values
        ('wine', 'acIns', new.id)
    ;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.gustos_wine__asTAD
AFTER DELETE ON $fti_gustos_db.gustos_wine FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(gustos_wine__asTAD_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    delete t1 from parsedwine.nfc__arP as t1
      inner join parsedwine.nfc_expr_wine__arPD as t2 on t2.arP = t1.arP and t2.wine = old.id
    ;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.gustos_wine_entity__asTAU
AFTER UPDATE ON $fti_gustos_db.gustos_wine_entity FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(gustos_wine_entity__asTAU_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if 1<>1 
    or ifnull(old.alcohol,'') <> ifnull(new.alcohol,'')
    or ifnull(old.sugar,'') <> ifnull(new.sugar,'')
    or ifnull(old.vintage,'') <> ifnull(new.vintage,'')
    or ifnull(old.region,'') <> ifnull(new.region,'')
  then
    if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
      insert into parsedwine.nfc_expr_updates__arS
          (source__dsP, action__eC, action__id)
        values
          ('wine', 'acUpd', new.wine)
      ;
    end if;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.gustos_wine_entity__asTAI
AFTER INSERT ON $fti_gustos_db.gustos_wine_entity FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(gustos_wine_entity__asTAI_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    insert into parsedwine.nfc_expr_updates__arS
        (source__dsP, action__eC, action__id)
      values
        ('wine', 'acUpd', new.wine)
    ;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.gustos_wine_entity__asTAD
AFTER DELETE ON $fti_gustos_db.gustos_wine_entity FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024) default (select vineyard from $fti_gustos_db.gustos_wine where id = old.wine);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(gustos_wine_entity__asTAD_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    if (select count(*) from gustos_wine_entity where wine = old.wine) = 0 then
      delete t1 from parsedwine.nfc__arP as t1
        inner join parsedwine.nfc_expr_wine__arPD as t2 on t2.arP = t1.arP and t2.wine = old.id
      ;
    else
      insert into parsedwine.nfc_expr_updates__arS
          (source__dsP, action__eC, action__id)
        values
          ('wine', 'acUpd', old.wine)
      ;
    end if;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.gustos_wine_grapes__asTAI
AFTER INSERT ON $fti_gustos_db.gustos_wine_grapes FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(gustos_wine_grapes__asTAI_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    insert into parsedwine.nfc_expr_updates__arS
        (source__dsP, action__eC, action__id)
      values
        ('wine', 'acUpd', new.wine)
    ;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.gustos_wine_grapes__asTAD
AFTER DELETE ON $fti_gustos_db.gustos_wine_grapes FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(gustos_wine_grapes__asTAD_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    insert into parsedwine.nfc_expr_updates__arS
        (source__dsP, action__eC, action__id)
      values
        ('wine', 'acUpd', old.wine)
    ;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.gustos_wine_grapes__asTAU
AFTER UPDATE ON $fti_gustos_db.gustos_wine_grapes FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(gustos_wine_grapes__asTAU_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    insert into parsedwine.nfc_expr_updates__arS
        (source__dsP, action__eC, action__id)
      values
        ('wine', 'acUpd', new.wine)
    ;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.taxonomy_term_data__asTAU
AFTER UPDATE ON $fti_gustos_db.taxonomy_term_data FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(taxonomy_term_data__asTAU_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if 1=1
    and ifnull(old.name,'') <> ifnull(new.name,'')
    and old.vid in (4,13)
  then
    if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
      insert into parsedwine.nfc_expr_updates__arS
          (source__dsP, action__eC, action__id)
        values
          (if(old.vid = 4, 'grape', 'region'), 'acUpd', new.tid)
      ;
      if old.vid = 13 then
        set @FTI_TRIGGERS_STOP = 1;
        UPDATE $fti_gustos_region_db.region
          set id = new.tid, `name` = new.name, `weight` = new.weight, updated = UNIX_TIMESTAMP()
          where id = old.tid
        ;
        set @FTI_TRIGGERS_STOP = 0;
      end if;
    end if;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.taxonomy_term_data__asTAI
AFTER INSERT ON $fti_gustos_db.taxonomy_term_data FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(taxonomy_term_data__asTAI_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if new.vid in (4,13) and @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    insert into parsedwine.nfc_expr_updates__arS
        (source__dsP, action__eC, action__id)
      values
        (if(new.vid = 4, 'grape', 'region'), 'acIns', new.tid)
    ;
    if new.vid = 13 then
      set @FTI_TRIGGERS_STOP = 1;
      insert into $fti_gustos_region_db.region
          (id, `type`, `name`, created, updated, `weight`)
        value
          (new.tid, 'REGION', new.name, UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), new.weight)
      ;
      set @FTI_TRIGGERS_STOP = 0;
    end if;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.taxonomy_term_data__asTAD
AFTER DELETE ON $fti_gustos_db.taxonomy_term_data FOR EACH ROW
BEGIN
  declare v_regi_to__id, v_link_cnt int;
  declare v__dsP varchar(1024);
  declare v_vine_to__id int;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
    GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(taxonomy_term_data__asTAD_P1) -err- ', v__dsP);
	  resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if old.vid = 4 then
    delete t1 from parsedwine.nfc__arP as t1
      inner join parsedwine.nfc_expr__arP as t2 on t2.arP = t1.arP and t2.id = old.tid
      where t2.expr__eS = $exGRAP
    ;
    delete d1 from parsedwine.nfc_expr_grap__arS_blend as d1
      inner join parsedwine.nfc_expr_grap__acSG_blend as d2 on d2.blend__arS = d1.arS
      where d2.grap__id = old.tid
    ;
    delete from parsedwine.nfc_expr_grap__arPD_link where old.tid in (link__id, grap__id);
  end if;
  if old.vid = 13 then
    set @FTI_TRIGGERS_STOP = 1;
    delete from $fti_gustos_db.region where id = old.tid;
    SET v_regi_to__id = ROW_COUNT();
    SET v__dsP = concat(' region_tid=', old.tid, ', cnt=', v_regi_to__id);
    insert into parsedwine.nfc_log__arS (action__eN, dsP) values ('del_1', v__dsP);
    set @FTI_TRIGGERS_STOP = 0;
    delete t1 from parsedwine.nfc__arP as t1
      inner join parsedwine.nfc_expr__arP as t2 on t2.arP = t1.arP and t2.id = old.tid
      where t2.expr__eS = $exREGI
    ;
    SET v_regi_to__id = ROW_COUNT();
    SET v__dsP = concat(' nfc__arP=', v_regi_to__id);
    insert into parsedwine.nfc_log__arS (action__eN, dsP) values ('del_2', v__dsP);
    delete from $fti_gustos_db.taxonomy_term_hierarchy where tid = old.tid;
    delete from $fti_gustos_db.field_data_field_region_country where entity_id = old.tid;
    delete from $fti_gustos_db.field_revision_field_region_country where entity_id = old.tid;
    SET v_regi_to__id = ROW_COUNT(), v__dsP = concat(' region_country=', v_regi_to__id);
    insert into parsedwine.nfc_log__arS (action__eN, dsP) values ('del_5', v__dsP);
    select count(*) into v_regi_to__id
      from parsedwine.nfc_expr_regi__arPD_link
      where regi__id = old.tid
      group by regi__id
    ;
    if v_regi_to__id > 0 then
      if v_regi_to__id  < 3 then
        delete from parsedwine.nfc_expr_regi__arPD_link where regi__id = old.tid;
        SET v_regi_to__id = ROW_COUNT();
        SET v__dsP = concat(' regi__arPD_link=', v_regi_to__id);
        insert into parsedwine.nfc_log__arS (action__eN, dsP) values ('del_6', v__dsP);
      else
        select link__id into v_regi_to__id
          from parsedwine.nfc_expr_regi__arPD_link
          where 1 = 1
            and regi__id = old.tid
            and link__id <> old.tid
          limit 1
        ;
        update parsedwine.nfc_expr_regi__arPD_link
          set regi__id = v_regi_to__id
          where regi__id = old.tid
        ;
        SET v_regi_to__id = ROW_COUNT();
        SET v__dsP = concat(' regi__arPD_link=', v_regi_to__id);
        insert into parsedwine.nfc_log__arS (action__eN, dsP) values ('upd_7', v__dsP);
      end if;
    else
      select count(*), regi__id into v_link_cnt, v_regi_to__id
        from parsedwine.nfc_expr_regi__arPD_link
        where regi__id = (
          select regi__id
          from parsedwine.nfc_expr_regi__arPD_link
          where link__id = old.tid          
        )
        group by regi__id
      ;
      if v_link_cnt < 3 then
        delete from parsedwine.nfc_expr_regi__arPD_link where regi__id = v_vine_to__id;
      else
        delete from parsedwine.nfc_expr_regi__arPD_link where link__id = old.tid;
      end if;
      SET v_regi_to__id = ROW_COUNT();
      SET v__dsP = concat(' regi__arPD_link=', v_regi_to__id);
      insert into parsedwine.nfc_log__arS (action__eN, dsP) values ('del_8', v__dsP);
    end if;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.vineyard__asTAU
AFTER UPDATE ON $fti_gustos_db.vineyard FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(vineyard__asTAU_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if (@FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1) and ifnull(old.name,'') <> ifnull(new.name,'') then
    insert into parsedwine.nfc_expr_updates__arS
        (source__dsP, action__eC, action__id)
      values
        ('vineyard', 'acUpd', old.id)
    ;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.vineyard__asTAI
AFTER INSERT ON $fti_gustos_db.vineyard FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(vineyard__asTAI_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if (@FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1) then
    insert into parsedwine.nfc_expr_updates__arS
        (source__dsP, action__eC, action__id)
      values
        ('vineyard', 'acIns', new.id)
    ;
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_db.vineyard__asTAD
AFTER DELETE ON $fti_gustos_db.vineyard FOR EACH ROW
BEGIN
  declare v_link_cnt int default (
    select count(*)
    from parsedwine.nfc_expr_vine__arPD_link
    where vine__id = old.id
    group by vine__id
  );
  declare v_vine_to__id int;
  declare v__dsP varchar(1024);
 	DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
	 	GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(vineyard__asTAD_P1) -err- ', v__dsP);
	 	resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if (@FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1) then
    delete t1 from parsedwine.nfc__arP as t1
      inner join parsedwine.nfc_expr__arP as t2 on t2.arP = t1.arP and t2.id = old.id
      where t2.expr__eS = $exVINE
    ;
    if v_link_cnt > 0 then
      if v_link_cnt  < 3 then
        delete from parsedwine.nfc_expr_vine__arPD_link where vine__id = old.id;  
      else
        select link__id into v_vine_to__id
          from parsedwine.nfc_expr_vine__arPD_link
          where 1 = 1
            and vine__id = old.id
            and link__id <> old.id
          limit 1
        ;
        update parsedwine.nfc_expr_vine__arPD_link
          set vine__id = v_vine_to__id
          where vine__id = old.id
        ;
      end if;
    else
      select count(*), vine__id into v_link_cnt, v_vine_to__id
        from parsedwine.nfc_expr_vine__arPD_link
        where vine__id = (
          select vine__id
          from parsedwine.nfc_expr_vine__arPD_link
          where link__id = old.id
        )
        group by vine__id
      ;
      if v_link_cnt < 3 then
        delete from parsedwine.nfc_expr_vine__arPD_link where vine__id = v_vine_to__id;
      else
        delete from parsedwine.nfc_expr_vine__arPD_link where link__id = old.id;
      end if;
    end if;
    select count(*) into v_link_cnt
      from parsedwine.nfc_expr_vine__arPD_dups
      where vine__id = old.id
      group by vine__id
    ;
    if v_link_cnt > 0 then
      if v_link_cnt  < 3 then
        delete from parsedwine.nfc_expr_vine__arPD_dups where vine__id = old.id;  
      else
        select dups__id into v_vine_to__id
          from parsedwine.nfc_expr_vine__arPD_dups
          where 1 = 1
            and vine__id = old.id
            and dups__id <> old.id
          limit 1
        ;
        update parsedwine.nfc_expr_vine__arPD_dups
          set vine__id = v_vine_to__id
          where vine__id = old.id
        ;
      end if;
    else
      select count(*), vine__id into v_link_cnt, v_vine_to__id
        from parsedwine.nfc_expr_vine__arPD_dups
        where vine__id = (
          select vine__id
          from parsedwine.nfc_expr_vine__arPD_dups
          where dups__id = old.id
        )
        group by vine__id
      ;
      if v_link_cnt < 3 then
        delete from parsedwine.nfc_expr_vine__arPD_dups where vine__id = v_vine_to__id;
      else
        delete from parsedwine.nfc_expr_vine__arPD_dups where dups__id = old.id;
      end if;
    end if;
  end if;
END
  ");
}


function region_db_triggers_create() {
  global $fti_gustos_region_db;
  db_query("DROP TRIGGER if exists $fti_gustos_region_db.region__asTBU");
  db_query("DROP TRIGGER if exists $fti_gustos_region_db.region__asTBI");
  db_query("DROP TRIGGER if exists $fti_gustos_region_db.region__asTBD");
  db_query(
"CREATE TRIGGER $fti_gustos_region_db.region__asTBU
BEFORE UPDATE ON $fti_gustos_region_db.region FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
  DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
    GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(region__asTBU_P1) -err- ', v__dsP);
	  resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    signal SQLSTATE '45000' SET MESSAGE_TEXT = 'ErrFTI(region__asTBU_P2) -err- Change allowed only in taxonomy';
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_region_db.region__asTBI
BEFORE INSERT ON $fti_gustos_region_db.region FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
  DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
    GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(region__asTBI_P1) -err- ', v__dsP);
	  resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    signal SQLSTATE '45000' SET MESSAGE_TEXT = 'ErrFTI(region__asTBI_P2) -err- Change allowed only in taxonomy';
  end if;
END
  ");
  db_query(
"CREATE TRIGGER $fti_gustos_region_db.region__asTBD
BEFORE DELETE ON $fti_gustos_region_db.region FOR EACH ROW
BEGIN
  declare v__dsP varchar(1024);
  DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
    GET DIAGNOSTICS CONDITION 1 v__dsP = MESSAGE_TEXT;
    SET v__dsP = CONCAT('ErrFTI(region__asTBD_P1) -err- ', v__dsP);
	  resignal SET MESSAGE_TEXT = v__dsP;
  END;
  if @FTI_TRIGGERS_STOP is null or @FTI_TRIGGERS_STOP <> 1 then
    signal SQLSTATE '45000' SET MESSAGE_TEXT = 'ErrFTI(region__asTBD_P2) -err- Change allowed only in taxonomy';
  end if;
END
  ");
}

function nfc_tag_create() {
  db_query(
    "INSERT INTO nfc_tag__arS
        (tag__dsP) VALUES
        ('plai moldova'),
        ('moldova lux'),
        ('Purpuriu de Purcari'),
        ('sevre maine sur lie / sevre maine s lie / sevre maine'),
        ('1827'),
        ('1808 Varietal Expression'),
        ('1808 Colheita Organic')
  ");
}

function nfc_country_synonyms_create() {
  return db_query(
    "SELECT 'united states/usa/us/america/american/etats unis/statele unite/estados unidos/stati uniti/соединенные штаты/vereinigte staaten/amerique/америка/amerika' as `name`
      UNION ALL VALUES
        ('united kingdom/uk/british/brit/anglia/england/angleterre/inglaterra/inghilterra/англия'),
        ('spain/Espaha/Espanya/spanish/espagne/spania/espana/spagna/испания/spanien/espanha'),
        ('italy/Italia/Italico/italian/italie/италия/italien/vlassky'),
        ('france/Francie/fra/fr/french/frankreich/franta/francia/франция/francs/franches'),
        ('romania/romanian/romaniei/roumanie/rumanía/румыния/rumanien/rom/ro/RUMANIA'),
        ('moldova/moldavian/moldavan/moldovei/moldavia/moldavie/Moldavii/молдова/moldawien/МОЛДАВИИ/Moldoveneasca/mld/mold'),
        ('portugal/portuguese/portugalia/portogallo/португалия'),
        ('japan/japanese/japonia/japon/giappone/япония/japao/jap/jp'),
        ('chile/chilean/chillian/chilian/chili/cile/чили'),
        ('czech/bohemian/tcheque/tcheque/cehia/chequia/ceca/чехия/tschechien/checa/czechia/Ceskâ'),
        ('bulgaria/bulgarian/bulgarie/болгария/bulgarien'),
        ('germany/german/allemagne/germania/alemania/германия/deutschland/alemanha/deutscher'),
        ('austria/austrian/austriachina/autriche/австрия/osterreich'),
        ('china/chinese/chine/cina/китай'),
        ('georgia/georgian/georgie/georgien/грузия'),
        ('australia/australlia/australian/australien/aussie/australie/австралия'),
        ('mexico/mexica/mexican/mexique/mexic/мексика/mexiko'),
        ('poland/polish/pologne/polonia/польша/polen'),
        ('switzerland/swiss/swisse/elvetia/suiza/svizzera/швейцария/schweiz/suíca/suisse'),
        ('ukraine/ukraina/ukrainian/украiна/украина/украіна'),
        ('hungary/hungarian/magyar/hongrie/ungaria/hungría/ungheria/венгрия/ungarn/hungria'),
        ('colombia/columbia/колумбия'),
        ('argentina/agentina/argentine/аргентина/argentinien/argentinos'),
        ('greece/grece/grecia/греция/griechenland'),
        ('russian federation/russian/русский/российский/russer/russe'),
        ('slovakia/slovaque/словакия/slovak/slovac/eslovaquia/slovakian/SLOVACCHIA'),
        ('slovenia/slovenian/slovene'),
        ('serbia/srbiji/Srbija/serbien/serbie/servia/servio/сербия/србија/сербія'),
        ('belgium/belgique'),
        ('croatia/hrvatska')
  ")->fetchAll(PDO::FETCH_ASSOC);
}

function nfc_vine_synonyms_create() {
  // group case(syGroupVT) - common for most vine, case(syGroupWT) for vine with main nama consist only syGroupVT typy/title words like (vinaria) or (vale)
  return db_query( // 1-st term must be exact as it gived in vineyard table
    "SELECT 'syGroupVT' as `group`, 'MOET CHANDON/MOET/CHANDON' as `name`
      UNION ALL VALUES
        ('syGroupVT', 'martini rossi/martini'),
        ('syGroupVT', 'Salcuta/winemakers way/ww/salcura'),
        ('syGroupVT', 'Contarini Vini e Spumanti/contarini'),
        ('syGroupVT', 'Serena Wines 1881/Serena'),
        ('syGroupVT', 'Milestii Mici/purcari'),
        ('syGroupVT', 'Timbrus/purcari'),
        ('syGroupVT', 'Gogu Winery/purcari'),
        ('syGroupVT', 'Castel Mimi/Bulboaca'),
        ('syGroupVT', 'Chateau Vartely/Individo'),
        ('syGroupVT', 'Vinaria Purcari/1827'),
        ('syGroupVT', 'Crémant and Alsace wines Arthur Metz/Arthur Metz/a metz'),
        ('syGroupVT', 'Bodega Pago de Tharsys/Tharsys'),
        ('syGroupVT', 'Raventós Codorníu/Codorníu'),
        ('syGroupVT', 'Cantina Montelliana e dei Colli Asolani/Montelliana'),
        ('syGroupVT', 'Maison du Vigneron (Domaine de Savagny)/Brut Dargent Quality'),
        ('syGroupVT', 'Vinum/Vladlen Uzhakov'),
        ('syGroupVT', 'Vinaria din Vale/Motive'),
        ('syGroupVT', 'Bottega Spa/Stefano Bottega/st Bottega')
  ")->fetchAll(PDO::FETCH_ASSOC);
}
