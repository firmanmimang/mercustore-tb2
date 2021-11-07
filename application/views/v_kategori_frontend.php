  <!-- slider -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slider1.jpg">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slider2.jpg">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slider3.jpg">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="<?= base_url(); ?>assets/slider/slider4.jpg">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="card card-solid">
    <div class="card-body pb-0">
      <div class="row tm-gallery">

        <?php foreach ($barang as $key => $value): ?>
          
           <!-- card tampil barang -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-flex align-items-stretch justify-content-center">
              <div class="card">
              <!-- pake form_open error -->
              <form action="<?= base_url('belanja/add'); ?>" method="post">
              <?php 
                echo form_hidden('id', $value->id_barang);
                echo form_hidden('qty', 1);
                echo form_hidden('price', $value->harga);
                echo form_hidden('name', $value->nama_barang);
                echo form_hidden('redirect_page', str_replace('index.php/', '' , current_url()));
              ?>
              
              <article class="tm-gallery-item">
                <figure>
                  <img src="<?= base_url('assets/gambar/'). $value->gambar; ?>" alt="Image" class="img-fluid tm-gallery-img" />
                  <div class="card-body">
                  <figcaption>
                    <div class="row">
                      <div class="col-sm-12">
                        <h4 class="tm-gallery-title"><b><?= $value->nama_barang; ?></b></h4>
                        <p class="text-muted text-sm"><b>Kategori: </b><?= $value->nama_kategori; ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">   
                        <p class="tm-gallery-price">Rp. <?= number_format($value->harga,0); ?></p>
                      </div>
                      <div class="col-sm-6 "> 
                        <div class="text-right">
                          <a href="<?= base_url('home/detail_barang/'.$value->id_barang) ?>" class="btn btn-sm bg-success mb-1">
                            <i class="fas fa-eye"></i>
                          </a>
                          <button type="submit" class="btn btn-sm btn-primary mb-1 swalDefaultSuccess">
                            <i class="fas fa-cart-plus"></i> Add
                          </button>
                        </div>
                    </div>
                  </figcaption>
                  </div>
                </figure>
              </article>

              </form>
              <!-- end form -->
              </div>
            </div>

        <?php endforeach; ?>
        <!-- endforeach -->

      </div>
    </div>
  </div>

<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>template/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: ' Barang Berhasil Ditambahkan Ke Keranjang'
      })
    });
  });
</script>