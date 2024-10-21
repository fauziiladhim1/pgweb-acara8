<?php
// Pastikan semua data POST tersedia
$kecamatan = isset($_POST['kecamatan']) ? $_POST['kecamatan'] : '';
$longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';
$latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
$luas = isset($_POST['luas']) ? $_POST['luas'] : '';
$jumlah_penduduk = isset($_POST['jumlah_penduduk']) ? $_POST['jumlah_penduduk'] : '';

// Cek apakah semua field sudah diisi
if (empty($kecamatan) || empty($longitude) || empty($latitude) || empty($luas) || empty($jumlah_penduduk)) {
    die("<div class='error'>Semua field harus diisi! <a href='index.html'>Kembali ke Form</a></div>");
}

// Konfigurasi MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_8";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk memasukkan data
$sql = "INSERT INTO penduduk (kecamatan, longitude, latitude, luas, jumlah_penduduk) 
        VALUES ('$kecamatan', $longitude, $latitude, $luas, $jumlah_penduduk)";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Penduduk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            color: #408080;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 15px;
            background-color: #408080;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #408080;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if ($conn->query($sql) === TRUE) {
            echo "<h2>Data berhasil ditambahkan!</h2>";
        } else {
            echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
        $conn->close();
        ?>
        <a href="index.html" class="button">Kembali ke Form</a>
        <a href="index.php" class="button">Lihat Data Penduduk</a>
    </div>
</body>
</html>
