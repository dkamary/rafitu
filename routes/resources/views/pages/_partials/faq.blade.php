{{-- FAQ templates --}}

<div class="accordion accordion-flush" id="faq-accordion">
    @foreach ($faq as $row)
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-faq-heading-{{ $row->id }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-faq-{{ $row->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="flush-faq-{{ $row->id }}">
                    {!! $row->question !!}
                </button>
            </h2>
            <div id="flush-faq-{{ $row->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="flush-faq-heading-{{ $row->id }}"
                data-bs-parent="#faq-accordion">
                <div class="accordion-body">
                    {!! $row->answer !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
