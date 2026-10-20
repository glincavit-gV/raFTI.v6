<?php
include_once '_o001a_raCore__acPP_meta.php';

function _raCore_iniTables() { $pp = 'p002a-0a';
  global $RA;
  $_OM_ref = "_RA";
  $_OM_ver = "0.1.$_OM_ref class - wind up";
  extract($RA[RA__tySEP]);
  $RA_raTY__arDS_cn__arDS = 0;
  $RA_raTY__arDS_cxN__arDS = 1;
  $cons = 'bcdfghjklmnpqrstvwxyz';
  $son = 'aeiou';
  $src['_raTY__arP'] = [
 //  NOT NULL ==== NOT NULL === NULL ======= NOT NULL ==== NOT NULL ==== NOT NULL ==== NOT NULL
    [RA_cn__arDS, 'cxN__arDS', 'cxF__EXPR', 'expl__bvKB', 'val__tyFLD', 'rule__EXPR', 'te__EXPR'],

//                                                   === rule__EXPR ===, te__EXPR
//                                                   'dsx , dsn , dsABR'
    ['_OM', '_OM', '', 'Object Model -- ', '__enZB', '_ZA , _WR , _UUU', '_/ds'], // the only one and 1-st cn__arDS can be used in its cxN
                                                    //_ZA - nothing for dsx part
                                                          //_WR - use all words 1-st symbol in main part of expl__bvKB (befor ( -- )) - abreviation like rule
                                                                //_UUU - convert all result part of ds to (upper case)
                                                                        //_/ds - put separator (_) in front of ds result, (/) - the template parts separator

    ['_RA', '_OM', '', 'Relate Assemblis -- global context', '__enZB', '_ZA , _WR , _UUU', '_/ds'],
    ['_raALT', '_RA', '', 'alternatives -- meta type', '__enZB', '_cxN_AA , _AT , _sUU', '_/ds'],
                                                                //_cxN_NA - use from (cxN - field) its (_NA - all dsn part)
                                                                          //_AT - use from (_A - any vocals/consonants) its 1-st 3 symbols
                                                                                //_sUU - convert dsx part to (lower case) all other parts to (upper case)

 //   _arDS(te__EXPR, rule__EXPR, expl__bvKB, cxN__arDS, cxF__EXPR, cn__TY) - the function to generate cn__arDS on template in te__EXPR by its parameters
    ['_raDS', '_RA', '', 'designation -- all type of desegnation by rules abrised in template', '__enZB', '_cxN_AA , _CD , _sUU', '_/ds'],

    ['_raTE', '_RA', '', 'template -- sub context for temlate description vs content', '__enZB', '_cxN_AA , _AD , _sUU', '_/ds'],
    ['_raTY', '_RA', '', 'types', '__enZB', '_cxN_AA , _AD , _sUU', '_/ds'],
    ['_raLI', '_RA', '', 'list', '__enZB', '_cxN_AA , _AD , _sUU', '_/ds'],
    ['_raHIE', '_RA', '', 'hierachy', '__enZB', '_cxN_AA , _AT , _sUU', '_/ds'],
    ['_hieSCH', '_raHIE', '_raTE', 'schema', '__enZB', '_cxNT_NA , _AT , _sUU', '_/ds'],
    ['_hieI', '_raHIE', '_hieSCH', 'initiatives', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_hieM', '_raHIE', '_hieI', 'modules', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_hieA', '_raHIE', '_hieM', 'aggregates', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_hieC', '_raHIE', '_hieA', 'components', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_hieO', '_raHIE', '_hieC', 'objects', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_hieV', '_raHIE', '_hieC', 'variables -- or fields', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],

    ['_altCX_CN', '_raALT', '', 'Context/Content', '__enZB', '_cxN_NA , _LE , _sUU', '_/ds/_/dso:_LE'],
                                                                          //_LE - use (_LE - ligature by functor edge) from 1-st expl__bvKB word
                                                                          // dso:_LE - put here (dso - ds optional part) by rule(_LE) from 2-nd word

    ['_cX', '_altCX_CN', '', 'context -- ', '__enZB', '_AS , _LL , _sUU', '_/ds'],
    ['_cN', '_altCX_CN', '', 'content -- ', '__enZB', '_AS , _LL , _sUU', '_/ds'],
    ['_altMM', '_raALT', '', 'min/max -- ', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_altMIN', '_altMM', '', 'min -- ', '__enZB', '_cxN_XA , _AA , _sUU', '_/ds'],
    ['_altMAX', '_altMM', '', 'max -- ', '__enZB', '_cxN_XA , _AA , _sUU', '_/ds'],
    ['_altLI', '_raALT', '_raLI', ' -- named list of consecutive values', '__enZB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],

    //_liMIN - 26 (english letters number) as alternatives number
    ['_liMIN', '_altLI', '_altMIN', '/^[a-z]$/ -- regexp like range of values : 26', '__evZB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],

    //_liMAX 36 = 10 + 26 (digit letters number) + (english letters number) as alternatives number
    ['_liMAX', '_altLI', '_altMAX', '/^[0-9A-Z]$/ -- --//-- : 36', '__evZB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],

    ['_hieATE', '_hieA', '_raTE', 'the main aggergate like __arP templae(structure) descriptor bits number: 32', '__evZB', '_cxN_AA , _cxF_NA , _zUU', '_/ds'],

    //_ateOFF - agg. element order number
    ['_ateOFF', '_hieATE', '', 'offset -- of agg index bits start : 0', '__evZB', '_cxN_NA , _AT , _sUU', '_/ds'],

    //_ateALT - agg. alternatives like (dsa - synonyms for main ds) or (dsf - ds with fcc code)
    ['_ateALT', '_hieATE', '', 'alternatives -- of agg index bit start : 24', '__evZB', '_cxN_NA , _AT , _sUU', '_/ds'],

    //_ateSEG - the agg. fcc code
    ['_ateSEG', '_hieATE', '', 'segment -- of agg index bit start  : 26', '__evZB', '_cxN_NA , _AT , _sUU', '_/ds'],

    ['_altFUNC', '_raALT', '', 'functor for _altNUM/_altTKN -- insted of exact number is used', '__enZB', '_cxN_NA , _AQ , _sUU', '_/ds'],
    ['__eraseInn', '_altFUNC', '', 'Erase inner -- some number of symbols and return rest', '__enZB', '_AA , _AT , _sHH', '__/dsx/dsn'],
    ['__eraseInnOut', '_altFUNC', '', 'Erase innerr/outer -- some number of symbols and return rest', '__enZB', '_AA , _AT:_ZA , _sHH', '__/dsx/dsn/dso:_AT'],
    ['__extractRef', '_altFUNC', '', 'Extract reference -- return the val__BVPQ of token', '__enZB', '_AA , _AT , _sHH', '__/dsx/dsn'],
    ['__unTuch', '_altFUNC', '', 'untuch token', '__enZB', '_AD , _AA , _sHH', '__/dsx/dsn'],

    ['_altNUM', '_raALT', '', 'numbers - human readable numbers ds', '__enZB', '_cxN_NA , _AT , _sUU', '_/ds'],
    ['_numS', '_altNUM', '_altNUM', 'singlet : 1', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_numB', '_altNUM', '_altNUM', 'byte -- size as in _numS : 1', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_numD', '_altNUM', '_altNUM', 'duplet : 2', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_numT', '_altNUM', '_altNUM', 'triplet : 3', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_numQ', '_altNUM', '_altNUM', 'quadlet : 4', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_numP', '_altNUM', '_altNUM', 'pintet : 5', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_numPS', '_altNUM', '_numP + _numS:_altNUM', ' : 6', '__evDB', '_cxN_NA , _cxF_NR , _sUU', '_/ds'],
    ['_numPD', '_altNUM', '_numP + _numD:_altNUM', ' : 7', '__evDB', '_cxN_NA , _cxF_NR , _sUU', '_/ds'],
    ['_numO', '_altNUM', '_altNUM', 'octet : 8', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_numOS', '_altNUM', '_numO + _numS:_altNUM', ' : 9', '__evDB', '_cxN_NA , _cxF_NR , _sUU', '_/ds'],
    ['_numOD', '_altNUM', '_numO + _numD:_altNUM', ' : 10', '__evDB', '_cxN_NA , _cxF_NR , _sUU', '_/ds'],
    ['_numOT', '_altNUM', '_numO + _numT:_altNUM', ' : 11', '__evDB', '_cxN_NA , _cxF_NR , _sUU', '_/ds'],
    ['_numOQ', '_altNUM', '_numO + _numQ:_altNUM', ' : 12', '__evDB', '_cxN_NA , _cxF_NR , _sUU', '_/ds'],
    ['_numOP', '_altNUM', '_numO + _numP:_altNUM', ' : 13', '__evDB', '_cxN_NA , _cxF_NR , _sUU', '_/ds'],
    ['_numH', '_altNUM', '_altNUM', 'hextet : 16', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
                                                                                          // exclude all bat last symbol
    ['_numL', '_altNUM', '__eraseInn:_altFUNC', 'last -- use last token - size as in _numS : /.(?!\b)/', '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
                                                                                          // exclude all but 1-st and last (edge)
    ['_numE', '_altNUM', '__eraseInn:_altFUNC', 'edge -- use 1-st and last tokens - size as in _numD : /.\K.*(?=.\b)/', '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
                                                                                                          // exclude nothing
    ['_numA', '_altNUM', '__eraseInn:_altFUNC', 'all -- with exception of types and options part of fields : /###/', '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_numR', '_altNUM', '__eraseInn:_altFUNC', 'recursive all -- with exception of types and options part of fields : /###/', '__evPQ', '_cxN_NA , _WS , _sUU', '_/ds'],
    ['_numU', '_altNUM', '__unTuch:_altFUNC', 'untuch all : /###/', '__evPQ', '_cxN_NA , _cxFT_AS , _sUU', '_/ds'],

    ['_altTKN', '_raALT', '', 'token -- source type of expl__bvKB or exact field to use for ds', '__enZB', '_cxN_NA , _CT , _sUU', '_/ds'],
    ['_tknS', '_altTKN', '_numS:_altNUM', ' -- number - 2 ^ _numS : 2', '__evDB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],
    ['_tknD', '_altTKN', '_numD:_altNUM', ' -- number - 2 ^ _numD : 4', '__evDB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],
    ['_tknT', '_altTKN', '_numT:_altNUM', ' -- number - 2 ^ _numT : 8', '__evDB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],
    ['_tknQ', '_altTKN', '_numQ:_altNUM', ' -- number - 2 ^ _numQ : 16', '__evDB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],
    ['_tknP', '_altTKN', '_numP:_altNUM', ' -- number - 2 ^ _numP : 32', '__evDB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],
    ['_tknO', '_altTKN', '_numO:_altNUM', ' -- number - 2 ^ _numO : 256', '__evDB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],
    ['_tknH', '_altTKN', '_numH:_altNUM', ' -- number - 2 ^ _numH : 65536', '__evDB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],
    ['_tknK', '_altTKN', '_altNUM', 'kilo -- number - 2 ^ 10 : 1024', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_tknM', '_altTKN', '_altNUM', 'mega -- number - 2 ^ 20 : 1048576', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_tknG', '_altTKN', '_altNUM', 'giga -- number - 2 ^ 30 : 1073741824', '__evDB', '_cxN_NA , _WR , _sUU', '_/ds'],
                                                                      // (?<=__).* - erase all after type prefix(__)
    ['_tknZ', '_altTKN', '_altFUNC:_altNUM:__eraseInnOut' // /###/ - leave all symbols
      , 'zero -- skip current part of ds (dsx or dsn) or number - 2 ^ _numZ = 1 when is used as __tyFLD : /###/', '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_tknA', '_altTKN', '_altFUNC:__eraseInnOut' // exclude all after type prefix - types and options
      , 'any -- use vocals or consonants symbols : /(?<=__).*|[[:punct:]]/', '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_tknI', '_altTKN', '_altFUNC:__eraseInnOut'
      , 'inverse order any -- from back to front : /(?<=__).*|[[:punct:]]/', '__evPQ', '_cxN_NA , _WS , _sUU', '_/ds'],
    ['_tknC', '_altTKN', '_altFUNC:__eraseInnOut' // exclude all after type prefix and all vocal symbols
      , "consonant -- use consonants symbols : /(?<=__).*|[$son]|[[:punct:]]/i", '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_tknV', '_altTKN', '_altFUNC:__eraseInnOut' // exclude all after type prefix and all consonants
      , "vocal -- use vocals symbols : /(?<=__).*|[$cons]|[[:punct:]])/i", '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_tknL', '_altTKN', '_altFUNC:__eraseInnOut' // exclude all after type prefix and leave only 1-st symbols from ligartures
      , "ligature -- sequence of consonants symbols : /(?<=__).*|(?<=[$cons])[$cons]|[$son]|[[:punct:]]/i", '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_tknW', '_altTKN', '_altFUNC:__eraseInnOut' // exclude all after type prefix and leave only 1-st symbol of word
      , 'word -- use 1-st symbols from word : /(?<=__).*|(?!\b[a-z])[a-z]|[[:punct:]]/i', '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_tknF', '_altTKN', '_altFUNC:__eraseInnOut' // exclude all after type prefix and leave only 1-st symbol of fixie
      , 'fixe -- words represented in mor-phe-me to use as legature : /(?<=__).*|(?!\b[a-z])[a-z]|[[:punct:]]/i', '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_tknN', '_altTKN', '_cN:_altFUNC:__eraseInnOut' // exclude all after type prefix and leave all after 1-st upper case
      , '_cN -- use symbols from part _cN : /(?<=__).*|[[:punct:]]|[a-z0-9]+(?=[A-Z].*)/', '__evPQ', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],
    ['_tknX', '_altTKN', '_cX:_altFUNC:__eraseInnOut' // exclude all after type prefix and leave all before 1-st upper case
      , '_cX -- use symbols from part _cX : /(?<=__).*|[[:punct:]]|[A-Z]+|(?<=[A-Z]).*/', '__evPQ', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],
    ['_tknR', '_altTKN', '_altFUNC:__extractRef'
      , 'reference -- use all symbols from val__evPQ field of content of referencrd field : /###/', '__evPQ', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_cxN', '_altTKN', 'cxN__arDS:_altFUNC:__eraseInnOut'
      , ' -- use this field content : /(?<=__).*|[[:punct:]]/', '__evPQ', '_cxF_AA , _ZA , _zzz', '_/ds'],
    ['_cxF', '_altTKN', 'cxF__EXPR:_altFUNC:__eraseInnOut'
      , ' -- use this field content : /(?<=__).*|[[:punct:]]/', '__evPQ', '_cxF_AA , _ZA , _zzz', '_/ds'],
    ['_cxNT', '_altTKN', 'cxN__arDS:_cxN:_altFUNC:__eraseInnOut'
      , 'type part of this field content : /.*(?=__)|[[:punct:]]/', '__evPQ', '_cxF_AA , _AS , _zUz', '_/ds'],
    ['_cxFT', '_altTKN', 'cxF__EXPR:_cxF:_altFUNC:__eraseInnOut'
      , 'type part of this field content : /.*(?=__)|[[:punct:]]/', '__evPQ', '_cxF_AA , _AS , _zUz', '_/ds'],
    ['_cxNU', '_altTKN', 'cxN__arDS:_altFUNC:__unTuch'
      , 'untuch all parts of this field content : /###/', '__evPQ', '_cxF_AA , _AS , _zUz', '_/ds'],
    ['_cxFU', '_altTKN', 'cxF__EXPR:_altFUNC:__unTuch'
      , 'untuch all parts of this field content : /###/', '__evPQ', '_cxF_AA , _AS , _zUz', '_/ds'],
    ['_tknU', '_altTKN', '_altFUNC:__unTuch'
      , 'untuch content : /###/', '__evPQ', '_cxN_NA , _AS , _sUU', '_/ds'],

    ['_tknNUM', '_raTE', '_altTKN + _altNUM', ' -- template to combine from cxF', '__enZB', '_cxF_NT , _cxF_NT , _sUU', '_/ds'],
    // 1000 - enogth value to skeep the rest of the token
    ['_ZA', '_tknNUM', '_tknZ + _numA:_altNUM:_altFUNC', ' -- skip current token : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_ZL', '_tknNUM', '_tknZ + _numL:_altNUM:_altFUNC', ' -- skip rest of current token : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_ZS', '_tknNUM', '_tknZ + _numS:_altNUM', ' -- skip current token by value symbols : 1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_ZD', '_tknNUM', '_tknZ + _numD:_altNUM', ' -- skip current token --//-- : 2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_ZT', '_tknNUM', '_tknZ + _numT:_altNUM', ' -- skip current token --//-- : 3', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_ZQ', '_tknNUM', '_tknZ + _numQ:_altNUM', ' -- skip current token --//-- : 4', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_ZP', '_tknNUM', '_tknZ + _numP:_altNUM', ' -- skip current token --//-- : 5', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_AA', '_tknNUM', '_tknA + _numA:_altFUNC', ' -- use any all symbols or coresponding field subpart : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_UU', '_tknNUM', '_tknU + _numU:_altFUNC', ' -- untuch coresponding fields or words : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_AR', '_tknNUM', '_tknA + _numR:_altFUNC', ' -- use any all symbols or coresponding field subpart : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_CA', '_tknNUM', '_tknC + _numA:_altFUNC', ' -- use all consonant symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_LA', '_tknNUM', '_tknL + _numA:_altFUNC', ' -- use all ligature(sequence of consonants) 1-st symbol : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_CR', '_tknNUM', '_tknC + _numR:_altFUNC', ' -- use all consonant symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_LR', '_tknNUM', '_tknL + _numR:_altFUNC', ' -- use all ligature(sequence of consonants) 1-st symbol : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_tknRA', '_tknNUM', '_tknR + _numA:_altFUNC', ' -- use all value of referenced field : 1000', '__evDB', '_cxN_XA , _cxF_NR , _sUU', '_/ds'],
    ['_RR', '_tknNUM', '_tknR + _numR:_altFUNC', ' -- use all value of referenced field : 1000', '__evDB', '_ZA , _cxF_NR , _sUU', '_/ds'],
    ['_AE', '_tknNUM', '_tknA + _numE:_altFUNC', ' -- use any edge (vocals or consonants) symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_CE', '_tknNUM', '_tknC + _numE:_altFUNC', ' -- use edge both (1-st and last) consonant symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_VE', '_tknNUM', '_tknV + _numE:_altFUNC', ' -- use edge both vocal symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_LE', '_tknNUM', '_tknL + _numE:_altFUNC', ' -- use edge both ligature 1-st symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_AL', '_tknNUM', '_tknA + _numL:_altFUNC', ' -- use any last (vocals or consonants) symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_CL', '_tknNUM', '_tknC + _numL:_altFUNC', ' -- use last (1-st and last) consonant symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_VL', '_tknNUM', '_tknV + _numL:_altFUNC', ' -- use last vocal symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_LL', '_tknNUM', '_tknL + _numL:_altFUNC', ' -- use last ligature symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_AS', '_tknNUM', '_tknA + _numS', ' -- use any singlet (vocals or consonants) symbols : 1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_AD', '_tknNUM', '_tknA + _numD', ' -- use any duplet (vocals or consonants) symbols : 2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_AT', '_tknNUM', '_tknA + _numT', ' -- use any triplet (vocals or consonants) symbols : 3', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_AQ', '_tknNUM', '_tknA + _numQ', ' -- use any qudlet (vocals or consonants) symbols : 4', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_AP', '_tknNUM', '_tknA + _numP', ' -- use any pintet (vocals or consonants) symbols : 5', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_APS', '_tknNUM', '_tknA + _numPS', ' -- use any pintet (vocals or consonants) symbols : 6', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_APD', '_tknNUM', '_tknA + _numPD', ' -- use any pintet (vocals or consonants) symbols : 7', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_AO', '_tknNUM', '_tknA + _numO', ' -- use any pintet (vocals or consonants) symbols : 0', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_IS', '_tknNUM', '_tknI + _numS:_altNUM', ' -- singlet any invers (from back to front) : -1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_ID', '_tknNUM', '_tknI + _numD:_altNUM', ' -- duplet --//-- : -2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_IT', '_tknNUM', '_tknI + _numT:_altNUM', ' -- triplet --//-- : -3', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_IQ', '_tknNUM', '_tknI + _numQ:_altNUM', ' -- quadlet --//-- : -4', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_IP', '_tknNUM', '_tknI + _numP:_altNUM', ' -- pentet --//-- : -5', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_VS', '_tknNUM', '_tknV + _numS', ' -- use vocals singlet symbol : 1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_VD', '_tknNUM', '_tknV + _numD', ' -- use vocals duplet symbols : 2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_VT', '_tknNUM', '_tknV + _numT', ' -- use vocals triplet symbols : 3', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_CS', '_tknNUM', '_tknC + _numS', ' -- use consonant singlet symbol : 1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_CD', '_tknNUM', '_tknC + _numD', ' -- use consonant duplet symbols : 2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_CT', '_tknNUM', '_tknC + _numT', ' -- use consonant triplet symbols : 3', '__enZB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_LS', '_tknNUM', '_tknL + _numS', ' -- use singlet ligature 1-st symbol : 1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_LD', '_tknNUM', '_tknL + _numD', ' -- use duplet ligature 1-st symbol : 2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_LT', '_tknNUM', '_tknL + _numT', ' -- use triplet ligature 1-st symbol : 3', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_WS', '_tknNUM', '_tknW + _numS', ' -- use word singlet 1-st symbol : 1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_WD', '_tknNUM', '_tknW + _numD', ' -- use words duplet 1-st symbols : 2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_WT', '_tknNUM', '_tknW + _numT', ' -- use words triplet 1-st symbols : 3', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_WR', '_tknNUM', '_tknW + _numR:_altFUNC', ' -- use all words 1-st symbols - as abreviation : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_FS', '_tknNUM', '_tknF + _numS', ' -- use singlet fixe 1-st symbol : 1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_FD', '_tknNUM', '_tknF + _numD', ' -- use duplet fixes 1-st symbol : 2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_FT', '_tknNUM', '_tknF + _numT', ' -- use triplet fixes 1-st symbol : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_FA', '_tknNUM', '_tknF + _numA:_altFUNC', ' -- use 1-st fixe all symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_FR', '_tknNUM', '_tknF + _numR:_altFUNC', ' -- use 1-st fixe all symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_FL', '_tknNUM', '_tknF + _numL:_altFUNC', ' -- use last fixe all symbols : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_FE', '_tknNUM', '_tknF + _numE:_altFUNC', ' -- use edge fixes 1-st symbol : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_NS', '_tknNUM', '_tknN + _numS', ' -- use all _cN symbols part from singlet sub parts : 1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_ND', '_tknNUM', '_tknN + _numD', ' -- use all _cN symbols part from duplet sub parts : 2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_NT', '_tknNUM', '_tknN + _numT', ' -- use all _cN symbols part from triplet sub parts : 3', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_NQ', '_tknNUM', '_tknN + _numQ', ' -- use all _cN symbols part from quad sub parts : 4', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_NA', '_tknNUM', '_tknN + _numA:_altFUNC', ' -- use all _cN symbols part from all sub parts : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_NR', '_tknNUM', '_tknN + _numR:_altFUNC', ' -- use all _cN symbols part from all sub parts : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_XS', '_tknNUM', '_tknX + _numS', ' -- use all _cX symbols part from singlet sub parts : 1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_XD', '_tknNUM', '_tknX + _numD', ' -- use all _cX symbols part from duplet sub parts : 2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_XT', '_tknNUM', '_tknX + _numT', ' -- use all _cX symbols part from triplet sub parts : 3', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_XQ', '_tknNUM', '_tknX + _numQ', ' -- use all _cX symbols part from quad sub parts : 4', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_XA', '_tknNUM', '_tknX + _numA:_altFUNC', ' -- use all _cX symbols part from all sub parts : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_XR', '_tknNUM', '_tknX + _numR:_altFUNC', ' -- use all _cX symbols part from all sub parts : 1000', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_ZB', '_tknNUM', '_tknZ + _numB:_altNUM', ' -- number - 2 ^ _numZ * _numB : 1', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_SB', '_tknNUM', '_tknS + _numB:_altNUM', ' -- number - 2 ^ _numS * _numB : 2', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_ST', '_tknNUM', '_tknS + _numT:_altNUM', ' -- number - 2 ^ _numS * _numT : 6', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_DB', '_tknNUM', '_tknD + _numB:_altNUM', ' -- number - 2 ^ _numD * _numB : 4', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_TB', '_tknNUM', '_tknT + _numB:_altNUM', ' -- number - 2 ^ _numT * _numB : 8', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_QB', '_tknNUM', '_tknQ + _numB:_altNUM', ' -- number - 2 ^ _numQ * _numB : 16', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_PB', '_tknNUM', '_tknP + _numB:_altNUM', ' -- number - 2 ^ _numP * _numB : 32', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_PD', '_tknNUM', '_tknP + _numD:_altNUM', ' -- number - 2 ^ _numP * _numD : 64', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_PQ', '_tknNUM', '_tknP + _numQ:_altNUM', ' -- number - 2 ^ _numP * _numQ : 128', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_OB', '_tknNUM', '_tknO + _numB:_altNUM', ' -- number - 2 ^ _numO * _numB : 256', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_OD', '_tknNUM', '_tknO + _numD:_altNUM', ' -- number - 2 ^ _numO * _numD : 512', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_KB', '_tknNUM', '_tknK + _numB:_altNUM', ' -- number - 2 ^ 10 * _numB : 1024', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_KD', '_tknNUM', '_tknK + _numD:_altNUM', ' -- number - 2 ^ 10 * _numD : 2048', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_KQ', '_tknNUM', '_tknK + _numQ:_altNUM', ' -- number - 2 ^ 10 * _numQ : 4192', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_KO', '_tknNUM', '_tknK + _numO:_altNUM', ' -- number - 2 ^ 10 * _numO : 8384', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_KH', '_tknNUM', '_tknK + _numH:_altNUM', ' -- number - 2 ^ 10 * _numH : 16768', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_HB', '_tknNUM', '_tknH + _numB:_altNUM', ' -- number - 2 ^ _numH * _numB : 65536', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'], 
    ['_HD', '_tknNUM', '_tknH + _numD:_altNUM', ' -- number - 2 ^ _numH * _numD : 131072', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'], 
    ['_HQ', '_tknNUM', '_tknH + _numQ:_altNUM', ' -- number - 2 ^ _numH * _numQ : 262144', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'], 
    ['_HO', '_tknNUM', '_tknH + _numO:_altNUM', ' -- number - 2 ^ _numH * _numO : 524288', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'], 
    ['_MB', '_tknNUM', '_tknM + _numB:_altNUM', ' -- number - 2 ^ _numM * _numB : 1048576', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_MD', '_tknNUM', '_tknM + _numD:_altNUM', ' -- number - 2 ^ _numM * _numD : 2097152', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_MQ', '_tknNUM', '_tknM + _numQ:_altNUM', ' -- number - 2 ^ _numM * _numQ : 4194304', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_MO', '_tknNUM', '_tknM + _numO:_altNUM', ' -- number - 2 ^ _numM * _numQ : 8388608', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_GB', '_tknNUM', '_tknG + _numB:_altNUM', ' -- number - 2 ^ _numG * _numB : 1073741824', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_GD', '_tknNUM', '_tknG + _numD:_altNUM', ' -- number - 2 ^ _numG * _numD : 2147483648', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_GQ', '_tknNUM', '_tknG + _numQ:_altNUM', ' -- number - 2 ^ _numG * _numQ : 4294967296', '__evDB', '_ZA , _cxF_NR , _UUU', '_/ds'],
    ['_cxN_AA', '_tknNUM', '_cxN + _AA', ' -- use all from cxN field symbols except type and option : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_AA', '_tknNUM', '_cxNT + _AA', ' -- use all from __TY part of cxN field symbols : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_AS', '_tknNUM', '_cxNT + _AS', ' -- use all from __TY part of cxN field symbols : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_AD', '_tknNUM', '_cxNT + _AD', ' -- use all from __TY part of cxN field symbols : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_AT', '_tknNUM', '_cxNT + _AT', ' -- use all from __TY part of cxN field symbols : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_IS', '_tknNUM', '_cxNT + _IS', ' -- use all from __TY part of cxN field symbols : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_ID', '_tknNUM', '_cxNT + _ID', ' -- use all from __TY part of cxN field symbols : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_IT', '_tknNUM', '_cxNT + _IT', ' -- use all from __TY part of cxN field symbols : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNU_UU', '_tknNUM', '_cxNU + _UU', ' -- use all from cxN field symbols - total ds : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_RA', '_tknNUM', '_cxN + _tknRA', ' -- use all from refernce in cxN : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_AR', '_tknNUM', '_cxN + _AR', ' -- use all from cxN field symbols except type and option : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_AR', '_tknNUM', '_cxNT + _AR', ' -- use all from __TY part of cxN field symbols : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_RR', '_tknNUM', '_cxN + _RR', ' -- use all from refernce in cxN : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_AS', '_tknNUM', '_cxN + _AS', ' -- use singlet sym. from cxN field symbols except type part : 1', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxN_AD', '_tknNUM', '_cxN + _AD', ' -- use duplet sym. from cxN field symbols except type part : 2', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_AT', '_tknNUM', '_cxN + _AT', ' -- use triplet sym. from cxN field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_AQ', '_tknNUM', '_cxN + _AQ', ' -- use quad sym. from cxN field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_IS', '_tknNUM', '_cxN + _IS', ' -- use singlet sym. from cxN field symbols except type part : 1', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxN_ID', '_tknNUM', '_cxN + _ID', ' -- use duplet sym. from cxN field symbols except type part : 2', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_IT', '_tknNUM', '_cxN + _IT', ' -- use triplet sym. from cxN field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_IQ', '_tknNUM', '_cxN + _IQ', ' -- use quad sym. from cxN field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_NA', '_tknNUM', '_cxN + _NA', ' -- use all _cN symbols part from all sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_NA', '_tknNUM', '_cxNT + _NA', ' -- use all _cN symbols from __TY sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_NS', '_tknNUM', '_cxNT + _NS', ' -- use all _cN symbols from __TY sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_ND', '_tknNUM', '_cxNT + _ND', ' -- use all _cN symbols from __TY sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_NT', '_tknNUM', '_cxNT + _NT', ' -- use all _cN symbols from __TY sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_NR', '_tknNUM', '_cxN + _NR', ' -- use all _cN symbols part from all sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_NR', '_tknNUM', '_cxNT + _NR', ' -- use all _cN symbols from __TY sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_NS', '_tknNUM', '_cxN + _NS', ' -- use singlet sym. from cxN field symbols except type part : 1', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxN_ND', '_tknNUM', '_cxN + _ND', ' -- use duplet sym. from cxN field symbols except type part : 2', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxN_NT', '_tknNUM', '_cxN + _NT', ' -- use triplet sym. from cxN field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxN_NQ', '_tknNUM', '_cxN + _NQ', ' -- use quad sym. from cxN field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxN_XA', '_tknNUM', '_cxN + _XA', ' -- use all _cX symbols part from all sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_XA', '_tknNUM', '_cxNT + _XA', ' -- use all _cX symbols from __TY sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_XS', '_tknNUM', '_cxNT + _XS', ' -- use all _cX symbols from __TY sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_XD', '_tknNUM', '_cxNT + _XD', ' -- use all _cX symbols from __TY sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_XT', '_tknNUM', '_cxNT + _XT', ' -- use all _cX symbols from __TY sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_XR', '_tknNUM', '_cxN + _XR', ' -- use all _cX symbols part from all sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxNT_XR', '_tknNUM', '_cxNT + _XR', ' -- use all _cX symbols from __TY sub parts of cxN field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxN_XS', '_tknNUM', '_cxN + _XS', ' -- use singlet sym. from cxN field symbols except type part : 1', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxN_XD', '_tknNUM', '_cxN + _XD', ' -- use duplet sym. from cxN field symbols except type part : 2', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxN_XT', '_tknNUM', '_cxN + _XT', ' -- use triplet sym. from cxN field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxN_XQ', '_tknNUM', '_cxN + _XQ', ' -- use quad sym. from cxN field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'], 
    ['_cxF_AA', '_tknNUM', '_cxF + _AA', ' -- use all from cxF field except type and options : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_RA', '_tknNUM', '_cxF + _tknRA', ' -- use all from refernce in cxF : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_AA', '_tknNUM', '_cxFT + _AA', ' -- use from __TY part of cxF field symbol : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_AS', '_tknNUM', '_cxFT + _AS', ' -- use from __TY part of cxF field symbol : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_AD', '_tknNUM', '_cxFT + _AD', ' -- use from __TY part of cxF field symbol : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_AT', '_tknNUM', '_cxFT + _AT', ' -- use from __TY part of cxF field symbol : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_IS', '_tknNUM', '_cxFT + _IS', ' -- use from __TY part of cxF field symbol : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_ID', '_tknNUM', '_cxFT + _ID', ' -- use from __TY part of cxF field symbol : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_IT', '_tknNUM', '_cxFT + _IT', ' -- use from __TY part of cxF field symbol : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFU_UU', '_tknNUM', '_cxFU + _UU', ' -- use all from all part cxF field symbols - total ds : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_AR', '_tknNUM', '_cxF + _AR', ' -- use all from cxF field except type and options : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_RR', '_tknNUM', '_cxF + _RR', ' -- use all from refernce in cxF : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_AR', '_tknNUM', '_cxFT + _AR', ' -- use from __TY part of cxF field symbol : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_AS', '_tknNUM', '_cxF + _AS', ' -- use all from cxF field symbols singlet sub parts except type part : 1', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_AD', '_tknNUM', '_cxF + _AD', ' -- use all from cxF field symbols duplet sub parts except type part : 2', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_AT', '_tknNUM', '_cxF + _AT', ' -- use all from cxF field symbols triplet sub parts except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_AQ', '_tknNUM', '_cxF + _AQ', ' -- use all from cxF field symbols quad sub parts except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_IS', '_tknNUM', '_cxF + _IS', ' -- use all from cxF field symbols singlet sub parts except type part : 1', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_ID', '_tknNUM', '_cxF + _ID', ' -- use all from cxF field symbols duplet sub parts except type part : 2', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_IT', '_tknNUM', '_cxF + _IT', ' -- use all from cxF field symbols triplet sub parts except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_IQ', '_tknNUM', '_cxF + _IQ', ' -- use all from cxF field symbols quad sub parts except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_NA', '_tknNUM', '_cxF + _NA', ' -- use all _cN from cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_NA', '_tknNUM', '_cxFT + _NA', ' -- use all _cN symbols from __TY sub parts of cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_NS', '_tknNUM', '_cxFT + _NS', ' -- use all _cN symbols from __TY sub parts of cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_ND', '_tknNUM', '_cxFT + _ND', ' -- use all _cN symbols from __TY sub parts of cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_NT', '_tknNUM', '_cxFT + _NT', ' -- use all _cN symbols from __TY sub parts of cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_NR', '_tknNUM', '_cxF + _NR', ' -- use all _cN from cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_NR', '_tknNUM', '_cxFT + _NR', ' -- use all _cN symbols from __TY sub parts of cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_NS', '_tknNUM', '_cxF + _NS', ' -- use singlet sym. from cxF field symbols except type part : 1', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxF_ND', '_tknNUM', '_cxF + _ND', ' -- use duplet sym. from cxF field symbols except type part : 2', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxF_NT', '_tknNUM', '_cxF + _NT', ' -- use triplet sym. from cxF field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxF_NQ', '_tknNUM', '_cxF + _NQ', ' -- use quad sym. from cxF field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxF_XA', '_tknNUM', '_cxF + _XA', ' -- use all _cX part from cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_XA', '_tknNUM', '_cxFT + _XA', ' -- use all _cX symbols from __TY sub parts of cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_XS', '_tknNUM', '_cxFT + _XS', ' -- use all _cX symbols from __TY sub parts of cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_XD', '_tknNUM', '_cxFT + _XD', ' -- use all _cX symbols from __TY sub parts of cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_XT', '_tknNUM', '_cxFT + _XT', ' -- use all _cX symbols from __TY sub parts of cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_XR', '_tknNUM', '_cxF + _XR', ' -- use all _cX part from cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxFT_XR', '_tknNUM', '_cxFT + _XR', ' -- use all _cX symbols from __TY sub parts of cxF field : 1000', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_cxF_XS', '_tknNUM', '_cxF + _XS', ' -- use singlet sym. from cxF field symbols except type part : 1', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxF_XD', '_tknNUM', '_cxF + _XD', ' -- use duplet sym. from cxF field symbols except type part : 2', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxF_XT', '_tknNUM', '_cxF + _XT', ' -- use triplet sym. from cxF field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],        
    ['_cxF_XQ', '_tknNUM', '_cxF + _XQ', ' -- use quad sym. from cxF field symbols except type part : 3', '__evDB', '_cxF_AA , _cxF_NA , _zzz', '_/dsx/_/dsn'],
    ['_dsABR', '_raDS', '_raTE', 'abris -- rule for capitalisation abris of _raDS in 3 parts', '__enZB', '_cxNT_NA , _AT , _sUU', '_/ds'],
    ['_tyABR', '_dsABR', '_raTY', ' -- type of abris', '__enZB', '_cxF_NA , _cxN_NA , _sUU', '_/ds'],
    ['_teABR', '_dsABR', '_raTE', '_/cx) + (cn) + (rest) -- template of abris', '__enZB', '_cxF_NA , _cxN_NA , _sUU', '_/ds'],
    ['_abrZ', '_tyABR', '', 'zero -- capitalisation = leave as is', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_abrS', '_tyABR', '', 'stringify -- capitalisation = lower case', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_abrU', '_tyABR', '', 'upper -- case - capitalisation = upper case', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_abrH', '_tyABR', '', 'horse -- upper case for 1-st lettre + lower for the rest', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],
    ['_abrC', '_tyABR', '', 'camal -- lower case for 1-st token + _atrH for each next', '__enZB', '_cxN_NA , _WR , _sUU', '_/ds'],

//                       dsx  +  dsn  + (rest) - the abris conversions: (C - upper / s - lower / z - leave as is) - cases of conversion
    ['_zzz', '_dsABR', '_abrZ + _abrZ + _abrZ', '', '__enZB', '_cxF_NA , _cxF_NA , _sss', '_/ds/dso:_cxF_NA'],
    ['_szz', '_dsABR', '_abrS + _abrZ + _abrZ', '', '__enZB', '_cxF_NA , _cxF_NA , _sss', '_/ds/dso:_cxF_NA'],
    ['_zUU', '_dsABR', '_abrZ + _abrU + _abrU', '', '__enZB', '_cxF_NA , _cxF_NA , _sUU', '_/ds/dso:_cxF_NA'],
    ['_sUU', '_dsABR', '_abrS + _abrU + _abrU', 'common ra cxCN like abris', '__enZB', '_cxF_NA , _cxF_NA , _sUU', '_/ds/dso:_cxF_NA'],
    ['_sss', '_dsABR', '_abrS + _abrS + _abrS', '', '__enZB', '_cxF_NA , _cxF_NA , _sss', '_/ds/dso:_cxF_NA'],
    ['_ssU', '_dsABR', '_abrS + _abrS + _abrU', '', '__enZB', '_cxF_NA , _cxF_NA , _ssU', '_/ds/dso:_cxF_NA'],
    ['_ssz', '_dsABR', '_abrS + _abrS + _abrZ', '', '__enZB', '_cxF_NA , _cxF_NA , _sss', '_/ds/dso:_cxF_NA'],
    ['_UUU', '_dsABR', '_abrU + _abrU + _abrU', '', '__enZB', '_cxF_NA , _cxF_NA , _UUU', '_/ds/dso:_cxF_NA'],
    ['_UUs', '_dsABR', '_abrU + _abrU + _abrS', '', '__enZB', '_cxF_NA , _cxF_NA , _UUs', '_/ds/dso:_cxF_NA'],
    ['_UUz', '_dsABR', '_abrU + _abrU + _abrZ', '', '__enZB', '_cxF_NA , _cxF_NA , _UUs', '_/ds/dso:_cxF_NA'],
    ['_sUs', '_dsABR', '_abrS + _abrU + _abrS', '', '__enZB', '_cxF_NA , _cxF_NA , _sUs', '_/ds/dso:_cxF_NA'],
    ['_sUz', '_dsABR', '_abrS + _abrU + _abrZ', '', '__enZB', '_cxF_NA , _cxF_NA , _sUs', '_/ds/dso:_cxF_NA'],
    ['_zUz', '_dsABR', '_abrZ + _abrU + _abrZ', '', '__enZB', '_cxF_NA , _cxF_NA , _sUs', '_/ds/dso:_cxF_NA'],
    ['_sHs', '_dsABR', '_abrS + _abrH + _abrS', '', '__enZB', '_cxF_NA , _cxF_NA , _sUs', '_/ds/dso:_cxF_NA'],
    ['_sHz', '_dsABR', '_abrS + _abrH + _abrZ', '', '__enZB', '_cxF_NA , _cxF_NA , _sUs', '_/ds/dso:_cxF_NA'],
    ['_sHU', '_dsABR', '_abrS + _abrH + _abrU', '', '__enZB', '_cxF_NA , _cxF_NA , _sUU', '_/ds/dso:_cxF_NA'],
    ['_sUH', '_dsABR', '_abrS + _abrU + _abrH', '', '__enZB', '_cxF_NA , _cxF_NA , _sUU', '_/ds/dso:_cxF_NA'],
    ['_sHH', '_dsABR', '_abrS + _abrH + _abrH', '', '__enZB', '_cxF_NA , _cxF_NA , _sUU', '_/ds/dso:_cxF_NA'],
    ['_UsU', '_dsABR', '_abrU + _abrS + _abrU', '', '__enZB', '_cxF_NA , _cxF_NA , _UsU', '_/ds/dso:_cxF_NA'],
    ['_sUC', '_dsABR', '_abrS + _abrU + _abrC', '', '__enZB', '_cxF_NA , _cxF_NA , _sUU', '_/ds/dso:_cxF_NA'],
    ['_ssC', '_dsABR', '_abrS + _abrS + _abrC', '', '__enZB', '_cxF_NA , _cxF_NA , _ssU', '_/ds/dso:_cxF_NA'],
    ['_zzC', '_dsABR', '_abrZ + _abrZ + _abrC', '', '__enZB', '_cxF_NA , _cxF_NA , _ssU', '_/ds/dso:_cxF_NA'],
    ['__tySEP', '_raTY', '', 'separator', '__enZB', '_cxN_NA , _AT , _sUU', '__/ds'],
    ['_sepCN', '__tySEP', '', "content -- or hierarchy level separator : $_sepCN", '__evQB', '_cxNT_NA , _CD , _sUU', '_/ds'],
    ['_sepTY', '__tySEP', '', "type -- prefix : $_sepTY", '__evQB', '_cxNT_NA , _AD , _sUU', '_/ds'],
    ['_sepADD', '__tySEP', '', "add -- or concatinate contexts : $_sepADD", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds'],
    ['_sepADD_Q', '__tySEP', '', "add quoted -- or concatinate contexts : $_sepADD_Q", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds/_/dso:_AS'],
    ['_sepMINUS', '__tySEP', '', "minus -- or deconcatinate contexts : $_sepMINUS", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds'],
    ['_sepFIXE', '__tySEP', '', "fixe : $_sepFIXE", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds'],
    ['_sepMULT', '__tySEP', '', "multiply -- content separator : $_sepMULT", '__evQB', '_cxNT_NA , _AQ , _sUU', '_/ds'],
    ['_sepMULT_Q', '__tySEP', '', "multiply quoted -- content separator : $_sepMULT_Q", '__evQB', '_cxNT_NA , _AQ:_ZA , _sUU', '_/ds/_/dso:_AS'],
    ['_sepVALUE', '__tySEP', '', "value -- or high level nod contexts : $_sepVALUE", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds'],
    ['_sepOPTION', '__tySEP', '', "option : $_sepOPTION", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds'],
    ['_sepBACK', '__tySEP', '', "back  -- references : $_sepBACK", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds'],
    ['_sepLIST', '__tySEP', '', "list -- content separator : $_sepLIST", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds'],
    ['_sepALT', '__tySEP', '', "alternatives -- content separator : $_sepALT", '__evQB', '_cxNT_NA , _AT , _sUU', '_/ds'],
    ['_sepALT_Q', '__tySEP', '', "alternatives quoted -- content separator : $_sepALT_Q", '__evQB', '_cxNT_NA , _AT:_ZA , _sUU', '_/ds/_/dso:_AS'],
    ['_sepPART', '__tySEP', '', "part -- or path content separator : $_sepPART", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds'],
    ['_sepPART_Q', '__tySEP', '', "part quoted -- or path content separator : $_sepPART_Q", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds/_/dso:_AS'],
    ['_sepREM', '__tySEP', '', "remarc -- content separator : $_sepREM", '__evQB', '_cxNT_NA , _AT , _sUU', '_/ds'],
    ['_sepPER', '__tySEP', '', "persons sign criterion : $_sepPER", '__evQB', '_cxNT_NA , _AT , _sUU', '_/ds'],
    ['_sepWORD', '__tySEP', '', "word : $_sepWORD", '__evQB', '_cxNT_NA , _AA , _sUU', '_/ds'],
    ['_sepSTRUC', '__tySEP', '', "structure -- components : $_sepSTRUC", '__evQB', '_cxNT_NA , _AP , _sUU', '_/ds'],
    ['_sepSTRUC_Q', '__tySEP', '', "structure quoted -- components : $_sepSTRUC_Q", '__evQB', '_cxNT_NA , _AP:_ZA , _sUU', '_/ds/_/dso:_AS'],
    ["$_sepCN", '_sepCN', '__tySEP', "content -- or hierarchy level separator", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepTY", '_sepTY', '__tySEP', "type -- prefix", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepADD", '_sepADD', '__tySEP', "add -- or concatinate contexts", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepADD_Q", '_sepADD_Q', '__tySEP', "add -- or concatinate contexts", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepMINUS", '_sepMINUS', '__tySEP', "minus -- or deconcatinate contexts", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepFIXE", '_sepFIXE', '__tySEP', "fixe", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepMULT", '_sepMULT', '__tySEP', "multiply -- content separator", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepMULT_Q", '_sepMULT_Q', '__tySEP', "multiply -- content separator", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepVALUE", '_sepVALUE', '__tySEP', "value -- or high level nod contexts", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepOPTION", '_sepOPTION', '__tySEP', "option", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepBACK", '_sepBACK', '__tySEP', "back -- references", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepLIST", '_sepLIST', '__tySEP', "list -- content separator", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepALT", '_sepALT', '__tySEP', "alternatives -- content separator", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepALT_Q", '_sepALT_Q', '__tySEP', "alternatives -- content separator", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepPART", '_sepPART', '__tySEP', "part -- or path content separator", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepPART_Q", '_sepPART_Q', '__tySEP', "part -- or path content separator", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepREM", '_sepREM', '__tySEP', "remarc -- content separator", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepPER", '_sepPER', '__tySEP', "persons sign criterion", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepWORD", '_sepWORD', '__tySEP', "word", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepSTRUC", '_sepSTRUC', '__tySEP', "structure", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ["$_sepSTRUC_Q", '_sepSTRUC_Q', '__tySEP', "structure", '__enZB', '_cxN_RA , _ZA , _zzz', 'ds'],
    ['_dsTE', '_raDS', '_raTE', ' -- rule for saparations of _raDS', '__enZB', '_cxN_NA , _cxF_NA , _sUU', '_/ds'],
    ['ds', '_dsTE', '', ' -- main functor for - _cX/cN parts', '__enZB', '_cxN_XA , _ZA , _sss', 'ds'],
    ['dsx', '_dsTE', '_cX', ' -- _cX part ds', '__enZB', '_cxN_XA , _cxF_NA , _sss', 'ds'],
    ['dsn', '_dsTE', '_cN', ' -- _cX part ds', '__enZB', '_cxN_XA , _cxF_NA , _sss', 'ds'],
    ['dsa', '_dsTE', '', 'alternative -- to main functorwith with its own parameters', '__enZB', '_cxN_XA , _WR , _sss', 'ds'],
    ['dst', '_dsTE', '__tyOBJ', ' -- use object type', '__enZB', '_cxN_XA , _cxFT_AS , _sss', 'ds'],
    ['dso', '_dsTE', '', 'options', '__enZB', '_cxN_XA , _WR , _sss', 'ds'],
    ['fcc', '_dsTE', '', 'Facet Class Code -- name spaces', '__enZB', '_ZA , _WR , _sss', 'ds'],
    ['fccI', 'fcc', '_hieI', 'initiatives name space : _liMAX', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],
    ['fccM', 'fcc', '_hieM', 'modules name space : _liMAX', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],
    ['fccA', 'fcc', '_hieA', 'aggregates name space : _liMAX', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],
    ['fccC', 'fcc', '_hieC', 'component name space : _liMAX', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],
    ['fccO', 'fcc', '_hieO', 'objects name space : _liMIN', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],
    ['fccD', 'fcc', '_hieO', 'documents name space : _liMAX', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],
    ['fccP', 'fcc', '_hieO', 'programm points name space : _liMAX', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],
    ['fccE', 'fcc', '_hieO', 'errors name space : _liMAX', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],
    ['fccS', 'fcc', '_hieO', 'short mesage name space : _liMAX', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],
    ['fccV', 'fcc', '_hieO', 'version name space : _liMAX', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],
    ['fccF', 'fcc', '_hieO', 'field name space : _liMIN', '__evPQ', '_cxN_AA , _WS , _sUU', 'ds'],

    ['__tyAGG', '_raTY', '_hieA', 'agg. -- types', '__enZB', '_cxN_NA , _AT , _sUU', '__/ds'],
    ['__tyGK', '_raTY', '', 'global key -- type ', '__enZB', '_cxN_NA , _WR , _sUU', '__/ds'],
    ['__tyCOMP', '_raTY', '', 'components -- type ', '__enZB', '_cxN_NA , _AQ , _sUU', '__/ds'],
    ['__tyFLD', '_raTY', '', 'field -- type ', '__enZB', '_cxN_NA , _CT , _sUU', '__/ds'],
    ['__tyIND', '_raTY', '', 'index -- type ', '__enZB', '_cxN_NA , _AT , _sUU', '__/ds'],
    ['__tyOBJ', '_raTY', '', 'object -- __tyCOMP + __tyFLD + __tyIND', '__enZB', '_cxN_NA , _AT , _sUU', '__/ds'],
    ['__tyAR', '__tyAGG', '', 'register -- main component object', '__enZB', '_cxNT_AT , _WR , _zUU', '__/ds'],
    ['__tyAC', '__tyAGG', '', 'component -- slave component object', '__enZB', '_cxNT_AT , _WR , _zUU', '__/ds'],
    ['__tyAS', '__tyAGG', '', 'solution -- code component object', '__enZB', '_cxNT_AT , _WR , _zUU', '__/ds'],
    ['_gkP', '__tyGK', '', 'primary -- global through all modules', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_gkS', '__tyGK', '', 'secondary -- global through current module', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_gkT', '__tyGK', '', 'tertiary -- global through current object - the ID like field outside the ra', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_gkDS', '__tyGK', '_raDS', ' -- global through all modules', '__enZB', '_cxNT_NA , _cxF_NA , _sUU', '_/ds'],
    ['_gkD', '__tyGK', '', 'detalisation -- global through all modules - the ID like field outside the ra', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_gkA', '__tyGK', '', 'array -- global through all modules', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_gkF', '__tyGK', '', 'foreign/forward -- key for reference to forward (usual direction) - 1 to many rels', '__enZB', '_cxNT_NA , _WS , _sUU', '_/ds'],
    ['_gkR', '__tyGK', '', 'revers -- key for refernce to inverse (unusual direction) - 1 to many rels', '__enZB', '_cxNT_NA , _WS , _sUU', '_/ds'],
    ['_gkU', '__tyGK', '', 'unical -- key or index as _gkF but is unical - 1 to 1 rels', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_gkI', '__tyGK', '', 'index -- not key and not unical index', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['__arP', '__tyAR', '_gkP:__tyCOMP:__tyOBJ', 'primary register reference : __nuDB', '__evQB', '_cxNT_NA , _cxF_NA , _sUU', '__/ds'],
    ['__arS', '__tyAR', '_gkS:__tyCOMP:__tyOBJ', 'secondary register reference : __nuDB', '__evQB', '_cxNT_NA , _cxF_NA , _sUU', '__/ds'],
    ['__arT', '__tyAR', '_gkT:__tyCOMP:__tyOBJ', 'tertiary register reference : __nuDB', '__evQB', '_cxNT_NA , _cxF_NA , _sUU', '__/ds'],
    ['__arDS', '__tyAR', '_gkDS:__tyCOMP:__tyOBJ', 'designation value : __bvPQ', '__evQB', '_cxNT_NA , _cxF_NA , _sUU', '__/ds'],
    ['__arPD', '__tyAR', '_gkP + _gkD:__tyCOMP:__tyOBJ', 'primary detalisation reference : __arP', '__evQB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__arSD', '__tyAR', '_gkS + _gkD:__tyCOMP:__tyOBJ', 'secondary detalisation reference : __arS', '__evQB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__arTD', '__tyAR', '_gkT + _gkD:__tyCOMP:__tyOBJ', 'tertiary detalisation reference : __arT', '__evQB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['_acG', '__tyAC', '', 'grid -- ordered union ', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_acU', '__tyAC', '', 'union -- simple union', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_acP', '__tyAC', '', 'php -- file', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_acS', '__tyAC', '', 'sql -- file', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['__acPG', '__tyAC', '_gkP + _acG:__tyCOMP:__tyOBJ', '', '__enZB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__acSG', '__tyAC', '_gkS + _acG:__tyCOMP:__tyOBJ', '', '__enZB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__acTG', '__tyAC', '_gkT + _acG:__tyCOMP:__tyOBJ', '', '__enZB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__acPU', '__tyAC', '_gkP + _acU:__tyCOMP:__tyOBJ', '', '__enZB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__acSU', '__tyAC', '_gkS + _acU:__tyCOMP:__tyOBJ', '', '__enZB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__acTU', '__tyAC', '_gkT + _acU:__tyCOMP:__tyOBJ', '', '__enZB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__acPP', '__tyAC', '_gkP + _acP:__tyCOMP:__tyOBJ', '', '__enZB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__acSP', '__tyAC', '_gkS + _acP:__tyCOMP:__tyOBJ', '', '__enZB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__acTP', '__tyAC', '_gkT + _acP:__tyCOMP:__tyOBJ', '', '__enZB', '_cxNT_NA , _cxF_NR , _sUU', '__/ds'],
    ['__asVS', '__tyAS', '__tyCOMP:__tyOBJ', 'view select', '__enZB', '_cxNT_NA , _WR , _sUU', '__/ds'],
    ['__asFN', '__tyAS', '__tyCOMP:__tyOBJ', 'function', '__enZB', '_cxNT_NA , _AE , _sUU', '__/ds'],
    ['__asFR', '__tyAS', '__tyCOMP:__tyOBJ', 'functor -- used object name generation', '__enZB', '_cxNT_NA , _AE , _sUU', '__/ds'],
    ['__asPS', '__tyAS', '__tyCOMP:__tyOBJ', 'procedure select records', '__enZB', '_cxNT_NA , _WD , _sUU', '__/ds'],
    ['__asPC', '__tyAS', '__tyCOMP:__tyOBJ', 'procedure create/drop/modify objects', '__enZB', '_cxNT_NA , _WD , _sUU', '__/ds'],
    ['__asPD', '__tyAS', '__tyCOMP:__tyOBJ', 'procedure delete records', '__enZB', '_cxNT_NA , _WD , _sUU', '__/ds'],
    ['__asPI', '__tyAS', '__tyCOMP:__tyOBJ', 'procedure insert records', '__enZB', '_cxNT_NA , _WD , _sUU', '__/ds'],
    ['__asPU', '__tyAS', '__tyCOMP:__tyOBJ', 'procedure update records', '__enZB', '_cxNT_NA , _WD , _sUU', '__/ds'],
    ['__asTBI', '__tyAS', '__tyCOMP:__tyOBJ', 'trgger befor insert', '__enZB', '_cxNT_NA , _WR , _sUU', '__/ds'],
    ['__asTBU', '__tyAS', '__tyCOMP:__tyOBJ', 'trgger befor update', '__enZB', '_cxNT_NA , _WR , _sUU', '__/ds'],
    ['__asTBD', '__tyAS', '__tyCOMP:__tyOBJ', 'trgger befor delete', '__enZB', '_cxNT_NA , _WR , _sUU', '__/ds'],
    ['__asTAI', '__tyAS', '__tyCOMP:__tyOBJ', 'trgger after insert', '__enZB', '_cxNT_NA , _WR , _sUU', '__/ds'],
    ['__asTAU', '__tyAS', '__tyCOMP:__tyOBJ', 'trgger after update', '__enZB', '_cxNT_NA , _WR , _sUU', '__/ds'],
    ['__asTAD', '__tyAS', '__tyCOMP:__tyOBJ', 'trgger after delete', '__enZB', '_cxNT_NA , _WR , _sUU', '__/ds'],
    ['__tyFI', '__tyFLD', '_raTE', 'interpritator', '__enZB', '_cxNT_AT , _WR , _zUU', '__/ds'],
    ['__tyFIN', '__tyFLD', '__tyFI', 'numbers -- like - int/float/...', '__enZB', '_cxFT_AA , _WR , _zUU', '__/ds'],
    ['__tyFID', '__tyFLD', '__tyFI', 'data -- like - date/time/...', '__enZB', '_cxFT_AA , _WR , _zUU', '__/ds'],
    ['__tyFIS', '__tyFLD', '__tyFI', 'string -- like - char/varchar/text...', '__enZB', '_cxFT_AA , _WR , _zUU', '__/ds'],
    ['__tyFIB', '__tyFLD', '__tyFI', 'binary -- like - binary/varbinary/blob/...', '__enZB', '_cxFT_AA , _WR , _zUU', '__/ds'],
    ['__tyFIE', '__tyFLD', '__tyFI', 'enamed -- like - enum/ebit/...', '__enZB', '_cxFT_AA , _WR , _zUU', '__/ds'],
    ['_fiNI', '__tyFI', '__tyFIN', 'number int', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiNU', '__tyFI', '__tyFIN', 'number unsigned', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiNF', '__tyFI', '__tyFIN', 'number float', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiDD', '__tyFI', '__tyFID', 'date day -- YYYY-mm-dd', '__enZB', '_cxNT_NA , _WD , _sUU', '_/ds'],
    ['_fiDT', '__tyFI', '__tyFID', 'date time -- hh:mm:ss', '__enZB', '_cxNT_NA , _WD , _sUU', '_/ds'],
    ['_fiDF', '__tyFI', '__tyFID', 'date full -- YYYY-mm-dd hh:mm:ss', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiDU', '__tyFI', '__tyFID', 'date unix -- unsigned int from 1970-01-01 till	2106-02-07', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiDS', '__tyFI', '__tyFID', 'date stamp -- int from 1970-01-01 till 2038-01-19', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiSN', '__tyFI', '__tyFIS', 'string nuber -- fixed length string - nchar/char', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiSV', '__tyFI', '__tyFIS', 'string variant -- not fixed length string - varchar', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiSL', '__tyFI', '__tyFIS', 'string long -- not fixed length string - longtext', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiBN', '__tyFI', '__tyFIB', 'binary nuber -- fixed length binary', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiBV', '__tyFI', '__tyFIB', 'binary variant -- not fixed length binary', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiBL', '__tyFI', '__tyFIB', 'binary long -- not fixed length binary - longblob', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiEN', '__tyFI', '__tyFIE', 'enamed number', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiEV', '__tyFI', '__tyFIE', 'enamed value', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiER', '__tyFI', '__tyFIE', 'enamed reference', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiES', '__tyFI', '__tyFIE', 'enamed structure', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiEB', '__tyFI', '__tyFIE', 'enamed bit', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_fiEM', '__tyFI', '__tyFIE', 'enamed mask', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['__niZB', '_fiNI', '_ZB:__tyFLD:__tyOBJ', ' : tinyint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__niSB', '_fiNI', '_SB:__tyFLD:__tyOBJ', ' : smalint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__niDB', '_fiNI', '_DB:__tyFLD:__tyOBJ', ' : int', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__niTB', '_fiNI', '_TB:__tyFLD:__tyOBJ', ' : bigint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__nuZB', '_fiNU', '_ZB:__tyFLD:__tyOBJ', ' : tinyint unsigned', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__nuSB', '_fiNU', '_SB:__tyFLD:__tyOBJ', ' : smalint unsigned', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__nuDB', '_fiNU', '_DB:__tyFLD:__tyOBJ', ' : int unsigned', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__nuTB', '_fiNU', '_TB:__tyFLD:__tyOBJ', ' : bigint unsigned', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__nfDB', '_fiNF', '_DB:__tyFLD:__tyOBJ', ' : FLOAT', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__nfTB', '_fiNF', '_TB:__tyFLD:__tyOBJ', ' : DOUBLE', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__ddZT', '_fiDD', '_ZT:__tyFLD:__tyOBJ', '3 bytes : DATE', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__dtZT', '_fiDT', '_ZT:__tyFLD:__tyOBJ', '3 bytes : TIME', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__dfST', '_fiDF', '_ST:__tyFLD:__tyOBJ', '6 bytes : DATETIME', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__duDB', '_fiDU', '_DB:__tyFLD:__tyOBJ', ' : int', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__dsDB', '_fiDS', '_DB:__tyFLD:__tyOBJ', ' : timestamp', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svZB', '_fiSV', '_ZB:__tyFLD:__tyOBJ', ' : varchar(1)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svSB', '_fiSV', '_SB:__tyFLD:__tyOBJ', ' : varchar(2)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svDB', '_fiSV', '_DB:__tyFLD:__tyOBJ', ' : varchar(4)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svTB', '_fiSV', '_TB:__tyFLD:__tyOBJ', ' : varchar(8)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svQB', '_fiSV', '_QB:__tyFLD:__tyOBJ', ' : varchar(16)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svPB', '_fiSV', '_PB:__tyFLD:__tyOBJ', ' : varchar(32)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svPD', '_fiSV', '_PD:__tyFLD:__tyOBJ', ' : varchar(64)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svPQ', '_fiSV', '_PQ:__tyFLD:__tyOBJ', ' : varchar(128)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svOB', '_fiSV', '_OB:__tyFLD:__tyOBJ', ' : varchar(256)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svOD', '_fiSV', '_OD:__tyFLD:__tyOBJ', ' : varchar(512)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svKB', '_fiSV', '_KB:__tyFLD:__tyOBJ', ' : varchar(1024)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svKD', '_fiSV', '_KD:__tyFLD:__tyOBJ', ' : varchar(2048)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svKQ', '_fiSV', '_KQ:__tyFLD:__tyOBJ', ' : varchar(4096)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svKO', '_fiSV', '_KO:__tyFLD:__tyOBJ', ' : varchar(8192)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__svKH', '_fiSV', '_KH:__tyFLD:__tyOBJ', ' : varchar(16768)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'], 
    ['__svHB', '_fiSV', '_HB:__tyFLD:__tyOBJ', ' : varchar(65536)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvZB', '_fiBV', '_ZB:__tyFLD:__tyOBJ', ' : varbinary(1)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvSB', '_fiBV', '_SB:__tyFLD:__tyOBJ', ' : varbinary(2)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvDB', '_fiBV', '_DB:__tyFLD:__tyOBJ', ' : varbinary(4)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvTB', '_fiBV', '_TB:__tyFLD:__tyOBJ', ' : varbinary(8)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvQB', '_fiBV', '_QB:__tyFLD:__tyOBJ', ' : varbinary(16)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvPB', '_fiBV', '_PB:__tyFLD:__tyOBJ', ' : varbinary(32)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvPD', '_fiBV', '_PD:__tyFLD:__tyOBJ', ' : varbinary(64)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvPQ', '_fiBV', '_PQ:__tyFLD:__tyOBJ', ' : varbinary(128)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvOB', '_fiBV', '_OB:__tyFLD:__tyOBJ', ' : varbinary(256)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvOD', '_fiBV', '_OD:__tyFLD:__tyOBJ', ' : varbinary(512)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvKB', '_fiBV', '_KB:__tyFLD:__tyOBJ', ' : varbinary(1024)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvKD', '_fiBV', '_KD:__tyFLD:__tyOBJ', ' : varbinary(2048)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvKQ', '_fiBV', '_KQ:__tyFLD:__tyOBJ', ' : varbinary(4096)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvKO', '_fiBV', '_KO:__tyFLD:__tyOBJ', ' : varbinary(8192)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvKH', '_fiBV', '_KH:__tyFLD:__tyOBJ', ' : varbinary(16768)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__bvHB', '_fiBV', '_HB:__tyFLD:__tyOBJ', ' : varbinary(65536)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__slGB', '_fiSL', '_GB:__tyFLD:__tyOBJ', ' : longtext', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__blGB', '_fiBL', '_GB:__tyFLD:__tyOBJ', ' : longblob', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__enZB', '_fiEN', '_ZB:__tyFLD:__tyOBJ', ' : tinyint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__enSB', '_fiEN', '_SB:__tyFLD:__tyOBJ', ' : smalint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__evZB', '_fiEV', '_ZB:__tyFLD:__tyOBJ', ' : tinyint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__evSB', '_fiEV', '_SB:__tyFLD:__tyOBJ', ' : smalint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__evDB', '_fiEV', '_DB:__tyFLD:__tyOBJ', ' : int', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__evTB', '_fiEV', '_TB:__tyFLD:__tyOBJ', ' : bigint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__evQB', '_fiEV', '_QB:__tyFLD:__tyOBJ', ' : varbinary(16)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__evPB', '_fiEV', '_PB:__tyFLD:__tyOBJ', ' : varbinary(32)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__evPD', '_fiEV', '_PD:__tyFLD:__tyOBJ', ' : varbinary(64)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__evPQ', '_fiEV', '_PQ:__tyFLD:__tyOBJ', ' : varbinary(128)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__evOB', '_fiEV', '_OB:__tyFLD:__tyOBJ', ' : varbinary(256)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__esPQ', '_fiES', '_PQ:__tyFLD:__tyOBJ', ' : varbinary(128)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__esOB', '_fiES', '_OB:__tyFLD:__tyOBJ', ' : varbinary(256)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__erOB', '_fiER', '_OB:__tyFLD:__tyOBJ', ' : varbinary(256)', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__ebZB', '_fiEB', '_ZB:__tyFLD:__tyOBJ', ' : tinyint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__ebSB', '_fiEB', '_SB:__tyFLD:__tyOBJ', ' : smalint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__ebDB', '_fiEB', '_DB:__tyFLD:__tyOBJ', ' : int', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__ebTB', '_fiEB', '_TB:__tyFLD:__tyOBJ', ' : bigint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__emZB', '_fiEM', '_ZB:__tyFLD:__tyOBJ', ' : tinyint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__emSB', '_fiEM', '_SB:__tyFLD:__tyOBJ', ' : smalint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__emDB', '_fiEM', '_DB:__tyFLD:__tyOBJ', ' : int', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__emTB', '_fiEM', '_TB:__tyFLD:__tyOBJ', ' : bigint', '__evPB', '_cxN_NA , _cxF_NA , _sUU', '__/ds'],
    ['__tyIC', '__tyIND', '_raTE', 'class', '__enZB', '_cxNT_AT , _WR , _zUU', '__/ds'],
    ['__tyICS', '__tyIC', '_raTE', 'subclass', '__enZB', '_cxNT_AA , _WR , _zUU', '__/ds'],
    ['__tyICSO', '__tyICS', '_raTE', 'options', '__enZB', '_cxNT_AA , _WR , _zUU', '__/ds'],
    ['_icPG', '__tyIC', '_gkP', 'group -- the group __tyIND just for PRIMARI KEY', '__enZB', '_cxNT_NA , _cxF_NA:_WS , _sUU', '_/ds'],
    ['_icKR', '__tyIC', '_icsK', 'reference -- the group __tyIND just for REFERENCE KEY like FK_ or RK_', '__enZB', '_cxNT_NA , _cxF_NA:_WS , _sUU', '_/ds'],
    ['_icsK', '__tyICS', '', 'key -- subclass for PK_ and FK_ like index', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_icsX', '__tyICS', '', 'index -- simple index for ordering and/or filtering purpose', '__enZB', '_cxNT_NA , _AL , _sUU', '_/ds'],
    ['_icsoM', '__tyICSO', '', 'multifield -- like index for _icsK and _icsX like indexes', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['PK_', '_gkP', '_icsK:__tyIND:_icPG:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NA , _UUU', 'ds/_'],
    ['SK_', '_gkS', '_icsK:__tyIND:_icPG:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NA , _UUU', 'ds/_'],
    ['TK_', '_gkT', '_icsK:__tyIND:_icPG:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NA , _UUU', 'ds/_'],
    ['FK_', '_gkF', '_icsK:_icKR:__tyIND:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NA , _UUU', 'ds/_'],
    ['RK_', '_gkR', '_icsK:_icKR:__tyIND:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NA , _UUU', 'ds/_'],
    ['UK_', '_gkU', '_icsK:__tyIND:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NA , _UUU', 'ds/_'],
    ['UX_', '_gkU', '_icsX:__tyIND:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NA , _UUU', 'ds/_'],
    ['IX_', '_gkI', '_icsX:__tyIND:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NA , _UUU', 'ds/_'],
    ['PKM_', '_gkP', '_icsK + _icsoM:__tyIND:_icPG:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NR , _UUU', 'ds/_'],
    ['SKM_', '_gkS', '_icsK + _icsoM:__tyIND:_icPG:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NR , _UUU', 'ds/_'],
    ['TKM_', '_gkT', '_icsK + _icsoM:__tyIND:_icPG:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NR , _UUU', 'ds/_'],
    ['UKM_', '_gkU', '_icsK + _icsoM:__tyIND:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NR , _UUU', 'ds/_'],
    ['UXM_', '_gkU', '_icsX + _icsoM:__tyIND:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NR , _UUU', 'ds/_'],
    ['IXM_', '_gkI', '_icsX + _icsoM:__tyIND:__tyOBJ', '', '__enZB', '_cxN_NA , _cxF_NR , _UUU', 'ds/_'],
    ['__tyPER', '_raTY', '', 'person -- phisic/juridic/registered name', '__enZB', '_cxN_NA , _AT , _sUU', '__/ds'],
    ['_perP', '__tyPER', '', 'phisic', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_perJ', '__tyPER', '', 'juruduc', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],
    ['_perR', '__tyPER', '', 'registered -- name', '__enZB', '_cxNT_NA , _WR , _sUU', '_/ds'],

  ];
  $src['_raOBJ__arP'] = [
    [RA_cn__arDS, 'cxN__arDS', 'cxF__EXPR', 'expl__bvKB', 'val__tyFLD', 'rule__EXPR', 'te__EXPR', 'cn__TY', 'ext__bvKB', 'fcc__svQB'],
    ['_i0_mAgV', '_RA', '@mA + @gV', ' -- houses + cars + ...', '__enZB', '_cxF_AR , _ZA , _zzz', '_/fcc/_/ds', '', '', 'i0'],
    ['_i1_gV', '_RA', '@gV', ' -- ideas', '__enZB', '_cxF_AR , _ZA , _zzz', '_/fcc/_/ds', '', '', 'i1'],
    ['_i2_cGgV', '_RA', '@cG + @gV', ' -- medtech', '__enZB', '_cxF_AR , _ZA , _zzz', '_/fcc/_/ds', '', '', 'i2'],
    ['_i3_pIgV', '_RA', '@pI + @gV', ' -- Konkurs', '__enZB', '_cxF_AR , _ZA , _zzz', '_/fcc/_/ds', '', '', 'i3'],
    ['_i4_gGgV', '_RA', '@gG + @gV', ' -- VSync', '__enZB', '_cxF_AR , _ZA , _zzz', '_/fcc/_/ds', '', '', 'i4'],
    ['_wRA', '_RA', '_hieSCH', 'with -- db schema', '__enZB', '_WR , _cxN_AA , _sUU', '_/ds', '', '', ''],
    ['_wRA_LOG', '_RA', '_hieSCH', 'log -- storage db schema', '__enZB', '_ZA , _AA , _zUz', '_/dst/_/ds', '_wRA', '', ''],
    ['_wRA_NLP', '_RA', '_hieSCH', 'natural lang processing -- db schema', '__enZB', '_ZA , _WR , _zUz', '_/dst/_/ds', '_wRA', '', ''],
    ['_wRA_i0_mAgV', '_i0_mAgV', '_hieSCH', '', '__enZB', '_ZA , _cxNU_UU , _zzz', '_/dst/ds', '_wRA', '', ''],
    ['_wRA_i1_gV', '_i1_gV', '_hieSCH', '', '__enZB', '_ZA , _cxNU_UU , _zzz', '_/dst/ds', '_wRA', '', ''],
    ['_wRA_i2_cGgV', '_i2_cGgV', '_hieSCH', '', '__enZB', '_ZA , _cxNU_UU , _zzz', '_/dst/ds', '_wRA', '', ''],
    ['_wRA_i3_pIgV', '_i3_pIgV', '_hieSCH', '', '__enZB', '_ZA , _cxNU_UU , _zzz', '_/dst/ds', '_wRA', '', ''],
    ['_wRA_i4_gGgV', '_i4_gGgV', '_hieSCH', '', '__enZB', '_ZA , _cxNU_UU , _zzz', '_/dst/ds', '_wRA', '', ''],
    ['_m0_RA', '_wRA', '_hieM', ' -- main module for all initiatives', '__enZB', '_ZA , _cxN_NA , _zUz', '_/fcc/_/ds', '', '', 'm0'],
    ['_m1_WT', '_wRA_i1_gV', '_hieM', 'wine tech -- new version for raFTI_v6', '__enZB', '_ZA , _WR , _zUz', '_/fcc/_/ds', '', '', 'm1'],
    ['_m2_MT', '_wRA_i2_cGgV', '_hieM', 'med tech -- --//--', '__enZB', '_ZA , _WR , _zUz', '_/fcc/_/ds', '', '', 'm2'],
    ['_m3_HT', '_wRA_i0_mAgV', '_hieM', 'house tech -- --//--', '__enZB', '_ZA , _WR , _zUz', '_/fcc/_/ds', '', '', 'm3'],
    ['_m4_TS', '_wRA_i3_pIgV', '_hieM', 'trening systems -- new using of Konkurs', '__enZB', '_ZA , _WR , _zUz', '_/fcc/_/ds', '', '', 'm4'],
    ['_m5_VH', '_wRA_i4_gGgV', '_hieM', 'VSync History', '__enZB', '_ZA , _WR , _zUz', '_/fcc/_/ds', '', '', 'm5'],
    ['_mW_LOG', '_wRA_LOG', '_hieM', '', '__enZB', '_ZA , _cxN_IT , _zUz', '_/fcc/_/ds', '', '', 'mW'],
    ['_mZ_NLP', '_wRA_NLP', '_hieM', '', '__enZB', '_ZA , _cxN_IT , _zUz', '_/fcc/_/ds', '', '', 'mZ'],
    ['_a0_Core', '_RA', '_hieA', 'core -- main aggregate', '__enZB', '_ZA , _AA , _sHz', '_/fcc/_/ds', '', '', 'a0'],
    ['_a1_DOC', '_RA', '_hieA', 'documents', '__enZB', '_ZA , _AT , _zUz', '_/fcc/_/ds', '', '', 'a1'],
    ['_a2_TY', '_RA', '_hieA', 'types', '__enZB', '_ZA , _AD , _zUz', '_/fcc/_/ds', '', '', 'a2'],
    ['_a3_OBJ', '_RA', '_hieA', 'objects', '__enZB', '_ZA , _AT , _zUz', '_/fcc/_/ds', '', '', 'a3'],
    ['_a4_LOC', '_RA', '_hieA', 'locations', '__enZB', '_ZA , _AT , _zUz', '_/fcc/_/ds', '', '', 'a4'],
    ['_a5_PER', '_RA', '_hieA', 'persons', '__enZB', '_ZA , _AT , _zUz', '_/fcc/_/ds', '', '', 'a5'],
    ['_a6_CON', '_RA', '_hieA', 'contacts', '__enZB', '_ZA , _AT , _zUz', '_/fcc/_/ds', '', '', 'a6'],
    ['_aR_RES', '_RA', '_hieA', 'resources', '__enZB', '_ZA , _AT , _zUz', '_/fcc/_/ds', '', '', 'aR'],
    ['_aS_SOL', '_RA', '_hieA', 'solutions', '__enZB', '_ZA , _AT , _zUz', '_/fcc/_/ds', '', '', 'aS'],
    ['_aU_URP', '_RA', '_hieA', 'user role permissions', '__enZB', '_ZA , _WR , _zUz', '_/fcc/_/ds', '', '', 'aU'],
    ['_aT_TLE', '_RA', '_hieA', 'time lines events', '__enZB', '_ZA , _WR , _zUz', '_/fcc/_/ds', '', '', 'aT'],
    ['_aV_VER', '_RA', '_hieA', 'versions', '__enZB', '_ZA , _AT , _UUz', '_/fcc/_/ds', '', '', 'aV'],
    ['_aW_WDOG', '_RA', '_hieA', 'watch-dog', '__enZB', '_FE , _AD , _UUz', '_/fcc/_/ds', '', '', 'aW'],
    ['_aX_EXPR', '_RA', '_hieA', 'expresions', '__enZB', '_ZA , _AQ , _UUz', '_/fcc/_/ds', '', '', 'aX'],
    ['_aY_YBUG', '_RA', '_hieA', 'yet-de-buger', '__enZB', '_FE , _AD , _UUz', '_/fcc/_/ds', '', '', 'aY'],
    ['_aZ_ZENG', '_RA', '_hieA', 'z-english -- referential english - ebanble all fixes for all words', '__enZB', '_FE , _AD , _UUU', '_/fcc/_/ds', '', '', 'aZ'],
    ['_raCore__arP', '_m0_RA', '_a0_Core', ' -- main aggregate unic number register', '__enZB', '_cxN_NA , _cxF_IQ , _szz',
      '_/ds/__/dst', '__arP', 'COMMENT onA_MOD _mod__arP', 'o000a'],
    ['_raCore__arPD_DS', '_m0_RA', '_a0_Core', 'Designation Shortest -- main aggregate detalisation', '__enZB', '_cxN_NA , _cxF_NA , _szz',
      '_/ds/__/dst/_/dso:_WR', '__arPD', 'COMMENT onB_MOD _mod__arDS', 'o000b'],
    ['_raCore__acPP_meta', '_m0_RA', '_a0_Core', 'meta -- php code component', '__enZB', '_cxN_NA , _cxF_NA , _szz',
      '_/ds/__/dst/_/dso:_AA', '__acPP', '', 'o001a'],
    ['_raCore__acPP_ini', '_m0_RA', '_a0_Core', 'initialisation -- php code component', '__enZB', '_cxN_NA , _cxF_NA , _szz',
      '_/ds/__/dst/_/dso:_AT', '__acPP', '', 'o002a'],
    ['_raCore__acPP_api', '_m0_RA', '_a0_Core', 'app. programm interface -- php code component', '__enZB', '_cxN_NA , _cxF_NA , _szz',
      '_/ds/__/dst/_/dso:_WR', '__acPP', '', 'o00Za'],
    ['_raDOC__arP', '_m0_RA', '_a1_DOC', ' --', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__arP', 'COMMENT onA_MOD _mod__arDS', 'o010a'],
    ['_raDOC__acPG_list', '_m0_RA', '_a1_DOC', 'list -- like simplest format', '__enZB', '_cxN_NA , _cxF_NA , _sUz',
      '_/ds/__/dst/_/dso:_AA', '__acPG', 'COMMENT onB_MOD _mod__arDS', 'o011a'],
    ['_raDOC__acPG_post', '_m0_RA', '_a1_DOC', 'post -- like format with @PER and @RES references', '__enZB', '_cxN_NA , _cxF_NA , _sUz',
      '_/ds/__/dst/_/dso:_AA', '__acPG', 'COMMENT onB_MOD _mod__arDS', 'o012a'],
    ['_raTY__arP', '_m0_RA', '_a2_TY', '', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__arP',
      'COMMENT onB_MOD _mod__arDS , _mod__EEXPR', 'o020a'],
    ['_raOBJ__arP', '_m0_RA', '_a3_OBJ', '', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__arP',
      'COMMENT onB_MOD _mod__arDS , _mod__EEXPR', 'o030a'],
    ['_raOBJ__arPD_seg', '_m0_RA', '_a3_OBJ', 'segments', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst/_/dso:_AT', '__arPD',
      'COMMENT onB_MOD _chk_seg', 'o031a'],
    ['_raOBJ__acPG_hie', '_m0_RA', '_a3_OBJ', '_hieV -- grid', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst/_/dso:_XA', '__acPG', '', 'o032a'],
    ['_raLOC__arP', '_m0_RA', '_a4_LOC', '', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__arP',
      'COMMENT onB_MOD _mod__arDS , _mod__EEXPR', 'o040a'],
    ['_raPER__arP', '_m0_RA', '_a5_PER', '', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__arP',
      'COMMENT onB_MOD _mod__arDS , _mod__EEXPR', 'o050a'],
    ['_raPER__acPG_LOC', '_m0_RA', '_a5_PER', '_a4_LOC -- @PER to @LOC grid', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst/_/dso:_NA', '__acPG',
      '', 'o051a'],
    ['_raCON__arP', '_m0_RA', '_a6_CON', '', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__arP',
      'COMMENT onB_MOD _mod__arDS , _mod__EEXPR', 'o060a'],
    ['_raCON__acPG', '_m0_RA', '_a6_CON', '@PER or @LOC to @CON grid', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__acPG', '', 'o061a'],
    ['_raRES__arP', '_m0_RA', '_aR_RES', '', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__arP',
      'COMMENT onB_MOD _mod__arDS , _mod__EEXPR', 'o0R0a'],
    ['_logVER__arT', '_mW_LOG', '_aV_VER', '', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__arT',
      'COMMENT onB_MOD _mod__arDS , _mod__EEXPR', 'oWV0a'],
    ['_logVER__acTG', '_mW_LOG', '_aV_VER', '', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__acTG',
      'COMMENT onB_MOD _mod__arDS , _mod__EEXPR', 'oWV1a'],
    ['_logWDOG__arT', '_mW_LOG', '_aW_WDOG', '', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__arT',
      'COMMENT onB_MOD _mod__arDS , _mod__EEXPR', 'oWW0a'],
    ['_logWDOG__acTG', '_mW_LOG', '_aW_WDOG', '', '__enZB', '_cxN_NA , _cxF_NA , _sUz', '_/ds/__/dst', '__acTG',
      'COMMENT onB_MOD _mod__arDS , _mod__EEXPR', 'oWW1a'],
    ['_raEXPR__arP', '_m0_RA', '_aX_EXPR', '', '__enZB', '_cxN_NA , _cxF_NA , _sUU', '_/ds/__/dst', '__arP', '', 'o0X0a'],
    ['_raEXPR__acPG', '_m0_RA', '_aX_EXPR', 'grid of references', '__enZB', '_cxN_NA , _cxF_NA , _sUU', '_/ds/__/dst', '__acPG', '', 'o0X1a'],
    ['_raYBUG__arP', '_m0_RA', '_aY_YBUG', '', '__enZB', '_cxN_NA , _cxF_NA , _sUU', '_/ds/__/dst', '__arP', '', 'o0Y0a'],
    ['__TY', '_raTY__arP', '__tyOBJ:_hieV', '', '__enZB', '_ZA , _cxN_NA , _zzz', '__/ds', '__arP', 'NULL', ''],
    ['__OBJ', '_raOBJ__arP', '__tyOBJ:_hieV', '', '__enZB', '_ZA , _cxN_NA , _zzz', '__/ds', '__arP', 'NULL', ''],
    ['__EXPR', '_raEXPR__arP', '__tyOBJ:_hieV', '', '__enZB', '_ZA , _cxN_NA , _zzz', '__/ds', '__arP', 'NULL', ''],
    ['_arP', '_raCore__arP', '_hieV', 'primary register functor', '__enZB', '_ZA , _ZA , _zzz', '_/dst', '__arP', 'NOT NULL', ''],
    ['cre__dsDB', '_raCore__arP', '_hieV', 'create', '__enZB', '_AT , _ZA , _szz', 'ds/__/dst', '__dsDB', 'NOT NULL DEFAULT CURRENT_TIMESTAMP', ''],
    ['upd__dsDB', '_raCore__arP', '_hieV', 'update', '__enZB', '_AT , _ZA , _sUU', 'ds/__/dst', '__dsDB', 'NOT NULL DEFAULT CURRENT_TIMESTAMP', ''],
    ['PK_arP', '_raCore__arP', '_arP', '', '__enZB', '_ZA , _cxF_AA , _zzz', 'dst/_/ds', 'PK_', '', ''],
    ['cn__arP', '_raCore__arPD_DS', '_cN:_hieV', 'reference to primary register', '__enZB', '_cxF_AD , _ZA , _ssz', 'ds/__/dst', '__arP', 'NOT NULL', ''],
    ['_arDS', '_raCore__arPD_DS', '__arP:_hieV', ' -- primary register ds functor', '__enZB', '_ZA , _ZA , _zzz', '_/dst', '__arDS', 'NOT NULL', ''],
    ['PK_cn', '_raCore__arPD_DS', 'cn__arP', '', '__enZB', '_ZA , _cxF_AA , _zzz', 'dst/_/ds', 'PK_', '', ''],
    ['UK_arDS', '_raCore__arPD_DS', '_arDS', '', '__enZB', '_ZA , _cxF_AA , _zzz', 'dst/_/ds', 'UK_', '', ''],
    ['FK_raCore__arPD_DS_cn', '_raCore__arPD_DS', 'cn__arP', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_raCore__arP (_arP) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['cxN__arP', '_raTY__arP', '_cX:_hieV', 'near -- reference to primary register', '__enZB', '_cxF_AA , _WR , _sUz', 'dsx/dsn/__/dst', '__arP', 'NOT NULL', ''],
    ['cxN__arDS', '_raTY__arP', 'cxN__arP:_hieV', ' -- ds to primary register', '__enZB', '_cxF_AA , _ZA , _zzz', 'ds/__/dst', '__arDS', 'NOT NULL', ''],
    ['cxF__EXPR', '_raTY__arP', '_cX:_hieV', 'far -- reference to expression of references', '__enZB', '_cxF_AA , _WR , _sUz', 'dsx/dsn/__/dst',
      '__EXPR', 'NULL DEFAULT NULL', ''],
    ['expl__bvKB', '_raTY__arP', '_hieV', 'explanation', '__enZB', '_AQ , _ZA , _szz', 'ds/__/dst', '__bvKB', "NOT NULL DEFAULT ''", ''],
    ['val__tyFLD', '_raTY__arP', '_hieV', 'value', '__enZB', '_AT , _ZA , _szz', '__/dst', '__arP', 'NOT NULL', ''],
    ['rule__EXPR', '_raTY__arP', '_hieV', 'rule -- reference to expression of references for (ds) part', '__enZB', '_AA , _ZA , _szz', 'ds/__/dst',
      '__EXPR', 'NOT NULL', ''],
    ['te__EXPR', '_raTY__arP', '_hieV', 'template -- reference to expression of references for all parts', '__enZB', '_AD , _ZA , _szz', 'ds/__/dst',
      '__EXPR', 'NOT NULL', ''],
    ['val__bvPQ', '_raTY__arP', 'val__tyFLD:_hieV', '', '__enZB', '_cxF_AA , _ZA , _szz', 'ds/__/dst', '__bvPQ', "NOT NULL DEFAULT ''", ''],
    ['FK_raTY__arP_cn', '_raTY__arP', 'cn__arP', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_raCore__arPD_DS (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['FK_raTY__arP_cxN', '_raTY__arP', 'cxN__arP', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_raCore__arPD_DS (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['RK_raTY__arP_cxF', '_raTY__arP', 'cxF__EXPR', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'RK_', '_raCore__arPD_DS (cn__arP) ON DELETE SET NULL ON UPDATE CASCADE', ''],
    ['FK_raTY__arP_tyFLD', '_raTY__arP', 'val__tyFLD', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxFT_AA', 'FK_', '_raCore__arPD_DS (cn__arP) ON UPDATE CASCADE', ''],
    ['RK_raTY__arP_rule', '_raTY__arP', 'rule__EXPR', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'RK_', '_raEXPR__arP (cn__arP) ON UPDATE CASCADE', ''],
    ['RK_raTY__arP_te', '_raTY__arP', 'te__EXPR', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'RK_', '_raCore__arPD_DS (cn__arP) ON UPDATE CASCADE', ''],
    ['cn__TY', '_raOBJ__arP', '_cN:_hieV', '', '__enZB', '_cxF_AA , _ZA , _szz', 'ds/__/dst', '__TY', 'NULL DEFAULT NULL', ''],
    ['ext__bvKB', '_raOBJ__arP', '_hieV', 'extended -- parameters of field', '__enZB', '_AT , _ZA , _szz', 'ds/__/dst',
      '__bvKB', "NOT NULL DEFAULT ''", ''],
    ['fcc__svQB', '_raOBJ__arP', 'fcc:_hieV', '', '__enZB', '_cxF_AA , _ZA , _zzz', 'ds/__/dst',
      '__svQB', 'CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL', ''],
    ['UK_fcc', '_raCore__arPD_DS', 'fcc__svQB', '', '__enZB', '_ZA , _cxF_AA , _zzz', 'dst/_/ds', 'UK_', '', ''],
    ['FK_raOBJ__arP_TY', '_raOBJ__arP', 'cn__TY', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxFT_AA', 'FK_', '_raTY__arP (cn__arP) ON DELETE SET NULL ON UPDATE CASCADE', ''],
    ['par__OBJ', '_raOBJ__acPG_hie', '_hieV', 'parent', '__enZB', '_AT , _ZA , _szz', 'ds/__/dst', '__OBJ', 'NULL', ''],
    ['chi__OBJ', '_raOBJ__acPG_hie', '_hieV', 'child', '__enZB', '_AT , _ZA , _szz', 'ds/__/dst', '__OBJ', 'NULL', ''],
    ['multi__OBJ', '_raOBJ__acPG_hie', '_hieV', 'multi -- fields keys', '__enZB', '_AT , _ZA , _szz', 'ds/__/dst', '__OBJ', 'NULL', ''],
    ['row__nuZB', '_raOBJ__acPG_hie', '_hieV', 'row', '__enZB', '_AT , _ZA , _szz', 'ds/__/dst', '__evZB', 'NOT NULL', ''],
    ['UKM_raOBJ__acPG_hie_par', '_raOBJ__acPG_hie', 'par__OBJ', '', '__enZB', '_cxNU_UU , _ZA , _zzz', 'dst/ds/_/dso:_cxF_AA', 'UKM_', '', ''],
    ['FK_raOBJ__acPG_hie_par', '_raOBJ__acPG_hie', 'par__OBJ', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_raOBJ__arP (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['FK_raOBJ__acPG_hie_chi', '_raOBJ__acPG_hie', 'chi__OBJ', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_raOBJ__arP (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['FK_raOBJ__acPG_hie_multi', '_raOBJ__acPG_hie', 'multi__OBJ', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_raOBJ__arP (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['_cnt__nuZB', '_raEXPR__arP', '_hieV', 'count', '__enZB', '_CT , _ZA , _szz', '_/ds/__/dst', '__nuZB', 'NOT NULL DEFAULT 0', ''],
    ['cn__tySEP', '_raEXPR__arP', '__tySEP:_hieV', '_cN', '__enZB', '_AA , _ZA , _szz', '_/ds/__/dso:_cxFT_AA', '__arP', 'NOT NULL', ''],
    ['FK_raEXPR__arP_cn', '_raCore__arPD_DS', 'cn__arP', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_raCore__arPD_DS (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['FK_raEXPR__arP_tySEP', '_raCore__arPD_DS', 'cn__tySEP', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxFT_AA', 'FK_', '_raTY__arP (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['par__arP', '_raEXPR__acPG', '_hieV', 'parent', '__enZB', '_AT , _ZA , _szz', 'ds/__/dst', '__arP', 'NOT NULL', ''],
    ['chi__arP', '_raEXPR__acPG', '_hieV', 'child', '__enZB', '_AT , _ZA , _szz', 'ds/__/dst', '__arP', 'NOT NULL', ''],
    ['PKM_raEXPR__acPG_par', '_raEXPR__acPG', 'par__arP', '', '__enZB', '_cxNU_UU , _ZA , _zzz', 'dst/ds/_/dso:_cxF_AA', 'PKM_', '', ''],
    ['FK_raEXPR__acPG_par', '_raEXPR__acPG', 'par__arP', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_raEXPR__arP (cn__arP) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['FK_raEXPR__acPG_chi', '_raEXPR__acPG', 'chi__arP', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_raCore__arPD_DS (cn__arP) ON UPDATE CASCADE', ''],
    ['next__nuDB', '_raOBJ__arPD_seg', '_hieV', 'next -- segment offset', '__enZB', '_AA , _ZA , _szz', 'ds/__/dst', '__nuDB', 'NOT NULL', ''],
    ['start__nuDB', '_raOBJ__arPD_seg', '_hieV', 'start -- segment offset', '__enZB', '_AA , _ZA , _szz', 'ds/__/dst', '__nuDB', 'NOT NULL', ''],
    ['FK_raOBJ__arPD_seg_cn', '_raOBJ__arPD_seg', 'cn__arP', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_raCore__arP (_arP) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['FK_raPER__arP_TY', '_raPER__arP', 'cn__TY', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxFT_AA', 'FK_', '_raTY__arP (cn__arP) ON DELETE SET NULL ON UPDATE CASCADE', ''],
    ['_arT', '_logVER__arT', '_hieV', 'tertiary register functor', '__enZB', '_ZA , _ZA , _zzz', '_/dst', '__arT', 'NOT NULL', ''],
    ['ref__svPQ', '_logVER__arT', '_hieV', 'major -- version number', '__enZB', '_AA , _ZA , _szz', 'ds/__/dst'
      , '__svPQ', 'CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL', ''],
    ['major__nuDB', '_logVER__arT', '_hieV', 'refference -- to event', '__enZB', '_AT , _ZA , _szz', 'ds/__/dst', '__nuDB', 'NOT NULL', ''],
    ['minor__nuDB', '_logVER__arT', '_hieV', 'minor -- version number', '__enZB', '_AA , _ZA , _szz', 'ds/__/dst', '__nuDB', 'NOT NULL', ''],
    ['build__nuDB', '_logVER__arT', '_hieV', 'build -- version number', '__enZB', '_AA , _ZA , _szz', 'ds/__/dst', '__nuDB', 'NOT NULL', ''],
    ['expl__svKB', '_logVER__arT', '_hieV', 'explanation', '__enZB', '_AQ , _ZA , _szz', 'ds/__/dst', '__svKB', "NOT NULL DEFAULT ''", ''],
    ['PK_arT', '_logVER__arT', '_arT', '', '__enZB', '_ZA , _cxF_AA , _zzz', 'dst/_/ds', 'PK_', '', ''],
    ['UKM_logVER__arT_ref', '_logVER__arT', 'ref__svPQ', '', '__enZB', '_cxNU_UU , _ZA , _zzz', 'dst/ds/_/dso:_cxF_AA', 'UKM_', '', ''],
    ['cn__arT', '_logVER__acTG', '_cN:_hieV', 'reference to tertiary register', '__enZB', '_cxF_AD , _ZA , _szz', 'ds/__/dst', '__arT', 'NOT NULL', ''],
    ['expl__svKQ', '_logVER__acTG', '_hieV', 'explanation', '__enZB', '_AQ , _ZA , _szz', 'ds/__/dst', '__svKQ', "NOT NULL DEFAULT ''", ''],
    ['PKM_logVER__acTG_cn', '_logVER__acTG', 'cn__arT', '', '__enZB', '_cxNU_UU , _ZA , _zzz', 'dst/ds/_/dso:_cxF_AA', 'PKM_', '', ''],
    ['FK_logVER__acTG_cn', '_logVER__acTG', 'cn__arT', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_logVER__arT (_arT) ON DELETE CASCADE ON UPDATE CASCADE', ''],
    ['_cnt__nuDB', '_logWDOG__arT', '_hieV', 'count -- version number', '__enZB', '_CA , _ZA , _szz', 'ds/__/dst', '__nuDB', 'NOT NULL', ''],
    ['PKM_logWDOG__acTG_cn', '_logWDOG__acTG', 'cn__arT', '', '__enZB', '_cxNU_UU , _ZA , _zzz', 'dst/ds/_/dso:_cxF_AA', 'PKM_', '', ''],
    ['FK_logWDOG__acTG_cn', '_logWDOG__acTG', 'cn__arT', '', '__enZB', '_cxNU_UU , _ZA , _zzz',
      'dst/ds/_/dso:_cxF_AA', 'FK_', '_logWDOG__arT (_arT) ON DELETE CASCADE ON UPDATE CASCADE', ''],

  ];
  $RA_raOBJ__acPG_hie_par__OBJ = 0;
  $RA_raOBJ__acPG_hie_chi__OBJ = 1;
  $RA_raOBJ__acPG_hie_multi__OBJ = 2;
  $src['_raOBJ__acPG_hie'] = [
    ['par__OBJ', 'chi__OBJ', 'multi__OBJ'],
    ['_raCore__arP', '_arP', ''],
    ['_raCore__arP', 'cre__dsDB', ''],
    ['_raCore__arP', 'upd__dsDB', ''],
    ['_raCore__arP', 'PK_arP', ''],
    ['_raCore__arPD_DS', 'cn__arP', ''],
    ['_raCore__arPD_DS', '_arDS', ''],
    ['_raCore__arPD_DS', 'PK_cn', ''],
    ['_raCore__arPD_DS', 'UK_arDS', ''],
    ['_raCore__arPD_DS', 'FK_raCore__arPD_DS_cn', ''],
    ['_raTY__arP', 'cn__arP', ''],
    ['_raTY__arP', 'cxN__arP', ''],
    ['_raTY__arP', 'cxF__EXPR', ''],
    ['_raTY__arP', 'expl__bvKB', ''],
    ['_raTY__arP', 'rule__EXPR', ''],
    ['_raTY__arP', 'te__EXPR', ''],
    ['_raTY__arP', 'val__tyFLD', ''],
    ['_raTY__arP', 'val__bvPQ', ''],
    ['_raTY__arP', 'PK_cn', ''],
    ['_raTY__arP', 'FK_raTY__arP_cn', ''],
    ['_raTY__arP', 'FK_raTY__arP_cxN', ''],
    ['_raTY__arP', 'RK_raTY__arP_cxF', ''],
    ['_raTY__arP', 'FK_raTY__arP_tyFLD', ''],
    ['_raTY__arP', 'RK_raTY__arP_rule', ''],
    ['_raTY__arP', 'RK_raTY__arP_te', ''],
    ['_raOBJ__arP', '_raTY__arP', ''],
    ['_raOBJ__arP', 'cn__TY', ''],
    ['_raOBJ__arP', 'ext__bvKB', ''],
    ['_raOBJ__arP', 'fcc__svQB', ''],
    ['_raOBJ__arP', 'UK_fcc', ''],
    ['_raOBJ__arP', 'FK_raOBJ__arP_TY', ''],
    ['_raOBJ__arPD_seg', 'cn__arP', ''],
    ['_raOBJ__arPD_seg', 'next__nuDB', ''],
    ['_raOBJ__arPD_seg', 'start__nuDB', ''],
    ['_raOBJ__arPD_seg', 'PK_cn', ''],
    ['_raOBJ__arPD_seg', 'FK_raOBJ__arPD_seg_cn', ''],
    ['_raOBJ__acPG_hie', 'par__OBJ', ''],
    ['_raOBJ__acPG_hie', 'chi__OBJ', ''],
    ['_raOBJ__acPG_hie', 'multi__OBJ', ''],
    ['_raOBJ__acPG_hie', 'row__nuZB', ''],
    ['_raOBJ__acPG_hie', 'UKM_raOBJ__acPG_hie_par', 'chi__OBJ'],
    ['_raOBJ__acPG_hie', 'UKM_raOBJ__acPG_hie_par', 'multi__OBJ'],
    ['_raOBJ__acPG_hie', 'FK_raOBJ__acPG_hie_par', ''],
    ['_raOBJ__acPG_hie', 'FK_raOBJ__acPG_hie_chi', ''],
    ['_raOBJ__acPG_hie', 'FK_raOBJ__acPG_hie_multi', ''],
    ['_raPER__arP', '_raTY__arP', ''],
    ['_raPER__arP', 'cn__TY', ''],
    ['_raPER__arP', 'FK_raPER__arP_TY', ''],
    ['_raEXPR__arP', 'cn__arP', ''],
    ['_raEXPR__arP', '_cnt__nuZB', ''],
    ['_raEXPR__arP', 'cn__tySEP', ''],
    ['_raEXPR__arP', 'PK_cn', ''],
    ['_raEXPR__arP', 'FK_raEXPR__arP_tySEP', ''],
    ['_raEXPR__acPG', 'par__arP', ''],
    ['_raEXPR__acPG', 'row__nuZB', ''],
    ['_raEXPR__acPG', 'chi__arP', ''],
    ['_raEXPR__acPG', 'PKM_raEXPR__acPG_par', 'row__nuZB'],
    ['_raEXPR__acPG', 'FK_raEXPR__acPG_par', ''],
    ['_raEXPR__acPG', 'FK_raEXPR__acPG_chi', ''],
    ['_logVER__arT', '_arT', ''],
    ['_logVER__arT', 'ref__svPQ', ''],
    ['_logVER__arT', 'major__nuDB', ''],
    ['_logVER__arT', 'minor__nuDB', ''],
    ['_logVER__arT', 'build__nuDB', ''],
    ['_logVER__arT', 'expl__svKB', ''],
    ['_logVER__arT', 'cre__dsDB', ''],
    ['_logVER__arT', 'PK_arT', ''],
    ['_logVER__arT', 'UKM_logVER__arT_ref', 'major__nuDB'],
    ['_logVER__arT', 'UKM_logVER__arT_ref', 'minor__nuDB'],
    ['_logVER__acTG', 'cn__arT', ''],
    ['_logVER__acTG', 'build__nuDB', ''],
    ['_logVER__acTG', 'cre__dsDB', ''],
    ['_logVER__acTG', 'PKM_logVER__acTG_cn', 'build__nuDB'],
    ['_logVER__acTG', 'FK_logVER__acTG_cn', ''],
    ['_logWDOG__arT', '_arT', ''],
    ['_logWDOG__arT', 'ref__svPQ', ''],
    ['_logWDOG__arT', 'fcc__svQB', ''],
    ['_logWDOG__arT', 'expl__svKB', ''],
    ['_logWDOG__arT', '_cnt__nuDB', ''],
    ['_logWDOG__arT', 'cre__dsDB', ''],
    ['_logWDOG__arT', 'PK_arT', ''],
    ['_logWDOG__acTG', 'cn__arT', ''],
    ['_logWDOG__acTG', '_cnt__nuDB', ''],
    ['_logWDOG__acTG', 'expl__svKQ', ''],
    ['_logWDOG__acTG', 'PKM_logWDOG__acTG_cn', '_cnt__nuDB'],
    ['_logWDOG__acTG', 'FK_logWDOG__acTG_cn', ''],

  ];
  $src['_raOBJ__arPD_seg'] = [
    ['cn__arP'],
    ['_raCore__arP'], ['_raDOC__arP'], ['_raTY__arP'], ['_raOBJ__arP'], ['_raLOC__arP'], ['_raPER__arP'], ['_raCON__arP'], ['_raRES__arP'],
    ['_raEXPR__arP'], ['_raYBUG__arP'], ['_logVER__arT'], ['_logWDOG__arT'], 
  ];
  $src['_raDOC__arP'] = [
      ['cn__arP', 'expl__bvKS', '__tyDOC'],
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
      ['__DOC', 'expl__svKB',
        ['__DOC', 'expl__svKB',
          ['expl__svKB',
            ['expl__svKB']]]],
      ['_d10', 'Destination : is : Relate Assemblies(RA)', []],
      ['_d10', 'Destination : is : Relate Assemblies(RA)', []],
      ['_d11', ' : do : Formal System Definition)', []],
      ['_d12', ' : by : Flexible Structuring of Ontologies', []],
      ['_d13', ' : on : Fast and Strong Integrety', []],
      ['_d1Z', '', []],
      ['_d20', 'Naming : (convention : constraints : order rules)', []],
      ['_d21', '<object designation template>(ODT) parts : _/fcc/_/ds/__/dst[__/dst/]/[_/dso/] : ', [
        ['_d211', '/_/ : <functor designation prefix or ODT part separator> : exact (1) <under score> symbol of ODT', []],
        ['_d212', '/__/ : <object type designation prefix> : <exact (2) <under score> symbols : ODT must have at least one type of object.', []],
        ['_d213', '/fcc/ : <Facet Class Code> : consist of 2 parts : /ns/FC/ : ', [
          ['/ns/ : name space : ', [
            'o : objects',
            'd : documents',
            'o : objects',
            '...',
          ]],
          ['(FC) : <Facet Code> : consist of 4 parts : /fccM/fccA/fccC/fccO/ : ', [
            '/fccM/ : <fcc of Modules -- index value> : [0-9A-Z] count(10 + 26) = 36',
            '/fccA/ : <fcc of Aggregate -- index value> [0-9A-Z]',
            '/fccC/ : <fcc of Component -- index value> [0-9A-Z]',
            '/fccO/ : <fcc of Object -- index value> : [a-z] : (<min number> : <a> : <0>) : (<max number> : <z> : <25>) : count() = 26',
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
          ['<_o000a_raOBJ__acPG_hie> : _/o031a/_/ra/OBJ/__/ac/PG/_/hie/ : _/fcc/_/dsx/dsn/__/dstCS/dstKM/_/dso/ : ', [
            '/o031a/ : /fcc/ : <o : object -- name space> + <0 : 1-st module> + <3 : 4-th agg.> + <1 : 2-nd comp.> + <a - 1-st object>',
            '/ra/ : /dsx/ : module DS : Relate Assmblies',
            '/OBJ/ : /dsn/ : agg. destination DS : OBJECTS',
            '/ac/ : /dstCS/ : (<a><r> : <agg.><register> : <class><subclass>) / (<ac> : <a><c> : <agg.><component>) : ...',
            '/PG/ : /dstKM/ : (<acPG> : <P : Primary><G : Grid>) / (<arPD> : <P : Primary><D : Detalisation>) / ...',
            '/hie/ : /dso/ : <HIERARCHY>',
            '...',
          ]],
        ]],
      ]],
      ['_d22', '(fcc : order : rules) : ', [
        ['_d221', 'r1 : Each fcc of each object is in coordonance with it position in _raOBJ__arDS table', []],
        ['_d222', 'r2 : Each fcc of each subobject is in coordonance with <Causal Relationships Criterion>(CRC) : ', [
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
  $src['_raPER__arP'] = [
    [RA_cn__arDS, 'cxN__arDS', 'cxF__EXPR', 'expl__bvKB', 'rule__EXPR', 'te__EXPR', 'cn__TY', 'val__tyFLD'],
    ['@gV', '_OM', '', 'Glinca Vitalie', '_WS , _WS , _sUU', '@/ds', '_perP', '__enZB'],
    ['@mA', '_OM', '', 'Moscvin Andrei', '_WS , _WS , _sUU', '@/ds', '_perP', '__enZB'],
    ['@pI', '_OM', '', 'Prilepov Igor', '_WS , _WS , _sUU', '@/ds', '_perP', '__enZB'],
    ['@sI', '_OM', '', 'Shapovalov Igor', '_WS , _WS , _sUU', '@/ds', '_perP', '__enZB'],
    ['@ms', '_OM', '', 'Micro-soft', '_FS , _FS , _sss', '@/ds', '_perJ', '__enZB'],
    ['@cP', '@ms', '', 'Co-pilot', '_FS , _FS , _sUU', '@/ds', '_perR', '__enZB'],
    ['@oAI', '_OM', '', 'Open-AI', '_FS , _FA , _sUU', '@/ds', '_perJ', '__enZB'],
    ['@cG', '@oAI', '', 'Chat-GPT', '_FS , _FS , _sUU', '@/ds', '_perR', '__enZB'],
    ['@goo', '_OM', '', 'google', '_AT , _ZA , _sss', '@/ds', '_perJ', '__enZB'],
    ['@gG', '@goo', '', 'gemeni', '_cxN_AS , _AS , _sUU', '@/ds', '_perR', '__enZB'],
    
  ];

$pp = 'p002a-0b';
  $RA[RA_cn__arDS] =  $errn = $errd = $err = [];
  foreach ($src as $src_tab => $src_arr) {
    $fields = array_merge($src_arr[0], ['src_tab', 'src_arr_i']);
    if (!$fields[0]) {
      foreach ($src_arr as $src_arr_i => $src_arr_val) {
        if ($src_arr_i) {
          $RA_cn__arDS = $src_arr_val[$RA_raTY__arDS_cn__arDS];
          $RA_cxN__arDS = $src_arr_val[$RA_raTY__arDS_cxN__arDS];
          $src_arr_val = array_merge($src_arr_val, [$src_tab, $src_arr_i - 1]);
          if (isset($RA[RA_cn__arDS][$RA_cn__arDS])) {

            $ep = "$pp-e1";
            if (!$errd) $errd[] = "$ep Errors [cn__arDS => cxN__arDS] already defined!";
            $errd[] = "$src_tab [$RA_cn__arDS => $RA_cxN__arDS] - cn__arDS($RA_cn__arDS)";
          } elseif (($src_arr_i != 1 || $src_tab != '_raTY__arP') && !isset($RA[RA_cn__arDS][$RA_cxN__arDS])) {

            $ep = "$pp-e2";
            if (!$errn) $errn[] = "$ep Errors [cn__arDS => cxN__arDS] not found!";
            $errn[] = "$src_tab [$RA_cn__arDS => $RA_cxN__arDS] - cxN__arDS($RA_cxN__arDS)";
          } else {
            //du($fields, $src_arr_val);
            $RA[RA_cn__arDS][$RA_cn__arDS] = array_combine($fields, $src_arr_val);
          }
        }
      }
    }
  }
  $_PQ_size = explode($_sepVALUE, $RA[RA_cn__arDS]['_PQ']['expl__bvKB'])[1];
  $_sepVAL_len = strlen($_sepVALUE);
  foreach ($RA[RA_cn__arDS] as $cn__arDS => $ra_arr) {
    // echo " $cn__arDS";
    $val__tyFLD = $ra_arr['val__tyFLD'];
    $__tyFLD__cxN = $RA[RA_cn__arDS][$val__tyFLD]['cxN__arDS'];
    if ($RA[RA_cn__arDS][$__tyFLD__cxN]['cxF__EXPR'] == '__tyFIE' && $__tyFLD__cxN != '_fiEN') { // is it type the enamed value ?
      $val__bvPQ = substr($ra_arr['expl__bvKB'], strpos($ra_arr['expl__bvKB'], $_sepVALUE) + $_sepVAL_len);
      if (strlen($val__bvPQ) > $_PQ_size) {

        $ep = "$pp-e3";
        $err[] = "$ep val__bvPQ($val__bvPQ) expl__bvKB part of cn__arDS($cn__arDS) is greater: $_PQ_size";
      } elseif ($__tyFLD__cxN == '_fiES') {
        $val__bvPQ_arr = explode($_sepLIST, $val__bvPQ);
        foreach ($val__bvPQ_arr as $val__bvPQ_el) {
          $val__bvPQ_el_arr = explode($_sepBACK, $val__bvPQ_el);
          if (($cnt = count($val__bvPQ_el_arr)) != 2) {

            $ep = "$pp-e4";
            $err[] = "$ep Bad val__tyFLD($val__tyFLD) leike _fiES type for field_name($field_name) with val__bvPQ($val__bvPQ) but it has count pairs($cnt) != 2";
          } elseif (!isset($RA[RA_cn__arDS][$val__bvPQ_el_arr[1]])) {

            $ep = "$pp-e5";
            $err[] = "$ep Bad val__tyFLD($val__tyFLD) leike _fiES type for field_name($field_name) with val__bvPQ($val__bvPQ) not registered: " . $val__bvPQ_el_arr[1];
          } else {
            $ra_arr['val__bvPQ'] = $val__bvPQ_el_arr[1]; // set name of variable
            $ra_arr[$val__bvPQ_el_arr[1]] = $val__bvPQ_el_arr[0]; // set it value
          }
        }
      } else {
        $ra_arr['val__bvPQ'] = $val__bvPQ;
      }
    } else {
      $ra_arr['val__bvPQ'] = 0;
    }
    if (isset($RA[RA_cn__arDS][$cn__arDS]['cn__TY']) && ($cn__TY = $RA[RA_cn__arDS][$cn__arDS]['cn__TY']) != '' && !isset($RA[RA_cn__arDS][$RA[RA_cn__arDS][$cn__arDS]['cn__TY']])) {

      $ep = "$pp-e6";
      $err[] = "$ep Bad cn__TY($cn__TY) not defined! for cn__arDS($cn__arDS) in src_tab: " . $ra_arr['src_tab'];
    }
    $ra_arr['main__bvPQ'] = explode($_sepREM, $ra_arr['expl__bvKB'])[0];
    $RA[RA_cn__arDS][$cn__arDS] = $ra_arr;
  }

$pp = 'p002a-0c';
  $_raOBJ = $log = $dst = $RA[RA_sq] = $RA[RA_sql] = $table_fields = $fields_desc = $fields_constraints = $fields_keys = $fields_keys_M = [];
  $RA[RA_curDB] = '';
  $RA[RA_sq][] = "SET FOREIGN_KEY_CHECKS=0";
  if ($errd || $errn) du($errd, $errn);
  else $log[] = "$pp-s1 No errors found in primary object processing.";
  $log[] = "$pp-s2 Number of cn__arDS processed: " . (count($RA[RA_cn__arDS]));
  $log[] ="$pp-s3 Create all tables\n|---|---|---|\n|table_name|field_name|object_type|\n|---|---|---|";
  $table_name = $prev_table = '';
  $seg_OBJ_start = __seg_agg_INT(substr($RA[RA_cn__arDS]['_a3_OBJ']['fcc__svQB'], 1));
  for ($src_i = 1; $src_i < count($src['_raOBJ__acPG_hie']); $src_i++) {
    $prev_table = $table_name;
    $table_name = $src['_raOBJ__acPG_hie'][$src_i][$RA_raOBJ__acPG_hie_par__OBJ];
    $field_name = $src['_raOBJ__acPG_hie'][$src_i][$RA_raOBJ__acPG_hie_chi__OBJ];
    $log[] = "|$table_name|$field_name|" . $RA[RA_cn__arDS][$field_name]['cxF__EXPR'] . "|";
    $multi__arP = 'NULL';
    if ($RA[RA_cn__arDS][$RA[RA_cn__arDS][$table_name]['cxN__arDS']]['cxF__EXPR'] != '_hieM') {

      $ep = "$pp-e7";
      $err[] = "$ep Bad not like table object found($table_name) in \$src['_raOBJ__acPG_hie']";
    } else {
      if (!isset($dst[$table_name])) {
        if ($prev_table != '') {
          $sql =  rtrim(
            "CREATE table if not exists " . __get_table($prev_table)
            . " (" . $fields_desc[$prev_table] . $fields_keys[$prev_table] . $fields_constraints[$prev_table]
            , ',') . "\n)"
          ;
          __check_DB($prev_table);
          $dst[$prev_table] = $sql;
          $RA[RA_sq][] = $sql;
          $RA[RA_tables][$prev_table][RA_tables_flds_str] = rtrim($table_fields[$prev_table], ',');
          $RA[RA_tables][$prev_table][RA_tables_hieSHE] = __get_hieSCH($prev_table);
        }
        $dst[$table_name] = 0;
        $fields_desc[$table_name] = $table_fields[$table_name] = $fields_keys[$table_name] = $fields_constraints[$table_name] = '';
        $chi_val = $row_val = 0;
      }
      if (isset($dst[$field_name])) {
        $table_fields[$table_name] = $table_fields[$field_name];
        $fields_desc[$table_name] = $fields_desc[$field_name];
        $fields_keys[$table_name] = strtr($fields_keys[$field_name], [$field_name => $table_name]);
        $fields_constraints[$table_name] = strtr($fields_constraints[$field_name], [$field_name => $table_name]);;
      } else {
        $__tyFLD = $old__tyFLD = $RA[RA_cn__arDS][$field_name]['cn__TY'];
        if (strpos($RA[RA_cn__arDS][$field_name]['cxF__EXPR'], '_hieV') !== FALSE) {
          if ($row_val != $chi_val ) {

            $ep = "$pp-e8";
            $err[] = "$ep Bad row_val/chi_val($row_val/$chi_val) nuber for table($table_name) and field($field_name): " . (count($err));
          } else {
            $wile_i = 10;
            if (isset($RA[RA_cn__arDS][$__tyFLD]['cn__TY'])) {
              $__tyFLD = $RA[RA_cn__arDS][$__tyFLD]['cn__TY'];
            }
            while (strpos($RA[RA_cn__arDS][$__tyFLD]['cxF__EXPR'], '__tyFLD') === FALSE && $wile_i--) {
              $__tyFLD = $RA[RA_cn__arDS][$__tyFLD]['val__bvPQ'];
              if (!$wile_i) {

                $ep = "$pp-e9";
                $err[] = "$ep Bad __tyFLD($old__tyFLD) for field_name($field_name) - not found real __tyFLD";
              }
            }
            $real_ty = $RA[RA_cn__arDS][$__tyFLD]['val__bvPQ'] . ' ' . $RA[RA_cn__arDS][$field_name]['ext__bvKB'];
            $fields_desc[$table_name] .= "\n  $field_name $real_ty,";
            $table_fields[$table_name] .= (in_array(substr($field_name, strpos($field_name, $_sepCN)), ['__dsDB']) ? "" : "$field_name,");
          }
          $row_val++;
        } elseif (strpos($RA[RA_cn__arDS][$__tyFLD]['cxF__EXPR'], '__tyIND') === FALSE) {

          $ep = "$pp-e10";
          $cxF__EXPR = $RA[RA_cn__arDS][$field_name]['cxF__EXPR'];
          $err[] = "$ep Bad cxF__EXPR($cxF__EXPR) for field_name($field_name) - not in (_hieV, __tyIND)";
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
            $index_field = $src['_raOBJ__acPG_hie'][$src_i][$RA_raOBJ__acPG_hie_multi__OBJ];
            if (isset($RA[RA_cn__arDS][$index_field])) {
              $multi__arP = $seg_OBJ_start + $RA[RA_cn__arDS][$index_field]['src_arr_i'];
              if (isset($fields_keys_M[$table_name][$field_name])) {
                $real_ty = "";
                $fields_keys[$table_name] = rtrim($fields_keys[$table_name], '),');
              }
              $fields_keys_M[$table_name][$field_name] = $index_field;
              $real_ty .= ", $index_field";
            } else {

              $ep = "$pp-e11";
              $err[] = "$ep Bad index_field($index_field) for field_name($field_name) - not found real __tyFLD";
            }
          }
          $fields_keys[$table_name] .= "\n  $real_ty),";
          if (strpos($RA[RA_cn__arDS][$__tyFLD]['cxF__EXPR'], '_icKR') !== FALSE) { //  is just REFERENCE KEY group like FK_ or RK_
            $real_field = $RA[RA_cn__arDS][$field_name]['ext__bvKB'];
            $fccO = $RA[RA_cn__arDS][explode(' ', $real_field)[0]]['fcc__svQB'];
            $real_ty = "CONSTRAINT $field_name FOREIGN KEY (" . $RA[RA_cn__arDS][$field_name]['cxF__EXPR']
            . ") REFERENCES _{$fccO}{$real_field}";
            $fields_constraints[$table_name] .= "\n  $real_ty,";
          }
        }
        $par__arP = $seg_OBJ_start + $RA[RA_cn__arDS][$table_name]['src_arr_i'];
        $chi__arP = $seg_OBJ_start + $RA[RA_cn__arDS][$field_name]['src_arr_i'];

        $_raOBJ_hie[] = "$par__arP, $chi__arP, $multi__arP, $chi_val";
        $chi_val++;
      }
    }
  }
  $sql = rtrim("CREATE table if not exists " . __get_table($table_name) . " ("
  . $fields_desc[$table_name] . $fields_keys[$table_name] . $fields_constraints[$table_name], ',') . "\n)";
  $RA[RA_tables][$table_name][RA_tables_flds_str] = rtrim($table_fields[$table_name], ',');
  $RA[RA_tables][$table_name][RA_tables_hieSHE] = __get_hieSCH($table_name);
  __check_DB($table_name);
  $dst[$table_name] = $sql;
  $RA[RA_sq][] = $sql;
$pp = 'p002a-0d';
  $log[] ="$pp-s4  Created tables number: " . count($dst);
  $log[] ="$pp-s5  Creating Aggergates segments number: " . count($src['_raOBJ__arPD_seg']);
  //dz($RA[RA_sq]);
  if ($err) dz(array_merge(["Errors found"], $err), 1);
  __exec_SQL();
  $_raOBJ_seg = $err = [];
$pp = 'p002a-0e';
  foreach ($src['_raOBJ__arPD_seg'] as $seg_i => $seg__arr) {
    if ($seg_i) {
      $seg__arDS = $seg__arr[0];
      if (!isset($RA[RA_cn__arDS][$seg__arDS])) {

        $ep = "$pp-e12";
        $err[] = "$ep Segment object($seg__arDS) not found";
      } else {        
        $seg_agg__arDS = $RA[RA_cn__arDS][$seg__arDS]['cxF__EXPR'];
        if (!isset($RA[RA_cn__arDS][$seg_agg__arDS])) {

          $ep = "$pp-e13";
          $err[] = "$ep Segment object agg($seg_agg__arDS) not found";
        }
        $seg_agg__val = substr($RA[RA_cn__arDS][$seg_agg__arDS]['fcc__svQB'], 1);
        $pattern = $RA[RA_cn__arDS]["_liMAX"]['main__bvPQ'];
        if (!preg_match($pattern, $seg_agg__val)) {

          $ep = "$pp-e14";
          $err[] = "$ep Segment object agg($seg_agg__arDS) agg_value($seg_agg__val) missmatch agg_value_pattern($pattern)";
        }
        if ($RA[RA_cn__arDS][$seg__arDS]['cn__TY'] == '__arT') {
          $seg_tab = __get_table($seg__arDS);
          $seg_agg_start = db_query("SELECT min(_arT) - 1 from $seg_tab")->fetchColumn() ?? 4294967295;
        } else {
          $seg_agg_start = __seg_agg_INT($seg_agg__val);
        }
        $seg__arP = $seg_OBJ_start + $RA[RA_cn__arDS][$seg__arDS]['src_arr_i'];
        $RA[RA_seg__arDS][$seg__arDS] = [
          RA_seg__arDS_start => $seg_agg_start,
          RA_seg__arDS_next => $seg_agg_start,
          RA_seg__arDS_arP => $seg__arP,
        ];
        $RA[RA_seg__arP][$RA[RA_seg__arDS][$seg__arDS][RA_seg__arDS_arP]] = $seg__arDS;
        $_raOBJ_seg[] = "$seg__arP, $seg_agg_start, $seg_agg_start";
      }
    }
  }
  $pp = 'p002a-0f';
  dul($log);
  foreach ($_raOBJ_hie as $row) __format_SQL($row, '_raOBJ__acPG_hie', 1);
  foreach ($_raOBJ_seg as $row) __format_SQL($row, '_raOBJ__arPD_seg', 1);
  //du($RA[RA_seg__arDS]);
  foreach ($RA[RA_cn__arDS] as $cn__arDS => $cn_arr) {    
    $seg__arDS = $RA[RA_cn__arDS][$cn__arDS]['src_tab'];
    $cxF__EXPR = $cn_arr['cxF__EXPR'];
    $err_fl_all = $err_fl = 1;
    $cxF__arP = 'NULL';
    if ($cxF__EXPR != '') {
      if (!isset($RA[RA_cn__arDS][$cxF__EXPR])) {
        if (($erre = __explore_EXPR($_sepADD, $_sepOPTION, $cxF__EXPR))) {

          $ep = "$pp-e15";
          $err[] = "$ep Errors in cxF__EXPR($cxF__EXPR) for cn__arDS($cn__arDS)";
          $err = array_merge($err, $erre);
          $err_fl--;
          $err_fl_all--;
        }
      }
      if ($err_fl) {
        if(!isset($RA[RA_cn__arDS][$cxF__EXPR]['cn__arP'])) {
          $RA[RA_cn__arDS][$cxF__EXPR]['cn__arP'] = __get_cn__arP($cxF__EXPR); 
        }
        $cxF__arP = $RA[RA_cn__arDS][$cxF__EXPR]['cn__arP'];
      }
    }
    $err_fl = 1;
      $rule__EXPR = $cn_arr['rule__EXPR'];
    if ($rule__EXPR == '') {

            $ep = "$pp-e16";
          $err[] = "$ep Errors empty rule__EXPR($rule__EXPR) for cn__arDS($cn__arDS)";
          $err_fl--;
          $err_fl_all = 0;
    } else {
      if (!isset($RA[RA_cn__arDS][$rule__EXPR])) {
        if (($erre = __explore_EXPR($_sepLIST, $_sepOPTION, $rule__EXPR))) {

          $ep = "$pp-e17";
          $err[] = "$ep Errors in rule__EXPR($rule__EXPR) for cn__arDS($cn__arDS)";
          $err = array_merge($err, $erre);
          $err_fl--;
          $err_fl_all = 0;
        }
      }
      if ($err_fl) {
        $rule__arP = $RA[RA_cn__arDS][$rule__EXPR]['cn__arP'];
      }
    }
    $err_fl = 1;
    $te__EXPR = $cn_arr['te__EXPR'];
    if ($te__EXPR == '') {

      $ep = "$pp-e18";
      $err[] = "$ep Errors empty te__EXPR($te__EXPR) for cn__arDS($cn__arDS)";
      $err_fl--;
      $err_fl_all = 0;
    } else {
      if (!isset($RA[RA_cn__arDS][$te__EXPR])) {
        if (($erre = __explore_EXPR($_sepPART, $_sepOPTION, $te__EXPR))) {

          $ep = "$pp-e19";
          $err[] = "$ep Errors in te__EXPR($te__EXPR)";
          $err = array_merge($err, $erre);
          $err_fl--;
          $err_fl_all = 0;
        }
      }
      if ($err_fl) {
        if(!isset($RA[RA_cn__arDS][$te__EXPR]['cn__arP'])) {
          $RA[RA_cn__arDS][$te__EXPR]['cn__arP'] = __get_cn__arP($te__EXPR);
        }
        $te__arP = $RA[RA_cn__arDS][$te__EXPR]['cn__arP'];
      }
    }
    if ($err_fl_all) {
      $RA[RA_cn__arDS][$cn__arDS]['cn__arP'] = 
      $val__tyFLD = __get_cn__arP($cn_arr['val__tyFLD']);      
      $cxN__arP = __get_cn__arP($cn_arr['cxN__arDS']);
      $cn__str = "$cxN__arP,$cxF__arP,'" . $cn_arr['expl__bvKB'] . "',$rule__arP,$te__arP,$val__tyFLD,'" . $cn_arr['val__bvPQ'] . "'";
      if (isset($cn_arr['cn__TY'])) {
        if ($cn_arr['cn__TY'] == '') {
          $cn__str .= ",NULL" ;
        } else {
          $cn__str .= "," . __get_cn__arP($cn_arr['cn__TY']);
        }
      }
      if (isset($cn_arr['ext__bvKB'])) {
        $cn__str .= ",'" . $cn_arr['ext__bvKB'] . "', " . ($cn_arr['fcc__svQB'] == '' ? 'NULL' : ("'" . $cn_arr['fcc__svQB'] . "'"));
      }
      //dz($seg__arDS, $cn__arDS, $cn__str, $cn_arr);
      $cn__arP = __format_SQL($cn__str, $seg__arDS);
      __format_SQL("$cn__arP, '$cn__arDS'", '_raCore__arPD_DS', 1);
      __format_SQL("$cn__arP", '_raCore__arP', 1);
    }
  }
  $pp = 'p002a-0g';
  //du($RA[RA_tables]);
  //du($RA[RA_sq]);
  if ($err) {
    duz(array_merge(["ERRORS!!!"], $err), 1);
  } else {
    __exec_SQL(1);
  }
  $OBJ_seg_tab = __get_table('_raOBJ__arPD_seg');
  foreach ($RA[RA_seg__arDS] as $seg__arDS => $seg_arr) { // [RA_seg__arDS_start]
    $RA[RA_sq][] = "UPDATE $OBJ_seg_tab set next__nuDB = " . $seg_arr[RA_seg__arDS_next] . " where cn__arP = " . $seg_arr[RA_seg__arDS_arP];
  }
  __exec_SQL(1);
  if (!$RA[RA_sql_stop]) duv($_OM_ver, $_OM_ref, $pp);
}

function _raCore_dropDB($sprefix = '_wRA') { $pp = 'p002a-1a';
  global $RA;
  $rows = db_query(
    "SELECT SCHEMA_NAME
      from information_schema.SCHEMATA
      where 1 = 1
        and SCHEMA_NAME like '$sprefix%'
        and SCHEMA_NAME not like '%LOG%'
  ")->fetchAll(\PDO::FETCH_COLUMN);
  foreach ($rows as $sname) {
    db_query("DROP database $sname");
  }
}

function __check_DB($table_name) { $pp = 'p002a-2a';
  global $RA;
  $mname = $RA[RA_cn__arDS][$table_name]['cxN__arDS'];
  if (!isset($RA[RA_cn__arDS][$mname])) {
    dz("004a-e1 Error module name($mname) not found!");
  } else {
    $sname = $RA[RA_cn__arDS][$mname]['cxN__arDS'];
    if (!isset($RA[RA_cn__arDS][$sname])) {
      dz("004a-e2 Error schema name($sname) not found!");
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

function __explore_EXPR($sepHI, $sepLO, $exprVAL) { $pp = 'p002a-3a';
  global $RA; 
  $err = [];
  if (!isset($RA[RA_cn__arDS][$exprVAL])) {
    $exprHI = explode($sepHI, $exprVAL);
    $_raOBJ__arP_start = $RA[RA_seg__arDS]['_raOBJ__arP'][RA_seg__arDS_start];
    $sepHI__arP = $_raOBJ__arP_start + $RA[RA_cn__arDS][$sepHI]['src_arr_i'];
    $sepLO__arP = $_raOBJ__arP_start + $RA[RA_cn__arDS][$sepLO]['src_arr_i'];
    if (($_cnt__HI = count($exprHI)) == 1 && strpos($exprVAL, $sepLO) === false) {

      $ep = "$pp-e1";
      $err[] = "$ep exprVAL($exprVAL) consist the single arDS but it not defined!";
    } else {     
      if ($_cnt__HI > 1) {
        $hi__arP = __format_SQL("$_cnt__HI, $sepHI__arP", '_raEXPR__arP');
        $RA[RA_cn__arDS][$exprVAL]['cn__arP'] = $hi__arP;
        __format_SQL("$hi__arP, '$exprVAL'", '_raCore__arPD_DS', 1);
        __format_SQL("$hi__arP", '_raCore__arP', 1);
      }
      foreach ($exprHI as $hi_i => $hiEL) {
        $exprLO = explode($sepLO, $hiEL);
        if (($_cnt__LO = count($exprLO)) == 1) {
          if (isset($RA[RA_cn__arDS][$hiEL])) {
            $RA[RA_cn__arDS][$exprVAL]['exprARR'][$hiEL] = [$RA[RA_cn__arDS][$hiEL]['cn__arP'] ?? __get_cn__arP($hiEL)];
          } else {

            $ep = "$pp-e2";
            $err[] = "$ep exprVAL($exprVAL) consist the not defined simple value hiEL($hiEL)!";
          }
        } else {
          if (isset($RA[RA_cn__arDS][$hiEL]['exprARR'])) {
            $RA[RA_cn__arDS][$exprVAL]['exprARR'][$hiEL] = $RA[RA_cn__arDS][$hiEL]['exprARR'][$hiEL];
          } else {
            $hiEL__arP = __format_SQL("$_cnt__LO, $sepLO__arP", '_raEXPR__arP');
            $RA[RA_cn__arDS][$hiEL]['cn__arP'] = $hiEL__arP;
            __format_SQL("$hiEL__arP, '$hiEL'", '_raCore__arPD_DS', 1);
            __format_SQL("$hiEL__arP", '_raCore__arP', 1);
            $loARR = [];
            $sql__acPG = '';
            foreach ($exprLO as $lo_i => $loEL) {
              if (!isset($RA[RA_cn__arDS][$loEL])) {

                $ep = "$pp-e3";
                $err[] = "$ep exprVAL($exprVAL) consist the not defined simple value loEL($loEL) in the  hiEL($hiEL)!";
              } else {
                $lo__arP = __get_cn__arP($loEL);
                $loARR[] = $lo__arP;
                __format_SQL("$hiEL__arP, $lo_i, $lo__arP", '_raEXPR__acPG', 1);
              }
            }
            if (!$err) {
              $RA[RA_cn__arDS][$hiEL]['exprARR'][$hiEL] = $RA[RA_cn__arDS][$exprVAL]['exprARR'][$hiEL] = $loARR;
            }
          }
        }
        if (!$err && $_cnt__HI > 1) __format_SQL("$hi__arP, $hi_i, " . $RA[RA_cn__arDS][$exprVAL]['exprARR'][$hiEL][0], '_raEXPR__acPG', 1);
      }
    }
  }
  //if (($hiEL ?? '') == '_numB:_altNUM') du($RA[RA_cn__arDS][$exprVAL], $exprVAL, $RA[RA_cn__arDS][$hiEL]);
  return $err;

}
