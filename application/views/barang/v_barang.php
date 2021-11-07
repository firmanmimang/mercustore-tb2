          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data <?= $title; ?></h3>

                <div class="card-tools">
                  <a href="<?= base_url('barang/add'); ?>" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add
                  </a>
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
                      <th>Nama Barang</th>
                      <th>Kategori</th>
                      <th>Harga</th>
                      <th>Berat</th>
                      <th>Gambar</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $no = 1; foreach ($barang as $b) :?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $b->nama_barang; ?></td>
                        <td><?= $b->nama_kategori; ?></td>
                        <td class="text-center">Rp. <?= number_format($b->harga,0); ?></td>
                        <td class="text-center"><?= $b->berat ?> G.</td>
                        <td class="text-center"><img src="<?= base_url('assets/gambar/'. $b->gambar); ?>" width="150px" class="img-thumbnail" ></td>
                        <td class="text-center">
                          <a href="<?= base_url('barang/edit/'.$b->id_barang); ?>" class="btn btn-warning btn-sm mt-1"><i class="fas fa-edit"></i></a>
                          <button class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#delete<?= $b->id_barang; ?>"><i class="fas fa-trash"></i></button>
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
        <?php foreach ($barang as $b) :?>
          <div class="modal fade" id="delete<?= $b->id_barang; ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete <?= $b->nama_barang ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Apakah Anda Yakin Menghapus <?= $b->nama_barang; ?>?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <a href="<?= base_url('barang/delete/'. $b->id_barang); ?>" class="btn btn-danger">Delete</a>
                </div>
              
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
        <?php endforeach; ?>

