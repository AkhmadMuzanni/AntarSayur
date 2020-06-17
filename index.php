<?php
    session_start();
    require_once('db.php');
    $no_telp = '6285749420404';
    $message = 'Hai+AntarSayur,+Saya+ingin+pesan+';
    $nama_product = 'Product+Ini';
    
    $sql="SELECT * FROM product";
          
    $data_product = array(); 
    $data_informasi = array(); 
    $data_carousel = array(); 

    if(!isset($_SESSION['notif'])){
        $_SESSION['notif'] = '';
    }

    // Get Product Data

    if ($result=mysqli_query($link,$sql)){
        while ($row=mysqli_fetch_row($result)){
            array_push($data_product, array($row[0], $row[1], $row[2], $row[3], $row[4]));
        }
    }

    $arrayProduct = array();
    $tempArray = array();

    for ($i=0; $i < count($data_product) ; $i++) { 
        array_push($tempArray, $data_product[$i]);
        if(count($tempArray) == 2 || $i == count($data_product) - 1){
            array_push($arrayProduct, $tempArray);
            $tempArray = array();
        }
    }

    // Get Information Data

    $sql="SELECT * FROM information";

    if ($result=mysqli_query($link,$sql)){
        while ($row=mysqli_fetch_row($result)){
            array_push($data_informasi, array($row[0], $row[1], $row[2]));
        }
    }

    $value_instagram = '';
    $value_facebook = '';
    $value_twitter = '';
    $value_no_telp = '';

    for ($i=0; $i < count($data_informasi) ; $i++) { 
        switch ($data_informasi[$i][1]) {
            case 'instagram':
                $value_instagram = $data_informasi[$i][2];
            break;
            case 'facebook':
                $value_facebook = $data_informasi[$i][2];
            break;
            case 'twitter':
                $value_twitter = $data_informasi[$i][2];
            break;
            case 'no_telp':
                $no_telp = $data_informasi[$i][2];
            break;
        }
    }

    // Get Carousel Data

    $sql="SELECT * FROM carousel";

    if ($result=mysqli_query($link,$sql)){
        while ($row=mysqli_fetch_row($result)){
            array_push($data_carousel, array($row[0], $row[1], $row[2], $row[3]));
        }
    }

    // print_r($arrayProduct);

    mysqli_close($link);
?>
<html>
    <?php include 'header.php' ?>  
    <body>
        <input type="hidden" id="notif" value="<?php (isset($_SESSION['notif']))?$_SESSION['notif']:'' ?>">
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
                            // if(isset($_SESSION["username"])){
                            //     if($_SESSION['username'] == true && $_SESSION['password'] == true){
                            //         echo '<li class="nav-item">';
                            //         echo '<a class="nav-link font-weight-bold" href="admin.php">ADMIN</a>';
                            //         echo '</li>';
                            //     } else {
                            //         echo '<li class="nav-item">';
                            //         echo '<a class="nav-link font-weight-bold" href="login.php">LOGIN</a>';
                            //         echo '</li>';
                            //     }
                            // } else {
                            //     echo '<li class="nav-item">';
                            //     echo '<a class="nav-link font-weight-bold" href="login.php">LOGIN</a>';
                            //     echo '</li>';
                            // }
                            
                            ?>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    
        <section id="home">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php 
                        for ($i=0; $i < count($data_carousel) ; $i++) { 
                            $active = "";
                            if($i == 0){
                                $active = 'active';
                            }
                            echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"". $i ."\" class=\"$active\"></li>";
                        }
                    ?>
                    <!-- <li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
                </ol>
                <div class="carousel-inner">
                    <?php 
                        for ($i=0; $i < count($data_carousel) ; $i++) { 
                            $active = "";
                            if($i == 0){
                                $active = 'active';
                            }
                            echo "<div class=\"carousel-item ".$active."\">";
                            echo "<img class=\"d-block w-100 h-100\" src=\"img/carousel/". $data_carousel[$i][3] ."\" alt=\"First slide\" style=\"filter: brightness(50%);\">";
                            echo "<div class=\"carousel-caption d-none d-md-block\">";
                            echo "<h5>". $data_carousel[$i][1] ."</h5>";
                            echo "<p>". $data_carousel[$i][2] ."</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    ?>
                    <!-- <div class="carousel-item active">
                        <img class="d-block w-100 h-100" src="img/carousel/carousel1.jpg" alt="First slide" style="filter: brightness(50%);">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Slide Pertama</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 h-100" src="img/carousel/carousel2.jpg" alt="Second slide" style="filter: brightness(50%);">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Slide Kedua</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 h-100" src="img/carousel/carousel3.jpg" alt="Third slide" style="filter: brightness(50%);">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Slide Ketiga</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div> -->
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </section>
        
        <section class="page-section" id="product">
            <div class="container">
                <div class="fixed-action-btn" style="bottom: 45px; right: 45px;">
                    <a href=<?php echo "\"https://api.whatsapp.com/send?phone=" . $value_no_telp . "&text=Hai+AntarSayur\""  ?> class="btn-floating btn-lg btn-success" data-toggle="tooltip" title="Chat Whatsapp">
                        <i class="fab fa-whatsapp text-white" style="display: flex; height: 100%;"></i>
                    </a>
                </div>
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
                            echo "<div class=\" col-md-6 product-container\">";
                            echo "<div class=\"row text-center\">";
                            echo "<div class=\"col-md-6\">";
                            echo "<img class=\"img-product\" src=\"img/product/". $arrayProduct[$i][$j][4] ."\">";
                            echo "</div>";
                            echo "<div class=\"col-md-6 info\">";
                            echo "<p class=\"font-weight-bold\">". $arrayProduct[$i][$j][1] ."</p>";
                            echo "<p class=\"font-weight-bold\">Rp. ". $arrayProduct[$i][$j][3] ."</p>";
                            echo "<p>". $arrayProduct[$i][$j][2] ."</p>";
                            // echo "<a href=\"https://api.whatsapp.com/send?phone=" . $no_telp . "&text=" . $message . str_replace(" ","+",$arrayProduct[$i][$j][1]) . "\"><button type=\"button\" class=\"btn btn-success\"><i class=\"fab fa-whatsapp\"></i>  ORDER</button></a>";
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
        <section class="text-center" id="ulasan">
            <p class="font-weight-bold">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et</p>
            <p class="font-weight-bold">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et</p>
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
                        <p>Jalan Suropati I A No. 18 RT. 13 RW. 04</p>
                        <p>Kecamatan Bululawang, Kabupaten Malang</p>
                        <!-- <div id="maps-contact">
                            <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
                            <script>
                                // initialize the map
                                // var map = L.map('maps-contact').setView([51.505, -0.09], 13);
                                var map = L.map('maps-contact').setView([-7.9448811,112.6550979], 13);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                }).addTo(map);

                                // L.marker([51.5, -0.09]).addTo(map)
                                //     .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
                                //     .openPopup();
                                L.marker([-7.9448811,112.6550979]).addTo(map)
                                    .bindPopup('Republic Visual Malang')
                                    .openPopup();
                            </script>
                        </div> -->
                    </div>
                    <div class="col-md-4">
                        <h4 class="sub-section-title">KONTAK KAMI</h4>
                        <div class="line-subtitle"></div>
                        <div class="row">
                            <p class="col-md-3">Instagram</p>
                            <p class="col-md-9">: <a href=<?php echo "\"https://www.instagram.com/".$value_instagram."\"" ?>><strong><?php echo $value_instagram ?></strong></a></p>
                        </div>
                        <div class="row">
                            <p class="col-md-3">Facebook</p>
                            <p class="col-md-9">: <a href=<?php echo "\"https://www.facebook.com/".$value_facebook."\"" ?>><strong><?php echo $value_facebook ?></strong></a></p>
                        </div>
                        <div class="row">
                            <p class="col-md-3">Twitter</p>
                            <p class="col-md-9">: <a href=<?php echo "\"https://twitter.com/".$value_twitter."\""?>><strong><?php echo $value_twitter ?></strong></a></p>
                        </div>

                        <div class="text-center">
                            <?php echo "<a href=\"https://api.whatsapp.com/send?phone=" . $value_no_telp . "&text=Hai+AntarSayur\"><button type=\"button\" class=\"btn btn-success\"><i class=\"fab fa-whatsapp\"></i>  HUBUNGI KAMI VIA WA</button></a>"; ?>
                        </div>
                        
                        <!-- <div>
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
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        <footer class="text-white">
            Copyright AntarSayur.id by Republic Visual @2020
        </footer>

        <?php include 'script.php' ?>    

    </body>
</html>