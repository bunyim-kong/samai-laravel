<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Samai Rum Map')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        @font-face {
            font-family: 'Amsterdam Four';
            src: url('{{ asset('assets/fonts/Amsterdam Four_ttf 400.ttf') }}')
                format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
            font-family: 'Montserrat', sans-serif;
        }
    </style>

    @stack('styles')
</head>
<body>
    @yield('content')

    @stack('scripts')
</body>
</html>