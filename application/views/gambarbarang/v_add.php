          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $title; ?> : <?= $barang->nama_barang; ?></h3>

                
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <?php 
                  // pesan berhasil
                  if ($this->session->flashdata('pesan')) {
                  echo '<div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <i class="icon fas fa-check"></i>';
                  echo $this->session->flashdata('pesan');
                  echo '</div>'
                  ;} 
                ?>

                <?php 
                // // notifikasi form kosong
                // echo validation_errors('<div class="alert alert-danger alert-dismissible">
                //   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                //   <h5><i class="icon fas fa-exclamation-triangle"></i>', '</h5></div>');

                // notifikasi gagal upload gambar
                if (isset($error_upload)) {
                  echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fas fa-exclamation-triangle"></i>'. $error_upload . '</div>';
                }

                echo form_open_multipart('gambarbarang/add/'.$barang->id_barang); 
                ?>

                 <div class="row">
                  <div class="col-sm-6">
                      <div class="col-sm-12"> 
                        <div class="form-group">
                            <label>Keterangan Barang</label>
                            <input type="text" class="form-control" placeholder="Keterangan Gambar" name="ket" value="<?= set_value('ket'); ?>">
                            <?= form_error('ket', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                      </div>

                     <div class="col-sm-12">  
                       <div class="form-group">
                           <label>Gambar</label>
                           <div class="input-group">
                             <div class="custom-file">
                                <input type="file" name="gambar" id="preview_gambar" class="form-control custom-file-input">
                                <label class="custom-file-label" for="exampleInputFile">Choose file max 4mb</label>
                             </div>
                           </div>
                       </div>
                     </div>
                  </div>
                  <div class="col-sm-6">  
                    <div class="form-group">
                         <img src="<?= base_url('assets/gambar/nofoto.jpg') ?>" id="gambar_load" width="200px" class="rounded mx-auto d-block">
                     </div>
                  </div>
                 </div>

                 <div class="form-group">  
                    <a href="<?= base_url('gambarbarang'); ?>" class="btn btn-success btn-sm">Kembali</a>
                    <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                 </div>


                <?php echo form_close(); ?>

                <hr>

                <div class="row">

                  <?php foreach ($gambar as $key => $value) :?>

                    <div class="col-sm-3 text-center">
                      <div class="form-group mt-3">
                        <img src="<?= base_url('assets/gambarbarang/'.$value->gambar) ?>" class="img-fluid" id="" width="250px" class="rounded mx-auto d-block">
                      </div>
                      <p class=""><?= $value->ket ?></p>
                      <button class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#delete<?= $value->id_gambar; ?>"><i class="fas fa-trash"></i> Delete</button>
                    </div>

                  <?php endforeach; ?>

                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

         <!-- modal delete -->
        <?php foreach ($gambar as $g) :?>
          <div class="modal fade" id="delete<?= $g->id_gambar; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete <?= $g->ket ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-center">
                  <div class="form-group mt-3">
                    <img src="<?= base_url('assets/gambarbarang/'.$g->gambar) ?>" id="" width="250px" height="250px">
                  </div>
                  <h5>Apakah Anda Yakin Menghapus <?= $g->ket; ?>?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <a href="<?= base_url('gambarbarang/delete/'. $g->id_barang . '/' . $g->id_gambar); ?>" class="btn btn-danger">Delete</a>
                </div>
              
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endforeach; ?>



<script>
  function bacaGambar(input){
    if (input.files && input.files[0]) {
      let reader = new FileReader();
      reader.onload = function(e){
        $('#gambar_load').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#preview_gambar').change(function(){
    bacaGambar(this);
  });
</script>