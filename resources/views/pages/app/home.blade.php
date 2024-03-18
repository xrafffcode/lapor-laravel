<x-layouts.app title="Home">
    @push('style')
        <style>
            #lottie {
                width: 250px;
                height: 250px;
            }
        </style>
    @endpush


    @auth
        @hasrole('resident')
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="fw-bold">Halo, {{ auth()->user()->resident->full_name }}</h6>
                <a class="text-decoration-none text-dark"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>

                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </a>
            </div>
        @endhasrole
    @endauth

    <div class="d-flex justify-content-between align-items-center py-3">
        <h6 class="fw-bold">Laporan Terbaru</h6>
        <a href="{{ route('report.index') }}" class="text-decoration-none text-dark">Lihat Semua</a>
    </div>
    <div class="d-flex flex-column">
        @foreach ($recentReports as $report)
            <div class="card card-report w-100 d-flex flex-row  mb-3"
                onclick="window.location.href = '{{ route('report.show', $report->id) }}'">

                <img src="{{ $report->image_url }}" alt="{{ $report->title }}" />

                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between align-items-center mb-1">
                        <div class="d-flex flex-row">
                            @if ($report->latestStatus->status == 'Menunggu')
                                <span class="badge bg-warning">{{ $report->latestStatus->status }}</span>
                            @elseif ($report->latestStatus->status == 'Diproses')
                                <span class="badge bg-primary">{{ $report->latestStatus->status }}</span>
                            @elseif ($report->latestStatus->status == 'Ditolak')
                                <span class="badge bg-danger">{{ $report->latestStatus->status }}</span>
                            @elseif ($report->latestStatus->status == 'Selesai')
                                <span class="badge bg-success">{{ $report->latestStatus->status }}</span>
                            @endif
                        </div>
                    </div>
                    <p class="card-title">{{ $report->title }}</p>
                </div>
            </div>
        @endforeach
    </div>


    @if (session('registerSuccess'))
        <div class="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-sm">
                    <div class="modal-body d-flex flex-column align-items-center">
                        <div id="lottie"></div>
                        <h6 class="fw-bold text-center mt-3">Yeay! Akun kamu berhasil dibuat</h6>
                        <p class="text-center">Anda bisa menikmati fitur-fitur yang ada di SCP</p>

                        <x-ui.base-button class="w-100 mt-3 py-2" type="button" color="primary">
                            Lanjutkan
                        </x-ui.base-button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
        <script>
            const modal = new bootstrap.Modal(document.querySelector('.modal'));
            modal.show();

            const btnContinue = document.querySelector('.modal .btn-primary');
            btnContinue.addEventListener('click', function() {
                modal.hide();
            });
        </script>
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
