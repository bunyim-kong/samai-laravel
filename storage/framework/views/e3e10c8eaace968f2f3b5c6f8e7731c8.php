<?php $__env->startSection('title', 'Country Sides - Samai Admin'); ?>
<?php $__env->startSection('page-title', 'Country Sides'); ?>
<?php $__env->startSection('page-description', 'Manage provinces shown on the Cambodia map'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h3 class="text-xl font-bold">All Country Sides</h3>
        <p class="text-sm text-gray-500 mt-1">
            <?php echo e($countrySides->total()); ?> records found
        </p>
    </div>

    <a
        href="<?php echo e(route('admin.country-sides.create')); ?>"
        class="inline-flex items-center justify-center gap-2 bg-[#b7936e] hover:bg-[#a5825e] text-[#2d241c] px-5 py-3 rounded-xl font-semibold text-sm transition"
    >
        <i class="fa-solid fa-plus"></i>
        Add Country Side
    </a>
</div>

<div class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm overflow-hidden">
    <?php if($countrySides->isEmpty()): ?>
        <div class="py-16 text-center">
            <div class="w-16 h-16 rounded-full bg-[#f1e7dc] text-[#9d7a54] mx-auto flex items-center justify-center">
                <i class="fa-solid fa-map text-2xl"></i>
            </div>

            <h4 class="font-semibold mt-4">No country sides found</h4>

            <p class="text-sm text-gray-500 mt-2">
                Create your first province.
            </p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px]">
                <thead class="bg-[#faf8f5]">
                    <tr class="text-left text-xs uppercase tracking-wide text-gray-500">
                        <th class="px-6 py-4 font-semibold">Name</th>
                        <th class="px-6 py-4 font-semibold">Map Center</th>
                        <th class="px-6 py-4 font-semibold">Zoom</th>
                        <th class="px-6 py-4 font-semibold">Position</th>
                        <th class="px-6 py-4 font-semibold">Areas</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#eee7df]">
                    <?php $__currentLoopData = $countrySides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrySide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-[#faf8f5]">
                            <td class="px-6 py-4">
                                <p class="font-semibold"><?php echo e($countrySide->name); ?></p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <?php echo e($countrySide->slug); ?>

                                </p>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                <?php if($countrySide->center_lat !== null && $countrySide->center_lng !== null): ?>
                                    <?php echo e($countrySide->center_lat); ?>,
                                    <?php echo e($countrySide->center_lng); ?>

                                <?php else: ?>
                                    <span class="text-gray-400">Not provided</span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                <?php echo e($countrySide->zoom); ?>

                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                <?php if($countrySide->position_top !== null && $countrySide->position_left !== null): ?>
                                    Top: <?php echo e($countrySide->position_top); ?>%
                                    <br>
                                    Left: <?php echo e($countrySide->position_left); ?>%
                                <?php else: ?>
                                    <span class="text-gray-400">Not provided</span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex min-w-9 h-9 px-3 items-center justify-center rounded-lg bg-[#f1e7dc] text-[#765738] font-bold text-sm">
                                    <?php echo e($countrySide->areas_count); ?>

                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="<?php echo e(route('admin.country-sides.show', $countrySide)); ?>"
                                        class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center"
                                        title="View"
                                    >
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>

                                    <a
                                        href="<?php echo e(route('admin.country-sides.edit', $countrySide)); ?>"
                                        class="w-9 h-9 rounded-lg bg-[#f1e7dc] text-[#9d7a54] hover:bg-[#e8d7c5] flex items-center justify-center"
                                        title="Edit"
                                    >
                                        <i class="fa-solid fa-pen text-sm"></i>
                                    </a>

                                    <form
                                        method="POST"
                                        action="<?php echo e(route('admin.country-sides.destroy', $countrySide)); ?>"
                                        onsubmit="return confirm('Delete this country side and all its areas?')"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            type="submit"
                                            class="w-9 h-9 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center cursor-pointer"
                                            title="Delete"
                                        >
                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <?php if($countrySides->hasPages()): ?>
            <div class="px-6 py-4 border-t border-[#eee7df]">
                <?php echo e($countrySides->links()); ?>

            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/kong-bunyim/Documents/projects/samai-laravel/resources/views/admin/country-sides/index.blade.php ENDPATH**/ ?>