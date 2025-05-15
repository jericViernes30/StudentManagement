<?php namespace App\Controllers\Student;
use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\GradesModel;
use App\Models\Subject;

class SubjectController extends BaseController{
    public function list(){
        $model = new Subject();
        $subjects = $model->findAll();

        return view('students/student_subjects', ['subjects' => $subjects]);
    }

    public function add()
    {
        $subjectName = ucwords(strtolower($this->request->getPost('subject_name')));
        $model = new Subject();

        // Generate subject code
        $words = explode(' ', $subjectName);
        $code = '';
        foreach ($words as $word) {
            $code .= strtoupper(substr($word, 0, 1));
        }

        if (strlen($code) < 3) {
            $code = strtoupper(substr($subjectName, 0, 3));
        }

        $subjectCode = $code . '101';

        $model->insert([
            'subject_code'  => $subjectCode,
            'subject_name'  => $subjectName,
        ]);

        return redirect()->back()->with('success', 'Subject added successfully!');
    }

}