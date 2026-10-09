<?php
global $RA;
const RA_cn__arDS = 0;
const RA_sql = 1;
const RA_sq = 2;
const RA_db = 3;
const RA_curDB = 4;
const RA_hieA__arP = 5;
const RA_EXPR__arP = 6;

const RA_seg_start = 0;
const RA_seg_next = 1;

$RA['__tySEP']['_sepCN'] = "_";
$RA['__tySEP']['_sepTY'] = "__";
$RA['__tySEP']['_sepADD'] = " + ";
$RA['__tySEP']['_sepMINUS'] = " - ";
$RA['__tySEP']['_sepMULTIPLY'] = " * ";
$RA['__tySEP']['_sepVALUE'] = " : ";
$RA['__tySEP']['_sepOPTION'] = ":";
$RA['__tySEP']['_sepBACK'] = " :: ";
$RA['__tySEP']['_sepLIST'] = " , ";
$RA['__tySEP']['_sepALT'] = " / ";
$RA['__tySEP']['_sepPART'] = "/";
$RA['__tySEP']['_sepREM'] = " -- ";
$RA['__tySEP']['_sepPER'] = "@";


function dz(...$vars) {
  du(...$vars);
  exit(1);
}

function du(...$vars) {
  echo "\n";
  // Orange/Brown for structural brackets
  $orange = "\e[38;5;208m"; 
  $reset  = "\e[0m";
  foreach ($vars as $v) {
    if (is_array($v)) {
      $count = count($v);
      echo "\e[34m^\e[0m \e[36marray:$count\e[0m {$orange}[{$reset}\n";
      formatTerminalArray($v, 2);
      echo "{$orange}]{$reset}\n";
    } else {
      echo "\e[34m^\e[0m " . formatTerminalValue($v, 0) . "\n";
    }
  }
}

function formatTerminalArray($array, $indent = 2) {
  $spaces = str_repeat(" ", $indent);
  $orange = "\e[38;5;208m";
  $reset  = "\e[0m";
  foreach ($array as $key => $val) {
    // Key Name remains regular weight. Surrounding quotes colored orange.
    $formattedKey = is_string($key) ? "{$orange}\"{$reset}{$key}{$orange}\"{$reset}" : "\e[36m$key\e[0m";
    if (is_array($val)) {
      $count = count($val);
      echo $spaces . $formattedKey . " {$orange}=>{$reset} \e[36marray:$count\e[0m {$orange}[{$reset}\n";
      formatTerminalArray($val, $indent + 2);
      echo $spaces . "{$orange}]{$reset}\n";
    } else {
      // Arrows are colored orange
      echo $spaces . $formattedKey . " {$orange}=>{$reset} " . formatTerminalValue($val, $indent) . "\n";
    }
  }
}

function formatTerminalValue($val, $indent = 0) {
  $orange = "\e[38;5;208m";
  $reset  = "\e[0m";
  $bold   = "\e[1m"; // ANSI Bold Modifier
  if (is_string($val)) {
    if (strpos($val, "\n") !== false) {          
      $spaces = str_repeat(" ", $indent + 2);
      $indentedString = str_replace("\n", "\n" . $spaces, $val);
      // Quotes are orange, string text inside is BOLD green (\e[1;32m)
      return "{$orange}\"{$reset}\e[1;32m\n{$spaces}" . $indentedString . "{$reset}{$orange}\n\"{$reset}";
    }
    return "{$orange}\"{$reset}\e[1;32m{$val}{$reset}{$orange}\"{$reset}";                  
  }
  // Bold numbers (\e[1;33m), Bold magenta booleans (\e[1;35m), Bold gray nulls (\e[1;90m)
  if (is_numeric($val)) return "\e[1;36m{$val}{$reset}";                     
  if (is_bool($val))    return "\e[1;35m" . ($val ? 'true' : 'false') . "{$reset}"; 
  if (is_null($val))    return "\e[1;90mnull{$reset}";                     

  return $val;
}
