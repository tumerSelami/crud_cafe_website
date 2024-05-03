<?php include("../includes/header.php"); ?>

<?php 

//Hakkımzıda
$hakkimizda_query = "SELECT * FROM sectiontbl WHERE SectionName = 'HakkımızdaBölümü'";
$hakkimizda = $db->select($hakkimizda_query)->fetch_assoc();

//Images
$query_images = "SELECT * FROM imagetbl";
$images = $db->select($query_images);

; ?>


    <main id="about-us-sub-page">
        <section class="banner" style="background-image: url('../assets/stock-assets/<?php echo $banners['HakkımızdaSayfası']["BannerImage"] ; ?>')">
            <div class="full-width">
                <div class="banner-header">
                    <h2 class="centered-text"><?php echo $banners['HakkımızdaSayfası']["BannerTitle"] ; ?></h2>
                </div>
    
                <article class="banner-description">
                    <p class="centered-text"><?php echo $banners['HakkımızdaSayfası']["BannerDesc"] ; ?></p>
                </article>
            </div>
        </section>

        <section id="about-us" class="padding-block">
            <div class="full-width flex">
                <div id="about-us-header">
                    <h5><?php echo $hakkimizda['SectionSubtitle'] ?></h5>
                    <h2><?php echo $hakkimizda['SectionTitle'] ?></h2>
                </div>
    
                <article id="about-us-description">
                    <p><?php echo $hakkimizda['SectionDesc'] ?></p>
                    <a href="../sayfalar/menu.php" class="button-link red"><img class="icon" src="../assets/icons-and-logos/drinks-menu.png" alt="icon-of-a-drinks-menu">Menümüz</a>
                    <a href="../sayfalar/konum-ve-iletisim.php" class="button-link white">Konum ve İletişim</a>
                </article>
            </div>
        </section>


        <section id="image-gallery">
            <div class="md-width centered-text">
                <div id="about-us-carousel-container" class="flex owl-carousel owl-theme">
                    
                    <?php 
                        if($images): 
                            $counter = 0;
                            while($image_row = $images->fetch_assoc()): 
                                if($counter >= 8) break; ?>
                                <div class="image-container item">
                                    <img class="carousel-image" src="../assets/photographs/<?= $image_row["ImageURL"] ?>" alt="#">
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
    </main>

<?php include("../includes/footer.php"); ?>