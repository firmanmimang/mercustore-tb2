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

                <!-- pesanan proses -->
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
	                     	<?php foreach ($pesanan_diproses as $key => $value): ?>
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
                                <button class="btn btn-sm btn-danger btn-block" data-toggle="modal" data-target="#tolak<?= $value->no_order ?>" >Tolak Proses</button>
		                     				<button class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target="#cek<?= $value->no_order ?>">Bukti Bayar</button>
		                     				<button class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#kirim<?= $value->no_order ?>">Kirim</button>
		             
		                     			<?php endif ?>
		                     			
		                     		</td>
		                     		<td>
		                     			<b>Rp. <?= number_format($value->grand_total,0); ?></b><br>
		                     			<span class="badge badge-success">Dikemas</span><br>
		                     			<span class="badge badge-primary">Terverifikasi</span>  			
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
          
<!-- info bukti bayar pesanan proses -->
<?php foreach ($pesanan_diproses as $key => $value): ?>
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
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php endforeach ?>

<!-- pengiriman pesanan proses -->
<?php foreach ($pesanan_diproses as $key => $value): ?>
	<!-- modal pengiriman -->
      <div class="modal fade" id="kirim<?= $value->no_order ?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><?= $value->no_order ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <?php echo form_open('admin/kirim/'.$value->no_order); ?>
              	<table class="table">
              		<tr>
	              		<th>Ekspedisi</th>
	              		<td>:</td>
	              		<td><?= $value->ekspedisi ?></td>
              		</tr>
              		<tr>
	              		<th>Paket</th>
	              		<td>:</td>
	              		<td><?= $value->paket ?></td>
              		</tr>
              		<tr>
	              		<th>Ongkir</th>
	              		<td>:</td>
	              		<td>Rp. <?= number_format($value->ongkir) ?></td>
              		</tr>
              		<tr>
	              		<th>Penerima</th>
	              		<td>:</td>
	              		<td><?= $value->nama_penerima ?></td>
              		</tr>
              		<tr>
	              		<th>No. Telepon</th>
	              		<td>:</td>
	              		<td><?= $value->tlp_penerima ?></td>
              		</tr>
              		<tr>
	              		<th>Alamat</th>
	              		<td>:</td>
	              		<td><?= $value->alamat ?>, <?= $value->kota ?>, <?= $value->provinsi ?>, <?= $value->kode_pos ?></td>
              		</tr>
              		<tr>
              			<th>No. Resi</th>
	              		<td>:</td>
	              		<td><input type="text" name="no_resi" class="form-control" required></td>
              		</tr>

              		<tr>
              			<th>Tanggal Pengiriman</th>
              			<td>:</td>
              			<td></td>
              		</tr>
              	</table>

              	<div class="row">

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tanggal</label>
                        <select name="tanggal" class="form-control">
                          <?php 
                            $mulai=1;
                            for($i=$mulai; $i < $mulai + 31; $i++){
                            	if($i == date('d')){
                            		echo '<option value="'.$i.'" selected>'.$i.'</option>';	
                            	}else{
                                echo '<option value="'.$i.'">'.$i.'</option>';
                              }
                            } 
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Bulan</label>
                        <select name="bulan" class="form-control">
                          <?php 
                            $mulai=1;
                            for($i=$mulai; $i < $mulai + 12; $i++){
                            	if($i == date('m')){
                            		echo '<option value="'.$i.'" selected>'.$i.'</option>';	
                            	}else{
                                echo '<option value="'.$i.'">'.$i.'</option>';
                              }
                            } 
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tahun</label>
                        <select name="tahun" class="form-control">
                          <?php 
                            $mulai=date('Y') -1 ;
                            for($i=$mulai; $i < $mulai + 7; $i++){
                            	if($i == date('Y')){
                            		echo '<option value="'.$i.'" selected>'.$i.'</option>';	
                            	}else{
                                echo '<option value="'.$i.'">'.$i.'</option>';
                              }
                            } 
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Jam</label>
                        <select name="jam" class="form-control">
                          <?php 
                            for($i=00 ; $i < 13; $i++){
                              if($i == date('h')){
                                echo '<option value="'.$i.'" selected>'.$i.'</option>'; 
                              }else{
                                echo '<option value="'.$i.'">'.$i.'</option>';
                              }
                            } 
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Menit</label>
                        <select name="menit" class="form-control">
                          <?php 
                            for($i=00 ; $i < 61; $i++){
                              if($i == date('i')){
                                echo '<option value="'.$i.'" selected>'.$i.'</option>'; 
                              }else{
                                echo '<option value="'.$i.'">'.$i.'</option>';
                              }
                            } 
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Detik</label>
                        <select name="detik" class="form-control">
                          <?php 
                            for($i=00 ; $i < 61; $i++){
                              if($i == date('s')){
                                echo '<option value="'.$i.'" selected>'.$i.'</option>'; 
                              } else{
                                echo '<option value="'.$i.'">'.$i.'</option>';
                              }
                              
                            } 
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-3">             
                      <div class="form-group">
                        <label>Am / Pm</label>
                        <select name="ampm" class="form-control">
                          <?php if (date('a', time()) == "am") {
                            echo '<option value="am" selected>AM</option>';
                            echo '<option value="pm">PM</option>';
                          } elseif (date('a', time()) == "pm"){
                            echo '<option value="am">AM</option>';
                            echo '<option value="pm" selected>PM</option>';
                          } ?>
                        
                        </select>
                      </div>
                    </div>

                </div>

              	
            </div>
            <div class="modal-footer justify-content-between">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	            <button type="submit" class="btn btn-primary">Kirim</button>
	        </div>
              
            <?php echo form_close(); ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php endforeach ?>

<!-- tolak proses pesanan -->
<?php foreach ($pesanan_diproses as $key => $value): ?>
  <!-- modal tolak proses -->
      <div class="modal fade" id="tolak<?= $value->no_order ?>">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tolak Proses <?= $value->no_order ?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <h5 class="text-center">Apakah yakin mau tolak proses pesanan nama <?= $value->atas_nama ?> ?</h5>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" onclick="$('#tolak<?= $value->no_order ?>').modal('hide');">Close</button>
              <a href="<?= base_url('admin/batal_proses/'. $value->no_order) ?>" class="btn btn-danger">Tolak Proses</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?php endforeach ?>
