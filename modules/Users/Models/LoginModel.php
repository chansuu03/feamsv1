<?php
namespace Modules\Users\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'fea_users';
    protected $primaryKey = 'user_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'password', 'email_code', 'type', 'status'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function userDetails($username = null) {
        return $this->select('user_id ,username, password, email_code, type, status')
                    ->where('username', $username)
                    ->first();
    }

    public function loginDetails($details = null) {
        $db      = \Config\Database::connect();
        $builder = $db->table('fea_logins');
        return $builder->insert($details);
    }

    public function print() {
        $db      = \Config\Database::connect();
        $builder = $db->table('fea_logins as a');
        $builder->select('a.login_id, b.username, b.first_name, b.last_name, a.role_id, a.login_date');
        $builder->join('fea_users as b', 'a.user_id = b.user_id');
        $data = $builder->get();
        return $data->getResultArray();
    }
}