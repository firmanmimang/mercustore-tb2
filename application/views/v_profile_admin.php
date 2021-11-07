
          <div class="col-sm-12">

            <?php 
              if ($this->session->flashdata('pesan')) {
              echo '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i>';
              echo $this->session->flashdata('pesan');
              echo '</h5></div>'
              ;} 
            ?>

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="row mb-3">
                  <div class="col-12 col-sm-6">
                    <div class="text-center">
                      <img class="img-fluid img-thumbnail"
                           src="<?php echo empty($profile_admin->foto_user) ? base_url('assets/foto_admin/default.jpg') : base_url('assets/foto_admin/'). $profile_admin->foto_user; ?>"
                           alt="User profile picture">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <p><h2 class="text-muted text-center mt-3"><?= $profile_admin->nama_user ?></h2></p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Email </b> <a class="float-right"><?= $profile_admin->email_user ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Username </b> <a class="float-right"><?= $profile_admin->username ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Level User</b> <a class="float-right"><?= $profile_admin->level_user == 1 ? 'admin':'user'; ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Bergabung Sejak</b> <a class="float-right"><?= date('d F Y', $profile_admin->date_created) ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Password </b> <a href="<?= base_url('profileadmin/editpassword/'. $profile_admin->username) ?>" class="btn btn-sm btn-warning float-right"><b>Change Password</b></a>
                      </li>
                    </ul>
                  </div>
                </div>

                <a href="<?= base_url('profileadmin/editprofileadmin/'.$profile_admin->username) ?>" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
