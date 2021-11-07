
          <div class="col-sm-12">


            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">

                <?php 

                // // notifikasi form kosong
                // echo validation_errors('<div class="alert alert-danger alert-dismissible">
                //   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                //   <h5><i class="icon fas fa-exclamation-triangle"></i>', '</h5></div>');
                
                echo form_open('user/add_user'); 
                ?>
                
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="Nama User" name="nama_user" value="<?= set_value('nama_user'); ?>">
                    </div>
                    <?= form_error('nama_user', '<small class="text-danger pl-1">', '</small>'); ?>
                  </li>

                  <li class="list-group-item">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" value="<?= set_value('username'); ?>">
                    </div>
                    <?= form_error('username', '<small class="text-danger pl-1">', '</small>'); ?>
                  </li>

                  <li class="list-group-item">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" placeholder="E-mail" name="email" value="<?= set_value('email'); ?>">
                    </div>
                    <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                  </li>

                  <li class="list-group-item">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
                  </li>

                  <li class="list-group-item">
                    <div class="form-group">
                        <label>Re-Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="re-password">
                    </div>
                    <?= form_error('re-password', '<small class="text-danger pl-1">', '</small>'); ?>
                  </li>

                  <li class="list-group-item">
                    <div class="form-group">
                        <label>Level User</label>
                        <select class="form-control" name="level_user">
                            <option value="1" >Admin</option>
                            <option value="2" selected>User</option> 
                        </select>
                    </div>
                  </li>

                </ul>

                <div class="row">
                  <div class="col-12 col-md-3 mt-1">
                    <a href="<?= base_url('user') ?>" class="btn btn-success btn-block"><b>Kembali</b></a>
                  </div>
                  <div class="col-12 col-md-9 mt-1">
                    <button type="submit" class="btn btn-primary btn-block"><b>Add</b></button>
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