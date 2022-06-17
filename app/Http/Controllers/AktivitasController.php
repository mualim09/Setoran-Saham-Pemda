<?php

namespace App\Http\Controllers;

use App\Models\HistoriesModel as historiesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SaldoAkhirModel;
use App\Models\SetoranModel;

class AktivitasController extends Controller
{
    //

    public function index(){


        return view('aktivitas.index',[
            'showData'=>false,
            'listPemda' => DB::table('t_pemda')->get(),
            'reportPemda'=>[]
        ]);
    }

    
    public function store(Request $request){

 
        


        $bulanKeTriwulan = [
            '01' => 1,
            '02' => 1,
            '03' => 1,
            '04' => 2,
            '05' => 2,
            '06' => 2,
            '07' => 3,
            '08' => 3,
            '09' => 3,
            '10' => 4,
            '11' => 4,
            '12' => 4,
        ];




        $bulanSetoran = explode('-', $request->input('tanggal_setoran'));
 
        $triwulan = $bulanKeTriwulan[$bulanSetoran[1]];
        $tahun = $bulanSetoran[0];


        $dataLama  = DB::table('t_setoran')
        ->select('t_setoran.*')
        ->where('t_setoran.pemda_id', '=', $request->input('kodePemda'))
        ->whereYear('t_setoran.tanggal_setoran', '=', $bulanSetoran[0])
 
        ->orderBy('created_at', 'ASC')

        ->get();

        $totalByDaerah = 0;

        foreach ($dataLama as $dl){
            $totalByDaerah += $dl->nominal_setoran; 
        }

 
       

        $nominalSetoran = floatval(str_replace(".", "", $request->input('nominal_setoran')));


        $setoranData=[];


        // $totSaldoAkhir = $nominalSetoran +$salTahunLalu->total_akhir ;

 
        
       $setoranData = [
        'pemda_id' => $request->input('kodePemda'),
        'tanggal_setoran' => $request->input('tanggal_setoran'),
        'triwulan' => $triwulan,
        'nominal_setoran' =>$nominalSetoran ,
        

        ];

        // return redirect('/histories/?kodePemda=12131321');
        // exit;
 

       

        $selectQuery = 'SELECT * FROM t_saldo_akhir where pemda_id='.$request->input('kodePemda').' AND tahun = '.$bulanSetoran[0];
        if(empty(DB::select($selectQuery))){
        
            $insertNewData = [
                'pemda_id'=>$request->input('kodePemda'),
                'tahun'=>$bulanSetoran[0],
                'triwulan1'=>0,
                'triwulan2'=>0,
                'triwulan3'=>0,
                'triwulan4'=>0,
                'total_akhir'=>0,
            ];

            SaldoAkhirModel::create($insertNewData);


        }

            


            SetoranModel::create($setoranData);

            // tambah di satu data
            historiesModel::tambahSetoran($tahun,$request->input('tanggal_setoran'),$nominalSetoran,$request->input('kodePemda'),$triwulan);

             if($request->input('kodePemda')){
                $showData = true;
    
                $reportLaporan  = DB::select('SELECT * FROM t_setoran WHERE pemda_id = '.$request->input('kodePemda'). ' AND year(tanggal_setoran) = '.$bulanSetoran[0]);
            }else{
                $showData = false;
                $reportLaporan=[];  
            }
  
            $sharedData = [
                'showData'=>$showData,
                'reportPemda'=>$reportLaporan,
                'listPemda' => DB::table('t_pemda')->get(),
                'success'=>'Data setoran berhasil ditambahkan'
            ];
 
            return redirect('/histories?kodePemda='.$request->input('kodePemda').'&tahun='. $tahun.'&action=searchpemda')->with($sharedData);
        

            
 
 
    }


}
