<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="m-4">
    <h1>Data Pelanggan</h1>
    <a href="index.php?page=tambah" class="btn btn-primary my-3">Tambah Pelanggan Baru</a>
    
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row['PelangganID'] ?></td>
                <td><?= $row['NamaPelanggan'] ?></td>
                <td><?= $row['Alamat'] ?></td>
                <td><?= $row['NomorTelepon'] ?></td>
                <td>
                <a href="index.php?page=detail&id=<?= $row['PelangganID'] ?>" class="btn btn-info">Detail</a>
<a href="index.php?page=edit&id=<?= $row['PelangganID'] ?>" class="btn btn-warning">Edit</a>
<a href="index.php?page=hapus&id=<?= $row['PelangganID'] ?>" class="btn btn-danger" onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</body>
</html>
