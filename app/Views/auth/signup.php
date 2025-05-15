<?= $this->extend('layouts/main') ?>

<?= $this->section('flex-centered') ?>
<?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error mt-4 text-red-600 bg-red-100 px-4 py-2 rounded">
                <ul class="list-disc pl-5">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <div class="text-gray-800 w-full">
        <form action="<?= site_url('auth/register') ?>" method="post" class="p-10 w-full">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label for="" class="font-medium">Username</label>
                <input type="text" name="username" id="username" class="border-gray-300 bg-white border-2 rounded-md p-2 w-full">
            </div>
            <div class="mb-4">
                <label for="" class="font-medium">First name</label>
                <input type="text" name="first_name" id="first_name" class="border-gray-300 bg-white border-2 rounded-md p-2 w-full">
            </div>
            <div class="mb-4">
                <label for="" class="font-medium">Last name</label>
                <input type="text" name="last_name" id="last_name" class="border-gray-300 bg-white border-2 rounded-md p-2 w-full">
            </div>
            <div class="mb-4 relative">
                <button type="button" id="toggleEye" class="absolute right-3 top-[49%]">
                    <i id="eye" class="fa-solid fa-eye"></i>
                </button>
                <label for="" class="font-medium">Password</label>
                <input type="password" name="password" id="password" class="border-gray-300 bg-white border-2 rounded-md p-2 w-full">
            </div>
            <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 ease-in-out duration-200 text-gray-100 rounded-md p-2 mb-2">Create account</button>
            <a href="/login" class="px-2 text-center block mx-auto">Login</a>
        </form>
    </div>

<?= $this->endSection() ?>
