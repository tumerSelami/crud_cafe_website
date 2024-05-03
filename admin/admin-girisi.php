<?php include("../config/config.php"); ?>
<?php include("../libraries/database.php"); ?>

<?php 

session_start();

$db = new Database();

if (isset($_POST['submit'])) {

    if (!empty($_POST["user"]) && !empty($_POST["pwd"])) {
        $query = "SELECT * FROM admintbl WHERE admin = '" . $_POST["user"] . "' AND password = '" . $_POST["pwd"] . "'";
        $output = $db->select($query);

        if ($output === false) {
            echo "Bilgiler yanlış!" . "<br>";
        } else {
            $_SESSION["username"] = $_POST["user"];
            $_SESSION["password"] = $_POST["pwd"];
            header("Location: index.php");
            exit();
        }

    } else {
        echo "Lütfen gerekli bilgileri girin";
    }
}

; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin Girişi</title>
</head>
<body>

	<h1 style="text-align: center; margin-top: 2rem;">Sükut-u Hayal Yönetim Paneli Girişi</h1>

    <form id="login" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="user">Admin: </label>
            <input name="user" type="text" id="user" placeholder="kullanıcı adını giriniz...">
        </div>

        <div class="form-group">
            <label for="pwd">Şifre: </label>
            <input name="pwd" type="password" id="pwd" placeholder="şifreyi giriniz...">
        </div>

        <div class="actions">
            <button style="float: right;" name="submit" type="submit" class="green">Giriş</button>
        </div>
    </form>
</body>
</html>