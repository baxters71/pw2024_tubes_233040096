<?php

function koneksi()
{
    $conn = mysqli_connect('localhost','root', '', 'pw2024_tubes_233040096');
return $conn;
}

function search($keyword) {
    $query = "SELECT * FROM music JOIN artis ON artis_id = artis.id JOIN kategori ON kategori_id = kategori.id
                WHERE nama_music 
                LIKE '%$keyword%' 
                OR nama_artis
                LIKE '%$keyword%'
                OR nama_kategori
                LIKE '%$keyword%'
    ";

    return query($query);
}

function query($query) {
    $conn = koneksi();
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// funtion tambah

function tambah_musik($data) {
    $conn = koneksi();
    // ambil data dari tiap elemen dalam form
    $nama_musik = htmlspecialchars($data["nama_musik"]);
    $nama_artis = htmlspecialchars($data["artis_id"]);
    $nama_kategori = htmlspecialchars($data["kategori_id"]);

    //Upload audio
    $audio = upload("audio", "../audio/", "mp3", "wma", "wav", "Yang anda upload bukan audio!");
    if(!$audio) {
        return false;
    }

    //Upload gambar
    $gambar = upload("gambar", "../img/", "../audio/", "jpg", "jpeg", "png", "Yang anda upload bukan gambar!");
    if(!$audio) {
        return false;
    }

    //  query insert data
    $query = "INSERT INTO music (nama_music, artis_id, kategori_id, audio, gambar)
                VALUES
                ('$nama_musik', '$nama_artis', '$nama_kategori', '$audio', '$gambar')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambah_artis($data) {
    $conn = koneksi();
    // ambil data dari tiap elemen dalam form
    $nama_artis = htmlspecialchars($data["nama_artis"]);

    //  query insert data
    $query = "INSERT INTO artis (nama_artis)
                VALUES
                ('$nama_artis')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambah_kategori($data) {
    $conn = koneksi();
    // ambil data dari tiap elemen dalam form
    $nama_kategori = htmlspecialchars($data["nama_kategori"]);

    //  query insert data
    $query = "INSERT INTO kategori (nama_kategori)
                VALUES
                ('$nama_kategori')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($tabel, $id) {
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM $tabel WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah_artis($data) {
    $conn = koneksi();
    // ambil data dari tiap elemen dalam form
    
    $id = $data["id"];
    $nama_artis = htmlspecialchars($data["nama_artis"]); 

    //  query update data
    $query = "UPDATE artis SET
                nama_artis = '$nama_artis'
            WHERE id = $id 
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah_kategori($data) {
    $conn = koneksi();
    // ambil data dari tiap elemen dalam form
    
    $id = $data["id"];
    $nama_kategori = htmlspecialchars($data["nama_kategori"]); 

    //  query update data
    $query = "UPDATE kategori SET
                nama_kategori = '$nama_kategori'
            WHERE id = $id 
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah_musik($data) {
    $conn = koneksi();
    // ambil data dari tiap elemen dalam form

    $id = $data["id"];
    $nama_musik = htmlspecialchars($data["nama_musik"]);
    $nama_artis = htmlspecialchars($data["artis_id"]);
    $nama_kategori = htmlspecialchars($data["kategori_id"]);
    $audio_lama = htmlspecialchars($data["audio_lama"]);
    $gambar_lama = htmlspecialchars($data["gambar_lama"]);

    // Cek apakah user pilih audio baru atau tidak
    if( $_FILES['audio']['error'] === 4) {
        $audio = $audio_lama;
    } else {
        $audio = upload("audio", "../audio/", "mp3", "wma", "wav", "Yang anda upload bukan audio!");
    }
    
    // Cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4) {
        $gambar = $gambar_lama;
    } else {
        $gambar = upload("gambar", "../img/", "jpg", "jpeg", "png", "Yang anda upload bukan gambar!");
    }

    //  query update data
    $query = "UPDATE music SET
                nama_music = '$nama_musik',
                artis_id = '$nama_artis',
                kategori_id = '$nama_kategori',
                audio = '$audio',
                gambar = '$gambar'
            WHERE id = $id 
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload($nama, $folder, $file1, $file2, $file3, $text) {
    $namaFile = $_FILES[$nama]['name'];
    $ukuranFile = $_FILES[$nama]['size'];
    $error = $_FILES[$nama]['error'];
    $tmpName = $_FILES[$nama]['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if( $error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = [$file1, $file2, $file3];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert($text);
            </script>";
        return false;
    }

    // Cek jika ukurannya terlalu besar
    if( $ukuranFile > 100000000) {
        echo "<script>
                alert('Ukuran file terlalu besar!');
            </script>";
        return false;
    }

    // Generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // Lolos pengecekan, gambar siap diupload
    move_uploaded_file($tmpName, $folder . $namaFileBaru);

    return $namaFileBaru;
}
?>