<?php
require "../functions/functions.php";

$id = $_GET["id"];

if( hapus("artis", $id) > 0) {
    echo "<script> alert('Berhasil Terhapus');
    window.location.href = 'artis-dashboard.php';</script>";
} else {
    echo "<script> alert('Gagal Terhapus');
    window.location.href = 'artis-dashboard.php';</script>";
}

?>