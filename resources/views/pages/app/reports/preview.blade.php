<x-layouts.app title="Review Foto Laporan">
    <x-slot name="appHeader">
        <x-ui.header-nav back-link-text="Review Foto Laporan" back-link="{{ route('report.take') }}" />
    </x-slot>

    <div class=" d-flex flex-column justify-content-center align-items-center">
        <img alt="image" id="image-preview" class="img-fluid rounded-2">

        <div class="d-flex justify-content-center mt-3 gap-3">
            <x-ui.base-button color="primary" outline="true" href="{{ route('report.take') }}">
                Ulangi Foto
            </x-ui.base-button>
            <x-ui.base-button color="primary" href="{{ route('report.create') }}">
                Gunakan Foto
            </x-ui.base-button>
        </div>
    </div>

    @push('script')
        <script>
            var image = localStorage.getItem('image');
            var imagePreview = document.getElementById('image-preview');
            imagePreview.src = image;
        </script>
    @endpush
</x-layouts.app>
