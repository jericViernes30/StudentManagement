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


    <h1 class="text-gray-900 text-2xl font-semibold pt-8 px-4 text-center mb-5">Subjects List</h1>
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
    <button onclick="window.location.href='/student/export'" class="bg-blue-600 text-white rounded-sm text-sm py-2 px-6">Add new Subject</button>
    <div class="w-full h-[500px] p-2 relative overflow-y-auto z-0">
        
        
    </div>
<?= $this->endSection() ?>
