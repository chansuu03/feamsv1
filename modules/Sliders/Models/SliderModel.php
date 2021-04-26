<?php namespace Modules\Sliders\Models;

use CodeIgniter\Model;

class SliderModel extends \CodeIgniter\Model
{
    protected $table = 'fea_sliders';
    protected $primaryKey = 'slider_id';
    protected $allowedFields = ['title', 'description', 'image_file', 'created_at', 'updated_at', 'deleted_at'];

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
