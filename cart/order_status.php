
<div class="shopping">
    <div class="container">
        <div class="col-lg-12">
            <h2 class="text-center text1">Status Pesanan</h2>
        </div>
       
        <table class="timetable_sub">
            <thead>
                <tr>
                    <th width="10">#</th>
                    <th>Tanggal</th>
                    <th>Kode Pesanan</th>
                    <th>Total Bayar</th>
                    <th>Status Pengiriman</th>
                </tr>
            </thead>
                <?php
                    if(!empty($_SESSION["member_id"])){ ?>
                    
                    <?php
                        $id = $_SESSION['member_id'];
                      
                        $query = mysqli_query($conn, "SELECT * FROM orders JOIN members ON orders.customer_id=members.member_id WHERE orders.customer_id= $id");
                        $no = 0;
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td width="10" align="center"><?php echo ++$no; ?></td>
                        <td align="center"><?php echo $row['creation_date']; ?></td>
                        <td width="15" align="center"><?php echo $row['order_id']; ?></td>
                        <td align="center"><?php echo 'Rp ' . number_format($row['totals'], 0, ".", "."); ?></td>
                        <td align="center"><?php echo $row['order_status']; ?></td>
                    </tr>
                <?php } ?>

                    <?php } else { ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                    <?php } ?>
            <tbody>
               
            </tbody>
        
        </table>
        <?php
        if (isset($_GET['item'])) {
            foreach ($_SESSION["cart"] as $keys => $values) {
                if ($values['product_id'] == $_GET['item'] && $values['color'] == $_GET['clr'] && $values['size'] == $_GET['sz']) {
                    unset($_SESSION['cart'][$keys]);
                }
            } ?>
            echo "<script>
                document.location = '<?= BASE_URL ?>/index.php?p=cart';
            </script>";
        <?php }
        ?>
        <div class="shopping-left">
            <div class="shopping-right-basket">
                <a class="btn-continue" href="<?= BASE_URL ?>/index.php">Kembali</a>
            </div>
        </div>
    </div>
</div>

