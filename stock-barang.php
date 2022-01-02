<?php 
    include 'koneksi.php';
    session_start();

    if(isset($_POST['tambah'])){

        // ambil data dari formulir
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $merk = $_POST['merk'];
        $ukuran = $_POST['ukuran'];
        $stock = $_POST['stock'];
        $satuan = $_POST['satuan'];
        $lokasi = $_POST['lokasi'];

        // buat query
        $sql = "INSERT INTO stock_barang (nama, jenis, merk, ukuran, stock, satuan, lokasi) VALUE ('$nama', '$jenis', '$merk', '$ukuran', '$stock', '$satuan', '$lokasi')";
        $query = mysqli_query($db, $sql);

        // apakah query simpan berhasil?
        if( $query ) {
            // kalau berhasil alihkan ke halaman index.php dengan status=sukses
            header('Location: stock-barang.php?status=sukses');
        } else {
            // kalau gagal alihkan ke halaman indek.php dengan status=gagal
            header('Location: stock-barang.php?status=gagal');
        }
    }

    // HAPUS
    if( isset($_GET['id']) ){

        // ambil id dari query string
        $id = $_GET['id'];
    
        // buat query hapus
        $sql = "DELETE FROM stock_barang WHERE id=$id";
        $query = mysqli_query($db, $sql);
    
        // apakah query hapus berhasil?
        if( $query ){
            header('Location: stock-barang.php');
        } else {
            die("gagal menghapus...");
        }
    
    }
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
            <a href="stock-barang.php" class="active">Stock Barang</a>
            <button class="dropdown-btn">Transaksi Data<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
                <a href="barang-masuk.php">Barang Masuk / Kembali</a>
                <a href="barang-keluar.php">Barang Keluar</a>
            </div>
            <a href="logout.php">Logout</a>
        </div>
    <!-- END -->

    <!-- CONTENT -->
        <div class="content btn-info" style="height: 100vh">
            <div class="box-content">
                <h3>Daftar Barang</h3>
                <!-- Button trigger modal -->
                <button id="btn-modal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah
                </button>

                <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        <table>
                                            <tr>
                                                <td>Nama Barang</td>
                                                <td><input name="nama" type="text"></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis</td>
                                                <td><input name="jenis" type="text"></td>
                                            </tr>
                                            <tr>
                                                <td>Merk</td>
                                                <td><input type="text" name="merk" maxlength="32" required /></td>
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td>ukuran</td>
                                                <td><input type="text" name="ukuran" maxlength="20" required /></td>
                                            </tr>
                                            <tr>
                                                <td>Stock</td>
                                                <td><input type="text" name="stock"></td>
                                            </tr>
                                            <tr>
                                                <td>Satuan</td>
                                                <td><input type="text" name="satuan"></td>
                                            </tr>
                                            <tr>
                                                <td>Lokasi</td>
                                                <td><input type="text" name="lokasi"></td>
                                            </tr>
                                            <tr height="36">
                                                <td></td>
                                                <td><input class="btn-primary" type="submit" name="tambah" value="Submit"/> <input type="reset" value="Reset"/></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- END -->
                <input type="text" id="cari">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Merk</th>
                            <th>Ukuran</th>
                            <th>Stock</th>
                            <th>Satuan</th>
                            <th>Lokasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $sql = "SELECT * FROM stock_barang";
                            $query = mysqli_query($db, $sql);

                            while($stock = mysqli_fetch_array($query)){
                                echo "<tr>";

                                echo "<td>".$no++."</td>";
                                echo "<td>".$stock['nama']."</td>";
                                echo "<td>".$stock['jenis']."</td>";
                                echo "<td>".$stock['merk']."</td>";
                                echo "<td>".$stock['ukuran']."</td>";
                                echo "<td>".$stock['stock']."</td>";
                                echo "<td>".$stock['satuan']."</td>";
                                echo "<td>".$stock['lokasi']."</td>";

                                echo "<td>";
                                echo "<a class='edit' href='form-edit.php?id=".$stock['id']."'>Edit</a> | ";
                                echo "<a class='hapus' href='stock-barang.php?id=".$stock['id']."'>Hapus</a>";
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