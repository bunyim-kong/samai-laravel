<?php $__env->startSection('title', 'Dashboard - Samai Admin'); ?>

<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('page-description', 'Overview of provinces, venues and gallery images'); ?>

<?php $__env->startSection('content'); ?>

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 mb-8">

    <div class="bg-white rounded-2xl border border-[#e4ddd5] p-6 shadow-sm">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500 font-medium">
                    Country Sides
                </p>

                <h3 class="text-3xl font-bold mt-2 text-[#2d241c]">
                    <?php echo e($countrySideCount); ?>

                </h3>
            </div>

            <div class="w-13 h-13 rounded-2xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center">
                <i class="fa-solid fa-map text-xl"></i>
            </div>

        </div>

        <a
            href="<?php echo e(route('admin.country-sides.index')); ?>"
            class="inline-flex items-center gap-2 mt-5 text-sm font-semibold text-[#9d7a54] hover:text-[#765738]"
        >
            Manage country sides
            <i class="fa-solid fa-arrow-right text-xs"></i>
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-[#e4ddd5] p-6 shadow-sm">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500 font-medium">
                    Total Areas
                </p>

                <h3 class="text-3xl font-bold mt-2 text-[#2d241c]">
                    <?php echo e($areaCount); ?>

                </h3>
            </div>

            <div class="w-13 h-13 rounded-2xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center">
                <i class="fa-solid fa-location-dot text-xl"></i>
            </div>

        </div>

        <a
            href="<?php echo e(route('admin.areas.index')); ?>"
            class="inline-flex items-center gap-2 mt-5 text-sm font-semibold text-[#9d7a54] hover:text-[#765738]"
        >
            Manage areas
            <i class="fa-solid fa-arrow-right text-xs"></i>
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-[#e4ddd5] p-6 shadow-sm">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-gray-500 font-medium">
                    Gallery Images
                </p>

                <h3 class="text-3xl font-bold mt-2 text-[#2d241c]">
                    <?php echo e($imageCount); ?>

                </h3>
            </div>

            <div class="w-13 h-13 rounded-2xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center">
                <i class="fa-solid fa-images text-xl"></i>
            </div>

        </div>

        <p class="mt-5 text-sm text-gray-500">
            Images uploaded for venue galleries
        </p>
    </div>

</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <div class="xl:col-span-2 bg-white rounded-2xl border border-[#e4ddd5] shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-[#eee7df] flex items-center justify-between">

            <div>
                <h3 class="font-bold text-lg">
                    Latest Areas
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Recently added venues
                </p>
            </div>

            <a
                href="<?php echo e(route('admin.areas.index')); ?>"
                class="text-sm font-semibold text-[#9d7a54] hover:text-[#765738]"
            >
                View all
            </a>

        </div>

        <?php if($latestAreas->isEmpty()): ?>

            <div class="px-6 py-14 text-center">

                <div class="w-16 h-16 rounded-full bg-[#f1e7dc] text-[#9d7a54] mx-auto flex items-center justify-center">
                    <i class="fa-solid fa-location-dot text-2xl"></i>
                </div>

                <h4 class="font-semibold mt-4">
                    No areas added yet
                </h4>

                <p class="text-sm text-gray-500 mt-2">
                    Add your first venue to display it on the map.
                </p>

                <a
                    href="<?php echo e(route('admin.areas.create')); ?>"
                    class="inline-flex items-center gap-2 mt-5 bg-[#b7936e] hover:bg-[#a5825e] text-[#2d241c] px-4 py-2.5 rounded-xl text-sm font-semibold"
                >
                    <i class="fa-solid fa-plus"></i>
                    Add Area
                </a>

            </div>

        <?php else: ?>

            <div class="overflow-x-auto">
                <table class="w-full">

                    <thead class="bg-[#faf8f5] text-left">
                        <tr class="text-xs uppercase tracking-wide text-gray-500">
                            <th class="px-6 py-4 font-semibold">Area</th>
                            <th class="px-6 py-4 font-semibold">Country Side</th>
                            <th class="px-6 py-4 font-semibold">Coordinates</th>
                            <th class="px-6 py-4 font-semibold text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#eee7df]">

                        <?php $__currentLoopData = $latestAreas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-[#faf8f5]">

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">

                                        <?php if($area->image_url): ?>
                                            <img
                                                src="<?php echo e($area->image_url); ?>"
                                                alt="<?php echo e($area->title); ?>"
                                                class="w-11 h-11 rounded-xl object-cover"
                                            >
                                        <?php else: ?>
                                            <div class="w-11 h-11 rounded-xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center">
                                                <i class="fa-solid fa-image"></i>
                                            </div>
                                        <?php endif; ?>

                                        <div>
                                            <p class="font-semibold text-sm">
                                                <?php echo e($area->title); ?>

                                            </p>

                                            <p class="text-xs text-gray-500 mt-1">
                                                <?php echo e($area->created_at?->format('d M Y')); ?>

                                            </p>
                                        </div>

                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?php echo e($area->countrySide?->name ?? 'Not assigned'); ?>

                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?php if($area->lat && $area->lng): ?>
                                        <?php echo e($area->lat); ?>, <?php echo e($area->lng); ?>

                                    <?php else: ?>
                                        <span class="text-gray-400">
                                            Not provided
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a
                                        href="<?php echo e(route('admin.areas.edit', $area)); ?>"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#f1e7dc] text-[#9d7a54] hover:bg-[#b7936e] hover:text-[#2d241c]"
                                    >
                                        <i class="fa-solid fa-pen text-sm"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>

                </table>
            </div>

        <?php endif; ?>

    </div>

    <div class="bg-white rounded-2xl border border-[#e4ddd5] shadow-sm">

        <div class="px-6 py-5 border-b border-[#eee7df]">

            <h3 class="font-bold text-lg">
                Country Sides
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Areas inside each province
            </p>

        </div>

        <div class="p-5 space-y-3">

            <?php $__empty_1 = true; $__currentLoopData = $countrySides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrySide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <div class="flex items-center justify-between px-4 py-3 rounded-xl bg-[#faf8f5]">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-[#f1e7dc] text-[#9d7a54] flex items-center justify-center">
                            <i class="fa-solid fa-map-pin"></i>
                        </div>

                        <div>
                            <p class="font-semibold text-sm">
                                <?php echo e($countrySide->name); ?>

                            </p>

                            <p class="text-xs text-gray-500">
                                <?php echo e($countrySide->slug); ?>

                            </p>
                        </div>

                    </div>

                    <span class="min-w-9 h-9 px-2 rounded-lg bg-white border border-[#e4ddd5] flex items-center justify-center text-sm font-bold">
                        <?php echo e($countrySide->areas_count); ?>

                    </span>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <div class="py-10 text-center">

                    <i class="fa-solid fa-map text-3xl text-[#b7936e]"></i>

                    <p class="text-sm text-gray-500 mt-3">
                        No country sides found.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/kong-bunyim/Documents/projects/samai-laravel/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>