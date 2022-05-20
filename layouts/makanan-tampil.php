<?php

    include "../app/class.php";

    $makanan = new Makanan();
    $rows = $makanan->tampilMakanan();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Farm|Data Makanan</title>

    <link rel="stylesheet" href="assets/style/style-makanan-tampil.css">
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
        <h1 style="text-align:center">Data Makanan</h1>
        <div class="btn-tambah">
            <a href="makanan-tambah.php">+ Tambah Makanan</a>
        </div>

    <table>
        <tr>
            <th>NO</th>
            <th class="nama-makanan">NAMA MAKANAN</th>
            <th class="harga-makanan">HARGA</th>
            <th colspan="2" class="aksi-makanan">AKSI</t>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td class="id"><?php echo $row['id_makanan']; ?></td>
                <td><?php echo $row['nama_makanan']; ?></td>
                <td>Rp. <?php echo $row['harga_makanan']; ?></td>
                <td><a href="makanan-edit.php?id=<?php echo $row['id_makanan']; ?>" class="edit">EDIT</a></td>
                <td><a href="makanan-hapus.php?id=<?php echo $row['id_makanan']; ?>" class="hapus">HAPUS</a></td>
            </tr>
            <?php } ?>     
    </table>
    </div>

    <footer>
        <p>Created by @Dwi Yanti Laily</p>
    </footer>
    
</body>
</html>


