<?php

$koneksi = mysqli_connect("localhost", "root", "", "phpdasar");

function tampildata($tampil){
    global $koneksi;
    $hasil = mysqli_query($koneksi, $tampil);
    $rows = [];
    while ($row = mysqli_fetch_assoc($hasil) ) {
        $rows [] = $row;
    }
    return $rows;
}

function tambah($data){
    global $koneksi;

    $nama = $data["nama"];
    $npm = $data["npm"];
    $email = $data["email"];
    $jurusan = $data["jurusan"];
    $gambar = $data["gambar"];

    // upload gambar
    $gambar = upload();

    if( !$gambar ){
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES
            ('','$nama','$npm','$email','$jurusan','$gambar')
            ";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function upload(){
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah ada gambar yang di upload

    if ( $error === 4 ){
        echo "
            <script>
                alert('Upload gambar terlebih dahulu');
                document.location.href = 'tambah.php';
            </script>
        ";
        return false;
    }

    //cek apakah yang di upload itu gambar
    $ekstensigambarValid = ['jpg', 'png', 'jpeg'];
    //mengambil extensi dari gambar yang di upload
    $extensiGambar = explode('.', $namafile);
    $extensiGambar = strtolower(end($extensiGambar));

    if ( !in_array($extensiGambar, $ekstensigambarValid)){
        echo "
            <script>
                alert('Hanya boleh mengupload file gambar (jpg. jpeg. png)');
                document.location.href = 'tambah.php';
            </script>
        ";
        return false;
    }

    //cek jika ukurannya terlalu besar
    if ($ukuranfile > 10000000){
        echo "
            <script>
                alert('Ukuran gambar terlalu besar');
                document.location.href = 'tambah.php';
            </script>
        ";
        return false;
    }

    //buat nama baru
    $namafileBaru = uniqid();
    $namafileBaru .= '.';
    $namafileBaru .= $extensiGambar;

    //jika lolos gambar bisa diupload
    move_uploaded_file($tmpName, 'img/' . $namafileBaru);
    return $namafileBaru;

}

function hapus($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($koneksi);
}

function ubah($data){
    global $koneksi;

    $id = $data["id"];
    $nama = $data["nama"];
    $npm = $data["npm"];
    $email = $data["email"];
    $jurusan = $data["jurusan"];

    //ambil gambar Lama
    $gambarLama = $data["gambarLama"];

    //cek apakah user pencet upload
    if($_FILES['gambar']['error'] ===4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET

            nama = '$nama',
            npm = '$npm',
            email = '$email',
            jurusan = '$jurusan',
            gambar = '$gambar'

            WHERE id = $id
    
            ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function cari($kata){
    $query = "SELECT * FROM mahasiswa
        WHERE 
        npm LIKE '%$kata%' or
        nama like '%$kata%'
        ";
    return tampildata($query);
}

?>