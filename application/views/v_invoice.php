          <div class="col-12">

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <a class="brand-link disabled">
                      <img src="<?= base_url('assets/mercustorelogopas.png'); ?>" class="brand-image">
                  </a>
                  <h4>
                    <?= $title ?>.
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>No. Order</th>
                      <th>Nama Pelanggan</th>
                      <th>Tanggal Order</th>
                      <th>Barang</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Total Harga</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $grand_total=0; $i=1; foreach ($invoice as $key => $value): ?>
                      <?php 
                        $total_harga = $value->qty * $value->harga;
                        $grand_total = $grand_total + $total_harga;
                      ?>
                        <tr>
                          <td><?= $i++ ?></td>
                          <td><?= $value->no_order ?></td>
                          <td><?= $value->nama_pelanggan ?></td>
                          <td>
                            <?= date('d F Y', $value->tgl_order); ?><br>
                            <?= date('h:i:s A', $value->tgl_order); ?>
                          </td>
                          <td><?= $value->nama_barang ?></td>
                          <td>Rp. <?= number_format($value->harga) ?></td>
                          <td><?= $value->qty ?></td>
                          <td>Rp. <?= number_format($total_harga) ?></td>
                          <td>
                            <?php if ($value->status_bayar == 0 && $value->status_order == 0): ?>
                              <span class="badge badge-danger">Belum Bayar</span>
                            <?php elseif($value->status_bayar == 1 && $value->status_order == 0): ?> 
                              <span class="badge badge-warning">Belum Terverifikasi</span>
                            <?php elseif($value->status_bayar == 1 && $value->status_order == 1): ?> 
                              <span class="badge badge-primary">Lunas</span>
                            <?php elseif($value->status_bayar == 1 && $value->status_order == 2): ?>
                              <span class="badge badge-success">Lunas</span>
                            <?php elseif($value->status_bayar == 1 && $value->status_order == 3): ?>
                              <span class="badge badge-success">Lunas</span>
                            <?php endif ?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                
                    </tbody>
                  </table>

                  <h4 class="text-right">Grand Total : Rp. <?= number_format($grand_total); ?></h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="<?= base_url('pesanan_saya') ?>" class="btn btn-success"><b>Kembali</b></a>
                  <button class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
