<?php

namespace App\Controllers;

use App\Models\Account_m;

class Auth extends BaseController
{
    public function register()
    {
        return view('register_v');
    }

    public function postRegister()
    {
        $rules = [
            'email'    => 'required|valid_email|is_unique[account.email]',
            'nama'     => 'required|min_length[3]',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $accountModel = new Account_m();
        $data = [
            'email'    => $this->request->getPost('email'),
            'nama'     => $this->request->getPost('nama'),
            'password' => md5($this->request->getPost('password')) // pakai MD5
        ];
        $accountModel->insert($data);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function login()
    {
        return view('login_v');
    }

    public function postDologin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            $data["pesan"] = validation_list_errors();
            return view("login_v", $data);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $accountModel = new Account_m();
        // PERBAIKAN 1: Gunakan where() untuk mencari berdasarkan email, lebih aman.
        $user = $accountModel->where('email', $email)->first();

        if ($user != null) {
            if ($user["password"] == md5($password)) {
                $session = session();
                // PERUBAHAN UTAMA DI SINI:
                $session->set([
                    'id_user'    => $user['id'], // <--- Kunci yang kita gunakan adalah 'id_user'
                    'email'      => $user['email'],
                    'nama'       => $user['nama'],
                    'isLoggedIn' => TRUE
                ]);
                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Akun tidak ditemukan');
        }
    }

    public function getAccount()
    {
        $session = session();
        if ($session->has('email')) {
            echo "Session tersedia, selamat datang " . $session->get('nama');
        } else {
            echo "Belum login.";
        }
    }

    public function getDestroy()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}