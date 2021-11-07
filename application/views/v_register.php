<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4 d-flex justify-content-center">
    <div class="register-box">
      <div class="register-logo">
        <a href="<?= base_url() ?>"><b>Mercu</b>Store</a>
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Register Pelanggan</p>

          <?php
            // echo validation_errors('<div class="alert alert-danger alert-dismissible">
            //           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            //           <i class="icon fas fa-exclamation-triangle"></i>', '</div>');

            if ($this->session->flashdata('pesan')) {
              echo '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <i class="icon fas fa-check"></i>';
              echo $this->session->flashdata('pesan');
              echo '</div>';
            }

            echo form_open('pelanggan/register'); 
          ?>
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan" value="<?= set_value('nama_pelanggan') ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <?= form_error('nama_pelanggan', '<small class="text-danger pl-1">', '</small>'); ?>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="far fa-user"></span>
                </div>
              </div>
            </div>
            <?= form_error('username', '<small class="text-danger pl-1">', '</small>'); ?>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="password" name="password" class="form-control" placeholder="Password" value="<?= set_value('password') ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="password" name="ulangi_password" class="form-control" placeholder="Retype password" value="<?= set_value('ulangi_password') ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <?= form_error('ulangi_password', '<small class="text-danger pl-1">', '</small>'); ?>
          </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <!-- /.col -->
            </div>
          <?php echo form_close() ?>
          <hr>
          <div class="text-center">
            <a class="small" href="<?= base_url('pelanggan/login') ?>" class="text-center">Sudah punya Akun ? Login</a><br>
          </div>

        </div>
        <!-- /.form-box -->
      </div>
    </div>
  </div>
  <div class="col-sm-4"></div>
</div>
<br>
<br>