<x-layouts.admin title="Tempat Wisata">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item active" aria-current="page">Tempat Wisata</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <x-ui.base-button color="primary" type="button" href="{{ route('admin.wisata.create') }}">
                        Tambah Tempat Wisata
                    </x-ui.base-button>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($tours as $tour)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tour->title }}</td>
                                <td>{{ $tour->address }}</td>
                                <td>{{ $tour->latitude }}</td>
                                <td>{{ $tour->longitude }}</td>
                                <td>
                                    <x-ui.base-button color="primary" type="button"
                                        href="{{ route('admin.wisata.edit', $tour->id) }}">
                                        Edit
                                    </x-ui.base-button>
                                    <form action="{{ route('admin.wisata.destroy', $tour->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.base-button color="danger" type="submit">
                                            Hapus
                                        </x-ui.base-button>
                                    </form>
                                </td>
                        @endforeach
                    </x-slot>
                </x-ui.datatables>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
