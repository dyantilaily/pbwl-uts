<?php
        
    include "../app/class.php";

    $hewan = new Hewan();
    $penjaga = new Penjaga();
    $makanan = new Makanan();

    $hewan->tambahHewan();
    $rows_makanan = $makanan->tampilMakanan();
    $rows_penjaga = $penjaga->tampilPenjaga();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Farm|Tambah Data Hewan</title>

    <link rel="stylesheet" href="assets/style/style-hewan-tambah.css">
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
        <h1>Tambah Hewan</h1>
        <form action="" method="post">
            <ul>
                <li>Nama Hewan</li>
                <li><input type="text" max-length="50" name="nama-hewan" class="form-tambah-hewan" required></li>
            </ul>
            <ul>
                <li>Jenis Hewan</li>
                <li>
                    <select name="jenis-hewan" id="" class="jenis-hewan">
                        <option value="">Pilih</option>
                        <option value="Unggas">Unggas</option>
                        <option value="Non Unggas">Non Unggas</option>
                    </select>
                </li>
            </ul>
            <ul>
                <li>Makanan</li>
                <li>
                    <select class="makanan-hewan" name="makanan-hewan">
                        <option value="">Pilih</option>
                        <?php foreach ($rows_makanan as $row) { ?>
                            <option value="<?php echo $row['id_makanan']; ?>"><?php echo $row['nama_makanan']; ?></option>
                        <?php } ?>
                    </select>
                 </li>
            </ul>
            <ul>
                <li>Penjaga</li>
                <li>
                <select class="penjaga-hewan" name="penjaga-hewan">
                        <option value="">Pilih</option>
                        <?php foreach ($rows_penjaga as $row) { ?>
                            <option value="<?php echo $row['id_penjaga']; ?>"><?php echo $row['nama_penjaga']; ?></option>
                        <?php } ?>
                    </select>
                 </li>
            </ul>
                    <input type="submit" value="Tambah" name="hewan-btn-tambah" class="btn-tambah-hewan">
        </form>
    </div>

    <footer>
        <p>Created by @Dwi Yanti Laily</p>
    </footer>
</body>
</html>