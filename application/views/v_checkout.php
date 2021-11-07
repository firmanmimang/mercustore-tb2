            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-shopping-cart"></i> <b>Mercu</b>Store</a>
                    <small class="float-right">Date: <?= date('d-m-y') ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">

                <div class="col-12">

                  <table class="table table-striped" id="example2">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                        <th>Berat</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php 
                        $no = 1;
                        $i = 1; 
                        $total_berat= 0;
                      ?>

                      <?php foreach ($this->cart->contents() as $items): ?>
                      <?php 
                        $barang = $this->m_home->detail_barang($items['id']); 
                        $berat= $items['qty']*$barang->berat;
                        $total_berat += $berat
                      ?>

                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?php echo $items['name']; ?></td>
                        <td><?php echo $items['qty']; ?></td>
                        <td>Rp. <?php echo number_format($items['price'],0); ?></td>
                        <td>Rp. <?php echo number_format($items['subtotal'],0); ?></td>
                        <td><?= $berat?> G.</td>
                      </tr>

                      <?php endforeach; ?>   
                    
                    </tbody>

                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <?php 
                echo validation_errors('<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-exclamation-triangle"></i>', '</div>');
              ?>

              <?php 
                echo form_open('belanja/checkout');
                $no_order = date('Ymd').strtoupper(random_string('alnum',8));
              ?>
              <div class="row">
                <!-- tujuan -->
                <div class="col-12 col-md-8 invoice-col">
                  Tujuan :
                  <div class="row">
                    
                    <div class="col-sm-6">  
                      <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinsi" class="form-control"></select>
                      </div>
                    </div>
                
                    <div class="col-sm-6">  
                      <div class="form-group">
                        <label>Kota/Kabupaten</label>
                        <select name="kota" class="form-control"></select>
                      </div>
                    </div>

                    <div class="col-sm-6">  
                      <div class="form-group">
                        <label>Ekspedisi</label>
                        <select name="ekspedisi" class="form-control"></select>
                      </div>
                    </div>

                    <div class="col-sm-6">  
                      <div class="form-group">
                        <label>Paket</label>
                        <select name="paket" class="form-control"></select>
                      </div>
                    </div>

                    <div class="col-sm-8">  
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                      </div>
                    </div>

                    <div class="col-sm-4">  
                      <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" class="form-control" required>
                      </div>
                    </div>

                    <div class="col-sm-6">  
                      <div class="form-group">
                        <label>Nama Penerima</label>
                        <input type="text" name="nama_penerima" class="form-control" required>
                      </div>
                    </div>

                    <div class="col-sm-6">  
                      <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="tlp_penerima" class="form-control" required>
                      </div>
                    </div>

                  </div>
                </div>
                <!-- /.col -->
                <div class="col-12 col-md-4 table-responsive">
                  <div class="">
                    <table class="table">
                      <tr>
                        <th>Berat:</th>
                        <td class="text-right"><?= $total_berat; ?> G.</td>
                      </tr>
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td class="text-right">Rp. <?php echo number_format($this->cart->total(),0); ?></td>
                      </tr>
                      <tr>
                        <th>Ongkir:</th>
                        <td class="text-right" id="ongkir"></td>
                      </tr>
                      <tr>
                        <th>Grandtotal:</th>
                        <td class="text-right" id="total_bayar"></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- simpan transaksi -->
              <input type="hidden" name="no_order" value="<?= $no_order; ?>">
              <input type="hidden" name="estimasi">
              <input type="hidden" name="ongkir">
              <input type="hidden" name="berat" value="<?= $total_berat; ?>">
              <br>
              <input type="hidden" name="sub_total" value="<?= $this->cart->total(); ?>">
              <input type="hidden" name="grand_total">
              <!-- end simpan transaksi -->
              <!-- simpan rinci transaksi -->
              <?php 
                $i= 1;
                foreach ($this->cart->contents() as $items) {      
                  echo form_hidden('qty'.$i++, $items['qty']);
                } 
              ?>
              <!-- end rinci transaksi -->
              <div class="row no-print">
                <div class="col-12 col-md-6 mt-1">
                  <a href="<?= base_url('belanja') ?>" class="btn btn-warning btn-block"><i class="fas fa-backward"></i> Kembali Ke Keranjang</a>
                </div>
                <div class="col-12 col-md-6 mt-1">
                  <button type="submit" class="btn btn-primary btn-block" style="margin-right: 5px;">
                    <i class="fas fa-shopping-cart"></i> Proses Check Out
                  </button>
                </div>
              </div>

              <?php 
                echo form_close();
              ?>

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

    // masukan nama ekspedisi
    $('select[name=kota').on("change", function(){

      $.ajax({
        type: "POST",
        url: "<?= base_url('rajaongkir/ekspedisi') ?>",
        success: function(hasil_ekspedisi){
          $('select[name=ekspedisi]').html(hasil_ekspedisi);
        }
      });
    });

    // masukan paket
    $('select[name=ekspedisi').on("change", function(){
      // mendapatkan ekspedisi terpilih
      let ekspedisi_terpilih= $('select[name=ekspedisi]').val();
      // mendapatkan id kota terpilih
      let id_kota_tujuan_terpilih= $("option:selected","select[name=kota]").attr("id_kota");
      // ambil data ongkos kirim
      let total_berat = <?= $total_berat; ?>;

      $.ajax({
        type: "POST",
        url: "<?= base_url('rajaongkir/paket') ?>",
        data: 'ekspedisi='+ ekspedisi_terpilih +'&id_kota='+ id_kota_tujuan_terpilih +'&berat='+ total_berat,
        success: function(hasil_paket){
          // console.log(hasil_paket);
          $('select[name=paket]').html(hasil_paket);
        }
      });
    });

    // saat klik paket
    $('select[name=paket').on("change", function(){
      // tampil ongkir
      let data_ongkir = $("option:selected",this).attr("ongkir");
      // format rupiah js
      function rubah(angka){
        var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join(',').split('').reverse().join('');
        return ribuan;
      }

      $('#ongkir').html('Rp. '+rubah(data_ongkir));
      // itung total grand
      let grand_total = parseInt(data_ongkir)+parseInt(<?= $this->cart->total() ?>)

      $('#total_bayar').html('Rp. '+rubah(grand_total));

      // estimasi dan ongkir utk input hidden
      let estimasi = $("option:selected",this).attr("estimasi");

      $("input[name=estimasi]").val(estimasi);
      $("input[name=ongkir]").val(data_ongkir);
      $("input[name=grand_total]").val(grand_total);

    });
  });
</script>