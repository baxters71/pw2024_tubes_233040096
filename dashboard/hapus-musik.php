<?php
require "../functions/functions.php";

$id = $_GET["id"];

if( hapus($id) > 0) {
    echo "<script> alert('Berhasil Terhapus')</script>";
    header("location: musik-dashboard.php");
    exit;
} else {
    echo "<script> alert('Gagal Terhapus')</script>";
    header("location: musik-dashboard.php");
    exit;
}

?>