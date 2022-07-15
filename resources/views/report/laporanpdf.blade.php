<!DOCTYPE html>
<html>

<head>
    <title>Report Setoran Saham Pemda</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;

        }

        ,
    </style>
    <div class="text-center">
        <h4 class="mt-2">Laporan Setoran Saham Pemda Tahun {{ request('tahun') }}</h4>
    </div>

    <table class='table-bordered my-4 '>
        <tr >
            <th width="2" class="text-center">No. </th>
            <th width="2" class="text-center" colspan="3">Saldo Tahun Lalu</th>

            <th width="2" class="text-center text-light bg-primary" colspan="4"> Triwulan 1 </th>

            <th width="2" class="text-center text-light bg-info" colspan="4"> Triwulan 2 </th>

            <th width="2" class="text-center text-light bg-success" colspan="4"> Triwulan 3 </th>

            <th width="2" class="text-center  bg-warning" colspan="4"> Triwulan 4 </th>

            <th width="2" class="text-center text-light bg-secondary" colspan="2"> Total Growth </th>
        </tr>

        <tr>
            <th width="2" class="text-center">No. </th>
            <th style="width: 10em">Pemegang Saham </th>
            <th width="10">Saldo Terakhir (Rp.)</th>
            <th width="2" class="text-center">% Saham </th>

            <th width="2" class="text-center text-light bg-primary">Setoran (Rp.)</th>
            <th width="2" class="text-center text-light bg-primary">Saldo Akhir </th>
            <th width="2" class="text-center text-light bg-primary">% Saham </th>
            <th width="2" class="text-center text-light bg-primary">% Growth </th>


            <th width="2" class="text-center text-light bg-info">Setoran (Rp.)</th>
            <th width="2" class="text-center text-light bg-info">Saldo Akhir </th>
            <th width="2" class="text-center text-light bg-info">% Saham </th>
            <th width="2" class="text-center text-light bg-info">% Growth </th>

            <th width="2" class="text-center text-light bg-success">Setoran (Rp.)</th>
            <th width="2" class="text-center text-light bg-success">Saldo Akhir </th>
            <th width="2" class="text-center text-light bg-success">% Saham </th>
            <th width="2" class="text-center text-light bg-success">% Growth </th>

            <th width="2" class="text-center bg-warning">Setoran (Rp.)</th>
            <th width="2" class="text-center bg-warning">Saldo Akhir </th>
            <th width="2" class="text-center bg-warning">% Saham </th>
            <th width="2" class="text-center bg-warning">% Growth </th>

            <th width="2" class="text-center text-light bg-secondary">Total Setoran (Rp.)</th>
            <th width="2" class="text-center text-light bg-secondary">% Growth </th>
        </tr>

        <tbody>

            @php
                $no = 1;
            @endphp
            {{-- {{var_dump($report)}} --}}

            @foreach ($reportSahamPemda as $index => $ds)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $ds->pemda_name }}</td>
                    <td>{{ number_format($ds->saldoakhirthnlalu, 2) }}</td>
                    <td>{{ number_format($ds->persensahamthnlalu, 2) }}</td>

                    <td class="text-right">{{ number_format($ds->setorantw1) }}</td>
                    <td class="text-right">{{ number_format($ds->saldoakhirtw1) }}</td>
                    <td>{{ number_format($ds->persensahamtw1, 2) }}</td>
                    <td>{{ number_format($ds->persengrowthtw1, 2) }}</td>



                    <td class="text-right">{{ number_format($ds->setorantw2) }}</td>
                    <td class="text-right">{{ number_format($ds->saldoakhirtw2) }}</td>
                    <td>{{ number_format($ds->persensahamtw2, 2) }}</td>
                    <td>{{ number_format($ds->persengrowthtw2, 2) }}</td>

                    <td class="text-right">{{ number_format($ds->setorantw3) }}</td>
                    <td class="text-right">{{ number_format($ds->saldoakhirtw3) }}</td>
                    <td>{{ number_format($ds->persensahamtw3, 2) }}</td>
                    <td>{{ number_format($ds->persengrowthtw3, 2) }}</td>

                    <td class="text-right">{{ number_format($ds->setorantw4) }}</td>
                    <td class="text-right">{{ number_format($ds->saldoakhirtw4) }}</td>
                    <td>{{ number_format($ds->persensahamtw4, 2) }}</td>
                    <td>{{ number_format($ds->persengrowthtw4, 2) }}</td>

                    <td class="text-right">{{ number_format($ds->totsetoran) }}</td>
                    <td class="text-right">{{ number_format($ds->growthakhir, 2) }}</td>

                </tr>
            @endforeach



        </tbody>

    </table>

    <table>
        <thead>
            <tr>
                <td class="px-2">
                    <h5>{{ $tahun_lalu['title'] }}</h5>
                    <table class="m-3">
                        <thead>
                            <tr>
                                <th>Total Setoran</th>
                                <th>:</th>
                                <th>Rp. {{ number_format($tahun_lalu['total']) }}</th>
                            </tr>
                            <tr>
                                <th>Persentase Saham</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Pemprov</th>
                                <th>:</th>
                                <th>{{ number_format($tahun_lalu['persenSahamPemprov'], 2) }} %</th>
                            </tr>
                            <tr>
                                <th>Pemkab/kota</th>
                                <th>:</th>
                                <th>{{ number_format($tahun_lalu['persenSahamPemkabkot'], 2) }} %</th>
                            </tr>
                        </thead>
                    </table>


                </td>
            </tr>


        </thead>
        <thead>
            <tr>
                @foreach ($kalkulasi as $index => $kl)
                    <td class="px-2">
                        <h5>{{ $kl['title'] }}</h5>


                        {{-- <table class="my-2"> --}}
                        <table class="m-3">
                            <thead>
                                <tr>
                                    <th>Total Saldo Akhir</th>

                                </tr>
                                <tr>
                                    <th>Pemprov</th>
                                    <th>:</th>
                                    <th>Rp. {{ number_format($kl['totalDiPemprov']) }}</th>
                                </tr>
                                <tr>
                                    <th>Pemkab</th>
                                    <th>:</th>
                                    <th>Rp. {{ number_format($kl['totalPemkabkot']) }}</th>
                                </tr>
                                <tr>
                                    <th>Semua Pemda</th>
                                    <th>:</th>
                                    <th>Rp. {{ number_format($kl['totalSaldoAkhir']) }}</th>
                                </tr>

                            </thead>
                        </table>



                        <table class="m-3">
                            <thead>
                                <tr>
                                    <th>Persen Saham</th>

                                </tr>
                                <tr>
                                    <th>Pemprov</th>
                                    <th>:</th>
                                    <th>
                                        {{ number_format($kl['persenSahamPemprov'], 2) }} %</th>
                                </tr>
                                <tr>
                                    <th>Pemkab</th>
                                    <th>:</th>
                                    <th>
                                        @if ($kl['persenSahamPemkabkot'] == 100)
                                            {{ number_format(0, 2) }} %
                                        @else
                                            {{ number_format($kl['persenSahamPemkabkot'], 2) }} %
                                        @endif



                                    </th>
                                </tr>

                            </thead>
                        </table>



                        <table class="m-3">
                            <thead>
                                <tr>
                                    <th>Total Setoran</th>
                                    <th>:</th>
                                    <th>Rp. {{ number_format($kl['totalSetPenyertaan']) }}</th>
                                </tr>
                                <tr>
                                    <th>% Growth</th>
                                    <th>:</th>
                                    <th>
                                        @if ($index == 'triwulan1')
                                            @if ($tahun_lalu['total'] == 0 || $kl['totalSaldoAkhir'] == 0)
                                                {{ 0 }} %
                                            @else
                                                {{ number_format((($kl['totalSaldoAkhir'] - $tahun_lalu['total']) / $tahun_lalu['total']) * 100, 2) }}
                                                %
                                            @endif
                                        @elseif($index == 'triwulan2')
                                            @if ($kalkulasi['triwulan1']['totalSaldoAkhir'] == 0)
                                                {{ 0 }} %
                                            @else
                                                {{ number_format(
                                                    (($kl['totalSaldoAkhir'] - $kalkulasi['triwulan1']['totalSaldoAkhir']) /
                                                        $kalkulasi['triwulan1']['totalSaldoAkhir']) *
                                                        100,
                                                    2,
                                                ) }}
                                                %
                                            @endif
                                        @elseif($index == 'triwulan3')
                                            @if ($kalkulasi['triwulan2']['totalSaldoAkhir'] == 0)
                                                {{ 0 }} %
                                            @else
                                                {{ number_format(
                                                    (($kl['totalSaldoAkhir'] - $kalkulasi['triwulan2']['totalSaldoAkhir']) /
                                                        $kalkulasi['triwulan2']['totalSaldoAkhir']) *
                                                        100,
                                                    2,
                                                ) }}
                                                %
                                            @endif
                                        @elseif($index == 'triwulan4')
                                            @if ($kalkulasi['triwulan3']['totalSaldoAkhir'] == 0)
                                                {{ 0 }} %
                                            @else
                                                {{ number_format(
                                                    (($kl['totalSaldoAkhir'] - $kalkulasi['triwulan3']['totalSaldoAkhir']) /
                                                        $kalkulasi['triwulan3']['totalSaldoAkhir']) *
                                                        100,
                                                    2,
                                                ) }}
                                                %
                                            @endif
                                        @endif


                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </td>
                @endforeach
                
                    <tr>

                        <td class="px-2">
                            <h5>{{ $growth['title'] }}</h5>

                            <table class="m-3">
                                <thead>
                                    <tr>
                                        <th>Total di Pemprov</th>
                                        <th>:</th>
                                        <th>Rp. {{ number_format($growth['totalDiPemprov']) }}</th>
                                    </tr>
                                    <tr>
                                        <th>Total di Pemkab/kota</th>
                                        <th>:</th>
                                        <th>Rp. {{ number_format($growth['totalPemkabkot']) }}</th>
                                    </tr>
                                </thead>
                            </table>
                            <table class="m-3">
                                <thead>
                                    <tr>
                                        <th>Total Setoran</th>
                                        <th>:</th>
                                        <th>Rp. {{ number_format($growth['total']) }}</th>
                                    </tr>
                                    <tr>
                                        <th>Growth</th>
                                        <th>:</th>
                                        <th>
                                            @if(empty($tahun_lalu['total']))
                                            {{0}}
                                            @else
                                            {{ number_format(($growth['total'] / $tahun_lalu['total']) * 100, 2) }}

                                            @endif

                                            %



                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </td>
                    </tr>






            </tr>
        </thead>
    </table>



</body>

</html>
