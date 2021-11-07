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

                <!-- pesanan kirim -->
	                     <table class="table table-bordered table-striped" id="example1">
	                     	<thead>
		                     	<tr>
		                     		<th>No. Order</th>
		                     		<th>Nama Pelanggan</th>
		                     		<th>Tanggal Order</th>
		                     		<th>Nama Penerima</th>
		                     		<th>Alamat</th>
		                     		<th>Tanggal Kirim</th>
		                     		<th>Ekspedisi</th>
		                     		<th>No. Resi</th>
		                     		<th>Sub Total</th>
		                     		<th>Grand Total</th>
		                     		
		                     	</tr>
	                     	</thead>
	                     	<tbody>
	                     	<?php foreach ($pesanan_dikirim as $key => $value): ?>
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
		                     		<td><b><?= $value->no_resi ?></b></td>
		                     		<td>Rp. <?= number_format($value->sub_total) ?></td>
		                     		<td>
		                     			<b>Rp. <?= number_format($value->grand_total,0); ?></b><br>
		                     			<span class="badge badge-success">Dikirim</span>  			
		                     		</td>
		                     		
		                     	</tr>
	                     	<?php endforeach ?>
	                     	</tbody>
	                     </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          