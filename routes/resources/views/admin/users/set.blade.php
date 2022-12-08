{{-- User Set (edit / new) --}}

@extends('_layouts.back')

@php
    $isNew = !isset($user) || is_null($user) || is_null($user->id);
    $user = isset($user) ? $user : User::createEmptyUser();
    $page_title = $isNew ? 'Nouvel utilisateur' : 'Edition utilisateur';
@endphp

@section('meta_title')
    {{ $page_title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => $page_title, ['page_parents' => [['route' => 'admin_user_index', 'text' => 'Utilisateurs']]]])

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    @include('_partials.back.notifications.flash-message')
                </div>
            </div>

            @include('admin.forms.user', ['user' => $user])

        </div>
    </div>
@endsection
