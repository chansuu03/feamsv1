<?php
namespace Modules\Elections\Models;

use CodeIgniter\Model;

class PositionsModel extends Model
{
    protected $table      = 'fea_positions';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['description', 'max_vote', 'priority'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function addPosition($details = null) {
        $db      = \Config\Database::connect();
        $builder = $db->table('fea_positions');
        return $builder->insert($details);
    }
}