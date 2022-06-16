<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReportModel extends Model
{
    use HasFactory;

    protected $table = 't_saldo_akhir';

    public static function getReportAllPemda($triwulan, $tahun)
    {

        $query = '';
        $Data = [];

        $totSaldoPenyertaan = 0;
        $totPersenGrowth = 0;
        $totSaldoAkhir = 0;
        $title = '';
        $totalDiPemprov=0;
        


        if ($triwulan == 1) {
 

            $query = 'select dp.pemda_name, dp.id,(aa.triwulan1)as saldo_akhir , (sp.nom_setoran) as setoran_penyertaan ,
            tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100  as  persen_saham, dthn_lalu.nom_prev, 
            case 
            when aa.triwulan1-dthn_lalu.nom_prev <0 then 0
                else ((aa.triwulan1-dthn_lalu.nom_prev)/dthn_lalu.nom_prev*100)
            end	as persen_grwth, 
            (aa.triwulan1) as selisih_growth
            from t_saldo_akhir as aa 
            left join (select sum(zz.triwulan1) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=' . ($tahun) . ') as tt on tt.periode=aa.tahun
            left join (select zz.pemda_id,zz.triwulan4 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=' . ($tahun - 1) . ') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
            left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
            left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where year(tanggal_setoran)=' . ($tahun) . ' and triwulan=1 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
                where aa.tahun=' . ($tahun);
            $title = 'Triwulan 1';


            $totalGrow = DB::select(
                '
                    select sprev.saldosebelum, snext.saldosesudah, 
                    case 
                        when (snext.saldosesudah-sprev.saldosebelum) <0 then 0
                        else (((snext.saldosesudah-sprev.saldosebelum)/sprev.saldosebelum)*100)
                    end as totgrow
                    from (SELECT sum(triwulan4) as saldosebelum , tahun from t_saldo_akhir where tahun=' . ($tahun - 1) . ') as sprev
                    inner join (SELECT sum(triwulan1) as saldosesudah  from t_saldo_akhir where tahun=' . ($tahun) . ') as snext

                '
            )[0]->totgrow;
        } else if ($triwulan == 2) {
 
            $query = 'select dp.pemda_name, dp.id,(aa.triwulan2) as saldo_akhir, (sp.nom_setoran) as setoran_penyertaan ,
            tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100 as  persen_saham, dthn_lalu.nom_prev, 
            case 
              when aa.total_akhir-dthn_lalu.nom_prev <0 then 0
                else ((aa.triwulan2-dthn_lalu.nom_prev)/dthn_lalu.nom_prev*100)
            end	as persen_grwth
            from t_saldo_akhir as aa 
            left join (select sum(zz.triwulan2) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=' . ($tahun) . ') as tt on tt.periode=aa.tahun
            
            left join (select zz.pemda_id,zz.triwulan1 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=' . ($tahun) . ') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
            
            left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
            left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where year(tanggal_setoran)=' . ($tahun) . ' and triwulan=2 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
            where aa.tahun=' . ($tahun);
            $title = 'Triwulan 2';

            $totalGrow = DB::select(
                '
                select sprev.saldosebelum, snext.saldosesudah, 
                case 
                    when (snext.saldosesudah-sprev.saldosebelum) <0 then 0
                    else (((snext.saldosesudah-sprev.saldosebelum)/sprev.saldosebelum)*100)
                end as totgrow
                from (SELECT sum(triwulan1) as saldosebelum , tahun from t_saldo_akhir where tahun=' . ($tahun) . ') as sprev
                inner join (SELECT sum(triwulan2) as saldosesudah  from t_saldo_akhir where tahun=' . ($tahun) . ') as snext
                '
            )[0]->totgrow;
        } else if ($triwulan == 3) {

            $query = 'select dp.pemda_name, dp.id,(aa.triwulan3) as saldo_akhir, (sp.nom_setoran) as setoran_penyertaan ,
            tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100 as  persen_saham, dthn_lalu.nom_prev, 
            case 
              when aa.total_akhir-dthn_lalu.nom_prev <0 then 0
                else ((aa.triwulan3-dthn_lalu.nom_prev)/dthn_lalu.nom_prev*100)
            end	as persen_grwth
            from t_saldo_akhir as aa 
            left join (select sum(zz.triwulan3) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=' . ($tahun) . ') as tt on tt.periode=aa.tahun 
            left join (select zz.pemda_id,zz.triwulan3 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=' . ($tahun) . ') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
            
            left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
            left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where year(tanggal_setoran)=' . ($tahun) . ' and triwulan=3 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
            where aa.tahun=' . ($tahun);
 
            
            $title = 'Triwulan 3';

            $totalGrow = DB::select(
                '
                select sprev.saldosebelum, snext.saldosesudah, 
                case 
                    when (snext.saldosesudah-sprev.saldosebelum) <0 then 0
                    else (((snext.saldosesudah-sprev.saldosebelum)/sprev.saldosebelum)*100)
                end as totgrow
                from (SELECT sum(triwulan2) as saldosebelum , tahun from t_saldo_akhir where tahun=' . ($tahun) . ') as sprev
                inner join (SELECT sum(triwulan3) as saldosesudah  from t_saldo_akhir where tahun=' . ($tahun) . ') as snext
                 
                '
            )[0]->totgrow;
        } else if ($triwulan == 4) {
 

            $query = 'select dp.pemda_name, dp.id,(aa.triwulan4) as saldo_akhir, (sp.nom_setoran) as setoran_penyertaan ,
            tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100 as  persen_saham, dthn_lalu.nom_prev, 
            case 
              when aa.triwulan4-dthn_lalu.nom_prev <0 then 0
                else ((aa.triwulan4-dthn_lalu.nom_prev)/dthn_lalu.nom_prev*100)
            end	as persen_grwth
            from t_saldo_akhir as aa 
            left join (select sum(zz.triwulan4) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=' . ($tahun) . ') as tt on tt.periode=aa.tahun
            
            left join (select zz.pemda_id,zz.triwulan3 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=' . ($tahun) . ') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
            
            left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
            left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where year(tanggal_setoran)=' . ($tahun) . ' and triwulan=4 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
            where aa.tahun=' . ($tahun) . '';
            $title = 'Triwulan 4';


            $totalGrow = DB::select(
                '
                select sprev.saldosebelum, snext.saldosesudah, 
                case 
                    when (snext.saldosesudah-sprev.saldosebelum) <0 then 0
                    else (((snext.saldosesudah-sprev.saldosebelum)/sprev.saldosebelum)*100)
                end as totgrow
                from (SELECT sum(triwulan3) as saldosebelum , tahun from t_saldo_akhir where tahun=' . ($tahun) . ') as sprev
                inner join (SELECT sum(triwulan4) as saldosesudah  from t_saldo_akhir where tahun=' . ($tahun) . ') as snext'
            )[0]->totgrow;
        }
        $persenSahamPemkabkot=0;
        $persenSahamPemprov=0;
        
        $reportAllPemda = DB::select($query);
        foreach ($reportAllPemda as $repPemda) {
            $totSaldoPenyertaan += $repPemda->setoran_penyertaan;
            $totPersenGrowth += $repPemda->persen_grwth;

            $totSaldoAkhir += $repPemda->saldo_akhir;

            if ($repPemda->id == 1) {
                $totalDiPemprov = $repPemda->saldo_akhir;
                $persenSahamPemprov = $repPemda->persen_saham;
                
            }

            $persenSahamPemkabkot += $repPemda->persen_saham;


        }



        // return false;
        $Data['title'] = $title;
        $Data['totalSetPenyertaan'] = $totSaldoPenyertaan;
        $Data['totalSaldoAkhir'] = $totSaldoAkhir;
        $Data['totalGrowth'] = $totalGrow;
        $Data['totalDiPemprov'] = $totalDiPemprov;
        $Data['totalPemkabkot'] = $totSaldoAkhir - $totalDiPemprov;
        
        $Data['persenSahamPemprov'] = $persenSahamPemprov;
        
        $Data['persenSahamPemkabkot'] = (100 - $persenSahamPemprov);
        // $Data['persenSahamPemkabkot'] = ($persenSahamPemkabkot - $persenSahamPemprov);


      


        return $Data;
    }


    public static function getReportTahunLalu($tahun)
    {

        $data = [];
        

        $sumTahunLalu = DB::select(
            '
           select sum(triwulan4) as jlh_semua, tahun as periode from t_saldo_akhir as aa where tahun = ' . $tahun . '
           '
        )[0]->jlh_semua;


        $queryPemprov = '
        select  aa.pemda_id, dp.pemda_name ,aa.tahun , rtl.jlh_semua, aa.triwulan4,
        (aa.triwulan4 / rtl.jlh_semua)*100 as persen_saham
        from t_saldo_akhir as aa 
        left join (select sum(triwulan4) as jlh_semua, tahun as periode from t_saldo_akhir as aa where tahun = ' . $tahun . ') as rtl 
        on rtl.periode = aa.tahun
        left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
        where aa.tahun=' . $tahun . '
        AND aa.pemda_id=1';



        $totalDiPemprov = empty(DB::select($queryPemprov)[0]->triwulan4) ?
            0 : DB::select($queryPemprov)[0]->triwulan4;
        $persenSahamPemprov = empty(DB::select($queryPemprov)[0]->persen_saham) ?
        0 : DB::select($queryPemprov)[0]->persen_saham;





        $data['title'] = 'Saldo Tahun Lalu';
        $data['total'] = $sumTahunLalu;
        
        $data['persenSahamPemprov'] = $persenSahamPemprov;
        $data['persenSahamPemkabkot'] = (100 - $persenSahamPemprov);

        $data['totalDiPemprov'] = $totalDiPemprov;
        $data['totalPemda'] = $sumTahunLalu - $totalDiPemprov;
        



        return $data;

        // echo json_encode($data);
        // exit;
    }


    public static function getHasilAkhir($tahun)
    {
        $totalDiPemprov = 0;
        $totalAllPemkabkot = 0;

        $query = '
        select aa.pemda_id, dp.pemda_name,(sp.nom_setoran) as setoran_penyertaan,
        dthn_lalu.nom_thnlalu, 
        case 
            when aa.total_akhir-dthn_lalu.nom_thnlalu <0 then 0
        else ((aa.total_akhir-dthn_lalu.nom_thnlalu)/dthn_lalu.nom_thnlalu*100)
        end	as persen_grwth
                    from t_saldo_akhir as aa 
                    left join (select sum(zz.total_akhir) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=' . $tahun . ') as tt on tt.periode=aa.tahun

                    left join (select zz.pemda_id,zz.total_akhir as nom_thnlalu ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=' . ($tahun - 1) . ') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id

                    left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
        left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where year(tanggal_setoran)=' . $tahun . ' GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
        where aa.tahun=' . $tahun;

        $hasilAkhir = DB::select($query);

        foreach ($hasilAkhir as $ha) {
            $totalAllPemkabkot += $ha->setoran_penyertaan;

            if ($ha->pemda_id == 1) {
                $totalDiPemprov = $ha->setoran_penyertaan;
            }
        }

        $data['title'] = 'Total Growth Tahun Ini';
        $data['total'] = $totalAllPemkabkot;
        $data['totalDiPemprov'] = $totalDiPemprov;
        $data['totalPemkabkot'] = $totalAllPemkabkot - $totalDiPemprov;


        return $data;
    }


    public static function bigReport($tahun)
    {
        $query = '
        select 
        triw1.pemda_name, 
        (thnlalu.triwulan4) as saldoakhirthnlalu,(thnlalu.persen_saham) as persensahamthnlalu,
        (triw1.setoran_penyertaan)as setorantw1, (triw1.saldo_akhir)as saldoakhirtw1, (triw1.persen_saham)as persensahamtw1,(triw1.persen_grwth)as persengrowthtw1,
        (triw2.setoran_penyertaan)as setorantw2, (triw2.saldo_akhir)as saldoakhirtw2, (triw2.persen_saham)as persensahamtw2,(triw2.persen_grwth)as persengrowthtw2,
        (triw3.setoran_penyertaan)as setorantw3, (triw3.saldo_akhir)as saldoakhirtw3, (triw3.persen_saham)as persensahamtw3,(triw3.persen_grwth)as persengrowthtw3,
        (triw4.setoran_penyertaan)as setorantw4, (triw4.saldo_akhir)as saldoakhirtw4, (triw4.persen_saham)as persensahamtw4,(triw4.persen_grwth)as persengrowthtw4,
        (alltotal.setoran_penyertaan) as totsetoran, (alltotal.persen_grwth) as growthakhir
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
                    left join (select sum(zz.triwulan1) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.$tahun.') as tt on tt.periode=aa.tahun
                        left join (select zz.pemda_id,zz.triwulan4 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun=2019) as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
                        left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
                        left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where year(tanggal_setoran)='.$tahun.' and triwulan=1 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
                    where aa.tahun='.$tahun.'
                )as triw1
                
        left join(


            select  aa.pemda_id, dp.pemda_name ,aa.tahun , rtl.jlh_semua, aa.triwulan4,
                            (aa.triwulan4 / rtl.jlh_semua)*100 as persen_saham
                            from t_saldo_akhir as aa 
                            left join (select sum(triwulan4) as jlh_semua, tahun as periode from t_saldo_akhir as aa where tahun = '.($tahun-1).') as rtl 
                            on rtl.periode = aa.tahun
                            left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
                            where aa.tahun='.($tahun-1).'
        ) as thnlalu

        on thnlalu.pemda_id = triw1.id 


        left join (
            select dp.pemda_name, dp.id,(aa.triwulan2) as saldo_akhir, (sp.nom_setoran) as setoran_penyertaan ,
            tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100 as  persen_saham, dthn_lalu.nom_prev, 
            case 
                when aa.total_akhir-dthn_lalu.nom_prev <0 then 0
                else ((aa.triwulan2-dthn_lalu.nom_prev)/dthn_lalu.nom_prev*100)
            end	as persen_grwth
            from t_saldo_akhir as aa 
                left join (select sum(zz.triwulan2) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.$tahun.') as tt on tt.periode=aa.tahun
                left join (select zz.pemda_id,zz.triwulan1 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.$tahun.') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
                left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
                left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where year(tanggal_setoran)='.$tahun.' and triwulan=2 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
                where aa.tahun='.$tahun.'
                ) as triw2 

        on triw1.id = triw2.id 


        left join (select dp.pemda_name, dp.id,(aa.triwulan3) as saldo_akhir, (sp.nom_setoran) as setoran_penyertaan ,
                    tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100 as  persen_saham, dthn_lalu.nom_prev, 
                    case 
                    when aa.triwulan3-dthn_lalu.nom_prev <0 then 0
                        else ((aa.triwulan3-dthn_lalu.nom_prev)/dthn_lalu.nom_prev*100)
                    end	as persen_grwth
                    from t_saldo_akhir as aa 
                    left join (select sum(zz.triwulan3) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.$tahun.') as tt on tt.periode=aa.tahun
                    
                    left join (select zz.pemda_id,zz.triwulan2 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.$tahun.') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
                    
                    left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
                    left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where year(tanggal_setoran)='.$tahun.' and triwulan=3 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
                    where aa.tahun='.$tahun.') as triw3

        on triw2.id = triw3.id 



        left join (select dp.pemda_name, dp.id,(aa.triwulan4) as saldo_akhir, (sp.nom_setoran) as setoran_penyertaan ,
                    tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100 as  persen_saham, dthn_lalu.nom_prev, 
                    case 
                    when aa.triwulan4-dthn_lalu.nom_prev <0 then 0
                        else ((aa.triwulan4-dthn_lalu.nom_prev)/dthn_lalu.nom_prev*100)
                    end	as persen_grwth
                    from t_saldo_akhir as aa 
                    left join (select sum(zz.triwulan4) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.$tahun.') as tt on tt.periode=aa.tahun
                    
                    left join (select zz.pemda_id,zz.triwulan3 as nom_prev ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.$tahun.') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
                    
                    left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
                    left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where year(tanggal_setoran)='.$tahun.' and triwulan=4 GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
                    where aa.tahun='.$tahun.') as triw4
        on triw3.id = triw4.id 

        left join (
        select aa.pemda_id, dp.pemda_name,(sp.nom_setoran) as setoran_penyertaan,
                dthn_lalu.nom_thnlalu, 
                case 
                    when aa.total_akhir-dthn_lalu.nom_thnlalu <0 then 0
                else ((aa.total_akhir-dthn_lalu.nom_thnlalu)/dthn_lalu.nom_thnlalu*100)
                end	as persen_grwth
                            from t_saldo_akhir as aa 
                            left join (select sum(zz.total_akhir) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.$tahun.') as tt on tt.periode=aa.tahun

                            left join (select zz.pemda_id,zz.total_akhir as nom_thnlalu ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.($tahun-1).') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id

                            left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
                left join (select sum(nominal_setoran) as nom_setoran , pemda_id from t_setoran where year(tanggal_setoran)='.$tahun.' GROUP BY pemda_id) as sp on sp.pemda_id = aa.pemda_id
                where aa.tahun='.$tahun.' ) as alltotal

        on alltotal.pemda_id = triw1.id


        ';


        $report = DB::select($query);

        return $report;
    }
}
