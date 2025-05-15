<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded p-6 w-[600px] max-w-full">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Edit Grades</h2>
        <form id="editGradeForm" method="POST" action="/student/update-grades">
            <input type="hidden" name="student_number" id="modalStudentNumber">
            <div id="gradesFields" class="grid grid-cols-2 gap-4"></div>
            <div class="flex justify-end mt-4">
                <button id="cancel" type="button" class="mr-2 px-4 py-2 bg-gray-300 rounded" onclick="closeModal()">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>


    <h1 class="text-gray-900 text-2xl font-semibold pt-8 px-4 text-center mb-5">Students Grade</h1>
    <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error mt-4 text-red-600 bg-red-100 px-4 py-2 rounded">
                <ul class="list-disc pl-5">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success mt-4">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <button onclick="window.location.href='/student/export'" class="bg-blue-600 text-white rounded-sm text-sm py-2 px-6">Export Grades</button>
    <div class="w-full h-[500px] p-2 relative overflow-y-auto z-0">
        <div class="sticky top-0 w-full flex text-gray-700 bg-gray-200 p-2 rounded-tr-md rounded-tl-md">
            <p class="w-[20%] font-medium">Name</p>
            <div class="w-[80%] overflow-x-auto">
                <div class="flex w-[1000px] justify-between text-xs text-center">
                    <p class="w-[10%] font-medium">Filipino</p>
                    <p class="w-[10%] font-medium">English</p>
                    <p class="w-[10%] font-medium">Science</p>
                    <p class="w-[10%] font-medium">Mathematics</p>
                    <p class="w-[10%] font-medium">Araling Panlipunan</p>
                    <p class="w-[10%] font-medium">Physical Education</p>
                    <p class="w-[10%] font-medium truncate overflow-hidden whitespace-nowrap">ESP</p>
                    <p class="w-[10%] font-medium truncate overflow-hidden whitespace-nowrap">EPP</p>
                    <p class="w-[10%] font-medium truncate overflow-hidden whitespace-nowrap">TLE</p>
                    <p class="w-[10%] font-medium">Music</p>
                    <p class="w-[10%] font-medium">Arts</p>
                    <p class="w-[10%] font-medium">Health</p>
                </div>
            </div>
        </div>

        <?php foreach($students as $studentData): ?>
    <?php
        $student = $studentData['student'];
        $grades = $studentData['grades'];
        $fullName = $student['last_name'] . ', ' . $student['first_name'];
        $studentJson = htmlspecialchars(json_encode($studentData), ENT_QUOTES, 'UTF-8');
    ?>
    <div class="gradeDiv w-full flex text-gray-800 px-2 py-3 border-b-2 hover:bg-gray-100 cursor-pointer"
        data-student='<?= $studentJson ?>'>
        <p class="w-[20%] font-medium text-sm"><?= esc($fullName) ?></p>
        <div class="w-[80%] overflow-x-auto">
            <div class="flex min-w-[1000px] justify-evenly text-sm text-center">
                <?php foreach($grades as $grade): ?>
                    <?php
                        $gradeValue = (int) $grade['grade'];
                        // Set the class based on the grade value
                        if ($gradeValue >= 80) {
                            $gradeClass = 'text-green-500';
                        } elseif ($gradeValue >= 75) {
                            $gradeClass = 'text-orange-500';
                        } else {
                            $gradeClass = 'text-red-500';
                        }
                    ?>
                    <p class="w-[10%] font-medium truncate <?= $gradeClass ?>"><?= esc($grade['grade']) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>


        
        
    </div>
<?= $this->endSection() ?>
