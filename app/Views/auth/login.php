<?= $this->extend('layouts/main') ?>

<?= $this->section('flex-centered') ?>

    <div class="text-gray-800 w-full">
        <div>
            <h1 class="text-2xl font-bold text-center text-white">Login</h1>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error mt-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
        </div>
        <form action="<?= site_url('auth/login') ?>" method="post" class="px-10 sm:px-0 py-3 w-full">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label for="" class="font-medium">Username</label>
                <input type="text" name="username" id="username" class="border-gray-300 bg-white border-2 rounded-md p-2 w-full">
            </div>
            <div class="mb-4 relative">
                <button type="button" id="toggleEye" class="absolute right-3 top-[49%]">
                    <i id="eye" class="fa-solid fa-eye"></i>
                </button>
                <label for="" class="font-medium">Password</label>
                <input type="password" name="password" id="password" class="border-gray-300 bg-white border-2 rounded-md p-2 w-full">
            </div>
            <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 ease-in-out duration-200 text-gray-100 rounded-md p-2 mb-2">Login</button>
            <a href="/register" class="px-2 text-center block mx-auto">Signup</a>
        </form>
    </div>

<?= $this->endSection() ?>
