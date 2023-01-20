{{-- Newsletter forms --}}

@php
    $isInline = $isInline ?? true;
@endphp

<form action="{{ route('newsletter_submit') }}" method="POST" class="newsletter-form">
    <div class="row">
        <div class="{{ $container_class ?? 'col-12' }}">
            @if($isInline)
            <div class="input-group w-70">
                <input type="email" name="email" id="email" class="form-control br-ts-3  br-bs-3 " placeholder="Email" placeholder="Votre adresse email" required>
                <div class=" ">
                    <button type="submit" class="{{ $button_classes ?? 'btn btn-primary br-ts-0  br-bs-0' }}">
                        {!! $button_text ?? 'Souscrire' !!}
                    </button>
                </div>
            </div>
            @else
                @if(isset($newsletter_title))
                    <h3 class="fs-4 mb-4 border-none">{!! $newsletter_title !!}</h3>
                @endif
            <input type="email" name="email" id="email" class="form-control" placeholder="Votre adresse email" required>
            <button type="submit" class="{{ $button_classes ?? 'btn btn-primary my-3' }}">
                {!! $button_text ?? 'Souscrire' !!}
            </button>
            @endif
        </div>
    </div>

    @csrf

</form>
