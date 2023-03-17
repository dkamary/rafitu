{{-- Edit blog page --}}

@php
    $formId = 'form-blog-edit';
@endphp

<form action="{{ route('admin_blog_new') }}" method="post" id="{{ $formId }}">
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" name="title" id="title" class="form-control" value="" placeholder="Titre de l'article" required title="Titre de l'article">
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">URL</label>
        <input type="text" name="slug" id="slug" class="form-control" value="" readonly disabled>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control" placeholder="Courte description" required title="Description utile pour le résumé de l'article" maxlength="255"></textarea>
    </div>
    <div class="mb-3">
        <label for="content-wysiwyg" class="form-label">Contenu</label>
        <textarea name="content" id="content" class="form-control" rows="10" placeholder="Contenu de l'article" required></textarea>
    </div>
    <div class="mb-3">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                Enregistrer
            </button>
        </div>
    </div>
    @csrf
</form>

@once
    @push('footer')
    <script src="https://cdn.tiny.cloud/1/dviruupf3fk2hf5cgzannqrlgyv58fj65b3bgjdca5y9t9qr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#content',
                plugins: [
                    'advlist','autolink',
                    'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
                    'fullscreen','insertdatetime','media','table','help','wordcount'
                ],
                toolbar: 'undo redo | casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help',
                images_upload_url: '{{ route('admin_upload_upload') }}',
            });
            </script>
    @endpush
@endonce
