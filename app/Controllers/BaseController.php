<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\TugasModel;
use Config\Services; // <-- 1. Tambahkan use untuk Services

abstract class BaseController extends Controller
{
    protected $request;

    // Tambahkan helper 'text'
    protected $helpers = ['url', 'session', 'text'];

    // Properti ini tetap ada untuk menyimpan data sementara
    protected $notifikasi_tugas;
    protected $jumlah_notifikasi;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Pastikan nama kunci session 'id' sudah benar
        $idUser = session()->get('id');

        if ($idUser) {
            $tugasModel = new TugasModel();

            // Ambil 5 tugas terbaru yang belum selesai
            $this->notifikasi_tugas = $tugasModel
                ->where('id_user', $idUser)
                ->whereIn('status', ['Belum Dikerjakan', 'Sedang Dikerjakan'])
                ->orderBy('created_at', 'DESC')
                ->findAll(5);

            $this->jumlah_notifikasi = count($this->notifikasi_tugas);
        } else {
            $this->notifikasi_tugas = [];
            $this->jumlah_notifikasi = 0;
        }

        // --- INI PERUBAHAN UTAMA: Ganti setVar dengan cara ini ---

        // 2. Panggil service renderer
        $renderer = Services::renderer();

        // 3. Gunakan metode setData() untuk membagikan data ke semua view
        $renderer->setData([
            'notifikasi_tugas'  => $this->notifikasi_tugas,
            'jumlah_notifikasi' => $this->jumlah_notifikasi
        ]);

        // --- AKHIR PERUBAHAN ---
    }
}
