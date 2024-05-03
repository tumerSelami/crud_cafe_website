<?php include("./includes/header.php"); ?>

<?php

    $db = new Database();

    //fetch table
    $query = "SELECT * FROM commenttbl";
    $comments = $db->select($query);

    //fetch comment if chosen
    if (isset($_GET["id"])) {
        $comment_id = $_GET["id"];
        $query = "SELECT * FROM commenttbl WHERE CommentID = " . $comment_id;
        $comment = $db->select($query)->fetch_assoc();
    }
?>

<?php //ADDING DATA TO DATABASE

if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($db-> link, $_POST["name"]);
    $caption = mysqli_real_escape_string($db-> link, $_POST["caption"]);
    $comment = mysqli_real_escape_string($db-> link, $_POST["comment"]);
    $stars = mysqli_real_escape_string($db-> link, $_POST["stars"]);
    $photo = mysqli_real_escape_string($db-> link, $_POST["photo"]);

    //image prep
    $file = $_FILES['photo'];

    $file_name = $_FILES['photo']['name'];
    $file_temp_name = $_FILES['photo']['tmp_name'];
    $file_size = $_FILES['photo']['size'];
    $file_error = $_FILES['photo']['error'];
    $file_type = $_FILES['photo']['type'];

    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('png', 'jpeg', 'jpg');

    if (in_array($file_actual_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 1048576) {
                $file_name_new = uniqid('', 'true') . "." . $file_actual_ext;

                $file_destination = "../assets/photographs/" . $file_name_new;

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

    if ($name == "" || $comment == "" || $file_name_new == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "INSERT INTO commenttbl
        (Name, Caption, Comment, Stars, Photo)
        values
        ('$name', '$caption', '$comment', '$stars', '$file_name_new')";

        $insert_row = $db->insert($query);
    }
}

?>


<?php //UPDATING DATA TO DATABASE

if (isset($_POST["update"])) {
    $name = mysqli_real_escape_string($db-> link, $_POST["name"]);
    $caption = mysqli_real_escape_string($db-> link, $_POST["caption"]);
    $comment = mysqli_real_escape_string($db-> link, $_POST["comment"]);
    $stars = mysqli_real_escape_string($db-> link, $_POST["stars"]);
    $photo = mysqli_real_escape_string($db-> link, $_POST["photo"]);

    //delete old image
    $query = "SELECT Photo FROM commenttbl WHERE CommentID = " . "'" . $comment_id . "'";
    $image = $db->select($query)->fetch_assoc();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $file_to_delete = '../assets/photographs/' . $image['Photo'];

    if (file_exists($file_to_delete) && is_writable($file_to_delete)) {
        if (unlink($file_to_delete)) {
            echo "Başarılı: Eski Dosya Silindi";
        } else {
            echo "Hata: Eski Dosya Silinemedi.";
        }
    } else {
        echo "Hata: Böyle eski bir dosya mevcut değil ya da düzenlenemiyor.";
    }

    //new image prep
    $file = $_FILES['photo'];

    $file_name = $_FILES['photo']['name'];
    $file_temp_name = $_FILES['photo']['tmp_name'];
    $file_size = $_FILES['photo']['size'];
    $file_error = $_FILES['photo']['error'];
    $file_type = $_FILES['photo']['type'];

    $file_ext = explode('.', $file_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed = array('png', 'jpeg', 'jpg');

    if (in_array($file_actual_ext, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 1048576) {
                $file_name_new = uniqid('', 'true') . "." . $file_actual_ext;

                $file_destination = "../assets/photographs/" . $file_name_new;

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

    //update database

    if ($name == "" || $comment == "" || $file_name_new == "") {
        $error = "Lütfen gerekli tüm yerleri doldurun.";
    } else {
        $query = "UPDATE commenttbl
        SET Name = '$name',
        Caption = '$caption', 
        Comment = '$comment', 
        Stars = '$stars',
        Photo = '$file_name_new'
        WHERE CommentID = " . $comment_id;

        $update_row = $db->update($query);
    }
}

?>


<!-- DELETING DATA FROM DATABASE -->

<?php if (isset($_POST["delete"])) {
    //delete image
    $query = "SELECT Photo FROM commenttbl WHERE CommentID = " . "'" . $comment_id . "'";
    $image = $db->select($query)->fetch_assoc();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $file_to_delete = '../assets/photographs/' . $image['Photo'];

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
    $query = "DELETE FROM commenttbl WHERE CommentID = " . $comment_id;

    $delete_row = $db->delete($query);
} ; ?>


<h3>Yorumları Ekle / Düzenle / Sil</h3>

<table>
    <tr>
        <th>Yorum ID#</th>
        <th>Ad</th>
        <th>Altbaşlık</th>
        <th>Yorum</th>
        <th>Yıldız</th>
        <th>Fotoğraf</th>
        <th>Eylem</th>
    </tr>
        <?php if(!empty($comments)) : ?>
            <?php while($row = $comments->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row["CommentID"] ; ?></td>
                <td><?php echo $row["Name"] ; ?></td>
                <td><?php echo $row["Caption"] ; ?></td>
                <td><?php echo $row["Comment"] ; ?></td>
                <td><?php echo $row["Stars"] ; ?></td>
                <td><img src="../assets/photographs/<?php echo $row['Photo'] ; ?>"></td>  
                <td>
                    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $row["CommentID"] ; ?>">Düzenle</a>
                </td>             
            </tr>
            <?php endwhile ; ?>
        <?php else : ?>
            <tr>
                <td colspan="100%">Hiçbir yorum bulunamadı.</td>             
            </tr>
        <?php endif ; ?>
</table>

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="name">İsim:</label>
        <input name="name" type="text" id="name" placeholder="isim giriniz..." value="<?php echo (!empty($comment['Name'])) ? $comment['Name'] : ""; ?>">
    </div>

    <div class="form-group">
        <label for="caption">Alt Başlık:</label>
        <input name="caption" type="text" id="caption" placeholder="altbaşlık giriniz..." value="<?php echo (!empty($comment['Caption'])) ? $comment['Caption'] : ""; ?>">
    </div>

    <div class="form-group">
        <label for="comment">Yorum:</label>
        <input name="comment" type="text" id="comment" placeholder="yorum giriniz..." value="<?php echo (!empty($comment['Comment'])) ? $comment['Comment'] : ""; ?>">
    </div>

    <div class="form-group">
        <label for="stars">Yıldız:</label>
        <input name="stars" type="number" min="1" max="5" id="stars" value="<?php echo (!empty($comment['Stars'])) ? $comment['Stars'] : ""; ?>">
    </div>

    <div class="form-group">
        <label for="photo">Fotoğraf:</label>
        <input type="file" accept="image/png, image/jpeg" name="photo" id="photo" value="">
    </div>

    <div class="actions">
        <button name="submit" type="submit" class="green">Ekle</button>
        <button name="update" type="submit" class="yellow">Güncelle</button>
        <button name="delete" type="submit" class="red">Sil</button>
        <a href="./index.php">İptal Et</a>
    </div>

</form>

<?php include("./includes/footer.php"); ?>
