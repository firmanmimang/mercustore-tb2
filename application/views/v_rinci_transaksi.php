          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $title ?></h3>
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
                      <th>Nama Pelanggan</th>
                      <th>No Order</th>
                      <th>Tanggal Order</th>
                      <th>Status</th>
                      <th>Nama Barang</th>
                      <th>Kategori</th>
                      <th>Qty</th>
                      <th>Gambar</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $no = 1; foreach ($rinci_transaksi as $u) :?>
                      <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $u->nama_pelanggan; ?></td>
                        <td class="text-center"><?= $u->no_order; ?></td>
                        <!-- <td class="text-center"><?= $u->password; ?></td> -->
                        <td>
                              <?= date('d F Y', $u->tgl_order); ?><br>
                              <?= date('h:i:s A', $u->tgl_order); ?>
                        </td>
                        <td class="text-center">
                          <?php if ($u->status_bayar == 0 && $u->status_order == 0): ?>
                            <span class="badge badge-warning">Belum Bayar</span>
                          <?php elseif ($u->status_bayar == 2 && $u->status_order == 0): ?>
                            <span class="badge badge-danger">Pembayaran Ditolak</span>
                          <?php elseif ($u->status_bayar == 1 && $u->status_order == 0): ?>
                            <span class="badge badge-success">Sudah Bayar</span>
                            <br>
                            <span class="badge badge-primary">Menunggu Verifikasi</span>
                          <?php elseif ($u->status_bayar == 1 && $u->status_order == 1): ?>
                            <span class="badge badge-success">Dikemas</span><br>
                            <span class="badge badge-primary">Terverifikasi</span>
                          <?php elseif ($u->status_bayar == 1 && $u->status_order == 2): ?>
                            <span class="badge badge-success">Dikirim</span>
                          <?php elseif ($u->status_bayar == 1 && $u->status_order == 3): ?>
                            <span class="badge badge-success">Diterima</span>
                          <?php endif ?>
                        </td>
                        <td><?= $u->nama_barang ?></td>
                        <td><?= $u->nama_kategori ?></td>
                        <td><?= $u->qty ?></td>
                        <td class="text-center"><img src="<?= empty($u->gambar) ? base_url('assets/gambar/default.jpg') : base_url('assets/gambar/'. $u->gambar); ?>" width="150px" class="img-thumbnail"></td>
                        
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>