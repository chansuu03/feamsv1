<?php namespace Modules\Users\Models;

use CodeIgniter\Model;

class UserModel extends \CodeIgniter\Model
{
    protected $table      = 'fea_users';
    protected $primaryKey = 'user_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['employee_id', 'username', 'password', 'email', 'profile_pic', 'last_name', 'first_name', 'middle_name', 'gender', 'type', 'birthdate', 'contact_number', 'address', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function verifyUsername($username) {
        return $this->where('username', $username)->first();
    }

    public function viewActive() {
        return $this->findAll();
    }

    public function viewProfile($id) {
        return $this->where('username', $id)->first();
    }
}