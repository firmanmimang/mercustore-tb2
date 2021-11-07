  <div class="card card-solid">
    <div class="card-body pb-0">
      <div class="row">
            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch justify-content-center">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  Founder Mercustore
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Firman Hidayat</b></h2>
                      <p class="text-muted text-sm"><b>About: </b> Web Developer / Fullstack Developer / Graphic Artist / Student </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Country: Jakarta, Indonesia</li>
                        <li class="medium mt-3"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone: <?= str_repeat('x', strlen('085712475711')) ?></li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="<?= base_url('assets/founder_fh.png') ?>" alt="" class="img-circle img-thumbnail img-fluid">
                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  Founder Mercustore
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Michael Peter Asher</b></h2>
                      <p class="text-muted text-sm"><b>About: </b> Web Developer / Fullstack Developer / Graphic Artist / Student </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="medium"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Country: Jakarta, Indonesia</li>
                        <li class="medium mt-3"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone: <?= str_repeat('x', strlen('085712475711')) ?></li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="<?= base_url('assets/founder_mpa.png') ?>" alt="" class="img-circle img-thumbnail img-fluid">
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Mercustore</a>
                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Lokasi Toko</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
                <b>Mercu</b>Store dibangun untuk memenuhi tugas besar 2 pemrograman web 2 <br> 
                <b>Mercu</b>Store menjual berbagai barang elektronik
              </div>
              <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
                <b>Mercu</b>Store saat ini berlokasi :<br>
                <?= $lokasi->alamat_toko ?><br>
              </div>
              
            </div>
          </div>

      </div>
    </div>
  </div>

<br>
<br>
<br>
<br>
<br>
<br>
