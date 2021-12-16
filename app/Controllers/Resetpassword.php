<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Resetpassword extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Reset Password'
        ];

        return view('pages/v_resetpassword', $data);
    }

    public function reset()
    {

        $request = \Config\Services::request();
        $token = base64_decode($request->uri->getSegment('3'));

        $userData = $this->model->isTokenValid($token);

        if (!$userData) {
            session()->setFlashdata('error', 'Token is invalid or expired');
            return redirect()->to(base_url() . '/login');
        }

        $data = array(
            'name' => $userData['name'],
            'email' => $userData['email'],
            'token' => base64_encode($token)
        );

        if ($this->request->getPost()) {
            $val = $this->validate([
                'password' => [
                    'label' => 'password',
                    'rules' =>  'required|min_length[8]'
                ],
                'c_password' => [
                    'label' => 'confirm password',
                    'rules' => 'required|matches[password]'
                ]
            ]);

            if ($val) {
                $newpassword = $this->request->getPost('password');
                $post = [
                    'password' => password_hash($newpassword, PASSWORD_DEFAULT),
                    'id' => $userData['id']
                ];

                if(!$this->model->updatePassword($post)){
                    session()->setFlashdata('error', 'Sorry failed to update the password, please try again');
                }else{
                    session()->setFlashdata('success', 'Password has been updated');
                    return redirect()->to(base_url() . '/login');
                }
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
            }
        }

        echo view('pages/v_resetpassword', $data);
    }

    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
