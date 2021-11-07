          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data <?= $title; ?></h3>

                
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
                      <th>Cover</th>
                      <th>Jumlah</th>
                      <th>Action</th>
                    </tr>
                  </thead>
        
                  <tbody>
                    <?php $no=1; foreach ($gambarbarang as $key => $value) : ?>
                    <tr>
                      <td class="text-center"><?= $no++ ?></td>
                      <td><?= $value->nama_barang; ?></td>
                      <td><?= $value->nama_kategori ?></td>
                      <td class="text-center"><img src="<?= base_url('assets/gambar/'.$value->gambar); ?>" width="150px" class="img-thumbnail"></td>
                      <td class="text-center"><span class="right badge bg-primary "><?= $value->total_gambar; ?></span></td>
                      <td class="text-center">
                        <a href="<?= base_url('gambarbarang/add/'.$value->id_barang); ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add</a>
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
