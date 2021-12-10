<?php
error_reporting(E_ALL ^ E_NOTICE);

define("BASE_URL", "http://localhost/miistore/");

include "connect.php";
include "library.php";

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="/miistore/">
	<!-- meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Toko Buku Varia</title>
	<meta name="keywords" content="men, women, clothing, home" />
	<meta name="author" content="Eirene KW"/>
	
	<!-- mobile specific -->
	<meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1" />
	

	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/miistore.css" media="screen, print" />
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/coreSlider.css" />
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/assets/css/flexslider.css" media="screen" />
	
	</head>
<body>

	<?php ob_start();
	
	include "connect.php";
	date_default_timezone_set('Asia/Jakarta');
	$userIP = $_SERVER['REMOTE_ADDR'];
	$date = date('Y-m-d');
	$time = date('G:i:s');
	
	if(!isset($_COOKIE['visitor'])){
		$timed = strtotime('next day 00:00');
		setcookie('visitor','hey',$timed);
	}
	
	
	
	include "inc/header-navigation.php";
	include "inc/main.php";
	include "inc/newsletter-footer.php";
	
	ob_end_flush();
	?>
	
	<!-- JS Offline -->
	<script src="<?= BASE_URL ?>/assets/js/jquery-1.11.1.min.js"></script>
	<script src="<?= BASE_URL ?>/assets/js/coreSlider.js"></script>
	<script defer src="<?= BASE_URL ?>/assets/js/jquery.flexslider.js"></script>
	<script src="<?= BASE_URL ?>/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/custom.js"></script>
	
</body>
</html>