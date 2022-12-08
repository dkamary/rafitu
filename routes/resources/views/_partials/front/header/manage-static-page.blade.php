{{-- Manage Static Pages --}}
@php
    $currentUser = Auth::user();
@endphp

@isset($page)
    @if($user->user_type_id == 1)
        @if ($page->page_category_id == 1)
            <li aria-haspopup="true"><a href="{{ route('pages_index') }}/{{ $page->slug }}">Editer la page</a></li>
        @else
            <li aria-haspopup="true"><a href="{{ route('pages_index') }}/{{ $page->slug }}">La page</a></li>
        @endif
    @endif
@endisset
