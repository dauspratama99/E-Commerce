<!-- News Letter -->
<?php
include "connect.php";
?>
<div class="news-letter">
	<div class="container">
		<div class="join">
			<h6><b>langganan email kami</b></h6>
			<form>
				<input type="text" value="Enter Your Email Here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Your Email Here';}" />
				<input type="submit" value="SUBSCRIBE" />
			</form>
		</div>
	</div>
</div>

<!-- Footer -->
<div class="footer-top">
	<div class="container">
		<div class="col-lg-3 footer-grid">
			<h3>Tentang Kami</h3>
			<p>Toko Buku Ternama Di Kota Padang</p>
		</div>
		<div class="col-lg-3 footer-grid">
			<h3>Menu</h3>
			<ul class="footer-grid-list">
				<li><a href="<?= BASE_URL ?>/index.php">Beranda</a></li>
				<li><a href="<?= BASE_URL ?>/index.php">Brand</a></li>
				<li><a href="<?= BASE_URL ?>/index.php">Pesan Kami</a></li>
				<li><a href="<?= BASE_URL ?>/index.php">Bantuan</a></li>
				<li><a href="<?= BASE_URL ?>/index.php">FAQ</a></li>
			</ul>
		</div>
		<div class="col-lg-3 footer-grid">
			<h3>Akun</h3>
			<ul class="footer-grid-list">
				<li><a href="<?= BASE_URL ?>/index.php?p=login">Masuk</a></li>
				<li><a href="<?= BASE_URL ?>/index.php?p=register">Daftar</a></li>
			</ul>
			<h3>Hubungi Kami</h3>
			<div class="social">
				<a class="fa fa-facebook" target="_blank" href="https://www.facebook.com/dauspratama99"></a>
				<a class="fa fa-youtube" target="_blank" href="https://www.youtube.com/channel/UCC9QX4RJXRy9EcNxcY0ltIg"></a>
				<a class="fa fa-github" target="_blank" href="https://github.com/dauspratama99"></a>
				<a class="fa fa-instagram" target="_blank" href="https://www.instagram.com/daus.p_/"></a>
			</div>
		</div>
		<div class="col-lg-3 footer-grid">
			<h3>Kontak Kami</h3>
			<div class="contact-grid">
				<i class="glyphicon glyphicon-map-marker"></i>
				<div class="contact1">
					<h3>Alamat Pusat</h3>
					<p>Jl. Anggrek No 25 </p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="contact-grid">
				<i class="glyphicon glyphicon-phone"></i>
				<div class="contact1">
					<h3>Telepon Kami</h3>
					<p>021 23456789</p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="contact-grid">
				<i class="glyphicon glyphicon-envelope"></i>
				<div class="contact1">
					<h3>Email</h3>
					<p>tokovaria@gmail.com</p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="contact-grid">
				<i class="glyphicon glyphicon-bell"></i>
				<div class="contact1">
					<h3>Jam Pelayanan</h3>
					<p>Senin - Sabtu, 08.00 - 21.00 WIB</p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<div class="footer-bottom">
	<div class="container-fluid">
		<ul class="footer-bottom-left">
			<li><img src="<?= BASE_URL ?>/assets/img/f2.png" class="img-responsive"/></li>
			<li><img src="<?= BASE_URL ?>/assets/img/f3.png" class="img-responsive"/></li>
			<li><img src="<?= BASE_URL ?>/assets/img/logo-bca.png" class="img-responsive"/></li>
			<li><img src="<?= BASE_URL ?>/assets/img/logo-bni46.png" class="img-responsive"/></li>
			<li><img src="<?= BASE_URL ?>/assets/img/logo-mandiri.png" class="img-responsive"/></li>
			<li><img src="<?= BASE_URL ?>/assets/img/logo-bri.png" class="img-responsive"/></li>
		</ul>
		<p class="footer-bottom-right">&copy; 2021. All Rights Reserved | Design by <a href="https://www.instagram.com/daus.p_/">daus</a></p>
		<div class="clearfix"></div>
	</div>
</div>
