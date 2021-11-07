          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Pelanggan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <?php 
                  // echo validation_errors('<div class="alert alert-danger alert-dismissible">
                  // <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  // <h5><i class="icon fas fa-exclamation-triangle"></i>', '</h5></div>');
                ?>

                <?php if ($this->session->flashdata('pesan')) {
                  echo '<div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h5><i class="icon fas fa-check"></i>';
                  echo $this->session->flashdata('pesan');
                  echo '</h5></div>'
                  ;} 
                ?>

                <table class="table table-bordered table-striped" id="example1">
                  <thead class="text-center">
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <!-- <th>Password</th> -->
                      <th>Email</th>
                      <th>Foto</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $no = 1; foreach ($pelanggan as $u) :?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $u->nama_pelanggan; ?></td>
                        <td class="text-center"><?= $u->username_pelanggan; ?></td>
                        <!-- <td class="text-center"><?= $u->password; ?></td> -->
                        <td class="text-center">
                          <?= $u->email; ?><br>
                          <?php if ($u->is_active == 1): ?>
                            <span class="right badge bg-success">Terverifikasi</span>
                          <?php else: ?>
                            <span class="right badge bg-warning">Belum Verifikasi</span>
                          <?php endif ?>    
                        </td>
                        <td class="text-center"><img src="<?= empty($u->foto) ? base_url('assets/foto/default.jpg') : base_url('assets/foto/'. $u->foto); ?>" width="150px" class="img-thumbnail"></td>
                        <td class="text-center">
                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $u->id_pelanggan; ?>"><i class="fas fa-trash"></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- modal delete -->
        <?php foreach ($pelanggan as $u) :?>
          <div class="modal fade" id="delete<?= $u->id_pelanggan; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete <?= $u->nama_pelanggan ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Apakah Anda Yakin Menghapus Pelanggan <?= $u->nama_pelanggan; ?>? <br>
                    Aksi ini akan mengakibatkan: <br>
                    <ul>
                      <li>Transaksi Pelanggan <?= $u->nama_pelanggan; ?> Terhapus</li>
                      <li>Rincian Transaksi Pelanggan <?= $u->nama_pelanggan; ?> Terhapus</li>
                    </ul>
                  </h5>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <a href="<?= base_url('admin/pelanggan_delete/'. $u->id_pelanggan); ?>" class="btn btn-danger">Delete</a>
                </div>
              
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endforeach; ?>
