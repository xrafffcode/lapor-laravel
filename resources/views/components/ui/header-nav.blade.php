<div class="container py-2 shadow-sm" id="app-header">
    <div class="d-flex align-items-center">
        <a href="{{ $attributes->get('back-link') }}" class="btn btn-link text-decoration-none text-black btn-arrow-left">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h6 class="me-3 mb-0">
            {{ $attributes->get('back-link-text') }}
        </h6>
    </div>
</div>

@push('script')
    <script>
        var appHeader = document.getElementById('app-header');
        var sticky = appHeader.offsetTop;

        window.onscroll = function() {
            if (window.pageYOffset > sticky) {
                appHeader.classList.add('sticky');
            } else {
                appHeader.classList.remove('sticky');
            }
        }
    </script>
@endpush
