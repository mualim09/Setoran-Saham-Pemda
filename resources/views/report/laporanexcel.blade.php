@php
$sumPersenSaham=0;

@endphp

<table>
    <thead>
        <tr></tr>
        <tr></tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="8">
                <h1 style="text-align:center; font-weight:bold; font-size:40px;">
                    Laporan Setoran Saham Pemda ( {{$tahun}} )</h1>
            </th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th rowspan="2" style="text-align: center;">No. </th>
            <th colspan="3" style="text-align: center;">Saldo Tahun Lalu {{($tahun  - 1)}}</th>
			<th></th>
            <th colspan="4" style="text-align: center; background-color:#007bff;color:white;"> Triwulan 1 </th>
			<th></th>
            <th colspan="4" style="text-align: center; background-color:#17a2b8;color:white;"> Triwulan 2 </th>
			<th></th>
            <th colspan="4" style="text-align: center; background-color:#28a745;color:white;"> Triwulan 3 </th>
			<th></th>
            <th colspan="4" style="text-align: center; background-color:#ffc107;"> Triwulan 4 </th>
			<th></th>
            <th colspan="2" style="text-align: center; background-color:#6c757d;color:white;"> Total Growth </th>
        </tr>
        <tr style="font-weight:bold">


            <th style="width: 18em font-weight:bold">Pemegang Saham </th>
            <th style="width: 20em">Saldo Terakhir (Rp.)</th>
            <th style="width: 10em">% Saham </th>
			<th></th>
            <th style="width: 20em;text-align: center; background-color:#007bff;color:white;">Setoran (Rp.)</th>
            <th style="width: 20em;text-align: center; background-color:#007bff;color:white;">Saldo Akhir (Rp.)</th>
            <th style="width: 10em;text-align: center; background-color:#007bff;color:white;">% Saham </th>
            <th style="width: 10em;ext-align: center; background-color:#007bff;color:white;">% Growth </th>
			<th></th>

            <th style="width: 20em; text-align: center; background-color:#17a2b8;color:white;">Setoran (Rp.)</th>
            <th style="width: 20em; text-align: center; background-color:#17a2b8;color:white;">Saldo Akhir (Rp.)</th>
            <th style="width: 10em; text-align: center; background-color:#17a2b8;color:white;">% Saham </th>
            <th style="width: 10em; text-align: center; background-color:#17a2b8;color:white;">% Growth </th>
			<th></th>
            <th style="width: 20em; text-align: center; background-color:#28a745;color:white;">Setoran (Rp.)</th>
            <th style="width: 20em; ext-align: center; background-color:#28a745;color:white;">Saldo Akhir (Rp.)</th>
            <th style="width: 10em; text-align: center; background-color:#28a745;color:white;">% Saham </th>
            <th style="width: 10em; text-align: center; background-color:#28a745;color:white;">% Growth </th>
			<th></th>
            <th style="width: 20em; text-align: center; background-color:#ffc107;">Setoran (Rp.)</th>
            <th style="width: 20em; text-align: center; background-color:#ffc107;">Saldo Akhir (Rp.)</th>
            <th style="width: 10em; text-align: center; background-color:#ffc107;">% Saham </th>
            <th style="width: 10em; text-align: center; background-color:#ffc107;">% Growth </th>
			<th></th>
            <th style="width: 20em;text-align: center; background-color:#6c757d;color:white;">Total Setoran (Rp.)</th>
            <th style="width: 10em;text-align: center; background-color:#6c757d;color:white;">% Growth </th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
 

		@foreach ($report as $rp )
			
		
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $rp->pemda_name }}</td>
            <td style="text-align: right;">{{ number_format($rp->saldoakhirthnlalu) }}</td>
            <td style="text-align: right;">{{ number_format($rp->persensahamthnlalu, 2) }}</td>
			<td></td>

            <td style="text-align: right;">{{ number_format($rp->setorantw1) }}</td>
            <td style="text-align: right;">{{ number_format($rp->saldoakhirtw1) }}</td>
            <td style="text-align: right;">{{ number_format($rp->persensahamtw1, 2) }}</td>
            <td style="text-align: right;">{{ number_format($rp->persengrowthtw1, 2) }}</td>
			<td></td>

            <td style="text-align: right;">{{ number_format($rp->setorantw2) }}</td>
            <td style="text-align: right;">{{ number_format($rp->saldoakhirtw2) }}</td>
            <td style="text-align: right;">{{ number_format($rp->persensahamtw2, 2) }}</td>
            <td style="text-align: right;">{{ number_format($rp->persengrowthtw2, 2) }}</td>
			<td></td>

            <td style="text-align: right;">{{ number_format($rp->setorantw3) }}</td>
            <td style="text-align: right;">{{ number_format($rp->saldoakhirtw3) }}</td>
            <td style="text-align: right;">{{ number_format($rp->persensahamtw3, 2) }}</td>
            <td style="text-align: right;">{{ number_format($rp->persengrowthtw3, 2) }}</td>
			<td></td>

            <td style="text-align: right;">{{ number_format($rp->setorantw4) }}</td>
            <td style="text-align: right;">{{ number_format($rp->saldoakhirtw4) }}</td>
            <td style="text-align: right;">{{ number_format($rp->persensahamtw4, 2) }}</td>
            <td style="text-align: right;">{{ number_format($rp->persengrowthtw4, 2) }}</td>
			<td></td>

            <td style="text-align: right;">{{ number_format($rp->totsetoran) }}</td>
            <td style="text-align: right;">{{ number_format($rp->growthakhir, 2) }}</td>
        </tr>
        

		@endforeach
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: right;">{{number_format($kalkulasi['tahun_lalu']['total'])}}</td>
            <td></td>
            <td></td>
            
            <td>{{number_format($kalkulasi['kalkulasi']['triwulan1']['totalSetPenyertaan'])}}</td>
            <td style="text-align: right;">{{number_format($kalkulasi['kalkulasi']['triwulan1']['totalSaldoAkhir'])}}</td>
            <td></td>
            <td style="text-align: right;">
            {{number_format(
                
                ((($kalkulasi['kalkulasi']['triwulan1']['totalSaldoAkhir'] - 
                $kalkulasi['tahun_lalu']['total']) / $kalkulasi['tahun_lalu']['total'])*100)
                
                
                
                , 2)  
                
                }}</td>
			<td></td>

            <td style="text-align: right;">{{number_format($kalkulasi['kalkulasi']['triwulan2']['totalSetPenyertaan'])}}</td>
            <td style="text-align: right;">{{number_format($kalkulasi['kalkulasi']['triwulan2']['totalSaldoAkhir'])}}</td>
            <td></td>
            
            
            <td style="text-align: right;">
            
                {{number_format(
                
                ((($kalkulasi['kalkulasi']['triwulan2']['totalSaldoAkhir'] - 
                $kalkulasi['kalkulasi']['triwulan1']['totalSaldoAkhir']) / $kalkulasi['kalkulasi']['triwulan1']['totalSaldoAkhir'])*100)
                
                
                
                , 2)  
                
                }}
            
            </td>
			<td></td>

            <td style="text-align: right;">{{number_format($kalkulasi['kalkulasi']['triwulan3']['totalSetPenyertaan'])}}</td>
            <td style="text-align: right;">{{number_format($kalkulasi['kalkulasi']['triwulan3']['totalSaldoAkhir'])}}</td>
            <td></td>
            
            <td style="text-align: right;">
            
            {{number_format(
                
                ((($kalkulasi['kalkulasi']['triwulan3']['totalSaldoAkhir'] - 
                $kalkulasi['kalkulasi']['triwulan2']['totalSaldoAkhir']) / $kalkulasi['kalkulasi']['triwulan2']['totalSaldoAkhir'])*100)
                
                
                
                , 2)  
                
                }}
            
            </td>
			<td></td>

            <td style="text-align: right;">{{number_format($kalkulasi['kalkulasi']['triwulan4']['totalSetPenyertaan'])}}</td>
            <td style="text-align: right;">{{number_format($kalkulasi['kalkulasi']['triwulan4']['totalSaldoAkhir'])}}</td>
            <td></td>
            <td style="text-align: right;">
            
            {{number_format(
                
                ((($kalkulasi['kalkulasi']['triwulan4']['totalSaldoAkhir'] - 
                $kalkulasi['kalkulasi']['triwulan3']['totalSaldoAkhir']) / $kalkulasi['kalkulasi']['triwulan3']['totalSaldoAkhir'])*100)
                
                
                
                , 2)  
                
                }}
            
            </td>
			<td></td>

            <td>
            {{number_format($kalkulasi['growth']['total'])}}
            </td>
            <td style="text-align: right;">{{number_format(
                
                ((
                    ($kalkulasi['growth']['total'] / $kalkulasi['tahun_lalu']['total']) )*100)
                
                
                
                , 2)  
                
                }}</td>
        </tr>

		<tr></tr>
        <tr></tr>
        {{-- pemprov --}}
        <tr>
			<td></td>
			<td>Pemprov</td>
			<td style="text-align:right;">{{number_format($kalkulasi['tahun_lalu']['totalDiPemprov'])}}</td>
			<td style="text-align:right;">{{number_format($kalkulasi['tahun_lalu']['persenSahamPemprov'], 2)}}</td>
			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan1']['totalDiPemprov'])}}</td>
            <td style="text-align:right;">

            {{number_format($kalkulasi['kalkulasi']['triwulan1']['persenSahamPemprov'],2)}}
            
            </td>
			<td></td>
			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan2']['totalDiPemprov'])}}</td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan2']['persenSahamPemprov'],2)}}</td>
			<td></td>
			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan3']['totalDiPemprov'])}}</td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan3']['persenSahamPemprov'],2)}}</td>
			
			<td></td>
			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan4']['totalDiPemprov'])}}</td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan4']['persenSahamPemprov'],2)}}</td>
			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['growth']['totalDiPemprov'])}}</td>
		</tr>


{{-- pemkabkot --}}
        <tr>
            <td></td>
            <td>Pemkabkot</td>
            <td style="text-align:right;">{{number_format($kalkulasi['tahun_lalu']['totalPemda'])}}</td>
			
            <td style="text-align:right;">{{number_format($kalkulasi['tahun_lalu']['persenSahamPemkabkot'], 2)}}</td>
			
            
            <td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan1']['totalPemkabkot'])}}</td>
			<td style="text-align:right;">
            
            @if($kalkulasi['kalkulasi']['triwulan1']['persenSahamPemkabkot']==100)
                {{number_format(0, 2)}}
            @else
                {{number_format($kalkulasi['kalkulasi']['triwulan1']['persenSahamPemkabkot'],2)}} 
            @endif
            </td>
			 
             
             <td></td>
			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan2']['totalPemkabkot'])}}</td>
            <td style="text-align:right;">
            
            
            
            @if($kalkulasi['kalkulasi']['triwulan2']['persenSahamPemkabkot']==100)
                {{number_format(0, 2)}}
            @else
                {{number_format($kalkulasi['kalkulasi']['triwulan2']['persenSahamPemkabkot'],2)}} 
            @endif
            
            
            
            </td>
			<td></td>
			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan3']['totalPemkabkot'])}}</td>
            <td style="text-align:right;">
            @if($kalkulasi['kalkulasi']['triwulan3']['persenSahamPemkabkot']==100)
                {{number_format(0, 2)}}
            @else
                {{number_format($kalkulasi['kalkulasi']['triwulan3']['persenSahamPemkabkot'],2)}} 
            @endif
            
            {{-- {{number_format($kalkulasi['kalkulasi']['triwulan3']['persenSahamPemkabkot'],2)}} --}}
            
            </td>
			<td></td>
			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan4']['totalPemkabkot'])}}</td>
            <td style="text-align:right;">
            @if($kalkulasi['kalkulasi']['triwulan4']['persenSahamPemkabkot']==100)
                {{number_format(0, 2)}}
            @else
                {{number_format($kalkulasi['kalkulasi']['triwulan4']['persenSahamPemkabkot'],2)}} 
            @endif
            
            {{-- {{number_format($kalkulasi['kalkulasi']['triwulan4']['persenSahamPemkabkot'],2)}} --}}
            
            
            </td>
			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['growth']['totalPemkabkot'])}}</td>
		</tr>
        
        
        
        {{-- hitung total --}}
        <tr>
            <td></td>
            <td>Total</td>
			<td style="text-align:right;">{{number_format($kalkulasi['tahun_lalu']['total'])}}</td>
			<td style="text-align:right;">{{number_format(
                
                ($kalkulasi['tahun_lalu']['persenSahamPemprov'] +   
                $kalkulasi['tahun_lalu']['persenSahamPemkabkot'])    
            
            , 2)}}</td>
			
			<td></td>
            
            
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan1']['totalSetPenyertaan'])}}</td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan1']['totalSaldoAkhir'])}}</td>
           
           
            <td style="text-align:right;">
            
            @if($kalkulasi['kalkulasi']['triwulan1']['persenSahamPemkabkot']==100)
                {{number_format(0, 2)}}
            @else
                {{number_format(
                    
                    ($kalkulasi['kalkulasi']['triwulan1']['persenSahamPemprov'] +   
                    $kalkulasi['kalkulasi']['triwulan1']['persenSahamPemkabkot'])    
                
                , 2)}}
            @endif  
            
            
            
            
            </td>
			



			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan2']['totalSetPenyertaan'])}}</td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan2']['totalSaldoAkhir'])}}</td>
            <td style="text-align:right;">
            
            @if($kalkulasi['kalkulasi']['triwulan2']['persenSahamPemkabkot']==100)
                {{number_format(0, 2)}}
            @else

                {{number_format(
                    ($kalkulasi['kalkulasi']['triwulan2']['persenSahamPemprov'] +   
                    $kalkulasi['kalkulasi']['triwulan2']['persenSahamPemkabkot'])    
                
                , 2)}}
            @endif
            
            
            
            
            </td>



			<td></td>
			<td></td>
            <td style="text-align:right;">
            
            @if($kalkulasi['kalkulasi']['triwulan3']['totalSetPenyertaan']==0)
                0
            @else
                {{number_format($kalkulasi['kalkulasi']['triwulan3']['totalSetPenyertaan'])}}
            @endif


            </td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan3']['totalSaldoAkhir'])}}</td>
             <td style="text-align:right;">
             @if($kalkulasi['kalkulasi']['triwulan3']['persenSahamPemkabkot']==100)
                {{number_format(0, 2)}}
            @else

                {{number_format(
                    ($kalkulasi['kalkulasi']['triwulan3']['persenSahamPemprov'] +   
                    $kalkulasi['kalkulasi']['triwulan3']['persenSahamPemkabkot'])    
                
                , 2)}}
            @endif
            
            </td>


			<td></td>
			<td></td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan4']['totalSetPenyertaan'])}}</td>
            <td style="text-align:right;">{{number_format($kalkulasi['kalkulasi']['triwulan4']['totalSaldoAkhir'])}}</td>
            <td style="text-align:right;">
            
             @if($kalkulasi['kalkulasi']['triwulan4']['persenSahamPemkabkot']==100)
                {{number_format(0, 2)}}
            @else

                {{number_format(
                    ($kalkulasi['kalkulasi']['triwulan4']['persenSahamPemprov'] +   
                    $kalkulasi['kalkulasi']['triwulan4']['persenSahamPemkabkot'])    
                
                , 2)}}
            @endif
            
            
            
            </td>



			<td></td>
			<td></td>


            <td style="text-align:right;">{{number_format($kalkulasi['growth']['total'])}}</td>
        </tr>
        
       
    </tbody>
</table>

