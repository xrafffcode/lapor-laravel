<x-layouts.admin title="Edit Berita">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.berita.index') }}">Berita</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Berita</li>

    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Edit Berita</h6>
                </x-slot>
                <form action="{{ route('admin.berita.update', $news->id) }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf
                    @method('PUT')
                    <x-forms.input label="Judul" name="title" id="title" :value="$news->title" />
                    <x-forms.input label="Slug" name="slug" id="slug" :value="$news->slug" />
                    <x-forms.mde name="content" label="Konten" id="content" :value="$news->content" />
                    <img src="{{ asset($news->thumbnail_url) }}" alt="" width="100" class="mb-3">
                    <x-forms.input label="Gambar" name="thumbnail" type="file" />
                    <x-ui.base-button color="primary" type="submit">
                        Edit Berita
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
