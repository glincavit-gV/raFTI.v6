-- 933,995,1128,1029,930,964,1097,1154,1065,934,1002,1078,1125

SELECT x.*, r.limit__niBQ, r.score__niBO, r.gw_name 
FROM nfc_score__acSG_wine__asVS x
	left join nfc_score__acSG_wine__asVS r on r.score__arS = 9 and r.pw_wine = x.pw_wine  
where x.score__arS = 7 and r.gw_wine <> x.gw_wine
ORDER BY x.score__arS

SELECT
  concat(x.arS, '/', x.name) src_name,
  x.nfc_gustos_vineyard_name,
  concat(x.nfc_gustos_wine__id, '/', x.nfc_gustos_wine_name) nfc_gustos_wine_name, x.nfc_gustos_wine__score, sc_limit,
  concat(x.msf_wine__id, '/', x.msf_wine_name) msf_wine_name,
--  concat(nw.wine , '/', w.Gustos_WIne) Gustos_WIne, w.Gustos_Vineyard,
  concat(x.msf_vineyard_id, '/', x.msf_vineyard_name) msf_vineyard_name, x.msf_score,
   x.word__cnt, x.nfc_word__cnt,
  x.countries, x.color nfc_color, x.co2 nfc_co2, nw.color, nw.co2, x.vintage__dsP, x.grape__dsP,
  x.regi__path, x.nfc_gustos_wine_entity__id, x.nfc_gustos_vintage 
FROM parsedwine__exDB.is24956_Wines_Croitoru x
  left join parsedwine__exDB.a_src_is24956_Wines_Croitoru w on x.name = w.Artigo
  left join gustos.gustos_wine_entity gwe on gwe.id = w.Vintage_ID 
  left join parsedwine.nfc_expr_wine__arPD nw on nw.wine = gwe.wine
where x.nfc_gustos_wine__id <> x.msf_wine__id 
-- order by x.nfc_gustos_wine__score desc  
-- order by if(x.sc_limit > 40, 0, 1), if(x.sc_limit > 40, x.nfc_gustos_vineyard_id, 1), x.nfc_gustos_wine__score desc  
 order by if(x.sc_limit > 40, 0, 1), if(x.sc_limit > 40, x.nfc_gustos_vineyard_id, 1), x.arS

SELECT 
  concat(x.arS, '/', x.name) src_name,
  x.nfc_gustos_vineyard_name,
  concat(x.nfc_gustos_wine__id, '/', x.nfc_gustos_wine_name) nfc_gustos_wine_name, x.nfc_gustos_wine__score, sc_limit,
  -- concat(x.msf_wine__id, '/', x.msf_wine_name) msf_wine_name,
  -- concat(x.msf_vineyard_id , '/', x.msf_vineyard_name) msf_vineyard_name,
  concat(nw.wine , '/', w.Gustos_WIne) Gustos_WIne, w.Gustos_Vineyard,
--  concat( , '/', x.msf_vineyard_name) msf_vineyard_name,
   x.word__cnt, x.nfc_word__cnt,
  x.countries, x.color nfc_color, x.co2 nfc_co2, nw.color, nw.co2, x.vintage__dsP, x.grape__dsP,
  x.regi__path, x.nfc_gustos_wine_entity__id, x.nfc_gustos_vintage 
FROM parsedwine__exDB.is24956_Wines_Croitoru x
  left join parsedwine__exDB.a_src_is24956_Wines_Croitoru w on x.name = w.Artigo
  left join gustos.gustos_wine_entity gwe on gwe.id = w.Vintage_ID 
  left join parsedwine.nfc_expr_wine__arPD nw on nw.wine = gwe.wine
--  where x.nfc_gustos_wine_entity__id <> ifnull(w.Vintage_ID, 0)
-- order by x.arS 
-- order by x.nfc_gustos_wine__score desc
-- order by x.name
 order by if(x.sc_limit > 40, 0, 1), if(x.sc_limit > 40, x.nfc_gustos_vineyard_id, 1), x.arS










SELECT
	x.Link, x.Brand_name, x.Wine_name, x.Producer_name,
	x.nfc_gustos_wine__score, x.sc_limit, x.nfc_gustos_wine_name, x.nfc_gustos_vineyard_name,
	x.msf_wine_name, x.msf_vineyard_name, x.msf_score 
FROM parsedwine.src_is25559_alcomarket x
where x.nfc_gustos_wine__id <> x.msf_wine__id
order by x.msf_score desc
-- order by x.sc_limit desc

SELECT
	x.Link, x.`Marcă_comercială` as Brand_name, x.`Numele_vinului` as Wine_name, x.`Producător` as Producer_name,
	x.nfc_gustos_wine__score, x.sc_limit, x.nfc_gustos_wine_name, x.nfc_gustos_vineyard_name,
	x.arS, x.nfc_gustos_wine__id , x.nfc_gustos_wine_entity__id, x.nfc_gustos_vintage
	-- x.msf_wine_name, x.msf_vineyard_name, x.msf_score 
FROM parsedwine.src_is25559_metro_parsing x
-- where x.nfc_gustos_wine__id <> x.msf_wine__id
order by x.sc_limit desc
-- order by x.arS

SELECT
	x.Link, x.Wine_name, x.Producer,
	x.nfc_gustos_wine__score, x.sc_limit, x.nfc_gustos_wine_name, x.nfc_gustos_vineyard_name,
	x.msf_wine_name, x.msf_vineyard_name, x.msf_score 
FROM parsedwine.src_is25559_carpe_diem x
where x.nfc_gustos_wine__id <> x.msf_wine__id
order by x.msf_score desc
-- order by x.sc_limit desc

SELECT
	x.Link, x.Brend_name, x.Wine_name,
	x.nfc_gustos_wine__score, x.sc_limit, x.nfc_gustos_wine_name, x.nfc_gustos_vineyard_name,
	x.msf_wine_name, x.msf_vineyard_name, x.msf_score 
FROM parsedwine.src_is25559_linella x
where x.nfc_gustos_wine__id <> x.msf_wine__id
order by x.msf_score desc
-- order by x.sc_limit desc

SELECT
	x.Link, x.Brand_name, x.Wine_name,
	x.nfc_gustos_wine__score, x.sc_limit, x.nfc_gustos_wine_name, x.nfc_gustos_vineyard_name,
	-- x.arS, x.nfc_gustos_wine__id , x.nfc_gustos_wine_entity__id, x.nfc_gustos_vintage 
	x.msf_wine_name, x.msf_vineyard_name, x.msf_score 
FROM parsedwine.src_is25559_vincuvin x
where x.nfc_gustos_wine__id <> x.msf_wine__id
order by x.msf_score desc
-- order by x.sc_limit desc
-- order by arS

SELECT
	x.Link, x.Brand_name, x.Wine_name,
	x.nfc_gustos_wine__score, x.sc_limit, x.nfc_gustos_wine_name, x.nfc_gustos_vineyard_name,
--	x.arS, x.nfc_gustos_wine__id , x.nfc_gustos_wine_entity__id, x.nfc_gustos_vintage 
	x.msf_wine_name, x.msf_vineyard_name, x.msf_score 
FROM parsedwine.src_is25559_wine_md x
where x.nfc_gustos_wine__id <> x.msf_wine__id
order by x.msf_score desc
-- order by x.sc_limit desc
-- order by arS

SELECT
	x.Link, x.Brand_name, x.Wine_name,
	x.nfc_gustos_wine__score, x.sc_limit, x.nfc_gustos_wine_name, x.nfc_gustos_vineyard_name,
--	x.arS, x.nfc_gustos_wine__id , x.nfc_gustos_wine_entity__id, x.nfc_gustos_vintage 
	x.msf_wine_name, x.msf_vineyard_name, x.msf_score 
FROM parsedwine.src_is25559_wine_time x
 where x.nfc_gustos_wine__id <> x.msf_wine__id
 order by x.msf_score desc
-- order by x.sc_limit desc
-- order by arS


