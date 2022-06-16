<?php

namespace Database\Seeders;

use App\Models\PemdaModel;
use App\Models\SaldoAkhirModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // echo Hash::make('adminsaham123');
        // exit;

        $dataPemda = [
            'Pemprov Sumut',
            "Pemkab Tapsel",
            "Pemkab Simalungun",
            "Pemkab Deli Serdang",
            "Pemkab Labuhanbatu",
            "Pemko Tebing Tinggi",
            "Pemko Medan",
            "Pemkab Tapteng",
            "Pemkab Nias",
            "Pemkab Asahan",
            "Pemkab Taput",
            "Pemko P Siantar",
            "Pemko P Sidimpuan",
            "Pemkab Dairi",
            "Pemko Tanjungbalai",
            "Pemko Sibolga",
            "Pemkab Langkat",
            "Pemkab Madina",
            "Pemkab Pd Lawas",
            "Pemkab Humbahas",
            "Pemkab Toba",
            "Pemkab Karo",
            "Pemko Binjai",
            "Pemkab Sergai",
            "Pemkab Samosir",
            "Pemkab Nias Selatan",
            "Pemkab Pakpak Bharat",
            "Pemkab Paluta",
            "Pemkab Batubara",
            "Pemkab Labura",
            "Pemkab Nias Utara",
            "Pemkab Nias Barat",
            "Pemkab Labusel",
        ];

        for ($i=0; $i < count($dataPemda); $i++) { 
            PemdaModel::create([
                'pemda_name'=>$dataPemda[$i]
            ]);
        }

        
        

        // $saldoTahunLalu = array(
            
        //     [1, 864661550000, 2019],
        //     [2, 173420540000, 2019],
        //     [3, 69294420000, 2019],
        //     [4, 75322890000, 2019],
        //     [5,41797360000, 2019],
        //     [6,43314160000, 2019],
        //     [7,58044590000, 2019],
        //     [8,35532530000, 2019],
        //     [9,34648540000, 2019],

        //     [10,30820350000, 2019],

            
        //     [11,28569480000, 2019],
        //     [12,33666470000, 2019],
        //     [13,48592420000, 2019],
        //     [14,34976730000, 2019],
        //     [15,24710230000, 2019],
        //     [16,31168510000, 2019],
        //     [17,23467580000, 2019],

        //     [18,45562420000, 2019],
        //     [19,13823620000, 2019],
        //     [20,15726660000, 2019],
        //     [21,28556500000, 2019],
        //     [22,9684960000, 2019],
            
        //     [23,13446440000, 2019],
        //     [24,27550100000, 2019],
        //     [25,17273810000, 2019],
        //     [26,20208920000, 2019],
        //     [27,4525310000, 2019],
        //     [28,6658270000, 2019],
            
        //     [29,7631360000, 2019],
        //     [30,10000000000, 2019],
        //     [31,9463830000, 2019],
        //     [32,3465690000, 2019],
        //     [33,6760100000, 2019],


        // );



        
        // for ($i=0; $i < count($saldoTahunLalu); $i++){

        //     SaldoAkhirModel::create([
        //         'pemda_id'=>$saldoTahunLalu[$i][0],
        //         'total_akhir'=>$saldoTahunLalu[$i][1],
        //         'triwulan1'=>0,
        //         'triwulan2'=>0,
        //         'triwulan3'=>0,
        //         'triwulan4'=>0,
        //         'tahun'=>$saldoTahunLalu[$i][2],
        //     ]);


        // }



    }
}
