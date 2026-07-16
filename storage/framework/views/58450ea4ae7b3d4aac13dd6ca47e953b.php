<?php $__env->startSection('title', 'Samai Rum Map'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .province-label {
        font-family: 'Amsterdam Four', cursive;
        font-weight: 400;
        line-height: 1;
        white-space: nowrap;
        text-shadow: 0 2px 4px rgba(0, 0, 0, .6);
        letter-spacing: 1px;
    }

    .map-frame {
        aspect-ratio: 3 / 4;
    }

    #detailContainer {
        position: absolute;
        top: 4px;
        right: 4px;
        width: 384px;
        height: calc(100% - 8px);
        border-radius: 24px;
        background: #ffffff;
        z-index: 80;
        overflow-y: auto;
        transition: transform .5s ease-in-out;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #detailContainer::-webkit-scrollbar {
        display: none;
    }

    #detailContainer.pointer-events-none {
        pointer-events: none;
    }

    #detailContainer.pointer-events-auto {
        pointer-events: auto;
    }

    @keyframes pinPulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(194, 160, 109, .7);
        }

        70% {
            transform: scale(1.05);
            box-shadow: 0 0 0 8px rgba(194, 160, 109, 0);
        }

        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(194, 160, 109, 0);
        }
    }

    .map-dot-pulse {
        animation: pinPulse 2s infinite ease-in-out;
    }

    @media (max-width: 768px) {
        .map-frame {
            margin-top: -40px;
        }

        .samai-info {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        #detailContainer {
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border-radius: 0;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section
    class="min-h-screen w-full bg-[#3a3942] text-white relative flex flex-col overflow-x-hidden select-none"
>
    <header
        class="my-5 mx-4 md:mx-12 lg:mx-32 xl:mx-64 rounded-3xl px-6 py-3 text-base font-semibold z-50 sticky top-5 shadow-lg backdrop-blur-md bg-[#b7936e]"
    >
        <nav class="hidden sm:flex justify-between items-center">
            <a
                href="https://www.samaidistillery.com/"
                target="_blank"
                rel="noopener noreferrer"
                class="text-[#4a2e10] hover:text-white transition-colors duration-200"
            >
                About Samai
            </a>

            <a
                href="<?php echo e(route('landing')); ?>"
                class="text-[#4a2e10] hover:text-white transition-colors duration-200"
            >
                Samai Rum Map
            </a>
        </nav>

        <div class="flex sm:hidden justify-between items-center">
            <span
                class="text-[#4a2e10] text-sm tracking-wider uppercase font-bold"
            >
                Samai Distillery
            </span>

            <button
                id="burger"
                type="button"
                class="flex flex-col gap-1.5 bg-transparent border-0 cursor-pointer p-1"
                aria-label="Toggle navigation"
            >
                <span
                    class="block w-5 h-0.5 bg-[#4a2e10] rounded transition-transform duration-200"
                ></span>

                <span
                    class="block w-5 h-0.5 bg-[#4a2e10] rounded transition-opacity duration-200"
                ></span>

                <span
                    class="block w-5 h-0.5 bg-[#4a2e10] rounded transition-transform duration-200"
                ></span>
            </button>
        </div>

        <ul
            id="mobileMenu"
            class="sm:hidden hidden flex-col list-none mt-2 border-t border-[#4a2e10]/20 pt-2 gap-2"
        >
            <li>
                <a
                    href="https://www.samaidistillery.com/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="block text-[#4a2e10] font-semibold py-1"
                >
                    About Samai
                </a>
            </li>

            <li>
                <a
                    href="<?php echo e(route('landing')); ?>"
                    class="block text-[#4a2e10] font-semibold py-1"
                >
                    Samai Rum Map
                </a>
            </li>
        </ul>
    </header>

    <div
        class="flex-1 flex flex-col items-center justify-center md:block relative w-full h-full p-4 max-w-[1600px] mx-auto z-10"
    >
        <div
            class="samai-info relative md:absolute top-0 md:top-[2%] right-[6%] md:right-[14%] z-30 flex flex-col items-center text-center w-full md:w-56 lg:w-64 mb-6 md:mb-0"
        >
            <img
                src="<?php echo e(asset('assets/images/samai-logo.png')); ?>"
                alt="Samai Logo"
                class="w-full max-w-[120px] sm:max-w-[140px] md:max-w-[180px] object-contain drop-shadow-2xl"
            >

            <div class="mt-2 md:mt-3 space-y-1 px-4">
                <h3
                    class="text-[10px] sm:text-xs md:text-[11px] font-bold tracking-widest text-[#c2a06d] uppercase"
                >
                    Journey through Cambodia
                </h3>

                <p
                    class="text-[11px] sm:text-xs md:text-[11px] font-semibold text-gray-100 tracking-wide leading-snug"
                >
                    Sip the moment. Keep the memory.
                </p>

                <p
                    class="text-[9px] sm:text-xs font-light italic text-gray-300 tracking-wider"
                >
                    From Cambodia, with Rum!
                </p>
            </div>
        </div>

        <div class="flex-1 flex items-center justify-center w-full">
            <div
                class="map-frame relative w-full max-w-[100vw] md:max-w-[100vh] lg:max-w-[100vh] max-h-[80vh] md:max-h-[90vh] mx-auto -mt-[40px] md:-mt-[60px]"
            >
                <img
                    src="<?php echo e(asset('assets/images/bg-map.png')); ?>"
                    alt="Cambodia Background Map"
                    class="absolute inset-0 w-full h-full object-contain opacity-20 mix-blend-screen pointer-events-none"
                >

                <?php $__currentLoopData = $countrySides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrySide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div
                        class="absolute z-20 flex flex-col items-center transform -translate-x-1/2 -translate-y-1/2"
                        style="
                            top: <?php echo e($countrySide->position_top ?? 50); ?>%;
                            left: <?php echo e($countrySide->position_left ?? 50); ?>%;
                        "
                    >
                        <?php if($countrySide->slug === 'phnom-penh'): ?>
                            <span
                                class="province-label text-sm sm:text-2xl md:text-3xl mb-2"
                            >
                                <?php echo e($countrySide->name); ?>

                            </span>

                            <button
                                type="button"
                                class="map-dot block w-14 h-14 sm:w-22 sm:h-22 md:w-26 md:h-26 lg:w-30 lg:h-30 cursor-pointer hover:scale-110 transition-transform duration-200 drop-shadow-lg"
                                data-slug="<?php echo e($countrySide->slug); ?>"
                                aria-label="Open <?php echo e($countrySide->name); ?> map"
                            >
                                <img
                                    src="<?php echo e(asset('assets/images/phnom-penh-icon.png')); ?>"
                                    alt="<?php echo e($countrySide->name); ?>"
                                    class="w-full h-full object-contain pointer-events-none"
                                >
                            </button>
                        <?php elseif(
                            $countrySide->slug === 'battambang' ||
                            $countrySide->slug === 'sihanoukville'
                        ): ?>
                            <button
                                type="button"
                                class="map-dot map-dot-pulse block w-3.5 h-3.5 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full bg-[#c2a06d] border-2 border-white/60 cursor-pointer hover:scale-120 hover:bg-white transition-all duration-200"
                                data-slug="<?php echo e($countrySide->slug); ?>"
                                aria-label="Open <?php echo e($countrySide->name); ?> map"
                            ></button>

                            <span
                                class="province-label text-xs sm:text-xl md:text-2xl mt-4"
                            >
                                <?php echo e($countrySide->name); ?>

                            </span>
                        <?php else: ?>
                            <span
                                class="province-label text-xs sm:text-xl md:text-2xl mb-5"
                            >
                                <?php echo e($countrySide->name); ?>

                            </span>

                            <button
                                type="button"
                                class="map-dot map-dot-pulse block w-3.5 h-3.5 sm:w-5 sm:h-5 md:w-6 md:h-6 rounded-full bg-[#c2a06d] border-2 border-white/60 cursor-pointer hover:scale-120 hover:bg-white transition-all duration-200"
                                data-slug="<?php echo e($countrySide->slug); ?>"
                                aria-label="Open <?php echo e($countrySide->name); ?> map"
                            ></button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<div
    id="mapModal"
    class="hidden fixed inset-0 z-[9999] bg-black/80 backdrop-blur-sm flex items-center justify-center p-4"
>
    <div
        id="modalContainer"
        class="relative w-full max-w-5xl h-[85vh] bg-white rounded-2xl overflow-hidden shadow-2xl transition-all duration-300 transform scale-95 opacity-0"
    >
        <button
            id="closeMap"
            type="button"
            class="absolute top-4 right-4 z-40 bg-white/90 hover:bg-white text-black rounded-full w-10 h-10 flex items-center justify-center font-bold shadow-md transition-colors duration-200"
            aria-label="Close interactive map"
        >
            ✕
        </button>

        <iframe
            id="mapIframe"
            src=""
            title="Interactive venue map"
            class="w-full h-full border-0"
        ></iframe>

        <div
            id="detailContainer"
            class="hidden translate-x-full pointer-events-none shadow-xl"
        >
            <div id="cardContent"></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    const modal = document.getElementById('mapModal');
    const modalContainer = document.getElementById('modalContainer');
    const closeMapButton = document.getElementById('closeMap');
    const mapIframe = document.getElementById('mapIframe');
    const detailContainer = document.getElementById('detailContainer');
    const cardContent = document.getElementById('cardContent');

    const mapUrlTemplate = <?php echo json_encode(
        route('map.show', [
            'countrySide' => '__COUNTRY_SIDE__'
        ]), 512) ?>;

    const areaUrlTemplate = <?php echo json_encode(
        route('areas.show', [
            'area' => '__AREA__'
        ]), 512) ?>;

    function resetVenueCard() {
        detailContainer.classList.add(
            'hidden',
            'translate-x-full',
            'pointer-events-none'
        );

        detailContainer.classList.remove(
            'pointer-events-auto'
        );

        cardContent.innerHTML = '';
    }

    function openMapModal(slug) {
        const mapUrl = mapUrlTemplate.replace(
            '__COUNTRY_SIDE__',
            encodeURIComponent(slug)
        );

        resetVenueCard();

        closeMapButton.classList.remove('hidden');

        modal.classList.remove('hidden');

        requestAnimationFrame(function () {
            modalContainer.classList.remove(
                'scale-95',
                'opacity-0'
            );

            modalContainer.classList.add(
                'scale-100',
                'opacity-100'
            );
        });

        mapIframe.src = mapUrl;
    }

    function openVenueCard(areaId) {
        const areaUrl = areaUrlTemplate.replace(
            '__AREA__',
            encodeURIComponent(areaId)
        );

        closeMapButton.classList.add('hidden');

        detailContainer.classList.remove(
            'hidden',
            'pointer-events-none'
        );

        detailContainer.classList.add(
            'pointer-events-auto'
        );

        requestAnimationFrame(function () {
            detailContainer.classList.remove(
                'translate-x-full'
            );
        });

        cardContent.innerHTML = `
            <div class="p-8 text-gray-700">
                Loading venue...
            </div>
        `;

        fetch(areaUrl, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error(
                        'Venue could not be loaded.'
                    );
                }

                return response.text();
            })
            .then(function (html) {
                cardContent.innerHTML = html;
                initVenueSlider();
            })
            .catch(function (error) {
                console.error(error);

                cardContent.innerHTML = `
                    <div class="p-8 text-red-600">
                        <p class="font-semibold mb-4">
                            ${error.message}
                        </p>

                        <button
                            type="button"
                            data-close-venue-card
                            class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800"
                        >
                            Close
                        </button>
                    </div>
                `;
            });
    }

    function closeVenueCard(showMapCloseButton = true) {
        detailContainer.classList.add(
            'translate-x-full',
            'pointer-events-none'
        );

        detailContainer.classList.remove(
            'pointer-events-auto'
        );

        setTimeout(function () {
            detailContainer.classList.add('hidden');
            cardContent.innerHTML = '';

            if (
                showMapCloseButton &&
                !modal.classList.contains('hidden')
            ) {
                closeMapButton.classList.remove('hidden');
            }
        }, 500);
    }

    function closeMapModal() {
        closeMapButton.classList.add('hidden');

        closeVenueCard(false);

        modalContainer.classList.remove(
            'scale-100',
            'opacity-100'
        );

        modalContainer.classList.add(
            'scale-95',
            'opacity-0'
        );

        setTimeout(function () {
            modal.classList.add('hidden');
            mapIframe.src = '';
            resetVenueCard();
            closeMapButton.classList.remove('hidden');
        }, 300);
    }

    function initVenueSlider() {
        const slider = cardContent.querySelector('#slider');
        const nextButton = cardContent.querySelector('#next');
        const previousButton = cardContent.querySelector('#prev');

        if (!slider) {
            return;
        }

        if (nextButton) {
            nextButton.addEventListener('click', function () {
                slider.scrollBy({
                    left: slider.clientWidth,
                    behavior: 'smooth'
                });
            });
        }

        if (previousButton) {
            previousButton.addEventListener('click', function () {
                slider.scrollBy({
                    left: -slider.clientWidth,
                    behavior: 'smooth'
                });
            });
        }
    }

    cardContent.addEventListener('click', function (event) {
        const closeButton = event.target.closest(
            '[data-close-venue-card]'
        );

        if (!closeButton) {
            return;
        }

        event.preventDefault();
        event.stopPropagation();

        closeVenueCard();
    });

    document.querySelectorAll('.map-dot').forEach(function (dot) {
        dot.addEventListener('click', function () {
            openMapModal(this.dataset.slug);
        });
    });

    closeMapButton.addEventListener('click', function () {
        closeMapModal();
    });

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeMapModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (
            event.key === 'Escape' &&
            !modal.classList.contains('hidden')
        ) {
            if (!detailContainer.classList.contains('hidden')) {
                closeVenueCard();
            } else {
                closeMapModal();
            }
        }
    });

    window.addEventListener('message', function (event) {
        if (!event.data || typeof event.data !== 'object') {
            return;
        }

        if (event.data.type === 'show_card') {
            openVenueCard(event.data.area_id);
        }

        if (event.data.type === 'close_card') {
            closeVenueCard();
        }
    });

    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');

    if (burger && mobileMenu) {
        burger.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');

            const lines = burger.querySelectorAll('span');

            lines[0].classList.toggle('rotate-45');
            lines[0].classList.toggle('translate-y-2');

            lines[1].classList.toggle('opacity-0');

            lines[2].classList.toggle('-rotate-45');
            lines[2].classList.toggle('-translate-y-2');
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/kong-bunyim/Documents/projects/samai-laravel/resources/views/landing.blade.php ENDPATH**/ ?>