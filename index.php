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
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mendapatkan data
$sql = "SELECT * FROM penduduk";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        h2 {
            color: #408080;
            font-weight: 700;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #00a2a2;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            table,
            th,
            td {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Data Penduduk</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Kecamatan</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Luas (km²)</th>
                        <th>Jumlah Penduduk</th>
                        <th>Aksi</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["kecamatan"] . "</td>
                        <td>" . $row["longitude"] . "</td>
                        <td>" . $row["latitude"] . "</td>
                        <td>" . $row["luas"] . "</td>
                        <td>" . $row["jumlah_penduduk"] . "</td>
                        <td> 
                            <button class='btn btn-danger btn-sm' onclick='deleteData(" . $row["id"] . ")'>Hapus</button> 
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='text-align: center;'>Tidak ada data yang ditemukan.</p>";
        }
        $conn->close();
        ?>
    </div>

    <script>
        function deleteData(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                fetch('delete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + encodeURIComponent(id),
                })
                .then(response => response.text())
                .then(result => {
                    alert(result);
                    location.reload(); // Refresh halaman setelah penghapusan
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menghapus data!');
                });
            }
        }
    </script>
</body>

</html>
