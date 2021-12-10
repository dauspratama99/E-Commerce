<?php
error_reporting(E_ALL ^ E_NOTICE);

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

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/miiadmin.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<?php
	$queryname = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '" . $id . "'");
	$name = mysqli_fetch_array($queryname);
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
						<i class="fa fa-users"></i> <?php echo $name['fullname']; ?> <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#"><i class="fa fa-user"></i> Profil</a></li>
						<li><a href="logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

	<div id="wrapper">
		<aside id="sidebar-wrapper">
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
		</aside>
		<?php
		include "library.php";
		?>
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<button type="button" class="btn btn-default" onclick="window.open('penjualan_report_v.php');"> Lihat PDF</button>
						<h1>Laporan Data Penjualan</h1>
						<div>
							<div class="table-responsive">
								<table id="data" class="table table-bordered results">
									<thead>
										<tr>
											<th width="10">#</th>
											<th>Tanggal Transaksi</th>
											<th>Kode Pesanan</th>
											<th>Pembayaran</th>
											<th>Status Pesanan</th>
											<th>Total</th>

										</tr>
									</thead>
									<tbody>
										<?php
										$sql = "SELECT * FROM orders
										WHERE order_status = 'SENT'
										ORDER BY order_id = 'ASC'";

										$query = mysqli_query($conn, $sql);

										$no = 0;
										$tot = 0;
										while ($row = mysqli_fetch_assoc($query)) {

										?>
											<tr align="center">
												<td width="10" align="center"><?php echo ++$no; ?></td>
												<td><?php echo fixdate($row['creation_date']); ?></td>
												<td><?php echo $row['order_id']; ?></td>
												<td><?php echo $row['cardbank_type']; ?></td>
												<td><?php echo $row['order_status']; ?></td>
												<td>Rp. <?php echo number_format($row['totals']); ?></td>

											</tr>
										<?php
											$tot += $row['totals'];
										?>
										<?php } ?>
									</tbody>

									<tr>
										<td colspan="5" style="text-align: center;"><b>TOTAL</b></td>
										<td style="text-align: center;"><b>Rp. <?= number_format($tot); ?></b></td>
									</tr>
								</table>
							</div>


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
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>

</body>

</html>