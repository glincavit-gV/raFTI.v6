<?php
global $tyDUPS__eN;
  $tyDUPS__eN = ['dups', 'link', 'om'];

function nfc_dups_vine_all() {
  global $fti_gustos_db, $tyDUPS__eN;
  foreach ($tyDUPS__eN as $ty) {
    echo "\n\n" . nfc_dups_vine_ty($ty) . "\n";
  }
}

function nfc_dups_vine_ty($tyDUPS) {
  global $fti_gustos_db, $tyDUPS__eN;
  if (!in_array($tyDUPS, $tyDUPS__eN)) {
    dd("nfc_dups_vine_e1 - Input parameter tyDUPS($tyDUPS) is not in allowed list: tyDUPS__eN(" . implode(',', $tyDUPS__eN) . ")");
  }
  $sql_s =
"SELECT vc.num, vc.cnt, r1.name as {$tyDUPS}__tara, vd.{$tyDUPS}__id, v1.name as {$tyDUPS}__name, v2.name as vine__name, vd.vine__id, r2.name as vine__tara
  from nfc_expr_vine__arPD_{$tyDUPS} as vd
    left join $fti_gustos_db.vineyard v1 on v1.id = vd.{$tyDUPS}__id 
    left join $fti_gustos_db.vineyard v2 on v2.id = vd.vine__id
    left join (
      select a1.vine__id, count(*) as cnt,
        row_number() over(order by count(*) desc) as num
      from nfc_expr_vine__arPD_{$tyDUPS} as a1
      group by a1.vine__id
    ) as vc on vc.vine__id = vd.vine__id
    left join $fti_gustos_db.region as r1 on r1.id = v1.country
    left join $fti_gustos_db.region as r2 on r2.id = v2.country"
  ;
  if ($tyDUPS == 'link') {
    $sql_s .= "
    left join nfc_expr_vine__arPD_dups as d1 on d1.dups__id = vd.link__id 
  where d1.dups__id is null"
    ;
  }
  $sql_s .= "
  order by vc.num, vc.cnt desc, vd.vine__id"
  ;
  return $sql_s;
}