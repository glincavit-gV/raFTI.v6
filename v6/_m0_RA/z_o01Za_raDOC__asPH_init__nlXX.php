<?php
global $RA;

function _o01Zb_init__nlXX_var() {
  _raDOC_init__nlXX_var();
}
function _raDOC_init__nlXX_var() {
  global $RA;
  $RA['__sepXX'] = [
    '__sepTY' => '__',
    '__sepOBJ' => '_',
    '__sepTEMPL' => '#',
    '__sepPER' => '@',
    '__sepCOL' => ' | ',
  ];
  foreach ($RA['__sepXX'] as $k_sepXX => $v_sepXX) $RA[$k_sepXX] = $v_sepXX;
  $RA['__nlXX'] = ['__nlEN', '__nlRU'];
  $RA['__docTAB'] = [
    '__arPN__dTitle' => ['_arPN', '_d__arDP', '_title__svPS', '__tyDOC'],
    '__arPN__dList' => ['_arPN', '__docDP', '_d__arDP', '_explan__svKS'],
    '__arPN__dPost' => ['_arPN', '__docDP', '_d__arDP', '_explan__svKS', '__perDP', '__resDP', 'cx__arDP'],
    '__acAN__dRem' => ['_acAN', '__docPN', '__perDP', '_explan__svKS', '__resDP'],
  ];
  $RA['_a__fccDOC'] =  '_o01';
  $RA['_a__aggDOC'] = '_raDOC';
  $RA['_d']['_d1__nlXX'] =
"_d__arDP | _explan__svKS | __tyDOC
    - | -
  _d1 | Documents | __dTitle
  _d1 | Документы | __dTitle
  _d2 | Namings | __dList
  _d2 | Именования | __dList
  ";
  $RA['_d']['_d2__nlXX'] =
"_d__arDP | _explan__svKS
    - | -
  _d2 | Namings : (conventions : constraints : sorting rules)
  _d2 | Именования : (соглашения : ограничения : правила сортировки)
 _d21 | Name Spaces : __nsX : { __nsXM , __nsXO , __nsXD , … , __nsXF } :
 _d21 | Пространства имен: #nsX : { __nsXM , __nsXO , __nsXD , … , __nsXF } :
      | : __nsXM : Name Space : modules
      | : __nsXM : Пространства имен : модули
      | : __nsXO : Name Space : objects
      | : __nsXO : Пространства имен : объекты
      | : __nsXD : Name Space : documents
      | : __nsXD : Пространства имен : документы
      | : … : …
      | : __nsXF : Name Space : fields data
      | : __nsXF : Пространства имен : поля данных
_d211 | Template of __nsXM names : #nsXM : { #nsXM_FCC + _m__arDP } :
_d211 | Шаблон имен #nsXM : { #nsXM_FCC + _m__arDP } :
    a | Template of #nsXM_FCC : modules Facet Class Code : { _m0 | _m1 | … | _mZ } : <_m><__fccMAX> :
    a | Шаблон #nsXM_FCC: Фасетный Код Класса модулей : { _m0 | _m1 | … | _mZ } : <_m><__fccMAX> :
      | : _m : designation of functor : next modules FCC
      | : _m : обозначение функтора : следующий FCC модулей
      | : __fccMAX : FCC maximum sequence number : 0-9A-Z : 36 slots
      | : __fccMAX : FCC Максимальный порядковый номер FCC : 0-9A-Z : 36 слотов
    b | _m__arDP : Designation Primary of module name
    b | _m__arDP : Обозначение Первичное имени модуля
    с | Examples of  #nsXM : { _m0_RA , _m1_PW , … , _mZ_NL } :
    с | Примеры #nsXM: { _m0_RA , _m1_PW , … , _mZ_NL } :
      | : _m0_RA : module #nsXM_FCC=_m0, _m_arDP=RA (Relate Assemblies)
      | : _m0_RA : модуль #nsXM_FCC=_m0, _m_arDP=RA (Связанные сборки)
      | : _m1_PW : module #nsXM_FCC=_m1, _m_arDP=PW (Parsed Wine)
      | : _m1_PW : модуль #nsXM_FCC=_m1, _m_arDP=PW (Parsed Wine)
      | : … : …
      | : _mZ_NL : module #nsXM_FCC=_mZ, _m_arDP=NL (Natural Languages)
      | : _mZ_NL : модуль #nsXM_FCC=_mZ, _m_arDP=NL (Естественные языки)
_d212 | Template of : #nsXO : { #nsXO_FCC + _m__arDP + _a__arDP + __acTY + [_opt__arDP]} :
_d212 | Шаблон : #nsXO: { #nsXO_FCC + _m__arDP + _a__arDP + __acTY + [_opt__arDP]} :
    a | Template of : #nsXO_FCC : Facet Class Code of objects : <_o><#fccMACu> :
    a | Шаблон : #nsXO_FCC : Фасетный Код Класса объектов : <_o><#fccMACu> :
      | : _o : designation of functor : next objects FCC
      | : _o : обозначение функтора : следующий FCC объектов
      | : #fccMACu : <M><A><C><u> : exact 4 chars code of objects FCC :
      | : #fccMACu : <M><A><C><u> : точно 4 символа FCC кода объектов :
      | : : <M> : #nsXM_FCC : Modules FCC part : 0-9A-Z : 36 slots
      | : : <M> : #nsXM_FCC : FCC часть Модулей : 0-9A-Z : 36 слотов
      | : : <A> : #nsXA_FCC : Aggregates FCC part : 0-9A-Z : 36 slots
      | : : <A> : #nsXA_FCC : FCC часть Агрегатов : 0-9A-Z : 36 слотов
      | : : <C> : #nsXC_FCC : Components FCC part : 0-9A-Z : 36 slots
      | : : <C> : #nsXC_FCC : FCC часть Компонентов : 0-9A-Z : 36 слотов
      | : : <u> : #nsXu_FCC : unites FCC part : a-z : 26 slots
      | : : <u> : #nsXu_FCC : FCC часть узлов : a-z : 26 слотов
    b | _m__arDP : Designation Primary of module name : lower case of chars
    b | _m__arDP : Обозначение Первичное имени модуля: строчные буквы
    c | _a__arDP : Designation Primary of aggregate name : upper case of chars
    c | _a__arDP : Обозначение Первичное имени агрегата : верхний регистр символов
    d | __acTY : Designation Primary of aggregate component type
    d | __acTY: Обозначение Первичное типа компонента агрегата
    e | _opt__arDP : Designation Primary of aggregate component unite for its options or parameters
    e | _opt__arDP : Обозначение Первичное узла компонента агрегата, его опций или параметров
    f | Examples of  #nsXO : { _o000a_raCore__asPH_initDOC__nlEN, ... , _o00Za_raCore__asPH_initDOC__nlXX} :
    f | Примеры #nsXO : { _o000a_raCore__asPH_initDOC__nlEN, ... , _o00Za_raCore__asPH_initDOC__nlXX} :
  ";

}

function _o01Zc_raDOC_init__nlXX_regErr(string $v_err) {
  _raDOC_init__nlXX_regErr($v_err);
}
function _raDOC_init__nlXX_regErr(string $v_err) {
  global $RA;
  $p_FCC = '_o01Zc';
  $a_err = explode("\n", strtr($v_err, ["\N\n" => ""]));
  foreach ($RA['__nlXX'] as $i_nlXX => $v_nlXX) {
    $a_str = explode($RA['__sepCOL'], $a_err[$i_nlXX]);
    $v__arDP = (($v_str = trim($a_str[0])) != '' ? $v_str : ($v__arDP ?? ''));
    if ($v__arDP == '') {
      $v_err = "$p_FCC.e1 \N
        | NOT set p_FCC
        | НЕ установлен p_FCC
      ";
      $v_err = _raDOC_init__nlXX_regErr($v_err);
      dog($v_err);
      throw new Exception($v_err);
    }
  }
  return $a_err[0];
}

function _o01Zd_raDOC_init__nlXX_thisLang(string $v_file) {
  _raDOC_init__nlXX_thisLang($v_file);
}
function _raDOC_init__nlXX_thisLang(string $v_file) {
  global $RA;
  $p_FCC = '_o01Zd';
  $a_ret = explode($RA['__sepTY'], $v_file);
  $v_sufix = $RA['__sepTY'] . end($a_ret);
  if (in_array($v_sufix, $RA['__nlXX'])) {
    return $v_sufix;
  }
  $v_err = "$p_FCC.e1 \N
    | NO such language in RA['__nlXX'] : #t_sufix
    | НЕТ такого языка в RA['__nlXX'] : #t_sufix
  ";
  $v_err = strtr(_raDOC_init__nlXX_regErr($v_err), ["#t_sufix" => "$v_sufix"]);
  dog($v_err);
  throw new Exception($v_err);
}

function _o01Zw_raDOC_init__nlXX_drop(string $v__nlXX) {
  _raDOC_init__nlXX_drop($v__nlXX);
}
function _raDOC_init__nlXX_drop(string $v__nlXX) {
  global $RA;
  _raDOC_init__nlXX_var();
  $thisLang = _raDOC_init__nlXX_thisLang(__FILE__);
  $d_idx = count($RA['__docTAB']);
  $d_FCC = $RA['_a__fccDOC'];
  $d_AGG = $RA['_a__aggDOC'];
  foreach (array_reverse($RA['__docTAB'], true) as $d_tab => $d_arr) {
    $d_sql = "DROP TABLE IF EXISTS {$d_FCC}" . $d_idx-- . "a{$d_AGG}{$d_tab}{$v__nlXX}";
    echo "\n$d_sql";
    //db_query($d_sql);
  }
}

function _o01Zx_raDOC_init__nlXX_create() {
  _raDOC_init__nlXX_create();
}
function _raDOC_init__nlXX_create() {
  
}

function _o01Zy_raDOC_init__nlXX_tables() {
  _raDOC_init__nlXX_tables();
}
function _raDOC_init__nlXX_tables() {
  _raDOC_init__nlXX_drop();
  _raDOC_init__nlXX_create();
}

function _o01Zz_raDOC_init__nlXX() {
  _raDOC_init__nlXX();
}
function _raDOC_init__nlXX() {
  global $RA;
  _raDOC_init__nlXX_var();
  foreach ($RA['__nlXX'] as $i__nlXX => $v__nlXX) {
    foreach ($RA['_d']['__nlXX'] as $d__arDP => $d__nlXX) {
      $d__str = explode("\n", $d__nlXX);

    }
  }
}