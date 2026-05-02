@extends('front.layout.master')

@section('title', 'Notre Identité | Bantou-Foundation')
@section('description', 'Découvrez l\'histoire, les valeurs, la mission et l\'équipe de Bantou-Foundation, engagée pour l\'éducation, la santé et le développement durable en Afrique.')

@section('styles')
<style>
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
        --border-radius: 16px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Scroll Reveal */
    .reveal {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity 0.7s ease, transform 0.7s ease;
    }
    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* Hero Section */
    .hero-identite {
        position: relative;
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-top: 0;
    }
    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }
    .hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.45);
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(15, 26, 58, 0.85) 0%, rgba(45, 74, 138, 0.65) 100%);
    }
    .hero-content {
        position: relative;
        z-index: 10;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(212, 175, 55, 0.2);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(212, 175, 55, 0.3);
        padding: 8px 20px;
        border-radius: 100px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--accent-gold);
        margin-bottom: 24px;
    }
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--pure-white);
        margin-bottom: 20px;
        line-height: 1.2;
        letter-spacing: -0.02em;
    }
    .hero-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.85);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Carousel Styles amélioré */
    .carousel-section {
        padding: 60px 0;
        background: var(--bg-light);
    }
    .carousel-container {
        position: relative;
        width: 100%;
        height: 500px;
        overflow: hidden;
        border-radius: 32px;
        box-shadow: 0 20px 40px var(--shadow-medium);
    }
    .carousel-slide {
        display: flex;
        width: 300%;
        height: 100%;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .slide {
        position: relative;
        width: 33.333%;
        height: 100%;
    }
    .slide-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .slide-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(15, 26, 58, 0.9), transparent);
        color: var(--pure-white);
        padding: 40px;
    }
    .slide-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .slide-sector {
        font-size: 0.9rem;
        opacity: 0.85;
    }
    .sector-indicator {
        position: absolute;
        top: 24px;
        right: 24px;
        background: var(--accent-gold);
        color: var(--navy-blue);
        padding: 8px 20px;
        border-radius: 100px;
        font-weight: 700;
        font-size: 0.8rem;
        backdrop-filter: blur(8px);
    }
    .carousel-control {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.95);
        border: none;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 4px 15px var(--shadow-light);
        color: var(--navy-blue);
        z-index: 20;
    }
    .carousel-control:hover {
        background: var(--accent-gold);
        color: var(--pure-white);
        transform: translateY(-50%) scale(1.05);
    }
    .carousel-control.prev { left: 24px; }
    .carousel-control.next { right: 24px; }
    .carousel-indicators {
        position: absolute;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 12px;
        z-index: 20;
    }
    .indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--pure-white);
        opacity: 0.5;
        cursor: pointer;
        transition: var(--transition);
    }
    .indicator.active {
        opacity: 1;
        background: var(--accent-gold);
        transform: scale(1.2);
    }

    /* Section Title */
    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 3rem;
        color: var(--navy-blue);
        position: relative;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-gold), var(--accent-light));
        border-radius: 2px;
    }

    /* Cards Grid */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
        margin-top: 20px;
    }
    .card {
        background: var(--pure-white);
        padding: 32px;
        border-radius: 24px;
        box-shadow: 0 4px 20px var(--shadow-light);
        text-align: center;
        transition: var(--transition);
        border: 1px solid rgba(45, 74, 138, 0.1);
    }
    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px var(--shadow-medium);
        border-color: var(--accent-gold);
    }
    .card-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--light-blue), var(--medium-blue));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        color: var(--pure-white);
        font-size: 2rem;
        transition: var(--transition);
    }
    .card:hover .card-icon {
        transform: scale(1.05);
        background: linear-gradient(135deg, var(--accent-gold), var(--accent-light));
    }
    .card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 16px;
        color: var(--navy-blue);
    }
    .card p {
        color: var(--text-light);
        line-height: 1.7;
        text-align: justify;
    }

    /* Values Grid spécifique */
    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }
    .value-card {
        background: var(--pure-white);
        padding: 28px;
        border-radius: 24px;
        text-align: center;
        transition: var(--transition);
        border-bottom: 4px solid var(--medium-blue);
    }
    .value-card:hover {
        transform: translateY(-5px);
        border-bottom-color: var(--accent-gold);
        box-shadow: 0 15px 35px var(--shadow-light);
    }
    .value-icon {
        width: 70px;
        height: 70px;
        background: rgba(45, 74, 138, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: var(--medium-blue);
        font-size: 1.8rem;
        transition: var(--transition);
    }
    .value-card:hover .value-icon {
        background: var(--accent-gold);
        color: var(--pure-white);
    }
    .value-card h3 {
        font-size: 1.3rem;
        margin-bottom: 12px;
        color: var(--navy-blue);
    }
    .value-card p {
        color: var(--text-light);
        line-height: 1.6;
    }

    /* Team Grid */
    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
    .team-card {
        background: var(--pure-white);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 5px 20px var(--shadow-light);
        transition: var(--transition);
        text-align: center;
    }
    .team-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px var(--shadow-medium);
    }
    .team-photo {
        width: 100%;
        height: 280px;
        overflow: hidden;
        position: relative;
    }
    .team-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .team-card:hover .team-photo img {
        transform: scale(1.05);
    }
    .team-social {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 15px;
        padding: 15px;
        background: linear-gradient(to top, rgba(15, 26, 58, 0.9), transparent);
        transition: bottom 0.3s ease;
    }
    .team-card:hover .team-social {
        bottom: 0;
    }
    .team-social a {
        width: 35px;
        height: 35px;
        background: var(--accent-gold);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--navy-blue);
        transition: var(--transition);
    }
    .team-social a:hover {
        transform: scale(1.1);
        background: var(--pure-white);
    }
    .team-card h4 {
        margin: 20px 0 5px;
        color: var(--navy-blue);
        font-size: 1.2rem;
        font-weight: 700;
    }
    .team-role {
        color: var(--accent-gold);
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 0.85rem;
    }
    .team-card p {
        padding: 0 20px 25px;
        color: var(--text-light);
        font-size: 0.9rem;
        line-height: 1.6;
    }

    /* Citation Section */
    .citation-section {
        background: linear-gradient(135deg, var(--navy-blue) 0%, var(--dark-blue) 100%);
        padding: 80px 0;
        margin: 60px 0;
    }
    .citation-card {
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
        color: var(--pure-white);
    }
    .citation-icon {
        font-size: 3rem;
        color: var(--accent-gold);
        margin-bottom: 30px;
    }
    .citation-text {
        font-size: 1.3rem;
        line-height: 1.8;
        font-style: italic;
        margin-bottom: 30px;
    }
    .citation-author {
        font-weight: 700;
        font-size: 1.1rem;
    }
    .citation-author span {
        display: block;
        font-weight: 400;
        font-size: 0.9rem;
        opacity: 0.8;
        margin-top: 5px;
    }

    /* Stats Section */
    .stats-section {
        padding: 60px 0;
        background: var(--bg-light);
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
    }
    .stat-card {
        background: var(--pure-white);
        padding: 32px;
        border-radius: 24px;
        text-align: center;
        transition: var(--transition);
        border: 1px solid rgba(45, 74, 138, 0.1);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent-gold);
        box-shadow: 0 15px 35px var(--shadow-light);
    }
    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        color: var(--medium-blue);
        margin-bottom: 10px;
    }
    .stat-label {
        color: var(--text-light);
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .hero-title { font-size: 2.5rem; }
        .carousel-container { height: 400px; }
        .slide-title { font-size: 1.5rem; }
        .slide-overlay { padding: 25px; }
        .citation-text { font-size: 1.1rem; }
    }
    @media (max-width: 768px) {
        .hero-title { font-size: 1.8rem; }
        .section-title { font-size: 2rem; }
        .carousel-container { height: 320px; }
        .carousel-control { width: 40px; height: 40px; }
        .sector-indicator { font-size: 0.7rem; padding: 5px 12px; }
        .slide-title { font-size: 1.2rem; }
        .cards-grid, .values-grid, .team-grid, .stats-grid { grid-template-columns: 1fr; }
        .citation-text { font-size: 1rem; }
    }
    @media (max-width: 480px) {
        .hero-title { font-size: 1.5rem; }
        .carousel-container { height: 280px; }
        .slide-overlay { padding: 15px; }
        .card { padding: 24px; }
    }
</style>
@endsection

@section('content')
    {{-- HERO SECTION --}}
    <section class="hero-identite">
        <div class="hero-bg">
            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1600"
                alt="Bantou-Foundation" loading="eager">
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content reveal">
            <div class="hero-badge">
                <i data-lucide="heart" class="w-4 h-4"></i> Qui sommes-nous ?
            </div>
            <h1 class="hero-title">Notre Identité</h1>
            <p class="hero-subtitle">Découvrez l'histoire, les valeurs et l'engagement de Bantou-Foundation pour un avenir meilleur</p>
        </div>
    </section>

    {{-- CARROUSEL --}}
    <section class="carousel-section reveal">
        <div class="max-w-7xl mx-auto px-4">
            <div class="carousel-container">
                <div class="carousel-slide">
                    <div class="slide">
                        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1200"
                            alt="Communauté" class="slide-image">
                        <div class="slide-overlay">
                            <h2 class="slide-title">Notre Fondation</h2>
                            <span class="slide-sector">Qui Sommes-Nous</span>
                        </div>
                        <div class="sector-indicator">Histoire</div>
                    </div>
                    <div class="slide">
                        <img src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1200"
                            alt="Équipe" class="slide-image">
                        <div class="slide-overlay">
                            <h2 class="slide-title">Notre Équipe Engagée</h2>
                            <span class="slide-sector">Qui Sommes-Nous</span>
                        </div>
                        <div class="sector-indicator">Équipe</div>
                    </div>
                    <div class="slide">
                        <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=1200"
                            alt="Valeurs" class="slide-image">
                        <div class="slide-overlay">
                            <h2 class="slide-title">Nos Valeurs Fondatrices</h2>
                            <span class="slide-sector">Qui Sommes-Nous</span>
                        </div>
                        <div class="sector-indicator">Valeurs</div>
                    </div>
                </div>
                <button class="carousel-control prev">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
                <button class="carousel-control next">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>
                <div class="carousel-indicators">
                    <div class="indicator active"></div>
                    <div class="indicator"></div>
                    <div class="indicator"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- HISTOIRE SECTION --}}
    <section id="histoire" class="py-20 bg-white reveal">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="section-title">Notre Histoire</h2>
            <div class="cards-grid">
                <div class="card reveal reveal-delay-1">
                    <div class="card-icon">
                        <i data-lucide="seedling" class="w-8 h-8"></i>
                    </div>
                    <h3>Notre Création</h3>
                    <p>
                        Bantou-Foundation est née d'un constat simple mais essentiel : la vie est la plus grande richesse que nous possédons.
                        Elle est le souffle qui anime nos existences, la source de toutes les créations et de toutes les espérances.
                    </p>
                </div>
                <div class="card reveal reveal-delay-2">
                    <div class="card-icon">
                        <i data-lucide="heart" class="w-8 h-8"></i>
                    </div>
                    <h3>Notre Mission</h3>
                    <p>
                        Notre mission est de préserver, nourrir et amplifier la vie sous toutes ses formes.
                        Nous travaillons pour que chaque enfant ait accès à l'éducation, que chaque famille puisse bénéficier d'une santé digne.
                    </p>
                </div>
                <div class="card reveal reveal-delay-3">
                    <div class="card-icon">
                        <i data-lucide="eye" class="w-8 h-8"></i>
                    </div>
                    <h3>Notre Vision</h3>
                    <p>
                        Notre vision est celle d'un monde où la vie est respectée et honorée comme le plus précieux des trésors.
                        Un monde où les générations futures hériteront de la force, de la santé, de la joie et de la lumière.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- VALEURS SECTION --}}
    <section id="nos-valeurs" class="py-20 bg-[#F8FAFC] reveal">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="section-title">Nos Valeurs</h2>
            <div class="values-grid">
                <div class="value-card reveal reveal-delay-1">
                    <div class="value-icon">
                        <i data-lucide="hands-helping" class="w-7 h-7"></i>
                    </div>
                    <h3>Compassion</h3>
                    <p>Nous agissons avec intégrité, sans calcul, en nous mettant réellement à la place de ceux qui souffrent.</p>
                </div>
                <div class="value-card reveal reveal-delay-2">
                    <div class="value-icon">
                        <i data-lucide="users" class="w-7 h-7"></i>
                    </div>
                    <h3>Solidarité</h3>
                    <p>Nous croyons à la force du collectif, car la vie ne prend tout son sens que lorsqu'elle est partagée.</p>
                </div>
                <div class="value-card reveal reveal-delay-3">
                    <div class="value-icon">
                        <i data-lucide="lightbulb" class="w-7 h-7"></i>
                    </div>
                    <h3>Innovation</h3>
                    <p>Créer sans cesse de nouvelles formes pour améliorer les conditions de vie.</p>
                </div>
                <div class="value-card reveal reveal-delay-4">
                    <div class="value-icon">
                        <i data-lucide="leaf" class="w-7 h-7"></i>
                    </div>
                    <h3>Durabilité</h3>
                    <p>Protéger la vie, c'est aussi protéger la nature, l'environnement et les générations futures.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CONSEIL D'ADMINISTRATION --}}
    <section id="conseil-administration" class="py-20 bg-white reveal">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="section-title">Conseil d'Administration</h2>
            <p class="text-center max-w-2xl mx-auto mb-12 text-gray-500">
                Notre Conseil d'administration est composé de femmes et d'hommes engagés, passionnés par la vie et convaincus que chaque action sincère peut changer le monde.
            </p>
            <div class="team-grid">
                <div class="team-card reveal reveal-delay-1">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1590086782792-42dd2350140d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400"
                            alt="Berthe KENDZO">
                        <div class="team-social">
                            <a href="#"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
                            <a href="#"><i data-lucide="mail" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                    <h4>Berthe KENDZO</h4>
                    <div class="team-role">Présidente Fondatrice</div>
                    <p>Fondatrice visionnaire de Bantou-Foundation, elle incarne les valeurs de compassion et d'engagement qui animent notre organisation.</p>
                </div>
                <div class="team-card reveal reveal-delay-2">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400"
                            alt="Marie Lambert">
                        <div class="team-social">
                            <a href="#"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
                            <a href="#"><i data-lucide="mail" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                    <h4>Marie Lambert</h4>
                    <div class="team-role">Secrétaire Générale</div>
                    <p>Garante de la transparence et de la rigueur administrative, elle veille au bon fonctionnement de la fondation.</p>
                </div>
                <div class="team-card reveal reveal-delay-3">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400"
                            alt="Jean Leroy">
                        <div class="team-social">
                            <a href="#"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
                            <a href="#"><i data-lucide="mail" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                    <h4>Jean Leroy</h4>
                    <div class="team-role">Trésorier</div>
                    <p>Expert en gestion financière, il assure la pérennité des ressources et la bonne utilisation des fonds.</p>
                </div>
                <div class="team-card reveal reveal-delay-4">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400"
                            alt="Sophie Martin">
                        <div class="team-social">
                            <a href="#"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
                            <a href="#"><i data-lucide="mail" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                    <h4>Sophie Martin</h4>
                    <div class="team-role">Chargée des Programmes Éducatifs</div>
                    <p>Spécialiste en éducation, elle développe et supervise nos programmes de formation et d'alphabétisation.</p>
                </div>
                <div class="team-card reveal reveal-delay-1">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400"
                            alt="Claire Dubois">
                        <div class="team-social">
                            <a href="#"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
                            <a href="#"><i data-lucide="mail" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                    <h4>Claire Dubois</h4>
                    <div class="team-role">Chargée des Programmes Santé</div>
                    <p>Experte en santé communautaire, elle coordonne nos actions de prévention et d'accès aux soins.</p>
                </div>
                <div class="team-card reveal reveal-delay-2">
                    <div class="team-photo">
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=400"
                            alt="Lucas Robert">
                        <div class="team-social">
                            <a href="#"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
                            <a href="#"><i data-lucide="mail" class="w-4 h-4"></i></a>
                        </div>
                    </div>
                    <h4>Lucas Robert</h4>
                    <div class="team-role">Chargé du Développement Durable</div>
                    <p>Passionné par l'environnement, il pilote nos projets de reboisement et de gestion des déchets.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- MOT DU FONDATEUR --}}
    <section class="citation-section reveal">
        <div class="max-w-7xl mx-auto px-4">
            <div class="citation-card">
                <div class="citation-icon">
                    <i data-lucide="quote" class="w-12 h-12"></i>
                </div>
                <p class="citation-text">
                    "Bantou-Foundation est née d'une conviction simple et personnelle : <strong>la vraie magie, le vrai pouvoir, se trouve dans la vie que nous menons et dans l'amour que nous y mettons</strong>. Travailler pour soi seul, poursuivre uniquement des résultats immédiats, c'est comme semer dans un sol stérile : tout se perd. Mais travailler avec patience, avec sincérité, avec confiance pour les autres, pour la collectivité, pour la vie elle-même, c'est semer dans un terreau fertile… et les fruits reviendront, souvent de manière inattendue, mais toujours certaine."
                </p>
                <p class="citation-text" style="font-size: 1.1rem;">
                    "Chaque action que nous posons pour éduquer un enfant, soutenir une famille, protéger l'environnement ou promouvoir la santé et la dignité humaine, n'est jamais perdue. Même si les résultats tardent à se montrer, la vie elle-même, dans sa sagesse infinie, s'en chargera."
                </p>
                <div class="citation-author">
                    Berthe KENDZO
                    <span>Fondatrice de Bantou-Foundation</span>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS SECTION --}}
    <section class="stats-section reveal">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="section-title">Notre Impact en Chiffres</h2>
            <div class="stats-grid">
                <div class="stat-card reveal reveal-delay-1">
                    <div class="stat-number">10 000+</div>
                    <div class="stat-label">Vies transformées</div>
                </div>
                <div class="stat-card reveal reveal-delay-2">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Projets réalisés</div>
                </div>
                <div class="stat-card reveal reveal-delay-3">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Communautés touchées</div>
                </div>
                <div class="stat-card reveal reveal-delay-4">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Transparence financière</div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Carousel functionality
        document.addEventListener('DOMContentLoaded', function() {
            const slide = document.querySelector('.carousel-slide');
            const slides = document.querySelectorAll('.slide');
            const prevButton = document.querySelector('.carousel-control.prev');
            const nextButton = document.querySelector('.carousel-control.next');
            const indicators = document.querySelectorAll('.indicator');

            let currentSlide = 0;
            const totalSlides = slides.length;

            function goToSlide(n) {
                currentSlide = (n + totalSlides) % totalSlides;
                slide.style.transform = `translateX(-${currentSlide * (100 / totalSlides)}%)`;
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === currentSlide);
                });
            }

            function nextSlide() { goToSlide(currentSlide + 1); }
            function prevSlide() { goToSlide(currentSlide - 1); }

            nextButton.addEventListener('click', nextSlide);
            prevButton.addEventListener('click', prevSlide);
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => goToSlide(index));
            });

            setInterval(nextSlide, 5000);
        });

        // Scroll Reveal
        const revealEls = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(el => revealObserver.observe(el));
    </script>
@endsection
