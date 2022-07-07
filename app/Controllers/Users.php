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
        $validation = \Config\Services::validation();

        if(!$id){
            if(!$this->validate([
                'user_name' => [
                    'rules' => 'required'
                ],
                'user_email' => [
                    'rules' => 'required|is_unique[users.user_email]'
                ],
                'user_password' => [
                    'rules' => 'required|min_length[8]'
                ]
            ])){
                return $this->fail($validation->getErrors());
            }

            $this->usersModel->save([
                'user_name' => $this->request->getVar('user_name'),
                'user_email' => $this->request->getVar('user_email'),
                'user_password' => password_hash($this->request->getVar('user_password'), PASSWORD_BCRYPT),
            ]);

            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Akun pengguna berhasil didaftarkan'
                ]
            ];

            return $this->respondCreated($response, 'Success');
        
        }else{


            $userExixts = $this->usersModel->getUsers($id);

            if(!$userExixts){
                return $this->fail('User tidak ditemukan');
            }

            if($userExixts['user_email'] === $this->request->getVar('user_email')){
                $rules_email = 'required';
            }else{
                $rules_email = 'required|is_unique[users.user_email]';
            }
            
            if(!$this->validate([
                'user_name' => [
                    'rules' => 'required'
                ],
                'user_email' => [
                    'rules' => $rules_email
                ],
                'user_password' => [
                    'rules' => 'required|min_length[8]'
                ]
            ])){
                return $this->fail($validation->getErrors());
            }

            $this->usersModel->save([
                'user_id' => $id,
                'user_name' => $this->request->getVar('user_name'),
                'user_email' => $this->request->getVar('user_email'),
                'user_password' => password_hash($this->request->getVar('user_password'), PASSWORD_BCRYPT),
            ]);

            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Akun berhasil di perbaharui',
                ]
            ];

            return $this->respond($response, 200);
        }
    }

    public function delete($id = null)
    {
        $userExixts = $this->usersModel->getUsers($id);

        if(!$userExixts){
            return $this->fail('User tidak ditemukan');
        }

        $this->usersModel->delete($id);

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
