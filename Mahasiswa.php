<?php
// Mahasiswa.php

abstract class Mahasiswa {
    // Properti terenkapsulasi dengan hak akses protected
    protected int $id_mahasiswa;
    protected string $nama_mahasiswa;
    protected string $nim;
    protected int $semester;
    protected float $tarifUKTnominal;

    // Constructor untuk inisialisasi atribut global (induk)
    public function __construct(int $id_mahasiswa, string $nama_mahasiswa, string $nim, int $semester, float $tarifUKTnominal) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarifUKTnominal = $tarifUKTnominal;
    }

    // Abstract method wajib 1: Menghitung total tagihan semester
    abstract public function hitungTagihanSemester(): float;

    // Abstract method wajib 2: Menampilkan spesifikasi akademik unik
    abstract public function tampilkanSpesifikasiAkademik(): void;

    // Getter dan Setter (Enkapsulasi standar)
    public function getIdMahasiswa(): int { return $this->id_mahasiswa; }
    public function setIdMahasiswa(int $id_mahasiswa): void { $this->id_mahasiswa = $id_mahasiswa; }

    public function getNamaMahasiswa(): string { return $this->nama_mahasiswa; }
    public function setNamaMahasiswa(string $nama_mahasiswa): void { $this->nama_mahasiswa = $nama_mahasiswa; }

    public function getNim(): string { return $this->nim; }
    public function setNim(string $nim): void { $this->nim = $nim; }

    public function getSemester(): int { return $this->semester; }
    public function setSemester(int $semester): void { $this->semester = $semester; }

    public function getTarifUKTnominal(): float { return $this->tarifUKTnominal; }
    public function setTarifUKTnominal(float $tarifUKTnominal): void { $this->tarifUKTnominal = $tarifUKTnominal; }
}