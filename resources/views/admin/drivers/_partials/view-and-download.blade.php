{{-- View and download --}}

<div class="row">
    <div class="col-12 d-flex justify-content-end align-items-center">
        <a href="{{ $link ?? '#' }}" class="btn btn-outline-primary mx-2" target="_blank">
            <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;
            Afficher
        </a>
        <a href="{{ $link ?? '#' }}" class="btn btn-outline-secondary mx-2" download="">
            <i class="fa fa-download" aria-hidden="true"></i>&nbsp;
            Télécharger
        </a>
    </div>
</div>
