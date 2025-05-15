<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div id="addSubjectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded p-6 w-[600px] max-w-full">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Add subject</h2>
        <form method="POST" action="/subject/add">
            <div >
                <label for="" class="text-gray-700">Subject name</label>
                <input type="text" name="subject_name" id="subject_name" class="w-full text-gray-800 bg-white rounded-md border-2 border-gray-400 px-4 py-2">
            </div>
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
    <button id="addNewSubject" class="bg-blue-600 text-white rounded-sm text-sm py-2 px-6 my-3">Add new Subject</button>
    <div class="w-full flex justify-evenly gap-2 p-2 z-0">
        <?php foreach($subjects as $subject): ?>
            <div class="w-1/5 h-[200px] bg-[#f0eeee] rounded-lg shadow-lg p-2 flex flex-col items-center">
                <div class="w-full h-1/4 flex items-center justify-center bg-gray-800 rounded-lg">
                    <p class="text-gray-200"><?= esc($subject['subject_code']) ?></p>
                </div>
                <div class="w-full h-3/4 flex items-center justify-center">
                    <h2 class="text-lg font-semibold text-gray-800"><?= esc($subject['subject_name']) ?></h2>
                </div>
            </div>

        <?php endforeach; ?>
        
    </div>
<?= $this->endSection() ?>
