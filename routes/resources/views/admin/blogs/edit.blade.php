{{-- Edit template --}}

@extends('_layouts.back')

@section('meta_title')
    {{ $page->title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Pages'])

    <div class="row">
        <div class="col-12">
            @include('admin.forms.blog-edit', ['page' => $page])
        </div>
    </div>
@endsection
