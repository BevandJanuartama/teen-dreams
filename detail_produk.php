<?php
error_reporting(0);
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

$product = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
$p = mysqli_fetch_object($product);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Januartama Shop</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!--header-->
    <header>
        <div class="container header-container">
            <h1><a href="index.php"><img src="img/logo.png" height="108px" width="184px"></a></h1>
            <div class="search-container">
                <form action="produk_cari.php" method="POST">
                    <div class="search-wrapper">
                        <input type="text" name="search" placeholder="Search Product">
                        <input type="image" name="cari" src="img/search2.png" alt="Search" class="search-button" width="26px" height="26px">
                    </div>
                </form>
            </div>
            <ul class="login-container">
                <li><a href="login.php"><img src="img/login2.png" width="120px" height="120px"></a></li>
            </ul>
        </div>
    </header>
</body>

  
<!--product detail-->
    <div class="section">
        <div class="container">
            <h3>Detail Product</h3>
            <div class="box">

                <div class="col-2">
                    <img src="produk/<?php echo $p->product_image ?>" width="450px" height="450px">
                </div>

                <div class="col-2">
                    <h3><?php echo $p->product_name ?></h3>
                    <h3>Rp. <?php echo number_format($p->product_price) ?></h3>
                    <h3>Stok <?php echo number_format($p->stok) ?></h3>
                    <p>Description :<br>
                        <?php echo $p->product_description ?>
                    </p>
                    <a href="login.php"><img src="img/basket.png" width="44px" height="44px" title="Tambahkan Keranjang"></a>
                    <a href="https://api.whatsapp.com/send?phone=6281349335089  <?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank"><img src="img/wa.png" width="40px" height="40px" Contact via Whatsapp, Click Here.</a>
                    
                </div>
            </div>
        </div>
    </div>
    <!--footer-->
    <div class="footer">
    <div class="container">
        <h4>Address</h4>
        <p><?php echo $a->admin_address ?></p>
        
        <h4>Email</h4>
        <p><?php echo $a->admin_email ?></p>
        
        <h4>No. Hp</h4>
        <p><?php echo $a->admin_telp?></p>
        <small>Copyright &copy; 2023/2024 - Warung XD RPL.</small>
    </div>

</div>
</body>
</html>