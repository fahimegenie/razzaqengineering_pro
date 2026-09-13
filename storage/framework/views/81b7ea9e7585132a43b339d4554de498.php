<div 
    x-data="{
        editor: null,
        editorId: '<?php echo e($editorId); ?>',
        value: $wire.entangle('value'),
        field: '<?php echo e($field); ?>',
        height: '<?php echo e($height); ?>',
        readOnly: <?php echo e($readOnly ? 'true' : 'false'); ?>,
        isInternalUpdate: false,
        
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
                    
                    // When editor changes
                    let debounceTimeout;
                    editor.model.document.on('change:data', () => {
                        this.isInternalUpdate = true;
                        const data = editor.getData();
                        this.value = data;
                        
                        // Har keypress pe server request rokne ke liye debounce lagaya hy
                        clearTimeout(debounceTimeout);
                        debounceTimeout = setTimeout(() => {
                            if (this.field) {
                                $wire.call('updateField', { 
                                    field: this.field, 
                                    value: data 
                                });
                            }
                            this.isInternalUpdate = false;
                        }, 300); // 300ms ka gap
                    });
                    
                    // When Alpine value changes
                    this.$watch('value', (newValue) => {
                        if (!this.isInternalUpdate && editor.getData() !== newValue) {
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
                placeholder: '<?php echo e($placeholder); ?>',
                readOnly: this.readOnly,
                licenseKey: '',
            };
            
            <?php if($toolbar === 'full'): ?>
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
            <?php elseif($toolbar === 'basic'): ?>
                return {
                    ...baseConfig,
                    toolbar: {
                        items: ['heading', '|', 'bold', 'italic', 'underline', '|', 'link', '|', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
                    }
                };
            <?php else: ?>
                return {
                    ...baseConfig,
                    toolbar: { items: ['bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList'] }
                };
            <?php endif; ?>
        },
        
        destroyEditor() {
            if (this.editor) {
                this.editor.destroy().then(() => { this.editor = null; }).catch(() => {});
            }
        }
    }"
    x-init="initEditor()"
    wire:ignore
    x-on:cleanup.window="destroyEditor()"
>
    <div class="ckeditor-wrapper">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label): ?>
            <label class="form-label fw-semibold"><?php echo e($label); ?></label>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <textarea id="<?php echo e($editorId); ?>" class="form-control" style="display: none;"></textarea>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .ck-editor__editable {
        min-height: <?php echo e($height); ?>;
    }
    .ck.ck-editor__main > .ck-editor__editable {
        min-height: <?php echo e($height); ?>;
    }
</style>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/html/projects/saif/razzaq-engineering/resources/views/livewire/components/ck-editor.blade.php ENDPATH**/ ?>