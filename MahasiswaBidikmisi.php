<?php
// MahasiswaBidikmisi.php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    // Properti tambahan spesifik Bidikmisi
    private string $nomorKipKuliah;
    private float $danaSakuSubsidi;

    // Constructor (Tetap dipertahankan untuk menangkap data awal)
    public function __construct(int $id_mahasiswa, string $nama_mahasiswa, string $nim, int $semester, float $tarifUKTnominal, string $nomorKipKuliah, float $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUKTnominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // Overriding Tahap 5: Gratis penuh karena ditanggung negara melalui KIP-K
    public function hitungTagihanSemester(): float {
        return 0.0;
    }

    // Menampilkan spesifikasi akademik khusus Bidikmisi
    public function tampilkanSpesifikasiAkademik(): void {
        echo "Jalur: Bidikmisi | No KIP-K: {$this->nomorKipKuliah} | Dana Saku Subsidi: Rp" . number_format($this->danaSakuSubsidi, 0, ',', '.') . "\n";
    }

    // Method Query (Dari Tahap 4)
    public static function getByMinimalDanaSaku(PDO $db, float $minDanaSaku) {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nim, nomor_kip_kuliah, dana_saku_subsidi 
                FROM tabel_mahasiswa 
                WHERE jenis_pembayaran = 'bidikmisi' AND dana_saku_subsidi >= :min_dana";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([':min_dana' => $minDanaSaku]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}