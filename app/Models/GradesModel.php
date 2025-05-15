<?php namespace App\Models;
use CodeIgniter\Model;

class GradesModel extends Model{
    protected $table = 'grades';
    protected $primaryKey = 'grade_id';
    protected $allowedFields = [
        'subject',
        'student_id',
        'quarter',
        'grade',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}