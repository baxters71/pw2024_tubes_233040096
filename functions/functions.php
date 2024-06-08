<?php

function koneksi()
{
    $conn = mysqli_connect('localhost','root', '', 'pw2024_tubes_233040096');
return $conn;
}

function search($keyword) {
    $query = "SELECT * from music JOIN artis ON artis_id = artis.id
                WHERE nama_music 
                LIKE '%$keyword%' 
                OR nama_artis
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

function hapus($id) {
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM music WHERE id = $id");

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

    // Cek apakah user pilih gambar baru atau tidak
    if( $_FILES['audio']['error'] === 4) {
        $audio = $audio_lama;
    } else {
        $audio = upload("audio", "../audio/", "mp3", "wma", "wav", "Yang anda upload bukan audio!");
    }

    if( $_FILES['gambar']['error'] === 4) {
        $gambar = $gambar_lama;
    } else {
        $gambar = upload("gambar", "../img/", "../audio/", "jpg", "jpeg", "png", "Yang anda upload bukan gambar!");
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

function cari($keyword) {
    $query = "SELECT * FROM mahasiswa
                WHERE
                nama LIKE '%$keyword%' OR
                nama LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
    ";

    return query($query);
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

function registrasi($data) {
    $conn = koneksi();

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script>
                alert('konfirmasi password tidak sesuai')
                </script>";
        return false;
    } 

    // Cek username sudah terdaftar atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar!')
                </script>";
        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users(username, password) VALUES ('$username', '$password')");

    return mysqli_affected_rows($conn);

}
?>


