{{-- Sidebar menu --}}

<ul class="side-menu">
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('admin') }}">
            <i class="side-menu__icon fa fa-tachometer"></i>
            <span class="side-menu__label">Tableau de bord</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#">
            <i class="side-menu__icon fa fa-file-text" aria-hidden="true"></i>
            <span class="side-menu__label">Pages</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="{{ route('pages_condition_utilisation') }}">Conditions d'utilisation</a></li>
            <li><a class="slide-item" href="{{ route('pages_charte_cookie') }}">Chartes de confidentialité et cookies</a></li>
            <li><a class="slide-item" href="{{ route('pages_contact') }}">Contact</a></li>
            <li><a class="slide-item" href="{{ route('pages_newsletter') }}">Newsletter</a></li>
            <li><a class="slide-item" href="{{ route('pages_nosValeurs') }}">Nos Valeurs</a></li>
            <li><a class="slide-item" href="{{ route('pages_qui_sommes_nous') }}">Qui sommes-nous</a></li>
            <li><a class="slide-item" href="{{ route('pages_reglement_trajet') }}">Règlement des trajets</a></li>
            <li><a class="slide-item" href="{{ route('pages_faq') }}">Foire aux questions</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#">
            <i class="side-menu__icon fa fa-rocket"></i>
            <span class="side-menu__label">Blog</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a href="{{ route('admin_blog_index') }}" class="slide-item">Liste</a></li>
            <li><a href="{{ route('admin_blog_new') }}" class="slide-item">Ajouter</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#">
            <i class="side-menu__icon fa fa-user"></i>
            <span class="side-menu__label">Utilisateurs</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a href="{{ route('admin_user_index') }}" class="slide-item">Liste</a></li>
            <li><a href="{{ route('admin_user_new') }}" class="slide-item">Ajouter</a></li>
            {{-- <li><a href="{{ route('admin_user_new') }}" class="slide-item">Vérification d'identité</a></li> --}}
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#">
            <i class="side-menu__icon fa fa-id-card" aria-hidden="true"></i>
            <span class="side-menu__label">Chauffeur</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a href="{{ route('admin_driver_index') }}" class="slide-item">A valider</a></li>
            <li><a href="{{ route('admin_driver_list') }}" class="slide-item">Liste</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#">
            <i class="side-menu__icon fa fa-cubes"></i>
            <span class="side-menu__label">Transactions</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a href="{{ route('transaction_paiements') }}" class="slide-item">Paiements</a></li>
            <li><a href="{{ route('transaction_commissions') }}" class="slide-item">Commissions</a></li>
            <li><a href="{{ route('transaction_remboursements') }}" class="slide-item">Remboursement</a></li>

        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#">
            <i class="side-menu__icon fa fa-table"></i>
            <span class="side-menu__label">Paramètres</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a href="{{ route('transaction_mode_de_paiements') }}" class="slide-item">Modes de paiement</a></li>
            <li><a href="{{ route('admin_brand_index') }}" class="slide-item">Marque des véhicules</a></li>
        </ul>
    </li>
</ul>
