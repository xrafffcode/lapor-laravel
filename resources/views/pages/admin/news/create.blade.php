<x-layouts.admin title="Tambah Berita">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.berita.index') }}">Berita</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Berita</li>

    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Berita</h6>
                </x-slot>
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf
                    <x-forms.input label="Judul" name="title" id="title" />
                    <x-forms.input label="Slug" name="slug" id="slug" />
                    <x-forms.mde name="content" label="Konten" id="content" />
                    <x-forms.input label="Gambar" name="thumbnail" type="file" />
                    <x-ui.base-button color="primary" type="submit">
                        Tambah Berita
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
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
                $('#content').val(editor.getMarkdown());
            });
        </script>
    @endpush
</x-layouts.admin>
