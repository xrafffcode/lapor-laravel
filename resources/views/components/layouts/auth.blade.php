<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/assets/images/icon-app.png') }}" />

    <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    @stack('style')
</head>

<body style="background-color: #f7f7f7">


    <div class="max-w-screen-sm mx-auto bg-white vh-100">
        <div class="p-4">
            {{ $slot }}
        </div>
    </div>

    <script src="{{ asset('frontend/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    @stack('script')
</body>

</html>
