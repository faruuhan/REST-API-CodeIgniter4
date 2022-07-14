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
        $fileImg = $this->request->getFile('product_img');
        if ($fileImg->getError() == 4) {
            $nameImg = 'default.jpg';
        } else {
            $nameImg = $fileImg->getRandomName();
            $fileImg->move('img', $nameImg);
        }

        $this->productsModel->save([
            'product_name' => $this->request->getVar('product_name'),
            'product_stock' => $this->request->getVar('product_stock'),
            'product_price' => $this->request->getVar('product_price'),
            'product_img' => $nameImg,
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
        $dataProduct = $this->productsModel->find($id);

        if(!$dataProduct) {
            return $this->fail('Product tidak ditemukan');
        }

        if($dataProduct['product_img'] != 'default.jpg'){
            unlink('img/' . $dataProduct['product_img']);
        }

        $this->productsModel->delete($id);

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Product berhasil dihapus'
            ]
        ];

        return $this->respondDeleted($response);
    }
}
