<x-layouts.app title="Ambil Foto Laporan">
    <x-slot name="appHeader">
        <x-ui.header-nav back-link-text="Ambil Foto Laporan" back-link="{{ route('home') }}" />
    </x-slot>

    <div class=" d-flex flex-column justify-content-center align-items-center">
        <video autoplay="true" id="video-webcam">
            Browsermu tidak mendukung bro, upgrade donk!
        </video>

        <div class="d-flex align-items-center mt-3">
            <hr class="flex-grow-1">
            <span class="mx-2">atau</span>
            <hr class="flex-grow-1">
        </div>

        <input type="file" id="upload" accept="image/*" capture="camera"  class="form-control mt-3" onchange="previewImage()" />

        <div class="d-flex justify-content-center mt-3 position-absolute bottom-0">
            <button class="btn btn-primary btn-snap mb-3 " onclick="takeSnapshot()">
                <i class="fas fa-camera"></i>
            </button>
        </div>

    </div>

    @push('script')
        <script type="text/javascript">
            var video = document.querySelector("#video-webcam");

            navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia ||
                navigator.msGetUserMedia || navigator.oGetUserMedia;

            if (navigator.getUserMedia) {
                navigator.getUserMedia({
                    video: true
                }, handleVideo, videoError);
            }

            function handleVideo(stream) {
                video.srcObject = stream;
            }

            function videoError(e) {
                alert("Izinkan menggunakan webcam untuk demo!")
            }
        </script>

        <script>
            function takeSnapshot() {
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                var video = document.getElementById('video-webcam');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0);
                var dataURL = canvas.toDataURL('image/png');
                localStorage.setItem('image', dataURL);

                window.location.href = '{{ route('report.preview') }}';
            }

            function previewImage() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("upload").files[0]);

                oFReader.onload = function(oFREvent) {
                    localStorage.setItem('image', oFREvent.target.result);
                    window.location.href = '{{ route('report.preview') }}';
                };
            }
        </script>
    @endpush
</x-layouts.app>
