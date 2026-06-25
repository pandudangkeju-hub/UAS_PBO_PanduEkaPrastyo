<?php
// MahasiswaPrestasi.php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    // Properti tambahan spesifik Prestasi
    private string $namaInstansiBeasiswa;
    private float $minimalIpkSyarat;

    public function __construct(int $id_mahasiswa, string $nama_mahasiswa, string $nim, int $semester, float $tarifUKTnominal, string $namaInstansiBeasiswa, float $minimalIpkSyarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUKTnominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // Implementasi abstract method 1
    public function hitungTagihanSemester(): float {
        // Jalur prestasi biasanya mendapat potongan / beasiswa parsial atau penuh
        return $this->tarifUKTnominal; 
    }

    // Implementasi abstract method 2
    public function tampilkanSpesifikasiAkademik(): void {
        echo "Jalur: Prestasi | Instansi: {$this->namaInstansiBeasiswa} | Syarat Minimal IPK: {$this->minimalIpkSyarat}\n";
    }

    // Method Query Spesifik: Mengambil data mahasiswa prestasi berdasarkan nama instansi pemberi beasiswa
    public static function getByInstansiBeasiswa(PDO $db, string $instansi) {
        $sql = "SELECT id_mahasiswa, nama_mahasiswa, nim, nama_instansi_beasiswa, minimal_ipk_syarat 
                FROM tabel_mahasiswa 
                WHERE jenis_pembayaran = 'prestasi' AND nama_instansi_beasiswa LIKE :instansi";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([':instansi' => "%$instansi%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}