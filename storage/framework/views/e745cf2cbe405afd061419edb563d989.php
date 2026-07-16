<?php $__env->startSection('title', 'Add Country Side - Samai Admin'); ?>
<?php $__env->startSection('page-title', 'Add Country Side'); ?>
<?php $__env->startSection('page-description', 'Create a province for the Cambodia map'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm p-6 sm:p-8">
        <form
            method="POST"
            action="<?php echo e(route('admin.country-sides.store')); ?>"
        >
            <?php echo csrf_field(); ?>

            <?php echo $__env->make('admin.country-sides.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-8 pt-6 border-t border-[#eee7df]">
                <a
                    href="<?php echo e(route('admin.country-sides.index')); ?>"
                    class="inline-flex justify-center items-center px-5 py-3 rounded-xl border border-[#d9d1c8] font-semibold text-sm hover:bg-[#f4f1ed]"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex justify-center items-center gap-2 bg-[#b7936e] hover:bg-[#a5825e] text-[#2d241c] px-5 py-3 rounded-xl font-semibold text-sm cursor-pointer"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Country Side
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/kong-bunyim/Documents/projects/samai-laravel/resources/views/admin/country-sides/create.blade.php ENDPATH**/ ?>