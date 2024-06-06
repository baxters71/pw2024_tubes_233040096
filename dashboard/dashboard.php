<?php 

require "../functions/functions.php";
$musics = query("SELECT * FROM music JOIN artis ON artis_id = artis.id JOIN kategori ON kategori_id = kategori.id");
$artis = query("SELECT * FROM artis");
$kategori = query("SELECT * FROM kategori");

if (isset($_POST["submit"])) {
    if(tambah_musik($_POST) > 0) {
        echo "<script> alert('Berhasil menambahkan')</script>";
    } else {
        echo "<script> alert('Gagal menambahkan')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/musik-dashboard.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<section>
  <?php require "../layouts/navbar.php"; ?>
  
  <div class="row d-flex justify-content-center gap-5">
    <a class="d-block col-3 text-decoration-none" href="musik-dashboard.php">
        <div class="card p-2 4 justify-content-center" style="width: 23rem;">
                <div class="card-body">
                    <h5 class="card-title">Musik</h5>
                </div>
        </div>
    </a>
    <a class="d-block col-3 text-decoration-none" href="">
        <div class="card p-2 4 justify-content-center" style="width: 23rem;">
                <div class="card-body">
                    <h5 class="card-title">Artis</h5>
                </div>
        </div>
    </a>
    <a class="d-block col-3 text-decoration-none" href="">
        <div class="card p-2 4 justify-content-center" style="width: 23rem;">
                <div class="card-body">
                    <h5 class="card-title">Kategori</h5>
                </div>
        </div>
    </a>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>