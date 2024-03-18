<x-layouts.app title="Review Foto Laporan">
    @push('style')
        <style>
            #lottie {
                width: 250px;
                height: 250px;
            }
        </style>
    @endpush


    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 75vh;">
        <div id="lottie"></div>

        <h6 class="fw-bold text-center mt-3">Fitur ini masih dalam tahap pengembangan</h6>
        <p class="text-center">Fitur ini akan segera hadir</p>

    </div>

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
        <script>
            var animation = bodymovin.loadAnimation({
                container: document.getElementById('lottie'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '{{ asset('frontend/assets/images/lottie/not-found.json') }}'
            })
        </script>
    @endpush
</x-layouts.app>
