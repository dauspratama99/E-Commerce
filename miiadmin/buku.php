<?php
error_reporting(E_ALL ^ E_NOTICE);
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
	<title>Toko Buku varia </title>
	<meta name="keywords" content="men, women, clothing, home" />
	<meta name="author" content="Victory Webstore" />

	<!-- mobile specific -->
	<meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1" />


	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/miiadmin.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />

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
		include "library.php";

		$act = @$_GET['act'];

		switch ($act) {
			default:

		?>
				<div id="page-content-wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-12">
								<h1>Data Buku</h1>
								<a href="?act=add" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Baru</a>
								<div class="clearfix"></div>

								<div class="table-responsive" style="margin-top:10px;">
									<table id="data" class="table table-bordered results" style="margin-bottom: 5%;">
										<thead>
											<tr>
												<th width="10">#</th>
												<th>Kode / ISBN</th>
												<th>Judul</th>
												<th>Nama Penggarang</th>
												<th>Tahun Terbit</th>
												<th>Jumlah Stok</th>
												<th>Harga</th>
												<th>Gambar</th>
												<th>Kategori</th>
												<th width="40">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql = "SELECT * FROM buku INNER JOIN kategori ON kategori.cat_id = buku.kategori_id";
											$query = mysqli_query($conn, $sql);
											$no = 0;
											while ($row = mysqli_fetch_assoc($query)) {

											?>
												<tr>
													<td width="10" align="center"><?php echo ++$no; ?></td>
													<td align="center"><?php echo $row['kode']; ?></td>

													<td align="center"><?php echo $row['judul']; ?></td>
													<td><?php echo $row['penggarang']; ?></td>
													<td><?php echo $row['tahun']; ?></td>
													<td><?php echo $row['jumlah']; ?> Pcs</td>
													<td><?php echo 'Rp ' . number_format($row['harga'], 0, ".", "."); ?></td>
													<td align="center"><img src="img/<?php echo $row['gambar']; ?>" class="img-small" width="8px" height="50px"></td>
													<td><?php echo $row['category']; ?></td>

													<td width="50" align="center">
														<!-- <a href="?act=edit&id=<?php echo $row['id']; ?>" class="mybtn"><i class="fa fa-pencil-square-o"> Edit </i></a> -->

														<a href="<?php echo $row['id']; ?>" data-target="#confirm-delete_<?php echo $row['id']; ?>" data-toggle="modal" class="mybtn btn-show"><i class="fa fa-trash-o"> Hapus</i></a>
														<div class="modal fade" id="confirm-delete_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true">&times;</button>
																		<h4 class="modal-tittle">
																			<i class="fa fa-trash-o"></i> Konfirmasi (<?php echo $row['id']; ?>)
																		</h4>
																	</div>
																	<div class="modal-body">
																		<p>Yakinkah Anda ingin menghapus data ini?</p>
																	</div>
																	<div class="modal-footer">
																		<a href="?act=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" id="<?php echo $row['id']; ?>">Ya</a>
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

									$kode = $_POST['kode'];
									$judul = $_POST['judul'];
									$penggarang = $_POST['penggarang'];
									$tahun = $_POST['tahun'];
									$jumlah = $_POST['jumlah'];
									$harga = $_POST['harga'];
									$kategori = $_POST['kategori'];

									$originalname = $_FILES['gambar']['name'];
									$lokasi = $_FILES['gambar']['tmp_name'];
									$size = $_FILES['gambar']['size'];
									$filename = time() . "_" . $originalname;

									$qry = "INSERT INTO buku (kode,judul,penggarang,tahun,jumlah,harga,gambar,kategori_id) VALUES ('$kode','$judul','$penggarang','$tahun','$jumlah','$harga','$filename','$kategori')";

									$hasil = mysqli_query($conn, $qry);

									move_uploaded_file($lokasi, 'img/' . $filename);

									header('location: buku.php');
								}

								?>

								<form action="?act=add" class="form-horizontal" method="POST" enctype="multipart/form-data">
									<legend>Tambah Baru</legend>
									<!-- Kode Produk -->
									<div class="form-group">
										<label class="col-md-2 control-label">Kode / ISBN</label>
										<div class="col-md-10">
											<input type="text" name="kode" class="form-control" value="">
										</div>
									</div>

									<!-- Nama Produk -->
									<div class="form-group">
										<label class="col-md-2 control-label">Judul</label>
										<div class="col-md-10">
											<input type="text" name="judul" class="form-control">
											<span class="text-danger"><?php echo $itemErr; ?></span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Nama Penggarang</label>
										<div class="col-md-10">
											<input type="text" name="penggarang" class="form-control">
											<span class="text-danger"><?php echo $itemErr; ?></span>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Tahun Terbit</label>
										<div class="col-md-4">
											<input type="text" name="tahun" class="form-control">
											<span class="text-danger"><?php echo $itemErr; ?></span>
										</div>
									</div>


									<!-- Stok Produk -->
									<div class="form-group">
										<label class="col-md-2 control-label">Stok Produk</label>
										<div class="col-md-3">
											<input type="text" name="jumlah" class="form-control">
											<span class="text-danger"><?php echo $stockErr; ?></span>
										</div>
									</div>

									<!-- Harga Produk -->
									<div class="form-group">
										<label class="col-md-2 control-label">Harga Buku</label>
										<div class="col-md-3">
											<div class="input-group">
												<div class="input-group-addon"><span>Rp</span></div><input type="text" name="harga" class="form-control" placeholder="Price" value="<?php echo isset($price) ? $price : ' '; ?>">
											</div>
											<span class="text-danger"><?php echo $priceErr; ?></span>
										</div>
									</div>

									<!-- Tipe Kategori dan Subkategori -->
									<div class="form-group">
										<label class="col-md-2 control-label">Pilih Kategori</label>
										<div class="col-md-3">
											<select name="kategori" id="kategori" class="form-control">
												<option value="" selected disabled>- Pilih kategori -</option>
												<?php
												$query = mysqli_query($conn, "SELECT * FROM kategori ORDER BY category ASC");
												while ($catid = mysqli_fetch_array($query)) {
												?>
													<option <?php if ($cat == $catid['cat_id']) echo 'selected'; ?> value="<?php echo $catid['cat_id']; ?>"><?php echo $catid['category']; ?></option>
												<?php
												}
												?>
											</select>
											<span class="text-danger"><?php echo $catErr; ?></span>
										</div>

									</div>

									<!-- Produk Gambar Multiple -->
									<div class="form-group">
										<label class="col-md-2 control-label">Gambar Buku</label>
										<div class="col-md-10">
											<div id="preview"></div>
											<input type="file" name="gambar" id="gambar" multiple><button id="btnDelete" style="display:none;">Delete</button>
											<div id="message"></div>
										</div>
									</div>

									<!-- Button -->
									<div class="form-group">
										<label class="col-md-2 control-label"></label>
										<div class="col-md-10">
											<button type="submit" class="btn btn-warning" name="save">Simpan</button>
											<a href="buku.php"><button type="button" class="btn btn-link">Batal</button></a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- 
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

								$query = mysqli_query($conn, "SELECT * FROM buku WHERE id = '" . $id . "'");
								$data = mysqli_fetch_array($query);

								$error = false;

								$item = $cat = $scat = $brd = $size = $clr = $desc = $price = $detail = $matcar = $stock = $available = "";
								$itemErr = $catErr = $scatErr = $brdErr = $sizeErr = $clrErr = $detailErr = $matcarErr = $priceErr = $stockErr = $availableErr = "";
								$A = "";
								$B = "";

								if (isset($_POST['update'])) {

									$disc = $_POST['disc'];
									$available = $_POST['available'];

									if ($_SERVER['REQUEST_METHOD'] == "POST") {

										if (empty($_POST['item'])) {
											$error = true;
											$itemErr = "Masukkan isi nama produk";
										} else {
											$item = $_POST['item'];
											if (!preg_match("/^[a-zA-Z0-9 .\-&]+$/i", $_POST['item'])) {
												$error = true;
												$itemErr = "Nama item harus menggunakan huruf, karakter dan spasi";
											}
										}

										if (trim($_POST['cat_id'] == "blank")) {
											$error = true;
											$catErr = "Pilih salah satu jenis kategori";
										} else {
											$cat = $_POST['cat_id'];
										}

										if (trim($_POST['scat_id'] == "blank")) {
											$error = true;
											$scatErr = "Pilih salah satu jenis subkategori";
										} else {
											$scat = $_POST['scat_id'];
										}

										if (trim($_POST['brand'] == "blank")) {
											$error = true;
											$brdErr = "Pilih salah satu tipe brand";
										} else {
											$brd = $_POST['brand'];
										}

										if (empty($_POST['size'])) {
											$error = true;
											$sizeErr = "Harus di centangkan";
										} else {
											$size = $_POST['size'];
										}

										if (empty($_POST['color'])) {
											$error = true;
											$clrErr = "Harus di centangkan";
										} else {
											$clr = $_POST['color'];
										}

										if (empty($_POST['detail'])) {
											$error = true;
											$detailErr = "Masukkan isi detail";
										} else {
											$detail = $_POST['detail'];
											if (!preg_match("/^[a-zA-Z0-9 .,\-&]+$/i", $_POST['detail'])) {
												$error = true;
												$detailErr = "Isi detail harus menggunakan huruf, karakter dan spasi";
											}
										}

										if (empty($_POST['matcar'])) {
											$error = true;
											$matcarErr = "Masukkan isi bahan";
										} else {
											$matcar = $_POST['matcar'];
										}

										if (empty($_POST['price'])) {
											$error = true;
											$priceErr = "Masukkan isi nominal harga";
										} else {
											$price = $_POST['price'];
											if (!is_numeric($price)) {
												$error = true;
												$priceErr = "Isi harga menggunakan angka";
											}
										}

										if (empty($_POST['stock'])) {
											$error = true;
											$stockErr = "Masukkan isi stok";
										} else {
											$stock = $_POST['stock'];
											if (!is_numeric($stock)) {
												$error = true;
												$stockErr = "Isi stok menggunakan angka";
											}
										}
									}

									if (empty($_POST['available'])) {
										$error = true;
										$availableErr = "Pilih mana yang aktif";
									} else {
										$available = $_POST['available'];
									}

									$bgImg = $_FILES['bg-img']['name'];
									$bgImgNew = date("md") . $bgImg;

									if (move_uploaded_file($_FILES['bg-img']['tmp_name'], "img/" . $bgImgNew)) {
										$sql = mysqli_query($conn, "SELECT bgimg FROM items WHERE item_id = '" . $id . "'");
										$img = mysqli_fetch_array($sql);

										if (is_file("img/" . $img['bgimg'])) {
											unlink("img/" . $img['bgimg']);
										}
										mysqli_query($conn, "UPDATE items SET bgimg='$bgImgNew' WHERE item_id='" . $id . "'");
									}

									if (!$error) {
										$size = implode(',', $_POST['size']);
										$clr = implode(',', $_POST['color']);
										$filename = implode(',', $_FILES['image']['name']);

										foreach ($_FILES['image']['error'] as $key => $error) {
											if ($error == UPLOAD_ERR_OK) {
												$image = $_FILES['image']['name'][$key];
												$tmp = $_FILES['image']['tmp_name'][$key];

												$temp = explode(',', $data['image']);
												if (move_uploaded_file($tmp, "img/" . $image)) {
													for ($i = 0; $i < count($temp); $i++) {
														if (is_file("img/" . trim($temp[$i]))) {
															unlink("img/" . trim($temp[$i]));
														}
														mysqli_query($conn, "UPDATE items SET image='$filename' WHERE item_id='" . $id . "'");
													}
												}
											}
										}

										mysqli_query($conn, "UPDATE items SET item_name='$item', cat_id='$cat', scat_id='$scat', brd_id='$brd', size='$size', clr_id='$clr', detail='$detail', material_care = '$matcar', price='$price', discount='$disc', stock='$stock', available ='$available' WHERE item_id='" . $id . "'");
										header('location: buku.php');
									}
								}

								?>
								<form action="?act=edit&id=<?php echo $_GET['id']; ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
									<legend>Edit Buku</legend>
									<!-- Kode Produk -->
				<div class="form-group">
					<label class="col-md-2 control-label">Kode / ISBN Buku</label>
					<div class="col-md-10">
						<input type="text" name="kode" class="form-control" value="<?php echo $data['kode']; ?>" readonly>
						<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					</div>
				</div>

				<!-- Nama Produk -->
				<div class="form-group">
					<label class="col-md-2 control-label">Judul Buku</label>
					<div class="col-md-10">
						<input type="text" name="judul" class="form-control" value="<?php echo isset($_POST['judul']) ? $_POST['judul'] : $data['judul']; ?>">
						<span class="text-danger"><?php echo $itemErr; ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Penggarang Buku</label>
					<div class="col-md-10">
						<input type="text" name="penggarang" class="form-control" value="<?php echo isset($_POST['penggarang']) ? $_POST['penggarang'] : $data['penggarang']; ?>">
						<span class="text-danger"><?php echo $itemErr; ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Tahun Terbit</label>
					<div class="col-md-5">
						<input type="text" name="tahun" class="form-control" value="<?php echo isset($_POST['tahun']) ? $_POST['tahun'] : $data['tahun']; ?>">
						<span class="text-danger"><?php echo $itemErr; ?></span>
					</div>
				</div>

				<!-- Stok Produk -->
				<div class="form-group">
					<label class="col-md-2 control-label">Jumlah Buku</label>
					<div class="col-md-5">
						<input type="text" name="jumlah" id="jumlah" class="form-control" value="<?php echo isset($_POST['jumlah']) ? $_POST['jumlah'] : $data['jumlah']; ?>">
						<span class="text-danger"><?php echo $stockErr; ?></span>
					</div>
				</div>

				<!-- Harga Produk -->
				<div class="form-group">
					<label class="col-md-2 control-label">Harga Buku</label>
					<div class="col-md-5">
						<div class="input-group">
							<div class="input-group-addon"><span>Rp</span></div><input type="text" name="harga" id="harga" class="form-control" placeholder="Harga" value="<?php echo isset($_POST['harga']) ? $_POST['harga'] : $data['harga']; ?>">
						</div>
						<span class="text-danger"><?php echo $priceErr; ?></span>
					</div>
				</div>

				<!-- Diskon -->
				<div class="form-group">
					<label class="col-md-2 control-label">Diskon</label>
					<div class="col-md-5">
						<div class="input-group">
							<input type="text" name="discount" class="form-control" value="<?php echo isset($_POST['discount']) ? $_POST['discount'] : $data['discount']; ?>"><span class="input-group-addon"><i>%</i></span>
						</div>
					</div>
				</div>


				<!-- Tipe Kategori dan Subkategori -->
				<div class="form-group">
					<label class="col-md-2 control-label">Kategori</label>
					<div class="col-md-3">
						<select name="kategori" id="kategori" class="form-control" onChange="showCategory(this.value);">
							<option value="blank">-- Pilih jenis kategori --</option>
							<?php
							$query = mysqli_query($conn, "SELECT * FROM kategori ORDER BY category ASC");
							while ($cat = mysqli_fetch_array($query)) {
								if ($data['cat_id'] == $cat['cat_id']) {
									echo "<option value='$cat[cat_id]' selected>$cat[category]</option>";
								} else {
									echo "<option value='$cat[cat_id]'>$cat[category]</option>";
								}
							}
							?>
						</select>

						<span class="text-danger"><?php echo $catErr; ?></span>
					</div>

				</div>

				<
				<div class="form-group">
					<label class="col-md-2 control-label"></label>
					<div class="col-md-10">
						<button type="submit" class="btn btn-warning" name="update">Update</button>
						<a href="buku.php"><button type="button" class="btn btn-link">Batal</button></a>
					</div>
				</div>
				</form>
	</div>
	</div>
	</div>
	</div> -->


<?php
				break;
			case "delete":

				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$query = "DELETE FROM buku WHERE id = '$id'";

					$sql = mysqli_query($conn, "SELECT gambar FROM buku WHERE id = '" . $id . "'");
					$img = mysqli_fetch_array($sql);

					if (is_file("img/" . $img['gambar'])) {
						unlink("img/" . $img['gambar']);
					}

					$temp = explode(',', $img['gambar']);
					for ($i = 0; $i < count($temp); $i++) {
						if (is_file("img/" . trim($temp[$i]))) {
							unlink("img/" . trim($temp[$i]));
						}
					}

					if (!$res = mysqli_query($conn, $query)) {
						exit(mysqli_error());
					}
					header('location: buku.php');
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