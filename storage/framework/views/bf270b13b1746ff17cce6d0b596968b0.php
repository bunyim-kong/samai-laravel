<?php $__env->startSection('title', 'Admin Login - Samai'); ?>

<?php $__env->startSection('content'); ?>
<div class="relative min-h-screen flex items-center justify-center px-4 py-4 overflow-hidden">

    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <img
            src="<?php echo e(asset('assets/images/bg-map.png')); ?>"
            alt=""
            class="w-full h-full object-contain opacity-10 scale-110"
        >
    </div>

    <div class="relative z-10 w-full max-w-md">

        <div class="text-center mb-5">
            <a href="<?php echo e(route('welcome')); ?>">
                <img
                    src="<?php echo e(asset('assets/images/samai-logo.png')); ?>"
                    alt="Samai"
                    class="w-32 sm:w-40 h-auto mx-auto object-contain"
                >
            </a>

            <p class="text-[#d7c2aa] text-sm mt-4">
                Rum Map Administration
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl p-6 sm:p-8">

            <div class="mb-7 flex flex-col items-center justify-center text-center">
                <h1 class="text-2xl font-bold text-[#2d241c]">
                    Welcome back
                </h1>

                <p class="text-sm text-gray-500 mt-2">
                    Sign in to manage provinces and venues.
                </p>
            </div>

            <?php if(session('success')): ?>
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    <div class="flex items-start gap-2">
                        <i class="fa-solid fa-circle-check mt-0.5"></i>

                        <span>
                            <?php echo e(session('success')); ?>

                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <form
                method="POST"
                action="<?php echo e(route('login.store')); ?>"
                class="space-y-5"
            >
                <?php echo csrf_field(); ?>

                <div>
                    <label
                        for="email"
                        class="block text-sm font-semibold mb-2"
                    >
                        Email Address
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-[#b7936e]"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?php echo e(old('email')); ?>"
                            autocomplete="email"
                            autofocus
                            required
                            class="w-full rounded-xl border border-[#d9d1c8] py-3 pl-11 pr-4 outline-none transition focus:border-[#b7936e] focus:ring-2 focus:ring-[#b7936e]/20"
                            placeholder="admin@samai.com"
                        >
                    </div>

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-sm text-red-600 mt-2">
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label
                        for="password"
                        class="block text-sm font-semibold mb-2"
                    >
                        Password
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-[#b7936e]"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            required
                            class="w-full rounded-xl border border-[#d9d1c8] py-3 pl-11 pr-12 outline-none transition focus:border-[#b7936e] focus:ring-2 focus:ring-[#b7936e]/20"
                            placeholder="Enter your password"
                        >

                        <button
                            type="button"
                            id="togglePassword"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#b7936e] cursor-pointer"
                            aria-label="Show or hide password"
                        >
                            <i
                                id="passwordIcon"
                                class="fa-solid fa-eye"
                            ></i>
                        </button>
                    </div>

                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-sm text-red-600 mt-2">
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        class="w-4 h-4 accent-[#b7936e]"
                        <?php if(old('remember')): echo 'checked'; endif; ?>
                    >

                    <span class="text-sm text-gray-600">
                        Remember me
                    </span>
                </label>

                <button
                    type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-[#b7936e] hover:bg-[#a5825e] px-5 py-3.5 text-[#2d241c] font-bold transition cursor-pointer"
                >
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Sign In
                </button>
            </form>

            <div class="mt-7 pt-5 border-t border-[#eee7df] text-center">
                <a
                    href="<?php echo e(route('landing')); ?>"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-[#9d7a54] hover:text-[#765738]"
                >
                    <i class="fa-solid fa-arrow-left"></i>
                    Return to website
                </a>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const passwordIcon = document.getElementById('passwordIcon');

    togglePassword.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';

        passwordIcon.classList.toggle('fa-eye', !isPassword);
        passwordIcon.classList.toggle('fa-eye-slash', isPassword);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/kong-bunyim/Documents/projects/samai-laravel/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>