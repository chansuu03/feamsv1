<?php namespace Modules\Announcements\Models;

use CodeIgniter\Model;

class AnnouncementsModel extends \CodeIgniter\Model
{
    protected $table = 'fea_announcements';
    protected $primaryKey = 'ann_id';
    protected $allowedFields = ['title', 'description', 'image', 'start_date', 'end_date', 'date_posted', 'updated_at', 'deleted_at'];

    protected $useTimestamps = false;
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;

    /**
    * Model function to view the data inside the table.
    *
    * @return $this->findAll() will return the data inside the table users.
    */
    public function view() {
        return $this->findAll();
    }
}
