<?php

namespace App\Models;

use CodeIgniter\Model;

class Subject extends Model
{
    protected $table            = 'subjects';
    protected $primaryKey       = 'subject_id';
    protected $allowedFields = ['subject_code', 'subject_name', 'created_at', 'updated_at', 'deleted_at'];
    protected $useSoftDeletes   = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
