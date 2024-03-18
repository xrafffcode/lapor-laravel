<x-layouts.admin title="Laporan Warga">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Laporan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Detail Laporan</h6>
                </x-slot>
                <table class="table table-bordered">
                    <tr>
                        <th>Pelapor</th>
                        <td>{{ $report->resident->full_name }}</td>
                    </tr>
                    <tr>
                        <th>Judul</th>
                        <td>{{ $report->title }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $report->address }}</td>
                    </tr>
                    <tr>
                        <th>Latitude</th>
                        <td>{{ $report->latitude }}</td>
                    </tr>
                    <tr>
                        <th>Longitude</th>
                        <td>{{ $report->longitude }}</td>
                    </tr>
                    <tr>
                        <th>Map View</th>
                        <td>
                            <div id="map" style="height: 300px;"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $report->description }}</td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td>{{ $report->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($report->latestStatus->status == 'Menunggu')
                                <span class="badge bg-warning">{{ $report->latestStatus->status }}</span>
                            @elseif ($report->latestStatus->status == 'Diproses')
                                <span class="badge bg-primary">{{ $report->latestStatus->status }}</span>
                            @elseif ($report->latestStatus->status == 'Ditolak')
                                <span class="badge bg-danger">{{ $report->latestStatus->status }}</span>
                            @elseif ($report->latestStatus->status == 'Selesai')
                                <span class="badge bg-success">{{ $report->latestStatus->status }}</span>
                            @endif
                        </td>

                    </tr>
                </table>
            </x-ui.base-card>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Status Laporan</h6>
                </x-slot>

                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Waktu</th>
                    </tr>
                    @foreach ($statuses as $status)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($status->status == 'Menunggu')
                                    <span class="badge bg-warning">{{ $status->status }}</span>
                                @elseif ($status->status == 'Diproses')
                                    <span class="badge bg-primary">{{ $status->status }}</span>
                                @elseif ($status->status == 'Ditolak')
                                    <span class="badge bg-danger">{{ $status->status }}</span>
                                @elseif ($status->status == 'Selesai')
                                    <span class="badge bg-success">{{ $status->status }}</span>
                                @endif
                            </td>
                            <td>{{ $status->description }}</td>
                            <td>
                                @if ($status->image_url)
                                    <img src="{{ asset($status->image_url) }}" alt="image_url" width="100px">
                                @else
                                    <span class="badge bg-danger">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ $status->created_at }}</td>
                        </tr>
                    @endforeach
                </table>

                <x-slot name="footer">
                    <x-ui.base-button color="primary" data-bs-toggle="modal" data-bs-target="#addStatusModal">
                        Tambah Status
                    </x-ui.base-button>
                </x-slot>
            </x-ui.base-card>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addStatusModal" tabindex="-1" aria-labelledby="addStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.reports.status.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStatusModalLabel">Tambah Status Laporan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @php
                            $statuses = [
                                [
                                    'value' => 'Diproses',
                                    'label' => 'Diproses',
                                ],
                                [
                                    'value' => 'Ditolak',
                                    'label' => 'Ditolak',
                                ],
                                [
                                    'value' => 'Selesai',
                                    'label' => 'Selesai',
                                ],
                            ];
                        @endphp
                        <x-forms.select name="status" label="Status" :options="$statuses" key="value" value="label" />
                        <x-forms.textarea name="description" label="Deskripsi" id="description" />
                        <x-forms.input type="file" name="image" label="Gambar" id="image" />
                        <x-forms.input type="hidden" name="report_id" value="{{ $report->id }}" />
                    </div>

                    <div class="modal-footer">
                        <x-ui.base-button color="secondary" data-bs-dismiss="modal">
                            Tutup
                        </x-ui.base-button>
                        <x-ui.base-button type="submit" color="primary">
                            Simpan
                        </x-ui.base-button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('custom-scripts')
        <script>
            var mymap = L.map('map').setView([{{ $report->latitude }}, {{ $report->longitude }}], 13);

            var marker = L.marker([{{ $report->latitude }}, {{ $report->longitude }}]).addTo(mymap);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(mymap);

            marker.bindPopup("<b>Lokasi Laporan</b><br />berada di {{ $report->address }}").openPopup();
        </script>
        <script>
            @if ($errors->any())
                var myModal = new bootstrap.Modal(document.getElementById('addStatusModal'), {
                    keyboard: false
                });
                myModal.show();
            @endif
        </script>
    @endpush
</x-layouts.admin>
