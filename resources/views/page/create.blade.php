<div class="modal fade" id="add-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Setoran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          {{-- {{ route('nama_pemda') }} --}}
        </div>
        <form action="/setoran" method="POST" name="contact"  enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="pemda_id" class="form-control pemdaid">
                  
          <div class="modal-body">                
              <div class="form-group">
                  <label>Kode Pemda</label>
                  {{-- <input type="text" name="pemda_id" class="form-control" id='kodePemda'> --}}
                  <p id='kodePemda'></p>



              </div>
              <div class="form-group">
                  <label>Nama Pemda</label>
                  {{-- <input type="text" name="pemda_name" class="form-control" id='namaPemda' readonly > --}}
                  <p id='namaPemda'></p>
              </div>

              


              <div class="form-group">
                  <label>Jenis Transaksi </label>
                  <div class="input-group mb-2">
          
                    <select name="jnsSetoran" id="" class="form-control">
                      <option value="1">Setoran Saham</option>
                      <option value="0">Penarikan Saham</option>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label>Nominal</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Rp.</div>
                    </div>
                    <input type="text" name="nominal_setoran" class="form-control" id="nominalSetoran">
                  </div>
              </div>
              <div class="form-group">
                  <label>Tanggal Setoran</label>
                  <input type="date" name="tanggal_setoran" class="form-control" 
                  {{-- value="{{ request('tahun') ? request('tahun') : 1990 }}-01-01" --}}
                  min="{{request('tahun')}}-01-01" max="{{request('tahun')}}-12-31"
                  
                  >
              </div>           
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

        $('#nominalSetoran').mask('000.000.000.000.000', {
            reverse: true
            
        });

       
    </script>  
