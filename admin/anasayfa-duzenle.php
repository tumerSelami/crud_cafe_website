<?php include("./includes/header.php"); ?>

<?php //PULLING DATA FROM DATABASE

$db = new Database();

$query = "SELECT SectionName FROM sectiontbl";

$section_names = $db->select($query);

?>

<?php //ADDING DATA TO DATABASE

if (isset($_POST["submit"])) {
    //data prep
    $name = mysqli_real_escape_string($db-> link, $_POST["section-name"]);
    $title = mysqli_real_escape_string($db-> link, $_POST["section-title"]);
    $subtitle = mysqli_real_escape_string($db-> link, $_POST["section-subtitle"]);
    $desc = mysqli_real_escape_string($db-> link, $_POST["section-desc"]);
    $image = mysqli_real_escape_string($db-> link, $_POST["section-background"]);

    //delete old file

    $query = "SELECT SectionBackground FROM sectiontbl WHERE SectionName = " . "'" . $name . "'";
    $image = $db->select($query)->fetch_assoc();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $file_to_delete = '../assets/photographs/' . $image['SectionBackground'];

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
    $file = $_FILES['section-background'];

    $file_name = $_FILES['section-background']['name'];
    $file_temp_name = $_FILES['section-background']['tmp_name'];
    $file_size = $_FILES['section-background']['size'];
    $file_error = $_FILES['section-background']['error'];
    $file_type = $_FILES['section-background']['type'];

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
        $query = "UPDATE sectiontbl
        SET SectionTitle = '$title', 
        SectionSubtitle = '$subtitle', 
        SectionDesc = '$desc',
        SectionBackground = '$file_name_new'
        WHERE SectionName =  '$name'";

        $update_row = $db->update($query);
    }
}

?>

<h3>Bölüm Düzenle</h3>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="section-name">Bölüm Adı</label>
        
        <select name="section-name" id="section-name">    
            
            <?php while($row = $section_names->fetch_assoc()) : ?>
                <?php if($name == $row['SectionName']) : ?>
                    <option <?php echo 'selected' ; ?> value="<?php echo $row['SectionName'] ; ?>"><?php echo $row['SectionName'] ; ?></option>
                <?php else : ?>
                    <option value="<?php echo $row['SectionName'] ; ?>"><?php echo $row['SectionName'] ; ?></option>
                <?php endif ; ?>
            <?php endwhile ; ?>

            <!-- see predefined names loop -->
        </select>
    </div>

    <div class="form-group">
        <label for="section-title">Bölüm Başlığı</label>
        <input name="section-title" type="text" id="section-title" placeholder="bölüm başlığını giriniz..." value="<?php echo !empty($title) ? $title : ''; ?>">
    </div>

    <div class="form-group">
        <label for="section-subtitle">Bölüm Altbaşlığı</label>
        <input name="section-subtitle" type="text" id="section-subtitle" placeholder="bölüm altbaşlığını giriniz..." value="<?php echo !empty($subtitle) ? $subtitle : ''; ?>">
    </div>

    <div class="form-group">
        <label for="section-desc">Bölüm Açıklaması</label>
        <input name="section-desc" type="text" id="section-desc" placeholder="bölüm açıklamasını giriniz..." value="<?php echo !empty($desc) ? $desc : ''; ?>">
    </div>

    <div class="form-group">
        <label for="section-background">Bölüm Görseli</label>
        <input type="file" accept="image/png, image/jpeg" name="section-background" id="section-background" value="<?php echo !empty($image) ? $image : ''; ?>">
    </div>

    <div class="actions">
        <button name="submit" type="submit" class="green">Düzenle</button>
        <a href="./index.php">İptal Et</a>
    </div>

</form>


<?php include("./includes/footer.php"); ?>
