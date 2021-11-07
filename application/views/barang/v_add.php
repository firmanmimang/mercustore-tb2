          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form <?= $title; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              	<?php 

                // // notifikasi form kosong
                // echo validation_errors('<div class="alert alert-danger alert-dismissible">
                //   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                //   <h5><i class="icon fas fa-exclamation-triangle"></i>', '</h5></div>');

              	// notifikasi gagal upload gambar
              	if (isset($error_upload)) {
              		echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fas fa-exclamation-triangle"></i>'. $error_upload . '</div>';
              	}

              	echo form_open_multipart('barang/add'); 
              	?>

              	  <div class="form-group">
                      <label>Nama Barang</label>
                      <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" value="<?= set_value('nama_barang'); ?>">
                      <?= form_error('nama_barang', '<small class="text-danger pl-1">', '</small>'); ?>
                  </div>

                  <div class="row">
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control">
                        	<option value="">--Pilih Kategori--</option>
                        	<?php foreach ($kategori as $key => $value) :?>
                        		<option value="<?= $value->id_kategori; ?>"><?= $value->nama_kategori; ?></option>
                        	<?php endforeach; ?>
                        </select>
                        <?= form_error('id_kategori', '<small class="text-danger pl-1">', '</small>'); ?>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" placeholder="Harga Barang" name="harga" value="<?= set_value('harga'); ?>">
                        <?= form_error('harga', '<small class="text-danger pl-1">', '</small>'); ?>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Berat</label>
                        <input type="number" min="0" class="form-control" placeholder="Berat Dalam Satuan Gram" name="berat" value="<?= set_value('berat'); ?>">
                        <?= form_error('berat', '<small class="text-danger pl-1">', '</small>'); ?>
                      </div>
                    </div>

                  </div>

                  <div class="form-group">
                      <label>Deskripsi</label>
                      <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Barang" rows="5"><?= set_value('deskripsi'); ?></textarea>
                      <?= form_error('deskripsi', '<small class="text-danger pl-1">', '</small>'); ?>
                  </div>

                  <div class="row">
                  	<div class="col-sm-6">
                     <div class="form-group">
                        <label for="exampleInputFile">Gambar</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="gambar" id="preview_gambar" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Choose file max 4mb</label>
                          </div>
                        </div>
                      </div>
                     </div>
	              
                    <div class="col-sm-6">	
  	                  <div class="form-group">
  	                      <img src="<?= base_url('assets/gambar/nofoto.jpg') ?>" id="gambar_load" width="200px" class="rounded mx-auto d-block">
  	                  </div>
	                  </div>
	                </div>

                  <div class="form-group">  
                      <a href="<?= base_url('barang'); ?>" class="btn btn-success btn-sm">Kembali</a>
                      <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                  </div>

                 <?php echo form_close(); ?>

              </div>
            </div>
          </div>

<script>
	function bacaGambar(input){
		if (input.files && input.files[0]) {
			let reader = new FileReader();
			reader.onload = function(e){
				$('#gambar_load').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$('#preview_gambar').change(function(){
		bacaGambar(this);
	});
</script>