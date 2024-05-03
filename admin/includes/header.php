<?php 
session_save_path('./includes/sessions.php');
session_start(); 
?>


<?php include("../config/config.php"); ?>
<?php include("../libraries/database.php"); ?>
<?php include("../helpers/format-helper.php"); ?>

<?php

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
	header('Location: admin-girisi.php');
	exit();
}

if (isset($_POST['logout'])) {
	session_destroy();
	header('Location: admin-girisi.php');
	exit();
}


?>


<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sükut-u Hayal | Admin Panel</title>
	<link rel="stylesheet" href="../css/admin.css" />
</head>
<body>
	<div class="app">
		<div class="menu-toggle">
			<div class="hamburger">
				<span></span>
			</div>
		</div>

		<aside class="sidebar">
			<h4>Menu</h4>
			
			<nav class="menu">
				<a class="menu-item is-active" href="./index.php">Admin Paneli</a>
				<a class="menu-item" href="./firma-bilgilerini-duzenle.php">Firma Bilgilerini Düzenle</a>
				<a class="menu-item" href="./anasayfa-duzenle.php">Anasayfa Düzenle</a>
				<a class="menu-item" href="./sayfa-basliklarini-duzenle.php">Sayfa Başlıklarını Düzenle</a>
				<a class="menu-item" href="./menuyu-duzenle.php">Menüyü Düzenle</a>
				<a class="menu-item" href="./menu-kategorileri-duzenle.php">Menü Kategorilerini Düzenle</a>
				<a class="menu-item" href="./yorumlari-duzenle.php">Yorumları Düzenle</a>
				<a class="menu-item" href="./resimleri-duzenle.php">Resimleri Düzenle</a>
				<a class="menu-item" href="http://localhost/site/index.php" style="font-weight:600">Web Sitesine Git</a>
				<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
					<button style="position: absolute; bottom: 2rem; left: 2rem;" class="red" name="logout" type="submit">Çıkış Yap</button>
				</form>
			</nav>

		</aside>

		<main class="content">
			<h1>Sükut-u Hayal Yönetim Paneli</h1>