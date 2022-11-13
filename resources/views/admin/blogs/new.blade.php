{{-- Edit template --}}

@extends('_layouts.back')

@section('meta_title')
    Nouvel article du blog
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Nouvel article du blog'])

    <div class="row">
        <div class="col-12">
            @include('admin.forms.blog-new')
        </div>
    </div>
@endsection
