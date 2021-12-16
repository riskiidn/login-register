<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
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
            'title' => 'Login'
        ];

        return view('pages/v_login', $data);
    }

    private function isLoggedIn(): bool
    {
        if (session()->get('logged_in')) {
            return true;
        }

        return false;
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $credentials = ['email' => $email];

        $user = $this->model->where($credentials)
            ->first();

        if (!$user) {
            session()->setFlashdata('error', 'Email atau password anda salah.');
            return redirect()->back();
        }

        $passwordCheck = password_verify($password, $user['password']);

        if (!$passwordCheck) {
            session()->setFlashdata('error', 'Email atau password anda salah.');
            return redirect()->back();
        }

        $userData = [
            'name' => $user['name'],
            'email' => $user['email'],
            'photo' => $user['profile_photo'],
            'logged_in' => TRUE
        ];

        session()->set($userData);
        return redirect()->to(base_url('dashboard'));
    }

    public function logout()
    {

        $userData = [
            'name',
            'email',
            'photo',
            'logged_in'
        ];

        session()->remove($userData);

        return redirect()->to(base_url('login'));
    }

    public function forgotPassword()
    {
        $email = $this->request->getVar('email');

        if ($this->request->getPost()) {

            $credentials = ['email' => $email];
            $user = $this->model->where($credentials)->first();

            if (!empty($user)) {
                $this->model->update($user['id'], ['updated_at' => date('Y-m-d h:i:s')]);
                if ($this->model->affectedRows() == 1) {
                    $to = $email;
                    $subject = "Reset Password";
                    $token  = $user['id'];
                    $message = 'Hi' . $user['name'] . '<br><br> Your reset password request has been received. please click the bellow link to resset your password.<br><br> <a href="' . base_url() . '/login/resetpassword/' . $token . '">';
                    $email = \Config\Services::email();
                    $email->setTo($to);
                    $email->setFrom('riskidwipatrio.indonesia@gmail.com', 'Riski Dwi Patrio');
                    $email->setSubject($subject);
                    $email->setMessage($message);
                    if ($email->send()) {
                        session()->setTempdata('success', 'The reset link has been sent to your email');
                        return redirect()->to(current_url());
                    } else {
                        session()->setFlashdata('error', "Sorry we can't send email right now, please try again");
                        return redirect()->back();
                    }
                }
            } else {
                session()->setFlashdata('error', "Invalid e-mail or it's not registered");
                return redirect()->back();
            }
        }
        return view('pages/v_forgotpassword');
    }
}
