@extends('_partials.master')

@section('title', 'Bantou-Foundation / Agir pour la vie')
@section('description', 'Bantou-Foundation œuvre pour l\'éducation, la santé et le développement durable en Afrique.')

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

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Poppins', 'Segoe UI', sans-serif;
        line-height: 1.6;
        color: var(--text-dark);
        background-color: var(--bg-light);
        overflow-x: hidden;
    }

    .container {
        width: 100%;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* Boutons modernes */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        cursor: pointer;
        border: none;
        font-size: 1rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--accent-gold), var(--accent-light));
        color: var(--navy-blue);
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(212, 175, 55, 0.4);
    }

    .btn-outline {
        background: transparent;
        color: var(--navy-blue);
        border: 2px solid var(--accent-gold);
    }

    .btn-outline:hover {
        background: var(--accent-gold);
        color: var(--navy-blue);
        transform: translateY(-3px);
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-top: 0;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    .hero-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(15, 26, 58, 0.85) 0%, rgba(42, 67, 135, 0.7) 100%);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: var(--pure-white);
        max-width: 800px;
        margin: 0 auto;
        padding: 120px 20px;
    }

    .hero-badge {
        display: inline-block;
        background: rgba(212, 175, 55, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(212, 175, 55, 0.3);
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 24px;
        letter-spacing: 1px;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .hero-content h1 span {
        color: var(--accent-gold);
    }

    .hero-content p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 32px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .hero-buttons .btn-primary {
        background: var(--accent-gold);
        color: var(--navy-blue);
    }

    .hero-buttons .btn-outline-light {
        background: transparent;
        border: 2px solid var(--pure-white);
        color: var(--pure-white);
    }

    .hero-buttons .btn-outline-light:hover {
        background: var(--pure-white);
        color: var(--navy-blue);
    }

    /* Reveal animations */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
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

    /* Section titles */
    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--navy-blue);
        margin-bottom: 1rem;
        position: relative;
    }

    .section-subtitle {
        text-align: center;
        color: var(--text-light);
        max-width: 700px;
        margin: 0 auto 3rem;
        font-size: 1.1rem;
    }

    .section-badge {
        display: inline-block;
        background: rgba(212, 175, 55, 0.15);
        color: var(--accent-gold);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 6px 16px;
        border-radius: 50px;
        margin-bottom: 1rem;
    }

    /* Stats Section */
    .stats-section {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--pure-white) 0%, var(--bg-light) 100%);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .stat-card {
        text-align: center;
        padding: 40px 24px;
        border-radius: var(--border-radius);
        background: var(--pure-white);
        box-shadow: 0 5px 20px var(--shadow-light);
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px var(--shadow-medium);
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--medium-blue), var(--light-blue));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: var(--pure-white);
        font-size: 28px;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        color: var(--navy-blue);
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--text-light);
        line-height: 1.5;
    }

    /* Impact Section */
    .impact-section {
        padding: 80px 0;
        background: var(--pure-white);
    }

    .impact-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .impact-text h2 {
        font-size: 2.2rem;
        color: var(--navy-blue);
        margin-bottom: 20px;
    }

    .impact-text p {
        color: var(--text-light);
        margin-bottom: 25px;
        line-height: 1.7;
    }

    .impact-stats {
        display: flex;
        gap: 30px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .impact-stat {
        text-align: center;
    }

    .impact-stat .number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--accent-gold);
    }

    .impact-stat .label {
        font-size: 0.8rem;
        color: var(--text-light);
    }

    .impact-image {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px var(--shadow-medium);
    }

    .impact-image img {
        width: 100%;
        height: auto;
        display: block;
        transition: var(--transition);
    }

    .impact-image:hover img {
        transform: scale(1.05);
    }

    /* Actions Section */
    .actions-section {
        padding: 80px 0;
        background: var(--bg-light);
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
    }

    .action-card {
        background: var(--pure-white);
        border-radius: 24px;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: 0 5px 20px var(--shadow-light);
    }

    .action-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px var(--shadow-medium);
    }

    .action-image {
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .action-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .action-card:hover .action-image img {
        transform: scale(1.1);
    }

    .action-overlay {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--accent-gold);
        color: var(--navy-blue);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .action-content {
        padding: 28px;
    }

    .action-icon {
        width: 50px;
        height: 50px;
        background: rgba(212, 175, 55, 0.15);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: var(--accent-gold);
        font-size: 24px;
    }

    .action-title {
        font-size: 1.35rem;
        color: var(--navy-blue);
        margin-bottom: 12px;
    }

    .action-description {
        color: var(--text-light);
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .action-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--accent-gold);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }

    .action-link:hover {
        gap: 12px;
        color: var(--accent-light);
    }

    /* CTA Section */
    .cta-section {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--navy-blue) 0%, var(--dark-blue) 100%);
        color: var(--pure-white);
        text-align: center;
    }

    .cta-content {
        max-width: 700px;
        margin: 0 auto;
    }

    .cta-content h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .cta-content p {
        opacity: 0.9;
        margin-bottom: 30px;
    }

    .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .impact-content {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .section-title {
            font-size: 2rem;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }

        .stats-section,
        .impact-section,
        .actions-section,
        .cta-section {
            padding: 60px 0;
        }

        .section-title {
            font-size: 1.75rem;
        }

        .stats-grid,
        .actions-grid {
            grid-template-columns: 1fr;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }

        .btn {
            width: 100%;
            max-width: 280px;
        }

        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-content p {
            font-size: 1rem;
        }

        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section avec image -->
<section class="hero-section">
    <div class="hero-background">
        <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Bantou-Foundation Hero">
        <div class="hero-overlay"></div>
    </div>
    <div class="hero-content">
        <div class="hero-badge reveal">
            <i class="fas fa-heart"></i> Ensemble pour un avenir meilleur
        </div>
        <h1 class="reveal reveal-delay-1">
            Agir pour <span>la vie</span><br>Transformer des vies
        </h1>
        <p class="reveal reveal-delay-2">
            Bantou-Foundation œuvre pour l'éducation, la santé et le développement durable en Afrique. Rejoignez-nous pour créer un impact durable.
        </p>
        <div class="hero-buttons reveal reveal-delay-3">
            <a href="{{ route('don') }}" class="btn btn-primary">
                <i class="fas fa-heart"></i> Faire un don
            </a>
            <a href="{{ route('nous_rejoindre') }}" class="btn btn-outline-light">
                <i class="fas fa-hands-helping"></i> Nous rejoindre
            </a>
        </div>
    </div>
</section>

<!-- Section Chiffres clés -->
<section class="stats-section">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-badge">Notre Impact</span>
            <h2 class="section-title">Nos Chiffres Clés</h2>
            <p class="section-subtitle">Des résultats concrets qui témoignent de notre engagement quotidien</p>
        </div>
        <div class="stats-grid">
            <div class="stat-card reveal reveal-delay-1">
                <div class="stat-icon">
                    <i class="fas fa-child"></i>
                </div>
                <div class="stat-number" data-count="5608">0</div>
                <div class="stat-label">Enfants et familles soutenus grâce à nos programmes d'éducation et de santé</div>
            </div>
            <div class="stat-card reveal reveal-delay-2">
                <div class="stat-icon">
                    <i class="fas fa-school"></i>
                </div>
                <div class="stat-number" data-count="25">0</div>
                <div class="stat-label">Établissements équipés avec du matériel éducatif et des infrastructures améliorées</div>
            </div>
            <div class="stat-card reveal reveal-delay-3">
                <div class="stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-number" data-count="45">0</div>
                <div class="stat-label">Micro-entreprises soutenues avec des formations et financements</div>
            </div>
            <div class="stat-card reveal reveal-delay-4">
                <div class="stat-icon">
                    <i class="fas fa-tree"></i>
                </div>
                <div class="stat-number" data-count="10000">0</div>
                <div class="stat-label">Arbres plantés dans le cadre de nos initiatives de reboisement</div>
            </div>
        </div>
    </div>
</section>

<!-- Section Impact -->
<section class="impact-section">
    <div class="container">
        <div class="impact-content">
            <div class="impact-text reveal">
                <span class="section-badge">Notre Vision</span>
                <h2>Un Impact Durable <br>pour les Générations Futures</h2>
                <p>Depuis notre création, Bantou-Foundation a transformé la vie de milliers de personnes à travers l'Afrique. Nos programmes sont conçus pour créer un changement durable et mesurable dans les communautés que nous servons.</p>
                <p>Nous croyons en une approche holistique du développement, où l'éducation, la santé et la durabilité environnementale sont interconnectées. Chaque projet que nous mettons en œuvre est le fruit d'une collaboration étroite avec les communautés locales.</p>
                <div class="impact-stats">
                    <div class="impact-stat">
                        <div class="number">5+</div>
                        <div class="label">Années d'action</div>
                    </div>
                    <div class="impact-stat">
                        <div class="number">15+</div>
                        <div class="label">Communautés</div>
                    </div>
                    <div class="impact-stat">
                        <div class="number">50+</div>
                        <div class="label">Partenaires</div>
                    </div>
                </div>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-chart-line"></i> Voir notre rapport d'impact
                </a>
            </div>
            <div class="impact-image reveal reveal-delay-2">
                <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Impact de Bantou-Foundation">
            </div>
        </div>
    </div>
</section>

<!-- Section Actions -->
<section class="actions-section">
    <div class="container">
        <div class="text-center reveal">
            <span class="section-badge">Nos Domaines d'Action</span>
            <h2 class="section-title">Ce que nous faisons</h2>
            <p class="section-subtitle">Des actions concrètes pour un changement positif et durable</p>
        </div>
        <div class="actions-grid">
            <!-- Éducation -->
            <div class="action-card reveal reveal-delay-1">
                <div class="action-image">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Éducation">
                    <div class="action-overlay">Priorité #1</div>
                </div>
                <div class="action-content">
                    <div class="action-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="action-title">Éducation & Formation</h3>
                    <p class="action-description">Bourses d'études, programmes d'alphabétisation, formations numériques et entrepreneuriales pour autonomiser les jeunes.</p>
                    <a href="#" class="action-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Santé -->
            <div class="action-card reveal reveal-delay-2">
                <div class="action-image">
                    <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Santé">
                    <div class="action-overlay">Priorité #2</div>
                </div>
                <div class="action-content">
                    <div class="action-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3 class="action-title">Santé & Bien-être</h3>
                    <p class="action-description">Prévention, soutien aux hôpitaux, campagnes de sensibilisation et distribution de kits d'hygiène.</p>
                    <a href="#" class="action-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Environnement -->
            <div class="action-card reveal reveal-delay-3">
                <div class="action-image">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Environnement">
                    <div class="action-overlay">Priorité #3</div>
                </div>
                <div class="action-content">
                    <div class="action-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3 class="action-title">Environnement & Développement durable</h3>
                    <p class="action-description">Reboisement, énergies renouvelables, gestion des déchets pour un avenir plus vert.</p>
                    <a href="#" class="action-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content reveal">
            <h2>Rejoignez le Mouvement</h2>
            <p>Chaque geste compte. Que ce soit par un don, du bénévolat ou un partenariat, vous pouvez faire la différence.</p>
            <div class="cta-buttons">
                <a href="{{ route('don') }}" class="btn btn-primary">
                    <i class="fas fa-heart"></i> Faire un don
                </a>
                <a href="{{ route('nous_rejoindre') }}" class="btn btn-outline-light">
                    <i class="fas fa-hands-helping"></i> Devenir bénévole
                </a>
            </div>
        </div>
    </div>
</section>

@include("_partials.blog")
@endsection

@section('scripts')
<script>
    // Animation des compteurs
    document.addEventListener('DOMContentLoaded', function() {
        const statNumbers = document.querySelectorAll('.stat-number');

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const numberElement = entry.target;
                    const target = parseInt(numberElement.getAttribute('data-count'));
                    let current = 0;
                    const duration = 2000;
                    const step = Math.ceil(target / (duration / 30));

                    const timer = setInterval(() => {
                        current += step;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        numberElement.textContent = current.toLocaleString();
                    }, 30);

                    counterObserver.unobserve(numberElement);
                }
            });
        }, { threshold: 0.5 });

        statNumbers.forEach(number => {
            counterObserver.observe(number);
        });
    });

    // Scroll Reveal Animation
    const revealElements = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    revealElements.forEach(el => revealObserver.observe(el));
</script>
@endsection
