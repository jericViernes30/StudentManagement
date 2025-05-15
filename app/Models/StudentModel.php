<?php namespace App\Models;
use CodeIgniter\Model;

class StudentModel extends Model{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $allowedFields = [
        'first_name',
        'last_name',
        'student_number',
        'grade_level',
        'section',
        'gender',
        'age',
        'email_address',
        'contact_number',
        'address',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}