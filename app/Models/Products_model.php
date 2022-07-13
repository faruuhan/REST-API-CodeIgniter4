<?php

namespace App\Models;

use CodeIgniter\Model;

class Products_model extends Model
{
    protected $table = "products";
    protected $primaryKey = 'product_id';
    protected $allowedFields = ['product_name', 'product_stock', 'product_price', 'product_img', 'user_id', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProduct($id = false){
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['product_id' => $id])->first();
        
    }

}