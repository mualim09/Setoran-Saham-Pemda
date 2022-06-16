select 
triw1.pemda_name, 
(triw1.setoran_penyertaan)as setorantw1, (triw1.saldo_akhir)as saldoakhirtw1, triw1.persen_saham)as persensahamtw1,(triw1.persen_grwth)as persengrowthtw1,
(triw2.setoran_penyertaan)as setorantw2,(triw2.saldo_akhir)as saldoakhirtw2, (triw2.persen_saham)as persensahamtw2,(triw2.persen_grwth)as persengrowthtw2,
(triw23.setoran_penyertaan)as setorantw3,(triw2.saldo_akhir)as saldoakhirtw3, (triw3.persen_saham)as persensahamtw3,(triw3.persen_grwth)as persengrowthtw3,
from 
		(
			select dp.pemda_name, dp.id,(aa.triwulan1)as saldo_akhir , (sp.nom_setoran) as setoran_penyertaan ,
			 tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100  as  persen_saham, dthn_lalu.nom_prev, 
			case 
			when aa.triwulan1-dthn_lalu.nom_prev <0 then 0
				else ((aa.triwulan1-dthn_lalu.nom_prev)/dthn_lalu.nom_prev*100)
			end	as persen_grwth, 
			(aa.triwulan1) as selisih_growth
			from t_saldo_akhir as aa 
			left join (select sum(zz.triwulan1) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=2020) as tt on tt.periode=aa.tahun
			left join (select zz.pemda_id,zz.triwulan4 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=2019) as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
			left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
			left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where YEAR(tanggal_setoran)=2020 and triwulan=1 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
			where aa.tahun=2020
	)as triw1


left join (select dp.pemda_name, dp.id,(aa.triwulan2) as saldo_akhir, (sp.nom_setoran) as setoran_penyertaan ,
tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100 as  persen_saham, dthn_lalu.nom_prev, 
case 
	when aa.total_akhir-dthn_lalu.nom_prev <0 then 0
	else ((aa.triwulan2-dthn_lalu.nom_prev)/dthn_lalu.nom_prev*100)
end	as persen_grwth
from t_saldo_akhir as aa 
left join (select sum(zz.triwulan2) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=2020) as tt on tt.periode=aa.tahun
						left join (select zz.pemda_id,zz.triwulan1 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=2020) as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
							
							left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
							left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where YEAR(tanggal_setoran)=2020 and triwulan=2 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
							where aa.tahun=2020) as triw2 

on triw1.id = triw2.id ;

left join (select dp.pemda_name, dp.id,(aa.total_akhir) as saldo_akhir, (sp.nom_setoran) as setoran_penyertaan ,
            tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100 as  persen_saham, dthn_lalu.nom_prev, 
            case 
              when aa.triwulan3-dthn_lalu.nom_prev <0 then 0
                else ((aa.triwulan3-dthn_lalu.nom_prev)/dthn_lalu.nom_prev*100)
            end	as persen_grwth
            from t_saldo_akhir as aa 
            left join (select sum(zz.triwulan3) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=2020) as tt on tt.periode=aa.tahun
            
            left join (select zz.pemda_id,zz.triwulan2 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=2020) as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
            
            left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
            left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where YEAR(tanggal_setoran)=2020 and triwulan=3 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
            where aa.tahun=2020) as triw3

on triw1.id = triw3.id 








UPDATE t_saldo_akhir set 
triwulan1 = 
	case 
		when triwulan1 = 0 
			then triwulan1 + 0
				
		else 
		
			
				CASE 
						WHEN( (month('2020-05-05')<=3) AND (YEAR('2020-05-05')=2020) ) THEN triwulan1 + 3
						WHEN( (month('2020-05-05')<=6) AND (YEAR('2020-05-05')=2020) ) THEN triwulan1 + 3
						WHEN( (month('2020-05-05')<=9) AND (YEAR('2020-05-05')=2020) ) THEN triwulan1 + 3
						WHEN( (month('2020-05-05')<=12) AND (YEAR('2020-05-05')=2020) ) THEN triwulan1 + 3	
				END 
			
	end	
,
triwulan2 = 
	case 
		when triwulan2 = 0 
			then triwulan2 + 0
				
		else 
		
			
				CASE 
						WHEN( (month('2020-05-05')<=3) AND (YEAR('2020-05-05')=2020) ) THEN triwulan2 + 3
						WHEN( (month('2020-05-05')<=6) AND (YEAR('2020-05-05')=2020) ) THEN triwulan2 + 3
						WHEN( (month('2020-05-05')<=9) AND (YEAR('2020-05-05')=2020) ) THEN triwulan2 + 3
						WHEN( (month('2020-05-05')<=12) AND (YEAR('2020-05-05')=2020) ) THEN triwulan2 + 3	
				END 
			
	end	
,
triwulan3 = 
	case 
		when triwulan3 = 0 
			then triwulan3 + 0
				
		else 
		
			
				CASE 
						WHEN( (month('2020-05-05')<=3) AND (YEAR('2020-05-05')=2020) ) THEN triwulan3 + 3
						WHEN( (month('2020-05-05')<=6) AND (YEAR('2020-05-05')=2020) ) THEN triwulan3 + 3
						WHEN( (month('2020-05-05')<=9) AND (YEAR('2020-05-05')=2020) ) THEN triwulan3 + 3
						WHEN( (month('2020-05-05')<=12) AND (YEAR('2020-05-05')=2020) ) THEN triwulan3 + 3	
				END 
			
	end	
,
triwulan4 = 
	case 
		when triwulan4 = 0 
			then triwulan4 + 0
				
		else 
		
			
				CASE 
						WHEN( (month('2020-05-05')<=3) AND (YEAR('2020-05-05')=2020) ) THEN triwulan4 + 3
						WHEN( (month('2020-05-05')<=6) AND (YEAR('2020-05-05')=2020) ) THEN triwulan4 + 3
						WHEN( (month('2020-05-05')<=9) AND (YEAR('2020-05-05')=2020) ) THEN triwulan4 + 3
						WHEN( (month('2020-05-05')<=12) AND (YEAR('2020-05-05')=2020) ) THEN triwulan4 + 3	
				END 
			
	end	
,
total_akhir = total_akhir+ 3 where pemda_id= 1 and tahun between 2020 and 2022;

select * from t_saldo_akhir where pemda_id=1 and tahun BETWEEN 2020 and 2022;
