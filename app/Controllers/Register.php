<?php namespace App\Controllers;
 
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

        $newName = $foto_profile->getRandomName();

        $foto_profile->move('./img/photoprofiles/', $newName);

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
            session()->setFlashdata('error', $this->model->errors());
            return redirect()->back();
        }
    }
}