<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <div id="overlay" class="hidden w-full h-screen absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-black opacity-80 z-10"></div>
    <div id="addModal" class="hidden w-1/2 h-[570px] rounded-tl-md rounded-tr-md absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#f0f0f0] z-20">
        <div class="w-full h-[7%] flex items-center justify-between bg-gray-800 rounded-tl-md rounded-tr-md py-2 px-5">
            <p>Add student</p>
            <button id="closeAddStudentModal">
                <i class="fa-regular fa-circle-xmark fa-sm" style="color: #e5e7eb;"></i>
            </button>
        </div>
        <div class="w-full p-5">
            <form action="add" method="POST" class="text-gray-800">
                <?= csrf_field() ?>
                <div class="w-full flex items-center gap-5 mb-4">
                    <div class="w-1/2">
                        <label for="">First name *</label>
                        <input type="text" name="first_name" id="first_name" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                    </div>
                    <div class="w-1/2">
                        <label for="">Last name *</label>
                        <input type="text" name="last_name" id="last_name" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                    </div>
                </div>
                <div class="w-full flex items-center gap-5 mb-5">
                    <div class="w-1/2">
                        <label for="">Student number *</label>
                        <input type="text" name="student_number" id="student_number" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                    </div>
                    <div class="w-1/2 flex items-center gap-5">
                        <div class="w-1/2 flex flex-col">
                            <label for="">Grade level *</label>
                            <select name="grade_level" id="grade_level" class="w-full border-gray-700 bg-white border rounded-md p-2 mt-1">
                                <option value="" selected disabled>Select grade level</option>
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                            </select>
                        </div>
                        <div class="w-1/2">
                            <label for="">Section *</label>
                            <select name="section" id="section" class="w-full border-gray-700 bg-white border rounded-md p-2 mt-1">
                                <option value="" selected disabled>Select section</option>
                                <option value="A">Section A</option>
                                <option value="B">Section B</option>
                                <option value="C">Section C</option>
                                <option value="D">Section D</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="w-full flex items-center gap-5 my-5">
                    <div class="w-1/2 flex flex-col">
                        <label for="">Gender</label>
                        <select name="gender" id="gender" class="w-full border-gray-700 bg-white border rounded-md p-2 mt-1">
                            <option value="" selected disabled>Select gender</option>
                            <option value="M">Male</option>
                            <option value="F">Feale</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="">Age</label>
                        <select name="age" id="age" class="w-full border-gray-700 bg-white border rounded-md p-2 mt-1">
                            <option value="" selected disabled>Select age</option>
                            <?php for ($age = 12; $age <= 30; $age++): ?>
                                <option value="<?= $age ?>"><?= $age ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="w-full flex items-center gap-5 mb-4">
                    <div class="w-1/2">
                        <label for="">Email address *</label>
                        <input type="email" name="email_address" id="email_address" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                    </div>
                    <div class="w-1/2">
                        <label for="">Contact number *</label>
                        <input type="text" name="contact_number" id="contact_number" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                    </div>
                </div>
                <div class="w-full">
                    <label for="">Address *</label>
                    <input type="text" name="address" id="address" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                </div>
                <div class="w-full flex items-center justify-center gap-5 mt-5">
                    <button class="w-32 bg-blue-600 text-sm rounded-sm py-2 text-white font-medium">Add</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editModal" class="hidden w-1/2 h-[570px] rounded-tl-md rounded-tr-md absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#f0f0f0] z-20">
        <div class="w-full h-[7%] flex items-center justify-between bg-gray-800 rounded-tl-md rounded-tr-md py-2 px-5">
            <p>Edit student info</p>
            <button id="closeAddStudentModal">
                <i class="fa-regular fa-circle-xmark fa-sm" style="color: #e5e7eb;"></i>
            </button>
        </div>
        <div class="w-full p-5 h-[93%] overflow-hidden">
            <div id="loader" class="hidden w-full flex items-center justify-center h-full">
                <span class="loader"></span>
            </div>
            <form id="editStudentForm" action="edit" method="POST" class="text-gray-800 hidden">
                <?= csrf_field() ?>
                <div class="w-full flex items-center gap-5 mb-4">
                    <div class="w-1/2">
                        <label for="">First name *</label>
                        <input type="text" name="first_name" id="first_name_edit" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                    </div>
                    <div class="w-1/2">
                        <label for="">Last name *</label>
                        <input type="text" name="last_name" id="last_name_edit" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                    </div>
                </div>
                <div class="w-full flex items-center gap-5 mb-5">
                    <div class="w-1/2">
                        <label for="">Student number *</label>
                        <input type="text" name="student_number" id="student_number_edit" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                    </div>
                    <div class="w-1/2 flex items-center gap-5">
                        <div class="w-1/2 flex flex-col">
                            <label for="">Grade level *</label>
                            <select name="grade_level" id="grade_level_edit" class="w-full border-gray-700 bg-white border rounded-md p-2 mt-1">
                                <option value="" selected disabled>Select grade level</option>
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                            </select>
                        </div>
                        <div class="w-1/2">
                            <label for="">Section *</label>
                            <select name="section" id="section_edit" class="w-full border-gray-700 bg-white border rounded-md p-2 mt-1">
                                <option value="" selected disabled>Select section</option>
                                <option value="A">Section A</option>
                                <option value="B">Section B</option>
                                <option value="C">Section C</option>
                                <option value="D">Section D</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="w-full flex items-center gap-5 my-5">
                    <div class="w-1/2 flex flex-col">
                        <label for="">Gender</label>
                        <select name="gender" id="gender_edit" class="w-full border-gray-700 bg-white border rounded-md p-2 mt-1">
                            <option value="" selected disabled>Select gender</option>
                            <option value="M">Male</option>
                            <option value="F">Feale</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="">Age</label>
                        <select name="age" id="age_edit" class="w-full border-gray-700 bg-white border rounded-md p-2 mt-1">
                            <option value="" selected disabled>Select age</option>
                            <?php for ($age = 12; $age <= 30; $age++): ?>
                                <option value="<?= $age ?>"><?= $age ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="w-full flex items-center gap-5 mb-4">
                    <div class="w-1/2">
                        <label for="">Email address *</label>
                        <input type="email" name="email_address" id="email_address_edit" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                    </div>
                    <div class="w-1/2">
                        <label for="">Contact number *</label>
                        <input type="text" name="contact_number" id="contact_number_edit" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                    </div>
                </div>
                <div class="w-full">
                    <label for="">Address *</label>
                    <input type="text" name="address" id="address_edit" class="border-gray-700 bg-white border rounded-md p-2 mt-1 w-full">
                </div>
                <div class="w-full flex items-center justify-center gap-5 mt-5">
                    <button type="submit" class="w-32 bg-blue-600 text-sm rounded-sm py-2 text-white font-medium">Update</button>
                </div>
            </form>
        </div>
    </div>

    <h1 class="text-gray-900 text-2xl font-semibold pt-8 px-4 text-center mb-10">Students list</h1>

    <div class="w-1/2 mb-2">
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
    </div>
    <div class="w-full flex justify-end mb-2">
        <button id="openAddStudentModal" class="bg-blue-600 px-6 py-1 rounded-sm text-sm text-white">Add new</button>
    </div>
    
    <div class="w-full p-2 relative z-0">
        <div class="sticky top-0 w-full flex text-gray-700 bg-gray-200 p-2 rounded-tr-md rounded-tl-md">
            <p class="w-[10%] font-medium">Student number</p>
            <p class="w-[15%] font-medium">First name</p>
            <p class="w-[15%] font-medium">Last name</p>
            <p class="w-[7%] font-medium">Grade</p>
            <p class="w-[7%] font-medium">Section</p>
            <p class="w-[7%] font-medium">Gender</p>
            <p class="w-[5%] font-medium">Age</p>
            <p class="w-[17%] font-medium">Email address</p>
            <p class="w-[10%] font-medium">Contact number</p>
            <p class="w-[7%] font-medium text-center">Actions</p>
        </div>
        <?php foreach($students as $student): ?>
            <div id="<?= esc($student['student_number']) ?>" class="chart-list w-full flex text-gray-800 px-2 py-3 border-b-2 border-gray-200">
                <p class="w-[10%] font-medium"><?= esc($student['student_number']) ?></p>
                <p class="w-[15%]"><?= esc($student['first_name']) ?></p>
                <p class="w-[15%]"><?= esc($student['last_name']) ?></p>
                <p class="w-[7%]"><?= esc($student['grade_level']) ?></p>
                <p class="w-[7%]"><?= esc($student['section']) ?></p>
                <p class="w-[7%]"><?= esc($student['gender']) ?></p>
                <p class="w-[5%]"><?= esc($student['age']) ?></p>
                <p class="w-[17%]"><?= esc($student['email_address']) ?></p>
                <p class="w-[10%]"><?= esc($student['contact_number']) ?></p>
                <div class="w-[7%]">
                    <div class="w-full flex items-center justify-center gap-2">
                        <button id="viewGrades" data-val="<?= $student['student_number'] ?>"><i class="fa-regular fa-eye fa-sm" style="color: #bed416;"></i></button>
                        <button id="editStudentInfo" data-val="<?= $student['student_number'] ?>"><i class="fa-regular fa-pen-to-square fa-sm" style="color: #184ba5;"></i></button>
                        <button onclick="confirmDeletion('<?= $student['student_number'] ?>')">
                            <i class="fa-regular fa-trash-can fa-sm" style="color: #a92323;"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div id="gradesChartContainer" class="w-full hidden">
            <div class="w-full h-[400px] text-gray-700 bg-gray-200 border-b-2 border-gray-700 p-2">
                <canvas id="gradesChart"></canvas>
            </div>
        </div>
    </div>
    
<?= $this->endSection() ?>
