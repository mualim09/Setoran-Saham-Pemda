@extends('layout.main')

@section('plugin-css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{  url('') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{  url('') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{  url('') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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

    
    <script src="{{  url('') }}/js/jquery/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
           $('#reportTable').DataTable({
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
 


        
        $('#reportTable').on('click', '.button-update', function(){

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
            // console.log(tanggalsetoran);    
            

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
           
            $('.form-edit').attr('action', '/histories/'+id);
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

    <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1 class="m-0">

                        History Transaksi Saham 
                    </h1>
                    @if(request('tahun'))
                    <h4 class="text-primary">
                        
                        Wilayah {{$namaPemda}}  :  {{' tahun '.request('tahun') }}</h4>
                        @endif


                    <button class="btn btn-primary my-2 " data-toggle="modal" data-target="#add-modal"><i class="fas fa-add"></i>Tambah Data Setoran</button>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                      <li class="breadcrumb-item active">Histories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
{{-- {{var_dump($hide_data)}} --}}
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
                            <form method="get " action="/histories">

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


                                                            <option value="{{ $lp->id }}" 
                                                                
                                                                {{ request('kodePemda') == $lp->id ? 'selected':''}}
                                                                {{-- {{ old('kodePemda') == $key ? "selected" : "" }} --}}
                                                                
                                                                >
                                                                 {{ $lp->pemda_name }}</option>
                                                  

                                                            
                                                        @endforeach

                                                    </select>
                                                    
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="tahun" required>
                                                        <option value="">---Pilih Tahun---</option>
                                                        @php
                                                            $earliest_year = 2019;
                                                        @endphp

                                                        @foreach (range(date('Y'), $earliest_year) as $x)
                                                            
                                                        <option value={{$x}} {{ request('tahun') == $x ? 'selected':''}}> {{$x}}</option>

                                                        @endforeach

                                                        


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

                @endphp


                 <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
        
                        <div class="info-box-content">
                        <span class="info-box-text">Total Saldo Akhir tahun ini </span>
                        <span class="info-box-number">
                            Rp. {{(number_format($statistikSetoran))}}

                            {{-- <small>%</small> --}}
                        </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
        
                        <div class="info-box-content">
                        <span class="info-box-text">Total Growth Tahun ini</span>
                       
                        <span class="info-box-number">Rp. {{(number_format($total_grow))}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
        
                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
        
                    <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-arrow-up"></i></span>
        
                        <div class="info-box-content">
                        <span class="info-box-text">Persentase Growth</span>
                        <span class="info-box-number">
                            @php
                                $persenGrowth = ($total_grow / $statistikTahunLalu) *100 ;
                            @endphp
                            {{ number_format($persenGrowth, 2) }} %
                        </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                   
                    <!-- /.col -->
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

{{-- 
                            <button class="btn btn-primary my-3" 
                            data-toggle="modal" 
                            data-target="#add-modal"
                            id="btnAddSetoran" 
                            data-regiondata="{{request('kodePemda')}}"
                            >
                                <i class="fas fa-plus"  ></i> Transaksi Saham</button> --}}

                                {{-- <h3>HALO</h3> --}}

                                {{-- {{var_dump($list_setoran->isEmpty())}} --}}

                        @if ($list_setoran->isEmpty())
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Catatan Setoran Saham {{ $namaPemda }} tahun {{request('tahun')}}</h3>
                                </div>
                                <div class="card-body">
                                    <h4 class="text-danger font-weight-bold">Belum Ada Data Setoran</h4>
                                </div>
                            </div>
                        @else
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Catatan Setoran Saham {{ $namaPemda }} tahun {{request('tahun')}}</h3>
                                </div>

                                <div class="card-body">
                                    <table id="reportTable" class="table table-bordered table-striped">
                                        <thead class="text-center">
                                            <tr>
                                                <th>#</th>
                                                {{-- <th>Nama Pemda</th> --}}
                                                <th>Tanggal Setoran</th>
                                                <th>Triwulan</th>
                                                <th>Setoran Penyertaan</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subtotal = 0;
                                                $no = 1 ;
                        
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


                                                    <td class="float-right">
                                                        Rp. @php 
                                                        
                                                        echo number_format($ls->nominal_setoran); 
                                                        @endphp</td>
                                                    
                                                    
                                                   

                                                    <td>
                                                        <div class="row">
                                                            <div class="col-xs-6 mx-1">
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
                                                            </div>
                                                            <div class="col-xs-6 mx-1">
                                                                <form method="POST" action="/histories/{{$ls->id}}">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <input type="hidden" name="pemda_id" value="{{$ls->pemda_id}}" >
                                                                    
        
        
                                                                    <button class="btn btn-danger" onclick="return confirm('Yakin untuk menghapus data ini ?')" >
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>

                                                        </div>

                                                        




                                                        

                                             


                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>

                                        

                                    </table>
                                </div>
                                
                                @php
                                        
                                        
                                    @endphp

                                

                                
                                    

                                <!-- /.card-body -->
                            </div>
                    

                        @endif
                        
                       


                    

                
                        

                        
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>

        
        </div>

            <!-- /.container-fluid -->


            {{-- modal untuk create data --}}
            {{-- @extends('page.create') --}}
            <!-- /.modal -->

            {{-- modal untuk create data --}}
            @extends('histories.update')
            @extends('histories.create')
            



        </section>



    @else
        <section class="content">
            Untuk menampilkan histories data, silahkan cari data dengan isi form di atas
        </section>
    @endif

</div>
  
      
    @endsection