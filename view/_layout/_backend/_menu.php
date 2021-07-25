<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-dark navbar-lightblue">
      <div class="container">
        <a href="<?=base_url?>" class="navbar-brand">
          <img src="<?=base_url?>assets/back/img/<?=favicon?>" alt="<?=base_name?> Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light" style="font-size: 1em"><?=base_name?></span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">

            <li class="nav-item <?=($data['judul'] == "Dashboard")?'menu-open active' : ''?>">
              <a href="<?=base_url?>admin" class="nav-link">Beranda</a>
            </li>
            
            <?php if ($_SESSION['role_id'] == "2"){ ?>
            <li class="nav-item <?=($data['judul'] == "Katalog")?'menu-open active' : ''?>">
              <a href="<?=base_url?>admin/grid.php" class="nav-link">Katalog Produk</a>
            </li>
            <?php } ?>
            
            <?php if ($_SESSION['role_id'] == "0"){ ?>
            <li class="nav-item <?=($data['judul'] == "Produk")?'menu-open active' : ''?>">
              <a href="<?=base_url?>admin/produk.php" class="nav-link">Data Produk</a>
            </li>
            
            <li class="nav-item <?=($data['judul'] == "Voucher")?'active' : ''?>">
              <a href="<?=base_url?>admin/voucher.php" class="nav-link">Voucher</a>
            </li>

            <!-- <li class="nav-item <?=($data['judul'] == "Pengguna")?'active' : ''?>">
              <a href="<?=base_url?>admin/pengguna.php" class="nav-link">Pengguna</a>
            </li> -->

            <li class="nav-item dropdown <?=($data['judul'] == "Pengguna")?'menu-open active' : ''?>">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="nav-link dropdown-toggle">Pengguna</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="<?=base_url?>admin/admin.php" class="dropdown-item">Admin </a></li>
                <li><a href="<?=base_url?>admin/pemilik.php" class="dropdown-item">Pemilik </a></li>
                <li><a href="<?=base_url?>admin/user.php" class="dropdown-item">User </a></li>
              </ul>
            </li>
            <?php } ?>

            <li class="nav-item <?=($data['judul'] == "Invoices")?'active' : ''?>">
              <a href="<?=base_url?>admin/invoices.php" class="nav-link">Invoices</a>
            </li>

            <li class="nav-item <?=($data['judul'] == "Voucher")?'active' : ''?>">
              <a href="<?=base_url?>admin/voucher.php" class="nav-link">Redeem Voucher</a>
            </li>

            <li class="nav-item <?=($data['judul'] == "Profile")?'active' : ''?>">
              <a href="<?=base_url?>admin/profile.php" class="nav-link">Profile</a>
            </li>

          </ul>

        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge"><?=$data['dataNotifikasi']->num_rows?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-header"><?=$data['dataNotifikasi']->num_rows?> Notifikasi</span>
              <div class="dropdown-divider"></div>
              <?php
              while ($key = $data['dataNotifikasi']->fetch_object()){
                $text = "";
                if ($_SESSION['role_id'] == "2"){
                  $text = "Ada barang yang sedang dikirim";
                }else{
                  $text = "Ada transaksi baru, ayo konfirmasi sekarang";
                }
              ?>
              <a href="<?=base_url?>admin/invoices.php?aksi=view&id=<?=$key->invoices_id?>" class="dropdown-item">
                <i class="fas fa-bell mr-2"></i> <?=$text?>
              </a>
              <div class="dropdown-divider"></div>
              <?php } ?>
            </div>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-user"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-lg">
              <span class="dropdown-header"></span>
              <div class="dropdown-divider"></div>
              <a href="<?=base_url?>admin/profile.php?aksi=edit" class="dropdown-item">
                <div class="media">
                  <img
                  src="<?=base_url?>assets/back/img/<?=($_SESSION['image'] != "")?$_SESSION['image']:'avatar5.png'?>"
                    alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body" style="margin-top: 10px;">
                    <h3 class="dropdown-item-title">
                      <?=$_SESSION['users_nama']?>

                    </h3>
                    <p class="text-sm"><?=$_SESSION['role_id']?></p>
                  </div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?=base_url?>admin/logout.php" class="dropdown-item dropdown-footer">Keluar</a>
            </div>
          </li>
          <li class="nav-item">
            <a href="<?=base_url?>admin/keranjang.php" class="nav-link">
              <i class="fas fa-shopping-cart"></i>
              
              <span class="badge badge-warning navbar-badge"><?=@count($_SESSION['cart'])?></span>
            </a>
          </li>
        </ul>

      </div>
      <!-- /.navbar -->
    </nav>
    
		<div class="content-wrapper">
      	<!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0"><?=$data['judul']?></h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        
        <!-- Main content -->
        <div class="content">
          <div class="container">