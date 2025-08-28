<?php
include 'session.php'; // Include file session.php untuk memulai sesi

// Periksa apakah pengguna telah login sebelumnya
if (!isset($_SESSION['id_login'])) {
    header("Location: login.php"); // Redirect pengguna ke halaman login jika tidak ada sesi yang aktif
    exit;
}

// Proses penambahan kategori saat formulir dikirim
if(isset($_POST['submit'])){
    $nama = $_POST['nama']; // Ambil nilai kategori dari formulir

    // Query SQL untuk menambahkan kategori baru ke database
    $insert = mysqli_query($conn, "INSERT INTO tb_category (category_name) VALUES ('$nama')");

    // Periksa apakah penambahan berhasil
    if($insert){
        echo '<script>alert("Tambah data berhasil")</script>'; // Tampilkan pesan sukses menggunakan alert
        echo '<script>window.location="kategori_data.php"</script>'; // Redirect pengguna ke halaman kategori setelah penambahan berhasil
    } else {
        echo 'Gagal: ' . mysqli_error($conn); // Tampilkan pesan kesalahan jika penambahan gagal
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung XD|Tambah Data</title>
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
</head>
<body>
    <div class="wrapper">
        <div class="header"></div>
        <div class="sidebar">
            <div class="sidebar-title"><b>Admin Dream</b></div>
            <ul>
                <?php include 'sidebar.php' ?>
           </ul>
          </div>
          <div class="section">
            <div class="container">
            <form action="" method="post"> <!-- Formulir untuk menambah kategori -->
                <h3>+Tambah Data Kategori</h3>
                <fieldset>
                    <input type="text" name="nama" placeholder="Nama Kategori" class="form-control" required>
            </fieldset>
            <fieldset>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Tambah</button> <!-- Tombol untuk mengirim formulir -->
        </fieldset>
        </form>
        </div>
    </div>
</body>
</html>
