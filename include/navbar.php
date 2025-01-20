
<!-- Navbar Start -->

<nav class="navbar sticky-top ">
    <div class="container-fluid">
  
    <a href="index.php" class="navbar-logo">CR <span>Hijup</span> </a>
    <div class="navbar-menu">
        <a href="index.php">Beranda</a>
        <a href="produk.php">Produk</a>
        <a href="about.php">Tentang Kami</a>
        <a href="contact.php">Kontak</a>
    </div>
    <div class="navbar-icon">
        <a href="#" id="btn-serach"><i class="ti-search"></i></a>
        <?php
        // Hitung total item dalam keranjang
        $total_items = 0;
        if (isset($_SESSION['keranjang_belanja'])) {
            $total_items = array_sum($_SESSION['keranjang_belanja']);
        }
        ?>
        <a href="keranjang.php" class="cart-icon">
            <i class="ti-shopping-cart"></i>
            <span class="cart-badge"><?= $total_items; ?></span>
        </a>
        <a href="login.php" id="btn-user"><i class="ti-user"></i></a>
        <a href="#" id="btn-menu"><i class="ti-menu"></i></a>

        <form action="produk.php" method="get">
            <div class="search-form">
                <input type="search" name="keyword" id="search-box" class="form-control" placeholder="Search">
                <button for="search-box" class="btn btn-primary">
                    <i class="ti-search"></i>
                </button>
            </div>
        </form>

    </div>
    <div class="user">
        <?php if (isset($_SESSION['pelanggan'])): ?>
            <li class=""><a href="pelanggan/index.php">Profile</a></li>
            <li class="#"><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li class=""><a href="login.php">Login</a></li>
            <li class=""><a href="register.php">Daftar</a></li>
        <?php endif; ?>
    </div>
    </div>
   
</nav>

<!-- Navbar End -->