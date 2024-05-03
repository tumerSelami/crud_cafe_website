<?php include("../includes/header.php"); ?>

<?php 

    //Hakkımzıda
    $iletisim_query = "SELECT * FROM sectiontbl WHERE SectionName = 'İletişimBölümü'";
    $iletisim = $db->select($iletisim_query)->fetch_assoc();

; ?>


    <main id="contact-and-location-sub-page">
        <section class="banner sub-page" style="background-image: url('../assets/stock-assets/<?php echo $banners['KonumSayfası']["BannerImage"] ; ?>')">
            <div class="full-width">
                <div class="banner-header">
                    <h2 class="centered-text"><?php echo $banners['KonumSayfası']["BannerTitle"] ; ?></h2>
                </div>
    
                <article class="banner-description">
                    <p class="centered-text"><?php echo $banners['KonumSayfası']["BannerDesc"] ; ?></p>
                </article>
            </div>
        </section>

        <section id="contact" class="padding-block">
            <div class="full-width flex">
                <div id="contact-header">
                    <h5><?php echo $iletisim['SectionSubtitle'] ?></h5>
                    <h2><?php echo $iletisim['SectionTitle'] ?></h2>
                </div>
    
                <article id="contact-description">

                    <div class="tile mini-margin-block">
                        <h4 class="tiny-margin-block"><img class="tile-icon icon" src="../assets/icons-and-logos/<?php echo $socials['Adres']["InfoIcon"] ; ?>" alt="#">Kafemiz</h4>
                        <span><a target="_blank" href="<?php echo $socials['Adres']["Info"] ; ?>"><?php echo $socials['Adres']["InfoDesc"] ; ?></a></span>
                    </div>

                    <div class="tile mini-margin-block">
                        <h4 class="tiny-margin-block"><img class="tile-icon icon" src="../assets/icons-and-logos/<?php echo $socials['Telefon']["InfoIcon"] ; ?>" alt="#"><?php echo $socials['Telefon']["InfoTitle"] ; ?></h4>
                        <span><a href="tel:<?php echo $socials['Telefon']["Info"] ; ?>"><?php echo $socials['Telefon']["Info"] ; ?></a></span>
                    </div>

                    <div class="tile mini-margin-block">
                        <h4 class="tiny-margin-block"><img class="tile-icon icon" src="../assets/icons-and-logos/<?php echo $socials['E-posta']["InfoIcon"] ; ?>" alt="#"><?php echo $socials['E-posta']["InfoTitle"] ; ?></h4>
                        <span><a href="mailto:<?php echo $socials['E-posta']["Info"] ; ?>"><?php echo $socials['E-posta']["Info"] ; ?></a></span>
                    </div>
                    
                </article>
            </div>
        </section>

        <section id="google-maps-location">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d25481.28088314313!2d35.3169566!3d37.0298286!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15288f761663edc1%3A0x8dae531894f9e!2sS%C3%BCkut-u%20HAYAL!5e0!3m2!1str!2str!4v1711276947243!5m2!1str!2str" width="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
    </main>

<?php include("../includes/footer.php"); ?>