<?php

namespace App\Models;

use CodeIgniter\Model;

class Users_model extends Model
{
    protected $table = "users";
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_name', 'user_email', 'user_password', 'user_status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [
        'user_name' => 'required',
        'user_email' => 'required|valid_email|is_unique[users.user_email]',
        'user_password' => 'required|min_length[8]'
    ];
    protected $validationMessages = [
        'user_name' => [
            'required' => 'Nama harus di isi!',
        ],
        'user_email' => [
            'required' => 'Email harus di isi',
            'valid_email' => 'Email yang dimasukan tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ],
        'user_password' => [
            'required' => 'Password harus di isi',
            'min_length' => 'Password minimal 8 karakter'
        ]
    ];

    public function getUsers($id = false){
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['user_id' => $id])->first();
        
    }

}