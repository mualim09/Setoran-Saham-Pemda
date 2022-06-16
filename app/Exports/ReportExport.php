<?php

namespace App\Exports;

use App\Models\PemdaModel;
use App\Models\ReportModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView; 
use Maatwebsite\Excel\Concerns\FromCollection; 
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet; 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings; 
use Maatwebsite\Excel\Concerns\WithHeadings; 
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Http\Controllers\ReportController as reportData;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromQuery;

class ReportExport implements 
FromView
,WithEvents
// ShouldAutoSize,
// FromQuery,
// WithHeadings,
// WithDrawings,
// WithCustomStartCell
{   

    public function __construct(int $tahun)
    {
        $this->tahun = $tahun;
    }
    public function view(): View
    {

        $tahun = $this->tahun;
       return view('report.laporanexcel', [
            // 'report' => DB::select($query),
            'report' => ReportModel::bigReport($this->tahun),
            'tahun'=>$this->tahun, 
            'kalkulasi'=>ReportController::dataReportExcel($tahun)
        ]);
    }

 
    public function registerEvents(): array
    {

        

        return [
            AfterSheet::class => function (AfterSheet $event) {

                $default_font_style = [
                    'font' => [
                        'name' => '  Times New Roman',
                         'size' => 10,
                         'bold' => true
                    ],
                    'height'=>1000
                ];

        
                

                $headerTable = [
                    'font' => [
                         'bold' => true
                         ]
                ];


                $event->sheet->getStyle('I3')->applyFromArray($default_font_style);
 
 

                $event->sheet->getStyle('A6:AA7')->applyFromArray($headerTable);
                $event->sheet->getStyle('A41:AA41')->applyFromArray($headerTable);
            }
        ];
    }
    
 
}

