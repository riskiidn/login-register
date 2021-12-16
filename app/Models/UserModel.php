<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'password', 'updated_at', 'profile_photo'];
    protected $useTimeStamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry, That email has already been taken. Please choose another.'
        ]
    ];

    protected $skipValidation = false;
    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function getUserInfo($id)
    {

        $builder = $this->db->table('users');
        $builder->select('id,name,email');
        $builder->where('id', $id);
        $result = $builder->get();

        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function insertToken($user_id)
    {
        $token = substr(sha1(rand()), 0, 30);
        $date = date('Y-m-d');

        $string = array(
            'token' => $token,
            'user_id' => $user_id,
            'created_at' => $date
        );
        $q = $this->db->table('tokens');
        $q->insert($string);
        return $token . $user_id;
    }

    public function isTokenValid($token)
    {
        $tkn = substr($token, 0, 30);
        $uid = substr($token, 30);

        $query = $this->db->table('tokens');
        $query->select('token, user_id, created_at');
        $query->where(['token' => $tkn, 'user_id' => $uid]);
        $res = $query->get();

        if (count($res->getResultArray()) > 0) {
            $row = $res->getRowArray();

            $created_at = $row['created_at'];
            $createdTS = strtotime($created_at);
            $today = date('Y-m-d');
            $todayTS = strtotime($today);

            if ($createdTS != $todayTS) {
                return false;
            }

            $user_info = $this->getUserInfo($row['user_id']);
            return $user_info;
        } else {
            return false;
        }
    }

    public function updatePassword($post)
    {
        $builder = $this->db->table('users');
        $builder->set('password' ,$post['password']);
        $builder->where('id', $post['id']);
        $builder->update();

        if($builder->get()->getNumRows()>0){
            return true;
        }else{
            return false;
        }

        
    }

    public function verivyEmail($email)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('id,name,email,password');
        $builder->where('email', $email);
        $result = $builder->get();

        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }
}
