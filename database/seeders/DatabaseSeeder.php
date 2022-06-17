<?php

namespace Database\Seeders;

use App\Models\PemdaModel;
use App\Models\SaldoAkhirModel;
use App\Models\User;
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



        User::create([
            'name'=>'Admin Saham',
            'username'=>'admin',
            'password'=>'$2y$10$5n4H.gn/CQDO.QzxXiTTrOpG.CBSuIHwEGIwElSGOdhhMhp0XLjRa',
        ]);
        
   

    }
}
