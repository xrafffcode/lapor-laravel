<x-layouts.admin title="Laporan Warga">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item active" aria-current="page">Laporan</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->title }}</td>
                                <td>{{ $report->address }}</td>
                                <td>
                                    <span
                                        class="badge {{ $report->statuses->first()->status == 'Menunggu ' ? 'bg-warning' : ($report->statuses->first()->status == 'approved' ? 'bg-success' : 'bg-danger') }}">
                                        {{ $report->statuses->first()->status }}
                                    </span>
                                </td>
                                <td>{{ $report->created_at }}</td>
                                <td>
                                    <x-ui.base-button color="primary" type="button"
                                        href="{{ route('admin.reports.show', $report->id) }}">
                                        Detail
                                    </x-ui.base-button>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-ui.datatables>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
