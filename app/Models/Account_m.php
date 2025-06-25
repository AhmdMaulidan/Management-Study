<?php

namespace App\Models;

use CodeIgniter\Model;

class Account_m extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'email'; // Email sebagai primary key
    protected $allowedFields = ['email', 'password', 'nama'];
}