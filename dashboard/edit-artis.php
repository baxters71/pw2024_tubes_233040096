<?php 

require "../functions/functions.php";
$id = $_GET["id"];

$artis = query("SELECT * FROM artis WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    if(ubah_artis($_POST) > 0) {
        echo "<script> alert('Berhasil mengubah');
                        window.location.href = 'artis-dashboard.php';</script>";
    } else {
        echo "<script> alert('Gagal mengubah');
        window.location.href = 'adit-artis.php';</script>";
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
    <h1>Artis Dashboard</h1>
    <a href="artis-dashboard.php"><button class="btn btn-success mb-2">Back</button></a>
    <div class="tbl-content d-flex flex-column justify-content-center align-items-center">
      <form action="" method="post" enctype="multipart/form-data">
        <label>
          Nama Artis
          <input type="text" name="nama_artis" autocomplete="off" value="<?= $artis["nama_artis"]; ?>" required>
        </label>
        <input type="hidden" name="id" value="<?= $artis["id"]; ?>">
        <button name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>

</html>