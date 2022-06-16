<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HistoriesModel extends Model
{
    use HasFactory;

    public static function calculateSetoran($tahun,$pemda_id){

        $result = DB::select('select totakhir.total_akhir, 
        totakhir.pemda_id ,totakhir.tahun , totgrow.total_grow from 
        t_saldo_akhir as totakhir 
        left join(select sum(nominal_setoran) as total_grow, 
        pemda_id from t_setoran where pemda_id='.$pemda_id.' and year(tanggal_setoran)='.$tahun.') as totgrow
        on totakhir.pemda_id= totgrow.pemda_id
        where totakhir.pemda_id= '.$pemda_id.'
        and totakhir.tahun = '.$tahun
        );

        return $result;
    }   


    public static function doAddSetoran($tahun, $nominal, $triwulan){


        
    }


    
    
}
