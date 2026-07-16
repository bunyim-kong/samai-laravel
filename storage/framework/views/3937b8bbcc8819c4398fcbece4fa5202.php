<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="lg:col-span-2">
        <label
            for="country_side_id"
            class="block text-sm font-semibold mb-2"
        >
            Country Side
        </label>

        <select
            id="country_side_id"
            name="country_side_id"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 bg-white outline-none focus:border-[#b7936e]"
            required
        >
            <option value="">Select country side</option>

            <?php $__currentLoopData = $countrySides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrySideOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                    value="<?php echo e($countrySideOption->id); ?>"
                    <?php if(
                        old(
                            'country_side_id',
                            $area->country_side_id ?? request('country_side_id')
                        ) == $countrySideOption->id
                    ): echo 'selected'; endif; ?>
                >
                    <?php echo e($countrySideOption->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <?php $__errorArgs = ['country_side_id'];
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

    <div class="lg:col-span-2">
        <label
            for="title"
            class="block text-sm font-semibold mb-2"
        >
            Title
        </label>

        <input
            type="text"
            id="title"
            name="title"
            value="<?php echo e(old('title', $area->title ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="Samai Distillery"
            required
        >

        <?php $__errorArgs = ['title'];
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

    <div class="lg:col-span-2">
        <label
            for="slug"
            class="block text-sm font-semibold mb-2"
        >
            Slug
        </label>

        <input
            type="text"
            id="slug"
            name="slug"
            value="<?php echo e(old('slug', $area->slug ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="samai-distillery"
            required
        >

        <p class="text-xs text-gray-500 mt-2">
            Use lowercase letters, numbers, and hyphens.
        </p>

        <?php $__errorArgs = ['slug'];
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
            for="lat"
            class="block text-sm font-semibold mb-2"
        >
            Latitude
        </label>

        <input
            type="number"
            step="0.0000001"
            id="lat"
            name="lat"
            value="<?php echo e(old('lat', $area->lat ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="11.5564000"
        >

        <?php $__errorArgs = ['lat'];
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
            for="lng"
            class="block text-sm font-semibold mb-2"
        >
            Longitude
        </label>

        <input
            type="number"
            step="0.0000001"
            id="lng"
            name="lng"
            value="<?php echo e(old('lng', $area->lng ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="104.9282000"
        >

        <?php $__errorArgs = ['lng'];
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

    <div class="lg:col-span-2">
        <label
            for="google_map_url"
            class="block text-sm font-semibold mb-2"
        >
            Google Maps URL
        </label>

        <input
            type="url"
            id="google_map_url"
            name="google_map_url"
            value="<?php echo e(old('google_map_url', $area->google_map_url ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
            placeholder="https://maps.google.com/..."
        >

        <?php $__errorArgs = ['google_map_url'];
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

    <div class="lg:col-span-2">
        <div class="mb-4">
            <h3 class="text-lg font-bold">
                Venue Photos
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Upload up to five photos. Photo 1 appears first in the slider.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4">
            <?php for($index = 0; $index < 5; $index++): ?>
                <?php
                    $existingImage = isset($area)
                        ? $area->images
                            ->firstWhere('sort_order', $index)
                        : null;
                ?>

                <div class="rounded-2xl border border-[#d9d1c8] bg-[#faf8f5] p-4">
                    <label
                        for="photos_<?php echo e($index); ?>"
                        class="block text-sm font-semibold mb-3"
                    >
                        Photo <?php echo e($index + 1); ?>

                    </label>

                    <div
                        class="w-full aspect-square rounded-xl overflow-hidden bg-white border border-[#e4ddd5] flex items-center justify-center mb-3"
                    >
                        <img
                            id="previewImage<?php echo e($index); ?>"
                            src="<?php echo e($existingImage?->image_url ?? ''); ?>"
                            alt="Photo <?php echo e($index + 1); ?>"
                            class="<?php echo e($existingImage ? '' : 'hidden'); ?> w-full h-full object-cover"
                        >

                        <div
                            id="previewPlaceholder<?php echo e($index); ?>"
                            class="<?php echo e($existingImage ? 'hidden' : ''); ?> text-center text-gray-400 px-3"
                        >
                            <i class="fa-solid fa-image text-2xl"></i>

                            <p class="text-xs mt-2">
                                No photo
                            </p>
                        </div>
                    </div>

                    <input
                        type="file"
                        id="photos_<?php echo e($index); ?>"
                        name="photos[<?php echo e($index); ?>]"
                        accept="image/jpeg,image/png,image/webp"
                        class="block w-full text-xs"
                        data-preview-index="<?php echo e($index); ?>"
                    >

                    <?php if($existingImage): ?>
                        <label class="flex items-center gap-2 mt-3 text-sm text-red-600 cursor-pointer">
                            <input
                                type="checkbox"
                                name="remove_photos[]"
                                value="<?php echo e($existingImage->id); ?>"
                            >

                            Remove photo
                        </label>
                    <?php endif; ?>

                    <?php $__errorArgs = ["photos.$index"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs text-red-600 mt-2">
                            <?php echo e($message); ?>

                        </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            <?php endfor; ?>
        </div>

        <?php $__errorArgs = ['photos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-sm text-red-600 mt-3">
                <?php echo e($message); ?>

            </p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="lg:col-span-2">
        <label
            for="address"
            class="block text-sm font-semibold mb-2"
        >
            Address
        </label>

        <input
            type="text"
            id="address"
            name="address"
            value="<?php echo e(old('address', $area->address ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

        <?php $__errorArgs = ['address'];
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

    <div class="lg:col-span-2">
        <label
            for="open_hours"
            class="block text-sm font-semibold mb-2"
        >
            Opening Hours
        </label>

        <textarea
            id="open_hours"
            name="open_hours"
            rows="3"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        ><?php echo e(old('open_hours', $area->open_hours ?? '')); ?></textarea>

        <?php $__errorArgs = ['open_hours'];
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

    <div class="lg:col-span-2">
        <label
            for="description"
            class="block text-sm font-semibold mb-2"
        >
            Description
        </label>

        <textarea
            id="description"
            name="description"
            rows="5"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        ><?php echo e(old('description', $area->description ?? '')); ?></textarea>

        <?php $__errorArgs = ['description'];
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

    <div class="lg:col-span-2">
        <label
            for="serves"
            class="block text-sm font-semibold mb-2"
        >
            Samai Signature Serves
        </label>

        <textarea
            id="serves"
            name="serves"
            rows="3"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        ><?php echo e(old('serves', $area->serves ?? '')); ?></textarea>

        <?php $__errorArgs = ['serves'];
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
            for="phone"
            class="block text-sm font-semibold mb-2"
        >
            Phone
        </label>

        <input
            type="text"
            id="phone"
            name="phone"
            value="<?php echo e(old('phone', $area->phone ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

        <?php $__errorArgs = ['phone'];
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
            for="email"
            class="block text-sm font-semibold mb-2"
        >
            Email
        </label>

        <input
            type="email"
            id="email"
            name="email"
            value="<?php echo e(old('email', $area->email ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

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
            for="facebook"
            class="block text-sm font-semibold mb-2"
        >
            Facebook URL
        </label>

        <input
            type="url"
            id="facebook"
            name="facebook"
            value="<?php echo e(old('facebook', $area->facebook ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

        <?php $__errorArgs = ['facebook'];
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
            for="instagram"
            class="block text-sm font-semibold mb-2"
        >
            Instagram URL
        </label>

        <input
            type="url"
            id="instagram"
            name="instagram"
            value="<?php echo e(old('instagram', $area->instagram ?? '')); ?>"
            class="w-full rounded-xl border border-[#d9d1c8] px-4 py-3 outline-none focus:border-[#b7936e]"
        >

        <?php $__errorArgs = ['instagram'];
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

    <div class="lg:col-span-2">
        <input
            type="hidden"
            name="is_active"
            value="0"
        >

        <label class="inline-flex items-center gap-3 cursor-pointer">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                <?php if(old('is_active', $area->is_active ?? true)): echo 'checked'; endif; ?>
                class="w-5 h-5 accent-[#b7936e]"
            >

            <span class="font-semibold">
                Active
            </span>
        </label>

        <p class="text-xs text-gray-500 mt-2">
            Inactive areas will not be displayed on the public map.
        </p>
    </div>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document
        .querySelectorAll('[data-preview-index]')
        .forEach(function (input) {
            input.addEventListener('change', function () {
                const index = this.dataset.previewIndex;
                const file = this.files[0];

                if (!file) {
                    return;
                }

                const previewImage = document.getElementById(
                    'previewImage' + index
                );

                const placeholder = document.getElementById(
                    'previewPlaceholder' + index
                );

                previewImage.src = URL.createObjectURL(file);
                previewImage.classList.remove('hidden');

                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            });
        });

    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function () {
            if (slugInput.dataset.edited === 'true') {
                return;
            }

            slugInput.value = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        });

        slugInput.addEventListener('input', function () {
            this.dataset.edited = 'true';

            this.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9-]/g, '');
        });
    }
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/kong-bunyim/Documents/projects/samai-laravel/resources/views/admin/areas/form.blade.php ENDPATH**/ ?>