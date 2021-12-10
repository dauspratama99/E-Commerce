<?php
error_reporting(E_ALL ^ E_NOTICE);

set_time_limit(0);

session_start();


ob_start();

include "../connect.php";
include "../library.php";
?>

<!DOCTYPE html>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cetak Laporan Buku</title>
    <style>
        html,
        body {
            background: #eee;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
        }


        .container {

            margin: auto;
            /* padding-left: 100px; */
        }

        /*design table 1*/
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: sans-serif;
            color: #232323;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;

            border: 1px solid #999;
            padding: 8px 20px;
        }

        .contoh-link:hover {
            background: #16A085;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div>
                <center>
                    <h1>Laporan Data Buku</h1>


                    <hr <hr style="display: block; height: 1px;border: 0; border-top: 1px solid #ccc;margin: 1em 0; padding: 0;">
                </center>
            </div>
        </div>

        <h3 align="center"><u>Periode Cetak : <?php echo date('F Y')  ?></u></h3>

        <div class="row">
            <div>
                <div>
                    <br>
                    <table>
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
                                    <td align="center"><img src="img/<?php echo $row['gambar']; ?>" class="img-small" width="50px" height="50px"></td>
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
                    <br>
                    <br>
                    <div class="" aliign="">

                        <div class="float-end text-center" style="padding: 1cm;padding-top:0%">
                            <!-- <h6 class="text-center" style="margin-bottom: 2cm;">{{ date('d F Y') }}</h6> -->
                            <span align="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala Toko</span><br><br><br><br>
                            <span>( ..................................... )</span><br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>