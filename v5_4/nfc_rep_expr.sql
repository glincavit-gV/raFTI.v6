select count(*) cnt_cnt, cnt
from (
select
	a2.id,
	regexp_replace(a1.countries, '\\d+', '') repl,
	a1.countries, length(regexp_replace(a1.countries, '\\d+', '')) + 1 cnt
from nfc_expr_vine__arPD as a1
	left join nfc_expr__arP as a2 on a2.arP = a1.vine__arP 
) as a1
group by cnt

select count(*) cnt_cnt, cnt
from (
select
	a2.id,
	regexp_replace(a1.countries, '\\d+', '') repl,
	a1.countries, length(regexp_replace(a1.countries, '\\d+', '')) + 1 cnt
from nfc_expr_regi__arPD as a1
	left join nfc_expr__arP as a2 on a2.arP = a1.regi__arP 
) as a1
group by cnt

select a1.vine__id, a2.name, a1.link__id, a3.name, a3.country, a4.name , count(*) cnt
from nfc_expr_vine__arPD_link as a1
  left join gustos.vineyard a2 on a2.id = a1.vine__id 
  left join gustos.vineyard a3 on a3.id = a1.link__id
  left join gustos.taxonomy_term_data as a4 on a4.tid = a3.country 
 group by a1.vine__id 
--  where a1.vine__id = 40136
 order by cnt desc

select a1.regi__id, a2.name, a1.link__id, a3.name, substring_index(a5.countries, ',', 1) country, a6.name , count(*) cnt
from nfc_expr_regi__arPD_link as a1
  left join parsedwine.region a2 on a2.id = a1.regi__id 
  left join parsedwine.region a3 on a3.id = a1.link__id
  left join nfc_expr__arP as a4 on a4.id = a1.regi__id and a4.expr__eS = 27262980
  left join nfc_expr_regi__arPD as a5 on a5.regi__arP = a4.arP
  left join gustos.taxonomy_term_data as a6 on a6.tid = substring_index(a5.countries, ',', 1) 
 group by a1.regi__id 
--  where a1.regi__id = 40136
 order by cnt desc


 
 select a1.regi__id, a2.name, a1.link__id, a3.name, substring_index(a5.countries, ',', 1) to_country, a6.name to_name,
 	substring_index(a52.countries, ',', 1) from_country, a6.name from_name-- , count(*) cnt
from nfc_expr_regi__arPD_link as a1
  left join parsedwine.region a2 on a2.id = a1.regi__id 
  left join parsedwine.region a3 on a3.id = a1.link__id
  left join nfc_expr__arP as a4 on a4.id = a1.regi__id and a4.expr__eS = 27262980
  left join nfc_expr_regi__arPD as a5 on a5.regi__arP = a4.arP
  left join parsedwine__exDB.nfc_src_regions as r1 on abs(r1.regi__id) = a1.regi__id
  left join gustos.taxonomy_term_data as a6 on a6.tid = if(r1.id is null, substring_index(a5.countries, ',', 1), r1.country__tid)
  left join nfc_expr__arP as a42 on a42.id = a1.link__id and a42.expr__eS = 27262980
  left join nfc_expr_regi__arPD as a52 on a52.regi__arP = a42.arP
  left join parsedwine__exDB.nfc_src_regions as r2 on abs(r2.regi__id) = a1.link__id
  left join gustos.taxonomy_term_data as a62 on a62.tid = if(r2.id is null, substring_index(a52.countries, ',', 1), r1.country__tid)
-- group by a1.regi__id 
--  where a1.regi__id = 4220
-- order by cnt desc


 
select a1.vine__id, a2.name, a1.link__id, a3.name, a3.country, a4.name -- , count(*) cnt
from nfc_expr_vine__arPD_link as a1
  left join gustos.vineyard a2 on a2.id = a1.vine__id 
  left join gustos.vineyard a3 on a3.id = a1.link__id
  left join gustos.taxonomy_term_data as a4 on a4.tid = a3.country 
-- group by a1.vine__id 
  where a1.vine__id = 29711
-- order by cnt desc

 -- truncate nfc_score__acSG_ids;
  
 select a1.*, a2.path, a3.path
 from nfc_expr_regi__arPD_link as a1
   left join parsedwine.region as a2 on a2.id = a1.link__id 
   left join parsedwine.region as a3 on a3.id = a1.regi__id 
   
 
 SELECT a1.*, a6.name wine, a6.vineyard, a4.name as from_, a5.name as to_
 from nfc_expr_wine__acPG as a1
   left join nfc_type__arP as a2 on a2.val = a1.expr__eS 
   inner join nfc_expr_vine__arPD_link as a3 on a3.link__id = a1.to__id
   left join gustos.vineyard a4 on a4.id = a1.from__id 
   left join gustos.vineyard a5 on a5.id = a1.to__id 
   left join gustos.gustos_wine as a6 on a6.id = a1.wine__id 
 where 1=1
   and a2.dsP = 'exVINE'
   and a3.vine__id = 11220
order by from_ -- a1.acPG 

select count(*)
from nfc_expr_wine__acPG as a1
   left join nfc_type__arP as a2 on a2.val = a1.expr__eS 
 where 1=1
   and a2.dsP = 'exVINE'


-- 3357 4743 6143 16389 20247 20401 29488 40136
 

select a6.cnt, a1.link__id, a1.vine__id, a5.name, a5.country, a4.countries
FROM nfc_expr_vine__arPD_link as a1
  left join nfc_expr__arP as a2 on a2.id = a1.link__id
  left join nfc_type__arP as a3 on a3.val = a2.expr__eS 
  left join nfc_expr_vine__arPD as a4 on a4.vine__arP = a2.arP
  left join gustos.vineyard as a5 on a5.id = a1.link__id 
  inner join (
    select c1.vine__id, c1.country, count(*) cnt
    from (
      select b1.vine__id, b4.countries as country, count(*) as cnt
      from nfc_expr_vine__arPD_link as b1
  	    left join nfc_expr__arP as b2 on b2.id = b1.link__id
        left join nfc_type__arP as b3 on b3.val = b2.expr__eS 
        left join nfc_expr_vine__arPD as b4 on b4.vine__arP = b2.arP
	  where b3.dsP = 'exVINE'
	  group by b1.vine__id, b4.countries
	) as c1
	group by c1.vine__id
	having count(*) = 1
  ) as a6 on a6.vine__id = a1.vine__id
where 1 = 1
  and a3.dsP = 'exVINE'
order by a1.vine__id 

SELECT a3.vine__arP, a3.countries, a1.link__id as from__id, a1.vine__id as to__id
    from nfc_expr_vine__arPD_link as a1
      left join nfc_expr__arP as a2 on a2.id = a1.link__id
      inner join nfc_expr_vine__arPD as a3 on a3.vine__arP = a2.arP
    where 1 = 1
--      and a2.expr__eS = $exVINE
    order by a1.vine__id

select distinct a1.*
from nfc_expr_vine__arPD_link as a1
order by a1.vine__id, a1.link__id 


CALL synonym__asPL_region(0, 0, 0);

CALL nfc_expr__asPL_wine_gustosapp_normALL(1, 0, 0);

select _term__asFL_dsP(2102787);

select hex(17826860);
   
select _term__asFL_dsP(2100329), _term__asFL_dsP(2097232), _syTerm__asFL(2097285), _expr__asFL(3145963);

select t1.*, _term__asFL_dsP(t2.el__arP), t2.*
from nfc__arP as t1
	left join nfc_expr__acU as t2 on t2.expr__arP = t1.arP 
where 1=1
  and (t1.arP & (0x003FFFFF+0)) = 3145963 -- 3145963
-- and t1.arP = 3145963
  
select @fti_dbg := 0;

SELECT dsP, arP from nfc_word__arP where dsP IN ('ile','de','France')


 -- Azienda Agricola Brancatelli Srl
select _expr__asFL(t1.arP), t1.id 
from nfc_expr__arP as t1
where t1.new__id > 0 and (t1.next__id - t1.new__id) > 1

  select _wine__asFL(246,0), _expr__asFL(3189659), hex(17826539),(0x7FFFFFFFFFFFFFFF+0), _term__asFL_dsP(2101227), _term__asFL_dsP(2101228), _term__asFL_dsP(2097813), 
  	_term__asFL_dsP(2134431), _attr__asFL(355), _attr__asFL(1488), _attr__asFL(2902),
	hex(168), hex(1050006), hex(137506127872), hex(201392128)

	1049557 1003D5
-- ,0,1,2006,2012,2013,2016,2018,2019,
	
call nfc_term__asPL_load()

select * from nfc_term__asVL_load;

call nfc_expr__asPL_wine_gustosapp_normALL(40000,0,0)

call nfc_expr__asPL_vine_gustosapp_normALL(0,0,45)

call nfc_load_terms__asPL();

SELECT t1.id, _term__asFL_dsP(t2.term__arP) dsP, t3.next__id, t4.dsP, t2.*, t1.*
  from nfc_expr__arP as t1
    left join nfc_expr__acPU_term as t2 on t2.expr__arP = t1.arP
    left join nfc_term__arP as t3 on t3.arP = t2.term__arP 
    left join nfc_type__arP as t4 on t4.val = t1.expr__eS 
  where t1.id in  ( 4481,2656,4547)
  order by expr__eS, id, el__id
  
  select * from nfc_expr__acPU_term a1
   inner join nfc_expr_wine__arPD as a2 on a2.arP = a1.expr__arP 
  where a1.el__id > 0
  order by a1.expr__arP 
  
  -- 3147957,3147958,3147959,3147960,3147961,3147962

CREATE OR REPLACE VIEW nfc_expr_wine__acPG__asVS_changes as  
SELECT distinct b3.cnt, a1.path, t1.word__cnt,
  t1.wine__id, t2.name, t6.dsP,
  if(t1.expr__eS = t6.val and t6.dsP = 'exGRAP', cast(t13.blend__dsP as char(1024)), t1.from__id) as from__id,
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
  if(t1.expr__eS = t6.val and t6.dsP = 'exGRAP', cast(t14.blend__dsP as char(1024)), t1.to__id) as to__id,
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
  left join gustos.gustos_wine as t2 on t2.id = t1.wine__id 
  left join nfc_expr_wine__arPD as t3 on t3.wine = t2.id
  left join nfc_type__arP as t6 on t6.description like 'expr__eS%' and t6.val = t1.expr__eS
  left join nfc_blend__asVS as t7 on t1.expr__eS = t6.val and t6.dsP = 'exGRAP' and t7.blend__arS = t1.to__id 
  left join nfc_blend__asVS as t8 on t1.expr__eS = t6.val and t6.dsP = 'exGRAP' and t8.blend__arS = t1.from__id
  left join gustos.vineyard as t9 on t1.expr__eS = t6.val and t6.dsP = 'exVINE' and  t9.id = t1.to__id 
  left join gustos.vineyard as t10 on t1.expr__eS = t6.val and t6.dsP = 'exVINE' and  t10.id = t1.from__id
  left join parsedwine.region as t11 on t11.id = t1.to__id
  left join parsedwine.region as t12 on t12.id = t1.from__id
  left join nfc_expr_grap__arS_blend as t13 on t13.arS = t1.from__id 
  left join nfc_expr_grap__arS_blend as t14 on t14.arS = t1.to__id 
  left join parsedwine.region a1 on a1.id = t2.country
  left join nfc_type__arP as b1 on b1.description like 'attr__eB%' and b1.val = t1.to__id
  left join nfc_type__arP as b2 on b2.description like 'attr__eB%' and b2.val = t1.from__id
  left join (
  	select count(*) cnt, e1.expr__eS, e1.to__id
  	from nfc_expr_wine__acPG as e1
  	group by e1.expr__eS, e1.to__id
  ) b3 on b3.expr__eS = t1.expr__eS and b3.to__id = t1.to__id 
where 1=1
 	and t6.dsP = 'exREGI'
-- 	and t1.wine__id = 114407
-- 	and t2.name like '%Bordeaux%'
--	and t6.dsP = 'exVINE'
--	and t1.from__id = 5010
--	and t1.wine__id = 103717
--    and t2.name like '%Dunaj%'
order by t1.word__cnt desc, b3.cnt, to__id -- path, t2.name -- a1.path

SELECT count(*) from nfc_expr__arP where 1=1 and expr__eS = 27262980 and (expr__eMI & 32768)

-- 22594 - 997 = 21597 - 22364 = 230	21819 - 21152 = 767 Organic White Blanc de Blancs	wineTYPE	1360	sparkling	1358	still ??


