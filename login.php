<?php
    session_start();
    require_once('db.php');
    $no_telp = '6285749420404';
    $message = 'Hai+AntarSayur,+Saya+ingin+pesan+';
    $nama_product = 'Product+Ini';
    
    $sql="SELECT * FROM product";
          
    $data_product = array(); 

    if ($result=mysqli_query($link,$sql)){
        while ($row=mysqli_fetch_row($result)){
            array_push($data_product, array($row[0], $row[1], $row[2]));
        }
    }

    $arrayProduct = array();
    $tempArray = array();

    for ($i=0; $i < count($data_product) ; $i++) { 
        array_push($tempArray, $data_product[$i]);
        if(count($tempArray) == 3 || $i == count($data_product) - 1){
            array_push($arrayProduct, $tempArray);
            $tempArray = array();
        }
    }

    // print_r($arrayProduct);

    mysqli_close($link);
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>AntarSayur</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/bootstrap-grid.css" rel="stylesheet" />
        <link href="css/bootstrap-reboot.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
    </head>
    <body id="body-login">
        <section>
            <div id="container-login">
                <h1 class="text-center">AntarSayur</h1>
                <p class="text-center">Masukkan Username dan Password</p>
                <div>
                    <form>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="string" class="form-control" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Username">
                        </div>
                        <button type="submit" class="btn btn-success float-right">MASUK</button>
                    </form>
                </div>
            </div>
        </section>
        <footer>
            Copyright Republic Visual @2020
        </footer>
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>