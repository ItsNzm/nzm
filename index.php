<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Booking Hotel</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Daftar Booking Hotel</h2>

    <!-- Tabel Booking -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Tamu</th>
                <th>Tipe Kamar</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $data = mysqli_query($koneksi, "SELECT * FROM booking");
        while ($row = mysqli_fetch_assoc($data)) {
            echo "<tr>";
            echo "<td>{$row['id_booking']}</td>";
            echo "<td>{$row['nama_tamu']}</td>";
            echo "<td>{$row['tipe_kamar']}</td>";
            echo "<td>{$row['tanggal_checkin']}</td>";
            echo "<td>{$row['tanggal_checkout']}</td>";
            echo "<td>{$row['status_pembayaran']}</td>";
            echo "<td>";
            
            // Tombol Ubah Status
            if ($row['status_pembayaran'] == 'Belum Lunas') {
                echo "<a href='index.php?lunas={$row['id_booking']}' class='btn btn-sm btn-success'>Tandai Lunas</a> ";
            }

            // Tambahan Aksi Lain
            echo "<a href='edit.php?id={$row['id_booking']}' class='btn btn-sm btn-warning'>Edit</a> ";
            echo "<a href='hapus.php?id={$row['id_booking']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin hapus?\")'>Hapus</a>";
            echo "</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <a href="tambah.php" class="btn btn-primary">+ Tambah Booking</a>

    <!-- Proses Ubah Status -->
    <?php
    if (isset($_GET['lunas'])) {
        $id = $_GET['lunas'];
        $update = mysqli_query($koneksi, "UPDATE booking SET status_pembayaran='Lunas' WHERE id_booking='$id'");
        if ($update) {
            echo "<div class='alert alert-info mt-3'>Status pembayaran berhasil diubah menjadi Lunas.</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php'>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Gagal mengubah status: " . mysqli_error($koneksi) . "</div>";
        }
    }
    ?>
</div>
</body>
</html>
