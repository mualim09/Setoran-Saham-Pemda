<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InsertTriwulanController extends Controller
{
    //


    // public function testScheduler1(){
    //     echo 'bisa1';    
    // } 

    // public function testScheduler2(){
    //     echo 'bisa1';  
    // } 


    public function insertTriwulan1(){
        $tahun=date('Y');
        $query = 'UPDATE t_saldo_akhir SET triwulan1 = total_akhir where tahun='.$tahun.'and updated_at=now()'; 
        // $query = 'UPDATE t_saldo_akhir SET triwulan1 = total_akhir where tahun='.date('Y'); 

        $data = [];
        $setToTriwulan = DB::update($query);

        if($setToTriwulan){
            $data['response'] = 'berhasil';
        }else{
            $data['response'] = 'gagal';
        }
        
        return json_encode($data);

    }



    public function insertTriwulan2(){
        $tahun=date('Y');

        $query = 'UPDATE t_saldo_akhir SET triwulan2 = total_akhir where tahun='.$tahun.'and updated_at=now()'; 

        $data = [];
        $setToTriwulan = DB::update($query);

        if($setToTriwulan){
            $data['response'] = 'berhasil';
        }else{
            $data['response'] = 'gagal';
        }
        
        return json_encode($data);


    
    }
    public function insertTriwulan3(){
        $tahun=date('Y');

        $query = 'UPDATE t_saldo_akhir SET triwulan3 = total_akhir where tahun='.$tahun.'and updated_at=now()'; 
        
  
       

        $data = [];
        $setToTriwulan = DB::update($query);

        if($setToTriwulan){
            $data['response'] = 'berhasil';
        }else{
            $data['response'] = 'gagal';
        }
        
        return json_encode($data);

    }
    public function insertTriwulan4(){
        $tahun=date('Y');

        $query = 'UPDATE t_saldo_akhir SET triwulan4 = total_akhir where tahun='.$tahun.'and updated_at=now()'; 
  
        $data = [];
        $setToTriwulan = DB::update($query);

        if($setToTriwulan){
            $data['response'] = 'berhasil';
        }else{
            $data['response'] = 'gagal';
        }

        $data['response_nextyear'] = $this->toNextYear();
        
        return json_encode($data);

    }

    public function toNextYear(){
        // $tahun=date('Y');
        $tahun=2021;
        // $tahun=2021;
        $query = 'SELECT * FROM t_saldo_akhir where tahun='.$tahun;
        $data = [];

        $getPrevYear = DB::select($query);
       

        $insertToNextYear='INSERT into t_saldo_akhir (pemda_id, tahun, triwulan1,triwulan2,triwulan3,triwulan4, total_akhir, created_at)
        values(?,?,?,?,?,?,?,now())';

        foreach($getPrevYear as $gp){
            
            DB::insert($insertToNextYear,[$gp->pemda_id,($tahun+1),0,0,0,0, $gp->total_akhir]) ;

    }
        $data['response'] = 'berhasil';
    
    
    return json_encode($data);

        // return false;
        
        


        

    }
}
