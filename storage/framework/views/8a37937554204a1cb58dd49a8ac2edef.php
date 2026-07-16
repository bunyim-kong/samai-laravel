<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="lg:col-span-2">
        <label for="name" class="block text-sm font-semibold mb-2">
            Name
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="<?php echo e(old('name', $countrySide->name ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="Phnom Penh"
            required
        >

        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="lg:col-span-2">
        <label for="slug" class="block text-sm font-semibold mb-2">
            Slug
        </label>

        <input
            type="text"
            id="slug"
            name="slug"
            value="<?php echo e(old('slug', $countrySide->slug ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="phnom-penh"
            required
        >

        <p class="text-xs text-gray-500 mt-2">
            Use lowercase letters and hyphens.
        </p>

        <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label for="center_lat" class="block text-sm font-semibold mb-2">
            Center Latitude
        </label>

        <input
            type="number"
            step="0.0000001"
            id="center_lat"
            name="center_lat"
            value="<?php echo e(old('center_lat', $countrySide->center_lat ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="11.5564000"
        >

        <?php $__errorArgs = ['center_lat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label for="center_lng" class="block text-sm font-semibold mb-2">
            Center Longitude
        </label>

        <input
            type="number"
            step="0.0000001"
            id="center_lng"
            name="center_lng"
            value="<?php echo e(old('center_lng', $countrySide->center_lng ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="104.9282000"
        >

        <?php $__errorArgs = ['center_lng'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label for="zoom" class="block text-sm font-semibold mb-2">
            Zoom Level
        </label>

        <input
            type="number"
            id="zoom"
            name="zoom"
            min="1"
            max="20"
            value="<?php echo e(old('zoom', $countrySide->zoom ?? 10)); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            required
        >

        <?php $__errorArgs = ['zoom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div></div>

    <div>
        <label for="position_top" class="block text-sm font-semibold mb-2">
            Position Top (%)
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            max="100"
            id="position_top"
            name="position_top"
            value="<?php echo e(old('position_top', $countrySide->position_top ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="60"
        >

        <?php $__errorArgs = ['position_top'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label for="position_left" class="block text-sm font-semibold mb-2">
            Position Left (%)
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            max="100"
            id="position_left"
            name="position_left"
            value="<?php echo e(old('position_left', $countrySide->position_left ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="49"
        >

        <?php $__errorArgs = ['position_left'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div><?php /**PATH /home/kong-bunyim/Documents/projects/samai-laravel/resources/views/admin/country-sides/form.blade.php ENDPATH**/ ?>