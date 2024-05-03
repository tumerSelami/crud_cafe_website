<?php include("./includes/header.php"); ?>

<?php

    $db = new Database();
    
    //fetch table
    $query = "SELECT * FROM menucategoriestbl";
    $categories = $db->select($query);

    //fetch category if chosen
    if (isset($_GET["id"])) {
        $category_id = $_GET["id"];
        $query = "SELECT * FROM menucategoriestbl WHERE CategoryID = " . $category_id;
        $category = $db->select($query)->fetch_assoc();
    }
?>


<?php //ADDING DATA TO DATABASE

if (isset($_POST["submit"])) {
    $category_name = mysqli_real_escape_string($db-> link, $_POST["category-name"]);

    if ($category_name == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "INSERT INTO menucategoriestbl
        (CategoryName)
        values
        ('$category_name')";

        $insert_row = $db->insert($query);
    }
}

?>


<?php //UPDATING DATA FROM A DATABASE

if (isset($_POST["update"])) {
    $category_name = mysqli_real_escape_string($db-> link, $_POST["category-name"]);

    if ($category_name == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "UPDATE menucategoriestbl
        SET CategoryName = '$category_name'
        WHERE CategoryID = " . $category_id;

        $update_row = $db->update($query);
    }
}

?>


<!-- DELETING DATA FROM DATABASE -->

<?php if (isset($_POST["delete"])) {
    $query = "DELETE FROM menucategoriestbl WHERE CategoryID = " . $category_id;

    $delete_row = $db->delete($query);
} ; ?>


<h3>Menü Kategorilerini Ekle / Düzenle / Sil</h3>

<table>
    <tr>
        <th>Kategori ID#</th>
        <th>Kategori Adı</th>
        <th>Eylem</th>
    </tr>
        <?php if(!empty($categories)) : ?>
            <?php while($row = $categories->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["CategoryID"] ; ?></td>       
                <td><?php echo $row["CategoryName"] ; ?></td>
                <td>
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $row["CategoryID"] ; ?>">Düzenle</a>
                </td>
            </tr>
            <?php endwhile ; ?>
        <?php else : ?>
            <tr>
                <td colspan="100%">Hiçbir görsel bulunamadı.</td>             
            </tr>
        <?php endif ; ?>
</table>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

    <div class="form-group">
        <label for="category-name">Kategori Adı:</label>
        <input name="category-name" type="text" id="category-name" placeholder="kategori adını giriniz..." value="<?php echo (!empty($category['CategoryName'])) ? $category['CategoryName'] : ""; ?>">
    </div>

    <div class="actions">
        <button name="submit" type="submit" class="green">Ekle</button>
        <button name="update" type="submit" class="yellow">Güncelle</button>
        <button name="delete" type="submit" class="red">Sil</button>
        <a href="./index.php">İptal Et</a>
    </div>

</form>

<?php include("./includes/footer.php"); ?>