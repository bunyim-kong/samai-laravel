@php
    $sliderImages = collect();

    if ($area->image_url) {
        $sliderImages->push($area->image_url);
    }

    foreach ($area->images as $galleryImage) {
        if ($galleryImage->image_url) {
            $sliderImages->push($galleryImage->image_url);
        }
    }
@endphp

<div class="venue-card">
    <div class="venue-header">
        <h2 class="venue-title">
            {{ $area->title }}
        </h2>

        <button
            type="button"
            class="venue-close-btn"
            onclick="window.postMessage({ type: 'close_card' }, '*')"
            aria-label="Close venue details"
        >
            <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
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
                    aria-label="Previous image"
                >
                    <i class="fa-solid fa-angle-left"></i>
                </button>
            @endif

            <div id="slider" class="slider-wrapper">
                @foreach ($sliderImages as $image)
                    <img
                        src="{{ $image }}"
                        alt="{{ $area->title }}"
                        loading="lazy"
                    >
                @endforeach
            </div>

            @if ($sliderImages->count() > 1)
                <button
                    id="next"
                    type="button"
                    class="slider-nav slider-next"
                    aria-label="Next image"
                >
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            @endif
        </div>
    @endif

    <div class="venue-content">
        @if ($area->address)
            <div class="venue-info-group">
                <span class="venue-label">Address</span>

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
                <span class="venue-label">Location</span>

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
                <span class="venue-label">Contact</span>

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
                <span class="venue-label">Follow Us</span>

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
        min-height: 100%;
        width: 100%;
        padding: 24px 24px 28px;
        box-sizing: border-box;
        background: white;
        color: #2d241c;
    }

    .venue-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .venue-title {
        margin: 0;
        font-family: 'Montserrat', sans-serif;
        font-size: 24px;
        line-height: 1.25;
        font-weight: 700;
        color: #2d241c;
    }

    .venue-close-btn {
        flex-shrink: 0;
        width: 36px;
        height: 36px;
        padding: 0;
        border: none;
        background: transparent;
        color: #6b5a4a;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .2s ease;
    }

    .venue-close-btn:hover {
        color: #b7936e;
        transform: rotate(90deg);
    }

    .slider-container {
        position: relative;
        margin-bottom: 24px;
    }

    .slider-wrapper {
        display: flex;
        overflow: hidden;
        scroll-behavior: smooth;
        border-radius: 18px;
        background: #eee;
    }

    .slider-wrapper img {
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
        border: none;
        border-radius: 50%;
        background: rgba(0, 0, 0, .45);
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .2s ease;
    }

    .slider-nav:hover {
        background: rgba(0, 0, 0, .7);
    }

    .slider-prev {
        left: 12px;
    }

    .slider-next {
        right: 12px;
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
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #b7936e;
    }

    .venue-text {
        margin: 0;
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
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        padding-bottom: 3px;
        border-bottom: 2px solid transparent;
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

        .slider-wrapper img {
            height: 220px;
        }

        .venue-text {
            font-size: 13px;
        }
    }
</style>

<script>
    document
        .querySelector('.venue-close-btn')
        ?.addEventListener('click', function () {
            window.dispatchEvent(
                new MessageEvent('message', {
                    data: {
                        type: 'close_card'
                    }
                })
            );
        });
</script>