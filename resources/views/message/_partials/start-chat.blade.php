{{-- Start Chat --}}

<!-- Button trigger modal -->
<button type="button" class="{{ $btn_chat_classes ?? 'btn btn-primary' }}" data-bs-toggle="modal" data-bs-target="#chatModal">
    @if(isset($btn_chat_icon))
    {!! $btn_chat_icon !!}
    @else
    <i class="fa fa-comments-o" aria-hidden="true"></i>
    @endif
    &nbsp;
    {{ $btn_chat_text ?? 'Contacter' }}
</button>

<!-- Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatModalLabel">Contacter <strong>{{ $receiver->firstname }}</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @auth
                    @include('message.form.chat-start', [
                        'sender' => $sender,
                        'receiver' => $receiver,
                    ])
                @endauth

                @guest

                    <div class="text-center fs-5 mb-4">
                        Veuillez d'abord vous connecter pour contacter {{ $receiver->firstname }}
                    </div>

                    <div class="single-page">
                        <div class="wrapper wrapper2 shadow-none">
                            @include('_partials.front.forms.login-form', [
                                'ajaxLogin' => true,
                                'showLoginTitle' => false,
                            ])
                        </div>
                    </div>

                @endguest
            </div>
        </div>
    </div>
</div>
