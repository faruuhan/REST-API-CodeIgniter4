<?php

namespace App\Models;

use CodeIgniter\Model;

class Users_model extends Model
{
    protected $table = "users";
    protected $allowedFields = ['user_name', 'user_email', 'user_password', 'user_status'];
}