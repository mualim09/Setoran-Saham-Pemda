<?php

namespace App\Http\Controllers;

use App\Models\SaldoAkhirModel;
use App\Models\SetoranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetoranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getNamaPemda()
    {
        // var_dump('test');

        $response = DB::table('t_pemda')->where('id', request('kode_pemda'))->first();
        return $response;
    }





    public function index()
    {

       
        $namaPemda = explode('-', request('kodePemda'));


        
        

        
        switch (request('action')) {
            case 'searchpemda':
                if (request('kodePemda') && request('tahun')) {


                    // return false;



                    $listLaporan = DB::table('t_setoran')
                        ->join('t_pemda', 't_setoran.pemda_id', '=', 't_pemda.id')
                        ->select('t_setoran.*', 't_pemda.pemda_name')
                        ->where('t_setoran.pemda_id', '=', $namaPemda[0])
                        ->whereYear('t_setoran.tanggal_setoran', '=', request('tahun'))
                        // ->orderBy('triwulan', 'ASC')
                        ->orderBy('created_at', 'ASC')

                        ->get();

                    // $saldoTahunLalu =  DB::table('t_saldo_akhir')->where('pemda_id','=',$namaPemda[0])->where('tahun', '=', (request('tahun') - 1))->first();
                    $saldoTahunLalu =  DB::select('select * from t_saldo_akhir where pemda_id='.$namaPemda[0].' AND tahun = '.(request('tahun') - 1));
            
                    $totalSaldoTahunLalu = [
                        'all'=>[
                            $this->calculateSaldo((request('tahun') - 1), 'all'),
                            'untuk seluruh pemda'
                        ],

                        'pemkabkot'=>
                        [

                            $this->calculateSaldo( (request('tahun') - 1), 'pemkabkot'),
                            'untuk Semua Pemerintahan Kabupaten / Kota'
                        ],
                        'pemprov'=>[
                            $this->calculateSaldo( (request('tahun') - 1), 'pemprov'),
                            'untuk Pemerintahan Provinsi Sumut'
                        ]

                    ];
                    $totalSaldoTahunSekarang = [
                        'all'=>[
                            $this->calculateSaldoTahunSekarang((request('tahun') ), 'all'),
                            'untuk seluruh pemda'
                        ],

                        'pemkabkot'=>
                        [

                            $this->calculateSaldoTahunSekarang( (request('tahun') ), 'pemkabkot'),
                            'untuk Semua Pemerintahan Kabupaten / Kota'
                        ],
                        'pemprov'=>[
                            $this->calculateSaldoTahunSekarang( (request('tahun')), 'pemprov'),
                            'untuk Pemerintahan Provinsi Sumut'
                        ]

                    ];

                    $totalSaldoAllPemdaByTriwulan = $this->calculateSaldoByTriwulan(request('tahun'));

                    $saltahunlu = 0;
                    if(empty( $saldoTahunLalu[0]->total_akhir)){
                        $saltahunlalu = 1;
                    }else{
                        $saltahunlalu = $saldoTahunLalu[0]->total_akhir;
                    }

                    
                    $totalSaldoWilayah = $this->totalSaldoTahunIni($namaPemda[0], request('tahun'));


                 return view(
                        'page.index',
                        [
                            'hidedata'=>false,
                            'list_setoran' =>$listLaporan,
                            'namaPemda' => $namaPemda[1],
                            // 'saldotahunlalu' => ! $saldoTahunLalu[0]->total_akhir ? :, 
                            'saldotahunlalu' => $saltahunlalu,
                            'tahunLalu' => request('tahun') - 1,
                            'listPemda' => DB::table('t_pemda')->get(),
                            'totalSaldoTahunLalu' =>  $totalSaldoTahunLalu ,
                            'totalSaldoTahunSekarang'=>$totalSaldoTahunSekarang,

                            'totalSaldoAllPemdaByTriwulan'=>$totalSaldoAllPemdaByTriwulan,

                            'totalSaldoWilayah'=>$totalSaldoWilayah

                        ]
                    );
                } else {
                    return redirect('/setoran');

                }

            default:
                
                $listLaporan = DB::table('t_setoran')
                    ->join('t_pemda', 't_setoran.pemda_id', '=', 't_pemda.id')
                    ->select('t_setoran.*', 't_pemda.pemda_name')
                    // ->where('t_setoran.pemda_id','=',1)
                    ->orderBy('triwulan', 'ASC')

                    ->get();

                return view(
                    'page.index',
                    [
                        'hidedata'=>true,
                        'list_setoran' => null,
                        'namaPemda' => null,
                        // 'bgcolor' => null,
                        'saldotahunlalu' => null,
                        'saldotahunlalu' => null,
                        'listPemda' => DB::table('t_pemda')->get()

                    ]
            );

 
        }
    }

    function totalSaldoTahunIni($pemda_id, $tahun){

        $query = 'SELECT *  FROM t_saldo_akhir WHERE pemda_id='
        .$pemda_id.' AND tahun = '.$tahun ;

        return DB::select($query);

    }


   //menampilkan  
    // function calculateSaldo($tahun, $filterBy, $triwulan){
    function calculateSaldo($tahun, $filterBy){

        $queries = '';

        // count all pemda
        $pemdaFilter = $filterBy=='pemkabkot' ? "AND pemda_id > 1": ($filterBy=='pemprov' ? "AND pemda_id = 1" : '');
        $queries = 'SELECT sum(total_akhir) as total_akhir from t_saldo_akhir where tahun='.$tahun.' '.$pemdaFilter;

        // var_dump($queries);
        return DB::select($queries)[0]->total_akhir;
    }





    function calculateSaldoByTriwulan($tahun){

        $varTahunLalu = DB::select('SELECT sum(total_akhir) as total_tahun_lalu from t_saldo_akhir WHERE tahun = '.($tahun-1));
                    
 
        $totAllPemdaTahunLalu = $varTahunLalu[0]->total_tahun_lalu;

        
        $sumNominalAllPemda = DB::select('SELECT SUM(nominal_setoran) as 
        total_nominal , triwulan FROM t_setoran WHERE 
        year(tanggal_setoran) = '.request('tahun').' GROUP BY triwulan');

        
        $afterCalculate = 0;
        for($i=0;$i<count($sumNominalAllPemda);$i++){
            
            // var_dump($sumNominalAllPemda[$i]->total_nominal).'</br>';

            if($sumNominalAllPemda[$i]->triwulan==1){
                
                // echo  'Hitungan saldo akhir di triwulan 1<br>';
                $sumNominalAllPemda[$i]->total_nominal= $sumNominalAllPemda[$i]->total_nominal + $totAllPemdaTahunLalu ;
                
                
                $afterCalculate += $sumNominalAllPemda[$i]->total_nominal;
                
                
            
                
            }
            
            else{
                    $sumNominalAllPemda[$i]->total_nominal = $sumNominalAllPemda[$i]->total_nominal + $afterCalculate ;
                    // $anu= $sumNominalAllPemda[$]->total_nominal + $afterCalculate ;
                    // var_dump($anu); 
                    // var_dump($sumNominalAllPemda[$i]->total_nominal);
                
                // echo '<br>'.$sumNominalAllPemda[$i]->total_nominal;                        
            }
        
        }


        return $sumNominalAllPemda;
        // ;



        
        

    }



    // function getPersenSaham($saldoAkhir=0, $triwulan=0){
    function getPersenSaham($saldoAkhirByTriwulan, $jnsTriwulan, $tahun){
        
        $query = 'select * from t_setoran where triwulan = '.$jnsTriwulan.' AND year(tanggal_setoran)='.$tahun;
        // $query = "select * from t_setoran where triwulan = ".$jnsTriwulan."AND tahun="+$tahun;



        $exectQuery = DB::select($query);

        // $allSaldoTahunIniByTriwulan =  
        // DB::select('select * from t_setoran where year(tanggal_setoran)='.($tahun-1).' AND triwulan = '.$jnsTriwulan);
        
        // DB::table('t_setoran')
        //                 ->whereYear('t_setoran.tanggal_setoran', '<=', $tahun)
        //                 ->where('t_setoran.triwulan','=',$jnsTriwulan );
                        // ->sum('nominal_setoran');

        // return 'saldo  '.$saldoAkhirByTriwulan .' : triwulan '.$jnsTriwulan;
        
        // return $exectQuery; 
        // return json_encode($allSaldoTahunLaluByTriwulan);
        
        $result =array(

            $exectQuery
        )

        ;
        
        return json_encode($result); 
 
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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


        $dataLama  = DB::table('t_setoran')
        ->select('t_setoran.*')
        ->where('t_setoran.pemda_id', '=', $request->input('pemda_id'))
        ->whereYear('t_setoran.tanggal_setoran', '=', $bulanSetoran[0])
        // ->orderBy('triwulan', 'ASC')
        ->orderBy('created_at', 'ASC')

        ->get();

        $totalByDaerah = 0;

        foreach ($dataLama as $dl){
            $totalByDaerah += $dl->nominal_setoran; 
        }

 

        $nominalSetoran = floatval(str_replace(".", "", $request->input('nominal_setoran')));

        
        $saldoTahunLalu =  DB::select('select * from t_saldo_akhir where pemda_id='.$request->input('pemda_id').' AND tahun = '.($bulanSetoran[0] - 1));
 
        $salTahunLalu = DB::select('select * from
        t_saldo_akhir where pemda_id = '.$request->input('pemda_id').' AND tahun = '.($bulanSetoran[0]-1))[0];

        // var_dump($salTahunLalu->total_akhir);
        // return false;


        $setoranData=[];

        $totSaldoAkhir = $nominalSetoran +$salTahunLalu->total_akhir ;
 
     
        
       $setoranData = [
        'pemda_id' => $request->input('pemda_id'),
        'tanggal_setoran' => $request->input('tanggal_setoran'),
        'triwulan' => $triwulan,
        'nominal_setoran' =>$nominalSetoran ,
        'dbcr'=>$request->input('jnsSetoran'),
        // 'total_setoran'=>$totSaldoAkhir
        'total_setoran'=>0

        ];

        
       

        $selectQuery = 'SELECT * FROM t_saldo_akhir where pemda_id='.$request->input('pemda_id').' AND tahun = '.$bulanSetoran[0];
        // $selectQuery = 'SELECT * FROM t_saldo_akhir where pemda_id= 1 AND tahun = 2022';
        // var_dump(DB::select($selectQuery));
        // var_dump(DB::select($selectQuery));
        // return false;

        if(empty(DB::select($selectQuery))){
        
            $insertNewData = [
                'pemda_id'=>$request->input('pemda_id'),
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

             // var_dump($saldoPrevYear );
            //  DB::update('UPDATE t_saldo_akhir set total_akhir = total_akhir + ?  where pemda_id= ? and tahun = ?',
            //  [($nominalSetoran), $request->input('pemda_id'), $bulanSetoran[0] ] );
             
            // DB::update('UPDATE t_saldo_akhir set total_akhir = total_akhir + ?  where pemda_id= ? and tahun = ?',
            //  [($totSaldoAkhir), $request->input('pemda_id'), $bulanSetoran[0] ] );




            // $saldoPrevYear = DB::select('select * from t_saldo_akhir where pemda_id=' .$request->input('pemda_id').' AND tahun = '.($bulanSetoran[0] - 1) );
            // $saldoPrevYear = DB::select('select * from t_saldo_akhir where pemda_id=' .$request->input('pemda_id').' AND tahun = '.($bulanSetoran[0]) );

           
             
            
            
            DB::update('UPDATE t_saldo_akhir set total_akhir = ? + ?  where pemda_id= ? and tahun = ?',
             [ $salTahunLalu->total_akhir+ $nominalSetoran , $totalByDaerah, $request->input('pemda_id'), $bulanSetoran[0] ] );
            
            // $setToTriwulan = '';
            // if($triwulan==1){
            //     $setToTriwulan = 'set triwulan1 = ';
            // }else if($triwulan==2){
            //     $setToTriwulan = 'set triwulan2 = ';
            // }else if($triwulan==3){
            //     $setToTriwulan = 'set triwulan3 = ';
            // }else if($triwulan==4){
            //     $setToTriwulan = 'set triwulan4 = ';
            // }else{
            //     $setToTriwulan = '';
            // }


            //  DB::update('UPDATE t_saldo_akhir '.$setToTriwulan.' ? + ?  where pemda_id= ? and tahun = ?',
            //  [ $saldoPrevYear[0]->total_akhir+ $nominalSetoran, $totalByDaerah, $request->input('pemda_id'), $bulanSetoran[0] ] );


                return redirect()->back()->withInput()->with('success', 'Data setoran berhasil ditambahkan');

        



        // if (!DB::select($selectQuery)){
        //     var_dump('ada');
        // }
        // $test = DB::update('update t_saldo_akhir set triwulan1 = ? +  where pemda_id = ? AND tahun=?');

        // return $test;

        // if(SetoranModel::create($setoranData)){

        //     // return redirect()->back()->withInput()->with('success', 'Data setoran berhasil ditambahkan');
        // }else{
        //     // return redirect()->back()->withInput()->with('error', 'Maaf , data anda tidak masuk');
        // }

    

        
        // $checkData = DB::table('t_setoran')
        // ->where('pemda_id', '=', $request->input('pemda_id'))
        // ->whereYear('tanggal_setoran', '=', $bulanSetoran[0])
        // ->where('triwulan', '=', $triwulan)
        // ->first();
        // if (!empty($checkData)) {
        //     return redirect()->back()->withInput()->with('error', 'Maaf , untuk triwulan yang dimasukkan sudah ada');
        // }
 


    //    $prevTriwulan = DB::table('t_setoran') 
    //    ->where('triwulan', '!=', $triwulan)
    //    ->where('pemda_id', '=', $request->input('pemda_id'))
    //    ->whereYear('tanggal_setoran', '=', $bulanSetoran[0])
    //    ->sum('nominal_setoran')
    //    ;

    //    $total = $prevTriwulan + floatval(str_replace(".", "", $request->input('nominal_setoran')));


 
       
    }


    public function setPersenSaham($total,$tahun,$triwulan ){

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SetoranModel  $setoranModel
     * @return \Illuminate\Http\Response
     */
    public function show(SetoranModel $setoranModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SetoranModel  $setoranModel
     * @return \Illuminate\Http\Response
     */
    public function edit(SetoranModel $setoranModel)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SetoranModel  $setoranModel
     * @return \Illuminate\Http\Response
     */

























     
    // public function update(Request $request, SetoranModel $setoranModel)
    // {

    //     // dd($request);
    //     // return false;
    //     $nominal_baru = floatval(str_replace(".", "", $request->input('nominal_baru')));
    //     $nominal_lama = floatval(str_replace(".", "", $request->input('nominal_lama')));
    //     $tahunSetoran = (explode('-', $request->input('tanggal_setoran'))[0]);
    //     $pemdaId = $request->input('pemda_id');
        
    //     // var_dump($tahunSetoran);
    //     // var_dump($nominal_baru);

    //     // var_dump($nominal_lama);
    //     // return false;
    //     //
    //     $idData =(request()->segments())[1]; 


    //     // var_dump($idData);

        

    //     // lakukan update di table t_setoran
    //      DB::update('UPDATE t_setoran set nominal_setoran = ? where id=?',
    //     [$nominal_baru ,$idData]);
        
    //     //kurangi total akhit dengan moninal lama 
    //      DB::update('UPDATE t_saldo_akhir set total_akhir = total_akhir - ? where pemda_id = ? AND tahun = ?',
    //     [$nominal_lama ,$pemdaId , $tahunSetoran]);

    //     // tambahkan total akhit dengan moninal baru 
    //      DB::update('UPDATE t_saldo_akhir set total_akhir = total_akhir + ? where pemda_id = ? AND tahun = ?',
    //     [$nominal_baru ,$pemdaId , $tahunSetoran]);

    //     return redirect()->back()->withInput()->with('success', 'Berhasil Edit Data Setoran');
 

    // }


















    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SetoranModel  $setoranModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

        // var_dump($setoranModel->id);
        $idData =(request()->segments())[1]; 


        $findData = DB::select('SELECT * FROM t_setoran WHERE id='.$idData)[0];


        // var_dump($findData);
        // var_dump($idData);
        
        $nominal_setoran =  $findData->nominal_setoran;
        $tahunSetoran = (explode('-', $findData->tanggal_setoran)[0]);
        $pemdaId = $findData->pemda_id;
 

        // kurangi nominal karena data bakal dihapus
        DB::update('UPDATE t_saldo_akhir set total_akhir = total_akhir - ? where pemda_id = ? AND tahun = ?',
            [$nominal_setoran ,$pemdaId , $tahunSetoran]);
 

        //hapus data setoran di t_setoran
        DB::delete('delete from t_setoran where id= ?',[$idData]);
 
        return redirect()->back()->withInput()->with('success', 'Berhasil hapus Data Setoran');

    }
}
