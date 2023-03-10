{{-- Sidebar menu --}}

<ul class="side-menu">
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('admin') }}">
            <i class="side-menu__icon fa fa-tachometer"></i>
            <span class="side-menu__label">Tableau de bord</span>
        </a>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#">
            <i class="side-menu__icon fa fa-file-text" aria-hidden="true"></i>
            <span class="side-menu__label">Pages</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="{{ route('pages_mentions_legales') }}">Mentions légales</a></li>
            <li><a class="slide-item" href="{{ route('pages_condition_utilisation') }}">Conditions d'utilisation</a></li>
            <li><a class="slide-item" href="{{ route('pages_charte_cookie') }}">Chartes de confidentialité et cookies</a></li>
            <li><a class="slide-item" href="{{ route('pages_reglement_trajet') }}">Règlement des trajets</a></li>
            <li><a class="slide-item" href="{{ route('pages_contact') }}">Contact</a></li>
            <li><a class="slide-item" href="{{ route('pages_newsletter') }}">Newsletter</a></li>
            <li><a class="slide-item" href="{{ route('pages_nosValeurs') }}">Nos Valeurs</a></li>
            <li><a class="slide-item" href="{{ route('pages_qui_sommes_nous') }}">Qui sommes-nous</a></li>
            <li><a class="slide-item" href="{{ route('pages_faq') }}">Foire aux questions</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#">
            <i class="side-menu__icon fa fa-file" aria-hidden="true"></i>
            <span class="side-menu__label">Articles</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="{{ route('admin_blog_index') }}">Liste</a></li>
            <li><a class="slide-item" href="{{ route('admin_blog_new') }}">Ajouter</a></li>
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
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#">
            <i class="side-menu__icon fa fa-car" aria-hidden="true"></i>
            <span class="side-menu__label">Trajets</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a href="{{ route('admin_ride_validation') }}" class="slide-item">A valider</a></li>
            <li><a href="{{ route('admin_ride_index') }}" class="slide-item">Liste</a></li>
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
            {{-- <li><a href="{{ route('transaction_paiements') }}" class="slide-item">Paiements</a></li> --}}
            <li><a href="{{ route('transaction_commissions') }}" class="slide-item">Commissions</a></li>

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
            <li><a href="{{ route('admin_contact_index') }}" class="slide-item">Contacts</a></li>
            <li><a href="{{ route('admin_ride_parameters') }}" class="slide-item">Trajets</a></li>
            <li><a href="{{ route('admin_social_network_parameter_index') }}" class="slide-item">Réseaux sociaux</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('admin_prereservation_index') }}">
            <i class="side-menu__icon fa fa-calendar-check-o"></i>
            <span class="side-menu__label">Pré-Réservations</span>
        </a>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('admin_reservation_all') }}">
            <i class="side-menu__icon fa fa-bookmark"></i>
            <span class="side-menu__label">Réservations</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a href="{{ route('admin_reservation_all') }}" class="slide-item">Tous les réservations</a></li>
            <li><a href="{{ route('admin_reservation_unpaid') }}" class="slide-item">Réservations impayées</a></li>
            <li><a href="{{ route('admin_reservation_paid') }}" class="slide-item">Réservations payées</a></li>
            <li><a href="{{ route('admin_reservation_canceled') }}" class="slide-item">Réservations annulées</a></li>
            <li><a href="{{ route('admin_reservation_deleted') }}" class="slide-item">Réservations effacées</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('admin_funfact_index') }}">
            <i class="side-menu__icon fa fa-square"></i>
            <span class="side-menu__label">Faits amusants</span>
        </a>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('admin_reservation_all') }}">
            <i class="side-menu__icon fa fa-comments"></i>
            <span class="side-menu__label">Commentaires</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu">
            <li><a href="{{ route('admin_review_index') }}" class="slide-item">Tous les commentaires</a></li>
            <li><a href="{{ route('admin_review_index', ['type' => 'todo']) }}" class="slide-item">A valider</a></li>
            <li><a href="{{ route('admin_review_index', ['type' => 'deactivated']) }}" class="slide-item">Non validés</a></li>
        </ul>
    </li>
</ul>
