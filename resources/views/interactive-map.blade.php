<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $countrySide->name }} Map</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        :root {
            --brand-brown: #9d7a54;
            --brand-brown-hover: #836342;
        }

        html,
        body {
            margin: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
            background: #3f3c47;
        }

        .map-wrapper,
        .map-card,
        #map {
            width: 100%;
            height: 100%;
        }

        .map-card {
            position: relative;
            overflow: hidden;
            background: white;
        }

        .leaflet-popup-content-wrapper,
        .leaflet-popup-tip {
            background: var(--brand-brown);
            color: white;
        }

        .leaflet-popup-content {
            margin: 10px;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
        }

        .leaflet-bar {
            border: none !important;
            border-radius: 18px !important;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .3) !important;
        }

        .leaflet-bar a {
            background: var(--brand-brown) !important;
            color: white !important;
            border: none !important;
            width: 44px !important;
            height: 44px !important;
            line-height: 44px !important;
            font-size: 22px !important;
            font-weight: 700;
        }

        .leaflet-bar a:hover {
            background: var(--brand-brown-hover) !important;
        }

        .pin-marker {
            width: 34px;
            height: 34px;
            background: var(--brand-brown);
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            border: 2px solid white;
            box-shadow: -2px 2px 6px rgba(0, 0, 0, .35);
        }

        .venue-label-tooltip {
            background: rgba(255, 255, 255, .95) !important;
            color: #2d241c !important;
            border: none !important;
            border-radius: 6px !important;
            padding: 3px 8px !important;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px !important;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .25);
            opacity: 0 !important;
            transform: scale(.9);
            transition: opacity .2s ease, transform .2s ease;
            pointer-events: none;
        }

        .venue-label-tooltip.is-visible {
            opacity: 1 !important;
            transform: scale(1);
        }

        .venue-label-tooltip::before {
            display: none;
        }

        .venue-search-wrap {
            position: absolute;
            top: 16px;
            left: 16px;
            right: 16px;
            max-width: 320px;
            z-index: 1000;
        }

        .venue-search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            border-radius: 16px;
            padding: 11px 14px;
            box-shadow:
                0 8px 24px rgba(0, 0, 0, .18),
                0 2px 6px rgba(0, 0, 0, .08);
        }

        .venue-search-box svg {
            flex-shrink: 0;
            color: var(--brand-brown);
        }

        .venue-search-box input {
            flex: 1;
            min-width: 0;
            border: none;
            outline: none;
            background: transparent;
            font: inherit;
            font-size: 13.5px;
            font-weight: 500;
            color: #2d241c;
        }

        .venue-search-clear {
            display: none;
            width: 22px;
            height: 22px;
            border: none;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: #efe9e2;
            color: #7a6e5f;
        }

        .venue-search-clear.is-visible {
            display: flex;
        }

        .venue-search-results {
            display: none;
            margin-top: 8px;
            max-height: 240px;
            overflow-y: auto;
            background: white;
            border-radius: 14px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, .2);
        }

        .venue-search-results.is-visible {
            display: block;
        }

        .venue-search-result {
            padding: 11px 14px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            color: #2d241c;
            border-bottom: 1px solid #f2ede6;
        }

        .venue-search-result:hover,
        .venue-search-result.is-active {
            background: #f7f2ec;
        }

        .venue-search-empty {
            padding: 14px;
            font-size: 12px;
            color: #8a7e70;
            text-align: center;
        }

        @media (max-width: 480px) {
            .venue-search-wrap {
                top: 12px;
                left: 12px;
                right: 60px;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="map-wrapper">
        <div class="map-card">
            <div class="venue-search-wrap">
                <div class="venue-search-box">
                    <svg
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                    >
                        <circle cx="11" cy="11" r="7"></circle>
                        <line
                            x1="21"
                            y1="21"
                            x2="16.65"
                            y2="16.65"
                        ></line>
                    </svg>

                    <input
                        type="text"
                        id="venueSearchInput"
                        placeholder="Search a venue..."
                        autocomplete="off"
                    >

                    <button
                        type="button"
                        id="venueSearchClear"
                        class="venue-search-clear"
                        aria-label="Clear search"
                    >
                        ✕
                    </button>
                </div>

                <div
                    id="venueSearchResults"
                    class="venue-search-results"
                ></div>
            </div>

            <div id="map"></div>
        </div>
    </div>

    <script>
        const mapData = {
            center: [
                {{ (float) ($countrySide->center_lat ?? 11.5564) }},
                {{ (float) ($countrySide->center_lng ?? 104.9282) }}
            ],

            zoom: {{ (int) ($countrySide->zoom ?? 10) }},

            markers: @json(
                $countrySide->areas
                    ->filter(fn ($area) => $area->lat !== null && $area->lng !== null)
                    ->map(fn ($area) => [
                        'id' => $area->id,
                        'title' => $area->title,
                        'lat' => (float) $area->lat,
                        'lng' => (float) $area->lng,
                    ])
                    ->values()
            )
        };

        const map = L.map('map', {
            zoomControl: false,
            attributionControl: false
        }).setView(mapData.center, mapData.zoom);

        L.control.zoom({
            position: 'bottomleft'
        }).addTo(map);

        L.tileLayer(
            'https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
            {
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                maxZoom: 20
            }
        ).addTo(map);

        const markerIcon = L.divIcon({
            className: 'custom-pin',
            html: '<div class="pin-marker"></div>',
            iconSize: [34, 34],
            iconAnchor: [17, 34],
            popupAnchor: [0, -26]
        });

        const labelZoom = 13;
        const markerItems = [];
        const bounds = [];

        mapData.markers.forEach(item => {
            const marker = L.marker(
                [item.lat, item.lng],
                { icon: markerIcon }
            ).addTo(map);

            marker.bindTooltip(item.title, {
                permanent: true,
                direction: 'right',
                offset: [14, -15],
                className: 'venue-label-tooltip'
            });

            marker.on('click', function () {
                window.parent.postMessage({
                    type: 'show_card',
                    area_id: item.id
                }, '*');
            });

            markerItems.push({
                ...item,
                marker
            });

            bounds.push([item.lat, item.lng]);
        });

        function updateLabels() {
            const visible = map.getZoom() >= labelZoom;

            markerItems.forEach(item => {
                const tooltip = item.marker.getTooltip();

                if (!tooltip) {
                    return;
                }

                const element = tooltip.getElement();

                if (element) {
                    element.classList.toggle(
                        'is-visible',
                        visible
                    );
                }
            });
        }

        if (bounds.length > 1) {
            map.fitBounds(bounds, {
                padding: [70, 70]
            });
        }

        if (bounds.length === 1) {
            map.setView(bounds[0], mapData.zoom);
        }

        map.on('zoomend', updateLabels);

        map.whenReady(() => {
            setTimeout(updateLabels, 50);
        });

        const searchInput = document.getElementById(
            'venueSearchInput'
        );

        const clearButton = document.getElementById(
            'venueSearchClear'
        );

        const resultsBox = document.getElementById(
            'venueSearchResults'
        );

        let currentMatches = [];
        let activeIndex = -1;

        function escapeHtml(value) {
            return String(value)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function renderResults(matches, query) {
            currentMatches = matches;
            activeIndex = -1;

            if (!query) {
                resultsBox.innerHTML = '';
                resultsBox.classList.remove('is-visible');
                return;
            }

            if (matches.length === 0) {
                resultsBox.innerHTML = `
                    <div class="venue-search-empty">
                        No venues found
                    </div>
                `;

                resultsBox.classList.add('is-visible');
                return;
            }

            resultsBox.innerHTML = matches.map((item, index) => `
                <div
                    class="venue-search-result"
                    data-index="${index}"
                >
                    ${escapeHtml(item.title)}
                </div>
            `).join('');

            resultsBox.classList.add('is-visible');

            resultsBox
                .querySelectorAll('.venue-search-result')
                .forEach(element => {
                    element.addEventListener('click', function () {
                        selectResult(
                            Number(this.dataset.index)
                        );
                    });
                });
        }

        function selectResult(index) {
            const item = currentMatches[index];

            if (!item) {
                return;
            }

            map.setView(
                [item.lat, item.lng],
                Math.max(map.getZoom(), labelZoom + 1),
                { animate: true }
            );

            item.marker.openTooltip();

            searchInput.value = item.title;
            clearButton.classList.add('is-visible');
            resultsBox.classList.remove('is-visible');

            window.parent.postMessage({
                type: 'show_card',
                area_id: item.id
            }, '*');
        }

        searchInput.addEventListener('input', function () {
            const query = this.value.trim().toLowerCase();

            clearButton.classList.toggle(
                'is-visible',
                this.value.length > 0
            );

            const matches = markerItems.filter(item => {
                return item.title.toLowerCase().includes(query);
            });

            renderResults(matches, query);
        });

        searchInput.addEventListener('keydown', function (event) {
            const resultElements = resultsBox.querySelectorAll(
                '.venue-search-result'
            );

            if (event.key === 'Escape') {
                resultsBox.classList.remove('is-visible');
                return;
            }

            if (!resultElements.length) {
                return;
            }

            if (event.key === 'ArrowDown') {
                event.preventDefault();

                activeIndex = Math.min(
                    activeIndex + 1,
                    resultElements.length - 1
                );
            }

            if (event.key === 'ArrowUp') {
                event.preventDefault();

                activeIndex = Math.max(activeIndex - 1, 0);
            }

            if (event.key === 'Enter') {
                event.preventDefault();

                selectResult(
                    activeIndex >= 0 ? activeIndex : 0
                );

                return;
            }

            resultElements.forEach((element, index) => {
                element.classList.toggle(
                    'is-active',
                    index === activeIndex
                );
            });

            if (activeIndex >= 0) {
                resultElements[activeIndex].scrollIntoView({
                    block: 'nearest'
                });
            }
        });

        clearButton.addEventListener('click', function () {
            searchInput.value = '';
            clearButton.classList.remove('is-visible');
            resultsBox.classList.remove('is-visible');
            resultsBox.innerHTML = '';
            searchInput.focus();
        });

        document.addEventListener('click', function (event) {
            if (!event.target.closest('.venue-search-wrap')) {
                resultsBox.classList.remove('is-visible');
            }
        });
    </script>
</body>
</html>