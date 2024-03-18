<x-layouts.app title="Buat Laporan">
    @push('style')
        <style>
            #map {
                height: 180px;
            }

            .leaflet-top,
            .leaflet-bottom {
                z-index: 0 !important;
            }
        </style>
    @endpush


    <x-slot name="appHeader">
        <x-ui.header-nav back-link-text="Buat Laporan" back-link="{{ route('report.preview') }}" />
    </x-slot>


    <div class="pb-5">
        <div class="alert alert-danger d-none" id="error-alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                <ul id="error-message" class="mb-0">
                </ul>
            </div>
        </div>

        <img alt="image" id="image-preview" class="img-fluid rounded-2 mb-3">
        <x-forms.input type="text" name="title" label="Judul Laporan" class="py-2" id="title" />
        <x-forms.textarea name="description" label="Ceritakan Laporan Kamu" class="py-2" id="description" />

        <div class="mb-3">
            <label for="map" class="form-label">Lokasi Laporan</label>
            <div id="map"></div>
        </div>

        <x-forms.textarea name="spesific_location" label="Tambahkan Ciri Khusus Lokasi Laporan (Opsional)"
            class="py-2" id="spesific_location" />



        <x-ui.base-button color="primary" class="w-100 mb-5" id="submit">
            Buat Laporan
        </x-ui.base-button>
    </div>


    @push('script')
        <script>
            var image = localStorage.getItem('image');
            var imagePreview = document.getElementById('image-preview');
            imagePreview.src = image;
        </script>

        <script>
            var map = document.getElementById('map');


            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                localStorage.setItem('lat', lat);
                localStorage.setItem('lng', lng);

                var mymap = L.map('map').setView([lat, lng], 13);

                var marker = L.marker([lat, lng]).addTo(mymap);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                }).addTo(mymap);

                var geocodingUrl =
                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`;

                fetch(geocodingUrl)
                    .then(response => response.json())
                    .then(data => {
                        localStorage.setItem('address', data.display_name);
                        var address = data.display_name;
                        marker.bindPopup(`<b>Lokasi Laporan</b><br />Kamu berada di ${address}`).openPopup();
                    })
                    .catch(error => console.error('Error fetching reverse geocoding data:', error));
            });
        </script>


        <script>
            const submitButton = document.getElementById('submit');

            submitButton.addEventListener('click', function(e) {
                e.preventDefault();

                submitButton.innerHTML = `<i class="fas fa-circle-notch fa-spin"></i>`;
                submitButton.disabled = true;

                const image = localStorage.getItem('image');
                const title = document.getElementById('title').value;
                const description = document.getElementById('description').value;
                const address = localStorage.getItem('address');
                const spesific_location = document.getElementById('spesific_location').value;
                const lat = localStorage.getItem('lat');
                const lng = localStorage.getItem('lng');

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const formData = new FormData();
                formData.append('image', image);
                formData.append('title', title);
                formData.append('description', description);
                formData.append('address', address);
                formData.append('spesific_location', spesific_location);

                formData.append('latitude', lat);
                formData.append('longitude', lng);


                axios.post('{{ route('report.store') }}', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(function(response) {
                        window.location.href = '{{ route('report.success') }}';

                        localStorage.removeItem('image');
                        localStorage.removeItem('lat');
                        localStorage.removeItem('lng');
                    })
                    .catch(function(error) {
                        if (error.response.status == 422) {
                            const errors = error.response.data.errors;

                            const errorAlert = document.getElementById('error-alert');
                            const errorMessage = document.getElementById('error-message');

                            errorMessage.innerHTML = '';

                            errorAlert.classList.remove('d-none');

                            for (const field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    errors[field].forEach((error) => {
                                        const li = document.createElement('li');
                                        li.textContent = `${error}`;
                                        errorMessage.appendChild(li);
                                    });
                                }
                            }

                            submitButton.innerHTML = `Buat Laporan`;
                            submitButton.disabled = false;


                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                        }

                        submitButton.innerHTML = `Buat Laporan`;
                        submitButton.disabled = false;

                    });
            });
        </script>
    @endpush
</x-layouts.app>
