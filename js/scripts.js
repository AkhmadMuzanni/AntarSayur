// var cw = $('.img-product').width();
// $('.img-product').css({ 'height': cw + 'px' });
let mainNavLinks = document.querySelectorAll(".nav-link-section");
let mainSections = document.querySelectorAll("main section");

let lastId;
let cur = [];

mainNavLinks.forEach(link => {
    link.addEventListener("click", event => {
        event.preventDefault();
        let target = document.querySelector(event.target.hash);
        target.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    });
});

window.addEventListener("scroll", event => {
    let fromTop = window.scrollY;

    mainNavLinks.forEach(link => {
        let section = document.getElementById(link.hash.substr(1));

        if (
            section.offsetTop <= fromTop &&
            section.offsetTop + section.offsetHeight > fromTop
        ) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
});

// CRUD Product

$(".btn-edit").on('click', function(event) {
    $('#namaProduk').val($(this).closest('.product-container').find('.namaProduk').html());
    $('#idProduk').val($(this).closest('.product-container').find('.idProduk').val());
    $('#keteranganProduk').val($(this).closest('.product-container').find('.keteranganProduk').html());
    $('#hargaProduk').val($(this).closest('.product-container').find('.hargaProduk').html());
    $('#function').val('editProduk');
    $('#modal-title').html("Edit Produk");
    $("#labelGambar").html("Pilih Gambar");
});

$("#btn-tambah").on('click', function(event) {
    $('#namaProduk').val("");
    $('#hargaProduk').val("");
    $('#idProduk').val("0");
    $('#keteranganProduk').val('');
    $('#function').val('tambahProduk');
    $('#modal-title').html("Tambah Produk");
    $("#labelGambar").html("Pilih Gambar");
});

$(".btn-delete").on('click', function(event) {
    console.log($(this).closest('.product-container').find('.namaProduk'));
    console.log($(this).closest('.product-container').find('.idProduk').val());
    $('#konfirmasiHapus').html('Apakah Anda yakin akan menghapus Produk Ini?');
    $('#functionHapus').val('deleteProduk');
    $('#idHapus').val($(this).closest('.product-container').find('.idProduk').val());
});

$("#gambarProduk").on('change', function(event) {
    $("#labelGambar").html($(this).val().replace("C:\\fakepath\\", ""));
});

// CRUD Carousel

$(".btn-edit-carousel").on('click', function(event) {
    $('#judulCarousel').val($(this).closest('.carousel-container').find('.judulCarousel').val());
    $('#teksCarousel').html($(this).closest('.carousel-container').find('.teksCarousel').html());
    $('#idCarousel').val($(this).closest('.carousel-container').find('.idCarousel').val());
    $('#functionCarousel').val('editCarousel');
    $('#modal-title-carousel').html("Edit Carousel");
    $("#labelGambarCarousel").html("Pilih Gambar");
});

$("#btn-tambah-carousel").on('click', function(event) {
    $('#judulCarousel').val("");
    $('#teksCarousel').html("");
    $('#functionCarousel').val('tambahCarousel');
    $('#idCarousel').val("0");
    $('#modal-title-carousel').html("Tambah Carousel");
    $("#labelGambarCarousel").html("Pilih Gambar");
});

$(".btn-delete-carousel").on('click', function(event) {
    console.log($(this).closest('.carousel-container'));
    console.log($(this).closest('.carousel-container').find('.idCarousel').val());
    $('#konfirmasiHapus').html('Apakah Anda yakin akan menghapus Carousel Ini?');
    $('#functionHapus').val('deleteCarousel');
    $('#idHapus').val($(this).closest('.carousel-container').find('.idCarousel').val());
});

$("#gambarCarousel").on('change', function(event) {
    $("#labelGambarCarousel").html($(this).val().replace("C:\\fakepath\\", ""));
});

// console.log($('#notif').val());