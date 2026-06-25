<?php
// MahasiswaMandiri.php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan spesifik Mandiri (Tetap dipertahankan)
    private string $golonganUKT;
    private string $namaWali;

    // Constructor (Sama persis seperti di screenshot Anda, JANGAN DIHAPUS)
    public function __construct(int $id_mahasiswa, string $nama_mahasiswa, string $nim, int $semester, float $tarifUKTnominal, string $golonganUKT, string $namaWali) {
        // Memanggil constructor dari abstract class induk
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUKTnominal);
        $this->golonganUKT = $golonganUKT;
        $this->namaWali = $namaWali;
    }

    /**
     * ==========================================
     * TAMBAHKAN / MODIFIKASI BAGIAN DI BAWAH INI
     * ==========================================
     */

    // Overriding: Logika hitung tagihan Mandiri (UKT + 100.000)
    public function hitungTagihanSemester(): float {
        return $this->tarifUKTnominal + 100000;
    }

    // Menampilkan spesifikasi akademik khusus Mandiri
    public function tampilkanSpesifikasiAkademik(): void {
        echo "Jalur: Mandiri | Golongan UKT: {$this->golonganUKT} | Wali: {$this->namaWali}\n";
    }

    // Method Query (Dari Tahap 4)
    public static function getByGolongan(PDO $db, string $golongan) {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nim, semester, tarif_ukt, golongan_ukt, nama_wali 
                FROM tabel_mahasiswa 
                WHERE jenis_pembayaran = 'mandiri' AND golongan_ukt = :golongan";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([':golongan' => $golongan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} // Tanda tutup kurung kurawal akhir class