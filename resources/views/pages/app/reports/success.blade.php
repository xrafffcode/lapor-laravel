<x-layouts.app title="Review Foto Laporan">
    @push('style')
        <style>
            #lottie {
                width: 250px;
                height: 250px;
            }
        </style>
    @endpush


    <div class="d-flex flex-column justify-content-center align-items-center vh-100">
        <div id="lottie"></div>

        <h6 class="fw-bold text-center mt-3">Yeay! Laporan kamu berhasil dibuat</h6>
        <p class="text-center">Anda bisa melihat laporan kamu di halaman laporan</p>

        <x-ui.base-button class="w-50 mt-3 py-2" type="button" color="primary" href="{{ route('report.index') }}">
            Lihat Laporan
        </x-ui.base-button>
    </div>

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
        <script>
            var animation = bodymovin.loadAnimation({
                container: document.getElementById('lottie'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '{{ asset('frontend/assets/images/lottie/register-success.json') }}'
            })
        </script>
    @endpush
</x-layouts.app>
