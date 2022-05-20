<?php

       include "../app/class.php";

       $id = $_GET['id'];
       $hewan = new Hewan();
       $hewan->hapusHewan($id);

?>