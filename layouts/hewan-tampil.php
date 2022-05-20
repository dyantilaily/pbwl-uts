<?php
    
    include "../app/class.php";

    $hewan = new Hewan();
    $rows = $hewan->tampilHewan();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Farm|Data Hewan</title>

    <link rel="stylesheet" href="assets/style/style-hewan-tampil.css">
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
        <h1 style="text-align:center">Data Hewan</h1>
        <div class="btn-tambah">
            <a href="hewan-tambah.php">+ Tambah Hewan</a>
        </div>

    <table>
        <tr>
            <th>NO</th>
            <th class="nama-hewan">NAMA HEWAN</th>
            <th class="jenis-hewan">JENIS</th>
            <th class="makanan-hewan">MAKANAN</th>
            <th class="penjaga-hewan">PENJAGA</th>
            <th colspan="2" class="aksi-hewan">AKSI</t>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td class="id"><?php echo $row['id_hewan']; ?></td>
                <td><?php echo $row['nama_hewan']; ?></td>
                <td><?php echo $row['jenis_hewan']; ?></td>
                <td class="makanan_hewan"><?php echo $row['nama_makanan']; ?></td>
                <td><?php echo $row['nama_penjaga']; ?></td>
                <td class="tombol"><a href="hewan-edit.php?id=<?php echo $row['id_hewan']; ?>" class="edit">EDIT</a></td>
                <td class="tombol"><a href="hewan-hapus.php?id=<?php echo $row['id_hewan']; ?>" class="hapus">HAPUS</a></td>
            </tr>
            <?php } ?>     
    </table>

    </div>

    <footer>
        <p>Created by @Dwi Yanti Laily</p>
    </footer>
    
</body>
</html>


