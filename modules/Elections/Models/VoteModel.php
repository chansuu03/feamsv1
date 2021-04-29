<?php
namespace Modules\Elections\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table      = 'fea_votes';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['voters_id', 'candidate_id', 'position_id'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function checkVote($id = null) {
        $this->where('voters_id', $id);
        return $this->get()->getResultArray();
    }
}