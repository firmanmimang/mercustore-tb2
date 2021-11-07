          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $title; ?> Website</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <?php 
                  if ($this->session->flashdata('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fas fa-check"></i>';
                    echo $this->session->flashdata('pesan');
                    echo '</div>'
                    ;}

                  echo form_open('admin/setting'); 
                ?>

                  <div class="row">
                    
                    <div class="col-sm-6">  
                      <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinsi" class="form-control"></select>
                      </div>
                    </div>
                
                    <div class="col-sm-6">  
                      <div class="form-group">
                        <label>Kota</label>
                        <select name="kota" class="form-control">
                          <option value="<?= $setting->lokasi ?>"><?= $setting->lokasi ?></option>
                        </select>
                      </div>
                    </div>

                  </div>

                  <div class="row">

                    <div class="col-sm-6">  
                      <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" name="nama_toko" class="form-control" value="<?= $setting->nama_toko; ?>">
                        <?= form_error('nama_toko', '<small class="text-danger pl-1">', '</small>'); ?>
                      </div>
                    </div>

                    <div class="col-sm-6">  
                      <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" value="<?= $setting->no_telepon; ?>">
                        <?= form_error('no_telepon', '<small class="text-danger pl-1">', '</small>'); ?>
                      </div>
                    </div>

                  </div>

                  <div class="form-group">
                    <label>Alamat Toko</label>
                    <input type="text" name="alamat_toko" class="form-control" value="<?= $setting->alamat_toko; ?>">
                    <?= form_error('alamat_toko', '<small class="text-danger pl-1">', '</small>'); ?>
                  </div>

                  <div class="form-group">  
                      <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                  </div>

                  

                <?php echo form_close() ?>

                  </div>
              </div>
            </div>

<script>
  $(document).ready(function(){
    // memasukan data ke select provinsi
    $.ajax({
      type: "POST",
      url: "<?= base_url('rajaongkir/provinsi') ?>",
      success: function(hasil_provinsi){
        // console.log(hasil_provinsi);
        $('select[name=provinsi]').html(hasil_provinsi);
      }
    })

    // masukan data ke select kota
    $('select[name=provinsi').on("change", function(){
      let id_provinsi_terpilih = $("option:selected",this).attr("id_provinsi");

      $.ajax({
        type: "POST",
        url: "<?= base_url('rajaongkir/kota') ?>",
        data: 'id_provinsi=' + id_provinsi_terpilih,
        success: function(hasil_kota){
          // console.log(hasil_kota);
          $('select[name=kota]').html(hasil_kota);
        }
      });
    });
  });
</script>