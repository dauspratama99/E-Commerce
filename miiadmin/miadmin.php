<?php
require_once("connect.php");

session_start();

if (isset($_COOKIE['user_id']) && $_COOKIE['user_id'] != '') {
	$id = $_COOKIE['user_id'];
} else if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
	$id = $_SESSION['user_id'];
} else {
	header('location: index.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Toko Buku Varia</title>
	<meta name="keywords" content="men, women, clothing, home" />
	<meta name="author" content="Victory Webstore" />

	<!-- mobile specific -->
	<meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1" />



	<!-- CSS Offline -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/miiadmin.css" />


</head>

<body>
	<?php
	$query = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '" . $id . "'");
	$data = mysqli_fetch_array($query);
	?>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="#main-toggle" id="menu-toggle" class="sidebar-toggle">
					<span class="sr-only">Toggle Navigation</span>
				</a>
				<a href="#" class="navbar-brand" style="color:white;"><b>ADMIN TOKO BUKU</b></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown user-menu">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-users"></i> <?php echo $data['fullname']; ?> <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="profil.php?id=<?php echo $id; ?>"><i class="fa fa-user"></i> Profil</a></li>
						<li><a href="logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

	<div id="wrapper">
		<nav id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li class="active"><a href="miadmin.php"><i class="fa fa-dashboard"></i> Beranda</a></li>
				<li><a href="order_confirmation.php"><i class="fa fa-shopping-cart"></i> Pesanan</a></li>
				<li class="sidebar-child"><a href="#"><i class="fa fa-th"></i> Master Buku <i class="sidebar-fa fa fa-angle-down pull-right"></i></a>
					<ul class="sidebar-second-child">
						<!-- <li><a href="pelanggan.php">Data Pelanggan</a></li> -->
						<li><a href="kategori.php">Data Kategori</a></li>
						<li><a href="buku.php">Data Buku</a></li>
					</ul>
				</li>

				<li class="sidebar-child"><a href="#"><i class="fa fa-th"></i> Pengaturan <i class="sidebar-fa fa fa-angle-down pull-right"></i></a>
					<ul class="sidebar-second-child">
						<li><a href="ganti_password.php">Ganti Password</a></li>
					</ul>
				</li>

				<li class="sidebar-child"><a href="#"><i class="fa fa-th"></i> Laporan <i class="sidebar-fa fa fa-angle-down pull-right"></i></a>
					<ul class="sidebar-second-child">
						<!-- <li><a href="pelanggan_report.php">Laporan pelanggan</a></li> -->
						<li><a href="kategori_report.php">Laporan Data Kategori</a></li>
						<li><a href="buku_report.php">Laporan Data Buku</a></li>
						<li><a href="penjualan_report.php">Laporan Penjualan</a></li>
						<!-- <li><a href="order_report_bydate.php">Laporan Data Pemesanan Berdasarkan Tanggal</a></li> -->
					</ul>
				</li>
			</ul>
		</nav>
		<?php
		include "connect.php";
		$sql = "SELECT (
					SELECT counter_visit FROM counter WHERE DATE(counter_date) = DATE(CURRENT_DATE)
				) AS today,
					(SELECT counter_visit FROM counter WHERE DATE(counter_date) = DATE(CURRENT_DATE - INTERVAL 1 DAY)
				) AS yesterday,
					(SELECT SUM(counter_visit) FROM counter WHERE WEEKOFYEAR(counter_date) = WEEKOFYEAR(CURRENT_DATE - INTERVAL 1 WEEK)
				) AS last_week,
					(SELECT SUM(counter_visit) FROM counter WHERE WEEKOFYEAR(counter_date) = WEEKOFYEAR(CURRENT_DATE)
				) AS this_week,
					(SELECT SUM(counter_visit) FROM counter WHERE MONTH(counter_date) = MONTH(CURRENT_DATE) AND YEAR(counter_date) = YEAR(CURRENT_DATE)
				) AS this_month,
					(SELECT SUM(counter_visit) FROM counter WHERE YEAR(counter_date) = YEAR(CURRENT_DATE)
				) AS this_year";
		$query = mysqli_query($conn, $sql);
		$visit = mysqli_fetch_array($query);
		?>
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<legend>
							<marquee>SELAMAT DATANG PENGUNJUNG</marquee>
						</legend>
						<div class="col-lg-12  counters">

							<img src="img/12.jpg" width="1100px" height="500px">

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<footer class="footer-bottom">
		<div class="footer-right">
			&copy; 2021. All Rights Reserved | Design by dp99 </div>
		<div class="clearfix"></div>
	</footer>

	<!-- JS Offline -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>

</body>

</html>