<?php namespace App\Controllers\Student;
use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\GradesModel;

class GradeController extends BaseController{

    public function index()
    {
        $model = new StudentModel();

        $results = $model
            ->select('students.student_number, students.first_name, students.last_name, grades.grade_id, grades.subject, grades.quarter, grades.grade')
            ->join('grades', 'grades.student_id = students.student_number')
            ->findAll();

        $students = [];

        foreach ($results as $row) {
            $studentNumber = $row['student_number'];
            if (!isset($students[$studentNumber])) {
                $students[$studentNumber] = [
                    'student' => [
                        'first_name' => $row['first_name'],
                        'last_name'  => $row['last_name'],
                        'student_number' => $studentNumber,
                    ],
                    'grades' => [],
                ];
            }
            $students[$studentNumber]['grades'][] = [
                'grade_id' => $row['grade_id'],
                'subject' => $row['subject'],
                'grade'   => $row['grade'],
                'quarter' => $row['quarter'],
            ];
        }

        return view('students/students_grade', [
            'students' => $students
        ]);
    }

    public function updateGrades()
    {
        $grades = $this->request->getPost('grades');
        $gradeModel = new GradesModel();

        foreach ($grades as $grade) {
            $gradeModel->update($grade['grade_id'], ['grade' => $grade['grade']]);
        }

        return redirect()->to('/student/grades')->with('success', 'Grades updated successfully.');
    }



    
}