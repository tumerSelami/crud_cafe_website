<?php include("./includes/header.php"); ?>

<?php

    $db = new Database();

    //fetch table
    $query = "SELECT * FROM menutbl";
    $products = $db->select($query);

    //fetch categories
    $query = "SELECT CategoryName FROM menucategoriestbl";
    $categories = $db->select($query);

    //fetch product if chosen
    if (isset($_GET["id"])) {
        $product_id = $_GET["id"];
        $query = "SELECT * FROM menutbl WHERE ProductID = " . $product_id;
        $product = $db->select($query)->fetch_assoc();
    }
?>


<?php //ADDING DATA TO DATABASE

if (isset($_POST["submit"])) {
    $title = mysqli_real_escape_string($db-> link, $_POST["product-title"]);
    $desc = mysqli_real_escape_string($db-> link, $_POST["product-desc"]);
    $price = mysqli_real_escape_string($db-> link, $_POST["product-price"]);
    $category = mysqli_real_escape_string($db-> link, $_POST["product-category"]);
    $image = mysqli_real_escape_string($db-> link, $_POST["product-image"]);

    //image prep
    $file = $_FILES['product-image'];

    $file_name = $_FILES['product-image']['name'];
    $file_temp_name = $_FILES['product-image']['tmp_name'];
    $file_size = $_FILES['product-image']['size'];
    $file_error = $_FILES['product-image']['error'];
    $file_type = $_FILES['product-image']['type'];

    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('png', 'jpeg', 'jpg');

    if (in_array($file_actual_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 1048576 * 5) {
                $file_name_new = uniqid('', 'true') . "." . $file_actual_ext;

                $file_destination = "../assets/product-images/" . $file_name_new;

                move_uploaded_file($file_temp_name, $file_destination);
            } else {
                echo "Yeni dosya boyutu 5mb sınırından büyük!";
            }
        } else {
            echo "Yeni dosya yüklenirken hata oluştu!";
        }
    } else {
        echo "Bu yeni dosya türünü yükleyemezsiniz!";
    }

    if ($title == "" || $category == "" || $file_name_new == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "INSERT INTO menutbl
        (ProductTitle, ProductDescription, ProductPrice, ProductCategory, ProductImage)
        values
        ('$title', '$desc', $price, '$category', '$file_name_new')";

        $insert_row = $db->insert($query);
    }
}

?>

<?php //UPDATING DATA TO DATABASE

if (isset($_POST["update"])) {
    $title = mysqli_real_escape_string($db-> link, $_POST["product-title"]);
    $desc = mysqli_real_escape_string($db-> link, $_POST["product-desc"]);
    $price = mysqli_real_escape_string($db-> link, $_POST["product-price"]);
    $category = mysqli_real_escape_string($db-> link, $_POST["product-category"]);
    $image = mysqli_real_escape_string($db-> link, $_POST["product-image"]);


    //delete old file

    $query = "SELECT ProductImage FROM menutbl WHERE ProductID = " . "'" . $product_id . "'";
    $image = $db->select($query)->fetch_assoc();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $file_to_delete = '../assets/product-images/' . $image['ProductImage'];

    if (file_exists($file_to_delete) && is_writable($file_to_delete)) {
        if (unlink($file_to_delete)) {
            echo "Başarılı: Eski Dosya Silindi";
        } else {
            echo "Hata: Eski Dosya Silinemedi.";
        }
    } else {
        echo "Hata: Böyle eski bir dosya mevcut değil ya da düzenlenemiyor.";
    }


    //image prep
    $file = $_FILES['product-image'];

    $file_name = $_FILES['product-image']['name'];
    $file_temp_name = $_FILES['product-image']['tmp_name'];
    $file_size = $_FILES['product-image']['size'];
    $file_error = $_FILES['product-image']['error'];
    $file_type = $_FILES['product-image']['type'];

    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('png', 'jpeg', 'jpg');

    if (in_array($file_actual_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 1048576 * 5) {
                $file_name_new = uniqid('', 'true') . "." . $file_actual_ext;

                $file_destination = "../assets/product-images/" . $file_name_new;

                move_uploaded_file($file_temp_name, $file_destination);
            } else {
                echo "Yeni dosya boyutu 5mb sınırından büyük!";
            }
        } else {
            echo "Yeni dosya yüklenirken hata oluştu!";
        }
    } else {
        echo "Bu yeni dosya türünü yükleyemezsiniz!";
    }

    
    //update database

    if ($title == "" || $category == "" || $file_name_new == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "UPDATE menutbl
        SET ProductTitle = '$title',
        ProductDescription = '$desc', 
        ProductPrice = '$price', 
        ProductCategory = '$category',
        ProductImage = '$file_name_new'
        WHERE ProductID = " . $product_id;

        $update_row = $db->update($query);
    }
}

?>

<!-- DELETING DATA FROM DATABASE -->

<?php if (isset($_POST["delete"])) {
    //delete image
    $query = "SELECT ProductImage FROM menutbl WHERE ProductID = " . "'" . $product_id . "'";
    $image = $db->select($query)->fetch_assoc();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $file_to_delete = '../assets/product-images/' . $image['ProductImage'];

    if (file_exists($file_to_delete) && is_writable($file_to_delete)) {
        if (unlink($file_to_delete)) {
            echo "Başarılı: Eski Dosya Silindi";
        } else {
            echo "Hata: Eski Dosya Silinemedi.";
        }
    } else {
        echo "Hata: Böyle eski bir dosya mevcut değil ya da düzenlenemiyor.";
    }

    //delete datas
    $query = "DELETE FROM menutbl WHERE ProductID = " . $product_id;

    $delete_row = $db->delete($query);
} ; ?>


<table>
    <tr>
        <th>Ürün ID#</th>
        <th>Ürün Adı</th>
        <th>Ürün Açıklaması</th>
        <th>Ürün Fiyatı</th>
        <th>Ürün Kategorisi</th>
        <th>Ürün Görseli</th>
        <th>Eylem</th>
    </tr>
        <?php if(!empty($products)) : ?>
            <?php while($row = $products->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["ProductID"] ; ?></td>
                <td><?php echo $row["ProductTitle"] ; ?></td>
                <td><?php echo $row["ProductDescription"] ; ?></td>
                <td><?php echo $row["ProductPrice"] ; ?></td>
                <td><?php echo $row["ProductCategory"] ; ?></td>
                <td><img src="../assets/product-images/<?php echo $row['ProductImage'] ; ?>"></td>
                <td>
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $row["ProductID"] ; ?>">Düzenle</a>
                </td>               
            </tr>
            <?php endwhile ; ?>
        <?php else : ?>
            <tr>
                <td colspan="100%">Hiçbir ürün bilgisi bulunamadı.</td>             
            </tr>
        <?php endif ; ?>
</table>

<h3>Ürün Ekle / Düzenle / Sil</h3>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="product-category">Kategori Seçimi:</label>

        <select name="product-category" id="product-category">

            <?php while($row = $categories->fetch_assoc()) : ?>
                <!-- if yapısı kullanılabilir -->
                <option value="<?php echo $row['CategoryName'] ; ?>"><?php echo $row['CategoryName'] ; ?></option>
            <?php endwhile ; ?>    
                        
        </select>
    </div>

    <div class="form-group">
        <label for="product-title">Ürün Başlığı:</label>
        <input name="product-title" type="text" id="product-title" placeholder="ürün başlığını giriniz..." value="<?php echo (!empty($product['ProductTitle'])) ? $product['ProductTitle'] : ""; ?>">
    </div>

    <div class="form-group">
        <label for="product-desc">Ürün Açıklaması:</label>
        <input name="product-desc" type="text" id="product-desc" placeholder="ürün açıklamasını giriniz..." value="<?php echo (!empty($product['ProductDescription'])) ? $product['ProductDescription'] : ""; ?>">
    </div>

    <div class="form-group">
        <label for="product-price">Ürün Fiyatı:</label>
        <input name="product-price" type="text" id="product-price" placeholder="ürün fiyatını giriniz..." value="<?php echo (!empty($product['ProductPrice'])) ? $product['ProductPrice'] : ""; ?>">
    </div>

    <div class="form-group">
        <label for="product-image">Ürün Görseli:</label>
        <input type="file" accept="image/png, image/jpeg" name="product-image" id="product-image" value="">
    </div>

    <div class="actions">
        <button name="submit" type="submit" class="green">Ekle</button>
        <button name="update" type="submit" class="yellow">Güncelle</button>
        <button name="delete" type="submit" class="red">Sil</button>
        <a href="./index.php">İptal Et</a>
    </div>

</form>

<?php include("./includes/footer.php"); ?>
