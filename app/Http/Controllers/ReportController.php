<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App;
use App\Exports\ReportExport;
use App\Models\ReportModel as reportModel;

// use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{


    public function index()
    {

        $tahun = request('tahun')==null ? date('Y') :request('tahun');

        
      


        switch (request('action')) {
            case 'searchreport':

                $setoranPenyertaan = DB::select(
                    '
                select sum(nominal_setoran) as totakhir from t_setoran where pemda_id = ' . request('kodePemda') . ' and YEAR(tanggal_setoran) 
                =' . $tahun
                )[0];
        
                $reportSaldo = DB::select('select * from t_saldo_akhir where pemda_id = ' . request('kodePemda')
                    . ' and tahun = ' . $tahun);
                // $reportSetoran =
                $reportSetoran = DB::select('
                select * from t_setoran where pemda_id = ' . request('kodePemda')
                    . ' and YEAR(tanggal_setoran) = ' . $tahun);
        
 

                $allPemda = request('kodePemda') == 0 ? true : false;

                

                if($allPemda==true){
                    $data = $this->callAllData($tahun);
                    
                }else{
                    $data=[];
                }
           

                return view('report.index', [
                    'header'=>'Setoran Saham | Report',
                    'report_saldo' => $reportSaldo,
                    'report_setoran' => $reportSetoran,
                    'hidedata' => false,
                    'listPemda' => DB::table('t_pemda')->get(),
                    'setoranPenyertaan' => $setoranPenyertaan->totakhir,
                    'allPemda' => $allPemda,
                    'dataSetoran' => $data  
                ]);
                break;

                
                case 'printreport':

                    switch(request('format')){

                        case 'pdf':
                            $data = $this->callAllData($tahun);
            
                            $pdf = PDF::loadview('report.laporanpdf', $data)->setPaper('a3', 'landscape') ;
                        
                        return $pdf->download('report_setoran_'.request('tahun').'.pdf');
                            // return $pdf->stream();
                            // return view('report.laporanpdf', $data);
        
                        break;
                        case 'excel':
                            // echo json_encode(PemdaModel::all());
                            // echo 'excel';
                            return Excel::download(new ReportExport($tahun), 'data_setoran.xlsx');
                            
                            // // // echo json_encode($report);
                            // // exit;
                            // $report = reportModel::bigReport($tahun);
                            // $data=[
                            //     'report'=>$report,
                            //     'kalkulasi'=>ReportController::callAllData($tahun), 
                            //     'tahun'=>$tahun
                            // ];
                            // return view('report.laporanexcel',$data );



                            // return $this->callAllData($tahun);
                        break;
                    }

                break;




            
                default:

                $data = [];
        
                    

                return view('report.index', [
                    'header'=>'Setoran Saham | Report',
                    'report_saldo' => null,
                    'report_setoran' => null,
                    'hidedata' => true,
                    'listPemda' => DB::table('t_pemda')->get(),
                    'allPemda' => false,
                    'dataSetoran'=>$data== null? null : $data,

                ]);

                break;
        }

 
 
    }

    public static function callAllData($tahun){
        
        $data = [];
        
        $data['reportSahamPemda'] = reportModel::bigReport($tahun);
        $data['tahun_lalu'] = reportModel::getReportTahunLalu(($tahun-1));
        $data['kalkulasi']['triwulan1'] = reportModel::getReportAllPemda(1, $tahun);
        $data['kalkulasi']['triwulan2'] = reportModel::getReportAllPemda(2, $tahun);
        $data['kalkulasi']['triwulan3'] = reportModel::getReportAllPemda(3, $tahun);
        $data['kalkulasi']['triwulan4'] = reportModel::getReportAllPemda(4, $tahun);
        $data['growth'] = reportModel::getHasilAkhir($tahun);

        return $data;


    }


    public static function dataReportExcel($tahun){
        
        $data['tahun_lalu'] = reportModel::getReportTahunLalu(($tahun-1));
        $data['kalkulasi']['triwulan1'] = reportModel::getReportAllPemda(1, $tahun);
        $data['kalkulasi']['triwulan2'] = reportModel::getReportAllPemda(2, $tahun);
        $data['kalkulasi']['triwulan3'] = reportModel::getReportAllPemda(3, $tahun);
        $data['kalkulasi']['triwulan4'] = reportModel::getReportAllPemda(4, $tahun);
        $data['growth'] = reportModel::getHasilAkhir($tahun);

        return $data;
    }

    // function singkat_angka($n, $presisi=1) {
    //     if ($n < 900) {
    //         $format_angka = number_format($n, $presisi);
    //         $simbol = '';
    //     } else if ($n < 900000) {
    //         $format_angka = number_format($n / 1000, $presisi);
    //         $simbol = 'rb';
    //     } else if ($n < 900000000) {
    //         $format_angka = number_format($n / 1000000, $presisi);
    //         $simbol = 'jt';
    //     } else if ($n < 900000000000) {
    //         $format_angka = number_format($n / 1000000000, $presisi);
    //         $simbol = 'M';
    //     } else {
    //         $format_angka = number_format($n / 1000000000000, $presisi);
    //         $simbol = 'T';
    //     }
     
    //     if ( $presisi > 0 ) {
    //         $pisah = '.' . str_repeat( '0', $presisi );
    //         $format_angka = str_replace( $pisah, '', $format_angka );
    //     }
        
    //     return $format_angka . $simbol;
    // }
     
    //penggunaan fungsi singkat angka
    // echo singkat_angka(8800);
   
}




