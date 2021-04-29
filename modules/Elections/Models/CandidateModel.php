<?php
namespace Modules\Elections\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
    protected $table      = 'fea_candidates';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['position_id', 'user_id', 'photo', 'platform'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function insertData($details = null) {
        $db      = \Config\Database::connect();
        $builder = $db->table('fea_candidates');
        return $builder->insert($details);
    }

    public function viewCandidates() {
        $db      = \Config\Database::connect();
        $builder = $db->table('fea_candidates as b');
        $builder->select('b.id, b.position_id, c.description as position, a.first_name, a.last_name, b.platform');
        $builder->where('b.deleted_at ', null);
        $builder->join('fea_users as a', 'b.user_id = a.user_id');
        $builder->join('fea_positions as c', 'b.position_id = c.id');
        $data = $builder->get();
        return $data->getResultArray();
    }
}