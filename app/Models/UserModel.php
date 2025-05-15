<?php namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'first_name', 'last_name', 'password'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    
    protected $beforeInsert = [
        'hashPassword'
    ];

    public function hashPassword(array $data){
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
}