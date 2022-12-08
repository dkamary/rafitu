{{-- Contact form --}}

@php
    $formId = 'form-edit-page-with-text';
    $size = $size ?? 'large';
    $spacingY = $spacingY ?? 1;
    $spacingX = $spacingX ?? 0;
    $className = $className ?? '';
@endphp

<div class="row">
    <div @class([
        'mx-auto' => true,
        'col-12' => true,
        'col-xl-5 col-lg-6 col-md-7' => $size == 'medium',
        'col-xl-3 col-lg-4 col-md-6' => $size == 'small',
        'px-' . $spacingX => true,
        'py-' . $spacingY => true,
        $className => strlen(trim($className)) > 0,
    ])>

        <form action="{{ route('contact_submit') }}" method="post">
            @isset($title)
                @if(strlen(trim($title)) > 0)
                    <div class="mb-6 text-center border-bottom">
                        <h2>{{ $title }}</h2>
                    </div>
                @endif
            @endisset
            <div class="mb-3">
                <input type="text" name="name" id="name" class="form-control" placeholder="Votre nom" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Votre adresse email" required>
            </div>
            <div class="mb-3">
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Le sujet de la conversation" required>
            </div>
            <div class="mb-3">
                <textarea name="message" id="message" class="form-control" rows="10" placeholder="Votre message" required></textarea>
            </div>
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary">
                    Envoyer
                </button>
            </div>
            @csrf
        </form>

    </div>
</div>
