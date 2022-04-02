<?php

require 'function.php';
$id = $_GET["id"];

if (hapus($id)>0){
    echo "
        <script>
            alert('Data mahasiswa berhasil dihapus');
            document.location.href ='index.php'
        </script>
        ";
} else {
    echo "
        <script>
            alert('Data mahasiswa tidak bisa dihapus');
            document.location.href ='index.php'
        </script>
        ";
}

?>