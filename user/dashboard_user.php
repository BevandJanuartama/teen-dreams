<?php
include('session.php')
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <title>Teen Dream</title>
</head>

<body>
    <header>
        <div class="container header-container"><h1><a href="../index.php"><img src="../img/logo.png" height="108px" width="184px"></a></h1>
        
            
        <ul>
            <?php include 'navbar.php' ?>
        </ul>   
            </div>
    </header>


<div class="ads">
        <div class="slider">
            <img src="../img/ads11.png">
            <img src="../img/ads6.jpg">
            <img src="../img/ads8.jpeg">
            <img src="../img/ads11.png">
            <img src="../img/ads6.jpg">
            <img src="../img/ads8.jpeg">
            <img src="../img/ads11.png">
            <img src="../img/ads6.jpg">
            <img src="../img/ads8.jpeg">
            <img src="../img/ads11.png">
            <img src="../img/ads6.jpg">
            <img src="../img/ads8.jpeg">
        </div>
    </div>


        <div class="section">
            <div class="container">

            

            <div class="box">
                <h4>Welcome <?php echo $user_row["admin_name"]?> please check out your purchase. </h4>
            </div>
        </div>
    </div>

    <footer>
    <div class="container">
        <small>Copyright &copy; 2023/2024 - Warung XD RPL.</small>
    </div>
</footer>
</body>
</html>