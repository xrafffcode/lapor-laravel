<x-layouts.app title="Laporan Warga">
    @push('style')
        <style>
            #lottie {
                width: 250px;
                height: 250px;
            }
        </style>
    @endpush


    <h5>Laporan Warga</h5>

    <div class="d-flex flex-column">
        @forelse ($reports as $report)
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
        @empty
            <div class="d-flex flex-column justify-content-center align-items-center" style="height: 75vh">
                <div id="lottie"></div>
                <h5 class="mt-3">Belum ada laporan</h5>
                <x-ui.base-button class="w-50 mt-3 py-2" type="button" color="primary"
                    href="{{ route('report.take') }}">
                    Buat Laporan
                </x-ui.base-button>
            </div>
        @endforelse
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
