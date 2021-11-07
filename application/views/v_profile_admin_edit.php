
          <div class="col-sm-12">


            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="row mb-3">
                  <div class="col-12 col-sm-6">
                    <div class="text-center">
                      <img class="img-fluid img-thumbnail"
                           src="<?php echo empty($profile_admin->foto_user) ? base_url('assets/foto_admin/default.jpg') : base_url('assets/foto_admin/'). $profile_admin->foto_user; ?>"
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
                        <i class="icon fas fa-exclamation-triangle"></i>'. $error_upload . '</div>';
                      }

                      echo form_open_multipart('profileadmin/editprofileadmin/'. $profile_admin->username); 
                      ?>

                      <!-- <input type="hidden" name="id_user" value="<?= $profile_admin->id_user; ?>"> -->
                      
                      <ul class="list-group list-group-unbordered mb-3">

                        <li class="list-group-item">
                          <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" placeholder="Email" name="email" value="<?= $profile_admin->email_user ?>" disabled>
                              <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                          </div>
                        </li>

                        <li class="list-group-item">
                          <div class="form-group">
                              <label>Nama</label>
                              <input type="text" class="form-control" placeholder="Nama User" name="nama_user" value="<?= $profile_admin->nama_user ?>">
                              <?= form_error('nama_user', '<small class="text-danger pl-1">', '</small>'); ?>
                          </div>
                        </li>

                        <li class="list-group-item">
                          <div class="form-group">
                              <label>Username</label>
                              <input type="text" class="form-control" placeholder="Username" name="username" value="<?= $profile_admin->username ?>">
                              <?= form_error('username', '<small class="text-danger pl-1">', '</small>'); ?>
                          </div>
                        </li>

                        <!-- <li class="list-group-item">
                          <div class="form-group">
                              <label>Password</label>
                              <input type="password" class="form-control" placeholder="Password" name="password" value="<?= $profile_admin->password ?>">
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="form-group">
                              <label>Level User</label>
                              <select class="form-control" name="level_user">
                                <?php if ($profile_admin->level_user == 1): ?>
                                  <option value="1" >Admin</option>
                                <?php elseif ($profile_admin->level_user == 2) : ?>
                                  <option value="2">User</option> 
                                <?php endif ?>
                              </select>
                          </div>
                        </li> -->

                        <li class="list-group-item">
                          <div class="form-group">
                            <label for="exampleInputFile">Ganti Foto</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" name="foto" id="preview_gambar" class="custom-file-input">
                                <label class="custom-file-label" for="exampleInputFile">Choose file max 4mb</label>
                              </div>
                            </div>
                        </li>

                      </ul>
                  </div>
                </div>

                
                <div class="row">
                  <div class="col-12 col-md-3 mt-1">
                    <a href="<?= base_url('profileadmin') ?>" class="btn btn-success btn-block"><b>Kembali</b></a>
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