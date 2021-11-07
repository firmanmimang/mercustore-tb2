
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
                           src="<?php echo empty($pelanggan->foto) ? base_url('assets/foto/default.jpg') : base_url('assets/foto/'). $pelanggan->foto; ?>"
                           alt="User profile picture">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <p><h3 class="profile-username text-muted text-center"><?= $pelanggan->nama_pelanggan ?></h3></p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Username </b> <a class="float-right"><?= $pelanggan->username_pelanggan ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Email </b> <a class="float-right"><?= $pelanggan->email ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Bergabung Sejak</b> <a class="float-right"><?= date('d F Y', $pelanggan->date_created) ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Password </b> <a href="<?= base_url('pelanggan/editpassword/' .$pelanggan->username_pelanggan) ?>" class="btn btn-sm btn-warning float-right"><b>Change Password</b></a>
                      </li>
                    </ul>
                  </div>
                </div>

                <a href="<?= base_url('pelanggan/editakun/'.$pelanggan->username_pelanggan) ?>" class="btn btn-primary btn-block"><b>Edit Profile</b></a>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>