<?php 
    include 'koneksi.php';
    session_start();

    // LOGIN
    $data = mysqli_query($db,"select * from admin");
    $user = mysqli_fetch_array($data);

    // cek apakah tombol daftar sudah diklik atau blum?
    if(isset($_POST['tambah'])){

        // ambil data dari formulir
        $catatan = $_POST['catatan'];

        // buat query
        $sql = "INSERT INTO note (catatan) VALUE ('$catatan')";
        $query = mysqli_query($db, $sql);

        // apakah query simpan berhasil?
        if( $query ) {
            // kalau berhasil alihkan ke halaman index.php dengan status=sukses
            header('Location: halaman_admin.php?status=sukses');
        } else {
            // kalau gagal alihkan ke halaman indek.php dengan status=gagal
            header('Location: halaman_admin.php?status=gagal');
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
            <a href="#about" class="active">Notes</a>
            <a href="stock-barang.php">Stock Barang</a>
            <button class="dropdown-btn">Transaksi Data<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
                <a href="barang-masuk.php">Barang Masuk / Kembali</a>
                <a href="#">Barang Keluar</a>
            </div>
            <a href="logout.php">Logout</a>
        </div>
    <!-- END -->

    <!-- CONTENT -->
        <div class="content btn-info">
            <div class="box-content">
                <h3>Notes</h3>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Catatan</th>
                            <th>Ditulis oleh</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <form action="" method="POST" id="form-catatan">
                                    <input name="catatan" type="text" id="catatan" autocomplete="off">
                            </td>
                            <td>
                                <p>Saya, <?php echo $_SESSION['username'] ?></p>
                            </td>
                            <td>
                                    <input name="tambah" type="submit" id="submit" class="btn-primary" value="Add note">
                                </form>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $ambil = $db->query("SELECT admin.id,nama,catatan FROM admin INNER JOIN note");
                            while($d = mysqli_fetch_array($ambil)){
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['catatan'] ?></td>
                                        <td><?php echo $d['nama'] ?></td>
                                        <td><?php echo "<a class='edit' href='edit.php?id=".$d['id']."'>Hapus</a>" ?></td>
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