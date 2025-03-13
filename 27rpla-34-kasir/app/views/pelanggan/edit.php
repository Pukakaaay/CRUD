<?php
require_once "../config/Database.php";

$db = new Database();
$conn = $db->connect();

if (!isset($_GET['id'])) {
    echo "<script>alert('Pelanggan tidak ditemukan!'); window.location='index.php?page=list';</script>";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM pelanggan WHERE PelangganID = :id";
$query = $conn->prepare($sql);
$query->bindParam(":id", $id);
$query->execute();
$data = $query->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    echo "<script>alert('Pelanggan tidak ditemukan!'); window.location='index.php?page=list';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    
    // Cek apakah ada foto baru yang diupload
    $foto = $data['Foto']; // Pakai foto lama jika tidak ada upload baru
    if (!empty($_FILES["foto"]["name"])) {
        $targetDir = "../public/uploads/";
        $foto = basename($_FILES["foto"]["name"]);
        $targetFilePath = $targetDir . $foto;
        
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
            // Foto berhasil diunggah
        } else {
            $foto = $data['Foto']; // Kembalikan ke foto lama jika gagal upload
        }
    }

    // Update data pelanggan
    $sql = "UPDATE pelanggan SET NamaPelanggan = :nama, NomorTelepon = :telepon, Alamat = :alamat, Foto = :foto WHERE PelangganID = :id";
    $query = $conn->prepare($sql);
    $query->bindParam(":nama", $nama);
    $query->bindParam(":telepon", $telepon);
    $query->bindParam(":alamat", $alamat);
    $query->bindParam(":foto", $foto);
    $query->bindParam(":id", $id);

    if ($query->execute()) {
        echo "<script>alert('Pelanggan berhasil diperbarui!'); window.location='index.php?page=list';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui pelanggan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="m-5">
    <h1>Edit Pelanggan</h1>
    <a href="index.php?page=list" class="btn btn-primary my-3">Kembali ke Daftar</a>
    
    <form method="POST" action="" enctype="multipart/form-data" class="w-50 bg-light p-4">
        <label>Nama:</label>
        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['NamaPelanggan']) ?>" required><br>
        
        <label>Telepon:</label>
        <input type="text" name="telepon" class="form-control" value="<?= htmlspecialchars($data['NomorTelepon']) ?>"><br>
        
        <label>Alamat:</label>
        <textarea name="alamat" class="form-control"><?= htmlspecialchars($data['Alamat']) ?></textarea><br>

        <label>Foto:</label>
        <input type="file" name="foto" class="form-control mb-3"><br>
        <?php if (!empty($data['Foto'])): ?>
            <img src="../uploads/<?= htmlspecialchars($data['Foto']) ?>" alt="Foto Pelanggan" width="100">
        <?php endif; ?>
        
        <input type="submit" value="Simpan Perubahan" class="btn btn-success">
    </form>
</body>
</html>
