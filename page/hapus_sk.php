<?php 
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}
    require '../functions_sk.php'; 
    $id = $_GET["id"];
    
    if (hapus($id) > 0) {
        echo " <script> 
                alert('Data berhasil dihapus');
                document.location.href = '../admin/surat_keluar.php'; 
            </script>";
        }else {
            echo " <script> 
            alert('Data gagal dihapus!');
            document.location.href = '../admin/surat_keluar.php'; 
        </script>";
        }
    
?>