<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StatistikController extends Controller
{
    //

    public function index(){
 
        $tahun = empty(request('tahun')) ? date('Y'): request('tahun') ;
 
        
        $dataStatistik = DB::select(
            '
            select dp.pemda_name, aa.* ,
tt.jlh_semua,(aa.total_akhir/tt.jlh_semua)*100 as  persen_saham, dthn_lalu.nom_thnlalu, 
case 
  when aa.total_akhir-dthn_lalu.nom_thnlalu <0 then 0
	else ((aa.total_akhir-dthn_lalu.nom_thnlalu)/dthn_lalu.nom_thnlalu*100)
end	as persen_grwth
from t_saldo_akhir as aa 
left join (select sum(zz.total_akhir) as jlh_semua,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.$tahun.') as tt on tt.periode=aa.tahun

left join (select zz.pemda_id,zz.triwulan4 as nom_thnlalu ,zz.tahun as periode from t_saldo_akhir zz where zz.tahun='.($tahun-1).') as dthn_lalu on dthn_lalu.pemda_id=aa.pemda_id
left join (select * from t_pemda) as dp on dp.id = aa.pemda_id
where aa.tahun= '.$tahun.'
            '
        
            )
        
        ;
        
     


        return view('statistik.index', [

            'dataStatistik'=>$dataStatistik
        ]
    );



    }
}
