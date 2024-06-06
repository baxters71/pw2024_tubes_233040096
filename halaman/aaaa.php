<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="card">
            <div class="header">
                <span class="action"><i class="fa fa-chevron-left"></i></span>
                <div class="playing">Play Music</div>
                <span class="action"><i class="fa fa-ellipsis-v"></i></span>
            </div>

            <div class="content">
                <figure class="album-cover">
                    <img src="../img/<?= $msc["gambar"] ?>" alt="">
                </figure>
                <div class="music-info">
                    <div class="song-name"><?= $msc["nama_music"] ?></div>
                    <div class="song-artist"><?= $msc["nama_artis"] ?></div>
                </div>
                <div class="timeline">
                    <audio controls>
                        <source src="../audio/<?= $msc["audio"] ?>" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                <div class="controls">
                    <span class="action random"><i class="fa fa-random"></i></span>
                    <span class="action previous"><i class="fa fa-step-backward"></i></span>
                    <span class="action play"><i class="fa fa-play"></i></span>
                    <span class="action next"><i class="fa fa-step-forward"></i></span>
                    <span class="action heart"><i class="fa fa-heart"></i></span>
                </div>
            </div>

            <div class="footer">
                <span class="action">
                    <i class="fa fa-angle-up"></i>
                    <div class="lyrics">lyrics</div>
                </span>
            </div>
        </div>
</body>
</html>