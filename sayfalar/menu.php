<?php include("../includes/header.php"); ?>

<?php 
    //Menu Categories
    $query_categories = "SELECT * FROM 	menucategoriestbl";
    $categories = $db->select($query_categories);
    
; ?>

    <main id="menu-sub-page">
        <section class="banner sub-page" style="background-image: url('../assets/stock-assets/<?php echo $banners['MenüSayfası']["BannerImage"] ; ?>')">
            <div class="full-width">
                <div class="banner-header">
                    <h2 class="centered-text"><?php echo $banners['MenüSayfası']["BannerTitle"] ; ?></h2>
                </div>
    
                <article class="banner-description">
                    <p class="centered-text"><?php echo $banners['MenüSayfası']["BannerDesc"] ; ?></p>
                </article>
            </div>
        </section>

        <section id="menu-container" class="full-width margin-block">
            <h1 class="centered-text">Menümüz</h1>

            <div class="tabs">

            <?php while($category_row = $categories->fetch_assoc()) : ?>

                <input type="radio" class="tabs__radio" name="tabs-example" id="tab<?php echo $category_row["CategoryID"] ; ?>" checked>
                <label for="tab<?php echo $category_row["CategoryID"] ; ?>" class="tabs__label"><?php echo $category_row["CategoryName"] ; ?></label>

                <div class="tabs__content">
                    <div class="products flex">

                        <?php 
                            //Menu Products
                            $query_products = "SELECT * FROM menutbl WHERE ProductCategory = '" . $category_row['CategoryName'] . "'";
                            $products = $db->select($query_products);
                        ; ?>

                        <?php while($product_row = $products->fetch_assoc()) : ?>

                        <div class="product flex">
                        <img src="../assets/product-images/<?php echo $product_row["ProductImage"] ; ?>" alt="">
                        <div>
                            <h3><?php echo $product_row["ProductTitle"] ; ?> <span>$<?php echo $product_row["ProductPrice"] ; ?></span></h3>
                            <p><?php echo $product_row["ProductDescription"] ; ?></p>
                        </div>
                        </div>

                        <?php endwhile ; ?>

                    </div>
                </div>

            <?php endwhile ; ?>
            
            </div>
        </section>
        
    </main>

<?php include("../includes/footer.php"); ?>