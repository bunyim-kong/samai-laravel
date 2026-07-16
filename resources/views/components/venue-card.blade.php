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

    <div class="venue-card-header">
        <div class="venue-heading">
            <p class="venue-province">
                {{ $area->countrySide?->name ?? 'Cambodia' }}
            </p>

            <h2 class="venue-title">
                {{ $area->title }}
            </h2>
        </div>

        <button
            type="button"
            class="venue-close-button"
            data-close-venue-card
            aria-label="Close venue details"
        >
            <svg
                width="21"
                height="21"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2.2"
                stroke-linecap="round"
                aria-hidden="true"
            >
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    @if ($sliderImages->isNotEmpty())
        <div class="venue-slider-container">

            @if ($sliderImages->count() > 1)
                <button
                    id="prev"
                    type="button"
                    class="venue-slider-button venue-slider-previous"
                    aria-label="Previous photo"
                >
                    <svg
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
            @endif

            <div
                id="slider"
                class="venue-slider"
            >
                @foreach ($sliderImages as $image)
                    <div class="venue-slide">
                        <img
                            src="{{ $image->image_url }}"
                            alt="{{ $area->title }} photo {{ $loop->iteration }}"
                            class="venue-slide-image"
                            loading="eager"
                        >
                    </div>
                @endforeach
            </div>

            @if ($sliderImages->count() > 1)
                <button
                    id="next"
                    type="button"
                    class="venue-slider-button venue-slider-next"
                    aria-label="Next photo"
                >
                    <svg
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            @endif

            @if ($sliderImages->count() > 1)
                <div class="venue-photo-count">
                    {{ $sliderImages->count() }} photos
                </div>
            @endif

        </div>
    @else
        <div class="venue-no-photo">
            <svg
                width="34"
                height="34"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
            >
                <rect
                    x="3"
                    y="3"
                    width="18"
                    height="18"
                    rx="2"
                ></rect>

                <circle
                    cx="8.5"
                    cy="8.5"
                    r="1.5"
                ></circle>

                <polyline
                    points="21 15 16 10 5 21"
                ></polyline>
            </svg>

            <span>No photos uploaded</span>
        </div>
    @endif

    <div class="venue-card-content">

        @if ($area->address)
            <section class="venue-section">
                <h3 class="venue-section-title">
                    Address
                </h3>

                <div class="venue-row">
                    <div class="venue-row-icon">
                        <svg
                            width="17"
                            height="17"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                d="M21 10c0 7-9 12-9 12S3 17 3 10a9 9 0 1 1 18 0z"
                            ></path>

                            <circle
                                cx="12"
                                cy="10"
                                r="3"
                            ></circle>
                        </svg>
                    </div>

                    <p class="venue-text">
                        {{ $area->address }}
                    </p>
                </div>
            </section>
        @endif

        @if ($area->open_hours)
            <section class="venue-section">
                <h3 class="venue-section-title">
                    Opening Hours
                </h3>

                <div class="venue-row">
                    <div class="venue-row-icon">
                        <svg
                            width="17"
                            height="17"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            ></circle>

                            <polyline
                                points="12 7 12 12 15 14"
                            ></polyline>
                        </svg>
                    </div>

                    <p class="venue-text">
                        {!! nl2br(e($area->open_hours)) !!}
                    </p>
                </div>
            </section>
        @endif

        @if ($area->description)
            <section class="venue-section">
                <h3 class="venue-section-title">
                    About
                </h3>

                <p class="venue-description">
                    {!! nl2br(e($area->description)) !!}
                </p>
            </section>
        @endif

        @if ($area->serves)
            <section class="venue-section">
                <h3 class="venue-section-title">
                    Samai Signature Serves
                </h3>

                <div class="venue-serves-box">
                    {!! nl2br(e($area->serves)) !!}
                </div>
            </section>
        @endif

        @if ($area->maps_url)
            <section class="venue-section">
                <h3 class="venue-section-title">
                    Location
                </h3>

                <a
                    href="{{ $area->maps_url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="venue-action-link"
                >
                    <span class="venue-action-icon">
                        <svg
                            width="17"
                            height="17"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                d="M21 10c0 7-9 12-9 12S3 17 3 10a9 9 0 1 1 18 0z"
                            ></path>

                            <circle
                                cx="12"
                                cy="10"
                                r="3"
                            ></circle>
                        </svg>
                    </span>

                    <span>View on Google Maps</span>

                    <svg
                        class="venue-link-arrow"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <line
                            x1="5"
                            y1="12"
                            x2="19"
                            y2="12"
                        ></line>

                        <polyline
                            points="12 5 19 12 12 19"
                        ></polyline>
                    </svg>
                </a>
            </section>
        @endif

        @if ($area->phone || $area->email)
            <section class="venue-section">
                <h3 class="venue-section-title">
                    Contact
                </h3>

                <div class="venue-contact-list">
                    @if ($area->phone)
                        <a
                            href="tel:{{ preg_replace('/\s+/', '', $area->phone) }}"
                            class="venue-contact-item"
                        >
                            <span class="venue-contact-icon">
                                <svg
                                    width="17"
                                    height="17"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2
                                        19.79 19.79 0 0 1-8.63-3.07
                                        19.5 19.5 0 0 1-6-6
                                        19.79 19.79 0 0 1-3.07-8.67
                                        A2 2 0 0 1 4.11 2h3
                                        a2 2 0 0 1 2 1.72
                                        12.84 12.84 0 0 0 .7 2.81
                                        2 2 0 0 1-.45 2.11L8.09 9.91
                                        a16 16 0 0 0 6 6l1.27-1.27
                                        a2 2 0 0 1 2.11-.45
                                        12.84 12.84 0 0 0 2.81.7
                                        A2 2 0 0 1 22 16.92z"
                                    ></path>
                                </svg>
                            </span>

                            <span>{{ $area->phone }}</span>
                        </a>
                    @endif

                    @if ($area->email)
                        <a
                            href="mailto:{{ $area->email }}"
                            class="venue-contact-item"
                        >
                            <span class="venue-contact-icon">
                                <svg
                                    width="17"
                                    height="17"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12
                                        c0 1.1-.9 2-2 2H4
                                        c-1.1 0-2-.9-2-2V6
                                        c0-1.1.9-2 2-2z"
                                    ></path>

                                    <polyline
                                        points="22,6 12,13 2,6"
                                    ></polyline>
                                </svg>
                            </span>

                            <span>{{ $area->email }}</span>
                        </a>
                    @endif
                </div>
            </section>
        @endif

        @if ($area->instagram || $area->facebook)
            <section class="venue-section venue-social-section">
                <h3 class="venue-section-title">
                    Follow Us
                </h3>

                <div class="venue-social-links">
                    @if ($area->instagram)
                        <a
                            href="{{ $area->instagram }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="venue-social-link"
                        >
                            <span>Instagram</span>

                            <svg
                                width="14"
                                height="14"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <line
                                    x1="7"
                                    y1="17"
                                    x2="17"
                                    y2="7"
                                ></line>

                                <polyline
                                    points="7 7 17 7 17 17"
                                ></polyline>
                            </svg>
                        </a>
                    @endif

                    @if ($area->facebook)
                        <a
                            href="{{ $area->facebook }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="venue-social-link"
                        >
                            <span>Facebook</span>

                            <svg
                                width="14"
                                height="14"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <line
                                    x1="7"
                                    y1="17"
                                    x2="17"
                                    y2="7"
                                ></line>

                                <polyline
                                    points="7 7 17 7 17 17"
                                ></polyline>
                            </svg>
                        </a>
                    @endif
                </div>
            </section>
        @endif

    </div>
</div>

<style>
    .venue-card {
        position: relative;
        width: 100%;
        min-height: 100%;
        box-sizing: border-box;
        padding: 24px;
        background: #ffffff;
        color: #30271f;
        font-family: 'Montserrat', sans-serif;
    }

    .venue-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 20px;
    }

    .venue-heading {
        min-width: 0;
        flex: 1;
    }

    .venue-province {
        margin: 0 0 6px;
        color: #a78460;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
    }

    .venue-title {
        margin: 0;
        color: #2d241c;
        font-size: 24px;
        font-weight: 700;
        line-height: 1.25;
        overflow-wrap: anywhere;
    }

    .venue-close-button {
        position: relative;
        z-index: 30;
        display: flex;
        flex: 0 0 auto;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        padding: 0;
        border: 1px solid #ebe2d8;
        border-radius: 50%;
        background: #f7f3ef;
        color: #6b5846;
        cursor: pointer;
        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease,
            transform .2s ease;
    }

    .venue-close-button:hover {
        border-color: #b7936e;
        background: #b7936e;
        color: #ffffff;
        transform: rotate(90deg);
    }

    .venue-close-button svg {
        pointer-events: none;
    }

    .venue-slider-container {
        position: relative;
        width: 100%;
        margin-bottom: 24px;
        overflow: hidden;
        border-radius: 20px;
        background: #eee9e4;
        box-shadow: 0 8px 22px rgba(45, 36, 28, .12);
    }

    .venue-slider {
        display: flex;
        width: 100%;
        overflow-x: hidden;
        scroll-behavior: smooth;
        scroll-snap-type: x mandatory;
    }

    .venue-slide {
        flex: 0 0 100%;
        width: 100%;
        min-width: 100%;
        height: 240px;
        scroll-snap-align: start;
        background: #eee9e4;
    }

    .venue-slide-image {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
        object-fit: cover;
    }

    .venue-slider-button {
        position: absolute;
        top: 50%;
        z-index: 15;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        padding: 0;
        border: 1px solid rgba(255, 255, 255, .45);
        border-radius: 50%;
        background: rgba(30, 25, 21, .58);
        color: #ffffff;
        cursor: pointer;
        transform: translateY(-50%);
        backdrop-filter: blur(6px);
        transition:
            background .2s ease,
            transform .2s ease;
    }

    .venue-slider-button:hover {
        background: rgba(30, 25, 21, .85);
    }

    .venue-slider-button:active {
        transform: translateY(-50%) scale(.94);
    }

    .venue-slider-previous {
        left: 12px;
    }

    .venue-slider-next {
        right: 12px;
    }

    .venue-photo-count {
        position: absolute;
        right: 12px;
        bottom: 12px;
        z-index: 12;
        padding: 6px 10px;
        border: 1px solid rgba(255, 255, 255, .28);
        border-radius: 999px;
        background: rgba(25, 20, 16, .58);
        color: #ffffff;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: .03em;
        backdrop-filter: blur(5px);
    }

    .venue-no-photo {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 230px;
        margin-bottom: 24px;
        border: 1px dashed #d9c9b8;
        border-radius: 20px;
        background: #f5f1ed;
        color: #a28f7c;
        gap: 10px;
    }

    .venue-no-photo span {
        font-size: 13px;
        font-weight: 500;
    }

    .venue-card-content {
        display: flex;
        flex-direction: column;
    }

    .venue-section {
        padding: 17px 0;
        border-bottom: 1px solid #eee7df;
    }

    .venue-section:first-child {
        padding-top: 0;
    }

    .venue-section:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .venue-section-title {
        margin: 0 0 10px;
        color: #a78460;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .venue-row {
        display: flex;
        align-items: flex-start;
        gap: 11px;
    }

    .venue-row-icon {
        display: flex;
        flex: 0 0 auto;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        margin-top: 1px;
        border-radius: 9px;
        background: #f2e9df;
        color: #a78460;
    }

    .venue-text {
        margin: 0;
        padding-top: 4px;
        color: #453a31;
        font-size: 13.5px;
        line-height: 1.65;
        overflow-wrap: anywhere;
    }

    .venue-description {
        margin: 0;
        color: #51463d;
        font-size: 13.5px;
        line-height: 1.75;
    }

    .venue-serves-box {
        padding: 13px 15px;
        border-left: 3px solid #b7936e;
        border-radius: 0 12px 12px 0;
        background: #f7f2ed;
        color: #45382d;
        font-size: 13.5px;
        line-height: 1.65;
    }

    .venue-action-link {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 12px 14px;
        border: 1px solid #eadfd4;
        border-radius: 13px;
        background: #fbf9f7;
        color: #40342a;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition:
            border-color .2s ease,
            background .2s ease,
            color .2s ease;
    }

    .venue-action-link:hover {
        border-color: #b7936e;
        background: #f4ece4;
        color: #8b6847;
    }

    .venue-action-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a78460;
    }

    .venue-link-arrow {
        margin-left: auto;
    }

    .venue-contact-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .venue-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        color: #453a31;
        font-size: 13px;
        line-height: 1.55;
        text-decoration: none;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .venue-contact-item:hover {
        color: #9d7853;
    }

    .venue-contact-icon {
        display: flex;
        flex: 0 0 auto;
        align-items: center;
        justify-content: center;
        width: 29px;
        height: 29px;
        border-radius: 9px;
        background: #f2e9df;
        color: #a78460;
    }

    .venue-social-section {
        padding-bottom: 4px;
    }

    .venue-social-links {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .venue-social-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 13px;
        border: 1px solid #e3d6c9;
        border-radius: 999px;
        background: #ffffff;
        color: #8f6c4b;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition:
            background .2s ease,
            border-color .2s ease,
            color .2s ease;
    }

    .venue-social-link:hover {
        border-color: #b7936e;
        background: #b7936e;
        color: #ffffff;
    }

    @media (max-width: 480px) {
        .venue-card {
            padding: 19px 17px 24px;
        }

        .venue-card-header {
            margin-bottom: 17px;
        }

        .venue-title {
            font-size: 21px;
        }

        .venue-close-button {
            width: 38px;
            height: 38px;
        }

        .venue-slide {
            height: 220px;
        }

        .venue-slider-button {
            width: 36px;
            height: 36px;
        }

        .venue-text,
        .venue-description,
        .venue-serves-box {
            font-size: 13px;
        }
    }
</style>