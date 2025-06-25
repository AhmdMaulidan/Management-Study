<?php

namespace App\Controllers;

use App\Models\Account_m;

class Login extends BaseController
{
    public function getIndex()
    {
        return view("login_v");
    }

    public function postLogin()
    {
        // Ambil input dari form
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validasi form input
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Email dan Password harus diisi dengan benar!');
        }

        // Ambil user dari database
        $accountModel = new Account_m();
        $user = $accountModel->find($email); // karena email adalah primary key

        if ($user) {
            // Cocokkan password MD5
            if ($user['password'] === md5($password)) {
                // Simpan ke session
                session()->set([
                    'id'    => $user['id'], // <-- TAMBAHAN PENTING
                    'email' => $user['email'],
                    'nama'  => $user['nama']
                ]);

                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Password salah!');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }
}
