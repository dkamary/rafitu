{{-- FAQ Form --}}

@php
    $isNew = !isset($faq) || is_null($faq->id);
@endphp

<form action="{{ route('admin_faq_save') }}" method="post">
    <div class="mb-3">
        <label for="question" class="form-label">Question</label>
        <input type="text" class="form-control" name="question" id="question" placeholder="La question" value="{{ $faq->question }}">
    </div>
    <div class="mb-3">
        <label for="answer" class="form-label">Réponse</label>
        <input type="text" class="form-control" name="answer" id="answer" placeholder="La réponse" value="{{ $faq->answer }}">
    </div>
    <div class="mb-3">
        <label for="rank" class="form-label">Position</label>
        <input type="number" class="form-control" name="rank" id="rank" min="1" max="255" value="{{ $faq->answer }}">
    </div>
    <div class="mb-3">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">
                Enregistrer
            </button>
        </div>
    </div>
    @csrf
    @if (!$isNew)
        <input type="hidden" name="id" value="{{ $faq->id }}">
    @endif
</form>
