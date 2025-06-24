<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit</h2>

    <!-- Form Input -->
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama Tamu</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipe Kamar</label>
            <select name="kamar" class="form-select" required>
                <option value="Standard">Standard</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Suite">Suite</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Check-in</label>
            <input type="date" name="checkin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Check-out</label>
            <input type="date" name="checkout" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status Pembayaran</label>
            <select name="status" class="form-select" required>
                <option value="Lunas">Lunas</option>
                <option value="Belum Lunas">Belum Lunas</option>
            </select>
        </div>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

    <!-- Proses Simpan -->
    <?php
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $kamar = $_POST['kamar'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $status = $_POST['status'];

        if ($checkin > $checkout) {
            echo "<div class='alert alert-warning mt-3'>Tanggal Check-out tidak boleh sebelum Check-in.</div>";
        } else {
            $query = "INSERT INTO booking (nama_tamu, tipe_kamar, tanggal_checkin, tanggal_checkout, status_pembayaran)
                      VALUES ('$nama', '$kamar', '$checkin', '$checkout', '$status')";
            $hasil = mysqli_query($koneksi, $query);

            if ($hasil) {
                echo "<div class='alert alert-success mt-3'>Booking berhasil ditambahkan. <a href='index.php'>Lihat Data</a></div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Gagal menyimpan data: " . mysqli_error($koneksi) . "</div>";
            }
        }
    }
    ?>
</div>
</body>
</html>
