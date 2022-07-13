<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Products_model;

class Products extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->productsModel = new Products_model();
    }

    public function index()
    {
        //
    }

    public function show($id = null)
    {
        //
    }

    public function create()
    {
        $this->productsModel->save([
            'product_name' => $this->request->getVar('product_name'),
            'product_stock' => $this->request->getVar('product_stock'),
            'product_price' => $this->request->getVar('product_price'),
            'product_img' => $this->request->getVar('product_img'),
            'user_id' => 12,
        ]);

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Product berhasil ditambahkan'
            ]
        ];

        return $this->respondCreated($response, 'Success');
    }
    public function delete($id = null)
    {
        //
    }
}
