<?php
// Konfigurasi MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_8";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari request POST
$id = isset($_POST['id']) ? $_POST['id'] : '';

if ($id) {
    // Query untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM penduduk WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan!";
}

$conn->close();
?>
