<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Register extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data = [
            'title' => 'Register'
        ];

        return view('pages/v_register', $data);
    }

    public function store()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $foto_profile = $this->request->getFile('uploadfoto');

        if (!$foto_profile->isValid()) {
            session()->setFlashdata('error', $foto_profile->getErrorString() . '(' . $foto_profile->getError() . ')');
            return redirect()->back();
        }

        if ($foto_profile->hasMoved()) {
            $newName = $foto_profile->getRandomName();
            $foto_profile->move('./img/photoprofiles/', $newName);
        }else{
            session()->setFlashdata('error', $foto_profile->getErrorString() . '(' . $foto_profile->getError() . ')');
            return redirect()->back();
        }

        $user = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'profile_photo' => $newName
        ];

        $save = $this->model->save($user);
        if ($save) {
            session()->setFlashdata('success', 'Register Berhasil!');
            return redirect()->to(base_url('login'));
        } else {
            session()->setFlashdata('error', [$this->model->errors()]);
            return redirect()->back();
        }
    }
}
