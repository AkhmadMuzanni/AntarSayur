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
    <body>
        <div id="container-nav-admin">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
                    <a class="navbar-brand text-white" href="#">AntarSayur.id</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-white" href="#home">BERANDA <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-white" href="#product">PRODUCT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-white" href="logout.php">LOGOUT</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        
    
        <section class="header" id="home">
            <div class="container">
                <!-- <h3 class="text-center text-white" id="title">Selamat Datang</h3> -->
                <!-- <h1 class="text-center text-white" id="subtitle">AntarSayur.id</h1> -->
            </div>
        </section>
        <section class="page-section" id="product">
            <div class="container">
                <h1 class="text-center">Product</h1>
                <div class="text-center">
                    <img src="img/line.png" class="line-section" >
                </div>
                <div class="product-list">
                    <!-- <div class="row row-product">
                        <div class=" col-md-4 product-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="img-product" src="img/product/product_1.jpg" alt="">
                                </div>
                                <div class="col-md-6 info">
                                    <p class="font-weight-bold">Product 1</p>
                                    <p>Buah tomat dari perkebunan ...</p>
                                    <a href="<?php echo "https://api.whatsapp.com/send?phone=" . $no_telp . "&text=" . $message . $nama_product; ?>"><button type="button" class="btn btn-success"><i class="fab fa-whatsapp"></i>  ORDER</button></a>
                                </div>
                            </div>
                        </div>

                        <div class=" col-md-4 product-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="img-product" src="img/product/product_2.jpg" alt="">
                                </div>
                                <div class="info">
                                    <p class="font-weight-bold">Product 2</p>
                                    <p>Buah tomat dari perkebunan ...</p>
                                    <a href="<?php echo "https://api.whatsapp.com/send?phone=" . $no_telp . "&text=" . $message . $nama_product; ?>"><button type="button" class="btn btn-success"><i class="fab fa-whatsapp"></i>  ORDER</button></a>
                                </div>
                            </div>
                        </div>

                        <div class=" col-md-4 product-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <img class="img-product" src="img/product/product_3.jpg" alt="">
                                </div>
                                <div class="info">
                                    <p class="font-weight-bold">Product 3</p>
                                    <p>Buah tomat dari perkebunan ...</p>
                                    <a href="<?php echo "https://api.whatsapp.com/send?phone=" . $no_telp . "&text=" . $message . $nama_product; ?>"><button type="button" class="btn btn-success"><i class="fab fa-whatsapp"></i>  ORDER</button></a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <?php 
                    for ($i=0; $i < count($arrayProduct) ; $i++) { 
                        echo "<div class=\"row row-product\">";
                        for ($j=0; $j < count($arrayProduct[$i]) ; $j++) { 
                            echo "<div class=\" col-md-4 product-container\">";
                            echo "<div class=\"row\">";
                            echo "<div class=\"col-md-6\">";
                            echo "<img class=\"img-product\" src=\"img/product/". $arrayProduct[$i][$j][2] ."\">";
                            echo "</div>";
                            echo "<div class=\"col-md-6 info\">";
                            echo "<p class=\"font-weight-bold\">". $arrayProduct[$i][$j][1] ."</p>";
                            echo "<p>Buah tomat dari perkebunan ...</p>";
                            echo "<a href=\"https://api.whatsapp.com/send?phone=" . $no_telp . "&text=" . $message . str_replace(" ","+",$arrayProduct[$i][$j][1]) . "\"><button type=\"button\" class=\"btn btn-success\"><i class=\"fab fa-whatsapp\"></i>  ORDER</button></a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                    ?>
                </div>
                
            </div>
        </section>
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="sub-section-title">TENTANG KAMI</h4>
                        <div class="line-subtitle"></div>
                        <p>AntarSayur.id adalah suatu platform digital untuk pemesanan sayur secara digital yang ditangani secara profesional</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="sub-section-title">LOKASI</h4>
                        <div class="line-subtitle"></div>
                        <img class="maps-contact" src="img/maps.png" alt="">
                    </div>
                    <div class="col-md-4">
                        <h4 class="sub-section-title">KONTAK KAMI</h4>
                        <div class="line-subtitle"></div>
                        <div>
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Pesan Anda</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Pesan Anda"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success float-right">KIRIM</button>
                            </form>
                        </div>
                    </div>
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