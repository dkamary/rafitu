{{-- Dashboard User --}}

@php
    $user = Auth::user();
    $now = new \DateTime();
    $other = $last->getUser();
    $client = $last->getClient();

    // $avatar = $other ? $other->getAvatar() : null;
    // $driverAvatar = $avatar;
    // if($avatar) {
    //     if(strpos($avatar, 'http') !== false) {
    //         $driverAvatar = $avatar;
    //     } else {
    //         $driverAvatar = asset('avatars/' . $avatar);
    //     }
    // } else {
    //     $driverAvatar = asset('avatars/user-01.svg');
    // }

    $avatar = get_avatar($conversation['receiver']);
    $firstname = isset($conversation['receiver']) && !is_null($conversation['receiver']) ? $conversation['receiver']->firstname : 'RAFITU';
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
            {{-- @dump([
                // 'last' => $last,
                // 'other' => $other,
                // 'client' => $client,
                'conversation' => [
                    'receiver' => $conversation['receiver']->email,
                    'sender' => $conversation['sender']->email
                ],
            ]) --}}
            <h2 class="fw-bold fs-3 my-4">{{ $firstname }}</h2>
        </div>
    </div>
    <div class="message-container">
        <div class="row message-history">
            <div class="col-12 d-flex flex-column px-0">
                @foreach ($messages as $msg)
                    @php
                        $isMe = ($msg->sender == $user->id || is_null($msg->sender));
                    @endphp
                <div id="message-{{ $msg->id }}"
                    data-user_id="{{ $msg->user_id }}"
                    data-client_id="{{ $msg->client_id }}"
                    data-sender_id="{{ $msg->sender }}"
                    @class([
                        'message-wrapper',
                        'me' => $isMe,
                        'you' => !$isMe,
                        ])
                >
                    @if(!$isMe)
                        <div class="message-user">
                            <a href="#" class="avatar" onclick="return false;">
                                <img src="{{ $avatar }}" alt="{{ $other->getFullname() }}">
                            </a>
                            <span class="state"></span>
                        </div>
                    @endif
                    <div class="message-item">{{ $msg->content }}</div>
                    <div class="message-info {{ $msg->is_seen ? 'seen' : '' }}">
                        <span class="date">{{ $msg->displayDate() }}</span>
                        <a href="#" class="remove-message" data-id="{{ $msg->id }}">&times;</a>
                    </div>
                </div>
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
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                <span class="d-none d-md-inline">&nbsp;Envoyer</span>
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
            var currentMessage = 0;

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
                                    user_id: {{ is_null($last->user_id) ? 'null' : $last->user_id }},
                                    client_id: {{ $last->client_id }},
                                    sender: {{ (int)$user->id }}
                                }
                            }).done(response => {
                                const msg = appendMessage({
                                    message: response.message,
                                    me: true
                                });

                                if(!msg) return;

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

                const messageRemover = document.querySelectorAll(".remove-message");
                if(messageRemover && messageRemover.length > 0) {
                    messageRemover.forEach(remover => {
                        remover.addEventListener("click", removeMessage);
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

                            const all = document.querySelectorAll('.message-user .state');
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

                            if(!response.message.id){
                                console.debug("Empty message");
                                return;
                            }

                            // if(response.message.sender == {{ $user->id }}) {
                            //     console.debug("Mon propre message!");
                            //     return;
                            // }

                            let msg = appendMessage({ message: response.message });
                            if(!msg) return;

                            const history = document.querySelector(".message-history > .col-12");
                            history.appendChild(msg);

                            currentMessage = setInterval(() => {
                                if(messageSeen({ message })) {
                                    clearInterval(currentMessage);
                                }
                            }, 1000);

                            console.debug({
                                interval: currentMessage
                            });

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
                console.debug("AppendMessage");
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
                const remove = document.createElement("a");

                user.classList.add("message-user");

                link.classList.add("avatar");
                link.addEventListener("click", e => { e.preventDefault() });

                if(!me) {
                    img.src = "{{ $avatar }}";
                    img.alt = "{{ $other->getFullname() }}";

                    link.appendChild(img);

                    state.classList.add("state", "connected");
                    user.appendChild(link);
                    user.appendChild(state);

                    msg.appendChild(user);
                }

                item.classList.add("message-item");
                item.innerHTML = message.content;

                msg.appendChild(item);

                date.classList.add("date");
                date.innerHTML = message.date_sent;

                remove.dataset.id = message.id;
                remove.classList.add('remove-message');
                remove.innerHTML = '&times;';
                remove.addEventListener('click', removeMessage);
                info.appendChild(remove); console.debug("Append Info!");

                info.classList.add("message-info");
                info.appendChild(date);
                msg.append(info);

                return msg;
            };

            const messageSeen = ({message}) => {
                console.debug("Check if message has been seen");
                if(document.hasHocus()) {
                    const msg = document.querySelector('#message-' + message.id);
                    if(msg) {
                        if(isInViewport(msg)) {
                            console.debug("In viewport");
                            updateMessageStatus({ message });

                            return true;

                        } else {
                            console.debug("Not in the viewport!");
                            return false;
                        }
                    } else {
                        console.warn('Le message ne peut pas être selectionné: ' + '#message-' + message.id);
                        return false;
                    }
                }
            };

            const isInViewport = (element) => {
                const rect = element.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                );
            }

            const updateMessageStatus = ({ message }) => {
                const $ = window.jQuery;
                if(!$) {
                    console.error("No JQUERY!!!");

                    return;
                }

                $.ajax({
                    type: 'post',
                    url: '{{ route("message_seen") }}',
                    data: {
                        id: message.id
                    }
                }).done(response => {
                    console.debug("Message updated");
                    console.debug("Message #message-%d has been seen!", message.id);
                })
                .fail(xhr => {})
                .always(() => {});
            };

            const removeMessage = e => {
                e.preventDefault();
                if(!confirm("Voulez-vous effacer ce message ?")) return;

                const target = e.currentTarget;
                const id = target.dataset.id;
                const $ = window.jQuery;

                $.ajax({
                    type: 'post',
                    url: '{{ route('message_remove') }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    }
                }).done(response => {
                    if(response.done) {
                        $('#message-' + response.message.id).hide('fast');
                    } else {
                        alert(response.message);
                    }
                })
                .fail(xhr => alert(`${xhr.status} - ${xhr.statusText}`));
            };
        </script>
    @endpush

@endonce
