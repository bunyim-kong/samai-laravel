<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>@yield('title', 'Samai Admin')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .admin-sidebar {
            scrollbar-width: none;
        }

        .admin-sidebar::-webkit-scrollbar {
            display: none;
        }

        @media (max-width: 767px) {
            .admin-responsive-table,
            .admin-responsive-table tbody {
                display: block;
                width: 100%;
            }

            .admin-responsive-table thead {
                display: none;
            }

            .admin-responsive-table tbody tr {
                display: block;
                padding: 1rem;
            }

            .admin-responsive-table tbody td {
                display: grid;
                grid-template-columns: minmax(7rem, 40%) minmax(0, 1fr);
                align-items: start;
                gap: 0.75rem;
                padding: 0.5rem 0;
                text-align: right;
                overflow-wrap: anywhere;
            }

            .admin-responsive-table tbody td:first-child {
                display: block;
                padding-top: 0;
                padding-bottom: 0.875rem;
                text-align: left;
            }

            .admin-responsive-table tbody td[data-label]::before {
                content: attr(data-label);
                color: #6b7280;
                font-size: 0.6875rem;
                font-weight: 600;
                letter-spacing: 0.05em;
                line-height: 1.25rem;
                text-align: left;
                text-transform: uppercase;
            }

            .admin-responsive-table tbody td[data-actions] {
                align-items: center;
                padding-top: 0.875rem;
            }

            .admin-responsive-table tbody td[data-actions] > div {
                justify-content: flex-end;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-[#f4f1ed] text-[#2d241c]">

<div class="min-h-screen flex">

    <aside
        id="adminSidebar"
        class="admin-sidebar fixed inset-y-0 left-0 z-50 w-64 bg-[#3a3942] text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 overflow-y-auto"
    >
        <div class="min-h-full flex flex-col">

            <div class="px-6 py-6 border-b border-white/10">
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3"
                >
                    <div class="w-11 h-11 rounded-xl bg-[#b7936e] flex items-center justify-center text-[#3a3942]">
                        <i class="fa-solid fa-map-location-dot text-xl"></i>
                    </div>

                    <div>
                        <h1 class="font-bold text-lg">
                            Samai Distilling
                        </h1>

                        <p class="text-xs text-gray-300">
                            Rum Map Management
                        </p>
                    </div>
                </a>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-[#b7936e] text-[#2d241c]'
                        : 'text-gray-200 hover:bg-white/10' }}"
                >
                    <i class="fa-solid fa-gauge-high w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a
                    href="{{ route('admin.country-sides.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('admin.country-sides.*')
                        ? 'bg-[#b7936e] text-[#2d241c]'
                        : 'text-gray-200 hover:bg-white/10' }}"
                >
                    <i class="fa-solid fa-map w-5"></i>
                    <span class="font-medium">Country Sides</span>
                </a>

                <a
                    href="{{ route('admin.areas.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('admin.areas.*')
                        ? 'bg-[#b7936e] text-[#2d241c]'
                        : 'text-gray-200 hover:bg-white/10' }}"
                >
                    <i class="fa-solid fa-location-dot w-5"></i>
                    <span class="font-medium">Areas</span>
                </a>

                <div class="pt-4 mt-4 border-t border-white/10">

                    <a
                        href="{{ route('welcome') }}"
                        target="_blank"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-200 hover:bg-white/10 transition"
                    >
                        <i class="fa-solid fa-arrow-up-right-from-square w-5"></i>
                        <span class="font-medium">View Website</span>
                    </a>

                </div>

            </nav>

            <div class="p-4 border-t border-white/10">

                @auth
                    <div class="flex items-center gap-3 px-3 py-3">
                        <div class="w-10 h-10 rounded-full bg-[#b7936e] text-[#2d241c] flex items-center justify-center font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-sm truncate">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-gray-300 truncate">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="mt-2"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-300 hover:text-white hover:bg-red-500/20 transition cursor-pointer"
                        >
                            <i class="fa-solid fa-right-from-bracket w-5"></i>

                            <span class="font-medium">
                                Logout
                            </span>
                        </button>
                    </form>
                @endauth

            </div>

        </div>
    </aside>

    <div class="flex-1 lg:ml-64 min-w-0">

        <header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-[#ddd4ca]">
            <div class="h-18 px-4 sm:px-6 lg:px-8 flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <button
                        id="sidebarToggle"
                        type="button"
                        class="lg:hidden w-10 h-10 rounded-xl border border-[#ddd4ca] flex items-center justify-center hover:bg-[#f4f1ed]"
                    >
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <div>
                        <h2 class="font-bold text-lg sm:text-xl">
                            @yield('page-title', 'Dashboard')
                        </h2>

                        <p class="text-xs sm:text-sm text-gray-500">
                            @yield('page-description', 'Manage your Samai Rum Map')
                        </p>
                    </div>

                </div>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">

            @if (session('success'))
                <div
                    id="successMessage"
                    class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700"
                >
                    <i class="fa-solid fa-circle-check mt-1"></i>

                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-red-700">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-circle-exclamation mt-1"></i>

                        <div>
                            <p class="font-semibold text-sm mb-2">
                                Please fix the following errors:
                            </p>

                            <ul class="list-disc pl-5 space-y-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

<div
    id="sidebarOverlay"
    class="hidden fixed inset-0 z-40 bg-black/50 lg:hidden"
></div>

<script>
    const sidebar = document.getElementById('adminSidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.remove('hidden');
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
    }

    sidebarToggle?.addEventListener('click', openSidebar);
    sidebarOverlay?.addEventListener('click', closeSidebar);

    const successMessage = document.getElementById('successMessage');

    if (successMessage) {
        setTimeout(() => {
            successMessage.remove();
        }, 4000);
    }
</script>

@stack('scripts')

</body>
</html>
