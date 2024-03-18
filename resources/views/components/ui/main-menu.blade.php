@props([
    'icon' => '',
    'title' => '',
    'route' => '',
])

{{-- <div class="main-menu mt-5">
     <img src="{{ asset('frontend/assets/images/icon/ic-microphone.png') }}" alt="icon" class="icon">
     <p>Lapor Lur</p>
 </div> --}}

<a href="{{ $route }}" class="main-menu ">
    <div class="icon">
        <img src="{{ asset('frontend/assets/images/icon/' . $icon) }}" alt="icon">
    </div>
    <p>{{ $title }}</p>
</a>
