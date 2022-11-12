{{-- Breadcrumbs --}}

<div class="page-header">
    <h4 class="page-title">{{ $page_title ?? 'Administration' }}</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Tableau de bord</a></li>

        @isset($page_parents)
            @foreach ($page_parents as $page_link)
                <li class="breadcrumb-item"><a href="{{ route($page_link['route']) }}">{!! $page_link['text'] !!}</a></li>
            @endforeach
        @endisset

        @if ($page_title != 'Tableau de bord')
            <li class="breadcrumb-item active" aria-current="page">{!! $page_title ?? 'Administration' !!}</li>
        @endif
    </ol>
</div>
