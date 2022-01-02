<?php include 
    'koneksi.php';
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
                <a href="#" class="active">Barang Masuk / Kembali</a>
                <a href="barang-keluar.php">Barang Keluar</a>
            </div>
            <a href="logout.php">Logout</a>
        </div>
    <!-- END -->

    <!-- CONTENT -->
        <div class="content btn-info">
            <div class="box-content">
                <h3>Daftar Barang Masuk</h3>

                <!-- Button trigger modal -->
                <button id="btn-modal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah
                </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Input Barang Masuk</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses-barangMasuk.php" method="POST" id="form-transaksi">
                                        <table>
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
                                            <tr>
                                                <td>Keterangan</td>
                                                <td><input type="text" name="keterangan" maxlength="20" required /></td>
                                            </tr>
                                            <tr height="36">
                                                <td></td>
                                                <td><input class="btn-primary" type="submit" name="Submit" value="Submit"/> <input type="reset" value="Reset"/></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- END -->

                <input type="text" id="cari" placeholder="Cari">
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
                            $no = 1;
                            $sql = "SELECT stock_barang.id, stock_barang.nama, stock_barang.jenis, stock_barang.merk, stock_barang.ukuran, barang_masuk.jumlah, barang_masuk.keterangan, barang_masuk.tanggal FROM stock_barang INNER JOIN barang_masuk ON stock_barang.id = barang_masuk.id_brg";
                            $query = mysqli_query($db, $sql);

                            while($barang_masuk = mysqli_fetch_array($query)){
                                echo "<tr>";

                                echo "<td>".$no++."</td>";
                                echo "<td>".$barang_masuk['tanggal']."</td>";
                                echo "<td>".$barang_masuk['nama']."</td>";
                                echo "<td>".$barang_masuk['jenis']."</td>";
                                echo "<td>".$barang_masuk['merk']."</td>";
                                echo "<td>".$barang_masuk['ukuran']."</td>";
                                echo "<td>".$barang_masuk['jumlah']."</td>";
                                echo "<td>".$barang_masuk['keterangan']."</td>";

                                echo "<td>";
                                echo "<a class='edit' href='form-edit.php?id=".$barang_masuk['id']."'>Edit</a> | ";
                                echo "<a class='hapus' href='hapus-barangmasuk.php?id=".$barang_masuk['id']."'>Hapus</a>";
                                echo "</td>";

                                echo "</tr>";
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