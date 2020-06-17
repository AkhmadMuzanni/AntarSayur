<?php 
    require_once('db.php');
    $target_dir = "img/product/";
    

    if($_POST['function'] == 'tambahProduk'){
        $imageFileType = strtolower(pathinfo($_FILES["gambarProduk"]["name"],PATHINFO_EXTENSION));
        $random_name = bin2hex(random_bytes(5)) . '.' . $imageFileType;
        echo $_POST['namaProduk'];
        echo $_POST['keteranganProduk'];

        mysqli_query($link,"INSERT INTO `product` VALUES (0, '".$_POST['namaProduk']."', '".$_POST['keteranganProduk']."', ".$_POST['hargaProduk'].", '".$random_name."')");
        $target_file = $target_dir . $random_name;
        move_uploaded_file($_FILES["gambarProduk"]["tmp_name"], $target_file);
        // $_SESSION['notif']  = 'tambahProduk';
    } else if($_POST['function'] == 'editProduk'){        
        $imageFileType = strtolower(pathinfo($_FILES["gambarProduk"]["name"],PATHINFO_EXTENSION));
        $random_name = bin2hex(random_bytes(5)) . '.' . $imageFileType;
        if($_FILES["gambarProduk"]["size"] != 0){
            mysqli_query($link,"UPDATE `product` SET productName=\"" .$_POST['namaProduk']. "\", keterangan=\"" .$_POST['keteranganProduk']. "\", harga=" .$_POST['hargaProduk']. " ,picture=\"" .$random_name. "\"WHERE id=".$_POST['idProduk']);
            $target_file = $target_dir . $random_name;
            move_uploaded_file($_FILES["gambarProduk"]["tmp_name"], $target_file);
        } else {
            mysqli_query($link,"UPDATE `product` SET productName=\"" .$_POST['namaProduk']. "\", keterangan=\"" .$_POST['keteranganProduk']. "\", harga=" .$_POST['hargaProduk']. " WHERE id=".$_POST['idProduk']);
        }
        // $_SESSION['notif']  = 'editProduk';
    } else if($_POST['function'] == 'deleteProduk'){
        echo $_POST['idHapus'];
        mysqli_query($link,"DELETE from `product` WHERE id=".$_POST['idHapus']);
        // $_SESSION['notif']  = 'hapusProduk';
    } else if($_POST['function'] == 'simpanInformasi'){
        $data_informasi = array(); 

        $sql="SELECT * FROM information";

        if ($result=mysqli_query($link,$sql)){
            while ($row=mysqli_fetch_row($result)){
                array_push($data_informasi, array($row[0], $row[1], $row[2]));
            }
        }

        for ($i=0; $i < count($data_informasi) ; $i++) { 
            switch ($data_informasi[$i][1]) {
                case 'instagram':
                    mysqli_query($link,"UPDATE `information` SET value=\"" . $_POST['instagram'] . "\" WHERE id=" .($i+1));
                break;
                case 'facebook':
                    mysqli_query($link,"UPDATE `information` SET value=\"" . $_POST['facebook'] . "\" WHERE id=" .($i+1));
                break;
                case 'twitter':
                    mysqli_query($link,"UPDATE `information` SET value=\"" . $_POST['twitter'] . "\" WHERE id=" .($i+1));
                break;
                case 'no_telp':
                    mysqli_query($link,"UPDATE `information` SET value=\"" . $_POST['nomor_wa'] . "\" WHERE id=" .($i+1));
                break;
                case 'username':
                    mysqli_query($link,"UPDATE `information` SET value=\"" . $_POST['username'] . "\" WHERE id=" .($i+1));
                break;
                case 'password':
                    mysqli_query($link,"UPDATE `information` SET value=\"" . $_POST['password'] . "\" WHERE id=" .($i+1));
                break;
            }
        }
        // $_SESSION['notif']  = 'hapusProduk';
    } else if($_POST['function'] == 'tambahCarousel'){
        $target_dir = "img/carousel/";
        $imageFileType = strtolower(pathinfo($_FILES["gambarCarousel"]["name"],PATHINFO_EXTENSION));
        $random_name = bin2hex(random_bytes(5)) . '.' . $imageFileType;
        echo $_POST['judulCarousel'];
        echo $_POST['teksCarousel'];

        mysqli_query($link,"INSERT INTO `carousel` VALUES (0, '".$_POST['judulCarousel']."', '".$_POST['teksCarousel']."', '".$random_name."')");
        $target_file = $target_dir . $random_name;
        move_uploaded_file($_FILES["gambarCarousel"]["tmp_name"], $target_file);
    } else if($_POST['function'] == 'editCarousel'){
        $target_dir = "img/carousel/";
        $imageFileType = strtolower(pathinfo($_FILES["gambarCarousel"]["name"],PATHINFO_EXTENSION));
        $random_name = bin2hex(random_bytes(5)) . '.' . $imageFileType;
        if($_FILES["gambarCarousel"]["size"] != 0){
            mysqli_query($link,"UPDATE `carousel` SET title=\"" .$_POST['judulCarousel']. "\", text=\"" .$_POST['teksCarousel']. "\", picture=\"" .$random_name. "\"WHERE id=".$_POST['idCarousel']);
            $target_file = $target_dir . $random_name;
            move_uploaded_file($_FILES["gambarCarousel"]["tmp_name"], $target_file);
        } else {
            mysqli_query($link,"UPDATE `carousel` SET title=\"" .$_POST['judulCarousel']. "\", text=\"" .$_POST['teksCarousel']. "\" WHERE id=".$_POST['idCarousel']);
        }

    } else if($_POST['function'] == 'deleteCarousel'){
        echo $_POST['idHapus'];
        mysqli_query($link,"DELETE from `carousel` WHERE id=".$_POST['idHapus']);
        // $_SESSION['notif']  = 'hapusProduk';
    }
    // echo $_SESSION['notif'];
    // header('Location: admin.php');
    echo "<script>window.location.href='admin.php';</script>";
?>