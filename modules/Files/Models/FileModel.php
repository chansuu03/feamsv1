<?php namespace Modules\Files\Models;

use CodeIgniter\Model;

class FileModel extends \CodeIgniter\Model
{
    protected $table = 'fea_files';
    protected $primaryKey = 'file_id';
    protected $allowedFields = ['name', 'size', 'extension', 'uploader', 'uploaded_at', 'updated_at', 'deleted_at'];

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

    public function delFile($id = null) {
        return $this->delete(['file_id' => $id]);
    }
}
