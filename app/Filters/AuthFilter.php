<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * This is the method that is called before a controller is executed.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah session dengan key 'isLoggedIn' tidak ada atau nilainya false
        if (! session()->get('isLoggedIn')) {
            // Jika belum login, redirect ke halaman login
            return redirect()->to('/login');
        }
    }

    /**
     * This is the method that is called after a controller is executed.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada yang perlu dilakukan setelah controller dijalankan
    }
}