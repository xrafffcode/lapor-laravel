<x-layouts.admin title="Tambah Kuliner">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.kuliner.index') }}">Kuliner</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Kuliner</li>

    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Kuliner</h6>
                </x-slot>
                <form action="{{ route('admin.kuliner.store') }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf
                    <x-forms.input label="Nama Kuliner" name="title" id="title" />
                    <x-forms.input label="Slug" name="slug" id="slug" />
                    <x-forms.mde name="description" label="Konten" id="description" />
                    <x-forms.input label="Gambar" name="thumbnail" type="file" />
                    <x-ui.base-button color="primary" type="submit">
                        Tambah Kuliner
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
                $('#description').val(editor.getMarkdown());
            });
        </script>
    @endpush
</x-layouts.admin>
