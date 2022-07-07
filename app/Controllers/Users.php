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

    public function show($id = null)
    {
        $data = $this->usersModel->getUsers($id);

        $response = [
            'status' => 200,
            'error' => null,
            'data' => $data
        ];

        if($data){
            return $this->respond($response, 200);
        }else{
            return $this->fail('data tidak ditemukan $id');
        }

    }

    public function create($id = null)
    {

        if(!$id){
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
        }else{

            $data = [
                'user_id' => $id,
                'user_name' => $this->request->getVar('user_name'),
                'user_email' => $this->request->getVar('user_email'),
                'user_password' => !$this->request->getVar('user_password') || strlen($this->request->getVar('user_password')) < 8  ? $this->request->getVar('user_password')  : password_hash($this->request->getVar('user_password'), PASSWORD_BCRYPT),
            ];
            
            if(!$this->usersModel->save($data)){
                return $this->fail($this->usersModel->errors());
            }

            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Akun berhasil di perbaharui',
                    'data' => $data,
                ]
            ];

            return $this->respond($response, 200);
        }
    }

    public function update($id = null)
    {

    }

    public function delete($id = null)
    {
        $userExixts = $this->usersModel->getUsers($id);

        if(!$userExixts){
            return $this->fail('User tidak ditemukan');
        }

        $this->usersModel->where('user_id', $id)->delete();

        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Akun pengguna berhasil dihapus'
            ]
        ];

        return $this->respondDeleted($response);
    }
}
