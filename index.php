
<?php

    include "app/class.php";

    $user = new Users();
    $user->loginUser();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Farm</title>

    <link rel="stylesheet" href="layouts/assets/style/style-index.css">
</head>
<body>
    <div class="header">
        <img src="assets/img/header.jpg" alt="">
    </div>    
    <div class="login">
    <form action="" method="post" id="form-masuk">  
        <h1>Masuk</h1>  
        <ul>
            <li><p>Username</p></li>
            <li><input type="text" name="masuk-uname" class="form-masuk" required placeholder="Masukkan Username"></li>
        </ul>
        <ul>
            <li><p>Password</p></li>
            <li><input type="password" name="masuk-password" class="form-masuk" required placeholder="Masukkan Password"></li>
        </ul>
        <ul>
            <li><input type="submit" name="btn-masuk" value="Masuk" class="btn-masuk"></li>
        </ul>
    </form>
    <form action="layouts/daftar.php" method="post" id="form-masuk">
        <ul>
            <li><input type="submit" name="btn-registrasi" value="Registrasi" class="btn-daftar"></li>
        </ul>
    </form>
    </div>
    <footer>
        <p>Created by @Dwi Yanti Laily</p>
    </footer>
</body>
</html>