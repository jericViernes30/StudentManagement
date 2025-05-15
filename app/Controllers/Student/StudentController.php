<?php namespace App\Controllers\Student;
use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\GradesModel;

class StudentController extends BaseController{

    public function studentList(){
        $model = new StudentModel();
        $students = $model->findAll();

        return view('students/students_list', [
            'students' => $students
        ]);
    }

    public function addStudent(){
        // dd($this->request->getPost());
        $validation = \Config\Services::validation();

        $rules = [
            'first_name' => 'required|alpha_space',
            'last_name'  => 'required|alpha_space',
            'student_number' => 'required|regex_match[/^[a-zA-Z0-9\-]+$/]',
            'grade_level' => 'required|numeric',
            'section' => 'required|alpha',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }
        $insertData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'student_number' => $this->request->getPost('student_number'),
            'grade_level' => $this->request->getPost('grade_level'),
            'section' => $this->request->getPost('section'),
            'gender' => $this->request->getPost('gender'),
            'age' => $this->request->getPost('age'),
            'email_address' => $this->request->getPost('email_address'),
            'contact_number' => $this->request->getPost('contact_number'),
            'address' => $this->request->getPost('address'),
        ];

        $subjects = [
            'Filipino',
            'English',
            'Science',
            'Mathematics',
            'Araling Panlipunan',
            'Physical Education',
            'ESP',
            'EPP',
            'TLE',
            'Music',
            'Arts',
            'Health',
        ];

        $studentNumber = $this->request->getPost('student_number');

        $gradeData = [];

        foreach ($subjects as $subject) {
            $gradeData[] = [
                'subject' => $subject,
                'student_id' => $studentNumber,
                'quarter' => 4,
                'grade' => 0
            ];
        }


        $model = new StudentModel();
        $gradeModel = new GradesModel();
        $model->insert($insertData);
        $gradeModel->insertBatch($gradeData);
        return redirect()->to('/student/list')->with('success', 'Student added successfully!');
    }

    public function deleteStudent($studentId)
    {
        $studentModel = new StudentModel();
        $gradesModel = new GradesModel();
        $gradesModel->where('student_id', $studentId)->delete();
        $studentModel->where('student_number', $studentId)->delete();

        return redirect()->to('/student/list')->with('success', 'Student and their grades deleted successfully!');
    }

    public function getGradesOfStudent($studentId)
    {
        $model = new StudentModel();
        $gradesModel = new GradesModel();

        $student = $model->where('student_number', $studentId)->first();
        $grades = $gradesModel->where('student_id', $studentId)->findAll();

        return $this->response->setJSON([
            'student' => $student,
            'grades' => $grades
        ]);
    }

    public function fetchStudentData($studentId){
        $model = new StudentModel();
        $student = $model->where('student_number', $studentId)->first();

        return $this->response->setJSON($student);
    }

    public function editStudent(){
        $studentNumber = $this->request->getPost('student_number');
        $model = new StudentModel();
        $student = $model->where('student_number', $studentNumber)->first();
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }
        $model->update($student['student_id'], [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'student_number' => $this->request->getPost('student_number'),
            'grade_level' => $this->request->getPost('grade_level'),
            'section' => $this->request->getPost('section'),
            'gender' => $this->request->getPost('gender'),
            'age' => $this->request->getPost('age'),
            'email_address' => $this->request->getPost('email_address'),
            'contact_number' => $this->request->getPost('contact_number'),
            'address' => $this->request->getPost('address'),
        ]);

        return redirect()->to('/student/list')->with('success', 'Student updated successfully!');
    }
        

}