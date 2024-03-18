@php
    $routeName = request()
        ->route()
        ->getName();

@endphp

<div
    class="floating-button-container d-flex {{ $routeName == 'report.take' || $routeName == 'report.preview' || $routeName == 'report.create' || $routeName == 'report.success' || $routeName == 'report.show' || $routeName == 'news.index' || $routeName == 'news.show' || $routeName == 'tour.index' || $routeName == 'tour.show' || $routeName == 'culinary.index' || $routeName == 'culinary.show' ? 'd-none' : '' }} ">
    <button class="floating-button" onclick="window.location.href = '{{ route('report.take') }}'">
        <i class="fa-solid fa-camera"></i>
    </button>
</div>
<nav
    class="nav-mobile d-flex {{ $routeName == 'report.take' || $routeName == 'report.preview' || $routeName == 'report.create' || $routeName == 'report.success' || $routeName == 'report.show' || $routeName == 'news.index' || $routeName == 'news.show' || $routeName == 'tour.index' || $routeName == 'tour.show' || $routeName == 'culinary.index' || $routeName == 'culinary.show' ? 'd-none' : '' }}">
    <a href="{{ route('home') }}" class="{{ $routeName == 'home' ? 'active' : '' }}">
        <i class="fas fa-house"></i>
        Beranda
    </a>
    <a href="{{ route('report.my-report') }}" class="{{ $routeName == 'report.my-report' ? 'active' : '' }}">
        <i class="fas fa-solid fa-clipboard-list"></i>
        Laporan
    </a>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <a href="{{ route('notification.index') }}" class="{{ $routeName == 'notification.index' ? 'active' : '' }}">
        <i class="fas fa-bell"></i>
        Notifikasi
    </a>
    <a href="" class="">
        <i class="fas fa-user"></i>
        Profil
    </a>
</nav>
