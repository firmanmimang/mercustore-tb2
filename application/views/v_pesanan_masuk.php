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
		    	        <h5><i class="icon fas fa-check"></i>';
		            echo $this->session->flashdata('pesan');
		            echo '</h5></div>'
		            ;} 
		        ?>
		        <?php if ($this->session->flashdata('error')) {
		            echo '<div class="alert alert-danger alert-dismissible">
		                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                  <h5><i class="icon fas fa-check"></i>';
		            echo $this->session->flashdata('error');
		            echo '</h5></div>'
		            ;} 
		        ?>

                <!-- pesanan masuk -->
	                     <table class="table table-bordered table-striped" id="example1">
	                     	<thead>
		                     	<tr>
		                     		<th>No. Order</th>
		                     		<th>Nama Pelanggan</th>
		                     		<th>Tanggal Order</th>
		                     		<th>Nama Penerima</th>
		                     		<th>Alamat</th>
		                     		<th>Ekspedisi</th>
		                     		<th>Action</th>
		                     		<th>Grand Total</th>
		                     		<th>Sub Total</th>
		                     	</tr>
	                     	</thead>
	                     	<tbody>
	                     	<?php foreach ($pesanan as $key => $value): ?>
		                     	<tr>
		                     		<td><?= $value->no_order ?></td>
		                     		<td><?= $value->nama_pelanggan ?></td>
		                     		<td>
                              <?= date('d F Y', $value->tgl_order); ?><br>
                              <?= date('h:i:s A', $value->tgl_order); ?>
                            </td>
		                     		<td><?= $value->nama_penerima ?></td>
		                     		<td>
		                     			<?= $value->alamat ?>
		                     			<br>
		                     			<?= $value->kota ?>
		                     			<br>
		                     			<?= $value->provinsi ?>, <?= $value->kode_pos ?>
		                     		</td>
		                     		<td>
		                     			<b><?= $value->ekspedisi ?></b><br>
		                     			Berat : <?= $value->berat ?>G. <br>
		                     			Paket : <?= $value->paket ?><br>
		                     			Ongkir : Rp. <?= number_format($value->ongkir) ?>
		                     			
		                     		</td>
		                     		<td class="text-center">
		                     			<?php if ($value->status_bayar == 1): ?>

		                     				<button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#cek<?= $value->no_order ?>">Bukti Bayar</button>
		                     				<a href="<?= base_url('admin/proses/'. $value->no_order) ?>" class="btn btn-sm btn-primary mt-2 btn-block">Proses</a>
		                     			<?php else: ?>
			             					    <button class="btn btn-sm btn-success btn-block disabled">Bukti Bayar</button>
			                     			<button class="btn btn-sm btn-primary mt-2 btn-block disabled">Proses</button>
		                     			<?php endif ?>
		                     		
		                     		</td>
		                     		<td>
		                     			<b>Rp. <?= number_format($value->grand_total,0); ?></b><br>
		                     			<?php if ($value->status_bayar == 0): ?>
		                     				<span class="badge badge-warning">Belum Bayar</span>
		                     			<?php elseif ($value->status_bayar == 2): ?>
		                     				<span class="badge badge-danger">Pembayaran Ditolak</span>
		                     			<?php else: ?>
		                     				<span class="badge badge-success">Sudah Bayar</span>
		                     				<br>
		                     				<span class="badge badge-primary">Menunggu Verifikasi</span>
		                     			<?php endif ?>
		                     		</td>
		                     		<td>Rp. <?= number_format($value->sub_total) ?></td>
		                     	</tr>
	                     	<?php endforeach ?>
	                     	</tbody>
	                     </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
<!-- info bukti bayar pesanan masuk -->
<?php foreach ($pesanan as $key => $value): ?>
	<!-- modal cek bukti pembayaran -->
      <div class="modal fade" id="cek<?= $value->no_order ?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><?= $value->no_order ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <table class="table">
              	<tr>
              		<th>Atas Nama</th>
              		<td>:</td>
              		<td><?= $value->atas_nama ?></td>
              	</tr>
              	<tr>
              		<th>Nama Bank</th>
              		<td>:</td>
              		<td><?= $value->nama_bank ?></td>
              	</tr>
              	<tr>
              		<th>No. Rekening</th>
              		<td>:</td>
              		<td><?= $value->no_rek ?></td>
              	</tr>
              	<tr>
              		<th>Grand Total</th>
              		<td>:</td>
              		<td>Rp. <?= number_format($value->grand_total) ?></td>
              	</tr>
              </table>

              <img src="<?= base_url('assets/bukti_bayar/'. $value->bukti_bayar) ?>" class="img-fluid rounded mx-auto d-block">

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button class="btn btn-danger float-end" data-toggle="modal" data-target="#tolak<?= $value->no_order ?>" >Tolak Bayar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php endforeach ?>

<!-- tolak bayar pesanan masuk -->
<?php foreach ($pesanan as $key => $value): ?>
	<!-- modal tolak pembayaran -->
      <div class="modal fade" id="tolak<?= $value->no_order ?>">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tolak Pembayaran <?= $value->no_order ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <h5 class="text-center">Apakah yakin mau tolak pembayaran atas nama <?= $value->atas_nama ?> ?</h5>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" onclick="$('#tolak<?= $value->no_order ?>').modal('hide');">Close</button>
              <a href="<?= base_url('admin/tolak_bayar/'. $value->no_order) ?>" class="btn btn-danger">Tolak</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php endforeach ?>
