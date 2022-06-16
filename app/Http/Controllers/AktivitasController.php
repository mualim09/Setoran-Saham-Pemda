<?php

namespace App\Http\Controllers;

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

        // var_dump($request->input('kodePemda'));
        // var_dump($request->input('nominal_setoran'));
        // var_dump($request->input('tanggal_setoran'));
        // $bulanSetoran = explode('-', $request->input('tanggal_setoran'));
        // $tahun = $bulanSetoran[0];
        // var_dump($tahun);
        // exit;
        // $triwulan = $bulanKeTriwulan[$bulanSetoran[1]];

        


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

            $queryTriwulan='';

            if($triwulan==1){
                $queryTriwulan='triwulan1 = triwulan1 + ?';
            }else if($triwulan==2){
                $queryTriwulan='triwulan2 = triwulan2 + ?';
            }else if($triwulan==3){
                $queryTriwulan='triwulan3 = triwulan3 + ?';
            }else if($triwulan==4){
                $queryTriwulan='triwulan4 = triwulan4 + ?';
            }


            SetoranModel::create($setoranData);

            // tambah di satu data
            //  DB::update('UPDATE t_saldo_akhir set total_akhir = total_akhir + ? , '.$queryTriwulan.' where pemda_id= ? and tahun = ?',
            //  [($nominalSetoran),($nominalSetoran), $request->input('kodePemda'), $bulanSetoran[0] ] );


            DB::update("
            UPDATE t_saldo_akhir set 
                triwulan1 = 
                    case 
                        when triwulan1 = 0 
                            then triwulan1 + 0
                                
                        else 
                        
                            
                                CASE 
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=3) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan1 + ".$nominalSetoran."
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=6) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan1 + 0
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=9) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan1 + 0
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=12) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan1 + 0
                                        else triwulan1 + ".$nominalSetoran."
                                END 
                            
                    end	
                ,
                triwulan2 = 
                    case 
                        when triwulan2 = 0 
                            then triwulan2 + 0
                                
                        else 
                        
                            
                                CASE 
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=3) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan2 + 0
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=6) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan2 + ".$nominalSetoran."
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=9) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan2 + 0
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=12) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan2 + 0	
                                        else triwulan2 + ".$nominalSetoran."
                                END 
                            
                    end	
                ,
                triwulan3 = 
                    case 
                        when triwulan3 = 0 
                            then triwulan3 + 0
                                
                        else 
                        
                            
                                CASE 
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=3) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan3 + 0
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=6) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan3 + 0
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=9) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan3 + ".$nominalSetoran."
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=12) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan3 + 0
                                        else triwulan3 + ".$nominalSetoran."
                                END 
                            
                    end	
                ,
                triwulan4 = 
                    case 
                        when triwulan4 = 0 
                            then triwulan4 + 0
                                
                        else 
                        
                            
                                CASE 
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=3) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan4 + 0
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=6) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan4 + 0
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=9) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan4 + 0
                                        WHEN( (month('".$request->input('tanggal_setoran')."')<=12) AND (YEAR('".$request->input('tanggal_setoran')."')=tahun) ) THEN triwulan4 + ".$nominalSetoran."
                                        else triwulan4 + ".$nominalSetoran."
                                END 
                            
                    end	
                ,
                total_akhir = total_akhir+ ".$nominalSetoran." where pemda_id= ".$request->input('kodePemda')." and tahun between ".$tahun."  and ".date('Y')."

        "
        );   



        




             if($request->input('kodePemda')){
                $showData = true;
    
                $reportLaporan  = DB::select('SELECT * FROM t_setoran WHERE pemda_id = '.$request->input('kodePemda'). ' AND year(tanggal_setoran) = '.$bulanSetoran[0]);
            }else{
                $showData = false;
                $reportLaporan=[];  
            }
 
                // return redirect()->back()->withInput()->with('success', 'Data setoran berhasil ditambahkan');

            $sharedData = [
                'showData'=>$showData,
                'reportPemda'=>$reportLaporan,
                'listPemda' => DB::table('t_pemda')->get(),
                'success'=>'Data setoran berhasil ditambahkan'
            ];

            // return redirect()

            // return redirect(route('/aktivitas')->with('success','Data setoran berhasil ditambahkan'));

            // return redirect(route('aktivitasku'), $sharedData)->with('success','Data setoran berhasil ditambahkan');

            
            // return redirect()->back()->with('success', 'Data setoran berhasil ditambahkan');
            // return redirect()->back()->with($sharedData);
            return redirect('/histories?kodePemda='.$request->input('kodePemda').'&tahun='. $tahun.'&action=searchpemda')->with($sharedData);
        

            
            // return view(
            //     'aktivitas.index',[
            //         'showData'=>$showData,
            //         'reportPemda'=>$reportLaporan,
            //         'listPemda' => DB::table('t_pemda')->get()
            //     ]
            // )->with('success', 'Data setoran berhasil ditambahkan');



 
    }


}
