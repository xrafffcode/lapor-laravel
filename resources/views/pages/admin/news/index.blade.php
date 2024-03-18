<x-layouts.admin title="Berita">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item active" aria-current="page">Berita</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <x-ui.base-button color="primary" type="button" href="{{ route('admin.berita.create') }}">
                        Tambah Berita
                    </x-ui.base-button>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Thumbnail</th>
                            <th>Judul</th>
                            <th>Content</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($news as $new)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset($new->thumbnail_url) }}" alt="" width="100">
                                </td>
                                <td>{{ $new->title }}</td>
                                <td>{{ $new->short_content }}</td>
                                <td>{{ $new->created_at }}</td>
                                <td>
                                    <x-ui.base-button color="primary" type="button"
                                        href="{{ route('admin.berita.show', $new->id) }}">
                                        Detail
                                    </x-ui.base-button>

                                    <x-ui.base-button color="warning" type="button"
                                        href="{{ route('admin.berita.edit', $new->id) }}">
                                        Edit
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
