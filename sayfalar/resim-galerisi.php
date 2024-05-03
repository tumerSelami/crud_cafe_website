<?php include("../config/config.php"); ?>
<?php include("../libraries/database.php"); ?>
<?php include("../helpers/format-helper.php"); ?>

<?php 
    $db = new Database();

    //Images
    $query_images = "SELECT * FROM imagetbl";
    $images = $db->select($query_images);

    //Banner
    $query_banner = "SELECT * FROM bannertbl WHERE BannerPage = 'GaleriSayfası'";
    $banner = $db->select($query_banner)->fetch_assoc();

    //Socials
    $socialNames = ['E-posta', 'Instagram', 'Telefon', 'Adres', 'Foursquare'];

    $socials = [];

    foreach ($socialNames as $name) {
        $query = "SELECT * FROM businesstbl WHERE InfoName = '$name'";
        $socials[$name] = $db->select($query)->fetch_assoc();
    }  
    
; ?>


<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/nanogallery2@3/dist/css/nanogallery2.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/nanogallery2@3/dist/jquery.nanogallery2.min.js"></script>
    <link rel="stylesheet" href="../style.css">

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

    <main id="image-gallery-sub-page">

        <section id="gallery">
            <h1><?php echo $banner["BannerTitle"] ; ?></h1>
            <p class="tiny-margin-block"><?php echo $banner["BannerDesc"] ; ?></p>
            
            <div ID="ngy2p" data-nanogallery2='{
                "itemsBaseURL": "../assets/photographs/",
                "thumbnailWidth": "450",
                "thumbnailHeight": "350",
                "thumbnailBorderVertical": 0,
                "thumbnailBorderHorizontal": 0,
                "thumbnailLabel": {
                  "position": "overImageOnBottom",
                  "display": false
                },
                "thumbnailHoverEffect2": "imageScaleIn80",
                "galleryDisplayMode": "moreButton",
                "thumbnailAlignment": "center",
                "thumbnailGutterWidth": 4,
                "thumbnailGutterHeight": 4,
                "thumbnailOpenImage": true
            }'>
                <!-- <a href="inner-decorations-1.jpg" data-ngthumb="inner-decorations-1.jpg" data-ngdesc=""></a> -->

                <?php
                    while($row = $images->fetch_assoc()) {
                        echo '<a href="'.$row['ImageURL'].'" data-ngthumb="'.$row['ImageURL'].'" data-ngdesc=""></a>';
                    }
                ?>
                
            </div>
        </section>
        
    </main>

    <footer class="mini-margin-block">
        <div class="full-width centered-text">
            <nav id="footer-nav" class="flex mini">
                <div class="brand-logo" class="image-container">
                    <a href="../index.php"><img src="../assets/icons-and-logos/sukutu-hayal-brand-logo.png" alt="logo-of-sukutu-hayal-cafe"></a>
                </div>
    
                <div id="nav-links" class="flex">
                    <a href="../sayfalar/hakkimizda.php">Hakkımızda</a>
                    <a href="../sayfalar/menu.php">Menümüz</a>
                    <a href="../sayfalar/resim-galerisi.php">Galerimiz</a>
                    <a href="../sayfalar/konum-ve-iletisim.php">Konum ve İletişim</a>
                </div>
    
                <div id="nav-social-links">
                    <a target="_blank" href="<?php echo $socials['Instagram']["Info"] ; ?>" class="footer-icon-link"><img class="social icon" src="../assets/icons-and-logos/instagram.png" alt="#"></a>
                    <a target="_blank" href="<?php echo $socials['Foursquare']["Info"] ; ?>" class="footer-icon-link"><img class="social icon" src="../assets/icons-and-logos/foursquare.png" alt="#"></a>
                </div>
            </nav>
    
            <div id="copyright">
                <p class="tiny-margin-block">© 2024 Sükut-u Hayal. Tüm hakları Saklıdır.</p>
                <a href="#">Gizlilik Politikası</a>
                <a href="#">Çerez Politikası</a>
            </div>
        </div>
    </footer>
  </body>
</html>