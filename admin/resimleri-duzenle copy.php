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
    $image = mysqli_real_escape_string($db-> link, $_POST["image"]);

    if ($image == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "INSERT INTO imagetbl
        (ImageURL)
        values
        ('$image')";

        $insert_row = $db->insert($query);
    }
}

?>


<!-- DELETING DATA FROM DATABASE -->

<?php if (isset($_POST["delete"])) {
    $query = "DELETE FROM imagetbl WHERE ImageID = " . $image_id;

    $delete_row = $db->delete($query);
} ; ?>


<h3>Görsel Ekle / Sil</h3>

<table>
    <tr>
        <th>Görsel ID#</th>
        <th>Görsel</th>
        <th>Eylem</th>
    </tr>
        <?php if(!empty($images)) : ?>
            <?php while($row = $images->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["ImageID"] ; ?></td>       
                <td><?php echo $row["ImageURL"] ; ?></td>
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
