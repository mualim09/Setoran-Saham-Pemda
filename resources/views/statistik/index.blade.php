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

@section('plugin-js')
    <!-- jQuery -->





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
    <!-- AdminLTE App -->
    <script src="{{  url('') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
     <!-- Page specific script -->

 
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1 class="m-0">

                        Dashboard
                    </h1>
                </div>
            </div>
        </div>
    </div>




    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Setoran Pemda tahun {{request('tahun') ? request('tahun'):date('Y') }}<h3>

                             
                                    


                        </div>
                        <!-- /.card-header -->
                        <form action="/statistik" method="get" >
                            <div class="row mt-3 ml-3">

                                <table>
                                    <tr>
                                        <td>
                                            Tahun
                                        </td>
                                        <td>
                                            <select name="tahun" id="" class="form-control" required>
                                                {{-- <option value="" >---Pilih Tahun---</option> --}}
                                                @php 
                                                    
                                                    $earliest_year = 2000;
                                                    
                                                    foreach (range(date('Y'), $earliest_year) as $x) {
            
                                                        
                                                        print '<option value="' . $x . '"' . ($x === date('Y') ? ' selected="selected"' : '') . '>' . $x . '</option>';
                                                   
                                                   
                                                    }
                     
                                                    
                                                @endphp
                
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                               
    
                                <button class="btn btn-primary mx-3">Cari </button>
    
                            </div>
                        </form>
                        
                        {{var_dump($dataStatistik)}}


                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Pemda</th>
                                        <th>Saldo Akhir</th>
                                        <th>Tahun</th>
                                        
                                        <th>% Saham</th>
                                        <th>% Growth</th>
                                        
                                        {{-- <th>% Growth </th> --}}

                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($dataStatistik as $ds)
                                        <tr> 
                                            <td>{{$ds->pemda_name}}</td>
                                            <td>Rp. {{ number_format($ds->total_akhir)}}</td>
                                            <td>{{$ds->tahun}}</td>
                                
                                            <td>{{ number_format($ds->persen_saham) }}</td>
                                            <td>{{ number_format($ds->persen_grwth) }}</td>
                                             {{-- <td>{{$ds->pemda_id}}</td>
                                             <td>Rp {{number_format($ds->nominal_setoran)}}</td>
                                             <td>{{$ds->tanggal_setoran}}</td>
                                             <td>{{$ds->total_akhir}}</td>
                                             <td>{{$ds->triwulan}}</td>
                                             <td>{{$ds->tahun}}</td>
                                             <td>hb</td> --}}
                                        </tr>
                                    @endforeach



                                </tbody>
                                {{-- <tfoot>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th> 
              </tr>
              </tfoot> --}}
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
