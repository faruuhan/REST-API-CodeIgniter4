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

    public function getUsers($id = false){
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['user_id' => $id])->first();
        
    }

}