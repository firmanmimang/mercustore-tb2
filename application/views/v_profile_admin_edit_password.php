
          <div class="col-sm-12">


            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <?php 

                // // notifikasi form kosong
                // echo validation_errors('<div class="alert alert-danger alert-dismissible">
                //   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                //   <h5><i class="icon fas fa-exclamation-triangle"></i>', '</h5></div>');

                if ($this->session->flashdata('pesan_error')) {
                echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fas fa-times"></i>';
                echo $this->session->flashdata('pesan_error');
                echo '</div>';
                }
                
                echo form_open('profileadmin/editpassword/'. $profile_admin->username); 
                ?>

                <!-- <input type="hidden" name="id_user" value="<?= $profile_admin->id_user; ?>"> -->
                
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <div class="form-group">
                        <label>Password Sekarang</label>
                        <input type="password" class="form-control" placeholder="Masukan Password Sekarang " name="password_sekarang">
                        <?= form_error('password_sekarang', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                  </li>

                  <li class="list-group-item">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" placeholder="Masukan Password Baru" name="password_baru">
                        <?= form_error('password_baru', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                  </li>

                  <li class="list-group-item">
                    <div class="form-group">
                        <label>Retype Password</label>
                        <input type="password" class="form-control" placeholder="Retype Password" name="ulangi_password">
                        <?= form_error('ulangi_password', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                  </li>

                </ul>

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
