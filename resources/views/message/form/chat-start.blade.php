{{-- Chat start form --}}

<form action="#" method="post" id="chat-start-form">

    <div class="row my-4">
        <div class="col-12">
            <textarea class="form-control" name="content" id="content" cols="30" rows="10" placeholder="Votre message" required></textarea>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-outline-primary">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;
                Envoyer
            </button>
        </div>
    </div>

    <input type="hidden" name="sender_id" id="sender_id" value="{{ $sender ? $sender->id : '' }}">
    <input type="hidden" name="receiver_id" id="receiver_id" value="{{ $receiver->id }}">

    @csrf

</form>
