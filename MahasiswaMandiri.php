<?php
// MahasiswaMandiri.php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan spesifik Mandiri
    private string $golonganUKT;
    private string $namaWali;

    public function __construct(int $id_mahasiswa, string $nama_mahasiswa, string $nim, int $semester, float $tarifUKTnominal, string $golonganUKT, string $namaWali) {
        // Memanggil constructor dari abstract class induk
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUKTnominal);
        $this->golonganUKT = $golonganUKT;
        $this->namaWali = $namaWali;
    }

    // Implementasi abstract method 1
    public function hitungTagihanSemester(): float {
        // Mahasiswa mandiri membayar penuh sesuai tarif UKT nominal ditambah biaya institusi (jika ada)
        return $this->tarifUKTnominal;
    }

    // Implementasi abstract method 2
    public function tampilkanSpesifikasiAkademik(): void {
        echo "Jalur: Mandiri | Golongan UKT: {$this->golonganUKT} | Wali: {$this->namaWali}\n";
    }

    // Method Query Spesifik: Mengambil data mahasiswa mandiri berdasarkan golongan UKT tertentu
    public static function getByGolongan(PDO $db, string $golongan) {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nim, semester, tarif_ukt, golongan_ukt, nama_wali 
                FROM tabel_mahasiswa 
                WHERE jenis_pembayaran = 'mandiri' AND golongan_ukt = :golongan";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([':golongan' => $golongan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}