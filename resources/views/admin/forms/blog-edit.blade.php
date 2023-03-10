{{-- blog edit page --}}
@php
    $formId = 'form-edit-page-with-text';
@endphp

<form action="{{ route('admin_blog_edit', ['page' => $page->id]) }}" method="post" id="{{ $formId }}">
    @if($page->id)
        <div class="mb-3">
            <label class="form-label text-info">
                Prévisualiser: <a href="{{ route('static_pages', ['slug' => $page->slug]) }}" target="_blank">{{ route('static_pages', ['slug' => $page->slug]) }}</a>
            </label>
        </div>
    @endif
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $page->title }}">
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">URL</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ $page->slug }}" readonly disabled>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control">{!! $page->description !!}</textarea>
    </div>
    <div class="mb-3">
        <label for="content-wysiwyg" class="form-label">Contenu</label>
        <textarea name="content" id="content" class="form-control" rows="10">{!! $page->content ?? '<p></p>' !!}</textarea>
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
    <input type="hidden" name="route" value="{{ $route ?? 'admin_blog_index' }}">
</form>

@once
    @push('head')
        {{--  --}}
    @endpush

    @push('footer')
        <script src="https://cdn.tiny.cloud/1/dviruupf3fk2hf5cgzannqrlgyv58fj65b3bgjdca5y9t9qr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#content',
                plugins: [
                    'advlist','autolink',
                    'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
                    'fullscreen','insertdatetime','media','table','help','wordcount', 'image'
                ],
                toolbar: 'undo redo | casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help',
                images_upload_url: '{{ route('admin_upload_upload') }}',
            });
        </script>
    @endpush
@endonce
