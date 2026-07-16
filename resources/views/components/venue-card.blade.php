@php
    $sliderImages = $area->images
        ->filter(function ($image) {
            return !empty($image->image_path)
                && !empty($image->image_url);
        })
        ->sortBy('sort_order')
        ->values();
@endphp

<div class="venue-card">
    <div class="venue-header">
        <h2 class="venue-title">
            {{ $area->title }}
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
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    @if ($sliderImages->isNotEmpty())
        <div class="slider-container">
            @if ($sliderImages->count() > 1)
                <button
                    id="prev"
                    type="button"
                    class="slider-nav slider-prev"
                    aria-label="Previous photo"
                >
                    <i class="fa-solid fa-angle-left"></i>
                </button>
            @endif

            <div id="slider" class="slider-wrapper">
                @foreach ($sliderImages as $image)
                    <div class="slider-slide">
                        <img
                            src="{{ $image->image_url }}"
                            alt="{{ $area->title }} photo {{ $loop->iteration }}"
                            class="venue-slider-image"
                            loading="eager"
                            decoding="async"
                        >
                    </div>
                @endforeach
            </div>

            @if ($sliderImages->count() > 1)
                <button
                    id="next"
                    type="button"
                    class="slider-nav slider-next"
                    aria-label="Next photo"
                >
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            @endif
        </div>
    @else
        <div class="no-venue-photo">
            <i class="fa-solid fa-image"></i>

            <span>
                No photos uploaded
            </span>
        </div>
    @endif

    <div class="venue-content">
        @if ($area->address)
            <div class="venue-info-group">
                <span class="venue-label">
                    Address
                </span>

                <p class="venue-text">
                    {{ $area->address }}
                </p>
            </div>
        @endif

        @if ($area->open_hours)
            <div class="venue-info-group">
                <span class="venue-label">
                    Opening Hours
                </span>

                <p class="venue-text">
                    {!! nl2br(e($area->open_hours)) !!}
                </p>
            </div>
        @endif

        @if ($area->description)
            <div class="venue-info-group">
                <span class="venue-label">
                    Description
                </span>

                <p class="venue-text venue-description">
                    {!! nl2br(e($area->description)) !!}
                </p>
            </div>
        @endif

        @if ($area->serves)
            <div class="venue-info-group">
                <span class="venue-label">
                    Samai Signature Serves
                </span>

                <p class="venue-text">
                    {!! nl2br(e($area->serves)) !!}
                </p>
            </div>
        @endif

        @if ($area->maps_url)
            <div class="venue-info-group">
                <span class="venue-label">
                    Location
                </span>

                <div class="contact-item">
                    <i class="fa-solid fa-location-dot"></i>

                    <a
                        href="{{ $area->maps_url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        View on Google Maps
                    </a>
                </div>
            </div>
        @endif

        @if ($area->phone || $area->email)
            <div class="venue-info-group">
                <span class="venue-label">
                    Contact
                </span>

                @if ($area->phone)
                    <div class="contact-item">
                        <i class="fa-solid fa-phone"></i>

                        <a href="tel:{{ $area->phone }}">
                            {{ $area->phone }}
                        </a>
                    </div>
                @endif

                @if ($area->email)
                    <div class="contact-item">
                        <i class="fa-solid fa-envelope"></i>

                        <a href="mailto:{{ $area->email }}">
                            {{ $area->email }}
                        </a>
                    </div>
                @endif
            </div>
        @endif

        @if ($area->instagram || $area->facebook)
            <div class="venue-info-group">
                <span class="venue-label">
                    Follow Us
                </span>

                <div class="venue-social-links">
                    @if ($area->instagram)
                        <a
                            href="{{ $area->instagram }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="venue-social-link"
                        >
                            Instagram
                        </a>
                    @endif

                    @if ($area->facebook)
                        <a
                            href="{{ $area->facebook }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="venue-social-link"
                        >
                            Facebook
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .venue-card {
        position: relative;
        width: 100%;
        min-height: 100%;
        box-sizing: border-box;
        padding: 24px 24px 28px;
        background: #ffffff;
        color: #2d241c;
        font-family: 'Montserrat', sans-serif;
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
        color: #2d241c;
        font-size: 24px;
        font-weight: 700;
        line-height: 1.25;
    }

    .venue-close-btn {
        position: relative;
        z-index: 20;
        display: flex;
        flex: 0 0 auto;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        padding: 0;
        border: 0;
        border-radius: 50%;
        background: #f4efe9;
        color: #6b5a4a;
        cursor: pointer;
        transition:
            color .2s ease,
            background .2s ease,
            transform .2s ease;
    }

    .venue-close-btn:hover {
        background: #b7936e;
        color: #ffffff;
        transform: rotate(90deg);
    }

    .venue-close-btn svg {
        pointer-events: none;
    }

    .slider-container {
        position: relative;
        width: 100%;
        margin-bottom: 24px;
    }

    .slider-wrapper {
        display: flex;
        width: 100%;
        overflow-x: hidden;
        border-radius: 18px;
        background: #eeeeee;
        scroll-behavior: smooth;
    }

    .slider-slide {
        display: block;
        flex: 0 0 100%;
        width: 100%;
        min-width: 100%;
        height: 230px;
        background: #eeeeee;
    }

    .venue-slider-image {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
        object-fit: cover;
    }

    .slider-nav {
        position: absolute;
        top: 50%;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        padding: 0;
        border: 0;
        border-radius: 50%;
        background: rgba(0, 0, 0, .55);
        color: #ffffff;
        cursor: pointer;
        transform: translateY(-50%);
        transition:
            background .2s ease,
            transform .2s ease;
    }

    .slider-nav:hover {
        background: rgba(0, 0, 0, .8);
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
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 230px;
        margin-bottom: 24px;
        border-radius: 18px;
        background: #f2eee9;
        color: #a18e7b;
        gap: 10px;
    }

    .no-venue-photo i {
        font-size: 30px;
    }

    .no-venue-photo span {
        font-size: 13px;
    }

    .venue-content {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .venue-info-group {
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(183, 147, 110, .15);
    }

    .venue-info-group:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .venue-label {
        display: block;
        margin-bottom: 5px;
        color: #b7936e;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .venue-text {
        margin: 0;
        color: #3d342c;
        font-size: 14px;
        line-height: 1.6;
    }

    .venue-description {
        color: #4a3f36;
        font-size: 13.5px;
        line-height: 1.7;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-top: 8px;
        color: #3d342c;
        font-size: 13px;
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
        flex-wrap: wrap;
        gap: 16px;
    }

    .venue-social-link {
        padding-bottom: 3px;
        border-bottom: 2px solid transparent;
        color: #b7936e;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
    }

    .venue-social-link:hover {
        border-bottom-color: #b7936e;
        color: #8a6f4e;
    }

    @media (max-width: 480px) {
        .venue-card {
            padding: 20px 18px 24px;
        }

        .venue-title {
            font-size: 20px;
        }

        .slider-slide,
        .no-venue-photo {
            height: 220px;
        }

        .venue-text {
            font-size: 13px;
        }
    }
</style>