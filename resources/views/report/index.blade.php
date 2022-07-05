@extends('layout.main')

@section('plugin-css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{  url('') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> --}}
    {{-- <link rel="stylesheet" --}}
    {{-- href="{{  url('') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{  url('') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('') }}/dist/css/adminlte.min.css">

    <link href="{{ url('') }}/datatablejs/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="{{ url('') }}/datatablejs/fixedColumns.dataTables.min.css" rel="stylesheet" />

      <!-- Select2 -->
    <link rel="stylesheet" href="{{  url('') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{  url('') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    

    <style>
        th,
        td {
            white-space: nowrap;
        }

        div.dataTables_wrapper {
            width: 100%;

            margin: 0 auto;
        }
    </style>
@endsection

@section('plugin-js')
    <script src="{{ url('') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ url('') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ url('') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('') }}/plugins/chart.js/Chart.min.js"></script>
    {{-- <script type="text/javascript" src="http://www.google.com/jsapi"></script> --}}

    <!-- Select2 -->
    <script src="{{  url('') }}/plugins/select2/js/select2.full.min.js"></script>


    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ url('') }}/datatablejs/dataTables.fixedColumns.min.js"></script>

    <script>
        // $(document).ready(function() {
        //$("#reportTable").DataTable({
        //      "responsive": true,
        //        "lengthChange": false,
        //          "autoWidth": false,
        //            "searching": true,
        //          });


        //        });

        $(document).ready(function() {

            $('.select2pemda').select2({
            theme: 'bootstrap4',
            
            });

            $('.select2tahun').select2({
                theme: 'bootstrap4',
            
            });
            $('.select2tahun').on('keypress', '.select2-search__field', function () {
                console.log($(this).val($(this).val().replace(/[^\d].+/, "")));
                

            });




            var table = $('#tableReport').DataTable({
                scrollY: "500px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    leftColumns: 4
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1 class="m-0">

                            Report Saham Pemda
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item active">Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Report Setoran Saham</h3>
                            </div>
                            <!-- ./card-header -->
                            <div class="card-body p-0">

                                <form action="/report" method="get">
                                    <div class="row my-3 ml-3">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    Nama Pemda
                                                </div>
                                                <div class="col-sm-7">
                                                    <select class="form-control select2pemda" name="kodePemda" id="listPemda" required>
                                                        <option value="">---- Pilih Daerah ----</option>
                                                        <option value="0" {{ request('kodePemda') == 0 ? 'selected' : '' }}>
                                                            Semua Pemda</option>
                                                        @foreach ($listPemda as $key => $lp)
                                                            <option value="{{ $lp->id }}"
                                                                {{ request('kodePemda') == $lp->id ? 'selected' : '' }}
                                                                {{-- {{ old('kodePemda') == $key ? "selected" : "" }} --}}>
                                                                {{ $lp->pemda_name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-sm-3">
                                                    Tahun
                                                </div>
                                                <div class="col-sm-7">
                                                    <select name="tahun" id="" class="form-control select2tahun" required>
                                                        <option value="">---Pilih Tahun---</option>
                                                        @php
                                                            
                                                            $earliest_year = 2015;
                                                        @endphp
                                                        @foreach (range(date('Y'), $earliest_year) as $x)
                                                            <option value={{ $x }}
                                                                {{ request('tahun') == $x ? 'selected' : '' }}>
                                                                {{ $x }}</option>
                                                        @endforeach




                                                    </select>
                                                </div>

                                            </div>



                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input type="hidden" name="action" value="searchreport">
                                                    <button class="btn btn-primary">Cari</button>
                                                </div>

                                            </div>



                                        </div>


                                    </div>

                                </form>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->



                @if ($hidedata == false)
                    @if ($allPemda == false)

                        <div class="row" id="view">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Tabel Report Setoran</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="mt-2">
                                            <h4>Report Saldo </h4>
                                            @if (!empty($report_saldo))
                                                <table class="table table-bordered col-6">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th width="20" class="text-center">#</th>
                                                            <th width="20">Tahun</th>
                                                            <th width="20">Total Setoran</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @php
                                                            $no2 = 1;
                                                        @endphp
                                                        @foreach ($report_saldo as $index => $rsaldo)
                                                            <tr>
                                                                <td>{{ $no2++ }}</td>
                                                                <td width="20" class="text-right">{{ $rsaldo->tahun }}
                                                                </td>

                                                                <td width="20" class="text-right">Rp.
                                                                    {{ number_format($rsaldo->total_akhir) }}</td>
                                                            </tr>
                                                        @endforeach



                                                    </tbody>
                                                </table>
                                            @else
                                                <span class="text-danger font-weight-bold">Belum ada data</span>
                                            @endif
                                        </div>

                                        <div class="mt-4">

                                            <h4>Report Setoran Akhir</h4>
                                            @php
                                                $no3 = 1;
                                            @endphp
                                            @if (!empty($report_setoran))
                                                <table class="table table-bordered col-6">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Tanggal Setoran</th>
                                                            <th style="width: 20px">Triwulan</th>
                                                            <th style="width: 40px">Nominal Setoran</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($report_setoran as $index => $rsetoran)
                                                            <tr>
                                                                <td>{{ $no3++ }}</td>
                                                                <td style="width: 50px" class="text-right">
                                                                    {{ $rsetoran->tanggal_setoran }}</td>
                                                                <td style="width: 50px" class="text-right">
                                                                    {{ $rsetoran->triwulan }}</td>
                                                                <td style="width: 50px" class="text-right">Rp.
                                                                    {{ number_format($rsetoran->nominal_setoran) }}</td>

                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            @else
                                                <span class="text-danger font-weight-bold">Belum Ada Data</span>
                                            @endif

                                            <div class="mt-4">
                                                <table class="text-bold">
                                                    <tr>
                                                        <td>Total Setoran Penyertaan</td>
                                                        <td>:</td>
                                                        <td>Rp. {{ number_format($setoranPenyertaan) }}</td>
                                                    </tr>
                                                </table>
                                            </div>


                                        </div>


                                    </div>

                                </div>



                            </div>
                        </div>
                    @else
                        <div class="content-wrapper border ml-0 my-3 pb-3 ">

                            <section class="content-header">
                                <div class="container-fluid">

                                    <div class="row ">
                                        <div class="col-sm-6">
                                            <h1>Setoran Saham Semua Pemda tahun {{ request('tahun') }}</h1>
                                            @if (!empty($dataSetoran['reportSahamPemda']))
                                                <a class="btn btn-danger my-1 mr-2"
                                                    href="/report?kodePemda={{ request('kodePemda') }}&tahun={{ request('tahun') }}&action=printreport&format=pdf"
                                                    target="_blank" rel="noopener noreferrer">
                                                    <i class="fas fa-print"></i> PDF</a>

                                                <a class="btn btn-success my-1"
                                                    href="/report?kodePemda={{ request('kodePemda') }}&tahun={{ request('tahun') }}&action=printreport&format=excel"
                                                    target="_blank" rel="noopener noreferrer" {{-- <a class="btn btn-success my-1" href="/exportexcel" --}}
                                                    target="_blank" rel="noopener noreferrer">
                                                    <i class="fas fa-file-excel"></i> Excel</a>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            </section>

                            <section class="content">




                                <div class="container-fluid h-50 pb-5">
                                    {{-- data kalkulasi terakhir saham pemda tahun lalu --}}
                                    @if (!empty($dataSetoran['reportSahamPemda']))
                                        <div class="card card-row card-info w-100">
                                            {{-- <div class="card-header">
                                    {{$dataSetoran['tahun_lalu']['repTahunLalu']['title']}} ({{(request('tahun')-1)}})
                                    
                                </div> --}}

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 table-container">
                                                        {{-- <table class="table table-report table-bordered table-hover" id="reportTable" > --}}
                                                        <table
                                                            class="stripe row-border order-column table table-bordered table-hover"
                                                            id="tableReport">
                                                            <thead class="text-center">

                                                                <tr>
                                                                    <th rowspan="2">No. </th>
                                                                    <th colspan="3">Saldo Tahun Lalu
                                                                        ({{ request('tahun') - 1 }})</th>

                                                                    <th class="text-center bg-primary" colspan="4"> Triwulan
                                                                        1 </th>

                                                                    <th class="text-center bg-info" colspan="4"> Triwulan 2
                                                                    </th>

                                                                    <th class="text-center bg-success" colspan="4"> Triwulan
                                                                        3 </th>

                                                                    <th class="text-center bg-warning" colspan="4"> Triwulan
                                                                        4 </th>

                                                                    <th class="text-center bg-secondary" colspan="4"> Total
                                                                        Growth </th>
                                                                </tr>

                                                                <tr>
                                                                    <th>Pemegang Saham </th>
                                                                    <th>Saldo Terakhir (Rp.)</th>
                                                                    <th>% Saham </th>

                                                                    <th width="2" style="width: 13em"
                                                                        class="bg-primary">Setoran (Rp.)</th>
                                                                    <th width="2" style="width: 13em"
                                                                        class="bg-primary">Saldo Akhir </th>
                                                                    <th width="2" style="width: 10em"
                                                                        class="bg-primary">% Saham </th>
                                                                    <th width="2" style="width: 13em"
                                                                        class="bg-primary">% Growth </th>


                                                                    <th width="2" style="width: 13em"
                                                                        class="bg-info">Setoran (Rp.)</th>
                                                                    <th width="2" style="width: 13em"
                                                                        class="bg-info">Saldo Akhir </th>
                                                                    <th width="2" style="width: 10em"
                                                                        class="bg-info">% Saham </th>
                                                                    <th width="2" style="width: 10em"
                                                                        class="bg-info">% Growth </th>

                                                                    <th width="2" style="width: 13em"
                                                                        class="bg-success">Setoran (Rp.)</th>
                                                                    <th width="2" style="width: 13em"
                                                                        class="bg-success">Saldo Akhir </th>
                                                                    <th width="2" style="width: 10em"
                                                                        class="bg-success">% Saham </th>
                                                                    <th width="2" style="width: 10em"
                                                                        class="bg-success">% Growth </th>

                                                                    <th width="2" style="width: 13em"
                                                                        class="bg-warning">Setoran (Rp.)</th>
                                                                    <th width="2" style="width: 13em"
                                                                        class="bg-warning">Saldo Akhir </th>
                                                                    <th width="2" style="width: 10em"
                                                                        class="bg-warning">% Saham </th>
                                                                    <th width="2" style="width: 10em"
                                                                        class="bg-warning">% Growth </th>

                                                                    <th width="2" style="width: 13em"
                                                                        class="bg-secondary">Total Setoran (Rp.)</th>
                                                                    <th width="2" style="width: 10em"
                                                                        class="bg-secondary">% Growth </th>

                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                                @php
                                                                    $no = 1;
                                                                @endphp
                                                                @foreach ($dataSetoran['reportSahamPemda'] as $index => $ds)
                                                                    <tr>
                                                                        <td>{{ $no++ }}</td>
                                                                        <td>
                                                                            <h5>{{ $ds->pemda_name }}</h5>


                                                                        </td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->saldoakhirthnlalu, 2) }}
                                                                        </td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->persensahamthnlalu, 2) }}
                                                                        </td>


                                                                        <td class="text-right">
                                                                            {{ number_format($ds->setorantw1) }}</td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->saldoakhirtw1) }}</td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->persensahamtw1, 2) }}
                                                                        </td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->persengrowthtw1, 2) }}
                                                                        </td>

                                                                        <td class="text-right">
                                                                            {{ number_format($ds->setorantw2) }}</td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->saldoakhirtw2) }}</td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->persensahamtw2, 2) }}
                                                                        </td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->persengrowthtw2, 2) }}
                                                                        </td>

                                                                        <td class="text-right">
                                                                            {{ number_format($ds->setorantw3) }}</td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->saldoakhirtw3) }}</td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->persensahamtw3, 2) }}
                                                                        </td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->persengrowthtw3, 2) }}
                                                                        </td>

                                                                        <td class="text-right">
                                                                            {{ number_format($ds->setorantw4) }}</td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->saldoakhirtw4) }}</td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->persensahamtw4, 2) }}
                                                                        </td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->persengrowthtw4, 2) }}
                                                                        </td>

                                                                        <td class="text-right">
                                                                            {{ number_format($ds->totsetoran) }}</td>
                                                                        <td class="text-right">
                                                                            {{ number_format($ds->growthakhir, 2) }}</td>


                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                
                                                        </table>




                                                    </div>
                                                </div>

                                                <div class="row">
                                                @foreach ($dataSetoran['kalkulasi'] as $index => $kl)
                                                    <div class="col-3" >
                                                        <div class="card card-info">
                                                            <div class="card-header">
                                                            {{ $kl['title'] }}
                                                            </div>

                                                            <div class="card-body">
                                                                <div class=" overflow-auto">
                                                        <table class="my-2">
                                                        <thead>
                                                            <tr>
                                                                <th>Total Saldo Akhir</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Pemprov </th>
                                                                <th>:</th>
                                                                <th>Rp. {{ number_format($kl['totalDiPemprov']) }}</th>
                                                            </tr>

                                                            
                                                            <tr>
                                                                <th>Pemkab/Kota </th>
                                                                <th>:</th>
                                                                <th>Rp. {{ number_format($kl['totalPemkabkot']) }}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Seluruh Pemda</th>
                                                                <th>:</th>
                                                                 <th>Rp. {{ number_format($kl['totalSaldoAkhir']) }}</th>
                                                            </tr>

                                                        </thead>
                                                    </table>
                                                    <table>
                                                        </thead>
                                                            <tr>
                                                                <th>Persentase Saham</th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Pemprov</th>
                                                                <th>:</th>
                                                                <th>{{ number_format($kl['persenSahamPemprov'], 2) }} %
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Pemkab/kota</th>
                                                                <th>:</th>
                                                                <th>
                                                                    {{-- {{ number_format($kl['persenSahamPemkabkot'], 2) }} % --}}
                                                                    @if ($kl['persenSahamPemkabkot'] == 100)
                                                                        {{ number_format(0, 2) }} %
                                                                    @else
                                                                        {{ number_format($kl['persenSahamPemkabkot'], 2) }}
                                                                        %
                                                                    @endif

                                                                    {{-- {{number_format($kl['persenSahamPemkabkot'], 2)}} % --}}


                                                                </th>
                                                            </tr>
                                                        </thead>
                                                    </table>

                                                    <table class="my-2">
                                                        <thead>
                                                            <tr>
                                                                <th>Total Setoran</th>
                                                                <th>:</th>
                                                                <th>Rp. {{ number_format($kl['totalSetPenyertaan']) }}</th>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <th>Growth</th>
                                                                <th>:</th>
                                                                <th>
                                                                {{-- anu {{empty($dataSetoran['tahun_lalu']['total']) }} --}}
                                                                        
                                                                        @if ($index == 'triwulan1')
                                                                            @if ($kl['totalSaldoAkhir'] == 0 OR empty($kl['totalSaldoAkhir']))
                                                                                {{ number_format(0, 2) }} %
                                                                            @else
                                                                                {{ number_format(
                                                                                    (($kl['totalSaldoAkhir'] - $dataSetoran['tahun_lalu']['total']) / $dataSetoran['tahun_lalu']['total']) * 100,
                                                                                    2,
                                                                                ) }}
                                                                                %
                                                                            @endif
                                                                        @elseif($index == 'triwulan2')
                                                                            @if ($dataSetoran['kalkulasi']['triwulan2']['totalSaldoAkhir'] == 0 OR empty($dataSetoran['kalkulasi']['triwulan2']['totalSaldoAkhir']))
                                                                                {{ number_format(0, 2) }} %
                                                                            @else
                                                                            {{ number_format(
                                                                                (($kl['totalSaldoAkhir'] - $dataSetoran['kalkulasi']['triwulan1']['totalSaldoAkhir']) /
                                                                                    $dataSetoran['kalkulasi']['triwulan1']['totalSaldoAkhir']) *
                                                                                    100,
                                                                                2,
                                                                            ) }}
                                                                            %
                                                                        @endif
                                                                    @elseif($index == 'triwulan3')
                                                                        @if ($dataSetoran['kalkulasi']['triwulan3']['totalSaldoAkhir'] == 0 OR empty($dataSetoran['kalkulasi']['triwulan3']['totalSaldoAkhir']))
                                                                            {{ number_format(0, 2) }} %
                                                                        @else
                                                                            {{ number_format(
                                                                                (($kl['totalSaldoAkhir'] - $dataSetoran['kalkulasi']['triwulan2']['totalSaldoAkhir']) /
                                                                                    $dataSetoran['kalkulasi']['triwulan2']['totalSaldoAkhir']) *
                                                                                    100,
                                                                                2,
                                                                            ) }}
                                                                            %
                                                                        @endif
                                                                    @elseif($index == 'triwulan4')
                                                                        @if ($dataSetoran['kalkulasi']['triwulan4']['totalSaldoAkhir'] == 0 OR empty($dataSetoran['kalkulasi']['triwulan4']['totalSaldoAkhir']))
                                                                            {{ number_format(0, 2) }} %
                                                                        @else
                                                                            {{ number_format(
                                                                                (($kl['totalSaldoAkhir'] - $dataSetoran['kalkulasi']['triwulan3']['totalSaldoAkhir']) /
                                                                                    $dataSetoran['kalkulasi']['triwulan3']['totalSaldoAkhir']) *
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
                                                                </div>
                                                   
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="card card-success">
                                                            <div class="card-header">
                                                            {{ $dataSetoran['tahun_lalu']['title'] }}
                                                            </div>
                                                            <div class="card-body">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Total Setoran </th>
                                                                            <th>:</th>
                                                                            <th>Rp.
                                                                                {{ number_format($dataSetoran['tahun_lalu']['total']) }}
                                                                            </th>
                                                                        </tr>
                                                                        

                                                                        <tr class="my-2">
                                                                            <th>Persentase Saham</th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pemprov</th>
                                                                            <th>:</th>
                                                                            <th>{{ number_format($dataSetoran['tahun_lalu']['persenSahamPemprov'], 2) }}
                                                                                %</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Pemkab/kota</th>
                                                                            <th>:</th>
                                                                            <th>{{ number_format($dataSetoran['tahun_lalu']['persenSahamPemkabkot'], 2) }}
                                                                                %</th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        
                                                        </div>
                                                    
                                                    
                                                    </div> 
                                                  
                                                    <div class="col-6">
                                                        <div class="card card-danger">
                                                            <div class="card-header">
                                                    {{ $dataSetoran['growth']['title'] }}
                                                            </div>
                                                            <div class="card-body">
                                                             <table class="my-2">
                                                    <thead>
                                                        <tr>
                                                            <th>Total di Pemprov</th>
                                                            <th>:</th>
                                                            <th>Rp.
                                                                {{ number_format($dataSetoran['growth']['totalDiPemprov']) }}
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>Total di Pemkab/kot</th>
                                                            <th>:</th>
                                                            <th>Rp.
                                                                {{ number_format($dataSetoran['growth']['totalPemkabkot']) }}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Total Setoran</th>
                                                            <th>:</th>
                                                            <th>Rp. {{ number_format($dataSetoran['growth']['total']) }}
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th> Growth</th>
                                                            <th>:</th>
                                                            <th> @if(empty($dataSetoran['tahun_lalu']['total'])!= 1)
                                                                {{ number_format(($dataSetoran['growth']['total'] / $dataSetoran['tahun_lalu']['total']) * 100, 2) }}%
                                                                @else
                                                                {{number_format(0,2)}}
                                                                @endif
                                                            </th>
                                                        </tr>

                                                    </thead>
                                                </table>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                    
                                                    </div> 
                                                </div>

                                            </div>



                                        </div>
                                    @else
                                        <h3 class="text-danger text-bold">Data Setoran Belum Ada</h3>
                                    @endif




                                </div>




                            </section>



                        </div>



                        {{-- akhir all pemda --}}
                    @endif
                @else
                    {{-- <div>Silahkan cari data terlebih dahulu {{var_dump($dataSetoran)}}</div> --}}
                    <div>Silahkan cari data terlebih dahulu </div>


                @endif

            </div>
        </section>
    </div>



@endsection
