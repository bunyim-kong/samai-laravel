<?php $__env->startSection('title', 'Areas - Samai Admin'); ?>
<?php $__env->startSection('page-title', 'Areas'); ?>
<?php $__env->startSection('page-description', 'Manage venues and map locations'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h3 class="text-xl font-bold">All Areas</h3>
        <p class="text-sm text-gray-500 mt-1">
            <?php echo e($areas->total()); ?> records found
        </p>
    </div>

    <a
        href="<?php echo e(route('admin.areas.create')); ?>"
        class="inline-flex items-center justify-center gap-2 bg-[#b7936e] hover:bg-[#a5825e] text-[#2d241c] px-5 py-3 rounded-xl font-semibold text-sm"
    >
        <i class="fa-solid fa-plus"></i>
        Add Area
    </a>
</div>

<div class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm overflow-hidden">
    <?php if($areas->isEmpty()): ?>
        <div class="py-16 text-center">
            <i class="fa-solid fa-location-dot text-4xl text-[#b7936e]"></i>
            <h4 class="font-semibold mt-4">No areas found</h4>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[950px]">
                <thead class="bg-[#faf8f5]">
                    <tr class="text-left text-xs uppercase tracking-wide text-gray-500">
                        <th class="px-6 py-4 font-semibold">Area</th>
                        <th class="px-6 py-4 font-semibold">Country Side</th>
                        <th class="px-6 py-4 font-semibold">Coordinates</th>
                        <th class="px-6 py-4 font-semibold">Contact</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#eee7df]">
                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-[#faf8f5]">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <?php if($area->image_url): ?>
                                        <img
                                            src="<?php echo e($area->image_url); ?>"
                                            alt="<?php echo e($area->title); ?>"
                                            class="w-12 h-12 rounded-xl object-cover"
                                        >
                                    <?php else: ?>
                                        <div class="w-12 h-12 rounded-xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    <?php endif; ?>

                                    <div>
                                        <p class="font-semibold"><?php echo e($area->title); ?></p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            <?php echo e($area->address ?: 'No address'); ?>

                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                <?php echo e($area->countrySide?->name ?? 'Not assigned'); ?>

                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                <?php if($area->lat !== null && $area->lng !== null): ?>
                                    <?php echo e($area->lat); ?>,
                                    <?php echo e($area->lng); ?>

                                <?php else: ?>
                                    <span class="text-gray-400">Not provided</span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                <?php echo e($area->phone ?: '—'); ?>

                                <br>
                                <?php echo e($area->email ?: '—'); ?>

                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a
                                        href="<?php echo e(route('admin.areas.show', $area)); ?>"
                                        class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center"
                                    >
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>

                                    <a
                                        href="<?php echo e(route('admin.areas.edit', $area)); ?>"
                                        class="w-9 h-9 rounded-lg bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center"
                                    >
                                        <i class="fa-solid fa-pen text-sm"></i>
                                    </a>

                                    <form
                                        method="POST"
                                        action="<?php echo e(route('admin.areas.destroy', $area)); ?>"
                                        onsubmit="return confirm('Delete this area?')"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            type="submit"
                                            class="w-9 h-9 rounded-lg bg-red-50 text-red-600 flex items-center justify-center cursor-pointer"
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

        <?php if($areas->hasPages()): ?>
            <div class="px-6 py-4 border-t border-[#eee7df]">
                <?php echo e($areas->links()); ?>

            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/kong-bunyim/Documents/projects/samai-laravel/resources/views/admin/areas/index.blade.php ENDPATH**/ ?>