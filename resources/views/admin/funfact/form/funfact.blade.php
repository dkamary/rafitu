{{-- User form for Admin --}}

@php
    $isNew = is_null($funfact->id);
@endphp

<form action="{{ route('admin_funfact_save') }}" method="post" enctype="multipart/form-data" class="user-admin-form">
    <div class="row my-3">
        <div class="col-12 col-md-6">
            <div class="row mb-3">
                <label for="title" class="col-12 col-sm-4 fw-bold">Titre</label>
                <div class="col-12 col-sm-8 required">
                    <input type="text" class="form-control" id="title" name="title"
                    value="{{ $isNew ? old('title') : $funfact->title }}"
                    placeholder="Saisir le titre"
                    title="Le titre ne doit pas commencer par un chiffre mais de caractères alphabétique"
                    required
                    >
                </div>
            </div>
            <div class="row mb-3">
                <label for="lastname" class="col-12 col-sm-4 fw-bold">Nom</label>
                <div class="col-12 col-sm-8 required">
                    <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                        <img id="image-preview"
                        src="{{ get_funfact_image($funfact->image) }}"
                        alt="{{ $funfact->id.'-'.$funfact->title }}"
                        class="mb-4"
                        style="width: auto; height: 10rem; cursor: pointer;"
                        onclick="document.querySelector('#image').click();"
                        >
                        <button type="button" class="btn btn-outline-info my-2" id="change-image" onclick="document.querySelector('#image').click();">
                            <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;
                            Changer l'image
                        </button>
                        <input type="file" name="image" id="image" class="form-control w-50 d-none">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-12 col-sm-4 fw-bold">Icone</label>
                <div class="col-12 col-sm-8 required">
                    <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                        <img id="icone-preview"
                        src="{{ get_funfact_icon($funfact->icon) }}"
                        alt="{{ $funfact->id.'-'.$funfact->title }}"
                        class="mb-4"
                        style="width: auto; height: 10rem; cursor: pointer;"
                        onclick="document.querySelector('#icon').click();"
                        >
                        <button type="button" class="btn btn-outline-info my-2" id="change-icon" onclick="document.querySelector('#icon').click();">
                            <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;
                            Changer l'icone
                        </button>
                        <input type="file" name="icon" id="icon" class="form-control w-50 d-none">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="birthdate" class="col-12 col-sm-4 fw-bold">Valeur</label>
                <div class="col-12 col-sm-8">
                    <input type="text" name="count" id="count" placeholder="Saisir une valeur" class="form-control" value="{{ $funfact->count }}">
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-12 text-center">
            <p class="mb-3 fs-6">
                <em>Les zones de saisie marquées par l'icone <img src="{{ asset('images/medical.png') }}" style="height: 1em; width: auto;" /> sont <strong>obligatoires</strong></em>
            </p>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-floppy-o fa-2x me-2" aria-hidden="true"></i>&nbsp;
                @if($isNew)
                    Créer le nouveau fait amusant
                @else
                    Enregistrer les modifications
                @endif
            </button>
        </div>
    </div>
    @csrf
    @if (!$isNew)
        <input type="hidden" name="id" value="{{ $funfact->id }}">
    @endif
</form>


@once
    @push('footer')
        <script id="form-user-edit">
            window.addEventListener("DOMContentLoaded", event => {
                manageImage();
                manageIcon();
            });

            function manageImage() {
                const imgPreview = document.querySelector("#image-preview");
                if(!imgPreview) {
                    imgPreview.addEventListener("click", e => {
                        e.preventDefault();
                        const image = document.querySelector("#image");

                        if(image) image.click();
                    });
                } else {
                    console.warn("No IMG preview!");
                }

                const image = document.querySelector('#image');
                if(image) {
                    image.addEventListener('change', e => {
                        if(e.target.files.length > 0){
                            var src = URL.createObjectURL(e.target.files[0]);
                            imgPreview.src = src;
                            imgPreview.style.display = "block";
                        }
                    });
                } else {
                    console.warn("No Image!!!");
                }
            }

            function manageIcon() {
                const iconPreview = document.querySelector("#icon-preview");
                if(!iconPreview) {
                    iconPreview.addEventListener("click", e => {
                        e.preventDefault();
                        const icon = document.querySelector("#icon");

                        if(icon) icon.click();
                    });
                } else {
                    console.warn("No ICON preview!");
                }

                const icon = document.querySelector('#icon');
                if(icon) {
                    icon.addEventListener('change', e => {
                        if(e.target.files.length > 0){
                            var src = URL.createObjectURL(e.target.files[0]);
                            iconPreview.src = src;
                            iconPreview.style.display = "block";
                        }
                    });
                } else {
                    console.warn("No icon!!!");
                }
            }
        </script>
    @endpush
@endonce
