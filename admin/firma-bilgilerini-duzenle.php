<?php include("./includes/header.php"); ?>

<?php //PULLING DATA FROM DATABASE

$db = new Database();

$query = "SELECT InfoName FROM businesstbl";

$info_names = $db->select($query);

?>

<?php //ADDING DATA TO DATABASE

if (isset($_POST["submit"])) {
    //data prep
    $name = mysqli_real_escape_string($db-> link, $_POST["info-name"]);
    $title = mysqli_real_escape_string($db-> link, $_POST["info-title"]);
    $desc = mysqli_real_escape_string($db-> link, $_POST["info-desc"]);
    $info = mysqli_real_escape_string($db-> link, $_POST["info"]);

    //delete old file

    $query = "SELECT InfoIcon FROM businesstbl WHERE InfoName = " . "'" . $name . "'";
    $icon = $db->select($query)->fetch_assoc();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $file_to_delete = '../assets/icons-and-logos/' . $icon['InfoIcon'];

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

    $file = $_FILES['info-icon'];

    $file_name = $_FILES['info-icon']['name'];
    $file_temp_name = $_FILES['info-icon']['tmp_name'];
    $file_size = $_FILES['info-icon']['size'];
    $file_error = $_FILES['info-icon']['error'];
    $file_type = $_FILES['info-icon']['type'];

    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('png');

    if (in_array($file_actual_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 1048576) {
                $file_name_new = uniqid('', 'true') . "." . $file_actual_ext;

                $file_destination = "../assets/icons-and-logos/" . $file_name_new;

                move_uploaded_file($file_temp_name, $file_destination);
            } else {
                echo "Yeni dosya boyutu 1mb sınırından büyük!";
            }
        } else {
            echo "Yeni dosya yüklenirken hata oluştu!";
        }
    } else {
        echo "Bu yeni dosya türünü yükleyemezsiniz!";
    }

    //update

    if ($name == "" || $title == "" || $info == "" || $file_name_new == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "UPDATE businesstbl
        SET InfoTitle = '$title', 
        InfoDesc = '$desc', 
        Info = '$info', 
        InfoIcon = '$file_name_new'
        WHERE InfoName =  '$name'";

        $update_row = $db->update($query);
    }
}

?>

<h3>Firma Bilgilerini Düzenle</h3>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="info-name">Firma Bilgisi Seçimi</label>

        <select name="info-name" id="info-name">

            <?php while($row = $info_names->fetch_assoc()) : ?>
                <?php if($name == $row['InfoName']) : ?>
                    <option <?php echo 'selected' ; ?> value="<?php echo $row['InfoName'] ; ?>"><?php echo $row['InfoName'] ; ?></option>
                <?php else : ?>
                    <option value="<?php echo $row['InfoName'] ; ?>"><?php echo $row['InfoName'] ; ?></option>
                <?php endif ; ?>
            <?php endwhile ; ?>
               
        </select>
    </div>

    <div class="form-group">
        <label for="info-title">Bilgi Başlığı:</label>
        <input name="info-title" type="text" id="info-title" placeholder="başlığı giriniz..." value="">
    </div>

    <div class="form-group">
        <label for="info-desc">Bilgi Açıklaması:</label>
        <input name="info-desc" type="text" id="info-desc" placeholder="açıklamayı giriniz..." value="">
    </div>

    <div class="form-group">
        <label for="info">Bilgi:</label>
        <input name="info" type="text" id="info" placeholder="bilgiyi giriniz..." value="">
    </div>

    <div class="form-group">
        <label for="info-icon">Bilgi İkonu:</label>
        <input type="file" accept="image/png" name="info-icon" id="info-icon" value="">
    </div>

    <div class="actions">
        <button name="submit" type="submit" class="green">Düzenle</button>
        <a href="./index.php">İptal</a>
    </div>

</form>

<?php include("./includes/footer.php"); ?>
