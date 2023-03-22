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
        <input type="text" name="title" id="title" class="form-control" value="{{ $page->title }}" required maxlength="255">
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">URL</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ $page->slug }}" readonly disabled>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control" required maxlength="255">{!! $page->description !!}</textarea>
    </div>
    <div class="mb-3">
        <label for="content-wysiwyg" class="form-label">Contenu</label>
        <textarea name="content" id="content" class="form-control" rows="10">{!! $page->content ?? '<p></p>' !!}</textarea>
    </div>
    <div class="mb-3">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-primary" id="btn-submit">
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
                    'fullscreen','insertdatetime','media','table','help','wordcount',
                ],
                toolbar: 'undo redo | casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help',
                images_upload_url: '{{ route('admin_upload_upload') }}',
            });
        </script>
        <script id="garde-fou-de-description">
            window.addEventListener("DOMContentLoaded", event => {
                const title = document.querySelector("#title");
                if(title) {
                    title.addEventListener("keyup", event => {
                        title.value = cleanupDescription(title.value);
                    });
                    title.addEventListener("paste", event => {
                        title.value = cleanupDescription(event.clipboardData.getData("text/plain"));
                    });
                }

                const description = document.querySelector("#description");
                if(description) {
                    description.addEventListener("keyup", event => {
                        description.value = cleanupDescription(description.value);
                    });
                    description.addEventListener("paste", event => {
                        description.value = cleanupDescription(event.clipboardData.getData("text/plain"));
                    });
                }

                const form = document.querySelector("#{{ $formId }}");
                if(form) {
                    form.addEventListener("submit", event => {
                        console.debug("form submit");
                        const title = document.querySelector("#title");
                        const description = document.querySelector("#description");
                        if(title.value.length < 3) {
                            alert("Le titre est trop court !");
                            title.style.border = "solid 1px #ee0000";
                            event.preventDefault();
                        } else if(title.value.length > 254) {
                            alert("Le titre est trop long !");
                            title.style.border = "solid 1px #ee0000";
                            event.preventDefault();
                        } else if(description.value.length < 3) {
                            alert("La description est trop courte !");
                            description.style.border = "solid 1px #ee0000";
                            event.preventDefault();
                        } else if(description.value.length > 254) {
                            alert("La description est trop longue !");
                            description.style.border = "solid 1px #ee0000";
                            event.preventDefault();
                        }
                        event.preventDefault();
                    });

                    const submitBtn = form.querySelector("#btn-submit");
                    if(submitBtn) {
                        submitBtn.addEventListener("click", event => {

                            const title = document.querySelector("#title");
                            const description = document.querySelector("#description");
                            if(title.value.length < 3) {
                                alert("Le titre est trop court !");
                                title.style.border = "solid 1px #ee0000";
                                event.preventDefault();
                                return false;
                            } else if(title.value.length > 254) {
                                alert("Le titre est trop long !");
                                title.style.border = "solid 1px #ee0000";
                                event.preventDefault();
                                return false;
                            } else if(description.value.length < 3) {
                                alert("La description est trop courte !");
                                description.style.border = "solid 1px #ee0000";
                                event.preventDefault();
                                return false;
                            } else if(description.value.length > 254) {
                                alert("La description est trop longue !");
                                description.style.border = "solid 1px #ee0000";
                                event.preventDefault();
                                return false;
                            }

                            console.debug("Triggering form submit");
                            form.submit();
                        });
                    } else {
                        console.warn("No submit button found!!!");
                    }
                }
            });

            function cleanupDescription(texte) {
                let value = texte.replace(/<[^>]+>/g, '');
                value = value.slice(0, 254);
                return value;
            }
        </script>
    @endpush
@endonce
