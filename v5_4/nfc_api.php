<?php

mb_internal_encoding('UTF-8');

include_once "nfc_macro.php";

function nfc_api($step, $arg_val) {
  global $fti_var, $fti_expra, $fti_sqr, $fti_seg, $fti_gustos_region_db,$fti_gustos_db,
          $fti_terms, $fti_terme, $fti_row, $mix__arr, $fti_parsedwine__exDB, $fti_sq;
  if ($step != 'del') {
      if (isset(array(1=>1, 'i1'=>2)[$step])) {
          nfc_loadClass();
          load_terms();
          load_attributes();
          load_blends();
      } else {
          nfc_load_all($step);
      }
  }
  switch ($step) {
    case 0:
        echo "\nInit nfc code objects like: proc, funct, trigg, view\n";
        nfc_reInit();
        $phase_curr = nfc_getVar('register_phase', 0);
        nfc_create_objects();
        nfc_setVar('match_new', 1);
        nfc_setVar('register_phase', "$phase_curr");
        break;
    case 'del':
        nfc_drop_by_prefix();
        break;
    case 'i1':
        nfc_setVar('match_new', 0);
        src_regions_create();
        regions_preserv_create();

        // $ftiService->install();
        echo "\nStart setup FTI\n";
        nfc_create_tables();
        nfc_init();
        nfc_create_objects();
        echo "\nFTI setup successful !\n";

        nfc_setVar('register_phase', "0");
        break;
    case 'i2':
        nfc_updates_7012_reg_all();
        break;
    case 'i3':
        nfc_load_all();
        reg_vineyards_syn();
        nfc_load_all();
        link_expr('exVINE');
        //nfcDB__backup();
        break;
    case 1:
        nfc_setVar('match_new', 0);
        
        //$ftiService->install();
        echo "\nStart setup FTI\n";
        nfc_create_tables();
        nfc_init();
        nfc_create_objects();
        echo "\nFTI setup successful !\n";

        nfc_setVar('register_phase', "0");
        break;
    case 2:
        
        //$ftiService->register();
        echo "\nLoad FTI\n";
        //nfc_create_objects();
        $fti_log = [];
        $fti_log[] = ["Create new index FTI"];
        echo "\n\n" . $fti_log[count($fti_log) - 1][0] . "\n\n";
        reg_log();
        nfc_register();
        $fti_log[] = ["Successuful changing index FTI"];
        echo "\n\n" . $fti_log[count($fti_log) - 1][0] . "\n\n";
        reg_log();

        nfc_setVar('match_new', 1);
/*
                    $pw__id = 383264; // 1-st for '2023-11-01'
                    parsed__exDB_reMatch($pw__id, 5000);
//                            */
                    $wa__id = 489542;
                    parsed__exDB_reMatch_admins(0, 5000, $wa__id);
//*/
        break;
    case 3:
        nfc_setVar('match_new', 1); // switch on
        nfc_loadClass();
        echo "\nNEW: " . nfc_getVar('match_new', 0) . "\n";
        break;
    case 4:
        nfc_setVar('match_new', 0); // switch off
        nfc_loadClass();
        echo "\nNEW: " . nfc_getVar('match_new', 1) . "\n";
        break;
    case 5:
        break;
        // debug futures
                case 1030:
                    $fti_var['match_dbg'] = 1;
                    nfc_setVar('match_dbg', $fti_var['match_dbg']);
                case 103:
                    // $ar = [$arg_val];
                    eval("\$ar = [$arg_val];");
                    print_r(nfc_match($ar));
                    break;
                case 104:
                    $rows = db_query(
                        "SELECT id
                            from wine
                            where status = 'new'
                            order by id desc
                            limit 2200, 23
                    ")->fetchAll(\PDO::FETCH_COLUMN);
                    print_r($rows);
                    print_r(nfc_match($rows)); //, 'MySQL'));
                    break;
                case 21:
                    $wines = [216575];//[89892,89895];
                    //$wines = db_query("SELECT id from gustos.gustos_wine where name regexp 'purcari'")->fetchAll(\PDO::FETCH_COLUMN);
                    // [81557, 140737, 142760, 142901, 143335, 143341, 143858, 143892, 156214, 171972, 172163, 172165];
                    // $wines = [765,815,6508,8266,8645,8803,8941,9067,9072,9077,9080,9154,10465,10769];
                    db_query("DELETE FROM nfc_expr_updates__arS");
                    $sql = "INSERT INTO nfc_expr_updates__arS (source__dsP, action__eC, action__id) VALUES\n('wine','acUpd',"
                        . (implode("),\n('wine','acUpd',", $wines)) . ")\n";
                    db_query($sql);
                case 22:
                    nfc_update();
                    break;
                case 23:
                    $regions = [16661];
                    db_query("DELETE FROM nfc_expr_updates__arS");
                    $sql = "INSERT INTO nfc_expr_updates__arS (source__dsP, action__eC, action__id) VALUES\n('region','acUpd',"
                        . (implode("),\n('region','acUpd',", $regions)) . ")\n";
                    //d($sql);
                    db_query($sql);
                    nfc_update();
                    break;                            
                case 24:
                    $vineyards = [902];
                    db_query("DELETE FROM nfc_expr_updates__arS");
                    $sql = "INSERT INTO nfc_expr_updates__arS (source__dsP, action__eC, action__id) VALUES\n('vineyard','acUpd',"
                        . (implode("),\n('vineyard','acUpd',", $vineyards)) . ")\n";
                    //d($sql);
                    db_query($sql);
                    nfc_update();
                    break;                                                        
                case 60:
                    //parsed__exDB_laad_country();
                    //parsed__exDB_laad_region();
                    //parsed__exDB_laad_producer();
                    parsed__exDB_laad_wine(1, 1);
                    break;
                case 61:
                    //parsed__exDB_laad_country(1, 1);
                    //parsed__exDB_laad_region(1, 1);
                    //parsed__exDB_laad_producer(1, 1);
                    parsed__exDB_laad_wine(0, 1);
                    parsed__exDB_save_score('nf');
                    break;
                case 61030:
                    $fti_var['match_dbg'] = 1;
                case 6103:
                    parsed__exDB_laad_wine(0, 1, ($arg_val ? $arg_val : 1000069));
                    break;
                case 62:
                    parsed__exDB_laad_wine(0, 0, '', 1, 3);       // $restore = 1 will update matching data in lwin__arS, else will create new score__arS group
                    //mf__ex_laad_wine(1, 1);
                    break;
                case 63:
                    parsed__exDB_laad_wine(0, 0);       // $restore = 1 will update matching data in lwin__arS, else will create new score__arS group
                    //mf__ex_laad_wine(0, -1);
                    break;

                case 70:
                    parsed__exDB_save_score('nf');
                    //parsed__exDB_save_score('mf');
                    // parsed__exDB_save_score('mf');
                    //parsed__exDB_restore_score('nf');
                    //parsed__exDB_producer_save_score();
                    break;
                case 71:
                    //mf__ex_laad_producer();
                    _is24297__nfc_laad_wine(1, 1);
                    //$fti_var['match_dbg'] = 1;
                    //_is24297__nfc_laad_wine(1, 1, '', 1, 'mySQL');
                    break;
                case 71030:
                    $fti_var['match_dbg'] = 1;
                case 7103:
                    //mf__ex_laad_producer();
                    _is24297__nfc_laad_wine(0, 1, ($arg_val ? $arg_val : 198));
                    break;
                case '70a':
                    parsed__exDB_create_tables();
                    break;
                case '71a':
                    _is24726__preload_prepare();
                    break;
                case '71b':
                    parsed__exDB_laad_wine('is24726_Wine_Republic_v4', 0, 1);
                    break;
                case 72:
                    parsed__exDB_save_score('nf', 'is24297__ID_wines');
                    //parsed__exDB_restore_score('nf', 'is24297__ID_wines');
                    //parsed__exDB_save_score('mf');
                    // parsed__exDB_save_score('mf');
                    //parsed__exDB_restore_score('nf');
                    //parsed__exDB_producer_save_score();
                    break;
                case 73:
                    parsed__exDB_save_db();
                    break;
                case 71030:
                    $fti_var['match_dbg'] = 1;
                case 7103:
                    mf__ex_laad_wine(0, 1, ($arg_val ? $arg_val : 1000085));
                    break;
                case 80:
                    nfcDB__backup();
                    break;
                case 81:
                    nfcDB__restore();
                    break;
                case 82:
                    if ($arg_val) {
                        nfcDB__restore($arg_val);
                    } else {
                        nfcDB__restore('2026-02-17 10:09:');
                        echo "\nThis comand is used only with date(YYYY-mm-dd hh:ii:) as prefix to restore\n";
                    }
                    break;
                case 83:
                    nfcDB__delete();
                    break;
                case 88:
                    link_expr('exGRAP');
                    reg_blends();
                    break;
                case 89:
                    //load_terms();
                    link_expr('exVINE');
                    break;
                case 90:
                    //$name = 'В-во Львівщина\Виноград Херсонщина';
                    $name = // "re:ee. 'sdfs d 'asasd r. t Mar+tín & Pons|as d. f. dads' B/V/Vinař'ství's sd. Eco' s'Bia d.g nco s.d. de Santar, S.A)";
                        //"Villa Tinta / ТОВ Винхол Оксамитне (Vinhol Oksamitnoe)";
                        //"Aimé Roquesante";
                        " E.B's PI.SpA dd:fg&hfh -d&f&g  3+4 a .s. d&hf'g L.Ii: ak, ou V. & Co. T:iare &Soc. 'S'empl. 100 % S\$u@m^m?:er Can'tine Do-Re-Mi Wine-N-More Soc.ieta' Agricola) / Vaccarèse/ Brun Argenté";
                    $name = "Karija l'Osü"; // "Sparkling wine \"Botter Brut\" 0.75л";
                    $name = "J2L 12'23-44 asda 2'23-44 ssss a'f'g. sdf s'Oro The I’M Winery 2018 E.B's The Albă 12% alc Gris sec alc 12% 0.75alc. Governor’s D/DULCE DIVUS D/D c/sel CABER.SAUV/RARA.NEAGRA rosu alc. 0.75l, anul 2022 the";
                    //$name = "Winemaker station ( Виноробна станція / ТОВ \"Таїрове\")";
                    $fti_row['countries'] = ''; //995;
                    $fti_row['type__cnt'] = $fti_row['title__cnt'] = 0;
                    $fti_expra = [];
                    $nnane = parse_name($fti_var['exWINE'],preg_replace('/\s*[&+]\s*/u', ' ', $name),  $fti_var['syGroupRP']);
                    $terms = [];
                    if (isset($fti_expra['term'])) {
                        foreach($fti_expra['term'] as $term => $val) {
                            $terms['terms'][$term] = db_query("SELECT _term__asFL_dsP($term)")->fetchColumn();
                        }
                    }
                    foreach($fti_expra['found'] as $term => $val) {
                        $terms['attr'][$term] = db_query("SELECT _attr__asFL(" . current($val) . ")")->fetchColumn();
                    }
                    $terme = [];
                    foreach($fti_terme as $term => $val) {
                        //d($fti_terme, $term, $val);
                        if (count($val))
                        $terme['terms'][$term] = db_query("SELECT group_concat(dsP separator ' ') from nfc_word__arP where arP in (" . implode(',', $val) . ")")->fetchColumn();
                    }
                    $term_arr = [];
                    $regiTYPE = $fti_var['regiTYPE'][0];
                    if (isset($mix__arr[$regiTYPE]['attr__eMB'])) {
                        $term_arr = $fti_expra['attr'];
                    }
                    dd($name,norm_it($name),$nnane, $fti_expra,'terms=', $fti_terms,"fti_terme=", $fti_terme, "terme=", $terme, $terms, $mix__arr, $term_arr, $fti_row);
                    break;
                case 91:
                    //$name = "Lombard (Israel)";
                    $name = "sddd 4G Wines";//"Winemaker station ( Виноробна станція / ТОВ \"Таїрове\")"; //"Bottega S.p.A."; // "Egon Müller, Kanta, Riesling 2015"; //"Geografico";//"Gallius - Vinhos, Lda";//
                    //$name = "Provin Bordeaux (Château Jean Faux)";
                    //$name = "Valle del Maule - San Javier";
                    //$name = "Merlot / Moldova";
                    //$name = "Mission Saint Vincent (St Vincent)";
                    //$name = "Alchemy Wines";
                    //$name = "FARM Napa Valley";
                    //$name = "los dos";
                    //$name = "Eros Winery (North Macedonia)";
                    $fti_row['countries'] = ''; //995;
                    echo "\n$name\n" . norm_it($name);
                    $fti_expra['word'] = [];
                    $fti_expra['term'] = []; //-
                    //$norm_name =  norm_it(preg_replace('/\s*[&+]\s*/u', ' ', $name)); preg_replace('/\s*[&+_"]\s*/u', ' ', 
                    $norm_name =  preg_replace('/^\s*\d+\s*[[:punct:]](?!\d)|[[:punct:]]\s*\d+\s*([[:punct:]](?!\d)|$)/u', '', norm_it(preg_replace('/\s*[&+_"]\s*/u', ' ', $name)));
                    parse_name($fti_var['exVINE'], $norm_name, $fti_var['syGroupVT']);
                    //expra_word($norm_name);
                    //search_terms($fti_var['syGroupVT'], $fti_var['exVINE'][0]);
                    //d(norm_it($name), $fti_expra, $fti_terme);
                    //search_terms($fti_var['syGroupRP'], $fti_var['exWINE'][0]);
                    $terms = [];
                    foreach($fti_terme as $term => $val) {
                        //d($fti_terme, $term, $val);
                        if (count($val))
                        $terms['terms'][$term] = db_query("SELECT group_concat(dsP separator ' ') from nfc_word__arP where arP in (" . implode(',', $val) . ")")->fetchColumn();
                    }
                    foreach($fti_expra['found'] as $term => $val) {
                        foreach ($val as $v) {
                            $terms['attr'][$term][$v] = db_query("SELECT _attr__asFL($v)")->fetchColumn();
                        }
                    }
                    $ft = [];
                    foreach ($fti_terms as $typ => $arr) {
                        foreach ($arr as $k => $v) {
                            $ft[$typ][$k] = "$v/" . db_query("SELECT _term__asFL_dsP($k)")->fetchColumn();
                        }
                    }
                    dd($norm_name,$fti_expra,'terms=', $fti_terms,$ft,"terme=", $fti_terme, $terms, $mix__arr);
                    break;
                case 92:
                    $fti_row = [
                        'name' => "Bottega S.p.A.",
                        'id' => 300001,
                        'expr__eMI' => 0,
                        'countries' => 1131,
                        'wines__cnt' => 1
                    ];
                    $arP = reg_vineyard();
                    $dsP = db_query("SELECT _expr__asFL($arP)")->fetchColumn();
                    dd($fti_row, $fti_expra, $fti_terme, $mix__arr, $arP, $dsP);
                    break;
                case 93:
                    $id = 4300;//19638;//114407;//6643;//453; //98819; //169754; //37720; //
                    nfc_load_all();
                    $fti_row = db_query("CALL nfc_expr__asPL_wine_gustosapp(0, $id)")->fetchAll(\PDO::FETCH_ASSOC)[0];
                    echo "\n" . norm_it($fti_row['name']) . "\n";
                    $norm_name = reg_wine_attr(1); //reg_wine(); //
                    dd($norm_name, $fti_row, $fti_expra, $fti_terme, $mix__arr, $fti_terms, $fti_sqr['r7'], $fti_sqr['r8']);
                case 94:
                    $exREGI = $fti_var['exREGI'][0];
                    $id = 7407;
                    $fti_row = db_query("CALL nfc_expr__asPL_regi_gustosapp(0, $id)")->fetchAll(\PDO::FETCH_ASSOC)[0];
                    $fti_row['expr__eMI'] = 0;
                    $arP = db_query("SELECT arP from nfc_expr__arP where id = $id and expr__eS = $exREGI")->fetchColumn() ?? 0;
                    $dups = reg_region_clear($arP, $id);
                    echo "\narP($arP), dups($dups), name_it(" . norm_it($fti_row['name']) . ")\n";
                    reg_region($arP); //reg_wine(); //
                    dd($fti_row, $fti_expra, $fti_terme, $mix__arr, $fti_terms, $fti_sqr['r7'], $fti_sqr['r8']);
                case 97:
                    nfc_load_all();
                    $fti_row = db_query("CALL nfc_expr__asPL_wine_gustosapp(0, 64637)")->fetchAll(\PDO::FETCH_ASSOC)[0];
                    $arP = 3248260;
                    $fti_sqr['r0'] = [];
                    $fti_sqr['r0'][] = "DELETE from nfc_expr_wine__acPG where wine__id = 64637";
                    $fti_sqr['r0'][] = "DELETE from nfc_expr_wine__arPD where arP = $arP";
                    reg_wine($arP);
                    break;
                case 98:
                    $wine_id = 107109;
                    $vine__id = 91; // 26347 Maiden + Liberty // 38547	Spain	Bodega y Viñedos Heredad Morán & López
                    // 27266931,mack schuhle	813	Italy	Mack & Schühle AG
                    // 27276833,martin	11902	Spain	Martín & Pons
                    $regi__tid = 7216;
                    $grap__id = 478;
                    $sql1 =
                        "SELECT 'wine' as source__dsP, 'acUpd' as action__eC, $wine_id as action__id
                        UNION ALL
                        SELECT 'vineyard', 'acUpd', $vine__id
                        UNION ALL
                        SELECT 'region', 'acUpd', $regi__tid
                        UNION ALL
                        SELECT 'grape', 'acUpd', $grap__id
                    ";
                    $sql2 =
                        "SELECT 'wine' as source__dsP, 'acUpd' as action__eC, $wine_id as wine_id
                    ";
                    $sql3 =
                        "SELECT 'vineyard' as source__dsP, 'acUpd' as action__eC, vine__id
                            from nfc_expr_vineyard__arPD as t1
                                left join nfc_expr__acPU_term as t2 on t2.expr__arP = t1.arP
                            where t2.expr__arP is null    
                    ";
                    $sql4 = 
                        "SELECT 'vineyard' as source__dsP, 'acUpd' as action__eC, v.vine__id as action__id
                            from nfc_expr_vineyard__arPD v
                                left join nfc_expr__acPU_term u on u.expr__arP = v.arP 
                            where 1=1
                                and u.expr__arP is null
                    ";
                    $sql = $sql2;
                    db_query("DELETE from nfc_expr_updates__arS");
                    db_query("INSERT INTO nfc_expr_updates__arS (source__dsP, action__eC, action__id) $sql");
                    nfc_update();
                    // $name = db_query("select _tName__asFL('wine', $wine_id)")->fetchColumn();
//                            $name = db_query("select _tName__asFL('vineyard', $vine__id)")->fetchColumn();
//                            $name = db_query("select _tName__asFL('region', $regi__tid)")->fetchColumn();
//                            $name = db_query("select _tName__asFL('grape', $grap__id)")->fetchColumn();
                    dd($fti_expra, $fti_terme, $fti_terms, $mix__arr);
                    break;
                case 99:
                    $wine_id = 107109;
                    $vine__id = 4830;
                    $regi__tid = 5782;
                    $grap__id = 478;
                    $sql1 =
                        "INSERT INTO nfc_expr_updates__arS
                            (source__dsP, action__eC, action__id) VALUES
                            ('wine', 'acUpd', $wine_id),
                            ('vineyard', 'acUpd', $vine__id),
                            ('region', 'acUpd', $regi__tid),
                            ('grape', 'acUpd', $grap__id)
                    ";
                    $sql2 =
                        "INSERT INTO nfc_expr_updates__arS
                            (source__dsP, action__eC, action__id) VALUES
                            ('wine', 'acUpd', $wine_id)
                    ";
                    $sql3 =
                        "INSERT INTO nfc_expr_updates__arS
                            (source__dsP, action__eC, action__id)
                        select
                            'wine', 'acUpd', id
                        from gustos.gustos_wine
                        where name regexp '[#№]'
                    ";
                    db_query($sql3);
                    $fti_sqr['r6'] = $fti_sqr['r41'] = $fti_sqr['r3'] = $fti_sqr['r2'] = $fti_sqr['r1'] = $fti_sqr['r0'] = '';
                    nfc_update();
                    $wine_name = db_query("select _xName__asFL('wine', $wine_id)")->fetchColumn();
                    $vineyard_name = db_query("select _xName__asFL('vineyard', $vine__id)")->fetchColumn();
                    $regi_name = db_query("select _xName__asFL('region', $regi__tid)")->fetchColumn();
                    $grape_name = db_query("select _xName__asFL('grape', $grap__id)")->fetchColumn();
                    dd($wine_name,$vineyard_name,$regi_name,$grape_name);
                    //dd($vineyard_name, $fti_sqr['r0'],$fti_sqr['r1'],$fti_sqr['r2'],$fti_sqr['r3'],$fti_sqr['r4'],$fti_sqr['r6']);
                    //dd($name, $fti_sqr['r0'],$fti_sqr['r1'],$fti_sqr['r2'],$fti_sqr['r3'],$fti_sqr['r4'],$fti_sqr['r6']);
                    break;
                case 't0':
                    nfc_update();
                    break;
                case 't1':
                    nfc_updates_7008();
                    break;
                case 't2':
                    nfc_updates_7009();
                    break;
                case 't3':
                    nfc_setVar('match_dbg', 1);
                    if ($arg_val) {
                        _is24956_Wines_Croitoru__laad(0,0,$arg_val);
                    } else {
                        _is24956_Wines_Croitoru__laad(0,0,43);
                    }
                    break;

                case 't4a':
                case 't4b':
                    parsed__exDB_laad('alcomarket');
                    break;
                case 't4c':
                    parsed__exDB_laad('carpe_diem');
                    break;
                case 't4d':
                    parsed__exDB_laad('linella');
                    break;
                case 't4e':
                    parsed__exDB_laad('vincuvin');
                    break;
                case 't4f':
                    parsed__exDB_laad('wine_md');
                    break;
                case 't4g':
                    parsed__exDB_laad('wine_time');
                    break;
                case 't4h':
                    parsed__exDB_laad('metro_parsing');
                    break;
                case 't4z':
                    $score__arS = parsed__exDB_laad('alcomarket');
                    //*
                    parsed__exDB_laad('carpe_diem');
                    parsed__exDB_laad('linella');
                    parsed__exDB_laad('vincuvin');
                    parsed__exDB_laad('wine_md');
                    parsed__exDB_laad('wine_time');
                    parsed__exDB_laad('metro_parsing');
                    //*/
                    $res = db_query(
                        "SELECT
                            sum(__dur) as s__dur, sum(__cnt) as s__cnt
                            FROM $fti_parsedwine__exDB.src_score__arS
                            where arS >= $score__arS
                    ")->fetchAll(\PDO::FETCH_ASSOC)[0] ?? ['s__cnt' => 0, 's__dur' => 0];
                    dop("  10a - 1 - Matched all wine entries: " . $res['s__cnt']);
                    dop("  10a - 2 - Matched all duration: " . intdiv($res['s__dur'], 60) . ":" . ($res['s__dur'] % 60));
                    break;
                case 't5a0':    
                    //$fti_var['match_dbg'] = 1;
                    //nfc_setVar('match_dbg', $fti_var['match_dbg']);
                    parsed__exDB_is25559_gw_without_medals__laad(1, '987');
                    break;
                case 't5a':
                    parsed__exDB_is25559_gw_without_medals__laad('gw_without_medals');
                    break;
                case 't5b':
                    parsed__exDB_is25559_gw_without_medals__laad('25669_gw_without_medals');
                    break;
                case 't6a':
                    parsed__exDB_laad('parse_armenia', 'is26763', '5'); //, 0, 0, 86);
                    break;
                case 't6b':
                    parsed__exDB_laad('parse_armenia', 'is26763', 'msf'); //, 0, 0, 86);
                    break;
                case 'm2':
                    _is24956_Wines_Croitoru__laad(0, 0, '', 1, 0, 'msf');
                    break;
                case 'u1': // update vintage in gustos_wine_entity using awards group
                    $recs = db_query("SELECT nfc_gustos_wine_entity__acFL_fix_vintage()")->fetchColumn() ?? 0;
                    dop("  Number of gustos_wine_entity records field vintage updated: $recs");
                    break;
                case 'u2': // just call update 
                    nfc_update();
                    break;
                case 'u3':
                    merge_grapes_link($arg_val);
                    break;
                case 'u4':
                    break;
                case 'u5':
                    break;
                case 'u6':
                    reg_attributes();
                    break;
                case 'u7':
                    db_query("UPDATE src_old_regions set new__id = NULL");
                    regions_preserv_restore();
                    db_query("call nfc_expr_regi__arPD_span__asPL_create()");
                    break;
                case 'rs8':
                    nfc_rs_regi__reg(($arg_val ? $arg_val : 0)); // 0 (def) - skeep initing tables / 1 - init main table  / 2 - init second table
                    break;
                case 'rs9':
                    nfc_rs_vine__reg(($arg_val ? $arg_val : 0));
                    break;
                case 'rsR':
                    $sql = nfc_rs__rep($arg_val ? $arg_val : 'regi'); // (def) = 'regi'
                    echo "\n$sql\n";
                    break;
                case 'rsV':
                    $sql = nfc_rs__rep('vine');
                    echo "\n$sql\n";
                    break;
                case 'rsM':
                    $ret = nfc_rs__match("AGRELO - LUJAN DE CUYO & LOS CHACAYES AND PARAJE ALTAMIRA - UCO VALLEY"); //("Saint Clair Pioneer Block 14 Doctor’s Creek Pinot Noir 2019");
                    dd($ret);
                    break;
                case 're1':
                    // $pw__id = db_query("")->fetchColumn() ?? 0;
                    $pw__id = 610036; // 1-st for '2025-10-01'
                    $pw__id = 252663; // 1-st for '2023-10-01'
                    $pw__id = 383264; // 1-st for '2023-11-01'
                    parsed__exDB_reMatch(($arg_val ? $arg_val : $pw__id), 5000);
                    break;
                case 're2':
                    $pw__id = 222665; //383264; // 1-st for '2023-11-01'
                    $wa__id = 489542;
                    parsed__exDB_reMatch_admins(0, 5000, $wa__id);
                    //parsed__exDB_reMatch_admins(498269, 1);
                    break;
    }   

}
