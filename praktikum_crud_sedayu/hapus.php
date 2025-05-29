<?php
// Include file koneksi database
include_once("config.php");

// Cek apakah ada ID yang dikirimkan
if(isset($_GET['id_Motor'])) {
    $id_Motor = $_GET['id_Motor'];
    
    // Query untuk menghapus data
    $result = mysqli_query($conn, "DELETE FROM motor WHERE id_Motor='$id_Motor'");
    
    // Redirect ke halaman utama
    header("Location: index.php");
} else {
    // Jika tidak ada ID yang dikirimkan, kembali ke halaman utama
    header("Location: index.php");
}
?>