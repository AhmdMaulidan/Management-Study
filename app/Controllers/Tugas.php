<?php

namespace App\Controllers;

use App\Models\TugasModel;
use CodeIgniter\Exceptions\PageNotFoundException; // Impor class exception

class Tugas extends BaseController
{
    protected $tugasModel;
    protected $idUser; // Properti untuk menyimpan ID user yang login

    public function __construct()
    {
        // Pastikan model dimuat sekali saja
        $this->tugasModel = new TugasModel();

        // Ambil ID user dari session dan simpan di properti agar mudah diakses
        $this->idUser = session()->get('id_user');
    }

    // Menampilkan halaman Daftar Tugas
    public function index()
    {
        $data = [
            'nama' => session()->get('nama'),
            'tugas' => $this->tugasModel->where('id_user', $this->idUser)->findAll()
        ];
        return view('tugas/index_v', $data);
    }

    // Menampilkan halaman Tambah Tugas
    public function create()
    {
        $data = [
            'nama' => session()->get('nama'),
            'validation' => \Config\Services::validation() // Untuk menampilkan error validasi
        ];
        return view('tugas/create_v', $data);
    }

    // Menyimpan data dari form Tambah Tugas
    public function store()
    {
        // Aturan validasi
        $rules = [
            'nama_tugas' => 'required|min_length[3]',
            'deadline'   => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            // Mengirim pesan error validasi ke view
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan ke database
        $this->tugasModel->save([
            'id_user'     => $this->idUser,
            'nama_tugas'  => $this->request->getPost('nama_tugas'),
            'deadline'    => $this->request->getPost('deadline'),
            'keterangan'  => $this->request->getPost('keterangan'),
            'status'      => 'Belum Dikerjakan' // Status default
        ]);

        return redirect()->to('/tugas')->with('success', 'Tugas berhasil ditambahkan.');
    }

    // Menampilkan form edit tugas
    public function edit($id)
    {
        $tugas = $this->tugasModel->find($id);

        // Validasi: Cek apakah tugas ada dan milik user yang login
        if (empty($tugas) || $tugas['id_user'] != $this->idUser) {
            throw new PageNotFoundException('Tugas dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = [
            'nama' => session()->get('nama'),
            'tugas' => $tugas,
            'validation' => \Config\Services::validation()
        ];

        return view('tugas/edit_v', $data);
    }

    // Memproses update tugas
    public function update($id)
    {
        // Validasi: Cek dulu apakah tugas ini benar milik user yang login sebelum update
        $tugas = $this->tugasModel->find($id);
        if (empty($tugas) || $tugas['id_user'] != $this->idUser) {
            return redirect()->to('/tugas')->with('error', 'Anda tidak memiliki izin untuk mengubah tugas ini.');
        }

        // Aturan validasi
        $rules = [
            'nama_tugas' => 'required|min_length[3]',
            'deadline'   => 'required|valid_date',
            'status'     => 'required|in_list[Belum Dikerjakan,Sedang Dikerjakan,Selesai]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->tugasModel->update($id, [
            'nama_tugas'  => $this->request->getPost('nama_tugas'),
            'deadline'    => $this->request->getPost('deadline'),
            'keterangan'  => $this->request->getPost('keterangan'),
            'status'      => $this->request->getPost('status')
        ]);

        return redirect()->to('/tugas')->with('success', 'Tugas berhasil diperbarui.');
    }

    // Menghapus tugas
    public function delete($id)
    {
        // Validasi: Cek apakah tugas ini benar milik user yang login sebelum dihapus
        $tugas = $this->tugasModel->find($id);
        if ($tugas && $tugas['id_user'] == $this->idUser) {
            $this->tugasModel->delete($id);
            return redirect()->to('/tugas')->with('success', 'Tugas berhasil dihapus.');
        }

        // Jika gagal (tugas tidak ada atau bukan miliknya)
        return redirect()->to('/tugas')->with('error', 'Gagal menghapus tugas.');
    }

    // Menampilkan halaman Tugas Selesai
    public function selesai()
    {
        $data = [
            'nama' => session()->get('nama'),
            'tugas' => $this->tugasModel
                ->where('id_user', $this->idUser)
                ->where('status', 'Selesai')
                ->findAll()
        ];
        return view('tugas/selesai_v', $data);
    }
}
