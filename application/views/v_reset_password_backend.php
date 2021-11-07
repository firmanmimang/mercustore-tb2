
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mercu Store | <?= $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>template/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(); ?>template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>template/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- favicon -->
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= base_url('ico/') ?>apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url('ico/') ?>apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url('ico/') ?>apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url('ico/') ?>apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?= base_url('ico/') ?>apple-touch-icon-60x60.png" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?= base_url('ico/') ?>apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?= base_url('ico/') ?>apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?= base_url('ico/') ?>apple-touch-icon-152x152.png" />
  <link rel="icon" type="image/png" href="<?= base_url('ico/') ?>favicon-196x196.png" sizes="196x196" />
  <link rel="icon" type="image/png" href="<?= base_url('ico/') ?>favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="<?= base_url('ico/') ?>favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="<?= base_url('ico/') ?>favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="<?= base_url('ico/') ?>favicon-128.png" sizes="128x128" />
  <meta name="application-name" content="&nbsp;"/>
  <meta name="msapplication-TileColor" content="#FFFFFF" />
  <meta name="msapplication-TileImage" content="<?= base_url('ico/') ?>mstile-144x144.png" />
  <meta name="msapplication-square70x70logo" content="<?= base_url('ico/') ?>mstile-70x70.png" />
  <meta name="msapplication-square150x150logo" content="<?= base_url('ico/') ?>mstile-150x150.png" />
  <meta name="msapplication-wide310x150logo" content="<?= base_url('ico/') ?>mstile-310x150.png" />
  <meta name="msapplication-square310x310logo" content="<?= base_url('ico/') ?>mstile-310x310.png" />

</head>
<body class="hold-transition login-page">
<div class="row">
  <div class="col-sm-4 d-flex justify-content-center">
    <div class="register-box">
      <div class="register-logo">
        <a href="../../index2.html"><b>Mercu</b>Store</a>
      </div>

      <div class="card col-12">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Reset Password</p>

          <?php

            // echo validation_errors('<div class="alert alert-danger alert-dismissible">
            //           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            //           <i class="icon fas fa-exclamation-triangle"></i>', '</div>');

            // if ($this->session->flashdata('pesan')) {
            //   echo '<div class="alert alert-success alert-dismissible">
            //           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            //           <i class="icon fas fa-check"></i>';
            //   echo $this->session->flashdata('pesan');
            //   echo '</div>';
            // }

            if ($this->session->flashdata('error')) {
              echo '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <i class="icon fas fa-ban"></i>';
              echo $this->session->flashdata('error');
              echo '</div>';
            }

            echo form_open('auth/change_password'); 
          ?>
          
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
                <button type="submit" class="btn btn-primary btn-block">Reset</button>
              </div>
              <!-- /.col -->
            </div>
          <?php echo form_close() ?>

        </div>
        <!-- /.form-box -->
      </div>
    </div>
  </div>
  </div>
</div>
<br>
<br>

<script type="text/javascript">
  window.setTimeout(function(){
    $('.alert').fadeTo(500,0).slideUp(500,function(){
      $(this).remove();
    });
  },5000);
</script>
<script type="text/javascript">
  window.setTimeout(function(){
    $('.text-danger').fadeTo(500,0).slideUp(500,function(){
      $(this).remove();
    });
  },5000);
</script>

<!-- jQuery -->
<script src="<?= base_url(); ?>template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>template/dist/js/adminlte.min.js"></script>

</body>
</html>
