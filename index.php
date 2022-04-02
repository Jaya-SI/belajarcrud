<?php

require 'function.php';

$mahasiswa = tampildata("SELECT * FROM mahasiswa");

if(isset($_POST["cari"])){
    $mahasiswa = cari($_POST["kata"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan | Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <a href="tambah.php">
        Tambah Data
    </a>
    <br>
    <br>
    <form action="" method="post">
        <input type="text" name="kata">
        <button type="submit" name="cari">Cari Mahasiswa</button>
    </form>
    <br>
    <br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        <?php $i=1; ?>
        <?php foreach($mahasiswa as $mhs) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="hapus.php?id=<?= $mhs["id"]; ?>" onclick="return confirm('Yakin ?');">Hapus</a> |
                <a href="ubah.php?id=<?= $mhs["id"]; ?>">Ubah</a>
            </td>
            <td>
                <img src="img/<?= $mhs["gambar"]; ?>" width="100px">
            </td>
            <td><?= $mhs["npm"]; ?></td>
            <td><?= $mhs["nama"]; ?></td>
            <td><?= $mhs["email"]; ?></td>
            <td><?= $mhs["jurusan"]; ?></td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>
</body>
</html>