<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SetoranModel;
use App\Models\HistoriesModel as historiesModel;

class HistoriesController extends Controller
{

    public function index(){



        switch (request('action')) {    
            case 'searchpemda':
                if (request('kodePemda') && request('tahun')) {

                    $namaPemda = DB::select('select * from t_pemda where id='.request('kodePemda'))[0]->pemda_name;
                    
                    $listLaporan = DB::table('t_setoran')
                        ->join('t_pemda', 't_setoran.pemda_id', '=', 't_pemda.id')
                        ->select('t_setoran.*', 't_pemda.pemda_name')
                        ->where('t_setoran.pemda_id', '=', request('kodePemda'))
                        ->whereYear('t_setoran.tanggal_setoran', '=', request('tahun'))
                        
                        ->orderBy('tanggal_setoran', 'DESC')

                        ->get();

                    $saldoTahunLalu =  DB::select('select * from t_saldo_akhir where pemda_id='.request('kodePemda').' AND tahun = '.(request('tahun') - 1));
                    
                    
                    
      

                    $saltahunlu = 0;
                    if(empty( $saldoTahunLalu[0]->total_akhir)){
                        $saltahunlalu = 1;
                    }else{
                        $saltahunlalu = $saldoTahunLalu[0]->total_akhir;
                    }


                $calculateSetoran = historiesModel::calculateSetoran(request('tahun'),request('kodePemda'));
                
                
                $hitungSetoranTahunLalu = historiesModel::calculateSetoran((request('tahun')-1),request('kodePemda'));

       


                 return view(
                        'histories.index',
                        [
                            'hidedata'=>false,
                            'list_setoran' =>$listLaporan,
                            'namaPemda' => $namaPemda,
                            // 'saldotahunlalu' => ! $saldoTahunLalu[0]->total_akhir ? :, 
                            'saldotahunlalu' => $saltahunlalu,
                            'tahunLalu' => request('tahun') - 1,
                            'listPemda' => DB::table('t_pemda')->get(),
                            'statistikSetoran'=>(empty($calculateSetoran[0])?0:$calculateSetoran[0]->total_akhir),
                            'total_grow'=>(empty($calculateSetoran[0])?0:$calculateSetoran[0]->total_grow),
                            'statistikTahunLalu'=>(empty($hitungSetoranTahunLalu[0])?1:$hitungSetoranTahunLalu[0]->total_akhir ),  
                            'header'=>'Setoran Saham | Histories'
                     

                        ]);





                }else{
                    return redirect('/setoran');
                }

            default :
            $listLaporan = DB::table('t_setoran')
                ->join('t_pemda', 't_setoran.pemda_id', '=', 't_pemda.id')
                ->select('t_setoran.*', 't_pemda.pemda_name')
                // ->where('t_setoran.pemda_id','=',1)
                ->orderBy('triwulan', 'ASC')

                ->get();

            return view(
                'histories.index',
                [
                    'hidedata'=>true,
                    'list_setoran' => null,
                    'namaPemda' => null,
                    // 'bgcolor' => null,
                    'saldotahunlalu' => null,
                    'saldotahunlalu' => null,
                    'listPemda' => DB::table('t_pemda')->get(),
                    'header'=>'Setoran Saham | Histories'
                ]
        );
            }


        return view('histories.index',[
            'listPemda'=>DB::table('t_pemda')->get(),
            'header'=>'Setoran Saham | Histories'

        ]);
    }


    public function update(Request $request, SetoranModel $setoranModel)
    {

         


        $nominal_baru = floatval(str_replace(".", "", $request->input('nominal_baru')));
        $nominal_lama = floatval(str_replace(".", "", $request->input('nominal_lama')));
        $tahunSetoran = (explode('-', $request->input('tanggal_setoran'))[0]);
        $pemdaId = $request->input('pemda_id');
        $triwulan = $request->input('triwulan');

        
        $idData =(request()->segments())[1]; 



        // lakukan update di table t_setoran
         DB::update('UPDATE t_setoran set nominal_setoran = ? where id=?',
        [$nominal_baru ,$idData]);


        
        //kurangi total akhit dengan moninal lama 
        historiesModel::kurangiSetoran($tahunSetoran,$request->input('tanggal_setoran'),$nominal_lama,$pemdaId, $triwulan);

        // tambahkan total akhit dengan moninal baru 
        historiesModel::tambahSetoran($tahunSetoran,$request->input('tanggal_setoran'),$nominal_baru,$pemdaId,$triwulan);


        return redirect()->back()->withInput()->with('success', 'Berhasil Edit Data Setoran');
 

    }

    public function destroy(Request $request)
    {
        $idData =(request()->segments())[1]; 


        $findData = DB::select('SELECT * FROM t_setoran WHERE id='.$idData)[0];


        $nominal_setoran =  $findData->nominal_setoran;
        $tahunSetoran = (explode('-', $findData->tanggal_setoran)[0]);
        $pemdaId = $findData->pemda_id;
        $triwulan = $findData->triwulan;
 

        historiesModel::kurangiSetoran($tahunSetoran,$findData->tanggal_setoran,$nominal_setoran,$pemdaId ,$triwulan);


        DB::delete('delete from t_setoran where id= ?',[$idData]);
 
        return redirect()->back()->withInput()->with('success', 'Berhasil hapus Data Setoran');

    }

}
