<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class DashboardModel extends Model
{
    use HasFactory;


    public static function persenSaham($tahun){
        $totalAll = DB::select('select sum(total_akhir) as totakhir from t_saldo_akhir where tahun = '.$tahun);
        $totalPemkabkot = DB::select('select sum(total_akhir) as totakhir from t_saldo_akhir where tahun = '.$tahun.' and pemda_id>1');
        $totalPemprov = $totalAll[0]->totakhir- $totalPemkabkot[0]->totakhir;
        $persenSahamPemprov= ($totalPemprov/ $totalAll[0]->totakhir)*100;
        $persenSahamPemkabkot = ($totalPemkabkot[0]->totakhir / $totalAll[0]->totakhir)*100; 
        $data=[
            'totalAll'=>$totalAll[0]->totakhir,
            'totalPemkabkot'=>$totalPemkabkot[0]->totakhir,

            'totalPemprov'=>$totalPemprov,
            
            'persenPemprov'=>number_format($persenSahamPemprov,2),
            'persenPemkabkot'=>number_format($persenSahamPemkabkot,2),
        ];


        return $data;

    }

    public static function dataPemprov($tahun,$pemda){

        if($pemda=='pemprov'){
            $pemda='and pemda_id=1';
        }else if($pemda=='pemkabkot'){
            $pemda='and pemda_id>1';
        }else{
            $pemda='';
        }

        $result = DB::select('select * from t_saldo_akhir where tahun = '.$tahun.' '.$pemda);
        // $result  = 'select * from t_saldo_akhir where tahun = '.$tahun.' '.$pemda;
        return $result;
        
    }

    public static function sumSaldoPemda($tahun,$pemda){
        if($pemda=='pemprov'){
            $pemda='and pemda_id=1';
        }else if($pemda=='pemkabkot'){
            $pemda='and pemda_id>1';
        }else{
            $pemda='';
        }

        $result = DB::select('select sum(total_akhir) as totakhir from t_saldo_akhir where tahun = '.$tahun.' '.$pemda);
        return $result;
    }

    public static function getPemda($tahun){

        $result =  DB::select('select a.id, a.pemda_name, b.* from t_pemda a
        left join t_saldo_akhir b 
        on a.id = b.pemda_id
        where b.tahun=
        '.$tahun.' group by a.id');

        return $result;
    }


    public static function persenSahamData($tahun,$pemda_id){

        $result = DB::select('
        select dp.pemda_name,
        tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100 as  persen_saham, dthn_lalu.nom_thnlalu, 
        case 
        when aa.total_akhir-dthn_lalu.nom_thnlalu <0 then 0
            else ((aa.total_akhir-dthn_lalu.nom_thnlalu)/dthn_lalu.nom_thnlalu*100)
        end	as persen_grwth
        from t_saldo_akhir as aa 
        left join (select sum(zz.total_akhir) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.$tahun.') as tt on tt.periode=aa.tahun

        left join (select zz.pemda_id,zz.triwulan4 as nom_thnlalu ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.($tahun-1).') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id

        left join (select * from t_pemda) as dp on dp.id = aa.pemda_id

        where aa.tahun='.$tahun.'
        and aa.pemda_id='.$pemda_id
        )[0];
        return $result;
    }

    public static function listSetoran($tahun, $pemda_id){
        $result=  DB::select('SELECT triwulan, nominal_setoran, pemda_id, tanggal_setoran FROM t_setoran where pemda_id='.$pemda_id.' and year(tanggal_setoran)='.$tahun);
    
        return $result;
    }




}
