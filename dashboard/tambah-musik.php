<?php 

require "../functions/functions.php";
$musics = query("SELECT * FROM music JOIN artis ON artis_id = artis.id JOIN kategori ON kategori_id = kategori.id");
$artis = query("SELECT * FROM artis");
$kategori = query("SELECT * FROM kategori");

if (isset($_POST["submit"])) {
    if(tambah_musik($_POST) > 0) {
      echo "<script> alert('Berhasil menambahkan');
      window.location.href = 'musik-dashboard.php';</script>";
    } else {
      echo "<script> alert('Gagal menambahkan');
      window.location.href = 'musik-dashboard.php';</script>";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <section>
    <?php require "../layouts/navbar.php"; ?>
    <!--for demo wrap-->
    <h1>Musik Dashboard</h1>
    <a href="musik-dashboard.php"><button class="btn btn-success mb-2">Back</button></a>
    <div class="tbl-content d-flex flex-column justify-content-center align-items-center">
      <form action="" method="post" enctype="multipart/form-data">
        <label>
          Nama Musik
          <input type="text" name="nama_musik" autocomplete="off">
        </label>
        <label class="artis mb-2 d-flex justify-content-between">
          Artis
          <select name="artis_id" id="category" required>
            <?php foreach($artis as $arts) : ?>
            <option value="<?= $arts["id"]; ?>"><?= $arts["nama_artis"]; ?></option>
            <?php endforeach ; ?>
          </select>
        </label>
        <label class="d-flex justify-content-between">
          Genre Musik
          <select name="kategori_id" id="category" required>
            <?php foreach($kategori as $ktg) : ?>
            <option value="<?= $ktg["id"]; ?>"><?= $ktg["nama_kategori"]; ?></option>
            <?php endforeach ; ?>
          </select>
        </label>
        <label>
          File Musik
          <input class="file" type="file" name="audio">
        </label>
        <label>
          File Gambar
          <input class="file" type="file" name="gambar">
        </label>
        <button name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>

</html>