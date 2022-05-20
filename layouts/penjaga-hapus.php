<?php
   
   include "../app/class.php";

   $id = $_GET['id'];
   $penjaga = new Penjaga();
   $penjaga->hapusPenjaga($id);

?>