<?php
include 'db.php';

// Ambil data kontak admin
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

// Ambil kategori dengan error handling
$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC LIMIT 8");

// Ambil produk berdasarkan kategori yang dipilih dengan prepared statement
if (isset($_GET['kat']) && is_numeric($_GET['kat'])) {
    $category_id = (int)$_GET['kat'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM tb_product WHERE category_id = ? AND product_status = 1 ORDER BY product_id DESC LIMIT 50");
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $produk = mysqli_stmt_get_result($stmt);
} else {
    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 50");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Teen Dream - Toko Online Fashion Remaja Terlengkap">
    <title>Teen Dream - Fashion Remaja Terkini</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Pink Theme Enhancements */
        :root {
            --primary-pink: #ff69b4;
            --light-pink: #ffb6c1;
            --dark-pink: #e1477f;
            --pale-pink: #ffeef2;
            --white: #ffffff;
            --gray: #666666;
            --light-gray: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, var(--pale-pink) 0%, var(--white) 100%);
            color: #333;
        }

        /* Header Improvements */
        header {
            background: linear-gradient(135deg, var(--primary-pink), var(--dark-pink));
            box-shadow: 0 2px 20px rgba(255, 105, 180, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-container h1 a {
            transition: transform 0.3s ease;
        }

        .header-container h1 a:hover {
            transform: scale(1.05);
        }

        /* Search Container */
        .search-container {
            flex: 1;
            max-width: 400px;
            margin: 0 2rem;
        }

        .search-wrapper {
            position: relative;
            display: flex;
            background: var(--white);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .search-wrapper input[type="text"] {
            flex: 1;
            padding: 12px 20px;
            border: none;
            outline: none;
            font-size: 16px;
            font-family: 'Quicksand', sans-serif;
        }

        .search-button {
            background: var(--primary-pink);
            border: none;
            padding: 12px 15px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .search-button:hover {
            background: var(--dark-pink);
        }

        /* Login Container */
        .login-container {
            list-style: none;
        }

        .login-container a {
            display: flex;
            align-items: center;
            padding: 8px 16px;
            background: rgba(255,255,255,0.2);
            border-radius: 20px;
            text-decoration: none;
            color: var(--white);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-container a:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        /* Ads Slider */
        .ads {
            margin: 2rem 0;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(255, 105, 180, 0.2);
        }

        .slider {
            display: flex;
            animation: slide 30s infinite linear;
        }

        .slider img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 10px;
        }

        @keyframes slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Section Styling */
        .section {
            margin: 3rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .box {
            display: grid;
            gap: 20px;
        }

        /* Category Grid */
        .category-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }

        .col-5 {
            background: var(--white);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.1);
            border: 2px solid transparent;
        }

        .col-5:hover {
            transform: translateY(-5px);
            border-color: var(--light-pink);
            box-shadow: 0 8px 25px rgba(255, 105, 180, 0.2);
        }

        .col-5 i {
            font-size: 2rem;
            color: var(--primary-pink);
            margin-bottom: 10px;
        }

        .col-5 p {
            font-weight: 600;
            color: var(--dark-pink);
            margin: 0;
        }

        /* Product Grid */
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }

        .col-4 {
            background: var(--white);
            border-radius: 15px;
            padding: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.1);
            overflow: hidden;
        }

        .col-4:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(255, 105, 180, 0.2);
        }

        .col-4 img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .nama {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.4;
        }

        .product-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stok {
            background: var(--light-pink);
            color: var(--dark-pink);
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .harga {
            font-weight: 700;
            color: var(--primary-pink);
            font-size: 16px;
        }

        /* Section Headers */
        .section-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-header h2 {
            color: var(--dark-pink);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .section-header p {
            color: var(--gray);
            font-size: 1.1rem;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--dark-pink), var(--primary-pink));
            color: var(--white);
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer h4 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--white);
        }

        .footer p {
            margin-bottom: 5px;
            opacity: 0.9;
        }

        .footer small {
            text-align: center;
            display: block;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.2);
            opacity: 0.8;
        }

        /* Loading Animation */
        .loading {
            text-align: center;
            padding: 2rem;
            color: var(--gray);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 1rem;
            }

            .search-container {
                margin: 0;
                max-width: 100%;
            }

            .section-header h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <h1><a href="index.php"><img src="img/logo.png" alt="Teen Dream Logo" height="60" width="100"></a></h1>
            <div class="search-container">
                <form action="produk_cari.php" method="POST">
                    <div class="search-wrapper">
                        <input type="text" name="search" placeholder="Cari produk impianmu..." required>
                        <button type="submit" name="cari" class="search-button">
                            <i class="fas fa-search" style="color: white;"></i>
                        </button>
                    </div>
                </form>
            </div>
            <ul class="login-container">
                <li><a href="login.php"><i class="fas fa-user"></i> Login</a></li>
            </ul>
        </div>
    </header>

    <!-- Ads Slider -->
    <div class="ads">
        <div class="container">
            <div class="slider">
                <img src="img/ads11.png" alt="Promo 1">
                <img src="img/ads6.jpg" alt="Promo 2">
                <img src="img/ads8.jpeg" alt="Promo 3">
                <img src="img/ads11.png" alt="Promo 4">
                <img src="img/ads6.jpg" alt="Promo 5">
                <img src="img/ads8.jpeg" alt="Promo 6">
            </div>
        </div>
    </div>

    <!-- Kategori -->
    <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>Kategori Favorit</h2>
                <p>Temukan style yang sesuai dengan kepribadianmu</p>
            </div>
            <div class="box category-grid">
                <?php 
                if (mysqli_num_rows($kategori) > 0) {
                    // Icon mapping untuk kategori
                    $category_icons = [
                        'Dress' => 'fas fa-tshirt',
                        'Top' => 'fas fa-vest',
                        'Bottom' => 'fas fa-socks',
                        'Outer' => 'fas fa-vest-patches',
                        'Shoes' => 'fas fa-shoe-prints',
                        'Accessories' => 'fas fa-gem',
                        'Bag' => 'fas fa-shopping-bag',
                        'Beauty' => 'fas fa-magic'
                    ];
                    
                    while ($k = mysqli_fetch_array($kategori)) {
                        $icon = $category_icons[$k['category_name']] ?? 'fas fa-star';
                        ?>
                        <a href="index.php?kat=<?php echo htmlspecialchars($k['category_id']) ?>" style="text-decoration: none;">
                            <div class="col-5">
                                <i class="<?php echo $icon ?>"></i>
                                <p><?php echo htmlspecialchars($k['category_name']) ?></p>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <div class="loading">
                        <i class="fas fa-heart-broken" style="font-size: 3rem; color: var(--light-pink); margin-bottom: 1rem;"></i>
                        <p>Kategori sedang dalam pembaruan</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Produk Terbaru -->
    <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>Produk Terbaru</h2>
                <p>Koleksi terdepan untuk remaja kekinian</p>
            </div>
            <div class="box product-grid">
                <?php 
                if (mysqli_num_rows($produk) > 0) {
                    while ($p = mysqli_fetch_array($produk)) {
                        ?>
                        <a href="detail_produk.php?id=<?php echo htmlspecialchars($p['product_id']) ?>" style="text-decoration: none; color: inherit;">
                            <div class="col-4">
                                <img src="produk/<?php echo htmlspecialchars($p['product_image']) ?>" 
                                     alt="<?php echo htmlspecialchars($p['product_name']) ?>" 
                                     onerror="this.src='img/no-image.png'">
                                <p class="nama"><?php echo htmlspecialchars(substr($p['product_name'], 0, 40)) ?><?php echo strlen($p['product_name']) > 40 ? '...' : '' ?></p>
                                <div class="product-info">
                                    <span class="stok">
                                        <i class="fas fa-box"></i> Stok <?php echo number_format($p['stok']) ?>
                                    </span>
                                    <span class="harga">
                                        Rp <?php echo number_format($p['product_price']) ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <div class="loading">
                        <i class="fas fa-search" style="font-size: 3rem; color: var(--light-pink); margin-bottom: 1rem;"></i>
                        <p>Produk tidak ditemukan untuk kategori ini</p>
                        <p><a href="index.php" style="color: var(--primary-pink);">Lihat semua produk</a></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="footer-content">
                <div>
                    <h4><i class="fas fa-map-marker-alt"></i> Alamat</h4>
                    <p><?php echo htmlspecialchars($a->admin_address ?? 'Alamat tidak tersedia') ?></p>
                </div>
                <div>
                    <h4><i class="fas fa-envelope"></i> Email</h4>
                    <p><?php echo htmlspecialchars($a->admin_email ?? 'Email tidak tersedia') ?></p>
                </div>
                <div>
                    <h4><i class="fas fa-phone"></i> No. HP</h4>
                    <p><?php echo htmlspecialchars($a->admin_telp ?? 'Nomor tidak tersedia') ?></p>
                </div>
            </div>
            <small>Copyright &copy; 2024 - Teen Dream Fashion. Made with <i class="fas fa-heart" style="color: var(--light-pink);"></i></small>
        </div>
    </div>

    <script>
        // Simple fade-in animation
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.col-4, .col-5');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.6s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Search form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput.value.trim() === '') {
                e.preventDefault();
                searchInput.focus();
                searchInput.placeholder = 'Masukkan kata kunci pencarian';
            }
        });
    </script>
</body>
</html>