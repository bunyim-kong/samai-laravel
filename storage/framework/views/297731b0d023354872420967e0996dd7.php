<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="<?php echo e(csrf_token()); ?>"
    >

    <title><?php echo $__env->yieldContent('title', 'Samai Admin Login'); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="min-h-screen bg-[#3a3942] text-[#2d241c]">
    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH /home/kong-bunyim/Documents/projects/samai-laravel/resources/views/layouts/guest.blade.php ENDPATH**/ ?>