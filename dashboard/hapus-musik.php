<?php
require "../functions/functions.php";

$id = $_GET["id"];


if( hapus("music", $id) > 0) {
    echo "<script> alert('Berhasil Terhapus');
    window.location.href = 'musik-dashboard.php';</script>";
} else {
    echo "<script> alert('Gagal Terhapus');
    window.location.href = 'musik-dashboard.php';</script>";
}

?>