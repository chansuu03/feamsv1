<?php namespace Modules\Users\Models;

use CodeIgniter\Model;

class DepartmentModel extends \CodeIgniter\Model
{
    protected $table = 'fea_departments';
    protected $primaryKey = 'dept_id';
    protected $allowedFields = ['dept_name'];

    public function showdept()
    {
      $this->select('*');
      $this->join('fea_users', 'fea_departments.dept_id = fea_users.type');
      $query = $this->get();
      return $query->getResult();
    }

    public function profile($id)
    {
      $this->select('*');
      $this->join('fea_users', 'fea_departments.dept_id = fea_users.type');
      $this->where('user_id', $id);
      $query = $this->get();
      return $query->getResult();
    }
}
