{{-- Chatbot --}}


<div class="chat-container">
    <div class="header-chat">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 px-0">
                    @auth
                    <button class="btn btn-primary btn-block d-flex justify-content-center align-items-center" id="discussion-toggle">
                        <i class="fa fa-comments-o fa-2x" aria-hidden="true"></i>&nbsp;
                        Contactez-nous
                    </button>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block d-flex justify-content-center align-items-center">
                            <i class="fa fa-comments-o fa-2x" aria-hidden="true"></i>&nbsp;
                            Contactez-nous
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
