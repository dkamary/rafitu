{{-- Dashboard User --}}

@php
    $user = Auth::user();
    $now = new \DateTime();
    $other = $last->getClient();
@endphp

@extends('dashboard._layout.base')

@section('meta_title')
    Mes messages
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Mes messages'])
@endsection

@section('dashboard_content')
    <div class="row mb-4 bg-rafitu text-white">
        <div class="col-12">
            <h2 class="fw-bold fs-3 my-4">{{ $other->getFullname() }}</h2>
        </div>
    </div>
    <div class="message-container">
        <div class="row message-history">
            <div class="col-12 d-flex flex-column px-0">
                @foreach ($messages as $msg)
                    <div class="message-item my-3 {{ is_null($msg->sender) ? 'me' : 'you' }}" id="message-{{ $msg->id }}">{{ $msg->content }}</div>
                @endforeach
            </div>
        </div>
        <div class="row mt-5 message-send-form border-top">
            <div class="col-12">
                <form action="#" method="get" id="form-message-send">
                    <div class="row py-3">
                        <div class="col-10">
                            <input type="text" name="content" id="content" class="form-control" placeholder="Votre message ..." autocomplete="off">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-secondary btn-block">
                                Envoyer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@once

    @push('head')
        <style>
            .message-container {

            }

            .message-history {
                height: 80%;
            }

            .message-send-form {
                height: 20%;
            }

            .message-item {
                padding: .5rem 1.5rem;
                border-radius: 5px;
            }

            .message-item.me {
                background-color: #4c6dff;
                color: #fff;
                border: solid 1px #3a59e5;
                align-self: flex-end;
                text-align: right;
            }

            .message-item.you {
                background-color: #c3c3c3;
                color: #fff;
                border: solid 1px #acacac;
                align-self: flex-start;
                text-align: left;
            }
        </style>
    @endpush

    @push('footer')
        <script>
            window.addEventListener("DOMContentLoaded", event => {
                const form = document.querySelector("#form-message-send");
                if(form) {
                    form.addEventListener("submit", e => {
                        e.preventDefault();

                        const history = document.querySelector(".message-history > .col-12");
                        const message = form.querySelector("#content");

                        const $ = window.jQuery;
                        if($) {
                            $.ajax({
                                type: 'post',
                                url: '{{ route('message_send') }}',
                                data: {
                                    token: '{{ $last->token }}',
                                    message: message.value.trim(),
                                    user_id: null,
                                    client_id: {{ (int)$other->id }},
                                    sender: null
                                }
                            }).done(response => {
                                const msg = document.createElement("div");
                                msg.classList.add("message-item", "my-3", "me");
                                msg.innerHTML = response.message.content;
                                history.appendChild(msg);
                            }).fail(xhr => {
                                alert(xhr.status + ' - ' + xhr.statusText);
                            }).always(() => {
                                message.value = "";
                            });
                        } else {
                            console.error("Pas de jQuery T_T");
                        }
                    });
                }

                setInterval(() => {
                    const $ = window.jQuery;
                    if($) {
                        $.ajax({
                            type: 'get',
                            url: '{{ route('message_last') }}',
                            data: {
                                token: '{{ $last->token }}',
                            }
                        }).done(response => {
                            if(!response.message.id) {
                                console.debug("Message vide");
                                return;
                            }

                            if(!response.message.sender) {
                                console.debug("Mon propre message!");
                                return;
                            }

                            let msg = document.querySelector('#message-' + response.message.id);

                            if(msg) return;

                            msg = document.createElement("div");
                            msg.classList.add("message-item", "my-3", "you");
                            msg.innerHTML = response.message.content;
                            msg.id = "message-" + response.message.id;

                            const history = document.querySelector(".message-history > .col-12");
                            history.appendChild(msg);
                        }).fail(xhr => {
                            alert(xhr.status + ' - ' + xhr.statusText);
                        }).always(() => {
                            // message.value = "";
                        });
                    } else {
                        console.error("Pas de jQuery T_T");
                    }
                }, 30000);
            });
        </script>
    @endpush

@endonce
