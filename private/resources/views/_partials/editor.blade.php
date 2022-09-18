@push('footer')
    <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script>
        // https://www.tiny.cloud/docs/configure/file-image-upload/
        // https://www.tiny.cloud/docs/advanced/php-upload-handler/
        tinymce.init({
            selector: '.text-editor',
            directionality: '{{ get_option('language_direction', 'ltr') }}',
            language: '{{ file_exists(public_path('assets/vendors/tinymce/langs/' . app()->getLocale() . '.js')) ? app()->getLocale() : 'en' }}',
            content_css: '{{ asset('assets/css/editor.css') }}',
            height: '500px',

            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;

                xhr.open('POST', '{{ route('upload.editor') }}');
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));

                xhr.onload = function () {
                    var json;

                    if (xhr.status !== 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location !== 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            },
            relative_urls: false,
            convert_urls: true,
            remove_script_host: false,

            plugins: 'code image wordcount link textcolor directionality table charmap lists visualblocks',
            image_title: true,
            image_caption: true,
            branding: false,
            menubar: false,
            // https://www.tiny.cloud/docs/advanced/editor-control-identifiers/#toolbarcontrols
            toolbar: 'formatselect bold italic underline strikethrough |  superscript subscript ltr rtl | ' +
                'alignleft aligncenter alignright alignjustify bullist numlist | ' +
                'cut copy paste undo redo | link unlink image table charmap | removeformat | visualblocks code',

            block_formats: 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;Div=div;Blockquote=blockquote'
        });
    </script>
@endpush
