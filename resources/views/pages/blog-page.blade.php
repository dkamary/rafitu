{{-- Home page --}}

@extends('_layouts.front')

@php

@endphp

@section('meta_title')
    {{ $page->title }}
@endsection

@section('meta_description')
{{ $page->description }}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $page->title])
@endsection

@section('main')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-7 col-md-8">
                @include('pages._partials.blog-page-content', ['page' => $page, 'hasTitle' => false])
            </div>
            <div class="col-12 col-sm-5 col-md-4">
                <div class="card my-4">
                    <div class="card-header">
                        <h3 class="fs-4 txt-rafitu">Les plus vus</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            @forelse (post_mostview(10) as $post)
                                <li>
                                    <a href="{{ route('static_pages', ['slug' => $post->slug]) }}" class="d-flex justify-content-between align-items-center">
                                        <em>{{ $post->title }}</em>
                                        <strong>{{ $post->views }} vue{{ $post->views > 1 ? 's' : '' }}</strong>
                                    </a>
                                </li>
                            @empty
                                <li><em>Il n'y a pas d'article pour le moment</em></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-header">
                        <h3 class="fs-4 txt-rafitu">Les derniers</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            @forelse (post_latest(10) as $post)
                                <li>
                                    <a href="{{ route('static_pages', ['slug' => $post->slug]) }}" class="d-flex justify-content-between align-items-center">
                                        <em>{{ $post->title }}</em>
                                        @if($post->views > 0)
                                        <strong>{{ $post->views }} vue{{ $post->views > 1 ? 's' : '' }}</strong>
                                        @endif
                                    </a>
                                </li>
                            @empty
                                <li><em>Il n'y a pas d'article pour le moment</em></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="card my-4">
                    <div class="card-header">
                        <h3 class="fs-4 txt-rafitu">Les incontournables</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'charte-confidentialite-et-cookies']) }}">
                                Charte de confidentialité et Cookies
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'reglement-trajet']) }}">
                                    Règlements sur les trajets
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'conditions-utilisation']) }}">
                                    Conditions d'utilisation
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'mentions-legales']) }}">
                                    Mentions légales
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'faq']) }}">FAQ</a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'qui-sommes-nous']) }}">Qui sommes-nous</a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'newsletter']) }}">Newsletter</a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'nos-valeurs']) }}">Nos valeurs, nos métiers</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@once
    @push('head')
        <style id="homepage-style">
            .homepage-features {
                margin-top: -11% !important;
            }

            .homepage-features .status-border {
                background: #ffffff;
                height: 100%;
            }

            .scam-warning .image-container img {
                height: 10rem;
                width: auto;
            }
        </style>
    @endpush
@endonce
