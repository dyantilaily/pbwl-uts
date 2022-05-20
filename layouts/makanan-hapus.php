<?php
    
    include "../app/class.php";

    $id = $_GET['id'];
    $makanan = new Makanan();
    $makanan->hapusMakanan($id);
    
?>