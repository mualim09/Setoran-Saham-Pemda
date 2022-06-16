<div class="modal fade" id="edit-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning" >
          <h4 class="modal-title">Edit Data Setoran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          {{-- {{ route('nama_pemda') }} --}}
        </div>
        <form class="form-edit" method="POST" name="contact"  enctype="multipart/form-data">
          @method('PUT')
          @csrf

          <input type="hidden" name="id" class="form-control id" >
          <input type="hidden" name="pemda_id" class="form-control id_pemda" >
          <input type="hidden" name="nominal_lama" class="form-control nominal_lama">
          <input type="hidden" name="tanggal_setoran" class="form-control tanggal_setoran">
          {{-- <input type="hidden" name="total_setoran" class="form-control total_setoran" > --}}
          {{-- <input type="hidden" name="pe" class="form-control total_setoran" > --}}
          {{-- <input type="hidden" name="pemda_id" class="form-control" > --}}

          <div class="modal-body">                
              <div class="form-group">
                  <label>Kode Pemda</label>
                  {{-- <input type="text" name="pemda_id" class="form-control pemda_id" id='kodePemda'> --}}
                  <p class="pemda_id"></p>
              </div>
              <div class="form-group">
                  <label>Nama Pemda</label>
                  {{-- <input type="text" name="pemda_id" class="form-control pemda_id" id='kodePemda'> --}}
                  <p class="pemda_name"></p>
              </div>
              {{-- <div class="form-group">
                  <label>Nama Pemda</label>
                  <input type="text" name="pemda_name" class="form-control" id='namaPemda' readonly >
              </div> --}}

              


              <div class="form-group">
                  <label>Nominal</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Rp.</div>
                    </div>
                    <input type="text" name="nominal_baru" class="form-control nominal_setoran" id="nominalSetoranEdit">
                  </div>
              </div>
              {{-- <div class="form-group">
                  <label>Tanggal Setoran</label>
                  <input type="date" name="tanggal_setoran" class="form-control">
              </div>            --}}
          </div>
          {{-- <div class="modal-footer">                    
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-success" id="submit">
          </div> --}}
          {{-- <input type="hidden" name="action" value='addsetoran'> --}}

          
 
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
  <script src="{{  url('') }}/plugins/jquery/jquery.min.js"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>   
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>

        $('#nominalSetoranEdit').mask('000.000.000.000.000', {
            reverse: true
            
        });

        $('#kodePemda').on('change', function() {
            
            var kodePemda = this.value;
            console.log(this.value);


            $.ajax({
                    type: 'GET',
                    url: '{{ route('nama_pemda') }}',
                    data: {
                        kode_pemda: kodePemda,
                    },
                    success: function(data) {
                        $('#namaPemda').val(data.pemda_name);
                
                    }
                });


       
       
       
       
            });
    </script>  
