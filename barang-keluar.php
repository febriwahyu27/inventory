<?php 
    include 'koneksi.php';

    session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- MY CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Inventory</title>
  </head>
  <body>
    <!-- NAVBAR -->
        <nav>
            <div class="menu-btn">
                <hr>
                <hr>
                <hr>
            </div>
            <h3>Hi, <?php echo $_SESSION['username'] ?></h3>
            <h4><?php echo date('l, d-m-Y'); ?></h4>
        </nav>
    <!-- END -->

    <!-- MENU -->
        <div class="menu">
            <h4>FEBRI'S LAB</h4>
            <a href="halaman_admin.php">Notes</a>
            <a href="stock-barang.php">Stock Barang</a>
            <button class="dropdown-btn">Transaksi Data<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
                <a href="barang-masuk.php">Barang Masuk / Kembali</a>
                <a href="#" class="active">Barang Keluar</a>
            </div>
            <a href="logout.php">Logout</a>
        </div>
    <!-- END -->

    <!-- CONTENT -->
        <div class="content btn-info" style="height: 100vh">
            <div class="box-content">
                <h3>Daftar Barang Keluar</h3>

                <!-- Button trigger modal -->
                    <button id="btn-modal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input Barang Keluar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="proses-barangKeluar.php" method="POST" id="form-transaksi">
                                <table border="0">
                                    <tr>
                                        <td>Tanggal</td>
                                        <td><input name="tanggal" type="date"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Barang</td>
                                        <td>
                                            <?php
                                            $selBar    =mysqli_query($db, "SELECT * FROM stock_barang ORDER BY nama");        
                                            echo '<select name="id_brg" required>';    
                                            echo '<option value="">...</option>';    
                                            while ($rowbar = mysqli_fetch_array($selBar)) {    
                                            echo '<option value="'.$rowbar['id'].'">'.$rowbar['nama'].'</option>';    
                                            }    
                                            echo '</select>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td><input type="text" name="jumlah" maxlength="32" required /></td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran</td>
                                        <td><input type="text" name="ukuran" maxlength="11" required /></td>
                                    </tr>
                                    <tr>
                                        <td>Penerima</td>
                                        <td><input type="text" name="penerima" maxlength="11" required /></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td><input type="text" name="keterangan" maxlength="11" required /></td>
                                    </tr>
                                    <tr height="36">
                                        <td></td>
                                        <td><input type="submit" name="Submit" value="Submit"/> <input type="reset" value="Reset"/></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                
                        </div> -->
                        </div>
                    </div>
                    </div>
                <!-- END -->
                
                <form action="" method="GET">
                   <input name="cari" type="text" id="cari" placeholder="Cari" autocomplete="off"> 
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Merk</th>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
                        
                        // Jumlah data per halaman
                        $limit = 5;

                        $limitStart = ($page - 1) * $limit;
                                    
                        $SqlQuery = mysqli_query($db, "SELECT stock_barang.id, stock_barang.nama, stock_barang.jenis, stock_barang.merk, stock_barang.ukuran, barang_keluar.jumlah, barang_keluar.keterangan, barang_keluar.tanggal FROM stock_barang INNER JOIN barang_keluar ON stock_barang.id = barang_keluar.id_brg");

                        // CARI
                        if(isset($_GET['cari'])){
                            $SqlQuery = mysqli_query($db, "SELECT * FROM stock_barang INNER JOIN barang_keluar ON stock_barang.id = barang_keluar.id_out  WHERE nama LIKE '%". $_GET['cari']."%'");
                        }
                        
                        $no = $limitStart + 1;
                        
                        while($row = mysqli_fetch_array($SqlQuery)){ 
                        ?>
                            <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['jenis']; ?></td>
                            <td><?php echo $row['merk']; ?></td>
                            <td><?php echo $row['ukuran']; ?></td>
                            <td><?php echo $row['jumlah']; ?></td>
                            <td><?php echo $row['keterangan']; ?></td>
                            <td><?php echo "<a class='edit' href='edit-siswa.php?id=".$row['id']."'>Edit</a> | <a class='hapus' href='hapus-barangkeluar.php?id=".$row['id']."'>Hapus</a>"; ?></td>
                            </tr>
                        <?php           
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    <!-- END -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="assets/js/script.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>