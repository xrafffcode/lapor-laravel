<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ $title }}</title>

    <!-- Meta Tag For SEO -->
    <meta name="description"
        content="{{ $metaDescription ?? 'SCP adalah sebuah aplikasi smart city yang dibuat oleh Synchronize Team' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? '' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'Synchronize Team' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="google" content="notranslate">
    <meta name="format-detection" content="telephone=no">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description"
        content="{{ $metaDescription ?? 'SCP adalah sebuah aplikasi smart city yang dibuat oleh Synchronize Team' }}">
    <meta property="og:image" content="{{ $metaImage ?? '' }}">
    <meta property="og:url" content="{{ $metaUrl ?? '' }}">
    <meta property="og:site_name" content="{{ $metaSiteName ?? 'SCP' }}">
    <meta property="og:type" content="website">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description"
        content="{{ $metaDescription ?? 'SCP adalah sebuah aplikasi smart city yang dibuat oleh Synchronize Team' }}">
    <meta name="twitter:image" content="{{ $metaImage ?? '' }}">
    <meta name="twitter:url" content="{{ $metaUrl ?? '' }}">
    <meta name="twitter:site" content="{{ $metaSiteName ?? 'SCP' }}">
    <meta name="twitter:creator" content="{{ $metaAuthor ?? 'Synchronize Team' }}">
    <meta name="twitter:image:alt" content="{{ $title }}">

    <!-- PWA  -->
    <meta name="apple-mobile-web-app-title" content="SCP">
    <meta name="application-name" content="SCP">
    <meta name="theme-color" content="#fff" />
    <link rel="apple-touch-icon" href="{{ asset('frontend/assets/images/logo.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/assets/images/icon-app.png') }}" />


    <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    @stack('style')
</head>

<body>
    <div class="max-w-screen-sm mx-auto bg-white min-vh-100">
        {{ $appHeader ?? '' }}
        <div class="{{ $padding ?? 'p-4' }}">
            {{ $slot }}
            <x-ui.mobile-navbar />
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://kit.fontawesome.com/7b36f2302d.js" crossorigin="anonymous"></script>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
        (registration) => {
            console.log("Service worker registration succeeded:", registration);
        },
        (error) => {
            console.error(`Service worker registration failed: ${error}`);
        },
        );
    } else {
        console.error("Service workers are not supported.");
    }
    </script>


    @stack('script')
</body>

</html>
