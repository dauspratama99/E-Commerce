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
    <title>Cetak Laporan Kategori</title>
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
                    <h1>Laporan Data Kategori</h1>


                    <hr <hr style="display: block; height: 1px;border: 0; border-top: 1px solid #ccc;margin: 1em 0; padding: 0;">
                </center>
            </div>
        </div>

        <h3 align="center"><u>Periode Cetak : <?php echo date('F Y')  ?></u></h3>

        <div class="row">
            <div>
                <div>
                    <br>
                    <table id="data" class="table table-bordered results">
                        <thead>
                            <tr>
                                <th width="10">#</th>
                                <th>Nama Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM kategori";
                            $query = mysqli_query($conn, $sql);
                            $no = 0;
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td width="10" align="center"><?php echo ++$no; ?></td>
                                    <td align="center"><?php echo $row['category']; ?></td>

                                </tr>
                            <?php } ?>
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