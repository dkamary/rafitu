{{-- Dashboard User --}}

@php
    $user = Auth::user();
    $now = new \DateTime();
    $other = $last->getClient();
    $lastMsg = null;

    $avatar = $other ? $other->getAvatar() : null;
    $driverAvatar = $avatar;
    if($avatar) {
        if(strpos($avatar, 'http') !== false) {
            $driverAvatar = $avatar;
        } else {
            $driverAvatar = asset('avatars/' . $avatar);
        }
    } else {
        $driverAvatar = asset('avatars/user-01.svg');
    }
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
                    <div id="message-{{ $msg->id }}" @class(['message-wrapper', 'me' => is_null($msg->sender), 'you' => !is_null($msg->sender)])>
                        @if($msg->sender != $user->id)
                            <div class="message-user">
                                <a href="#" class="avatar" onclick="return false;">
                                    <img src="{{ $driverAvatar }}" alt="{{ $other->getFullname() }}">
                                </a>
                                <span class="state"></span>
                            </div>
                        @endif
                        <div class="message-item">{{ $msg->content }}</div>
                        <div class="message-info">
                            <span class="date">{{ $msg->displayDate() }}</span>
                        </div>
                    </div>
                    {{-- <div class="message-item my-3 {{ is_null($msg->sender) ? 'me' : 'you' }}" id="message-{{ $msg->id }}">{{ $msg->content }}</div> --}}
                    @php
                        $lastMsg = $msg;
                    @endphp
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
        @include('dashboard.message._partials.style')
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
                                    user_id: {{ $last->user_id ?? 'null' }},
                                    client_id: {{ (int)$other->id }},
                                    sender: {{ $last->user_id ?? 'null' }}
                                }
                            }).done(response => {
                                const msg = appendMessage({ message: response.message, me: true });
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

                            const all = document.querySelectorAll('.message-item.you');
                            if(response.isConnected) {
                                if(all && all.length) {
                                    all.forEach(elt => {
                                        elt.classList.add('connected');
                                    });
                                }
                            } else {
                                if(all && all.length) {
                                    all.forEach(elt => {
                                        elt.classList.remove('connected');
                                    });
                                }
                            }

                            if(!response.message.id) {
                                console.debug("Message vide");
                                return;
                            }

                            if(!response.message.sender) {
                                console.debug("Mon propre message!");
                                return;
                            }

                            let msg = appendMessage({ message: response.message, me: false });

                            if(msg) return;

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

            const appendMessage = ({ message, me }) => {
                let msg = document.querySelector('#message-' + message.id);

                if(msg) return null;

                msg = document.createElement("div");
                msg.classList.add("message-wrapper", (me ? "me" : "you"));
                msg.id = "message-" + message.id;

                const user = document.createElement("div");
                const link = document.createElement("a");
                const img = document.createElement("img");
                const state = document.createElement("span");
                const item = document.createElement("div");
                const info = document.createElement("div");
                const date = document.createElement("span");

                user.classList.add("message-user");

                link.classList.add("avatar");
                link.addEventListener("click", e => { e.preventDefault() });

                if(!me) {
                    img.src = "{{ $driverAvatar }}";
                    img.alt = "{{ $other->getFullname() }}";

                    link.appendChild(img);

                    state.classList.add("state");
                    user.appendChild(link);
                    user.appendChild(state);

                    msg.appendChild(user);
                }

                item.classList.add("message-item");
                item.innerHTML = message.content;

                msg.appendChild(item);

                date.classList.add("date");
                date.innerHTML = message.date_sent;

                info.classList.add("message-info");
                info.appendChild(date);
                msg.append(info);

                return msg;
            };
        </script>
    @endpush

@endonce
