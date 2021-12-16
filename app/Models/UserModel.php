<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model{
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
        if (! isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function verivyEmail($email){
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('id,name,email,password');
        $builder->where('email', $email);
        $result = $builder->get();

        if(count($result->getResultArray())==1){
            return $result->getRowArray();
        }
        else{
            return false;
        }
    }

}