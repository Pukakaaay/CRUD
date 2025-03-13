<?php
require_once "../config/Database.php"; // Pakai require_once agar tidak error

$db = new Database();
$conn = $db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    
    // Upload foto pelanggan
    $foto = "";
    if (!empty($_FILES["foto"]["name"])) {
        $targetDir = "../public/uploads/";
        $foto = basename($_FILES["foto"]["name"]);
        $targetFilePath = $targetDir . $foto;

        // Cek apakah file berhasil diunggah
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
            // Foto berhasil diunggah
        } else {
            $foto = ""; // Kosongkan jika gagal upload
        }
    }

    // Masukkan data ke database
    $sql = "INSERT INTO pelanggan (NamaPelanggan, NomorTelepon, Alamat, Foto) VALUES (:nama, :telepon, :alamat, :foto)";
    $query = $conn->prepare($sql);
    $query->bindParam(":nama", $nama);
    $query->bindParam(":telepon", $telepon);
    $query->bindParam(":alamat", $alamat);
    $query->bindParam(":foto", $foto);

    if ($query->execute()) {
        echo "<script>alert('Pelanggan berhasil ditambahkan!'); window.location='index.php?page=list';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan pelanggan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggan Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="m-5">
    <h1>Tambah Pelanggan Baru</h1>
    <a href="index.php?page=list" class="btn btn-primary my-3">Kembali ke Daftar</a>
    
    <form method="POST" action="" enctype="multipart/form-data" class="w-50 bg-light p-4">
        <label>Nama:</label>
        <input type="text" name="nama" class="form-control" required><br>
        
        <label>Telepon:</label>
        <input type="text" name="telepon" class="form-control"><br>
        
        <label>Alamat:</label>
        <textarea name="alamat" class="form-control"></textarea><br>

        <label>Foto:</label>
        <input type="file" name="foto" class="form-control mb-3"><br>
        
        <input type="submit" value="Tambah Pelanggan" class="btn btn-primary">
    </form>
</body>
</html>
