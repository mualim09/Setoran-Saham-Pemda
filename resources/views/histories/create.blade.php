<div class="modal fade" id="add-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Tambah Data Setoran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{-- {{ route('nama_pemda') }} --}}
            </div>
            <form class="form-add" action="/aktivitas" method="POST" name="contact" enctype="multipart/form-data">

                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Pemda</label>
                        <select class="form-control" name="kodePemda" id="pilihanPemda" required>
                            <option value="" selected>---- Pilih Daerah -------</option>
                            @foreach ($listPemda as $key => $lp)
                                <option value="{{ $lp->id }}"
                                {{ request('kodePemda') == $lp->id ? 'selected':''}}
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

                        <input type="text" class="form-control input-full" name="tanggal_setoran" id="tanggal_setoran"
                            placeholder="Silahkan Pilih Tanggal" autocomplete="off">
                    </div>


                </div>
                




                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
    <script src="{{ url('') }}/plugins/jquery/jquery.min.js"></script>

    <script src="{{ url('') }}/js/mask/js/jquery.mask.min.js"></script>
    <script src="{{ url('') }}/js/ui/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="{{ url('') }}/plugins/jquery-ui/jquery-ui.min.css" />
    {{-- <link rel="stylesheet" href="{{ url('') }}/plugins/jquery-ui/jquery-ui.min.css" /> --}}
    <link rel="stylesheet" href="{{ url('') }}/js/datepicker/datepicker.min.css" />


<script>
    $('#nominalSetoranAdd').mask('000.000.000.000.000.000.000', {
        reverse: true

    });

    var currentYear = (new Date).getFullYear();
    var currentMonth = (new Date).getMonth();
    var currenDate = (new Date).getDate();

    var limitMonth;

    //var limitCustom = new Date({{ request('tahun')=='' ? date('Y') : request('tahun') }} , 1, 31);

    if (currentMonth <= 3) {
        limitMonth=1;
    } else if (currentMonth <= 6) {
        limitMonth=4;
    } else if (currentMonth <= 9) {
        limitMonth=7;
    } else if (currentMonth <= 12) {
        limitMonth=10;
    }
    

    var limitDatePicker =currentYear+'-'+limitMonth+'-'+1;

        var date = new Date();
        $('#tanggal_setoran').datepicker({
            yearRange: '2015:{{ request('tahun')=='' ?  date('Y') : request('tahun')}}',
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
             //minDate:new Date(limitDatePicker),
             maxDate:
                @if((request('tahun')!='') && (request('tahun')!= date('Y'))) 
                    
                    new Date('{{request('tahun')}}-12-31') 
                
                @elseif (request('tahun')=='')
                    new Date('{{date('Y-m-d')}}')
                @else 

                    @if(request('tahun')== date('Y'))
                        new Date('{{date('Y-m-d')}}')
                    
                    @endif
                @endif


        }).datepicker("setDate", date);

</script>
