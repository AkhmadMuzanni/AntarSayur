<?php 
    require_once('db.php');
    $target_dir = "img/product/";
    $imageFileType = strtolower(pathinfo($_FILES["gambarProduk"]["name"],PATHINFO_EXTENSION));
    $random_name = bin2hex(random_bytes(5)) . '.' . $imageFileType;

    if($_POST['function'] == 'tambahProduk'){
        echo $_POST['namaProduk'];
        echo $_POST['keteranganProduk'];

        mysqli_query($link,"INSERT INTO `product` VALUES (0, '".$_POST['namaProduk']."', '".$random_name."')");
        $target_file = $target_dir . $random_name;
        move_uploaded_file($_FILES["gambarProduk"]["tmp_name"], $target_file);
    } else if($_POST['function'] == 'editProduk'){        
        if($_FILES["gambarProduk"]["size"] != 0){
            mysqli_query($link,"UPDATE `product` SET productName=\"" .$_POST['namaProduk']. "\" ,picture=\"" .$random_name. "\"WHERE id=".$_POST['idProduk']);
            $target_file = $target_dir . $random_name;
            move_uploaded_file($_FILES["gambarProduk"]["tmp_name"], $target_file);
        } else {
            mysqli_query($link,"UPDATE `product` SET productName=\"" .$_POST['namaProduk']. "\" WHERE id=".$_POST['idProduk']);
        }
    }
    header('Location: admin.php');
?>