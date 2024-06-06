
<?php 

require "function.php";
$musics=query("select * from music join artis on id_artis = artis.id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <script src="fontawesome/all.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<div class="search">
        <form action="" method="post">
            <input type="text" name="" placeholder="search"> 
            <!-- <button type="hidden" name="search"></button> -->
        </form>
    </div>

</html>

