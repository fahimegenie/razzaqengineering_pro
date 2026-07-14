{{-- File: resources/views/livewire/components/ck-editor.blade.php --}}
<div 
    x-data="{
        editor: null,
        editorId: '{{ $editorId }}',
        value: @entangle('value'),
        height: '{{ $height }}',
        readOnly: {{ $readOnly ? 'true' : 'false' }},
        
        initEditor() {
            if (typeof ClassicEditor === 'undefined') {
                setTimeout(() => this.initEditor(), 200);
                return;
            }
            
            const config = this.getEditorConfig();
            
            ClassicEditor
                .create(document.querySelector('#' + this.editorId), config)
                .then(editor => {
                    this.editor = editor;
                    
                    if (this.value) {
                        editor.setData(this.value);
                    }
                    
                    editor.model.document.on('change:data', () => {
                        this.value = editor.getData();
                    });
                    
                    this.$watch('value', (newValue) => {
                        if (editor.getData() !== newValue) {
                            editor.setData(newValue || '');
                        }
                    });
                })
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });
        },
        
        getEditorConfig() {
            const baseConfig = {
                placeholder: '{{ $placeholder }}',
                readOnly: this.readOnly,
                licenseKey: '',
            };
            
            @if($toolbar === 'full')
                return {
                    ...baseConfig,
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', '|',
                            'link', 'blockQuote', 'codeBlock', '|',
                            'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'imageUpload', 'mediaEmbed', '|',
                            'insertTable', '|',
                            'alignment', '|',
                            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                            'highlight', 'horizontalLine', '|',
                            'undo', 'redo'
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    image: {
                        toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
                    },
                    table: {
                        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                    },
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        ]
                    }
                };
            @elseif($toolbar === 'basic')
                return {
                    ...baseConfig,
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', '|',
                            'link', '|',
                            'bulletedList', 'numberedList', '|',
                            'undo', 'redo'
                        ]
                    }
                };
            @else
                return {
                    ...baseConfig,
                    toolbar: {
                        items: ['bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList']
                    }
                };
            @endif
        },
        
        destroyEditor() {
            if (this.editor) {
                this.editor.destroy().then(() => { this.editor = null; }).catch(() => {});
            }
        }
    }"
    x-init="initEditor()"
    wire:ignore
>
    <div class="ckeditor-wrapper">
        @if($label)
            <label class="form-label fw-semibold">{{ $label }}</label>
        @endif
        <textarea id="{{ $editorId }}" class="form-control" style="display: none;"></textarea>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
@endpush

@push('styles')
<style>
    .ck-editor__editable {
        min-height: {{ $height }};
    }
    .ck.ck-editor__main > .ck-editor__editable {
        min-height: {{ $height }};
    }
</style>
@endpush