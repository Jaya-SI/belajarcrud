<?php 

include 'function.php';
$id = $_GET["id"];

$mhs = tampildata("SELECT * FROM mahasiswa WHERE id = $id")[0];

if( isset($_POST["submit"])){

    if(ubah($_POST)>0){
        echo "
        <script>
            alert('Data berhasil di ubah');
            document.location.href= 'index.php'
        </script>
        ";
    }else {
        echo "
        <script>
            alert('Data tidak bisa di ubah');
            document.location.href= 'index.html';
        </script>
        ";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data | Mahasiswa</title>
</head>
<body>
    <h1>Ubah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" value="<?= $mhs["nama"]; ?>">
            </li>
            <li>
                <label for="npm">NPM : </label>
                <input type="text" name="npm" id="npm" value="<?= $mhs["npm"]; ?>">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" value="<?= $mhs["email"]; ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label> <br>
                <img src="img/<?= $mhs['gambar']; ?>" width="100px"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
        </ul>
        <button type="submit" name="submit">Ubah Data</button>
    </form>
</body>
</html>