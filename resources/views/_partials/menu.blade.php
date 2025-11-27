<!-- Menu Bantou-Foundation -->
<link rel="stylesheet" href="css/menu.css">
<script src="./js/menu.js" defer></script>
<header class="header" id="header">
    <nav class="navbar">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo" aria-label="Retour à l'accueil Bantou-Foundation">
            <img src="{{ asset("../asset/img/logo/BFund/logo BH BF-05.png") }}" alt="Logo Bantou Foundation"
                loading="lazy" />
        </a>

        <!-- Menu principal -->
        <ul class="nav-menu" id="nav-menu" role="menubar">
            {{-- NOTRE IDENTITÉ --}}
            <li class="nav-item" role="none">
                <a href="{{ route("identite") }}" class="nav-link" role="menuitem">
                    <i class="fas fa-users nav-icon"></i>
                    Notre Identité
                    @if (Route::currentRouteName() == 'identite')
                    <span class="dropdown-arrow"><i class="fas fa-chevron-down"></i></span>
                    @endif
                </a>
                @if (Route::currentRouteName() == 'identite')
                    <div class="dropdown" role="menu">
                        <a href="#histoire" class="dropdown-item"><i class="fas fa-history dropdown-icon"></i> Histoire &
                            Création</a>
                        <a href="#mission" class="dropdown-item"><i class="fas fa-bullseye dropdown-icon"></i> Mission &
                            Vision</a>
                        <a href="#valeurs" class="dropdown-item"><i class="fas fa-heart dropdown-icon"></i> Nos Valeurs</a>
                        <a href="#gouvernance" class="dropdown-item"><i class="fas fa-sitemap dropdown-icon"></i>
                            Gouvernance</a>
                        {{-- <a href="#conseil" class="dropdown-item"><i class="fas fa-user-tie dropdown-icon"></i> Conseil
                            d'administration</a> --}}
                    </div>
                @endif
            </li>

            {{-- NOS ACTIONS --}}
            <li class="nav-item" role="none">
                <a href="{{ route("action") }}" class="nav-link" role="menuitem">
                    <i class="fas fa-hands-helping nav-icon"></i>
                    Nos Actions
                    @if (Route::currentRouteName() == 'action')
                    <span class="dropdown-arrow"><i class="fas fa-chevron-down"></i></span>
                    @endif
                </a>
                @if (Route::currentRouteName() == 'action')
                    <div class="dropdown" role="menu">
                        <a href="#axes-intervention" class="dropdown-item"><i class="fas fa-graduation-cap dropdown-icon"></i>
                           Nos Axes d'Intervention</a>
                        <a href="#chiffres-cles" class="dropdown-item"><i class="fas fa-heartbeat dropdown-icon"></i> Santé &
                            chiffres-cles</a>
                        {{-- <a href="#developpement" class="dropdown-item"><i class="fas fa-chart-line dropdown-icon"></i>
                            Développement économique</a> --}}
                        {{-- <a href="#environnement" class="dropdown-item"><i class="fas fa-leaf dropdown-icon"></i>
                            Environnement & Durabilité</a> --}}
                        <a href="#projets-realises" class="dropdown-item"><i class="fas fa-check-circle dropdown-icon"></i>
                            Projets réalisés</a>
                        <a href="#projets-cours" class="dropdown-item"><i class="fas fa-spinner dropdown-icon"></i> Projets
                            en cours</a>
                    </div>
                @endif
            </li>

            {{-- BLOG & ACTUALITÉS --}}
            <li class="nav-item" role="none">
                <a href="" class="nav-link" role="menuitem">
                    <i class="fas fa-newspaper nav-icon"></i>
                    Blog & Actualités
                </a>
            </li>

            {{-- NOUS REJOINDRE --}}
            <li class="nav-item " role="none">
                <a href="" class="nav-link" role="menuitem">
                    <i class="fas fa-handshake nav-icon"></i>
                    Nous Rejoindre
                    <span class="dropdown-arrow"><i class="fas fa-chevron-down"></i></span>
                </a>

                <div class="dropdown" role="menu">
                    <a href="{{ route("don") }}" class="dropdown-item"><i class="fas fa-gift dropdown-icon"></i> Faire un don</a>
                    <a href="{{ route("benevole") }}" class="dropdown-item"><i class="fas fa-hands dropdown-icon"></i> Devenir
                        bénévole</a>
                    <a href="{{ route("partenaire") }}" class="dropdown-item"><i class="fas fa-handshake dropdown-icon"></i> Devenir
                        partenaire</a>
                    <a href="{{ route("adhesion") }}" class="dropdown-item"><i class="fas fa-user-plus dropdown-icon"></i> Adhérer à la
                        fondation</a>
                </div>
            </li>

            <!-- Bouton Faire un Don (mobile) -->
            <div class="auth-button mobile-auth" style="display: none;">
                <a href="{{ route("don") }}" class="btn-donate" aria-label="Faire un don à Bantou-Foundation">
                    <i class="fas fa-gift btn-icon"></i> Faire un Don
                </a>
            </div>
        </ul>

        <!-- Bouton Faire un Don (desktop) -->
        <div class="auth-button desktop-auth" style="display: none;">
            <a href="" class="btn-donate" aria-label="Faire un don à Bantou-Foundation">
                <i class="fas fa-gift btn-icon"></i> Faire un Don
            </a>
        </div>

        <!-- Toggle menu mobile -->
        <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Ouvrir/fermer le menu de navigation"
            aria-expanded="false">
            <div class="hamburger"></div>
            <div class="hamburger"></div>
            <div class="hamburger"></div>
        </button>
    </nav>
</header>
<div style="height: 8vh;width:100%;">

</div>
<style>
    /* Variables CSS - Couleurs Bantou Foundation */
    :root {
        --navy-blue: #0f1a3a;
        --dark-blue: #1a2b55;
        --medium-blue: #2d4a8a;
        --light-blue: #3a5fc0;
        --accent-gold: #d4af37;
        --accent-light: #e6c34d;
        --pure-white: #ffffff;
        --text-dark: #1e293b;
        --text-light: #64748b;
        --bg-light: #f8fafc;
        --glass-bg: rgba(255, 255, 255, 0.9);
        --glass-bg-strong: rgba(255, 255, 255, 0.95);
        --shadow-light: rgba(15, 26, 58, 0.1);
        --shadow-medium: rgba(15, 26, 58, 0.2);
        --shadow-strong: rgba(15, 26, 58, 0.3);
        --border-radius: 8px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Header avec effet glass professionnel */
    .header {
        background: var(--glass-bg);
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        box-shadow: 0 4px 20px var(--shadow-light);
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        border-bottom: 3px solid var(--navy-blue);
        transition: var(--transition);
        will-change: transform, background, box-shadow;
        font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        border-radius: 0 0 10px 10px;
    }

    .header.scrolled {
        background: var(--glass-bg-strong);
        backdrop-filter: blur(15px) saturate(200%);
        -webkit-backdrop-filter: blur(15px) saturate(200%);
        box-shadow: 0 8px 32px var(--shadow-medium);
        border-bottom-color: var(--accent-gold);
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
        height: 80px;
    }

    /* Logo optimisé */
    .logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: var(--transition);
        position: relative;
        padding: 8px 16px;
        border-radius: var(--border-radius);
    }

    .logo:hover {
        transform: translateY(-2px);
    }

    .logo img {
        height: 50px;
        width: auto;
        transition: var(--transition);
    }

    .logo:hover img {
        transform: scale(1.05);
    }

    /* Navigation améliorée */
    .nav-menu {
        display: flex;
        list-style: none;
        align-items: center;
        gap: 0;
    }

    .nav-item {
        position: relative;
    }

    .nav-link {
        display: flex;
        align-items: center;
        padding: 22px 18px;
        text-decoration: none;
        color: var(--navy-blue);
        font-weight: 600;
        font-size: 15px;
        transition: var(--transition);
        border-radius: 6px;
        margin: 0 2px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }

    .nav-link::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(58, 95, 192, 0.1), transparent);
        transition: all 0.5s ease;
    }

    .nav-link:hover::before {
        left: 100%;
    }

    .nav-link:hover,
    .nav-link:focus {
        background: linear-gradient(45deg, rgba(15, 26, 58, 0.08), rgba(212, 175, 55, 0.08));
        color: var(--medium-blue);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px var(--shadow-light);
        outline: none;
    }

    .nav-icon {
        margin-right: 8px;
        font-size: 16px;
        width: 20px;
        text-align: center;
        color: var(--medium-blue);
        transition: var(--transition);
    }

    .nav-link:hover .nav-icon,
    .nav-link:focus .nav-icon {
        color: var(--accent-gold);
        transform: scale(1.2);
    }

    .dropdown-arrow {
        margin-left: 6px;
        transition: var(--transition);
        font-size: 11px;
        color: var(--medium-blue);
    }

    .nav-link:hover .dropdown-arrow,
    .nav-link:focus .dropdown-arrow,
    .nav-item:hover .dropdown-arrow {
        color: var(--accent-gold);
        transform: rotate(180deg);
    }

    /* Dropdown professionnel */
    .dropdown {
        position: absolute;
        top: calc(100% + 10px);
        left: 50%;
        transform: translateX(-50%) translateY(-15px);
        background: var(--glass-bg-strong);
        backdrop-filter: blur(15px) saturate(180%);
        -webkit-backdrop-filter: blur(15px) saturate(180%);
        min-width: 260px;
        border-radius: var(--border-radius);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 8px 32px var(--shadow-medium);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.5);
        overflow: hidden;
        z-index: 1000;
        border-top: 3px solid var(--accent-gold);
    }

    .nav-item:hover .dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 14px 18px;
        color: var(--text-dark);
        text-decoration: none;
        transition: var(--transition);
        border-bottom: 1px solid rgba(15, 26, 58, 0.08);
        font-weight: 500;
        font-size: 14px;
        opacity: 0;
        transform: translateX(-10px);
        animation: none;
    }

    .dropdown-item:last-child {
        border-bottom: none;
    }

    .dropdown-icon {
        margin-right: 10px;
        font-size: 14px;
        width: 18px;
        text-align: center;
        color: var(--medium-blue);
        transition: var(--transition);
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
        background: linear-gradient(90deg, rgba(15, 26, 58, 0.06), rgba(212, 175, 55, 0.06));
        color: var(--navy-blue);
        padding-left: 24px;
        outline: none;
    }

    .dropdown-item:hover .dropdown-icon,
    .dropdown-item:focus .dropdown-icon {
        transform: scale(1.2);
        color: var(--accent-gold);
    }

    /* Animation d'apparition pour les éléments du dropdown */
    .nav-item:hover .dropdown-item {
        opacity: 1;
        transform: translateX(0);
        animation: slideInLeft 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .nav-item:hover .dropdown-item:nth-child(1) {
        animation-delay: 0.05s;
    }

    .nav-item:hover .dropdown-item:nth-child(2) {
        animation-delay: 0.1s;
    }

    .nav-item:hover .dropdown-item:nth-child(3) {
        animation-delay: 0.15s;
    }

    .nav-item:hover .dropdown-item:nth-child(4) {
        animation-delay: 0.2s;
    }

    .nav-item:hover .dropdown-item:nth-child(5) {
        animation-delay: 0.25s;
    }

    .nav-item:hover .dropdown-item:nth-child(6) {
        animation-delay: 0.3s;
    }

    @keyframes slideInLeft {
        0% {
            opacity: 0;
            transform: translateX(-10px);
        }

        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Bouton Faire un Don optimisé */
    .auth-button {
        display: flex;
        align-items: center;
    }

    .btn-donate {
        background: linear-gradient(45deg, var(--accent-gold), var(--accent-light));
        color: var(--navy-blue);
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: var(--transition);
        border: 2px solid transparent;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .btn-donate::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: all 0.5s ease;
    }

    .btn-donate:hover::before {
        left: 100%;
    }

    .btn-donate:hover,
    .btn-donate:focus {
        background: linear-gradient(45deg, var(--accent-light), #e0b42e);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        border-color: var(--navy-blue);
        outline: none;
    }

    .btn-icon {
        font-size: 15px;
        transition: var(--transition);
    }

    .btn-donate:hover .btn-icon {
        animation: bounce 0.6s ease-in-out;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-3px);
        }

        60% {
            transform: translateY(-1.5px);
        }
    }

    /* Menu mobile optimisé */
    .mobile-menu-toggle {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 8px;
        background: rgba(15, 26, 58, 0.1);
        border-radius: 6px;
        transition: var(--transition);
        border: none;
        outline: none;
    }

    .mobile-menu-toggle:hover,
    .mobile-menu-toggle:focus {
        background: rgba(15, 26, 58, 0.2);
    }

    .hamburger {
        width: 25px;
        height: 3px;
        background: var(--navy-blue);
        margin: 3px 0;
        transition: var(--transition);
        border-radius: 2px;
    }

    /* États actifs */
    .nav-link.active {
        background: linear-gradient(45deg, rgba(15, 26, 58, 0.12), rgba(212, 175, 55, 0.12));
        color: var(--navy-blue);
        box-shadow: 0 4px 12px var(--shadow-light);
    }

    .nav-link.active .nav-icon {
        color: var(--accent-gold);
    }

    /* Effet de pulsation sur le bouton don */
    @keyframes pulse {
        0% {
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        50% {
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.5);
        }

        100% {
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }
    }

    .btn-donate {
        animation: pulse 3s infinite;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .nav-link {
            padding: 18px 14px;
            font-size: 14px;
        }

        .nav-icon {
            font-size: 15px;
            margin-right: 6px;
        }

        .dropdown {
            min-width: 240px;
        }
    }

    @media (max-width: 768px) {
        .mobile-menu-toggle {
            display: flex;
        }

        .nav-menu {
            position: fixed;
            top: 80px;
            left: 0;
            right: 0;
            background: var(--glass-bg-strong);
            backdrop-filter: blur(15px) saturate(200%);
            -webkit-backdrop-filter: blur(15px) saturate(200%);
            flex-direction: column;
            box-shadow: 0 8px 32px var(--shadow-medium);
            transform: translateX(-100%);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border-top: 2px solid var(--accent-gold);
            height: calc(100vh - 80px);
            overflow-y: auto;
            z-index: 999;
        }

        .nav-menu.active {
            transform: translateX(0);
            opacity: 1;
        }

        .nav-item {
            width: 100%;
            border-bottom: 1px solid rgba(15, 26, 58, 0.1);
        }

        .nav-link {
            width: 100%;
            justify-content: space-between;
            padding: 18px 25px;
            margin: 0;
            border-radius: 0;
        }

        .dropdown {
            position: static;
            opacity: 1;
            visibility: visible;
            transform: none;
            box-shadow: none;
            background: rgba(248, 250, 252, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 0;
            border: none;
            border-top: 1px solid rgba(212, 175, 55, 0.3);
            display: none;
            width: 100%;
            min-width: 100%;
        }

        .dropdown.active {
            display: block;
        }

        .dropdown-item {
            opacity: 1;
            transform: translateX(0);
            animation: none;
        }

        .auth-button.mobile-auth {
            width: 100%;
            padding: 20px 25px;
            border-top: 2px solid rgba(212, 175, 55, 0.5);
            background: rgba(248, 250, 252, 0.5);
        }

        .btn-donate {
            width: 100%;
            text-align: center;
            justify-content: center;
        }

        .desktop-auth {
            display: none;
        }

        .mobile-auth {
            display: block;
        }
    }

    @media (min-width: 769px) {
        .mobile-auth {
            display: none;
        }

        .desktop-auth {
            display: block;
        }
    }

    @media (max-width: 480px) {
        .navbar {
            padding: 0 15px;
            height: 70px;
        }

        .logo img {
            height: 40px;
        }
    }

    /* Animation hamburger */
    .mobile-menu-toggle.active .hamburger:nth-child(1) {
        transform: rotate(-45deg) translate(-5px, 5px);
        background: var(--accent-gold);
    }

    .mobile-menu-toggle.active .hamburger:nth-child(2) {
        opacity: 0;
        transform: scale(0);
    }

    .mobile-menu-toggle.active .hamburger:nth-child(3) {
        transform: rotate(45deg) translate(-5px, -5px);
        background: var(--accent-gold);
    }

    /* Accessibilité */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    .nav-link:focus-visible,
    .dropdown-item:focus-visible,
    .btn-donate:focus-visible {
        outline: 2px solid var(--accent-gold);
        outline-offset: 2px;
    }

    /* Amélioration des performances */
    .header,
    .nav-link,
    .dropdown,
    .btn-donate {
        will-change: transform;
    }
</style>
<script>
    // JavaScript pour le menu hamburger
    document.addEventListener('DOMContentLoaded', function () {
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');
        const dropdowns = document.querySelectorAll('.dropdown');

        // Toggle menu mobile
        hamburger.addEventListener('click', function () {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Gestion des dropdowns en mobile
        dropdowns.forEach(dropdown => {
            const link = dropdown.querySelector('.nav-link');

            link.addEventListener('click', function (e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    dropdown.classList.toggle('active');
                }
            });
        });

        // Fermer le menu en cliquant sur un lien
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    hamburger.classList.remove('active');
                    navMenu.classList.remove('active');
                    dropdowns.forEach(d => d.classList.remove('active'));
                }
            });
        });

        // Fermer le menu en redimensionnant la fenêtre
        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                dropdowns.forEach(d => d.classList.remove('active'));
            }
        });
    });
</script>
