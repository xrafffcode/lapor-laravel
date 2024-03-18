<x-layouts.admin title="Kuliner">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item active" aria-current="page">Kuliner</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <x-ui.base-button color="primary" type="button" href="{{ route('admin.kuliner.create') }}">
                        Tambah Kuliner
                    </x-ui.base-button>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Thumbnail</th>
                            <th>Nama</th>
                            <th>Deksripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($culinaries as $culinary)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset($culinary->thumbnail_url) }}" alt="{{ $culinary->name }}">
                                </td>
                                <td>{{ $culinary->title }}</td>
                                <td>{!! \Illuminate\Support\Str::limit($culinary->description, 100) !!}</td>
                                <td>
                                    <x-ui.base-button color="primary" type="button"
                                        href="{{ route('admin.kuliner.edit', $culinary->id) }}">
                                        Edit
                                    </x-ui.base-button>
                                    <x-ui.base-button color="danger" type="button"
                                        onclick="deleteData('{{ route('admin.kuliner.destroy', $culinary->id) }}')">
                                        Hapus
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
