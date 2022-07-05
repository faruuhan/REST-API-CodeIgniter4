<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Users_model;

class Users extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->usersModel = new Users_model();
    }

    public function index()
    {
        $data = $this->usersModel->getUsers();

        $response = [
            'status' => 200,
            'error' => null,
            'data' => $data
        ];

        return $this->respond($response, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {

        if(!$this->usersModel->save([
            'user_name' => $this->request->getVar('user_name'),
            'user_email' => $this->request->getVar('user_email'),
            'user_password' => !$this->request->getVar('user_password') || strlen($this->request->getVar('user_password')) < 8  ? $this->request->getVar('user_password')  : password_hash($this->request->getVar('user_password'), PASSWORD_BCRYPT),
        ])){
            return $this->fail($this->usersModel->errors());
        }

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Akun pengguna berhasil didaftarkan'
            ]
        ];

        return $this->respondCreated($response, 'Success');

    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
