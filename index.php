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
            array_push($data_product, array($row[0], $row[1], $row[2], $row[3]));
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
    <?php include 'header.php' ?>  
    <body>
        <div id="container-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
                    <a class="navbar-brand" href="#">
                        <img src="img/logo_samping2.png" id="nav-logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold nav-link-section" href="#home">HOME <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold nav-link-section" href="#product">PRODUCT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold nav-link-section" href="#contact">KONTAK</a>
                            </li>
                            <?php 
                            if(isset($_SESSION["username"])){
                                if($_SESSION['username'] == true && $_SESSION['password'] == true){
                                    echo '<li class="nav-item">';
                                    echo '<a class="nav-link font-weight-bold" href="admin.php">ADMIN</a>';
                                    echo '</li>';
                                } else {
                                    echo '<li class="nav-item">';
                                    echo '<a class="nav-link font-weight-bold" href="login.php">LOGIN</a>';
                                    echo '</li>';
                                }
                            } else {
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link font-weight-bold" href="login.php">LOGIN</a>';
                                echo '</li>';
                            }
                            
                            ?>
                            
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
                            echo "<img class=\"img-product\" src=\"img/product/". $arrayProduct[$i][$j][3] ."\">";
                            echo "</div>";
                            echo "<div class=\"col-md-6 info\">";
                            echo "<p class=\"font-weight-bold\">". $arrayProduct[$i][$j][1] ."</p>";
                            echo "<p>". $arrayProduct[$i][$j][2] ."</p>";
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
        <footer class="text-white">
            Copyright Republic Visual @2020
        </footer>
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>