@push('plugin-styles')
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
@endpush

@props([
    'name' => false,
    'label' => false,
    'value' => false,
    'class' => false,
    'id' => false,
    'placeholder' => false,
    'rows' => false,
    'cols' => false,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'autofocus' => false,
])

@php
    $classes = 'form-control';
    $classes .= $errors->has($name) ? ' is-invalid' : '';
@endphp

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <div id="editor"></div>
    <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}">
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


@push('plugin-scripts')
    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
@endpush

@push('custom-scripts')
    <script>
        const Editor = toastui.Editor;

        const editor = new Editor({
            el: document.querySelector('#editor'),
            height: '500px',
            initialEditType: 'markdown',
            previewStyle: 'vertical',
            initialValue: `{{ $value }}`,
        });
    </script>
@endpush
