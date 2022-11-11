{{-- Breadcrumbs --}}

<div class="page-header">
    <h4 class="page-title">{{ $page_title ?? 'Administration' }}</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $page_title ?? 'Administration' }}</li>
    </ol>
</div>
