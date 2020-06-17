<?php
    session_start();
    require_once('db.php');
    $no_telp = '6285749420404';
    $message = 'Hai+AntarSayur,+Saya+ingin+pesan+';
    $nama_product = 'Product+Ini';

    if(!isset($_SESSION['username']) || (($_SESSION['username'] == false) || ($_SESSION['password'] == false)) ){
        header('Location: login.php');
    } else {

    echo $_SESSION['notif'];
    
    if(!isset($_SESSION['notif'])){
        $_SESSION['notif'] = '';
    }

    // Get Product Data

    $sql="SELECT * FROM product";
          
    $data_product = array(); 
    $data_informasi = array(); 
    $data_carousel = array(); 

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

    $value_username = '';
    $value_password = '';
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
                $value_no_telp = $data_informasi[$i][2];
            break;
            case 'username':
                $value_username = $data_informasi[$i][2];
            break;
            case 'password':
                $value_password = $data_informasi[$i][2];
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

    $arrayCarousel = array();
    $tempArray = array();

    for ($i=0; $i < count($data_carousel) ; $i++) { 
        array_push($tempArray, $data_carousel[$i]);
        if(count($tempArray) == 2 || $i == count($data_carousel) - 1){
            array_push($arrayCarousel, $tempArray);
            $tempArray = array();
        }
    }


    // print_r($arrayProduct);

    mysqli_close($link);
?>
<html>
    <?php include 'header.php' ?>    
    <body>
        <input type="hidden" id="notif" value="a<?php echo $_SESSION['notif'] ?>">
        <div id="container-nav-admin">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
                    <a class="navbar-brand" href="#">
                        <img src="img/logo_samping3.png" id="nav-logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-white" href="index.php">BERANDA <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-white" href="#information">INFORMASI</a>
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
         
        <section class="information" id="information">
            <div class="container">
                <h1 class="text-center">Informasi</h1>
                <div class="text-center">
                    <img src="img/line.png" class="line-section" >
                </div>
                <div id="form-informasi">
                    <form action="controller.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3" for="username">Username</label>
                                    <div class="col-md-9">
                                        <input type="string" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $value_username ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3" for="password">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $value_password ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3" for="nomor_wa">Nomor WA</label>
                                    <div class="col-md-9">
                                        <input type="string" class="form-control" name="nomor_wa" id="nomor_wa" placeholder="Nomor Whatsapp" value="<?php echo $value_no_telp ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3" for="instagram">Instagram</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Akun Instagram" value="<?php echo $value_instagram ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3" for="facebook">Facebook</label>
                                    <div class="col-md-9">
                                        <input type="string" class="form-control" name="facebook" id="facebook" placeholder="Akun Facebook" value="<?php echo $value_facebook ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3" for="twitter">Twitter</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Akun Twitter" value="<?php echo $value_twitter ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="function" id="functionInformasi" value="simpanInformasi">
                        <button type="submit" class="btn btn-success float-right" id="btn-simpan-perubahan">SIMPAN PERUBAHAN</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </section>

        <section id="carousel-section">
            <div class="container">
                <h1 class="text-center">Carousel</h1>
                <div class="text-center">
                    <img src="img/line.png" class="line-section" >
                </div>
                <div>
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalCarousel" id="btn-tambah-carousel">TAMBAH CAROUSEL</button>
                    <div class="clearfix"></div>
                </div>
                <div id="list-carousel">
                    <!-- <form action="controller.php" method="post">
                    </form> -->
                    <?php 
                    for ($i=0; $i < count($arrayCarousel) ; $i++) { 
                        echo "<div class=\"row row-product\">";
                        for ($j=0; $j < count($arrayCarousel[$i]) ; $j++) { 
                            echo "<div class=\"col-md-6 carousel-container\">";
                            echo "<div class=\"row\">";
                            echo "<div class=\"col-md-4 text-center\">";
                            echo "<img class=\"img-product\" src=\"img/carousel/".$arrayCarousel[$i][$j][3]."\">";
                            echo "</div>";
                            echo "<div class=\"col-md-8 info\">";
                            echo "<p class=\"font-weight-bold\">Carousel ".(($i*2) + $j + 1)."</p>";
                            echo "<div class=\"form-group\">";
                            echo "<label for=\"carousel1\" class=\"text-left\">Judul</label>";
                            echo "<input type=\"string\" class=\"form-control judulCarousel\" name=\"judulCarousel\" placeholder=\"Judul Carousel\" value=\"".$arrayCarousel[$i][$j][1]."\" disabled>";
                            echo "</div>";
                            echo "<div class=\"form-group\">";
                            echo "<label for=\"teksCarousel\" class=\"text-left\">Teks</label>";
                            echo "<textarea class=\"form-control teksCarousel\" name=\"teksCarousel\" rows=\"3\" placeholder=\"Teks Carousel\" disabled>".$arrayCarousel[$i][$j][2]."</textarea>";
                            echo "</div>";
                            echo "<input type=\"hidden\" class=\"idCarousel\" value=\"".$arrayCarousel[$i][$j][0]."\"></input>";
                            echo "<button type=\"button\" class=\"btn btn-info btn-admin btn-edit-carousel\" data-toggle=\"modal\" data-target=\"#modalCarousel\"><i class=\"fa fa-edit\"></i></button>";
                            echo "<button type=\"button\" class=\"btn btn-danger btn-admin btn-delete-carousel\" data-toggle=\"modal\" data-target=\"#modalDelete\"><i class=\"fa fa-trash\"></i></button>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                    ?>

                    <!-- <div class="row row-product">
                        <div class=" col-md-6 carousel-container">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img class="img-product" src="img/product/product_1.jpg" alt="">
                                </div>
                                <div class="col-md-8 info">
                                    <p class="font-weight-bold">Carousel 1</p>
                                    <div class="form-group">
                                        <label for="carousel1" class="text-left">Judul</label>
                                        <input type="string" class="form-control" name="judulCarousel" id="judulCarousel" placeholder="Judul Carousel" value="klsalska">
                                    </div>
                                    <div class="form-group">
                                        <label for="teksCarousel" class="text-left">Teks</label>
                                        <textarea class="form-control" name="teksCarousel" id="teksCarousel" rows="3" placeholder="Teks Carousel"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-info btn-admin btn-edit" data-toggle="modal" data-target="#modalCarousel"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-admin btn-delete" data-toggle="modal" data-target="#modalDelete"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class=" col-md-6 carousel-container">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img class="img-product" src="img/product/product_1.jpg" alt="">
                                </div>
                                <div class="col-md-8 info">
                                    <p class="font-weight-bold">Carousel 1</p>
                                    <div class="form-group">
                                        <label for="carousel1" class="text-left">Judul</label>
                                        <input type="string" class="form-control" name="judulCarousel" id="judulCarousel" placeholder="Judul Carousel" value="klsalska">
                                    </div>
                                    <div class="form-group">
                                        <label for="teksCarousel" class="text-left">Teks</label>
                                        <textarea class="form-control" name="teksCarousel" id="teksCarousel" rows="3" placeholder="Teks Carousel"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-info btn-admin btn-edit" data-toggle="modal" data-target="#modalCarousel"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-admin btn-delete" data-toggle="modal" data-target="#modalDelete"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    
                </div>
            </div>
        </section>

        <section class="page-section" id="product">
            <div class="container" id="product-admin">
                <div class="fixed-action-btn" style="bottom: 45px; right: 45px;">
                    <a href=<?php echo "\"https://api.whatsapp.com/send?phone=" . $value_no_telp . "&text=Hai+AntarSayur\""  ?> class="btn-floating btn-lg btn-success" data-toggle="tooltip" title="Chat Whatsapp">
                        <i class="fab fa-whatsapp text-white" style="display: flex; height: 100%;"></i>
                    </a>
                </div>
                <h1 class="text-center">Produk Saya</h1>
                <div class="text-center">
                    <img src="img/line.png" class="line-section" >
                </div>
                <div>
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#myModal" id="btn-tambah">TAMBAH PRODUK</button>
                    <div class="clearfix"></div>
                </div>
                <div class="product-list product-list-admin">
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
                            echo "<p class=\"font-weight-bold namaProduk\">". $arrayProduct[$i][$j][1] ."</p>";
                            echo "<p class=\"font-weight-bold hargaProduk\">". $arrayProduct[$i][$j][3] ."</p>";
                            echo "<p class=\"keteranganProduk\">". $arrayProduct[$i][$j][2] ."</p>";
                            echo "<input type=\"hidden\" class=\"idProduk\" value=\"".$arrayProduct[$i][$j][0]."\"></input>";
                            echo "<button type=\"button\" class=\"btn btn-info btn-admin btn-edit\" data-toggle=\"modal\" data-target=\"#myModal\"><i class=\"fa fa-edit\"></i></button>";
                            echo "<button type=\"button\" class=\"btn btn-danger btn-admin btn-delete\" data-toggle=\"modal\" data-target=\"#modalDelete\"><i class=\"fa fa-trash\"></i></button>";
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
        <footer class="text-white">
            Copyright AntarSayur.id by Republic Visual @2020
        </footer>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form method="post" action="controller.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Tambah Produk</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="namaProduk" class="col-sm-4 col-form-label font-weight-bold">Nama Product</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="namaProduk" name="namaProduk" placeholder="Nama Produk">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hargaProduk" class="col-sm-4 col-form-label font-weight-bold">Harga Product</label>
                            <div class="input-group col-sm-8">
                                <!-- <input type="number" class="form-control" id="hargaProduk" name="hargaProduk" placeholder="Harga Produk"> -->
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="number" class="form-control" id="hargaProduk" name="hargaProduk" placeholder="Harga Produk">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keteranganProduk" class="col-sm-4 col-form-label font-weight-bold">Keterangan</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="keteranganProduk" name="keteranganProduk" placeholder="Keterangan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gambarProduk" class="col-sm-4 col-form-label font-weight-bold">Gambar</label>    
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambarProduk" name="gambarProduk" accept='image/*'>
                                    <label class="custom-file-label" for="gambarProduk" id="labelGambar">Pilih Gambar...</label>
                                </div>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    File harus berupa file .jpg/.png dengan ukuran maksimal 2MB.
                                </small>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idProduk" id="idProduk" value="0">
                        <input type="hidden" name="function" id="function" value="tambahProduk">
                        <button type="submit" class="btn btn-success" id="btn-simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        </div>

        <!-- Modal Delete-->
        <div id="modalDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form method="post" action="controller.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p id="konfirmasiHapus">Apakah Anda yakin akan menghapus Produk Ini?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idHapus" id="idHapus" value="0">
                        <input type="hidden" name="function" id="functionHapus" value="deleteProduk">
                        <button type="submit" class="btn btn-danger" id="btn-simpan">HAPUS</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">KEMBALI</button>
                    </div>
                </form>
            </div>
        </div>
        </div>

        <!-- Modal -->
        <div id="modalCarousel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <form method="post" action="controller.php" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-carousel">Tambah Carousel</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="judulCarousel" class="col-sm-4 col-form-label font-weight-bold">Judul</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="judulCarousel" name="judulCarousel" placeholder="Judul Carousel">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="teksCarousel" class="col-sm-4 col-form-label font-weight-bold">Teks</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="teksCarousel" id="teksCarousel" rows="3" placeholder="Teks Carousel"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gambarProduk" class="col-sm-4 col-form-label font-weight-bold">Gambar</label>    
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambarCarousel" name="gambarCarousel" accept='image/*'>
                                    <label class="custom-file-label" for="gambarCarousel" id="labelGambarCarousel">Pilih Gambar...</label>
                                </div>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    File harus berupa file .jpg/.png dengan ukuran maksimal 2MB.
                                </small>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idCarousel" id="idCarousel" value="0">
                        <input type="hidden" name="function" id="functionCarousel" value="tambahCarousel">
                        <button type="submit" class="btn btn-success" id="btn-simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        </div>

        <?php include 'script.php' ?>    
        
    </body>
</html>

<?php
}
?>