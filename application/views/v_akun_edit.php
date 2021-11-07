
          <div class="col-sm-12">


            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="row mb-3">
                  <div class="col-12 col-sm-6">
                    <div class="text-center">
                      <img class="img-fluid img-thumbnail"
                           src="<?php echo empty($pelanggan->foto) ? base_url('assets/foto/default.jpg') : base_url('assets/foto/'). $pelanggan->foto; ?>"
                           alt="User profile picture" id="gambar_load">
                    </div>
                  </div>

                  <div class="col-12 col-sm-6">

                    <?php 
                    // // notifikasi form kosong
                    // echo validation_errors('<div class="alert alert-danger alert-dismissible">
                    //   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    //   <h5><i class="icon fas fa-exclamation-triangle"></i>', '</h5></div>');

                    // notifikasi gagal upload gambar
                    if (isset($error_upload)) {
                      echo '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i>'. $error_upload . '</h5></div>';
                    }

                    echo form_open_multipart('pelanggan/editakun/'. $pelanggan->username_pelanggan); 
                    ?>

                    <input type="hidden" name="id_pelanggan" value="<?= $pelanggan->id_pelanggan; ?>">
                    
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $pelanggan->email ?>" readonly>
                        </div>
                      </li>

                      <li class="list-group-item">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" name="nama_pelanggan" value="<?= $pelanggan->nama_pelanggan ?>">
                            <?= form_error('nama_pelanggan', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                      </li>

                      <li class="list-group-item">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username_pelanggan" value="<?= $pelanggan->username_pelanggan ?>">
                            <?= form_error('username_pelanggan', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                      </li>

                      <li class="list-group-item">
                        <div class="form-group">
                          <label for="exampleInputFile">Ganti Foto</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="foto" id="preview_gambar" class="custom-file-input">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                          </div>
                      </li>

                    </ul>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 col-md-3 mt-1">
                    <a href="<?= base_url('pelanggan/akun/' . $this->session->userdata('username_pelanggan')) ?>" class="btn btn-success btn-block"><b>Kembali</b></a>
                  </div>
                  <div class="col-12 col-md-9 mt-1">
                    <button type="submit" class="btn btn-primary btn-block"><b>Edit</b></button>
                  </div>
                </div>

                <?php echo form_close() ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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