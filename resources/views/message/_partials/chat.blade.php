{{-- Chatbot --}}


<div class="chat-container">
    <div class="header-chat">
        <div class="container-fluid">
            <div class="row">
                <div class="button-container">
                    @auth
                    <button class="btn btn-primary" id="discussion-toggle">
                        <i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp;
                        <span class="text">Contactez-nous</span>
                    </button>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary" id="discussion-toggle">
                            <i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp;
                            <span class="text">Contactez-nous</span>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <div class="border">
        <div class="responsive-html5-chat">
        </div>
    </div>
</div>
