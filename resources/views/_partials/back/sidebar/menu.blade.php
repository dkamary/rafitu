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
            <i class="side-menu__icon fa fa-cogs"></i>
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
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-rocket"></i><span class="side-menu__label">Apps</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="cards.html" class="slide-item">Cards design</a></li>
            <li><a href="chat2.html" class="slide-item">Default Chat</a></li>
            <li><a href="notify.html" class="slide-item">Notifications</a></li>
            <li><a href="email.html" class="slide-item">Email</a></li>
            <li><a href="emailservice.html" class="slide-item">Email Inbox</a></li>
            <li><a href="sweetalert.html" class="slide-item">Sweet alerts</a></li>
            <li><a href="rangeslider.html" class="slide-item">Range slider</a></li>
            <li><a href="scroll.html" class="slide-item">Content Scroll bar</a></li>
            <li><a href="counters.html" class="slide-item">Counters</a></li>
            <li><a href="loaders.html" class="slide-item">Loaders</a></li>
            <li><a href="time-line.html" class="slide-item">Time Line</a></li>
            <li><a href="rating.html" class="slide-item">Rating </a></li>
            <li><a href="users-list.html" class="slide-item">User List</a></li>
            <li><a href="search.html" class="slide-item">Search page</a></li>
            <li><a href="crypto-currencies.html" class="slide-item">Crypto-currencies</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" href="widgets.html"><i class="side-menu__icon fa fa-window-restore"></i><span class="side-menu__label">Widget</span></a>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-calendar"></i><span class="side-menu__label">Calendar</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="calendar.html" class="slide-item">Default calendar</a></li>
            <li><a href="calendar2.html" class="slide-item">Full calendar</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-bar-chart"></i><span class="side-menu__label">Charts</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="chart-chartist.html" class="slide-item">Chartjs Charts </a></li>
            <li><a href="chart-dygraph.html" class="slide-item">Dygraph Charts</a></li>
            <li><a href="chart-echart.html" class="slide-item">Echart Charts</a></li>
            <li><a href="chart-flot.html" class="slide-item">Flot Charts</a></li>
            <li><a href="chart-nvd3.html" class="slide-item">Nvd3 Charts</a></li>
            <li><a href="sparklinechart.html" class="slide-item">Sparkline Chart</a></li>
            <li><a href="chart-morris.html" class="slide-item">Morris Charts</a></li>
            <li><a href="charts.html" class="slide-item">C3 Bar Charts</a></li>
            <li><a href="chart-line.html" class="slide-item">C3 Line Charts</a></li>
            <li><a href="chart-donut.html" class="slide-item">C3 Donut Charts</a></li>
            <li><a href="chart-pie.html" class="slide-item">C3 Pie charts</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-cubes"></i><span class="side-menu__label"> Elements</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="alerts.html" class="slide-item">Alerts</a></li>
            <li><a href="buttons.html" class="slide-item">Buttons</a></li>
            <li><a href="colors.html" class="slide-item">Colors</a></li>
            <li><a href="avatars.html" class="slide-item">Avatar-Square</a></li>
            <li><a href="avatar-round.html" class="slide-item">Avatar-Rounded</a></li>
            <li><a href="avatar-radius.html" class="slide-item">Avatar-Radius</a></li>
            <li><a href="dropdown.html" class="slide-item">Drop downs</a></li>
            <li><a href="thumbnails.html" class="slide-item">Thumbnails</a></li>
            <li><a href="mediaobject.html" class="slide-item">Media Object</a></li>
            <li><a href="list.html" class="slide-item">List</a></li>
            <li><a href="tags.html" class="slide-item">Tags</a></li>
            <li><a href="pagination.html" class="slide-item">Pagination</a></li>
            <li><a href="navigation.html" class="slide-item">Navigation</a></li>
            <li><a href="typography.html" class="slide-item">Typography</a></li>
            <li><a href="breadcrumbs.html" class="slide-item">Breadcrumbs</a></li>
            <li><a href="badge.html" class="slide-item">Badges</a></li>
            <li><a href="jumbotron.html" class="slide-item">Jumbotron</a></li>
            <li><a href="panels.html" class="slide-item">Panels</a></li>
            <li><a href="modal.html" class="slide-item">Modal</a></li>
            <li><a href="tooltipandpopover.html" class="slide-item">Tooltip and popover</a></li>
            <li><a href="progress.html" class="slide-item">Progress</a></li>
            <li><a href="carousel.html" class="slide-item">Carousels</a></li>
            <li><a href="Accordion.html" class="slide-item">Accordions</a></li>
            <li><a href="tabs.html" class="slide-item">Tabs</a></li>
            <li><a href="headers.html" class="slide-item">Headers</a></li>
            <li><a href="footers.html" class="slide-item">Footers</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-th-large"></i><span class="side-menu__label">Forms</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="form-elements.html" class="slide-item">Form Elements</a></li>
            <li><a href="form-wizard.html" class="slide-item">Form-wizard Elements</a></li>
            <li><a href="wysiwyag.html" class="slide-item">Text Editor</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-table"></i><span class="side-menu__label">Tables</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="tables.html" class="slide-item">Default table</a></li>
            <li><a href="datatable.html" class="slide-item">Data Table</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" href="maps.html"><i class="side-menu__icon fa fa-map-marker"></i><span class="side-menu__label"> Maps</span></a>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-codepen"></i><span class="side-menu__label">Icons</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="icons.html" class="slide-item">Font Awesome</a></li>
            <li><a href="icons2.html" class="slide-item">Material Design Icons</a></li>
            <li><a href="icons3.html" class="slide-item">Simple Line Iocns</a></li>
            <li><a href="icons4.html" class="slide-item">Feather Icons</a></li>
            <li><a href="icons5.html" class="slide-item">Ionic Icons</a></li>
            <li><a href="icons6.html" class="slide-item">Flag Icons</a></li>
            <li><a href="icons7.html" class="slide-item">pe7 Icons</a></li>
            <li><a href="icons8.html" class="slide-item">Themify Icons</a></li>
            <li><a href="icons9.html" class="slide-item">Typicons Icons</a></li>
            <li><a href="icons10.html" class="slide-item">Weather Icons</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-database"></i><span class="side-menu__label">Pages</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="profile1.html" class="slide-item">Profile</a></li>
            <li><a href="editprofile1.html" class="slide-item">Edit Profile</a></li>
            <li><a href="gallery.html" class="slide-item">Gallery</a></li>
            <li><a href="about.html" class="slide-item">About Company</a></li>
            <li><a href="company-history.html" class="slide-item">Company History</a></li>
            <li><a href="services.html" class="slide-item">Services</a></li>
            <li><a href="faq.html" class="slide-item">FAQS</a></li>
            <li><a href="terms.html" class="slide-item">Terms and Conditions</a></li>
            <li><a href="empty.html" class="slide-item">Empty Page</a></li>
            <li><a href="construction.html" class="slide-item">Under Construction</a></li>
            <li><a href="blog.html" class="slide-item">Blog</a></li>
            <li><a href="invoice.html" class="slide-item">Invoice</a></li>
            <li><a href="pricing.html" class="slide-item">Pricing Tables</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-shopping-cart"></i><span class="side-menu__label">E-commerce</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="shop.html" class="slide-item">Products</a></li>
            <li><a href="shop-des.html" class="slide-item">Product Details</a></li>
            <li><a href="cart.html" class="slide-item">Shopping Cart</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-folder"></i><span class="side-menu__label">Submenu 01</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="#" class="slide-item">Sub menu 01</a></li>
            <li class="sub-slide">
                <a class="slide-item sub-slide-item" data-bs-toggle="sub-slide" href="#"><span class="side-menu__label ms-0">Submenu 02</span> <i class="sub-angle fa fa-angle-right"></i></a>
                <ul class="sub-slide-menu">
                    <li><a href="#" class="slide-item">Submenu 01</a></li>
                    <li><a href="#" class="slide-item">Submenu 02</a></li>
                    <li class="sub-slide2">
                        <a class="slide-item sub-slide-item2" data-bs-toggle="sub-slide2" href="#"><span class="side-menu__label ms-0">Submenu 03</span> <i class="sub-angle2 fa fa-angle-right"></i></a>
                        <ul class="sub-slide-menu2">
                            <li><a href="#" class="slide-item">Submenu 01</a></li>
                            <li><a href="#" class="slide-item">Submenu 02</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-chain-broken"></i><span class="side-menu__label">Custom  Pages</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="login.html" class="slide-item">Login</a></li>
            <li><a href="register.html" class="slide-item">Register</a></li>
            <li><a href="forgot-password.html" class="slide-item">Forgot password</a></li>
            <li><a href="lockscreen.html" class="slide-item">Lock screen</a></li>
        </ul>
    </li>
    <li class="slide">
        <a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-diamond"></i><span class="side-menu__label">Error pages</span><i class="angle fa fa-angle-right"></i></a>
        <ul class="slide-menu">
            <li><a href="400.html" class="slide-item">400 Error</a></li>
            <li><a href="401.html" class="slide-item">401 Error</a></li>
            <li><a href="403.html" class="slide-item">403 Error</a></li>
            <li><a href="404.html" class="slide-item">404 Error</a></li>
            <li><a href="500.html" class="slide-item">500 Error</a></li>
            <li><a href="503.html" class="slide-item">503 Error</a></li>
        </ul>
    </li>
</ul>
