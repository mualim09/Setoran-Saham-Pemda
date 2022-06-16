@extends('layout.main')

@section('plugin-css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{  url('') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{  url('') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{  url('') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{  url('') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{  url('') }}/dist/css/adminlte.min.css">
@endsection



@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
    
                        <h1 class="m-0">
    
                            Dashboard
                        </h1>   
                    </div>
    
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                          <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
    
                    
                </div>
            </div>
        </div>
    
        <section class="content">
            <div class="container-fluid">
           
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Total Keseluruhan Saham Pemda Tahun Ini </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
    
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="info-box mb-3 bg-warning">
                                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>
    
                                            <div class="info-box-content">
                                                <span class="info-box-text">Setoran Penyertaan</span>
                                                <span class="info-box-number">Rp. {{number_format($setoran_penyertaan)}}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="info-box mb-3 bg-primary">
                                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>
    
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Growth</span>
                                                <span class="info-box-number">{{number_format($totalGrowth, 2)}} %</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="info-box mb-3 bg-success">
                                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>
    
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Setoran Seluruh Pemda</span>
                                                <span class="info-box-number">Rp. {{number_format($totAllSetoran)}}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- BAR CHART -->
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Pemasukan Per Triwulan</h3>
    
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart">
                                                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
    
                                    <div class="col-sm-6">
                                        <!-- PIE CHART -->
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h3 class="card-title">Persentase Saham (%)</h3>
    
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
    
                          
    
    
    
                            </div>
                            <!-- /.card-body -->
    
    
                        </div>
    
                    </div>
                </div>
    
    
            </div>
        </section>
    
    
     
    
        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-info">
                            <div class="card-header ">
                                <h3 class="card-title">Laporan Setoran Saham Tahun Ini</h3>
                            </div>
                            <!-- ./card-header -->
                            <div class="card-body p-0">
                                <table class="table table-hover">
                                    <tbody>
                                     
                                        @foreach ($dataPemda as $index=>$dp)
    
                                        <tr data-widget="expandable-table" 
                                        aria-expanded={{$index==0 ? 'true':'false'}}
                                        
                                        >
                                            <td>
                                                <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                {{$dp->pemda_name}} 
                                            </td>
                                        </tr>
    
    
    
                                        <tr class="expandable-body">
                                            <td>
                                                <div class="p-0" >
                                                    <div class="row mx-5 my-4">
                                                        <div class="col-sm-6">
                                                            <h5>History Setoran {{$dp->pemda_name}}</h5>
    
                                                            @if (empty($dp->data))
                                                                <div class="text-danger font-weight-bold">Belum ada setoran penyertaan di wilayah ini</div>
    
                                                            @else
    
    
                                                            
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th style="width: 10px">#</th>
                                                                        <th>Triwulan</th>
                                                                        <th>Tanggal Setoran </th>
                                                                        <th>Nominal Setoran</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                    
                                                                    @php
                                                                    $no = 1;
                                                                    $sumSetoran=0;
                                                                    @endphp
    
    
                                                                
                                                                    @foreach ($dp->data as $index => $str )
                                                                        @php
                                                                            $sumSetoran += $str->nominal_setoran;
                                                                        @endphp
                                                                        <tr>
                                                                            <td>{{$no++}}</td>
                                                                            <td>{{$str->triwulan}}</td>
                                                                            <td>
                                                                                {{$str->tanggal_setoran}}
                                                                            </td>
                                                                            <td>
                                                                                Rp. {{number_format($str->nominal_setoran)}}
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    @endforeach
    
    
                                                                    
                                                                    
                                                                
                                                                    </tbody>
                                                                </table>
    
                                                            @endif
                                                            
                                                              <div class="float-right mt-3" >
                                                                  <table class="text-bold">
                                                                      <tr>
                                                                          <td>Total Setoran Penyertaan</td>
                                                                          <td>:</td>
                                                                          <td>Rp. 
                                                                              
                                                                            @php
                                                                                if(empty($dp->data)){
                                                                                    $sumSetoran=0;
                                                                                    echo $sumSetoran;
                                                                                }else{
                                                                                    echo number_format($sumSetoran);
                                                                                }
                                                                            @endphp
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                            </td>
                                                                      </tr>
                                                                      <tr>
                                                                          <td>Saldo Terakhir </td>
                                                                          <td>:</td>
                                                                          <td>Rp. {{number_format($dp->total_akhir)}}</td>
                                                                      </tr>
                                                                    
                                                                  </table>
                                                                
                                                              </div>
                                                           
    
    
                                                        </div>
    
                                                        <div class="col-sm-6">
                                                            <h5 class="ml-5">Persentase Setoran</h5>
                                                            <div class="row ml-5">
                                                                <div class="col-sm-6 mt-2">
                                                                    <span class="text-success font-weight-bold">
                                                                       {{ number_format($dp->persen_saham, 2) }} %
                                                                    </span>
                                                                    <p class="font-weight-normal">Kepemilikan Saham</p>
                                                                </div>
                                                                <div class="col-sm-6 mt-2">
                                                                    <span class="text-success font-weight-bold">
                                                                        
                                                                       <i class="fas fa-caret-up"></i>
                                                                       {{number_format($dp->persen_growth, 2)}} %
                                                                    </span>
                                                                    <p class="font-weight-normal">Pertumbuhan Saham</p>
                                                                </div>
                                                                 
                                                            </div>
                                                            
    
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                            </td>
                                        </tr>
    
                                        @endforeach
     
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>
   
  
@endsection




@section('plugin-js')
 
    <script src="{{  url('') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{  url('') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{  url('') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{  url('') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{  url('') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{  url('') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{  url('') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{  url('') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{  url('') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{  url('') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{  url('') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{  url('') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{  url('') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{  url('') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    
    {{-- <script src="../../plugins/chart.js/Chart.min.js"></script> --}}
    <script src="{{  url('') }}/plugins/chart.js/Chart.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="{{  url('') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
     <!-- Page specific script -->

 

    {{-- untuk bagian chart.js --}}
    <script>
    
        $(function() {


            var areaChartData = {
                labels: ['Triwulan 1', 'Triwulan 2', 'Triwulan 3', 'Triwulan 4'],
                datasets: [{
                    label:' {{$bar_chart['pemkabkot']['keterangan']}} ',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: {{$bar_chart['pemkabkot']['data']}} 
                    // data: []
                }, {
                    label: ' {{$bar_chart['pemprov']['keterangan']}} ',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                
                    data: {{$bar_chart['pemprov']['data']}} 
                    // data: []
                    } 
                ]
            };
            

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                animation: false, 
                responsiveAnimationDuration: 5,

                scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return value.toLocaleString("id-ID",{style:"currency", currency:"IDR"});
                            }
                        }
                    }]
                }                    
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })


            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            // var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    '{{$pie_chart['pemprov']['keterangan']}}',
                    '{{$pie_chart['pemkabkot']['keterangan']}}',
                    
                    
                ],
                datasets: [{
                    data: [{{$pie_chart['pemprov']['data']}}, {{$pie_chart['pemkabkot']['data']}}],
                    backgroundColor: ['#f56954', '#00a65a'],
                }]
            }
    
            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })




        });
    </script>





@endsection


