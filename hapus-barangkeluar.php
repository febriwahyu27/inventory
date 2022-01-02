<?php
    include 'koneksi.php';
    $id = (int) $_GET['id'];
    
    if( $id ){
        $sql = "DELETE FROM barang_keluar WHERE id_out='{$id}'";
        $query = mysqli_query($db, $sql);
    }
    header('Location: index.php');
    exit;
?>