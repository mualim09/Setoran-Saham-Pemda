<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DashboardModel as dashboardModel;

class DashboardController extends Controller
{
    //
    public function index()
    {

        // $tahun = empty(request('tahun')) ? date('Y') : request('tahun');
        $tahun = 2020;
        // echo json_encode(dashboardModel::persenSaham($tahun));
        // exit;
 

        $data = [];

        $tw1pemkabkot = 0;
        $tw1pemprov = 0;
        $tw2pemkabkot = 0;
        $tw2pemprov = 0;
        $tw3pemkabkot = 0;
        $tw3pemprov = 0;
        $tw4pemkabkot = 0;
        $tw4pemprov = 0;


        $dataPemkabkot = dashboardModel::dataPemprov($tahun, 'pemkabkot');
        $dataPemprov = dashboardModel::dataPemprov($tahun, 'pemprov');
        
       
        $dataPiePemkabkot = dashboardModel::sumSaldoPemda($tahun, 'pemkabkot');
        $dataPiePemprov = dashboardModel::sumSaldoPemda($tahun, 'pemprov');

        foreach ($dataPemkabkot as $kabkot) {
            $tw1pemkabkot += $kabkot->triwulan1;
            $tw2pemkabkot += $kabkot->triwulan2;
            $tw3pemkabkot += $kabkot->triwulan3;
            $tw4pemkabkot += $kabkot->triwulan4;
        }
        foreach ($dataPemprov as $pemprov) {
            $tw1pemprov += $pemprov->triwulan1;
            $tw2pemprov += $pemprov->triwulan2;
            $tw3pemprov += $pemprov->triwulan3;
            $tw4pemprov += $pemprov->triwulan4;
        }



 
        $setoranPenyertaan = DB::select('
        select sum(nominal_setoran) as totakhir from t_setoran where year(tanggal_setoran)='.$tahun.'
        ')[0];

        $data['setoran_penyertaan'] = $setoranPenyertaan->totakhir;


        $data['bar_chart']['pemkabkot'] = [
            'keterangan'=>'Pemerintahan Kabupaten / Kota',
            'data'=>json_encode([$tw1pemkabkot,$tw2pemkabkot,$tw3pemkabkot,$tw4pemkabkot])
     
        ];

        $data['bar_chart']['pemprov'] = [
            'keterangan'=>'Pemprov Sumut',
            'data'=>json_encode([$tw1pemprov,$tw2pemprov,$tw3pemprov,$tw4pemprov])
     
        ];

        $data['pie_chart']['pemkabkot'] = [
            'keterangan'=>'Pemerintahan Kabupaten / Kota',
            'data'=>dashboardModel::persenSaham($tahun)['persenPemkabkot']
            // $dataPiePemkabkot[0]->totakhir
        ];
        $data['pie_chart']['pemprov'] = [
            'keterangan'=>'Pemprov Sumut',
            'data'=>dashboardModel::persenSaham($tahun)['persenPemprov']
           // $dataPiePemprov[0]->totakhir
        ];


        $getPemda = dashboardModel::getPemda($tahun) ;


    
 

        foreach($getPemda as $gp){
            
            $dataTransaksi = dashboardModel::listSetoran($tahun, $gp->pemda_id);

            $persenSahamData = dashboardModel::persenSahamData($tahun, $gp->pemda_id);

            $gp->persen_saham = $persenSahamData->persen_saham;
            
            $gp->persen_growth = $persenSahamData->persen_grwth;
            
            $gp->data = $dataTransaksi;
   
        }


        $data['header'] = 'Setoran Saham | Dashboard';
        $data['dataPemda'] = $getPemda;


        
        $setoranTahunLalu= dashboardModel::sumSaldoPemda(($tahun-1),'');
        $setoranTahunIni = dashboardModel::sumSaldoPemda(($tahun),'');
        
        $data['totalGrowth'] = ($setoranPenyertaan->totakhir / $setoranTahunLalu[0]->totakhir)*100;
        $data['totAllSetoran'] = $setoranTahunIni[0]->totakhir;





        return view(
            'dashboard\index',

            $data
        );
    }
}
