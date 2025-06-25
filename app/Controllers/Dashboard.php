<?php

namespace App\Controllers;

use App\Models\TugasModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $tugasModel = new TugasModel();
        $idUser = session()->get('id_user');

        // --- Menghitung Jumlah Tugas (Kode yang sudah ada) ---
        $jumlahDaftarTugas = $tugasModel
            ->where('id_user', $idUser)
            ->whereIn('status', ['Belum Dikerjakan', 'Sedang Dikerjakan'])
            ->countAllResults();

        $jumlahTugasSelesai = $tugasModel
            ->where('id_user', $idUser)
            ->where('status', 'Selesai')
            ->countAllResults();

        // --- MENGAMBIL DAFTAR TUGAS UNTUK DITAMPILKAN (KODE BARU) ---
        $daftarTugasDashboard = $tugasModel
            ->where('id_user', $idUser)
            ->whereIn('status', ['Belum Dikerjakan', 'Sedang Dikerjakan'])
            ->orderBy('deadline', 'ASC') // Urutkan berdasarkan deadline terdekat
            ->findAll(5); // Ambil maksimal 5 tugas terdekat

        // --- Siapkan data untuk dikirim ke view ---
        // Tentukan nilai default untuk filter_aktif (misal: null atau string tertentu)
        $filter_aktif = null;

        $data = [
            'nama' => session()->get('nama'),
            'jumlah_daftar_tugas' => $jumlahDaftarTugas,
            'jumlah_tugas_selesai' => $jumlahTugasSelesai,
            'daftar_tugas' => $daftarTugasDashboard,
            'filter_aktif' => $filter_aktif,
        ];

        return view('pages/dashboard_v', $data);
    }
}
