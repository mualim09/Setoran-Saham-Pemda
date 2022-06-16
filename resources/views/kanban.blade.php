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
    <script src="{{  url('') }}/plugins/chart.js/Chart.min.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>

    
 
@endsection

@section ('content')
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
          <div class="row" >
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Report Setoran Saham</h3>
                      </div>
                      <!-- ./card-header -->
                      <div class="card-body p-0">
                          
                          <form action="/kanban" method="get" >
                              <div class="row my-3 ml-3">
                                  <div class="col-sm-6">
                                      <div class="row">
                                          <div class="col-sm-3">
                                              Nama Pemda
                                          </div>
                                          <div class="col-sm-7">
                                              <select class="form-control" name="kodePemda" id="listPemda" required>
                                                  <option value="">---- Pilih Daerah ----</option>
                                                  <option value="0" {{ request('kodePemda') == 0 ? 'selected':''}}>Semua Pemda</option>
                                                  @foreach ($listPemda as $key=>  $lp)


                                                      <option value="{{ $lp->id }}" 
                                                          
                                                          {{ request('kodePemda') == $lp->id ? 'selected':''}}
                                                          {{-- {{ old('kodePemda') == $key ? "selected" : "" }} --}}
                                                          
                                                          >
                                                           {{ $lp->pemda_name }}</option>
                                            

                                                      
                                                  @endforeach

                                              </select>
                                          </div>
                                      </div>
                                      {{-- <div class="row mt-3">
                                          <div class="col-sm-3">
                                              Periode
                                          </div>
                                          <div class="col-sm-3">
                                              <select name="tahun_awal" id="" class="form-control" required>
                                                  <option value="" >---Awal---</option>
                                                  @php 
                                                      
                                                      $earliest_year = 2019;
                                                  @endphp   
                                                      @foreach (range(date('Y'), $earliest_year) as $x) 
              
                                                          
                                                      <option value={{$x}} {{ request('tahun_awal') == $x ? 'selected':''}}> {{$x}}</option> 
                                                     
                                                      @endforeach
                       
                                                      
                                              
                  
                                              </select>
                                          </div>
                                          <div class="col-sm-1">s/d</div>
                                          <div class="col-sm-3">
                                              <select name="tahun_akhir" id="" class="form-control" required>
                                                  <option value="" >--Akhir--</option>
                                                  @php 
                                                      
                                                  $earliest_year = 2019;
                                                  @endphp   
                                                  @foreach (range(date('Y'), $earliest_year) as $x) 
          
                                                      
                                                  <option value={{$x}} {{ request('tahun_akhir') == $x ? 'selected':''}}> {{$x}}</option> 
                                                 
                                                  @endforeach
                  
                                              </select>
                                          </div>
                                      </div> --}}
                                      <div class="row mt-3">
                                          <div class="col-sm-3">
                                              Tahun
                                          </div>
                                          <div class="col-sm-7">
                                              <select name="tahun" id="" class="form-control" required>
                                                  <option value="" >---Pilih Tahun---</option>
                                                  @php 
                                                      
                                                      $earliest_year = 2019;
                                                  @endphp   
                                                      @foreach (range(date('Y'), $earliest_year) as $x) 
              
                                                          
                                                      <option value={{$x}} {{ request('tahun') == $x ? 'selected':''}}> {{$x}}</option> 
                                                     
                                                      @endforeach
                       
                                                      
                                              
                  
                                              </select>
                                          </div>
                                        
                                      </div>



                                      <div class="row">
                                          <div class="col-sm-3">
                                              <input type="hidden" name="action" value="searchreport">
                                              <button class="btn btn-primary" >Cari</button>
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

        

          @if ($hidedata==false)
              @if ($allPemda==false)
                  
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
                                      <table class="table table-bordered">
                                          <thead>
                                          <tr>
                                              <th style="width: 10px">#</th>
                                              <th style="width: 50px">Tahun</th>
                                              <th >Total Setoran</th> 
                                          </tr>
                                          </thead>
                                          <tbody>
                                              @foreach ($report_saldo as $index => $rsaldo)
                                              <tr>
                                                  <td>{{$index++}}</td>
                                                  <td style="width: 50px">{{$rsaldo->tahun}}</td>
                                                  
                                                  <td style="width: 50px">Rp. {{number_format($rsaldo->total_akhir)}}</td>
                                              </tr>
                                              @endforeach
                                          
                                          </tbody>
                                      </table>
                                  </div>

                                  <div class="mt-4">

                                      <h4>Report Setoran Akhir</h4>
                                      <table class="table table-bordered">
                                          <thead>
                                          <tr>
                                              <th style="width: 10px">#</th>
                                              <th>Tanggal Setoran</th>
                                              <th style="width: 40px">Triwulan</th>
                                              <th style="width: 40px">Nominal Setoran</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                              @foreach ($report_setoran as $index => $rsetoran)
                                              <tr>
                                                  <td>{{$index++}}</td>
                                                  <td style="width: 50px">{{$rsetoran->tanggal_setoran}}</td>
                                                  <td style="width: 50px">{{$rsetoran->triwulan}}</td>
                                                  <td style="width: 50px">Rp. {{number_format($rsetoran->nominal_setoran)}}</td>
                                                  
                                              </tr>
                                              @endforeach
                                          
                                          </tbody>
                                      </table>

                                      <div class="mt-4">
                                          <table class="text-bold">
                                              <tr>
                                                  <td>Total Setoran Penyertaan</td>
                                                  <td>:</td>
                                                  <td>Rp. {{number_format($setoranPenyertaan)}}</td>
                                              </tr>
                                          </table>
                                      </div>


                                  </div>

                          
                              </div>
                              
                          </div>
                      
          
              
                      </div>
                  </div>
              @else    
                  {{-- <div>Semua Daerah</div> --}}
                   {{-- awal all pemda --}}
 
                   <div class="content-wrapper kanban border ml-0 my-3 pb-3" >
 
                    <section class="content-header">
                        <div class="container-fluid">
                            
                            <div class="row">
                                <div class="col-sm-6">
                                <h1>Setoran Semua Pemda</h1>
                                </div>
                            </div>
                            
                        </div>
                    </section>
                  
                    <section class="content">
                  
                        @php
                            $no=0;
                                                         
                            $a=array("primary","secondary","info","success","danger","warning");
                            $random_keys=array_rand($a,count($dataSetoran['tahun_ini']));
                                   
                         @endphp
                  
                  
                       
                        <div class="container-fluid h-100" >
                            {{-- data kalkulasi terakhir saham pemda tahun lalu --}}
                            <div class="card card-row card-info w-100 ">
                                <div class="card-header">
                                    {{$dataSetoran['tahun_lalu']['repTahunLalu']['title']}}
                                    
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            @if (!empty($dataSetoran['tahun_lalu']['repTahunLalu']['report']))
                                            <table class="table table-border">
                                                <thead>
                  
                                                    <tr>
                                                        <th>No. </th> 
                                                        <th>Pemegang Saham </th>
                                                        <th>Saldo Terakhir (Rp.)</th>
                                                        <th>% Saham </th>
                                                         
                                                    </tr>
                                                </thead>
                  
                                                <tbody>
                                                    @foreach ( $dataSetoran['tahun_lalu']['repTahunLalu']['report'] as $dtl )
                                                        
                                                   
                                                    <tr>
                                                        <td>{{$dtl->pemda_id}}</td> 
                                                        <td>{{$dtl->pemda_name}}</td> 
                                                        <td>{{number_format($dtl->triwulan4, 2)}}</td> 
                                                        <td>{{number_format($dtl->persen_saham, 2)}}</td> 
                                                        
                                                         
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                  
                                            </table>

                                            <div class="mt-3 mx-2">
                                                <table class="table-stripped">
                                                    <thead>
                                                        <tr>
                                                            <th>Pemprov Sumut</th>
                                                            <th>: </th>
                                                            <th>Rp. {{number_format($dataSetoran['tahun_lalu']['repTahunLalu']['totalDiPemprov'])}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Pemkab / Pemko</th>
                                                            <th>: </th>
                                                            <th>Rp. {{number_format($dataSetoran['tahun_lalu']['repTahunLalu']['totalPemda'])}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Total </th>
                                                            <th>: </th>
                                                            {{-- <th>{{number_format($ds['totalGrowth'], 2)}} %</th> --}}
                                                            <th>Rp. {{number_format($dataSetoran['tahun_lalu']['repTahunLalu']['total'])}}</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>

                                            @else
                                            <div class="text-danger font-weight-bold">Data Belum Ada</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                  
                          @foreach ($dataSetoran['tahun_ini'] as $index=>$ds )
                          {{-- report saham pemda tahun ini --}}
                            <div class="card card-row card-{{$a[$random_keys[$no++]]}} w-100" >

                            {{-- <div class="card card-row card-success w-25" > --}}
                                <div class="card-header">
                                    
                                    
                                    {{!empty($ds['title'])? $ds['title'] :'' }} 
                                </div>
                                <div class="card-body">
                  
                                    @if (!empty($ds['report']))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="{{$index}}" class="table table-border">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Pemda</th>
                                                        <th>Setoran Penyertaan (Rp.)</th>
                                                        <th>Saldo Akhir (Rp.)</th>
                                                        <th>%tase saham</th>
                                                        <th>%tase Grow</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no1=1;
                                                    @endphp
                                                    @foreach ($ds['report'] as $index => $rd)
                                                        
                                                    <tr>
                                                        <td>{{$no1++}}</td>
                                                        <td>{{$rd->pemda_name}}</td>
                                                        <td>{{number_format($rd->setoran_penyertaan)}}</td>
                                                        <td>{{number_format($rd->saldo_akhir)}}</td>
                                                        <td>{{number_format($rd->persen_saham, 2)}}</td>
                                                        <td>{{number_format($rd->persen_grwth, 2)}}</td>
                                                        
                                                    </tr>
                                                    @endforeach
                        
                                                </tbody>
                                            </table>
                        
                                            <div class="mt-3">
                                                <table class="table-stripped">
                                                    <thead>
                                                        <tr>
                                                            <th>Pemprov Sumut </th>
                                                            <th>: </th>
                                                            <th>Rp. {{number_format($ds['totalDiPemprov'])}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Pemkab / Pemko </th>
                                                            <th>: </th>
                                                            <th>Rp. {{number_format($ds['totalPemkabkot'])}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Total Setoran Penyertaan </th>
                                                            <th>: </th>
                                                            <th>Rp. {{number_format($ds['totalSetPenyertaan'])}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Total Saldo Akhir</th>
                                                            <th>: </th>
                                                            <th>Rp. {{number_format($ds['totalSaldoAkhir'])}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Persentase Growth </th>
                                                            <th>: </th>
                                                            <th>{{number_format($ds['totalGrowth'], 2)}} %</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    @else
                                    <div class="text-danger font-weight-bold">Data belum ada</div>
                                    @endif
                                </div>
                  
                            </div>
                  
                         @endforeach 
                          
                            
                  
                        </div>
                        
                      
                    </section>
                    
                  </div>
                  

              

              {{-- akhir all pemda --}}
              @endif
                  


          @else
              <div>Silahkan cari data terlebih dahulu</div>
             
              
          @endif

      </div>
  </section>
</div>

                      
  
@endsection
