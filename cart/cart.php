<div class="shopping">
	<div class="container">
		<div class="col-lg-12">
			<h2 class="text-center text1">Keranjang Belanja</h2>
		</div>
		<table class="timetable_sub">
			<thead>
				<tr>
					<th>Buku</th>
					<th>Jumlah</th>
					<th>Diskon</th>
					<th>Harga</th>
					<th>Total</th>
					<th>Hapus</th>
				</tr>
			</thead>
			<?php
			if(!empty($_SESSION["cart"])){
				$total = 0;
				foreach ($_SESSION["cart"] as $keys => $values) {
					$totalDisc = $values['price']-($values['price'] * $values['disc']/100);
					$subtotal = $values['qty'] * $totalDisc;
					$total = $total + $subtotal;
			?>
			<tr>
				<td align="center">
					<div class="table-column-left">
						<img src="<?= BASE_URL ?>/miiadmin/img/<?php echo $values['item_img']; ?>" class="img-small">
					</div>
				
					<div class="table-column-center ">
						Kode : <?php echo $values['product_id']; ?><br/>
						Nama : <?php echo $values['item_name']; ?><br/>
						
					</div>
				</td>
				<td align="center"><?php echo $values['qty']; ?></td>
				<td align="center"><?php echo $values['disc']; ?>%</td>
				<td align="center"><?php echo 'Rp '.number_format($values['price'],0,".","."); ?></td>
				<td align="center"><?php echo 'Rp '.number_format($subtotal,0,".","."); ?></td>
				<td align="center"><a href="<?= BASE_URL ?>/index.php?p=cart&item=<?php echo $values['product_id']; ?>&clr=<?php echo $values['color']; ?>&sz=<?php echo $values['size']; ?>"><i class="fa fa-times-circle-o"></i></a></td>
			</tr>
			<?php
				}
			}
			?>
		</table>
		<?php
		if(isset($_GET['item'])){
			foreach ($_SESSION["cart"] as $keys => $values) {
				if($values['product_id'] == $_GET['item'] && $values['color'] == $_GET['clr'] && $values['size'] == $_GET['sz']){
					unset($_SESSION['cart'][$keys]);
				}
			} ?>
			echo "<script>document.location = '<?= BASE_URL ?>/index.php?p=cart'; </script>";
		<?php }
		?>
		<div class="shopping-left">
			<div class="shopping-left-basket">
				<ul>
					<li class="total">Total semua: <span><?php echo 'Rp '.number_format($total,2,",","."); ?></span></li>
				</ul>
			</div>
		
			<div class="shopping-right-basket">
				<a class="btn-continue" href="<?= BASE_URL ?>/index.php">Lanjutkan</a>
				<a class="btn-continue" href="<?= BASE_URL ?>/index.php?p=cart&act=clear">Hapus Semua</a>
				<?php
				if(isset($_SESSION['email'])){?>
					
					<a class="btn-continue" href="<?= BASE_URL ?>/index.php?p=checkout">Berikutnya</a>
				
				<?php }elseif(isset($_COOKIE['email'])){ ?>
				
					<a class="btn-continue" href="<?= BASE_URL ?>/index.php?p=checkout">Berikutnya</a>
				
				<?php }else{ ?>
					
					<a class="btn-continue" href="<?= BASE_URL ?>/index.php?p=login">Berikutnya</a>
				
				<?php }
				?>
			</div>
			<div class="clearfix"></div>
			<?php
			if(isset($_GET['act'])){
				if($_GET['act'] == "clear"){
					unset($_SESSION['cart']); ?>
					<script>document.location = '<?= BASE_URL ?>/index.php?p=cart'; </script>;
				<?php }
			}
			?>
		</div>				
	</div>
</div>