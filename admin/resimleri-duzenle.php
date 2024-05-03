<?php include("./includes/header.php"); ?>

<?php

    $db = new Database();
    
    //fetch table
    $query = "SELECT * FROM imagetbl";
    $images = $db->select($query);

    //fetch image if chosen
    if (isset($_GET["id"])) {
        $image_id = $_GET["id"];
        $query = "SELECT * FROM imagetbl WHERE ImageID = " . $image_id;
        $image = $db->select($query)->fetch_assoc();
    }
?>


<?php //ADDING DATA TO DATABASE

if (isset($_POST["submit"])) {
    $file = $_FILES['image'];

    $file_name = $_FILES['image']['name'];
    $file_temp_name = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_error = $_FILES['image']['error'];
    $file_type = $_FILES['image']['type'];

    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($file_actual_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 1048576 * 5) {
                $file_name_new = uniqid('', 'true') . "." . $file_actual_ext;

                $file_destination = "../assets/photographs/" . $file_name_new;

                move_uploaded_file($file_temp_name, $file_destination);
            } else {
                echo "Dosya boyutu 5mb sınırından büyük!";
            }
        } else {
            echo "Dosya yüklenirken hata oluştu!";
        }
    } else {
        echo "Bu dosya türünü yükleyemezsiniz!";
    }


    if ($file_name_new == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "INSERT INTO imagetbl
        (ImageURL)
        values
        ('$file_name_new')";

        $insert_row = $db->insert($query);
    }
}

?>


<!-- DELETING DATA FROM DATABASE -->

<?php if (isset($_POST["delete"])) {
    $query = "DELETE FROM imagetbl WHERE ImageID = " . $image_id;

    $delete_row = $db->delete($query);


    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $file_to_delete = '../assets/photographs/' . $image['ImageURL'];

    if (file_exists($file_to_delete) && is_writable($file_to_delete)) {
        if (unlink($file_to_delete)) {
            echo "Başarılı: Dosya Silindi";
        } else {
            echo "Hata: Dosya silinemedi.";
        }
    } else {
        echo "Hata: Böyle bir dosya mevcut değil ya da düzenlenemiyor.";
    }

} ; ?>


<h3>Görsel Ekle / Sil</h3>

<table>
    <tr>
        <th>Görsel ID#</th>
        <th>Görsel Ad</th>
        <th>Görsel</th>
        <th>Eylem</th>
    </tr>
        <?php if(!empty($images)) : ?>
            <?php while($row = $images->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["ImageID"] ; ?></td>       
                <td><?php echo $row["ImageURL"] ; ?></td>
                <td><img src="../assets/photographs/<?php echo $row['ImageURL'] ; ?>"></td>
                <td>
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $row["ImageID"] ; ?>">Düzenle</a>
                </td>
            </tr>
            <?php endwhile ; ?>
        <?php else : ?>
            <tr>
                <td colspan="100%">Hiçbir görsel bulunamadı.</td>             
            </tr>
        <?php endif ; ?>
</table>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="image">Görsel:</label>
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" id="image" value="<?php echo (!empty($image['ImageURL'])) ? $image['ImageURL'] : ""; ?>">
    </div>

    <div class="actions">
        <button name="submit" type="submit" class="green">Ekle</button>
        <button name="delete" type="submit" class="red">Sil</button>
        <a href="./index.php">İptal Et</a>
    </div>

</form>

<?php include("./includes/footer.php"); ?>
