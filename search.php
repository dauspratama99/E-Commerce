<div class="top-products">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="text-center text1">Semua Produk</h2>
			</div>
		</div>
		<div class="row product">
<?php
include "connect.php";
$key = $_GET['key'];

$query = mysqli_query($conn, "SELECT * FROM buku WHERE judul LIKE '%{$key}%'");
while($row = mysqli_fetch_array($query)){ ?>
<?php	$totalDisc = $row['harga']-($row['harga'] * $row['discount']/100); ?>
	<div class="col-md-3 col-xs-6 product-left">
					<div class="p-one">
						<a href="#">
							<img src="<?= BASE_URL ?>/miiadmin/img/<?= $row['gambar']; ?>"/>
							<div class="mask">
								<a href="<?= BASE_URL ?>/index.php?p=single&id=<?= $row['id'] ?>"><span>Quick View</span></a>
							</div>
						</a>
						<h4><?= $row['judul'] ?></h4>
						<div class="item_price">
							<p>
								<i>Rp <?= number_format($row['harga'],0,".",".") ?> </i>
								<span> Rp <?= number_format($totalDisc,0,".",".") ?></span>
							</p>
						</div>
					</div>
				</div>;
				<?php
}
?>
		</div>
	</div>
</div>
<div class="clearfix"></div>