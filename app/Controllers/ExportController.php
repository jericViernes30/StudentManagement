<?php 
namespace App\Controllers;
use App\Models\StudentModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends BaseController{

    public function exportToExcel()
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
            'subject' => $row['subject'],
            'grade'   => $row['grade'],
        ];
    }


    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Student Number');
    $sheet->setCellValue('B1', 'Full Name');

    $allSubjects = [];
    foreach ($students as $data) {
        foreach ($data['grades'] as $grade) {
            $allSubjects[$grade['subject']] = true;
        }
    }
    $subjects = array_keys($allSubjects);

    $col = 'C';
    foreach ($subjects as $subject) {
        $sheet->setCellValue($col . '1', $subject);
        $col++;
    }

    $rowNum = 2;
    foreach ($students as $studentData) {
        $sheet->setCellValue('A' . $rowNum, $studentData['student']['student_number']);
        $sheet->setCellValue('B' . $rowNum, $studentData['student']['last_name'] . ', ' . $studentData['student']['first_name']);
        $gradeMap = [];
        foreach ($studentData['grades'] as $grade) {
            $gradeMap[$grade['subject']] = $grade['grade'];
        }

        $col = 'C';
        foreach ($subjects as $subject) {
            $sheet->setCellValue($col . $rowNum, $gradeMap[$subject] ?? '');
            $col++;
        }

        $rowNum++;
    }
    $writer = new Xlsx($spreadsheet);
    $filename = 'students_grades.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=\"$filename\"");
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
}
}