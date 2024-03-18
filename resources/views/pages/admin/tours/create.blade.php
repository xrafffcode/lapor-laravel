<x-layouts.admin title="Tambah Tempat Wisata">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.wisata.index') }}">Tempat Wisata</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Tempat Wisata</li>

    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.wisata.store') }}" method="POST" enctype="multipart/form-data" id="form">
                @csrf
                <x-ui.base-card class="mb-3">
                    <x-slot name="header">
                        <h6>Tambah Tempat Wisata</h6>
                    </x-slot>

                    <x-forms.input label="Nama Tempat" name="title" id="title" />
                    <x-forms.input label="Slug" name="slug" id="slug" />
                    <x-forms.mde name="description" label="Deskripsi Tempat" id="description" />
                    <x-forms.input label="Gambar" name="thumbnail" type="file" />
                    <div class="row align-items-center mb-3">
                        <div class="col-6">
                            <x-forms.input label="Latitude" name="latitude" id="latitude" :mb="0" />
                        </div>
                        <div class="col-6">
                            <x-forms.input label="Longitude" name="longitude" id="longitude" :mb="0" />
                        </div>
                    </div>
                    <x-forms.input label="Alamat" name="address" id="address" />
                    <x-ui.base-button color="primary" type="button" id="btn-map" class="mb-3">
                        Dapatkan Lokasi
                    </x-ui.base-button>
                    <div id="map" style="height: 300px;" class="mb-3"></div>
                    <x-forms.input label="Harga Tiket" name="price" id="price" />

                </x-ui.base-card>
                <x-ui.base-card class="mb-3">
                    <x-slot name="header">
                        <h6>Foto Tempat Wisata</h6>
                    </x-slot>
                    <div class="row">
                        <div class="col-md-4">
                            <x-forms.input label="Foto 1" name="images[]" type="file" />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input label="Foto 2" name="images[]" type="file" />
                        </div>
                        <div class="col-md-4">
                            <x-forms.input label="Foto 3" name="images[]" type="file" />
                        </div>
                    </div>

                </x-ui.base-card>

                <x-ui.base-button color="primary" type="submit">
                    Tambah Tempat Wisata
                </x-ui.base-button>
            </form>

        </div>
    </div>

    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                $('#title').keyup(function() {
                    $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
                });
            });
        </script>
        <script>
            $('#form').submit(function() {
                $('#description').val(editor.getMarkdown());
            });
        </script>
        <script>
            const latitude = document.getElementById('latitude');
            const longitude = document.getElementById('longitude');

            const btnMap = document.getElementById('btn-map');

            btnMap.addEventListener('click', function() {
                const latitudeValue = latitude.value;
                const longitudeValue = longitude.value;

                var mymap = L.map('map').setView([latitudeValue, longitudeValue], 13);

                var marker = L.marker([latitudeValue, longitudeValue]).addTo(mymap);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                }).addTo(mymap);


                var geocodingUrl =
                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitudeValue}&lon=${longitudeValue}&zoom=18&addressdetails=1`;

                fetch(geocodingUrl)
                    .then(response => response.json())
                    .then(data => {
                        const display_name = data.display_name;

                        marker.bindPopup(display_name).openPopup();

                        $('#address').val(display_name);
                    });



            });
        </script>
    @endpush
</x-layouts.admin>
