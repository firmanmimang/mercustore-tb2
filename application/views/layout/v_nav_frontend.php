  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="<?= base_url(); ?>" class="navbar-brand">
        <img src="<?= base_url('assets/mercustorelogopas.png') ?>" height="30px">
        <span class="brand-text font-weight-light"><b>Mercu</b>Store</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">

          <li class="nav-item">
            <a href="<?= base_url(); ?>" class="nav-link <?php if($this->uri->segment(1)== '' && $this->uri->segment(2)!= 'about' && $this->uri->segment(2)!= 'kategori') echo 'active' ?>">Home</a>
          </li>

          <?php $kategori= $this->m_home->get_all_data_kategori(); ?>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle <?php if($this->uri->segment(2)== 'kategori') echo 'active' ?>">Kategori</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

              <?php foreach ($kategori as $key => $value): ?>
                <li><a href="<?= base_url('home/kategori/'.$value->id_kategori); ?>" class="dropdown-item <?php if($this->uri->segment(3)== $value->id_kategori) echo 'active' ?>"><?= $value->nama_kategori; ?></a>
                </li>   
          
              <?php endforeach ?>

            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('home/about'); ?>" class="nav-link <?php if($this->uri->segment(2)== 'about') echo 'active' ?>">About</a>
          </li>

        </ul>

      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->

        <li class="nav-item dropdown">
          <?php 
            $id= $this->db->get_where('tbl_pelanggan', ['username_pelanggan' => $this->session->userdata('username_pelanggan')])->row();
          ?>
          <?php if ($id == ""): ?>
            <?php  
              $this->session->unset_userdata('username_pelanggan');
              $this->session->unset_userdata('email');
              $this->session->unset_userdata('foto');
            ?>
            <a class="nav-link" href="<?= base_url('pelanggan/login') ?>">
              <span class="brand-text font-weight-light mr-1"><b>Login/Register</b></span>
              <img src="<?= base_url('assets/foto/default.jpg'); ?>" alt="AdminLTE Logo" class="brand-image img-circle"
                   style="opacity: .8">       
            </a>
          <?php else: ?>

            <!-- get jumlah pesanan pelanggan -->
            <?php 
              $jmlPesanan = $this->db->get_where('tbl_transaksi', ['id_pelanggan' => $id->id_pelanggan])->num_rows();
            ?>

            <a class="nav-link" data-toggle="dropdown" href="#">
              <span class="brand-text font-weight-light mr-1"><b><?= $this->session->userdata('username_pelanggan') ?></b></span>
              <img src="<?= !empty($this->session->userdata('foto')) ? base_url('assets/foto/'. $this->session->userdata('foto')) : base_url('assets/foto/default.jpg')?>" alt="AdminLTE Logo" class="brand-image img-circle"
                   style="opacity: .8">       
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('pelanggan/akun/'.$this->session->userdata('username_pelanggan')) ?>" class="dropdown-item"><i class="fas fa-user mr-2"></i> Akun Saya</a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('pesanan_saya') ?>" class="dropdown-item">
                <i class="fas fa-shopping-cart mr-2"></i> Pesanan Saya
                <span class="float-right badge badge-danger"><?= $jmlPesanan ?></span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('pelanggan/logout') ?>" class="dropdown-item dropdown-footer">Log Out</a>
            </div>
          <?php endif ?>
          
        </li>

      <?php 
        $keranjang = $this->cart->contents();
        $jml_item = 0;
        foreach ($keranjang as $key => $value) {
          $jml_item= $jml_item + $value['qty'];
        }
      ?>

        <!-- keranjang belanja -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge badge-danger navbar-badge"><?= $jml_item; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <?php if (empty($keranjang)): ?>
              <a href="#" class="dropdown-item">
                <p>Keranjang Belanja Kosong</p>
              </a>
            <?php else: ?>
              <!-- barang Start -->
              <?php foreach ($keranjang as $key => $value) : ?>
              <?php $barang = $this->m_home->detail_barang($value['id']); ?>

              <a href="#" class="dropdown-item">
                
                <div class="media">
                  <img src="<?= base_url('assets/gambar/'.$barang->gambar); ?>" alt="User Avatar" class="img-size-50 mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      <p class="text-sm"><?= $value['name']; ?></p>
                    </h3>
                    <p class="text-sm"><?= $value['qty'] ?> x Rp. <?= number_format($value['price'],0); ?></p>
                    <p class="text-sm text-muted"><i class="fa fa-calculator mr-1"></i> Rp. <?= number_format($value['subtotal']); ?></p>
                  </div>
                </div>
                
              </a>
              <div class="dropdown-divider"></div>

              <?php endforeach ?>
              <!-- barang End -->
              
              <!-- grand total -->
              <a href="#" class="dropdown-item">
                
                <div class="media">
                  <div class="media-body">
                    <tr>
                        <td colspan="2"> </td>
                        <td class="right"><strong>Total : </strong></td>
                        <td class="right">Rp. <?= $this->cart->format_number($this->cart->total()); ?></td>
                    </tr>
                  </div>
                </div>
                
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('belanja') ?>" class="dropdown-item dropdown-footer">View Cart</a>
              <a href="<?= base_url('belanja/checkout') ?>" class="dropdown-item dropdown-footer">Checkout</a>
            <?php endif ?>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        
       
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $title; ?></h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- content-main -->
    <div class="content">
      <div class="container">