{{-- Home page --}}

@extends('_layouts.front')

@php

@endphp

@section('meta_title')
    Actualités
@endsection

@section('meta_description')
    Liste des articles concernant les actualités
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Actualités'])
@endsection

@section('main')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-7 col-md-8">
                @forelse ($posts as $post)
                    @php
                        $readArticle = route('static_pages', ['slug' => $post->slug]);
                    @endphp
                    <article class="row my-4 bg-white pt-4">
                        <header class="col-12">
                            <h4 class="fw-bold txt-rafitu">
                                <a href="{{ $readArticle }}">{{ $post->title }}</a>
                            </h4>
                            <hr>
                        </header>
                        <main class="col-12">
                            <p class="my-3">
                                {{ $post->description }}
                            </p>
                            <p class="mb-3 text-end">
                                <a href="{{ $readArticle }}" class="fw-bold txt-rafitu">Lire l'article &hellip;</a>
                            </p>
                        </main>
                    </article>
                @empty
                    <div class="row my-4 bg-white py-4">
                        <div class="col-12">
                            <em>Il n'y a pas encore d'article pour le moment</em>
                        </div>
                    </div>
                @endforelse
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
