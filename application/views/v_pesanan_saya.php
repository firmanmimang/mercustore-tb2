		  <div class="row">		
		  		
	          
	          <div class="col-sm-12">
	          		
	            <div class="card card-primary card-outline card-outline-tabs">
	              <div class="card-header p-0 border-bottom-0">
	                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
	                  <li class="nav-item">
	                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Order</a>
	                  </li>
	                  <li class="nav-item">
	                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Diproses</a>
	                  </li>
	                  <li class="nav-item">
	                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Dikirim</a>
	                  </li>
	                  <li class="nav-item">
	                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
	                  </li>
	                </ul>
	              </div>
	              <div class="card-body">
	                <div class="tab-content" id="custom-tabs-four-tabContent">
	                <?php if ($this->session->flashdata('pesan')) {
	                  echo '<div class="alert alert-success alert-dismissible">
	                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                          <h5><i class="icon fas fa-check"></i>';
	                  echo $this->session->flashdata('pesan');
	                  echo '</h5></div>'
	                  ;} 
	                ?>
	                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
	                  	<!-- daftar order -->
	                     <table class="table table-responsive">
	                     	<tr>
	                     		<th>No. Order</th>
	                     		<th>Tanggal Order</th>
	                     		<th>Nama Penerima</th>
	                     		<th>Alamat</th>
	                     		<th>Ekspedisi</th>
	                     		<th>Sub Total</th>
	                     		<th>Grand Total</th>
	                     		<th>Action</th>
	                     	</tr>
	                     	<?php foreach ($belum_bayar as $key => $value): ?>
		                     	<tr>
		                     		<td><?= $value->no_order ?></td>
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
		                     		<td>Rp. <?= number_format($value->sub_total) ?></td>
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
		                     		<td>
		                     			<a href="<?= base_url('pesanan_saya/invoice/'. $value->no_order) ?>" class="btn btn-sm btn-warning btn-block">Invoice</a>
		                     			<?php if ($value->status_bayar == 0): ?>

		                     				<a href="<?= base_url('pesanan_saya/bayar/'. $value->no_order) ?>" class="btn btn-sm btn-primary btn-block">Bayar</a>

		                     			<?php else: ?>

		                     				<a href="<?= base_url('pesanan_saya/edit_bayar/'. $value->no_order) ?>" class="btn btn-sm btn-primary btn-block">Edit Bayar</a>
		             
		                     			<?php endif ?>
		                     			
		                     		</td>
		                     	</tr>
	                     	<?php endforeach ?>
	                     </table>
	                  </div>

	                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
	                  	<!-- pesanan diproses -->
	                     <table class="table table-responsive">
	                     	<tr>
	                     		<th>No. Order</th>
	                     		<th>Tanggal Order</th>
	                     		<th>Nama Penerima</th>
	                     		<th>Alamat</th>
	                     		<th>Ekspedisi</th>
	                     		<th>Sub Total</th>
	                     		<th>Grand Total</th>
	                     		<th>Action</th>
	                     	</tr>
	                     	<?php foreach ($diproses as $key => $value): ?>
		                     	<tr>
		                     		<td><?= $value->no_order ?></td>
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
		                     		<td>Rp. <?= number_format($value->sub_total) ?></td>
		                     		<td>
		                     			<b>Rp. <?= number_format($value->grand_total,0); ?></b><br>
		                     			<span class="badge badge-success">Dikemas</span><br>
		                     			<span class="badge badge-primary">Terverifikasi</span>
		                     		</td>
		                     		<td>
		                     			<a href="<?= base_url('pesanan_saya/invoice/'. $value->no_order) ?>" class="btn btn-sm btn-warning btn-block">Invoice</a>
		                     		</td>
		                     
		                     	</tr>
	                     	<?php endforeach ?>
	                     </table>
	                  </div>

	                  <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
	                     <!-- pesanan dikirim -->
	                     <table class="table table-responsive">
	                     	<tr>
	                     		<th>No. Order</th>
	                     		<th>Tanggal Order</th>
	                     		<th>Nama Penerima</th>
	                     		<th>Alamat</th>
	                     		<th>Tanggal Kirim</th>
	                     		<th>Ekspedisi</th>
	                     		<th>Sub Total</th>
	                     		<th>Grand Total</th>
	                     		<th>No. Resi</th>
	                     		<th>Action</th>
	                     	</tr>
	                     	<?php foreach ($dikirim as $key => $value): ?>
		                     	<tr>
		                     		<td><?= $value->no_order ?></td>
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
		                     			<?= date('d F Y', $value->tgl_kirim); ?><br>
		                     			<?= date('h:i:s A', $value->tgl_kirim); ?>
		                     		</td>
		                     		<td>
		                     			<b><?= $value->ekspedisi ?></b><br>
		                     			Berat : <?= $value->berat ?>G. <br>
		                     			Paket : <?= $value->paket ?><br>
		                     			Estimasi : <?= $value->estimasi ?><br>
		                     			Ongkir : Rp. <?= number_format($value->ongkir) ?>
		                     			
		                     		</td>
		                     		<td>Rp. <?= number_format($value->sub_total) ?></td>
		                     		<td>
		                     			<b>Rp. <?= number_format($value->grand_total,0); ?></b><br>
		                     			<span class="badge badge-success">Dikirim</span>
		                     		</td>
		                     		<td>
		                     			<b><?= $value->no_resi ?></b><br>
		                     			
		                     		</td>
		                     		<td>
		                     			<a href="<?= base_url('pesanan_saya/invoice/'. $value->no_order) ?>" class="btn btn-sm btn-warning btn-block">Invoice</a>
		                     			<button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#diterima<?= $value->no_order ?>">Diterima</button>
		                     		</td>
		                     	</tr>
	                     	<?php endforeach ?>
	                     </table>
	                  </div>

	                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
	                  	<!-- pesanan selesai -->
	                     <table class="table table-responsive">
	                     	<tr>
	                     		<th>No. Order</th>
	                     		<th>Tanggal Order</th>
	                     		<th>Nama Penerima</th>
	                     		<th>Alamat</th>
	                     		<th>Tanggal Kirim</th>
	                     		<th>Tanggal Terima</th>
	                     		<th>Ekspedisi</th>
	                     		<th>Sub Total</th>
	                     		<th>Grand Total</th>
	                     		<th>No. Resi</th>
	                     	</tr>
	                     	<?php foreach ($selesai as $key => $value): ?>
		                     	<tr>
		                     		<td><?= $value->no_order ?></td>
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
		                     			<?= date('d F Y', $value->tgl_kirim); ?><br>
		                     			<?= date('h:i:s A', $value->tgl_kirim); ?>
		                     		</td>
		                     		<td>
		                     			<?= date('d F Y', $value->tgl_terima); ?><br>
		                     			<?= date('h:i:s A', $value->tgl_terima); ?>
		                     		</td>
		                     		<td>
		                     			<b><?= $value->ekspedisi ?></b><br>
		                     			Berat : <?= $value->berat ?>G. <br>
		                     			Paket : <?= $value->paket ?><br>
		                     			Ongkir : Rp. <?= number_format($value->ongkir) ?>
		                     			
		                     		</td>
		                     		<td>Rp. <?= number_format($value->sub_total) ?></td>
		                     		<td>
		                     			<b>Rp. <?= number_format($value->grand_total,0); ?></b><br>
		                     			<span class="badge badge-success">Diterima</span>
		                     		</td>
		                     		<td>
		                     			<b><?= $value->no_resi ?></b><br>
		                     		</td>
		                     		
		                     	</tr>
	                     	<?php endforeach ?>
	                     </table>
	                  </div>

	                </div>
	              </div>
	              <!-- /.card -->
	            </div>
	          </div>
		  </div>

<!-- form diterima -->
<?php foreach ($dikirim as $key => $value): ?>
	<!-- modal penerimaan -->
      <div class="modal fade" id="diterima<?= $value->no_order ?>">
        <div class="modal-dialog modal-m">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pesanan Diterima</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	Pesanan Telah Diterima?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <a href="<?= base_url('pesanan_saya/diterima/'.$value->no_order); ?>" class="btn btn-primary">Ya</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php endforeach ?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
