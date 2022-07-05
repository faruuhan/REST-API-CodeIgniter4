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
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
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
        $this->usersModel->save([
            'user_name' => $this->request->getVar('user_name'),
            'user_email' => $this->request->getVar('user_email'),
            'user_password' => password_hash($this->request->getVar('user_password'), PASSWORD_BCRYPT),
        ]);

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => 'Data berhasil ditambahkan'
        ];

        return $this->respondCreated($response);
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
