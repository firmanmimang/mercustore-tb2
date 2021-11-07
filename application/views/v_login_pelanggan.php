<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4 d-flex justify-content-center">
    <div class="register-box">
      <div class="register-logo">
        <a href="<?= base_url() ?>"><b>Mercu</b>Store</a>
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Login Pelanggan</p>

          <?php
            // echo validation_errors('<div class="alert alert-warning alert-dismissible">
            //           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            //           <i class="icon fas fa-exclamation-triangle"></i>', '</div>');

            if ($this->session->flashdata('pesan')) {
              echo '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <i class="icon fas fa-check"></i>';
              echo $this->session->flashdata('pesan');
              echo '</div>';
            }

            if ($this->session->flashdata('error')) {
              echo '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <i class="icon fas fa-times"></i>';
              echo $this->session->flashdata('error');
              echo '</div>';
            }

            echo form_open('pelanggan/login'); 
          ?>
            
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>" autocomplete="off">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-key"></span>
                </div>
              </div>
            </div>
            <?= form_error('username', '<small class="text-danger pl-1">', '</small>'); ?>
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
           
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          
          <?php echo form_close() ?>
          <hr>
          <div class="text-center">
            <a class="small" href="<?= base_url('pelanggan/register') ?>" class="text-center">Belum Punya Akun ?</a> <br>
            <a class="small" href="<?= base_url('pelanggan/forgetpassword') ?>" class="text-center">Forget Password ?</a>
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
<br>
<br>
<br>
<br>