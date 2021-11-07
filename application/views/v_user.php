          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data User</h3>
                <div class="card-tools">
                  <a href="<?= base_url('user/add_user') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add
                  </a>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <?php 
                  echo validation_errors('<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fas fa-exclamation-triangle"></i>', '</div>');
                ?>

                <?php if ($this->session->flashdata('pesan')) {
                  echo '<div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <i class="icon fas fa-check"></i>';
                  echo $this->session->flashdata('pesan');
                  echo '</div>'
                  ;} 
                ?>

                <table class="table table-bordered table-striped" id="example1">
                  <thead class="text-center">
                    <tr>
                      <th>No.</th>
                      <th>Nama User</th>
                      <th>Email</th>
                      <th>Username</th>
                      <!-- <th>Password</th> -->
                      <th>Level</th>
                      <th>Foto</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $no = 1; foreach ($user as $u) :?>
                      <?php if ($u->username == 'admin'): ?>
                        <tr>
                          <td class="text-center"><?= $no++; ?></td>
                          <td><?= $u->nama_user; ?></td>
                          <td class="text-center">
                            <?= $u->email_user; ?><br>
                            <?php if ($u->is_active == 1): ?>
                              <span class="right badge bg-success">Terverifikasi</span>
                            <?php else: ?>
                              <span class="right badge bg-warning">Belum Verifikasi</span>
                            <?php endif ?>    
                          </td>
                          <td><?= $u->username; ?></td>
                          <!-- <td class="text-center"><?= $u->password; ?></td> -->
                          <td class="text-center"><?php
                            if ($u->level_user == 1) {
                              echo '<span class="right badge bg-primary">Admin</span>';
                            } else {
                              echo '<span class="right badge bg-success">User</span>';
                            }?>
                          </td>
                          <td class="text-center"><img src="<?= empty($u->foto_user) ? base_url('assets/foto_admin/default.jpg') : base_url('assets/foto_admin/'. $u->foto_user); ?>" width="150px" class="img-thumbnail"></td>
                          <td class="text-center">
                            
                          </td>
                        </tr>
                      <?php else: ?>
                        <tr>
                          <td class="text-center"><?= $no++; ?></td>
                          <td><?= $u->nama_user; ?></td>
                          <td class="text-center">
                            <?= $u->email_user; ?><br>
                            <?php if ($u->is_active == 1): ?>
                              <span class="right badge bg-success">Terverifikasi</span>
                            <?php else: ?>
                              <span class="right badge bg-warning">Belum Verifikasi</span>
                            <?php endif ?>    
                          </td>
                          <td><?= $u->username; ?></td>
                          <!-- <td class="text-center"><?= $u->password; ?></td> -->
                          <td class="text-center"><?php
                            if ($u->level_user == 1) {
                              echo '<span class="right badge bg-primary">Admin</span>';
                            } else {
                              echo '<span class="right badge bg-success">User</span>';
                            }?>
                          </td>
                          <td class="text-center"><img src="<?= empty($u->foto_user) ? base_url('assets/foto_admin/default.jpg') : base_url('assets/foto_admin/'. $u->foto_user); ?>" width="150px" class="img-thumbnail"></td>
                          <td class="text-center">
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $u->id_user; ?>"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $u->id_user; ?>"><i class="fas fa-trash"></i></button>
                          </td>
                        </tr>
                      <?php endif ?>
                      
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- modal delete -->
        <?php foreach ($user as $u) :?>
          <div class="modal fade" id="delete<?= $u->id_user; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete <?= $u->nama_user ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Apakah Anda Yakin Menghapus <?= $u->nama_user; ?>?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <a href="<?= base_url('user/delete/'. $u->id_user); ?>" class="btn btn-danger">Delete</a>
                </div>
              
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endforeach; ?>

        <!-- modal edit -->
        <?php foreach ($user as $key => $value): ?>
          <div class="modal fade" id="edit<?= $value->id_user; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Level User <?= $value->nama_user ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <?php echo form_open('user/edit_user/'. $value->id_user);  ?>

                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" placeholder="E-mail" name="email" value="<?= $value->email_user; ?>" required>
                    </div>
                
                    <div class="form-group">
                        <label>Level User</label>
                        <select class="form-control" name="level_user" required>
                            <option value="1" <?php if ($value->level_user == 1) echo "selected";?>>Admin</option>
                            <option value="2" <?php if ($value->level_user == 2) echo "selected";?>>User</option> 
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary"><b>Edit</b></button>
                </div>
                <?php echo form_close(); ?>
              
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endforeach ?>
