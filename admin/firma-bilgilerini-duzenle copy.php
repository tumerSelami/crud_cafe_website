<?php include("./includes/header.php"); ?>

<?php //PULLING DATA FROM DATABASE

$db = new Database();

$query = "SELECT InfoName FROM businesstbl";

$info_names = $db->select($query);

?>

<?php //ADDING DATA TO DATABASE

if (isset($_POST["submit"])) {

    $name = mysqli_real_escape_string($db-> link, $_POST["info-name"]);
    $title = mysqli_real_escape_string($db-> link, $_POST["info-title"]);
    $desc = mysqli_real_escape_string($db-> link, $_POST["info-desc"]);
    $info = mysqli_real_escape_string($db-> link, $_POST["info"]);
    $icon = mysqli_real_escape_string($db-> link, $_POST["info-icon"]);

    if ($name == "" || $title == "" || $info == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "UPDATE businesstbl
        SET InfoTitle = '$title', 
        InfoDesc = '$desc', 
        Info = '$info', 
        InfoIcon = '$icon'
        WHERE InfoName =  '$name'";

        $update_row = $db->update($query);
    }
}

?>

<h3>Firma Bilgilerini Düzenle</h3>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

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
        <label for="info-title">Bilgi Başlığı</label>
        <input name="info-title" type="text" id="info-title" placeholder="başlığı giriniz..." value="">
    </div>

    <div class="form-group">
        <label for="info-desc">Bilgi Açıklaması</label>
        <input name="info-desc" type="text" id="info-desc" placeholder="açıklamayı giriniz..." value="">
    </div>

    <div class="form-group">
        <label for="info">Bilgi</label>
        <input name="info" type="text" id="info" placeholder="bilgiyi giriniz..." value="">
    </div>

    <div class="form-group">
        <label for="info-icon">Bilgi İkonu</label>
        <input type="file" accept="image/png, image/jpeg" name="info-icon" id="info-icon" value="">
    </div>

    <div class="actions">
        <button name="submit" type="submit" class="green">Düzenle</button>
        <a href="./index.php">İptal</a>
    </div>

</form>

<?php include("./includes/footer.php"); ?>
