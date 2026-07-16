<?php
    $sliderImages = $area->images
        ->filter(function ($image) {
            return !empty($image->image_path);
        })
        ->sortBy('sort_order')
        ->values();
?>

<div class="venue-card">
    <div class="venue-header">
        <h2 class="venue-title">
            <?php echo e($area->title); ?>

        </h2>

        <button
            type="button"
            class="venue-close-btn"
            data-close-venue-card
            aria-label="Close venue details"
        >
            <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <line
                    x1="18"
                    y1="6"
                    x2="6"
                    y2="18"
                ></line>

                <line
                    x1="6"
                    y1="6"
                    x2="18"
                    y2="18"
                ></line>
            </svg>
        </button>
    </div>

    <?php if($sliderImages->isNotEmpty()): ?>
        <div class="slider-container">
            <?php if($sliderImages->count() > 1): ?>
                <button
                    id="prev"
                    type="button"
                    class="slider-nav slider-prev"
                    aria-label="Previous image"
                >
                    <i class="fa-solid fa-angle-left"></i>
                </button>
            <?php endif; ?>

            <div id="slider" class="slider-wrapper">
                <?php $__currentLoopData = $sliderImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img
                        src="<?php echo e('/storage/' . ltrim($image->image_path, '/')); ?>"
                        alt="<?php echo e($area->title); ?> photo <?php echo e($loop->iteration); ?>"
                    >
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($sliderImages->count() > 1): ?>
                <button
                    id="next"
                    type="button"
                    class="slider-nav slider-next"
                    aria-label="Next image"
                >
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="no-venue-photo">
            <i class="fa-solid fa-image"></i>

            <span>
                No photos uploaded
            </span>
        </div>
    <?php endif; ?>

    <div class="venue-content">
        <?php if($area->address): ?>
            <div class="venue-info-group">
                <span class="venue-label">
                    Address
                </span>

                <p class="venue-text">
                    <?php echo e($area->address); ?>

                </p>
            </div>
        <?php endif; ?>

        <?php if($area->open_hours): ?>
            <div class="venue-info-group">
                <span class="venue-label">
                    Opening Hours
                </span>

                <p class="venue-text">
                    <?php echo nl2br(e($area->open_hours)); ?>

                </p>
            </div>
        <?php endif; ?>

        <?php if($area->description): ?>
            <div class="venue-info-group">
                <span class="venue-label">
                    Description
                </span>

                <p class="venue-text venue-description">
                    <?php echo nl2br(e($area->description)); ?>

                </p>
            </div>
        <?php endif; ?>

        <?php if($area->serves): ?>
            <div class="venue-info-group">
                <span class="venue-label">
                    Samai Signature Serves
                </span>

                <p class="venue-text">
                    <?php echo nl2br(e($area->serves)); ?>

                </p>
            </div>
        <?php endif; ?>

        <?php if($area->maps_url): ?>
            <div class="venue-info-group">
                <span class="venue-label">
                    Location
                </span>

                <div class="contact-item">
                    <i class="fa-solid fa-location-dot"></i>

                    <a
                        href="<?php echo e($area->maps_url); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        View on Google Maps
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <?php if($area->phone || $area->email): ?>
            <div class="venue-info-group">
                <span class="venue-label">
                    Contact
                </span>

                <?php if($area->phone): ?>
                    <div class="contact-item">
                        <i class="fa-solid fa-phone"></i>

                        <a href="tel:<?php echo e($area->phone); ?>">
                            <?php echo e($area->phone); ?>

                        </a>
                    </div>
                <?php endif; ?>

                <?php if($area->email): ?>
                    <div class="contact-item">
                        <i class="fa-solid fa-envelope"></i>

                        <a href="mailto:<?php echo e($area->email); ?>">
                            <?php echo e($area->email); ?>

                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if($area->instagram || $area->facebook): ?>
            <div class="venue-info-group">
                <span class="venue-label">
                    Follow Us
                </span>

                <div class="venue-social-links">
                    <?php if($area->instagram): ?>
                        <a
                            href="<?php echo e($area->instagram); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="venue-social-link"
                        >
                            Instagram
                        </a>
                    <?php endif; ?>

                    <?php if($area->facebook): ?>
                        <a
                            href="<?php echo e($area->facebook); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="venue-social-link"
                        >
                            Facebook
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .venue-card {
        position: relative;
        min-height: 100%;
        width: 100%;
        padding: 24px 24px 28px;
        box-sizing: border-box;
        background: #ffffff;
        color: #2d241c;
    }

    .venue-header {
        position: relative;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 20px;
    }

    .venue-title {
        margin: 0;
        padding-right: 8px;
        font-family: 'Montserrat', sans-serif;
        font-size: 24px;
        line-height: 1.25;
        font-weight: 700;
        color: #2d241c;
    }

    .venue-close-btn {
        position: relative;
        z-index: 20;
        flex: 0 0 auto;
        width: 38px;
        height: 38px;
        padding: 0;
        border: none;
        border-radius: 50%;
        background: #f4efe9;
        color: #6b5a4a;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition:
            color .2s ease,
            background .2s ease,
            transform .2s ease;
    }

    .venue-close-btn:hover {
        color: #ffffff;
        background: #b7936e;
        transform: rotate(90deg);
    }

    .venue-close-btn svg {
        pointer-events: none;
    }

    .slider-container {
        position: relative;
        margin-bottom: 24px;
    }

    .slider-wrapper {
        display: flex;
        width: 100%;
        overflow: hidden;
        scroll-behavior: smooth;
        border-radius: 18px;
        background: #eeeeee;
    }

    .slider-wrapper img {
        display: block;
        flex: 0 0 100%;
        width: 100%;
        height: 230px;
        object-fit: cover;
    }

    .slider-nav {
        position: absolute;
        top: 50%;
        z-index: 10;
        transform: translateY(-50%);
        width: 34px;
        height: 34px;
        padding: 0;
        border: none;
        border-radius: 50%;
        background: rgba(0, 0, 0, .5);
        color: #ffffff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition:
            background .2s ease,
            transform .2s ease;
    }

    .slider-nav:hover {
        background: rgba(0, 0, 0, .75);
    }

    .slider-nav:active {
        transform: translateY(-50%) scale(.94);
    }

    .slider-prev {
        left: 12px;
    }

    .slider-next {
        right: 12px;
    }

    .no-venue-photo {
        height: 230px;
        margin-bottom: 24px;
        border-radius: 18px;
        background: #f2eee9;
        color: #a18e7b;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: center;
        justify-content: center;
    }

    .no-venue-photo i {
        font-size: 30px;
    }

    .no-venue-photo span {
        font-family: 'Montserrat', sans-serif;
        font-size: 13px;
    }

    .venue-content {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .venue-info-group {
        border-bottom: 1px solid rgba(183, 147, 110, .15);
        padding-bottom: 14px;
    }

    .venue-info-group:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .venue-label {
        display: block;
        margin-bottom: 5px;
        font-family: 'Montserrat', sans-serif;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #b7936e;
    }

    .venue-text {
        margin: 0;
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        line-height: 1.6;
        color: #3d342c;
    }

    .venue-description {
        font-size: 13.5px;
        line-height: 1.7;
        color: #4a3f36;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-top: 8px;
        font-family: 'Montserrat', sans-serif;
        font-size: 13px;
        color: #3d342c;
    }

    .contact-item i {
        width: 16px;
        margin-top: 3px;
        color: #b7936e;
    }

    .contact-item a {
        color: inherit;
        text-decoration: none;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .contact-item a:hover {
        color: #b7936e;
    }

    .venue-social-links {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .venue-social-link {
        color: #b7936e;
        font-family: 'Montserrat', sans-serif;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        padding-bottom: 3px;
        border-bottom: 2px solid transparent;
        transition:
            color .2s ease,
            border-color .2s ease;
    }

    .venue-social-link:hover {
        color: #8a6f4e;
        border-bottom-color: #b7936e;
    }

    @media (max-width: 480px) {
        .venue-card {
            padding: 20px 18px 24px;
        }

        .venue-title {
            font-size: 20px;
        }

        .venue-close-btn {
            width: 36px;
            height: 36px;
        }

        .slider-wrapper img,
        .no-venue-photo {
            height: 220px;
        }

        .venue-text {
            font-size: 13px;
        }
    }
</style><?php /**PATH /home/kong-bunyim/Documents/projects/samai-laravel/resources/views/components/venue-card.blade.php ENDPATH**/ ?>