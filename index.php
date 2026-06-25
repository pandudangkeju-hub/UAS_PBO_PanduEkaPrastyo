<?php
// index.php
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

// 1. Koneksi ke Database menggunakan PDO
$host     = 'localhost';
$db_name  = 'DB_UAS_PBO_TI1D_PanduEkaPrastyo';
$username = 'root'; // Sesuaikan dengan username database Anda
$password = '';     // Sesuaikan dengan password database Anda

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi Database Gagal: " . $e->getMessage());
}

// 2. Ambil Semua Data dari tabel_mahasiswa
$sql = "SELECT * FROM tabel_mahasiswa";
$stmt = $db->query($sql);
$allData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 3. Kelompokkan ke dalam Array Objek sesuai Jalur Pembiayaan
$daftarMandiri   = [];
$daftarBidikmisi = [];
$daftarPrestasi  = [];

foreach ($allData as $row) {
    if ($row['jenis_pembayaran'] === 'mandiri') {
        $daftarMandiri[] = new MahasiswaMandiri(
            $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], 
            (float)$row['tarif_ukt'], $row['golongan_ukt'], $row['nama_wali']
        );
    } elseif ($row['jenis_pembayaran'] === 'bidikmisi') {
        $daftarBidikmisi[] = new MahasiswaBidikmisi(
            $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], 
            (float)$row['tarif_ukt'], $row['nomor_kip_kuliah'], (float)$row['dana_saku_subsidi']
        );
    } elseif ($row['jenis_pembayaran'] === 'prestasi') {
        $daftarPrestasi[] = new MahasiswaPrestasi(
            $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], 
            (float)$row['tarif_ukt'], $row['nama_instansi_beasiswa'], (float)$row['minimal_ipk_syarat']
        );
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Registrasi Pembayaran Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-center mb-2 fw-bold text-primary">SISTEM INFORMASI REGISTRASI PEMBAYARAN KULIAH</h2>
    <p class="text-center text-muted mb-5">Data Terintegrasi Polimorfisme Objek & Database Terpusat</p>

    <div class="card shadow-sm mb-5">
        <div class="card-header bg-dark text-white fw-bold">
            📊 Kategori: Mahasiswa Mandiri (Umum)
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Semester</th>
                            <th>Tarif UKT Asli</th>
                            <th>Spesifikasi Akademik (Jalur)</th>
                            <th class="text-end">Total Tagihan (Polimorfisme)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($daftarMandiri)): ?>
                            <tr><td colspan="6" class="text-center text-muted">Tidak ada data.</td></tr>
                        <?php else: foreach($daftarMandiri as $mhs): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($mhs->getNim()) ?></strong></td>
                                <td><?= htmlspecialchars($mhs->getNamaMahasiswa()) ?></td>
                                <td>Smtr <?= htmlspecialchars($mhs->getSemester()) ?></td>
                                <td>Rp <?= number_format($mhs->getTarifUKTnominal(), 0, ',', '.') ?></td>
                                <td><span class="badge bg-secondary"><?= ob_start(); $mhs->tampilkanSpesifikasiAkademik(); $out = ob_get_clean(); echo trim(str_replace('Jalur: Mandiri |', '', $out)); ?></span></td>
                                <td class="text-end fw-bold text-danger">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-header bg-success text-white fw-bold">
            🎓 Kategori: Mahasiswa Bidikmisi / KIP-Kuliah
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Semester</th>
                            <th>Spesifikasi Akademik (Beasiswa Negara)</th>
                            <th class="text-end">Total Tagihan (Polimorfisme)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($daftarBidikmisi)): ?>
                            <tr><td colspan="5" class="text-center text-muted">Tidak ada data.</td></tr>
                        <?php else: foreach($daftarBidikmisi as $mhs): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($mhs->getNim()) ?></strong></td>
                                <td><?= htmlspecialchars($mhs->getNamaMahasiswa()) ?></td>
                                <td>Smtr <?= htmlspecialchars($mhs->getSemester()) ?></td>
                                <td><span class="badge bg-success"><?= ob_start(); $mhs->tampilkanSpesifikasiAkademik(); $out = ob_get_clean(); echo trim(str_replace('Jalur: Bidikmisi |', '', $out)); ?></span></td>
                                <td class="text-end fw-bold text-success">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?> <span class="badge bg-light text-success border border-success">Lunas Negara</span></td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-dark fw-bold">
            🌟 Kategori: Mahasiswa Prestasi (Beasiswa Institusi/Mitra)
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Semester</th>
                            <th>Tarif UKT Asli</th>
                            <th>Spesifikasi Akademik (Syarat & Mitra)</th>
                            <th class="text-end">Total Tagihan (Polimorfisme Diskon 75%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($daftarPrestasi)): ?>
                            <tr><td colspan="6" class="text-center text-muted">Tidak ada data.</td></tr>
                        <?php else: foreach($daftarPrestasi as $mhs): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($mhs->getNim()) ?></strong></td>
                                <td><?= htmlspecialchars($mhs->getNamaMahasiswa()) ?></td>
                                <td>Smtr <?= htmlspecialchars($mhs->getSemester()) ?></td>
                                <td>Rp <?= number_format($mhs->getTarifUKTnominal(), 0, ',', '.') ?></td>
                                <td><span class="badge bg-info text-dark"><?= ob_start(); $mhs->tampilkanSpesifikasiAkademik(); $out = ob_get_clean(); echo trim(str_replace('Jalur: Prestasi |', '', $out)); ?></span></td>
                                <td class="text-end fw-bold text-primary">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>