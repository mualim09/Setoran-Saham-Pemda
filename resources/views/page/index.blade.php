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


    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });


            



        });

        $('#btnAddSetoran').on('click', function(){
            // console.log($(this).data('regiondata'));
            var dataPemda = ($(this).data('regiondata')).split("-");

            // console.log(dataPemda[0]);
            // console.log(dataPemda[1]);

            $('#kodePemda').text(dataPemda[0]);
            $('#namaPemda').text(dataPemda[1]);
            $('.pemdaid').val(dataPemda[0]);

        });
 


        
        $('#example1').on('click', '.button-update', function(){

            var id = $(this).data('id');
            var pemdaid = $(this).data('pemdaid');
            var pemdaname = $(this).data('pemdaname');
            var nominalsetoran = $(this).data('nominalsetoran');
            var nominallama = $(this).data('nominalsetoran');
            // var totalsetoran = $(this).data('totalsetoran');
            var tanggalsetoran = $(this).data('tanggalsetoran');
            // var triwulan = $(this).data('triwulan');

            // console.log(id);
            // console.log(formatNominal(nominalsetoran));    
            console.log(tanggalsetoran);    
            

            $('.id').val(id);
            $('.pemda_id').text(pemdaid);
            $('.id_pemda').val(pemdaid);
            $('.pemda_name').text(pemdaname);
            
            
            $('.nominal_setoran').val(
                formatNominal(nominalsetoran)
            // nominalsetoran.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&."
            );


            $('.nominal_lama').val(nominalsetoran);

            $('.tanggal_setoran').val(tanggalsetoran);
           
            $('.form-edit').attr('action', '/setoran/'+id);
        });

        function formatNominal(angka){

            // var anu = 1000000000;
            var number_string = angka.toFixed(0).replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            angka_hasil     = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
    
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                angka_hasil += separator + ribuan.join('.');
            }
    
            angka_hasil = split[1] != undefined ? angka_hasil + ',' + split[1] : angka_hasil;
            return angka_hasil;
        }



    </script>
@endsection




@section('content')

        <!-- Main content -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1 class="m-0">
                        Catatan Setoran {{ $namaPemda}} {{' tahun '.request('tahun') }} 
                    </h1>



                </div>
                {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">

                                Home
                                 

                            </a></li>


                    </ol>
                </div> --}}
            </div><!-- /.row -->

            {{-- <h4 class="my-2 text-success">

                Total saldo yang masuk : Rp. {{ number_format($saldotahunlalu) }}
            </h4> --}}



        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">

                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-search"></i> Cari Data Setoran Daerah</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="get " action="/setoran">

                                <div class="row">
                                    <div class="col-sm-8">
                                        <!-- text input -->
                                        <div class="form-group">

                                            <h5>Cari Data </h5>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="kodePemda" id="listPemda" required>
                                                        <option value="" selected>---- Pilih Daerah -------</option>
                                                        @foreach ($listPemda as $key=>  $lp)


                                                            <option value="{{ $lp->id }}-{{ $lp->pemda_name }}" 
                                                                
                                                                {{-- {{ old('kodePemda') == $key ? "selected" : "" }} --}}
                                                                
                                                                >
                                                                {{ $lp->id }} - {{ $lp->pemda_name }}</option>
                                                  

                                                            
                                                        @endforeach

                                                    </select>
                                                    {{old('kodePemda')}}
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="tahun" required>
                                                        <option value="">---Pilih Tahun---</option>
                                                        @php
                                                            
                                                            $earliest_year = 2000;
                                                            
                                                            foreach (range(date('Y'), $earliest_year) as $x) {
                                                                print '<option value="' . $x . '"' . ($x === date('Y') ? ' selected="selected"' : '') . '>' . $x . '</option>';
                                                            }
                                                        @endphp


                                                    </select>

                                                </div>
                                            </div>


                                        </div>
                                        <input type="hidden" name="action" value="searchpemda">
                                        <button class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- Small boxes (Stat box) -->




            

            
            
        </div>
    </section>


    @if ($hidedata == false)
        <section class="content">
            <div class="container-fluid">

                @php
                    $sumAllData = 0;
                    $nominalPlusSaldoAkhir = 0;
                    $persenTumbuhAll = 0;                    
                    foreach ($list_setoran as $index => $rowSetoran){

                        // ====================== kode penting =================
                        $sumAllData += $rowSetoran->nominal_setoran;
                        //=====================================/==============
                        $nominalPlusSaldoAkhir = $sumAllData + $saldotahunlalu;

                        $persenTumbuhAll = ($sumAllData/ $saldotahunlalu)*100;
                    }

                @endphp

                <div class="row mt-3">
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                        <h3>Rp. {{number_format($nominalPlusSaldoAkhir)}}</h3>
               
    
                        <p>Total Saldo Akhir tahun ini </p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i> 
                        </a>
                    </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                        <h3>Rp {{ number_format($sumAllData) }}</h3>
    
                        <p>Total Growth Tahun ini </p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                        <h3>{{ number_format(($persenTumbuhAll),2) }} %</h3>
    
                        <p>Persentase Grow</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                </div>
           

                <div class="row">
                    <div class="col-12">
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif


                            <button class="btn btn-primary my-3" 
                            data-toggle="modal" 
                            data-target="#add-modal"
                            id="btnAddSetoran" 
                            data-regiondata="{{request('kodePemda')}}"
                            >
                                <i class="fas fa-plus"  ></i> Transaksi Saham</button>


 


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Catatan Setoran Saham {{ $namaPemda }}</h3>
                            </div>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            {{-- <th>Nama Pemda</th> --}}
                                            <th>Tanggal Setoran</th>
                                            <th>Triwulan</th>
                                            <th>Setoran Penyertaan</th>
                                            <th>Saldo Akhir</th>
                                            <th>Saldo Akhir di database</th>
                                            <th>% Saham</th>
                                            <th>% Growth</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subtotal = 0;
                                            $no = 0;
                    
                                            $valueSaldoAkhir = 0;
                                            $abc = 0;
                                            
                                            $totalSaldoPerPemda=0;

                                        @endphp

                                        
                                        @foreach ($list_setoran as $index => $ls)
                                            <tr>    

                                                <td>{{ $no++ }} </td>
                                                {{-- <td>{{ $ls->pemda_name }} </td> --}}
                                                <td>{{ $ls->tanggal_setoran }}
                                                </td>
                                                <td>{{ $ls->triwulan }}</td>


                                                <td>
                                                    Rp. @php 
                                                    
                                                    // echo number_format($ls->nominal_setoran); 
                                                    echo number_format($ls->nominal_setoran); 
                                                    @endphp</td>
                                                
                                                
                                                <td>
                                                    {{-- @php
                                                        // ====================== kode penting =================
                                                        $abc += $ls->nominal_setoran;
                                                        //=====================================/==============
                                                        $valueSaldoAkhir = $abc + $saldotahunlalu;
                                                    @endphp

                                                    Rp. {{number_format($abc)}} --}}
                                                    Rp. {{number_format($ls->total_setoran)}}
                                                       
                                                </td>
                                                <td>
                                                    
                                                    {{-- Rp. {{number_format($ls->total_setoran)}} --}}

                                                </td>
                                                <td>
                                                    @php

                                                    
                                                    // for ($i=0; $i <count($totalSaldoAllPemdaByTriwulan) ; $i++) {
                                                    //     // if($totalSaldoAllPemdaByTriwulan[$i]->triwulan == $ls->triwulan ){
                                                    //     //     echo number_format((($valueSaldoAkhir / $totalSaldoAllPemdaByTriwulan[$i]->total_nominal) *100), 2);
                                                    //         echo '<br>';
                                                    //     //     // echo number_format($totalSaldoAllPemdaByTriwulan[$i]->total_nominal);
                                                    //     //     // echo (string)$totalSaldoAllPemdaByTriwulan[$i];
                                                    //     // }
                                                    //     var_dump($totalSaldoAllPemdaByTriwulan[$i]);
                                                        
                                                    // } 
                                                    
                                                    @endphp 
                                                    {{-- % --}}
                                                     
                                                </td>

                                                @php
                                                    $persenGrowth =0 ;

                                                    if($ls->triwulan==1){
                                                        $percentGrowth = ((($valueSaldoAkhir - $saldotahunlalu) / $saldotahunlalu) *100);
                                                    }else{
                                                        // $percentGrowth =($valueSaldoAkhir - );

                                                        if(empty($list_setoran[$index-1]->nominal_setoran)){

                                                            $tempNextSaldoAkhir = (0 + $saldotahunlalu) ;
                                                        }else{
                                                            $tempNextSaldoAkhir = ($list_setoran[$index-1]->nominal_setoran + $saldotahunlalu) ;
                                                        }
                                                        $percentGrowth = (($valueSaldoAkhir - $tempNextSaldoAkhir) / $tempNextSaldoAkhir )*100;
                                                    }


                                                @endphp
                                                <td>
                                                {{number_format($percentGrowth, 2)}} 
                                                {{-- %  --}}
                                                    
                                                </td>

                                                <td>

                                                    <a href="javascript:void()"
                                                    data-toggle="modal" data-target="#edit-modal"
                                                    data-id="{{$ls->id}}"
                                                    data-pemdaid="{{$ls->pemda_id}}"
                                                    data-pemdaname="{{$ls->pemda_name}}"
                                                    data-nominalsetoran="{{$ls->nominal_setoran}}"
                                                    data-tanggalsetoran="{{$ls->tanggal_setoran}}"
                                                    {{-- data-totalsetoran="{{$ls->total_setoran}}" --}}
                                                    {{-- data-triwulan="{{$ls->triwulan}}" --}}
                                                    class="btn btn-warning button-update"><i class="fas fa-cogs"></i></a>




                                                    <form method="POST" action="/setoran/{{$ls->id}}">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="pemda_id" value="{{$ls->pemda_id}}" >
                                                        {{-- <input type="hidden" name="nominal_setoran" value="{{$ls->nominal_setoran}}">
                                                        <input type="hidden" name="tanggal_setoran" value="{{$ls->tanggal_setoran}}"> --}}
                                                        


                                                        <button class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus data ini ?')" >
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>


                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            {{-- <th>Nama Pemda</th> --}}
                                            <th>Tanggal Setoran</th>
                                            <th>Triwulan</th>
                                            <th>Setoran Penyertaan</th>
                                            <th>Saldo Akhir</th>
                                            <th>Saldo Akhir di database</th>
                                            <th>% Saham</th>
                                            <th>% Growth</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            
                            @php
                                    
                                    
                                @endphp

                            


                            <h3>Data tahun {{ request('tahun') - 1 }}</h3>
 
                            
                                

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>

                <h3> Perbandingan data </h3>
{{-- 
               <div class="row">
                    <div class="col-sm-6">
                        <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Data Tahun {{request('tahun') - 1}}</h3>
                            </div>
                            <div class="card-body">
                              <h5>Total Saldo Akhir </h5>

                              <table>
                                  <tr>
                                      <td>Seluruh Pemda  </td>
                                      <td> : </td>
                                      <td></td>
                                      <td>Rp. {{number_format($totalSaldoTahunLalu['all'][0])}}</td>
                                  </tr>
                                  <tr>
                                      <td>Pemprov Sumut </td>
                                      <td> : </td>
                                      <td></td>
                                      <td>Rp. {{number_format($totalSaldoTahunLalu['pemprov'][0])}}</td>
                                  </tr>
                                  <tr>
                                      <td>Pemerintahan Kabupaten / kota  </td>
                                      <td> : </td>
                                      <td></td>
                                      <td>Rp. {{number_format($totalSaldoTahunLalu['pemkabkot'][0])}}</td>
                                  </tr>
                              </table>

                              {{-- <h5 class="mt-3"> Persen Growth {{ $namaPemda}}  = {{number_format((($saldotahunlalu / $totalSaldoTahunLalu['all'][0]) *100), 2) }} %</h5>
                              <h5 class="mt-3"> Total Saldo Wilayah  {{ $namaPemda}}  = Rp. {{ number_format($saldotahunlalu) }}</h5> --}}
                              

                            </div>
                            
                          </div> 
                    </div>   

                    @php
                    $sumAllData = 0;
                    $nominalPlusSaldoAkhir = 0;
                    $persenTumbuhAll = 0;
                    
                    foreach ($list_setoran as $index => $rowSetoran){


                        // ====================== kode penting =================
                        $sumAllData += $rowSetoran->nominal_setoran;
                        //=====================================/==============
                        $nominalPlusSaldoAkhir = $sumAllData + $saldotahunlalu;

                        $persenTumbuhAll = ($sumAllData/ $saldotahunlalu)*100;

                    }


                    @endphp

                    {{-- <div class="col-sm-6">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Data Tahun {{request('tahun')}}</h3>
                              </div>
                              <div class="card-body">
                                <h5>Total Saldo Akhir </h5>
  
                                <table>
                                    <tr>
                                        <td>Seluruh Pemda  </td>
                                        <td> : </td>
                                        <td></td>
                                        <td>Rp. {{number_format($totalSaldoTahunSekarang['all'][0])}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pemprov Sumut </td>
                                        <td> : </td>
                                        <td></td>
                                        <td>Rp. {{number_format($totalSaldoTahunSekarang['pemprov'][0])}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pemerintahan Kabupaten / kota  </td>
                                        <td> : </td>
                                        <td></td>
                                        <td>Rp. {{number_format($totalSaldoTahunSekarang['pemkabkot'][0])}}</td>
                                    </tr>
                                </table>
  
                                <h5 class="mt-3"> Persen Growth {{ $namaPemda}}  = %</h5>
                                <h5 class="mt-3"> Total Saldo Wilayah  {{ $namaPemda}}  = Rp. {{number_format($totalSaldoWilayah[0]->total_akhir)}}</h5>
  
  
                              </div>
                        </div>    
                    </div>    --}}
                </div>  --}}

            
            
            
            </div>

            <!-- /.container-fluid -->


            {{-- modal untuk create data --}}
            @extends('page.create')
            <!-- /.modal -->

            {{-- modal untuk create data --}}
            @extends('page.update')
            



        </section>



    @else
        <section class="content">
            Data tidak ditemukan. Silahkan cari data dengan isi form di atas
        </section>
    @endif




            


@endsection

{{-- @section('add-alert')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Kirim</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection --}}

{{-- @section('edit-alert')
@endsection

@section('delete-alert')
@endsection --}}
