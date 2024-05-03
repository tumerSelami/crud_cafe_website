<?php include("../config/config.php"); ?>
<?php include("../libraries/database.php"); ?>
<?php include("../helpers/format-helper.php"); ?>

<?php
    $db = new Database();

    //Banners
    $BannerNames = ['HakkımızdaSayfası', 'MenüSayfası', 'KonumSayfası'];

    $banners = [];

    foreach ($BannerNames as $name) {
        $query = "SELECT * FROM bannertbl WHERE BannerPage = '$name'";
        $banners[$name] = $db->select($query)->fetch_assoc();
    }  

    //Socials
    $socialNames = ['E-posta', 'Instagram', 'Telefon', 'Adres', 'Foursquare'];

    $socials = [];

    foreach ($socialNames as $name) {
        $query = "SELECT * FROM businesstbl WHERE InfoName = '$name'";
        $socials[$name] = $db->select($query)->fetch_assoc();
    }   

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <title>My Project</title>
</head>
<body>

    <header>
        <nav id="header-nav" class="flex full-width">
            <div id="nav-links" class="flex">
                <a href="../sayfalar/hakkimizda.php">Hakkımızda</a>
                <a href="../sayfalar/menu.php">Menümüz</a>
                <a href="../sayfalar/resim-galerisi.php">Galerimiz</a>
            </div>

            <div class="brand-logo" class="image-container">
                <a href="../index.php"><img src="../assets/icons-and-logos/sukutu-hayal-brand-logo.png" alt="logo-of-sukutu-hayal-cafe"></a>
            </div>

            <a href="../sayfalar/konum-ve-iletisim.php" id="nav-button-link" class="button-link red">Konum ve İletişim<img class="icon" src="../assets/icons-and-logos/location.png" alt="icon-of-a-map-and-a-pin"></a>

            <button id="menu-toggle"><img class="icon" src="../assets/icons-and-logos/main-menu.png" alt=""></button>
        </nav>
    </header>