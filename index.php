<?php include("./config/config.php"); ?>
<?php include("./libraries/database.php"); ?>
<?php include("./helpers/format-helper.php"); ?>

<?php 
    $db = new Database();

    //Sections
    $sectionNames = ['AnaBölüm', 'HakkımızdaBölümü', 'MiniGaleriBölümü', 'TanıtımBölümü', 'MiniTanıtımBölümü1', 'MiniTanıtımBölümü2', 'MenüBölümü', 'İletişimBölümü', 'MottoBölümü'];

    $sections = [];

    foreach ($sectionNames as $name) {
        $query = "SELECT * FROM sectiontbl WHERE SectionName = '$name'";
        $sections[$name] = $db->select($query)->fetch_assoc();
    }    

    //Images
    $query_images = "SELECT * FROM imagetbl";
    $images = $db->select($query_images);

    //Comments
    $query_comments = "SELECT * FROM commenttbl";
    $comments = $db->select($query_comments);

    //Socials
    $socialNames = ['E-posta', 'Instagram', 'Telefon', 'Adres', 'Foursquare'];

    $socials = [];

    foreach ($socialNames as $name) {
        $query = "SELECT * FROM businesstbl WHERE InfoName = '$name'";
        $socials[$name] = $db->select($query)->fetch_assoc();
    }   

; ?>

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
    <link rel="stylesheet" href="./style.css">
    <title>Sükut-u Hayal | Anasayfa</title>
</head>
<body>

    <header>
        <nav id="header-nav" class="flex full-width">
            <div id="nav-links" class="flex">
                <a href="./sayfalar/hakkimizda.php">Hakkımızda</a>
                <a href="./sayfalar/menu.php">Menümüz</a>
                <a href="./sayfalar/resim-galerisi.php">Galerimiz</a>
            </div>

            <div class="brand-logo" class="image-container">
                <a href="./index.php"><img src="./assets/icons-and-logos/sukutu-hayal-brand-logo.png" alt="logo-of-sukutu-hayal-cafe"></a>
            </div>

            <a href="./sayfalar/konum-ve-iletisim.php" id="nav-button-link" class="button-link red">Konum ve İletişim<img class="icon" src="./assets/icons-and-logos/location.png" alt="icon-of-a-map-and-a-pin"></a>

            <button id="menu-toggle"><img class="icon" src="./assets/icons-and-logos/main-menu.png" alt=""></button>
        </nav>

        <section id="hero" class="flex">
            <div id="hero-image-container" class="image-container">
                <img src="./assets/photographs/<?php echo $sections['AnaBölüm']["SectionBackground"] ; ?>" alt="a-photo-of-a-red-beetle-car-inside-of-a-coffee-shop">
            </div>

            <div id="hero-description">
                <h1><?php echo $sections['AnaBölüm']["SectionTitle"] ; ?></h1>
                <p class="mini-margin-block"><?php echo $sections['AnaBölüm']["SectionDesc"] ; ?></p>
                <a href="./sayfalar/menu.php" class="button-link red"> <img class="icon" src="./assets/icons-and-logos/drinks-menu.png" alt="icon-of-a-drinks-menu">Menümüz</a>
                <a href="./sayfalar/konum-ve-iletisim.php" class="button-link white">Konum ve İletişim</a>
            </div>
        </section>
    </header>

    <main>
        <section id="about-us" class="padding-block">
            <div class="full-width flex">
                <div id="about-us-header">
                    <h5><?php echo $sections['HakkımızdaBölümü']["SectionSubtitle"] ; ?></h5>
                    <h2><?php echo $sections['HakkımızdaBölümü']["SectionTitle"] ; ?></h2>                    
                </div>
    
                <article id="about-us-description">
                    <p><?php echo $sections['HakkımızdaBölümü']["SectionDesc"] ; ?></p>
                    <a href="./sayfalar/hakkimizda.php" class="button-link red"><img class="icon" src="./assets/icons-and-logos/shop-sign.png" alt="icon-of-a-shop-sign">Hakkımızda</a>
                </article>
            </div>
        </section>


        <section id="image-gallery" class="padding-block">
            <div class="full-width centered-text">
                <h2><?php echo $sections['MiniGaleriBölümü']["SectionTitle"] ; ?></h2>
                <p class="margin-block"><?php echo $sections['MiniGaleriBölümü']["SectionDesc"] ; ?></p>

                <div id="main-page-carousel-container" class="flex owl-carousel owl-theme">

                    <?php 
                    if($images): 
                        $counter = 0;
                        while($image_row = $images->fetch_assoc()): 
                            if($counter >= 8) break; ?>
                            <div class="image-container item">
                                <img class="carousel-image" src="./assets/photographs/<?= $image_row["ImageURL"] ?>" alt="#">
                            </div>
                        <?php 
                            $counter++;
                        endwhile;
                    else: ?> 
                        <p>Resim Bulunamadı.</p>
                    <?php endif; ?>    

                </div>
            </div>
        </section>


        <section id="features" class="padding-block">
            <div class="full-width flex">
                <article id="features-description">
                    <h2><?php echo $sections['TanıtımBölümü']["SectionTitle"] ; ?></h2>
                    <p class="mini-margin-block"><?php echo $sections['TanıtımBölümü']["SectionDesc"] ; ?></p>

                    <div id="mini-descriptions" class="flex">
                        <div class="mini-description">
                            <img src="./assets/icons-and-logos/<?php echo $sections['MiniTanıtımBölümü1']["SectionBackground"] ; ?>" alt="icon-of-a-latte-cup" class="icon">
                            <h4 class="mini-margin-block"><?php echo $sections['MiniTanıtımBölümü1']["SectionTitle"] ; ?></h4>
                            <p><?php echo $sections['MiniTanıtımBölümü1']["SectionDesc"] ; ?></p>
                        </div>

                        <div class="mini-description">
                            <img src="./assets/icons-and-logos/<?php echo $sections['MiniTanıtımBölümü2']["SectionBackground"] ; ?>" alt="icon-of-a-cassette" class="icon">
                            <h4 class="mini-margin-block"><?php echo $sections['MiniTanıtımBölümü2']["SectionTitle"] ; ?></h4>
                            <p><?php echo $sections['MiniTanıtımBölümü2']["SectionDesc"] ; ?></p>
                        </div>
                    </div>
                </article>


                <div class="image-container">
                    <img id="features-image" src="./assets/photographs/inner-decorations-16.jpg" alt="#">
                </div>
            </div>
        </section>


        <section id="testimonials" class="padding-block">
            <div class="full-width flex owl-carousel owl-theme">

            
            <?php if($comments): ?>

            <?php while($comment_row = $comments->fetch_assoc()) : ?>

                <div class="testimonial item">
                    <div class="stars-contanier centered-text">

                        <?php 
                            for ($i = 0; $i < $comment_row["Stars"]; $i++) {
                                echo '<img src="./assets/icons-and-logos/star.png" alt="icon-of-a-star" class="icon star">';
                            }
                            if ($comment_row["Stars"] < 5) {
                                for ($i=0; $i < 5 - $comment_row["Stars"]; $i++) { 
                                    echo '<img src="./assets/icons-and-logos/black-star.png" alt="icon-of-a-star" class="icon star">';
                                }
                            }
                        ; ?>
                    </div>
        
                    <blockquote>
                        <p class="mini-margin-block centered-text"><?php echo $comment_row["Comment"] ; ?></p>
                        <div class="customer-info mini-margin-block flex">
                            <img class="customer-photo" src="./assets/photographs/<?php echo $comment_row["Photo"] ; ?>" alt="profile-photo-of-a-customer">
                            <div class="customer">
                                <h4><cite><?php echo $comment_row["Name"] ; ?></cite></h4>
                                <span ><?php echo $comment_row["Caption"] ; ?></span>
                            </div>
                            <a target="_blank" href="https://maps.app.goo.gl/DkRZLyJDc2T4pQmU6"><img class="icon platform-icon" src="./assets/icons-and-logos/google-maps.png" alt="icon-of-a-google-maps-platfrom"></a>
                        </div>
                    </blockquote>
                </div>

            <?php endwhile ; ?>

            <?php else : ?> 

                    <p>Herhangi bir yorum bulunamadı.</p>

            <?php endif ; ?>

            </div>
        </section>
        

        <section id="menu" class="padding-block" style="background-image: url('./assets/photographs/<?php echo $sections['MenüBölümü']["SectionBackground"] ; ?>');">
            <div class="full-width centered-text">
                <h1><?php echo $sections['MenüBölümü']["SectionTitle"] ; ?></h1>
                <p class="mini-margin-block"><?php echo $sections['MenüBölümü']["SectionDesc"] ; ?></p>
                <a href="./sayfalar/menu.php" class="button-link red"><img class="icon" src="./assets/icons-and-logos/drinks-menu.png" alt="icon-of-a-drinks-menu">Menümüz</a>
                <a href="./sayfalar/konum-ve-iletisim.php" class="button-link white">Konum ve İletişim</a>
            </div>
        </section>


        <section id="contact-and-location" class="padding-block">
            <div class="full-width centered-text">
                <h5><?php echo $sections['İletişimBölümü']["SectionSubtitle"] ; ?></h5>
                <h2 class="mini-margin-block"><?php echo $sections['İletişimBölümü']["SectionTitle"] ; ?></h2>
                <p><?php echo $sections['İletişimBölümü']["SectionDesc"] ; ?></p>

                <div id="business-infos" class="flex">

                    <div class="tile">
                        <img class="tile-icon icon" src="./assets/icons-and-logos/<?php echo $socials['Adres']["InfoIcon"] ; ?>" alt="#">
                        <h3><?php echo $socials['Adres']["InfoTitle"] ; ?></h3>
                        <p class="tiny-margin-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.</p>
                        <span><a target="_blank" href="<?php echo $socials['Adres']["Info"] ; ?>"><?php echo $socials['Adres']["InfoDesc"] ; ?></a></span>
                    </div>

                    <div class="tile">
                        <img class="tile-icon icon" src="./assets/icons-and-logos/<?php echo $socials['Telefon']["InfoIcon"] ; ?>" alt="#">
                        <h3><?php echo $socials['Telefon']["InfoTitle"] ; ?></h3>
                        <p class="tiny-margin-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.</p>
                        <span><a href="tel:<?php echo $socials['Telefon']["Info"] ; ?>"><?php echo $socials['Telefon']["Info"] ; ?></a></span>
                    </div>

                    <div class="tile">
                        <img class="tile-icon icon" src="./assets/icons-and-logos/<?php echo $socials['E-posta']["InfoIcon"] ; ?>" alt="#">
                        <h3><?php echo $socials['E-posta']["InfoTitle"] ; ?></h3>
                        <p class="tiny-margin-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in ero.</p>
                        <span><a href="mailto:<?php echo $socials['E-posta']["Info"] ; ?>"><?php echo $socials['E-posta']["Info"] ; ?></a></span>
                    </div>
                    
                </div>
            </div>
        </section>

        <section id="quote" class="centered-text padding-block">
            <blockquote cite="#">
                <p><?php echo $sections['MottoBölümü']["SectionDesc"] ; ?></p>
                <span><cite><?php echo $sections['MottoBölümü']["SectionTitle"] ; ?></cite></span>
              </blockquote>          
        </section>
    </main>

    <footer>
        <div class="full-width centered-text">
            <nav id="footer-nav" class="flex mini">
                <div class="brand-logo" class="image-container">
                    <a href="./index.php"><img src="./assets/icons-and-logos/sukutu-hayal-brand-logo.png" alt="logo-of-sukutu-hayal-cafe"></a>
                </div>
    
                <div id="nav-links" class="flex">
                    <a href="./sayfalar/hakkimizda.php">Hakkımızda</a>
                    <a href="./sayfalar/menu.php">Menümüz</a>
                    <a href="./sayfalar/resim-galerisi.php">Galerimiz</a>
                    <a href="./sayfalar/konum-ve-iletisim.php">Konum ve İletişim</a>
                </div>
    
                <div id="nav-social-links">
                    <a target="_blank" href="<?php echo $socials['Instagram']["Info"] ; ?>" class="footer-icon-link"><img class="social icon" src="./assets/icons-and-logos/instagram.png" alt="#"></a>
                    <a target="_blank" href="<?php echo $socials['Foursquare']["Info"] ; ?>" class="footer-icon-link"><img class="social icon" src="./assets/icons-and-logos/foursquare.png" alt="#"></a>
                </div>
            </nav>
    
            <div id="copyright">
                <p class="tiny-margin-block">© 2024 Sükut-u Hayal. Tüm hakları Saklıdır.</p>
                <a href="#">Gizlilik Politikası</a>
                <a href="#">Fıstık Politikası</a>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js" integrity="sha512-rCjfoab9CVKOH/w/T6GbBxnAH5Azhy4+q1EXW5XEURefHbIkRbQ++ZR+GBClo3/d3q583X/gO4FKmOFuhkKrdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./script.js"></script>
</body>
</html>
