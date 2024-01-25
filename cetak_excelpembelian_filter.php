<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "appgudang");
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Pembelian.xls"); 

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil tanggal awal dan tanggal akhir dari form
$tanggal_awal = $_POST['tanggal_awal'];
$tanggal_akhir = $_POST['tanggal_akhir'];

// Query untuk mengambil data transaksi dalam periode tertentu

$query = "SELECT pembelian.*, tbbarang.* 
FROM pembelian JOIN tbbarang ON pembelian.kodeb = tbbarang.kodeb  WHERE pembelian.tgltransaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ";
$result = mysqli_query($koneksi, $query);

$tgl_awal = date("d-m-Y", strtotime($tanggal_awal));
$tgl_akhir = date("d-m-Y", strtotime($tanggal_akhir));

// format ubah bulan yang berupa angka ke huruf 
$tanggal_awal_obj = new DateTime($tanggal_awal);
$tanggal_akhir_obj = new DateTime($tanggal_akhir);

$tanggal_awal_string = $tanggal_awal_obj->format('d F Y');
$tanggal_akhir_string = $tanggal_akhir_obj->format('d F Y');

// Tutup koneksi ke database
mysqli_close($koneksi);




?>


<html>
    
    <head>
    <title>Laporan Pembelian</title>
</head>

<body>


    <div >
        <!-- Spinner Start -->
      
    

            <div >
                <div >
                    <div >
                        <h3 >Laporan Pembelian</h3>
                        <h3 >Periode <?php  echo"$tanggal_awal_string";?> &nbsp;<?php echo"S/d"?>&nbsp; <?php  echo" $tanggal_akhir_string" ?></h3>                                                        

                        <!-- <a href="">Show All</a> -->
                    </div>
                    <div class="table-responsive">
                    <table border="1" id="exportopname" width="100%" cellspacing="0" cellpadding="5" style="text-align:center">
                                                    <thead>
                                                        <tr>
                                                            <th  scope="col" style="width: 60px;">No</th>
                                                            <th scope="col" style="width: 150px;">Tgl Transaksi</th>
                                                            <th scope="col" style="width: 150px;">Nota</th>
                                                            <th scope="col" style="width: 150px;">Kode Barang</th>
                                                            <th scope="col" style="width: 80px;">masuk</th>
                                                            <th scope="col " style="width: 200px;">Deskripsi</th>



                                                    </thead>

                                                    <tbody style="text-align:center">
                                                        <?php
                                                        // Proses hasil query untuk membuat laporan
                                                        $i=1;
                                                        if (mysqli_num_rows($result) > 0) {
                                                            // Buat laporan
                                                            ?>
                                                         
                                                               
                                                        
                                                            <?php
    

                                                            



                                                           ?>
                                                           <?php
                                                               
                                                         
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo '<tr style="text-align:center">';
                                                                echo "<td>" . $i++ . "</td>";
                                                                echo "<td>" . $row['tgltransaksi'] . "</td>";
                                                                echo '<td style="text-align:left">' . $row['nota'] . "</td>";
                                                                echo '<td style="text-align:left">' . $row['kodeb'] .' - '. $row['namab'] . "</td>";
                                                                echo "<td>" . $row['masuk'] . "</td>";
                                                                echo '<td style="text-align:left">' . $row['deskripsi'] . "</td>";


                                                                echo "</tr>";
                                                            }
                                                        } else {
                                                            echo "Tidak ada data transaksi dalam periode ini.";
                                                        }

                                                        ?>
                                            </div>
                                        </div>
                                    </div>





                                    <?php


                                    ?>
                                    </tbody>
                                    </table>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <!-- JavaScript Libraries -->


    <!-- Template Javascript -->
    <script src="js/main.js"></script>
 




</body>

</html>














  