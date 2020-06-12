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
                                <a class="nav-link font-weight-bold text-white" href="index.php">BERANDA <span class="sr-only">(current)</span></a>
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
        
            
        <section class="page-section" id="product">
            <div class="container" id="product-admin">
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
                            echo "<div class=\" col-md-4 product-container\">";
                            echo "<div class=\"row\">";
                            echo "<div class=\"col-md-6\">";
                            echo "<img class=\"img-product\" src=\"img/product/". $arrayProduct[$i][$j][2] ."\">";
                            echo "</div>";
                            echo "<div class=\"col-md-6 info\">";
                            echo "<p class=\"font-weight-bold namaProduk\">". $arrayProduct[$i][$j][1] ."</p>";
                            echo "<p>Buah tomat dari perkebunan ...</p>";
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
        <footer>
            Copyright Republic Visual @2020
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
                            <label for="keteranganProduk" class="col-sm-4 col-form-label font-weight-bold">Keterangan</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="keteranganProduk" name="keteranganProduk" placeholder="Keterangan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gambarProduk" class="col-sm-4 col-form-label font-weight-bold">Gambar</label>    
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambarProduk" name="gambarProduk">
                                    <label class="custom-file-label" for="gambarProduk" id="labelGambar">Pilih Gambar...</label>
                                </div>
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
                        <p>Apakah Anda yakin akan menghapus Produk Ini?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idProduk" id="idProdukHapus" value="0">
                        <input type="hidden" name="function" id="function" value="deleteProduk">
                        <button type="submit" class="btn btn-danger" id="btn-simpan">HAPUS</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">KEMBALI</button>
                    </div>
                </form>
            </div>
        </div>
        </div>


        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>