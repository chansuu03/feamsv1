<?php namespace Modules\Admin\Users\Models;

use CodeIgniter\Model;

class UserModel extends \CodeIgniter\Model
{
    protected $table      = 'fea_users';
    protected $primaryKey = 'user_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['employee_id', 'username', 'password', 'email', 'profile_pic', 'last_name', 'first_name', 'middle_name', 'gender', 'dept_id', 'birthdate', 'contact_number', 'address', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function verifyUsername($username)
    {
      return $this->where('username', $username)->first();
    }

    public function viewActive()
    {
      return $this->join('fea_departments', 'fea_departments.dept_id = fea_users.dept_id')
                  ->findAll();
    }

    public function viewProfile($id)
    {
      return $this->where('username', $id)
                  ->first();
    }
}
