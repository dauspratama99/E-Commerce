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
						<button type="button" class="btn btn-default" onclick="window.open('buku_report_v.php');"> Lihat PDF</button>
						<h1>Laporan Data Buku</h1>
						<div>
							<div class="table-responsive">
								<table class="table table-bordered results">
									<thead>
										<tr>
											<th width="10">#</th>
											<th>Kode / ISBN</th>
											<th>Judul</th>
											<th>Nama Penggarang</th>
											<th>Tahun Terbit</th>
											<th>Kategori</th>
											<th>Gambar</th>
											<th>Jumlah Stok</th>
											<th>Harga</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$perpage = 15;
										$page = isset($_GET['page']) ? $_GET['page'] : "";

										if (empty($page)) {
											$num = 0;
											$page = 1;
										} else {
											$num = ($page - 1) * $perpage;
										}
										$sql1 = "SELECT * FROM buku INNER JOIN kategori ON 
							  					kategori.cat_id = buku.kategori_id ORDER BY buku.id ASC LIMIT $num, $perpage";
										$query = mysqli_query($conn, $sql1);
										while ($row = mysqli_fetch_array($query)) {
											$totalDisc = $row['harga'] - ($row['harga'] * $row['discount'] / 100);
											$total1 = $total1 + $totalDisc;
											$total2 = $total2 + $row['jumlah'];
										?>
											<tr>
												<td width="10" align="center"><?php echo ++$no; ?></td>
												<td align="center"><?php echo $row['kode']; ?></td>

												<td align="center"><?php echo $row['judul']; ?></td>
												<td><?php echo $row['penggarang']; ?></td>
												<td><?php echo $row['tahun']; ?></td>
												<td><?php echo $row['category']; ?></td>
												<td align="center"><img src="img/<?php echo $row['gambar']; ?>" class="img-small" width="8px" height="50px"></td>
												<td><?php echo $row['jumlah']; ?> Pcs</td>
												<td><?php echo 'Rp ' . number_format($row['harga'], 0, ".", "."); ?></td>
											</tr>
										<?php } ?>
										<tr>
											<td colspan="7" align="center"><b>TOTAL</b></td>
											<td align="left"><b><?php echo $total2; ?> Pcs</b></td>
											<td align="left"><b><?php echo 'Rp ' . number_format($total1, 0, ".", "."); ?></b></td>
										</tr>
									</tbody>
								</table>
							</div>
							<?php
							$sql2 = mysqli_query($conn, "SELECT * FROM buku INNER JOIN kategori ON 
							  kategori.cat_id = buku.kategori_id");
							$total_record = mysqli_num_rows($sql2);
							$total_page = ceil($total_record / $perpage);
							?>
							<div class="col-lg-12 col-xs-12">
								<nav class="text-center">
									<ul class="pagination" style="margin-bottom: 5%;">
										<?php
										if ($page > 1) {
											$prev = "<a href='item_report.php?page=1'><span aria-hidden='true'>First</span></a>";
										} else {
											$prev = "<a href=''><span aria-hidden='true'>First</span></a>";
										}
										$number = '';
										for ($i = 1; $i <= $total_page; $i++) {
											if ($i == $page) {
												$number .= "<a href='item_report.php?page=$i'>$i</a>";
											} else {
												$number .= "<a href='item_report.php?page=$i'>$i</a>";
											}
										}
										if ($page < $total_page) {
											$link = $page + 1;
											$next = "<a href='item_report.php?page=$total_page'><span aria-hidden='true'>Last</span></a>";
										} else {
											$next = "<a href=''><span aria-hidden='true'>Last</span></a>";
										}
										?>
										<li><?php echo $prev; ?></li>
										<li><?php echo $number; ?></li>
										<li><?php echo $next; ?></li>
									</ul>
								</nav>
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