<?php

    include "../app/class.php";

    $penjaga = new Penjaga();
    $penjaga->tambahPenjaga();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Farm|Tambah Data Penjaga</title>

    <link rel="stylesheet" href="assets/style/style-penjaga-tambah.css">
</head>
<body>
<div class="container">
        <div class="header">
            <img src="assets/img/header.jpg" alt="">
        </div>
        <div class="navigasi">
            <ul>
            <a href="dashboard.php"><li>BERANDA</li></a>
                <a href="penjaga-tampil.php"><li>PENJAGA</li></a>
                <a href="makanan-tampil.php"><li>MAKANAN HEWAN</li></a>
                <a href="hewan-tampil.php"><li>HEWAN</li></a>
            </ul>
        </div>
        <div class="logout">
            <ul>
                <a href="keluar.php">KELUAR
                <a href="keluar.php"><li><img src="assets/img/logout.png" alt="tombol keluar"></li></a>
                </a>
            </ul>
        </div>
    </div>
    <div class="main">
        <h1>Tambah Penjaga</h1>
        <form action="" method="post">
            <ul>
                <li>Nama Penjaga</li>
                <li><input type="text" max-length="50" name="nama-penjaga" class="form-tambah-penjaga" required></li>
            </ul>
            <ul>
                <li>Umur</li>
                <li><input type="text" max-length="50" name="umur-penjaga" class="form-tambah-penjaga" required></li>
            </ul>
            <input type="submit" value="Tambah" name="penjaga-btn-tambah" class="btn-tambah-penjaga">
        </form>
    </div>

    <footer>
        <p>Created by @Dwi Yanti Laily</p>
    </footer>
</body>
</html>

