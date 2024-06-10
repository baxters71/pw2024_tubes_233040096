<?php 

require "../functions/functions.php";
$kategori = query("select * FROM kategori");

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
    <h1>Kategori Dashboard</h1>
    <a href="dashboard.php"><button class="btn btn-success mb-2">Back</button></a>
    <a href="tambah-kategori.php"><button class="btn btn-success mb-2">Tambah</button></a>
    <div class="tbl-header">
      <table cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kategori</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tbl-content">
      <table cellpadding="0" cellspacing="0" border="0">
        <tbody>
          <?php 
        $i = 1;
        foreach($kategori as $ktg) {?>
          <tr>
            <td><?= $i++; ?></td>
            <td><?= $ktg["nama_kategori"]; ?></td>
            <td>
              <a href="edit-kategori.php?id=<?= $ktg["id"]; ?>"><button type="button"
                  class="btn btn-primary">Edit</button></a>
              <a href="hapus-kategori.php?id=<?= $ktg["id"]; ?>" onclick="confirm('Apakah Anda Yakin?')"><button
                  type="button" class="btn btn-danger">Hapus</button></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>

</html>