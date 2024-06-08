<?php 

require "../functions/functions.php";
$musics=query("SELECT * FROM music JOIN artis on artis_id = artis.id JOIN kategori ON kategori.id = kategori_id");

if(isset($_POST["search"])) {
    $musics = search($_POST["keyword"]);
    var_dump($musics);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <script src="fontawesome/all.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require "../layouts/navbar.php"; ?>

    

    <div class="container d-flex flex-column justify-content-center">
        <div class="search mt-5 mb-5">
            <form action="" method="post">
                <input type="text" name="keyword" size="40" placeholder="search.." autocomplete="off" id="keyword">
                <input type="hidden" class="search" name="search" id="tombol-cari"></input>
            </form>
        </div>

        <div class="row d-flex justify-content-center gap-5">
            <?php foreach($musics as $msc) : ?>
            <div class="card p-2 col-3 justify-content-center" style="width: 23rem;">
                <img src="../img/<?= $msc["gambar"]; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $msc["nama_music"] ?></h5>
                    <div class="text d-flex justify-content-between">
                        <p><?= $msc["nama_artis " ]; ?></p>
                        <p><?= $msc["nama_kategori " ]; ?></p>
                    </div>
                    <div class="audio d-flex justify-content-center">
                        <audio controls >
                            <source src="../audio/<?= $msc["audio"] ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
            </div>
            <?php endforeach ; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
    
    
</html>
