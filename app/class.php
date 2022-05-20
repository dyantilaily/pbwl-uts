<?php

$vendor_path = dirname($_SERVER["PHP_SELF"]) == "/myfarm/layouts" ? "../vendor/autoload.php":"vendor/autoload.php"; 


require $vendor_path;

use Respect\Validation\Validator as v;

class Koneksi{

    protected $db; 
        
        public function __construct() 
        { 
            try { 
            $this->db = new PDO("mysql:host=localhost;dbname=dbmyfarm", "root", "");
        }
        catch (PDOException $e) { 
            die ("Error " . $e->getMessage()); 
        } 
    }
}

class Users extends Koneksi {
    public function loginUser()
    {
        if(isset($_POST['btn-masuk'])){
            $uname = $_POST['masuk-uname'];
            $password = MD5($_POST['masuk-password']);
    
    
            $sql = "SELECT * FROM tb_user WHERE uname_user= :uname AND password= :pass";
    
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":uname", $uname);
            $stmt->bindParam(":pass", $password);
            $stmt->execute();
        
            $row = $stmt->rowCount();

    
            if($row == 1){
                $_SESSION['masuk-uname'] = $uname;
                header("location: layouts/dashboard.php");
                $_SESSION['is_login'] == 1;
            }else{
    
            header("location: layouts/pesan.php?pesan=1");
            }
        }
    }

    public function tambahUser()
    {
        if (isset($_POST['btn-daftar'])) {
            $nama = $_POST['daftar-nama'];
            $tgllahir = $_POST['daftar-tgllahir'];
            $uname = $_POST['daftar-uname'];
            $password = md5($_POST['daftar-password']);
            $error = false;
    
            echo "<div class='error'>";

            if(!v::date()->validate($tgllahir)) {
                echo "Tgl Error <br>";
                $error = true;
            }  
            
            if(!v::stringType()->length(3, 128)->validate($nama)) {
                echo "Nama Minimal 3 - 128 Karakter <br>";
                $error = true;
            } 
            
            if(!v::alpha(' ')->validate($nama)) {
                echo "Nama Hanya Menggunakan Huruf <br>";
                $error = true;
            } 
            
            if(!v::stringType()->length(6, 16)->validate($uname)) {
                echo "Username Minimal 6 - 16 Karakter <br>";
                $error = true;
            } 
            
            if(!v::alnum('.','_')->validate($uname)) {
                echo "Username Hanya Menggunakan Huruf dan Angka <br>";
                $error = true;
            }
            
            if(!v::alnum()->validate($password)) {
                echo "Password Hanya Menggunakan Huruf dan Angka <br>";
                $error = true;
            }

            if(!v::stringType()->length(8, 16)->validate($password)) {
                echo "Password Minimal 8 - 16 Karakter <br>";
                $error = true;
            }

            echo "</div>";
            if (!$error){
                $sql = "INSERT INTO tb_user (nama_user, tgllahir_user, uname_user, password)
                    VALUES(:nama_user, :tgllahir_user, :uname_user, :password)";
            
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":nama_user", $nama);
                $stmt->bindParam(":tgllahir_user", $tgllahir);
                $stmt->bindParam(":uname_user", $uname);
                $stmt->bindParam(":password", $password);
                $stmt->execute();
            
                header("location: ../layouts/pesan.php?pesan=11");
            }
        }
    }

    public function exitUser()
    {
        session_start();
        session_destroy();
 
        header("Location: ../index.php");
    }
}

class Penjaga extends Koneksi {
    public function tampilPenjaga()
    {
        $sql = "SELECT * FROM tb_penjaga ORDER BY id_penjaga ASC";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $data = [];
        while ($rows = $stmt->fetch())
        {
            $data[] = $rows;
        }
        return $data;
    }

    public function tambahPenjaga()
    {
        if (isset($_POST['penjaga-btn-tambah'])) {
          
            $penjaga_nama = $_POST['nama-penjaga'];
            $penjaga_umur = $_POST['umur-penjaga'];
            //SQL
            $sql = "INSERT INTO tb_penjaga (nama_penjaga, umur_penjaga) VALUES
            (:nama_penjaga, :umur_penjaga)";
           
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":nama_penjaga", $penjaga_nama);
            $stmt->bindParam(":umur_penjaga", $penjaga_umur);
            $stmt->execute();
            
            header("location: pesan.php?pesan=10");
        }
    }

    public function getPenjaga($id)
    {
        $sql = "SELECT * FROM tb_penjaga WHERE id_penjaga=:id_penjaga";
            
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_penjaga", $id);
        $stmt->execute();
        
        $row = $stmt->fetch();

        return $row;
    }

    public function editPenjaga($id)
    {   
        if (isset($_POST['penjaga-btn-edit'])) {
            
            $penjaga_nama = $_POST['nama-penjaga'];
            $penjaga_umur = $_POST['umur-penjaga'];

            $sql = "UPDATE tb_penjaga SET nama_penjaga=:nama_penjaga, umur_penjaga=:umur_penjaga WHERE id_penjaga=:id_penjaga";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_penjaga", $id);
            $stmt->bindParam(":nama_penjaga", $penjaga_nama);
            $stmt->bindParam(":umur_penjaga", $penjaga_umur);
            $stmt->execute();
            
            header('location: pesan.php?pesan=4');
        }
    }

    public function hapusPenjaga($id)
    {
        if (isset($_GET['id'])) {
            $sql = "DELETE FROM tb_penjaga WHERE id_penjaga=:id_penjaga";
            $sql2 = "SELECT id_hewan FROM tb_hewan WHERE id_penjaga_hewan=:id_penjaga_hewan";

            $stmt = $this->db->prepare($sql2);
            $stmt->bindParam(":id_penjaga_hewan", $id);
            $stmt->execute();
            
            if ($stmt->rowCount()) {
                header("location: pesan.php?pesan=13");
                exit();
            }

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_penjaga", $id);
            $stmt->execute();

            header("location: pesan.php?pesan=7");
        }
    }
}

class Makanan extends Koneksi {
    public function tampilMakanan()
    {
        $sql = "SELECT * FROM tb_makanan ORDER BY id_makanan ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $data = [];
        while ($rows = $stmt->fetch())
        {
            $data[] = $rows;
        }
        return $data;
    }

    public function tambahMakanan()
    {
        if (isset($_POST['makanan-btn-tambah'])) {
            
            $makanan_nama = $_POST['nama-makanan'];
            $makanan_harga = $_POST['harga-makanan'];
    
            $sql = "INSERT INTO tb_makanan (nama_makanan, harga_makanan) VALUES
            (:nama_makanan, :harga_makanan)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":nama_makanan", $makanan_nama);
            $stmt->bindParam(":harga_makanan", $makanan_harga);
            $stmt->execute();
            
            header("location: pesan.php?pesan=9");
        }
    }

    public function getMakanan($id)
    {
        if (isset($_GET['id'])) {
           
            $sql = "SELECT * FROM tb_makanan WHERE id_makanan=:id_makanan";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_makanan", $id);
            $stmt->execute();
            
            $row = $stmt->fetch();

            return $row;
        }
    }

    public function editMakanan($id)
    {
        if (isset($_POST['makanan-btn-edit'])) {
            
            $makanan_nama = $_POST['nama-makanan'];
            $makanan_harga = $_POST['harga-makanan'];
            
            $sql = "UPDATE tb_makanan SET nama_makanan=:nama_makanan, harga_makanan=:harga_makanan WHERE id_makanan=:id_makanan";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_makanan", $id);
            $stmt->bindParam(":nama_makanan", $makanan_nama);
            $stmt->bindParam(":harga_makanan", $makanan_harga);
            $stmt->execute();
            
            header('location: pesan.php?pesan=3');
        }
    }

    public function hapusMakanan($id)
    {
        if (isset($_GET['id'])) {
          
            $sql1 = "DELETE FROM tb_makanan WHERE id_makanan=:id_makanan";
            $sql2 = "SELECT id_hewan FROM tb_hewan WHERE id_makanan_hewan=:id_makanan_hewan";
            
            $stmt = $this->db->prepare($sql2);
            $stmt->bindParam(":id_makanan_hewan", $id);
            $stmt->execute();
            
             if ($stmt->rowCount()) {
                 header("location: pesan.php?pesan=13");
                 exit();
            } 
     
            $stmt = $this->db->prepare($sql1);
            $stmt->bindParam(":id_makanan", $id);
            $stmt->execute();
             header("location: pesan.php?pesan=6");
             
         }
    }
}

class Hewan extends Koneksi{
    public function tampilHewan()
    {
        $sql = "SELECT * FROM tb_hewan JOIN tb_makanan ON tb_makanan.id_makanan=tb_hewan.id_makanan_hewan 
        JOIN tb_penjaga ON tb_penjaga.id_penjaga=tb_hewan.id_penjaga_hewan
        ORDER BY id_hewan ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $data = [];
        while ($rows = $stmt->fetch())
        {
            $data[] = $rows;
        }
        return $data;
    }

    public function tambahHewan()
    {
        if (isset($_POST['hewan-btn-tambah'])) {
            
            $hewan_nama = $_POST['nama-hewan'];
            $hewan_jenis = $_POST['jenis-hewan'];
            $hewan_makanan = $_POST['makanan-hewan'];
            $hewan_penjaga = $_POST['penjaga-hewan'];
           
            $sql = "INSERT INTO tb_hewan (nama_hewan, jenis_hewan, id_makanan_hewan, id_penjaga_hewan) VALUES
            (:nama_hewan, :jenis_hewan, :id_makanan_hewan, :id_penjaga_hewan)";
         
        
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":nama_hewan", $hewan_nama);
            $stmt->bindParam(":jenis_hewan", $hewan_jenis);
            $stmt->bindParam(":id_makanan_hewan", $hewan_makanan);
            $stmt->bindParam(":id_penjaga_hewan", $hewan_penjaga);
            $stmt->execute();
            
            header("location: pesan.php?pesan=8");
        }
    }

    public function getHewan($id)
    {
        if (isset($_GET['id'])) {
            
            $sql = "SELECT * FROM tb_hewan JOIN tb_makanan ON tb_hewan.id_makanan_hewan=tb_makanan.id_makanan 
                    JOIN tb_penjaga ON tb_hewan.id_penjaga_hewan=tb_penjaga.id_penjaga WHERE id_hewan=:id_hewan";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_hewan", $id);
            $stmt->execute();
            
            $row = $stmt->fetch();

            return $row;
        }
    }

    public function editHewan($id)
    {
        if (isset($_POST['hewan-btn-edit'])) {
            
            $hewan_nama = $_POST['nama-hewan'];
            $hewan_jenis = $_POST['jenis-hewan'];
            $hewan_makanan = $_POST['makanan-hewan'];
            $hewan_penjaga = $_POST['penjaga-hewan'];
    
            $sql = "UPDATE tb_hewan SET nama_hewan=:nama_hewan, jenis_hewan=:jenis_hewan, id_makanan_hewan=:id_makanan_hewan, id_penjaga_hewan=:id_penjaga_hewan WHERE id_hewan=:id_hewan";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_hewan", $id);
            $stmt->bindParam(":nama_hewan", $hewan_nama);
            $stmt->bindParam(":jenis_hewan", $hewan_jenis);
            $stmt->bindParam(":id_makanan_hewan", $hewan_makanan);
            $stmt->bindParam(":id_penjaga_hewan", $hewan_penjaga);
            $stmt->execute();
    
            header('location: pesan.php?pesan=2');
        }
    }

    public function hapusHewan($id)
    {
        if (isset($_GET['id'])) {
           
            $sql = "DELETE FROM tb_hewan WHERE id_hewan=:id_hewan";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_hewan", $id);
            $stmt->execute();
     
            header("location: pesan.php?pesan=5");
        }
    }
}

?>