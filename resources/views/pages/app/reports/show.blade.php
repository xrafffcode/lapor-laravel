<x-layouts.app title="{{ $report->title }}" padding="p-0">
    @push('style')
        <link rel="stylesheet" href="{{ asset('frontend/css/show-report.css') }}?v={{ time() }}">
    @endpush

    <div class="position-relative ">
        <img src="{{ asset($report->image_url) }}" alt="report-img" class="img-fluid header-image"
            onclick="showImage('{{ asset($report->image_url) }}')">

        <div class="header-nav">
            <a href="{{ route('report.index') }}" class="text-decoration-none ">
                <i class="fas fa-chevron-left"></i>
            </a>
            <p id="report-code" class="mb-0">{{ $report->code }}</p>
        </div>
    </div>

    <div class="p-3">

        <x-ui.base-card>
            <x-slot name="header">
                <h6>Detail Laporan</h6>
            </x-slot>

            <p class="mb-0">Permasalahan: </p>
            <p class="mb-3">{{ $report->title }}</p>

            <p class="mb-0">Deskripsi: </p>
            <p class="mb-5">{{ $report->description }}</p>

        </x-ui.base-card>

        <x-ui.base-card class="mt-3">
            <x-slot name="header">
                <h6>Status Laporan</h6>
            </x-slot>

            @foreach ($statuses as $status)
                <div class="timeline-item">
                    <div class="timeline-date">{{ $status->created_at }}</div>
                    <div class="timeline-title">{{ $status->status }}</div>
                    <article>
                        <p>{{ $status->description }}</p>
                        @if ($status->image_url)
                            <img src="{{ asset($status->image_url) }}" alt="status-img">
                        @endif
                    </article>
                </div>
            @endforeach
        </x-ui.base-card>
    </div>

    @push('script')
        <script>
            $(window).scroll(function() {
                if ($(window).scrollTop() >= 100) {
                    $('.header-nav').addClass('fixed-top');
                } else {
                    $('.header-nav').removeClass('fixed-top');
                }
            });
        </script>
        <script>
            function showImage(src) {
                const modal = document.createElement('div');
                modal.classList.add('modal');
                modal.classList.add('fade');
                modal.classList.add('show');
                modal.setAttribute('id', 'modal');
                modal.setAttribute('tabindex', '-1');
                modal.setAttribute('aria-labelledby', 'modalLabel');
                modal.setAttribute('aria-hidden', 'true');

                const modalDialog = document.createElement('div');
                modalDialog.classList.add('modal-dialog');
                modalDialog.classList.add('modal-dialog-centered');
                modalDialog.classList.add('modal-xl');
                modalDialog.setAttribute('role', 'document');

                const modalContent = document.createElement('div');
                modalContent.classList.add('modal-content');

                const modalBody = document.createElement('div');
                modalBody.classList.add('modal-body');

                const image = document.createElement('img');
                image.setAttribute('src', src);
                image.classList.add('img-fluid');

                modalBody.appendChild(image);
                modalContent.appendChild(modalBody);
                modalDialog.appendChild(modalContent);
                modal.appendChild(modalDialog);

                document.body.appendChild(modal);

                $('#modal').modal('show');
            }
        </script>
    @endpush
</x-layouts.app>
