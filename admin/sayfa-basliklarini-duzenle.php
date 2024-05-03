<?php include("./includes/header.php"); ?>

<?php //PULLING DATA FROM DATABASE

$db = new Database();

$query = "SELECT BannerPage FROM bannertbl";

$banner_names = $db->select($query);

?>

<?php //ADDING DATA TO DATABASE

if (isset($_POST["submit"])) {
    //Assign vars
    $name = mysqli_real_escape_string($db-> link, $_POST["banner-name"]);
    $title = mysqli_real_escape_string($db-> link, $_POST["banner-title"]);
    $desc = mysqli_real_escape_string($db-> link, $_POST["banner-desc"]);
    $image = mysqli_real_escape_string($db-> link, $_POST["banner-background"]);


    //delete old file

    $query = "SELECT BannerImage FROM bannertbl WHERE BannerPage = " . "'" . $name . "'";
    $image = $db->select($query)->fetch_assoc();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $file_to_delete = '../assets/photographs/' . $image['BannerImage'];

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
    $file = $_FILES['banner-background'];

    $file_name = $_FILES['banner-background']['name'];
    $file_temp_name = $_FILES['banner-background']['tmp_name'];
    $file_size = $_FILES['banner-background']['size'];
    $file_error = $_FILES['banner-background']['error'];
    $file_type = $_FILES['banner-background']['type'];

    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('png', 'jpeg', 'jpg');

    if (in_array($file_actual_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 1048576 * 5) {
                $file_name_new = uniqid('', 'true') . "." . $file_actual_ext;

                $file_destination = "../assets/photographs/" . $file_name_new;

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


    //Simple form validation
    if ($name == "" || $title == "" || $desc == "" || $file_name_new == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "UPDATE bannertbl
        SET BannerTitle = '$title', 
        BannerDesc = '$desc', 
        BannerImage = '$file_name_new'
        WHERE BannerPage =  '$name'";

        $update_row = $db->update($query);
    }
}

?>


<h3>Sayfa Başlığı Düzenle</h3>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="banner-name">Sayfa Başlığı Adı:</label>

        <select name="banner-name" id="banner-name">

            <?php while($row = $banner_names->fetch_assoc()) : ?>
                <?php if($name == $row['BannerPage']) : ?>
                    <option <?php echo 'selected' ; ?> value="<?php echo $row['BannerPage'] ; ?>"><?php echo $row['BannerPage'] ; ?></option>
                <?php else : ?>
                    <option value="<?php echo $row['BannerPage'] ; ?>"><?php echo $row['BannerPage'] ; ?></option>
                <?php endif ; ?>
            <?php endwhile ; ?>

            <!-- see predefined names loop -->               
        </select>
    </div>

    <div class="form-group">
        <label for="banner-title">Sayfa Başlığı Başlığı:</label>
        <input name="banner-title" type="text" id="banner-title" placeholder="başlık giriniz..." value="">
    </div>

    <div class="form-group">
        <label for="banner-desc">Sayfa Başlığı Açıklaması:</label>
        <input name="banner-desc" type="text" id="banner-desc" placeholder="açıklama giriniz..." value="">
    </div>

    <div class="form-group">
        <label for="banner-background">Sayfa Başlığı Arkaplanı:</label>
        <input type="file" accept="image/png, image/jpeg" name="banner-background" id="banner-background" value="">
    </div>

    <div class="actions">
        <button name="submit" type="submit" class="green">Düzenle</button>
        <a href="./index.php">İptal Et</a>
    </div>

</form>

<?php include("./includes/footer.php"); ?>
