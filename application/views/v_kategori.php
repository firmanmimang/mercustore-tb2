          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data <?= $title; ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Add
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->

              <div class="card-body">

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
                      <th>Nama Kategori</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $no = 1; foreach ($kategori as $k) :?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $k->nama_kategori; ?></td>
                        <td class="text-center">
                          <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $k->id_kategori; ?>"><i class="fas fa-edit"></i></button>
                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $k->id_kategori; ?>"><i class="fas fa-trash"></i></button>
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

          <!-- modal add -->
          <div class="modal fade" id="add">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Add <?= $title; ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">

                <?php echo form_open('kategori/add'); ?>

                    <div class="form-group">
                      <label>Nama Kategori</label>
                      <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori" required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
                <?php echo form_close(); ?>

              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

          <!-- modal edit -->
        <?php foreach ($kategori as $k) :?>
          <div class="modal fade" id="edit<?= $k->id_kategori; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit <?= $title; ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                <?php echo form_open('kategori/edit/'. $k->id_kategori); ?>
              
                    <div class="form-group">
                      <label>Nama <?= $title; ?>r</label>
                      <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori" value="<?= $k->nama_kategori; ?>" required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                <?php echo form_close(); ?>

              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endforeach; ?>

          <!-- modal delete -->
        <?php foreach ($kategori as $k) :?>
          <div class="modal fade" id="delete<?= $k->id_kategori; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete <?= $k->nama_kategori ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Apakah Anda Yakin Menghapus <?= $k->nama_kategori; ?>?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <a href="<?= base_url('kategori/delete/'. $k->id_kategori); ?>" class="btn btn-danger">Delete</a>
                </div>
              
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endforeach; ?>

