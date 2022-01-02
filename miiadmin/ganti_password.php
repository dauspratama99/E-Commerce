<?php
require_once("connect.php");

ob_start();
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
		include "connect.php";

		$act = @$_GET['act'];

		switch ($act) {
			default:

		?>
				<div id="page-content-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-12">
								<h1>User / Admin</h1>
								<a href="?act=add" class="btn btn-default"><i class="fa fa-plus"></i> Tambah User Baru</a>
								<div class="clearfix"></div>

								<div class="table-responsive" style="margin-top:10px;">
									<table id="data" class="table table-bordered results">
										<thead>
											<tr>
												<th width="10">#</th>
												<th>Nama Lengkap</th>
												<th>Username</th>
												<th>Password</th>
												<th width="40">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql = "SELECT * FROM users";
											$query = mysqli_query($conn, $sql);
											$no = 0;
											while ($row = mysqli_fetch_assoc($query)) {
											?>
												<tr>
													<td width="10" align="center"><?php echo ++$no; ?></td>
													<td align="center"><?php echo $row['fullname']; ?></td>
													<td align="center"><?php echo $row['user']; ?></td>
													<td align="center"><?php echo $row['pass']; ?></td>
													<td width="50" align="center">
														<a href="?act=edit&id=<?php echo $row['user_id']; ?>" class="mybtn"><i class="fa fa-pencil-square-o"> Edit</i></a>


														<a href="<?php echo $row['user_id']; ?>" data-target="#confirm-delete_<?php echo $row['user_id']; ?>" data-toggle="modal" class="mybtn btn-show"><i class="fa fa-trash-o"> Hapus</i></a>
														<div class="modal fade" id="confirm-delete_<?php echo $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
																		<h4 class="modal-tittle">
																			<i class="fa fa-trash-o"></i> Konfirmasi (<?php echo $row['user_id']; ?>)
																		</h4>
																	</div>
																	<div class="modal-body">
																		<p>Yakinkah Anda ingin menghapus data ini ?</p>
																	</div>
																	<div class="modal-footer">
																		<a href="?act=delete&id=<?php echo $row['user_id']; ?>" class="btn btn-danger" id="<?php echo $row['user_id']; ?>">Ya</a>
																		<a href="#" type="button" class="btn btn-default btn-cancel" data-dismiss="modal" aria-hidden="true">Tidak</a>
																	</div>
																</div>
															</div>
														</div>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php
				break;
			case 'add':
			?>
				<div id="page-content-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-12">


							<?php



								if (isset($_POST['save'])) {

									$fullname = $_POST['fullname'];
									$user = $_POST['user'];
									$password = $_POST['password'];

									$qry = "INSERT INTO users (fullname, user, pass) VALUES ('$fullname','$user','$password')";

									$hasil = mysqli_query($conn, $qry);

									header('location: ganti_password.php');
								}

								?>

								<form action="?act=add" class="form-horizontal" method="POST">
									<legend>Tambah Admin Baru</legend>
									<!-- Category Name -->
									<div class="form-group">
										<label class="col-md-2 control-label">Nama Lengkap <i>(required)</i></label>
										<div class="col-md-10">
											<input type="text" name="fullname" placeholder="fullname" class="form-control">
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-md-2 control-label">Username <i>(required)</i></label>
										<div class="col-md-10">
											<input type="text" name="user" placeholder="Username" class="form-control">
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-md-2 control-label">Password <i>(Minimal 8 Karakter)</i></label>
										<div class="col-md-10">
											<input type="password" name="password" placeholder="Password" class="form-control">
										</div>
									</div>
									<!-- Button -->
									<div class="form-group">
										<label class="col-md-2 control-label"></label>
										<div class="col-md-10">
											<button type="submit" class="btn btn-warning" name="save">Simpan</button>
											<a href="ganti_password.php"><button type="button" class="btn btn-link">Batal</button></a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php
				break;
			case "edit":
			?>
				<div id="page-content-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-12">
                            <?php

                                $id = $_GET['id'];

                                $query = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '" . $id . "'");
                                $data = mysqli_fetch_array($query);


                                $error = false;
                                $brand  = "";
                                $brandErr = "";

                                if (isset($_POST['update'])) {

                                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                                        if (empty($_POST['fullname'])) {
                                            $error = true;
                                        }

                                        if (empty($_POST['username'])) {
                                            $error = true;
                                        }

                                        if (empty($_POST['password'])) {
                                            $error = true;
                                        }
                                    }


                                    if (!$error) {

                                        $fullname = $_POST['fullname'];
                                        $username    = $_POST['username'];
                                        $password    = $_POST['password'];

                                        mysqli_query($conn, "UPDATE users SET fullname='$fullname', user='$username', pass='$password' WHERE user_id='" . $id . "'");
                                        header('location: ganti_password.php');
                                    }
                                }

                                ?>
							<form action="?act=edit&id=<?php echo $_GET['id']; ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
									<legend>Edit Data User / Admin</legend>
									<!-- Brand Name -->
									<div class="form-group">
										<label class="col-md-2 control-label">Nama Lengkap<i>(required)</i></label>
										<div class="col-md-10">
											<input type="text" name="fullname" value="<?php echo $data['fullname']; ?>" class="form-control">
											<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
											<span class="text-danger"><?php echo $brandErr; ?></span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Username<i>(required)</i></label>
										<div class="col-md-10">
											<input type="text" name="username" value="<?php echo $data['user']; ?>" class="form-control">
											<span class="text-danger"><?php echo $brandErr; ?></span>
										</div>
									</div>


									<div class="form-group">
										<label class="col-md-2 control-label">Password <i>(minimal 8 karakter)</i></label>
										<div class="col-md-10">
											<input type="password" name="password" value="<?php echo $data['pass']; ?>" class="form-control">
											<span class="text-danger"><?php echo $brandErr; ?></span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label"></label>
										<div class="col-md-10">
											<button type="submit" class="btn btn-warning" name="update">Update</button>
											<a href="pelanggan.php"><button type="button" class="btn btn-link">Batal</button></a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php
				break;
			case "delete":
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$query = "DELETE FROM users WHERE user_id = '$id'";
					if (!$res = mysqli_query($conn, $query)) {
						exit(mysqli_error());
					}
					header('location: ganti_password.php');
				}
			?>

		<?php
				break;
		}
		?>
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

<?php
ob_end_flush();
?>