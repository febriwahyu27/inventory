<?php 
    if ($_POST['Submit'] == "Submit") {
        $id_brg =$_POST['id_brg'];
        $tanggal  =$_POST['tanggal'];
        $jumlah =$_POST['jumlah'];
        $ukuran =$_POST['ukuran'];
        $penerima =$_POST['penerima'];
        $keterangan =$_POST['keterangan'];
        
        include "koneksi.php";    
        $selSto =mysqli_query($db, "SELECT * FROM stock_barang WHERE id='$id_brg'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stock'];
        //menghitung sisa stok
        $sisa    =$stok-$jumlah;
        
        if ($jumlah < $stok) {
            $insert =mysqli_query($db, "INSERT INTO barang_keluar (id_brg, tanggal, jumlah, ukuran, penerima, keterangan) VALUES ('$id_brg', '$tanggal', '$jumlah', '$ukuran', '$penerima', '$keterangan')");
            if($insert){
                //update stok
                $upstok= mysqli_query($db, "UPDATE stock_barang SET stock='$sisa' WHERE id='$id_brg'");
                ?>
                <script language="JavaScript">
                    alert('Good! Input transaksi pengeluaran barang berhasil ...');
                    document.location='barang-keluar.php';
                </script>
                <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
            }
        }
        //proses    
        elseif($jumlah > $stok){
            ?>
            <script language="JavaScript">
                alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
                document.location='barang-keluar.php';
            </script>
            <?php
        }
?>