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
    {{-- datepicker library --}}
    <script src="{{  url('') }}/datepicker/bootstrap-datepicker.min.css"></script>
    <script src="{{  url('') }}/datepicker/bootstrap-datepicker.min.js"></script>
     <!-- Page specific script -->

    <script src="{{  url('') }}/mask/jquery.mask.min.js"></script> 
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" />


    <script>

        $('#nominalSetoranAdd').mask('000.000.000.000.000.000.000', {
            reverse: true
            
        });
        


        var currentYear = (new Date).getFullYear();
        var date = new Date();
        $('#tanggal_surat').datepicker({
            format: 'mm/dd/yyyy',
             minDate:new Date((currentYear - 1), 12, 1),
             maxDate:new Date(currentYear, 11, 31),
        }).datepicker("setDate", date);
       
    </script>  

@endsection    

  

    @section('content')
 
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
    
                        <h1 class="m-0">
    
                            Aktivitas
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                          <li class="breadcrumb-item active">Aktivitas</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    
    
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
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
    
                    <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">Form Aktivitas</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/aktivitas" method="POST" name="contact"  enctype="multipart/form-data">
                                @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Pemda</label>
                                    <select class="form-control" name="kodePemda" id="pilihanPemda" required>
                                        <option value="" selected>---- Pilih Daerah -------</option>
                                        @foreach ($listPemda as $key=>  $lp)
    
    
                                            <option value="{{ $lp->id }}" 
                                                
                                                {{-- {{ old('kodePemda') == $key ? "selected" : "" }} --}}
                                                
                                                >
                                                {{ $lp->pemda_name }}</option>
                                  
    
                                            
                                        @endforeach
    
                                    </select>
    
    
                                </div>
    
                               
                                
                                <div class="form-group">
                                    <label>Nominal</label>
                                    <div class="input-group mb-2">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">Rp.</div>
                                      </div>
                                      <input type="text" name="nominal_setoran" class="form-control" id="nominalSetoranAdd">
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label>Tanggal Setoran</label>
                                    {{-- <input type="date" name="tanggal_setoran" class="form-control" 
                                    min="{{date('Y')}}-01-01"
                                    
                                    > --}}
                                    {{-- value="{{ request('tahun') ? request('tahun') : 1990 }}-01-01" --}}
                                    {{-- min="{{date('Y')}}-01-01" max="{{date('Y-m-d')}}" --}}
                                    {{-- min="{{date('Y')-1}}-01-01" max="2020-12-31" --}}
                                    
                                    {{-- <input class="form-control" id="dtSelectorStatic" /> --}}
                                    <input type="text" class="form-control input-full" name="tanggal_surat" id="tanggal_surat" placeholder="Silahkan Pilih Tanggal" autocomplete="off">
                                </div>

    

                                {{-- <div class="form-group">
                                    <label>Tanggal Setoran</label>
                                </div> --}}
                             
                            </div>
                            <!-- /.card-body -->
                            {{-- <input type="hidden" name="pemda_id" id="pemdaId"> --}}
            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>    
                </div>
     
            </div>
        </section>
    
     
        
    
        
    
    </div>  

        
    


 
      
    @endsection