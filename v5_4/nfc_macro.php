<?php

const FTI_PREFIX = 'nfc_';
const NFC_TYPE__arP = 1; // 1-st object index
const NFC_WORD__arP = 2; 
const NFC_TERM__arP = 3; 
const NFC_EXPR__arP = 4;
const NFC_FORM__arP = 5; 
const NFC_SCORE__arS = 6;

const NFC_exprTRIG__eMB = 0x00003FFF;

const FTI_WINE = 1;
const FTI_VINE = 2;
const FTI_REGI = 4;
const FTI_GRAP = 8;
const FTI_TARA = 16;
const FTI_SYNO = 32;
const FTI_RULE = 64;
const FTI_ALL = 128;
const FTI_MASK__CLASS = 15;
const FTI_MASK__ALL = 0x000FFFFF;

const FTI_FOUND__RV = 1;
const FTI_FOUND__AType = 4;
const FTI_FOUND__TARA = 8;
const FTI_FOUND__rest = 2;

const FTI_SEP_PATH_PARENT = '<';
const FTI_SEP_PATH_CHILD = '>';
const FTI_SEP_PATH_SPAN = '><';
const FTI_SEP_PATH_NAME = " " . FTI_SEP_PATH_PARENT . " ";
const FTI_SEP_ATTR = '#';
const FTI_SEP_SPAN = ',';
const FTI_SEP_ALT = '/';
const FTI_SEP_VAL = ': ';
const FTI_SEP_COMM = '--';
const FTI_SEP_TYPE = '__';
const FTI_SEP_HIE = '_';
const FTI_SEP_LIST = '::';

const FTI_ATTR_64_BITS_CNT = 64;
const FTI_ATTR_64_BITS_MAX = '0x8000000000000000';
const FTI_ARP_MAX = 0x100000000;
const FTI_SYNONYMS_BL_5000 = 5000;
const FTI_WINE_BL_20000 = 20000;
const FTI_VINEYARD_BL_20000 = 20000;
const FTI_REGION_BL_20000 = 20000;
const FTI_GRAPE_BL_20000 = 20000;

const FTI_RANG_SZ = 6;
const FTI_VINE_DUPS_LVL_MAX = 3;

const FTI_PARSE_NAME__NORM_IT_elim_single_alpha = 1;
const FTI_PARSE_NAME__REG_TERM_ignore_term = 2;
const FTI_PARSE_NAME__ignore_all = FTI_PARSE_NAME__NORM_IT_elim_single_alpha | FTI_PARSE_NAME__REG_TERM_ignore_term;
/*
$name = $_SERVER['PHP_SELF'];
$name = preg_replace('#\/#mui', '', $name);

$file = file_get_contents($name);

// get defined macros
//preg_match_all('#\#macro\h+(\w+)\h+(.*)$#mui', $file, $matches, PREG_SET_ORDER);
preg_match_all("/#MACRO\h+([^\(]+)(\()([^\)]+)(\))\h+([^\(]+)(\()([^\)]+)(\))/mui", $str, $ma, PREG_SET_ORDER);

foreach ($ma as $m) {
    // delete macro definition
    $file = str_replace($m[0], '', $file);
    $s2rep = $m[1] . $m[2] . $m[3] . $m[4];
    $vars = explode(',', $m[3]);
    $s4rep = $m[5] . '(' . $m[7] . ')';
    foreach ($vars as $var) {
        $s4rep = strtr($s4rep, [end(explode('$', $var)) => ]);
    }
    // substitute macro => value
    $file = str_replace($m[1], $m[2], $file);
}

// save processed file
$new_name = '/var/tmp/' . $name . '.pr';
file_put_contents($new_name, $file);

include_once $new_name;
exit;

/*
https://stackoverflow.com/questions/3911299/can-i-make-a-php-macro-like-define-to-supply-parameters-for-function-calls

$html = "<b>bold text</b><a href=howdy.html>click me</a>";

preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/mui", $html, $matches, PREG_SET_ORDER);
$str = "\nstr1\nstr2 #MACRO EXTRACE(var) myEXTRACE(var,'var')\nstr3\n#macro M1(p1,p2,p3) my1(p1,p2,v3)\n str4\nstr5 EXTRACE(\$var1); m1(\$v1,\$v2); M1(\$v3,\$v4))";
//preg_match_all("/#MACRO\h+([^\(]+)(\()(\w+)(,\w+)*\h*(\))\h+([^\(]+)(\()(\w+)(,\w+)*?/mui", $str, $ma, PREG_SET_ORDER);
preg_match_all("/#MACRO\h+([^\(]+)(\()([^\)]+)(\))\h+([^\(]+)(\()([^\)]+)(\))/mui", $str, $ma, PREG_SET_ORDER);

echo "\n$str\n";
var_dump($ma);



/*
// Source - https://stackoverflow.com/a/47056548
// Posted by Agnius Vasiliauskas, modified by community. See post 'Timeline' for change history
// Retrieved 2026-07-01, License - CC BY-SA 3.0

<?php

include_once "macro.php";

#macro DEBUG_INFO ;echo('<b>  DEBUG_INFO: __FILE__ : ' . __FILE__ . ';__LINE__ : ' . __LINE__ . '</b>')

echo '<br>'.(1/2); DEBUG_INFO;
echo '<br>'.(1/0); DEBUG_INFO;
echo '<br>'.(0/0); DEBUG_INFO;




*/