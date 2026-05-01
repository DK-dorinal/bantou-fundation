<header class="header" id="header">
    <nav class="navbar">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo" aria-label="Retour à l'accueil Bantou-Foundation">
            <img src="{{ asset('asset/img/logo/BFund/logo BH BF-05.png') }}" alt="Logo Bantou Foundation" loading="lazy" />
        </a>

        <!-- Menu principal -->
        <ul class="nav-menu" id="nav-menu" role="menubar">
            {{-- NOTRE IDENTITÉ --}}
            <li class="nav-item" role="none">
                <a href="{{ route('identite') }}" class="nav-link {{ Route::currentRouteName() == 'identite' ? 'active' : '' }}" role="menuitem">
                    <i class="fas fa-users nav-icon"></i>
                    <span>Notre Identité</span>
                    @if (Route::currentRouteName() == 'identite')
                        <span class="dropdown-arrow"><i class="fas fa-chevron-down"></i></span>
                    @endif
                </a>
                @if (Route::currentRouteName() == 'identite')
                    <div class="dropdown" role="menu">
                        <a href="#histoire" class="dropdown-item"><i class="fas fa-history dropdown-icon"></i> Histoire & Création</a>
                        <a href="#mission" class="dropdown-item"><i class="fas fa-bullseye dropdown-icon"></i> Mission & Vision</a>
                        <a href="#valeurs" class="dropdown-item"><i class="fas fa-heart dropdown-icon"></i> Nos Valeurs</a>
                        <a href="#gouvernance" class="dropdown-item"><i class="fas fa-sitemap dropdown-icon"></i> Gouvernance</a>
                    </div>
                @endif
            </li>

            {{-- NOS ACTIONS --}}
            <li class="nav-item" role="none">
                <a href="{{ route('action') }}" class="nav-link {{ Route::currentRouteName() == 'action' ? 'active' : '' }}" role="menuitem">
                    <i class="fas fa-hands-helping nav-icon"></i>
                    <span>Nos Actions</span>
                    @if (Route::currentRouteName() == 'action')
                        <span class="dropdown-arrow"><i class="fas fa-chevron-down"></i></span>
                    @endif
                </a>
                @if (Route::currentRouteName() == 'action')
                    <div class="dropdown" role="menu">
                        <a href="#axes-intervention" class="dropdown-item"><i class="fas fa-graduation-cap dropdown-icon"></i> Nos Axes d'Intervention</a>
                        <a href="#chiffres-cles" class="dropdown-item"><i class="fas fa-chart-line dropdown-icon"></i> Chiffres clés</a>
                        <a href="#projets-realises" class="dropdown-item"><i class="fas fa-check-circle dropdown-icon"></i> Projets réalisés</a>
                        <a href="#projets-cours" class="dropdown-item"><i class="fas fa-spinner dropdown-icon"></i> Projets en cours</a>
                    </div>
                @endif
            </li>

            {{-- BLOG & ACTUALITÉS --}}
            <li class="nav-item" role="none">
                <a href="{{ route('blog') }}" class="nav-link" role="menuitem">
                    <i class="fas fa-newspaper nav-icon"></i>
                    <span>Blog & Actualités</span>
                </a>
            </li>

            {{-- NOUS REJOINDRE --}}
            <li class="nav-item" role="none">
                <a href="#" class="nav-link has-dropdown" role="menuitem">
                    <i class="fas fa-handshake nav-icon"></i>
                    <span>Nous Rejoindre</span>
                    <span class="dropdown-arrow"><i class="fas fa-chevron-down"></i></span>
                </a>

                <div class="dropdown" role="menu">
                    @auth
                        {{-- Utilisateur connecté --}}
                        <div class="dropdown-user-info">
                            <div class="user-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-email">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('user_dashboard') }}" class="dropdown-item dashboard-link">
                            <i class="fas fa-tachometer-alt dropdown-icon"></i> Tableau de bord
                        </a>
                        <a href="{{ route('user_profil') }}" class="dropdown-item">
                            <i class="fas fa-user dropdown-icon"></i> Mon profil
                        </a>
                        <a href="#" class="dropdown-item logout-link" id="logoutMenuLink">
                            <i class="fas fa-sign-out-alt dropdown-icon"></i> Déconnexion
                        </a>
                    @else
                        {{-- Utilisateur non connecté --}}
                        <a href="{{ route('don') }}" class="dropdown-item">
                            <i class="fas fa-gift dropdown-icon"></i> Faire un don
                        </a>
                        <a href="{{ route('benevole') }}" class="dropdown-item">
                            <i class="fas fa-hands dropdown-icon"></i> Devenir bénévole
                        </a>
                        <a href="{{ route('partenaire') }}" class="dropdown-item">
                            <i class="fas fa-handshake dropdown-icon"></i> Devenir partenaire
                        </a>
                        <a href="{{ route('adhesion') }}" class="dropdown-item">
                            <i class="fas fa-user-plus dropdown-icon"></i> Adhérer à la fondation
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('login') }}" class="dropdown-item login-link">
                            <i class="fas fa-sign-in-alt dropdown-icon"></i> Connexion
                        </a>
                    @endauth
                </div>
            </li>

            <!-- Bouton Faire un Don (mobile) -->
            <div class="auth-button mobile-auth">
                <a href="{{ route('don') }}" class="btn-donate" aria-label="Faire un don à Bantou-Foundation">
                    <i class="fas fa-gift btn-icon"></i> Faire un Don
                </a>
            </div>
        </ul>

        <!-- Bouton Faire un Don (desktop) -->
        <div class="auth-button desktop-auth">
            <a href="{{ route('don') }}" class="btn-donate" aria-label="Faire un don à Bantou-Foundation">
                <i class="fas fa-gift btn-icon"></i> Faire un Don
            </a>
        </div>

        <!-- Toggle menu mobile -->
        <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Ouvrir/fermer le menu de navigation" aria-expanded="false">
            <div class="hamburger"></div>
            <div class="hamburger"></div>
            <div class="hamburger"></div>
        </button>
    </nav>
</header>

<div style="height: 8vh; width: 100%;"></div>

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
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-bg-strong: rgba(255, 255, 255, 0.98);
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
        font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    .header.scrolled {
        background: var(--glass-bg-strong);
        backdrop-filter: blur(15px) saturate(200%);
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

    /* Logo */
    .logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: var(--transition);
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

    /* Navigation */
    .nav-menu {
        display: flex;
        list-style: none;
        align-items: center;
        gap: 0;
        margin: 0;
        padding: 0;
    }

    .nav-item {
        position: relative;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 8px;
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
        white-space: nowrap;
    }

    .nav-link span {
        display: inline-block;
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
    }

    .nav-link.active {
        background: linear-gradient(45deg, rgba(15, 26, 58, 0.12), rgba(212, 175, 55, 0.12));
        color: var(--navy-blue);
    }

    .nav-icon {
        font-size: 16px;
        width: 20px;
        text-align: center;
        color: var(--medium-blue);
        transition: var(--transition);
    }

    .nav-link:hover .nav-icon,
    .nav-link.active .nav-icon {
        color: var(--accent-gold);
        transform: scale(1.1);
    }

    .dropdown-arrow {
        margin-left: 6px;
        transition: var(--transition);
        font-size: 11px;
        color: var(--medium-blue);
    }

    .nav-link:hover .dropdown-arrow {
        color: var(--accent-gold);
        transform: rotate(180deg);
    }

    /* Dropdown */
    .dropdown {
        position: absolute;
        top: calc(100% + 10px);
        left: 50%;
        transform: translateX(-50%) translateY(-15px);
        background: var(--glass-bg-strong);
        backdrop-filter: blur(15px) saturate(180%);
        min-width: 280px;
        border-radius: var(--border-radius);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-top: 3px solid var(--accent-gold);
        z-index: 1000;
    }

    .nav-item:hover .dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 18px;
        color: var(--text-dark);
        text-decoration: none;
        transition: var(--transition);
        border-bottom: 1px solid rgba(15, 26, 58, 0.08);
        font-weight: 500;
        font-size: 14px;
    }

    .dropdown-item:last-child {
        border-bottom: none;
    }

    .dropdown-item:hover {
        background: linear-gradient(90deg, rgba(15, 26, 58, 0.06), rgba(212, 175, 55, 0.06));
        color: var(--navy-blue);
        padding-left: 24px;
    }

    .dropdown-icon {
        font-size: 14px;
        width: 18px;
        text-align: center;
        color: var(--medium-blue);
        transition: var(--transition);
    }

    .dropdown-item:hover .dropdown-icon {
        transform: scale(1.2);
        color: var(--accent-gold);
    }

    /* Infos utilisateur dans dropdown */
    .dropdown-user-info {
        padding: 15px 18px;
        text-align: center;
        background: linear-gradient(135deg, rgba(15, 26, 58, 0.05), rgba(212, 175, 55, 0.05));
    }

    .user-avatar i {
        font-size: 40px;
        color: var(--medium-blue);
        margin-bottom: 8px;
    }

    .user-name {
        font-weight: 700;
        color: var(--navy-blue);
        font-size: 14px;
    }

    .user-email {
        font-size: 11px;
        color: var(--text-light);
        margin-top: 4px;
        word-break: break-all;
    }

    .dropdown-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(15, 26, 58, 0.15), transparent);
        margin: 8px 0;
    }

    .login-link,
    .dashboard-link {
        background: linear-gradient(45deg, rgba(212, 175, 55, 0.1), rgba(15, 26, 58, 0.05));
        border-top: 1px solid rgba(212, 175, 55, 0.3);
        margin-top: 5px;
    }

    .login-link i,
    .dashboard-link i {
        color: var(--accent-gold);
    }

    .logout-link {
        color: #dc2626;
    }

    .logout-link i {
        color: #dc2626;
    }

    .logout-link:hover {
        background: rgba(220, 38, 38, 0.08);
        color: #dc2626;
    }

    /* Bouton Don */
    .auth-button {
        display: flex;
        align-items: center;
    }

    .btn-donate {
        background: linear-gradient(45deg, var(--accent-gold), var(--accent-light));
        color: var(--navy-blue);
        padding: 10px 22px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    }

    .btn-donate:hover {
        background: linear-gradient(45deg, var(--accent-light), #e0b42e);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
    }

    .btn-icon {
        font-size: 14px;
    }

    /* Menu mobile */
    .mobile-menu-toggle {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 10px;
        background: rgba(15, 26, 58, 0.1);
        border-radius: 8px;
        border: none;
        outline: none;
    }

    .hamburger {
        width: 25px;
        height: 2.5px;
        background: var(--navy-blue);
        margin: 3px 0;
        transition: var(--transition);
        border-radius: 2px;
    }

    /* Responsive Desktop */
    @media (max-width: 992px) {
        .nav-link {
            padding: 18px 14px;
            font-size: 13px;
        }

        .btn-donate {
            padding: 8px 16px;
            font-size: 12px;
        }
    }

    /* Responsive Mobile */
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
            backdrop-filter: blur(20px);
            flex-direction: column;
            align-items: stretch;
            transform: translateX(-100%);
            transition: transform 0.4s ease;
            height: calc(100vh - 80px);
            overflow-y: auto;
            z-index: 999;
            gap: 0;
        }

        .nav-menu.active {
            transform: translateX(0);
        }

        .nav-item {
            width: 100%;
            border-bottom: 1px solid rgba(15, 26, 58, 0.1);
        }

        .nav-link {
            width: 100%;
            justify-content: space-between;
            padding: 16px 20px;
            margin: 0;
            border-radius: 0;
            white-space: normal;
        }

        .nav-link span {
            flex: 1;
            text-align: left;
        }

        .dropdown {
            position: static;
            opacity: 1;
            visibility: visible;
            transform: none;
            box-shadow: none;
            background: rgba(248, 250, 252, 0.95);
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
            padding: 14px 20px 14px 40px;
        }

        .dropdown-user-info {
            padding: 15px 20px;
        }

        .auth-button.mobile-auth {
            display: block;
            padding: 20px;
            border-top: 2px solid rgba(212, 175, 55, 0.5);
            background: rgba(248, 250, 252, 0.5);
        }

        .btn-donate {
            width: 100%;
            justify-content: center;
            padding: 14px;
        }

        .desktop-auth {
            display: none;
        }

        /* Animation hamburger */
        .mobile-menu-toggle.active .hamburger:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .mobile-menu-toggle.active .hamburger:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-toggle.active .hamburger:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }
    }

    @media (min-width: 769px) {
        .mobile-auth {
            display: none !important;
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

        .nav-menu {
            top: 70px;
            height: calc(100vh - 70px);
        }
    }

    /* Accessibilité */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Éléments
        const mobileToggle = document.getElementById('mobile-menu-toggle');
        const navMenu = document.getElementById('nav-menu');
        const dropdownLinks = document.querySelectorAll('.nav-link.has-dropdown');
        const dropdowns = document.querySelectorAll('.dropdown');

        // Toggle menu mobile
        if (mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                navMenu.classList.toggle('active');
                const expanded = navMenu.classList.contains('active');
                this.setAttribute('aria-expanded', expanded);
                document.body.style.overflow = expanded ? 'hidden' : '';
            });
        }

        // Gestion des dropdowns en mobile
        function handleMobileDropdowns() {
            const isMobile = window.innerWidth <= 768;

            dropdownLinks.forEach(link => {
                link.removeEventListener('click', mobileDropdownHandler);
                if (isMobile) {
                    link.addEventListener('click', mobileDropdownHandler);
                }
            });
        }

        function mobileDropdownHandler(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                const dropdown = this.closest('.nav-item').querySelector('.dropdown');
                if (dropdown) {
                    dropdown.classList.toggle('active');
                    const arrow = this.querySelector('.dropdown-arrow');
                    if (arrow) {
                        arrow.style.transform = dropdown.classList.contains('active') ? 'rotate(180deg)' : '';
                    }
                }
            }
        }

        // Fermeture menu mobile au clic sur un lien
        document.querySelectorAll('.dropdown-item, .nav-link:not(.has-dropdown)').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    mobileToggle.classList.remove('active');
                    navMenu.classList.remove('active');
                    document.body.style.overflow = '';
                    // Fermer tous les dropdowns
                    dropdowns.forEach(d => d.classList.remove('active'));
                }
            });
        });

        // Rendre le header transparent au scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Gestion de la déconnexion
        const logoutBtn = document.getElementById('logoutMenuLink');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Déconnexion',
                        text: 'Voulez-vous vraiment vous déconnecter ?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#2d4a8a',
                        cancelButtonColor: '#dc2626',
                        confirmButtonText: 'Oui, me déconnecter',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form')?.submit();
                        }
                    });
                } else {
                    document.getElementById('logout-form')?.submit();
                }
            });
        }

        // Initialiser les gestionnaires
        handleMobileDropdowns();
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                dropdowns.forEach(d => d.classList.remove('active'));
                if (mobileToggle.classList.contains('active')) {
                    mobileToggle.classList.remove('active');
                    navMenu.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
            handleMobileDropdowns();
        });
    });
</script>

{{-- Formulaire de déconnexion caché --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
