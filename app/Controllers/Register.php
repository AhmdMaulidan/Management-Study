<?php

namespace App\Controllers;

use App\Models\Account_m;

class Register extends BaseController
{
    public function index()
    {
        return view('register_v');
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama'     => 'required|min_length[3]',                     // gunakan nama sesuai model
            'email'    => 'required|valid_email|is_unique[account.email]', // tabel: account, field: email
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new Account_m();
        $model->insert([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')), // sesuai permintaan pakai md5
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}