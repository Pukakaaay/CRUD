<?php if (!$data): ?>
    <h1>Pelanggan tidak ditemukan!</h1>
    <a href="index.php?page=list" class="btn btn-primary">Kembali ke Daftar</a>
    <?php exit; ?>
<?php endif; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="m-5">
    <h1 class="mt-5">Detail Pelanggan</h1>
    <a href="index.php?page=list" class="btn btn-primary my-3">Kembali ke Daftar</a>
    <table class="table">
        <tr>
            <th>Foto</th>
            <td>
                <?php if (!empty($data['Foto'])): ?>
                    <img src="../../public/uploads/<?= htmlspecialchars($data['Foto']) ?>" alt="foto-pelanggan" width="150">
                <?php else: ?>
                    <p class="text-muted">Tidak ada foto</p>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>ID</th>
            <td><?= htmlspecialchars($data['PelangganID']) ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?= htmlspecialchars($data['NamaPelanggan']) ?></td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td><?= htmlspecialchars($data['NomorTelepon']) ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?= htmlspecialchars($data['Alamat']) ?></td>
        </tr>
    </table>
</body>
</html>
