            <div class="row">
              <div class="col-sm-6">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Nomor Rekening Toko</h3>
                  </div>
                  
                  <div class="card-body">
                    <p>Silahkan Transfer Uang ke Nomor Rekening Terdaftar Di Bawah Ini Sebesar : <h1 class="text-primary">Rp. <?= number_format($pesanan->grand_total,0); ?>.-</h1></p>
                    
                    <table class="table">
                      <tr>
                        <th>Bank</th>
                        <th>No. Rekening</th>
                        <th>Atas Nama</th>
                      </tr>
                      <?php foreach ($rekening as $key => $value): ?>
                        <tr> 
                            <td><?= $value->nama_bank ?></td>
                            <td><?= $value->no_rek ?></td>
                            <td><?= $value->atas_nama ?></td>
                        </tr>
                      <?php endforeach ?>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Upload Bukti Pembayaran</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="col-sm-12 mt-1">
                  <?php
                    // echo validation_errors('<div class="alert alert-danger alert-dismissible">
                    //           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    //           <i class="icon fas fa-exclamation-triangle"></i>', '</div>');

                    // notifikasi gagal upload gambar
                    if (isset($error_upload)) {
                      echo '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <i class="icon fas fa-exclamation-triangle"></i>'. $error_upload . '</div>';
                    }

                    if ($this->session->flashdata('pesan')) {
                      echo '<div class="alert alert-success alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <i class="icon fas fa-check"></i> Sukses!';
                      echo $this->session->flashdata('pesan');
                      echo '</div>';
                    }
                  ?>
                  </div>
                  <?php echo form_open_multipart('pesanan_saya/bayar/'.$pesanan->no_order); ?>
                    <div class="card-body">
                      <div class="form-group">
                        <label>Atas Nama</label>
                        <input type="text" name="atas_nama" class="form-control" placeholder="Atas Nama" value="<?= set_value('atas_nama') ?>">
                        <?= form_error('atas_nama', '<small class="text-danger pl-1">', '</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Nama Bank</label>
                        <input type="text" name="nama_bank" class="form-control" placeholder="Nama Bank" value="<?= set_value('nama_bank') ?>">
                        <?= form_error('nama_bank', '<small class="text-danger pl-1">', '</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="text" name="no_rek" class="form-control" placeholder="Nomor Rekening" value="<?= set_value('no_rek') ?>">
                        <?= form_error('no_rek', '<small class="text-danger pl-1">', '</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Bukti Bayar</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="bukti_bayar" id="preview_gambar" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-12">  
                      <div class="form-group">
                          <img src="<?= base_url('assets/gambar/nofoto.jpg') ?>" id="gambar_load" width="200px" class="rounded mx-auto d-block">
                      </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <a href="<?= base_url('pesanan_saya') ?>" class="btn btn-success">Kembali</a>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  <?php echo form_close(); ?>
                </div>
            <!-- /.card -->
              </div>
            </div>

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