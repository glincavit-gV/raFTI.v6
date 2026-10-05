<?php
include_once '_o001a_raCore__acPP_meta.php';
include_once '_o002a_raCore__acPP_ini.php';

$pp = '_p002a';
function _raCore_iniTables() {
  global $RA, $dst;

  extract($RA['__tySEP']);
$pp = '_p002b';
  $RA_raTY__arDS_cn__arDS = 0;
  $RA_raTY__arDS_cxN__arDS = 1;
  $src['_raTY__arP'] = [
    [RA_cn__arDS, 'cxN__arDS', 'cxF__EXPR', 'expl__vbKB', 'val__tyFLD', 'rule__EXPR', 'te__EXPR'],
//                                                ===== rule__EXPR ====, te__EXPR
//                                               '/dsCX/,/dsCN/,/dsABR'
    ['_OM', '', '', 'Object Model -- ', '__enZB', '_ZZ , _WA , _CCC', '_/ds'],
    ['_RA', '_OM', '', 'Relate Assemblis -- global context', '__enZB', '_ZZ , _WA , _CCC', '_/ds'],
    ['_omFCC', '_OM', '', 'Facet Class Code -- name spaces', '__enZB', '_cxN_AA , _WA , _sCC', '_/ds'],
    ['_omALT', '_OM', '', 'alternatives -- meta type', '__enZB', '_cxN_AA , _AT , _sCC', '_/ds'],
    ['_omDS', '_OM', '', 'designation -- all type of desegnation by rules abrised in template - _arDS(rule__EXPR)', '__enZB', '_cxN_AA , _WA , _sCC', '_/ds'],
    ['_omTE', '_OM', '', 'template -- sub context for temlate description vs content', '__enZB', '_cxN_AA , _AD , _sCC', '_/ds'],
    ['_omTY', '_OM', '', 'types', '__enZB', '_cxN_AA , _AD , _sCC', '_/ds'],
    ['_omLI', '_OM', '', 'list', '__enZB', '_cxN_AA , _AD , _sCC', '_/ds'],
    ['_omHIE', '_OM', '', 'hierachy', '__enZB', '_cxN_AA , _AT , _sCC', '_/ds'],
    ['_hieSCH', '', '_omHIE', 'schema : S', '__evQB', '_cxN_NA , _AT , _sCC', '_/ds'],
    ['_hieM', '_hieSCH', '_omHIE', 'modules : SM', '__evQB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_hieA', '_hieM', '_omHIE', 'aggregates : SMA', '__evQB', '_cxN_NA , _WA , _zCC', '_/ds'],
    ['_hieC', '_hieA', '_omHIE', 'components : SMAC', '__evQB', '_cxN_NA , _WA , _zCC', '_/ds'],
    ['_hieO', '_hieC', '_omHIE', 'objects : SMACO', '__evQB', '_cxN_NA , _WA , _zCC', '_/ds'],
    ['_hieV', '_hieC', '_omHIE', 'variables -- or fields : SMACOV', '__evQB', '_cxN_NA , _WA , _zCC', '_/ds'],
    ['_altXN', '_omALT', '', 'Context/Content -- ', '__enZB', '_cxN_NA , _LL , _sCC', '_/ds'],
    ['_cX', '_altXN', '', 'Context -- ', '__enZB', '_AS , _LL , _sCC', '_/ds'],
    ['_cN', '_altXN', '', 'Content -- ', '__enZB', '_AS , _LL , _sCC', '_/ds'],
    ['_altLI', '_omALT', '_omLI', ' -- named list of consecutive values', '__enZB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_li0Z', '_altLI', '', ' 0-9A-Z -- regexp like range of values : 36', '__evZB', '_AS , _LL , _sCC', '_/ds'],
    ['_liAZ', '_altLI', '', ' a-z -- --//-- : 26', '__evZB', '_AS , _LL , _sCC', '_/ds'],
    ['fci', '_omFCC', '', 'initiatives -- name space : "i" + li0Z', '__evPQ', '_cxN_ND , _WA , _sCC', 'ds'],
    ['fcm', '_omFCC', '_hieM', 'modules -- name space : "m" + li0Z', '__evPQ', '_cxN_ND , _cxF_NA , _sCC', 'ds'],
    ['fca', '_omFCC', '_hieA', 'aggregates -- name space : "a" + li0Z', '__evPQ', '_cxN_ND , _cxF_NA , _sCC', 'ds'],
    ['fco', '_omFCC', '_hieO', 'objects -- name space : li0Z + liAZ', '__evPQ', '_cxN_ND , _cxF_NA , _sCC', 'ds'],
    ['_fcoR', '_omFCC', 'fco', 'result -- functor : @fcm + @fca + @fco ', '__evPQ', '_cxN_ND , _WA , _sCC', 'ds'],
    ['fcd', '_omFCC', '', 'documents -- name space: "d" + @_fcoR', '__evPQ', '_cxN_ND , _WA , _sCC', 'ds'],
    ['fcp', '_omFCC', '', 'programm -- points - name space : "p" + @_fcoR', '__evPQ', '_cxN_ND , _WS , _sCC', 'ds'],
    ['fce', '_omFCC', '', 'errors -- name space : "e" + @_fcoR', '__evPQ', '_cxN_ND , _WA , _sCC', 'ds'],
    ['fcs', '_omFCC', '', 'short -- mesage - name space : "s" + @_fcoR', '__evPQ', '_cxN_ND , _WA , _sCC', 'ds'],
    ['fcf', '_omFCC', '', 'filed -- name space : "s" + @_fcoR', '__evPQ', '_cxN_ND , _WA , _sCC', 'ds'],
    ['_altNUM', '_omALT', '', 'numbers', '__enZB', '_cxN_NA , _AT , _sCC', '_/ds'],
    ['_numZ', '_altNUM', '', 'zero : 0', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numS', '_altNUM', '', 'singlet : 1', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numD', '_altNUM', '', 'duplet : 2', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numT', '_altNUM', '', 'triplet : 3', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numQ', '_altNUM', '', 'quadlet : 4', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numP', '_altNUM', '', 'pintet : 5', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numQS', '_altNUM', '_numQ + _numS', ' : 6', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_numQD', '_altNUM', '_numQ + _numD', ' : 7', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_numO', '_altNUM', '', 'octet : 8', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numOS', '_altNUM', '_numO + _numS', ' : 9', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_numOD', '_altNUM', '_numO + _numD', ' : 10', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_numOT', '_altNUM', '_numO + _numT', ' : 11', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_numOQ', '_altNUM', '_numO + _numQ', ' : 12', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_numOP', '_altNUM', '_numO + _numP', ' : 13', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_numH', '_altNUM', '', 'hextet : 16', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numL', '_altNUM', '_numS', 'last : 1', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numB', '_altNUM', '_numS', 'byte -- synonym to _numS : 1', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numE', '_altNUM', '_numD', 'edge : 2', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numA', '_altNUM', '', 'all : -1', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_numN', '_altNUM', '_cN', 'all _cN part : -1', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_numX', '_altNUM', '_cX', 'all _cX part : -1', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_altTKN', '_omALT', '', 'token -- designation part or field to use', '__enZB', '_cxN_NA , _CT , _sCC', '_/ds'],
    ['_tknZ', '_altTKN', '_numZ : _altNUM', ' -- skip current or number - 2 ^ _numZ : 1', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_tknS', '_altTKN', '_numS : _altNUM', ' -- number - 2 ^ _numS : 2', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_tknD', '_altTKN', '_numD : _altNUM', ' -- number -  2 ^ _numD : 4', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_tknT', '_altTKN', '_numT : _altNUM', ' -- number -  2 ^ _numT : 8', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_tknQ', '_altTKN', '_numQ : _altNUM', ' -- number -  2 ^ _numQ : 16', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_tknP', '_altTKN', '_numP : _altNUM', ' -- number -  2 ^ _numP : 32', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_tknO', '_altTKN', '_numO : _altNUM', ' -- number -  2 ^ _numO : 256', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_tknK', '_altTKN', '_altNUM', 'kilo -- number -  2 ^ 10 : 1024', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_tknM', '_altTKN', '_altNUM', 'mega -- number -  2 ^ 20 : 1048576', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_tknG', '_altTKN', '_altNUM', 'giga -- number -  2 ^ 30 : 1073741824', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_tknA', '_altTKN', '', 'any -- use vocals or consonants symbols : -1', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_tknC', '_altTKN', '', 'consonant -- use consonants symbols : -1', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_tknV', '_altTKN', '', 'vocal -- use vocals symbols : -1', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_tknL', '_altTKN', '', 'ligature -- sequence of consonants symbols : -1', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_tknW', '_altTKN', '', 'word -- use 1-st symbols from word : -1', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_tknF', '_altTKN', '', 'fixe -- words represented in mor-phe-me to use as legature: -1', '__evDB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_tknN', '_altTKN', '_cN', ' -- use symbols from part _cN : -1', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_tknX', '_altTKN', '_cX', ' -- use symbols from part _cX : -1', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_tknR', '_altTKN', '', 'reference -- use symbols from reference value : -1', '__evDB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_cxN', '_altTKN', 'cxN__arDS', ' -- use this field conetnt : -1', '__evDB', '_cxF_AA , _ZZ , _zzz', '_/ds'],
    ['_cxF', '_altTKN', 'cxF__EXPR', ' -- use this field conetnt : -1', '__evDB', '_cxF_AA , _ZZ , _zzz', '_/ds'],
    ['_tknNUM', '_altTKN', '_altNUM : _omTE', ' -- template to combine from cxF', '__enZB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_ZZ', '_tknNUM', '_tknZ + _numZ : _altNUM', ' -- skip current or number - 2 ^ _numZ * _numZ : 0', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_AA', '_tknNUM', '_tknA + _numA', ' -- use any all (vocals or consonants) symbols or coresponding field subpart : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_CA', '_tknNUM', '_tknC + _numA', ' -- use all consonant symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_VA', '_tknNUM', '_tknV + _numA', ' -- use all vocal symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_LA', '_tknNUM', '_tknL + _numA', ' -- use all ligature(sequence of consonants) 1-st symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_AE', '_tknNUM', '_tknA + _numE', ' -- use any edge (vocals or consonants) symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_CE', '_tknNUM', '_tknC + _numE', ' -- use edge both (1-st and last) consonant symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_VE', '_tknNUM', '_tknV + _numE', ' -- use edge both vocal symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_LE', '_tknNUM', '_tknL + _numE', ' -- use edge both ligature 1-st symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_AL', '_tknNUM', '_tknA + _numL', ' -- use any last (vocals or consonants) symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_CL', '_tknNUM', '_tknC + _numL', ' -- use last (1-st and last) consonant symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_VL', '_tknNUM', '_tknV + _numL', ' -- use last vocal symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_LL', '_tknNUM', '_tknL + _numL', ' -- use last ligature symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_AS', '_tknNUM', '_tknA + _numS', ' -- use any singlet (vocals or consonants) symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_AD', '_tknNUM', '_tknA + _numD', ' -- use any duplet (vocals or consonants) symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_AT', '_tknNUM', '_tknA + _numT', ' -- use any triplet (vocals or consonants) symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_VS', '_tknNUM', '_tknV + _numS', ' -- use vocals singlet symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_VD', '_tknNUM', '_tknV + _numD', ' -- use vocals duplet symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_VT', '_tknNUM', '_tknV + _numT', ' -- use vocals triplet symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_CS', '_tknNUM', '_tknC + _numS', ' -- use consonant singlet symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_CD', '_tknNUM', '_tknC + _numD', ' -- use consonant duplet symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_CT', '_tknNUM', '_tknC + _numT', ' -- use consonant triplet symbols : -1', '__enZB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_LS', '_tknNUM', '_tknL + _numS', ' -- use singlet ligature 1-st symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_LD', '_tknNUM', '_tknL + _numD', ' -- use duplet ligature 1-st symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_LT', '_tknNUM', '_tknL + _numT', ' -- use triplet ligature 1-st symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_WS', '_tknNUM', '_tknW + _numS', ' -- use word singlet 1-st symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_WD', '_tknNUM', '_tknW + _numD', ' -- use words duplet 1-st symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_WT', '_tknNUM', '_tknW + _numT', ' -- use words triplet 1-st symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_WA', '_tknNUM', '_tknW + _numA', ' -- use all words 1-st symbols - as abreviation : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_WL', '_tknNUM', '_tknW + _numL', ' -- use last word 1-st symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_WE', '_tknNUM', '_tknW + _numE', ' -- use edge words 1-st symbols : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_FS', '_tknNUM', '_tknF + _numS', ' -- use singlet fixe 1-st symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_FD', '_tknNUM', '_tknF + _numD', ' -- use duplet fixes 1-st symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_FT', '_tknNUM', '_tknF + _numT', ' -- use triplet fixes 1-st symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_FL', '_tknNUM', '_tknF + _numL', ' -- use last fixe 1-st symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_FE', '_tknNUM', '_tknF + _numE', ' -- use edge fixes 1-st symbol : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_NS', '_tknNUM', '_tknN + _numS', ' -- use all _cN symbols part from singlet sub parts : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_ND', '_tknNUM', '_tknN + _numD', ' -- use all _cN symbols part from  duplet sub parts : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_NL', '_tknNUM', '_tknN + _numL', ' -- use last symbol from _cN part : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_NA', '_tknNUM', '_tknN + _numA', ' -- use all _cN symbols part from all sub parts : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_XS', '_tknNUM', '_tknN + _numS', ' -- use all _cX symbols part from singlet sub parts : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_XD', '_tknNUM', '_tknN + _numD', ' -- use all _cX symbols part from duplet sub parts : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_XL', '_tknNUM', '_tknN + _numL', ' -- use last symbol from _cX part : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_XA', '_tknNUM', '_tknN + _numA', ' -- use all _cX symbols part from all sub parts : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_RS', '_tknNUM', '_tknR + _numS', ' -- use singlet symbol from reference value : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_RD', '_tknNUM', '_tknR + _numD', ' -- use duplet symbols from reference value : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_RT', '_tknNUM', '_tknR + _numT', ' -- use triplet symbols from reference value : -1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_RV', '_tknNUM', '_tknR', 'value -- use value all _symbols from reference value : -1', '__evDB', '_cxF_NS , _WA , _CCC', '_/ds'],
    ['_ZB', '_tknNUM', '_tknZ + _numB : _altNUM', ' -- number - 2 ^ _numZ * _numB : 1', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_SB', '_tknNUM', '_tknS + _numB : _altNUM', ' -- number - 2 ^ _numS * _numB : 2', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_DB', '_tknNUM', '_tknD + _numB : _altNUM', ' -- number - 2 ^ _numD * _numB : 4', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_TB', '_tknNUM', '_tknT + _numB : _altNUM', ' -- number - 2 ^ _numT * _numB : 8', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_QB', '_tknNUM', '_tknQ + _numB : _altNUM', ' -- number - 2 ^ _numQ * _numB : 16', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_PB', '_tknNUM', '_tknP + _numB : _altNUM', ' -- number - 2 ^ _numP * _numB : 32', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_PD', '_tknNUM', '_tknP + _numD : _altNUM', ' -- number - 2 ^ _numP * _numD : 64', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_PQ', '_tknNUM', '_tknP + _numQ : _altNUM', ' -- number - 2 ^ _numP * _numQ : 128', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_OB', '_tknNUM', '_tknO + _numB : _altNUM', ' -- number - 2 ^ _numO * _numB : 256', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_OD', '_tknNUM', '_tknO + _numD : _altNUM', ' -- number - 2 ^ _numO * _numD : 512', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_KB', '_tknNUM', '_tknK + _numB : _altNUM', ' -- number - 2 ^ 10 * _numB : 1024', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_KD', '_tknNUM', '_tknK + _numD : _altNUM', ' -- number - 2 ^ 10 * _numD : 2048', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_KQ', '_tknNUM', '_tknK + _numQ : _altNUM', ' -- number - 2 ^ 10 * _numQ : 4192', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_KO', '_tknNUM', '_tknK + _numO : _altNUM', ' -- number - 2 ^ 10 * _numO : 8384', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_KH', '_tknNUM', '_tknK + _numH : _altNUM', ' -- number - 2 ^ 10 * _numH : 16768', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_HB', '_tknNUM', '_tknH + _numB : _altNUM', ' -- number - 2 ^ _numH * _numB : 65536', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'], 
    ['_HD', '_tknNUM', '_tknH + _numD : _altNUM', ' -- number - 2 ^ _numH * _numD : 131072', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'], 
    ['_HQ', '_tknNUM', '_tknH + _numQ : _altNUM', ' -- number - 2 ^ _numH * _numQ : 262144', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'], 
    ['_HO', '_tknNUM', '_tknH + _numO : _altNUM', ' -- number - 2 ^ _numH * _numO : 524288', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'], 
    ['_MB', '_tknNUM', '_tknM + _numB : _altNUM', ' -- number - 2 ^ _numM * _numB : 1048576', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_MD', '_tknNUM', '_tknM + _numD : _altNUM', ' -- number - 2 ^ _numM * _numD : 2097152', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_MQ', '_tknNUM', '_tknM + _numQ : _altNUM', ' -- number - 2 ^ _numM * _numQ : 4194304', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_MO', '_tknNUM', '_tknM + _numO : _altNUM', ' -- number - 2 ^ _numM * _numQ : 8388608', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_GB', '_tknNUM', '_tknG + _numB : _altNUM', ' -- number - 2 ^ _numG * _numB : 1073741824', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_GD', '_tknNUM', '_tknG + _numB : _altNUM', ' -- number - 2 ^ _numG * _numD : 2147483648', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_GQ', '_tknNUM', '_tknG + _numB : _altNUM', ' -- number - 2 ^ _numG * _numQ : 4294967296', '__evDB', '_ZZ , _cxF_ND , _CCC', '_/ds'],
    ['_cxN_AA', '_tknNUM', '_cxN + _AA', ' -- use all from cxN field symbols except type part : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxN_AS', '_tknNUM', '_cxN + _AS', ' -- use singlet sym. from cxN field symbols except type part : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],        
    ['_cxN_AD', '_tknNUM', '_cxN + _AD', ' -- use duplet sym. from cxN field symbols except type part : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],        
    ['_cxN_AT', '_tknNUM', '_cxN + _AT', ' -- use triplet sym. from cxN field symbols except type part : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],        
    ['_cxN_NA', '_tknNUM', '_cxN + _NA', ' -- use all _cN symbols part from all sub parts of cxN field : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxN_NL', '_tknNUM', '_cxN + _NL', ' -- use last symbol from _cN part of cxN field : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxN_XA', '_tknNUM', '_cxN + _NA', ' -- use all _cX symbols part from all sub parts of cxN field : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxN_RS', '_tknNUM', '_cxN + _RS', ' -- use singlet symbol from cxN reference value : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxN_RD', '_tknNUM', '_cxN + _RD', ' -- use duplet symbols from cxN reference value : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxN_RT', '_tknNUM', '_cxN + _RT', ' -- use triplet symbols from cxN reference value : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxN_RV', '_tknNUM', '_cxN + _RA', ' -- use all symbols from cxN reference value : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_AA', '_tknNUM', '_cxF + _AA', ' -- use all from cxF field symbols all sub parts except type part : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_AS', '_tknNUM', '_cxF + _AS', ' -- use all from cxF field symbols singlet sub parts except type part : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_AD', '_tknNUM', '_cxF + _AD', ' -- use all from cxF field symbols duplet sub parts except type part : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_AT', '_tknNUM', '_cxF + _AT', ' -- use all from cxF field symbols triplet sub parts except type part : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_NS', '_tknNUM', '_cxF + _NS', ' -- use all _cN symbols part from sinlet sub parts of cxF field : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_ND', '_tknNUM', '_cxF + _ND', ' -- use all _cN symbols part from duplet sub parts of cxF field : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_NA', '_tknNUM', '_cxF + _NA', ' -- use all _cN symbols part from all sub parts of cxF field : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_NL', '_tknNUM', '_cxN + _NL', ' -- use last symbol from _cN part of cxF field : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_XS', '_tknNUM', '_cxF + _XS', ' -- use all _cX symbols part from sinlet sub parts of cxF field : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_XD', '_tknNUM', '_cxF + _XD', ' -- use all _cX symbols part from duplet sub parts of cxF field : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_XA', '_tknNUM', '_cxF + _XA', ' -- use all _cX symbols part from all sub parts of cxF field : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_RS', '_tknNUM', '_cxF + _RS', ' -- use singlet symbol from cxF reference value : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_RD', '_tknNUM', '_cxF + _RD', ' -- use duplet symbols from cxF reference value : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_RT', '_tknNUM', '_cxF + _RT', ' -- use triplet symbols from cxF reference value : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_cxF_RV', '_tknNUM', '_cxF + _RA', ' -- use all symbols from cxF reference value : -1', '__evDB', '_cxF_AT , _ZZ , _zzz', '_/ds/_/dso:cxF_AA'],
    ['_dsCX', '_omDS', '_cX : _omTE', ' -- rule for _cX part of _omDS', '__enZB', '_cxN_NA , _cxF_AA , _sCC', '_/ds'],
    ['_dsCN', '_omDS', '_cN : _omTE', ' -- rule for _cN part of _omDS', '__enZB', '_cxN_NA , _cxF_AA , _sCC', '_/ds'],
    ['_dsABR', '_omDS', '_omTE', 'abris -- rule for capitalisation abris of _omDS in 3 parts', '__enZB', '_cxN_NA , _AT , _sCC', '_/ds'],
    ['_dsTE', '_omDS', '_omTE', ' -- rule for saparations of _omDS', '__enZB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['__tyABR', '_dsABR', '_omTY', ' -- type of abris', '__enZB', '_cxF_NA , _cxN_NA , _sCC', '__/ds'],
    ['_teABR', '_dsABR', '_omTE', '_/cx) + (cn) + (rest) -- template of abris', '__enZB', '_cxF_NA , _cxN_NA , _sCC', '_/ds'],
    ['_abZ', '__tyABR', '', 'zero -- capitalisation = leave as is', '__enZB', '_cxN_XA , _WA , _sCC', '_/ds'],
    ['_abS', '__tyABR', '', 'stringify -- capitalisation = lower case', '__enZB', '_cxN_XA , _WA , _sCC', '_/ds'],
    ['_abC', '__tyABR', '', 'capitalize -- capitalisation = upper case', '__enZB', '_cxN_XA , _WA , _sCC', '_/ds'],
    ['cx__tyABR', '__tyABR', '_cX : _teABR', ' -- capitalisation rule for _cX part of _omDS', '__enZB', '_cxF_AS , _ZZ , _ssZ', '_/ds/__/dso:_cxN_AA'],
    ['cn__tyABR', '__tyABR', '_cN : _teABR', ' -- capitalisation rule for _cN part of _omDS', '__enZB', '_cxF_AS , _ZZ , _ssZ', '_/ds/__/dso:_cxN_AA'],
    ['rest__tyABR', '__tyABR', '_teABR', 'rest -- parts capitalisation for _omDS', '__enZB', '_AA , _ZZ , _ssZ', '_/ds/__/dso:_cxN_AA'],
//                    '_/cx) + (cn) + (rest)'
    ['_zzz', '_dsABR', '_abZ + _abZ + _abZ', '', '__enZB', '_cxF_NA , _ZZ , _sss', '_/ds'],
    ['_szz', '_dsABR', '_abS + _abZ + _abZ', '', '__enZB', '_cxF_NA , _ZZ , _sss', '_/ds'],
    ['_zCC', '_dsABR', '_abZ + _abC + _abC', '', '__enZB', '_cxF_NS , _cxF_NA , _sCC', '_/ds'],
    ['_sCC', '_dsABR', '_abS + _abC + _abC', 'common ra cxCN like abris', '__enZB', '_cxF_NS , _cxF_NA , _sCC', '_/ds'],
    ['_sss', '_dsABR', '_abS + _abS + _abS', 'snake like abris', '__enZB', '_cxF_NA , _ZZ , _sss', '_/ds'],
    ['_ssC', '_dsABR', '_abS + _abS + _abC', '', '__enZB', '_cxF_NA , _ZZ , _ssC', '_/ds'],
    ['_ssz', '_dsABR', '_abS + _abS + _abZ', '', '__enZB', '_cxF_NA , _ZZ , _sss', '_/ds'],
    ['_CCC', '_dsABR', '_abC + _abC + _abC', '', '__enZB', '_ZZ , _cxF_NA , _CCC', '_/ds'],
    ['_sCs', '_dsABR', '_abS + _abC + _abS', 'camila singlet like abris', '__enZB', '_ZZ , _cxF_NA , _sCs', '_/ds'],
    ['_CsC', '_dsABR', '_abC + _abS + _abC', 'camila duplet like abris', '__enZB', '_ZZ , _cxF_NA , _CsC', '_/ds'],
    ['__tySEP', '_omTY', '', 'separator', '__enZB', '_cxN_NA , _AT , _sCC', '__/ds'],
    ['_sepCN', '__tySEP', '', "content -- or hierarchy level separator : $_sepCN", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ['_sepTY', '__tySEP', '', "type -- prefix : $_sepTY", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ['_sepADD', '__tySEP', '', "add -- or concatinate contexts : $_sepADD", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ['_sepMINUS', '__tySEP', '', "minus -- or deconcatinate contexts : $_sepMINUS", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ['_sepMULTIPLY', '__tySEP', '', "multiply -- content separator : $_sepMULTIPLY", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ['_sepVALUE', '__tySEP', '', "value -- or high level nod contexts : $_sepVALUE", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ['_sepBACKREF', '__tySEP', '', "low -- level nod contexts : $_sepBACKREF", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ['_sepLIST', '__tySEP', '', "list -- content separator : $_sepLIST", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ['_sepALT', '__tySEP', '', "alternatives -- content separator : $_sepALT", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ['_sepPART', '__tySEP', '', "part -- or path content separator : $_sepPART", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ['_sepREM', '__tySEP', '', "remarc -- content separator : $_sepREM", '__evQB', '_cxN_NA , _AD , _sCC', '_/ds'],
    ["$_sepCN", '_sepCN', '__tySEP', "content -- or hierarchy level separator : $_sepCN", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ["$_sepTY", '_sepTY', '__tySEP', "type -- prefix : $_sepTY", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ["$_sepADD", '_sepADD', '__tySEP', "add -- or concatinate contexts : $_sepADD", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ["$_sepMINUS", '_sepMINUS', '__tySEP', "minus -- or deconcatinate contexts : $_sepMINUS", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ["$_sepMULTIPLY", '_sepMULTIPLY', '__tySEP', "multiply -- content separator : $_sepMULTIPLY", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ["$_sepVALUE", '_sepVALUE', '__tySEP', "value -- or high level nod contexts : $_sepVALUE", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ["$_sepBACKREF", '_sepBACKREF', '__tySEP', "low -- level nod contexts : $_sepBACKREF", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ["$_sepLIST", '_sepLIST', '__tySEP', "list -- content separator : $_sepLIST", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ["$_sepALT", '_sepALT', '__tySEP', "alternatives -- content separator : $_sepALT", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ["$_sepPART", '_sepPART', '__tySEP', "part -- or path content separator : $_sepPART", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ["$_sepREM", '_sepREM', '__tySEP', "remarc -- content separator : $_sepREM", '__evQB', '_cxN_RV , _ZZ , _zzz', 'ds'],
    ['ds', '_dsTE', '', ' -- main functor for - _cX/cN parts', '__enZB', '_cxN_XA , _ZZ , _sss', 'ds'],
    ['dsx', '_dsTE', '_cX', ' -- _cX part ds', '__enZB', '_cxN_XA , _cxF_NA , _sss', 'ds'],
    ['dsn', '_dsTE', '_cN', ' -- _cX part ds', '__enZB', '_cxN_XA , _cxF_NA , _sss', 'ds'],
    ['dsa', '_dsTE', '', 'alternative -- to main functorwith with its own parameters', '__enZB', '_cxN_XA , _WA , _sss', 'ds'],
    ['dst', '_dsTE', '', '__tyOBJ -- use object type', '__enZB', '_cxN_XA , _AS , _sss', 'ds'],
    ['dso', '_dsTE', '', 'options', '__enZB', '_cxN_XA , _WA , _sss', 'ds'],

    ['__tyAGG', '_omTY', '_hieA', 'agg. -- types', '__enZB', '_cxN_NA , _AT , _sCC', '__/ds'],
    ['__tyGK', '_omTY', '', 'global key -- type ', '__enZB', '_cxN_NA , _WA , _sCC', '__/ds'],
    ['__tyOBJ', '_omTY', '', 'objects -- type ', '__enZB', '_cxN_NA , _AT , _sCC', '__/ds'],
    ['__tyFLD', '_omTY', '', 'field -- type ', '__enZB', '_cxN_NA , _CT , _sCC', '__/ds'],
    ['__tyIND', '_omTY', '', 'index -- type ', '__enZB', '_cxN_NA , _AT , _sCC', '__/ds'],
    ['__tyOFI', '_omTY', '', '__tyOBJ + __tyFLD + __tyIND', '__enZB', '_cxN_NA , _NS , _zCC', '__/ds'],
    ['__tyAR', '__tyAGG', '', 'register -- main component object', '__enZB', '_cxN_AT , _WA , _zCC', '__/ds'],
    ['__tyAC', '__tyAGG', '', 'component -- slave component object', '__enZB', '_cxN_AT , _WA , _zCC', '__/ds'],
    ['__tyAS', '__tyAGG', '', 'solution -- code component object', '__enZB', '_cxN_AT , _WA , _zCC', '__/ds'],
    ['_gkP', '__tyGK', '', 'primary -- global through all modules', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_gkS', '__tyGK', '', 'secondary -- global through current module', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_gkT', '__tyGK', '', 'tertiary -- global through current object - the ID like field outside the ra', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_gkDS', '__tyGK', '_omDS', ' -- global through all modules', '__enZB', '_cxN_NA , _cxF_NA , _sCC', '_/ds'],
    ['_gkD', '__tyGK', '', 'detalisation -- global through all modules - the ID like field outside the ra', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_gkA', '__tyGK', '', 'array -- global through all modules', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_gkF', '__tyGK', '', 'foreign/forward -- key for reference to forward (usual direction) - 1 to many rels', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_gkR', '__tyGK', '', 'revers -- key for refernce to inverse (unusual direction) - 1 to many rels', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_gkU', '__tyGK', '', 'unical -- key or index as _gkF but is unical - 1 to 1 rels', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_gkI', '__tyGK', '', 'index -- not key and not unical index', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['__arP', '__tyAR', '_gkP :  __tyOBJ : __tyOFI', 'primary register reference : __nuDB', '__evZB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__arS', '__tyAR', '_gkS : __tyOBJ : __tyOFI', 'secondary register reference : __nuDB', '__evZB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__arT', '__tyAR', '_gkT : __tyOBJ : __tyOFI', 'tertiary register reference : __nuDB', '__evZB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__arDS', '__tyAR', '_gkDS : __tyOBJ : __tyOFI', 'designation register reference : __vbPQ', '__evZB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__arPD', '__tyAR', '_gkP + _gkD : __tyOBJ : __tyOFI', 'primary detalisation reference : __arP', '__evZB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__arPA', '__tyAR', '_gkP + _gkA : __tyOBJ : __tyOFI', 'primary array reference : ', '__evZB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__arSD', '__tyAR', '_gkS + _gkD : __tyOBJ : __tyOFI', 'secondary detalisation reference : __arS', '__evZB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__arTD', '__tyAR', '_gkT + _gkD : __tyOBJ : __tyOFI', 'tertiary detalisation reference : __arT', '__evZB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['_acG', '__tyAC', '', 'grid -- ordered union ', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_acU', '__tyAC', '', 'union -- simple union', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_acP', '__tyAC', '', 'php -- file', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_acS', '__tyAC', '', 'sql -- file', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['__acPG', '__tyAC', '__gkP + _acG : __tyOBJ : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_ND , _sCC', '__/ds'],
    ['__acSG', '__tyAC', '__gkS + _acG : __tyOBJ : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_ND , _sCC', '__/ds'],
    ['__acTG', '__tyAC', '__gkT + _acG : __tyOBJ : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_ND , _sCC', '__/ds'],
    ['__acPU', '__tyAC', '__gkP + _acU : __tyOBJ : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_ND , _sCC', '__/ds'],
    ['__acSU', '__tyAC', '__gkS + _acU : __tyOBJ : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_ND , _sCC', '__/ds'],
    ['__acTU', '__tyAC', '__gkT + _acU : __tyOBJ : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_ND , _sCC', '__/ds'],
    ['__acPP', '__tyAC', '__gkP + _acP : __tyOBJ : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_ND , _sCC', '__/ds'],
    ['__acSP', '__tyAC', '__gkS + _acP : __tyOBJ : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_ND , _sCC', '__/ds'],
    ['__acTP', '__tyAC', '__gkT + _acP : __tyOBJ : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_ND , _sCC', '__/ds'],
    ['__asVS', '__tyAS', '__tyOBJ : __tyOFI', 'view select', '__enZB', '_cxN_NA , _WA , _sCC', '__/ds'],
    ['__asFN', '__tyAS', '__tyOBJ : __tyOFI', 'function', '__enZB', '_cxN_NA , _AE , _sCC', '__/ds'],
    ['__asFR', '__tyAS', '__tyOBJ : __tyOFI', 'functor -- used object name generation', '__enZB', '_cxN_NA , _AE , _sCC', '__/ds'],
    ['__asPS', '__tyAS', '__tyOBJ : __tyOFI', 'procedure select records', '__enZB', '_cxN_NA , _WD , _sCC', '__/ds'],
    ['__asPC', '__tyAS', '__tyOBJ : __tyOFI', 'procedure create/drop/modify objects', '__enZB', '_cxN_NA , _WD , _sCC', '__/ds'],
    ['__asPD', '__tyAS', '__tyOBJ : __tyOFI', 'procedure delete records', '__enZB', '_cxN_NA , _WD , _sCC', '__/ds'],
    ['__asPI', '__tyAS', '__tyOBJ : __tyOFI', 'procedure insert records', '__enZB', '_cxN_NA , _WD , _sCC', '__/ds'],
    ['__asPU', '__tyAS', '__tyOBJ : __tyOFI', 'procedure update records', '__enZB', '_cxN_NA , _WD , _sCC', '__/ds'],
    ['__asTBI', '__tyAS', '__tyOBJ : __tyOFI', 'trgger befor insert', '__enZB', '_cxN_NA , _WA , _sCC', '__/ds'],
    ['__asTBU', '__tyAS', '__tyOBJ : __tyOFI', 'trgger befor update', '__enZB', '_cxN_NA , _WA , _sCC', '__/ds'],
    ['__asTBD', '__tyAS', '__tyOBJ : __tyOFI', 'trgger befor delete', '__enZB', '_cxN_NA , _WA , _sCC', '__/ds'],
    ['__asTAI', '__tyAS', '__tyOBJ : __tyOFI', 'trgger after insert', '__enZB', '_cxN_NA , _WA , _sCC', '__/ds'],
    ['__asTAU', '__tyAS', '__tyOBJ : __tyOFI', 'trgger after update', '__enZB', '_cxN_NA , _WA , _sCC', '__/ds'],
    ['__asTAD', '__tyAS', '__tyOBJ : __tyOFI', 'trgger after delete', '__enZB', '_cxN_NA , _WA , _sCC', '__/ds'],
    ['__tyFI', '__tyFLD', '_omTE', 'interpritator', '__enZB', '_cxN_AT , _WA , _zCC', '__/ds'],
    ['__tyFG', '__tyFLD', '_omTE', 'granularity -- use _tknNUM variants', '__enZB', '_cxN_AT , _WA , _zCC', '__/ds'],
    ['_fiNI', '__tyFI', '', 'number int', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiNU', '__tyFI', '', 'number unsigned', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiNF', '__tyFI', '', 'number float', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiDD', '__tyFI', '', 'date day -- YYYY-mm-dd', '__enZB', '_cxN_NA , _WD , _sCC', '_/ds'],
    ['_fiDF', '__tyFI', '', 'date full -- YYYY-mm-dd hh:mm:ss', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiDU', '__tyFI', '', 'date unix', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiDS', '__tyFI', '', 'date stamp', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiVC', '__tyFI', '', 'var char', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiVB', '__tyFI', '', 'var binary', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiTS', '__tyFI', '', 'text string', '__enZB', '_cxN_NA , _CA , _sCC', '_/ds'],
    ['_fiTB', '__tyFI', '', 'text binary', '__enZB', '_cxN_NA , _CA , _sCC', '_/ds'],
    ['_fiEN', '__tyFI', '', 'enamed number', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiEV', '__tyFI', '', 'enamed value', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiER', '__tyFI', '', 'enamed reference', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiES', '__tyFI', '', 'enamed structure', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiEB', '__tyFI', '', 'enamed bit', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['_fiEM', '__tyFI', '', 'enamed mask', '__enZB', '_cxN_NA , _WA , _sCC', '_/ds'],
    ['__niZB', '_fiNI', '_ZB : __tyFLD : __tyOFI', ' : tinyint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__niSB', '_fiNI', '_SB : __tyFLD : __tyOFI', ' : smalint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__niDB', '_fiNI', '_DB : __tyFLD : __tyOFI', ' : int', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__niTB', '_fiNI', '_QB : __tyFLD : __tyOFI', ' : bigint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__nuZB', '_fiNU', '_ZB : __tyFLD : __tyOFI', ' : tinyint unsigned', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__nuSB', '_fiNU', '_SB : __tyFLD : __tyOFI', ' : smalint unsigned', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__nuDB', '_fiNU', '_DB : __tyFLD : __tyOFI', ' : int unsigned', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__nuTB', '_fiNU', '_QB : __tyFLD : __tyOFI', ' : bigint unsigned', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__nfDB', '_fiNF', '_DB : __tyFLD : __tyOFI', ' : FLOAT', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__nfTB', '_fiNF', '_QB : __tyFLD : __tyOFI', ' : DOUBLE', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__ddPB', '_fiDD', '_PB : __tyFLD : __tyOFI', ' : DATE', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__dfPB', '_fiDF', '_PB : __tyFLD : __tyOFI', ' : DATETIME', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__duDB', '_fiDU', '_DB : __tyFLD : __tyOFI', ' : int', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__dsDB', '_fiDS', '_DB : __tyFLD : __tyOFI', ' : timestamp', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcZB', '_fiVC', '_ZB : __tyFLD : __tyOFI', ' : varchar(1)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcSB', '_fiVC', '_SB : __tyFLD : __tyOFI', ' : varchar(2)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcDB', '_fiVC', '_DB : __tyFLD : __tyOFI', ' : varchar(4)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcTB', '_fiVC', '_TB : __tyFLD : __tyOFI', ' : varchar(8)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcQB', '_fiVC', '_QB : __tyFLD : __tyOFI', ' : varchar(16)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcPB', '_fiVC', '_PB : __tyFLD : __tyOFI', ' : varchar(32)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcPD', '_fiVC', '_PD : __tyFLD : __tyOFI', ' : varchar(64)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcPQ', '_fiVC', '_PD : __tyFLD : __tyOFI', ' : varchar(128)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcOB', '_fiVC', '_OB : __tyFLD : __tyOFI', ' : varchar(256)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcOD', '_fiVC', '_OD : __tyFLD : __tyOFI', ' : varchar(512)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcKB', '_fiVC', '_KB : __tyFLD : __tyOFI', ' : varchar(1024)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcKD', '_fiVC', '_KD : __tyFLD : __tyOFI', ' : varchar(2048)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcKQ', '_fiVC', '_KQ : __tyFLD : __tyOFI', ' : varchar(4096)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcKO', '_fiVC', '_KO : __tyFLD : __tyOFI', ' : varchar(8192)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vcKH', '_fiVC', '_KH : __tyFLD : __tyOFI', ' : varchar(16768)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'], 
    ['__vcHB', '_fiVC', '_HB : __tyFLD : __tyOFI', ' : varchar(65536)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbZB', '_fiVB', '_ZB : __tyFLD : __tyOFI', ' : varbinary(1)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbSB', '_fiVB', '_SB : __tyFLD : __tyOFI', ' : varbinary(2)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbDB', '_fiVB', '_DB : __tyFLD : __tyOFI', ' : varbinary(4)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbTB', '_fiVB', '_TB : __tyFLD : __tyOFI', ' : varbinary(8)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbQB', '_fiVB', '_QB : __tyFLD : __tyOFI', ' : varbinary(16)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbPB', '_fiVB', '_PB : __tyFLD : __tyOFI', ' : varbinary(32)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbPD', '_fiVB', '_PD : __tyFLD : __tyOFI', ' : varbinary(64)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbPQ', '_fiVB', '_PQ : __tyFLD : __tyOFI', ' : varbinary(128)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbOB', '_fiVB', '_OB : __tyFLD : __tyOFI', ' : varbinary(256)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbOD', '_fiVB', '_OD : __tyFLD : __tyOFI', ' : varbinary(512)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbKB', '_fiVB', '_KB : __tyFLD : __tyOFI', ' : varbinary(1024)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbKD', '_fiVB', '_KD : __tyFLD : __tyOFI', ' : varbinary(2048)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbKQ', '_fiVB', '_KQ : __tyFLD : __tyOFI', ' : varbinary(4096)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbKO', '_fiVB', '_KO : __tyFLD : __tyOFI', ' : varbinary(8192)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbKH', '_fiVB', '_KH : __tyFLD : __tyOFI', ' : varbinary(16768)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__vbHB', '_fiVB', '_HB : __tyFLD : __tyOFI', ' : varbinary(65536)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__tsGB', '_fiTS', '_GB : __tyFLD : __tyOFI', ' : text', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__tbGB', '_fiTB', '_GB : __tyFLD : __tyOFI', ' : blob', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__enZB', '_fiEN', '_ZB : __tyFLD : __tyOFI', ' : tinyint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__enSB', '_fiEN', '_SB : __tyFLD : __tyOFI', ' : smalint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__evZB', '_fiEV', '_ZB : __tyFLD : __tyOFI', ' : tinyint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__evSB', '_fiEV', '_SB : __tyFLD : __tyOFI', ' : smalint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__evDB', '_fiEV', '_DB : __tyFLD : __tyOFI', ' : int', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__evTB', '_fiEV', '_TB : __tyFLD : __tyOFI', ' : bigint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__evQB', '_fiEV', '_QB : __tyFLD : __tyOFI', ' : varbinary(16)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__evPB', '_fiEV', '_PB : __tyFLD : __tyOFI', ' : varbinary(32)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__evPD', '_fiEV', '_PD : __tyFLD : __tyOFI', ' : varbinary(64)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__evPQ', '_fiEV', '_PQ : __tyFLD : __tyOFI', ' : varbinary(128)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__esPQ', '_fiES', '_PQ : __tyFLD : __tyOFI', ' : varbinary(128)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__erPQ', '_fiER', '_PQ : __tyFLD : __tyOFI', ' : varbinary(128)', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__ebZB', '_fiEB', '_ZB : __tyFLD : __tyOFI', ' : tinyint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__ebSB', '_fiEB', '_SB : __tyFLD : __tyOFI', ' : smalint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__ebDB', '_fiEB', '_DB : __tyFLD : __tyOFI', ' : int', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__ebTB', '_fiEB', '_TB : __tyFLD : __tyOFI', ' : bigint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__emZB', '_fiEM', '_ZB : __tyFLD : __tyOFI', ' : tinyint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__emSB', '_fiEM', '_SB : __tyFLD : __tyOFI', ' : smalint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__emDB', '_fiEM', '_DB : __tyFLD : __tyOFI', ' : int', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__emTB', '_fiEM', '_TB : __tyFLD : __tyOFI', ' : bigint', '__evPB', '_cxN_NA , _cxF_NA , _sCC', '__/ds'],
    ['__tyIC', '__tyIND', '_omTE', 'class', '__enZB', '_cxN_AT , _WA , _zCC', '__/ds'],
    ['__tyICS', '__tyIC', '_omTE', 'subclass', '__enZB', '_cxN_AA , _WA , _zCC', '__/ds'],
    ['__tyICSO', '__tyICS', '_omTE', 'options', '__enZB', '_cxN_AA , _WA , _zCC', '__/ds'],
    ['_icPG', '__tyIC', '_gkP', 'group -- the group __tyIND just for PRIMARI KEY', '__enZB', '_cxN_NA , _cxF_NA + _WS , _sCC', '_/ds'],
    ['_icKR', '__tyIC', '_icsK', 'reference -- the group __tyIND just for REFERENCE KEY like FK_ or RK_', '__enZB', '_cxN_NA , _cxF_NA + _WS , _sCC', '_/ds'],
    ['_icsK', '__tyICS', '', 'key -- subclass for PK_ and FK_ like index', '__enZB', '_cxN_NA , _WA , _zCC', '_/ds'],
    ['_icsX', '__tyICS', '', 'index -- simple index for ordering and/or filtering purpose', '__enZB', '_cxN_NA , _WA , _zCC', '_/ds'],
    ['_icsoM', '__tyICSO', '', 'multifield -- like index for _icsK and _icsX like indexes', '__enZB', '_cxN_NA , _WA , _zCC', '_/ds'],
    ['PK_', '_gkP', '_icsK : __tyIND : _icPG : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['SK_', '_gkS', '_icsK : __tyIND : _icPG : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['TK_', '_gkT', '_icsK : __tyIND : _icPG : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['FK_', '_gkF', '_icsK : _icKR : __tyIND : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['RK_', '_gkR', '_icsK : _icKR : __tyIND : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['UK_', '_gkU', '_icsK : __tyIND : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['UX_', '_gkU', '_icsX : __tyIND : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['IX_', '_gkI', '_icsX : __tyIND : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['PKM_', '_gkP', '_icsK + _icsoM : __tyIND : _icPG : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['SKM_', '_gkS', '_icsK + _icsoM : __tyIND : _icPG : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['TKM_', '_gkT', '_icsK + _icsoM : __tyIND : _icPG : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['UKM_', '_gkU', '_icsK + _icsoM : __tyIND : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['UXM_', '_gkU', '_icsX + _icsoM : __tyIND : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],
    ['IXM_', '_gkI', '_icsX + _icsoM : __tyIND : __tyOFI', '', '__enZB', '_cxN_NA , _cxF_NA , _CCC', 'ds/_'],

  ];
  $src['_raOBJ__arP'] = [
    [RA_cn__arDS, 'cxN__arDS', 'cxF__EXPR', 'expl__vbKB', 'val__tyFLD', 'rule__EXPR', 'te__EXPR', 'cn__tyOFI', 'ext__vbKB'],
    ['_i0_mAV', '_RA', '@mA + @gV', ' -- houses + cars + ... : 0', '__evZB', ' , _cxF_NA , _sCC', '_/fci/_/ds', '', ''],
    ['_i1_gV', '_RA', '@gV', ' -- ideas : 1', '__evZB', '_cxF_AS , _cxF_NA , _sCC', '_/fci/_/ds', '', ''],
    ['_i2_cGV', '_RA', '@cG + @gV', ' -- medtech : 1', '__evZB', '_cxF_AS , _cxF_NA , _sCC', '_/fci/_/ds', '', ''],
    ['_i3_pIV', '_RA', '@pI + @gV', ' -- Konkurs : 2', '__evZB', '_cxF_AS , _cxF_NA , _sCC', '_/fci/_/ds', '', ''],
    ['_i4_gGV', '_RA', '@gG + @gV', ' -- VSync : 3', '__evZB', '_cxF_AS , _cxF_NA , _sCC', '_/fci/_/ds', '', ''],
    ['_wRA', '_RA', '_hieSCH : __tyOFI', 'with -- db schema : ', '__evZB', '_WA , _cxN_AA , _sCC', '_/ds', '', ''],
    ['_wRA_LOG', '_RA', '_hieSCH', 'log -- storage db schema : ', '__evZB', '_ZZ , _AA , _CCC', '_/dst/_/ds', '_wRA', ''],
    ['_wRA_NLP', '_RA', '_hieSCH', 'natural lang processing -- db schema : ', '__evZB', '_ZZ , _WA , _CCC', '_/dst/_/ds', '_wRA', ''],
    ['_wRA_i0_mAV', '_i0_mAV', '_hieSCH', ' : ', '__evZB', '_ZZ , _cxN_AA , _zzz', '_/dst/_/ds', '_wRA', ''],
    ['_wRA_i1_gV', '_i1_gV', '_hieSCH', ' : ', '__evZB', '_ZZ , _cxN_AA , _zzz', '_/dst/_/ds', '_wRA', ''],
    ['_wRA_i2_cGV', '_i2_cGV', '_hieSCH', ' : ', '__evZB', '_ZZ , _cxN_AA , _zzz', '_/dst/_/ds', '_wRA', ''],
    ['_wRA_i3_pIV', '_i3_pIV', '_hieSCH', ' : ', '__evZB', '_ZZ , _cxN_AA , _zzz', '_/dst/_/ds', '_wRA', ''],
    ['_wRA_i4_gGV', '_i4_gGV', '_hieSCH', ' : ', '__evZB', '_ZZ , _cxN_AA , _zzz', '_/dst/_/ds', '_wRA', ''],
    ['_m0_RA', '_wRA', '_hieM', ' -- main module for all initiatives : 0', '__evZB', '_ZZ , _cxF_NA , _sCC', '_/fcm/_/ds', '', ''],
    ['_m1_WT', '_wRA_i1_gV', '_hieM', 'wine tech -- new version for raFTI_v6 : 1', '__evZB', '_ZZ , _WA , _sCC', '_/fcm/_/ds', '', ''],
    ['_m2_MT', '_wRA_i2_cGV', '_hieM', 'med tech -- --//-- : 2', '__evZB', '_ZZ , _WA , _sCC', '_/fcm/_/ds', '', ''],
    ['_m3_HT', '_wRA_i0_mAV', '_hieM', 'house tech -- --//-- : 4', '__evZB', '_ZZ , _WA , _sCC', '_/fcm/_/ds', '', ''],
    ['_m4_TS', '_wRA_i3_pIV', '_hieM', 'trening systems -- new using of Konkurs : 5', '__evZB', '_ZZ , _WA , _sCC', '_/fcm/_/ds', '', ''],
    ['_m5_VH', '_wRA_i4_gGV', '_hieM', 'VSync History : 6', '__evZB', '_ZZ , _WA , _sCC', '_/fcm/_/ds', '', ''],
    ['_mY_LOG', '_wRA_LOG', '_hieM', ' : Z', '__evZB', '_ZZ , _cxN_NA , _sCC', '_/fcm/_/ds', '', ''],
    ['_mZ_NLP', '_wRA_NLP', '_hieM', ' : Z', '__evZB', '_ZZ , _cxN_NA , _sCC', '_/fcm/_/ds', '', ''],
    ['_a0_CORE', '_RA', '_hieA', 'core -- main aggregate : 0', '__evZB', '_ZZ , _AA , _sCC', '_/fca/_/ds', '', ''],
    ['_a1_DOC', '_RA', '_hieA', 'documents : 1', '__evZB', '_ZZ , _AT , _sCC', '_/fca/_/ds', '', ''],
    ['_a2_TY', '_RA', '_hieA', 'types : 2', '__evZB', '_ZZ , _AD , _sCC', '_/fca/_/ds', '', ''],
    ['_a3_OBJ', '_RA', '_hieA', 'objects : 3', '__evZB', '_ZZ , _AT , _sCC', '_/fca/_/ds', '', ''],
    ['_a4_LOC', '_RA', '_hieA', 'locations : 4', '__evZB', '_ZZ , _AT , _sCC', '_/fca/_/ds', '', ''],
    ['_a5_PER', '_RA', '_hieA', 'persons : 5', '__evZB', '_ZZ , _AT , _sCC', '_/fca/_/ds', '', ''],
    ['_a6_CON', '_RA', '_hieA', 'contacts : 6', '__evZB', '_ZZ , _AT , _sCC', '_/fca/_/ds', '', ''],
    ['_aR_RES', '_RA', '_hieA', 'resources : R', '__evZB', '_ZZ , _AT , _sCC', '_/fca/_/ds', '', ''],
    ['_aS_SOL', '_RA', '_hieA', 'solutions : S', '__evZB', '_ZZ , _AT , _sCC', '_/fca/_/ds', '', ''],
    ['_aU_URP', '_RA', '_hieA', 'user role permissions : U', '__evZB', '_ZZ , _WA , _sCC', '_/fca/_/ds', '', ''],
    ['_aT_TLE', '_RA', '_hieA', 'time lines events : T', '__evZB', '_ZZ , _WA , _sCC', '_/fca/_/ds', '', ''],
    ['_aV_VER', '_RA', '_hieA', 'versions : V', '__evZB', '_ZZ , _AT , _sCC', '_/fca/_/ds', '', ''],
    ['_aW_WDOG', '_RA', '_hieA', 'watch-dog : W', '__evZB', '_FE , _AD , _CCC', '_/fca/_/ds', '', ''],
    ['_aX_EXPR', '_RA', '_hieA', 'expresions : X', '__evZB', '_ZZ , _AQ , _sCC', '_/fca/_/ds', '', ''],
    ['_aY_YBUG', '_RA', '_hieA', 'yet-de-buger: Y', '__evZB', '_FE , _AD , _CCC', '_/fca/_/ds', '', ''],
    ['_aZ_ZENG', '_RA', '_hieA', 'z-english -- referential english - ebanble all fixes for all words: Z', '__evZB', '_FS , _AT , _CCC', '_/fca/_/ds', '', ''],
    ['_raCORE__arP', '_m0_RA', '_a0_CORE : _hieO', ' -- main aggregate unic number register : o000a', '__evQB', '_cxN_NA , _cxF_NA , _sCC',
      '_/ds/__/dst', '__arP', 'COMMENT onA_MOD _mod__arP'],
    ['_raCORE__arPD_DS', '_m0_RA', '_a0_CORE : _hieO', 'designation shortes -- main aggregate detalisation : o001a', '__evQB', '_cxN_NA , _cxF_NA , _sCC',
      '_/ds/__/dst/_/dso:_WA', '__arPD', 'COMMENT onB_MOD _mod__arDS'],
    ['_raCORE__acPP_meta', '_m0_RA', '_a0_CORE : _hieO', 'meta -- php code component : o002a', '__evQB', '_cxN_NA , _cxF_NA , _sCs',
      '_/ds/__/dst/_/dso:_AA', '__acPP', ''],
    ['_raCORE__acPP_ini', '_m0_RA', '_a0_CORE : _hieO', 'initialisation -- php code component : o003a', '__evQB', '_cxN_NA , _cxF_NA , _sCs',
      '_/ds/__/dst/_/dso:_AT', '__acPP', ''],
    ['_raDOC__arP', '_m0_RA', '_a1_DOC : _hieO', ' -- : o010a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arP', 'COMMENT onA_MOD _mod__arDS'],
    ['_raDOC__acPG_list', '_m0_RA', '_a1_DOC : _hieO', 'list -- like simplest format : o011a', '__evQB', '_cxN_NA , _cxF_NA , _sCC',
      '_/ds/__/dst/_/dso:_AA', '__acPG', 'COMMENT onB_MOD _mod__arDS'],
    ['_raDOC__acPG_post', '_m0_RA', '_a1_DOC : _hieO', 'post -- like format with @PER and @RES references : o012a', '__evQB', '_cxN_NA , _cxF_NA , _sCC',
      '_/ds/__/dst/_/dso:_AA', '__acPG', 'COMMENT onB_MOD _mod__arDS'],
    ['_raTY__arP', '_m0_RA', '_a2_TY : _hieO', ' : o020a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arP', 'COMMENT onB_MOD _mod__arDS , _mod__EEXPR'],
    ['_raOBJ__arP', '_m0_RA', '_a3_OBJ : _hieO', ' : o030a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arP', 'COMMENT onB_MOD _mod__arDS , _mod__EEXPR'],
    ['_raOBJ__arPD_seg', '_m0_RA', '_a3_OBJ : _hieO', 'segments : o031a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst/_/dso:_AT', '__arPD', 'COMMENT onB_MOD _chk_seg'],
    ['_raOBJ__acPG_hie', '_m0_RA', '_a3_OBJ : _hieO', '_hieV -- grid : o032a', '__evQB', '_cxN_NA , _cxF_NA , _sCs', '_/ds/__/dst/_/dso:_XA)', '__acPG', ''],
    ['_raLOC__arP', '_m0_RA', '_a4_LOC : _hieO', ' : o040a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arP', 'COMMENT onB_MOD _mod__arDS , _mod__EEXPR'],
    ['_raPER__arP', '_m0_RA', '_a5_PER : _hieO', ' : o050a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arP', 'COMMENT onB_MOD _mod__arDS , _mod__EEXPR'],
    ['_raPER__acPG_loc', '_m0_RA', '_a5_PER : _hieO', '_a4_LOC -- @PER to @LOC grid : o051a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst/_/dso:_NA)', '__acPG', ''],
    ['_raCON__arP', '_m0_RA', '_a6_CON : _hieO', ' : o060a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arP', 'COMMENT onB_MOD _mod__arDS , _mod__EEXPR'],
    ['_raCON__acPG', '_m0_RA', '_a6_CON : _hieO', '@PER or @LOC to @CON grid : o061a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__acPG', ''],
    ['_raRES__arP', '_m0_RA', '_aR_RES : _hieO', ' : o0R0a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arP', 'COMMENT onB_MOD _mod__arDS , _mod__EEXPR'],
    ['_raVER__arP', '_m0_RA', '_aV_VER : _hieO', ' : o0V0a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arP', 'COMMENT onB_MOD _mod__arDS , _mod__EEXPR'],
    ['_raWDOG__arT', '_mY_LOG', '_aW_WDOG : _hieO', ' : oYW0a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arT', 'COMMENT onB_MOD _mod__arDS , _mod__EEXPR'],
    ['_raEXPR__arP', '_m0_RA', '_aX_EXPR : _hieO', ' : o0X0a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arP', ''],
    ['_raEXPR__acPG', '_m0_RA', '_aX_EXPR : _hieO', 'grid of references : o0X1a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__acPG', ''],
    ['_raYDEB__arP', '_m0_RA', '_aY_YDEB : _hieO', ' : o0Y0a', '__evQB', '_cxN_NA , _cxF_NA , _sCC', '_/ds/__/dst', '__arP', ''],
    ['__TY', '_raTY__arP', '__tyOFI : _hieV', '', '__enZB', '_ZZ , _cxN_NA , _sCC', '__/ds', '__arP', 'NOT NULL'],
    ['__OBJ', '_raOBJ__arP', '__tyOFI : _hieV', '', '__enZB', '_ZZ , _cxN_NA , _sCC', '__/ds', '__arP', 'NOT NULL'],
    ['__EXPR', '_raEXPR__arP', '__tyOFI : _hieV', '', '__enZB', '_ZZ , _cxN_NA , _sCC', '__/ds', '__arP', 'NOT NULL'],
    ['_arP', '_raCORE__arP', '_hieV', 'primary register functor', '__enZB', '_ZZ , _ZZ , _zzz', '_/dst', '__arP', 'NOT NULL'],
    ['cre__dsDB', '_raCORE__arP', '_hieV', 'create', '__enZB', '_AT , _ZZ , _sCC', 'ds/__/dst', '__dsDB', 'NOT NULL DEFAULT CURRENT_TIMESTAMP'],
    ['upd__dsDB', '_raCORE__arP', '_hieV', 'update', '__enZB', '_AT , _ZZ , _sCC', 'ds/__/dst', '__dsDB', 'NOT NULL DEFAULT CURRENT_TIMESTAMP'],
    ['PK_arP', '_raCORE__arP', '_arP', '', '__enZB', '_ZZ , _cxF_AA , _zzz', 'dst/_/ds', 'PK_', ''],
    ['cn__arP', '_raCORE__arPD_DS', '_cN : _hieV', 'reference to primary register', '__enZB', '_cxF_AS , _ZZ , _ssz', 'ds/__/dst', '__arP', 'NOT NULL'],
    ['_arDS', '_raCORE__arPD_DS', '__arP + ds : _hieV', ' -- primary register ds functor', '__enZB', '_cxF_XA , _cxF_AA , _zzz', '_/ds', '__vbPQ', 'NOT NULL'],
    ['PK_cn__arP', '_raCORE__arPD_DS', 'cn__arP', '', '__enZB', '_ZZ , _cxF_AA , _zzz', 'dst/_/ds', 'PK_', ''],
    ['UK_arDS', '_raCORE__arPD_DS', '_arDS', '', '__enZB', '_ZZ , _cxF_AA , _zzz', 'dst/_/ds', 'UK_', ''],
    ['FK_raCORE__arPD_DS_cn__arP', '_raCORE__arPD_DS', 'cn__arP', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'FK_', '_raCORE__arP (_arP) ON DELETE CASCADE ON UPDATE CASCADE'],      
    ['cxN__arP', '_raTY__arP', '_cX : _hieV', 'near -- reference to primary register', '__enZB', '_cxF_AA , _WA , _sCs', 'ds/__/dst', '__arP', 'NOT NULL'],
    ['cxF__EXPR', '_raTY__arP', '_cX : _hieV', 'far -- reference to expression of references', '__enZB', '_cxF_AS , _WA , _sCC', 'ds/__/dst',
      '__EXPR', 'NULL DEFAULT NULL'],
    ['expl__vbKB', '_raTY__arP', '_hieV', 'explanation', '__enZB', '_AQ , _ZZ , _sCC', 'ds/__/dst', '__vbKB', "NOT NULL DEFAULT ''"],
    ['val__tyFLD', '_raTY__arP', '_hieV', 'value', '__enZB', '_AT , _ZZ , _sCC', '__/dst', '__arP', 'NOT NULL'],
    ['rule__EXPR', '_raTY__arP', '_hieV', 'rule -- reference to expression of references for (ds) part', '__enZB', '_WA , _ZZ , _sCC', 'ds/__/dst',
      '__EXPR', 'NOT NULL'],
    ['te__EXPR', '_raTY__arP', '_hieV', 'template -- reference to expression of references for all parts', '__enZB', '_WA , _ZZ , _sCC', 'ds/__/dst',
      '__EXPR', 'NOT NULL'],
    ['val__vbPQ', '_raTY__arP', '_hieV', 'value', '__enZB', '_AT , _ZZ , _sCC', 'ds/__/dst', '__vbPQ', "NOT NULL DEFAULT ''"],
    ['FK_raTY__arP_cn__arP', '_raTY__arP', 'cn__arP', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'FK_', '_raCORE__arPD_DS (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE'],
    ['FK_raTY__arP_cxN__arP', '_raTY__arP', 'cxN__arP', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'FK_', '_raCORE__arPD_DS (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE'],
    ['RK_raTY__arP_cxF__EXPR', '_raTY__arP', 'cxF__EXPR', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'RK_', '_raEXPR__arP (cn__arP) ON DELETE SET NULL ON UPDATE CASCADE'],
    ['FK_raTY__arP_val__tyFLD', '_raTY__arP', 'val__tyFLD', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'FK_', '_raCORE__arPD_DS (cn__arP) ON UPDATE CASCADE'],
    ['RK_raTY__arP_rule__EXPR', '_raTY__arP', 'rule__EXPR', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'RK_', '_raEXPR__arP (cn__arP) ON UPDATE CASCADE'],
    ['RK_raTY__arP_te__EXPR', '_raTY__arP', 'te__EXPR', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'RK_', '_raEXPR__arP (cn__arP) ON UPDATE CASCADE'],
    ['cn__tyOFI', '_raOBJ__arP', '_cN : _hieV', '', '__enZB', '_cxF_AA , _cxN_AA , _sCC', '__/dst', '__arP', 'NULL DEFAULT NULL'],
    ['ext__vbKB', '_raOBJ__arP', '_hieV', 'template -- reference to expression of all fields parameters', '__enZB', '_WA , _ZZ , _sCC', 'ds/__/dst',
      '__vbKB', "NOT NULL DEFAULT ''"],
    ['FK_raOBJ__arP_cn__tyOFI', '_raOBJ__arP', 'cn__tyOFI', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'FK_', '_raCORE__arPD_DS (cn__arP) ON DELETE SET NULL ON UPDATE CASCADE'],
    ['par__OBJ', '_raOBJ__acPG_hie', '_hieV', 'parent', '__enZB', '_AT , _ZZ , _sCC', 'ds/__/dst', '__OBJ', 'NOT NULL'],
    ['chi__OBJ', '_raOBJ__acPG_hie', '_hieV', 'child', '__enZB', '_AT , _ZZ , _sCC', 'ds/__/dst', '__OBJ', 'NOT NULL'],
    ['row__evZB', '_raOBJ__acPG_hie', '_hieV', 'row', '__enZB', '_AT , _ZZ , _sCC', 'ds/__/dst', '__evZB', 'NOT NULL'],
    ['PKM_raOBJ__acPG_hie_par__OBJ', '_raOBJ__acPG_hie', 'par__OBJ', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz', 'dst/_/ds', 'PKM_', ''],
    ['FK_raOBJ__acPG_hie_par__OBJ', '_raOBJ__acPG_hie', 'par__OBJ', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'FK_', '_raOBJ__arP (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE'],
    ['FK_raOBJ__acPG_hie_chi__OBJ', '_raOBJ__acPG_hie', 'chi__OBJ', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'FK_', '_raOBJ__arP (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE'],
    ['_cnt__nuZB', '_raEXPR__arP', '_hieV', 'count', '__enZB', '_CT , _ZZ , _sss', '_/ds/__/dst', '__nuZB', 'NOT NULL DEFAULT 0'],
    ['FK_raEXPR__arP_cn__arP', '_raCORE__arPD_DS', 'cn__arP', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'FK_', '_raCORE__arPD_DS (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE'],
    ['par__arP', '_raEXPR__acPG', '_hieV', 'parent', '__enZB', '_AT , _ZZ , _szz', 'ds/__/dst', '__arP', 'NOT NULL'],
    ['chi__arP', '_raEXPR__acPG', '_hieV', 'child', '__enZB', '_AT , _ZZ , _szz', 'ds/__/dst', '__arP', 'NOT NULL'],
    ['PKM_raEXPR__acPG_par__arP', '_raEXPR__acPG', 'par__arP', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz', 'dst/_/ds', 'PKM_', ''],
    ['FK_raEXPR__acPG_par__arP', '_raEXPR__acPG', 'par__arP', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'FK_', '_raEXPR__arP (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE'],
    ['FK_raEXPR__acPG_chi__arP', '_raEXPR__acPG', 'chi__arP', '', '__enZB', '_cxN_AA , _cxF_AA , _zzz',
      'dst/_/ds/_/dso:cxF_AA', 'FK_', '_raCORE__arPD_DS (cn__arP) ON UPDATE CASCADE'],

  ];
  $RA_raOBJ__acPG_hie_par__OBJ = 0;
  $RA_raOBJ__acPG_hie_chi__OBJ = 1;
  $RA_raOBJ__acPG_hie_multi__FLD = 2;
  $src['_raOBJ__acPG_hie'] = [
    ['par__OBJ', 'chi__OBJ', 'multi__FLD'],
    ['_raCORE__arP', '_arP', ''],
    ['_raCORE__arP', 'cre__dsDB', ''],
    ['_raCORE__arP', 'upd__dsDB', ''],
    ['_raCORE__arP', 'PK_arP', ''],
    ['_raCORE__arPD_DS', 'cn__arP', ''],
    ['_raCORE__arPD_DS', '_arDS', ''],
    ['_raCORE__arPD_DS', 'PK_cn__arP', ''],
    ['_raCORE__arPD_DS', 'UK_arDS', ''],
    ['_raCORE__arPD_DS', 'FK_raCORE__arPD_DS_cn__arP', ''],
    ['_raTY__arP', 'cn__arP', ''],
    ['_raTY__arP', 'cxN__arP', ''],
    ['_raTY__arP', 'cxF__EXPR', ''],
    ['_raTY__arP', 'expl__vbKB', ''],
    ['_raTY__arP', 'rule__EXPR', ''],
    ['_raTY__arP', 'te__EXPR', ''],
    ['_raTY__arP', 'val__tyFLD', ''],
    ['_raTY__arP', 'val__vbPQ', ''],
    ['_raTY__arP', 'PK_cn__arP', ''],
    ['_raTY__arP', 'FK_raTY__arP_cn__arP', ''],
    ['_raTY__arP', 'FK_raTY__arP_cxN__arP', ''],
    ['_raTY__arP', 'RK_raTY__arP_cxF__EXPR', ''],
    ['_raTY__arP', 'FK_raTY__arP_val__tyFLD', ''],
    ['_raTY__arP', 'RK_raTY__arP_rule__EXPR', ''],
    ['_raTY__arP', 'RK_raTY__arP_te__EXPR', ''],
    ['_raOBJ__arP', '_raTY__arP', ''],
    ['_raOBJ__arP', 'cn__tyOFI', ''],
    ['_raOBJ__arP', 'ext__vbKB', ''],
    ['_raOBJ__arP', 'FK_raOBJ__arP_cn__tyOFI', ''],
    ['_raOBJ__acPG_hie', 'par__OBJ', ''],
    ['_raOBJ__acPG_hie', 'chi__OBJ', ''],
    ['_raOBJ__acPG_hie', 'row__evZB', ''],
    ['_raOBJ__acPG_hie', 'PKM_raOBJ__acPG_hie_par__OBJ', 'chi__OBJ'],
    ['_raOBJ__acPG_hie', 'FK_raOBJ__acPG_hie_par__OBJ', ''],
    ['_raOBJ__acPG_hie', 'FK_raOBJ__acPG_hie_chi__OBJ', ''],
    ['_raEXPR__arP', 'cn__arP', ''],
    ['_raEXPR__arP', '_cnt__nuZB', ''],
    ['_raEXPR__arP', 'PK_cn__arP', ''],
    ['_raEXPR__arP', 'FK_raEXPR__arP_cn__arP', ''],
    ['_raEXPR__acPG', 'par__arP', ''],
    ['_raEXPR__acPG', 'row__evZB', ''],
    ['_raEXPR__acPG', 'chi__arP', ''],
    ['_raEXPR__acPG', 'PKM_raEXPR__acPG_par__arP', 'row__evZB'],
    ['_raEXPR__acPG', 'FK_raEXPR__acPG_par__arP', ''],
    ['_raEXPR__acPG', 'FK_raEXPR__acPG_chi__arP', ''],

  ];
  $src['_raDOC__arP'] = [
      [RA_cn__arDS, 'expl__vbKS', '__tyDOC'],
      ['_d0', 'Content : this document', '__dList'],
      ['_d1', 'Destination', '__dList'],
      ['_d2', 'Naming', '__dList'],
      ['_d3', 'Glossary', '__dList'],
      ['_d4', 'Manifest', '__dPost'],
      ['_d5', 'preDescription', '__dList'],
      ['_d6', 'Description', '__dList'],
      ['_d7', 'Versions', '__dPost'],
      ['_d8', 'Specification', '__dPost'],
      ['_d9', 'Notes', '__dPost'],
      ['_dA', 'ReDeBuger', '__dPost'],
  ];
  //*
  $src['_raDOC__acPG__dList'] = [
      ['__DOC', 'expl__vcKB',
        ['__DOC', 'expl__vcKB',
          ['expl__vcKB',
            ['expl__vcKB']]]],
      ['_d10', 'Destination : is : Relate Assemblies(RA)', []],
      ['_d10', 'Destination : is : Relate Assemblies(RA)', []],
      ['_d11', ' : do : Formal System Definition)', []],
      ['_d12', ' : by : Flexible Structuring of Ontologies', []],
      ['_d13', ' : on : Fast and Strong Integrety', []],
      ['_d1Z', '', []],
      ['_d20', 'Naming : (convention : constraints : order rules)', []],
      ['_d21', '<object designation template>(ODT) parts : _/FCC/_/ds/__/dst[__/dst/]/[_/dso/] : ', [
        ['_d211', '/_/ : <functor designation prefix or ODT part separator> : exact (1) <under score> symbol of ODT', []],
        ['_d212', '/__/ : <object type designation prefix> : <exact (2) <under score> symbols : ODT must have at least one type of object.', []],
        ['_d213', '/FCC/ : <Facet Class Code> : consist of 2 parts : /ns/FC/ : ', [
          ['/ns/ : name space : ', [
            'o : objects',
            'd : documents',
            'o : objects',
            '...',
          ]],
          ['(FC) : <Facet Code> : consist of 4 parts : /fcm/fca/fcc/fco/ : ', [
            '/fcm/ : <FCC of Modules -- index value> : [0-9A-Z] count(10 + 26) = 36',
            '/fca/ : <FCC of Aggregate -- index value> [0-9A-Z]',
            '/fcc/ : <FCC of Component -- index value> [0-9A-Z]',
            '/fco/ : <FCC of Object -- index value> : [a-z] : (<min number> : <a> : <0>) : (<max number> : <z> : <25>) : count() = 26',
          ]],
        ]],
        ['_d214', '/ds/ : /dsx/dsn/ : ', [
          ['/dsx/ : <DS of conteXt> : transformed to <Lower Case> : for (ODT) is.designation of module', []],
          ['/dsn/ : <DS of conteNt> : transformed to <Uper Case> : for (ODT) is.designation of aggregate', []],
        ]],
        ['_d215', '/dst/ : <DS of Type -- of object> : /dstCS/dstKM/ : ', [
          ['/dstCS/ : <DST Class + Subclass -- interpritation> : ', [
            '/nu/ : <Number + Unsigned>',
            '/vc/ : <Var + Char>',
            '...',
          ]],
          ['/dstKM/ : <DST> + <Key -- of token> + <Multiplicator -- interpritation> : ', [
            '/ZB/ : <Zero + Byte> : 2 ^ Zero : 1 : tinyint',
            '/SB/ : <Singlet + Byte> : 2 ^ Singlet = 2 : smalint ',
            '...',
            '/KB/ : <Kilo + Byte> : (vcKB : 2 ^ 10 * 1 = 1024 : varchar(1024)) / (vbKD : 2 ^ 10 * 2 = 2048  : varbinary(2048)) / ... ',
            '...',
          ]],
        ]],
        ['_d216', '/dso/ : <DS Option -- of object> : ', [
          ['<_o000a_raOBJ__acPG_hie> : _/o031a/_/ra/OBJ/__/ac/PG/_/hie/ : _/FCC/_/dsx/dsn/__/dstCS/dstKM/_/dso/ : ', [
            '/o031a/ : /FCC/ : <o : object -- name space> + <0 : 1-st module> + <3 : 4-th agg.> + <1 : 2-nd comp.> + <a - 1-st object>',
            '/ra/ : /dsx/ : module DS : Relate Assmblies',
            '/OBJ/ : /dsn/ : agg. destination DS : OBJECTS',
            '/ac/ : /dstCS/ : (<a><r> : <agg.><register> : <class><subclass>) / (<ac> : <a><c> : <agg.><component>) : ...',
            '/PG/ : /dstKM/ : (<acPG> : <P : Primary><G : Grid>) / (<arPD> : <P : Primary><D : Detalisation>) / ...',
            '/hie/ : /dso/ : <HIERARCHY>',
            '...',
          ]],
        ]],
      ]],
      ['_d22', '(FCC : order : rules) : ', [
        ['_d221', 'r1 : Each FCC of each object is in coordonance with it position in _raOBJ__arDS table', []],
        ['_d222', 'r2 : Each FCC of each subobject is in coordonance with <Causal Relationships Criterion>(CRC) : ', [
          ['So _r1 can violate _r2 but for each such case the constraint name designation began with perfix <R>(Reverse)', []],
          ['and is used to separate modification in thouse constraints conturs.', []],
        ]],
        ['_d223', 'r3 : (r1/r2) : At once only one type of objects can be modified : with constraint perfixed by R or without it :', [
          ['So if object has fields with both types of constraint you can\'t modify both simultaneously.', []],
          ['Rules r2 and r3 is provided by triggers.', []],
        ]],
      ]],
      ['_d23', '(Designation Short : rules) : (DP:_r:)', [
        ['_d231', 'DS_r1 : NO DUPS : NO Duplicates for Primary Purpose Designation : ', [
          ['Each DS of object name is unical in all contexts.', []],
          ['It is shortest unical name of object.', []],
        ]],
        ['_d232', 'DS_r2 : NO FLFL : NO Free Letters Flying or Lying :', [
          ['Each DS is generated from : (cxN, cxF, expl, __tyOBJ) packed in (rule) using (dsTE) :', [
            ' : cxN : object ConteXt Near',
            ' : cxF : object ConteXt Far : context expression',
            ' : expl : explanation expression of object destination and aspects (English only)',
            ' : __tyOBJ : type of object',
            ' : rule : packet of : <(dsx),(dsn),(dsABR)> : (DS conteXt),(DS conteNt),(DS abris -- capitalisation subrules)',
            ' : dsTE : DS TEmplate : <__(dst) : types DS> / </ds/__/dst/ - variables or field DS> / ...',
          ]],
        ]],
        ['_d233', 'DS_r3 : NO NO : Each DS of each hierarchy level can not be constructed without its context and/or without type :', []],
        ['_d234', 'DS_r4 : NO TRANS : ', [
          ['NO Translator exists for constructing of DP but will be 1-st and most important task for feuture partners :', [
            ' : Strict Rules format and interpriation was made in ra3.0 verssion. (see below: _d6:_ra3.0)',
            ' : Use your mind to translate (cxN, cxF, expl, __tyOBJ, rule, dsTE) to its DP.',
          ]],
        ]],
      ]],
      ['_d24', 'There is many <Desegnation>DS functor types for any objects: DS(_dp,_dc,_da,_de,_do,_dd)', [
        ['_d241', 'ds : Desegnation Primary : unical global', []],
        ['_d242', 'da : Desegnation Alternative : unical global', []],
        ['_d243', 'de : Desegnation Expression -- of contexts : unical global : combinations of many DS in groups and/or with operators', []],
        ['_d244', 'do : Desegnation Objects : full : unical global', []],
        ['_d245', 'dd', 'Desegnation Documents : unical global', []],
      ]],
  ];

$pp = '_p002c';
  $RA[RA_cn__arDS] =  $errn = $errd = $err = [];
  foreach ($src as $src_tab => $src_arr) {
    $fields = $src_arr[0];
    foreach ($src_arr as $src_arr_i => $src_arr_val) {
      $RA_cn__arDS = $src_arr_val[$RA_raTY__arDS_cn__arDS];
      if ($src_arr_i) {
        $RA_cxN__arDS = $src_arr_val[$RA_raTY__arDS_cxN__arDS];
        if (isset($RA[RA_cn__arDS][$RA_cn__arDS])) {
          if (!$errd) $errd[] = "$pp e1 Errors [cn__arDS => cxN__arDS] already defined!";
          $errd[] = "[$RA_cn__arDS => $RA_cxN__arDS] - cn__arDS($RA_cn__arDS)";
        } elseif ($RA_cxN__arDS != '' && !isset($RA[RA_cn__arDS][$RA_cxN__arDS])) {
          if (!$errn) $errn[] = "$pp e2 Errors [cn__arDS => cxN__arDS] not found!";
          $errn[] = "[$RA_cn__arDS => $RA_cxN__arDS] - cxN__arDS($RA_cxN__arDS)";
        } else {
          $RA[RA_cn__arDS][$RA_cn__arDS] = array_combine($fields, $src_arr_val);
        }
      } elseif ($RA_cn__arDS != RA_cn__arDS) {
        break 2;
      }
    }
  }
  foreach ($RA[RA_cn__arDS] as $cn__arDS => $ra_arr) {
    // echo " $cn__arDS";
    if ($RA[RA_cn__arDS][$ra_arr['val__tyFLD']]['cxN__arDS'] == '_fiEV') {
      $ra_arr['val__vbPQ'] = explode($_sepVALUE, $ra_arr['expl__vbKB'])['1'] ?? 0;
    } else {
      $ra_arr['val__vbPQ'] = 0;
    }
    $RA[RA_cn__arDS][$cn__arDS] = $ra_arr;
  }

$pp = '_p002d';
  $log = $dst[RA_sql] = $RA[RA_sq] = $fields_desc = $fields_constraints = $fields_keys = [];
  $RA[RA_curDB] = '';
  $RA[RA_sq][] = "SET FOREIGN_KEY_CHECKS=0";
  if ($errd || $errn) du($errd, $errn);
  else $log[] = "$pp s1 No errors found in primary object processing.";
  $log[] = "$pp s2 Number of cn__arDS processed: " . (count($RA[RA_cn__arDS]));
  $log[] ="$pp s3  Create all tables\n|---|---|---|\n|table_name|field_name|object_type|\n|---|---|---|";
  $table_name = $prev_table = '';
  for ($src_i = 1; $src_i < count($src['_raOBJ__acPG_hie']); $src_i++) {
    $prev_table = $table_name;
    $table_name = $src['_raOBJ__acPG_hie'][$src_i][$RA_raOBJ__acPG_hie_par__OBJ];
    $field_name = $src['_raOBJ__acPG_hie'][$src_i][$RA_raOBJ__acPG_hie_chi__OBJ];

    $log[] = "|$table_name|$field_name|" . $RA[RA_cn__arDS][$field_name]['cxF__EXPR'] . "|";
    if (strpos($RA[RA_cn__arDS][$table_name]['cxF__EXPR'], '_hieO') === FALSE) {

$ep = "$pp e3";
      $err[] = "  $ep Bad not like table object found($table_name) in \$src['_raOBJ__acPG_hie']";
    } else {
      if (!isset($dst[RA_sql][$table_name])) {
        if ($prev_table != '') {
          $fco = $RA[RA_cn__arDS][$prev_table]['val__vbPQ'];
          $sql =  rtrim(
            "CREATE table _{$fco}{$prev_table} (" . $fields_desc[$prev_table] . $fields_keys[$prev_table] . $fields_constraints[$prev_table],
            ',') . "\n)"
          ;
          __check_DB($prev_table);
          $dst[RA_sql][$prev_table] = $sql;
          $RA[RA_sq][] = $sql;
        }
        $dst[RA_sql][$table_name] = 0;
        $fields_desc[$table_name] =  $fields_keys[$table_name] = $fields_constraints[$table_name] = '';
        $chi_val = $row_val = 0;
      }
      if (isset($dst[RA_sql][$field_name])) {
         $fields_desc[$table_name] = $fields_desc[$field_name];
         $fields_keys[$table_name] = strtr($fields_keys[$field_name], [$field_name => $table_name]);
         $fields_constraints[$table_name] = strtr($fields_constraints[$field_name], [$field_name => $table_name]);;
      } else {
        $__tyFLD = $old__tyFLD = $RA[RA_cn__arDS][$field_name]['cn__tyOFI'];
        if (strpos($RA[RA_cn__arDS][$field_name]['cxF__EXPR'], '_hieV') !== FALSE) {
          if ($row_val != $chi_val ) {

$ep = "$pp e4";
            $err[] = "  $ep Bad row_val/chi_val($row_val/$chi_val) nuber for table($table_name) and field($field_name): " . (count($err));
          } else {
            $wile_i = 10;
            if (isset($RA[RA_cn__arDS][$__tyFLD]['cn__tyOFI'])) {
              $__tyFLD = $RA[RA_cn__arDS][$__tyFLD]['cn__tyOFI'];
            }
            while (strpos($RA[RA_cn__arDS][$__tyFLD]['cxF__EXPR'], '__tyFLD') === FALSE && $wile_i--) {
              $__tyFLD = $RA[RA_cn__arDS][$__tyFLD]['val__vbPQ'];
              if (!$wile_i) {

$ep = "$pp e5";
                $err[] = "  $ep Bad __tyFLD($old__tyFLD) for field_name($field_name) - not found real __tyFLD";
              }
            }
            $real_ty = $RA[RA_cn__arDS][$__tyFLD]['val__vbPQ'] . ' ' . $RA[RA_cn__arDS][$field_name]['ext__vbKB'];
            $fields_desc[$table_name] .= "\n  $field_name $real_ty,";
          }
          $row_val++;
        } elseif (strpos($RA[RA_cn__arDS][$__tyFLD]['cxF__EXPR'], '__tyIND') === FALSE) {

$ep = "$pp e6";
          $cxF__EXPT = $RA[RA_cn__arDS][$field_name]['cxF__EXPR'];
          $err[] = "  $ep Bad cxF__EXPR($cxF__EXPT) for field_name($field_name) - not in (_hieV, __tyIND)";
        } else {
          $real_ty = "";
          if (strpos($RA[RA_cn__arDS][$__tyFLD]['cxF__EXPR'], '_icPG') !== FALSE) { //  is just PRIMARY KEY group
            $real_ty = "PRIMARY KEY (" . $RA[RA_cn__arDS][$field_name]['cxF__EXPR'];
          } else {
            if ($RA[RA_cn__arDS][$__tyFLD]['cxN__arDS'] == '_gkU') { // is it unical
              $real_ty .= "UNIQUE ";
            }
            $real_ty .= "KEY $field_name(" . $RA[RA_cn__arDS][$field_name]['cxF__EXPR'];
          }
          if (strpos($RA[RA_cn__arDS][$__tyFLD]['cxF__EXPR'], '_icsoM') !== FALSE) {
            $index_field = $src['_raOBJ__acPG_hie'][$src_i][$RA_raOBJ__acPG_hie_multi__FLD];
            if (isset($RA[RA_cn__arDS][$index_field])) {
              $real_ty .= ", $index_field";
            } else {

$ep = "$pp e7";
              $err[] = "  $ep Bad __tyFLD($old__tyFLD) for field_name($field_name) - not found real __tyFLD";
            }
          }
          $fields_keys[$table_name] .= "\n  $real_ty),";
          if (strpos($RA[RA_cn__arDS][$__tyFLD]['cxF__EXPR'], '_icKR') !== FALSE) { //  is just REFERENCE KEY group like FK_ or RK_
            $real_field = $RA[RA_cn__arDS][$field_name]['ext__vbKB'];
            $fco = $RA[RA_cn__arDS][explode(' ', $real_field)[0]]['val__vbPQ'];
            $real_ty = "CONSTRAINT $field_name FOREIGN KEY (" . $RA[RA_cn__arDS][$field_name]['cxF__EXPR']
            . ") REFERENCES _{$fco}{$real_field}";
            $fields_constraints[$table_name] .= "\n  $real_ty,";
          }
        }
        $chi_val++;
      }
    }
  }
  $fco = $RA[RA_cn__arDS][$table_name]['val__vbPQ'];
  $sql =  rtrim("CREATE table _{$fco}{$table_name} (" . $fields_desc[$table_name] . $fields_keys[$table_name] . $fields_constraints[$table_name], ',') . "\n)";
  __check_DB($table_name);
  $dst[RA_sql][$table_name] = $sql;
  $RA[RA_sq][] = $sql;
$pp = '_p002y';
  $log[] ="$pp s4  Created tables number: " . count($dst[RA_sql]);
  du($log);
  //du($RA[RA_sq]);
  if ($err) dz("$pp e8  Errors found", $err);
  foreach ($RA[RA_sq] as $tname => $sql) db_query($sql);
  $log = [];

}

$pp = '_p003a';
function _raCore_dropDB($sprefix = '_wRA') {
  global $RA;
  $rows = db_query("SELECT SCHEMA_NAME from information_schema.SCHEMATA where SCHEMA_NAME like '$sprefix%'")->fetchAll(\PDO::FETCH_COLUMN);
  foreach ($rows as $sname) {
    db_query("DROP database $sname");
  }
}

$pp = '_p004a';
function __check_DB($table_name) {
  global $RA, $dst;
$pp = '_p004b';
  $mname = $RA[RA_cn__arDS][$table_name]['cxN__arDS'];
  if (!isset($RA[RA_cn__arDS][$mname])) {
    dz("$pp e1 Error module name($mname) not found!");
  } else {
    $sname = $RA[RA_cn__arDS][$mname]['cxN__arDS'];
    if (!isset($RA[RA_cn__arDS][$sname])) {
      dz("$pp e2 Error schema name($sname) not found!");
    } else {      
      if (!isset($RA[RA_db][$sname])) {
        $RA[RA_db][$sname] = 1;
        if (!db_query("SELECT 1 FROM information_schema.SCHEMATA where SCHEMA_NAME = '$sname'")->fetchColumn()) {
          $RA[RA_sq][] = "CREATE database $sname";
        }
      }
      if ($RA[RA_curDB] != $sname) {
        $RA[RA_curDB] = $sname;
        $RA[RA_sq][] = "USE $sname";
      }
    }
  }
}