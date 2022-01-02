<?php 
    if ($_POST['Submit'] == "Submit") {
        $id_brg =$_POST['id_brg'];
        $tanggal  =$_POST['tanggal'];
        $jumlah =$_POST['jumlah'];
        $keterangan =$_POST['keterangan'];
        
        include "koneksi.php";    
        $selSto =mysqli_query($db, "SELECT * FROM stock_barang WHERE id='$id_brg'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['stock'];
        //menghitung sisa stok
        $sisa    =$stok+$jumlah;
        
        if ($stok > $jumlah) {
            $insert =mysqli_query($db, "INSERT INTO barang_masuk (id_brg, tanggal, jumlah, keterangan) VALUES ('$id_brg', '$tanggal', '$jumlah', '$keterangan')");
            if($insert){
                //update stok
                $upstok= mysqli_query($db, "UPDATE stock_barang SET stock='$sisa' WHERE id='$id_brg'");
                ?>
                <script language="JavaScript">
                    alert('Good! Input transaksi pengeluaran barang berhasil ...');
                    document.location='barang-masuk.php';
                </script>
                <?php
                }
                else {
                    echo "<div><b>Oops!</b> 404 Error Server.</div>";
                }
            }
        }
        //proses    
        else{
            ?>
            <script language="JavaScript">
                alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
                document.location='barang-masuk.php';
            </script>
            <?php
        }
?>