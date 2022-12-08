{{-- Edit Page : Text only --}}

@extends('_layouts.back')

@section('meta_title')
    {{ $page->title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', [
        'page_title' => $page->title,
        'page_parents' => [
            ['route' => 'pages_index', 'text' => 'Pages'],
        ]
    ])

    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            @include('_partials.back.notifications.flash-message')
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @include('admin.forms.page-edit-text', ['user' => $user, 'route' => $route])
        </div>
    </div>
@endsection

