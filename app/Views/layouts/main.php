<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url('src/output.css') ?>" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo base_url('js/auth_jquery.js') ?>"></script>
    <script src="https://kit.fontawesome.com/5bf9be4e76.js" crossorigin="anonymous"></script>
    <title>Student Management</title>
    <style>
        .loader {
        width: 58px;
        height: 58px;
        display: inline-block;
        position: relative;
        }
        .loader::after,
        .loader::before {
        content: '';  
        box-sizing: border-box;
        width: 58px;
        height: 58px;
        border-radius: 50%;
        border: 4px solid #1f2937;
        position: absolute;
        left: 0;
        top: 0;
        animation: animloader 2s linear infinite;
        }
        .loader::after {
        animation-delay: 1s;
        }

        @keyframes animloader {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(1);
            opacity: 0;
        }
        }
    </style>
</head>
<body class="w-full bg-white h-screen">
    <?php if (session()->has('isLoggedIn')): ?>
        <div class="w-full sticky top-0 z-10">
            <?= view('navigation') ?>
        </div>

        <div class="px-5 lg:px-24 h-full bg-white">
            <?= $this->renderSection('content') ?>
        </div>
    <?php endif; ?>

    <?php if (!session()->has('isLoggedIn')): ?>
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full sm:w-1/2 lg:w-1/3 2xl:w-1/4">
                <?= $this->renderSection('flex-centered') ?>
            </div>
        </div>
    <?php endif; ?>
    

</body>
</html>
